<?php
    // UNFINISHED: rewriting js to be php (all that's needed is the while loop to continually check if the time is correct)


    // point of the project: texts you when to water your garden based on weather data like rainfall and temperature

    // requiring the send_sms.php file to send texts when needed
    require "send_sms.php";

    // var weatherURL = "https://api.weather.gov/gridpoints/LSX/88,79/forecast/hourly";
    $weatherURL = "https://api.openweathermap.org/data/2.5/forecast?zip=63005&appid=505d485073f4075dbefead69528cf0e6";
    $mmRainToday = 0;


    date_default_timezone_set("America/Chicago");

    // checks if it's the correct time (02:59 because the server only returns data starting in several hours)
    function checkIfCorrectTime() {
        return (date("H:i") == "02:59");
    }

    function getWeather() {
        return file_get_contents($weatherURL);
    }

    function checkIfWateringNeeded($weatherData) {
        for ($i = 0; $i < 8; $i++) {
            if ($weatherData->rain) {
                $mmRainToday += $weatherData->list[i]->rain["3h"];
            }
        }
        if ($mmRainToday >= 3.8) {
            return false;
        } else {
            return true;
        }
    }


    while (true) {
        if (checkIfCorrectTime()) {
            if (checkIfWateringNeeded(getWeather())) {
                textUsers("Water!");
            } else {
                textUsers("Don't water!");
            }
        }
        sleep(60);
    }
?>