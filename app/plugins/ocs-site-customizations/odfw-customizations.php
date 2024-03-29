<?php
/*
 * Plugin Name: OCS App Customizations
 * Plugin URL: http://www.dfw.state.or.us/conservationstrategy/
 * Description: Custom Post Types, Taxonomies and more for ODFW's Oregon Conservation Strategy
 * Version: 0.4
 * Author: Will Moore, Ecotrust
 * Author URI: http://ecotrust.org
 * Contributors: wmoore
 * Text Domain: odfw
*/


defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );

/*
|--------------------------------------------------------------------------
| CONSTANTS
|--------------------------------------------------------------------------
*/


class ODFW_customizations {

	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/
	/**
     * Bootstrap it.
	 */
	function __construct() {


        /**
         * Define plugin folder path
         */
        if( ! defined( 'ODFW_CUSTOMIZATIONS_PLUGIN_URL') ) {
            define( 'ODFW_CUSTOMIZATIONS_PLUGIN_URL', trailingslashit( dirname( __FILE__ ) ) );
	}

        if( ! defined( 'ODFW_MODULES') ) {
            define('ODFW_MODULES', ODFW_CUSTOMIZATIONS_PLUGIN_URL . 'modules/');
        }

        include_once(ODFW_MODULES . 'odfw-options-page.php');

        include_once(ODFW_MODULES . 'odfw-custom-post-types.php');

        include_once(ODFW_MODULES . 'odfw-custom-taxonomies.php');

        include_once(ODFW_MODULES . 'odfw-custom-meta-boxes.php');

        include_once(ODFW_MODULES . 'odfw-content-authoring.php');

        include_once(ODFW_MODULES . 'odfw-customize-admin.php');

        include_once(ODFW_MODULES . 'odfw-customize-media.php');

        include_once(ODFW_MODULES . 'odfw-search.php');



		// $this->adjust_species_CSV_imports();

		//Uncomment this to debug CSV importing before it hits the database
		//require_once('lib/rs-csv-importer-debug.php');


	} // end constructor


    public function adjust_species_CSV_imports () {


        // tweak custom fields ('meta_data')
        function CSV_species_save_meta_filter( $meta, $post, $is_update ) {

			$accros = array(
				"SOC" => "Species of Concern",
				"C" => "Candidate for listing",
				"E"=> "Endangered",
				"T" => "Threatened",
				"S" => "Sensitive",
				"P" => "Proposed"
			);
            foreach ($meta as $key => $value) {
                // serialize the attached ecoregions list
                if ($key == "species_meta_attached_ecoregions") {
                    if (strpos($value, ',') !== false) {
                        $_value = preg_split("/,+/", $value);
                        $meta[$key] = $_value;
                    }
                }
				// Replace abbreviations in the status fields with <abbr> tags
				if ($key == "species_meta_federal-listing-status" || $key == "species_meta_state-listing-status") {
					if ( !empty( $value ) ) {
						trim($value);
						foreach($accros as $accr=>$fullText) {
							//if( strpos($ac, $value) !== false ) {
							// only when the abbr is the first thing in the field:
							//if( strpos($ac, $value) == 0 ) {
							if( $accr == $value ) {
								$abbrStr = "<abbr title='" . $fullText . "'>" . $value . "</abbr>";
								$meta[$key] = $abbrStr;
								//echo "XXX: " . $key . ": " . $value . "<br>" . "\n\n" ;
							}
						}
					}else{
						//echo "value is empty<br>" . "\n\n";
					}
				}

            }
            return $meta;
        }
        add_filter( 'really_simple_csv_importer_save_meta', 'CSV_species_save_meta_filter', 10, 3 );

        // tweak the post content
        function CSV_species_save_post_filter( $post, $is_update ) {

            if (!isset($post['post_name'])) {
                if (isset($post['post_title'])) {
                    // avoid adding a slug to the CSV sheet and just do it here
                    $post_name = sanitize_title($post['post_title']);
                    $post['post_name'] = $post_name;
                    //$post['post_status'] = "publish";
                }
            }

            return $post;
        }
        add_filter( 'really_simple_csv_importer_save_post', 'CSV_species_save_post_filter', 10, 2 );
    }



}


// Please proceed, governer
$GLOBALS['ODFW_customizations'] = new ODFW_customizations();

/*
    could autoload it all http://www.phpro.org/tutorials/SPL-Autoload.html
*/
