<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class('single'); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>
    <div class="entry-content">
      <?php get_template_part('templates/featured-thumbnail'); ?>
      <?php the_content(); ?>
    </div>
    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>

	<?php get_template_part('templates/content', 'success-story'); ?>

  </article>


<?php endwhile; ?>
