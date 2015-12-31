<header id="header" class="container-fluid banner" role="banner">
	<div class="row">
		<a tabindex="1" class="brand" href="<?= esc_url(home_url('/')); ?>">Conserve</a>

		<a href="#mainContent" id="skip-to-content" class="sr-only sr-only-focusable" tabindex="2">Skip to Main Content</a>

		<div class="header-inner view-switcher">
			<div class="search-wrap">
				<form action="/" class="search-form form-inline" method="get" role="search">
					<label class="sr-only">Search for:</label>
					<input type="search" required="" tabindex="3" placeholder="SEARCH" id="search-field" class="search-field" name="s" value="">
					<button class="search-submit"  tabindex="4" type="submit">Search</button>
				</form>
			</div>

			<a href="#" class="view-map">Map</a>
			<a href="#" class="view-grid">Grid View</a>
			<a href="#" class="view-list">List View</a>
			<?php $theHelpLink = get_permalink(ocs_get_option('ocs-help-icon-url')); ?>
			<a class="my-ocs" href="<?php echo $theHelpLink ?>" tabindex="5">Help</a></li>

		</div> <!-- /.header-inner -->
	</div> <!-- /.row -->
</header>
