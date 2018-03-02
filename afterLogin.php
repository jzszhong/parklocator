<?php session_start(); ?>

<!DOCTYPE html>
<html>

	<head>
		<link href="CSS/style.css" rel="stylesheet" type="text/css"/>
		<link href="CSS/loginStyle.css" rel="stylesheet" type="text/css"/>
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
				<a href="home.php">Home</a>
				<a href="search.php">Search</a>
				<a class= "active" href="">Login</a>
				<a href="Registration.php">Register</a>
			</div>
			
			<div id = "contentLogin">
				<p>Login</p>
				
				<h2>You have logged in!</h2><br>
			
				<a href="search.php">Start to search for a park</a>
			</div>
			
			<div id="footer">
				
			</div>
		</div>
	</body>
	
	
	
	
</html>