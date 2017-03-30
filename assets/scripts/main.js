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
		});
    }


})();
