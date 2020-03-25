<?php
/**
 * Some Tweaks for the admin UI
 *
 */

// Load CSS tweaks for the Admin
function odfw_load_global_admin_tweaks($hook) {
	wp_enqueue_style('odfw_admin_custom_style', plugins_url('../assets/odfw_global_admin_custom_style.css', __FILE__));
	wp_enqueue_script( 'odfw_admin_affix',  plugins_url('../assets/bs.affix.3.3.5.min.js', __FILE__) );
	wp_enqueue_script( 'odfw_admin_custom_scripts',  plugins_url('../assets/odfw_global_admin_custom_scripts.js', __FILE__) );
}
add_action('admin_enqueue_scripts', 'odfw_load_global_admin_tweaks', 20);
add_action('login_enqueue_scripts', 'odfw_load_global_admin_tweaks', 20);

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

/*
// Register Modified Date Column for both posts & pages
function modified_column_register( $columns ) {
	$columns['Modified'] = __( 'Modified Date', 'modified' );

	return $columns;
}
add_filter( 'manage_posts_columns', 'modified_column_register' );
add_filter( 'manage_pages_columns', 'modified_column_register' );

// Display the modified date of each post
function modified_column_display( $column_name, $post_id ) {
	global $post;
	$modified = the_modified_date();
	echo $modified;
}
add_action( 'manage_posts_custom_column', 'modified_column_display', 10, 2 );
add_action( 'manage_pages_custom_column', 'modified_column_display', 10, 2 );

// Register the column as sortable
function modified_column_register_sortable( $columns ) {
	$columns['Modified'] = 'modified';
	return $columns;
}
add_filter( 'manage_edit-post_sortable_columns', 'modified_column_register_sortable' );
add_filter( 'manage_edit-page_sortable_columns', 'modified_column_register_sortable' );

// Support for Custom Post Types
add_action('wp', 'add_sortable_views_for_custom_post_types');

function add_sortable_views_for_custom_post_types(){
	$args=array(
	  'public'   => true,
	  '_builtin' => false
	);
	$post_types=get_post_types($args);
	foreach ($post_types  as $post_type ) {
		add_filter( 'manage_edit-'.$post_type.'_sortable_columns', 'modified_column_register_sortable' );
	}
}
 */

// //wrap images from media gallery in divs
function wrap_images_in_div($content) {
   $pattern = '/(<img[^>]*class=\"([^>]*?)\"[^>]*>)/i';
   $replacement = '<div class="image-container">$1</div>';
   $content = preg_replace($pattern, $replacement, $content);
   return $content;
}
add_filter('the_content', 'wrap_images_in_div', 30);

// Adjust the way images are imported into the Admin area

function filter_image_send_to_editor($html, $id, $caption, $title, $align, $url, $size, $alt) {
	$meta = get_post_meta($id);
	if ( !empty( $meta["odfw_attribution_name"] ) || !empty( $caption)) {
		$html .= "<span class='photo-attribution'><span class='attr-name'>";
		if (!empty($meta["odfw_attribution_name"])) {
			$html .= "Photo Credit: " . $meta["odfw_attribution_name"][0] . ".</span>";
		} else {
			$html .= "</span>";
		}

	}
	return $html;
}
add_filter('image_send_to_editor', 'filter_image_send_to_editor', 10, 8);


//relative urls for inserted images
function image_to_relative($html, $id, $caption, $title, $align, $url, $size, $alt) {
	$sp = strpos($html,"src=") + 5;
	$ep = strpos($html,"\"",$sp);

	$imageurl = substr($html,$sp,$ep-$sp);

	$relativeurl = str_replace("http://","",$imageurl);
	$sp = strpos($relativeurl,"/");
	$relativeurl = substr($relativeurl,$sp);

	$html = str_replace($imageurl,$relativeurl,$html);

	return $html;
}
add_filter('image_send_to_editor', 'image_to_relative', 5, 8);

// Convert absolute URLs in content to site relative ones
// Inspired by http://thisismyurl.com/6166/replace-wordpress-static-urls-dynamic-urls/
function sp_clean_static_url($content) {
   $thisURL = get_bloginfo('url');
   $stuff = str_replace(' src=\"'.$thisURL, ' src=\"', $content );
   $stuff = str_replace(' href=\"'.$thisURL, ' href=\"', $stuff );
	return $stuff;
}
//add_filter('content_save_pre','sp_clean_static_url','99');
