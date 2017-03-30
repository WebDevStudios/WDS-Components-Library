/**
* Tabs for PHP / HTML / SCSS
*/

( function() {

	// Grab our tab anchors.
	var tabLinks = document.getElementsByClassName( "tab-link" );

	// Loop over each anchor to set the click listener.
	for (var i = 0; i < tabLinks.length; i++) {

		tabLinks[i].addEventListener( 'click', function( e ) {

			// Stop the page from jumping.
			e.preventDefault;

			// Set up variables for links and content areas.
			var htmlOutput	= document.getElementById( 'html-output' ),
				htmlLink	= document.getElementById( 'html-link' ),
				phpOutput	= document.getElementById( 'php-output' ),
				phpLink		= document.getElementById( 'php-link' ),
				scssOutput	= document.getElementById( 'scss-output' ),
				scssLink	= document.getElementById( 'scss-link' );

		});
    }


})();
