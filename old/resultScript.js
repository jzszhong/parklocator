// Display a map for results page
function mapForRes(lat, lon) {
	//Set the map with Brisbane city's centre as centre coordination
	var centerlat = lat;
	var centerlng = lon;
	var myCenter = new google.maps.LatLng(centerlat,centerlng);
	//set the map into the div with id "mapres"
	var mapCanvas = document.getElementById("mapres");
	var mapOptions = {center: myCenter, zoom: 11};
	var map = new google.maps.Map(mapCanvas, mapOptions);
	
	// Get all needed infomation of each result from html so that they can be displayed for markers in the map
	var rawLatLon = document.getElementsByClassName("corRows");
	var rawParks = document.getElementsByClassName("parks");
	var rawSuburbs = document.getElementsByClassName("suburbs");
	var rawStreets = document.getElementsByClassName("streets");
	var rawDists = document.getElementsByClassName("distances");
	
	// Set up markers of results in the map
	var markers = new Array(rawLatLon.length);
	for (var i = 0; i < rawLatLon.length; i++) {
		var lati = (rawLatLon[i].id.split(","))[0];
		var longi = (rawLatLon[i].id.split(","))[1];
		var park = {lat: lati * 1, lng: longi * 1};
		var name = (rawParks[i].id.split(","))[0];
		var id = (rawParks[i].id.split(","))[1];
		var suburb = rawSuburbs[i].id;
		var street = rawStreets[i].id;
		var dist = rawDists[i].id
		var url = "item.php?id=" + id + "&distance=" + dist + "&lat=" + lati + "&lon=" + longi;
		// Initialize markers
		markers[i] = new google.maps.Marker({
			position:park,
			// Set up infromation of result in markers
			title:("Name: " + name + '\n' + "Suburb: " + suburb + '\n' + "Street: " + street + '\n' + "Distance: " + dist)
		});
		markers[i].setMap(map);
		// Set up the link to the marker so that they can be clicked to direct to corresponding item page
		function attachURL(marker, url) {
			marker.addListener('click', function() {
				window.location.href=url;
			});
		}
		attachURL(markers[i], url);
	}
}