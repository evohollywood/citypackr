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
	<div class="well" style="margin-top: 150px;">
		<h1>To Redeem Perks Enter Your Membership E-mail:</h1>
		<form method="post" action="perks.php">
			<input type="text" name="email" class="input-block-level" placeholder="E-mail Address" />
			<div class="row" style="margin-top:20px;">
				<div class="span3">
					<a class="btn btn-large btn-danger btn-block" href="#" onClick="timeout_trigger()">Cancel</a>
				</div>
				<div class="span3 pull-right">
					<input class="btn btn-large btn-primary btn-block" type="submit" name="submit" value="Continue >>" />
					<input type="hidden" name="m_id" value="<?php echo $_GET['m_id']; ?>" />
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