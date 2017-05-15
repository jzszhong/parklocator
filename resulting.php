<?php
	
	require 'data.php';
	
	function validateSearchOptions($fields) {
		if ($fields['suburb'] == "" && $fields['park'] == "" && $fields['min rating'] == "") return false;
		else return true;
	}
	
	if (isset($_GET['suburb']) && isset($_GET['park']) && isset($_GET['min rating'])) {
		if (validateSearchOptions($_GET)) {
			if ($_GET['park'] != "") {
				include 'item.php';
			}
			else {
				include 'results.php';
			}
		}
		else {
			setSearchOptionHist($_GET);
			include 'search page.php';
		}
	}
	else {
		include 'search page.php';
	}
	
?>