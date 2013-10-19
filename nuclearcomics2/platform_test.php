<?php
    // WePay PHP SDK - http://git.io/mY7iQQ
    require 'includes/wepay.php';

    // application settings
    $client_id = 96607;
    $client_secret = "127a37d4f3";
    $access_token = "STAGE_8f8321a5334d2fc0295abb0a5d17f9502d27ba43bb7894648573e5eb7ba2e0f4";

    // change to useProduction for live environments
    Wepay::useStaging($client_id, $client_secret);

    $wepay = new WePay($access_token);

    // create an account for a user
    $response = $wepay->request('account/create/', array(
        'name'          => 'CakeBaby Bakery',
        'description'   => 'Memberships to the CakeBaby Loyal Customers Club.'
    ));
    
    // display the response
    print_r($response);
?>