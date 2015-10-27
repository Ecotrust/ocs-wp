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
							
							// IF there is an item
							if($data[$c]!= ''){
								
								// Get the Column Headers from the first line
								if($row == 1) {
									$headersArray[]=$data[$c];
								}else{
									
									// each Number represent a column in the file
// 									add_post_meta($post_id, $meta_key, $meta_value, $unique);
									
									
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
												'post_type'   => 'page',
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
											}											
											break;
										case 3:
											// WordpressID Column
											if($data[$c])
											break;
										case 4:
											// Wordpress Import Notes
											break;
										case 5:
											// Category Column
											break;
										case 6:
											// Sub Category Column
											break;
										case 7:
											// Item Column
											break;
										case 8:
											// Link Column
											break;
										case 9:
											// SpeciesType Column
											break;
										case 10:
											// DataSourse Column
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