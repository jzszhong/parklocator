function getLocation() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition, showError);
	} else {
		document.getElementById("status").innerHTML="Geolocation is not supported by this browser.";
	}
}

function showPosition(position) {
	mapForSearch(position.coords.latitude, position.coords.longitude);
	getAddress(position.coords.latitude, position.coords.longitude);
	
	enableSearchNearParksButton();
}

function enableSearchNearParksButton() {
	var button = document.getElementsByName("search near parks")[0];
	button.disabled = false;
	button.style.backgroundColor = "#31FF98";
}

// The map displayed before location is gotten
function defaultMap() {
	var lat = -27.46967;
	var lon = 153.02508;
	
	var mapCanvas = document.getElementById("map");
	var mapProp = {center:new google.maps.LatLng(lat, lon), zoom:15};
	var map = new google.maps.Map(mapCanvas,mapProp);
}

// The map used to display user's location in search page
function mapForSearch(lat, lon) {
	var mapCanvas = document.getElementById("map");
	var mapProp = {center:new google.maps.LatLng(lat, lon), zoom:15};
	var map = new google.maps.Map(mapCanvas,mapProp);
	
	var markerPosition = {lat:lat, lng:lon};
	var marker = new google.maps.Marker({position: markerPosition});
	marker.setMap(map)
}

// Transfer the location to be an address and display it
function getAddress(lat, lon) {
            var latlng = new google.maps.LatLng(lat, lon);
            var geocoder = geocoder = new google.maps.Geocoder();
            geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[1]) {
                        document.getElementById("status").innerHTML = results[1].formatted_address;
                    }
                }
            });
}

function showError(error) {
	var msg = "";
	switch(error.code) {
		case error.PERMISSION_DENIED:
			msg = "User denied the request for Geolocation."
			break;
		case error.POSITION_UNAVAILABLE:
			msg = "Location information is unavailable."
			break;
		case error.TIMEOUT:
			msg = "The request to get user location timed out."
			break;
		case error.UNKNOWN_ERROR:
			msg = "An unknown error occurred."
			break;
	}
	document.getElementById("status").innerHTML = msg;
}

function searchValidation() {
	var valid;
	var suburb = document.getElementsByName("suburb")[0];
	var park = document.getElementsByName("park")[0];
	var minRating = document.getElementsByName("min rating")[0];
	
	if (suburb.value == "" && park.value == "" && minRating.value == "") {
		window.alert("You at least need to select one of the options to search");
		valid = false;
	}
	else valid = false;
	
	return valid;
}

function reviewValidation() {
	var valid;
	var comment = document.getElementsByName("comment")[0];
	var rate = document.getElementsByName("rate")[0];
	
	if (comment.value == "") {
		window.alert("You cannot send an empty review!");
		valid = false;
	}
	else if (rate.value == "") {
		window.alert("You have to give a rating!");
		valid = false;
	}
	else valid = true;
	
	return valid;
}


//the following functions check the validity of each field
function checkFirstName(form){
//if the field is empty, make the error message visible and return false
		if (form.firstName.value == ""){
			document.getElementById("firstNameMissing").style.visibility = "visible";
			return false;
		}
		return true;	
}
function checkLastName(form){
	
		if (form.lastName.value == ""){
			document.getElementById("surnameMissing").style.visibility = "visible";
			return false;
		}
		return true;
}
function checkUsername(form){
	
		if (form.username.value == ""){
			document.getElementById("usernameMissing").style.visibility = "visible";
			return false;
		}
		return true;
}

function checkEmail(form){
	var x = form.email.value;
	var atpos = x.indexOf("@");
	//checks if an @ symbol is present in the email address, and that it isnt the first character if it is present
	if (atpos<1){
		document.getElementById("emailMissing").style.visibility = "visible";
		return false;
	}
	return true;
		
}	
function checkPassword(form){
	
		if (form.password.value == ""){
			document.getElementById("passwordMissing").style.visibility = "visible";
			return false;
		}
		return true;
}

