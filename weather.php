<?php

    // requiring the send_sms.php file to send texts when needed
    require "send_sms.php";

    // var weatherURL = "https://api.weather.gov/gridpoints/LSX/88,79/forecast/hourly";
    $weatherURL = "https://api.openweathermap.org/data/2.5/forecast?zip=63005&appid=505d485073f4075dbefead69528cf0e6";


    // returns the weather data
    function getWeather() {
	global $weatherURL;
        return json_decode(file_get_contents($weatherURL),true);
    }

    // returns the total rainfall for the day in mm
    function checkIfWateringNeeded($weatherData) {
	$mmRainToday = 0.0;
	for ($i = 0; $i < 8; $i++) {
	    if (array_key_exists("rain", $weatherData["list"][$i])) {
		$mmRainToday += $weatherData["list"][$i]["rain"]["3h"];
	    }
	}
	return $mmRainToday;
    }

    $mmRainToday = checkIfWateringNeeded(getWeather());
    // I calculated that the recommended watering per day for the average garden is 3.8mm or more
    if ($mmRainToday >= 3.8) {
        sleep(21600);
        textUsers("Don't water your garden. The expected rainfall today is " . strval($mmRainToday) . " millimeters.");
    } else if ($mmRainToday >= 1.8) {
        sleep(21600);
	textUsers("Water your garden lightly. The expected rainfall today is " . strval($mmRainToday) . " millimeters.");
    } else if ($mmRainToday > 0) {
        sleep(21600);
	textUsers("Water your garden normally. The expected rainfall today is only " . strval($mmRainToday) . " millimeters.");
    } else {
        sleep(21600);
	textUsers("Water your garden normally. There is no expected rainfall today.");
    }
?>
