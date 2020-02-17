<?php
/**
 * HTML/CSS for Writeboard
 *
 */

/** WordPress Administration Bootstrap */
//require_once( ABSPATH . 'wp-load.php' );
//require_once( ABSPATH . 'wp-admin/admin.php' );
//require_once( ABSPATH . 'wp-admin/admin-header.php' );
?>
<style type="text/css" media="all">
	#wp-ocs-write-page {
		padding-top: 20px;
	}
	#wp-ocs-write-page .wp-menu-name, #wp-ocs-write-page h2 {
		border-bottom: 1px solid #eee;
		font-size: 1.5em;
		margin: 0;
		overflow: hidden;
		padding: 10px;
	}
	#wp-ocs-write-page div.wp-menu-image {
    float: left;
    height: 34px;
    margin: 0;
    text-align: center;
    width: 36px;
}
	#wp-ocs-write-page div.wp-menu-image::before {
		color: rgba(40, 45, 50, 0.6);
		font-size: 25px;
	}
#wp-ocs-write-page .button div.wp-menu-image::before {
	color: rgba(242,242,242,0.5);
	font-size: 20px;
}
	#wp-ocs-write-page .wp-menu-name a{
		display: inline-block;
		float: right;
		font-size: 70%;
		text-align: right;
	}
	#wp-ocs-write-page section{
		border: 1px solid #eee;
		border-radius: 5px;
		float: left;
		margin-right: 2%;
		margin-bottom: 30px;
		width: 30%;
	}
	#wp-ocs-write-page .body {
		padding: 5px;
	}
	#wp-ocs-write-page ul{
		padding: 0 10px 5px 10px;
	}
	#wp-ocs-write-page .button{
	}
	#wp-ocs-write-page .button-large{
		font-size: 1.2em;
		line-height: 2;
		height: 2.2em;
		display: block;
		text-align: left;
		margin-bottom: 4px;
	}
	#wp-ocs-write-page .button-large .dashicons{
		font-size: 1.2em;
		line-height: 1.8;
		margin-right: 4px;
	}
	#wp-ocs-write-page h2 .dashicons {
		margin-right: 5px;
		margin-top: -12px;
	}

</style>
<div id="wp-ocs-write-page" role="navigation">

	<h1 id="heading">Oregon Conservation Strategy Write Panel</h1>


<?php

	//TODO add a link
	$args = array(
	   'public'   => true
	);
	$of_post_types = get_post_types( $args, 'objects' );
	foreach($of_post_types as $type) :
		//Skip Media and Blog Posts
		if ( $type->name == "attachment" || $type->name == "post" ) continue;
	//dbug($type->labels);
	//print_r($type);
	$icon = !empty($type->menu_icon) ? $type->menu_icon : "dashicons-admin-page";
	?>

		<section>
			<?php $name = $type->labels->name == "Posts" ? "Blog Posts" : $type->labels->name; ?>
			<h2><div class="wp-menu-image dashicons-before dashicons <?php echo $icon; ?>"><br></div><?php echo $name; ?></h2>
			<div class="body">
				<a class="button button-primary button-large" href="post-new.php?post_type=<?php echo $type->name; ?>">
					<!-- <div class="wp-menu-image dashicons-before dashicons <?php echo $icon; ?>"><br></div> -->
					<span class="dashicons dashicons-welcome-write-blog" alt="f119"></span>
					<?php echo $type->labels->add_new_item; ?>
				</a>
				<a class="button action" href="edit.php?post_type=<?php echo $type->name; ?>">
					View <?php echo $type->labels->all_items; ?>
				</a>
			</div>
		</section>

<?php endforeach; ?>
		<section>
			<?php //$name = $type->labels->name == "Posts" ? "Blog Posts" : $type->labels->name; ?>
			<h2><div class="wp-menu-image dashicons-before dashicons dashicons-editor-ul"><br></div>Export to CSV</h2>
			<div class="body">
				<a class="button button-primary button-large" href="tools.php?page=export-csv">
					<span class="dashicons dashicons-download" alt="f119"></span>
					<?php echo 'Export COA Profiles'; ?>
				</a>
			</div>
		</section>

<?php
// include( ABSPATH . 'wp-admin/admin-footer.php' );
