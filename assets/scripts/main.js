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
			e.preventDefault();

			// Set up variables for links and content areas.
			var htmlOutput	= document.getElementById( 'html-output' ),
				htmlLink	= document.getElementById( 'html-link' ),
				phpOutput	= document.getElementById( 'php-output' ),
				phpLink		= document.getElementById( 'php-link' ),
				scssOutput	= document.getElementById( 'scss-output' ),
				scssLink	= document.getElementById( 'scss-link' );

				// Add and remove the is-active class from the link and the content areas based on the clicked tab.
				// If the HTML tab is clicked...
				if ( '#html-output' === this.getAttribute( 'href' ) ) {
					htmlOutput.classList.add( 'is-active' );
					htmlLink.classList.add( 'is-active' );

					phpOutput.classList.remove( 'is-active' );
					phpLink.classList.remove( 'is-active' );

					scssOutput.classList.remove( 'is-active' );
					scssLink.classList.remove( 'is-active' );

				// Else if the PHP tab is clicked...
				} else if ( '#php-output' === this.getAttribute( 'href' ) ) {
					phpOutput.classList.add( 'is-active' );
					phpLink.classList.add( 'is-active' );

					htmlOutput.classList.remove( 'is-active' );
					htmlLink.classList.remove( 'is-active' );

					scssOutput.classList.remove( 'is-active' );
					scssLink.classList.remove( 'is-active' );

				// Otherwise the SCSS tab is clicked...
				} else {
					scssOutput.classList.add( 'is-active' );
					scssLink.classList.add( 'is-active' );

					htmlOutput.classList.remove( 'is-active' );
					htmlLink.classList.remove( 'is-active' );

					phpOutput.classList.remove( 'is-active' );
					phpLink.classList.remove( 'is-active' );
				}

		});
    }


})();
