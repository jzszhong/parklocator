// The map displayed in item page
function mapForItem(lati, longi) {
	// Set the centre coordination to be the item's location
	var centerlat = lati;
	var centerlng = longi;
	
	var myCenter = new google.maps.LatLng(centerlat,centerlng);
	var mapCanvas = document.getElementById("itemMap");
	var mapOptions = {center: myCenter, zoom: 14};
	var map = new google.maps.Map(mapCanvas, mapOptions);
	
	// Set up a marker for the item
	var park = {lat: centerlat, lng: centerlng};
	var marker = new google.maps.Marker({position:park});
	marker.setMap(map);
}