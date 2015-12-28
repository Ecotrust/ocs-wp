	<nav role="navigation">
			<?php
			  if (has_nav_menu('primary_navigation')) :
				wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'main-ocs-navigation']);
			  endif;
			?>
			<?php
/*
		<ul class="main-ocs-navigation">
				// 22 = homepage
				wp_list_pages("title_li=&exclude=22");
</ul>
 */
			?>
    </nav>
	<a class="brand" href="<?php echo ocs_get_option('ocs-odfw-logo-url'); ?>"><?php bloginfo('name'); ?></a>

