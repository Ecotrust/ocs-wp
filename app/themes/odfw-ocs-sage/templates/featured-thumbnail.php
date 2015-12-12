<?php if ( has_post_thumbnail() ) : ?>
    <figure class="feature-thumb">
	<?php $caption = get_post( get_post_thumbnail_id() )->post_excerpt; ?>
        <div class="image-container">
			<?php if (!empty($caption)): ?>
				<span class="photo-info show-info glyphicon glyphicon-info-sign"></span>
			<?php endif; ?>
            <?php echo the_post_thumbnail('large') ?>
        </div>

		<?php if (!empty($caption)): ?>
			<figcaption>
				<span class="photo-info glyphicon glyphicon-remove-circle"></span>
				<?php echo get_post( get_post_thumbnail_id() )->post_excerpt; ?>
			</figcaption>
		<?php endif; ?>
    </figure>
<?php endif; ?>
