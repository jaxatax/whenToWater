<?php
	require __DIR__ . '/twilio-php-main/twilio-php-main/src/Twilio/autoload.php';
	use Twilio\Rest\Client;

	// account SID and auth token
	$account_sid = 'ACf64b8d065fff26f227422f45e5bc683c';
	$auth_token = '266d764bd5306821ec451d7af03b9598';

	$water = $_GET["water"];
	$phoneNumbers = json_decode($_GET['phoneNumbers']);

	// Twilio number
	$twilio_number = "+19196263961";

	
	$client = new Client($account_sid, $auth_token);

	foreach ($phoneNumbers as $phoneNumber) {
		$phoneNumber = "+1" . $phoneNumber;
		echo $phoneNumber;
		$client->messages->create(
			// receiving number
			$phoneNumber,
			array(
				'from' => $twilio_number,
				'body' => $water
			)
		);
	}
	unset($phoneNumber);

// redirect to index.php
header("Location: index.php");
?>