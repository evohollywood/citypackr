<?php

session_start();

include ('includes/functions.inc');
require_once ('includes/mysql_connect.php');

$mid = 8;

$sub_id = $_GET['s_id'];

$subscription_info = get_sub_type_info($sub_id);

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
<body style="background-image:url('images/comics.jpg');">
<script language="Javascript">

window.onload = function() {
    timeout_init();
};

function timeout_trigger() {
    window.location="http://nuclear.citypackr.com";   
}

function timeout_init() {
    setTimeout('timeout_trigger()', 40000);
}

</script>
<div class="container">
	<div class="well" style="margin-top: 20px; text-align: center;">
		<h1>You've purchased a gift subscription!</h1>
		<p>You can either e-mail the gift code to the lucky recipient right now, or the cashier can provide you with a card with the code written in it.</p>
		<h2>Gift Code: <?php echo $_GET['gift_code']; ?></h2>
		<form method="post" action="gift_email.php">
			<input type="text" name="email" class="input-block-level" placeholder="Recipient E-mail Address" />
			<input class="btn btn-large btn-success btn-block" type="submit" name="submit" value="E-mail Gift Code" />
			<input type="hidden" name="gift_code" value="<?php echo $_GET['gift_code']; ?>" />
		</form>
	<div>
</div>
</body>
</html>
<?php

?>