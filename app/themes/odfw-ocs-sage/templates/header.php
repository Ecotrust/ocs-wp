<header id="header" class="container-fluid banner" role="banner">
	<div class="row">
		<a class="brand" href="<?= esc_url(home_url('/')); ?>">Conserve</a>

		<div class="header-inner view-switcher">
			<div class="search-wrap">
				<form action="/" class="search-form form-inline" method="get" role="search">
					<label class="sr-only">Search for:</label>
					<input type="search" required="" placeholder="Search the OCS" id="search-field" class="search-field" name="s" value="">
					<button class="search-submit" type="submit">Search</button>
				</form>
			</div>

			<a href="#" class="view-map">Map</a>
			<a href="#" class="view-grid">Grid View</a>
			<a href="#" class="view-list">List View</a>
			<?php $theHelpLink = get_permalink(ocs_get_option('ocs-help-icon-url')); ?>
			<a class="my-ocs" href="<?php echo $theHelpLink ?>">Help</a></li>

		</div> <!-- /.header-inner -->
	</div> <!-- /.row -->
</header>
