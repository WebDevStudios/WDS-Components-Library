'use strict';

/**
 * File js-enabled.js
 *
 * If Javascript is enabled, replace the <body> class "no-js".
 */
document.body.className = document.body.className.replace('no-js', 'js');
'use strict';

/**
 * File modal.js
 *
 * Deal with multiple modals and their media.
 */
window.wdsModal = {};

(function (window, $, app) {

	var $modalToggle;
	var $focusableChildren;

	// Constructor.
	app.init = function () {
		app.cache();

		if (app.meetsRequirements()) {
			app.bindEvents();
		}
	};

	// Cache all the things.
	app.cache = function () {
		app.$c = {
			'body': $('body')
		};
	};

	// Do we meet the requirements?
	app.meetsRequirements = function () {
		return $('.modal-trigger').length;
	};

	// Combine all events.
	app.bindEvents = function () {
		// Trigger a modal to open.
		app.$c.body.on('click touchstart', '.modal-trigger', app.openModal);

		// Trigger the close button to close the modal.
		app.$c.body.on('click touchstart', '.close', app.closeModal);

		// Allow the user to close the modal by hitting the esc key.
		app.$c.body.on('keydown', app.escKeyClose);

		// Allow the user to close the modal by clicking outside of the modal.
		app.$c.body.on('click touchstart', 'div.modal-open', app.closeModalByClick);

		// Listen to tabs, trap keyboard if we need to
		app.$c.body.on('keydown', app.trapKeyboardMaybe);
	};

	// Open the modal.
	app.openModal = function () {
		// Store the modal toggle element
		$modalToggle = $(this);

		// Figure out which modal we're opening and store the object.
		var $modal = $($(this).data('target'));

		// Display the modal.
		$modal.addClass('modal-open');

		// Add body class.
		app.$c.body.addClass('modal-open');

		// Find the focusable children of the modal.
		// This list may be incomplete, really wish jQuery had the :focusable pseudo like jQuery UI does.
		// For more about :input see: https://api.jquery.com/input-selector/
		$focusableChildren = $modal.find('a, :input, [tabindex]');

		// Ideally, there is always one (the close button), but you never know.
		if ($focusableChildren.length > 0) {
			// Shift focus to the first focusable element.
			$focusableChildren[0].focus();
		}
	};

	// Close the modal.
	app.closeModal = function () {
		// Figure the opened modal we're closing and store the object.
		var $modal = $($('div.modal-open .close').data('target'));

		// Find the iframe in the $modal object.
		var $iframe = $modal.find('iframe');

		// Only do this if there are any iframes.
		if ($iframe.length) {
			// Get the iframe src URL.
			var url = $iframe.attr('src');

			// Removing/Readding the URL will effectively break the YouTube API.
			// So let's not do that when the iframe URL contains the enablejsapi parameter.
			if (!url.includes('enablejsapi=1')) {
				// Remove the source URL, then add it back, so the video can be played again later.
				$iframe.attr('src', '').attr('src', url);
			} else {
				// Use the YouTube API to stop the video.
				player.stopVideo();
			}
		}

		// Finally, hide the modal.
		$modal.removeClass('modal-open');

		// Remove the body class.
		app.$c.body.removeClass('modal-open');

		// Revert focus back to toggle element
		$modalToggle.focus();
	};

	// Close if "esc" key is pressed.
	app.escKeyClose = function (event) {
		if (27 === event.keyCode) {
			app.closeModal();
		}
	};

	// Close if the user clicks outside of the modal
	app.closeModalByClick = function (event) {
		// If the parent container is NOT the modal dialog container, close the modal
		if (!$(event.target).parents('div').hasClass('modal-dialog')) {
			app.closeModal();
		}
	};

	// Trap the keyboard into a modal when one is active.
	app.trapKeyboardMaybe = function (event) {

		// We only need to do stuff when the modal is open and tab is pressed.
		if (9 === event.which && $('.modal-open').length > 0) {
			var $focused = $(':focus');
			var focusIndex = $focusableChildren.index($focused);

			if (0 === focusIndex && event.shiftKey) {
				// If this is the first focusable element, and shift is held when pressing tab, go back to last focusable element.
				$focusableChildren[$focusableChildren.length - 1].focus();
				event.preventDefault();
			} else if (!event.shiftKey && focusIndex === $focusableChildren.length - 1) {
				// If this is the last focusable element, and shift is not held, go back to the first focusable element.
				$focusableChildren[0].focus();
				event.preventDefault();
			}
		}
	};

	// Engage!
	$(app.init);
})(window, jQuery, window.wdsModal);

// Load the yt iframe api js file from youtube.
// NOTE THE IFRAME URL MUST HAVE 'enablejsapi=1' appended to it.
// example: src="http://www.youtube.com/embed/M7lc1UVf-VE?enablejsapi=1"
// It also _must_ have an ID attribute.
var tag = document.createElement('script');
tag.id = 'iframe-yt';
tag.src = 'https://www.youtube.com/iframe_api';
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

