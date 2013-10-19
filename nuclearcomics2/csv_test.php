<?php  
include ('includes/functions.inc');
require_once ('includes/mysql_connect.php');
header("Content-type: text/csv");  
header("Cache-Control: no-store, no-cache");  
header('Content-Disposition: attachment; filename="shipment_manifest.csv"');  
  
$outstream = fopen("php://output",'w');  

$header = array ( 'Name', 'Address', 'Email' ); 

fputcsv($outstream, $header, ',', '"');

$recipients = get_shipment_recipients($_GET['s_id']);

foreach ($recipients as $recipient) {

	$address_id = find_address($recipient, $_GET['s_id']);
	$recipient_info = get_recipient_info ($address_id);
    fputcsv($outstream, $recipient_info, ',', '"');  
	
} 

/* 
$test_data = array(  
    array( 'Cell 1,A', 'Cell 1,B' ),  
    array( 'Cell 2,A', 'Cell 2,B' )  
);  
  
foreach( $test_data as $row )  
{  
    fputcsv($outstream, $row, ',', '"');  
}

*/  
  
fclose($outstream);

?> 

