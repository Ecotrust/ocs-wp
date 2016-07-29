<?php

  ini_set('memory_limit', '512M');

  ini_set('max_execution_time', 300); //300 seconds = 5 minutes

  $extensions = array('xls' => '.xls', 'xlsx' => '.xlsx');

  $args = array (

      'public'   => true

  );

  $output = 'objects';

  //$post_types = get_post_types($args, $output);

  if ( isset($_POST['Download']) ) {
  	global $wpdb;
  	$ext = 'csv';
  	if (empty($_POST) || !check_admin_referer('e2e_export_data' )  ) {
  		wp_die('Sorry, your nonce did not verify.');
  	} else {
  		include('loop.php');
  		$filename = sanitize_file_name(get_bloginfo('name') ) . '.' . $ext;
		//header('Content-Type: application/excel');
		header("Content-type: text/csv");
		header('Content-Disposition: attachment; filename="'.$filename.'"');
		$fp = fopen('php://output', 'w');
		
		foreach ($data as $line) {
		    $val = explode(",", $line);
		    fputcsv($fp, $val);
		}
		
		//fputcsv($fp, $str);
		fclose($fp);
		//		print $str;
  		exit();
  	}
  } else { ?>
  <div id="wp-ocs-write-page" role="navigation">
	<section>
		<?php //$name = $type->labels->name == "Posts" ? "Blog Posts" : $type->labels->name; ?>
		<h2><div class="wp-menu-image dashicons-before dashicons dashicons-download"><br></div>Export to CSV
			<br><span><em>Dowload CSV file of complete COA data.</em></span></h2>
		<div class="body">
    		<form name="export" action="<?php echo $form_action; ?>" method="post">
		            <?php wp_nonce_field('e2e_export_data'); ?>
					<input type="submit" class="button button-primary button-large" name="Download" value="Download" />
		    </form> 
		</div>
	</section>
</div>
  
  
    <?php } ?>