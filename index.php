<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<title>When to Water?</title>
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
		<link href="style.css" rel="stylesheet" type="text/css" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/twilio.js/1.2.0/twilio.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	</head>
	<body>
		<script src="script.js"></script>
		
		<!--
		<form onsubmit="console.log('it worked')" method="POST">
			<input id="phoneNumber" name="phoneNumber" type="text" placeholder="Input your phone number." size="25" maxlength="50" onblur="checkPhoneNumber(this)" required="required"/>
			<p id="phoneMsg"></p>
			<input type="submit" value="Submit Form" class="font" id="buttons">
		</form>
		-->
		
		<h1>When to Water?</h1>
		<br>
		<br>
		<div class="centerMe">
			<input id="phoneNumber" type="text" placeholder="Enter phone number"/>
			<p id="phoneMsg"></p>
			<br>
			<br>
			<button onclick="checkPhoneNumber()">Submit Number</button>
			<br>
			<br>
			<br>
			<br>
			<p id="date" class="info"></p>
			<p id="weather" class="info"></p>
			<!--
			<button onclick='var water="Water your garden!"; var phoneNumbers = JSON.stringify(phoneNumberArray); window.location.href = "send_sms.php?water="+water+"&phoneNumbers="+phoneNumbers'>Text Me!</button>
			-->
			
			
			
		</div>
		
		<script>
			getWeather();
			
			// variable initialization and changing the time and date on the page
			var daysOfTheWeek = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
			var monthsOfTheYear = ["January","February","March","April","May","June","July","August","September","October","November","December"];
			var currentDate = new Date();
			if (currentDate.getMinutes() < 10) {
				var minutes = "0" + currentDate.getMinutes().toString();
			} else {
				var minutes = currentDate.getMinutes().toString();
			}
			if (currentDate.getHours() > 12) {
				var currentTime = (currentDate.getHours() - 12).toString() + ":" + minutes + "pm";
			} else if (currentDate.getHours() == 0) {
				var currentTime = "12:" + minutes + "am";
			} else {
				var currentTime = currentDate.getHours().toString() + ":" + minutes + "am";
			}
			document.getElementById("date").innerHTML = "It's " + currentTime + " on " + daysOfTheWeek[currentDate.getDay()] + ", " + monthsOfTheYear[currentDate.getMonth()] + " " + currentDate.getDate().toString() + ", " + currentDate.getFullYear().toString() + ".";
			
			var phoneNumberArray = [];
			
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
			
			// correct time is 2:59
			function checkIfCorrectTime() {
				currentDate = new Date();
				if (currentDate.getMinutes() < 10) {
					var minutes = "0" + currentDate.getMinutes().toString();
				} else {
					var minutes = currentDate.getMinutes().toString();
				}
				if (currentDate.getHours() > 12) {
					var currentTime = (currentDate.getHours() - 12).toString() + ":" + minutes + "pm";
				} else if (currentDate.getHours() == 0) {
					var currentTime = "12:" + minutes + "am";
				} else {
					var currentTime = currentDate.getHours().toString() + ":" + minutes + "am";
				}
				document.getElementById("date").innerHTML = "It's " + currentTime + " on " + daysOfTheWeek[currentDate.getDay()] + ", " + monthsOfTheYear[currentDate.getMonth()] + " " + currentDate.getDate().toString() + ", " + currentDate.getFullYear().toString() + ".";
				if ((currentDate.getHours() == 2) && (currentDate.getMinutes() == 59)) {
					return(true);
				} else {
					return(false);
				}
			}
			
			
			// 21600000ms = 6hrs
			window.setInterval(function(){
				getWeather();
				if (checkIfCorrectTime()){
					if (wateringNeeded){
						wateringText = "Water your garden!";
					} else {
						wateringText = "Don't water your garden!";
					}
					window.setTimeout(function(){
						var phoneNumbers = JSON.stringify(phoneNumberArray);
						window.location.href = "send_sms.php?water="+wateringText+"&phoneNumbers="+phoneNumbers;
					},21600000);
				}
			},60000);
			
		</script>
	</body>
</html>