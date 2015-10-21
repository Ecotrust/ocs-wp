<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>
    <div class="entry-content">

      <?php the_content(); ?>

<section class="cmb2-wrap-group goals_and_actions_repeat_group">
    <h2>Goals and Actions</h2>

    <div class="cmb2-group">
        <?php $the_field = get_post_meta( get_the_ID(), 'goals_and_actions_repeat_group', true );

if ( ! empty ($the_field) ):
        foreach($the_field as $entries => $entry ) { ?>
            <h3><?php echo esc_html($entry['kci_goal_title']); ?></h3>
            <p><?php echo wpautop($entry['kci_actions']); ?></p>

		<?php
		}
endif;
?>
    </div>
</section>

	<?php $the_compass_field = get_post_meta( get_the_ID(), '_strategy_habitat_meta_compass-link', true );
		if ( ! empty($the_compass_field) ): ?>
			<?php the_odfw_compass_iframe($the_compass_field); ?>
	<?php endif; ?>

    </div>
  </article>
<?php endwhile; ?>
