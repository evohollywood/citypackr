<?php

session_start();

include ('includes/functions.inc');
require_once ('includes/mysql_connect.php');

$mid = 7;

$q = 'SELECT * FROM perk_types WHERE perk_type_id=' . $_GET['perk_id'];
$r = mysql_query($q);
$perk_info = mysql_fetch_assoc($r);

$user_id = $_GET['user_id'];

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
    setTimeout('timeout_trigger()', 100000);
}

</script>
<div class="container">
	<h1>Almost Done!</h1>
	<div class="well">
	<?php 
		echo '<h2>Perk: ' . $perk_info['perk_description'] . '</h2>';
	?>
	</div>
	<div class="well">
		<h2>Show this screen to the cashier to redeem your perk.</h2>
		<form method="post" action="accept.php">
			<input type="password" name="code" class="input-block-level" placeholder="Merchant Confirmation Code" />
			<div class="row" style="margin-top:20px;">
				<div class="span3">
					<a class="btn btn-large btn-danger btn-block" href="#" onClick="timeout_trigger()">Cancel</a>
				</div>
				<div class="span3 pull-right">
					<input class="btn btn-large btn-primary btn-block" type="submit" name="submit" value="Accept Perk" />
					<input type="hidden" name="perk_id" value="<?php echo $_GET['perk_id']; ?>" />
					<input type="hidden" name="email" value="<?php echo $_GET['email']; ?>" />
					<input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
					</form>
				</div>
				<div class="clearfix"></div>
			</div>
		</form>
	</div>
</div>
</body>
</html>
<?php

?>