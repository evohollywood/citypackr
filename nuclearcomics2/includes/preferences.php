<?php

session_start();

$user_id = $_SESSION['user_id'];

include ('../includes/functions.inc');

if (isset($_POST['submitted'])) {

	$errors = array();
	$passions = array();
	
	// check to make sure atleast one passion was selected
	
	if (empty($_POST['Food']) && empty($_POST['Fashion']) && empty($_POST['Entertainment']) && empty($_POST['Technology'])) {
	
		$errors[] = 'Please select at least one passion (maybe just pick something you dont hate?).';
	
	}
	
	// ingest passions
	
	if (isset($_POST['Food'])) {
	
		$passions[] = $_POST['Food'];
	
	}
	
	if (isset($_POST['Fashion'])) {
	
		$passions[] = $_POST['Fashion'];
	
	}
	
	if (isset($_POST['Entertainment'])) {
	
		$passions[] = $_POST['Entertainment'];
	
	}
	
	if (isset($_POST['Technology'])) {
	
		$passions[] = $_POST['Technology'];
	
	}
	
	if (empty($_POST['userAddress'])) {

		$errors[] = 'You forgot to enter a shipping address.';

	} else {
	
		$ua = trim($_POST['userAddress']);

	}

	if (isset($_POST['userApt'])) {
	
		$uapt = trim($_POST['userApt']);

	}

	if (!empty($_POST['userZip'])) {
			
		$z = trim($_POST['userZip']);
			
	} else {

		$errors[] = 'You forgot to enter your zip code.';
	
	}

	if (empty($errors)) {

		require_once ('../includes/mysql_connect.php');
		
		foreach ($passions as $passion) {

			$q2 = "INSERT INTO passions (user_id, passion_type_id) VALUES ('$user_id', '$passion')";
			$r2 = @mysql_query ($q2);
		
		}
		
			$q3 = "INSERT INTO shipping_addresses (user_id, address, apt, zip) VALUES ('$user_id', '$ua', '$uapt', '$z')";
			$r3 = @mysql_query ($q3);
			
			// Circumventing wepay panel for now.
			
			/*
			$url = '../includes/wepay.php';
            header("Location: $url");
            exit();
			*/
			
			echo '<script>
					parent.changeURL(\'../account.php\' );
				  </script>';
	
	} else {

		echo '<h1>Error!</h1>';

		foreach ($errors as $msg) {

			echo " - $msg<br />\n";
	
		}
		echo '</p>Please try again.</p><p><br /></p>';
	
	}

} else {

	echo '<h3>Did not submit!</h3>';

}
?>