<div id="leftColumn">
	<div id="playlistContainer">

		<div id="playlistScroll"
      style="margin:0px;
      padding:0px;
      height:500px;
      width:227px;
      font:16px/26px Georgia, Garamond, Serif;
      overflow:auto;">
				<ul id="playlista">
					<li class="playlistCategory">
						<p>
								All Music
						</p>
					</li>
					<table class="playlistCategoryTable">
							<tr class="playlist" onclick="selectPlaylist(this);">
								<td class="playlistName">
									<p class="playlistP">
										My Library
									</p>
								</td>
							</tr>
					</table>

					<li class="playlistCategory">
							<p class="auto_cursor">
								My Playlists
							</p>
					</li>
					<table id="user_playlists" class="playlistCategoryTable">

          <?php

				    include 'constants.php';
            session_start();

            $db = mysql_connect("localhost", DB_HOST, DB_USERNAME);

             //check to see if the database was connected to successfully
             if (!$db) {
                echo "Could not connect to database" . mysql_error();
                exit();
             }
             // try to connect to the specific database, kill the thread if not
             $db_name = "youtunes";
             if (!mysql_select_db($db_name, $db)){
               die ("Could not select database") . mysql_error();
             }

             $uID = $_SESSION['uid'];

             $query=
                "SELECT * FROM Playlists
                  INNER JOIN (
                    (SELECT
                      pID
                    FROM
                      UserHasPlaylist
                    WHERE
                      uID=" .mysql_real_escape_string($uID). ")
                  AS T)
                  ON Playlists.pID=T.pID";

		          $sql=mysql_query($query);

              $playlists = array();
              $playlist_index = 0;

		          while ($row=mysql_fetch_assoc($sql)) {
                $playlist_name = $row['name'];
                $pID = $row['pID'];
                $playlist_query =
                  "SELECT *
                  FROM  `PlaylistHasSong`
                  WHERE  `pID` =" .mysql_real_escape_string($pID);
                $playlist_songs_results = mysql_query($playlist_query);
                $playlist_songs = array();
                $song_index = 0;

                while ($song = mysql_fetch_assoc($playlist_songs_results)) {
                  $to_print = $song['sID'];
                  $playlist_songs[$song_index] = $to_print;

                  // print("<h> $song_index --- $to_print </h>");
                  /*array(
                    'sID' => $song['sID'],
                  );*/
                  $song_index++;
                }


                $playlists[$pID] = $playlist_songs;
                $playlist_index++;
                print(
                  "<tr name=\"$pID\" class=\"playlist\" onclick=\"selectPlaylist(this);\">
                    <td class=\"playlistName\">
                      <p class=\"playlistP\">
                        $playlist_name
                      </p>
                    </td>
                    <td>
                      <p>
                      <img src=\"images/edit.png\"
                        onclick=\"editPlaylist(this);\"
                        alt=\"edit\"/>
                      <img src=\"images/delete-icon.png\"
                        onclick=\"deletePlaylist(this);\"
                        alt=\"delete\"/>
                      </p>
                    </td>
                  </tr>");

              }
					?>
          </table>
          <script type="text/javascript">
            function implodeArray(text) {
              if (text == "") {
                return [];
              } else {
                return text.split("<>");
              }
            }
            <?php
              //Prints the playlist IDs and
               print("var playlists_printed = \"");
               print(implode("<>", array_keys($playlists)));
               print("\";");

               print("var playlists_songs_printed = \"");

               foreach ($playlists as $pID => $z_playlist_songs) {
                 $imploded = implode("<>", $z_playlist_songs);
                 print("$imploded<|>");
               }
               print("\";");
            ?>
            // parse the text printed from PHP into javascript data
            var playlist_info_array = playlists_printed.split("<>");
            var playlist_song_info_array = playlists_songs_printed.split("<|>");
            playlist_song_info_array =
              playlist_song_info_array.slice(
                0,
                playlist_song_info_array.length - 1);
            playlist_song_info_array =
              playlist_song_info_array.map(implodeArray);
            // combine the arrays into an associative array
            var playlist_to_song_assoc = new Object();
            for (var i=0; i<playlist_info_array.length; i++) {
              playlist_to_song_assoc[playlist_info_array[i]] = playlist_song_info_array[i];
            }
          </script>
				</ul>
				</div>
			</div>
		</div>
