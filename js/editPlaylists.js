var inputRow = "<input class=\"playlistInput\" type=\"text\"/>";
var editing = false;

function editPlaylist(sender){
						
	if(editing == false){
		editing = true;
	}
	else{
		alert("You must finish editing one song before editing another!");
		return;
	}