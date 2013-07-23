<!--!DOCTYPE html>
<html-->
<!--head-->

<?php
	session_start();
?>
	<!--meta charset="utf-8">
	<title>Basic Tablesorter Demo</title>

	<!-- Demo styling -->
	<!--link href="docs/css/jq.css" rel="stylesheet"-->

	<!-- jQuery: required (tablesorter works with jQuery 1.2.3+) -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

	<!-- Pick a theme, load the plugin & initialize plugin -->
	<link href="css/theme.default.css" rel="stylesheet">
	<script src="js/jquery.tablesorter.min.js"></script>
	<script src="js/jquery.tablesorter.widgets.js"></script>

	<script>
	$(function(){
		$('table').tablesorter({
			sortList	   : [[3,0]],
			widgets        : ['zebra'],/* 'columns'],*/
			usNumberFormat : false,
			sortReset      : false,
			sortRestart    : true
		});
	});
	</script>
	<script type="text/javascript">
		var previousRow = null;


		function select(sender){


			if (previousRow == null){
				previousRow = sender;

			}
			else{
				var prevIndex = previousRow.getAttribute("class");
				if (prevIndex == "evenSel"){
					previousRow.setAttribute("class", "even");
				}
				else {
					previousRow.setAttribute("class", "odd");
				}

			}

			var evenOrOdd = sender.getAttribute("class");
			if (evenOrOdd == "even"){
				sender.setAttribute("class", "evenSel");
			}
			else {
				sender.setAttribute("class", "oddSel");
			}
			previousRow = sender;
		}

	</script>

<!--/head-->
<!--body-->
<!--div class="demo"-->


	<table class="tablesorter filterable more" id="songTable">
		<thead class="playlistCategory" style="position:fixed;margin-left:-22px;border-bottom:solid; border-width:thin; border-color:gray">
			<tr>
				<th width="20px" style="min-width:20px"></th>
				<th width="300px" style="min-width:300px">Name</th>
				<th width="60px" style="min-width:60px">Time</th>
				<th width="250px" style="min-width:250px">Artist</th>
				<th width="200px" style="min-width:200px">Album</th>
				<th width="100px" style="min-width:100px">Genre</th>
				<th width="100%">Edit</th>
			</tr>
		</thead>
		<tbody >




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

				$uID = $_SESSION['uid'];


				if($uID == 1){
					$query = "SELECT * FROM Songs";
				}
				else{
    				$queryi =
              "SELECT * FROM Songs
              INNER JOIN (
              (SELECT song FROM HasSong
                  WHERE user=" .mysql_real_escape_string($uID). ")
                  AS T) ON Songs.sID=T.song";
				}

				$sql=mysql_query($query);

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

					print("<tr id=$index title=$sID name=$vID ondblclick=\"play(this);\" onmousedown=\"select(this);\">
								<td width=\"20px\" style=\"min-width:20px;max-height:29px\">
									<div id=\"$index front\" style=\"width:100%;height:20px;overflow:hidden;\">

									</div>
								</td>
								<td width=\"316px\" style=\"min-width:316px;max-height:29px\">
									<div id=\"$index name\" style=\"width:100%;height:20px;overflow:hidden;\">
										$title
									</div>
								</td>
								<td width=\"16px\" style=\"min-width:76px;max-height:29px\">
								<div id=\"$index time\" style=\"width:100%;height:20px;overflow:hidden;\">
										$time
									</div>
								</td>
								<td width=\"266px\" style=\"min-width:266px;max-height:29px\">
									<div id=\"$index artist\" style=\"width:100%;height:20px;overflow:hidden;\">
										$artist
									</div>
								</td>
								<td width=\"216px\" style=\"min-width:216px;max-height:29px\">
									<div id=\"$index album\" style=\"width:100%;height:20px;overflow:hidden;\">
										$album
									</div>
								</td>
								<td width=\"116px\" style=\"min-width:116px;max-width:116px;max-height:29px\">
									<div id=\"$index genre\" style=\"width:100%;height:20px;overflow:hidden;\">
										$genre
									</div>
								</td>
								<td width=\"100%\">
									<div style=\"width:100%;height:20px;margin-left:5px;overflow:hidden;\">

											<!--$plays-->

											<img src=\"images/edit.png\" onclick=\"edit(this);\" alt=\"edit\"/>
											<img src=\"images/delete-icon.png\" onclick=\"deleteSong(this);\" alt=\"delete\"/>

									</div>
								</td>
						   </tr>");

					$songs[$index] = array('vID' => $vID, 'title' => $title, 'time' => $time, 'artist' => $artist, 'plays' => $plays, 'genre' => $genre, 'sID' => $sID, 'album' => $album);

					//increment the counter so that the next video gets the next index
					$index++;
				}//end while




			?>

		</tbody>
	</table>

<!--/div-->
<!--/body></html-->
