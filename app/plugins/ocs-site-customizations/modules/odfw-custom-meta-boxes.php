<?php

/**
 * Define all custom fields for different OCS content types
 *
 */

function setupCustomFields () {

	// A few helpers

	function get_compass_instructions () {
		$compassDescription = 	'Include a Compass URL here. Only include the portion of the URL starting with the #. So, if the URL is <br> ';
		$compassDescription .= '<small>http://52.25.124.64/visualize/#x=-121.65&y=44.11&z=7&logo=true&dls%5B%5D=true&dls%5B%5D=0.5&dls%5B%5D=456&basemap=ESRI+Ocean&themes%5Bids%5D%5B%5D=27&tab=data</small>';
		$compassDescription .= '<br><strong>Remove:</strong><br><small> <strong><strike>http://52.25.124.64/visualize/</strike></strong>  before pasting.</small>';
		return 	$compassDescription;
	}

	function odfw_get_ecoregions (){
		$args = array(
			'posts_per_page'   => -1,
			'orderby'          => 'title',
			'order'            => 'ASC',
			'post_type'        => 'ecoregion',
		);
		$ecoregions = get_posts( $args );
		return $ecoregions;
	}
	function odfw_get_species (){
		$args = array(
			'taxonomy'          => 'species',
		);
		$species = get_categories( $args );
		//$species = get_terms( 'species');
		print_r($species);
		return $species;
	}
	/**
	 * Gets a number of terms and displays them as options
	 * @param  string       $taxonomy Taxonomy terms to retrieve. Default is category.
	 * @param  string|array $args     Optional. get_terms optional arguments
	 * @return array                  An array of options that matches the CMB2 options array
	 */
	function cmb2_get_term_options( $taxonomy = 'category', $args = array() ) {

		$args['taxonomy'] = $taxonomy;
		// $defaults = array( 'taxonomy' => 'category' );
		$args = wp_parse_args( $args, array( 'taxonomy' => 'category' ) );

		$taxonomy = $args['taxonomy'];

		$terms = (array) get_terms( $taxonomy, $args );

		// Initate an empty array
		$term_options = array();
		if ( ! empty( $terms ) ) {
			foreach ( $terms as $term ) {
				$term_options[ $term->term_id ] = $term->name;
			}
		}

		return $term_options;
	}

	/**
	 * Gets a number of posts and displays them as options
	 * @param  array $query_args Optional. Overrides defaults.
	 * @return array An array of options that matches the CMB2 options array
	 */
	function cmb2_get_post_options( $query_args ) {

		$args = wp_parse_args( $query_args, array(
			'numberposts'       => 15,
			'posts_per_page'    => -1,
			'post_type'         => 'post',
			'orderby'           => 'title',
			'order'             => 'ASC',
		) );

		$posts = get_posts( $args );

		$post_options = array();
		if ( $posts ) {
			foreach ( $posts as $post ) {
				$post_options[ $post->ID ] = $post->post_title;
			}
		}

		return $post_options;
	}



	add_action( 'cmb2_init', 'kci_metabox' );

	function kci_metabox() {

		$prefix = 'kci_';


		$kci_cmb = new_cmb2_box( array(
			'id'           => $prefix . 'goals',
			'title'        => __( 'Goals and Actions', 'odfw' ),
			'desc' => __( 'Groups of goals and actions.', 'odfw' ),
			'object_types' => array( 'kci' ),
			'context'      => 'normal',
			'priority'     => 'default',
		) );



		$goal_group_field_id = $kci_cmb->add_field( array(
			'id'          => 'goals_and_actions_repeat_group',
			'type'        => 'group',
			'description' => __( 'Goals and Actions for this KCI. Please note: Due to a bug, you *must* save this entry between adding each additonal goal/action set in order to use the full text editor.', 'odfw' ),
			'options'     => array(
				'group_title'   => __( 'Goal {#}', 'odfw' ),
				'add_button'    => __( 'Add Another Goal/Action set', 'odfw' ),
				'remove_button' => __( 'Remove this goal', 'odfw' ),
				'sortable'      => true, // beta
				),
		) );


	   $kci_cmb->add_group_field( $goal_group_field_id, array(
			'name' => __( 'Goal Title', 'odfw' ),
			'id' => $prefix . 'goal_title',
			'type' => 'text',
		) );

		/*
	   $kci_cmb->add_group_field( $goal_group_field_id, array(
			'name' => __( 'Action Title', 'odfw' ),
			'id' => $prefix . 'action_title',
			'type' => 'text',
		) );

		 */

	   $kci_cmb->add_group_field( $goal_group_field_id, array(
			'name' => __( 'Actions', 'odfw' ),
			'id' => $prefix . 'actions',
			'type'    => 'wysiwyg',
			'options' => array()
			) );

	}










	/*
	 *
	 * strategy_species
	 *
	 */

	add_action( 'cmb2_init', 'species_cpt_metabox' );
	function species_cpt_metabox(  ) {

		$prefix = 'species_meta_';

		$ss_cmb = new_cmb2_box( array(
			'id'           => $prefix . 'strategy_species',
			'title'        => __( 'Species Metadata', 'odfw' ),
			'object_types' => array( 'strategy_species' ),
			'context'      => 'normal',
			'priority'     => 'high',
		) );

		$ss_cmb->add_field( array(
			'name' => __( 'Compass Link', 'odfw' ),
			'id' => $prefix . 'compass-link',
			'type' => 'textarea_small',
			'desc' => get_compass_instructions()
		));
		$ss_cmb->add_field( array(
			'name' => __( 'Species Common Name', 'odfw' ),
			'id' => $prefix . 'species-common-name',
			'type' => 'text',
		));
		$ss_cmb->add_field( array(
			'name' => __( 'Species Scientific Name', 'odfw' ),
			'id' => $prefix . 'species-scientific-name',
			'type' => 'text',
		));
		$ss_cmb->add_field( array(
			'name' => __( 'SMU/ESU/DPS/Group', 'odfw' ),
			'id' => $prefix . 'species-group',
			'type' => 'text',
		));
		$ss_cmb->add_field( array(
			'name' => __( 'Federal listing status', 'odfw' ),
			'id' => $prefix . 'federal-listing-status',
			'type' => 'text',
		));
		$ss_cmb->add_field( array(
			'name' => __( 'State listing status', 'odfw' ),
			'id' => $prefix . 'state-listing-status',
			'type' => 'text',
		));
		$ss_cmb->add_field( array(
			'name'    => __( 'Associated Ecoregions', 'cmb2' ),
			'desc'    => __( 'Drag posts from the left column to the right column to attach them to this page.<br />You may rearrange the order of the posts in the right column by dragging and dropping.', 'cmb2' ),
			'id'      =>  $prefix . 'attached_ecoregions',
			//'before_row'   => '<p> Click the (+) next to any item to associate it with this content</p>',
			'type'    => 'custom_attached_posts',
			'options' => array(
				'show_thumbnails' => false, // Show thumbnails on the left
				'filter_boxes'    => true, // Show a text box for filtering the results
				'query_args'      => array( 'post_type' => 'ecoregion', 'posts_per_page' => -1 ), // override the get_posts args
			)
		));
		$ss_cmb->add_field( array(
			'name' => __( 'Special needs', 'odfw' ),
			'id' => $prefix . 'special-needs',
			'type' => 'textarea',
			'row_classes' => 'species-textarea',
		));
		$ss_cmb->add_field( array(
			'name' => __( 'Limiting factors', 'odfw' ),
			'id' => $prefix . 'limiting-factors',
			'type' => 'textarea',
			'row_classes' => 'species-textarea',
		));
		$ss_cmb->add_field( array(
			'name' => __( 'Data gaps', 'odfw' ),
			'id' => $prefix . 'data-gaps',
			'type' => 'textarea',
			'row_classes' => 'species-textarea',
		));
		$ss_cmb->add_field( array(
			'name' => __( 'Conservation actions', 'odfw' ),
			'id' => $prefix . 'conservation-actions',
			'type' => 'textarea',
			'row_classes' => 'species-textarea',
		));
		$ss_cmb->add_field( array(
			'name' => __( 'Key reference or plan', 'if available', 'odfw' ),
			'id' => $prefix . 'key-reference',
			'type' => 'textarea',
			'desc' => __( 'URLs in this field will be automatically converted to clickable links', 'odfw' ),
		));
		$ss_cmb->add_field( array(
			'name' => __( 'Full URL to Thumbnail Image', 'odfw' ),
			'id' => $prefix . 'image-thumb-url',
			'type' => 'text_url',
			'show_on_cb' => 'speciesimageloaded',
			'row_classes' => 'species-image',
		));
		$ss_cmb->add_field( array(
			'name' => __( 'Full URL to Image', 'odfw' ),
			'id' => $prefix . 'image-url',
			'type' => 'text_url',
			'show_on_cb' => 'speciesimageloaded',
			'row_classes' => 'species-image',
		));
		$ss_cmb->add_field( array(
			'name' => __( 'Image Attribution', 'odfw' ),
			'id' => $prefix . 'image-attribution',
			'type' => 'text',
			'desc' => __( 'URLs in this field will be automatically converted to clickable links', 'odfw' ),
		));



	}





	//add_filter('cmb2-taxonomy_meta_boxes', 'species_add_metabox');
	//add_action( 'cmb2_init', 'species_add_metabox' )
	function species_add_metabox( array $meta_boxes ) {

		$prefix = 'species_meta_';


		$meta_boxes['species_meta_species'] = array(
			'id'           => $prefix . 'species',
			'title'        => __( 'Species Metadata', 'odfw' ),
			'object_types' => array( 'species' ),
			'context'      => 'normal',
			'priority'     => 'high',
			'fields'        => array(
				array(
					'name' => __( 'Compass Link', 'odfw' ),
					'id' => $prefix . 'compass-link',
					'type' => 'textarea_small',
					'desc' => get_compass_instructions()
				),
				array(
					'name' => __( 'Species Common Name', 'odfw' ),
					'id' => $prefix . 'species-common-name',
					'type' => 'text',
				),
				array(
					'name' => __( 'Species Scientific Name', 'odfw' ),
					'id' => $prefix . 'species-scientific-name',
					'type' => 'text',
				),
				array(
					'name' => __( 'SMU/ESU/DPS/Group', 'odfw' ),
					'id' => $prefix . 'species-group',
					'type' => 'text',
				),
				array(
					'name' => __( 'Federal listing status', 'odfw' ),
					'id' => $prefix . 'federal-listing-status',
					'type' => 'text',
				),
				array(
					'name' => __( 'State listing status', 'odfw' ),
					'id' => $prefix . 'state-listing-status',
					'type' => 'text',
				),
				array(
					'name' => __( 'Special needs', 'odfw' ),
					'id' => $prefix . 'special-needs',
					'type' => 'textarea',
					'row_classes' => 'species-textarea',
				),
				array(
					'name' => __( 'Limiting factors', 'odfw' ),
					'id' => $prefix . 'limiting-factors',
					'type' => 'textarea',
					'row_classes' => 'species-textarea',
				),
				array(
					'name' => __( 'Data gaps', 'odfw' ),
					'id' => $prefix . 'data-gaps',
					'type' => 'textarea',
					'row_classes' => 'species-textarea',
				),
				array(
					'name' => __( 'Conservation actions', 'odfw' ),
					'id' => $prefix . 'conservation-actions',
					'type' => 'textarea',
					'row_classes' => 'species-textarea',
				),
				array(
					'name' => __( 'Key reference or plan', 'if available', 'odfw' ),
					'id' => $prefix . 'key-reference',
					'type' => 'textarea',
					'desc' => __( 'URLs in this field will be automatically converted to clickable links', 'odfw' ),
				),
				array(
					'name' => __( 'Full URL to Image', 'odfw' ),
					'id' => $prefix . 'image-url',
					'type' => 'text_url',
					'show_on_cb' => 'speciesimageloaded',
					'row_classes' => 'species-image',
				),
				array(
					'name' => __( 'Image Attribution', 'odfw' ),
					'id' => $prefix . 'image-attribution',
					'type' => 'text',
					'desc' => __( 'URLs in this field will be automatically converted to clickable links', 'odfw' ),
				)
			) //fields
		); //meta-boxes

		return $meta_boxes;

	}




	/*
	 * COA
	 */


	add_action( 'cmb2_init', 'coa_metabox' );
	function coa_metabox(  ) {

		$prefix = 'coa_meta_';

		$coa_cmb = new_cmb2_box( array(
			'id'           => $prefix . 'coa',
			'title'        => __( 'Conservation Opportunity Area Details', 'odfw' ),
			'object_types' => array( 'coa' ),
			'context'      => 'normal',
			'priority'     => 'high',
		) );


		$species_group_field = $coa_cmb->add_field( array(
			'id' => $prefix . 'strategy_species',
			'type'        => 'group',
			'options'     => array (
				'group_title'   => __( 'Strategy Species {#}', 'odfw' ),
				'add_button'    => __( 'Add another Strategy Species', 'odfw' ),
				'remove_button' => __( 'Remove this Strategy Species', 'odfw' ),
				'sortable'      => true, // beta
				'attributes'  => array(
					'data-row-type'    => 'cmb-inline-rows',
				),
			),
		) );

			$coa_cmb->add_group_field( $species_group_field, array(
				'name' => __('Strategy Species ID', 'odfw'),
				'id'   => $prefix . 'strategy_species_id',
				'desc' => __('Use the spyglass icon to select a strategy_species.', 'odfw'),
				'type' => 'post_search_text',
				'post_type'   => 'strategy_species',
				'select_type' => 'radio',
				'select_behavior' => 'replace',
				'find_text'     => 'Find Species',
				'include_post_title'  => true,
				'after_row'   => 'OCS_get_the_name'
			) );

			$coa_cmb->add_group_field( $species_group_field, array(
				'name' => __('Strategy Species Association', 'odfw'),
				'id'   => $prefix . 'strategy_species_association',
				'desc' => __('Is the species modeled or observed?', 'odfw'),
				'type' => 'select',
				'select_type' => 'radio',
				'default'     => 'modeled',
				'options'     => array(
					'Modeled'   => __( 'Modeled', 'cmb' ),
					'Observed'  => __( 'Observed', 'cmb' ),
				),
			) );
/**
 * Conditionally displays a message if the $post_id is 2
 *
 * @param  array             $field_args Array of field parameters
 * @param  CMB2_Field object $field      Field object
 */
function OCS_get_the_name( $field_args, $field ) {
	//$title =  !empty($field->escaped_value) ?  get_the_title($field->escaped_value) : "";
	//echo "<label class='attached-post-title' for='" . $field->args('id') . "'>" . $title . "</label>";

}


		$coa_cmb->add_field( array(
			'name' => __( 'Compass Link', 'odfw' ),
			'id' => $prefix . 'compass_link',
			'type' => 'textarea_small',
			'desc' => get_compass_instructions()
		));


		$coa_cmb->add_field( array(
			'name' => __( 'COA ID', 'odfw' ),
			'id' => $prefix . 'coa_id',
			'type' => 'text',
		));

		$coa_cmb->add_field( array(
			'name'    => __( 'Associated Ecoregions', 'cmb2' ),
			'desc'    => __( 'Click the + sign or drag posts from the left column to the right column to attach them to this page.<br />You may rearrange the order of the posts in the right column by dragging and dropping.', 'cmb2' ),
			'id'      =>  $prefix . 'attached_ecoregions',
			'type'    => 'custom_attached_posts',
			//'post_type'   => 'coa',
			'options' => array(
				'show_thumbnails' => false, // Show thumbnails on the left
				'filter_boxes'    => true, // Show a text box for filtering the results
				'query_args'      => array( 'post_type' => 'ecoregion', 'posts_per_page' => -1), // override the get_posts args
			)
		));


		$local_actions_group_field = $coa_cmb->add_field( array(
			'id' => $prefix . 'local_conservation_actions_and_plans',
			'type'        => 'group',
			//'description' => __( 'Local Conservation Action or Plan', 'odfw' ),
			'options'     => array(
				'group_title'   => __( 'Local Conservation Action or Plan {#}', 'odfw' ),
				'add_button'    => __( 'Add another Local Conservation Action or Plan', 'odfw' ),
				'remove_button' => __( 'Remove this entry', 'odfw' ),
				'sortable'      => true, // beta
				)
		));

		   $coa_cmb->add_group_field( $local_actions_group_field, array(
				'name' => __( 'Local Conservation Action or Plan Title', 'odfw' ),
				'id' => $prefix . 'local_plan_title',
				'type' => 'text'
			) );

		   $coa_cmb->add_group_field( $local_actions_group_field, array(
				'name' => __( 'Action or Plan Link', 'odfw' ),
				'id' => $prefix . 'local_plan_link',
				'type' => 'text_url'
			) );


		$coa_cmb->add_field( array(
			'name' => 'Potential Partners',
			'type' => 'title',
			'id'   => 'potential_partners_title'
		));

		$potential_partners_group_field = $coa_cmb->add_field( array(
			'id' => $prefix . 'potential_partners',
			'type'        => 'group',
			//'description' => __( 'Potential Partners', 'odfw' ),
			'options'     => array(
				'group_title'   => __( 'Potential Partners {#}', 'odfw' ),
				'add_button'    => __( 'Add another Potential Partners', 'odfw' ),
				'remove_button' => __( 'Remove this entry', 'odfw' ),
				'sortable'      => true, // beta
				)
		) );


		   $coa_cmb->add_group_field( $potential_partners_group_field, array(
				'name' => __( 'Potential Partner Name', 'odfw' ),
				'id' => $prefix . 'potential_partner_title',
				'type' => 'text'
			) );

		   $coa_cmb->add_group_field( $potential_partners_group_field, array(
				'name' => __( 'Potential Partner Link', 'odfw' ),
				'id' => $prefix . 'potential_partner_link',
				'type' => 'text_url'
			) );


		$coa_cmb->add_field( array(
			'name' => 'Recommended Conservation Actions',
			'type' => 'title',
			'id'   => 'recommended-conservation-actions_title'
		) );

		$coa_cmb->add_field( array(
			'name' => __( 'Recommended Conservation Actions', 'odfw' ),
			'id' => $prefix . 'recommended_conservation_actions',
			'desc' => 'One recommendation per box. Click the [Add Another Recommendation] button to add another recommendation.',
			'type' => 'textarea_small',
			'options' => array(
				'add_row_text' => __( 'Add Another Recommendation', 'odfw' ),
			),
			'repeatable' => true
		));

		$coa_cmb->add_field( array(
			'name' => 'Special Features',
			'type' => 'title',
			'id'   => 'coa_special_features_title'
		) );

		$special_features_group_field = $coa_cmb->add_field( array(
			'id' => $prefix . 'special_features',
			'type'        => 'group',
			'options'     => array(
				'group_title'   => __( 'Special Features {#}', 'odfw' ),
				'add_button'    => __( 'Add another Special Feature', 'odfw' ),
				'remove_button' => __( 'Remove this Special Feature', 'odfw' ),
				'sortable'      => true, // beta
				)
		) );

		   $coa_cmb->add_group_field( $special_features_group_field, array(
				'name' => __( 'Special Feature Name', 'odfw' ),
				'id' => $prefix . 'special_feature_title',
				'type' => 'text'
			) );

		   $coa_cmb->add_group_field( $special_features_group_field, array(
				'name' => __( 'Special Feature Value', 'odfw' ),
				'id' => $prefix . 'special_features_value',
				'type' => 'text_url'
			) );


		$coa_cmb->add_field( array(
			'name' => __( 'Specialized Local Habitats', 'odfw' ),
			'id'=> $prefix . 'specialized_local_habitats',
			'desc' => 'One habitat per box. Click the [Add Another Recommendation] button to add another.',
			'type' => 'text',
			'options' => array(
				'add_row_text' => __( 'Add Another Specialized Local Habitat', 'odfw' ),
			),
			'repeatable' => true
		));

		$coa_cmb->add_field( array(
			'name'    => __( 'Associated Strategy Habitats', 'odfw' ),
			'desc'    => __( 'Click the + sign or drag posts from the left column to the right column to attach them to this page.<br />You may rearrange the order of the posts in the right column by dragging and dropping.', 'cmb2' ),
			'id'      =>  $prefix . 'attached_habitats',
			'type'    => 'custom_attached_posts',
			//'post_type'   => 'coa',
			'options' => array(
				'show_thumbnails' => false, // Show thumbnails on the left
				'filter_boxes'    => true, // Show a text box for filtering the results
				'query_args'      => array( 'post_type' => 'strategy_habitat', 'posts_per_page' => -1 ), // override the get_posts args
			)
		));




		/*
		$coa_cmb->add_field( array(
			'name'    => __( 'Associated Strategy Species', 'odfw' ),
			'desc'    => __( 'Drag posts from the left column to the right column to attach them to this page.<br />You may rearrange the order of the posts in the right column by dragging and dropping.', 'cmb2' ),
			'id'      =>  $prefix . 'key_species',
			'before_row'   => '<p> Click the (+) next to any item to associate it with this content</p>',
			'type'    => 'custom_attached_posts',
			//'post_type'   => 'coa',
			'options' => array(
				'show_thumbnails' => false, // Show thumbnails on the left
				'filter_boxes'    => true, // Show a text box for filtering the results
				'query_args'      => array( 'post_type' => 'strategy_species', 'posts_per_page' => -1 ), // override the get_posts args
			)
		));
		*/
		$coa_cmb->add_field( array(
			'name' => __( 'KCI Connections', 'odfw' ),
			'before_row'   => '<p>TBD if KCI Connections will be used here. They are currently a part of "Special Features"</p>',
			'id' => $prefix . 'kci_connections',
			'type' => 'text'
		));



		// repeater field for each species. Each one needs to be associated
		// with a binary 'observed' or 'modeled'


	}




	/*
	 *
	 * Success Story Boxes
	 *
	 */

  add_action('cmb2_init', 'success_story_metabox');
  function success_story_metabox() {
    $success_story_cmb = new_cmb2_box( array(
      'id'           => 'posts_success_story',
      'title'        => __('Associate a Success Story', 'odfw'),
      'desc'         => __('Select a success story to go with this post', 'odfw'),
      'object_types' => array('post', 'ecoregion', 'kci', 'strategy_habitat', 'coa', 'strategy_species', 'page'),
      'context'      => 'normal',
      'priority'     => 'low'
    ));

    $success_story_cmb->add_field(array(
      'name' => __('Success Story', 'odfw'),
      'desc' => __('Use the spyglass icon to select a success story to include with this post.', 'odfw'),
      'post_type'   => 'success_story',
      'id' => 'success_story',
	  'type' => 'post_search_text',
	  'select_type' => 'radio',
	  'select_behavior' => 'replace',

    ));
  }


	/*
	 *
	 * Ecoregion Boxes
	 *
	 */


	add_action( 'cmb2_init', 'ecoregion_metabox' );
	function ecoregion_metabox() {

		$prefix = 'ecoregion_meta_';

		$ecoregion_cmb = new_cmb2_box( array(
			'id'           => $prefix . 'ecoregion',
			'title'        => __( 'Ecoregion Details', 'odfw' ),
			'desc'         => __( 'Use main content area above for the main ecoregion description', 'odfw' ),
			'object_types' => array( 'ecoregion' ),
			'context'      => 'normal',
			'priority'     => 'high'
		) );


		/*
		 * Use Main Post Content Area
		$ecoregion_cmb->add_field( array(
			'name' => __( 'Description', 'odfw' ),
			'id' => $prefix . 'wysiwyg',
			'type' => 'text',
		));
		*
		*/

		$ecoregion_cmb->add_field( array(
			'name' => __( 'Acronym', 'odfw' ),
			'desc' => __( 'e.g: BM, CP, CR, EC... Used for look ups.', 'odfw' ),
			'id' => $prefix . 'acronym',
			'type' => 'textarea_small',
		));

		$ecoregion_cmb->add_field( array(
			'name' => __( 'Compass Link', 'odfw' ),
			'id' => $prefix . 'compass-link',
			'type' => 'textarea_small',
			'desc' => get_compass_instructions()

		));

		$ecoregion_cmb->add_field( array(
			'name' => __( 'At a glance   Characteristics and Statistics', 'odfw' ),
			'id' => $prefix . 'characteristics-title',
			'type' => 'title'
		));

		$ecoregion_cmb->add_field( array(
			'name' => __( 'Important industries', 'odfw' ),
			'id' => $prefix . 'important-industries',
			'type' => 'textarea_small',
		));

		$ecoregion_cmb->add_field( array(
			'name' => __( 'Major crops', 'odfw' ),
			'id' => $prefix . 'major-crops',
			'type' => 'textarea_small',
		));

		$ecoregion_cmb->add_field( array(
			'name' => __( 'Important nature-based recreational areas', 'odfw' ),
			'id' => $prefix . 'recreational-areas',
			'type' => 'textarea_small'
		));

		$ecoregion_cmb->add_field( array(
			'name' => __( 'Elevation', 'odfw' ),
			'id' => $prefix . 'elevation',
			'type' => 'text'
		));

		$ecoregion_cmb->add_field( array(
			'name' => __( 'Number of vertebrate wildlife species', 'odfw' ),
			'id' => $prefix . 'number-of-species',
			'type' => 'text'
		));

		$ecoregion_cmb->add_field( array(
			'name' => __( 'Important rivers', 'odfw' ),
			'id' => $prefix . 'rivers',
			'type' => 'textarea_small'
		));

		$ecoregion_cmb->add_field( array(
			'name' => __( 'Ecologically outstanding areas', 'odfw' ),
			'id' => $prefix . 'outstanding',
			'type' => 'textarea_small'
		));

		$ecoregion_cmb->add_field( array(
			'name' => __( 'Conservation Issues and Priorities', 'odfw' ),
			'id' => $prefix . 'ecoregions',
			'type' => 'title'
		));

		$ecoregion_cmb->add_field( array(
			'name' => __( 'Overview', 'odfw' ),
			'id' => $prefix . 'conservation-issues-overview',
			'type' => 'wysiwyg'
		));

		$ecoregion_cmb->add_field( array(
			'name' => __( 'Ecoregion-level limiting factors and recommended approaches', 'odfw' ),
			'id' => $prefix . 'limiting-factors',
			'type' => 'wysiwyg'
		));

		$factor_group_field_id = $ecoregion_cmb->add_field( array(
			'id'          => 'factors_repeat_group',
			'type'        => 'group',
			'description' => __( 'Factors and Approaches', 'odfw' ),
			'options'     => array(
				'group_title'   => __( 'Factor {#}', 'odfw' ),
				'add_button'    => __( 'Add Another Factor/Approach set', 'odfw' ),
				'remove_button' => __( 'Remove this factor', 'odfw' ),
				'sortable'      => true, // beta
				)
		) );


		   $ecoregion_cmb->add_group_field( $factor_group_field_id, array(
				'name' => __( 'Factor Title', 'odfw' ),
				'id' => $prefix . 'factor_title',
				'type' => 'text'
			) );

		   $ecoregion_cmb->add_group_field( $factor_group_field_id, array(
				'name' => __( 'Factor Description', 'odfw' ),
				'id' => $prefix . 'factor_description',
				'type' => 'textarea'
			) );

		   $ecoregion_cmb->add_group_field( $factor_group_field_id, array(
				'name' => __( 'Approach', 'odfw' ),
				'id' => $prefix . 'approach',
				'desc' => 'The word "approach" will be output automatically',
				'type' => 'textarea'
			) );

	}



	add_action( 'cmb2_init', 'strategy_habitat_metabox' );
	function strategy_habitat_metabox() {

		$prefix = '_strategy_habitat_meta_';

		$strategy_habitat_cmb = new_cmb2_box( array(
			'id'           => $prefix . 'strategy_habitat',
			'title'        => __( 'Strategy Habitat', 'odfw' ),
			'object_types' => array( 'strategy_habitat' ),
			'context'      => 'normal',
			'priority'     => 'high',
		) );

		$strategy_habitat_cmb->add_field( array(
			'name' => __( 'Compass Link', 'odfw' ),
			'id' => $prefix . 'compass-link',
			'type' => 'textarea_small',
			'desc' => get_compass_instructions()
		));

		$strategy_habitat_cmb->add_field( array(
			'name' => __( 'Ecoregions', 'odfw' ),
			'id' => $prefix . 'ecoregions',
			'type' => 'textarea',
		) );

		$strategy_habitat_cmb->add_field( array(
			'name' => __( 'Characteristics', 'odfw' ),
			'id' => $prefix . 'characteristics',
			'type' => 'wysiwyg',
		) );


		$ecoregional_characteristics_group_field_id = $strategy_habitat_cmb->add_field( array(
			'id'          => 'ecoregional_characteristics_repeat_group',
			'type'        => 'group',
			'desc' => __( 'Ecoregional Characteristics (if applicable)', 'odfw' ),
			'options'     => array(
				'group_title'   => __( 'Ecoregional Characteristic #{#}', 'odfw' ),
				'add_button'    => __( 'Add Another Ecoregion', 'odfw' ),
				'remove_button' => __( 'Remove this Ecoregion', 'odfw' ),
				'sortable'      => true, // beta
				)
		) );

		   $strategy_habitat_cmb->add_group_field( $ecoregional_characteristics_group_field_id, array(
				'name' => __( 'Select an Ecoregion', 'odfw' ),
				'id'          => $prefix . 'related_ecoregion',
				'type'        => 'select',
				'show_option_none' => false,
				//'options' => odfw_get_ecoregions
				'options' => cmb2_get_post_options( array( 'post_type' => 'ecoregion', 'numberposts' => 15 ) )
			) );


		   $strategy_habitat_cmb->add_group_field( $ecoregional_characteristics_group_field_id, array(
				'name' => __( 'Selected Ecoregion Chracteristics', 'odfw' ),
				'id' => $prefix . 'selected_ecoregional_characteristics',
				'type' => 'textarea'
			) );

		$strategy_habitat_cmb->add_field( array(
			'name' => __( 'Conservation Overview', 'odfw' ),
			'id' => $prefix . 'conservation_overview',
			'type' => 'wysiwyg',
		) );

		$strategy_habitat_cmb->add_field( array(
			'name' => __( 'Limiting Factors', 'odfw' ),
			'id' => $prefix . 'limiting_factors',
			'type' => 'title',
		) );

		$factor_group_field_id = $strategy_habitat_cmb->add_field( array(
			'id'          => 'factors_repeat_group',
			'type'        => 'group',
			'description' => __( 'Factors and Approaches', 'odfw' ),
			'options'     => array(
				'group_title'   => __( 'Factor {#}', 'odfw' ),
				'add_button'    => __( 'Add Another Factor/Approach set', 'odfw' ),
				'remove_button' => __( 'Remove this factor', 'odfw' ),
				'sortable'      => true, // beta
				)
		) );


		   $strategy_habitat_cmb->add_group_field( $factor_group_field_id, array(
				'name' => __( 'Factor Title', 'odfw' ),
				'id' => $prefix . 'factor_title',
				'type' => 'text'
			) );

		   $strategy_habitat_cmb->add_group_field( $factor_group_field_id, array(
				'name' => __( 'Factor Description', 'odfw' ),
				'id' => $prefix . 'factor_description',
				'type' => 'textarea'
			) );

		   $strategy_habitat_cmb->add_group_field( $factor_group_field_id, array(
				'name' => __( 'Approach', 'odfw' ),
				'id' => $prefix . 'approach',
				'desc' => 'The word "approach" will be output automatically',
				'type' => 'textarea'
			) );

		$strategy_habitat_cmb->add_field( array(
			'name' => __( 'Resources for more information', 'odfw' ),
			'id' => $prefix . 'resources',
			'type' => 'wysiwyg',
		) );

	}







	add_action( 'cmb2_init', 'setupSpeciesPageCustomFields' );
	function setupSpeciesPageCustomFields () {
		$prefix = 'sp_pages_meta_';

		//$species_sub_pages = array(110,111,112, 113, 114, 115, 116);

		$page_cmb = new_cmb2_box( array(
			'id'           => $prefix . 'taxo-wrap',
			'title'        => __( 'Species Taxonomy Select', 'odfw' ),
			'object_types' => array( 'page' ),
			'show_on'      => array( 'key' => 'id', 'value' => array(110,111,112, 113, 114, 115, 116) ),
			'context'      => 'side',
			'priority'     => 'low'
		) );

		$page_cmb->add_field( array(
			'desc'     => 'Select the species taxonomy term this page is associated with',
			'id'       => $prefix . 'taxonomy',
			//'taxonomy' => 'species', //Enter Taxonomy Slug
			'type'    => 'select',
			'options' => cmb2_get_term_options( 'species' ),
		) );

	}




}

add_action( 'init', 'setupCustomFields', 0 );

