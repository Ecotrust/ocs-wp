<?php
/**
* Redirect Page
*/
$link = ( $this->post->nav_type && $this->post->nav_type !== 'custom' ) 
	? $this->post->nav_original_link
	: esc_url($this->post->content);
?>
<div class="row" <?php if ( $this->isSearch() ) echo 'style="padding-left:10px;"';?>>
	
	<?php if ( $this->post_type->hierarchical && !$this->isSearch() ) : ?>
	<div class="child-toggle"></div>
	<?php endif; ?>

	<div class="row-inner">

		<i class="np-icon-sub-menu"></i>
		
		<?php if ( $this->user->canSortPages() && !$this->isSearch() ) : ?>
		<i class="handle np-icon-menu"></i>
		<?php endif; ?>

		<a href="<?php echo $link; ?>" class="page-link page-title" target="_blank">
			<span class="title"><?php echo $this->post->title ?> <i class="np-icon-link"></i></span>
			<?php 

				// Post Status
				if ( $this->post->status !== 'publish' ){
					echo '<span class="status">(' . __(ucfirst($this->post->status)) . ')</span>';
				} else {
					echo '<span class="status"></span>';
				}

				// Nested Pages Status
				if ( $this->post->np_status == 'hide' )
					echo '<i class="np-icon-eye-blocked"></i>';

				// Nav Status
				if ( $this->post->nav_status == 'hide' ){
					echo '<span class="nav-status">(' . __('Hidden', 'nestedpages') . ')</span>';
				} else {
					echo '<span class="nav-status"></span>';
				}
			?>
		</a>

		<a href="#" class="np-toggle-edit"><i class="np-icon-pencil"></i></a>

		<div class="action-buttons">

			<a href="#" 
				class="np-btn np-quick-edit-redirect" 
				data-id="<?php echo $this->post->id; ?>" 
				data-parentid="<?php echo $this->post->parent_id; ?>"
				data-title="<?php echo $this->post->title; ?>" 
				data-url="<?php echo NestedPages\Helpers::check_url($this->post->content); ?>"
				data-status="<?php echo $this->post->status; ?>" 
				data-np-status="<?php echo $this->post->np_status; ?>"
				data-navstatus="<?php echo $this->post->nav_status; ?>"
				data-navtitleattr="<?php echo $this->post->nav_title_attr; ?>"
				data-navcss="<?php echo $this->post->nav_css; ?>"
				data-nav-type="<?php echo $this->post->nav_type; ?>"
				data-nav-object="<?php echo $this->post->nav_object; ?>"
				data-nav-object-id="<?php echo $this->post->nav_object_id; ?>"
				data-nav-original-link="<?php echo $this->post->nav_original_link; ?>"
				data-nav-original-title="<?php echo $this->post->nav_original_title; ?>"
				data-linktarget="<?php echo $this->post->link_target; ?>">
				<?php _e('Quick Edit'); ?>
			</a>

			<?php if ( current_user_can('delete_pages') ) : ?>
			<a href="<?php echo get_delete_post_link($this->post->id, '', true); ?>" class="np-btn np-btn-trash" data-np-confirm-delete>
				<i class="np-icon-remove"></i>
			</a>
			<?php endif; ?>

		</div><!-- .action-buttons -->
	</div><!-- .row-inner -->
</div><!-- .row -->