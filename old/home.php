<!DOCTYPE html>
<html>

	<head>
	
		<link href="style.css" rel="stylesheet" type="text/css"/>
		<link href="homeStyle.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="script.js"></script>
		
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
				<a class="active" href="">Home</a>
				<a href="search page.php">Search</a>
				<a href="">Login</a>
				<a href="Registration.html">Register</a>
			</div>
			
			<div id="main">
				<div id="guide">
					<h1>Welcome to use Park Locator</h1>
					<p>You can search for the location of any Brisbane parks here</p>
					<button id="searchBtn" onclick="javascript:window.location.href='search page.php'">Search Now</button>
					<br>
					<span>or</span>
					<br>
					<button id="loginBtn">Login</button>
				</div>
			</div>
			
			<div id="footer">
				
			</div>
		
		</div>
	
	</body>
	
</html>