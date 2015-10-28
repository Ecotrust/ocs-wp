<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>

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
	// $species_sub_pages = array(110,111,112, 113, 114, 115, 116);
	elseif ( is_page( array(110,111,112, 113, 114, 115, 116) ) ) :
		get_template_part('templates/cpt-listing/cpt', 'strategy-species');

	// the rest
	else :
		get_template_part('templates/content', 'page');

	endif;

	wp_reset_postdata();

?>

</section>

	<?php

endwhile;

/*
99 kci
101 ecoregion
102 Conservation Opportunity Areas
105 Strategy Habitats
109 Strategy Species
	Get sub pages and then
110, //Birds
111, //Mammals
112, //Amphibians
113, //Reptiles
114, //Fish
115, //Invertebrates
116, //Plants and Algae
117, //Species Data Gaps: Research and Monitoring Needs
118, //Animal Concentrations
119, //Naturally Occurring Fish and Wildlife Diseases
120, //Methods for determining Strategy Species
 */
?>
