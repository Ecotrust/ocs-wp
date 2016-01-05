<?php
/**
 * OCS Search Settings
 *
 *
 */


/**
 * Define Prefix and Suffix for Compass URL inclusions
 * Inititally defined in wp-config.php but just in case.
 */

/*
 * Adjust the total number of results displayed from 10 to 200
 */
add_filter('post_limits', 'OCS_postsperpage');
function OCS_postsperpage($limits) {
	if (is_search()) {
		global $wp_query;
		$wp_query->query_vars['posts_per_page'] = 200;
	}
	return $limits;
}




/**
 * Include the content from related success stories
 *
 * Success Stories are only associated by ID. This grabs the content from the ID and appends it
 * to the "owning" page's search terms.
 */
add_filter('relevanssi_content_to_index', 'ocs_include_success_stories_in_page_indexing', 10, 2);
add_filter('relevanssi_excerpt_content', 'ocs_include_success_stories_in_page_indexing', 10, 2);
function ocs_include_success_stories_in_page_indexing($content, $post) {

    $successStory = get_post_meta( $post->ID, 'success_story', true );

    if (is_numeric($successStory)) {

		$content .= apply_filters('the_content', get_post_field('post_content', $successStory));

	}

    return $content;
}

/**
 *
 * Group results by post type
 *
 * OFF for now. -wm
 *
 */

add_filter('relevanssi_hits_filter', 'group_results_by_post_type');
function group_results_by_post_type($hits) {
	$searchTerm = $hits[1];

    $types = array();
	$types['titles'] = array();
	$types['post'] = array();
	$types['page'] = array();
	$types['attachment'] = array();
	$types['ecoregion'] = array();
	$types['kci'] = array();
	$types['coa'] = array();
	$types['strategy_habitat'] = array();
	$types['strategy_species'] = array();
	$types['success_story'] = array();


    // Split the post types in array $types
    if (!empty($hits)) {
        foreach ($hits[0] as $hit) {
			//Pull anything with the term in the title up top
			if(stripos($hit->post_title, $searchTerm) !== false ){
				array_push($types['titles'], $hit);
			} else {
				array_push($types[$hit->post_type], $hit);
			}
        }
    }

    // Merge back to $hits in the desired order
	$hits[0] = array_merge($types['titles'], $types['coa'], $types['kci'], $types['ecoregion'], $types['strategy_habitat'], $types['strategy_species'], $types['page'], $types['success_story'], $types['attachment'], $types['post']);
    return $hits;
}

/**
 * Add Some Extra Classes to each Result
 */

function category_id_class( $classes ) {
	if( is_search() ){
		global $post;
		if ( $post->relevance_score > 1000 ) {
			$classes[] = "relavance-high";
		}
	}
	return $classes;
}
//add_filter( 'post_class', 'category_id_class' );
