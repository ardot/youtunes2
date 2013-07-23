var inputPlaylist = "<tr id=\"playlistInputRow\" class=\"playlist\" onclick=\"selectPlaylist(this);\">";
inputPlaylist = inputPlaylist.concat("<td class=\"playlistName\">");
inputPlaylist = inputPlaylist.concat("<input class=\"edit playlistInput\" type=\"text\"/>");
inputPlaylist = inputPlaylist.concat("</td> <td>");
inputPlaylist = inputPlaylist.concat("<img src=\"images/fucking_massive_check.png\" onclick=\"acceptPlaylistEdit(this);\"  alt=\"edit\"/>");
inputPlaylist = inputPlaylist.concat("<img src=\"images/delete-icon.png\" onclick=\"cancelPlaylistEdit(this);\" alt=\"delete\"/>");
inputPlaylist = inputPlaylist.concat("</td></tr>");

var inputPlaylistRef;
var editing = false;
var editingPlaylist;

var playlistInput;
var playlistName;

function addPlaylistInput() {
  console.log("here!");
	if (editing == false) {
		editing = true;
	} else {
		alert("You must finish editing one song before editing another!");
		return;
	}
  $("#user_playlists").append(inputPlaylist);

  inputPlaylistRef = $("#playlistInputRow")[0];
  playlistInput = $('.playlistInput')[0];
}

function editPlaylist(sender){

  addPlaylistInput();
  editingPlaylist = sender.parentNode.parentNode;

  editingPlaylist.setAttribute("style", "display:none");

  playlistDiv = $(editingPlaylist).find(".playlistP")[0];
  playlistName = playlistDiv.innerHTML;
  if (playlistName == undefined) {
    playlistName = "";
  }

  console.log( (String(playlistName).replace(/\s+/g, ' ')));
  playlistInput.setAttribute("value", (String(playlistName).replace(/\s+/g, ' ')));
}

function acceptPlaylistEdit(sender) {
  console.log(playlistInput.value);
  playlistDiv.innerHTML = playlistInput.value;

  // TODO insert ajax call to update DBs

  cancelPlaylistEdit(sender);
}

function cancelPlaylistEdit(sender) {
  editingPlaylist.setAttribute('style', '');
  inputPlaylistRef.parentNode.removeChild(inputPlaylistRef);
  editing = false;
}

function addNewPlaylist() {

}
