<?php
  session_start();

  print("<h> TESHET </h>");
  $uID = $_SESSION['uid'];
  // User must have a valid session to proceed
	if(!isset($_SESSION['uid'])){
		echo "Not ogged in!";
		exit();
	}
  include 'constants.php';

  $db = mysql_connect("localhost",DB_HOST,DB_USERNAME);

	//check to see if the database was connected to successfully
    if (!$db){
    	echo "Could not connect to database" . mysql_error();
    	exit();
    }//end if

	//try to connect to the specific database, kill the thread if not
	$db_name = "youtunes";
  if (!mysql_select_db($db_name, $db)){
    die ("Could not select database") . mysql_error();
  }

  if (!isset($_GET['sID']) ||
      !isset($_GET['pID'])) {
		echo "Invalid call to this function";
		exit();
	}

  $sID = $_GET['sID'];
  $pID = $_GET['pID'];

  $query = "INSERT INTO  `youtunes`.`PlaylistHasSong` (
      `pID` ,
      `sID`
    ) VALUES (
      '" .mysql_real_escape_string($pID). "',
      '" .mysql_real_escape_string($sID). "'
    );";

  print("<h> $query </h>");
  mysql_query($query);
  print("<h> TESHET </h>");
?>


