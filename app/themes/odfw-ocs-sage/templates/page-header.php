<?php use Roots\Sage\Titles; ?>

<header class="page-header">
  <h1 tabindex="6"><?= Titles\title(); ?></h1>

  <?php  if( $post && $post->post_parent && !is_search() ) {
	$parent = $post->post_parent;
	$parentPost = get_post($parent);
	$grandParent = $parentPost->post_parent ? $parentPost->post_parent : false;
	?>
	<nav class="crumbs">
		<a href="/">Home</a> >
		<?php if($grandParent): ?>
		<a href="<?php echo get_permalink($grandParent); ?>"><?php echo get_the_title($grandParent); ?></a> >
		<?php endif; ?>
		<a href="<?php echo get_permalink($parent); ?>"><?php echo get_the_title($parent); ?></a> >
		<span class="current-page"><?php the_title(); ?></span>
	</nav>
	<?php } ?>
</header>
