<?php
  session_start();

  $uID = $_SESSION['uid'];
  // User must have a valid session to proceed
	if(!isset($_SESSION['uid'])){
		echo "Not ogged in!";
		exit();
	}

  print("<h> hittin this </h>");
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
  }



	if (!isset($_GET['name'])) {
		echo "Invalid call to this function";
		exit();
	}

  $name = $_GET['name'];

	$query = "INSERT INTO `youtunes`.`Playlists`
			(`pID`,
			`name`)
		VALUES
			(NULL,
			'" .mysql_real_escape_string($name). "');";

  print("<h> $query </h>");
	mysql_query($query);

	$last_pid_query = "SELECT LAST_INSERT_ID();";
	$last_id = mysql_query($last_pid_query);
	$last_int_id = 0;

  print("<h> $last_id </h>");

	while($row=mysql_fetch_array($last_id)){
		$last_int_id = $row[0];
	}

  print("<h> $last_int_id </h>");
	$has_playlist_insert =
		"INSERT INTO `youtunes`.`UserHasPlaylist`
			(`uID`,
			`pID`,
			`creator`)
		VALUES (
			'" .mysql_real_escape_string($uID). "',
			'" .mysql_real_escape_string($last_int_id). "',
			'" .mysql_real_escape_string($uID). "');";

  $user_has_result = mysql_query($has_playlist_insert);

	mysql_close($db);
?>
