<?php
	
	//$pdo = new PDO('mysql:host=localhost;dbname=n9674985', 'n9674985', 'zzs123456');
	$pdo = new PDO('mysql:host=localhost;dbname=parks', 'parkReader', 'zzs123456');
	
	function getDistance($lat1, $lon1, $lat2, $lon2) {
		$R = 6371;
		$dLat = deg2rad($lat2 - $lat1);
		$dLon = deg2rad($lon2 - $lon1);
		$a = sin($dLat / 2) * sin($dLat / 2) +
			cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * 
			sin($dLon / 2) * sin($dLon / 2);
		$c = 2 * atan2(sqrt($a), sqrt(1-$a)); 
		$d = $R * $c;
		
		return $d;
	}
	
	function getNearParksId() {
		global $pdo;
		$allParks = $pdo->query('SELECT id, Latitude, Longitude FROM parks ORDER BY Name;');
		$ids = array();
		
		foreach ($allParks as $park) {
			if (getDistance($park['Latitude'], $park['Longitude'], $_GET['lat'], $_GET['lon']) <= 2) array_push($ids, $park['id']);
		}
		
		return $ids;
	}
	
	function getResults() {
		global $pdo;
		
		if (isset($_GET['lat']) && isset($_GET['lat'])) {
			$ids = getNearParksId();
			$results = array();
			foreach ($ids as $id) {
				$rawResult = $pdo->query('SELECT id, Name, Suburb, Street, Latitude, Longitude FROM parks WHERE parks.id = '. $id. ' ORDER BY Name;');
				foreach ($rawResult as $result) {
					array_push($results, $result);
				}
			}
		}
		else if (isset($_GET['parkId'])) {
			if (!empty($_GET['parkId'])) $results = $pdo->query('SELECT id, Name, Suburb, Street, Latitude, Longitude FROM parks WHERE parks.id = '. $_GET['parkId']. ' ORDER BY Name;');
			else if (isset($_GET['suburb'])) {
				$results = $pdo->query('SELECT id, Name, Suburb, Street, Latitude, Longitude FROM parks WHERE parks.Suburb = \''. $_GET['suburb']. '\' ORDER BY Name;');
			}
		}
		else {
			$results = $pdo->query('SELECT id, Name, Suburb, Street, Latitude, Longitude FROM parks ORDER BY Name;');
		}
		
		return $results;
	}
	
	function getNumResults() {
		$results = getResults();
		$counter = 0;
		
		foreach ($results as $result) {
			$counter++;
		}
		
		return $counter;
	}
	
	function showNumResults() {
		$num = getNumResults();
		if ($num > 1) echo '<span>There are '. $num .' results:</span>';
		else if ($num == 1) echo '<span>There is '. $num .' result:</span>';
		else echo '<span>There is no result</span>';
	}
	
	function createResults() {
		$results = getResults();
		
		if (count($results) != 0) {
			echo '<tr>';
			echo '<th>Park Name</th>';
			echo '<th>Suburb</th>';
			echo '<th>Street</th>';
			echo '<th>Distance</th>';
			echo '</tr>';
		
			foreach ($results as $result) {
				$lat = $result['Latitude'];
				$lon = $result['Longitude'];
				
				if (isset($_GET['opLat']) && isset($_GET['opLon'])) {
					if (!empty($_GET['opLat']) && !empty($_GET['opLon'])) $dist = round(getDistance($lat, $lon, $_GET['opLat'], $_GET['opLon']), 3).' km';
					else $dist = 'N/A'; 
				}
				else if (isset($_GET['lat']) && isset($_GET['lon'])) {
					if (!empty($_GET['lat']) && !empty($_GET['lon'])) $dist = round(getDistance($lat, $lon, $_GET['lat'], $_GET['lon']), 3).' km';
					else $dist = 'N/A'; 
				}
				else $dist = 'N/A';
				
				echo '<tr class="corRows" id="'. $lat .','. $lon .'">';
				echo '<td class="parks" id="'. $result['Name'] .','. $result['id'] .'"><a href="item.php?id='. $result['id'] .'&distance='. $dist .'&lat='. $lat .'&lon='. $lon .'">'. $result['Name'] .'</a></td>';
				echo '<td class="suburbs" id="'. $result['Suburb'] .'">'. $result['Suburb'] .'</td>';
				echo '<td class="streets" id="'. $result['Street'] .'">'. $result['Street'] .'</td>';
				echo '<td class="distances" id="'. $dist .'">'. $dist .'</td>';
				echo '</tr>';
			}
		}
		else {
			echo '<span>No park is found</span>';
		}
	}
	
?>

<!DOCTYPE html>
<html>

	<head>
	
		<link href="style.css" rel="stylesheet" type="text/css"/>
		<link href="resStyle.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="script.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6gFjy8jz6k01nXpBTFU7HBZR02TXNK1Y&callback=mapForRes"></script>
		
		<style>
		
		body {
			height: 100%;
			padding: 0px;
			margin: 0px;
		}
		
		</style>
	
	</head>
	
	<body onload="mapForRes();">
	
		<div id="wrapper">
		
			<div id="header">
				Park Locator
			</div>
			
			<div id="menu">
				<a href="home.php">Home</a>
				<a class= "active" href="search page.php">Search</a>
				<a href="">Login</a>
				<a href="Registration.html">Register</a>
			</div>
			
			<div id = "contentres">
				<div id="mapres"></div>
				
				<div id="results">
				<p>Results</p>
				<?php showNumResults(); ?>
				<br>
				<div id="resultsTable">
				<table>
					<?php
						createResults();
					?>
				</table>
				</div>
				
				<button onclick="javascript:window.location.href='search page.php'">Search again</button>
				</div>
			</div>
			
			<div id="footer">
				
			</div>
		
		</div>
	
	</body>
	
</html>