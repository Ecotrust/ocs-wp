<header id="header" class="container-fluid banner" role="banner">
	<div class="row">
		<a tabindex="1" class="brand" href="<?= esc_url(home_url('/')); ?>">Conserve</a>

		<a href="#mainContent" id="skip-to-content" class="sr-only sr-only-focusable" tabindex="2">Skip to Main Content</a>

		<div class="header-inner view-switcher">
			<div class="search-wrap">
				<form action="/" class="search-form form-inline" method="get" role="search">
					<label class="sr-only" for="search-field" aria-label="search-field">Search for:</label>
					<input type="search" required="" placeholder="SEARCH" id="search-field" class="search-field" name="s" value="">
					<button class="search-submit" type="submit"><span>Search</span></button>
					<div id="length-test"></div>
				</form>
			</div>

			<a href="#" class="view-map" aria-title="map view">Map</a>
			<a href="#" class="view-grid" aria-title="grid view">Grid View</a>
			<a href="#" class="view-list" aria-title="list view">List View</a>
			<a href="#" class="view-article" aria-title="article view">Article View</a>
			<input type="checkbox" name="nav" class="nav-check" id="nav-check" value="" aria-label="nav-check-label" title="nav menu">
			<label rel="navigation" class="navicon my-ocs" id="nav-check-label" aria-label="nav-check" for="search-field" title="nav menu"><span></span></label>
			<nav>
				<?php
				  if (has_nav_menu('secondary_navigation')) :
					wp_nav_menu(['theme_location' => 'secondary_navigation', 'menu_class' => 'secondary-ocs-navigation', 'container' => '']);
				  endif;
				?>
			</nav>

		</div> <!-- /.header-inner -->
	</div> <!-- /.row -->
</header>