function checkPasswordConfirm(form){
	
		if (form.passwordConfirm.value == ""){
			document.getElementById("passwordConfirmMissing").style.visibility = "visible";
			return false;
		}
		return true;
}

function checkPasswordMatch(form){
//checks if the passwords match, sends an alert to the browser if they don't
		if (form.password.value != form.passwordConfirm.value){
			window.alert("passwords must match");
			return false;
		}
		return true;
}

function checkDateofBirth(form){
	
		if (form.dateofBirth.value == ""){
			document.getElementById("dateofbirthMissing").style.visibility = "visible";
			return false;
		}
		return true;
}
//determines if a entered value is a number
function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
  //isNaN (Not a number) checks if a value is a number or not. Returns true if Not a number, so use ! to invert (return true if is a number)
  //parseFloat is used to parse a string and return a float
  //is finite checks if a value is a finite number-makes the function more robust
}

function checkPostcode(form){
		var v = true
		//checks if the postcode has 4 characters
		if (form.postCode.value.length < 4){
			document.getElementById("postcodeMissing").style.visibility = "visible";
			v = false;
		}
		//checks if the postcode entered is a number
		if (isNumber(form.postCode.value) == false){
			document.getElementById("postcodeMissing").style.visibility = "visible";
			v = false;
		}
		return v;
}

function checkCheckBox() {
	var box = document.getElementsByName("Privacy")[0];
	
	if (!box.checked) {
		window.alert("Terms and conditions must be agreed to register");
		return false;
	}
	else return true;
}




// this function takes a field name as its input, and is executed when each field is changed. It is used to hide the error messages.

function CheckChange(field){
		document.getElementById(field + "Missing").style.visibility = "hidden";


}





//calls all of the above listed functions. If any of the individual checks fails, the variable is set to false. However, all other fields are also checked regardless of if one has failed.
function RegValidateForm(form) {
		var valid = true;
		//declares a variable to hold the status of the form (true or false) This way if one check fails, the variable is set to false, however all checks are still carried out
		
		if (checkFirstName(form) == false){
			valid = false;
		}
		if (checkPasswordMatch(form) == false){
			valid = false;
		}
		if (checkLastName(form) == false){
			valid = false;
		}	
		if (checkEmail(form) == false){
			valid = false;
		}
		if (checkUsername(form) == false){
			valid = false;
		}
		
		if(checkPassword(form) == false){
			valid = false;
		}
		
		if(checkPasswordConfirm(form) == false){
			valid = false;
		}
		
		if(checkDateofBirth(form) == false){
			valid = false;
		}
		
		if(checkPostcode(form) == false){
			valid = false;
		}
		
		if (!valid) window.alert("Please fill in all required contents!");
		else {
			if (checkCheckBox() == false) valid = false;
		}
		
		return valid;
}


//uses the google maps API
function ResmyMap(){
			//declaring variables containing the coordinates for both the centre, and the hard coded parks
			  var centerlat = -27.495612;
			  var centerlng = 153.011489;
			  var park1 = {lat: -27.498948, lng: 153.003280};
			  var park2 = {lat: -27.499186, lng: 153.007754};
			  var park3 = {lat: -27.493502, lng: 153.001372};
			  var myCenter = new google.maps.LatLng(centerlat,centerlng);
			  //set the map into the div with id "mapres"
			  var mapCanvas = document.getElementById("mapres");
			  var mapOptions = {center: myCenter, zoom: 15};
			  var map = new google.maps.Map(mapCanvas, mapOptions);
			  var marker = new google.maps.Marker({position:park1});
			  marker.setMap(map)
			  var marker = new google.maps.Marker({position:park2});
			  marker.setMap(map);
			  var marker = new google.maps.Marker({position:park3});
			  marker.setMap(map);
			}	