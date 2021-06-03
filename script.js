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

// function to check if the form data is valid
function checkFormData() {
  var correct = true;

  var phoneError = document.getElementById("phoneMsg");

  // check phone number and get rid of extra characters
  var phonenumEle = document.getElementById("phoneNumber");
  if(phonenumEle){					
    var phonenumValue = phonenumEle.value;
    var phonenumCleaned = phonenumValue.replace(/\D/g, "");
    var phonenumMatch = phonenumValue.match(/\d/g);
    if (phonenumMatch) {
      if(phonenumMatch.length===10) {
        var firstPart = phonenumCleaned.substr(0, 3);
        var secondPart = phonenumCleaned.substr(3, 3);
        var thirdPart = phonenumCleaned.substr(6, 4);
        var newNum = firstPart + secondPart + thirdPart;
        if (phoneError) { 
          phoneError.innerHTML = "";
          phoneError.classList.remove("invalid");
        }	
        phoneNumberArray.push(newNum);
      } else {
        var phoneError = document.getElementById("phoneMsg");
        if (phoneError) { 
          phoneError.innerHTML = "Invalid phone number!";
          // alert("Invalid phone number!");
          phoneError.classList.remove("valid");
          phoneError.classList.add("invalid");
          correct = false;
        }
      }
    }
    else {
      var phoneError = document.getElementById("phoneMsg");
      if (phoneError) { 
        phoneError.innerHTML = "Invalid phone number!";
        // alert("Invalid phone number!");
        phoneError.classList.remove("valid");
        phoneError.classList.add("invalid");
        correct = false;
      }
    }
  }

  // check zip code entered
  var zip = document.getElementById("zipCode");
  var zipError = document.getElementById("zipMsg");
  if (!/(^\d{5}$)|(^\d{5}-\d{4}$)/.test(zip.value)) {
    zipError.innerHTML = "Invalid zip code!";
    // alert("Invalid zip code!");
    correct = false;
  } else {
    zipError.innerHTML = "";
  }

  // check time entered
  var time = document.getElementById("textTime");
  var timeError = document.getElementById("timeMsg");
  if (time.value == "") {
    timeError.innerHTML = "Please select a time!";
    correct = false;
  }

  if (correct) {
    // send data to server and redirect user
    window.location = "index.html";
  }
}