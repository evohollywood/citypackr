<?php

session_start();

include ('includes/functions.inc');
require_once ('includes/mysql_connect.php');

$mid = 7;

$merchant_info = get_merchant_info($mid);

$mem_id = $_GET['m_id'];

$membership_info = get_membership_type_info($mem_id);

// WePay PHP SDK - http://git.io/mY7iQQ
    require 'includes/wepay.php';

    // application settings
    $account_id = $merchant_info['wepay_id'];
    $client_id = 96607;
    $client_secret = "127a37d4f3";
    $access_token = $merchant_info['merchant_auth'];
	$charge = $membership_info['membership_price'] . '.00';
	$commission = $charge/10;
	$membership_name = $membership_info['membership_name'];
	$redirect = 'http://cakebaby.citypackr.com/purchase.php?m_id=' . $mem_id;

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
        'short_description' => $membership_name,
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
<body style="background-image:url('images/cupcakes.jpg');">
<script language="Javascript">

window.onload = function() {
    timeout_init();
};

function timeout_trigger() {
    window.location="http://cakebaby.citypackr.com";   
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
	<div class="well" style="height: 125px; margin-top: 20px;">
		<div class="span2">
			<ul class="thumbnails">
				<li class="span2">
					<div class="thumbnail">
						<img src="../images/<?php echo $membership_info['mem_image']; ?>" />
					</div>
				</li>
			</ul>
		</div>
		<h3 class="span6"><?php echo $membership_info['membership_name']; ?></h3>
		<h3 class="span3">$<?php echo $membership_info['membership_price']; ?>/mo.</h3>
		<div class="clearfix"></div>
	</div>
	<div class="well">
		<h2>Enter Payment Information</h2>
		<div class="span3">
			<h3>About WePay:</h3>
			<ul>
				<li>WePay is a secure billing service which will charge the membership fee once a month.</li>
				<li>You will receive a confirmation e-mail from WePay and from CityPackr after you have finished signing up.</li>
				<li>You may pause or cancel your membership at any time.</li>
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