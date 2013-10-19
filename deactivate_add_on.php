<?php

session_start();

include ('includes/functions.inc');
require_once ('includes/mysql_connect.php');

if (isset($_SESSION['user_id']) && isset($_GET['add_on_id'])) {

	deactivate_add_on($_SESSION['user_id'], $_GET['add_on_id']);
	
	$url = 'account.php';
    header("Location: $url");
    exit();

} else {

	$url = 'index.php';
    header("Location: $url");
    exit();

}

?>