<?php

if (isset($_POST['submitted'])) {
	
	require_once ('../includes/mysql_connect.php');
	
	$e = trim($_POST['email']);
	
	$q2 = "INSERT INTO invites (email, created_date) VALUES ('$e', NOW() )";
	$r2 = @mysql_query ($q2);
	
	if ($r2) {	        

		session_start();

		$_SESSION['blog_invited'] = 1;

		$url = 'index.php?invited=1';
		header("Location: $url");
		exit();

	} else {
	
		echo '<h2>Error!</h2>';
	
	}

	mysql_close();

} else {

	echo 'No e-mail was entered, <a href="javascript:history.back()">please try again.</a>';

}

/*

if (isset($_POST['submitted'])) {

	echo '<h2>Working Here</h2>';

	$errors = array();

	if (empty($_POST['email'])) {

		$errors[] = 'You forgot to enter an e-mail address.';

	} else {
	
		$e = trim($_POST['email']);

		require_once ('../includes/mysql_connect.php');

		$check_email = check_email ($e);

		if ($check_email) {

			$errors[] = 'There is already an account associated with that e-mail address!';
		}

	}

	if (empty($errors)) {
	
		echo '<h2>Working Here</h2>';

		require_once ('../includes/mysql_connect.php');

		$q2 = "INSERT INTO invites (email, created_date) VALUES ('$e', NOW() )";
		$r2 = @mysql_query ($q2);

		if ($r2) {	        

            session_start();

		    $_SESSION['invited'] = 1;

            $url = 'index.php';
            header("Location: $url");
            exit();
	
		}

		mysql_close();


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

*/
?>