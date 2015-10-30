/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  var OCS = {
	// All pages
	'common': {
	  init: function() {
		// JavaScript to be fired on all pages
    /*
		CP.$body.on('click touchstart', '.photo-info', function () {
			$(this).toggleClass('visible');
		});
    */

    //temp hack until HTML is updated!
    $('table').attr('border', 0);

	  },
	  finalize: function() {
		// JavaScript to be fired on all pages, after page specific JS is fired
	  }
	},
	'home': {
	  init: function() {
		// JavaScript to be fired on the home page
	  },
	  finalize: function() {
	  }
	},
	// About us page, note the change from about-us to about_us.
	'about_us': {
	  init: function() {
	  }
	}
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
	fire: function(func, funcname, args) {
	  var fire;
	  var namespace = OCS;
	  funcname = (funcname === undefined) ? 'init' : funcname;
	  fire = func !== '';
	  fire = fire && namespace[func];
	  fire = fire && typeof namespace[func][funcname] === 'function';

	  if (fire) {
		namespace[func][funcname](args);
	  }
	},
	loadEvents: function() {
	  // Fire common init JS
	  UTIL.fire('common');

	  // Fire page-specific init JS, and then finalize JS
	  $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
		UTIL.fire(classnm);
		UTIL.fire(classnm, 'finalize');
	  });

	  // Fire common finalize JS
	  UTIL.fire('common', 'finalize');
	}
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
