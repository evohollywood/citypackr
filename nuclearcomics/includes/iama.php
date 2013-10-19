<?php

session_start();

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
		<div class="modal-body" style="width: 500px;">
			<form class="form-inline" method="post" action="preferences.php" target="_self" onSubmit="" name="registerForm">
				<div class="control-group">
					<label class="control-label" for="inputPassions">I Am Passionate About:</label><br />
					<label class="checkbox inline">
						<input type="checkbox" name="Food" id="Food" value="0">
							Food
					</label>
					<label class="checkbox inline">
						<input type="checkbox" name="Fashion" id="Fashion" value="1">
							Fashion
					</label>
					<label class="checkbox inline">
						<input type="checkbox" name="Entertainment" id="Entertainment" value="2">
							Entertainment
					</label>
					<label class="checkbox inline">
						<input type="checkbox" name="Technology" id="Technology" value="3">
							Technology
					</label>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputAddress">My Shipping Address Is</label>
					<div class="controls">
						<input class="input-block-level" type="text" name="userAddress" id="inputAddress" placeholder="123 Awesome St." />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputApt">My Apt. # Is</label>
					<div class="controls">
						<input class="input-block-level" type="text" name="userApt" id="inputApt" placeholder="3b" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputZip">My Zip Code Is</label>
					<div class="controls">
						<input class="input-block-level" type="text" name="userZip" id="inputZip" placeholder="90210" />
					</div>
				</div>
				<input type="hidden" name="submitted" value="TRUE" />
		</div>
		<div class="modal-footer">
			<input class="btn btn-large btn-primary" style="width: 110px;" type="submit" name="submit" value="Next" />
			</form>
		</div>
</html>