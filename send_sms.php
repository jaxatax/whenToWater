<?php

    require "/opt/bitnami/apache2/htdocs/vendor/autoload.php";
    use Twilio\Rest\Client;

    // account SID and auth token
    $account_sid = getenv('TWILIO_ACCOUNT_SID'); // getting the account SID from an environment variable for safety
    $auth_token = getenv('TWILIO_AUTH_TOKEN'); // getting the auth token from an environment variable for safety

    /*
    echo $account_sid;
    echo "\n Hi from send_sms.php \n";
    echo $auth_token;
    */

    $phoneNumbers = array('9729229088'); // change later to access database

    // Twilio number
    $twilio_number = "+19196263961";


    $client = new Client($account_sid, $auth_token);

    function textUsers($water) {
        global $phoneNumbers, $twilio_number, $client;
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

// textUsers("Test 123");

