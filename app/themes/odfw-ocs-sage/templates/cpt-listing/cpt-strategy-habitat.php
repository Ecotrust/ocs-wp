<article <?php post_class(); ?>>


<?php
	$args = array(
		'post_type' => 'strategy_habitat',
		'orderby' => 'title',
		'order' => 'ASC',
		'posts_per_page'=> '100', // -1 == show all
	);

	$loop = new WP_Query( $args );

	$count = 0;

	if( $loop->have_posts() ):
		while( $loop->have_posts() ): $loop->the_post();

			global $post;

?>

		<div id="strategy-habitat-item-<?php echo $post->ID; ?>" class="">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail('small'); ?>
				<h3><?php the_title(); ?></h3>
				<p><?php the_excerpt(); ?></h3>
			</a>
		</div>

<?php
			$count++;

		endwhile;
	endif;

?>
</section>
