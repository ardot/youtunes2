var playlists = $('.playlist');
var selected = playlists[0];
var selected_playlist_id = null;
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
  selected_playlist_id = sender.getAttribute('name');
  var term = document.getElementById("searc");
  var table = document.getElementById("songTable");
  filterTable(term, table);
}

