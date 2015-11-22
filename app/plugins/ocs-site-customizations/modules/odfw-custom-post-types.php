<?php

/**
 * Define OCS Custom Post Types
 *
 */



// Include the custom post type class
// https://github.com/jjgrainger/wp-custom-post-type-class
include_once(ODFW_CUSTOMIZATIONS_PLUGIN_URL . '/lib/wp-custom-post-type-class.php');
/*
 *
 *
 *
 *
 * NOTE The above CPT class checks to see if the CPT already exists. If it does, it doesn't register the CPT again.
 * This means you can't update options here and have them take.
 * For them to take, you'll need to go and comment out the check for existing CPTs (L# ~430)
 *
 *
 *
 *
 */



function setupCustomPostTypes () {

	$global_cpt_args = array(
		'has_archive'    => true,
		'menu_position'  => 3,
		'public'         => true,
		'show_in_nav_menus'   => true,
		//'taxonomies'     => array( 'species' ), // 'category', 'post_tag',
		'supports'       => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions' ), //, 'custom-fields'
	);

	$ecoregion = new CPT(array(
		'post_type_name' => 'ecoregion',
		'singular'       => 'Ecoregion',
		'plural'         => 'Ecoregions',
		'slug'           => 'ecoregion'
	), array_merge($global_cpt_args, array(
		'menu_position'  => 4,
		//'supports'       => array( 'title', 'author', 'revisions' )
	)));
	$ecoregion->menu_icon('dashicons-admin-site');

	$kci  = new CPT(array(
		'post_type_name' => 'kci',
		'singular'       => 'KCI',
		'plural'         => 'KCIs',
		'slug'           => 'key-conservation-issue'
	), array_merge($global_cpt_args, array(
		'menu_position'  => 6,
		//'supports'       => array( 'title', 'author', 'revisions' )
	)));
	$kci->menu_icon('dashicons-admin-network');
	//$kci->add_admin_columns(array('post_id'=>'post_id'));

	$coa = new CPT(array(
		'post_type_name' => 'coa',
		'singular'       => 'COA',
		'plural'         => 'COAs',
		'slug'           => 'conservation-opportunity-area'
	), array_merge($global_cpt_args, array(
		'menu_position'  => 9,
	)));
	$coa->menu_icon('dashicons-editor-ul');

	$strategy_habitat = new CPT(array(
		'post_type_name' => 'strategy_habitat',
		'singular'       => 'Strategy Habitat',
		'plural'         => 'Strategy Habitats',
		'slug'           => 'strategy-habitat'
	), array_merge($global_cpt_args, array(
		'menu_position'  => 7,
	)));
	$strategy_habitat->menu_icon('dashicons-format-image');

	$ss_options = array_merge($global_cpt_args, array(
		'menu_position'  => 8,
		'hierarchical'   => true,
		'taxonomies'     => array( 'species' ),
		'supports'       => array( 'title', 'editor', 'author', 'thumbnail', 'page-attributes'),
	));
	$strategy_species = new CPT(array(
		'post_type_name' => 'strategy_species',
		'singular'       => 'Strategy Species',
		'plural'         => 'Strategy Species',
		'slug'           => 'strategy-species',
	), $ss_options);
	$strategy_species->menu_icon('dashicons-id');

	$success_story = new CPT(array(
		'post_type_name' => 'success_story',
		'singular'       => 'Success Story',
		'plural'         => 'Success Stories',
		'slug'           => 'success-story'
	), array_merge($global_cpt_args, array(
		'menu_position'  => 9,
	)));
	$success_story->menu_icon('dashicons-format-chat');

}


add_action( 'init', 'setupCustomPostTypes', 0 );
