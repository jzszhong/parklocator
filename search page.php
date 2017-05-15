<!DOCTYPE html>
<html>

	<head>
	
		<link href="style.css" rel="stylesheet" type="text/css"/>
		<link href="searchStyle.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="script.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6gFjy8jz6k01nXpBTFU7HBZR02TXNK1Y&callback=defaultMap"></script>
		
		<?php require 'data.php' ?>
		
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
					
					<div id="location">
						<p>Your Location is: </p>
						<p id="status"></p>
					</div>
					
					<button name="search near parks" disabled>Search near parks</button>
					<br>
					<br>
					<span>or</span>
					
					<form name="searchForm" onsubmit="return (searchValidation());" method="get" action="resulting.php">
					<fieldset>
					<legend id="searchSubTitle">Search by options:</legend>
						<input list="list1" name="suburb">
						<datalist id="list1">
							<?php
								createSuburbOptions();
							?>
						</datalist>
						</input>
						<br>
						<input list="list2" name="park">
						<datalist id="list2">
							<?php
								createNameOptions();
							?>
						</datalist>
						</input>
						<br>
						<input list="list3" name="min rating">
						<datalist id="list3">
							<?php
								createRatingOptions();
							?>
						</datalist>
						</input>
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