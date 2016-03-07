<?php
/**
 * CMB2 Theme Options
 * @version 0.1.1
 */


/**
 *
 * NOTE on Tabs:
 *
 * Each cmb2 "title" field will be converted into tab title.
 * Use the 'before_row' field on each title to add the required HTML.
 *
 *		First tab needs to open it:
 *
 *			'before_row' => '<div id="tab-1">'
 *
 *		Subsequent titles need to close the previous and open the next, incrementing the tab ID:
 *
 * 			'before_row' => '</div><div id="tab-2">'
 *
 *		Final field in the set (not a title field) needs to use the after_row property to close it all up.
 *
 *			'after_row' => '</div>', //close final tab
 *
 *		Javascript will take care of the rest
 *
 *
 * If you need a real "title" field for some other reason, use one of the 'before' properties on an existing field.
 *
 */

class ocs_Admin {

	/**
 	 * Option key, and option page slug
 	 * @var string
 	 */
	private $key = 'ocs_options';

	/**
 	 * Options page metabox id
 	 * @var string
 	 */
	private $metabox_id = 'ocs_option_metabox';

	/**
	 * Options Page title
	 * @var string
	 */
	protected $title = 'OCS Settings ZOMG';

	/**
	 * Options Page hook
	 * @var string
	 */
	protected $options_page = '';

	/**
	 * Constructor
	 * @since 0.1.0
	 */
	public function __construct() {
		// Set our title
		$this->title = __( 'OCS Settings', 'ocs' );
	}

	/**
	 * Initiate our hooks
	 * @since 0.1.0
	 */
	public function hooks() {
		add_action( 'admin_init', array( $this, 'init' ) );
		add_action( 'admin_menu', array( $this, 'add_options_page' ) );
		add_action( 'cmb2_admin_init', array( $this, 'add_options_page_metabox' ) );
		add_action( 'cmb2_after_form', array( $this, 'admin_options_page_javascript' ), 10, 4 );
		add_action( 'cmb2_after_form', array( $this, 'admin_options_page_css' ), 10, 4 );

	}


	/**
	 * Register our setting to WP
	 * @since  0.1.0
	 */
	public function init() {
		register_setting( $this->key, $this->key );
	}

	/**
	 * Add menu options page
	 * @since 0.1.0
	 */
	public function add_options_page() {
		$this->options_page = add_menu_page( $this->title, $this->title, 'manage_options', $this->key, array( $this, 'admin_page_display' ) );

		// Include CMB CSS in the head to avoid FOUC
		add_action( "admin_print_styles-{$this->options_page}", array( 'CMB2_hookup', 'enqueue_cmb_css' ) );
	}

	/**
	 * Admin page markup. Mostly handled by CMB2
	 * @since  0.1.0
	 */
	public function admin_page_display() {
		?>
		<div class="wrap cmb2-options-page <?php echo $this->key; ?>">
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
			<?php cmb2_metabox_form( $this->metabox_id, $this->key ); ?>
		</div>
		<?php
	}

	/**
	 * Admin page Javascript
	 * Added WM 12/2015
	 */

	public function admin_options_page_css () {
	/**
	 * Admin page CSS
	 * Added WM 12/2015
	 */
	?>
		<style>
		.nav-tab { //taken from wysiwyg tabs
		    background: #ebebeb none repeat scroll 0 0;
			border: 1px solid #e5e5e5;
			box-sizing: content-box;
			color: #777777;
			cursor: pointer;
			float: left;
			font: 13px/19px "Open Sans",sans-serif;
			height: 20px;
			margin: 5px 0 0 5px;
			padding: 3px 8px 4px;
			position: relative;
			top: 1px;
		}
		.ui-tabs-active .nav-tab {
			background-color: #333;
			color: #fff;

		}

		</style>
	<?php
	}

