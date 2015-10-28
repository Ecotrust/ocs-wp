
<?php

$pType = $post->post_type;
$pParent = $post->post_parent;
$menuParent = 9999999;
$title = "";

$cpts = array(
	"kci" => "99",
	"ecoregion" => "101",
	"coa" => "102",
	"strategy_habitat" => "105",
	"strategy_species" => 109
);



//Is it a regular WP page?
if ($pType != "post" && $pType != "page" && $pType != "attachment"){

	//No? Prolly a CPT. Let's look it up
	if ( !empty($cpts[$pType]) ):
		$menuParent = $cpts[$pType];
		$title = get_the_title($cpts[$pType]);
	else:
		//er, not a post, page, attachment or cpt?
	endif;

} else {
	if ( $pParent ):
		$title = get_the_title( $post->post_parent );
		$menuParent = $post->post_parent;
	else:
		$title = get_the_title( $post->ID );
		$menuParent = $post->ID;
	endif;
}

?>
<?php
$page_list = wp_list_pages("title_li=&child_of=" . $menuParent . "&echo=0");
if ($page_list) { ?>

	<nav>
		<?php if ( !empty( $title ) ): ?>
		<h2><?= $title; ?></h2>
		<?php endif; ?>
<?php
	//TODO? if (cpt) echo "<a>See all {post_type}</a>";
	// Could list them all but not species?
?>
		<ul class="sub-page-navigation">
			<?php echo $page_list; ?>
		</ul>

		<!-- @TODO? Generic "On This Page"?  "Explore more $post_title"? -->
		<ul class="on-page-nav sub-page-navigation">

		</ul>
	</nav>

<?php } ?>
