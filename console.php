<?php
	session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link rel="stylesheet" type="text/css" href="youTunesStyle.css" title="YouTunes Style"/>
		<link rel="stylesheet" type="text/css" href="js/apprise/apprise.min.css" title="Apprise Style"/>
		<script src="js2/jquery.js" type="text/javascript"></script>
		<script src="js/googlejsapi.js" type="text/javascript"></script>
		<script type="text/javascript" src="js/ytsearch.js"></script>
		<script type="text/javascript" src="js/apprise/apprise-1.5.min.js"></script>
		
		</head>
		<script type="text/javascript">
   			var xmlHttp = null;

			function GetCustomerInfo()
			{	
    			var CustomerNumber = document.getElementById( "TextBoxCustomerNumber" ).value;
    			var Url = "GetCustomerInfoAsJson.aspx?number=" + CustomerNumber;

  			  	xmlHttp = new XMLHttpRequest(); 
    			xmlHttp.onreadystatechange = ProcessRequest;
 				xmlHttp.open( "GET", Url, true );
    			xmlHttp.send( null );
			}

			function ProcessRequest() 
			{
    			if ( xmlHttp.readyState == 4 && xmlHttp.status == 200 ) 
    			{
        			if ( xmlHttp.responseText == "Not found" ) 
        			{
           			 	document.getElementById( "TextBoxCustomerName"    ).value = "Not found";
            			document.getElementById( "TextBoxCustomerAddress" ).value = "";
        			}
        			else
        			{
            			var info = eval ( "(" + xmlHttp.responseText + ")" );

            			// No parsing necessary with JSON!        
        				document.getElementById( "TextBoxCustomerName"    ).value = info.jsonData[ 0 ].cmname;
            			document.getElementById( "TextBoxCustomerAddress" ).value = info.jsonData[ 0 ].cmaddr1;
        			}                    
    			}
			}
   
   		</script>
   		
		<script type="text/javascript">
    	  google.load("swfobject", "2.1");
   		 </script>  
  
    	<!--script type="text/javascript" charset="utf-8">
			var curSelected
			
			$(document).ready( function () {
  				$('tr').click( function () {
  					
  					console.log("Here!");
  				});
			} );
		</script0-->
    	<script type="text/javascript">
    	   
      var paused=false;
      var selected="none";
      /*
       * Change out the video that is playing
       */
      
      // Update a particular HTML element with a new value
      function updateHTML(elmId, value) {
        document.getElementById(elmId).innerHTML = value;
      }
      
      
      // Loads the selected video into the player.
      function loadVideo() {
        var selectBox = document.getElementById("videoSelection");
        var videoID = selectBox.options[selectBox.selectedIndex].value
        
        if(ytplayer) {
          ytplayer.loadVideoById(videoID);
        }
      }
      
      function pause(sender){
      	
      	if(ytplayer){
      		
      		var state = ytplayer.getPlayerState();
      		
      		if (state == 1){
      			ytplayer.pauseVideo();
      		}
      		else{
      			ytplayer.playVideo();
      		}
    
      	}
      }
      

	
      
     
      // This function is called when an error is thrown by the player
      function onPlayerError(errorCode) {
        alert("An error occured of type:" + errorCode);
      }
      
      // This function is automatically called by the player once it loads
      function onYouTubePlayerReady(playerId) {
        ytplayer = document.getElementById("ytPlayer");
        ytplayer.addEventListener("onError", "onPlayerError");
        initializePlayer();
      }
      
      // The "main method" of this sample. Called when someone clicks "Run".
      function loadPlayer() {
        // The video to load
        var videoID = "D6WThN_5GQs";//"Ao138HwSqow"
        // Lets Flash from another domain call JavaScript
        var params = { allowScriptAccess: "always" };
        // The element id of the Flash embed
        var atts = { id: "ytPlayer" };
        
        console.log("starting the swf object init");
        // All of the magic handled by SWFObject (http://code.google.com/p/swfobject/)
        swfobject.embedSWF("http://www.youtube.com/v/" + videoID + 
                           "?version=3&enablejsapi=1&playerapiid=player1", 
                           "videoDiv", "100%", "100%", "9", null, null, params, atts);
        console.log("SWF object created!");
      }
      
    /*  function init(){
      	var nameCategory=document.getElementById("name");
      	nameCategory.setAttribute
      }*/
     
      
      function _run() {
      	console.log("running!");
        loadPlayer();
        /*init();*/
      }
      
      console.log("made it here!");
      google.setOnLoadCallback(_run);
    </script>
	

	<body>
		<div id="popup">
			
		</div>
		
		<div id="sidepage" style="position:absolute; left:100%; top:0%; width:100%; height:100%; z-index:20; background-color: #ADF8BB">
			<div id="videoDiv"></div>
			
		</div>
		
		<?php
			include 'header.php';
		?>
		<?php
			include 'leftColumn.php';
		?>
		
		<div id="cont">
			
			<!--div id="rightColumn"></div-->
			<div id="library">
				
				<div id="libraryContainer">
					
					<div id="playlistScroll" style="margin:0px; padding:0px; height:100%;width:100%;overflow:auto;\">
					
					<?php
						include 'table.php';
					?>
						
					</div>

				</div>
					
					
					<?php
						
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
    					}//end if
	
						if($uID == 1){
							$query = "SELECT * FROM Songs";
						}
						else{
    						$query= "SELECT * FROM Songs INNER JOIN ((SELECT song FROM HasSong WHERE user=" .mysql_real_escape_string($uID). ") AS T) ON Songs.sID=T.song";
						}
						
						$sql=mysql_query($query);
    					//$sql=mysql_query("select * from Songs");
    					
						//counts the number of songs and stores them for communication with Javascript later
    					$index = 0;
						$songs= array();
						
						
    					while($row=mysql_fetch_assoc($sql)){
       						
							$vID = $row['vID'];
							$title = $row['title'];
							$time = $row['time'];
							$artist = $row['artist'];
							$plays = $row['plays'];
							$genre = $row['genre'];
							$sID = $row['sID'];
							$album = $row['album'];
							
							
							$songs[$index] = array('vID' => $vID, 'title' => $title, 'time' => $time, 'artist' => $artist, 'plays' => $plays, 'genre' => $genre, 'sID' => $sID, 'album' => $album);
							
							//increment the counter so that the next video gets the next index
							$index++;
						}//end while	
					
					
					?>
				
				<script type="text/javascript" src="js/editSongs.js"></script>
				<script type="text/javascript">
					var selected=-1;
					var progress=document.getElementById('completed');
					var loadedBar=document.getElementById('loaded');
					var titlePane=document.getElementById('titlePane');
					var artistPane=document.getElementById('artistPane');
					var playButton=document.getElementById('playImage');
					var songArray = [];
					var titleArray = [];
					var artistArray = [];
					var songStack = [];
   					var initialized = false; 
   					var selected="nameSel";
   					var shuffle=false;
   					var loop=0;
   					var index_map = new Object;
   					var currentSongPlaying = -1;
   					//arks when a user has just chosen a song. necessary because state change status -1 shows up both when a song ends and when the user chooses a new song.
   					var justChose = true;
   					var playing = null;
   					var playingImg = document.createElement("img");
   					playingImg.setAttribute("src", "images/sound_high.png");
   					playingImg.setAttribute("alt", ">");
   				
   					
   					
   					/**
   					 * Runs through all of the songs, and cues them into the player as a playlist
   					 */
   					function initializePlayer(){
   						<?php echo("var numSongs = $index;"); ?>
					
						//Prints the songs into javascript from PHP
						var num = parseInt(numSongs);
				 				<?php 
				 					//prints out the songID, title and author to be stored in Javascript
									print ("var songs = \"");
									foreach ($songs as $vid){
										$id = $vid['vID'];
										$num = $vid['sID'];
										$tit = $vid['title'];
										$artist = $vid['artist'];
										print("$id<>$tit<>$artist<>$num;");
									}
									print("\";");
								?>
						//console.log(songs);
						var infoArray = songs.split(";");
						
						
						//run through the info and store them in songArray, titleArray, and artistArray accordingly
						for(var i = 0; i < infoArray.length; i++){
							
							var spltArr = infoArray[i].split("<>");
							var id = spltArr[3];
							index_map[id] = i;
							
							songArray[i] = spltArr[0];
							titleArray[i] = spltArr[1];
							artistArray[i] = spltArr[2];
						}//end for
						console.log(songArray);
						if(ytplayer){
   							//set an event listener, and cue the playlist. 
   							ytplayer.addEventListener("onStateChange", "onPlayerStateChange");
   							ytplayer.addEventListener('onError', 'onPlayerError');
   							//ytplayer.cuePlaylist(songArray,0,0,"small");
   						}//end if
   						setInterval(updatePlayerInfo, 250);
   					}//end initialize player
   					
   					function onPlayerError(){
   						console.log('Error');
   					}
   					//Changes the class of a header when the user clicks on it 
      				function selectHeader(sender){
      					console.log("here");
      					var id = sender.getAttribute("id");
      					
      					//checks if that header is already selected. If not change it
      					if(selected != id){
      						var previous = document.getElementById(selected);
      						var cut = selected.indexof("Sel");
      						var newID = selected.slice(0,cut);
      						previous.setAttribute("id", newID);
      						selected = id + "Sel";
      						sender.setAttribute("id", id + "Sel");
      					}//end if
      				
      				}//end selectHeader
   					
   				
   					
   					function updatePlayerInfo(){
   						
   						if(ytplayer && ytplayer.getDuration){
   							
   							var length = ytplayer.getDuration();
   							var curTime = ytplayer.getCurrentTime();
   							var total = ytplayer.getVideoBytesTotal();
   							var loaded = ytplayer.getVideoBytesLoaded();
   							
   							var percent = curTime/length * 100;
   							var loadedPercent = loaded/total * 100;
   							
   							var stringPercent = percent.toString();
   							var stringLoaded = loadedPercent.toString();
   							progress.style.width = stringPercent.concat("%");
   							loadedBar.style.width = stringLoaded.concat("%");
   							/*console.log("UpdatingPlayerInfo");*/
   						}	
   					}
   					
   					/**
   					 * SetShuffle
   					 * Resets the shuffle value depending on its current value
   					 */
   					function setShuffle(sender){
   						if(shuffle){
   							sender.setAttribute("src", "images/shuffle50.png");
   							shuffle=false;
   						}//end if
   						else{
   							sender.setAttribute("src", "images/shuffleSel50.png");
   							shuffle=true;
   							console.log(shuffle);
   						}//end else
   					}//end setShuffle
   					
   					/**
   					 * setLoop
   					 * Sets the loop value to either no loop, loop, or single song loop
   					 */
   					function setLoop(sender){
   						if(loop==0){
   							if(ytplayer){
   								ytplayer.setLoop(true);
   							}
   							sender.setAttribute("src", "images/loopSel50.png");
   							loop =1;
   						}//end if
   						else if(loop==1){
   							sender.setAttribute("src", "images/loopSingleSel50.png");
   							loop=2;
   						}//end else if
   						else{
   							if(ytplayer){
   								ytplayer.setLoop(false);
   							}
   							sender.setAttribute("src", "images/loop50.png");
   							loop=0;
   						}//end else
   					}//end setLoop
   				
   					function chooseNextSong(next){
   						//loop!
   								if(loop==1){
   									console.log("here!");
   									var row = $(playing).next();
   									
   									if(next == 0){
   										row =$(playing).prev();
   									}
   									
   									
   									console.log(row);
   									if(row.length == 0){
   										console.log("here!");
   										
   										play(playing.parentNode.childNodes[2]);
   									}
   									else{
   										play(row[0]);
   									}
   								}
   								//if shuffle is set, play a random song
   								else if(shuffle == true){
   									
   									var nodes = playing.parentNode.childNodes;
   									
   									//ytplayer.stopVideo();
   									var nextSong=Math.floor(Math.random() * Object.keys(index_map).length);
   									
   									play(nodes[nextSong + 2]);
   									//console.log("Next song:" + nextSong + "\n\n");
   									//PlayIndex(nextSong);
   								}//end if
   								//TODO otherwise somehow determine the next song
   								else{
   									var row = $(playing).next();
   									
   									if(next == 0){
   										row =$(playing).prev();
   									}
   								
   									if(row.length > 0){
   										play(row[0]);	
   									}	
   								}
   					}
   				
   					function back(){
   						var curTime = ytplayer.getCurrentTime();
      					
      					if(curTime > 1){
      						play(songStack.pop());
      					}
      					else{
      						songStack.pop();
      						if(songStack.length > 0){
      							play(songStack.pop());	
      						}
      						
      					}
      					//chooseNextSong(0);
      				}
      
      				function forward(){
      					chooseNextSong(1);
      				}
      
   					//Handles the state changes accordingly
   					function onPlayerStateChange(newState){
   						//TODO When a song has ended, increment its play count, find the next song, and play that one
   						
						console.log(newState);
   						
   						if(newState == 0){
   							//if(justChose == false){
   								//console.log("Song ended " + shuffle + "  " + justChose);
   								if(loop==2){
   									console.log("Single Loop");
   									ytplayer.playVideo();
   									//ytplayer.stopVideo();
   									//PlayIndex(1);
   								}
   								else{
   									chooseNextSong(1);
   								}
   						}
   						else if(newState == 1){
   							playButton.src = "images/pause.png";
   						}
   						else if(newState == 2){
   							playButton.src = "images/play.png";
   						}
   					
   					}
   					
   					function play(sender){
						console.log("Play!");
			
						if(ytplayer){
						
							var songID = sender.getAttribute("id");
							var vID = sender.getAttribute("name");
							var songIndex = parseInt(songID);
							//ytplayer.playVideoAt(songIndex);
							
							songStack.push(sender);
							
							playing = sender;
							var play = sender.childNodes[0].childNodes[0];
							if(play == undefined){
								sender.childNodes[1].childNodes[1].appendChild(playingImg);
							}
							else{
								play.appendChild(playingImg);
							}
							
							
							titlePane.innerHTML = titleArray[songIndex];
   							artistPane.innerHTML = artistArray[songIndex];
   							
   							ytplayer.loadVideoById(vID);
						}
					}
					
					function deleteSong(sender){
						
						console.log(sender.parentNode.parentNode);
						
						var r = confirm("Are you sure you want to delete this song?");
						
						if (r==true){
 							var to_remove = sender.parentNode.parentNode.parentNode;
 							var sID = to_remove.getAttribute( "title");
 							
 							console.log(to_remove);
 							var url = "delete.php";
							url = url.concat("?sID=" + sID);
							console.log(url);
							$.get(url);
 							
 							to_remove.parentNode.removeChild(to_remove);
 							$("table").trigger("update"); 
  						}
						
					}
		
					function addPlaylist(){
						
						
					}
					
   					//Plays the song selected (called on a double click)
   					/*function Play(sender)
   					{
   						
   						var index = sender.getAttribute("id");
   						var splitIndex = index.split("_");
   						var vIndex = parseInt(splitIndex[1]);
   						
   						justChose = true;
   						currentSongPlaying = vIndex;
   						PlayIndex(vIndex);
   						
   					}//end play
   					
   					function PlayIndex(index){
   						setInterval(updatePlayerInfo, 250);
   						if(ytplayer){
   							var curIndex = index_map[index];
   							console.log("Index to play: " + curIndex + "   " + "apped fro index: " + index);
   							ytplayer.playVideoAt(curIndex);
   							titlePane.innerHTML = titleArray[curIndex];
   							artistPane.innerHTML = artistArray[curIndex];
   							var play = document.getElementById("playButton");
   							play.src = "images/pause.png";
   						}//end if
   					}//end playIndex*/
   					
   				</script>
			
						
			</div>
			
		
		
			
		</div>
		
		<?php
			include 'footer.php';
		?>
		
	</body>
</html>

<!--Body must be initialized to run this script! -->
<script src="js/dynamic_resize.js" type="text/javascript"></script>
<script src="js/selectPlaylist.js" type="text/javascript"></script>