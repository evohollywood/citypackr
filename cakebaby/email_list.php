<?php  
include ('includes/functions.inc');
require_once ('includes/mysql_connect.php');
header("Content-type: text/csv");  
header("Cache-Control: no-store, no-cache");  
header('Content-Disposition: attachment; filename="membership_list.csv"');  
  
$outstream = fopen("php://output",'w');  

$header = array ( 'Name', 'Email' ); 

fputcsv($outstream, $header, ',', '"');

$members = get_members($_GET['mem_id']);

foreach ($members as $member) {

	$member_info = get_member_info ($member);
    fputcsv($outstream, $member_info, ',', '"');  
	
} 
  
fclose($outstream);

?> 

