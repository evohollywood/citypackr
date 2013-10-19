<?php

function check_membership ($pack_id, $user_id) {

$q = 'SELECT * FROM memberships WHERE pack_id=' . $pack_id . ' AND user_id=' . $user_id;
$r = mysql_query($q);

$row = mysql_fetch_assoc($r);

if ($row['user_id'] == $user_id && $row['active_flag'] == '1') {

	return true;
	
} else {

	return false;
	
}

}

// User Validation Functions

function check_email ($email) {

$q = "SELECT * FROM users WHERE email='$email'";

$r = @mysql_query ($q);

$check = mysql_num_rows($r);

if ($check == 0) {

	return FALSE;

} else {

 	return TRUE;

}

}

// Subscription Functions

function createSub($user_id, $sub_id, $payment_id, $frequency, $address_id) {

$q = "INSERT INTO subscriptions (subscription_type_id, user_id, payment_id, address_id, frequency, created_date) VALUES ('$sub_id', '$user_id', '$payment_id', '$address_id', '$frequency', NOW() )";

$r = @mysql_query ($q);

return $r;

}

function checkSub($user_id) {

$q = 'SELECT COUNT(*) AS count FROM subscriptions WHERE user_id=' . $user_id;
$r = mysql_query($q);

$row = mysql_fetch_assoc($r);

$count = $row['count'];

return $count;

}

function check_active_sub($user_id) {

$q = 'SELECT COUNT(*) AS count FROM subscriptions WHERE active_flag=1 AND user_id=' . $user_id;
$r = mysql_query($q);

$row = mysql_fetch_assoc($r);

$count = $row['count'];

if ($count > 0) {

	return true;

} else {

	return false;

}

}

function get_subs ($user_id) {

$q = 'SELECT * FROM subscriptions WHERE user_id=' . $user_id;
$r = mysql_query($q);

while ($row = mysql_fetch_assoc($r)) {

	if ($row['subscription_id'] != "") {
	
		$subscription_ids[] = $row['subscription_id'];

	}

}

return $subscription_ids;

}

function get_sub_type_recs ($user_id) {

$q = 'SELECT * FROM subscription_types ORDER BY subscription_type_id LIMIT 2';
$r = mysql_query($q);

while ($row = mysql_fetch_assoc($r)) {

	if ($row['subscription_type_id'] != "") {
	
		$sub_ids[] = $row['subscription_type_id'];

	}

}

return $sub_ids;

}

function get_sub_info ($subscription_id) {

$q = 'SELECT * FROM subscriptions WHERE subscription_id=' . $subscription_id;
$r = mysql_query($q);

$row = mysql_fetch_assoc($r);

return $row;

}

function get_sub_type_info ($subscription_type_id) {

$q = 'SELECT * FROM subscription_types WHERE subscription_type_id=' . $subscription_type_id;
$r = mysql_query($q);

$row = mysql_fetch_assoc($r);

return $row;

}


function deactivate_subscription ($user_id, $subscription_id) {

$q = 'UPDATE subscriptions SET active_flag=0 WHERE user_id=' . $user_id . ' AND subscription_id=' . $subscription_id;
$r = mysql_query($q);

}

function reactivate_subscription ($user_id, $subscription_id) {

$q = 'UPDATE subscriptions SET active_flag=1 WHERE user_id=' . $user_id . ' AND subscription_id=' . $subscription_id;
$r = mysql_query($q);

}

// Membership functions


function createMembership($user_id, $mem_id, $payment_id, $frequency) {

$q = "INSERT INTO memberships (membership_type_id, user_id, payment_id, frequency, created_date) VALUES ('$mem_id', '$user_id', '$payment_id', '$frequency', NOW() )";

$r = @mysql_query ($q);

return $r;

}

function checkMembership($user_id) {

$q = 'SELECT COUNT(*) AS count FROM memberships WHERE user_id=' . $user_id;
$r = mysql_query($q);

$row = mysql_fetch_assoc($r);

$count = $row['count'];

return $count;

}

