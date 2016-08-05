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
  		$filename = 'ODFW_COA_Profiles'.'.'. $ext;
		header("Content-type: text/csv");
		header('Content-Disposition: attachment; filename="'.$filename.'"');
		$fp = fopen('php://output', 'w');
		foreach ($data as $line) {
		    $val = explode('",', $line);
		    fputcsv($fp, $val);
		}
 		fclose($fp);
  		exit();
  	}
  } else { ?>
<!-- match to Write Panel -->
  <div id="wp-ocs-write-page" role="navigation">
	<section>
		<h2><div class="wp-menu-image dashicons-before dashicons dashicons-download"><br></div>Export to CSV
			<br><span><em>Dowload CSV file of complete COA profiles.</em></span></h2>
		<div class="body">
    		<form name="export" action="<?php echo $form_action; ?>" method="post">
		            <?php wp_nonce_field('e2e_export_data'); ?>
					<input type="submit" class="button button-primary button-large" name="Download" value="Download" />
		    </form> 
		</div>
	</section>
</div>
    <?php } ?>