var playlists = $('.playlist');
var selected = playlists[0];
playlists[0].setAttribute("id", "selectedHeader");
console.log(playlists);
console.log(selected);
/**
 * method: selectPlaylist
 *
 * Selects a given playlist by changing it's class. Also calls the filterSongs method to do the actual filtering
 *
 */
function selectPlaylist(sender){
	if (selected != sender) {
	  console.log(playlists);
    console.log(selected);

    selected.setAttribute("id", "");
		selected = sender;
		selected.setAttribute("id", "selectedHeader");
		filterSongs(sender);
  }
}

/**
 * method: filterSongs
 *
 * Takes filters the songs based on what playlist they are in.
 *
 * TODO: Implement this!
 */
function filterSongs(sender){
  var pID = sender.getAttribute('name');

  if (!pID) {
    // pID will be null for the main "Library"
    console.log("Reveal all songs");
  } else {
    var playlist_songs = playlists[pID];
    console.log(playlist_songs);
  }

}

