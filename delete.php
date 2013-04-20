<?php

	//WHY DOES THIS NOT DELETE??

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
	
	//
	if(!isset($_GET['vID'])){
		echo "Invalid call to this function";
		exit();
	}
	
	$vID = $_GET['vID'];

	$query = "DELETE FROM `youtunes`.`Songs` WHERE 'Songs'.'vID'=$vID";
	
	error_log("Query: $query", 3, "errors.txt");
	
	mysql_query("DELETE FROM `youtunes`.`Songs` WHERE 'Songs'.'vID'='$vID'");

/*
	mysql_query("INSERT INTO 'youtunes'.'Songs' 
					('sID', 'album', 'vID', 'plays', 'genre', 'title', 'time', 'artist') 
				VALUES 
					(NULL, 'album', NULL, NULL, NULL, NULL, NULL, NULL ");//'album', '$vID', '$plays', '$genre', '$title', '$time', '$artist')");
	*/
	mysql_close($db);
    					
?>