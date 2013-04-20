/*function initialize(){*/
	/*var playlistPane = document.getElementById("playlistScroll");
	*/
	
	setInterval(resize, 10);
	
/*}*/


function resize(){
	
	var playlistPane = document.getElementById("playlistScroll");
	var libraryPane = document.getElementById("libraryContainer");
	
	var docHeight = getDocHeight();
	
	playlistPane.style.height = (docHeight - 200).toString() + "px";
	libraryPane.style.height = (docHeight - 200).toString() +"px";
}

function getDocHeight() {
    var D = document;
    return Math.max(
        Math.max(D.body.scrollHeight, D.documentElement.scrollHeight),
        Math.max(D.body.offsetHeight, D.documentElement.offsetHeight),
        Math.max(D.body.clientHeight, D.documentElement.clientHeight)
    );
 /*  	var body = document.body,
   	html = document.documentElement;

	return Math.max( body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight );
*/}