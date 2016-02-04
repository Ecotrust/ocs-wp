<section <?php post_class(); ?>>


<?php
	$args = array(
		'post_type' => 'kci',
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'posts_per_page'=> '-1',
	);

	$loop = new WP_Query( $args );


	if( $loop->have_posts() ):
		while( $loop->have_posts() ): $loop->the_post();

			get_template_part('/templates/cpt-parts/part', 'kci');

		endwhile;
	endif;

?>
</section>
