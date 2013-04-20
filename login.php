<?php
	session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link rel="stylesheet" type="text/css" href="youTunesStyle.css" title="Twitter User Lookup Styles"/>
		<link rel="stylesheet" type="text/css" href="signInStyle.css" title="Twitter User Lookup Styles"/>
		<script type="text/javascript" language="javascript" charset="utf-8" src="js/signInForms.js"></script>
		
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