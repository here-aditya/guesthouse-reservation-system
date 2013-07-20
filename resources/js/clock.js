function currentDate()
{
	var currentTime = new Date ( );
	var currentYear = currentTime.getFullYear();
	var currentMonth = currentTime.getMonth();
	var currentDate = currentTime.getDate();
	var monthList = new Array("January","February","March","April","May","June","July","August","September","October","November","December");
	return(currentDate + '-' + monthList[currentMonth] + '-' + currentYear);
}

function currentTime( )
{
	var currentTime = new Date ( );
	var currentHours = currentTime.getHours ( );
	var currentMinutes = currentTime.getMinutes ( );
	var currentSeconds = currentTime.getSeconds ( );
	// Pad the minutes and seconds with leading zeros, if required
	currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
	currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
	// Choose either "AM" or "PM" as appropriate
	var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";
	// Convert the hours component to 12-hour format if needed
	currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;
	// Convert an hours component of "0" to "12"
	currentHours = ( currentHours == 0 ) ? 12 : currentHours;
	// Compose the string for display
	return(currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay);
}

function startTime() {
		currentTimeString = currentDate() + ', ' + currentTime();
		$('#disp_clock').text(currentTimeString);
}
	
setInterval('startTime()', 1000);
$('#login_time').text('Logged Since: ' + currentTime());