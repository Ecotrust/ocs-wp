<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>
    <div class="entry-content">
      <?php get_template_part('templates/featured-thumbnail'); ?>
      <?php the_content(); ?>

	<?php $the_compass_field = get_post_meta( get_the_ID(), '_strategy_habitat_meta_compass-link', true );
		if ( ! empty($the_compass_field) ): ?>
			<?php the_odfw_compass_iframe($the_compass_field); ?>
	<?php endif; ?>

	<?php get_template_part('templates/content', 'success-story'); ?>

    </div>

  </article>

<?php endwhile; ?>
