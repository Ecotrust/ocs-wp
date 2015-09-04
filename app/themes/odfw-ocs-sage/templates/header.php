<header id="header" class="banner" role="banner">
  <div class="container-fluid">
	<div class="row">
		<a class="brand" href="<?= esc_url(home_url('/')); ?>">Conserve</a>

		<div class="search-wrap">
			<form action="//localhost:3000/" class="search-form form-inline" method="get" role="search">
				<label class="sr-only">Search for:</label>
				<input type="search" required="" placeholder="Search the OCS" id="search-field" class="search-field" name="s" value="">
				<button class="search-submit btn btn-default" type="submit">Search</button>
			</form>
		</div>

		<?php //dynamic_sidebar('header-primary'); ?>
	</div>
  </div>
</header>
