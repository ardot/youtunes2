

function SearchiTunes(query) {
	
	$.ajax({
        url: 'http://itunes.apple.com/search?media=music&limit=1&term=' + query,
        dataType: 'jsonp',
        success: function (data) {
        	console.log(data);
        },
        error: function () {
            alert("Error loading youtube video results");
        }
    });
    
    return false;
}
