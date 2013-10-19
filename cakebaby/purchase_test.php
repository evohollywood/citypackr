<?php
    // WePay PHP SDK - http://git.io/mY7iQQ
    require 'includes/wepay.php';
	
    $account_id = 508790531;
    $client_id = 96607;
    $client_secret = "127a37d4f3";
    $access_token = "STAGE_ccae256c3cec257536a08602c5c0ba68f5f7e326f47e24adca782bf717b42b7f";
	
	$preapproval_id = $_GET['preapproval_id'];
	
    // change to useProduction for live environments
    Wepay::useStaging($client_id, $client_secret);

    $wepay = new WePay($access_token);

    // create the checkout
    $response = $wepay->request('preapproval', array(
        'preapproval_id'        => $preapproval_id
    ));

	echo '<h2>Name - ' . $response->payer_name . '</h2>';
	
	
    // display the response
    print_r($response);
	

?>