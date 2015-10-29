<?php

/*
 * Define OCS Custom Taxonomies
 * Note: Species are also a custom post type
 *
 */



	function species_taxonomy() {

		$labels = array(
			'name'                       => _x( 'Species', 'Taxonomy General Name', 'odfw' ),
			'singular_name'              => _x( 'Species', 'Taxonomy Singular Name', 'odfw' ),
			'menu_name'                  => __( 'Species', 'odfw' ),
			'all_items'                  => __( 'All Species', 'odfw' ),
			'parent_item'                => __( 'Parent Species', 'odfw' ),
			'parent_item_colon'          => __( 'Parent Species:', 'odfw' ),
			'new_item_name'              => __( 'New Species', 'odfw' ),
			'add_new_item'               => __( 'Add New Species', 'odfw' ),
			'edit_item'                  => __( 'Edit Species', 'odfw' ),
			'update_item'                => __( 'Update Species', 'odfw' ),
			'view_item'                  => __( 'View Species', 'odfw' ),
			'separate_items_with_commas' => __( 'Separate species with commas', 'odfw' ),
			'add_or_remove_items'        => __( 'Add or remove Species', 'odfw' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'odfw' ),
			'popular_items'              => __( 'Popular Species', 'odfw' ),
			'search_items'               => __( 'Search Species', 'odfw' ),
			'not_found'                  => __( 'Not Found', 'odfw' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		register_taxonomy( 'species', array( 'post', 'species', 'ecoregion', 'coa', 'strategy-habitat', 'coa' ), $args );

	}
	
	function category_taxonomy() {

		$labels = array(
			'name'                       => _x( 'category', 'Taxonomy General Name', 'odfw' ),
			'singular_name'              => _x( 'category', 'Taxonomy Singular Name', 'odfw' ),
			'menu_name'                  => __( 'Categories', 'odfw' ),
			'all_items'                  => __( 'All Categories', 'odfw' ),
			'parent_item'                => __( 'Parent Categories', 'odfw' ),
			'parent_item_colon'          => __( 'Parent Categories:', 'odfw' ),
			'new_item_name'              => __( 'New Category', 'odfw' ),
			'add_new_item'               => __( 'Add New Category', 'odfw' ),
			'edit_item'                  => __( 'Edit Category', 'odfw' ),
			'update_item'                => __( 'Update Category', 'odfw' ),
			'view_item'                  => __( 'View Category', 'odfw' ),
			'separate_items_with_commas' => __( 'Separate categories with commas', 'odfw' ),
			'add_or_remove_items'        => __( 'Add or remove Categories', 'odfw' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'odfw' ),
			'popular_items'              => __( 'Popular Categories', 'odfw' ),
			'search_items'               => __( 'Search Categories', 'odfw' ),
			'not_found'                  => __( 'Not Found', 'odfw' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		register_taxonomy( 'category', array( 'post', 'category', 'ecoregion', 'coa', 'strategy-habitat', 'coa' ), $args );

	}
	
	add_action( 'init', 'species_taxonomy', 0 );
	add_action( 'init', 'category_taxonomy', 0 );
