/*
function getDistance(lat1, lon1, lat2. lon2) {
	var R = 6371e3; // metres
	var l1 = lat1.toRadians();
	var l2 = lat2.toRadians();
	var latDiff = (lat2-lat1).toRadians();
	var lonDiff = (lon2-lon1).toRadians();

	var a = Math.sin(latDiff/2) * Math.sin(latDiff/2) +
			Math.cos(l1) * Math.cos(l2) *
			Math.sin(lonDiff/2) * Math.sin(lonDiff/2);
	var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));

	var d = R * c;
	
	document.getElementById("distance").innerHTML = d + " m";
}
*/