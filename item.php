<?php
	
	//$pdo = new PDO('mysql:host=localhost;dbname=n9674985', 'n9674985', 'zzs123456');
	$pdo = new PDO('mysql:host=localhost;dbname=parks', 'parkReader', 'zzs123456');
	
	function createItem() {
		global $pdo;
		
		$parkId = $_GET['id'];
		$results = $pdo->query('SELECT id, Name, Suburb, Street, Latitude, Longitude FROM parks WHERE id = '. $parkId .' ORDER BY Name;');
		
		foreach ($results as $result) {
			echo '<p>'. $result['Name'] .'</p>';
			//echo '<div id="itemMap"></div>';
			echo '<table>';
			echo '<tr><th>Suburb</th><td>'. $result['Suburb'] .'</td></tr>';
			echo '<tr><th>Street</th><td>'. $result['Street'] .'</td></tr>';
			echo '<tr><th>Distance</th><td>'. $_GET['distance'] .' km</td></tr>';
			echo '<tr><th>Average rating</th><td></td></tr>';
			echo '</table>';
		}
	}
	
?>

<!DOCTYPE html>
<html>

	<head>
	
		<link href="style.css" rel="stylesheet" type="text/css"/>
		<link href="itemStyle.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="script.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6gFjy8jz6k01nXpBTFU7HBZR02TXNK1Y&callback=mapForItem"></script>
		
		<style>
		
		body {
			height: 100%;
			padding: 0px;
			margin: 0px;
		}
		
		</style>
	
	</head>
	
	<body>
	
		<div id="wrapper">
		
			<div id="header">
				Park Locator
			</div>
			
			<div id="menu">
				<a href="">Home</a>
				<a class= "active" href="search page.html">Search</a>
				<a href="">Login</a>
				<a href="Registration.html">Register</a>
			</div>
			
			<div id="main">
				<div id="reviews">
					<p>Reviews</p>
					
					<div id="reviewsContent">
						<div>
						<h4>User: laens464 &nbsp &nbsp &nbsp &nbsp Rating: 4 / 5</h4>
						This is a nice park!
						</div>
						<div>
						<h4>User: rrrrs0 &nbsp &nbsp &nbsp &nbsp Rating: 3 / 5</h4>
						The park is fine.
						</div>
						<div>
						<h4>User: jmie_dsd &nbsp &nbsp &nbsp &nbsp Rating: 3.5 / 5</h4>
						Good environment.
						</div>
					</div>
					
					<div id="comment">
						<textarea name="comment" placeholder="Enter your review here"></textarea>
						<br>
						<div id="rating">
							<button onclick="reviewValidation();">Send</button>
							<span>Your rating to this park: </span>
							<select name="rate">
								<option value="" disabled selected hidden></option>
								<option value="0">0</option>
								<option value="0">0.5</option>
								<option value="0">1</option>
								<option value="0">1.5</option>
								<option value="0">2</option>
								<option value="0">2.5</option>
								<option value="0">3</option>
								<option value="0">3.5</option>
								<option value="0">4</option>
								<option value="0">4.5</option>
								<option value="0">5</option>
							</select>
							<span> / 5</span>
						</div>
					</div>
				</div>
				
				<div id="item">
					<?php createItem(); ?>
					<br>
					<button onclick="javascript:window.history.back();">Go back</button>
				</div>
			</div>
			
			<div id="footer">
				
			</div>
		
		</div>
	
	</body>
	
</html>