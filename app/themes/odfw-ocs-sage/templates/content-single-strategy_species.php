<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>

    <header>
	  <h1 class="entry-title" tabindex="6"><?php the_title(); ?> </h1>
    </header>

    <?php $the_compass_field = get_post_meta( get_the_ID(), 'species_meta_compass-link', true );
        if ( ! empty($the_compass_field) ): ?>
            <?php include(locate_template('templates/compass-view.php')); ?>
    <?php endif; ?>

    <div class="entry-content">

	<figure class="species-hero">
		<?php
            $the_field = get_post_meta( get_the_ID(), 'species_meta_image-url', true );
            $the_field_thumbnail = get_post_meta( get_the_ID(), 'species_meta_image-thumb-url', true );
        ?>

		<?php if ( !empty($the_field) ): ?>
            <div class="image-container">
                <span class="photo-info show-info glyphicon glyphicon-info-sign"></span>
			    <img src="<?php echo esc_html( $the_field ); ?>">
            </div>
        <?php elseif ( !empty($the_field_thumbnail) ): ?>
            <div class="image-container">
                <span class="photo-info show-info glyphicon glyphicon-info-sign"></span>
                <img src="<?php echo esc_html( $the_field_thumbnail ); ?>">
            </div>
		<?php else: ?>
            <div class="image-container">
                <span class="photo-info"></span>
			    <img src="http://placehold.it/492x354/58595B/ffffff?text=species+placeholder">
            </div>
		<?php endif; ?>

		<?php $the_field = get_post_meta( get_the_ID(), 'species_meta_image-attribution', true );?>
		<?php if ( !empty($the_field) ): ?>
			<figcaption>
                <span class="photo-info glyphicon glyphicon-remove-circle"></span>
				<?php echo esc_html( $the_field ); ?>
			</figcaption>
		<?php endif; ?>
	</figure>


	<?php the_content(); ?>


	<section class="species-overview">

		<h2>Overview</h2>

		<ul class="list-unstyled">

			<li><strong>Species Common Name</strong>
				<?php $the_field = get_post_meta( get_the_ID(), 'species_meta_species-common-name', true );
				echo esc_html( $the_field ); ?>
			</li>

			<li><strong>Species Scientific Name</strong><em>
				<?php $the_field = get_post_meta( get_the_ID(), 'species_meta_species-scientific-name', true );
				echo esc_html( $the_field ); ?></em>
			</li>

			<?php $the_field = get_post_meta( get_the_ID(), 'species_meta_federal-listing-status', true );
				if ( !empty($the_field) ): ?>
					<li><strong>Federal Listing Status</strong>
						<?php echo $the_field; ?>
					</li>
			<?php endif; ?>

			<?php $the_field = get_post_meta( get_the_ID(), 'species_meta_state-listing-status', true );
				if ( !empty($the_field) ): ?>
					<li><strong>State Listing Status</strong>
						<?php echo $the_field; ?>
					</li>
			<?php endif; ?>

		<?php $cats = get_the_terms($post->ID, 'species');
			//only need this one for fish, catID=19
			if ( $cats[0]->term_id==19 ): ?>
				<?php $the_field = get_post_meta( get_the_ID(), 'species_meta_species-group', true );
					if ( !empty($the_field) ): ?>
					<li><strong><abbr title="Species Management Unit for Native Fish">SMU</abbr>/<abbr title="Evolutionarily Significant Unity">ESU</abbr>/<abbr title="Distinct Population Segment">DPS</abbr>/Group</strong>
						<?php echo esc_html( $the_field ); ?>
					</li>
				<?php endif; ?>
			<?php endif; ?>

		</ul>

	</section>


	<?php Roots\Sage\CPT\ocs_list_sub_species(get_the_ID()); ?>



		<section class="associated-ecoregions listings-wrap">
			<h2 data-toggle="tooltip"  data-placement="right" title="<?php echo ocs_get_option('ss-ecoregions') ?>">Ecoregions</h2 data-toggle="tooltip"  data-placement="right" title="">

			<div class="grid-layout">
				<?php
					// Some of these were stored as a string(single), some as an array (on CSV import)
					$the_ecoregions = get_post_meta( get_the_ID(), 'species_meta_attached_ecoregions', true );
					// so let's make sure it's an array
					$the_ecoregions_array = is_array($the_ecoregions) ? $the_ecoregions : explode(",", $the_ecoregions);
					Roots\Sage\CPT\ocs_list_ecoregions($the_ecoregions_array);
				?>
			</div>
		</section>



	<?php $the_field = get_post_meta( get_the_ID(), 'species_meta_special-needs', true );
		if ( !empty($the_field) ): ?>

			<section class="cmb2-wrap-textarea species_meta_special-needs">
				<h2 data-toggle="tooltip"  data-placement="right" title="<?php echo ocs_get_option('ss-special-needs') ?>">Special needs</h2 data-toggle="tooltip"  data-placement="right" title="<?php echo ocs_get_option('ss-') ?>">

				<p class="cmb2-textarea">
					<?php echo esc_html( $the_field ); ?>
				</p>
			</section>
	<?php endif; ?>


	<?php $the_field = get_post_meta( get_the_ID(), 'species_meta_limiting-factors', true );
		if ( !empty($the_field) ): ?>

			<section class="cmb2-wrap-textarea species_meta_limiting-factors">
				<h2 data-toggle="tooltip"  data-placement="right" title="<?php echo ocs_get_option('ss-limiting-factors') ?>">Limiting factors</h2 data-toggle="tooltip"  data-placement="right" title="<?php echo ocs_get_option('ss-') ?>">

				<p class="cmb2-textarea">
					<?php echo esc_html( $the_field ); ?>
				</p>
			</section>
	<?php endif; ?>



	<?php $the_field = get_post_meta( get_the_ID(), 'species_meta_data-gaps', true );
		if ( !empty($the_field) ): ?>

			<section class="cmb2-wrap-textarea species_meta_data-gaps">
				<h2 data-toggle="tooltip"  data-placement="right" title="<?php echo ocs_get_option('ss-data-gaps') ?>">Data gaps</h2 data-toggle="tooltip"  data-placement="right" title="<?php echo ocs_get_option('ss-') ?>">

				<p class="cmb2-textarea">
					<?php echo esc_html( $the_field ); ?>
				</p>
			</section>
	<?php endif; ?>



	<?php $the_field = get_post_meta( get_the_ID(), 'species_meta_conservation-actions', true );
		if ( !empty($the_field) ): ?>
			<section class="cmb2-wrap-textarea species_meta_conservation-actions">
				<h2 data-toggle="tooltip"  data-placement="right" title="<?php echo ocs_get_option('ss-recommended-conservation-actions') ?>">Conservation actions</h2 data-toggle="tooltip"  data-placement="right" title="<?php echo ocs_get_option('ss-') ?>">

				<p class="cmb2-textarea">
					<?php echo esc_html( $the_field ); ?>
				</p>
			</section>
	<?php endif; ?>



	<?php $the_field = get_post_meta( get_the_ID(), 'species_meta_key-reference', true );
		if ( !empty($the_field) ): ?>
			<section class="cmb2-wrap-textarea species_meta_key-reference">
				<h2 data-toggle="tooltip"  data-placement="right" title="<?php echo ocs_get_option('ss-key-reference') ?>">Key reference or plan</h2 data-toggle="tooltip"  data-placement="right" title="<?php echo ocs_get_option('ss-') ?>">

				<?php //may contain links
				$linkified = preg_replace('/(http[s]{0,1}\:\/\/\S{4,})\s{0,}/ims', '<a href="$1" >$1</a> ', $the_field); ?>
				<p class="cmb2-textarea">
					<?php echo $linkified; ?>
				</p>
			</section>
	<?php endif; ?>

	<?php /*
	<section class="cmb2-wrap-text_url species_meta_image-thumb-url">
		<h2 data-toggle="tooltip"  data-placement="right" title="<?php echo ocs_get_option('ss-') ?>">Full URL to Thumbnail Image (DEVELOPMENT ONLY FIELD)</h2 data-toggle="tooltip"  data-placement="right" title="<?php echo ocs_get_option('ss-') ?>">

		<p class="cmb2-text_url">
			<?php $the_field = get_post_meta( get_the_ID(), 'species_meta_image-url', true );
			echo esc_html( $the_field ); ?>
		</p>
	</section>
	*/ ?>

	<?php get_template_part('templates/content', 'success-story'); ?>

    </div>

  </article>

<?php endwhile; ?>
