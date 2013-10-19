<?php

session_start();

include ('includes/functions.inc');
require_once ('includes/mysql_connect.php');

if (isset($_GET['s_id'])) {

	$subscription_id = $_GET['s_id'];
	$merchant_id = $_GET['m_id'];
	$recipient_count = get_current_recipient_count($subscription_id);

	$recipients = get_current_recipients($subscription_id);
	
	
	$q2 = "INSERT INTO shipments (shipment_date, merchant_id, subscription_type_id, recipients) VALUES ( NOW(), '$merchant_id', '$subscription_id', '$recipient_count')";
	$r2 = mysql_query($q2);
		
	if ($r2) {
	

	
		$q3 = "SELECT shipment_id FROM shipments WHERE subscription_type_id='$subscription_id' ORDER BY shipment_date DESC LIMIT 1";
		$r3 = mysql_query($q3);
		$row3 = mysql_fetch_assoc($r3);
		
		
		$shipment_id = $row3['shipment_id'];
	
		foreach ($recipients as $recipient) {
		
			$q = "INSERT INTO shipment_records (shipment_id, user_id) VALUES('$shipment_id', '$recipient')";
			$r = mysql_query ($q);
			
		
		}
		
		$url = 'admin.php?success_id=' . $shipment_id;
		header("Location: $url");
		exit();

	
	} else {
	
		echo 'Failed insert';
	
	}
	
	
}


$url = 'admin.php';
header("Location: $url");
exit();


?>