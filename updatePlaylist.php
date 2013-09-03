<?php
  session_start();

  $uID = $_SESSION['uid'];
  print("<h> $uID </h>");

  // User must have a valid session to proceed
	if (!isset($_SESSION['uid'])) {
		echo "Not logged in!";
		exit();
	}

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
  }

  if (!isset($_GET['pID']) ||
      !isset($_GET['name'])) {
	  echo "Invalid call to this function";
		exit();
  }

  $pID = $_GET['pID'];
	$name = $_GET['name'];

  print("<h> $pID </h>");
  print("<h> $name </h>");

  $query = "UPDATE  `youtunes`.`Playlists` SET
		`name` =  '" .mysql_real_escape_string($name). "'
		WHERE  `Playlists`.`pID` =" .mysql_real_escape_string($pID). ";";

  print("<h> $query </h>");
  mysql_query($query);
  mysql_close($db);

?>
