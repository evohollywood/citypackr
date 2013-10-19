<?php

$e = 'evomoore@gmail.com';

$args = array(
	'key' => 'HaVrKwsIhLsI8vsnlhn0QA',
    'template_name' => 'nuclear-comics',
	'template_content' => array(array("name" => "example name", "content" => "example content")),
	'message' => array(
		"text" => null,
		"from_email" => "evo@citypackr.com",
		"from_name" => "Nuclear Comics",
		"subject" => "Confirmation - TPB of the Month Club",
		"to" => array(array("email" => $e)),
		"track_opens" => true,
		"track_clicks" => true,
		"auto_text" => true
	)   
);
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

print_r($response);

echo 'Is valid php';

?>