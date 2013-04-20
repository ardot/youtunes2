var playlists = document.getElementsByClassName("playlist");
var selected = playlists[0];
playlists[0].setAttribute("id", "selectedHeader");

/**
 * method: selectPlaylist
 * 
 * Selects a given playlist by changing it's class. Also calls the filterSongs method to do the actual filtering
 * 
 */
function selectPlaylist(sender){
	console.log("here!");
	if (selected != sender) {
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
	
	
}

