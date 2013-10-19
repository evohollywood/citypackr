<?php

session_start();

include ('includes/functions.inc');
require_once ('includes/mysql_connect.php');



$mid = 7;

$perk = $_POST['perk_id'];
$user_id = $_POST['user_id'];

if ($_POST['code'] != 'bakingbabies') {

	$url = 'redeem.php?perk_id=' . $perk . '&user_id=' . $user_id;
	header("Location: $url");
	exit();
	
}

$q = "UPDATE perk_records SET last_redeemed=NOW() WHERE perk_id='$perk' AND user_id='$user_id'";
$r = mysql_query($q);

$q2 = 'SELECT * FROM perk_types WHERE perk_type_id=' . $perk;
$r2 = mysql_query($q2);
$perk_info = mysql_fetch_assoc($r2);

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
	<h1>Congratulations!</h1>
	<div class="well">
		<h2>You redeemed: <?php echo $perk_info['perk_description']; ?></h2>
	</div>
</div>
</body>
</html>
<?php

?>