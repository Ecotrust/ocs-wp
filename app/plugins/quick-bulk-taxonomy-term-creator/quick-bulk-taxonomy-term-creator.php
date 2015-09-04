<?php
/**
 * Plugin Name: Quick Bulk Taxonomy Term Creator
 * Plugin URI: https://wordpress.org/plugins/quick-bulk-taxonomy-term-creator/
 * Description: A handy tool for batch creation of taxonomy terms in your preferred hierarchy. 
 * Version: 1.0.2
 * Author: tyxla
 * Author URI: https://github.com/tyxla
 * License: GPL2
 * Requires at least: 3.0.1
 * Tested up to: 4.3
 */

/**
 * Main plugin class.
 */
class QBTTC {

	/**
	 * Path to the plugin.
	 *
	 * @access protected
	 *
	 * @var string
	 */
	protected $plugin_path;

	/**
	 * Form object.
	 *
	 * @access protected
	 *
	 * @var QBTTC_Form
	 */
	protected $form;

	/**
	 * Constructor.
	 *	
	 * Hooks all of the plugin functionality.
	 *
	 * @access public
	 */
	public function __construct() {

		// set the path to the plugin main directory
		$this->set_plugin_path(dirname(__FILE__));

		// include all plugin files
		$this->include_files();

		// initialize the admin form
		$this->set_form( new QBTTC_Form() );

	}

	/**
	 * Load the plugin classes and libraries.
	 *
	 * @access protected
	 */
	protected function include_files() {
		require_once($this->get_plugin_path() . '/includes/hierarchy.php');
		require_once($this->get_plugin_path() . '/includes/taxonomies.php');
		require_once($this->get_plugin_path() . '/includes/field.php');
		require_once($this->get_plugin_path() . '/includes/field-text.php');
		require_once($this->get_plugin_path() . '/includes/field-textarea.php');
		require_once($this->get_plugin_path() . '/includes/field-select.php');
		require_once($this->get_plugin_path() . '/includes/form.php');
	}

	/**
	 * Retrieve the path to the main plugin directory.
	 *
	 * @access public
	 *
	 * @return string $plugin_path The path to the main plugin directory.
	 */
	public function get_plugin_path() {
		return $this->plugin_path;
	}

	/**
	 * Modify the path to the main plugin directory.
	 *
	 * @access protected
	 *
	 * @param string $plugin_path The new path to the main plugin directory.
	 */
	protected function set_plugin_path($plugin_path) {
		$this->plugin_path = $plugin_path;
	}

	/**
	 * Retrieve the form object.
	 *
	 * @access public
	 *
	 * @return string $form The form object.
	 */
	public function get_form() {
		return $this->form;
	}

	/**
	 * Modify the form object.
	 *
	 * @access protected
	 *
	 * @param string $form The new form object.
	 */
	protected function set_form($form) {
		$this->form = $form;
	}

}

// initialize the plugin
global $qbttc;
$qbttc = new QBTTC();