// point of the project: texts you when to water your garden based on weather data like rainfall and temperature

// var weatherURL = "https://api.weather.gov/gridpoints/LSX/88,79/forecast/hourly";
var weatherURL = "https://api.openweathermap.org/data/2.5/forecast?zip=63005&appid=505d485073f4075dbefead69528cf0e6";
var currentWeatherURL = "https://api.openweathermap.org/data/2.5/weather?zip=63005&appid=505d485073f4075dbefead69528cf0e6&units=imperial";
var wateringNeeded = true;
var pageChanged = false;
var mmRainToday = 0;
var wateringText;

function checkIfWateringNeeded(weatherData) {
	for (var i = 0; i < 8; i++) {
		if (weatherData.rain) {
			mmRainToday += weatherData.list[i].rain["3h"];
		}
	}
	if (mmRainToday >= 3.8) {
		wateringNeeded = false;
	}
	if (wateringNeeded) {
		console.log("Water!");
	} else {
		console.log("Don't water!");
	}
}

async function getWeather() {
	var weather = await $.ajax({ url:weatherURL, data:{}, headers:{} });
	checkIfWateringNeeded(weather);
	var currentWeather = await $.ajax({ url:currentWeatherURL, data:{}, headers:{} });
	var weatherText = "It's " + Math.round(currentWeather.main.temp).toString() + " degrees with " + currentWeather.weather[0].description + ".";
 	document.getElementById("weather").innerHTML = weatherText;
	console.log(currentWeather);
}