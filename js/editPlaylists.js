var inputPlaylist = "<tr id=\"playlistInputRow\" class=\"playlist\" onclick=\"selectPlaylist(this);\">";
inputPlaylist = inputPlaylist.concat("<td class=\"playlistName\">");
inputPlaylist = inputPlaylist.concat("<input class=\"edit playlistInput\" type=\"text\"/>");
inputPlaylist = inputPlaylist.concat("</td> <td>");
inputPlaylist = inputPlaylist.concat("<p><img src=\"images/fucking_massive_check.png\" onclick=\"acceptPlaylistEdit(this);\"  alt=\"edit\"/>");
inputPlaylist = inputPlaylist.concat("<img src=\"images/delete-icon.png\" onclick=\"cancelPlaylistEdit(this);\" alt=\"delete\"/></p>");
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
		alert("You must finish editing one song before editing another.");
		return;
	}
  $("#user_playlists").append(inputPlaylist);

  inputPlaylistRef = $("#playlistInputRow")[0];
  playlistInput = $('.playlistInput')[0];
}

function editPlaylist(sender){

  addPlaylistInput();
  editingPlaylist = sender.parentNode.parentNode.parentNode;

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

// Handles deleting a playlist
function deletePlaylist(sender) {

  var r = confirm("Are you sure you want to delete this playlist?");
  if (r) {
    var toRemove = sender.parentNode.parentNode;
    toRemove.parentNode.removeChild(toRemove);
  }
}

function addNewPlaylist() {
  if (editing == false) {
		editing = true;
	} else {
		alert("You must finish editing a playlist before adding a new playlist.");
		return;
	}

  // Create dynamically to maintain a reference to these elements
  var newPlaylist = document.createElement('tr');
  newPlaylist.setAttribute('class', 'playlist');
  newPlaylist.setAttribute('onclick', 'selectPlaylist(this);');
  newPlaylist.setAttribute('style', 'display:none');
  editingPlaylist = newPlaylist;

  var newPlaylistName = document.createElement('td');
  newPlaylistName.setAttribute('class', 'playlistName');

  var newPlaylistP = document.createElement('p');
  newPlaylistP.setAttribute('class', 'playlistP');
  playlistDiv = newPlaylistP;

  var editImages = document.createElement('td');
  editImages.innerHTML = "<p><img src=\"images/edit.png\" onclick=\"editPlaylist(this);\" alt=\"edit\"/><img src=\"images/delete-icon.png\" onclick=\"deletePlaylist(this);\" alt=\"delete\"/></p>";

  newPlaylistName.appendChild(newPlaylistP);
  newPlaylist.appendChild(newPlaylistName);
  newPlaylist.appendChild(editImages);

  $("#user_playlists").append(newPlaylist);
  $("#user_playlists").append(inputPlaylist);

  inputPlaylistRef = $("#playlistInputRow")[0];
  playlistInput = $('.playlistInput')[0];
}
