<?php

namespace Roots\Sage\CPT;

use WP_Query;

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

		//global $post;
		//$out .= "<li><a id='$post->ID' href='/ecoregion/$post->post_name'>$post->post_title</a></li>";

			$out .= get_template_part('/templates/cpt-parts/part', 'ecoregion');

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

			$out .= get_template_part('/templates/cpt-parts/part', 'strategy_habitat');

		endwhile;
	endif;

	$out .= '</ul>';
	echo $out;

	/* Restore original Post Data */
	wp_reset_postdata();

}


function ocs_list_coa_strategy_species ($strategy_species, $meta="", $coa=false) {
	$out = "";
	//$out .=	'<ul class="associated-strategy-species long-list">';

	//$incAssoc = get_query_var('coa-listing', false);




/*

Needs to be broken down by top level taxonomy (amphibian, bird, reptile...)
	These are taxonomies currently. Either need to:
		Add other 'parents' to the taxonomy for (special grouped fish)
		Create top level CPTs for existing taxonomy items
			Either way, page listings could/should be cleaned up

*/

	/*
	 * For COAs, the species array looks like this:
	 * [0] => Array (
            [coa_meta_strategy_species_id] => 1004
            [coa_meta_strategy_species_association] => Observed
        )
	    [1] => Array (
            [coa_meta_strategy_species_id] => 1013
            [coa_meta_strategy_species_association] => Observed
        )
	 *
	 * This array map is to pull the species IDs out.
	 */

	if ( $coa ) {
		$species_ids = array_map(
			function($species) { return $species['coa_meta_strategy_species_id']; },
			$strategy_species
		);
	} else {
		$species_ids = $strategy_species;
	}

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

		//global $post;
		//$asso =  $strategy_species[$i]['coa_meta_strategy_species_association'];
		//$out .= "<li><a id='$post->ID' href='/strategy-species/$post->post_name'>$post->post_title</a>";
		//$out .= " <span class='species-association'>($asso)</span></li>";

		if($coa) {
			//set_query_var( 'coa-assoc', $strategy_species[$i]['coa_meta_strategy_species_association'] );
			set_query_var( 'coa-assoc', $strategy_species[$i]['coa_meta_strategy_species_association'] );
		}
			$out .= get_template_part('/templates/cpt-parts/part', 'species');
			//$out = include(locate_template('/templates/cpt-parts/part-species.php'));

		$i++;
		endwhile;
	endif;

	//$out .= '</ul>';
	echo $out;

	/* Restore original Post Data */
	wp_reset_postdata();

}

function ocs_list_ecoregion_associated_species ($ecoregion_id){
	$this_ID = $ecoregion_id;
	$out = "";
	if (isset($this_ID) && !empty($this_ID) ) {

		$args=array(
			'post_type' => 'strategy_species',
			'orderby' => 'post_title',
			'order' => 'ASC',
			'posts_per_page' => 100,
			'meta_query' => array(
				array (
					'key' => 'species_meta_attached_ecoregions',
					'value' => $this_ID,
					'compare' => 'LIKE'
				)
			),
		);
		$loop = new WP_Query($args);

			if( $loop->have_posts() ):
				while( $loop->have_posts() ): $loop->the_post();

					$out .= get_template_part('/templates/cpt-parts/part', 'species');

				endwhile;
			endif;

		echo $out;
		/* Restore original Post Data */
		wp_reset_postdata();
	}

}


function ocs_list_ecoregion_associated_COA ($ecoregion_id){
	$this_ID = $ecoregion_id;
	$out = "";
	if (isset($this_ID) && !empty($this_ID) ) {

		$args=array(
			'post_type' => 'coa',
			'orderby' => 'post_title',
			'order' => 'ASC',
			'posts_per_page' => -1,
			'meta_query' => array(
				array (
					'key' => 'coa_meta_attached_ecoregions',
					'value' => $this_ID,
					'compare' => 'LIKE'
				)
			),
		);
		$loop = new WP_Query($args);

			if( $loop->have_posts() ):
				while( $loop->have_posts() ): $loop->the_post();

					$out .= get_template_part('/templates/cpt-parts/part', 'coa');

				endwhile;
			endif;

		echo $out;
		/* Restore original Post Data */
		wp_reset_postdata();
	}

}


function ocs_list_sub_species ($species_id){
	if (isset($species_id) && !empty($species_id) ) {

		$out = "";

		$args=array(
			'post_type' => 'strategy_species',
			'orderby' => 'post_title',
			'post_parent' => $species_id,
			'order' => 'ASC',
			'posts_per_page' => -1,
		);
		$loop = new WP_Query($args);

			if( $loop->have_posts() ):
				echo "<section class='sub-species listings-wrap'>";
				echo "<h2>Sub-Species</h2>";
				echo "<div class='grid-layout'>";

					while( $loop->have_posts() ): $loop->the_post();

						//$out .= get_template_part('/templates/cpt-parts/part', 'species');
						get_template_part('/templates/cpt-parts/part', 'species');

					endwhile;

				echo "</div></section>";
			endif;


		//echo $out;
		/* Restore original Post Data */
		wp_reset_postdata();
	}

}
