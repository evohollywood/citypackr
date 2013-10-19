<?php

session_start();

	$_SESSION = array();

	session_destroy();
	
	$url = 'index.php';

	header("Location: $url");

	exit();

?>