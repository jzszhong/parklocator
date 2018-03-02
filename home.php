<?php session_start(); ?>

<!DOCTYPE html>
<html>

	<head>
	
		<link href="CSS/style.css" rel="stylesheet" type="text/css"/>
		<link href="CSS/homeStyle.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="JS/script.js"></script>
		
	
	
	</head>
	
	<body>
	
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
				<a class="active" href="">Home</a>
				<a href="search.php">Search</a>
				<a href="Login.php">Login</a>
				<a href="Registration.php">Register</a>
			</div>
			
			<div id="main">
				<div id="guide">
					<h1>Welcome to use Park Locator</h1>
					<p>You can search for the location of any Brisbane parks here</p>
					<button id="searchBtn" onclick="javascript:window.location.href='search.php'">Search Now</button>
					<br>
					<span>or</span>
					<br>
					<button id="loginBtn" onclick="javascript:window.location.href='Login.php'">Login</button>
				</div>
			</div>
			
			<div id="footer">
				
			</div>
		
		</div>
	
	</body>
	
</html>