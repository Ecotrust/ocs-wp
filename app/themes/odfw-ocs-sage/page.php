<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>

<pre>
	<?php  //print_r( @get_defined_constants() ); ?>
</pre>
<div class="hentry">
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
</div>

<? //TODO listings-wrap is going on in every page ?>
<section class="listings-wrap">

<?php

	// CPT listings
//
	// Key Conservation Issues
	if ( is_page('99') ) :
		get_template_part('templates/cpt-listing/cpt', 'kci');

	// ecoregion
	elseif ( is_page('101') ) :
		get_template_part('templates/cpt-listing/cpt', 'ecoregion');

	// Conservation Opportunity Areas
	elseif ( is_page('102') ) :
		get_template_part('templates/cpt-listing/cpt', 'coa');

	// Strategy Habitats
	elseif ( is_page('105') ) :
		get_template_part('templates/cpt-listing/cpt', 'strategy-habitat');

	// Strategy Species Parent Page
	elseif ( is_page('109') ) :
		get_template_part('templates/cpt-listing/cpt', 'strategy-species');

	// Strategy Species sub pages
	elseif ( is_page( Roots\Sage\Config\get_the_species_listing_pages() ) ) :
		get_template_part('templates/cpt-listing/cpt', 'strategy-species');

	// the rest
	else :
		get_template_part('templates/content', 'page');

	endif;

	wp_reset_postdata();

?>

</section>
		<?php get_template_part('templates/content', 'success-story'); ?>

	<?php

endwhile;


?>
