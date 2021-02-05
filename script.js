// point of the project: texts you when to water your garden based on weather data like rainfall and temperature


// variable initialization and changing the time and date on the page
var daysOfTheWeek = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
var monthsOfTheYear = ["January","February","March","April","May","June","July","August","September","October","November","December"];
var currentDate = new Date();
var currentWeatherURL = "https://api.openweathermap.org/data/2.5/weather?zip=63005&appid=505d485073f4075dbefead69528cf0e6&units=imperial";

var minutes;
var currentTime;

var phoneNumberArray = []; // temporary array to hold the phone numbers that the user inputs, change this later to send the phone number to the VM


// changes the time on the webpage
function changeTime() {
    currentDate = new Date();
    if (currentDate.getMinutes() < 10) {
        minutes = "0" + currentDate.getMinutes().toString();
    } else {
        minutes = currentDate.getMinutes().toString();
    }
    if (currentDate.getHours() > 12) {
        currentTime = (currentDate.getHours() - 12).toString() + ":" + minutes + "pm";
    } else if (currentDate.getHours() == 0) {
        currentTime = "12:" + minutes + "am";
    } else {
        currentTime = currentDate.getHours().toString() + ":" + minutes + "am";
    }
    document.getElementById("date").innerHTML = "It's " + currentTime + " on " + daysOfTheWeek[currentDate.getDay()] + ", " + monthsOfTheYear[currentDate.getMonth()] + " " + currentDate.getDate().toString() + ", " + currentDate.getFullYear().toString() + ".";
}

// changes the weather on the webpage
async function getWeather() {
	var currentWeather = await $.ajax({ url:currentWeatherURL, data:{}, headers:{} });
	var weatherText = "It's " + Math.round(currentWeather.main.temp).toString() + " degrees with " + currentWeather.weather[0].description + ".";
 	document.getElementById("weather").innerHTML = weatherText;
	console.log(currentWeather);
}

window.setInterval(changeTime, 1000); // changes the time on the webpage every second
window.setInterval(getWeather, 60000); // changes the weather on the webpage every minute


// function to check if the phone number is valid
function checkPhoneNumber() {
    console.log("I am in here!!!!!");
    var phonenumEle = 
        document.getElementById("phoneNumber");

    if(phonenumEle){					
        var phonenumValue = phonenumEle.value;

        var phonenumCleaned = phonenumValue.replace(/\D/g, "");

        var phonenumMatch = phonenumValue.match(/\d/g);

        if (phonenumMatch) {
            if(phonenumMatch.length===10){
                var pEle = document.getElementById("phoneMsg");

                var firstPart = phonenumCleaned.substr(0, 3);
                var secondPart = phonenumCleaned.substr(3, 3);
                var thirdPart = phonenumCleaned.substr(6, 4);

                var newNum = firstPart + secondPart + thirdPart;


                if (pEle) { 
                    pEle.innerHTML = "";
                    pEle.classList.remove("invalid");

                }	
                phoneNumberArray.push(newNum);
                phonenumEle.value = "";
                return true;
            }
            else {
                var pEle = document.getElementById("phoneMsg");
                if (pEle) { 
                    pEle.innerHTML = "Invalid phone number!";
                    alert("Invalid phone number!");
                    pEle.classList.remove("valid");
                    pEle.classList.add("invalid");
                }

                return false;
            }
        }
        else {
            var pEle = document.getElementById("phoneMsg");
            if (pEle) { 
                pEle.innerHTML = "Invalid phone number!";
                alert("Invalid phone number!");
                pEle.classList.remove("valid");
                pEle.classList.add("invalid");
            }

            return false;
        }
    }
}