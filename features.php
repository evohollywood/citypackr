<?php

session_start();

$page_title = 'CityPackr - The Best of Your City at Your Doorstep';


include ('includes/head_new.inc');

if (isset($_GET['p'])) {

$page = $_GET['p'];

} else {

$page = 1;

}

?>
<div class="container" style="min-height: 500px; margin-top: 20px;">
	<div class="row">
		<div class="span3">
			<ul class="nav nav-tabs nav-stacked affix span3" style="background-color: white;">
			  <li<?php if ($page == 1) { echo ' class="active"'; } ?>><a href="?p=1">Subscriptions</a></li>
			  <li<?php if ($page == 2) { echo ' class="active"'; } ?>><a href="?p=2">Memberships</a></li>
			  <li<?php if ($page == 3) { echo ' class="active"'; } ?>><a href="?p=3">No Setup Fees</a></li>
			  <li<?php if ($page == 4) { echo ' class="active"'; } ?>><a href="?p=4">In Store POS</a></li>
			  <li<?php if ($page == 5) { echo ' class="active"'; } ?>><a href="?p=5">Fully Customizable</a></li>
			  <li<?php if ($page == 6) { echo ' class="active"'; } ?>><a href="?p=6">Dead Simple Admin</a></li>
			</ul>
		</div>
		<div class="span9">
			<div class="row" style="margin-left: 20px;">
				<?php if ($page == 1): ?>
				<div class="page-header">
					<h1>Subscriptions</h1>
				</div>
				<?php elseif ($page == 2): ?>
				<div class="page-header">
					<h1>Memberships</h1>
				</div>
				<?php elseif ($page == 3): ?>
				<div class="page-header">
					<h1>No Setup Fees</h1>
				</div>
				<?php elseif ($page == 4): ?>
				<div class="page-header">
					<h1>In Store POS</h1>
				</div>
				<?php elseif ($page == 5): ?>
				<div class="page-header">
					<h1>Fully Customizable</h1>
				</div>
				<?php elseif ($page == 6): ?>
				<div class="page-header">
					<h1>Dead Simple Admin</h1>
				</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<?

include ('includes/foot_new.inc');

?>