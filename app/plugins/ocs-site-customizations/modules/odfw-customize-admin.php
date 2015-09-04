<?php
/**
 * Some Tweaks for the admin UI
 *
 */

// Load CSS tweaks for the Admin
function odfw_load_global_admin_tweaks() {
	//wp_enqueue_style('odfw_admin_custom_style', plugins_url('assets/odfw_global_admin_custom_style.css', __FILE__));
	wp_enqueue_style('odfw_admin_custom_style', ODFW_CUSTOMIZATIONS_PLUGIN_URL + 'assets/odfw_global_admin_custom_style.css');
}
add_action('admin_enqueue_scripts', 'odfw_load_global_admin_tweaks');
add_action('login_enqueue_scripts', 'odfw_load_global_admin_tweaks');

/*
// Can use $hook limit which pages a script or style sheet is loaded
function ecotrust_load_scripts($hook) {
	echo "<h1 style='float: right; text-align: right'>Hook is <i style='color:red'>$hook</i></h1>";
	// for now, we only want it on post pages
	if( $hook != 'post-new.php'
		&& $hook != 'post.php'
		&& $hook != 'nav-menus.php'
		&& $hook != 'settings_page_searchwp'
	) return;

	//wp_enqueue_style( 'odfw_admin_custom_style', asset_path('css/odfw_admin_custom_style.css')	);
	//wp_enqueue_script( 'odfw_admin_affix_js', asset_path('js/plugins/bootstrap/affix.js' );
	//wp_enqueue_script( 'odfw_admin_custom_js', asset_path('js/odfw_admin_custom_js.js' );
}
*/


function rearrange_wp_admin_menu () {
/*
	Reference:
	2 Dashboard
	4 Separator
	5 Posts
	10 Media
	15 Links
	20 Pages
	25 Comments
	59 Separator
	60 Appearance
	65 Plugins
	70 Users
	75 Tools
	80 Settings
	99 Separator
 */

	global $menu;
	//TODO remains a mess in the admin sidebar
	//$menu[24] = $menu[5]; // Move Posts down by comments; site doesn't use either.
	//$menu[3] = $menu[20]; // Move Pages to the top
	//unset($menu[4]); // Get rid of the separator
	//unset($menu[5]); // Free the position 5 so we can use it
}
add_action('admin_menu', 'rearrange_wp_admin_menu');


/**
 * Add Excerpt to Pages in the Admin
 *
 * Not entirely an admin tweak as we need it in both the
 * admin and the front end. This hooks on init instead of admin_init.
 *
 * Currently added for use on the species parent template
 * to pull in summaries of each species taxonomy (sub page)
 *
 */
function OCS_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'OCS_add_excerpts_to_pages' );
