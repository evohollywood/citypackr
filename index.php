<?php

session_start();

$page_title = 'CityPackr - The Best of Your City at Your Doorstep';

if(isset($_SESSION['user_id'])) {

    $url = 'account.php';
    header("Location: $url");
    exit();

}

include ('includes/head_new2.inc');

?>
<div id="hero" style="margin-top: 40px;">

	<div class="container">
		<div class="span12">
			<div class="span6">
				<img src="images/pos3.jpg" alt="" />
			</div>
			<div class="span5">
				<h2>Creating Loyal Customers for Small Businesses</h2>
				<p>
					CityPackr's solutions drives recurring revenue and customer loyalty at the point of sale.
				</p>
				<form class="form-horizontal">
					<div class="field">
						<input class="input-block-level" style="margin-bottom: 10px;" type="text" id="inputName" placeholder="Name" />
					</div>

					<div class="field">
						<input class="input-block-level" style="margin-bottom: 10px;" type="text" id="inputEmail" placeholder="E-mail" />
					</div>

					<div class="field">
						<input class="input-block-level" style="margin-bottom: 10px;" type="text" id="inputPhone" placeholder="Phone Number" />
					</div>
					<button type="submit" style="font-family: cp_font; color: white; width: 100%; height: 47px; border: none; background: url(/images/button_back.png) no-repeat center top;">
						REQUEST A DEMO
					</button>
				</form>
			</div>
		</div>
	</div>
</div>
<div id="features" class="features_page">
	<div class="container">
		<div id="features2">
			<!-- header -->
			<h2 class="section_header">
				<hr class="left visible-desktop">
				<span>Features</span>
				<hr class="right visible-desktop">
			</h2>
			<!-- feature list -->
			<div class="row">
				<div class="span4 feature2">
					<div class="icon">
						<i class="secure"></i></div>
					<h4>Product Subscriptions</h4>
					<p>
                        Turn in store sales into recurring revenue streams by providing subscriptions of your most popular products.
					</p>
                    <a href="#" class="btn btn-default" style="margin-left: 75px;">Find Out More</a>
				</div>
				<div class="span4 feature2">
					<div class="icon">
						<i class="graph"></i></div>
					<h4>Memberships</h4>
					<p>
                        Our membership platform turns regular customers into loyal customers and loyal customers into fanatics.
					</p>
                    <a href="#" class="btn btn-default" style="margin-left: 75px;">Find Out More</a>
				</div>
				<div class="span4 feature2">
					<div class="icon">
						<i class="tools"></i></div>
					<h4>No Setup Fees</h4>
					<p>
                        Setup is quick and easy with absolutely no upfront costs, no setup fees, no monthly fees, and no maintenance fees EVER.
					</p>
                    <a href="#" class="btn btn-default" style="margin-left: 75px;">Find Out More</a>
				</div>
			</div>
			<div class="row">
				<div class="span4 feature2">
					<div class="icon">
						<i class="mobile"></i></div>
					<h4>In Store POS</h4>
					<p>
                        Top of the line attractive tablet powered display running CityPackr's custom POS software.
					</p>
                    <a href="#" class="btn btn-default" style="margin-left: 75px;">Find Out More</a>
				</div>
				<div class="span4 feature2">
					<div class="icon">
						<i class="lab"></i></div>
					<h4>Fully Customizable</h4>
					<p>
                        Your brand is #1, at CityPackr we get out of the way and let your store and products shine.
					</p>
                    <a href="#" class="btn btn-default" style="margin-left: 75px;">Find Out More</a>
				</div>
				<div class="span4 feature2">
					<div class="icon">
						<i class="cloud"></i></div>
					<h4>Dead Simple Admin</h4>
					<p>
                        Easy to use admin makes it a breeze to turn walk-in customers into die hard regulars.
					</p>
                    <a href="#" class="btn btn-default" style="margin-left: 75px;">Find Out More</a>
				</div>
			</div>
		</div>
	</div>
</div>
<?

include ('includes/foot_new.inc');

?>