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
						<?php   
						$coa = get_post_meta( get_the_ID(), 'coa_meta_compass-link', true );
						$ecoregion = get_post_meta( get_the_ID(), 'ecoregion_meta_compass-link', true);
						$habitat = get_post_meta( get_the_ID(), '_strategy_habitat_meta_compass-link', true);
						$species = get_post_meta( get_the_ID(), 'species_meta_compass-link', true );

  						if ( ! empty($coa) || ! empty($ecoregion) || ! empty($habitat) || ! empty($species) ) : ?>
							<li class="view-map"><button>M</button></li>
						<?php endif; ?>
						
						<li class="view-grid"><button>G</button></li>
						<li class="view-list"><button>L</button></li>
					</ul>
					<span class="my-ocs">OR</span>
				</nav>
			</div>
		</div>
	</div>
</header>