	public function admin_options_page_javascript () {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script('jquery-ui-tabs');

	?>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				'use strict';


				function setUpOptionsTabs () {

					var $container = $('#cmb2-metabox-ocs_option_metabox');

					$container.prepend('<ul id="tab-nav"></ul>');
					//$container.prepend('<h2 id="tab-nav" class="nav-tab-wrapper current"></h2>');

					// create the tabs from title fields
					$('.cmb2-metabox-title').each(function(i, item){
						var ret = '<li><a class="nav-tab" href="#tab-'+(i+1)+'">'+ $(this).text() +'</a></li>';
						//var ret = '<a class="nav-tab" href="#tab-'+(i+1)+'">'+ $(this).text() +'</a>';
						$('#tab-nav').append(ret);
					});

					$container.tabs();

				}

				setUpOptionsTabs();

			});
		</script>
	<?php
	}

	/**
	 * Add the options metabox to the array of metaboxes
	 * @since  0.1.0
	 */
	function add_options_page_metabox() {

		// hook in our save notices
		add_action( "cmb2_save_options-page_fields_{$this->metabox_id}", array( $this, 'settings_notices' ), 10, 2 );

		$cmb = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );

		// JS loop through the title fields to create the tabs ul
		// each title field gets
		//		before: start tab container
		//		if > 1: before: close previous tab container
		//				or put it on the last one before the title
		//

		//
		// General Stuff
		//

		$cmb->add_field( array(
			'name' => __( 'General OCS Settings', 'ocs' ),
			'id'   => 'general-ocs-settings',
			'type' => 'title',
			'before_row' => '<div id="tab-1">'
		) );

		$cmb->add_field( array(
			'name'    => __( 'Where should the Oregon/Help icon link to?', 'ocs' ),
			'id'      => 'ocs-help-icon-url',
			'desc' => __('Use the spyglass icon to select destination url.', 'odfw'),
			'type' => 'post_search_text',
			'post_type'   => 'page',
			'select_type' => 'radio',
			'select_behavior' => 'replace',
			'find_text'     => 'Find Pages',
			'include_post_title'  => true,
		) );

		$cmb->add_field( array(
			'name' => __( 'ODFW/OCS Link Destination', 'odfw' ),
			'desc' => __('Where should the ODFW/OCS icon in the lower left link to?', 'odfw'),
			'id' => 'ocs-odfw-logo-url',
			'type' => 'text'
		) );

		$cmb->add_field( array(
			'name' => __( 'Compass URL', 'odfw' ),
			'desc' => __('This url will prefix all compass links in the OCS', 'odfw'),
			'id' => 'ocs-compass-url',
			'type' => 'text'
		) );

		//
		// SPECIES
		//
		$cmb->add_field( array(
			'name' => __( 'Strategy Species Hover Text', 'ocs' ),
			'id'   => 'strategy-species-title',
			'type' => 'title',
			//generic tabID because the id passed above is conflated on options pages
			//comes out as class along with generic cmb2 classes:
			//class="cmb-row cmb-type-title cmb2-id-[id-passed]"
			'before_row' => '</div><div id="tab-2">'
		) );

		$cmb->add_field( array(
			'name'    => __( 'Ecoregions Hover Text', 'ocs' ),
			'id'      => 'ss-ecoregions',
			'type'    => 'textarea_small',
		) );

		$cmb->add_field( array(
			'name'    => __( 'Special Needs Hover Text', 'ocs' ),
			'id'      => 'ss-special-needs',
			'type'    => 'textarea_small',
		) );

		$cmb->add_field( array(
			'name'    => __( 'Limiting Factors Hover Text', 'ocs' ),
			'id'      => 'ss-limiting-factors',
			'type'    => 'textarea_small',
		) );

		$cmb->add_field( array(
			'name'    => __( 'Data Gaps Hover Text', 'ocs' ),
			'id'      => 'ss-data-gaps',
			'type'    => 'textarea_small',
		) );

		$cmb->add_field( array(
			'name'    => __( 'Recommended Conservation Actions Hover Text', 'ocs' ),
			'id'      => 'ss-recommended-conservation-actions',
			'type'    => 'textarea_small',
		) );

		$cmb->add_field( array(
			'name'    => __( 'Key Reference or Plan Hover Text', 'ocs' ),
			'id'      => 'ss-key-reference',
			'type'    => 'textarea_small',
		) );



		//
		// COAs
		//


		$cmb->add_field( array(
			'name' => __( 'COAP Hover Text', 'ocs' ),
			'id'   => 'coa-hover-title',
			'type' => 'title',
			'before_row' => '</div><div id="tab-3">'
		) );

		$cmb->add_field( array(
			'name'    => __( 'COA ID Hover Text', 'ocs' ),
			'id'      => 'coa-id',
			'type'    => 'textarea_small',
		) );

		$cmb->add_field( array(
			'name'    => __( 'COA Ecoregions Hover Text', 'ocs' ),
			'id'      => 'coa-ecoregions',
			'type'    => 'textarea_small',
		) );

		$cmb->add_field( array(
			'name'    => __( 'COA Special Features: (Main Header) Hover Text', 'ocs' ),
			'id'      => 'coa-special-features-main-header-tooltip',
			'type'    => 'textarea_small',
		) );

		$cmb->add_field( array(
			'name'    => __( 'COA Special Features: (General) Hover Text', 'ocs' ),
			'id'      => 'coa-special-features-general-tooltip',
			'type'    => 'textarea_small',
		) );

		$cmb->add_field( array(
			'name'    => __( 'COA Special Features: (Previously Associated) Hover Text', 'ocs' ),
			'id'      => 'coa-special-features-2006',
			'type'    => 'textarea_small',
		) );

		$cmb->add_field( array(
			'name'    => __( 'COA Special Features: (Protected Areas) Hover Text', 'ocs' ),
			'id'      => 'coa-special-features-protected-areas',
			'type'    => 'textarea_small',
		) );

		$cmb->add_field( array(
			'name'    => __( 'COA Special Features: (KCI Connections) Hover Text', 'ocs' ),
			'id'      => 'coa-special-features-KCI-connections',
			'type'    => 'textarea_small',
		) );

		$cmb->add_field( array(
			'name'    => __( 'COA Strategy Species Hover Text', 'ocs' ),
			'id'      => 'coa-strategy-species',
			'type'    => 'textarea_small',
		) );

		$cmb->add_field( array(
			'name'    => __( 'COA Strategy Habitats Hover Text', 'ocs' ),
			'id'      => 'coa-strategy-habitats',
			'type'    => 'textarea_small',
		) );

		$cmb->add_field( array(
			'name'    => __( 'COA Specialized and Local Habitats Hover Text', 'ocs' ),
			'id'      => 'coa-specialized-habitats',
			'type'    => 'textarea_small',
		) );

		$cmb->add_field( array(
			'name'    => __( 'Recommended Conservation Actions Hover Text', 'ocs' ),
			'id'      => 'coa-conservations-actions',
			'type'    => 'textarea_small',
		) );

		$cmb->add_field( array(
			'name'    => __( 'Local Conservation Actions and Plans Hover Text', 'ocs' ),
			'id'      => 'coa-local-conservation-actions',
			'type'    => 'textarea_small',
		) );

		$cmb->add_field( array(
			'name'    => __( 'Potential Partners Hover Text', 'ocs' ),
			'id'      => 'coa-potential-partners',
			'type'    => 'textarea_small',
			'after_row' => '</div>', //close final tab
		) );






	}

	/**
	 * Register settings notices for display
	 *
	 * @since  0.1.0
	 * @param  int   $object_id Option key
	 * @param  array $updated   Array of updated fields
	 * @return void
	 */
	public function settings_notices( $object_id, $updated ) {
		if ( $object_id !== $this->key || empty( $updated ) ) {
			return;
		}

		add_settings_error( $this->key . '-notices', '', __( 'Settings updated.', 'ocs' ), 'updated' );
		settings_errors( $this->key . '-notices' );
	}

	/**
	 * Public getter method for retrieving protected/private variables
	 * @since  0.1.0
	 * @param  string  $field Field to retrieve
	 * @return mixed          Field value or exception is thrown
	 */
	public function __get( $field ) {
		// Allowed fields to retrieve
		if ( in_array( $field, array( 'key', 'metabox_id', 'title', 'options_page' ), true ) ) {
			return $this->{$field};
		}

		throw new Exception( 'Invalid property: ' . $field );
	}

}

/**
 * Helper function to get/return the ocs_Admin object
 * @since  0.1.0
 * @return ocs_Admin object
 */
function ocs_admin() {
	static $object = null;
	if ( is_null( $object ) ) {
		$object = new ocs_Admin();
		$object->hooks();
	}

	return $object;
}

/**
 * Wrapper function around cmb2_get_option
 * @since  0.1.0
 * @param  string  $key Options array key
 * @return mixed        Option value
 */
function ocs_get_option( $key = '' ) {
	return cmb2_get_option( ocs_admin()->key, $key );
}

// Get it started
ocs_admin();

