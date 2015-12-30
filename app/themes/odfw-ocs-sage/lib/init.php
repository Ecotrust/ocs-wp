<?php

namespace Roots\Sage\Init;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
  load_theme_textdomain('sage', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'odfw')
  ]);

  // Add post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');

  add_image_size( 'hero', 1600, 580, true );
  add_image_size( 'grid', 230, 117, true );
  add_image_size( 'listing', 116, 63, true );

  //if(get_option('medium_size_w')!=640) update_option('medium_size_w',640);
  //if(get_option('medium_size_h')!=320) update_option('medium_size_h',320);
  if(get_option('large_size_w') !=750) update_option('large_size_w',750);
  if(get_option('large_size_h') !=9999) update_option('large_size_h',9999);

  // Defaults for inserting images
  update_option('image_default_align', 'none' );
  update_option('image_default_link_type', 'none' );
  update_option('image_default_size', 'large' );

  update_option('upload_path', $_SERVER['DOCUMENT_ROOT'] . '/media');
  update_option('upload_url_path', 'http://' . $_SERVER['SERVER_NAME'] . '/media');

  add_filter('jpeg_quality', function($arg){return 75;});


  // Add post formats
  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', ['gallery']);

  // Add HTML5 markup for captions
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption']);

  // Tell the TinyMCE editor to use a custom stylesheet
  add_editor_style(Assets\asset_path('styles/editor-style.css'));

  /* Doesn't need to be set over and over again so commented for now
  	// We need the medium and large image sizes to be cropped.
	if(false === get_option("medium_crop")):
		add_option("medium_crop", "1");
	else:
		update_option("medium_crop", "1");
	endif;
 */
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Register sidebars
 */
function widgets_init() {
  register_sidebar([
    'name'          => __('Header', 'odfw'),
    'id'            => 'header-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Footer', 'odfw'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');
