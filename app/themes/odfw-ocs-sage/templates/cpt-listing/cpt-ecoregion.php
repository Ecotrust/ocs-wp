<img id="region-png-print" src="/media/ODFW_ecoregion_final_base.png"/>

<section <?php post_class('row'); ?>>

<?php
	$args = array(
		'post_type' => 'ecoregion',
		'orderby' => 'title',
		'order' => 'ASC',
		'posts_per_page'=> '-1', // -1 == show all
	);

	$loop = new WP_Query( $args );

	$popup_content_array = array();


	if( $loop->have_posts() ):
		while( $loop->have_posts() ): $loop->the_post();

			//get content material for svg popup
			$region_title = the_title('','',false);
			$region_content = wp_trim_excerpt(get_the_excerpt());
			$popup_content_array[$region_title] = $region_content;

			get_template_part('/templates/cpt-parts/part', 'ecoregion');

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
			<img id="region-png" src="/media/ODFW_ecoregion_final_base.png"/>
			<object id="regions" data="/media/ODFW_ecoregion_final_clean.svg" type="image/svg+xml"></object>
		</div>
	</div>

</section>
