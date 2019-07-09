<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title" tabindex="6"><?php the_title(); ?></h1>
    </header>

    <?php $the_compass_field = get_post_meta( get_the_ID(), 'ecoregion_meta_compass-link', true );
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
		<section>
			<h2>Description</h2>
			<?php the_content(); ?>
		</section>

		<section class="ecoregion-characteristics-title">
			<h2>Characteristics</h3>

			<?php $the_field = get_post_meta( get_the_ID(), 'ecoregion_meta_ecoregion-map', true ); ?>
			<div class="image-container">
				<img class="img-responsive ecoregion-map" src="<?php echo esc_html( $the_field ); ?>">
			</div>

			<?php $the_field = get_post_meta( get_the_ID(), 'ecoregion_meta_important-industries', true );
			if ( !empty ($the_field) ): ?>
			<h5>Important Industries</h5>
			<p class="cmb2-textarea_small">
				<?php echo apply_filters( 'the_content', $the_field ); ?>
			</p>
			<?php endif; ?>

			<?php $the_field = get_post_meta( get_the_ID(), 'ecoregion_meta_major-crops', true );
			if ( !empty ($the_field) ): ?>
			<h5>Major Crops</h5>
			<p class="cmb2-textarea_small">
				<?php echo apply_filters( 'the_content', $the_field ); ?>
			</p>
			<?php endif; ?>

			<?php $the_field = get_post_meta( get_the_ID(), 'ecoregion_meta_recreational-areas', true );
			if ( !empty ($the_field) ): ?>
			<h5>Important Nature-based Recreational Areas</h5>
			<p class="cmb2-textarea_small">
				<?php echo apply_filters( 'the_content', $the_field ); ?>
			</p>
			<?php endif; ?>

			<?php $the_field = get_post_meta( get_the_ID(), 'ecoregion_meta_elevation', true );
			if ( !empty ($the_field) ): ?>
			<h5>Elevation</h5>
			<p class="cmb2-text">
				<?php echo apply_filters( 'the_content', $the_field ); ?>
			</p>
			<?php endif; ?>

			<?php $the_field = get_post_meta( get_the_ID(), 'ecoregion_meta_number-of-species', true );
			if ( !empty ($the_field) ): ?>
			<h5>Number of Vertebrate Wildlife Species</h5>
			<p class="cmb2-text">
				<?php echo apply_filters( 'the_content', $the_field ); ?>
			</p>
			<?php endif; ?>

			<?php $the_field = get_post_meta( get_the_ID(), 'ecoregion_meta_rivers', true );
			if ( !empty ($the_field) ): ?>
			<h5>Important Rivers</h5>
			<?php echo apply_filters( 'the_content', $the_field ); ?>
			<?php endif; ?>

			<?php $the_field = get_post_meta( get_the_ID(), 'ecoregion_meta_outstanding', true );
			if ( !empty ($the_field) ): ?>
			<h5>Ecologically Outstanding Areas</h5>
			<p class="cmb2-textarea_small">
				<?php echo apply_filters( 'the_content', $the_field ); ?>
			</p>
			<?php endif; ?>

		</section>



		<section class="cmb2-wrap-title ecoregion_meta_ecoregions">
			<h2>Conservation Issues and Priorities</h2>

			<p class="cmb2-title">
				<?php $the_field = get_post_meta( get_the_ID(), 'ecoregion_meta_ecoregions', true );
				echo esc_html( $the_field ); ?>
			</p>

			<div class="cmb2-wysiwyg">
				<?php $the_field = apply_filters('the_content', get_post_meta( get_the_ID(), 'ecoregion_meta_conservation-issues-overview', true ));
				echo wpautop( apply_filters('the_content', $the_field ) ); ?>
			</div>
		</section>


		<section class="cmb2-wrap-group factors_repeat_group">
  		<?php $the_field = get_post_meta( get_the_ID(), 'factors_repeat_group', true );
			if ( !empty($the_field) ): ?>
				<h2>Limiting Factors and Recommended Approaches</h2>
        <div class="cmb2-group">
  				<?php foreach($the_field as $entries => $entry ) { ?>
  					<h3>Limiting Factor: <?php echo apply_filters('the_content', $entry['ecoregion_meta_factor_title']);?></h3>
  					<p><?php echo apply_filters('the_content', $entry['ecoregion_meta_factor_description']);?></p>
  					<h4>Recommended Approach</h4>
  					<p><?php echo apply_filters('the_content', $entry['ecoregion_meta_approach']);?></p>
  				<?php } ?>
				</div>
			<?php endif; ?>
		</section>


		<section class="associated-species listings-wrap">

			<h2>Strategy Species</h2>

			<div class="grid-layout">

			<?php
				Roots\Sage\CPT\ocs_list_ecoregion_associated_species( get_the_ID() );
			?>

			</div>
		</section>


		<section class="associated-species listings-wrap">

			<h2>Conservation Opportunity Areas</h2>

			<div class="grid-layout">

			<?php
				Roots\Sage\CPT\ocs_list_ecoregion_associated_COA( get_the_ID() );
			?>

			</div>
		</section>

		<?php
/*
 * coa_meta_attached_ecoregions
 *
 *
 * species_meta_attached_ecoregions
 *
 * */


?>
		<?php get_template_part('templates/content', 'success-story'); ?>

    </div>
  </article>


<?php endwhile; ?>
