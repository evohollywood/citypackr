<?php

session_start();

if (!isset($_SESSION['user_id'])) {

	require_once ('includes/login_functions.inc');

	$url = 'admin.php';

	header("Location: $url");

	exit();

} else {

	$_SESSION = array();

	session_destroy();
	
	$url = 'admin.php';

	header("Location: $url");

	exit();

}

?>