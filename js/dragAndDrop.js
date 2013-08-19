$(document).ready(function(){
  var isDown = false;   // Tracks status of mouse button
  var playlistOver = null;

  $(document).mousedown(function() {
    isDown = true;      // When mouse goes down, set isDown to true
  })
  .mouseup(function() {
    isDown = false;    // When mouse goes up, set isDown to false
    // if the user has dragged from a song
    if (clickedOnSong != null && playlistOver != null) {
      console.log("Drag and drop, like a boss");
    }
    clickedOnSong = null;
    playlistOver = null;
  });

  $(".playlist").mouseover(function(){
    if(isDown && clickedOnSong != null) {        // Only change css if mouse is down
       $(this).css({border:"thin solid"});
       playlistOver = $(this);
    }
  });

  $(".playlist").mouseout(function(){
    $(this).css({border:"none"});
    playlistOver = null;
  });

});
