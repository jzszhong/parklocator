<?php
include 'CheckPassword.php';
include 'functions.php';
if (isset($_POST['login'])){
	//checks if the username and password combination is present in the database. htmlspecialchars is used to prevent sql injection
	if (checkPassword(htmlspecialchars($_POST['username']), htmlspecialchars($_POST['password']))){
		//start the session
		session_start();
		//save the username of the logged in user into a session variable
		$_SESSION["username"] = $_POST['username'];
		//if the user successfully logs in, link them to the search page
		//header('Location: http://localhost/Assignment/search.php');
		header('Location: http://localhost/CAB230/Project/search.php');
	}
	else {
		if (!isset($errors)){
						$errors = array();
		}
		$errors['loginField'] = 'Please enter a valid username and password combination';
	}
}
?>


<!DOCTYPE html>
<html>

	<head>
		<link href="style.css" rel="stylesheet" type="text/css"/>
		<link href="loginStyle.css" rel="stylesheet" type="text/css"/>
	</head>
	
	
	<body>
		<div id="wrapper">
			<div id="header">
				Park Locator
			</div>
			
			<div id="menu">
				<a href="">Home</a>
				<a href="search.php">Search</a>
				<a class= "active" href="">Login</a>
				<a href="">Register</a>
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