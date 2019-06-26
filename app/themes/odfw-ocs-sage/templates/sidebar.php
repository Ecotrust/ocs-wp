	<nav role="navigation">
			<?php
			  if (has_nav_menu('primary_navigation')) :
					wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'main-ocs-navigation', 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',]);
			  endif;
			?>
    </nav>
	<a class="brand" href="<?php echo ocs_get_option('ocs-odfw-logo-url'); ?>"><?php bloginfo('name'); ?></a>
