<?php

// Subscriber Admin

session_start();


$mid = 7;

if ($_POST['submitted']) {

	if ($_POST['pass'] == 'cakebaby' && $_POST['email'] == 'stacie@cakebaby.com') {
	
		$_SESSION['user_id'] = $mid;
	
	}

}

include ('includes/functions.inc');
require_once ('includes/mysql_connect.php');
include ('includes/wepay.php');

if ($_SESSION['user_id'] == $mid):

$memberships = get_merchant_membership_types($mid);

$merchant_info = get_merchant_info($mid);

$account_id = $merchant_info['wepay_id'];
$client_id = 96607;
$client_secret = "127a37d4f3";
$access_token = $merchant_info['merchant_auth'];

// change to useProduction for live environments
Wepay::useStaging($client_id, $client_secret);

$wepay = new WePay($access_token);

// create the checkout
$response = $wepay->request('account/balance', array(
	'account_id'        => $account_id
));

$balance = $response->pending_balance;

$withdrawl = $wepay->request('withdrawal/create', array(
        'account_id'    => $account_id,
        'redirect_uri'  => 'http://nuclear.citypackr.com/admin.php'
    ));
	
$withdrawl_url = $withdrawl->withdrawal_uri;

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
<body>
<div class="container">
	<div class="navbar navbar-fixed-top navbar-inverse">
		<div class="navbar-inner">
			<a class="brand" href="#" style="margin-left: 20px;"><h1>CityPackr Merchant Admin - CakeBaby</h1></a>
			<a href="logout.php" style="margin-top: 20px; margin-right: 20px;" class="btn btn-large btn-danger pull-right" type="button">Sign Out</a>
		</div>
	</div>
	<div class="row"  style="margin-top: 90px;">
		<div class="span3">
			<div class="well" style="text-align: center;">
				<h2>Earnings</h2>
				<h3>$<?php echo $balance; ?></h3>
				<a href="<?php echo $withdrawl_url; ?>" class="btn btn-large btn-success btn-block" type="button">Withdraw</a>
			</div>
		</div>
		<div class="span9">
			<div class="well">
				<h2>Memberships</h2>
				<?php
					foreach ($memberships as $membership_id) {	
					
						echo '<div class="row">';
					
						$membership = get_membership_type_info($membership_id);
						
						$members = get_current_member_count($membership_id);

						echo '  <div class="span6">';						
						echo '      <h3>' . $membership['membership_name'] . '</h3>';
						echo '      <h4>' . $members . ' Members</h4>';
						echo '  </div>';
						echo '  <div class="span2">';
						echo '  	<a href="email_list.php?mem_id=' . $membership['membership_type_id'] . '&m_id=' . $mid . '" class="btn btn-large btn-primary btn-block" style="margin-top:20px;" type="button">Download Members</a>';
						echo '  </div>';
						echo '</div>';
					}
				?>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<?php
else:
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
<div class="container" style="padding-top: 200px;">
	<div class="well span6 offset3">
		<h2>Sign In</h2>
		<form method="post" action="admin.php">
			<div class="control-group">
				<div class="controls">
					<input class="input-large span6" type="text" name="email" id="inputEmail" placeholder="Email" />
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<input class="input-large span6" type="password" name="pass" id="inputPassword" placeholder="Password" />
				</div>
			</div>
			<input type="hidden" name="submitted" value="TRUE" />
			<button class="btn btn-large btn-primary btn-block" type="submit">Sign In</button>
		</form>
	</div>
</div>
</body>
</html>
<?php endif; ?>