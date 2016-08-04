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

	if ( $coa ) {
		$species_ids = array_map(
			function($species) { return $species['coa_meta_strategy_species_id']; },
			$strategy_species
		);
		$species_asc = array_map(
			function($species) { return $species['coa_meta_strategy_species_association']; },
			$strategy_species
		);
	} else {
		$species_ids = $strategy_species;
	}
	
	$i = 0;
	foreach ($species_ids as $specID) {
		$specAsc = $species_asc[$i];
		global $specID,$specAsc;
		$out .= get_template_part('/templates/cpt-parts/part', 'strategy_species');
		$i++;
	}
	echo $out;
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

					$out .= get_template_part('/templates/cpt-parts/part', 'strategy_species');

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
				echo "<h2>SMU/ESU/DPS/Subspecies</h2>";
				echo "<div class='grid-layout'>";

					while( $loop->have_posts() ): $loop->the_post();

						//$out .= get_template_part('/templates/cpt-parts/part', 'strategy_species');
						get_template_part('/templates/cpt-parts/part', 'strategy_species');

					endwhile;

				echo "</div></section>";
			endif;


		//echo $out;
		/* Restore original Post Data */
		wp_reset_postdata();
	}

}
