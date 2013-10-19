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
<style TYPE="text/css">
       <!--
			@font-face {
				font-family: cp_font;
				src: url('/fonts/Museo_Slab_500-webfont.ttf');
			}
        -->
</style>
</head>
<body style="background-image:url('images/clean_comic_background.jpg');">
<script language="Javascript">

window.onload = function() {
    timeout_init();
};

function timeout_trigger() {
    window.location="http://nuclear2.citypackr.com";   
}

function timeout_init() {
    setTimeout('timeout_trigger()', 40000);
}

</script>
<div class="container">
	<div class="well" style="margin-top: 60px; background-color: white;">
		<div class="span5">
			<img src="/images/comic_product_2.jpg" />
		</div>
		<div class="span6">
			<h2><?php echo $subscription_info['subscription_name']; ?></h2>
			<p><?php echo $subscription_info['sub_description']; ?></p>
			<ul>
				<li>Graphic novels delivered to your doorstep once a month.</li>
				<li>Already read that month's pick? Bring it back in and pick another of equal or lesser value.</li>
				<li>Special events and deals each month just for club members.</li>
			</ul>
			<h2 style="text-align: center;">$<?php echo $subscription_info['subscription_price']; ?>.00/month</h2>
			<a href="delivery.php?s_id=<?php echo $subscription_info['subscription_type_id']; ?>" border="0">
				<button style="font-size: 250%; font-family: cp_font; color: white; margin-top: 35px; border: 0; width: 100%; height: 75px; background: url(/images/button_sign_up.png) no-repeat center top;">
					SIGN UP
				</button>
			</a>
			<a href="gift.php?s_id=<?php echo $subscription_info['subscription_type_id']; ?>" border="0">
				<button style="font-size: 250%; font-family: cp_font; color: white; margin-top: 10px; border: 0; width: 100%; height: 75px; background: url(/images/button_gift.png) no-repeat center top;">
					GIVE AS GIFT
				</button>
			</a>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
</body>
</html>
<?php

?>