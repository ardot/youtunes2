<script type="text/javascript">
	function createPlaylist(sender){
	
		var row1 = $("#1");
		console.log(row1);
		console.log(row1.parent());
		console.log(row1.parent().next());
		//var trs = $(".songrow");
		//console.log(trs);
	}
</script>

<ul id="footer">
	<div id="options">
		<ul id="opt">
			<li id="addPL" class="button">
				<img src="images/addPL.png" alt="some_text" onclick="printSongYTInfo(this)" />
			</li>
			<li id="shuffle" class="button">
				<img src="images/shuffle50.png" alt="some_text" onclick="setShuffle(this)" />
			</li>
			<li id="loop" class="button">
				<img src="images/loop50.png" alt="some_text" onclick="setLoop(this)"/>
			</li>
		</ul>
	</div>	
	
	<?php
	
		if(isset($_SESSION['username'])){
			print("<div class=\"ytclosed\" id=\"ytsearch\">
					<div style=\"background-color:rgba(255,120,120,1); border-top-left-radius:8px; max-height:50px;\">
						<input type=\"text\" id=\"queryinput\" style=\"position:relative; left:38px; margin-left:0px; width:340px;font-style:italic; color:gray\" value=\"Search youtube\" onkeydown=\"javascript:SearchYouTube(document.getElementById('queryinput').value)\"/>			
						<div style=\"height:25px; width:27px;background-color:rgba(255,50,50,1); border-radius:8px; position:relative; top:-40px; left:4px; padding-top:4px; padding-left:2px\"   onclick=\"searchChange()\">
				
							<img id=\"upordown\" src=\"images/up.png\", alt=\"\">
						</div>
					</div>
					<div id=\"resultPane\">
			
			
						<div id=\"search-results-block\"></div>
					</div>
				</div>	");
		}
	?>
	
</ul>

<!--input type="submit" value="Search" onclick="javascript:SearchYouTube(document.getElementById('queryinput').value)" /-->