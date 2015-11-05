<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>

    <?php $the_compass_field = get_post_meta( get_the_ID(), 'coa_meta_compass-link', true );
        if ( ! empty($the_compass_field) ): ?>
           <div class="compass main">
                <div class="compass-frame">
                    <span class="compass-close"></span>
                    <?php the_odfw_compass_iframe($the_compass_field); ?>
                </div>
            </div>
    <?php endif; ?>
    
    <div class="entry-content">

      <?php the_content(); ?>


<section class="cmb2-wrap-text coa_meta_id">
    <h2>COA ID</h2>

    <p class="cmb2-text">
        <?php $the_field = get_post_meta( get_the_ID(), 'coa_meta_id', true );
        echo esc_html( $the_field ); ?>
    </p>
</section>



<section class="cmb2-wrap-custom_attached_posts coa_meta_attached_ecoregions">
    <h2>Associated Ecoregions</h2>

    <p class="cmb2-custom_attached_posts">
        <?php $the_field = get_post_meta( get_the_ID(), 'coa_meta_attached_ecoregions', true );
        echo esc_html( $the_field ); ?>
    </p>
</section>



<section class="cmb2-wrap-textarea coa_meta_name-Description">
    <h2>COA Description</h2>

    <p class="cmb2-textarea">
        <?php $the_field = get_post_meta( get_the_ID(), 'coa_meta_name-Description', true );
        echo esc_html( $the_field ); ?>
    </p>
</section>



<section class="cmb2-wrap-text coa_meta_key-habitats">
    <h2>Key Habitats</h2>

    <p class="cmb2-text">
        <?php $the_field = get_post_meta( get_the_ID(), 'coa_meta_key-habitats', true );
        echo esc_html( $the_field ); ?>
    </p>
</section>



<section class="cmb2-wrap-text coa_meta_key-species">
    <h2>Key Species</h2>

    <p class="cmb2-text">
        <?php $the_field = get_post_meta( get_the_ID(), 'coa_meta_key-species', true );
        echo esc_html( $the_field ); ?>
    </p>
</section>



<section class="cmb2-wrap-text coa_meta_kci-connections">
    <h2>KCI Connections</h2>

    <p class="cmb2-text">
        <?php $the_field = get_post_meta( get_the_ID(), 'coa_meta_kci-connections', true );
        echo esc_html( $the_field ); ?>
    </p>
</section>



<section class="cmb2-wrap-pw_multiselect coa_meta_species">
    <h2>Select Species</h2>

    <p class="cmb2-pw_multiselect">
        <?php $the_field = get_post_meta( get_the_ID(), 'coa_meta_species', true );
        echo esc_html( $the_field ); ?>
    </p>
</section>



<section class="cmb2-wrap-custom_attached_posts coa_meta_attached_habitats">
    <h2>Associated Strategy Habitats</h2>

    <p class="cmb2-custom_attached_posts">
        <?php $the_field = get_post_meta( get_the_ID(), 'coa_meta_attached_habitats', true );
        echo esc_html( $the_field ); ?>
    </p>
</section>



<section class="cmb2-wrap-textarea_small coa_meta_recommended-conservation-actions">
    <h2>Recommended Conservation Actions</h2>

    <p class="cmb2-textarea_small">
        <?php $the_field = get_post_meta( get_the_ID(), 'coa_meta_recommended-conservation-actions', true );
        echo esc_html( $the_field ); ?>
    </p>
</section>


    </div>

		<?php get_template_part('templates/content', 'success-story'); ?>

  </article>


<?php endwhile; ?>
