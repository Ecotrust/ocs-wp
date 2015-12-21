<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>
    <div class="entry-content">
      <?php get_template_part('templates/featured-thumbnail'); ?>
      <?php the_content(); ?>

	<?php get_template_part('templates/content', 'success-story'); ?>

    </div>

  </article>

<?php endwhile; ?>

<?php $the_compass_field = get_post_meta( get_the_ID(), 'kci_meta_compass-link', true );
  if ( ! empty($the_compass_field) ): ?>
    <?php include(locate_template('templates/compass-view.php')); ?>
<?php endif; ?>