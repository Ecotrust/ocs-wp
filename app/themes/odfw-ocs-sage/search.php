<?php get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
  <h3>No results found for <mark><?php the_search_query(); ?></mark>.</h3>
  <ul>
      <li>Make sure all words are spelled correctly</li>
      <li>Simplify your search: try fewer or more general keywords</li>
      <li>Use keywords that reflect words or phrases likely to be in the text of the item you are seeking</li>
  </ul>
<?php else: ?>
	<h1 class="search-results-header">
		We found <?php echo $wp_query->found_posts; ?> search results for
		<mark><?php the_search_query(); ?></mark>.
	</h1>
<?php endif; ?>
<?php
/*
<pre>
<?php print_r($wp_query); ?>
</pre>



/**
 * Search Results
 *
 * Results are pre-sorted in site-plugin/modules/odfw-search.php
 * First, anything with the search term in the title
 * Second, the rest by post_type
 *
 * But it comes out as a flat array.
 *
 * Here we use $post->relevance_score as a proxy for the 'in title' section. Relevanssi
 * marks posts with the term in the title as 'highly' relevant
 *
 * Should probably actually output different containers for each section and include
 * the post_type as a title. For now, we'll short cut it with some CSS and psuedo selectors
 *
 * Create the containers for the 'in-title' section, only the first time
 *
 */
$inTitle = false;
$hadTitles = false;
$theRest = false;
$count = 0;
$term = get_search_query();
?>
	<section class="search-results-wrap listings-wrap list-layout ">

		<?php while (have_posts()) : the_post(); ?>

		<?php
		/**
		 * Create the containers for the 'in-title' section, only the first time
		 * $post->relevance_score is a proxy for in-title
		 */

		if ( $post->relevance_score > 1000 && $inTitle==false){
			echo '<div class="in-title-section">';
			echo '<h2 class="search-section-label">Content featuring <mark>' . $term . '</mark>:</h2>';
			$inTitle = true;
			$hadTitles = true;
		} elseif( $post->relevance_score < 1001 && $theRest==false && $hadTitles==true ){
			//no longer over 1000? Close and start the next div
			echo '</div>';
			echo '<div class="the-rest-section">';
			echo '<h2 class="search-section-label">Addtional content related to <mark>' . $term . '</mark>:</h2>';
			$theRest = true;
		}
		$count++;
		?>

		  <?php get_template_part('templates/content', 'search'); ?>

		<?php
		// close it out if we've count++'d to the total number of found_posts
		if ($count == $wp_query->found_posts && $hadTitles==true):
			echo '</div>';
		endif; ?>
		<?php endwhile; ?>

	</section>

<?php the_posts_navigation(); ?>
