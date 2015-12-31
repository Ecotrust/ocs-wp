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
  var $compass = $(".compass.main"); //compass component
  var $iframe = $("iframe.compass-iframe"); //iframe element
  var $nonFeatureFig = $('figure.wp-caption'); //non featured images

    var OCS = {
        $body : $('body'),
		// "99" => "kci", "101" => "ecoregion", "102" => "coa", "105" => "strategy_habitat", "109" = "Strategy Species Parent Page"
        landingPages : ['page-id-99','page-id-101','page-id-102','page-id-105', 'page-id-109' ],


	// All pages
	'common': {
	  init: function() {
		// JavaScript to be fired on all pages

        if ($compass.length || ($(".compass-coa").length)) {
            OCS.$body.toggleClass('map-available');
            if ($compass) {
                $compass.insertAfter("main");
            }
        }

        OCS.listAndGridToggle();
        OCS.inlineReadMore();
        OCS.fixLeftNav();

        $('body').tooltip({
            selector: '[data-toggle="tooltip"]'
        });

        //mobile menu navigation plugin
        $('.main-ocs-navigation').slicknav({
          easingOpen: 'linear',
          label: '',
          closeOnClick: "true",
          appendTo: "header#header",
          allowParentLinks: "true"
        });

        $('<a href="#mainContent" class="sr-only sr-only-focusable" tabindex="0">Skip to Main Content</a>').prependTo('.slicknav_menu');

        /*
          toggling non-featured images added via media gallery
          '.image-container' wrapper added to all media via functions.php
        */
        if ($nonFeatureFig.length) {
          $nonFeatureFig.each(function(i,figure) {
            $(figure).find('.image-container')
              .append('<span class="photo-info show-info glyphicon glyphicon-info-sign"></span>');
            $(figure).find('figcaption')
              .append('<span class="photo-info glyphicon glyphicon-remove-circle"></span>');
          });
        }
    /*
     * Image Attribution
     * Check https://github.com/Ecotrust/commonplace-magazine/search?utf8=%E2%9C%93&q=photo-info
		CP.$body.on('click touchstart', '.photo-info', function () {
			$(this).toggleClass('visible');
		});
    */

        //temp hack until HTML is updated!
        $('table').attr('border', 0);
	  },
	  finalize: function() {
		// JavaScript to be fired on all pages, after page specific JS is fired

        //Toggle class for switching between compass and main content
        $('.view-map, span.compass-close').click(function(){
            OCS.$body.toggleClass('map-visible');
            if ($iframe.length) {
                //$iframe has to be added, not just hidden for fullscreen view of oregon
                $('.compass-wrap').append($iframe);
            }
        });

        $('.photo-info').click(function() {
            $(this).parents('figure').toggleClass('close-caption');
        });

        $nonFeatureFig.find(' > a').removeAttr('href'); //deactivate hrefs by default

        // BootStrap ToolTips
        $('[title]').tooltip();

        $('.slicknav_nav').slicknav('toggle');
	  }
	},
	'home': {
	  init: function() {
		// JavaScript to be fired on the home page

	  },
	  finalize: function() {

		  // Don't show slide arrows or dots if there's only one slide
		  if ($('.carousel-inner .item').length <= 1) {
		      $('a.control_next, a.control_prev, ol.carousel-indicators').addClass('single-item');
		  }

	  }
	},
    'single_strategy_species': {
      init: function() {
        // JavaScript to be fired on the single species page

      },
      finalize: function() {
        OCS.showSpeciesTypeSidebar();
      }
    },
    'conservation_opportunity_areas': {
	  init: function() {
		// JavaScript to be fired on COA pages
        if ($('body.page-id-102').length) {
            $('body').addClass('map-visible').removeClass('grid-layout');
        }
	  },
	  finalize: function() {
        var $coaCompass = $('.compass-coa');
        OCS.findAvailableHeight($coaCompass);
	  }
    },
    // pages with a sidebar
	'has_sidebar': {
		init: function() {
			$('.entry-content').scrollNav({
				sections: 'h2, .toc-item',
				subSections: false,
				sectionElem: 'section',
				className: 'scroll-nav',
				headlineText: 'On This Page',
				showTopLink: false,
				//fixedMargin: 60,
				fixedMargin: 97,
				scrollOffset: 75,
				fixedHeaderSize: 60,
				animated: true,
				speed: 300,
				insertTarget: '.on-page-nav',
				insertLocation: 'prependTo',
				activeClass: 'current_page_item',
				scrollToHash: true,
				onRender: function(){
					OCS.$body.addClass('sidebar-visible');
				}
			});

		}
	},

    //show species type reference in sidebar on single-strategy-species pages
    showSpeciesTypeSidebar: function() {
        var speciesArray = ['amphibian', 'bird', 'mammal', 'reptile', 'fish', 'invertebrate', 'plant'];
        for (var i=0; i<speciesArray.length; i++) {
            var str = '.tax-species-'+speciesArray[i];
            if ($(str).length) {
               switch(i) {
                case 0:
                    page = 'li.page-item-112';
                    break;
                case 1:
                    page = 'li.page-item-110';
                    break;
                case 2:
                    page = 'li.page-item-111';
                    break;
                case 3:
                    page = 'li.page-item-113';
                    break;
                case 4:
                    page = 'li.page-item-114';
                    break;
                case 5:
                    page = 'li.page-item-115';
                    break;
                case 6:
                    page = 'li.page-item-116';
                    break;
                }
                $(page).addClass('current_page_item current-menu-item');
                $(page).parent().parent().addClass('current_page_parent current-menu-parent');
            }
        }
    },

    //fill rest of COA main page with Compass iframe, with certain constraints
    findAvailableHeight: function(elm) {
        if ($(window).height() <= 767) {
            elm.css('height', 400 + 'px');
        } else {
            var entryContentHeight = 0;
            var viewHeight = $('main.main').height() - $('.draft-message').outerHeight() - $('header#header').height();
            $('.entry-content > p').each(function() {
                entryContentHeight += $(this).height();
            });
            var availableHeight = (viewHeight - entryContentHeight);
            if (availableHeight < 400) {
                elm.css('height', 400+'px');
            } else {
                elm.css('height', (availableHeight+'px'));
            }
        }
    },

    fixLeftNav: function(){

    },

	inlineReadMore: function(){
        var $readMore = $('.inline-read-more');
        //if readMore exists, add class so a divider can be added to larger div
        if ($readMore.length) {
            $('.main-content > .hentry').addClass('has-read-more');
        }
        //replace the WordPress <!--MORE--> Link with a readmore
        //content is wrapped inside of a div.read-more-wrap within lib/extras.php
        $readMore.on('click', function(){
			var $t = $(this),
				newText = $t.text() === $t.attr('data-original') ? $t.attr("data-alternate") : $t.attr('data-original');

                $('.read-more-wrap').toggleClass('visible');

                //need to scroll back up?
                if (newText === $t.attr("data-original") ) {
                    $('html, body').animate({scrollTop: '0px'}, 600);
                }

				$t.text(newText);
        }).blur();
	},

	listAndGridToggle: function (){

		if ($('.listings-wrap').length ) {
			OCS.$body.addClass('grid-available').addClass('list-available');
			//temp for testing
			OCS.$body.addClass('grid-layout');
		}
		$('.view-grid').on('click', function() {
            if ($('.compass-coa') || $('.ecoregion-svg').length) {
                OCS.$body.removeClass('map-visible');
            }
			OCS.$body.addClass('grid-layout').removeClass('list-layout');
			return false;
		});
		$('.view-list').on('click', function() {
            if ($('.compass-coa') || $('.ecoregion-svg').length) {
                OCS.$body.removeClass('map-visible');
            }
			OCS.$body.addClass('list-layout').removeClass('grid-layout');
			return false;
		});
        $('.view-map').on('click', function() {
            if ($('.compass-coa') || $('.ecoregion-svg').length) {
                OCS.$body.removeClass('list-layout grid-layout');
            }
            return false;
        });
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
