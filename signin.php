<?php

	session_start();

  function encrypt_password($password, $salt) {
		$salty = $password . $salt;
    return hash("sha256", $salty);
	}

	//print("<h> Connectiong </h>");

	//check to see if the user has attempted to log in
	if (isset($_POST['username']) && isset($_POST['passwd'])) {
		$username = $_POST['username'];
		$passwd = $_POST['passwd'];

    // Connect to db and validate connection
    $db = mysql_connect("localhost","root", "root");
    if (!$db) {
      echo "Could not connect to database" . mysql_error();
      exit();
    }
		$db_name = "youtunes";
   	if (!mysql_select_db($db_name, $db)) {
      die ("Could not select database") . mysql_error();
    }

		$check_password = sprintf(
      "SELECT * FROM Users WHERE username=\"%s\"",
      mysql_real_escape_string($username)
    );

		$sql = mysql_query($check_password);
		$found = 0;
		while ($row=mysql_fetch_assoc($sql)) {
			$username = $row['username'];
			$password = $row['password'];
      $uID = $row['uID'];
      if (!isset($row['salt'])) {
        if ($password === $passwd) {
          $_SESSION['username'] = $username;
          $_SESSION['uid'] = $uID;
          $_SESSION['login_error'] = NULL;
          $found = 1;
        }
      } else {
        $salt = $row['salt'];
        $salty = $passwd . $salt;
        $passwd = hash("sha256", $salty);
        if ($password === $passwd) {
          $_SESSION['username'] = $username;
          $_SESSION['uid'] = $uID;
          $_SESSION['login_error'] = NULL;
          $found = 1;
        }
      }
		}
		if($found == 0) {
			$_SESSION['login_error'] = "Invalid username and password combination!";
		}
	}
	else {
		$_SESSION['login_error'] = "You must enter both a username and a password!";
	}
  header("Location: index.php");
?>

