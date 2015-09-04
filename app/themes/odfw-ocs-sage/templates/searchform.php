<form role="search" method="get" class="search-form form-inline" action="<?= esc_url(home_url('/')); ?>">
  <label class="sr-only"><?php _e('Search for:', 'sage'); ?></label>
    <input type="search" value="<?= get_search_query(); ?>" name="s" class="search-field" placeholder="<?php _e('Search', 'sage'); ?> <?php bloginfo('name'); ?>" required>
	<button type="submit" class="search-submit btn btn-default"><?php _e('Search', 'sage'); ?></button>
  </div>
</form>
