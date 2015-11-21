<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>

	<?php $the_compass_field = get_post_meta( get_the_ID(), '_strategy_habitat_meta_compass-link', true );
		if ( ! empty($the_compass_field) ): ?>
			<div class="compass main">
				<div class="compass-container">                 
				    <span class="compass-close">
				        <i class="glyphicon glyphicon-remove-circle"></i>
				    </span>
				    <div class="view-external-compass">
				        <a href="<?php echo external_odfw_compass_url($the_compass_field) ?>"  target="_blank">
				            <i class="glyphicon glyphicon-dashboard"></i> 
				            VIEW DATA LAYERS IN COMPASS
				        </a>
				    </div>
				    <?php the_odfw_compass_iframe($the_compass_field); ?>
				</div>
			</div>
	<?php endif; ?>

    <div class="entry-content">
		
	  <?php get_template_part('templates/featured-thumbnail'); ?>
      <?php the_content(); ?>



		<section class="cmb2-wrap-textarea _strategy_habitat_meta_ecoregions">
			<h2>Ecoregions</h2>

			<p class="cmb2-textarea">
				<?php $the_field = get_post_meta( get_the_ID(), '_strategy_habitat_meta_ecoregions', true );
				echo esc_html( $the_field ); ?>
			</p>
		</section>



		<section class="cmb2-wrap-wysiwyg _strategy_habitat_meta_characteristics">
			<h2>Characteristics</h2>

			<div class="cmb2-wysiwyg">
				<?php $the_field = get_post_meta( get_the_ID(), '_strategy_habitat_meta_characteristics', true );
				echo wpautop( $the_field ); ?>
			</div>
		</section>



		<section class="cmb2-wrap-group ecoregional_characteristics_repeat_group">
			<h2>Ecoregional Characteristics</h2>

			<div class="cmb2-group">
				<?php $the_field = get_post_meta( get_the_ID(), 'ecoregional_characteristics_repeat_group', true );
				if ( !empty( $the_field ) ):
					foreach($the_field as $entries => $entry ) :
						$assoc_ecoregion = get_post($entry['_strategy_habitat_meta_related_ecoregion']);
				?>
						<h3><?php echo $assoc_ecoregion->post_title;?></h3>
						<?php $characteristics = $entry['_strategy_habitat_meta_selected_ecoregional_characteristics'];
						if ( ! empty( $characteristics ) ) : ?>
							<p><?php echo wpautop($characteristics); ?></p>
				<?php
						endif;
					endforeach;
				endif;
				?>
			</div>
		</section>



		<section class="cmb2-wrap-wysiwyg _strategy_habitat_meta_conservation_overview">
			<h2>Conservation Overview</h2>

			<div class="cmb2-wysiwyg">
				<?php $the_field = get_post_meta( get_the_ID(), '_strategy_habitat_meta_conservation_overview', true );
				echo wpautop( $the_field ); ?>
			</div>
		</section>



		<section class="cmb2-wrap-title _strategy_habitat_meta_limiting_factors">
			<h2>Limiting Factors</h2>

			<p class="cmb2-title">
				<?php $the_field = get_post_meta( get_the_ID(), '_strategy_habitat_meta_limiting_factors', true );
				echo esc_html( $the_field ); ?>
			</p>
		</section>



		<section class="cmb2-wrap-group factors_repeat_group">

			<div class="cmb2-group">
				<?php $the_field = get_post_meta( get_the_ID(), 'factors_repeat_group', true );
				if ( ! empty( $the_field ) ) :
				foreach($the_field as $entries => $entry ) : ?>
					<h3><?php echo $entry['_strategy_habitat_meta_factor_title'];?></h3>
					<p><?php echo $entry['_strategy_habitat_meta_factor_description'];?></p>
					<h4>Approach</h4>
					<p><?php echo $entry['_strategy_habitat_meta_approach'];?></p>
				<?php endforeach; endif; ?>
			</div>
		</section>



		<section class="cmb2-wrap-wysiwyg _strategy_habitat_meta_resources">
			<h2>Resources for more information</h2>

			<div class="cmb2-wysiwyg">
				<?php $the_field = get_post_meta( get_the_ID(), '_strategy_habitat_meta_resources', true );
				echo wpautop( $the_field ); ?>
			</div>
		</section>

    </div>

	<?php get_template_part('templates/content', 'success-story'); ?>

  </article>


<?php endwhile; ?>

<pre>
   <?php
   // WP makes posts with the type "attachment" for media objects
   // name, description and caption are stored in the post object
   // $att = get_post( get_post_thumbnail_id() );
   // print_r($att);

   // Alt, attribution name and attribution url are stored as meta for that attachement post object
   // $meta = get_post_meta( get_post_thumbnail_id() );
   // print_r($meta);

   $args = array(
   	'post_type'   => 'attachment',
   	'numberposts' => -1,
   	'post_status' => 'published',
   	'post_parent' => $post->ID,
    'exclude' => get_post_thumbnail_id()
   );

   $attachments = get_posts( $args );

   // output example
   if ( $attachments ) {
   	foreach ( $attachments as $thumbnail ) {
            
        echo "<figure>" .wp_get_attachment_image( $content, 'medium' ) ."</figure>";
	   echo $thumbnail->post_title . "<br>";
	   echo $thumbnail->post_excerpt . "<br>";
	   echo $thumbnail->post_content . "<br>";
	   echo get_post_meta( $thumbnail->ID, '_wp_attachment_image_alt', true ) . "<br>";
	   echo get_post_meta( $thumbnail->ID, 'odfw-attribution-name', true ) . "<br>";
	   echo get_post_meta( $thumbnail->ID, 'odfw-attribution-url', true ) . "<br>";
	}
}

   ?>
   </pre>



