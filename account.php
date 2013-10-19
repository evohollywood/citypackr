<?php

$page_title = 'CityPackr - The Best of Your City at Your Doorstep';

include ('includes/head_new2.inc');
require_once ('includes/mysql_connect.php');

if ($isLoggedIn):

// Check for ANY active subscriptions, add check for memberships

$checkSub = checkSub($user_id);

if ($checkSub != 0) {
	$isSubbed = 1;
}

// Change to get_sub_recs

$merchants = get_merch_recs ($user_id);

$reward_balance = get_reward_total ($user_id);

// Check for ANY active memberships

$checkMem = checkMembership($user_id);

if ($checkMem != 0) {
	$isMem = 1;
}

/*

// Change to get_sub_recs

$memberships = get_merch_recs ($user_id);

*/

?>
	<div class="container">
<?php if ($isMem == 0): 
	
		$memberships = get_membership_type_recs($user_id);
	
	?>
	<?php /*
		<h2>My Memberships</h2>
		<div class="well">
			<h2 class="span12">Suggested Memberships</h2>
			<div class="span8">
				<ul class="thumbnails">
					<?php
					foreach ($memberships as $membership) {
					
						$membership_info = get_membership_type_info($membership);
						
						echo '<li class="span4">
							<div class="thumbnail">
								<img src="images/' . $membership_info['mem_image'] . '" alt="">
								<h4>' . $membership_info['membership_name'] . '</h4>
								<p>' . $membership_info['mem_description'] . '</p>
								<a href="#memWizardModal" onClick="document.getElementById(\'memwizardForm\').src=\'includes/mem_wizard.php?membership_id=' . $membership . '\'" data-toggle="modal" class="btn btn-block btn-large btn-success">Join</a>
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
	*/ ?>
	<?php else: 
		$mem_ids = get_memberships($user_id);
	?>
		<h2 class="section_header">
			<hr class="left visible-desktop">
			<span>My Rewards</span>
			<hr class="right visible-desktop">
		</h2>
		<?php
			foreach ($mem_ids as $mem_id) {
				
				$mem_info = get_membership_info($mem_id);
				$mem_type_info = get_membership_type_info($mem_info['membership_type_id']);
				$merchant_info = get_merchant_info($mem_type_info['merchant_id']);
				echo'<div class="well">
						<div class="row">
							<div class="span3">
								<img src="images/' . $merchant_info['merchant_img'] . '" alt="">
							</div>
							<div class="span5">
								<h3>' . $mem_type_info['membership_name'] . '</h3>
								<h4>' . $merchant_info['merchant_name'] . '</h4>
							</div>
							<div class="span3">
								<h4>$' . $mem_type_info['membership_price'] . '.00/month</h4>';
								
				if ($mem_info['active_flag'] == 0) {
					echo		'<a href="reactivate.php?mem_id=' . $mem_id . '" class="btn btn-block btn-large btn-success" style="margin-top: 10px;">Reactivate Membership</a>';				
				} else {
					echo		'<a href="deactivate.php?mem_id=' . $mem_id . '" class="btn btn-block btn-large btn-danger" style="margin-top: 10px;">Deactivate Membership</a>';
				}

				echo	'	</div>
						</div>
					</div>';
			}
		?>
	<?php endif; ?>
	<?php if ($isSubbed == 0): 
			$subscription_types = get_sub_type_recs($user_id);
	?>
	<?php /*
		<h2>My Subscriptions</h2>
		<div class="well">
			<h2 class="span12">Suggested Subscriptions</h2>
			<div class="span8">
				<ul class="thumbnails">
					<?php
					foreach ($subscription_types as $subscription_type) {
					
						$sub_type_info = get_sub_type_info($subscription_type);
						
						echo '<li class="span4">
							<div class="thumbnail">
								<img src="images/' . $sub_type_info['sub_image'] . '" alt="">
								<h4>' . $sub_type_info['subscription_name'] . '</h4>
								<p style="height: 50px;">' . $sub_type_info['sub_description'] . '</p>
								<a href="#newWizardModal" onClick="document.getElementById(\'wizardForm\').src=\'includes/wizard.php?subscription_id=' . $subscription_type . '\'" data-toggle="modal" class="btn btn-block btn-large btn-success">Subscribe</a>
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
	*/ ?>
	<?php else: 
		$sub_ids = get_subs($user_id);
	?>
		<h2 class="section_header">
			<hr class="left visible-desktop">
			<span>My Discoveries</span>
			<hr class="right visible-desktop">
		</h2>
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
								<p><a href="#">Edit Payment Information</a> | <a href="#">Edit Delivery Address</a></p>
							</div>
							<div class="span3">
								<h4>$' . $sub_type_info['subscription_price'] . '.00/month</h4>
								<a href="gift.php?sub_id=' . $sub_id . '" class="btn btn-block btn-large btn-success" style="margin-top: 10px;">Give as Gift</a>';
								
				if ($sub_info['active_flag'] == 0) {
					echo		'<a href="reactivate.php?sub_id=' . $sub_id . '" class="btn btn-block btn-large btn-success" style="margin-top: 10px;">Reactivate Subscription</a>';				
				} else {
					echo		'<a href="deactivate.php?sub_id=' . $sub_id . '" class="btn btn-block btn-large btn-danger" style="margin-top: 10px;">Deactivate Subscription</a>';
				}

				echo	'	</div>
						</div>
					</div>';
			}
		?>
	<?php endif; ?>
	<?php /*
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
	*/ ?>
	</div>
<?php else: ?>
<div class="container" style="margin-top: 50px;">
    <div id="box_login">
        <div class="container">
            <div class="span12 box_wrapper">
                <div class="span12 box">
                    <div>
                        <div class="head">
                            <h4>Log in to your account</h4>
                        </div>
                        <div class="form">
                            <form method="post" action="login.php">
                                <input type="text" name="email" id="inputEmail" placeholder="Email"/>
                                <input type="password" name="pass" id="inputPassword" placeholder="Password"/>
								<input type="hidden" name="submitted" value="TRUE" />
                                <input type="submit" class="btn" value="Sign in"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php

include ('includes/foot_new.inc');

?>