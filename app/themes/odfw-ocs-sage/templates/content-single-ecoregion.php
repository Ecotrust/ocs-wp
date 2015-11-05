<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>

    <?php $the_compass_field = get_post_meta( get_the_ID(), 'ecoregion_meta_compass-link', true );
        if ( ! empty($the_compass_field) ): ?>
            <div class="compass main">
            	<div class="compass-frame">
            		<span class="compass-close">
            			<i class="glyphicon glyphicon-remove-sign"></i>
            		</span>
        			<?php the_odfw_compass_iframe($the_compass_field); ?>
        		</div>
        	</div>
    <?php endif; ?>

    <div class="entry-content">

		<?php the_content(); ?>


		<section class="ecoregion-characteristics-title">
			<?php //<h3>"At a glance" Characteristics and Statistics</h3> ?>
			<h2>Description</h2>



<?php // @TODO Needs better formatting. Table or DL or something ?>

			<section class="cmb2-wrap-textarea_small ecoregion_meta_important-industries">
				<h3>Important industries</h3>

				<p class="cmb2-textarea_small">
					<?php $the_field = get_post_meta( get_the_ID(), 'ecoregion_meta_important-industries', true );
					echo esc_html( $the_field ); ?>
				</p>
			</section>



			<section class="cmb2-wrap-textarea_small ecoregion_meta_major-crops">
				<h3>Major crops</h3>

				<p class="cmb2-textarea_small">
					<?php $the_field = get_post_meta( get_the_ID(), 'ecoregion_meta_major-crops', true );
					echo esc_html( $the_field ); ?>
				</p>
			</section>



			<section class="cmb2-wrap-textarea_small ecoregion_meta_recreational-areas">
				<h3>Important nature-based recreational areas</h3>

				<p class="cmb2-textarea_small">
					<?php $the_field = get_post_meta( get_the_ID(), 'ecoregion_meta_recreational-areas', true );
					echo esc_html( $the_field ); ?>
				</p>
			</section>



			<section class="cmb2-wrap-text ecoregion_meta_elevation">
				<h3>Elevation</h3>

				<p class="cmb2-text">
					<?php $the_field = get_post_meta( get_the_ID(), 'ecoregion_meta_elevation', true );
					echo esc_html( $the_field ); ?>
				</p>
			</section>



			<section class="cmb2-wrap-text ecoregion_meta_number-of-species">
				<h3>Number of vertebrate wildlife species</h3>

				<p class="cmb2-text">
					<?php $the_field = get_post_meta( get_the_ID(), 'ecoregion_meta_number-of-species', true );
					echo esc_html( $the_field ); ?>
				</p>
			</section>



			<section class="cmb2-wrap-textarea_small ecoregion_meta_rivers">
				<h3>Important rivers</h3>

				<p class="cmb2-textarea_small">
					<?php $the_field = get_post_meta( get_the_ID(), 'ecoregion_meta_rivers', true );
					echo esc_html( $the_field ); ?>
				</p>
			</section>



			<section class="cmb2-wrap-textarea_small ecoregion_meta_outstanding">
				<h3>Ecologically outstanding areas</h3>

				<p class="cmb2-textarea_small">
					<?php $the_field = get_post_meta( get_the_ID(), 'ecoregion_meta_outstanding', true );
					echo esc_html( $the_field ); ?>
				</p>
			</section>

		</section>



		<section class="cmb2-wrap-title ecoregion_meta_ecoregions">
			<h3>Conservation Issues and Priorities</h3>

			<p class="cmb2-title">
				<?php $the_field = get_post_meta( get_the_ID(), 'ecoregion_meta_ecoregions', true );
				echo esc_html( $the_field ); ?>
			</p>
		</section>



		<section class="cmb2-wrap-wysiwyg ecoregion_meta_conservation-issues-overview">
			<h3>Overview</h3>

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
					<h3><?php echo $entry['ecoregion_meta_factor_title'];?></h3>
					<h4>Description:</h4>
					<p><?php echo $entry['ecoregion_meta_factor_description'];?></p>
					<h4>Approach</h4>
					<p><?php echo $entry['ecoregion_meta_approach'];?></p>

				<?php } ?>
			</div>
		</section>



		<?php get_template_part('templates/content', 'success-story'); ?>

    </div>
  </article>


<?php endwhile; ?>
