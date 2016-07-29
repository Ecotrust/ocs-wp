<?php
  $path = WP_PLUGIN_URL . '/' . 'export-csv';
  define('E2E_PLUGIN_PATH', $path);
  define('E2E_STATIC_PATH', E2E_PLUGIN_PATH . '/static/');
  define('E2E_JS_PATH', E2E_STATIC_PATH . 'js/');
  define('E2E_CSS_PATH', E2E_STATIC_PATH . 'css/');
  define('E2E_IMAGES_PATH', E2E_STATIC_PATH . 'images/');
  define('E2E_AJAX_SEPARATOR', '~#$');
  define('E2E_DEFAULT_POSTS_PER_PAGE', 150);
  define('E2E_DEFAULT_NUM_POSTS', 20);
?>