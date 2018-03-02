<?php
include 'CheckPassword.php';
include 'functions.php';

					
// When it submits itself after enter login data
if (isset($_POST['login'])){
	//checks if the username and password combination is present in the database. htmlspecialchars is used to prevent sql injection
	if (checkPassword(htmlspecialchars($_POST['username']), htmlspecialchars($_POST['password']))){
		//start the session
		session_start();
		//save the username of the logged in user into a session variable
		$_SESSION["username"] = $_POST['username'];
		//if the user successfully logs in, link them to the search page
		header('Location: search.php');
	}
	else {
		if (!isset($errors)){
						$errors = array();
		}
		$errors['loginField'] = 'Please enter a valid username and password combination';
	}
}
// When the user has logged in and open the login page again
else {
	session_start();
	if (isset($_SESSION["username"])) header('Location: afterLogin.php');
}
?>


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
			</div>
			
			<div id="menu">
				<a href="home.php">Home</a>
				<a href="search.php">Search</a>
				<a class= "active" href="">Login</a>
				<a href="Registration.php">Register</a>
			</div>
			
			<div id = "contentLogin">
				<p>Login</p>
				<h2>Login to our site to post your reviews!</h2><br>
			
				<form name="Login" action = "Login.php" method="post">
					<br>
					<label for 'username'>Username</label>
					<br>
					<input type = 'text' name = 'username'>
					<?php
					if (!isset($errors)){
								$errors = array();
					}
					errorLabel($errors, 'loginField')
					?>
					<br>
					<label for 'password'>Password</label>
					<br>
					<input type = 'password' name = 'password'>
					<br><br>
					<input type="submit" name="login" value="Login">
			
	
				</form>
				
				<a href="Registration.php">Not registered yet? Join us now!</a>
			</div>
			
			<div id="footer">
				
			</div>
		</div>
	</body>
	
	
	
	
</html>