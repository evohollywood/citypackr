<?php

session_start();

require_once ('includes/mysql_connect.php');
include ('includes/login_functions.inc');
include ('includes/functions.inc');

$user_id = $_SESSION['user_id'];
$pack_id = $_POST['pack_id'];

if (check_membership($pack_id, $user_id)) {

	$q = "UPDATE memberships SET active_flag='0' WHERE user_id='$user_id' AND pack_id='$pack_id' LIMIT 1";

    $r = @mysql_query ($q);
	

} else {

	$q2 = 'SELECT * FROM memberships WHERE pack_id=' . $pack_id . ' AND user_id=' . $user_id;
	$r2 = mysql_query($q2);

	$row = mysql_fetch_assoc($r2);

	if ($row['user_id'] == $user_id && $row['active_flag'] == '0') {

		$q3 = "UPDATE memberships SET active_flag='1' WHERE user_id='$user_id' AND pack_id='$pack_id' LIMIT 1";

		$r3 = @mysql_query ($q3);
	
	} else {

		$q4 = "INSERT INTO memberships (pack_id, user_id, active_flag) VALUES ('$pack_id', '$user_id', '1')";
		
		$r4 = @mysql_query ($q4);
	
	}

}

$url = absolute_url('pack.php?pack_id=' . $pack_id);

header("Location: $url");

exit();


?>