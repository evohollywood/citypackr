<?php

include ('../includes/functions.inc');

if (isset($_POST['submitted'])) {

	$errors = array();
	
	if (empty($_POST['userName'])) {

		$errors[] = 'You forgot to enter a user name.';

	} else {
	
		$un = trim($_POST['userName']);

	}

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

	if (!empty($_POST['pass'])) {
			
		$p = trim($_POST['pass']);
			
	} else {

		$errors[] = 'You forgot to enter your password.';
	
	}

	if (empty($errors)) {

		require_once ('../includes/mysql_connect.php');

		$q2 = "INSERT INTO users (username, email, pass, jointime) VALUES ('$un', '$e', SHA1('$p'), NOW() )";
		$r2 = @mysql_query ($q2);

		if ($r2) {

            require_once ('../includes/login_functions.inc');

            $data = check_login ($_POST['email'], $_POST['pass']);		        

            session_start();

		    $_SESSION['user_id'] = $data['user_id'];

		    $_SESSION['username'] = $data['username'];

            $url = '../includes/iama.php';
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
?>