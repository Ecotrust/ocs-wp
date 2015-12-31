<?php while (have_posts()) : the_post(); ?>

  <article <?php post_class('single'); ?>>

    <header>
      <h1  tabindex="6" class="entry-title"><?php the_title(); ?></h1>
    </header>

    <div class="entry-content">
      <?php get_template_part('templates/featured-thumbnail'); ?>
      <?php the_content(); ?>
	  <?php get_template_part('templates/content', 'success-story'); ?>
    </div>

  </article>

<?php endwhile; ?>
