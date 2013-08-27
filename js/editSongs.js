var inputRow = "<tr id=\"inputRow\" style=\"display:none\" onmousedown=\"select(this);\">";
inputRow = inputRow.concat("<td width=\"20px\" style=\"min-width:20px;max-height:29px\">");
inputRow = inputRow.concat("<div style=\"width:100%;height:20px;overflow:hidden;\">");

inputRow = inputRow.concat("</div>");
inputRow = inputRow.concat("</td>");
inputRow = inputRow.concat("<td width=\"306px\" style=\"min-width:316px;max-height:29px\">");
inputRow = inputRow.concat("<div style=\"width:100%;height:20px;overflow:hidden;\">");
inputRow = inputRow.concat("<input id=\"inputName\" style=\"min-width:306px;\" class=\"edit\" type=\"text\" name=\"firstname\">");
inputRow = inputRow.concat("</div>");
inputRow = inputRow.concat("</td>");
inputRow = inputRow.concat("<td width=\"16px\" style=\"min-width:76px;max-height:29px\">");
inputRow = inputRow.concat("<div style=\"width:100%;height:20px;overflow:hidden;\">");
inputRow = inputRow.concat("</div> ");
inputRow = inputRow.concat("</td>");
inputRow = inputRow.concat("<td width=\"256px\" style=\"min-width:256px;max-height:29px\">");
inputRow = inputRow.concat("<div style=\"width:100%;height:20px;overflow:hidden;\">");
inputRow = inputRow.concat("<input id=\"inputArtist\" style=\"min-width:256px;\"  class=\"edit\" type=\"text\" name=\"firstname\">");
inputRow = inputRow.concat("</div>");
inputRow = inputRow.concat("</td>");
inputRow = inputRow.concat("<td width=\"206px\" style=\"min-width:216px;max-height:29px\">");
inputRow = inputRow.concat("<div style=\"width:100%;height:20px;overflow:hidden;\">");
inputRow = inputRow.concat("<input id=\"inputAlbum\" style=\"min-width:206px;\" class=\"edit\" type=\"text\" name=\"firstname\">");
inputRow = inputRow.concat("</div>");
inputRow = inputRow.concat("</td>");
inputRow = inputRow.concat("<td width=\"106px\" style=\"min-width:106px;max-height:29px\">");
inputRow = inputRow.concat("<div style=\"width:100%;height:20px;overflow:hidden;\">");
inputRow = inputRow.concat("<input id=\"inputGenre\" style=\"max-width:106px;\" class=\"edit\" type=\"text\" name=\"firstname\">");
inputRow = inputRow.concat("</div>");
inputRow = inputRow.concat("</td>");
inputRow = inputRow.concat("<td width=\"100%\">");
inputRow = inputRow.concat("<div style=\"width:100%;height:20px;margin-left:5px;overflow:hidden;\">");

inputRow = inputRow.concat("<!--$plays-->");

inputRow = inputRow.concat("<img src=\"images/fucking_massive_check.png\" onclick=\"acceptEdit(this);\" alt=\"edit\"/>");
inputRow = inputRow.concat("<img src=\"images/delete-icon.png\" onclick=\"cancelEdit(this);\"  alt=\"delete\"/>");

inputRow = inputRow.concat("</div>");
inputRow = inputRow.concat("</td>");
inputRow = inputRow.concat("</tr>");

var input;
var editing=false;
var editingRow;

var nameVal;
var artistVal;
var albumVal;
var genreVal;

var nameDiv;
var artistDiv;
var albumDiv;
var genreDiv;

var inputName;
var inputArtist;
var inputAlbum;
var inputGenre;

function edit(sender){

  // Check if user is currently editing
	if(editing == false){
		editing = true;
	}
	else{
		alert("You must finish editing one song before editing another!");
		return;
  }

	$("#songTable").append(inputRow);

	inputName = $('#inputName')[0];
	inputArtist = $('#inputArtist')[0];
	inputAlbum = $('#inputAlbum')[0];
	inputGenre = $('#inputGenre')[0];

	editingRow = sender.parentNode.parentNode.parentNode;
	input = document.getElementById("inputRow");

	input.setAttribute("style","");
	editingRow.setAttribute("style", "display:none");
	editingRow.parentNode.insertBefore(input, editingRow);

	var id = editingRow.getAttribute("id");

  // Grab the divisions that contain relevant data
	nameDiv = document.getElementById(id + " name");
	artistDiv = document.getElementById(id + " artist");
	albumDiv = document.getElementById(id + " album");
	genreDiv = document.getElementById(id + " genre");

	nameVal = nameDiv.innerHTML;
	artistVal = artistDiv.innerHTML;
	albumVal = albumDiv.innerHTML;
	genreVal = genreDiv.innerHTML;

	if(nameVal == undefined){
		nameVal = "";
	}
	if(artistVal == undefined){
		artistVal = "";
	}
	if(albumVal == undefined){
		albumVal = "";
	}
	if(genreVal == undefined){
		genreVal = "";
	}

	inputName.setAttribute("value", (String(nameVal).replace(/\s+/g, ' ')));
	inputArtist.setAttribute("value", (String(artistVal).replace(/\s+/g, ' ')));
	inputAlbum.setAttribute("value", (String(albumVal).replace(/\s+/g, ' ')));
	inputGenre.setAttribute("value", (String(genreVal).replace(/\s+/g, ' ')));

	select(input);
}

/**
* When edit is complete.
* Called when the user clicks the green checkmark after starting an edit
*
* TODO run  when the user hits "enter" with an open edit as well
*/
function acceptEdit(sender){
  nameDiv.innerHTML = inputName.value;
  artistDiv.innerHTML = inputArtist.value;
  albumDiv.innerHTML = inputAlbum.value;
  genreDiv.innerHTML = inputGenre.value;

  input = document.getElementById("inputRow");
	editingRow.setAttribute("style", "");
	input.parentNode.removeChild(input);

  editing = false;

  $("table").trigger("update");

	var sID = editingRow.getAttribute("title");
  var sIndex = parseInt(editingRow.getAttribute("id"));

  titleArray[sIndex] = inputName.value;
  artistArray[sIndex] = inputArtist.value;

	var url = "update.php";
	url = url.concat("?sID=" + sID);
	url = url.concat("&name=" + inputName.value);
	url = url.concat("&artist="+ inputArtist.value);
	url = url.concat("&album=" + inputAlbum.value);
	url = url.concat("&genre=" + inputGenre.value);

	$.ajax(url);
}

function cancelEdit(sender){
  editingRow.setAttribute("style", "");
	input.parentNode.removeChild(input);
  editing = false;
}
