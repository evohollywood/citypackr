<?php

session_start();

include ('includes/functions.inc');
require_once ('includes/mysql_connect.php');

$mid = 8;

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
<div class="container">
	<h1 style="margin-top: 50px; margin-bottom: 50px; font-size: 800%; text-align: center; color: white; text-shadow: black 0.1em 0.1em 0.2em;">Nuclear Comic's</h1>
	<h1 style="margin-top: 75px; margin-bottom: 75px; font-size: 800%; text-align: center; color: white; text-shadow: black 0.1em 0.1em 0.2em;">Graphic Novel Of</h1>
	<h1 style="margin-top: 75px; margin-bottom: 75px; font-size: 800%; text-align: center; color: white; text-shadow: black 0.1em 0.1em 0.2em;">The Month Club</h1>
	<div class="well" style="margin-top: 100px;">
		<a href="more_info.php?s_id=4" class="btn btn-large btn-primary btn-block" style="height:100px; font-size: 400%;">More Info >></a>
	</div>
</div>
</body>
</html>
<?php

?>