<?php
	require __DIR__ . "/twilio-php-main/twilio-php-main/src/Twilio/autoload.php";
	use Twilio\Rest\Client;

	// account SID and auth token
	$account_sid = "ACf64b8d065fff26f227422f45e5bc683c"; // make this an environment variable later
	$auth_token = "9236a993a99d39094f435942b250b6df"; // make this an environment variable later

	$phoneNumbers = array("9729229088"); // change later to access database

	// Twilio number
	$twilio_number = "+19196263961";

	
	$client = new Client($account_sid, $auth_token);

    function textUsers($water) {
        foreach ($phoneNumbers as $phoneNumber) {
            $phoneNumber = "+1" . $phoneNumber;
            // echo $phoneNumber;
            $client->messages->create(
                // receiving number
                $phoneNumber,
                array(
                    "from" => $twilio_number,
                    "body" => $water
                )
            );
        }
        unset($phoneNumber);
    }
?>