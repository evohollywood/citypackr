<?php  
include ('includes/functions.inc');
require_once ('includes/mysql_connect.php');
header("Content-type: text/csv");  
header("Cache-Control: no-store, no-cache");  
header('Content-Disposition: attachment; filename="shipment_manifest.csv"');  
  
$outstream = fopen("php://output",'w');  

$header = array ( 'Name', 'Address', 'Address 2', 'Zip Code', 'Email' ); 

fputcsv($outstream, $header, ',', '"');

$recipients = get_shipment_recipients($_GET['s_id']);

foreach ($recipients as $recipient) {

	$address_id = find_address($recipient, $_GET['s_id']);
	$recipient_info = get_recipient_info ($address_id);
    fputcsv($outstream, $recipient_info, ',', '"');  
	
} 
  
fclose($outstream);

?> 