// This var and function have to be available globally due to yt js iframe api.
var player;
function onYouTubeIframeAPIReady() {
	var modal = jQuery('div.modal');
	var iframeid = modal.find('iframe').attr('id');

	player = new YT.Player(iframeid, {
		events: {
			'onReady': onPlayerReady,
			'onStateChange': onPlayerStateChange
		}
	});
}

function onPlayerReady(event) {}

function onPlayerStateChange(event) {
	// Set focus to the first focusable element inside of the modal the player is in.
	jQuery(event.target.a).parents('.modal').find('a, :input, [tabindex]').first().focus();
}
'use strict';

/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
(function () {
	var isWebkit = navigator.userAgent.toLowerCase().indexOf('webkit') > -1,
	    isOpera = navigator.userAgent.toLowerCase().indexOf('opera') > -1,
	    isIe = navigator.userAgent.toLowerCase().indexOf('msie') > -1;

	if ((isWebkit || isOpera || isIe) && document.getElementById && window.addEventListener) {
		window.addEventListener('hashchange', function () {
			var id = location.hash.substring(1),
			    element;

			if (!/^[A-z0-9_-]+$/.test(id)) {
				return;
			}

			element = document.getElementById(id);

			if (element) {
				if (!/^(?:a|select|input|button|textarea)$/i.test(element.tagName)) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false);
	}
})();
'use strict';

/**
 * File window-ready.js
 *
 * Add a "ready" class to <body> when window is ready.
 */
window.wdsWindowReady = {};
(function (window, $, app) {
	// Constructor.
	app.init = function () {
		app.cache();
		app.bindEvents();
	};

	// Cache document elements.
	app.cache = function () {
		app.$c = {
			'window': $(window),
			'body': $(document.body)
		};
	};

	// Combine all events.
	app.bindEvents = function () {
		app.$c.window.load(app.addBodyClass);
	};

	// Add a class to <body>.
	app.addBodyClass = function () {
		app.$c.body.addClass('ready');
	};

	// Engage!
	$(app.init);
})(window, jQuery, window.wdsWindowReady);
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbImpzLWVuYWJsZWQuanMiLCJtb2RhbC5qcyIsInNraXAtbGluay1mb2N1cy1maXguanMiLCJ3aW5kb3ctcmVhZHkuanMiXSwibmFtZXMiOlsiZG9jdW1lbnQiLCJib2R5IiwiY2xhc3NOYW1lIiwicmVwbGFjZSIsIndpbmRvdyIsIndkc01vZGFsIiwiJCIsImFwcCIsIiRtb2RhbFRvZ2dsZSIsIiRmb2N1c2FibGVDaGlsZHJlbiIsImluaXQiLCJjYWNoZSIsIm1lZXRzUmVxdWlyZW1lbnRzIiwiYmluZEV2ZW50cyIsIiRjIiwibGVuZ3RoIiwib24iLCJvcGVuTW9kYWwiLCJjbG9zZU1vZGFsIiwiZXNjS2V5Q2xvc2UiLCJjbG9zZU1vZGFsQnlDbGljayIsInRyYXBLZXlib2FyZE1heWJlIiwiJG1vZGFsIiwiZGF0YSIsImFkZENsYXNzIiwiZmluZCIsImZvY3VzIiwiJGlmcmFtZSIsInVybCIsImF0dHIiLCJpbmNsdWRlcyIsInBsYXllciIsInN0b3BWaWRlbyIsInJlbW92ZUNsYXNzIiwiZXZlbnQiLCJrZXlDb2RlIiwidGFyZ2V0IiwicGFyZW50cyIsImhhc0NsYXNzIiwid2hpY2giLCIkZm9jdXNlZCIsImZvY3VzSW5kZXgiLCJpbmRleCIsInNoaWZ0S2V5IiwicHJldmVudERlZmF1bHQiLCJqUXVlcnkiLCJ0YWciLCJjcmVhdGVFbGVtZW50IiwiaWQiLCJzcmMiLCJmaXJzdFNjcmlwdFRhZyIsImdldEVsZW1lbnRzQnlUYWdOYW1lIiwicGFyZW50Tm9kZSIsImluc2VydEJlZm9yZSIsIm9uWW91VHViZUlmcmFtZUFQSVJlYWR5IiwibW9kYWwiLCJpZnJhbWVpZCIsIllUIiwiUGxheWVyIiwiZXZlbnRzIiwib25QbGF5ZXJSZWFkeSIsIm9uUGxheWVyU3RhdGVDaGFuZ2UiLCJhIiwiZmlyc3QiLCJpc1dlYmtpdCIsIm5hdmlnYXRvciIsInVzZXJBZ2VudCIsInRvTG93ZXJDYXNlIiwiaW5kZXhPZiIsImlzT3BlcmEiLCJpc0llIiwiZ2V0RWxlbWVudEJ5SWQiLCJhZGRFdmVudExpc3RlbmVyIiwibG9jYXRpb24iLCJoYXNoIiwic3Vic3RyaW5nIiwiZWxlbWVudCIsInRlc3QiLCJ0YWdOYW1lIiwidGFiSW5kZXgiLCJ3ZHNXaW5kb3dSZWFkeSIsImxvYWQiLCJhZGRCb2R5Q2xhc3MiXSwibWFwcGluZ3MiOiI7O0FBQUE7Ozs7O0FBS0FBLFNBQVNDLElBQVQsQ0FBY0MsU0FBZCxHQUEwQkYsU0FBU0MsSUFBVCxDQUFjQyxTQUFkLENBQXdCQyxPQUF4QixDQUFpQyxPQUFqQyxFQUEwQyxJQUExQyxDQUExQjs7O0FDTEE7Ozs7O0FBS0FDLE9BQU9DLFFBQVAsR0FBa0IsRUFBbEI7O0FBRUEsQ0FBRSxVQUFXRCxNQUFYLEVBQW1CRSxDQUFuQixFQUFzQkMsR0FBdEIsRUFBNEI7O0FBRTdCLEtBQUlDLFlBQUo7QUFDQSxLQUFJQyxrQkFBSjs7QUFFQTtBQUNBRixLQUFJRyxJQUFKLEdBQVcsWUFBWTtBQUN0QkgsTUFBSUksS0FBSjs7QUFFQSxNQUFLSixJQUFJSyxpQkFBSixFQUFMLEVBQStCO0FBQzlCTCxPQUFJTSxVQUFKO0FBQ0E7QUFDRCxFQU5EOztBQVFBO0FBQ0FOLEtBQUlJLEtBQUosR0FBWSxZQUFZO0FBQ3ZCSixNQUFJTyxFQUFKLEdBQVM7QUFDUixXQUFRUixFQUFHLE1BQUg7QUFEQSxHQUFUO0FBR0EsRUFKRDs7QUFNQTtBQUNBQyxLQUFJSyxpQkFBSixHQUF3QixZQUFZO0FBQ25DLFNBQU9OLEVBQUcsZ0JBQUgsRUFBc0JTLE1BQTdCO0FBQ0EsRUFGRDs7QUFJQTtBQUNBUixLQUFJTSxVQUFKLEdBQWlCLFlBQVk7QUFDNUI7QUFDQU4sTUFBSU8sRUFBSixDQUFPYixJQUFQLENBQVllLEVBQVosQ0FBZ0Isa0JBQWhCLEVBQW9DLGdCQUFwQyxFQUFzRFQsSUFBSVUsU0FBMUQ7O0FBRUE7QUFDQVYsTUFBSU8sRUFBSixDQUFPYixJQUFQLENBQVllLEVBQVosQ0FBZ0Isa0JBQWhCLEVBQW9DLFFBQXBDLEVBQThDVCxJQUFJVyxVQUFsRDs7QUFFQTtB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O0FBa0JBO0FBQ0QsQ0F6QkQ7OztBQ1BBOzs7OztBQUtBdEIsT0FBTzRFLGNBQVAsR0FBd0IsRUFBeEI7QUFDQSxDQUFFLFVBQVc1RSxNQUFYLEVBQW1CRSxDQUFuQixFQUFzQkMsR0FBdEIsRUFBNEI7QUFDN0I7QUFDQUEsS0FBSUcsSUFBSixHQUFXLFlBQVk7QUFDdEJILE1BQUlJLEtBQUo7QUFDQUosTUFBSU0sVUFBSjtBQUNBLEVBSEQ7O0FBS0E7QUFDQU4sS0FBSUksS0FBSixHQUFZLFlBQVk7QUFDdkJKLE1BQUlPLEVBQUosR0FBUztBQUNSLGFBQVVSLEVBQUdGLE1BQUgsQ0FERjtBQUVSLFdBQVFFLEVBQUdOLFNBQVNDLElBQVo7QUFGQSxHQUFUO0FBSUEsRUFMRDs7QUFPQTtBQUNBTSxLQUFJTSxVQUFKLEdBQWlCLFlBQVk7QUFDNUJOLE1BQUlPLEVBQUosQ0FBT1YsTUFBUCxDQUFjNkUsSUFBZCxDQUFvQjFFLElBQUkyRSxZQUF4QjtBQUNBLEVBRkQ7O0FBSUE7QUFDQTNFLEtBQUkyRSxZQUFKLEdBQW1CLFlBQVk7QUFDOUIzRSxNQUFJTyxFQUFKLENBQU9iLElBQVAsQ0FBWXVCLFFBQVosQ0FBc0IsT0FBdEI7QUFDQSxFQUZEOztBQUlBO0FBQ0FsQixHQUFHQyxJQUFJRyxJQUFQO0FBQ0EsQ0EzQkQsRUEyQktOLE1BM0JMLEVBMkJheUMsTUEzQmIsRUEyQnFCekMsT0FBTzRFLGNBM0I1QiIsImZpbGUiOiJwcm9qZWN0LmpzIiwic291cmNlc0NvbnRlbnQiOlsiLyoqXG4gKiBGaWxlIGpzLWVuYWJsZWQuanNcbiAqXG4gKiBJZiBKYXZhc2NyaXB0IGlzIGVuYWJsZWQsIHJlcGxhY2UgdGhlIDxib2R5PiBjbGFzcyBcIm5vLWpzXCIuXG4gKi9cbmRvY3VtZW50LmJvZHkuY2xhc3NOYW1lID0gZG9jdW1lbnQuYm9keS5jbGFzc05hbWUucmVwbGFjZSggJ25vLWpzJywgJ2pzJyApO1xuIiwiLyoqXG4gKiBGaWxlIG1vZGFsLmpzXG4gKlxuICogRGVhbCB3aXRoIG11bHRpcGxlIG1vZGFscyBhbmQgdGhlaXIgbWVkaWEuXG4gKi9cbndpbmRvdy53ZHNNb2RhbCA9IHt9O1xuXG4oIGZ1bmN0aW9uICggd2luZG93LCAkLCBhcHAgKSB7XG5cblx0dmFyICRtb2RhbFRvZ2dsZTtcblx0dmFyICRmb2N1c2FibGVDaGlsZHJlbjtcblxuXHQvLyBDb25zdHJ1Y3Rvci5cblx0YXBwLmluaXQgPSBmdW5jdGlvbiAoKSB7XG5cdFx0YXBwLmNhY2hlKCk7XG5cblx0XHRpZiAoIGFwcC5tZWV0c1JlcXVpcmVtZW50cygpICkge1xuXHRcdFx0YXBwLmJpbmRFdmVudHMoKTtcblx0XHR9XG5cdH07XG5cblx0Ly8gQ2FjaGUgYWxsIHRoZSB0aGluZ3MuXG5cdGFwcC5jYWNoZSA9IGZ1bmN0aW9uICgpIHtcblx0XHRhcHAuJGMgPSB7XG5cdFx0XHQnYm9keSc6ICQoICdib2R5JyApXG5cdFx0fTtcblx0fTtcblxuXHQvLyBEbyB3ZSBtZWV0IHRoZSByZXF1aXJlbWVudHM/XG5cdGFwcC5tZWV0c1JlcXVpcmVtZW50cyA9IGZ1bmN0aW9uICgpIHtcblx0XHRyZXR1cm4gJCggJy5tb2RhbC10cmlnZ2VyJyApLmxlbmd0aDtcblx0fTtcblxuXHQvLyBDb21iaW5lIGFsbCBldmVudHMuXG5cdGFwcC5iaW5kRXZlbnRzID0gZnVuY3Rpb24gKCkge1xuXHRcdC8vIFRyaWdnZXIgYSBtb2RhbCB0byBvcGVuLlxuXHRcdGFwcC4kYy5ib2R5Lm9uKCAnY2xpY2sgdG91Y2hzdGFydCcsICcubW9kYWwtdHJpZ2dlcicsIGFwcC5vcGVuTW9kYWwgKTtcblxuXHRcdC8vIFRyaWdnZXIgdGhlIGNsb3NlIGJ1dHRvbiB0byBjbG9zZSB0aGUgbW9kYWwuXG5cdFx0YXBwLiRjLmJvZHkub24oICdjbGljayB0b3VjaHN0YXJ0JywgJy5jbG9zZScsIGFwcC5jbG9zZU1vZGFsICk7XG5cblx0XHQvLyBBbGxvdyB0aGUgdXNlciB0byBjbG9zZSB0aGUgbW9kYWwgYnkgaGl0dGluZyB0aGUgZXNjIGtleS5cblx0XHRhcHAuJGMuYm9keS5vbiggJ2tleWRvd24nLCBhcHAuZXNjS2V5Q2xvc2UgKTtcblxuXHRcdC8vIEFsbG93IHRoZSB1c2VyIHRvIGNsb3NlIHRoZSBtb2RhbCBieSBjbGlja2luZyBvdXRzaWRlIG9mIHRoZSBtb2RhbC5cblx0XHRhcHAuJGMuYm9keS5vbiggJ2NsaWNrIHRvdWNoc3RhcnQnLCAnZGl2Lm1vZGFsLW9wZW4nLCBhcHAuY2xvc2VNb2RhbEJ5Q2xpY2sgKTtcblxuXHRcdC8vIExpc3RlbiB0byB0YWJzLCB0cmFwIGtleWJvYXJkIGlmIHdlIG5lZWQgdG9cblx0XHRhcHAuJGMuYm9keS5vbiggJ2tleWRvd24nLCBhcHAudHJhcEtleWJvYXJkTWF5YmUgKTtcblxuXHR9O1xuXG5cdC8vIE9wZW4gdGhlIG1vZGFsLlxuXHRhcHAub3Blbk1vZGFsID0gZnVuY3Rpb24gKCkge1xuXHRcdC8vIFN0b3JlIHRoZSBtb2RhbCB0b2dnbGUgZWxlbWVudFxuXHRcdCRtb2RhbFRvZ2dsZSA9ICQoIHRoaXMgKTtcblxuXHRcdC8vIEZpZ3VyZSBvdXQgd2hpY2ggbW9kYWwgd2UncmUgb3BlbmluZyBhbmQgc3RvcmUgdGhlIG9iamVjdC5cblx0XHR2YXIgJG1vZGFsID0gJCggJCggdGhpcyApLmRhdGEoICd0YXJnZXQnICkgKTtcblxuXHRcdC8vIERpc3BsYXkgdGhlIG1vZGFsLlxuXHRcdCRtb2RhbC5hZGRDbGFzcyggJ21vZGFsLW9wZW4nICk7XG5cblx0XHQvLyBBZGQgYm9keSBjbGFzcy5cblx0XHRhcHAuJGMuYm9keS5hZGRDbGFzcyggJ21vZGFsLW9wZW4nICk7XG5cblx0XHQvLyBGaW5kIHRoZSBmb2N1c2FibGUgY2hpbGRyZW4gb2YgdGhlIG1vZGFsLlxuXHRcdC8vIFRoaXMgbGlzdCBtYXkgYmUgaW5jb21wbGV0ZSwgcmVhbGx5IHdpc2ggalF1ZXJ5IGhhZCB0aGUgOmZvY3VzYWJsZSBwc2V1ZG8gbGlrZSBqUXVlcnkgVUkgZG9lcy5cblx0XHQvLyBGb3IgbW9yZSBhYm91dCA6aW5wdXQgc2VlOiBodHRwczovL2FwaS5qcXVlcnkuY29tL2lucHV0LXNlbGVjdG9yL1xuXHRcdCRmb2N1c2FibGVDaGlsZHJlbiA9ICRtb2RhbC5maW5kKCdhLCA6aW5wdXQsIFt0YWJpbmRleF0nKTtcblxuXHRcdC8vIElkZWFsbHksIHRoZXJlIGlzIGFsd2F5cyBvbmUgKHRoZSBjbG9zZSBidXR0b24pLCBidXQgeW91IG5ldmVyIGtub3cuXG5cdFx0aWYgKCAkZm9jdXNhYmxlQ2hpbGRyZW4ubGVuZ3RoID4gMCApIHtcblx0XHRcdC8vIFNoaWZ0IGZvY3VzIHRvIHRoZSBmaXJzdCBmb2N1c2FibGUgZWxlbWVudC5cblx0XHRcdCRmb2N1c2FibGVDaGlsZHJlblswXS5mb2N1cygpO1xuXHRcdH1cblxuXHR9O1xuXG5cdC8vIENsb3NlIHRoZSBtb2RhbC5cblx0YXBwLmNsb3NlTW9kYWwgPSBmdW5jdGlvbiAoKSB7XG5cdFx0Ly8gRmlndXJlIHRoZSBvcGVuZWQgbW9kYWwgd2UncmUgY2xvc2luZyBhbmQgc3RvcmUgdGhlIG9iamVjdC5cblx0XHR2YXIgJG1vZGFsID0gJCggJCggJ2Rpdi5tb2RhbC1vcGVuIC5jbG9zZScgKS5kYXRhKCAndGFyZ2V0JyApICk7XG5cblx0XHQvLyBGaW5kIHRoZSBpZnJhbWUgaW4gdGhlICRtb2RhbCBvYmplY3QuXG5cdFx0dmFyICRpZnJhbWUgPSAkbW9kYWwuZmluZCggJ2lmcmFtZScgKTtcblxuXHRcdC8vIE9ubHkgZG8gdGhpcyBpZiB0aGVyZSBhcmUgYW55IGlmcmFtZXMuXG5cdFx0aWYgKCAkaWZyYW1lLmxlbmd0aCApIHtcblx0XHRcdC8vIEdldCB0aGUgaWZyYW1lIHNyYyBVUkwuXG5cdFx0XHR2YXIgdXJsID0gJGlmcmFtZS5hdHRyKCAnc3JjJyApO1xuXG5cdFx0XHQvLyBSZW1vdmluZy9SZWFkZGluZyB0aGUgVVJMIHdpbGwgZWZmZWN0aXZlbHkgYnJlYWsgdGhlIFlvdVR1YmUgQVBJLlxuXHRcdFx0Ly8gU28gbGV0J3Mgbm90IGRvIHRoYXQgd2hlbiB0aGUgaWZyYW1lIFVSTCBjb250YWlucyB0aGUgZW5hYmxlanNhcGkgcGFyYW1ldGVyLlxuXHRcdFx0aWYgKCAhIHVybC5pbmNsdWRlcyggJ2VuYWJsZWpzYXBpPTEnICkgKSB7XG5cdFx0XHRcdC8vIFJlbW92ZSB0aGUgc291cmNlIFVSTCwgdGhlbiBhZGQgaXQgYmFjaywgc28gdGhlIHZpZGVvIGNhbiBiZSBwbGF5ZWQgYWdhaW4gbGF0ZXIuXG5cdFx0XHRcdCRpZnJhbWUuYXR0ciggJ3NyYycsICcnICkuYXR0ciggJ3NyYycsIHVybCApO1xuXHRcdFx0fSBlbHNlIHtcblx0XHRcdFx0Ly8gVXNlIHRoZSBZb3VUdWJlIEFQSSB0byBzdG9wIHRoZSB2aWRlby5cblx0XHRcdFx0cGxheWVyLnN0b3BWaWRlbygpO1xuXHRcdFx0fVxuXHRcdH1cblxuXHRcdC8vIEZpbmFsbHksIGhpZGUgdGhlIG1vZGFsLlxuXHRcdCRtb2RhbC5yZW1vdmVDbGFzcyggJ21vZGFsLW9wZW4nICk7XG5cblx0XHQvLyBSZW1vdmUgdGhlIGJvZHkgY2xhc3MuXG5cdFx0YXBwLiRjLmJvZHkucmVtb3ZlQ2xhc3MoICdtb2RhbC1vcGVuJyApO1xuXG5cdFx0Ly8gUmV2ZXJ0IGZvY3VzIGJhY2sgdG8gdG9nZ2xlIGVsZW1lbnRcblx0XHQkbW9kYWxUb2dnbGUuZm9jdXMoKTtcblxuXHR9O1xuXG5cdC8vIENsb3NlIGlmIFwiZXNjXCIga2V5IGlzIHByZXNzZWQuXG5cdGFwcC5lc2NLZXlDbG9zZSA9IGZ1bmN0aW9uICggZXZlbnQgKSB7XG5cdFx0aWYgKCAyNyA9PT0gZXZlbnQua2V5Q29kZSApIHtcblx0XHRcdGFwcC5jbG9zZU1vZGFsKCk7XG5cdFx0fVxuXHR9O1xuXG5cdC8vIENsb3NlIGlmIHRoZSB1c2VyIGNsaWNrcyBvdXRzaWRlIG9mIHRoZSBtb2RhbFxuXHRhcHAuY2xvc2VNb2RhbEJ5Q2xpY2sgPSBmdW5jdGlvbiAoIGV2ZW50ICkge1xuXHRcdC8vIElmIHRoZSBwYXJlbnQgY29udGFpbmVyIGlzIE5PVCB0aGUgbW9kYWwgZGlhbG9nIGNvbnRhaW5lciwgY2xvc2UgdGhlIG1vZGFsXG5cdFx0aWYgKCAhJCggZXZlbnQudGFyZ2V0ICkucGFyZW50cyggJ2RpdicgKS5oYXNDbGFzcyggJ21vZGFsLWRpYWxvZycgKSApIHtcblx0XHRcdGFwcC5jbG9zZU1vZGFsKCk7XG5cdFx0fVxuXHR9O1xuXG5cdC8vIFRyYXAgdGhlIGtleWJvYXJkIGludG8gYSBtb2RhbCB3aGVuIG9uZSBpcyBhY3RpdmUuXG5cdGFwcC50cmFwS2V5Ym9hcmRNYXliZSA9IGZ1bmN0aW9uICggZXZlbnQgKSB7XG5cblx0XHQvLyBXZSBvbmx5IG5lZWQgdG8gZG8gc3R1ZmYgd2hlbiB0aGUgbW9kYWwgaXMgb3BlbiBhbmQgdGFiIGlzIHByZXNzZWQuXG5cdFx0aWYgKCA5ID09PSBldmVudC53aGljaCAmJiAkKCAnLm1vZGFsLW9wZW4nICkubGVuZ3RoID4gMCApIHtcblx0XHRcdHZhciAkZm9jdXNlZCA9ICQoICc6Zm9jdXMnICk7XG5cdFx0XHR2YXIgZm9jdXNJbmRleCA9ICRmb2N1c2FibGVDaGlsZHJlbi5pbmRleCggJGZvY3VzZWQgKTtcblxuXHRcdFx0aWYgKCAwID09PSBmb2N1c0luZGV4ICYmIGV2ZW50LnNoaWZ0S2V5ICkge1xuXHRcdFx0XHQvLyBJZiB0aGlzIGlzIHRoZSBmaXJzdCBmb2N1c2FibGUgZWxlbWVudCwgYW5kIHNoaWZ0IGlzIGhlbGQgd2hlbiBwcmVzc2luZyB0YWIsIGdvIGJhY2sgdG8gbGFzdCBmb2N1c2FibGUgZWxlbWVudC5cblx0XHRcdFx0JGZvY3VzYWJsZUNoaWxkcmVuWyAkZm9jdXNhYmxlQ2hpbGRyZW4ubGVuZ3RoIC0gMSBdLmZvY3VzKCk7XG5cdFx0XHRcdGV2ZW50LnByZXZlbnREZWZhdWx0KCk7XG5cdFx0XHR9IGVsc2UgaWYgKCAhIGV2ZW50LnNoaWZ0S2V5ICYmIGZvY3VzSW5kZXggPT09ICRmb2N1c2FibGVDaGlsZHJlbi5sZW5ndGggLSAxICkge1xuXHRcdFx0XHQvLyBJZiB0aGlzIGlzIHRoZSBsYXN0IGZvY3VzYWJsZSBlbGVtZW50LCBhbmQgc2hpZnQgaXMgbm90IGhlbGQsIGdvIGJhY2sgdG8gdGhlIGZpcnN0IGZvY3VzYWJsZSBlbGVtZW50LlxuXHRcdFx0XHQkZm9jdXNhYmxlQ2hpbGRyZW5bMF0uZm9jdXMoKTtcblx0XHRcdFx0ZXZlbnQucHJldmVudERlZmF1bHQoKTtcblx0XHRcdH1cblx0XHR9XG5cdH1cblxuXHQvLyBFbmdhZ2UhXG5cdCQoIGFwcC5pbml0ICk7XG59ICkoIHdpbmRvdywgalF1ZXJ5LCB3aW5kb3cud2RzTW9kYWwgKTtcblxuLy8gTG9hZCB0aGUgeXQgaWZyYW1lIGFwaSBqcyBmaWxlIGZyb20geW91dHViZS5cbi8vIE5PVEUgVEhFIElGUkFNRSBVUkwgTVVTVCBIQVZFICdlbmFibGVqc2FwaT0xJyBhcHBlbmRlZCB0byBpdC5cbi8vIGV4YW1wbGU6IHNyYz1cImh0dHA6Ly93d3cueW91dHViZS5jb20vZW1iZWQvTTdsYzFVVmYtVkU/ZW5hYmxlanNhcGk9MVwiXG4vLyBJdCBhbHNvIF9tdXN0XyBoYXZlIGFuIElEIGF0dHJpYnV0ZS5cbnZhciB0YWcgPSBkb2N1bWVudC5jcmVhdGVFbGVtZW50KCdzY3JpcHQnKTtcbnRhZy5pZCA9ICdpZnJhbWUteXQnO1xudGFnLnNyYyA9ICdodHRwczovL3d3dy55b3V0dWJlLmNvbS9pZnJhbWVfYXBpJztcbnZhciBmaXJzdFNjcmlwdFRhZyA9IGRvY3VtZW50LmdldEVsZW1lbnRzQnlUYWdOYW1lKCdzY3JpcHQnKVswXTtcbmZpcnN0U2NyaXB0VGFnLnBhcmVudE5vZGUuaW5zZXJ0QmVmb3JlKHRhZywgZmlyc3RTY3JpcHRUYWcpO1xuXG4vLyBUaGlzIHZhciBhbmQgZnVuY3Rpb24gaGF2ZSB0byBiZSBhdmFpbGFibGUgZ2xvYmFsbHkgZHVlIHRvIHl0IGpzIGlmcmFtZSBhcGkuXG52YXIgcGxheWVyO1xuZnVuY3Rpb24gb25Zb3VUdWJlSWZyYW1lQVBJUmVhZHkoKSB7XG4gIHZhciBtb2RhbCA9IGpRdWVyeSgnZGl2Lm1vZGFsJyk7XG5cdHZhciBpZnJhbWVpZCA9IG1vZGFsLmZpbmQoJ2lmcmFtZScpLmF0dHIoJ2lkJyk7XG5cblx0cGxheWVyID0gbmV3IFlULlBsYXllciggaWZyYW1laWQgLCB7XG5cdFx0ZXZlbnRzOiB7XG5cdFx0XHQnb25SZWFkeSc6IG9uUGxheWVyUmVhZHksXG5cdFx0XHQnb25TdGF0ZUNoYW5nZSc6IG9uUGxheWVyU3RhdGVDaGFuZ2Vcblx0XHR9XG5cdH0pO1xufVxuXG5mdW5jdGlvbiBvblBsYXllclJlYWR5KGV2ZW50KSB7XG5cbn1cblxuZnVuY3Rpb24gb25QbGF5ZXJTdGF0ZUNoYW5nZSggZXZlbnQgKSB7XG5cdC8vIFNldCBmb2N1cyB0byB0aGUgZmlyc3QgZm9jdXNhYmxlIGVsZW1lbnQgaW5zaWRlIG9mIHRoZSBtb2RhbCB0aGUgcGxheWVyIGlzIGluLlxuXHRqUXVlcnkoIGV2ZW50LnRhcmdldC5hICkucGFyZW50cyggJy5tb2RhbCcgKS5maW5kKCdhLCA6aW5wdXQsIFt0YWJpbmRleF0nKS5maXJzdCgpLmZvY3VzKCk7XG59XG4iLCIvKipcbiAqIEZpbGUgc2tpcC1saW5rLWZvY3VzLWZpeC5qcy5cbiAqXG4gKiBIZWxwcyB3aXRoIGFjY2Vzc2liaWxpdHkgZm9yIGtleWJvYXJkIG9ubHkgdXNlcnMuXG4gKlxuICogTGVhcm4gbW9yZTogaHR0cHM6Ly9naXQuaW8vdldkcjJcbiAqL1xuKCBmdW5jdGlvbiAoKSB7XG5cdHZhciBpc1dlYmtpdCA9IG5hdmlnYXRvci51c2VyQWdlbnQudG9Mb3dlckNhc2UoKS5pbmRleE9mKCAnd2Via2l0JyApID4gLTEsXG5cdFx0aXNPcGVyYSA9IG5hdmlnYXRvci51c2VyQWdlbnQudG9Mb3dlckNhc2UoKS5pbmRleE9mKCAnb3BlcmEnICkgPiAtMSxcblx0XHRpc0llID0gbmF2aWdhdG9yLnVzZXJBZ2VudC50b0xvd2VyQ2FzZSgpLmluZGV4T2YoICdtc2llJyApID4gLTE7XG5cblx0aWYgKCAoIGlzV2Via2l0IHx8IGlzT3BlcmEgfHwgaXNJZSApICYmIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkICYmIHdpbmRvdy5hZGRFdmVudExpc3RlbmVyICkge1xuXHRcdHdpbmRvdy5hZGRFdmVudExpc3RlbmVyKCAnaGFzaGNoYW5nZScsIGZ1bmN0aW9uICgpIHtcblx0XHRcdHZhciBpZCA9IGxvY2F0aW9uLmhhc2guc3Vic3RyaW5nKCAxICksXG5cdFx0XHRcdGVsZW1lbnQ7XG5cblx0XHRcdGlmICggISggL15bQS16MC05Xy1dKyQvICkudGVzdCggaWQgKSApIHtcblx0XHRcdFx0cmV0dXJuO1xuXHRcdFx0fVxuXG5cdFx0XHRlbGVtZW50ID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoIGlkICk7XG5cblx0XHRcdGlmICggZWxlbWVudCApIHtcblx0XHRcdFx0aWYgKCAhKCAvXig/OmF8c2VsZWN0fGlucHV0fGJ1dHRvbnx0ZXh0YXJlYSkkL2kgKS50ZXN0KCBlbGVtZW50LnRhZ05hbWUgKSApIHtcblx0XHRcdFx0XHRlbGVtZW50LnRhYkluZGV4ID0gLTE7XG5cdFx0XHRcdH1cblxuXHRcdFx0XHRlbGVtZW50LmZvY3VzKCk7XG5cdFx0XHR9XG5cdFx0fSwgZmFsc2UgKTtcblx0fVxufSApKCk7XG4iLCIvKipcbiAqIEZpbGUgd2luZG93LXJlYWR5LmpzXG4gKlxuICogQWRkIGEgXCJyZWFkeVwiIGNsYXNzIHRvIDxib2R5PiB3aGVuIHdpbmRvdyBpcyByZWFkeS5cbiAqL1xud2luZG93Lndkc1dpbmRvd1JlYWR5ID0ge307XG4oIGZ1bmN0aW9uICggd2luZG93LCAkLCBhcHAgKSB7XG5cdC8vIENvbnN0cnVjdG9yLlxuXHRhcHAuaW5pdCA9IGZ1bmN0aW9uICgpIHtcblx0XHRhcHAuY2FjaGUoKTtcblx0XHRhcHAuYmluZEV2ZW50cygpO1xuXHR9O1xuXG5cdC8vIENhY2hlIGRvY3VtZW50IGVsZW1lbnRzLlxuXHRhcHAuY2FjaGUgPSBmdW5jdGlvbiAoKSB7XG5cdFx0YXBwLiRjID0ge1xuXHRcdFx0J3dpbmRvdyc6ICQoIHdpbmRvdyApLFxuXHRcdFx0J2JvZHknOiAkKCBkb2N1bWVudC5ib2R5IClcblx0XHR9O1xuXHR9O1xuXG5cdC8vIENvbWJpbmUgYWxsIGV2ZW50cy5cblx0YXBwLmJpbmRFdmVudHMgPSBmdW5jdGlvbiAoKSB7XG5cdFx0YXBwLiRjLndpbmRvdy5sb2FkKCBhcHAuYWRkQm9keUNsYXNzICk7XG5cdH07XG5cblx0Ly8gQWRkIGEgY2xhc3MgdG8gPGJvZHk+LlxuXHRhcHAuYWRkQm9keUNsYXNzID0gZnVuY3Rpb24gKCkge1xuXHRcdGFwcC4kYy5ib2R5LmFkZENsYXNzKCAncmVhZHknICk7XG5cdH07XG5cblx0Ly8gRW5nYWdlIVxuXHQkKCBhcHAuaW5pdCApO1xufSApKCB3aW5kb3csIGpRdWVyeSwgd2luZG93Lndkc1dpbmRvd1JlYWR5ICk7XG4iXX0=
