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
	//$content = str_replace('###replaceme###', 'something_else',$content);
	$markupOpen = "<div class='read-more-wrap'>";
	$markupClose = '</div><button class="inline-read-more" data-original="Continue Reading" data-alternate="Close Overivew">Continue Reading</button>';
	$content = preg_replace('/<span id\=\"(more\-\d+)"><\/span>/', '<span id="\1"></span>'."\n\n". $markupOpen ."\n\n", $content);
	$content .= $markupClose;
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









