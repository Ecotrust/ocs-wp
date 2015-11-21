<?php
/**
 * Create function and shortcode for displaying Compass URLs
 *
 * $url @param expects a single url to be passed starting with the #
 * not the full url
 *
 */


/**
 * Define Prefix and Suffix for Compass URL inclusions
 * Inititally defined in wp-config.php but just in case.
 */

	if (!defined('COMPASS_URL_PREFIX')) {
	  // Path to the build directory for front-end assets
	  define('COMPASS_URL_PREFIX', 'http://52.25.124.64/visualize/');
	}
	if (!defined('COMPASS_URL_SUFFIX')) {
	  // Path to the build directory for front-end assets
	  define('COMPASS_URL_SUFFIX', '&print=true');
	}

function external_odfw_compass_url ($url) {
    //external compass should always display 0.75 opacity with Oregon Mask Layer
    return COMPASS_URL_PREFIX . $url . '&print=false&dls%5B%5D=true&dls%5B%5D=0.75&dls%5B%5D=549';
}
function get_the_odfw_compass_iframe ($url) {
	//$cleanURL = esc_html( $url );
	$fullURL = COMPASS_URL_PREFIX . $url . COMPASS_URL_SUFFIX;

	$out = '<section class="compass-wrap">';
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


function ocs_list_ecoregions ($ecorgions) {
	$out = "";
	$out .=	'<ul class="associated-ecoregions">';

		// Get the associated ecoregion names
		$args = array(
			'post_type' => 'ecoregion',
			'post__in' => $ecorgions,
			'orderby' => 'date',
			'order' => 'ASC',
			'posts_per_page'=> '30', // -1 == show all
		);

		$loop = new WP_Query( $args );


	if( $loop->have_posts() ):
		while( $loop->have_posts() ): $loop->the_post();

		global $post;
		$out .= "<li><a id='$post->ID' href='/ecoregion/$post->post_name'>$post->post_title</a></li>";

		endwhile;
	endif;

	$out .= '</ul>';
	echo $out;

	/* Restore original Post Data */
	wp_reset_postdata();


}
