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
										
inputRow = inputRow.concat("<img src=\"images/customCheck.png\" onclick=\"acceptEdit(this);\" alt=\"edit\"/>");
inputRow = inputRow.concat("<img src=\"images/customExit.png\" onclick=\"cancelEdit(this);\"  alt=\"delete\"/>");
											
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

var inputName;// = $('#inputName')[0];
var inputArtist;// = $('#inputArtist')[0];
var inputAlbum;// = $('#inputAlbum')[0];
var inputGenre;// = $('#inputGenre')[0];

function edit(sender){
						
	if(editing == false){
		editing = true;
	}
	else{
		alert("You must finish editing one song before editing another!");
		return;
	}
	//console.log(sender.parentNode.parentNode.parentNode);
	
	$("table tbody").append(inputRow); 
			
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
						
	console.log("ID" + id);
						
						
	//console.log(row.childNodes[3].childNodes[1].innerHTML);
	//console.log(inputRow.childNodes[3].childNodes[1].childNodes[1].value);
	nameDiv = document.getElementById(id + " name");//editingRow.childNodes[3].childNodes[1].innerHTML;
	artistDiv = document.getElementById(id + " artist");//editingRow.childNodes[7].childNodes[1].innerHTML;
	albumDiv = document.getElementById(id + " album");//editingRow.childNodes[9].childNodes[1].innerHTML;
	genreDiv = document.getElementById(id + " genre");//editingRow.childNodes[11].childNodes[1].innerHTML;*/
						
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
	//console.log(editingRow.childNodes[9].childNodes[1]);
						
	inputName.setAttribute("value", (String(nameVal).replace(/\s+/g, ' ')));
	inputArtist.setAttribute("value", (String(artistVal).replace(/\s+/g, ' ')));
	inputAlbum.setAttribute("value", (String(albumVal).replace(/\s+/g, ' ')));
	inputGenre.setAttribute("value", (String(genreVal).replace(/\s+/g, ' ')));
						
						
						
	select(input);
				
						
}
					
function acceptEdit(sender){
						
	console.log(sender.parentNode.parentNode);
						
	/*var r = confirm("Are you sure you want to finalize this edit?");
						
	if (r!=true){
		return;
  	}*/
  			
  			
  
  	nameDiv.innerHTML = inputName.value;
  	artistDiv.innerHTML = inputArtist.value;
  	albumDiv.innerHTML = inputAlbum.value;
  	genreDiv.innerHTML = inputGenre.value;
  	
  	input = document.getElementById("inputRow");					
	editingRow.setAttribute("style", "");
	input.parentNode.removeChild(input);
	
  	//ow.setAttribute("style", "display:none");
  	editing = false;
  	
  	$("table").trigger("update");
	
	var sID = editingRow.getAttribute("title");
	
	var url = "update.php";
	url = url.concat("?sID=" + sID);
	url = url.concat("&name=" + inputName.value);
	url = url.concat("&artist="+ inputArtist.value);
	url = url.concat("&album=" + inputAlbum.value);
	url = url.concat("&genre=" + inputGenre.value);

	//console.log(url);
	$.ajax(url);

	//console.log("INPUT" + input);
}
					
function cancelEdit(sender){
						
	console.log(sender.parentNode.parentNode);
						
	/*var r = confirm("Are you sure you want to close this edit?");
						
	if (r!=true){
 		return;
  	}*/
  	//inputRow.parentNode.insertBefore(editingRow, row);
  	editingRow.setAttribute("style", "");
  	console.log("INPUT" + input);
	input.parentNode.removeChild(input);
  						
  	editing = false;
  					
						
}