<?php

session_start();

include ('includes/functions.inc');
require_once ('includes/mysql_connect.php');

$mid = 7;

$sub_id = $_GET['s_id'];

// WePay PHP SDK - http://git.io/mY7iQQ
    require 'includes/wepay.php';

    // application settings
    $account_id = 508790531;
    $client_id = 96607;
    $client_secret = "127a37d4f3";
    $access_token = "STAGE_ccae256c3cec257536a08602c5c0ba68f5f7e326f47e24adca782bf717b42b7f";
	$subscription_info = get_sub_type_info($sub_id);
	$charge = $subscription_info['subscription_price'] . '.00';
	$subscription_name = $subscription_info['subscription_name'];
	$redirect = 'http://cakebaby.citypackr.com/purchase.php?s_id=' . $sub_id;

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
<body style="background-image:url('images/cupcakes.jpg');">
<script language="Javascript">

window.onload = function() {
    timeout_init();
};

function timeout_trigger() {
    window.location="http://cakebaby.citypackr.com";   
}

function timeout_init() {
    setTimeout('timeout_trigger()', 40000);
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
		<iframe src="<?php echo $iframe_uri; ?>" frameborder="0" id="preapproval_div_id"></iframe>
	</div>
</div>
</body>
</html>
<?php

?>