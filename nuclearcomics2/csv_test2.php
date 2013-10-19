<?php  
include ('includes/functions.inc');
require_once ('includes/mysql_connect.php');


$recipients = get_shipment_recipients(9);

foreach ($recipients as $recipient) {
	
	$address_id = find_address($recipient, 9);
	$recipient_info = get_recipient_info (59);
    fputcsv($outstream, $recipient_info, ',', '"');  
	
	echo 'Recipient: ' . $recipient;
	echo 'Address Id: ' . $address_id;
	print_r($recipient_info);
	
} 


?> 