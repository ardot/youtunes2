<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>jQuery UI Dialog - Modal form</title>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <script src="/resources/demos/external/jquery.bgiframe-2.1.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css" />
    <style>
        body { font-size: 62.5%; }
        label, input { display:block; }
        input.text { margin-bottom:12px; width:95%; padding: .4em; }
        fieldset { padding:0; border:0; margin-top:25px; }
        h1 { font-size: 1.2em; margin: .6em 0; }
        div#users-contain { width: 350px; margin: 20px 0; }
        div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
        div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
        .ui-dialog .ui-state-error { padding: .3em; }
        .validateTips { border: 1px solid transparent; padding: 0.3em; }
    </style>
    <script>
    //$(function() {
        var name = $( "#name" ),
            artist = $( "#artist" ),
            album = $( "#album" ),
            genre = $( "#genre" ),
            allFields = $( [] ).add( name ).add( artist ).add( album ).add( genre ),
            tips = $( ".validateTips" );
 
        function updateTips( t ) {
            tips
                .text( t )
                .addClass( "ui-state-highlight" );
            setTimeout(function() {
                tips.removeClass( "ui-state-highlight", 1500 );
            }, 500 );
        }
 
        function checkLength( o, n, min, max ) {
            if ( o.val().length > max || o.val().length < min ) {
                o.addClass( "ui-state-error" );
                updateTips( "Length of " + n + " must be between " +
                    min + " and " + max + "." );
                return false;
            } else {
                return true;
            }
        }
 
        function checkRegexp( o, regexp, n ) {
            if ( !( regexp.test( o.val() ) ) ) {
                o.addClass( "ui-state-error" );
                updateTips( n );
                return false;
            } else {
                return true;
            }
        }
 
 		function launchPopup(){
 			
 			$("#dialog-form").dialog( "open");
 		}
 		
        $( "#dialog-form" ).dialog({
            autoOpen: false,
            height: 400,
            width: 450,
            modal: true,
            buttons: {
                "Edit Song": function() {
                    var bValid = true;
                    allFields.removeClass( "ui-state-error" );
 
                    bValid = bValid && checkLength( name, "name", 0, 256 );
                    bValid = bValid && checkLength( artist, "artist", 0, 256 );
                    bValid = bValid && checkLength( album, "album", 0, 256 );
                    bValid = bValid && checkLength( genre, "genre", 0, 256 );
 
                   /* bValid = bValid && checkRegexp( name, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
                    // From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
                    bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
                    bValid = bValid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
 					*/
 					
                    if ( bValid ) {
                        $( "#users tbody" ).append( "<tr>" +
                            "<td>" + name.val() + "</td>" + 
                            "<td>" + artist.val() + "</td>" + 
                            "<td>" + album.val() + "</td>" +
                            "<td>" + genre.val() + "</td>" +
                        "</tr>" ); 
                        $( this ).dialog( "close" );
                    }
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            },
            close: function() {
                allFields.val( "" ).removeClass( "ui-state-error" );
            }
        });
 
 
 		
        /*$( "#create-user" )
            .button()
            .click(function() {
                $( "#dialog-form" ).dialog( "open" );
            });*/
    //});
    </script>
</head>
<body>
 
<div id="dialog-form" title="Edit Song!">
    <p class="validateTips"></p>
 
    <form>
    <fieldset>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all" />
        <label for="email">Artist</label>
        <input type="text" name="artist" id="artist" value="" class="text ui-widget-content ui-corner-all" />
        <label for="password">Album</label>
        <input type="text" name="album" id="album" value="" class="text ui-widget-content ui-corner-all" />
        <label for="genre">Genre</label>
        <input type="text" name="genre" id="genre" value="" class="text ui-widget-content ui-corner-all" />
    </fieldset>
    </form>
</div>
 
 
<div id="users-contain" class="ui-widget">
    <h1>Existing Users:</h1>
    <table id="users" class="ui-widget ui-widget-content">
        <thead>
            <tr class="ui-widget-header ">
                <th>Name</th>
                <th>Album</th>
                <th>Artist</th>
                <th>Genre</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>John Doe</td>
                <td>john.doe@example.com</td>
                <td>johndoe1</td>
                <td>johndoe1</td>
            </tr>
        </tbody>
    </table>
</div>
<button id="create-user" onclick="launchPopup()">Create new user</button>
 
 
</body>
</html>