<?php 
	
	/* 
		Plugin Name: Ecotrust CSV Import
		Description: This plugin imports csv files to custom post types.
		Vesion: 0.1
		Author: Lang Schwartzwald
		Author URI: www.langschwartzwald.com
		License: GPLv2
	*/

/* Initialization ---------------------------------------------
*
* 
*
*
-------------------------------------------------------------*/


	register_activation_hook( __FILE__, 'ls_csv_activate');
	register_deactivation_hook( __FILE__, 'ls_csv_deactivate');
	
	// Activate
	function ls_csv_activate() {
		// 	Check wordpress version compatability

		if (version_compare(get_bloginfo('version'), '4.0', '<')) {
			
			// Deactivates plugin in if fails version compare
			deactivte_plugins(basename( __FILE__)) ;
		}
	}
	
	// Deactivate
	function ls_csv_deactivate() {
		// Clear the permalinks to remove our post type's rules
		flush_rewrite_rules();
	}
	
	// Actions once plugins have been loaded
	add_action( 'plugins_loaded', 'ls_plugin_setup');
	

	// Plugin Setup 
	function ls_plugin_setup() {
		
		// Add Actions
		add_action( 'admin_menu', 'ls_admin_settings');
	}
		
	function ls_admin_settings() {
		
 		add_options_page( 'CSV Import Settings', 'CSV Import Settings', 'manage_options', 'csv_admin_settings', 'ls_csv_admin_page');
		
		
	}
	
	function get_category_id($cat_name) {
		$term = get_term_by('name', $cat_name, 'category');
		
		if($term->term_id){
			return $term->term_id;
		}else{
			return false;
		}
		
	}
	
	
	function ls_csv_admin_page() { 
		?>
		
		<?php
		
			if($_FILES[csv][size] > 0) {
				//get the csv file 
				$file = $_FILES[csv][tmp_name]; 
				$row = 1;
				if (($handle = fopen($file, "r")) !== FALSE) {
					while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
						
						// Items in a line
						$num = count($data);
						echo "<p> $num fields in line $row: <br /></p>\n";
						$row++;
						
						$headersArray = [];
						
						// For each item in the line
						for ($c=0; $c < $num; $c++) {
							
// 							Set (reset) Variables for each row
							$WP_ID = '';
							$coaName = '';
							$post_ID = '';
							$cat_ID = '';
							
							
							
							// IF there is an item
							if($data[$c]!= ''){
								
								// Get the Column Headers from the first line
								if($row == 1) {
									$headersArray[]=$data[$c];
								}else{
									
									// each Number represent a column in the file
// 									update_post_meta($post_id, $meta_key, $meta_value, $unique);
									
									
									switch($c) {
										case 1:
											// COA Name Column
											// store post title
											$coaName = $data[$c];
											break;
										case 2:
											// COAID Column
											// Get the post id by searching on the COAID meta field
											$args = array(
												'post_type'   => 'coa',
												'meta_query'  => array(
													array(
														'coa_meta_id' => $data[$c]
														)
													)
												);
											$coa_query = new WP_Query( $args );
											
// 											Verify there is only record, and store the ID
											if($coa_query->post_count == 1){
												$post_ID = $coa_query->post->ID;
												update_post_meta($post_ID, 'coa_meta_coaid', $data[$c], true);
											}											
											break;
										case 3:
											// WordpressID Column
												$WP_ID = $data[$c]
											break;
										case 4:
											// Wordpress Import Notes
											break;
										case 5:
											// Category Column
											
											// Search for Category by name, get the ID's and set
											$cat_ID= get_category_id($data[$c]);
											if($cat_ID != false){
												$set_category = wp_set_object_terms($post_ID, $cat_ID, 'category');
											}else{
												// Create category if one is not found
												$cat_ID = wp_create_category($data[$c]);
												$set_category = wp_set_object_terms($post_ID, $cat_ID, 'category');
											}
											
											break;
										case 6:
											// Sub Category Column
											
											// Check for existance of Sub Category
											if(!empty($data[$c])) {
												$subCat_ID = get_category_id($data[$c]);
												
												if($subCat_ID !=false){
													// Set the sub category
													$set_category = wp_set_object_terms($post_ID, $subCat_ID, 'category');
												}else{
													// Setup a sub category
													$subCat_ID=wp_insert_term($data[$c], 'category', array('parent' => $cat_ID));
													// Set the sub category
													$set_category = wp_set_object_terms($post_ID, $subCat_ID['term_taxonomy_id'], 'category');
												}
												
											}
											break;
										case 7:
											// Item Column
											
											if($WP_ID != ''){
												
											}
											break;
										case 8:
											// Link Column
											update_post_meta($post_ID, 'coa_meta_compass-link', $data[$c], true);
											break;
										case 9:
											// SpeciesType Column
											break;
										case 10:
											// DataSource Column
											update_post_meta($post_ID, 'coa_meta_data-source', $data[$c], true);
											break;
										case 11:
											break;
											
									}
									
								}
								
// 								echo $data[$c] . "<br />\n";
							}
							
						}
					}
					fclose($handle);
				}	
			}	
		?>
		
		<div style='padding: 1em'>
		<h3>CSV Importer</h3>
		<p>This plugin is used to map specific csv files to various custom posts types, and metadata</p>
		
		<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
  Upload file: <br /> 
  <input name="csv" type="file" id="csv" /> 
  <input type="submit" name="Submit" value="Submit" />
		</form>
		</div>
		
		
<?php } ?>