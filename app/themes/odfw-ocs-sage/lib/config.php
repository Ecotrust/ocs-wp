<?php

namespace Roots\Sage\Config;

use Roots\Sage\ConditionalTagCheck;

/**
 * Enable theme features
 */
add_theme_support('soil-clean-up');         // Enable clean up from Soil
//add_theme_support('soil-nav-walker');       // Enable cleaner nav walker from Soil
add_theme_support('soil-relative-urls');    // Enable relative URLs from Soil
add_theme_support('soil-nice-search');      // Enable nice search from Soil
add_theme_support('soil-jquery-cdn');       // Enable to load jQuery from the Google CDN

/**
 * Configuration values
 */
if (!defined('WP_ENV')) {
  // Fallback if WP_ENV isn't defined in your WordPress config
  // Used in lib/assets.php to check for 'development' or 'production'
  define('WP_ENV', 'production');
}

if (!defined('DIST_DIR')) {
  // Path to the build directory for front-end assets
  define('DIST_DIR', '/dist/');
}

/**
 * Define which pages shouldn't have the sidebar
 */
function display_sidebar() {
  static $display;

  if (!isset($display)) {
    $conditionalCheck = new ConditionalTagCheck(
      /**
       * Any of these conditional tags that return true won't show the sidebar.
       * You can also specify your own custom function as long as it returns a boolean.
       *
       * To use a function that accepts arguments, use an array instead of just the function name as a string.
       *
       * Examples:
       *
       * 'is_single'
       * 'is_archive'
	   * 'is_front_page',
       * ['is_page', 'about-me']
       * ['is_tax', ['flavor', 'mild']]
       * ['is_page_template', 'about.php']
       * ['is_post_type_archive', ['foo', 'bar', 'baz']]
       *
       */
      [
        'is_404',
		'is_front_page',
		['is_tax', 'species'],
		['is_page',  get_the_cpt_listing_pages() ],
		['is_page',  get_the_species_listing_pages() ],
        ['is_page_template', 'template-custom.php']
      ]
    );
    $display = apply_filters('sage/display_sidebar', $conditionalCheck->result);
  }

  return $display;
}

function get_the_cpt_listing_pages_assoc () {
	// CPT listings
	$OCS_cptListingPages = array(
		"99" => "kci",  // KCIs
		"101" => "ecoregion", // Ecoregions
		"102" => "coa",// COAs
		"105" => "strategy_habitat", // Strategy Habitats
		109, // Strategy Species Parent Page
	);
	return $OCS_cptListingPages;

}

function get_the_cpt_listing_pages () {
	// CPT listings
	$OCS_cptListingPages = array(
		99,  // KCIs
		101, // Ecoregions
		102,// COAs
		105, // Strategy Habitats
		109, // Strategy Species Parent Page
	);
	return $OCS_cptListingPages;

}

function get_the_species_listing_pages () {
	// Strategy Species sub pages
	$OCS_species_sub_pages = array(
		110, //Birds
		111, //Mammals
		112, //Amphibians
		113, //Reptiles
		114, //Fish
		115, //Invertebrates
		116, //Plants and Algae
	);

	return $OCS_species_sub_pages;

}
