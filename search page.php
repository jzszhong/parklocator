<?php
	
	//$pdo = new PDO('mysql:host=localhost;dbname=n9674985', 'n9674985', 'zzs123456');
	$pdo = new PDO('mysql:host=localhost;dbname=parks', 'parkReader', 'zzs123456');
	
	function createSuburbOptions() {
		global $pdo;
		
		$suburbs = $pdo->query('SELECT Suburb FROM parks GROUP BY Suburb ORDER BY Suburb;');
		
		if (!isset($_GET['suburb'])) {
			echo '<option value="" selected>Select a suburb</option>';
			
			foreach ($suburbs as $suburb) {
				echo '<option value="'. $suburb['Suburb'] .'">'. $suburb['Suburb'] .'</option>';
			}
		}
		else {
			foreach ($suburbs as $suburb) {
				echo '<option value="'. $suburb['Suburb'] .'"';
				if ($suburb['Suburb'] == $_GET['suburb']) echo ' selected';
				echo '>'. $suburb['Suburb'] .'</option>';
			}
		}
	}
	
	function createNameOptions() {
		global $pdo;
		
		$names = $pdo->query('SELECT id, Suburb, Name FROM parks ORDER BY Name;');
		
		if (!isset($_GET['parkId'])) {
			echo '<option value="" selected>Select a park</option>';
			
			foreach ($names as $name) {
				echo '<option value="'. $name['id'] .'" class="'. $name['Suburb'] .'">'. $name['Name'] .'</option>';
			}
		}
		else {
			foreach ($names as $name) {
				echo '<option value="'. $name['id'] .'" class="'. $name['Suburb'] .'"';
				if ($name['id'] == $_GET['parkId']) echo ' selected';
				echo '>'. $name['Name'] .'</option>';
			}
		}
	}
	
	function createRatingOptions() {
		if (!isset($_GET['min rating'])) {
			echo '<option value="" selected>Select a min rating</option>';
			
			for ($rate = 0; $rate <= 5; $rate += 0.5) {
				echo '<option value="'. $rate .'"';
				echo '>'. $rate .'</option>';
			}
		}
		else {
			for ($rate = 0; $rate <= 5; $rate += 0.5) {
				echo '<option value="'. $rate .'"';
				if ($rate == $_GET['min rating']) ' selected';
				echo '>'. $rate .'</option>';
			}
		}
	}
	
	function print_get() {
		if (isset($_GET['lat'])) {
			echo '<p>'.$_GET['suburb'].'</p>';
		}
	}
	
?>

<!DOCTYPE html>
<html>

	<head>
	
		<link href="style.css" rel="stylesheet" type="text/css"/>
		<link href="searchStyle.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="script.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6gFjy8jz6k01nXpBTFU7HBZR02TXNK1Y&callback=defaultMap"></script>
		
		<style>
		
		body {
			height: 100%;
			padding: 0px;
			margin: 0px;
		}
		
		</style>
	
	</head>
	
	<body onload="defaultMap(); getLocation();">
	
		<div id="wrapper">
		
			<div id="header">
				Park Locator
			</div>
			
			<div id="menu">
				<a href="">Home</a>
				<a class= "active" href="">Search</a>
				<a href="">Login</a>
				<a href="Registration.html">Register</a>
			</div>
			
			<div id="main">
				<div id="map"></div>
				
				<div id="search">
					<p id="searchTitle">Search for a park:</p>
					
					<form method="get" action="processSearch.php">
					<div id="location">
						<p>Your Location is: </p>
						<p id="status"></p>
						<input type="text" name="lat" hidden>
						<input type="text" name="lon" hidden>
					</div>
					
					<input type="submit" name="search near parks" value="Search near parks" disabled>
					</form>
					<br>
					<br>
					<span>or</span>
					
					<form name="searchForm" onsubmit="return (searchValidation());" action="processSearch.php" method="get">
					<fieldset>
					<legend id="searchSubTitle">Search by options:</legend>
						<select name="suburb" onchange="hideUnmatchedParkOptions();">
							<?php
								createSuburbOptions();
							?>
						</select>
						<br>
						<select name="parkId" onchange="hideUnmatchedSuburbOptions();">
							<?php
								createNameOptions();
							?>
						</select>
						<br>
						<select name="min rating">
							<?php
								createRatingOptions();
							?>
						</select>
						<br><br>
						<input type="submit" value="Search">
					</fieldset>
					</form>
				</div>
			</div>
			
			<div id="footer">
				
			</div>
		
		</div>
	
	</body>
	
</html>