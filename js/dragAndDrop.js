var isDown = false;   // Tracks status of mouse button
var playlistOver = null;

function hoverIn(sender) {
  console.log(isDown);
  console.log(clickedOnSong);
  if(isDown && clickedOnSong != null) {        // Only change css if mouse is down
    sender.style.border = "thin solid";
    playlistOver = sender;
  }
}

function hoverOut(sender) {
  console.log("and out");
  sender.style.border = "none" ;
  playlistOver = null;
}

$(document).ready(function(){

  $(document).mousedown(function() {
    isDown = true;      // When mouse goes down, set isDown to true
  })
  .mouseup(function() {
    isDown = false;    // When mouse goes up, set isDown to false
    // if the user has dragged from a song
    if (clickedOnSong != null && playlistOver != null) {
      console.log(playlistOver);
      if (playlistOver[0]) {
        var pID = playlistOver[0].getAttribute('name');
      } else {
        var pID = playlistOver.getAttribute('name');
      }
      var sID = clickedOnSong.getAttribute('title');

      playlist_to_song_assoc[pID].push(
        sID
      );
      var url = "addSongToPlaylist.php";
      url = url.concat("?pID=" + pID);
      url = url.concat("&sID=" + sID);
      $.ajax(url);
    }
    clickedOnSong = null;
    playlistOver = null;
  });

  $(".playlist").mouseover(function() {
    if(isDown && clickedOnSong != null) {        // Only change css if mouse is down
      $(this).css({border:"thin solid"});
      playlistOver = $(this);
    }
  });

  $(".playlist").mouseout(function() {
    $(this).css({border:"none"});
    playlistOver = null;
  });
});
