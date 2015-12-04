<img id="region-png-print" src="/wordpress//media/ODFW_ecoregion_final_base.png"/>

<article class="row" <?php post_class(); ?>>

<?php
	$args = array(
		'post_type' => 'ecoregion',
		'orderby' => 'title',
		'order' => 'ASC',
		'posts_per_page'=> '100', // -1 == show all
	);

	$loop = new WP_Query( $args );

	$count = 0;

	$popup_content_array = array();


	if( $loop->have_posts() ):
		while( $loop->have_posts() ): $loop->the_post();

			//get content material for svg popup
			$region_title = the_title('','',false);
			$region_content = wp_trim_excerpt(get_the_excerpt());
			$popup_content_array[$region_title] = $region_content;

			global $post;

?>

		<div class="col-md-6" id="ecoregion-item-<?php echo $post->ID; ?>">
			<a href="<?php the_permalink(); ?>">
				<div class="image-grid-container">
					<?php if ( has_post_thumbnail($page->ID) ) : ?>
						<?php echo get_the_post_thumbnail($page->ID, 'large', array('class' => 'img-responsive')) ?>
					<?php endif; ?>
				</div>
				<h3 class="cpt-title"><?php the_title(); ?></h3>
				<?php echo get_the_excerpt(); ?>
			</a>
		</div>

<?php
			$count++;

		endwhile;
	endif;

?>

	<div class="compass main">

		<?php 
			wp_enqueue_script('svgPopup', get_template_directory_uri() . '/assets/scripts/svgPopup.js');
			wp_localize_script('svgPopup', 'svg_popup_vars', $popup_content_array);
		?>

		<div class="ecoregion-svg">
			<span class="compass-close">
			    <i class="glyphicon glyphicon-remove-circle"></i>
			</span>
			<img id="region-png" src="/wordpress//media/ODFW_ecoregion_final_base.png"/>
			<object id="regions" data="/wordpress//media/ODFW_ecoregion_final_clean.svg" type="image/svg+xml"></object>
		</div>
	</div>

</section>
