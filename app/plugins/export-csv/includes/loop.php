<?php
//$data = array('COAName,COAID,Category,SubCategory,Item,Link,SpeciesType,DataSource'); 
$data = array('COAName,COAID,Category,SubCategory,Item,Link,SpeciesType,'); 

$coas = $wpdb->get_results("SELECT `ID` AS 'ID', `post_title` AS 'COAName', `post_content` AS 'COADesc' FROM `wp_posts` WHERE `post_status` = 'publish' AND `post_type` = 'coa' ORDER BY `post_title` ASC");

foreach ($coas as $coa ) {
	//$coaName = str_replace(',','\",',$coa->COAName);
	//$coaName = "'".$coa->COAName;
	$coaName = str_replace(',','',$coa->COAName);
	$category = 'COA Description';
	$subCat = '';
	$item = $coa->COADesc;
	$link = '';
	//$TGTID
	$speciesType = '';	
	//$dataSource = '';
	

	$coa_id = $wpdb->get_results("SELECT `meta_value` AS 'value' 
		FROM `wp_postmeta` 
		WHERE `post_id` = $coa->ID
		AND `meta_key` = 'coa_meta_coa_id'");
	foreach ($coa_id as $id_coa) {
		$coaID = "'".$id_coa->value;
	}

	// COA Description
	$output = $coaName.',';
	$output .= $coaID.',';
	$output .= $category.',';
	$output .= $subCat.',';
	$output .= $item.',';
	$output .= $link.',';
	//$output .= $speciesType.',';
	//$output .= $dataSource;
	$output .= $speciesType;

	$data[]=$output;
	
	$coa_meta = $wpdb->get_results("SELECT DISTINCT `meta_key` AS 'key', `meta_value` AS 'value' 
		FROM `wp_postmeta` 
		WHERE `post_id` = $coa->ID
		GROUP BY `meta_key`
		ORDER BY `meta_id` DESC");
	
		foreach ($coa_meta as $meta ) {
			//reset
			$category = '';
			$subCat = '';
			$item = '';
			$link = '';
			//$TGTID
			$speciesType = '';	
			//$dataSource = '';

			$count = count($meta->key);

			if($meta->key == 'coa_meta_special_features') {
				$category = 'Special Features';
				$subCat = '';
			} elseif($meta->key == 'coa_meta_special_features_2006') {
				$category = 'Special Features';
				$subCat = '2006 COA';
			} elseif($meta->key == 'coa_meta_special_features_protected_area') {
				$category = 'Special Features';
				$subCat = 'Protected Area';
			} elseif($meta->key == 'coa_meta_local_conservation_actions_and_plans') {
				$category = 'Local Conservation Actions and Plans';
				$subCat = '';
			} elseif($meta->key == 'coa_meta_potential_partners') {
				$category = 'Potential Partners';
				$subCat = '';
			} elseif($meta->key == 'coa_meta_recommended_conservation_actions') {
				$category = 'Recommended Conservation Actions';
				$subCat = '';
			} elseif($meta->key == 'coa_meta_attached_ecoregions') {
				$category = 'Ecoregions';
				$subCat = '';
			} elseif($meta->key == 'coa_meta_specialized_local_habitats') {
				$category = 'Specialized Local Habitats';
				$subCat = '';
			} elseif($meta->key == 'coa_meta_attached_habitats') {
				$category = 'Strategy Habitat';
				$subCat = '';
			} elseif($meta->key == 'coa_meta_strategy_species') {
				$category = 'Strategy Species';
				$subCat = '';
			}
			
			
			foreach((array) $meta->key as $metaKey) {
				if(is_serialized($meta->value)) {
					$se = (maybe_unserialize($meta->value));
					if(($se) !== FALSE){
						for ($i=0;$i<$count;$i++){
							if(($count) !== FALSE) {
								foreach ($se as $saValue) {
									if(is_array($saValue) == false) {
										$item = $saValue;
										$speciesType = '';
									}
									foreach ((array) $saValue as $seKey => $seValue) {
										if (strpos($seKey, 'title') !== false) {
										  	$item = $seValue;
									  	} elseif (strpos($seValue, 'htpp://') !== false){
										  	$link = $seValue;
									  	} 


										if($seKey == 'coa_meta_attached_habitats') {
											$habits = $wpdb->get_results("SELECT `post_title` AS 'title'
												FROM `wp_posts`
												WHERE `ID` = $seValue");
												foreach ($habits as $habit) {
													$item = $habit->title;
												}
												$link = '';
										}
										if($seKey == 'coa_meta_strategy_species_id') {
											$species = $wpdb->get_results("SELECT DISTINCT `wp_terms`.`name`
												FROM `wp_terms`
												INNER JOIN `wp_term_relationships`
												ON `wp_terms`.`term_id` = `wp_term_relationships`.`term_taxonomy_id`
												WHERE `wp_term_relationships`.`object_id` = $seValue
												ORDER BY `wp_terms`.`name` DESC");
												foreach ($species as $term) {
													$subCat = $term->name;
												}
		
		
											$metaSpecies = $wpdb->get_results("SELECT DISTINCT `meta_value` AS 'name'
												FROM `wp_postmeta`
												WHERE `meta_key` = 'species_meta_species-common-name'
												AND `post_id` = $seValue
												ORDER BY `meta_value` DESC");
												foreach ($metaSpecies as $common) {
													$item = $common->name;
												}
												$link = '';

										}
										if($seKey == 'coa_meta_strategy_species_association') {
											$link = '';
											$speciesType = $seValue;
										}
									}
									
									$item = str_replace(',','',$item);
									
									$output = $coaName.',';
									$output .= $coaID.',';
									$output .= $category.',';
									$output .= $subCat.',';
									$output .= $item.',';
									$output .= $link.',';
									//$output .= $speciesType.',';
									//$output .= $dataSource;
									$output .= $speciesType;
									
									$data[]=$output;
									
									$item = '';
									$link = '';
									$speciesType = '';	
									//$dataSource = '';
								}
							}
						}						
					}
				}
			}
		}	
}
// echo '<pre>';
// var_dump($data);
// echo '</pre>';

?>