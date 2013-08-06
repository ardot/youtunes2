var up = false;
var first = true;
var found = false;

var name, artist, album, genre;

function secondstotime(secs)
{
    var t = new Date(1970,0,1);
    t.setSeconds(secs);
    var s = t.toTimeString().substr(0,8);
    if(secs > 86399)
    	s = Math.floor((t - Date.parse("1/1/70")) / 3600000) + s.substr(2);
    return s;
}


function SearchiTunes(sender) {

	var stop_list = ['-', 'lyrics', '&amp;', 'ft', 'feat', '+', '&', '.', ',', '/', 'w/', 'official music video', 'music video', '"'];//, 'in', 'the', 'description', 'full', 'studio', 'version', 'live', 'on'];
	var open_types = ['[', '{', '('];
	var close_types = [']', '}', ')'];


	var query = sender.innerHTML;
	query = query.toLowerCase();

	var counter = 0;



	//run through all types of opens/closes and cut out anything inside of them.
	for(counter; counter < open_types.length; counter++){
		//query.replace("[[{(].*[})]", "");
		var i = query.indexOf(open_types[counter]);
		var i2 = query.indexOf(close_types[counter]);

		if(i >= 0 && i2 >= 0){

			query = query.substring(0,i) + query.substring(i2 + 2, query.length);
			//query.replace(str, "");
		}
	}

	//run through all the stoplist terms and remove them
	for(counter = 0; counter < stop_list.length; counter++){
		while(query.indexOf(stop_list[counter]) > 0){
			query = query.replace(stop_list[counter], " ");
		}
	}//end for

	query = query.trim();
	var to_query = query.split(" ").join("+");


	console.log("Searching iTunes for: " + to_query + "\n\n");

	$.when(
		$.ajax({
      		url: 'http://itunes.apple.com/search?media=music&limit=1&term=' + to_query,
        	dataType: 'jsonp',
        	success: function (data) {

        		if(data.results[0] == undefined){
        			console.log("Count not find in store!");
        			var id = sender.id;
        			var title = sender.innerHTML;
        			//createForm(id, title);
        			found = false;
        		}
        		else{
        			console.log(data.results[0]);
        			name = data.results[0].trackName;
        			artist = data.results[0].artistName;
        			album = data.results[0].collectionName;
        			genre = data.results[0].primaryGenreName;
        			found = true;
        		}

        		if(name == undefined){
        			name = "";
        		}
        		if(artist== undefined){
        			artist = "";
        		}
        		if(album == undefined){
        			album = "";
        		}
        		if(genre == undefined){
        			genre = "";
        		}
        	},
        	error: function () {
            	alert("Error in searching iTunes store!");
        	}
    	})
 ).then(function(){


  // blank out form fields if empty
 	if(found != true){
    name = '';
    artist = '';
    album = '';
    genre = '';
 	}





 	var id = sender.getAttribute("id");
	var time = sender.getAttribute("name");
	var plays = 0;


    var droplist = ['\'', ',', '<', '>', '(', ')', '{', '}', '[', ']', '|', '\\', '^', '~', '#', '%', ';', '/', '?', ':', '@', '='];

  	//run through all the stoplist terms and remove them
	for(counter = 0; counter < droplist.length; counter++){
		console.log("Checking! " + droplist[counter]);

		while(album.indexOf(droplist[counter]) > 0){
			album = album.replace(droplist[counter], "");
		}
		while(genre.indexOf(droplist[counter]) > 0){
			genre = genre.replace(droplist[counter], "");
		}
		while(name.indexOf(droplist[counter]) > 0){
			name = name.replace(droplist[counter], "");
		}
		while(artist.indexOf(droplist[counter]) > 0){
			artist = artist.replace(droplist[counter], "");
		}
	}//end for

    console.log(id + "  " + name + "  " + artist);

   //console.log("SongArray" + songArray);
   //console.log("TitleArray" + titleArray);
   //console.log("ArtistArray" + artistArray);

   //console.log("SongArray" + songArray);
   //console.log("TitleArray" + titleArray);
   //console.log("ArtistArray" + artistArray);



    var new_time = secondstotime(time);

    var sID;
 	var url = "add.php";
	url = url.concat("?album=" + album);
	url = url.concat("&vID=" + id);
	url = url.concat("&plays=0");
	url = url.concat("&genre=" + genre);
	url = url.concat("&title=" + name);
	url = url.concat("&time=" + new_time);
	url = url.concat("&artist=" + artist);

	console.log(url);
	//?album=testAlbum&vID=testID&plays=0&genre=HipHop&title=title&time=00:00:00&artist=tim

	$.get(url).done(function(data) {
  	sID = data;


    var index = songArray.length;

    var html = "<tr id=\"" + index + "\"title=\"" + sID + "\" name=\"" + id + "\" ondblclick=\"play(this);\" onmousedown=\"select(this);\">";
   	html = html.concat("<td width=\"20px\" style=\"min-width:20px;max-height:29px\">");
   	html = html.concat("<div id=\"" + index + " front\" style=\"width:100%;height:20px;overflow:hidden;\"></div></td>");
    html = html.concat("<td width=\"316px\" style=\"min-width:316px;max-height:29px\">");
    html = html.concat("<div id=\"" + index + " name\" style=\"width:100%;height:20px;overflow:hidden;\">" + name + "</div></td>");
    html = html.concat("<td width=\"16px\" style=\"min-width:76px;max-height:29px\">");
    html = html.concat("<div id=\"" + index + " time\" style=\"width:100%;height:20px;overflow:hidden;\">" + new_time + "</div></td>");
    html = html.concat("<td width=\"266px\" style=\"min-width:266px;max-height:29px\">");
    html = html.concat("<div id=\"" + index + " artist\" style=\"width:100%;height:20px;overflow:hidden;\">" + artist + "</div></td>");
    html = html.concat("<td width=\"216px\" style=\"min-width:216px;max-height:29px\">");
    html = html.concat("<div id=\"" + index + " album\" style=\"width:100%;height:20px;overflow:hidden;\">" + album + "</div></td>");
    html = html.concat("<td width=\"116px\" style=\"min-width:116px;max-height:29px\">");
    html = html.concat("<div id=\"" + index + " genre\" style=\"width:100%;height:20px;overflow:hidden;\">" + genre + "</div></td>");
    html = html.concat("<td width=\"100%\"><div style=\"width:100%;height:20px;margin-left:5px;overflow:hidden;\"><!--$plays--><img src=\"images/edit.png\" onclick=\"edit(this);\"  alt=\"edit\"/><img src=\"images/delete-icon.png\" onclick=\"deleteSong(this);\" style=\"margin-left:5px\" alt=\"delete\"/></div></td></tr>");

    $("#songTable").append(html);
    // let the plugin know that we made a update
    $("#songTable").trigger("update");

   songArray.push(id);
   titleArray.push(name);
   artistArray.push(artist);

    var indexString = index.toString();

    console.log("Index String" + indexString);

    var justAdded = document.getElementById(indexString);

    console.log(justAdded);
    var toJump = $(justAdded).prev()[0].id;

    select(justAdded);
    play(justAdded);

    var url = "#" + toJump;
    window.location = url;
    });
 });

//album', 'vID', 'plays', 'genre', 'sID', 'title', 'time', 'artist')

	/*&$Query.ajax({
		type: "POST", // Post / Get method
		url: "add.php", //Where form data is sent on submission
		dataType:"text", // Data type, HTML, json etc.
		data:myData, //Form variables
		success:function(response){
		//If we get success response hide content user wants to delete.
			$(‘#item_’+DbNumberID).fadeOut("slow");
		},
		error:function (xhr, ajaxOptions, thrownError){
			//On error, we alert user
			alert(thrownError);
		}
	});*/
	var searchBar = document.getElementById("queryinput");
	searchBar.setAttribute("value", "search youtube");
	contractSearch(true);

    return false;
}



