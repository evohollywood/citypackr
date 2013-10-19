<?php
?>
<!DOCTYPE html>
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
			<form class="form-inline" method="post" action="register.php" target="_self" onSubmit="" name="registerForm">
				<div class="control-group">
					<label class="control-label" for="inputName">My Name Is</label>
					<div class="controls">
						<input class="input-block-level" type="text" name="userName" id="inputName" placeholder="My Name" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputEmail">My E-mail Is</label>
					<div class="controls">
						<input class="input-block-level" type="text" name="email" id="inputEmail" placeholder="Email" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputPassword">I Would Like My Password To Be</label>
					<div class="controls">
						<input class="input-block-level" type="password" name="pass" id="inputPassword" placeholder="Password" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputGender">I Am A</label><br />
					<label class="radio inline">
						<input type="radio" name="optionsRadios" id="Man" value="Man">
							Man
					</label>
					<label class="radio inline">
						<input type="radio" name="optionsRadios" id="Woman" value="Woman">
							Woman
					</label>
				</div>
				<input type="hidden" name="submitted" value="TRUE" />
		</div>
		<div class="modal-footer">
			<input class="btn btn-large btn-primary" style="width: 110px;" type="submit" name="submit" value="Next" />
			</form>
		</div>
</html>