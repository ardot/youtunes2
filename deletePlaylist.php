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

	// Check for the playlist ID
	if(!isset($_GET['pID'])){
		echo "Invalid call to this function";
		exit();
	}

  // Store playlist ID and user ID locally
  $pID = $_GET['pID'];
	$uID = $_SESSION['uid'];

  // delete's relationship between user and playlist
	$delete_user_relation =
    "DELETE
      FROM `youtunes`.`UserHasPlaylist`
    WHERE
      `UserHasPlaylist`.`uID` = " .mysql_real_escape_string($uID). " AND
      `UserHasPlaylist`.`pID` = " .mysql_real_escape_string($pID).  "
    LIMIT 1";

  // deletes all references to songs for that playlist
  $delete_playlist_songs =
    "DELETE
      FROM `youtunes`.`PlaylistHasSong`
    WHERE `PlaylistHasSong`.`pID` = " .mysql_real_escape_string($pID);

  // deletes there original reference to the playlist
  $delete_playlist_reference =
    "DELETE
      FROM `youtunes`.`Playlists`
     WHERE `Playlists`.`pID` = " .mysql_real_escape_string($pID);

  mysql_query($delete_user_relation);
  mysql_query($delete_playlist_songs );
  mysql_query($delete_playlist_reference);

  mysql_close($db);
?>
