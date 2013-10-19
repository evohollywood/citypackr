<?php

// Purchase Processing

require_once ('includes/mysql_connect.php');
include ('includes/functions.inc');

require 'includes/wepay.php';

$mid = 7;

$merchant_info = get_merchant_info($mid);

$account_id = $merchant_info['wepay_id'];
$client_id = 96607;
$client_secret = "127a37d4f3";
$access_token = $merchant_info['merchant_auth'];

$preapproval_id = $_GET['preapproval_id'];

// change to useProduction for live environments
Wepay::useStaging($client_id, $client_secret);

$wepay = new WePay($access_token);

// create the checkout
$response = $wepay->request('preapproval', array(
	'preapproval_id'        => $preapproval_id
));

$un = $response->payer_name;
$e = $response->payer_email;
$p = 'password';
$a_id = $_GET['a_id'];

if (check_email($e)) {

} else {

	$q2 = "INSERT INTO users (username, email, pass, jointime) VALUES ('$un', '$e', SHA1('$p'), NOW() )";
	$r2 = @mysql_query ($q2);
	
}

$q3 = "SELECT * FROM users WHERE email='$e' LIMIT 1";
$r3 = @mysql_query ($q3);

$user_info = mysql_fetch_assoc($r3);

$user_id = $user_info['user_id'];

$q4 = "UPDATE shipping_addresses SET user_id='$user_id' WHERE address_id='$a_id'";
$r4 = @mysql_query ($q4);

// Sub purchase

if (isset($_GET['s_id'])) {

//Check for newly activated subscriptions

	if (isset($_GET['preapproval_id'])) {

		// first make sure the id is unique

		if (uniquePreapproval($_GET['preapproval_id']) == 0) {
		
			$sub_id = $_GET['s_id'];
			$payment_id = $_GET['preapproval_id'];
			$frequency = 1;
			$createSub = createSub($user_id, $sub_id, $payment_id, $frequency, $_GET['a_id']);
			
				if (isset($_SESSION['refer_id'])) {
					
					$refer_id = $_SESSION['refer_id'];
				
					$q3 = "INSERT INTO referrals (user_id, referrer_id, creation_date) VALUES ('$user_id', '$refer_id', NOW() )";
					$r3 = @mysql_query ($q3);

					$q4 = "INSERT INTO rewards (reward_type_id, user_id, reward_entity_id, reward_amount, created_date) VALUES (1, '$refer_id', '$user_id', 5, NOW() )";
					$r4 = @mysql_query ($q4);					
				
				}

			// Send Thank You E-mail
			
			$args = array(
				'key' => 'HaVrKwsIhLsI8vsnlhn0QA',
				'template_name' => 'nuclear-comics',
				'template_content' => array(array("name" => "example name", "content" => "example content")),
				'message' => array(
					"text" => null,
					"from_email" => "evo@citypackr.com",
					"from_name" => "Nuclear Comics",
					"subject" => "Confirmation - TPB of the Month Club",
					"to" => array(array("email" => $e)),
					"track_opens" => true,
					"track_clicks" => true,
					"auto_text" => true
				)   
			);
			// Open a curl session for making the call

			$curl = curl_init('https://mandrillapp.com/api/1.0/messages/send.json' );
			// Tell curl to use HTTP POST
			curl_setopt($curl, CURLOPT_POST, true);

			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			// Tell curl not to return headers, but do return the response
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

			curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
			// Set the POST arguments to pass on
			curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($args));

			// Make the REST call, returning the result
			$response = curl_exec($curl);
				
		}	
	}

}

// Membership purchase

if (isset($_GET['m_id'])) {

//Check for newly activated memberships

	if (isset($_GET['preapproval_id'])) {

		// first make sure the id is unique

		if (uniquePreapproval($_GET['preapproval_id']) == 0) {
		
			$mem_id = $_GET['m_id'];
			$payment_id = $_GET['preapproval_id'];
			$frequency = 1;
			$createMembership = createMembership($user_id, $mem_id, $payment_id, $frequency);
			
				if (isset($_SESSION['refer_id'])) {
					
					$refer_id = $_SESSION['refer_id'];
				
					$q3 = "INSERT INTO referrals (user_id, referrer_id, creation_date) VALUES ('$user_id', '$refer_id', NOW() )";
					$r3 = @mysql_query ($q3);

					$q4 = "INSERT INTO rewards (reward_type_id, user_id, reward_entity_id, reward_amount, created_date) VALUES (1, '$refer_id', '$user_id', 5, NOW() )";
					$r4 = @mysql_query ($q4);					
				
				}
				
			// Send Thank You E-mail
			
			$args = array(
				'key' => 'HaVrKwsIhLsI8vsnlhn0QA',
				'template_name' => 'cakebaby',
				'template_content' => array(array("name" => "example name", "content" => "example content")),
				'message' => array(
					"text" => null,
					"from_email" => "evo@citypackr.com",
					"from_name" => "CakeBaby Bakery",
					"subject" => "Confirmation - CakeBaby Customer Perks Membership",
					"to" => array(array("email" => $e)),
					"track_opens" => true,
					"track_clicks" => true,
					"auto_text" => true
				)   
			);
			// Open a curl session for making the call

			$curl = curl_init('https://mandrillapp.com/api/1.0/messages/send-template.json' );
			// Tell curl to use HTTP POST
			curl_setopt($curl, CURLOPT_POST, true);

			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			// Tell curl not to return headers, but do return the response
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

			curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
			// Set the POST arguments to pass on
			curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($args));

			// Make the REST call, returning the result
			$response = curl_exec($curl);

		}	
	}

}

$url = 'thanks.php';
header("Location: $url");
exit();

?>