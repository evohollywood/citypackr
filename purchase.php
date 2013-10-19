<?php

// Purchase Processing

session_start();

$user_id=$_SESSION['user_id'];

require_once ('includes/mysql_connect.php');
include ('includes/functions.inc');

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

		}	
	}

}

$url = 'account.php';
header("Location: $url");
exit();

?>