<?php
  $success_story_post_id = get_post_meta(get_the_ID(), 'success_story', true);
  if ($success_story_post_id) {
    $success_story = get_post($success_story_post_id);
?>
    <aside class="success-story" name="success-story">
    <h2><?php echo $success_story->post_title; ?></h2>
      <div class="success-story-content">
        <?php echo wpautop($success_story->post_content); ?>
      </div>
    </aside>
<?php } ?>
