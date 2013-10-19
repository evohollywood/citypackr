<?php

session_start();

include ('includes/functions.inc');
require_once ('includes/mysql_connect.php');
// WePay PHP SDK - http://git.io/mY7iQQ
    require 'includes/wepay.php';

$mid = 8;

$term = $_GET['term'];

$merchant_info = get_merchant_info($mid);

$sub_id = $_GET['s_id'];

$e = $_POST['email'];

$subscription_info = get_sub_type_info($sub_id);

			// send gift code e-mail
			$args = array(
				'key' => 'HaVrKwsIhLsI8vsnlhn0QA',
				'template_name' => 'nuclear-comics-gift-2',
				'template_content' => array(array("GIFTCODE" => "gift code inserted")),
				'message' => array(
					"text" => null,
					"from_email" => "evo@citypackr.com",
					"from_name" => "Nuclear Comics",
					"subject" => "You've Been Given a Gift Subscription to Nuclear Comics!",
					"to" => array(array("email" => $e)),
					"track_opens" => true,
					"track_clicks" => true,
					"auto_text" => true,
					'merge_vars' => array(array(
						'rcpt' => $e,
						'vars' =>
						array(
							array(
								'name' => 'giftcode',
								'content' => $_POST['gift_code'])
				)))));
			// Open a curl session for making the call

			$curl = curl_init('https://mandrillapp.com/api/1.0/messages/send-template.json' );
			// Tell curl to use HTTP POST
			curl_setopt($curl, CURLOPT_POST, true);

			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			// Tell curl not to return headers, but do return the response
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

			curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
			// Set the POST arguments to pass on
			curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($args));

			// Make the REST call, returning the result
			$response = curl_exec($curl);
	

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
<body style="background-image:url('images/clean_comic_background.jpg');">
<script language="Javascript">

window.onload = function() {
    timeout_init();
};

function timeout_trigger() {
    window.location="http://nuclear2.citypackr.com";   
}

function timeout_init() {
    setTimeout('timeout_trigger()', 40000);
}

</script>
<script type="text/javascript" src="https://www.wepay.com/js/iframe.wepay.js">
</script>
<script type="text/javascript">
    WePay.iframe_checkout("preapproval_div_id", "<?php echo $iframe_uri; ?>");
</script>
<div class="container">
	<div class="well" style="margin-top: 20px;">
		<h1>Thanks! Your gift has been sent!</h1>
	</div>
</div>
</body>
</html>
<?php

?>