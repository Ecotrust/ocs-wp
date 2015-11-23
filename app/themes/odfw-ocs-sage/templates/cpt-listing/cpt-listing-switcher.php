<?php


/*
 *
 *
 *
 * THERE IS A STASH WITH MORE OF THIS STUFF
 *
 *
 *
 *
 *
 */
	$currentPage = get_the_ID();

	// CPT listings
	$cptListingPages = array(
		"99" => "kci",  // KCIs
		"101" => "ecoregion", // Ecoregions
		"102" => "coa",// COAs
		"105" => "strategy_habitat", // Strategy Habitats
		/*
		109, // Strategy Species Parent Page
		110, //Birds
		111, //Mammals
		112, //Amphibians
		113, //Reptiles
		114, //Fish
		115, //Invertebrates
		116, //Plants and Algae
		*/
	);

	// Strategy Species sub pages
	$species_sub_pages = array(
		110, //Birds
		111, //Mammals
		112, //Amphibians
		113, //Reptiles
		114, //Fish
		115, //Invertebrates
		116, //Plants and Algae
	);

/*
 *
 *
 *
 *
 *
 * THERE IS A STASH WITH MORE OF THIS STUFF
 *
 *
 *
 *
 *
 */

?>


<section class="listings-wrap">

<article <?php post_class(); ?>>
<!--
if id = 109 (species parent page) :
	$species_pages = get_pages(
		array(
			'child_of'=>$post->ID,
			'exclude' => $non_species_pages
		)
	);

		foreach( $species_pages as $page ) :
elseif (in_array($currentPage, $species_sub_pages)
	//special subloop from cpt-strategy species
else :
$cpt = $cptListingPages[$currentPage];

-->

<?php
$cpt = $cptListingPages[$currentPage];
echo "<h2>cpt = " . $cpt . "</h2>";
echo "<hr><hr><br><hr><br>";

	$args = array(
		'post_type' => $cpt,
		'orderby' => 'title',
		'order' => 'ASC',
		'posts_per_page'=> '100', // -1 == show all
	);

	$loop = new WP_Query( $args );

	$count = 0;

	if( $loop->have_posts() ):
		while( $loop->have_posts() ): $loop->the_post();

			global $post;
/*
 *
 *
 *
 *
 *
 * THERE IS A STASH WITH MORE OF THIS STUFF
 *
 *
 *
 *
 *
 */

?>

		<div id="coa-item-<?php echo $post->ID; ?>" class="">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail('small'); ?>
				<h3><?php the_title(); ?></h3>
				<p><?php the_excerpt(); ?></h3>
			</a>
		</div>

<?php
			$count++;

		endwhile;
	endif;

?>
</article>
</section>
