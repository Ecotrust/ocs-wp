<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="google-site-verification" content="nGfWTwdYO4auXg8ACjTzBCp-s4ewVw9SW5mwRsbA3-s" />
	<script>
		var ocs_asset_dir = "<?php echo get_stylesheet_directory_uri(); ?>";
		<?php // try to prevent FOUC for page title/search box ?>
		<?php readfile(get_template_directory() . '/dist/scripts/inline-head.js'); ?>
	</script>
  <?php wp_head(); ?>
</head>