function printSongYTInfo(query){

	console.log("Query: " + query);

	query = "uRfNGQdVcOA";
	$.ajax({
        url: 'http://gdata.youtube.com/feeds/mobile/videos?alt=json-in-script&max-results=1&q=' + query,
        dataType: 'jsonp',
        success: function (data) {
            var to_print = "";

            console.log("Data: " + data);

            for (i = 0; i < data.feed.entry.length; i++) {

            	var id_path = data.feed.entry[i].id.$t;
            	var id_split = id_path.split("/");
            	var id = id_split[id_split.length - 1];

            	to_print += "<div>";
				to_print += "<div style=\"border:solid;border-width:thin; border-color:gray; border-radius:8px; width:50%; margin-top:10px; position:float; margin-left:auto; margin-right:auto\">";
				to_print +=	"<img width=\"120px\" height=\"80px\" style=\"float:left; margin-right:10px;\" src=\"" + data.feed.entry[i].media$group.media$thumbnail[0].url +  "\"> ";
				to_print += "<div style=\"padding:10px;\">";
				to_print += "<div>" + data.feed.entry[i].media$group.media$title.$t + "</div>";
				to_print += "<div>by" + data.feed.entry[i].author[0].name.$t + "</div";
				to_print += "<div>" + data.feed.entry[i].yt$statistics.viewCount + " views </div></div></div></div>";

				console.log(to_print);
				return to_print;


            }

        },
        error: function () {
            alert("Error loading youtube video results");
            return "";
        }
    });

    console.log("ending this!");
    return "";
}

