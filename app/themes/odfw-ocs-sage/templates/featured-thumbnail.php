<?php if ( has_post_thumbnail() ) : ?>
    <?php
        $thumbnail = get_post( get_post_thumbnail_id() );
        $caption = $thumbnail->post_excerpt;
        $attrName = get_post_meta( $thumbnail->ID, 'odfw_attribution_name', true );
    ?>
    <figure class="feature-thumb">
        <div class="image-container">
            <?php if (!empty($caption) || !empty($attrName)): ?>
                <span class="photo-info show-info glyphicon glyphicon-info-sign"></span>
            <?php endif; ?>
            <?php echo the_post_thumbnail('large') ?>
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
