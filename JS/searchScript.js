// Get the geolocation of the user
function getLocation() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition, showError);
	} else {
		document.getElementById("status").innerHTML="Geolocation is not supported by this browser.";
	}
}

// Address the location coordination of the user
function showPosition(position) {
	// Show the user's location in a map
	mapForSearch(position.coords.latitude, position.coords.longitude);
	// Transfer the location geolocation to be actual address
	getAddress(position.coords.latitude, position.coords.longitude);
	
	// Write the coordination data to html so that it can be send to display results
	document.getElementsByName("lat")[0].value = position.coords.latitude;
	document.getElementsByName("lon")[0].value = position.coords.longitude;
	document.getElementsByName("opLat")[0].value = position.coords.latitude;
	document.getElementsByName("opLon")[0].value = position.coords.longitude;
	
	// Enable the "Search near parks" button only when location is obtained
	enableSearchNearParksButton();
}

// Enable the button to search near parks
function enableSearchNearParksButton() {
	var button = document.getElementsByName("search near parks")[0];
	button.disabled = false;
	button.style.backgroundColor = "#31FF98";
}

// The map displayed before location is gotten
function defaultMap() {
	// Display a map centred with Brisbane city's coordination
	var lat = -27.46967;
	var lon = 153.02508;
	
	var mapCanvas = document.getElementById("map");
	var mapProp = {center:new google.maps.LatLng(lat, lon), zoom:13};
	var map = new google.maps.Map(mapCanvas,mapProp);
}

// The map used to display user's location in search page
function mapForSearch(lat, lon) {
	var mapCanvas = document.getElementById("map");
	var mapProp = {center:new google.maps.LatLng(lat, lon), zoom:13};
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

// Show the error message when it is unable to obtain users' locations
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

// Check if the search options form is valid
function searchValidation() {
	var valid;
	var suburb = document.getElementsByName("suburb")[0];
	var park = document.getElementsByName("park")[0];
	var minRating = document.getElementsByName("rating")[0];
	
	// It is invalid when none of the option fields is filled
	if (suburb.value == "" && park.value == "" && minRating.value == "") {
		window.alert("You at least need to select one of the options to search");
		valid = false;
	}
	else valid = true;
	
	return valid;
}