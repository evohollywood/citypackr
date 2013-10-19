<?php

session_start();

include ('includes/functions.inc');

// user state checks

$isLoggedIn = false;
$checkSub = 0;
$isSubbed = 0;

if (isset($_SESSION['user_id'])) {

	$isLoggedIn = true;
	$user_id = $_SESSION['user_id'];

} 

if (isset($_SESSION['merchant_id'])) {

	$merchLoggedIn = true;
	$merchant_id = $_SESSION['merchant_id'];

}

if (isset($_GET['ref_id'])) {

	$_SESSION['refer_id'] = $_GET['ref_id'];

}


?><!DOCTYPE html>
<html lang="en">
<head>
	<title>CityPackr - The Best of Your City on Your Doorstep</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap -->
    <link href="http://www.citypackr.com/measure_theme/measure/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://www.citypackr.com/measure_theme/measure/css/theme.css">
    <link rel="stylesheet" type="text/css" href="http://www.citypackr.com/measure_theme/measure/css/signin.css">
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="http://www.citypackr.com/measure_theme/measure/css/animate.css">
    <link rel="stylesheet" type="text/css" href="http://www.citypackr.com/measure_theme/measure/css/external-pages.css">
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    <link href="http://www.citypackr.com/adminia/css/font-awesome.css" rel="stylesheet">  
    <link href="http://www.citypackr.com/adminia/css/adminia.css" rel="stylesheet"> 
    <link href="http://www.citypackr.com/adminia/css/adminia-responsive.css" rel="stylesheet">  
    <link href="http://www.citypackr.com/adminia/css/pages/dashboard.css" rel="stylesheet"> 
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
<body>
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    // init the FB JS SDK
    FB.init({
      appId      : '262588197124151', // App ID from the App Dashboard
      channelUrl : '//www.myopia.me/channel.html', // Channel File for x-domain communication
      status     : true, // check the login status upon init?
      cookie     : true, // set sessions cookies to allow your server to access the session?
      xfbml      : true  // parse XFBML tags on this page?
    });

    // Additional initialization code such as adding Event Listeners goes here

  };

  // Load the SDK's source Asynchronously
  // Note that the debug version is being actively developed and might 
  // contain some type checks that are overly strict. 
  // Please report such bugs using the bugs tool.
  (function(d, debug){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all" + (debug ? "/debug" : "") + ".js";
     ref.parentNode.insertBefore(js, ref);
   }(document, /*debug*/ false));
</script>
	<script type="text/javascript">
		function submitiframeform(){
			window.top.registerFrame.document.registerForm.submit();
		}
	</script>
	<div class="modal hide fade" id="inviteModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">Request Invite</h3>
		</div>
		<div class="modal-body">
			<form class="form-horizontal" method="post" action="invite.php">
				<div class="control-group">
					<label class="control-label" for="inputEmail">Email Address</label>
					<div class="controls">
						<input class="input-large" type="text" name="email" id="inputEmail" placeholder="Email" />
					</div>
				</div>
				<input type="hidden" name="submitted" value="TRUE" />
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			<button class="btn btn-primary" type="submit">Request Invite</button>
			</form>
		</div>
	</div>
	<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">Sign In</h3>
		</div>
		<div class="modal-body">
			<form class="form-horizontal" method="post" action="login.php">
				<div class="control-group">
					<label class="control-label" for="inputEmail">Email</label>
					<div class="controls">
						<input class="input-large" type="text" name="email" id="inputEmail" placeholder="Email" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputPassword">Password</label>
					<div class="controls">
						<input class="input-large" type="password" name="pass" id="inputPassword" placeholder="Password" />
					</div>
				</div>
				<input type="hidden" name="submitted" value="TRUE" />
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			<button class="btn btn-primary" type="submit">Sign In</button>
			</form>
		</div>
	</div>
	<div class="modal hide fade" id="wizardModal" style="width: 600px; margin: -250px 0 0 -300px;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">Tell Us About Yourself</h3>
		</div>
			<iframe src="includes/register_form.php" width="600px" height="350px" frameborder="0" id="registerForm" name="registerFrame" scrolling="no"></iframe>
	</div>
	<div class="modal hide fade" id="newWizardModal" style="width: 750px; margin: -250px 0 0 -375px;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">Subscribe</h3>
		</div>
			<iframe src="#" width="750px" height="450px" frameborder="0" id="wizardForm" name="registerFrame" scrolling="no"></iframe>
	</div>
	<div class="modal hide fade" id="memWizardModal" style="width: 750px; margin: -250px 0 0 -375px;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">Join</h3>
		</div>
			<iframe src="#" width="750px" height="450px" frameborder="0" id="memwizardForm" name="registerFrame" scrolling="no"></iframe>
	</div>
	<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
    		<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
          	</a>
          	<a class="brand scroller" href="index.php">
                <img src="images/logo.png" alt="logo" />
            </a>
		  	<div class="nav-collapse collapse">
                <ul class="nav pull-right">
                    <li><a href="features.php">Features</a></li>
                    <li><a href="aboutus.php">About Us</a></li>
                    <li><a href="contactus.php">Contact Us</a></li>
                    <li><a href="/blog">Blog</a></li>
					<?php if ($merchLoggedIn): ?>
                    <li class="dropdown">
                        <a href="merchant_admin.php" class="dropdown-toggle" data-toggle="dropdown">
                            Merchant Account
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="merchant_admin.php">Merchant Admin</a></li>
                            <li><a href="logout.php?m=1">Sign Out</a></li>
                        </ul>
                    </li>
					<?php else: ?>
					<li><a href="merchant_admin.php" class="btn-header" type="button">Merchant Sign In</a></li>
					<?php endif; ?>	
					<?php if ($isLoggedIn): ?>
                    <li class="dropdown">
                        <a href="merchant_admin.php" class="dropdown-toggle" data-toggle="dropdown">
                            My Account
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="account.php">My Account Admin</a></li>
                            <li><a href="logout.php">Sign Out</a></li>
                        </ul>
                    </li>
					<?php else: ?>
					<li><a href="account.php" class="btn-header" type="button">User Sign In</a></li>
					<?php endif; ?>	
                </ul>
	        </div>
        </div>
      </div>
    </div>
