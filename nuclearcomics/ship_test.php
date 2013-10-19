<?php

include ('includes/functions.inc');
require_once ('includes/mysql_connect.php');

$date = date("m")+1;

if ($date < 10) {

$date = '0' . $date;

}

echo $date;

?>