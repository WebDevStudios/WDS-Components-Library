/**
 * WP Component Library
 * https://carrieforde.com
 *
 * Licensed under the GPLv2+ license.
 */

window.WPComponentLibrary = window.WPComponentLibrary || {};

( function( window, document, $, plugin ) {
	var $c = {};

	plugin.init = function() {
		plugin.cache();
		plugin.bindEvents();
	};

	plugin.cache = function() {
		$c.window = $( window );
		$c.body = $( document.body );
	};

	plugin.bindEvents = function() {
	};

	$( plugin.init );
}( window, document, jQuery, window.WPComponentLibrary ) );
