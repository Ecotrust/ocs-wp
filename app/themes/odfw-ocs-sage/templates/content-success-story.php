<?php
  $success_story_post_id = get_post_meta(get_the_ID(), 'success_story', true);
  if ($success_story_post_id) {
    $success_story = get_post($success_story_post_id);
?>
    <div class="success-story">
    <h3><?php echo $success_story->post_title; ?></h3>
      <div class="success-story-content">
        <?php echo wpautop($success_story->post_content); ?>
      </div>
    </div>
<?php } ?>
