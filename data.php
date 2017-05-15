<?php
	
	$searchOptionHist = array('suburb'=>'', 'park'=>'', 'min rating'=>'');
	
	$pdo = new PDO('mysql:host=localhost;dbname=parks', 'parkReader', 'zzs123456');
	
	function setSearchOptionHist($fields) {
		global $searchOptionHist;
		
		if ($fields['suburb'] != "") $searchOptionHist['suburb'] = $fields['suburb'];
		if ($fields['park'] != "") $searchOptionHist['park'] = $fields['park'];
		if ($fields['min rating'] != "") $searchOptionHist['min rating'] = $fields['min rating'];
	}
	
	function createSuburbOptions() {
		global $searchOptionHist;
		global $pdo;
		
		$suburbs = $pdo->query('SELECT Suburb FROM parks GROUP BY Suburb ORDER BY Suburb;');
		
		if ($searchOptionHist['suburb'] == '') {
			echo '<option value="" disabled selected >Select a suburb</option>';
			
			foreach ($suburbs as $suburb) {
				echo '<option value="'. $suburb['Suburb'] .'">'. $suburb['Suburb'] .'</option>';
			}
		}
		else {
			foreach ($suburbs as $suburb) {
				echo '<option value="'. $suburb['Suburb'];
				if ($suburb == $searchOptionHist['suburb']) echo ' selected';
				echo '">'. $suburb['Suburb'] .'</option>';
			}
		}
	}
	
	function createNameOptions() {
		global $searchOptionHist;
		global $pdo;
		
		$names = $pdo->query('SELECT Name FROM parks ORDER BY Name;');
		
		if ($searchOptionHist['park'] == '') {
			echo '<option value="" disabled selected >Select a park</option>';
			
			foreach ($names as $name) {
				echo '<option value="'. $name['Name'] .'">'. $name['Name'] .'</option>';
			}
		}
		else {
			foreach ($names as $name) {
				echo '<option value="'. $name['Name'];
				if ($name == $searchOptionHist['Name']) echo ' selected';
				echo '">'. $name['Name'] .'</option>';
			}
		}
	}
	
	function createRatingOptions() {
		global $searchOptionHist;
		
		//echo '<option value="" disabled selected >Select a min rating</option>';
		
		for ($rate = 0; $rate <= 5; $rate += 0.5) {
			echo '<option value="'. $rate;
			if ($rate == $searchOptionHist['min rating']) ' selected';
			echo '">'. $rate .'</option>';
		}
	}
	
?>