<?php

session_start();

include ('includes/functions.inc');
require_once ('includes/mysql_connect.php');

$mid = 7;

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
<div class="container">
	<h1 style="text-align: center; color: white; text-shadow: black 0.1em 0.1em 0.2em;">CakeBaby's Cupcake of the Month Club</h1>
	<div class="well" style="margin-top: 350px;">
		<div class="row">
			<div class="span5">
				<a href="more_info.php?m_id=2" class="btn btn-large btn-primary btn-block" style="height:100px; font-size: 400%;">Learn More</a>
			</div>
			<div class="span5 pull-right">
				<a href="sign_in.php?m_id=2" class="btn btn-large btn-success btn-block" style="height:100px; font-size: 400%;">Redeem Perks</a>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<?php

?>