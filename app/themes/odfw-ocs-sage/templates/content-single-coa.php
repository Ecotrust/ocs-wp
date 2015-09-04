<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>
    <div class="entry-content">

      <?php the_content(); ?>


<section class="cmb2-wrap-text coa_meta_id">
    <h3>COA ID</h3>

    <p class="cmb2-text">
        <?php $the_field = get_post_meta( get_the_ID(), 'coa_meta_id', true );
        echo esc_html( $the_field ); ?>
    </p>
</section>



<section class="cmb2-wrap-custom_attached_posts coa_meta_attached_ecoregions">
    <h3>Associated Ecoregions</h3>

    <p class="cmb2-custom_attached_posts">
        <?php $the_field = get_post_meta( get_the_ID(), 'coa_meta_attached_ecoregions', true );
        echo esc_html( $the_field ); ?>
    </p>
</section>



<section class="cmb2-wrap-textarea coa_meta_name-Description">
    <h3>COA Description</h3>

    <p class="cmb2-textarea">
        <?php $the_field = get_post_meta( get_the_ID(), 'coa_meta_name-Description', true );
        echo esc_html( $the_field ); ?>
    </p>
</section>



<section class="cmb2-wrap-text coa_meta_key-habitats">
    <h3>Key Habitats</h3>

    <p class="cmb2-text">
        <?php $the_field = get_post_meta( get_the_ID(), 'coa_meta_key-habitats', true );
        echo esc_html( $the_field ); ?>
    </p>
</section>



<section class="cmb2-wrap-text coa_meta_key-species">
    <h3>Key Species</h3>

    <p class="cmb2-text">
        <?php $the_field = get_post_meta( get_the_ID(), 'coa_meta_key-species', true );
        echo esc_html( $the_field ); ?>
    </p>
</section>



<section class="cmb2-wrap-text coa_meta_kci-connections">
    <h3>KCI Connections</h3>

    <p class="cmb2-text">
        <?php $the_field = get_post_meta( get_the_ID(), 'coa_meta_kci-connections', true );
        echo esc_html( $the_field ); ?>
    </p>
</section>



<section class="cmb2-wrap-pw_multiselect coa_meta_species">
    <h3>Select Species</h3>

    <p class="cmb2-pw_multiselect">
        <?php $the_field = get_post_meta( get_the_ID(), 'coa_meta_species', true );
        echo esc_html( $the_field ); ?>
    </p>
</section>



<section class="cmb2-wrap-custom_attached_posts coa_meta_attached_habitats">
    <h3>Associated Strategy Habitats</h3>

    <p class="cmb2-custom_attached_posts">
        <?php $the_field = get_post_meta( get_the_ID(), 'coa_meta_attached_habitats', true );
        echo esc_html( $the_field ); ?>
    </p>
</section>



<section class="cmb2-wrap-textarea_small coa_meta_recommended-conservation-actions">
    <h3>Recommended Conservation Actions</h3>

    <p class="cmb2-textarea_small">
        <?php $the_field = get_post_meta( get_the_ID(), 'coa_meta_recommended-conservation-actions', true );
        echo esc_html( $the_field ); ?>
    </p>
</section>




		<?php
			$the_compass_field = get_post_meta( get_the_ID(), '_strategy_habitat_meta_compass-link', true );
				if ( ! empty($the_compass_field) ): ?>
					<?php Roots\Sage\Extras\the_odfw_compass_iframe($the_compass_field); ?>
			<?php endif; ?>


    </div>
  </article>
<?php endwhile; ?>
