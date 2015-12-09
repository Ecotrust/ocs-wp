<?php
// NOTE The HTML for the shortcode version is in /modules/content-authoring
$success_story_post_id = get_post_meta(get_the_ID(), 'success_story', true);
if ($success_story_post_id):
	$success_story = get_post($success_story_post_id);
	if ($success_story):
?>

		<aside class="success-story" name="success-story">
			<?php //@TODO H2 only if it's at the bottom of the page? -
				// they shouldn't be in the sidebar nav except the final one ?>
			<h2><?php echo $success_story->post_title; ?></h2>
			<div class="success-story-content">
				<?php echo wpautop($success_story->post_content); ?>
			</div>
		</aside>

<?php
	endif;
endif;
?>
