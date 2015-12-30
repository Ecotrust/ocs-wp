<?php
// NOTE The HTML for the shortcode version is in /modules/content-authoring
$success_story_post_id = get_post_meta(get_the_ID(), 'success_story', true);
if ($success_story_post_id):
	$success_story = get_post($success_story_post_id);
	if ($success_story):
?>

		<aside class="success-story" name="success-story">
			<h2><?php echo $success_story->post_title; ?></h2>

            <?php if ( has_post_thumbnail($success_story_post_id) ) : ?>
                <?php
                    $thumbnail = get_post( get_post_thumbnail_id($success_story_post_id) );
                    $caption = $thumbnail->post_excerpt;
                    $attrName = get_post_meta( $thumbnail->ID, 'odfw_attribution_name', true );
                ?>
                <figure class="feature-thumb">
                    <div class="image-container">
                        <?php if (!empty($caption) || !empty($attrName)): ?>
                            <span class="photo-info show-info glyphicon glyphicon-info-sign"></span>
                        <?php endif; ?>
                        <?php echo get_the_post_thumbnail($success_story_post_id, 'large') ?>
                    </div>

                    <figcaption>
                        <span class="photo-info glyphicon glyphicon-remove-circle"></span>
                        <?php if ( !empty($caption) ) : ?>
                            <?php echo $caption; ?> 
                        <?php endif; ?>
                        <?php if ( !empty($attrName) ) : ?>
                            Photo Credit: <?php echo $attrName; ?> 
                        <?php endif; ?>
                    </figcaption>
                </figure>
            <?php endif; ?>

			<div class="success-story-content">
				<?php echo wpautop($success_story->post_content); ?>
			</div>
		</aside>

<?php
	endif;
endif;
?>
