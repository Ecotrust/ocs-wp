<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title">Getting to know the <?php the_title(); ?> Ecoregion</h1>
    </header>
    <div class="entry-content">

      <?php the_content(); ?>


<section class="ecoregion-characteristics-title">
    <h3>"At a glance" Characteristics and Statistics</h3>




	<section class="cmb2-wrap-textarea_small ecoregion_meta_important-industries">
		<h4>Important industries</h4>

		<p class="cmb2-textarea_small">
			<?php $the_field = get_post_meta( get_the_ID(), 'ecoregion_meta_important-industries', true );
			echo esc_html( $the_field ); ?>
		</p>
	</section>



	<section class="cmb2-wrap-textarea_small ecoregion_meta_major-crops">
		<h4>Major crops</h4>

		<p class="cmb2-textarea_small">
			<?php $the_field = get_post_meta( get_the_ID(), 'ecoregion_meta_major-crops', true );
			echo esc_html( $the_field ); ?>
		</p>
	</section>



	<section class="cmb2-wrap-textarea_small ecoregion_meta_recreational-areas">
		<h4>Important nature-based recreational areas</h4>

		<p class="cmb2-textarea_small">
			<?php $the_field = get_post_meta( get_the_ID(), 'ecoregion_meta_recreational-areas', true );
			echo esc_html( $the_field ); ?>
		</p>
	</section>



	<section class="cmb2-wrap-text ecoregion_meta_elevation">
		<h4>Elevation</h4>

		<p class="cmb2-text">
			<?php $the_field = get_post_meta( get_the_ID(), 'ecoregion_meta_elevation', true );
			echo esc_html( $the_field ); ?>
		</p>
	</section>



	<section class="cmb2-wrap-text ecoregion_meta_number-of-species">
		<h4>Number of vertebrate wildlife species</h4>

		<p class="cmb2-text">
			<?php $the_field = get_post_meta( get_the_ID(), 'ecoregion_meta_number-of-species', true );
			echo esc_html( $the_field ); ?>
		</p>
	</section>



	<section class="cmb2-wrap-textarea_small ecoregion_meta_rivers">
		<h4>Important rivers</h4>

		<p class="cmb2-textarea_small">
			<?php $the_field = get_post_meta( get_the_ID(), 'ecoregion_meta_rivers', true );
			echo esc_html( $the_field ); ?>
		</p>
	</section>



	<section class="cmb2-wrap-textarea_small ecoregion_meta_outstanding">
		<h4>Ecologically outstanding areas</h4>

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
    <h2>Ecoregion-level limiting factors and recommended approaches</h2>

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




    </div>
  </article>
<?php endwhile; ?>
