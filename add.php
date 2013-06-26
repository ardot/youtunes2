<?php

	
	
	session_start();
	/*
	if(!isset($_SESSION['username'])){
		echo "Not logged in!";
		exit();
	}*/
	
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
    
	/*mysql_query("INSERT INTO  `youtunes`.`Users` 
					(`uID` ,`username` , `password`)
				VALUES 
					(NULL ,  'Tim',  'Lenardo')");*/
	
	
	if((!isset($_GET['album'])) || (!isset($_GET['time'])) || (!isset($_GET['vID'])) || (!isset($_GET['plays']))){
		echo "Invalid call to this function";
		exit();
	}
	
	if((!isset($_GET['genre'])) || (!isset($_GET['artist'])) || (!isset($_GET['title']))){
		echo "Invalid call to this function";
		exit();
	}

	$album = $_GET['album'];
	$vID = $_GET['vID'];
	$plays = $_GET['plays'];
	$genre = $_GET['genre'];
	$title = $_GET['title'];
	$time = $_GET['time'];
	$artist = $_GET['artist'];
	
	//print("<p> Album: $album <br/> </p>");

  	$uID = $_SESSION['uid'];		
  		
  	$query = "INSERT INTO  `youtunes`.`Songs` (`sID`, `title`, `time`, `artist`, `genre`, `plays`, `vID`, `album`) VALUES (NULL ,  '$title',  '$time',  '$artist',  '$genre',  '0',  '$vID',  '$album')";	
	mysql_query($query);
	
	$query = "SELECT LAST_INSERT_ID();";
	$last_id = mysql_query($query);
	$last_int_id = 0;
	
	while($row=mysql_fetch_array($last_id)){
		$last_int_id = $row[0];		
	}
		
	//print("<h1>$last_int_id</h1>");

	$query = "INSERT INTO HasSong (song, user, plays) VALUES ($last_int_id, " .mysql_real_escape_string($uID). ", 0)";
	mysql_query($query);

	

	/*while($row=mysql_fetch_assoc($result)){
		$sID = $row['sID'];
		print("<h1> sID = $sID </h1>");
$uID = $_SESSION['uid'];
		print("<h1> uID = $uID </h1>");
				print("<h1> query = $query </h1>");
		$result = mysql_query($query);
		print("<h1> result = $result </h1>");
	}*/
	//print("<h> $result </h>");
 	 
 	
 
 /*
	mysql_query("INSERT INTO 'youtunes'.'Songs' 
					('sID', 'album', 'vID', 'plays', 'genre', 'title', 'time', 'artist') 
				VALUES 
					(NULL, 'album', NULL, NULL, NULL, NULL, NULL, NULL ");//'album', '$vID', '$plays', '$genre', '$title', '$time', '$artist')");
	*/
	mysql_close($db);
	
	echo $last_int_id;
    					
?>