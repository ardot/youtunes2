<?php
	session_start();
	include 'constants.php';

  $db = mysql_connect("localhost", DB_HOST, DB_USERNAME);

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
	if(!isset($_GET['sID'])){
		echo "Invalid call to this function";
		exit();
	}

	$sID = $_GET['sID'];
	$uID = $_SESSION['uid'];

	$query = "DELETE FROM HasSong WHERE (song="  .mysql_real_escape_string($sID). " AND user="  .mysql_real_escape_string($uID). ")";

	print("<h1> query = $query </h1>");

	//error_log("Query: $query", 3, "errors.txt");

	$result = mysql_query($query);

	print("<h1> Result = $result </h1>");
/*
	mysql_query("INSERT INTO 'youtunes'.'Songs'
					('sID', 'album', 'vID', 'plays', 'genre', 'title', 'time', 'artist')
				VALUES
					(NULL, 'album', NULL, NULL, NULL, NULL, NULL, NULL ");//'album', '$vID', '$plays', '$genre', '$title', '$time', '$artist')");
	*/
	mysql_close($db);

?>
