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
              if (OCS.$body.hasClass('map-visible')) {
                  OCS.$body.removeClass('article-layout');
              } else if (!OCS.$body.hasClass('page-id-101')) {
                OCS.$body.addClass('article-available article-layout');
              }

              if ($compass) {
                  $compass.insertAfter("main");
              }
          }

          OCS.listAndGridToggle();
          OCS.inlineReadMore();

          $('body').tooltip({
              selector: '[data-toggle="tooltip"]'
          });

          //mobile menu navigation plugin
          $('.main-ocs-navigation').slicknav({
            easingOpen: 'linear',
            label: '',
            closeOnClick: "true",
            appendTo: "header#header",
            allowParentLinks: "true",
  		      init: function(){
    			   if ($('.slicknav_menu').is(':visible')) {
    			     //only move the #skip line from position 2 on the page if we're in a mobile view
    			     $('#skip-to-content').prependTo('.slicknav_menu');
    			   }
  		      }
          });

          // secondary nav open on keyboard enter hit
          // also opens on defualt space hit
          document.querySelector('#nav-check').addEventListener('keypress', function (e) {
            var key = e.which || e.keyCode;
            if (key === 13) { // 13 is enter
              if (e.target.checked) {
                e.target.checked = false;
              } else {
                e.target.checked = true;
              }
            }
          });

          /*
            toggling non-featured images added via media gallery
            '.image-container' wrapper added to all media via functions.php
          */
          var $nonFeatureFig = $('figure.wp-caption');
          if ($nonFeatureFig.length) {
            $nonFeatureFig.each(function() {
              var caption = $(this).find('figcaption .attr-name').html();

              //kci's??
              if (!$(this).has('.image-container').length) {
                $(this).find('img').wrap("<div class='image-container'></div>");
              }

              $(this).find('.image-container')
                     .append('<span class="photo-info show-info glyphicon glyphicon-info-sign"></span>');
              $(this).find('figcaption')
                     .append('<span class="photo-info glyphicon glyphicon-remove-circle"></span>');
              $(this).find('figcaption .attr-name').remove();

              if (typeof caption !== 'undefined' && caption.length > 1) {
                $(this).find('figcaption .photo-attribution').append(' '+caption);
              }

            });
          }

          //temp hack until HTML is updated!
          $('table').attr('border', 0);

          // make sidebar sticky
          // var $sticky = $('#menu-ocs-navigation');
          // get logo elements from sidebar
          // var $brandBtn = $('.brand');
          // if (!!$sticky.offset()) { // make sure sidebar exists element exists
            // var generalSidebarHeight = $sticky.innerHeight();
            // var offsetBottom = $brandBtn.innerHeight();
            // var sidebarOffsetDiff =  generalSidebarHeight + offsetBottom * 2;
            // store last known Y coords so we know if scrolling up or down
            // var lastKnownY = $(window).scrollTop();
            // store second to last know Y coords
            // var yBeforeLast = lastKnownY;
            // store bottom position
            // var lastKnownBottom = offsetBottom;
            // $(window).scroll(function() {
          //     // distance to top of window
          //     var windowTop = $(window).scrollTop();
          //     // distance from top of sticky to window top
          //     var stickyTop = $sticky.offset().top;
          //     stickyTop = stickyTop + offsetBottom * 2;
          //     // client window height
          //     var windowHeight = $(window).innerHeight();
          //     var windowSidebarDifference = sidebarOffsetDiff - windowHeight;
          //     var scrollDiff = 0;
          //     var scrollingUp = true;
          //     if (lastKnownY >= windowTop) { // scrolling up
          //       scrollDiff = lastKnownY - windowTop;
          //     } else if (windowTop > lastKnownY) { // scrolling down
          //       scrollDiff = windowTop - lastKnownY;
          //       scrollingUp = false;
          //     }
          //
          //     if (windowSidebarDifference < windowTop) {
          //       if (scrollingUp) {
          //         if (stickyTop > windowTop) {
          //           lastKnownBottom = lastKnownBottom - scrollDiff;
          //           $sticky.css({
          //             bottom: 'auto',
          //             position: 'fixed',
          //             top: offsetBottom,
          //             width: '16.66%'
          //           });
          //         } else {
          //           lastKnownBottom = lastKnownBottom - scrollDiff;
          //           $sticky.css({
          //             bottom: lastKnownBottom,
          //             position: 'fixed',
          //             top: 'auto',
          //             width: '16.66%'
          //           });
          //         }
          //       } else {
          //         if (stickyTop > windowTop) {
          //           lastKnownBottom = lastKnownBottom - scrollDiff;
          //           $sticky.css({
          //             bottom: 'auto',
          //             position: 'fixed',
          //             top: offsetBottom,
          //             width: '16.66%'
          //           });
          //         } else {
          //           lastKnownBottom = offsetBottom;
          //           $sticky.css({
          //             bottom: lastKnownBottom,
          //             position: 'fixed',
          //             top: 'auto',
          //             width: '16.66%'
          //           });
          //         }
          //       }
          //     } else {
          //       $sticky.css({
          //         bottom: 'auto',
          //         position: 'absolute',
          //         top: 'initial',
          //         width: '100%'
          //       });
          //     }
          //     yBeforeLast = lastKnownY;
          //     lastKnownY = windowTop;
          //   });
          // }
  	  },
  	  finalize: function() {
  		// JavaScript to be fired on all pages, after page specific JS is fired

          //Toggle class for switching between compass and main content
          $('.view-map, span.compass-close').click(function(){
              OCS.$body.toggleClass('map-visible');
              if (OCS.$body.hasClass('map-visible')) {
                  OCS.$body.removeClass('article-layout');
              } else {
                OCS.$body.addClass('article-available article-layout');
              }
              if ($iframe.length) {
                  //$iframe has to be added, not just hidden for fullscreen view of oregon
                  $('.compass-wrap').append($iframe);
              }
          });

          $('.photo-info').click(function() {
              $(this).parents('figure').toggleClass('close-caption');
          });

          $('figure.wp-caption').find(' > a').removeAttr('href'); //deactivate hrefs by default

          // BootStrap ToolTips
          $('[title]').tooltip();

          $('.slicknav_nav').slicknav('toggle');
          OCS.fixLeftNavFlyout();
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
        $('body').addClass('article-layout article-available map-available');
      },
      finalize: function() {
		    // Done in PHP to avoid flash of no-nav + those w/o js.
        //OCS.showSpeciesTypeSidebar();
      }
    },
    'conservation_opportunity_areas': {
	   init: function() {
		  // JavaScript to be fired on COA pages
        if ($('body.page-id-102').length) {
            $('body').addClass('map-visible').removeClass('grid-layout article-layout article-available');
        }
	   },
	   finalize: function() {
      },
    },
    'single_ecoregion': {
      init: function() {
        // JavaScript to be fired on single ecoregion pages
        $('body').addClass('article-layout article-available map-available');
      },
      finalize: function() {
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
		  },
      finalize: function(){
        OCS.fixLeftNavFlyout();
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

    fixLeftNavFlyout: function(){
      $mainMenuHasChildren = $('#menu-ocs-navigation > .menu-item-has-children');
      if ($mainMenuHasChildren.length > 0) {

        $mainMenuHasChildren.each(function(index) {
          var $subMenu = $(this).children().closest('.sub-menu');
          $subMenu.addClass('flyout');
        });
      }
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

      function coaSort($type) {
        if ($('body.page-id-102')) {
          $coaContainer = $('section.post-102');
          $coas = $coaContainer.children('article.coa');
          // var $type = $type;
          $coas.sort(function (a,b) {
            if ($type === 'list') {
              a = parseInt($(a).attr('coa'), 10);
              b = parseInt($(b).attr('coa'), 10);
            } else {
              a = ($(a).attr('item-name'));
              b = ($(b).attr('item-name'));
            }

            if(a > b) {
                return 1;
            } else if(a < b) {
                return -1;
            }
            return 0;
          });
          $coas.detach().appendTo($coaContainer);
        }
      }

  		if ($('#cpt-listings-wrap').length ) {
  			OCS.$body.addClass('grid-available').addClass('list-available');
  			//temp for testing
  			OCS.$body.addClass('grid-layout');
  		}
  		$('.view-grid').on('click', function() {
              if ($('.compass-coa') || $('.ecoregion-svg').length) {
                  OCS.$body.removeClass('map-visible');

                  //grids for COAs needs to be alphabetical
                  var type = "grid";
                  coaSort(type);

                  if ($('.compass-coa').length) {
                    $('.image-grid-container .coa-placeholder').show();
                  }
              }
  			OCS.$body.addClass('grid-layout').removeClass('list-layout');
  			return false;
  		});
  		$('.view-list').on('click', function() {
          if ($('.compass-coa') || $('.ecoregion-svg').length) {
            OCS.$body.removeClass('map-visible');

            //list for COAs needs to be numeric
            var type = 'list';
            coaSort(type);

            if ($('.compass-coa').length) {
              $('.image-grid-container .coa-placeholder').hide();
            }
          }
  			OCS.$body.addClass('list-layout').removeClass('grid-layout');
  			return false;
  		});
      $('.view-map').on('click', function() {
          if ($('.compass-coa') || $('.ecoregion-svg').length) {
              OCS.$body.removeClass('list-layout grid-layout article-layout');
          }
          return false;
      });
      $('.view-article').on('click', function() {
        OCS.$body.removeClass('map-visible');
  			OCS.$body.addClass('article-layout');
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
