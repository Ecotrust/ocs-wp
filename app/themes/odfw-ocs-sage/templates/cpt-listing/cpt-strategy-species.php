<section <?php post_class('row'); ?>>

<?php

	$i = 0;
	$tempColors = array("27ae60", "58595B", "005130", "404041", "a3b9a1", "00371a", "bbbbbb");
	// sub pages of Strategy Species but we only want the species taxonomy masters here
	$non_species_pages = "117, 118, 119, 120";


// Is this the Species parent page?
if ( is_page('109') ) :

	$species_pages = get_pages(
		array(
			'child_of'=>$post->ID,
			'exclude' => $non_species_pages
		)
	);

		foreach( $species_pages as $page ) :
	?>
			<article id="strategy-species-overview-<?php echo $page->post_name; ?>"  <?php post_class('grid-item', $page->ID); ?>>

				<a href="<?php echo get_page_link( $page->ID ); ?>">
					<!-- <?php $the_field = get_post_meta( $page->ID, 'species_meta_image', true ); ?> -->
					<div class="image-grid-container">
						<?php if ( has_post_thumbnail($page->ID) ) : ?>
							<?php echo get_the_post_thumbnail($page->ID, 'large', array('class' => 'img-responsive')) ?>
						<?php else: ?>
						<img class='img-responsive' src="http://placehold.it/230x115/<?php echo $tempColors[$i]; ?>/ffffff?text=species+placeholder">
						<?php endif; ?>
					</div>
					<h4><?php echo $page->post_title; ?></h4>
					<?php $summary = $page->post_excerpt;
					if ( !empty( $summary ) ): ?>
						<p class="summary"><?php echo $summary; ?></p>
					<?php endif; ?>
				</a>
			</article>
		<?php
		$i = $i==6 ? $i=0 : $i + 1;
		endforeach;
	?>




<?php

// It's not? Must be a sub-page of the parent
else :


	//TODO: CHECK FOR 'sp_pages_meta_taxonomy' and
	$species_term_id = get_post_meta( get_the_ID(), 'sp_pages_meta_taxonomy', true );

	$args = array(
		'post_type' => 'strategy_species',
		'orderby' => 'title',
		'order' => 'ASC',
		'post_parent' => 0, //no subpages please
		'posts_per_page'=> '-1', // -1 == show all
		'tax_query' => array(
			array(
				'taxonomy' => 'species',
				'field'    => 'term_id',
				'terms'    => $species_term_id,
			),
		),
	);


	$loop = new WP_Query( $args );

	if( $loop->have_posts() ):
		while( $loop->have_posts() ): $loop->the_post();

			get_template_part('/templates/cpt-parts/part', 'species');

		endwhile;
	endif;


endif; // page check
?>
</section>
