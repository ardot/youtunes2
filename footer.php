<ul id="footer">
	<div id="options">
		<ul id="opt">
			<li id="addPL" class="button">
				<img height="30" src="images/addPL.png" alt="some_text" onclick="addNewPlaylist()" />
			</li>
			<li id="shuffle" class="button">
				<img height="30" src="images/shuffle50.png" alt="some_text" onclick="setShuffle(this)" />
			</li>
			<li id="loop" class="button">
				<img height="30" src="images/loop50.png" alt="some_text" onclick="setLoop(this)"/>
			</li>
		</ul>
	</div>

	<?php

		if(isset($_SESSION['username'])){
			print("<div class=\"ytclosed\" id=\"ytsearch\">
					<div class=\"searchContainer\">
						<input class=\"addSongs\" type=\"text\" id=\"queryinput\"  value=\"Add Songs from Youtube!\" onkeydown=\"javascript:SearchYouTube(document.getElementById('queryinput').value)\"/>
						<div class=\"minimize\" onclick=\"searchChange()\">

							<img id=\"upordown\" src=\"images/up.png\", alt=\"\">
						</div>
					</div>
					<div id=\"resultPane\">


						<div id=\"search-results-block\"></div>
					</div>
				</div>	");
		 print("<div id=\"smiley\">
              <img id=\"smileyImage\" height=\"35\" src=\"images/smiley3.png\" alt=\"smiley\"/>
            </div>");
    }
	?>
</ul>

<!--input type="submit" value="Search" onclick="javascript:SearchYouTube(document.getElementById('queryinput').value)" /-->
