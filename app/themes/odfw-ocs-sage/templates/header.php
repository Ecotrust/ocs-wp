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
						<li class="view-map"><button>M</button></li>
						<li class="view-grid"><button>G</button></li>
						<li class="view-list"><button>L</button></li>
					</ul>
					<span class="my-ocs">OR</span>
				</nav>
			</div>
		</div>
	</div>
</header>