function check_active_memberships($user_id) {

$q = 'SELECT COUNT(*) AS count FROM memberships WHERE active_flag=1 AND user_id=' . $user_id;
$r = mysql_query($q);

$row = mysql_fetch_assoc($r);

$count = $row['count'];

if ($count > 0) {

	return true;

} else {

	return false;

}

}

function get_memberships ($user_id) {

$q = 'SELECT * FROM memberships WHERE user_id=' . $user_id;
$r = mysql_query($q);

while ($row = mysql_fetch_assoc($r)) {

	if ($row['membership_id'] != "") {
	
		$membership_ids[] = $row['membership_id'];

	}

}

return $membership_ids;

}

function get_membership_info ($membership_id) {

$q = 'SELECT * FROM memberships WHERE membership_id=' . $membership_id;
$r = mysql_query($q);

$row = mysql_fetch_assoc($r);

return $row;

}

function get_membership_type_info ($membership_type_id) {

$q = 'SELECT * FROM membership_types WHERE membership_type_id=' . $membership_type_id;
$r = mysql_query($q);

$row = mysql_fetch_assoc($r);

return $row;

}

function get_membership_type_recs ($user_id) {

$q = 'SELECT * FROM membership_types ORDER BY membership_type_id LIMIT 2';
$r = mysql_query($q);

while ($row = mysql_fetch_assoc($r)) {

	if ($row['membership_type_id'] != "") {
	
		$membership_ids[] = $row['membership_type_id'];

	}

}

return $membership_ids;

}

function deactivate_membership ($user_id, $membership_id) {

$q = 'UPDATE memberships SET active_flag=0 WHERE user_id=' . $user_id . ' AND membership_id=' . $membership_id;
$r = mysql_query($q);

}

function reactivate_membership ($user_id, $membership_id) {

$q = 'UPDATE memberships SET active_flag=1 WHERE user_id=' . $user_id . ' AND membership_id=' . $membership_id;
$r = mysql_query($q);

}

// Preapproval/payment functions

function uniquePreapproval ($p_id) {

$q = 'SELECT COUNT(*) AS count FROM subscriptions WHERE payment_id=' . $p_id;
$r = mysql_query($q);

$row = mysql_fetch_assoc($r);

$count = $row['count'];

return $count;

}


// Shipment functions

function get_next_ship_date () {

$q = 'SELECT * FROM shipment_schedule ORDER BY shipment_date DESC LIMIT 1';
$r = mysql_query($q);

$row = mysql_fetch_assoc($r);

$date = $row['shipment_date'];

return $date;

}

function get_next_ship_capacity () {

$q = 'SELECT capacity FROM shipment_schedule ORDER BY shipment_date DESC LIMIT 1';
$r = mysql_query($q);

$row = mysql_fetch_assoc($r);

$date = $row['capacity'];

return $date;

}

function get_next_ship_member_count () {

$q = 'SELECT COUNT(*) AS count FROM subscriptions WHERE active_flag=1';
$r = mysql_query($q);

$row = mysql_fetch_assoc($r);

$count = $row['count'];

return $count;

}

// Merchant functions

function get_merch_recs ($user_id) {

$q = 'SELECT * FROM merchants ORDER BY merchant_id LIMIT 2';
$r = mysql_query($q);

while ($row = mysql_fetch_assoc($r)) {

	if ($row['merchant_id'] != "") {
	
		$merch_ids[] = $row['merchant_id'];

	}

}

return $merch_ids;

}

function get_merchant_info ($merchant_id) {

$q = 'SELECT * FROM merchants WHERE merchant_id=' . $merchant_id;
$r = mysql_query($q);

$row = mysql_fetch_assoc($r);

return $row;

}

// Reward & Referral functions

function get_reward_total ($user_id) {

$total = 0;

$q = 'SELECT * FROM rewards WHERE active_flag=1 AND user_id=' . $user_id;
$r = mysql_query($q);

while ($row = mysql_fetch_assoc($r)) {

	$total = $total + $row['reward_amount'];

}

$total = number_format($total, 2);

return $total;

}


// MEMBERSHIP ADMIN FUNCTIONS

