<?php if ( has_post_thumbnail() ) : ?>
    <figure class="feature-thumb">
        <div class="image-container">
            <span class="photo-info show-info glyphicon glyphicon-info-sign"></span>
            <?php echo the_post_thumbnail() ?>
        </div>
    
        <figcaption>
            <span class="photo-info glyphicon glyphicon-remove-circle"></span>
            <?php echo get_post( get_post_thumbnail_id() )->post_excerpt; ?>
        </figcaption>
    </figure>
<?php endif; ?>