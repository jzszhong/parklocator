<?php
	session_start();
	echo $_SESSION['username'];
	unset($_SESSION['username']);
	//header('Location: http://localhost/Assignment/Login.php');
	header('Location: http://localhost/CAB230/Project/Login.php');





?>