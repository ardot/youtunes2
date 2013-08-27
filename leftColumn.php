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
	           session_start();
	           $db = mysql_connect("localhost","root", "root");
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
                  "SELECT
                    sID
                  FROM
                    PlaylistHasSong
                  WHERE
                    pID='" .mysql_real_escape_string($pID). "'";
                $playlist_songs_results = mysql_query($playlist_query);
                $playlist_songs = array();
                $song_index = 0;

                while ($song = mysql_fetch_assoc($playlist_songs_results)) {
                  $to_print = $song['sID'];
                  print("<h id=\"test_printing\"> $to_print </h>");
                  $playlist_songs[$song_index] = array(
                    'sID' => $song['sID'],
                  );
                  $song_index++;
                }
                $song_to_print = $playlist_songs[0];
                print("<h id=\"test_printing\"> $song_to_print` </h>");
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

            <?php
              //Prints the playlist IDs and
               print("var playlists_printed = \"");
               foreach ($playlists as $pID => $z_playlist_songs) {
                 print("$pID: $z_playlist_songs");
                 foreach ($z_playlists_songs as $xyz => $xyz_playlist_song) {
                   print("$xyz <> $xyz_playlist_song <>");
                 }
               }
               print("\";");
            ?>
            console.log("Hitting the playlist printing");
            console.log(playlists_printed);
          </script>
				</ul>
				</div>
			</div>
		</div>
