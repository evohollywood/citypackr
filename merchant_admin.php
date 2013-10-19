<?php

session_start();

$page_title = 'CityPackr - The Best of Your City at Your Doorstep';

include ('includes/head_new2.inc');

if ($merchLoggedIn):

require_once ('includes/mysql_connect.php');
include ('wepay/wepay.php');

$merchant_info = get_merchant_info($merchant_id);

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
        'redirect_uri'  => 'http://www.citypackr.com/merchant_admin.php'
    ));
	
$withdrawl_url = $withdrawl->withdrawal_uri;

if ($merchant_info['offer_type'] == 1):

$subscriptions = get_merchant_subscription_types($merchant_id);

$past_shipments = get_past_shipments($merchant_id);

?>
<div id="content">
	<div class="container">
		<div class="row">
			<div class="span3">
				<div class="account-container">				
					<div class="account-details">			
						<span class="account-name"><?php echo $merchant_info['merchant_name']; ?></span>		
						<span class="account-role">Administrator</span>	
					</div> <!-- /account-details -->
				</div> <!-- /account-container -->
				<hr />
				<ul id="main-nav" class="nav nav-tabs nav-stacked">
					<li class="active">
						<a href="merchant_admin.php">
							<i class="icon-home"></i>
							Dashboard 		
						</a>
					</li>	
					<li>
						<a href="merchant_faq.php">
							<i class="icon-pushpin"></i>
							FAQ	
						</a>
					</li>					
				</ul>
				<div class="well" style="text-align: center;">
					<h2>Current Earnings</h2>
					<h3>$<?php echo $balance; ?></h3>
					<a href="<?php echo $withdrawl_url; ?>" class="btn btn-large btn-success btn-block" type="button">Withdraw</a>
				</div>
			</div>
			<div class="span9">
				<h1 class="page-title">
					<i class="icon-home"></i>
					Merchant Dashboard					
				</h1>
				<div class="stat-container">
										
					<div class="stat-holder">						
						<div class="stat">							
							<span>$564.00</span>							
							Total Earnings					
						</div> <!-- /stat -->						
					</div> <!-- /stat-holder -->
					
					<div class="stat-holder">						
						<div class="stat">							
							<span>423</span>							
							Current Subscribers						
						</div> <!-- /stat -->						
					</div> <!-- /stat-holder -->
					
					<div class="stat-holder">						
						<div class="stat">							
							<span>96</span>							
							Past Shipments							
						</div> <!-- /stat -->						
					</div> <!-- /stat-holder -->
					
				</div> <!-- /stat-container -->
					<?php
							echo '<div class="widget widget-table">
										<div class="widget-header">
											<i class="icon-th-list"></i>
											<h3>Next Shipments</h3>
										</div> <!-- /widget-header -->
										<div class="widget-content">
											<table class="table table-striped table-bordered">
												<thead>
												<tr>
													<th>Date</th>
													<th>Recipients</th>
													<th>Options</th>
												</tr>
											</thead>							
											<tbody>';
						foreach ($subscriptions as $subscription_id) {	
						
							$subscription = get_sub_type_info($subscription_id);
							$last_ship_date = get_last_ship_date($subscription['subscription_type_id']);
							
							$last_ship_month = substr($last_ship_date, -5, 2);						
							$today_month = date("m");
							
							if ($last_ship_month == $today_month) {
								$next_ship_month = date("m")+1;
								if ($today_month == '12') {
									$next_ship_year = date("Y")+1;
								} else {
									$next_ship_year = date("Y");					
								}
							} else {
								$next_ship_month = $today_month;
								$next_ship_year = date("Y");
							}
							/*
							if ($next_ship_month < 10) {
								$next_ship_month = '0' . $next_ship_month;
							}
							*/
							$next_ship_day = $subscription['sub_date'];
							
							$next_ship_date = $next_ship_year . '-' . $next_ship_month . '-' . $next_ship_day;
							
							$recipients = get_current_recipient_count($subscription_id);
							
							echo '
							<tr>
								<td>' . $next_ship_date . '</td>
								<td>' . $recipients . '</td>
								<td class="action-td">
									<a href="ship.php?s_id=' . $subscription['subscription_type_id'] . '&m_id=' . $merchant_id . '" class="btn btn-primary">
										Generate Shipment						
									</a>					
								</td>
							</tr>';
							
							}
							?>
							</tbody>
						</table>				
					</div> <!-- /widget-content -->					
				</div> <!-- /widget -->
				<div class="widget widget-table">
										
					<div class="widget-header">
						<i class="icon-th-list"></i>
						<h3>Past Shipments</h3>
					</div> <!-- /widget-header -->
					
					<div class="widget-content">
					
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Date</th>
									<th>Recipients</th>
									<th>Options</th>
								</tr>
							</thead>
							
							<tbody>
							<?php
								foreach ($past_shipments as $past_shipment) {
									
									$shipment_info = get_shipment_info($past_shipment);
								echo '
								<tr>
									<td>' . $shipment_info['shipment_date'] . '</td>
									<td>' . $shipment_info['recipients'] . '</td>
									<td class="action-td">
										<a href="manifest.php?s_id=' . $shipment_info['shipment_id'] . '" class="btn btn-warning">
											Download Manifest							
										</a>					
									</td>
								</tr>';
								
								}
							?>
							</tbody>
						</table>
					
					</div> <!-- /widget-content -->
					
				</div> <!-- /widget -->
			</div>
		</div>
	</div>
