<?php

	session_start();
	
	//print("<h> Connectiong </h>");
	
	function encrypt_password($text) {
		$salty = $test . "Friends to this ground. And leigemen to the Dane!";
		return hash("sha256", $salty);
	}
	
	print("<p> Here </p>");
	
	//check to see if the user has attempted to log in	
	if (isset($_POST['username_new']) && isset($_POST['passwd_new']) && isset($_POST['passwdconf_new'])) {
		print("<p> Here </p>");
		
		$db = mysql_connect("localhost","root", "root");
						
		//check to see if the database was connected to successfully
    	if (!$db) {
       		echo "Could not connect to database" . mysql_error();
        	exit();
    	}//end if
						
		//try to connect to the specific database, kill the thread if not
		$db_name = "youtunes";
   		if (!mysql_select_db($db_name, $db)) {
        	die ("Could not select database") . mysql_error();
    	}//end if
		
		
		$username = $_POST['username_new'];
		$passwd = $_POST['passwd_new'];
		$passwd_conf = $_POST['passwdconf_new'];
		
		if (strcmp($passwd, $passwd_conf) != 0) {
			$_SESSION['login_error'] = "Password and Confirm Password do not match!";	
		}
		else { 
			$query = "SELECT * FROM Users WHERE username='" .mysql_real_escape_string($username). "'";
			
			print("<p> $query </p>");
			
			$result = mysql_query($query);
		
			$continue = false;
			print("<p> $continue </p>");		
			while ($row=mysql_fetch_assoc($result)) {
				print("<p> $row </p>");
				$continue = true;
			}
					
			print("<p> $continue </p>");
			
			if ($continue) {
				$_SESSION['login_error'] = "A user with that email already exists!";
			}
			else {
				$query = "INSERT INTO  `youtunes`.`Users` (
						`uID`,
						`username`,
						`password`,
					)
					VALUES (
						NULL,
						'" .mysql_real_escape_string($username). ",
						'" .mysql_real_escape_string($passwd). "',
					);";
				$result = mysql_query($query);
		
				
				$query = "SELECT LAST_INSERT_ID();";
				$result = mysql_query($query);
				$found = false;
				
				while ($row=mysql_fetch_assoc($result)) {
					$_SESSION['uid'] = $row['uID'];
					$_SESSION['username'] = $username;
					$found = true;
				}	
			
				if (!$found) {
					$_SESSION['login_error'] = "Error while adding user, please try again!";
				}
				
				
			}	
		}
		
		 
	} else {
		$_SESSION['login_error'] = "Please fill out all of the required fields!";
	}
	
	//header("Location: index.php");

	
?>
		