<?php

	session_start();
	
	$user_id = $_SESSION['user_id'];

 // WePay PHP SDK - http://git.io/mY7iQQ
    require '../wepay/wepay.php';
	include ('functions.inc');
	require_once ('mysql_connect.php');

    // application settings
    $account_id = 508790531;
    $client_id = 96607;
    $client_secret = "127a37d4f3";
    $access_token = "STAGE_ccae256c3cec257536a08602c5c0ba68f5f7e326f47e24adca782bf717b42b7f";
	$membership_info = get_membership_type_info($_GET['membership_id']);
	$charge = $membership_info['membership_price'] . '.00';
	$membership_name = $membership_info['membership_name'];
	$redirect = 'http://www.citypackr.com/purchase.php?m_id=' . $membership_info['membership_type_id'];

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
        'short_description' => $membership_name,
        'redirect_uri'      => $redirect,
        'auto_recur'        => 'true'
    ));
    
    // display the approval embed
	$iframe_uri = $response->{preapproval_uri};
	
?><!DOCTYPE html>
<html lang="en">
<head>
	<link rel=StyleSheet href="../bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div class="modal-body" style="width: 720px;">
	<div class="well" style="height: 100px;">
		<div class="span2">
			<ul class="thumbnails">
				<li class="span2">
					<div class="thumbnail">
						<img src="../images/<?php echo $membership_info['mem_image']; ?>" />
					</div>
				</li>
			</ul>
		</div>
		<h3 class="span5"><?php echo $membership_info['membership_name']; ?></h3>
		<h3 class="span1">$<?php echo $membership_info['membership_price']; ?>/mo.</h3>
		<div class="clearfix"></div>
	</div>
</div>
<script type="text/javascript" src="https://www.wepay.com/js/iframe.wepay.js">
</script>

<script type="text/javascript">
    WePay.iframe_checkout("preapproval_div_id", "<?php echo $iframe_uri; ?>");
</script>

<iframe src="<?php echo $iframe_uri; ?>" width="750px" height="290px" frameborder="0" id="preapproval_div_id" style="margin-top: -25px;"></iframe>
</body>
</html>