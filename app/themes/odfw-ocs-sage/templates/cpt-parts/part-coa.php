	<article id="coa-item-<?php echo $post->ID; ?>"  <?php post_class('grid-item'); ?>>
			<a href="<?php the_permalink(); ?>">
			<?php //get_template_part('templates/featured-thumbnail'); ?>
				<?php if ( has_post_thumbnail($post->ID) ) : ?>
					<div class="image-grid-container">
						<?php //echo get_the_post_thumbnail($post->ID, 'grid') ?>
					</div>
				<?php endif; ?>

				<?php //$incAssoc =  get_query_var('coa-assoc', false); ?>
				<?php $coa_id = get_post_meta( get_the_ID(), 'coa_meta_coa_id', true );?>

				<h3 class="cpt-title"><?php the_title(); ?>
					<span class="coa-id">[COA ID: <?=$coa_id ?>]</span>
				</h3>
				<p><?php echo get_the_excerpt(); ?></p>
			</a>
	</article>