function get_merchant_membership_types ($merchant_id) {

$q = 'SELECT * FROM membership_types WHERE merchant_id=' . $merchant_id;
$r = mysql_query($q);

while ($row = mysql_fetch_assoc($r)) {

	if ($row['membership_type_id'] != "") {
	
		$membership_type_ids[] = $row['membership_type_id'];

	}

}

return $membership_type_ids;


}

function get_current_member_count($membership_id) {

$q = 'SELECT COUNT(*) FROM memberships WHERE membership_type_id=' . $membership_id . ' AND active_flag=1';
$r = mysql_query($q);

$row = mysql_fetch_assoc($r);

$recipients = $row['COUNT(*)'];

return $recipients;

}

function get_members($membership_id) {

$q = 'SELECT * FROM memberships WHERE membership_type_id=' . $membership_id . ' AND active_flag=1';
$r = @mysql_query($q);

while ($row = mysql_fetch_assoc($r)) {

		$members[] = $row['user_id'];

}

return $members;

}

function get_member_info ($user_id) {

$q = 'SELECT username, email FROM users WHERE user_id=' . $user_id;
$r = mysql_query($q);

$row = mysql_fetch_assoc($r);

return $row;

}

// DEPRECATED ADD ON FUNCTIONS

function get_add_on_recs ($user_id) {

$q = 'SELECT * FROM add_on_types ORDER BY merchant_id LIMIT 4';
$r = mysql_query($q);

while ($row = mysql_fetch_assoc($r)) {

	if ($row['add_on_type_id'] != "") {
	
		$add_on_ids[] = $row['add_on_type_id'];

	}

}

return $add_on_ids;

}

function get_add_on_info ($add_on_id) {

$q = 'SELECT * FROM add_on_types WHERE add_on_type_id=' . $add_on_id;
$r = mysql_query($q);

$row = mysql_fetch_assoc($r);

return $row;

}

function check_add_on($user_id, $add_on_id) {

$q = 'SELECT COUNT(*) AS count FROM add_ons WHERE active_flag=1 AND user_id=' . $user_id . ' AND add_on_type_id=' . $add_on_id;
$r = mysql_query($q);

$row = mysql_fetch_assoc($r);

$count = $row['count'];

if ($count == 0) {

	return true;

} else {

	return false;
}

}

function check_inactive_add_on($user_id, $add_on_id) {

$q = 'SELECT COUNT(*) AS count FROM add_ons WHERE active_flag=0 AND user_id=' . $user_id . ' AND add_on_type_id=' . $add_on_id;
$r = mysql_query($q);

$row = mysql_fetch_assoc($r);

$count = $row['count'];

if ($count == 0) {

	return true;

} else {

	return false;
}

}

function get_my_add_ons ($user_id) {

$q = 'SELECT * FROM add_ons WHERE active_flag=1 AND user_id=' . $user_id;
$r = mysql_query($q);

while ($row = mysql_fetch_assoc($r)) {

	if ($row['add_on_type_id'] != "") {
	
		$add_on_ids[] = $row['add_on_type_id'];

	}

}

return $add_on_ids;

}

function createAddon($add_on_type_id, $user_id, $payment_id, $frequency) {

$q = "INSERT INTO add_ons (add_on_type_id, user_id, payment_id, frequency, created_date) VALUES ('$add_on_type_id', '$user_id', '$payment_id', '$frequency', NOW() )";

$r = @mysql_query ($q);

return $r;

}

function uniqueAddonapproval ($p_id) {

$q = 'SELECT COUNT(*) AS count FROM add_ons WHERE payment_id=' . $p_id;
$r = mysql_query($q);

$row = mysql_fetch_assoc($r);

$count = $row['count'];

if ($count == 0) {
	return true;
} else {
	return false;
}

}

function deactivate_add_on ($user_id, $add_on_id) {

$q = 'UPDATE add_ons SET active_flag=0 WHERE user_id=' . $user_id . ' AND add_on_type_id=' . $add_on_id;
$r = mysql_query($q);

}

function reactivate_add_on ($user_id, $add_on_id) {

$q = 'UPDATE add_ons SET active_flag=1 WHERE user_id=' . $user_id . ' AND add_on_type_id=' . $add_on_id;
$r = mysql_query($q);

}

?>