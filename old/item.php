<?php
//JASONS
	session_start();
	//$pdo = new PDO('mysql:host=localhost;dbname=n9674985', 'n9674985', 'zzs123456');
	//$pdo = new PDO('mysql:host=localhost;dbname=assignment1', 'min', 'Secret!');
	$pdo = new PDO('mysql:host=localhost;dbname=parks', 'parkReader', 'zzs123456');
	
	$_SESSION["park id"] = $_GET['id'];
	
	function showReviews() {
		global $pdo;
		$results = $pdo->query('SELECT * FROM parks.reviews WHERE itemid = '. $_GET['id'] .';');
		
		if (count($results) == 0) echo '<h3>No review for this park yet</h3>';
		else {
			foreach ($results as $result) {
				echo '<div>';
				echo '<h4>User: '. $result['username'] .' &nbsp &nbsp &nbsp &nbsp Rating: '. $result['rating'] .' / 5</h4>';
				echo $result['review'];
				echo '</div>';
			}
		}
	}
	
	// Calculate the average rating of an item
	function getRating($id) {
		global $pdo;
		$ratings = $pdo->query('SELECT rating FROM parks.reviews WHERE itemid = '. $id .';');
		$numRatings = count($ratings);
		
		if ($numRatings == 0) return 0;
		else {
			$rates = 0;
			foreach ($ratings as $rating) {
				$rates += $rating['rating'];
			}
			return ($rates / $numRatings);
		}
	}
	
	// Create the item information in html as a table
	function createItem() {
		global $pdo;
		
		$parkId = $_GET['id'];
		
		$results = $pdo->query('SELECT id, Name, Suburb, Street, Latitude, Longitude FROM parks WHERE id = '. $parkId .' ORDER BY Name;');
		
		foreach ($results as $result) {
			echo '<p><span itemprop="name">'. $result['Name'] .'</span></p>';
			echo '<div id="itemMap"></div>';
			echo '<table>';
			echo '<tr><th>Suburb</th><td><span itemprop="address">'. $result['Suburb'] .'</span></td></tr>';
			echo '<tr><th>Street</th><td>'. $result['Street'] .'</td></tr>';
			echo '<tr><th>Distance</th><td>'. $_GET['distance'] .'</td></tr>';
			echo '<tr><th>Average rating</th><td>'. getRating($parkId) .'</td></tr>';
			echo '</table>';
		}
	}
	
	// Write the onload statement to html
	function createOnload() {
		echo 'onload="mapForItem('. $_GET['lat'] .', '. $_GET['lon'] .')"';
	}
	
?>

<!DOCTYPE html>
<html>

	<head>
	
		<link href="style.css" rel="stylesheet" type="text/css"/>
		<link href="itemStyle.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="script.js"></script>
		<script type="text/javascript" src="itemScript.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6gFjy8jz6k01nXpBTFU7HBZR02TXNK1Y&callback=mapForItem"></script>
	
	</head>
	
	<body <?php createOnload(); ?>>
	
		<div id="wrapper">
		
			<div id="header">
				Park Locator
				<?php
				if (isset($_SESSION['username'])){
					echo '<button onclick="javascript:window.location.href=\'Logout.php\'">Logout</button>';
				}
				?>
			</div>
			
			<div id="menu">
				<a href="home.php">Home</a>
				<a class= "active" href="search.php">Search</a>
				<a href="">Login</a>
				<a href="Registration.html">Register</a>
			</div>
			
			<div id="main" >
				<div id="reviews">
					<p>Reviews</p>
					
					<div id="reviewsContent">
						<?php
						require 'itemFunctions.php';
						//displayReviews();
						showReviews();
						
						
						
						
						
						
						?>
					</div>
					
					<div id="comment">
						<form name="Review" action = "processReview.php" method="get">
						<textarea name="comment" placeholder="Enter your review here"></textarea>
						<br>
						<div id="rating">
							<button action = "processReview.php" onclick="return (reviewValidation());">Send</button>
							<span>Your rating to this park: </span>
							<select name="rate">
								<option value="" disabled selected hidden></option>
								<option value="0">0</option>
								<option value="0.5">0.5</option>
								<option value="1">1</option>
								<option value="1.5">1.5</option>
								<option value="2">2</option>
								<option value="2.5">2.5</option>
								<option value="3">3</option>
								<option value="3.5">3.5</option>
								<option value="4">4</option>
								<option value="4.5">4.5</option>
								<option value="5">5</option>
							</select>
							<span> / 5</span>
						</div>
						
						</form>
					</div>
				</div>
				
				<div itemscope itemtype="http://schema.org/Place" id="item">
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