function SearchYouTube(query) {
	if(first == true){
		var input = document.getElementById("queryinput");
		input.value = "";
		first = false;
	}
	expandSearch();
    $.ajax({
        url: 'http://gdata.youtube.com/feeds/mobile/videos?alt=json-in-script&max-results=20&q=' + query,
        dataType: 'jsonp',
        success: function (data) {
            var row = "";
            for (i = 0; i < data.feed.entry.length; i++) {

            	var id_path = data.feed.entry[i].id.$t;
            	var id_split = id_path.split("/");
            	var id = id_split[id_split.length - 1];

                row += "<div class='search_item'>";
                row += "<table width='100%'>";
                row += "<tr>";
                row += "<td vAlign='top' align='left'>";
                row += "<a href='#' ><img width='120px' height='80px' src=" + data.feed.entry[i].media$group.media$thumbnail[0].url + " /></a>";
                row += "</td>";
                row += "<td vAlign='top' width='100%' align='left'>";
                row += "<a href='#' ><b id=\"" + id + "\" name = \"" + data.feed.entry[i].media$group.yt$duration.seconds + "\" onclick=\"SearchiTunes(this);\">" + data.feed.entry[i].media$group.media$title.$t + "</b></a><br/>";
                row += "<span style='font-size:12px; color:#555555'>by " + data.feed.entry[i].author[0].name.$t + "</span><br/>";
                row += "<span style='font-size:12px' color:#666666>" + data.feed.entry[i].yt$statistics.viewCount + " views" + "<span><br/>";
                row += "</td>";
                row += "</tr>";
                row += "</table>";
                row += "</div>";
            }
            console.log("adding row!");
            document.getElementById("search-results-block").innerHTML = row;
        },
        error: function () {
            alert("Error loading youtube video results");
        }
    });

    return false;
}

function createForm(vID, name){
	console.log("Creating the form!\n");

	var popup = document.getElementById("popup")
	var to_add = "";

	var videoInfo = printSongYTInfo(vID);

	console.log("videoInfo: " + videoInfo);

	to_add += videoInfo;
	to_add += "<div style=\"border:solid;border-width:thin; background-color:white; width:728px; height:450px; position:fixed; left:50%; top:50%; margin-left:-364px; margin-top:-225px; border-radius:8px; z-index:25\">";
	/*to_add += "<div style=\"background-color:rgba(255,120,120,1); border-top-left-radius:8px; border-top-right-radius:8px; max-height:35px;height:35px;\">";
	to_add += "<div class=\"playlistCategory\" style=\"text-align:center;  padding-left:5px;padding-top:5px;\">";
	to_add += "Edit Song </div></div><div>"
	to_add += "<div style=\"border:solid;border-width:thin; border-color:gray; border-radius:8px; width:50%; margin-top:10px; position:float; margin-left:auto; margin-right:auto\">";
	to_add += "<img width=\"120px\" height=\"80px\" style=\"float:left; margin-right:10px;\" src=\"http://i.ytimg.com/vi/3WN7Lsx0KYU/0.jpg\">";
	to_add += "<div style=\"padding:10px;\">";
	to_add += "<div> Test title of video</div>";
	to_add += "<div>by Test video </div>";
	to_add += "<div> 1000000 views </div></div></div></div>"*/


	to_add += "<div style=\"padding:10px;\">"
	to_add += "<p>Name: </p>";
	to_add += "<input type=\"text\" style=\"width:97%; margin-top:2px;margin-bottom:6px;\" name=\"name\"/>";
	to_add += "<p>Artist: </p>";
	to_add += "<input type=\"text\" style=\"width:97%; margin-top:2px;margin-bottom:6px;\" name=\"artist\"/>";
	to_add += "<p> Album: </p>";
	to_add += "<input type=\"text\" style=\"width:97%; margin-top:2px;margin-bottom:6px;\" name=\"album\"/>";
	to_add += "<p> Genre: </p>";
    to_add += "<input type=\"text\" style=\"width:97%; margin-top:2px;margin-bottom:6px;\" name=\"genre\"/>";
    to_add += "<button style=\"position:relative; margin-top:10px; left:70%\" type=\"submit\" id=\"submit\">Submit</button>";
    to_add += "<button style=\"position:relative; left:70%\" type=\"submit\" id=\"cancel\">Cancel</button></div></div>";


    popup.innerHTML = to_add;

}

/**
 * ExpandSearch
 *
 * Expands the "youtube" search pane so the user can view the results
 */
function expandSearch(){
	var searchPane = document.getElementById("ytsearch");
	var resultPane = document.getElementById("resultPane");
	var upOrDown = document.getElementById("upordown");
  var smiley = document.getElementById('smileyImage');

  smiley.setAttribute('src', 'images/smiley2.png');
  upOrDown.setAttribute("src", "images/down.png");
	searchPane.setAttribute("class", "ytopen");
	resultPane.style.display = "block";
}

/**
 * contractSearch
 *
 * Contracts the "youtube" search pane so the user can view the music table
 */
function contractSearch(insert){
	var searchPane = document.getElementById('ytsearch');
	var resultPane = document.getElementById('resultPane');
	var upOrDown = document.getElementById('upordown');
  var smiley = document.getElementById('smileyImage');

  if (insert) {
    smiley.setAttribute('src', 'images/smiley1.png');
    setTimeout(function(){
      smiley.setAttribute('src', 'images/smiley3.png');
    }, 3000);
  } else {
    smiley.setAttribute('src', 'images/smiley3.png');
  }

	searchPane.setAttribute('class', 'ytclosed');
	resultPane.style.display = 'none';
	upOrDown.setAttribute('src', 'images/up.png');
}

function searchChange(){
	if(up == true){
		contractSearch(false);
		up = false;
	}
	else{
		expandSearch();
		up = true;
	}
}

function clear(){


}
