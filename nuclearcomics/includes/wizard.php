<?php

session_start();

include ('functions.inc');
require_once ('mysql_connect.php');


$subscription_info = get_sub_type_info($_GET['subscription_id']);


?><!DOCTYPE html>
<html lang="en">
<head>
	<title>CityPackr - The Best of Your City on Your Doorstep</title>
	<link rel=StyleSheet href="../bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){

});//]]>  

</script>
</head>
		<div class="modal-body" style="width: 720px;">
			<div class="well" style="height: 100px;">
				<div class="span2">
					<ul class="thumbnails">
						<li class="span2">
							<div class="thumbnail">
								<img src="../images/<?php echo $subscription_info['sub_image']; ?>" />
							</div>
						</li>
					</ul>
				</div>
				<h3 class="span5"><?php echo $subscription_info['subscription_name']; ?></h3>
				<h3 class="span1">$<?php echo $subscription_info['subscription_price']; ?>/mo.</h3>
				<div class="clearfix"></div>
			</div>
			<h3>Enter Delivery Address</h3>
			<form class="form-inline" method="post" action="payment.php?subscription_id=<?php echo $_GET['subscription_id']; ?>" target="_self" onSubmit="" name="registerForm">
				<div class="row">
					<div class="control-group span9">
						<label class="control-label" for="inputAddress">My Shipping Address Is</label>
						<div class="controls">
							<input class="input-block-level" type="text" name="userAddress" id="inputAddress" placeholder="123 Awesome St." />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="control-group span5">
						<label class="control-label" for="inputApt">My Apt. # Is</label>
						<div class="controls">
							<input class="input-block-level" type="text" name="userApt" id="inputApt" placeholder="3b" />
						</div>
					</div>
					<div class="control-group span4">
						<label class="control-label" for="inputZip">My Zip Code Is</label>
						<div class="controls">
							<input class="input-block-level" type="text" name="userZip" id="inputZip" placeholder="90210" />
						</div>
					</div>
				</div>
				<input type="hidden" name="submitted" value="TRUE" />
		</div>
		<div class="modal-footer">
			<input class="btn btn-large btn-primary" style="width: 110px;" type="submit" name="submit" value="Next" />
			</form>
		</div>
</html>