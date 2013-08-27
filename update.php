<?php

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
  }

	//try to connect to the specific database, kill the thread if not
	$db_name = "youtunes";
   	if (!mysql_select_db($db_name, $db)){
    	die ("Could not select database") . mysql_error();
    }//end if

	/*mysql_query("INSERT INTO  `youtunes`.`Users`
					(`uID` ,`username` , `password`)
				VALUES
					(NULL ,  'Tim',  'Lenardo')");*/


	/*if((!isset($_GET['sID'])) || (!isset($_GET['name'])) || (!isset($_GET['artist'])) || (!isset($_GET['album'])) || (!isset($_GET['genre']))){
		echo "Invalid call to this function";
		exit();
	}*/


	$sID = $_GET['sID'];
	$name = $_GET['name'];
	$artist = $_GET['artist'];
	$album = $_GET['album'];
	$genre = $_GET['genre'];

	print("<h>sID $sID</h>");

	$query = "UPDATE  `youtunes`.`Songs` SET
		`title` =  '" .mysql_real_escape_string($name). "',
		`artist` =  '" .mysql_real_escape_string($artist). "',
		`genre` =  '" .mysql_real_escape_string($genre). "',
		`album` =  '" .mysql_real_escape_string($album). "'
		WHERE  `Songs`.`sID` =" .mysql_real_escape_string($sID);

	//$query = "UPDATE Songs SET title=" .mysql_real_escape_string($name). ", artist=" .mysql_real_escape_string($artist). ", album=" .mysql_real_escape_string($album). ", genre="  " WHERE sID=" .mysql_real_escape_string($sID);

  	print($query);
	mysql_query($query);


	mysql_close($db);

?>
