<?php

session_start();

include ('includes/functions.inc');
require_once ('includes/mysql_connect.php');

if (isset($_SESSION['user_id'])) {

	if (isset($_GET['sub_id'])) {

		reactivate_subscription($_SESSION['user_id'], $_GET['sub_id']);
		
	}
	
	if (isset($_GET['mem_id'])) {

		reactivate_membership($_SESSION['user_id'], $_GET['mem_id']);
		
	}
	
	$url = 'account.php';
    header("Location: $url");
    exit();

} else {

	$url = 'index.php';
    header("Location: $url");
    exit();

}

?>