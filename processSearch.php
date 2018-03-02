<?php
	
	// Check if any of the necessary fields is set
	if ((isset($_GET['lat'])) || (isset($_GET['lon'])) || (isset($_GET['suburb'])) || isset($_GET['park']) || isset($_GET['min rating'])) {
		include 'results.php';
	}
	else {
		include 'search page.php';
	}
	
?>