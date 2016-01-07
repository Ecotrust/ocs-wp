<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Config;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }


	// Add species tax-slug to body to highlight proper item in left nav
	if (get_post_type() == 'strategy_species') {
		$custom_terms = get_the_terms(0, 'species');
		if ($custom_terms) {
		  foreach ($custom_terms as $custom_term) {
			$classes[] = 'tax-species-' . $custom_term->slug;
		  }
		}
	}

  }

  // Add class if sidebar is active
  if (Config\display_sidebar()) {
    $classes[] = 'has-sidebar';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');





/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip;';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

function modify_read_more_link() {
	return '<a class="more-link">Your Read More Link Text</a>';
}
//add_filter( 'the_content_more_link', __NAMESPACE__ . '\\modify_read_more_link' );

function replace_content($content) {
	// could limit it to specific pages with something like:
	//
	// $cptPages = Roots\Sage\Config\get_the_cpt_listing_pages();
	// if (in_array($post->ID, $cptPages) )
	// but seems ok/open for now.
	$count = 0;

	$markupOpen = "<div class='read-more-wrap'>";
	$markupClose = '</div><button class="inline-read-more" data-original="READ MORE" data-alternate="READ LESS">READ MORE</button>';

	$content = preg_replace('/<span id\=\"(more\-\d+)"><\/span>/', '<span id="\1"></span>'."\n\n". $markupOpen ."\n\n", $content, 1, $count);

	// only if it actually found something:
	if ( $count > 0 ) {
		$content .= $markupClose;
	}
	return $content;
}
add_filter('the_content', __NAMESPACE__ . '\\replace_content');


add_filter('sage/wrap_base', __NAMESPACE__ . '\\sage_wrap_base_cpts'); // Add our function to the sage/wrap_base filter

//allow for different base templates via CPTs. eg base-ecoregion.php
function sage_wrap_base_cpts($templates) {
	$cpt = get_post_type(); // Get the current post type
	if ($cpt) {
		array_unshift($templates, 'base-' . $cpt . '.php'); // Shift the template to the front of the array
	}
	return $templates; // Return our modified array with base-$cpt.php at the front of the queue
}







function add_post_id_to_nav_items( $classes, $item ) {
	$classes[] = 'page-item-' . $item->object_id;
    return $classes;
}
//add_filter( 'nav_menu_css_class',  __NAMESPACE__ . '\\add_post_id_to_nav_items', 10, 2 );

function highlight_cpt_parent( $classes, $item ) {
	// Get the current post details
	global $post;

	// no $post on a 404!
	// Also, need to make sure a search for 'frog' doesn't open up the sidebar
	if ( $post && !is_search() ):
		// Get the species terms for the current post
		$term_list = wp_get_post_terms($post->ID, 'species', array("fields" => "names"));
		if ( !empty($term_list)) {
			$current_post_term = strtolower(trim($term_list[0]));

			// Get the URL of the menu item
			$menu_slug = strtolower(trim($item->url));

			// if we have a taxonomy term and the slug has 'ocs-strategy-species' and there is no parent, most be the main SS
			// page. Need to start with turning that "on".
			if ( $current_post_term !== "" && strpos($menu_slug, 'ocs-strategy-species') !== false && $item->post_parent == 0 ) {
				$classes[] = 'current-menu-parent';
			}
			// If the menu item URL contains the current post taxonomy term, since we know they're 1:1
			// set that item to active
			else if (strpos($menu_slug,$current_post_term) !== false) {
			   $classes[] = 'current-menu-item';
			}
		}
	endif;
    return $classes;
}
add_filter( 'nav_menu_css_class',  __NAMESPACE__ . '\\highlight_cpt_parent', 10, 2 );

