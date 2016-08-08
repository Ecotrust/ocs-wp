<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title" tabindex="6"><?php the_title(); ?></h1>
    </header>

	<?php $the_compass_field = get_post_meta( get_the_ID(), '_strategy_habitat_meta_compass-link', true );
		if ( ! empty($the_compass_field) ): ?>
			<?php include(locate_template('templates/compass-view.php')); ?>
	<?php endif; ?>

    <div class="entry-content">

	  <?php get_template_part('templates/featured-thumbnail'); ?>
      <?php the_content(); ?>



		<section class="cmb2-wrap-textarea _strategy_habitat_meta_ecoregions">
			<h2>Ecoregions</h2>

			<p class="cmb2-textarea">
				<?php $the_field = get_post_meta( get_the_ID(), '_strategy_habitat_meta_ecoregions', true );
				echo wpautop( $the_field ); ?>
			</p>
		</section>



		<section class="cmb2-wrap-wysiwyg _strategy_habitat_meta_characteristics">
			<h2>Characteristics</h2>

			<div class="cmb2-wysiwyg">
				<?php $the_field = get_post_meta( get_the_ID(), '_strategy_habitat_meta_characteristics', true );
				echo wpautop( apply_filters('the_content', $the_field ) ); ?>
			</div>
		</section>



		<?php $the_field = get_post_meta( get_the_ID(), 'ecoregional_characteristics_repeat_group', true );
		// strlen Hack. These fields don't have a blank option so they all default to Blue Mountains. Oops!
		// Let's make sure something is meant to be there by ensuring it's longer than the default storage
		// length of a single ecoregion with no text (a two digit ecoregion id).
		// a:1:{i:0;a:1:{s:40:"_strategy_habitat_meta_related_ecoregion";s:2:"57";}}

		$the_field_length = strlen( implode('', $the_field[0] ) );
		if ( !empty( $the_field ) && $the_field_length > 2 ): ?>
		<section class="cmb2-wrap-group ecoregional_characteristics_repeat_group">
			<h2>Ecoregional Characteristics</h2>

			<div class="cmb2-group">
				<?php
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
				?>
			</div>
		</section>
		<?php endif; ?>



		<section class="cmb2-wrap-wysiwyg _strategy_habitat_meta_conservation_overview">
			<h2>Conservation Overview</h2>

			<div class="cmb2-wysiwyg">
				<?php $the_field = get_post_meta( get_the_ID(), '_strategy_habitat_meta_conservation_overview', true );
				echo wpautop( apply_filters('the_content', $the_field ) ); ?>
			</div>
		</section>



		<section class="cmb2-wrap-group factors_repeat_group">

			<h2>Limiting Factors and Recommended Approaches</h2>

			<div class="cmb2-group">
				<?php $the_field = get_post_meta( get_the_ID(), 'factors_repeat_group', true );
				if ( ! empty( $the_field ) ) :
				foreach($the_field as $entries => $entry ) : ?>
					<h3>Limiting Factor: <?php echo $entry['_strategy_habitat_meta_factor_title'];?></h3>
					<p><?php echo $entry['_strategy_habitat_meta_factor_description'];?></p>
					<h4>Recommended Approach</h4>
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

	<?php get_template_part('templates/content', 'success-story'); ?>

    </div>


  </article>


<?php endwhile; ?>
