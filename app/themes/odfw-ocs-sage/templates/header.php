<header id="header" class="container-fluid banner" role="banner">
	<div class="row">
		<a class="brand" href="<?= esc_url(home_url('/')); ?>">Conserve</a>

		<div class="header-inner">
			<div class="row">
				<div class="search-wrap">
					<form action="//localhost:3000/" class="search-form form-inline" method="get" role="search">
						<label class="sr-only">Search for:</label>
						<input type="search" required="" placeholder="Search the OCS" id="search-field" class="search-field" name="s" value="">
						<button class="search-submit" type="submit">Search</button>
					</form>
				</div>

				<nav class="view-switcher">
					<ul>
						<li><button class="view-map">Map</button></li>
						<li><button class="view-grid">Grid View</button></li>
						<li><button class="view-list">List View</button></li>
						<li><button class="my-ocs">Oregon</button></li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
</header>
