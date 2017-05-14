/**
 * WP Component Library
 * https://carrieforde.com
 *
 * Licensed under the GPLv2+ license.
 */

window.WPComponentLibrary = window.WPComponentLibrary || {};

( function( window, document, $, app ) {
	var $c = {};

	app.init = function() {
		app.cache();

		if ( app.meetsRequirements() ) {
			app.bindEvents();
		}
	};

	app.cache = function() {
		app.$c = {
			window: $( window ),
			codeTabs: $( '#code-tabs' )
		};
	};

	app.bindEvents = function() {

		app.$c.window.on( 'load', app.jQueryTabs );
	};

	// Do we meet the requirements?
	app.meetsRequirements = function() {
		return app.$c.codeTabs.length;
	};

	// Initiate the jQuery tabs.
	app.jQueryTabs = function() {
		console.log ('pffftt');
		app.$c.codeTabs.tabs();
	};

	$( app.init );
}( window, document, jQuery, window.WPComponentLibrary ) );
