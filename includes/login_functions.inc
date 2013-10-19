<?php 

// Login functions

function absolute_url ($page = 'index.php') {

	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

	$url = rtrim($url, '/\\');

	$url .= '/' . $page;

	return $url;

}

function check_login ($email = ' ', $pass = ' ') {

	$errors = array();

	if (empty($email)) {

		$errors[] = 'You forgot to enter your email address.';

	} else {

		$e = mysql_real_escape_string (trim($email));

	}

	if (empty($pass)) {

		$errors[] = 'You forgot to enter your password.';

	} else {

		$p = mysql_real_escape_string (trim($pass));

	}

	if (empty($errors)) {

		$q = "SELECT user_id, username FROM users WHERE email='" . $e . "' AND pass=SHA1('" . $p . "')";

		$r = mysql_query ($q);

		$row = mysql_fetch_assoc ($r);
	
		if (mysql_num_rows($r)) {

			return $row;

		} else {

			$errors[] = 'Password and username are not in the system.';

		}

	

	return $errors;


	}
	
}

function check_merchant_login ($email = ' ', $pass = ' ') {

	$errors = array();

	if (empty($email)) {

		$errors[] = 'You forgot to enter your email address.';

	} else {

		$e = mysql_real_escape_string (trim($email));

	}

	if (empty($pass)) {

		$errors[] = 'You forgot to enter your password.';

	} else {

		$p = mysql_real_escape_string (trim($pass));

	}

	if (empty($errors)) {

		$q = "SELECT merchant_id FROM merchants WHERE email='" . $e . "' AND pass=SHA1('" . $p . "')";

		$r = mysql_query ($q);

		$row = mysql_fetch_assoc ($r);
	
		if (mysql_num_rows($r)) {

			return $row;

		} else {

			$errors[] = 'Password and username are not in the system.';

		}

	

	return $errors;


	}
	
}


?>