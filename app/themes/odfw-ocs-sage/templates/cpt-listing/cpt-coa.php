<?php $the_compass_field = get_post_meta( get_the_ID(), '_main_coa_compass-link', true ); ?>
<div class="compass-coa compass">
	<div class="compass-container">
	    <span class="compass-close">
	        <i class="glyphicon glyphicon-remove-circle"></i>
	    </span>
	    <div class="view-external-compass">
            <a href="<?php echo external_odfw_compass_url($the_compass_field) ?>"  target="_blank">
                <span class="compass-icon">VIEW DATA LAYERS IN COMPASS</span> 
            </a>
        </div>
	    <?php the_odfw_compass_iframe($the_compass_field); ?>
	</div>
</div>

<section <?php post_class(); ?>>

<?php
	$args = array(
		'post_type' => 'coa',
		'orderby' => 'title',
		'order' => 'ASC',
		'posts_per_page'=> '-1',
	);

	$loop = new WP_Query( $args );

	if( $loop->have_posts() ):
		while( $loop->have_posts() ): $loop->the_post();

			get_template_part('/templates/cpt-parts/part', 'coa');

		endwhile;
	endif;

?>
</section>

