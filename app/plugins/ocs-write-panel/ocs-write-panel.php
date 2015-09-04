<?php
/*
Plugin Name: Oregon Conservation Strategy Write Panel
Plugin URL: http://ecotrust.org
Description: Collecting all of the write/edit options on to a single page
Version: 0.2
Author: Will Moore, Ecotrust
Author URI: http://ecotrust.org
Contributors: wmoore, corsonr
Text Domain: ecotrust
*/


defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );


/*
|--------------------------------------------------------------------------
| CONSTANTS
|--------------------------------------------------------------------------
*/

// plugin folder url
if(!defined('odfw_WP_PLUGIN_URL')) {
	define('odfw_WP_PLUGIN_URL', plugin_dir_url( __FILE__ ));
}

/*
|--------------------------------------------------------------------------
| MAIN CLASS
|--------------------------------------------------------------------------
*/



class OCA_write_panel {

	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/

	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 */
	function __construct() {

		add_action('admin_menu', array( &$this,'ODFW_write_panel_register_menu') );
		//add_action('load-index.php', array( &$this,'rc_scd_redirect_dashboard') );

	} // end constructor

	function rc_scd_redirect_dashboard() {

		if( is_admin() ) {
			$screen = get_current_screen();

			if( $screen->base == 'dashboard' ) {

				wp_redirect( admin_url( 'index.php?page=custom-dashboard' ) );

			}
		}

	}

	function ODFW_write_panel_register_menu() {
		//add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
		add_menu_page( 'Write Panel', 'Create/Edit', 'edit_posts', 'write-panel', array( &$this,'ODFW_wp_include_page'), '', 3 );

		$args = array(
			'public'   => true
		);
		$of_post_types = get_post_types( $args, 'objects' );
		foreach($of_post_types as $type) :
			$name = $type->name;
			$functionName = "add_".$name;

			$addNew = $type->labels->add_new_item;

			//Skip Media
			if ( $type->name == "attachment" ) continue;
		endforeach;


	}

	function ODFW_wp_include_page() {
		include_once( 'ocs-write-panel-content.php'  );
	}


}

// instantiate plugin's class
$GLOBALS['OCA_write_panel'] = new OCA_write_panel();

