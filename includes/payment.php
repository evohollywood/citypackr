<?php

	session_start();
	
	$user_id = $_SESSION['user_id'];

 // WePay PHP SDK - http://git.io/mY7iQQ
    require '../wepay/wepay.php';
	include ('functions.inc');
	require_once ('mysql_connect.php');
	
	// Check for address input and then store in session
	
	
	if ($_POST['submitted']) {
	
		$errors = array();
	
		if (empty($_POST['userAddress'])) {

			$errors[] = 'You forgot to enter a shipping address.';

		} else {
		
			$ua = trim($_POST['userAddress']);

		}

		if (isset($_POST['userApt'])) {
		
			$uapt = trim($_POST['userApt']);

		}

		if (!empty($_POST['userZip'])) {
				
			$z = trim($_POST['userZip']);
				
		} else {

			$errors[] = 'You forgot to enter your zip code.';
		
		}
	
	} else {

		$url = '../account.php';
		header("Location: $url");
		exit();
	
	}
	
	if (empty($errors)):
		
	$q2 = "INSERT INTO shipping_addresses (user_id, address, apt, zip) VALUES ('$user_id', '$ua', '$uapt', '$z')";
	$r2 = @mysql_query ($q2);
	
	if ($r2) {
	
		$q3 = "SELECT * FROM shipping_addresses WHERE user_id='$user_id' ORDER BY address_id DESC LIMIT 1";
		$r3 = @mysql_query ($q3);
		$address_info = mysql_fetch_assoc($r3);
	
	}

    // application settings
    $account_id = 508790531;
    $client_id = 96607;
    $client_secret = "127a37d4f3";
    $access_token = "STAGE_ccae256c3cec257536a08602c5c0ba68f5f7e326f47e24adca782bf717b42b7f";
	$subscription_info = get_sub_type_info($_GET['subscription_id']);
	$charge = $subscription_info['subscription_price'] . '.00';
	$subscription_name = $subscription_info['subscription_name'];
	$redirect = 'http://www.citypackr.com/purchase.php?a_id=' . $address_info['address_id'] . '&s_id=' . $subscription_info['subscription_type_id'];

    // change to useProduction for live environments
    Wepay::useStaging($client_id, $client_secret);

    $wepay = new WePay($access_token);
	
	$year = date("Y") + 1;
	$month = date("m");
	$day = date("d");

	$date = $year . '-' . $month . '-' . $day;

    // create the pre-approval
    $response = $wepay->request('preapproval/create', array(
        'account_id'        => $account_id,
        'period'            => 'monthly',
        'end_time'          => $date,
        'amount'            => $charge,
		'fee_payer'         => 'payee',
        'mode'              => 'iframe',
        'short_description' => $subscription_name,
        'redirect_uri'      => $redirect,
        'auto_recur'        => 'true'
    ));
    
    // display the approval embed
	$iframe_uri = $response->{preapproval_uri};
	
?><!DOCTYPE html>
<html lang="en">
<head>
	<link rel=StyleSheet href="../bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
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
</div>
<script type="text/javascript" src="https://www.wepay.com/js/iframe.wepay.js">
</script>

<script type="text/javascript">
    WePay.iframe_checkout("preapproval_div_id", "<?php echo $iframe_uri; ?>");
</script>

<iframe src="<?php echo $iframe_uri; ?>" width="750px" height="290px" frameborder="0" id="preapproval_div_id" style="margin-top: -25px;"></iframe>
</body>
</html>
<?php else: 

		echo '<h1>Error!</h1>';

		foreach ($errors as $msg) {

			echo " - $msg<br />\n";
	
		}
		echo '</p>Please try again.</p><p><br /></p>';

?>
<?php endif; ?>