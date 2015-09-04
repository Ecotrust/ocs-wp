<?php
/*
Plugin Name: Really Simple CSV Importer Debugger add-on
Description: Enables to dry-run-testing with Really Simple CSV Importer. When this add-on plugin activated, csv data will not imported, just displayed on dashboard.
Author: Takuro Hishikawa
Version: 0.2
@link https://gist.github.com/hissy/7175656
*/

class rscsvimporter_debug {
	// singleton instance
	private static $instance;

	public static function instance() {
		if ( isset( self::$instance ) )
			return self::$instance;

		self::$instance = new rscsvimporter_debug;
		self::$instance->run_init();
		return self::$instance;
	}

	private function __construct() {
		/** Do nothing **/
	}

	protected function run_init() {
		add_action( 'init', array( $this, 'add_filter' ) );
	}

	public function add_filter() {
		add_filter( 'really_simple_csv_importer_dry_run', '__return_true' ); // dry-run
		add_filter( 'really_simple_csv_importer_save_post', array( $this, 'debug_save_post'), 50, 2 );
		add_filter( 'really_simple_csv_importer_save_meta', array( $this, 'debug_save_meta'), 50, 3 );
		add_filter( 'really_simple_csv_importer_save_tax', array( $this, 'debug_save_tax'), 50, 3 );
	}

	public function debug_save_post($post, $is_update) {
		$this->var_dump($is_update,'$is_update');
		$this->var_dump($post,'$post');
		return $post;
	}

	public function debug_save_meta($meta, $post, $is_update) {
		$this->var_dump($meta,'$meta');
		return $meta;
	}

	public function debug_save_tax($tax, $post, $is_update) {
		$this->var_dump($tax,'$tax');
		return $tax;
	}

	private function var_dump($var, $label) {
		if (isset($label) && !empty($label))
			echo $label . ':';

		echo '<pre>';
		var_dump($var);
		echo '</pre>';
	}

}

$rscsvimporter_debug = rscsvimporter_debug::instance();
