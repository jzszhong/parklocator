<?php
session_start();

//check if the user is logged in
if (isset($_SESSION["username"])){
	//$pdo = new PDO('mysql:host=localhost;dbname=assignment1', 'min', 'Secret!');
	$pdo = new PDO('mysql:host=localhost;dbname=parks', 'parkReader', 'zzs123456');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	try {
			$entry = $pdo->prepare('INSERT INTO reviews VALUES(:username, :review, :itemid, :rating)');
			$entry->execute(array(
					'username' => $_SESSION['username'],
					//filter used to prevent cross site scripting. This filter escapes special characters
					'review'  => filter_var($_GET['comment'], FILTER_SANITIZE_SPECIAL_CHARS),
					'itemid' => $_SESSION['park id'],
					'rating' => $_GET['rate']
				));
	}	catch (PDOException $e) {
			echo $e->getMessage();
			
		}
	
	header("location:javascript://history.go(-1)");
} else {
	//if the user is not logged in, link them to the login page
	//header('Location: http://localhost/Assignment/Login.php');
	header('Location: http://localhost/CAB230/Project/Login.php');
}

$_SESSION['park id'] = null;

?>








