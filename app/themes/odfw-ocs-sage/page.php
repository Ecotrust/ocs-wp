<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>

<div class="hentry">
	<?php
		// No featured image on species sub-pages (Taxonomy overview pages)
		//$parent = $post->post_parent;
		if ($post->post_parent != 109):
			get_template_part('templates/featured-thumbnail');
		endif;
	?>
	<div class="entry-content">
		<?php the_content(); ?>

<?php
	$pageID = get_the_id();
	$cptPages = Roots\Sage\Config\get_the_cpt_listing_pages();
	$speciesPages =  Roots\Sage\Config\get_the_species_listing_pages();
	$isListingPage = in_array($pageID, $cptPages) || in_array($pageID, $speciesPages) ? true : false;

//   $pdf_btn_url = get_post_meta($pageID, 'chapter_pdf_custom-url', true );
//   if (!empty($pdf_btn_url)) : 
?>
<!--   <div class="pdf-download-btn-wrap">
    <a href="<?=//$pdf_btn_url?>" target="_blank" class="btn btn-primary">&#8681; Download Chapter PDF</a>
   </div> -->
   <?php 
   // endif;

	if ($isListingPage) : ?>

		<section tabindex="8" id="cpt-listings-wrap" class="listings-wrap">
		<?php

			// CPT listings

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
	<?php endif; ?>
		<?php get_template_part('templates/content', 'success-story'); ?>

	</div>
</div>
	<?php

endwhile;


?>
