<div id="header">
	
	<?php
	
		if(isset($_SESSION['username'])){
			$name = $_SESSION['username'];
			print("<h style=\"position:fixed; left:100%; margin-left:-220px; top:2px;\"> 
				Welcome $name! | 
				<a href=\"logout.php\">
					logout
				</a>
			
			</h>");
		}
		
	?>
			<div id="headerContent">
			<!--ul id="horzlist"-->
				<div id="playControls">
					<ul id="navi">
						<li id="back">
							<img class="buttons" src="images/back.png" alt="some_text" onclick="back()"/>
						</li>
						<li id="play" >
							<img class="buttons" id="playImage" src="images/play.png" onclick="pause(this)" alt="some_text" id="playButton"/>
						</li>
						<li id="forward">
							<img class="buttons" src="images/forward.png" alt="some_text" onclick="forward()"/>
						</li>
					</ul>
				</div>
				
				<div id="playerConsole">
					<!--div id="videoDiv"></div-->
					<!--div id="videoDiv"></div-->
					<div id="playerDisplay">
						<div id="songInfo">
							<h4 id="titlePane" class="fixedText">
								Welcome to youTunes
							</h4>
							<h4 id="artistPane" class="fixedText">
					
								(| ' _ ' |)
							</h4>
							</div>
							<div id="progressBar">
								<div id="loaded">
							</div>
						
							<div id="completed">
							</div>
						
						</div>	
					</div>
				</div>
				<div id="search">
					<form class="filter more">
						<script src="js/filterTable.js" type="text/javascript"></script>
						<input type="text" name="search" id="searc" size="40" onkeyup="filter(this);"/>
					</form>
				</div>
			<!--/ul-->
			</div>
		</div>