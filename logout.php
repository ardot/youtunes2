<?php

	session_start();
	
	unset($_SESSION['username']);
	
	unset($_SESSION['uID']);
	
	unset($_SESSION['login_error']);
	
	header("Location: index.php");
?>