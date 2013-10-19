<?php

session_start();

include ('includes/functions.inc');
require_once ('includes/mysql_connect.php');

$mid = 7;

$mem_id = $_GET['m_id'];

$membership_info = get_membership_type_info($mem_id);

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
	<div class="well" style="margin-top: 20px;">
		<div class="span5">
			<img src="/images/cupcake_product.jpg" />
		</div>
		<div class="span6">
			<h2><?php echo $membership_info['membership_name']; ?></h2>
			<p><?php echo $membership_info['mem_description']; ?></p>
			<ul>
				<li>Cupcake feature number 1!</li>
				<li>Cupcake feature number 2!</li>				
			</ul>
			<h3 style="text-align: center;">$<?php echo $membership_info['membership_price']; ?>.00/month</h3>
			<a href="sign_up.php?m_id=<?php echo $membership_info['membership_type_id']; ?>" class="btn btn-primary btn-large btn-block">Sign Up</a>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
</body>
</html>
<?php

?>