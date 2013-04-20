<?php
	session_start();

	if(isset($_SESSION['username'])){
		include 'console.php';
	}
	else{
		include 'login.php';
	}
	
?>