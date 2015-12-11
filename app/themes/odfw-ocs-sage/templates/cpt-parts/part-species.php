<?php
	$scienctific_name = get_post_meta( get_the_ID(), 'species_meta_species-scientific-name', true );
?>

	<article id="strategy-species-item-<?php echo $post->ID; ?>"  <?php post_class('grid-item'); ?>>
		<a href="<?php the_permalink(); ?>">
			<div class="image-grid-container">
				<?php
					$the_field = get_post_meta( get_the_ID(), 'species_meta_image-url', true );
					$the_field_thumbnail = get_post_meta( get_the_ID(), 'species_meta_image-thumb-url', true );
				?>
				<?php if ( !empty($the_field) ): ?>
					<img class="img-responsive" src="<?php echo esc_html( $the_field ); ?>">
				<?php elseif ( !empty($the_field_thumbnail) ): ?>
					<img class="img-responsive" src="<?php echo esc_html( $the_field_thumbnail ); ?>">
				<?php else: ?>
					<img class="img-responsive" src="http://placehold.it/330x215/aaaaaa/ffffff?text=species+placeholder">
				<?php endif; ?>
			</div>
			<h3 class="cpt-title"><?php the_title(); ?></h3>
			<p><?php echo esc_html( $scienctific_name ); ?></p>
		</a>
	</article>
