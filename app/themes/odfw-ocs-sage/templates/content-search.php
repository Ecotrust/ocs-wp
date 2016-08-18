<?php
$postType = get_post_type();
// if exists:
if ($postType == 'strategy_species'):
	$specID = get_the_ID();
	$specAsc = '';
	set_query_var('specID', $specID);
	set_query_var('specAsc', $specAsc);
	echo get_template_part('templates/cpt-parts/part', 'strategy_species');
elseif (locate_template('templates/cpt-parts/part-' . $postType . '.php') != '') :
	echo get_template_part('templates/cpt-parts/part', $postType);
else:
?>
<article <?php post_class('grid-item'); ?>>
	<a href="<?php the_permalink(); ?>">

		<header>
			<h3 class="cpt-title">
				<?php the_title(); ?>
			</h3>
		</header>

		<div class="entry-summary">
			<?php if ( has_post_thumbnail($post->ID) ) : ?>
				<div class="image-grid-container">
					<?php echo get_the_post_thumbnail($post->ID, 'grid') ?>
				</div>
			<?php endif; ?>

			<?php the_excerpt(); ?>
			<?php if($postType == "page" && $post->post_parent): ?>
				<footer class="result-crumb">
					<span>Parent:</span>
					<?php echo get_the_title($post->post_parent); ?>
				</footer>
			<?php endif; ?>
		</div>

	</a>
</article>
<?php
endif;
?>


