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
	<div class="well" style="height: 150px; margin-top: 20px;">
		<div class="span2">
			<ul class="thumbnails">
				<li class="span2">
					<div class="thumbnail">
						<img src="../images/<?php echo $subscription_info['sub_image']; ?>" />
					</div>
				</li>
			</ul>
		</div>
		<h3 class="span6"><?php echo $subscription_info['subscription_name']; ?></h3>
		<h3 class="span3">Give as Gift</h3>
		<div class="clearfix"></div>
	</div>
	<div class="well">
		<div class="row">
			<h2 class="span8">3 Months/$30</h2>
			<div class="span3" style="margin-top: 10px;">
				<a border="0" href="gift_purchase.php?s_id=<?php echo $subscription_info['subscription_type_id']; ?>&term=3" >
					<div style="padding-top: 15px; text-align: center; font-size: 150%; font-family: cp_font; color: white; border: 0; width: 100%; height: 47px; background: url(/images/button_next.png) no-repeat center top;">
						PURCHASE
					</div>
				</a>			
			</div>
		</div>
	</div>
	<div class="well">
		<div class="row">
			<h2 class="span8">6 Months/$60</h2>
			<div class="span3" style="margin-top: 10px;">	
				<a border="0" href="gift_purchase.php?s_id=<?php echo $subscription_info['subscription_type_id']; ?>&term=6" >
					<div style="padding-top: 15px; text-align: center; font-size: 150%; font-family: cp_font; color: white; border: 0; width: 100%; height: 47px; background: url(/images/button_next.png) no-repeat center top;">
						PURCHASE
					</div>
				</a>			
			</div>
		</div>
	</div>
	<div class="well">
		<div class="row">
			<h2 class="span8">12 Months/$100</h2>
			<div class="span3" style="margin-top: 10px;">						
				<a border="0" href="gift_purchase.php?s_id=<?php echo $subscription_info['subscription_type_id']; ?>&term=12" >
					<div style="padding-top: 15px; text-align: center; font-size: 150%; font-family: cp_font; color: white; border: 0; width: 100%; height: 47px; background: url(/images/button_next.png) no-repeat center top;">
						PURCHASE
					</div>
				</a>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<?php

?>