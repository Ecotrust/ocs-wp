	<article id="kci-item-<?php echo $post->ID; ?>"  <?php post_class('grid-item'); ?>>
			<a href="<?php the_permalink(); ?>">
				<?php if ( has_post_thumbnail($post->ID) ) : ?>
					<div class="image-grid-container">
						<?php echo get_the_post_thumbnail($post->ID, 'grid') ?>
					</div>
				<?php endif; ?>
				<h3 class="cpt-title"><?php the_title(); ?></h3>
				<p><?php echo get_the_excerpt(); ?></p>
			</a>
	</article>

