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
		<h3 class="span3">$<?php echo $subscription_info['subscription_price']; ?>/mo.</h3>
		<div class="clearfix"></div>
	</div>
	<div class="well">
		<h2>Step 1 - Enter Delivery Address</h2>
		<form class="form-inline" method="post" action="sign_up.php?s_id=<?php echo $_GET['s_id']; ?>" target="_self" onSubmit="" name="registerForm">
		<div class="row">
			<div class="control-group span11">
				<label class="control-label" for="inputAddress">My Shipping Address Is</label>
				<div class="controls">
					<input class="input-block-level" type="text" name="userAddress" id="inputAddress" placeholder="123 Awesome St." />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="control-group span6">
				<label class="control-label" for="inputApt">My Apt. # Is</label>
				<div class="controls">
					<input class="input-block-level" type="text" name="userApt" id="inputApt" placeholder="3b" />
				</div>
			</div>
			<div class="control-group span5">
				<label class="control-label" for="inputZip">My Zip Code Is</label>
				<div class="controls">
					<input class="input-block-level" type="text" name="userZip" id="inputZip" placeholder="90210" />
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<input type="hidden" name="submitted" value="TRUE" />
		<div class="row">
			<div class="span3">
				<a class="btn btn-large btn-danger btn-block" href="#" onClick="timeout_trigger()">Cancel</a>
			</div>
			<div class="span3 offset5">
				<input class="btn btn-large btn-primary btn-block" type="submit" name="submit" value="Next >>" />
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<?php

?>