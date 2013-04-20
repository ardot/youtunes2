<?php

	session_start();
	
	//print("<h> Connectiong </h>");
	
	function encrypt_password($text){
		$salty = $test . "Friends to this ground. And leigemen to the Dane!";
		return hash("sha256", $salty);
	}
	
	//check to see if the user has attempted to log in	
	if(isset($_POST['username']) && isset($_POST['passwd'])){
		
		//print("<h> Checking </h>");
		
		$username = $_POST['username'];
		$passwd = $_POST['passwd'];
		
		//print("<h> Username: $username <br/> Password: $passwd <br/> </h>");
		
		//$sql=mysql_query("select * from Users where username = $username");
		
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
		
		
		$sql = mysql_query("select * from Users");//` WHERE  `username` LIKE  'telenardo'");// WHERE username = $username");
		
		//print("<h> SQL: $sql <br/> </h>");
		
		$found = 0;
	
		while($row=mysql_fetch_assoc($sql)){
			
			$test1 = $row['username'];
			$test2 = $row['password'];
			
			//print("<h> <br/> USERNAME: $test1  <br/> PASSWORD: $test2  <br/> </h>");
			
			if($row['username'] == $username && $row['password'] == $passwd){
				//print("Match");
				$_SESSION['username'] = $username;
				$_SESSION['uid'] = $row['uID'];
				$_SESSION['login_error'] = NULL;
				$found = 1;
			}
			
		}

		if($found == 0){
			//print("<h1> here </h1>");
			$_SESSION['login_error'] = "Invalid username and password combination!";	
		}
		
		
		
		
	}
	else if(isset($_POST['username_new'])){
		$username = $_POST['username_new'];
		$passwd = $_POST['passwd_new'];
		$passwdconf = $_POST['passwdconf_new'];
		
		if ($passwd != $passwdconf){
			
			$_SESSION['login_error'] = "Passwords do not match!";
		}
		else{
			
			//CHECK IF USER ALREADY EXISTS IN DATABASE
			
			//IF NOT, ADD THAT USER TO THE DATABASE.
			
			//SEND CONFIRMATION EMAIL??
		}
		
	}
	
	header("Location: index.php");
/*	print($_SESSION['login_error']);
	
	print($username);
	print($passwd);	
	
	
	/*$res = $this->_execute($sql);
		if ( ! $res ) {
			print("<h> Check validity </h>");
			
			$_SESSION['login_error'] = "Username query failed, please try again!";
		}*/
		//else{
			//print("<h> Check validity </h>");
			
			//$count = $sql->count();
			
			
			
			
			//if($count == 0){
				
			//	$_SESSION['login_error'] = "Please enter a valid username!";
			//}
			//else{
				//print("<h> count is not zero!</h>");
			
				
			//}	
			
		//}
		
	
	
	//check to see the user is a new user
		/*if(isset($_POST['passwordconf'])){
			$sql=mysql_query("select * from Users where username = $username");
			
			$count = $sql->count();
			//if the email address already has an account
			if($count > 0){
				$_SESSION['loginError'] = 0;
			}
			else {
				$activated = "false";
				//$sql=mysql_query("INSERT INTO Users VALUES $username, $_POST['password'], $activated");
			}
		}*/
//	include 'index.php';

	//Establish connection to the database
	/*$db = mysql_connect("localhost","root", "root");
	
	print("<h> Connectiong </h>");
						
	//check to see if the database was connected to successfully
    if (!$db){
     	echo "Could not connect to database" . mysql_error();
      	exit();
    }//end if
		
	print("<h> Connected </h>");				
	//try to connect to the specific database, kill the thread if not
	$db_name = "youTunes";
   	if (!mysql_select_db($db_name, $db)){
       	die ("Could not select database") . mysql_error();
    }//end if
		
	print("<h> Selecting </h>");
		
	$mypdo = new PDO("mysql:host=localhost;dbname=youTunes","root","root");*/
	


?>

