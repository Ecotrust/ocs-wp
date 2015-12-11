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
//add_shortcode('linkbox', 'the_odfw_success_story_shortcode');




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

function ocs_list_strategy_habitats ($strategy_habitats) {
	$out = "";
	$out .=	'<ul class="associated-strategy-habitats">';

		// Get the associated ecoregion names
		$args = array(
			'post_type' => 'strategy_habitat',
			'post__in' => $strategy_habitats,
			'orderby' => 'date',
			'order' => 'ASC',
			'posts_per_page'=> '-1', // -1 == show all
		);

		$loop = new WP_Query( $args );


	if( $loop->have_posts() ):
		while( $loop->have_posts() ): $loop->the_post();

		global $post;
		$out .= "<li><a id='$post->ID' href='/strategy-habitat/$post->post_name'>$post->post_title</a></li>";

		endwhile;
	endif;

	$out .= '</ul>';
	echo $out;

	/* Restore original Post Data */
	wp_reset_postdata();

}

function ocs_list_coa_strategy_species ($strategy_species, $meta="") {
	$out = "";
	$out .=	'<ul class="associated-strategy-species long-list">';

/*

Needs to be broken down by top level taxonomy (amphibian, bird, reptile...)
	These are taxonomies currently. Either need to:
		Add other 'parents' to the taxonomy for (special grouped fish)
		Create top level CPTs for existing taxonomy items
			Either way, page listings could/should be cleaned up

*/
	$species_ids = array_map(
        function($species) { return $species['coa_meta_strategy_species_id']; },
        $strategy_species
	);

	// Get the associated ecoregion names
	$args = array(
		'post_type' => 'strategy_species',
		'post__in' => $species_ids,
		'orderby' => 'title',
		'order' => 'ASC',
		'posts_per_page'=> '-1', // -1 == show all
	);

	$loop = new WP_Query( $args );

	$i = 0;
	if( $loop->have_posts() ):
		while( $loop->have_posts() ): $loop->the_post();

		global $post;
		$asso =  $strategy_species[$i]['coa_meta_strategy_species_association'];
		$out .= "<li><a id='$post->ID' href='/strategy-species/$post->post_name'>$post->post_title</a>";
		$out .= " ($asso)</li>";


		$i++;
		endwhile;
	endif;

	$out .= '</ul>';
	echo $out;

	/* Restore original Post Data */
	wp_reset_postdata();

}

