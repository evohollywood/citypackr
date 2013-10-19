<?php

session_start();

include ('includes/functions.inc');
require_once ('includes/mysql_connect.php');

$mid = 8;

$merchant_info = get_merchant_info($mid);

$sub_id = $_GET['s_id'];

$subscription_info = get_sub_type_info($sub_id);

if ($_POST['submitted']) {

	$errors = array();

	if (empty($_POST['userAddress'])) {

		$errors[] = 'You forgot to enter a shipping address.';

	} else {
	
		$ua = trim($_POST['userAddress']);

	}

	if (isset($_POST['userApt'])) {
	
		$uapt = trim($_POST['userApt']);

	}

	if (!empty($_POST['userZip'])) {
			
		$z = trim($_POST['userZip']);
			
	} else {

		$errors[] = 'You forgot to enter your zip code.';
	
	}

}

if (empty($errors)) {
		
	$q2 = "INSERT INTO shipping_addresses (user_id, address, apt, zip) VALUES ('0', '$ua', '$uapt', '$z')";
	$r2 = @mysql_query ($q2);
	
	if ($r2) {
	
		$q3 = "SELECT * FROM shipping_addresses WHERE address='$ua' ORDER BY address_id DESC LIMIT 1";
		$r3 = @mysql_query ($q3);
		$address_info = mysql_fetch_assoc($r3);
	
	}

} else {

	$url = 'delivery.php?s_id=' . $sub_id;
	header("Location: $url");
	exit();

}



// WePay PHP SDK - http://git.io/mY7iQQ
    require 'includes/wepay.php';

    // application settings
    $account_id = $merchant_info['wepay_id'];
    $client_id = 96607;
    $client_secret = "127a37d4f3";
    $access_token = $merchant_info['merchant_auth'];
	$charge = $subscription_info['subscription_price'] . '.00';
	$commission = $charge/10;
	$subscription_name = $subscription_info['subscription_name'];
	$redirect = 'http://nuclear.citypackr.com/purchase.php?s_id=' . $sub_id . '&a_id=' . $address_info['address_id'];

    // change to useProduction for live environments
    Wepay::useStaging($client_id, $client_secret);

    $wepay = new WePay($access_token);
	
	$year = date("Y") + 1;
	$month = date("m");
	$day = date("d");

	$date = $year . '-' . $month . '-' . $day;

    // create the pre-approval
    $response = $wepay->request('preapproval/create', array(
        'account_id'        => $account_id,
        'period'            => 'monthly',
        'end_time'          => $date,
        'amount'            => $charge,
        'app_fee'            => $commission,
		'fee_payer'         => 'payee',
        'mode'              => 'iframe',
        'short_description' => $subscription_name,
        'redirect_uri'      => $redirect,
        'auto_recur'        => 'true'
    ));
    
    // display the approval embed
	$iframe_uri = $response->{preapproval_uri};
	

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
<body style="background-image:url('images/comics.jpg');">
<script language="Javascript">

window.onload = function() {
    timeout_init();
};

function timeout_trigger() {
    window.location="http://nuclear.citypackr.com";   
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
	<div class="well" style="height: 150px; margin-top: 20px;">
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
		<h3 class="span3">$<?php echo $subscription_info['subscription_price']; ?>/mo.</h3>
		<div class="clearfix"></div>
	</div>
	<div class="well">
		<h2>Step 2 - Enter Payment Information</h2>
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