<?php

	session_start();
	
	//print("<h> Connectiong </h>");
	
	function encrypt_password($text){
		$salty = $test . "Friends to this ground. And leigemen to the Dane!";
		return hash("sha256", $salty);
	}
	
	//check to see if the user has attempted to log in	
	if(isset($_POST['username_new']) && isset($_POST['passwd_new']) && isset($_POST['passwdconf_new'])){
			
		$db = mysql_connect("localhost","root", "root");
						
		//check to see if the database was connected to successfully
    	if (!$db){
       		echo "Could not connect to database" . mysql_error();
        	exit();
    	}//end if
						
		//try to connect to the specific database, kill the thread if not
		$db_name = "youtunes";
   		if (!mysql_select_db($db_name, $db)){
        	die ("Could not select database") . mysql_error();
    	}//end if
		
		
		$username = $_POST['username_new'];
		$passwd = $_POST['passwd_new'];
		$passwd_conf = $_POST['passwdconf_new'];
		
		if( strcmp($passwd, $passwd_conf) != 0){
			
			echo "Invalid call to this function";
			exit();
		}
		
		
		mysql_query("
			INSERT INTO  `youtunes`.`Users` (
				`uID` ,
				`username` ,
				`password`
			)
			VALUES (
				NULL ,  '$username',  '$passwd'
			);	
		");	
		
		$_SESSION['username'] = $username;
		
	}
	
	header("Location: index.php");

	
?>
		