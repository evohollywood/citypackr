<?php

session_start();

include ('includes/functions.inc');
require_once ('includes/mysql_connect.php');

$mid = 7;

$email = $_POST['email'];

$q1 = "SELECT user_id FROM users WHERE email='$email'";
$r1 = mysql_query($q1);
$row1 = mysql_fetch_assoc($r1);


if ($row1['user_id'] != '') {

	$user_id = $row1['user_id'];

	$q2 = 'SELECT * FROM memberships WHERE user_id=' . $user_id . ' AND membership_type_id=' . $_POST['m_id'] . ' AND active_flag=1';
	$r2 = mysql_query($q2);
	$row2 = mysql_fetch_assoc($r2);
	
	if ($row2['membership_type_id'] == NULL) {
	
		$url = 'sign_in.php';
		header("Location: $url");
		exit();	
	
	}

} else {

	$url = 'sign_in.php';
	header("Location: $url");
	exit();

} 


$q = 'SELECT * FROM perk_types WHERE membership_type_id=' . $_POST['m_id'];
$r = mysql_query($q);

while ($row = mysql_fetch_assoc($r)) {

	if ($row['perk_type_id'] != "") {
	
		$perks[] = $row['perk_type_id'];

	}

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>CityPackr - The Best of Your City on Your Doorstep</title>
	<link rel=StyleSheet href="bootstrap/css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){

});//]]>  
function changeURL( url ) {
    document.location = url;
}
</script>
</head>
<body style="background-image:url('images/cupcakes.jpg');">
<script language="Javascript">

window.onload = function() {
    timeout_init();
};

function timeout_trigger() {
    window.location="http://cakebaby.citypackr.com";   
}

function timeout_init() {
    setTimeout('timeout_trigger()', 40000);
}

</script>
<div class="container">
	<h1>Available Perks:</h1>
	<?php 
		foreach ($perks as $perk) {
			$q = 'SELECT * FROM perk_types WHERE perk_type_id=' . $perk;
			$r = mysql_query($q);
			$perk_info = mysql_fetch_assoc($r);
			
			
			$q3 = "SELECT * FROM perk_records WHERE perk_type_id='$perk' AND user_id='$user_id'";
			$r3 = mysql_query($q3);
			$row3 = mysql_fetch_assoc($r3);
			$last_redeemed = $row3['last_redeemed'];
			$created_date = $row2['created_date'];
			$today = date("Y") . '-' . date("m") . '-' . date("d");
			
			$redeemable = true;
			
			if ($last_redeemed == $today) {
			
				$redeemable = false;
			
			}
			
			$renewal_date = date("Y") . '-' . date("m") . '-' . substr($created_date, -2);
			
			if ($last_redeemed > $renewal_date) {
			
				$redeemable = false;
			
			}
			
			if ($last_redeemed == '0000-00-00') {
			
				$redeemable = true;
			
			}
			
			if ($perk_info['perennial_flag'] == 1) {
			
				$redeemable = true;
			
			} 
			
			echo '  <div class="well">
						<div class="row">
							<h2 class="span8">' . $perk_info['perk_description'] . '</h2>
							<div class="span3" style="margin-top: 10px;">';							
							if ($redeemable) {
								echo '<a href="redeem.php?perk_id=' . $perk_info['perk_type_id'] . '&email=' . $_POST['email'] . '&user_id=' . $user_id . '" class="btn btn-large btn-block btn-success">Redeem</a>';
							} else {
								echo '<button class="btn btn-large btn-block btn-danger disabled">Redeemed</button>';
							}
					echo '
							</div>
						</div>
					</div>';
		}
	?>
	<a class="btn btn-large btn-danger btn-block" href="#" onClick="timeout_trigger()">Cancel</a>
</div>
</body>
</html>
<?php

?>