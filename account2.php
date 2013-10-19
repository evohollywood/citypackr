<?php

$page_title = 'CityPackr - The Best of Your City at Your Doorstep';

include ('includes/head.inc');
require_once ('includes/mysql_connect.php');

if ($isLoggedIn):

//Check for newly activated subscriptions

if (isset($_GET['preapproval_id'])) {

	// first make sure the id is unique

	if (uniquePreapproval($_GET['preapproval_id']) == 0) {

		$sub_id = 1;
		$payment_id = $_GET['preapproval_id'];
		$frequency = 1;
		$createSub = createSub($user_id, $sub_id, $payment_id, $frequency);
		
			if (isset($_SESSION['refer_id'])) {
				
				$refer_id = $_SESSION['refer_id'];
			
				$q3 = "INSERT INTO referrals (user_id, referrer_id, creation_date) VALUES ('$user_id', '$refer_id', NOW() )";
				$r3 = @mysql_query ($q3);

				$q4 = "INSERT INTO rewards (reward_type_id, user_id, reward_entity_id, reward_amount, created_date) VALUES (1, '$refer_id', '$user_id', 5, NOW() )";
				$r4 = @mysql_query ($q4);					
			
			}

	}	
}

// Check for ANY active subscriptions, add check for memberships

$checkSub = checkSub($user_id);

if ($checkSub != 0) {
	$isSubbed = 1;
}

// Change to get_sub_recs

$merchants = get_merch_recs ($user_id);

$reward_balance = get_reward_total ($user_id);

// Check for ANY active memberships

/*

$checkMem = checkMem($user_id);

if ($checkMem != 0) {
	$isMem = 1;
}

// Change to get_sub_recs

$memberships = get_merch_recs ($user_id);

*/

$isMem = 0;

?>
	<div class="container"  style="margin-top:90px;">
		<ul class="nav nav-tabs">
			<li class="active"><a href="/account.php" data-toggle="tab">My Account</a></li>
		</ul>
	<?php if ($isSubbed == 0): ?>
		<h2>My Subscriptions</h2>
		<div class="well">
			<h2 class="span12">Suggested Subscriptions</h2>
			<div class="span8">
				<ul class="thumbnails">
					<?php
					foreach ($merchants as $merchant) {
					
						$merchant_info = get_merchant_info($merchant);
						
						echo '<li class="span4">
							<div class="thumbnail">
								<img src="images/' . $merchant_info['merchant_img'] . '" alt="">
								<h4>' . $merchant_info['merchant_name'] . '</h4>
								<p>' . $merchant_info['merchant_short_desc'] . '</p>
							</div>
						</li>';
					}
					?>
				</ul>
			</div>
			<div class="span3 pullright">
				<p>Based on your location and preferences we’ve identified great subscription plans from local brands and stores that you should try out.</p>
				<a href="subscriptions.php" class="btn btn-success btn-large btn-block">See More in Your Area</a>
				</div>
			<div class="clearfix"></div>
		</div>
	<?php else: 
		$sub_ids = get_subs($user_id);
	?>
		<h2>My Subscriptions</h2>
		<?php
			foreach ($sub_ids as $sub_id) {
				
				$sub_info = get_sub_info($sub_id);
				$sub_type_info = get_sub_type_info($sub_info['subscription_type_id']);
				$merchant_info = get_merchant_info($sub_type_info['merchant_id']);
				echo'<div class="well">
						<div class="row">
							<div class="span3">
								<img src="images/' . $merchant_info['merchant_img'] . '" alt="">
							</div>
							<div class="span5">
								<h3>' . $sub_type_info['subscription_name'] . '</h3>
								<h4>' . $merchant_info['merchant_name'] . '</h4>
							</div>
							<div class="span3">
								<h4>$' . $sub_type_info['subscription_price'] . '.00/month</h4>
								<a href="deactivate.php" class="btn btn-block btn-large btn-danger" style="margin-top: 10px;">Deactivate Subscription</a>
							</div>
						</div>
					</div>';
			}
		?>
	<?php endif; ?>
	<?php if ($isMem == 0): ?>
		<h2>My Memberships</h2>
		<div class="well">
			<h2 class="span12">Suggested Memberships</h2>
			<div class="span8">
				<ul class="thumbnails">
					<?php
					foreach ($merchants as $merchant) {
					
						$merchant_info = get_merchant_info($merchant);
						
						echo '<li class="span4">
							<div class="thumbnail">
								<img src="images/' . $merchant_info['merchant_img'] . '" alt="">
								<h4>' . $merchant_info['merchant_name'] . '</h4>
								<p>' . $merchant_info['merchant_short_desc'] . '</p>
							</div>
						</li>';
					}
					?>
				</ul>
			</div>
			<div class="span3 pullright">
				<p>These local retailers offer awesome membership programs which grant amazing perks, freebies, and discounts. Check them out!</p>
				<a href="memberships.php" class="btn btn-success btn-large btn-block">See More in Your Area</a>
				</div>
			<div class="clearfix"></div>
		</div>
	<?php else: ?>
		<p>You're a member!</p>
	<?php endif; ?>
		<h2>My Rewards</h2>
		<div class="row">
			<div class="span5 well">
				<h3 align="center">Reward Balance:</h3>
				<h3 align="center" style="height: 137px;">$<?php echo $reward_balance; ?></h3>
			</div>
			<div class="span6 well">
				<h3 align="center">Earn More Rewards</h3>
				<div class="row">
					<div class="span3">
						<img src="images/facepile.jpg" alt="" />
					</div>
					<div class="span3">
						<p>Invite your Facebook friends to join CityPackr and when any one of them activates a subscription we'll give you <strong>$5 towards your next shipment!</strong></p>
						<a href="#inviteModal" onclick="FB.ui({method: 'send',name: 'Join CityPackr to Discover the Best Stores and Brands in Los Angeles',link: 'http://www.myopia.me/citypackr?ref_id=<?php echo $user_id; ?>',});" class="btn btn-block btn-success">Invite Friends</a>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
<?php else: ?>
<div class="container" style="padding-top: 200px;">
	<div class="well span6 offset2">
		<form method="post" action="login.php">
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
<?php endif; ?>
<?php

include ('includes/foot.inc');

?>