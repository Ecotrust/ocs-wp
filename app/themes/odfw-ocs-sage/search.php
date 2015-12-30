<?php get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
  <h3>No results matched your search terms.</h3>
  <ul>
      <li>Make sure all words are spelled correctly</li>
      <li>Simplify your search: try fewer or more general keywords</li>
      <li>Use keywords that reflect words or phrases likely to be in the text of the item you are seeking</li>
  </ul>
<?php else: ?>
    <h1 class="search-results">SEARCH RESULTS:</h1>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'search'); ?>
<?php endwhile; ?>

<?php the_posts_navigation(); ?>
