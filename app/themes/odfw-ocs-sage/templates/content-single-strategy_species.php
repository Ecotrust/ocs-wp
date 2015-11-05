<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
	  <h1 class="entry-title"><?php the_title(); ?> </h1>
		<?php $the_field = get_post_meta( get_the_ID(), 'species_meta_species-scientific-name', true ); ?>
		<?php if ( !empty($the_field) ): ?>
			<small>
				<?php echo esc_html( $the_field ); ?>
			</small>
		<?php endif; ?>
    </header>

    <?php $the_compass_field = get_post_meta( get_the_ID(), 'species_meta_compass-link', true );
        if ( ! empty($the_compass_field) ): ?>
            <div class="compass main">
                <div class="compass-frame">
                    <span class="compass-close"></span>
                    <?php the_odfw_compass_iframe($the_compass_field); ?>
                </div>
            </div>
    <?php endif; ?>
    
    <div class="entry-content">

	<figure class="species-hero">
		<?php $the_field = get_post_meta( get_the_ID(), 'species_meta_image', true ); ?>
		<?php if ( !empty($the_field) ): ?>
			<img src="<?php echo esc_html( $the_field ); ?>">
		<?php else: ?>
			<img src="http://placehold.it/492x354/58595B/ffffff?text=species+placeholder">
		<?php endif; ?>

		<?php $the_field = get_post_meta( get_the_ID(), 'species_meta_image-attribution', true );?>
		<?php if ( !empty($the_field) ): ?>
			<figcaption>
				<?php echo esc_html( $the_field ); ?>
			</figcaption>
		<?php endif; ?>
	</figure>

      <?php the_content(); ?>


<section class="cmb2-wrap-text species_meta_species-common-name">
    <h3>Species Common Name</h3>

    <p class="cmb2-text">
        <?php $the_field = get_post_meta( get_the_ID(), 'species_meta_species-common-name', true );
        echo esc_html( $the_field ); ?>
    </p>
</section>



<section class="cmb2-wrap-text species_meta_species-scientific-name">
    <h3>Species Scientific Name</h3>

    <p class="cmb2-text">
        <?php $the_field = get_post_meta( get_the_ID(), 'species_meta_species-scientific-name', true );
        echo esc_html( $the_field ); ?>
    </p>
</section>



<?php $cats = get_the_terms($post->ID, 'species');
	//only need this one for fish, catID=19
	if ( $cats[0]->term_id==19 ):
?>
		<section class="cmb2-wrap-text species_meta_species-group">
			<h3>SMU/ESU/DPS/Group</h3>

			<p class="cmb2-text">
				<?php $the_field = get_post_meta( get_the_ID(), 'species_meta_species-group', true );
				echo esc_html( $the_field ); ?>
			</p>
		</section>
	<?php endif; ?>




<section class="cmb2-wrap-text species_meta_federal-listing-status">
    <h3>Federal listing status</h3>

    <p class="cmb2-text">
        <?php $the_field = get_post_meta( get_the_ID(), 'species_meta_federal-listing-status', true );
        echo esc_html( $the_field ); ?>
    </p>
</section>



<section class="cmb2-wrap-text species_meta_state-listing-status">
    <h3>State listing status</h3>

    <p class="cmb2-text">
        <?php $the_field = get_post_meta( get_the_ID(), 'species_meta_state-listing-status', true );
        echo esc_html( $the_field ); ?>
    </p>
</section>



<section class="cmb2-wrap-custom_attached_posts species_meta_attached_ecoregions">
    <h3>Associated Ecoregions</h3>

    <ul class="associated-ecoregions">
		<?php
			// Some of these were stored as a string(single), some as an array (on CSV import)
			$the_ecoregions = get_post_meta( get_the_ID(), 'species_meta_attached_ecoregions', true );
			// so let's make sure it's an array
			$the_ecoregions_array = is_array($the_ecoregions) ? $the_ecoregions : explode(",", $the_ecoregions);

			// Get the associated ecoregion names
			$args = array(
				'post_type' => 'ecoregion',
				'post__in' => $the_ecoregions_array,
				'orderby' => 'date',
				'order' => 'ASC',
				'posts_per_page'=> '30', // -1 == show all
			);

				$loop = new WP_Query( $args ); ?>

		<?php


	if( $loop->have_posts() ):
		while( $loop->have_posts() ): $loop->the_post();

		global $post; ?>

			<li><a id="<?= $post->ID; ?>" href="/ecoregion/<?= $post->post_name; ?>"><?= $post->post_title; ?></a></li>

		<?php

		endwhile;
	endif;
/* Restore original Post Data */
wp_reset_postdata();
?>

    </ul>
</section>



<section class="cmb2-wrap-textarea species_meta_special-needs">
    <h3>Special needs</h3>

    <p class="cmb2-textarea">
        <?php $the_field = get_post_meta( get_the_ID(), 'species_meta_special-needs', true );
        echo esc_html( $the_field ); ?>
    </p>
</section>



<section class="cmb2-wrap-textarea species_meta_limiting-factors">
    <h3>Limiting factors</h3>

    <p class="cmb2-textarea">
        <?php $the_field = get_post_meta( get_the_ID(), 'species_meta_limiting-factors', true );
        echo esc_html( $the_field ); ?>
    </p>
</section>



<section class="cmb2-wrap-textarea species_meta_data-gaps">
    <h3>Data gaps</h3>

    <p class="cmb2-textarea">
        <?php $the_field = get_post_meta( get_the_ID(), 'species_meta_data-gaps', true );
        echo esc_html( $the_field ); ?>
    </p>
</section>



<section class="cmb2-wrap-textarea species_meta_conservation-actions">
    <h3>Conservation actions</h3>

    <p class="cmb2-textarea">
        <?php $the_field = get_post_meta( get_the_ID(), 'species_meta_conservation-actions', true );
        echo esc_html( $the_field ); ?>
    </p>
</section>



<section class="cmb2-wrap-textarea species_meta_key-reference">
    <h3>Key reference or plan</h3>

    <p class="cmb2-textarea">
        <?php $the_field = get_post_meta( get_the_ID(), 'species_meta_key-reference', true );
        echo esc_html( $the_field ); ?>
    </p>
</section>



<section class="cmb2-wrap-text_url species_meta_image-thumb-url">
    <h3>Full URL to Thumbnail Image</h3>

    <p class="cmb2-text_url">
        <?php $the_field = get_post_meta( get_the_ID(), 'species_meta_image-url', true );
        echo esc_html( $the_field ); ?>
    </p>
</section>


    </div>

	<?php get_template_part('templates/content', 'success-story'); ?>

  </article>

<?php endwhile; ?>
