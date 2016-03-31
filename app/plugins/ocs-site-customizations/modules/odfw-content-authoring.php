<?php
/**
 * Create function and shortcode for displaying Compass URLs
 *
 * $url @param expects a single url to be passed starting with the #
 * not the full url
 *
 */


function external_odfw_compass_url ($url) {
	$prefix = ocs_get_option('ocs-compass-url-prefix');
	//external compass should always display 0.75 opacity with Oregon Mask Layer
	return $prefix . $url . '&print=false&dls%5B%5D=true&dls%5B%5D=0.75&dls%5B%5D=549';
}

function get_the_odfw_compass_iframe ($url) {
	//$cleanURL = esc_html( $url );
	$prefix = ocs_get_option('ocs-compass-url-prefix');
	$fullURL = $prefix . $url . '&print=true';

	$out  = '<section class="compass-wrap">';
	$out .= '<iframe class="compass-iframe" frameborder="0" src="' . $fullURL .'"></iframe>';
	$out .= '</section>';

	return $out;
}
function the_odfw_compass_iframe ($url) {
	echo get_the_odfw_compass_iframe($url);
}
function the_odfw_compass_iframe_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
        "url" => 'Please Include A Compass URL'
    ), $atts));
	return get_the_odfw_compass_iframe($url);
}
add_shortcode('compassMap', 'the_odfw_compass_iframe_shortcode');



/*
	can use this to allow the shortcode (and paragraph tags) to be
	used within custom fields.

function yourprefix_get_wysiwyg_output( $meta_key, $post_id = 0 ) {
    global $wp_embed;

    $post_id = $post_id ? $post_id : get_the_id();

    $content = get_post_meta( $post_id, $meta_key, 1 );
    $content = $wp_embed->autoembed( $content );
    $content = $wp_embed->run_shortcode( $content );
    $content = do_shortcode( $content );
    $content = wpautop( $content );

    return $content;
}

USE:
	echo yourprefix_get_wysiwyg_output( 'wiki_test_wysiwyg', get_the_ID() );

*/


function get_the_odfw_success_story ($id) {
	$out = "";
	$success_story = get_post($id);
	if ($success_story):
		$out .= '<aside class="success-story" name="success-story">';
		$out .= '<h3>' . $success_story->post_title . ' </h3>';
		$out .= '<div class="success-story-content">';
		$out .= apply_filters('the_content', $success_story->post_content);
		$out .= '</div>';
		$out .= '</aside>';
	endif;
return $out;
}
function the_odfw_success_story ($id) {
	echo get_the_odfw_success_story($id);
}
function the_odfw_success_story_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
        "id" => 'Please Include A Success Story ID'
    ), $atts));
	return get_the_odfw_success_story($id);
}

add_shortcode('success-story', 'the_odfw_success_story_shortcode');


function the_odfw_link_box_shortcode($atts, $content = null) {
	return '<div class="link-box">' . $content . '</div>';
}

add_shortcode('linkbox', 'the_odfw_link_box_shortcode');
