<?php

session_start();

include ('includes/functions.inc');
require_once ('includes/mysql_connect.php');
// WePay PHP SDK - http://git.io/mY7iQQ
    require 'includes/wepay.php';

$mid = 8;

$term = $_GET['term'];

$merchant_info = get_merchant_info($mid);

$sub_id = $_GET['s_id'];

$subscription_info = get_sub_type_info($sub_id);

$account_id = $merchant_info['wepay_id'];
$client_id = 96607;
$client_secret = "127a37d4f3";
$access_token = $merchant_info['merchant_auth'];

if (isset($_GET['checkout_id'])) {

	$checkout_id = $_GET['checkout_id'];

	// change to useProduction for live environments
	Wepay::useStaging($client_id, $client_secret);

	$wepay = new WePay($access_token);
	
	// create the checkout
	$response = $wepay->request('checkout', array(
		'checkout_id'        => $checkout_id
	));

	$un = $response->payer_name;
	$e = $response->payer_email;
	$p = 'password';
	

	if (check_email($e)) {

	} else {

		$q2 = "INSERT INTO users (username, email, pass, jointime) VALUES ('$un', '$e', SHA1('$p'), NOW() )";
		$r2 = @mysql_query ($q2);
		
	}
	
	$q3 = "SELECT * FROM users WHERE email='$e' LIMIT 1";
	$r3 = @mysql_query ($q3);

	$user_info = mysql_fetch_assoc($r3);

	$user_id = $user_info['user_id'];
	
	$gift_code = genRandomString();
	
	$q4 = "INSERT INTO gift_subscriptions (gifter_id, subscription_type_id, gift_term, gift_term_remaining, gift_code) VALUES ('$user_id', '$sub_id', '$term', '$term', '$gift_code' )";
	$r4 = @mysql_query ($q4);
	
	$url = 'gift_thanks.php?gift_code=' . $gift_code;
	header("Location: $url");
	exit();

}

if ($term == 3) {
	$price = 30;
} elseif ($term == 6) {
	$price = 60;
} elseif ($term == 12) {
	$price = 100;
}

    // application settings
	$charge = $price . '.00';
	$commission = $charge/10;
	$subscription_name = $subscription_info['subscription_name'];
	$redirect = 'http://nuclear2.citypackr.com/gift_purchase.php?s_id=' . $sub_id . '&term=' . $term;

    // change to useProduction for live environments
    Wepay::useStaging($client_id, $client_secret);

    $wepay = new WePay($access_token);
	
	$year = date("Y") + 1;
	$month = date("m");
	$day = date("d");

	$date = $year . '-' . $month . '-' . $day;
	
    // create the pre-approval
    $response = $wepay->request('checkout/create', array(
        'account_id'        => $account_id,
		'type'				=> 'GOODS',
        'amount'            => $charge,
        'app_fee'            => $commission,
		'fee_payer'         => 'payee',
        'mode'              => 'iframe',
        'short_description' => $subscription_name,
        'redirect_uri'      => $redirect,
    ));
    
    // display the approval embed
	$iframe_uri = $response->{checkout_uri};
	

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>CityPackr - The Best of Your City on Your Doorstep</title>
	<link rel=StyleSheet href="bootstrap/css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){

});//]]>  
function changeURL( url ) {
    document.location = url;
}
</script>
</head>
<body style="background-image:url('images/clean_comic_background.jpg');">
<script language="Javascript">

window.onload = function() {
    timeout_init();
};

function timeout_trigger() {
    window.location="http://nuclear2.citypackr.com";   
}

function timeout_init() {
    setTimeout('timeout_trigger()', 140000);
}

</script>
<script type="text/javascript" src="https://www.wepay.com/js/iframe.wepay.js">
</script>
<script type="text/javascript">
    WePay.iframe_checkout("preapproval_div_id", "<?php echo $iframe_uri; ?>");
</script>
<div class="container">
	<div class="well" style="height: 150px; margin-top: 20px; background-color: white;">
		<div class="span2">
			<ul class="thumbnails">
				<li class="span2">
					<div class="thumbnail">
						<img src="../images/<?php echo $subscription_info['sub_image']; ?>" />
					</div>
				</li>
			</ul>
		</div>
		<h3 class="span6"><?php echo $subscription_info['subscription_name']; ?></h3>
		<?php if ($term == 3): ?>
		<h3 class="span3">3 Months/$30</h3>
		<?php elseif ($term == 6): ?>
		<h3 class="span3">6 Months/$60</h3>
		<?php elseif ($term == 12): ?>
		<h3 class="span3">12 Months/$100</h3>
		<?php endif; ?>
		<div class="clearfix"></div>
	</div>
	<div class="well" style="background-color: white;">
		<h2>Enter Payment Information</h2>
		<div class="span3">
			<h3>About WePay:</h3>
			<ul>
				<li>WePay is a secure billing service which will charge the subscription fee once a month.</li>
				<li>You will receive a confirmation e-mail from WePay and from CityPackr after you have finished signing up.</li>
				<li>You may pause or cancel your subscription at any time.</li>
			<ul>
		</div>
		<iframe src="<?php echo $iframe_uri; ?>" class="span8" height="295px" frameborder="0" id="preapproval_div_id"></iframe>
		<div class="clearfix"></div>	
	</div>
</div>
</body>
</html>
<?php

?>