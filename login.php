<?php
	session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link rel="stylesheet" type="text/css" href="youTunesStyle.css" title="Twitter User Lookup Styles"/>
		<link rel="stylesheet" type="text/css" href="signInStyle.css" title="Twitter User Lookup Styles"/>
		<script type="text/javascript" language="javascript" charset="utf-8" src="js/signInForms.js"></script>
		<meta name="viewport" content="width=device-width">
    <meta name="Keywords" content="Streaming, music, free, online, youtube, playlists, youtunes, no ads, youtunesmusic">
    <meta name="Description" content="Stream ad-free music online, directly through YouTube videos!">
    <meta property="og:image" content="http://www.youtunesmusic.net/youtunes.png" />
    <title> Welcome to YouTunes - Free Music Streaming Online </title>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-34594746-2', 'youtunesmusic.net');
      ga('send', 'pageview');

    </script>
	</head>

	<body>

		<?php
			include 'header.php';

			if(isset($_SESSION['login_error']) && $_SESSION['login_error'] != NULL){
				$error = $_SESSION['login_error'];
				print("<h4 style=\"color:red; position:fixed; left:50%; width:800px; margin-left:-400px; top:150px;\"> $error </h4>");
			}
		?>

		<div id="content">
			<div id="left">
				<!--img src="images/logonew580.png" id="logo" alt="some_text"-->
			</div>

			<div id="topI">
				<form action="signin.php" method="post">
				<ul>
					<li id="head">
							<p>
								Sign in!
							</p>
						</li>
					<li>
						<input type="text" name="username" id="signInput" size="30" />
					</li>

					<li>

						<input type="text" name="passwd" id="password" size="30" />
						<button type="submit" id="submit">Sign in!</button>
					</li>


				</ul>
				</form>


			</div>
			<div id="bottom">
				<form action="signup.php" method="post">

					<ul>
						<li id="head2">
							<p>
								New to youTunes?
							</p>
						</li>
						<li>
							<input type="text" name="username_new" id="signUpput" size="30"/>
						</li>

						<li>
							<input type="text" name="passwd_new" id="passwdNew" size="30" />
						</li>

						<li>
							<input type="text" name="passwdconf_new" id="passwdNewConfirm" size="30" />
							<button type="submit" id="submit2">Sign up!</button>
						</li>
					</ul>
				</form>
			</div>
			<!--form action="albums.php" method="post">
				<input type="text" name="passwd" id="email" size="30" />
				<input type="text" name="passwd" id="password" size="30" />
				<button type="submit" id="submit">Sign in!</button>
			</form-->
		</div>

		<?php
			include 'footer.php';
		?>
	</body>
