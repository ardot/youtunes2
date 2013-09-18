<?php
	include 'constants.php';

  // User must have a valid session to proceed
	if(!isset($_SESSION['uid'])){
		echo "Not logged in!";
		exit();
	}

  $db = mysql_connect("localhost", DB_HOST, DB_USERNAME);

	// check to see if the database was connected to successfully
  if (!$db){
    echo "Could not connect to database" . mysql_error();
    exit();
  }

	// try to connect to the specific database, kill the thread if not
	$db_name = "youtunes";
  if (!mysql_select_db($db_name, $db)){
    die ("Could not select database") . mysql_error();
  }

	if (!isset($_GET['album']) ||
      !isset($_GET['time']) ||
      !isset($_GET['vID']) ||
      !isset($_GET['plays']) ||
      !isset($_GET['genre']) ||
      !isset($_GET['artist']) ||
      !isset($_GET['title'])) {
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
  $uID = $_SESSION['uid'];

  $query =
    "INSERT INTO  `youtunes`.`Songs`
      (`sID`,
        `title`,
        `time`,
        `artist`,
        `genre`,
        `plays`,
        `vID`,
        `album`)
    VALUES
      (NULL ,
        '$title',
        '$time',
        '$artist',
        '$genre',
        '0',
        '$vID',
        '$album')";
	mysql_query($query);

	$last_id_query = "SELECT LAST_INSERT_ID();";
	$last_id = mysql_query($last_id_query);
	$last_int_id = 0;

	while($row=mysql_fetch_array($last_id)) {
 		$last_int_id = $row[0];
	}

	$has_song_insert =
    "INSERT INTO  `youtunes`.`HasSong` (
      `user` ,
      `song` ,
      `plays`
    ) VALUES (
      '" .mysql_real_escape_string($uID). "',
      '$last_int_id',
      '0');";

  $result2 = mysql_query($has_song_insert);
  echo mysql_error();


  print("Result: $has_song_insert /n");
	mysql_close($db);

	echo $last_int_id;

?>
