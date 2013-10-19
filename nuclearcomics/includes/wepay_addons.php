<?php

	include ('../includes/functions.inc');
	require_once ('../includes/mysql_connect.php');

    // WePay PHP SDK - http://git.io/mY7iQQ
    require '../wepay/wepay.php';

    // application settings
    $account_id = 508790531;
    $client_id = 96607;
    $client_secret = "127a37d4f3";
    $access_token = "STAGE_ccae256c3cec257536a08602c5c0ba68f5f7e326f47e24adca782bf717b42b7f";

    // change to useProduction for live environments
    Wepay::useStaging($client_id, $client_secret);

    $wepay = new WePay($access_token);
	
	// add on info
	
	$add_on_id = $_GET['add_on_id'];
	$add_on_info = get_add_on_info($add_on_id);
	
	$year = date("Y") + 1;
	$month = date("m");
	$day = date("d");

	$date = $year . '-' . $month . '-' . $day;
	$amount = number_format($add_on_info['add_on_price'], 2);
	$short_desc = $add_on_info['add_on_short_desc'];
	$redirect = 'http://myopia.me/citypackr/account.php?add_on=' . $add_on_id;
	
	/*
	$date = '2013-12-25';
	$amount = '10.00';
	$short_desc = 'An Add-on';
	
	*/

    // create the pre-approval
    $response = $wepay->request('preapproval/create', array(
        'account_id'        => $account_id,
        'period'            => 'monthly',
        'end_time'          => $date,
        'amount'            => $amount,
		'fee_payer'         => 'payee',
        'mode'              => 'iframe',
        'short_description' => $short_desc,
        'redirect_uri'      => $redirect,
        'auto_recur'        => 'true'
    ));
    
    // display the approval embed
	$iframe_uri = $response->{preapproval_uri};
	
?><!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<script type="text/javascript" src="https://www.wepay.com/js/iframe.wepay.js">
</script>

<script type="text/javascript">
    WePay.iframe_checkout("preapproval_div_id", "<?php echo $iframe_uri; ?>");
</script>

<iframe src="<?php echo $iframe_uri; ?>" width="600px" height="350px" frameborder="0" id="preapproval_div_id" style="margin-left: -7px;"></iframe>
</body>
</html>