</div>
<?php elseif ($merchant_info['offer_type'] == 2): 

$memberships = get_merchant_membership_types($merchant_id);

?>
<div class="container">
	<div class="row"  style="margin-top: 20px;">
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
						echo '  	<a href="email_list.php?mem_id=' . $membership['membership_type_id'] . '&m_id=' . $merchant_id . '" class="btn btn-large btn-primary btn-block" style="margin-top:20px;" type="button">Download Members</a>';
						echo '  </div>';
						echo '</div>';
					}
				?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
	<div class="container">
		<h2 class="section_header">
			<hr class="left visible-desktop">
			<span>Feedback</span>
			<hr class="right visible-desktop">
		</h2>
            <div class="row form">
                <div class="span6">
                    <form class="form-horizontal">
                        <div class="control-group">
                                <label class="control-label" for="inputName">Name</label>
                                <div class="controls">
                                    <input type="text" class="span4" id="inputName">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputEmail">Email</label>
                                <div class="controls">
                                    <input type="text" class="span4" id="inputEmail">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputPhone">Phone</label>
                                <div class="controls">
                                    <input type="text" class="span4" id="inputPhone">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputCity">City</label>
                                <div class="controls">
                                    <input type="text" class="span4" id="inputCity">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="inputComment">Comment</label>
                                <div class="controls">
                                    <textarea class="span4" id="inputComment" rows="6"></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls action">
                                    <button type="submit" class="btn">Send</button>
                                </div>
                            </div>
                        </form>
                </div>
                <div class="span5 offset1">
                    <div class="address">
                        <h3>Address</h3>
                        <p>
                            7086 Hollywood Blvd. 
                            <br> Los Angeles, CA 90028
                        </p>
                        <div class="info">
                            <i class="contact phone"></i>
                            1 562 761 1506
                        </div>
                        <div class="info">
                            <i class="contact email"></i>
                            evo@citypackr.com
                        </div>
                        <hr>
                        <h3>Social media</h3>
                        <div class="social">
                            <a href="#"><i class="social tw"></i></a>
                            <a href="#"><i class="social fb"></i></a>
                            <a href="#"><i class="social flickr"></i></a>
                            <a href="#"><i class="social in"></i></a>
                            <a href="#"><i class="social gp"></i></a>
                            <a href="#"><i class="social pin"></i></a>
                            <a href="#"><i class="social tumblr"></i></a>
                            <br>
                            <a href="#"><i class="social wp"></i></a>
                            <a href="#"><i class="social yt"></i></a>
                            <a href="#"><i class="social vim"></i></a>
                            <a href="#"><i class="social picasa"></i></a>
                            <a href="#"><i class="social forrst"></i></a>
                            <a href="#"><i class="social rss"></i></a>
                            <a href="#"><i class="social myspace"></i></a>
                        </div>
                    </div>
                </div>
            </div>
		</div>
<?php else: ?>
    <div id="box_login" style="margin-top: 50px;">
        <div class="container">
            <div class="span12 box_wrapper">
                <div class="span12 box">
                    <div>
                        <div class="head">
                            <h4>Login to your merchant account</h4>
                        </div>
                        <div class="form">
                            <form method="post" action="login.php">
                                <input type="text" name="email" placeholder="Email"/>
                                <input type="password" name="pass" placeholder="Password"/>
                                <input type="submit" class="btn" value="Sign in"/>
								<input type="hidden" name="merchant" value="TRUE" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?

include ('includes/foot_new.inc');

?>