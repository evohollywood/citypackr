<?php

// Check to see if merchant login has been submitted.


if (isset($_POST['merchant'])) {

	require_once ('includes/mysql_connect.php');

	include ('includes/login_functions.inc');
	
	//Check login.

	$data = check_merchant_login ($_POST['email'], $_POST['pass']);	

	if (($data[0] == 'Password and username are not in the system.') OR ($data[0] == 'You forgot to enter your email address.') OR ($data[0] == 'You forgot to enter your password.')) {
	
		// Check for errors and assign as data.		

		echo $data[0];

	} else {
		
		session_start();

		$_SESSION['merchant_id'] = $data['merchant_id'];
	
		// If no referring page send to the main debate page.

		$url = absolute_url('merchant_admin.php');

		header("Location: $url");

		exit();

	}

	mysql_close();


} 



// Check to see if user login has been submitted.


if (isset($_POST['submitted'])) {

	require_once ('includes/mysql_connect.php');

	include ('includes/login_functions.inc');



	//Check login.

	$data = check_login ($_POST['email'], $_POST['pass']);	

	if (($data[0] == 'Password and username are not in the system.') OR ($data[0] == 'You forgot to enter your email address.') OR ($data[0] == 'You forgot to enter your password.')) {
	
		// Check for errors and assign as data.		

		echo $data[0];

	} else {
		
		session_start();

		$_SESSION['user_id'] = $data['user_id'];

		$_SESSION['username'] = $data['username'];
	
		// If no referring page send to the main debate page.

		$url = absolute_url('index.php');

		header("Location: $url");

		exit();

	}

	mysql_close();
	

} else {

		$url = absolute_url('index.php');

		header("Location: $url");

		exit();

}

	
?>