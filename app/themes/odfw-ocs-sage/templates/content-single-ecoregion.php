<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
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
		<h2>Description</h2>
		<?php the_content(); ?>


		<section class="ecoregion-characteristics-title">
			<h2>Characteristics</h3>



<?php // @TODO Needs better formatting. Table or DL or something ?>

			<section class="cmb2-wrap-textarea_small ecoregion_meta_important-industries">
				<h5>IMPORTANT INDUSTRIES</h5>

				<p class="cmb2-textarea_small">
					<?php $the_field = get_post_meta( get_the_ID(), 'ecoregion_meta_important-industries', true );
					echo esc_html( $the_field ); ?>
				</p>
			</section>



			<section class="cmb2-wrap-textarea_small ecoregion_meta_major-crops">
				<h5>MAJOR CROPS</h5>

				<p class="cmb2-textarea_small">
					<?php $the_field = get_post_meta( get_the_ID(), 'ecoregion_meta_major-crops', true );
					echo esc_html( $the_field ); ?>
				</p>
			</section>



			<section class="cmb2-wrap-textarea_small ecoregion_meta_recreational-areas">
				<h5>IMPORTANT NATURE-BASED RECREATIONAL AREAS</h5>

				<p class="cmb2-textarea_small">
					<?php $the_field = get_post_meta( get_the_ID(), 'ecoregion_meta_recreational-areas', true );
					echo esc_html( $the_field ); ?>
				</p>
			</section>



			<section class="cmb2-wrap-text ecoregion_meta_elevation">
				<h5>ELEVATION</h5>

				<p class="cmb2-text">
					<?php $the_field = get_post_meta( get_the_ID(), 'ecoregion_meta_elevation', true );
					echo esc_html( $the_field ); ?>
				</p>
			</section>



			<section class="cmb2-wrap-text ecoregion_meta_number-of-species">
				<h5>NUMBER OF VERTEBRATE WILDLIFE SPECIES</h5>

				<p class="cmb2-text">
					<?php $the_field = get_post_meta( get_the_ID(), 'ecoregion_meta_number-of-species', true );
					echo esc_html( $the_field ); ?>
				</p>
			</section>



			<section class="cmb2-wrap-textarea_small ecoregion_meta_rivers">
				<h5>IMPORTANT RIVERS</h5>

				<p class="cmb2-textarea_small">
					<?php $the_field = get_post_meta( get_the_ID(), 'ecoregion_meta_rivers', true );
					echo esc_html( $the_field ); ?>
				</p>
			</section>



			<section class="cmb2-wrap-textarea_small ecoregion_meta_outstanding">
				<h5>ECOLOGICALLY OUTSTANDING AREAS</h5>

				<p class="cmb2-textarea_small">
					<?php $the_field = get_post_meta( get_the_ID(), 'ecoregion_meta_outstanding', true );
					echo esc_html( $the_field ); ?>
				</p>
			</section>

		</section>



		<section class="cmb2-wrap-title ecoregion_meta_ecoregions">
			<h2>Conservation Issues and Priorities</h2>

			<p class="cmb2-title">
				<?php $the_field = get_post_meta( get_the_ID(), 'ecoregion_meta_ecoregions', true );
				echo esc_html( $the_field ); ?>
			</p>

			<div class="cmb2-wysiwyg">
				<?php $the_field = get_post_meta( get_the_ID(), 'ecoregion_meta_conservation-issues-overview', true );
				echo wpautop( $the_field ); ?>
			</div>
		</section>





		<section class="cmb2-wrap-group factors_repeat_group">
			<h2>Limiting Factors and Recommended Approaches</h2>

			<div class="cmb2-group">
				<?php $the_field = get_post_meta( get_the_ID(), 'factors_repeat_group', true );

				foreach($the_field as $entries => $entry ) { ?>
					<h3>Limiting Factor: <?php echo $entry['ecoregion_meta_factor_title'];?></h3>
					<p><?php echo $entry['ecoregion_meta_factor_description'];?></p>
					<h5>Recommended Approach</h5>
					<p><?php echo $entry['ecoregion_meta_approach'];?></p>

				<?php } ?>
			</div>
		</section>



		<?php get_template_part('templates/content', 'success-story'); ?>

    </div>
  </article>


<?php endwhile; ?>
