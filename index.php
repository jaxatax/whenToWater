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
		</div>
		
		<script>
			getWeather();
		</script>
	</body>
</html>