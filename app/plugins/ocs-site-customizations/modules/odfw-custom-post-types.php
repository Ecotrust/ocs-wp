<?php

/**
 * Define OCS Custom Post Types
 *
 */



// Include the custom post type class
// https://github.com/jjgrainger/wp-custom-post-type-class
include_once(ODFW_CUSTOMIZATIONS_PLUGIN_URL . '/lib/wp-custom-post-type-class.php');

function setupCustomPostTypes () {

	$global_cpt_args = array(
		'has_archive'    => true,
		'menu_position'  => 3,
		'public'         => true,
		'show_in_nav_menus'   => true,
		'taxonomies'     => array( 'species' ), // 'category', 'post_tag',
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
		//'supports'       => array( 'title', 'author', 'revisions' )
	)));
	$coa->menu_icon('dashicons-editor-ul');

	$strategy_habitat = new CPT(array(
		'post_type_name' => 'strategy_habitat',
		'singular'       => 'Strategy Habitat',
		'plural'         => 'Strategy Habitats',
		'slug'           => 'strategy-habitat'
	), array_merge($global_cpt_args, array(
		'menu_position'  => 7,
		//'supports'       => array( 'title', 'author', 'revisions' )
	)));
	$strategy_habitat->menu_icon('dashicons-format-image');


	$strategy_species = new CPT(array(
		'post_type_name' => 'strategy_species',
		'singular'       => 'Strategy Species',
		'plural'         => 'Strategy Species',
		'slug'           => 'strategy-species'
	), array_merge($global_cpt_args, array(
		'menu_position'  => 8,
		//'supports'       => array( 'title', 'author', 'revisions' )
	)));
	$strategy_species->menu_icon('dashicons-id');


}


add_action( 'init', 'setupCustomPostTypes', 0 );
