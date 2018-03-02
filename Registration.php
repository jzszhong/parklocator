<?php
session_start();
?>


<!DOCTYPE html>
<html>

	<head>
	
		<link href="CSS/style.css" rel="stylesheet" type="text/css"/>
		<link href="CSS/regStyle.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="JS/script.js"></script>
		
		<title>
		Registration
		</title>
	
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
				<a href="Login.php">Login</a>
				<a class= "active" href="">Register</a>
			</div>
			
			<div id = "contentreg">
				<p>Enter your details to register: </p>
			
				<form name="Register" action = "processData.php" onsubmit ="return (RegValidateForm(this));" method="post">
					<?php
					include 'functions.php';
					if (!isset($errors)){
						$errors = array();
					}
					
					input_field($errors, 'firstName', 'First Name', 'text');
					input_field($errors, 'lastName', 'Last Name', 'text');
					input_field($errors, 'email', 'Email', 'text');
					input_field($errors, 'username', 'Username','text');
					input_field($errors, 'password', 'Password', 'password');
					input_field($errors, 'passwordConfirm', 'Confirm Password', 'password');
					input_field($errors, 'dateofBirth', 'Date of Birth', 'date');
					input_field($errors, 'postCode', 'Postcode', 'text');
					
					?>
					
					<input type="checkbox" name="Privacy" value="agree"> Please agree to our terms and conditions
					<br><br><br>
					<input type="submit" value="Submit"> <br>
				</form>	
			</div>
			
			<div id="footer">
				
			</div>
		
		</div>
	
	</body>
	
</html>