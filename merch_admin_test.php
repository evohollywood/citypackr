<?php

include ('includes/functions.inc');
require_once ('includes/mysql_connect.php');
include ('wepay/wepay.php');

$merchant_id = 8;

$subscriptions = get_merchant_subscription_types($merchant_id);

$past_shipments = get_past_shipments($merchant_id);

$merchant_info = get_merchant_info($merchant_id);

$account_id = $merchant_info['wepay_id'];
$client_id = 96607;
$client_secret = "127a37d4f3";
$access_token = $merchant_info['merchant_auth'];

// change to useProduction for live environments
Wepay::useStaging($client_id, $client_secret);

$wepay = new WePay($access_token);

// create the checkout
$response = $wepay->request('account/balance', array(
	'account_id'        => $account_id
));

$balance = $response->pending_balance;

$withdrawl = $wepay->request('withdrawal/create', array(
        'account_id'    => $account_id,
        'redirect_uri'  => 'http://www.citypackr.com/merchant_admin.php'
    ));
	
$withdrawl_url = $withdrawl->withdrawal_uri;

print_r($withdrawl);


?>