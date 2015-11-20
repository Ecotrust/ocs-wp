	<nav role="navigation">
			<?php
			/*
			  if (has_nav_menu('primary_navigation')) :
				wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'main-ocs-navigation']);
			  endif;
			*/
			?>
		<ul class="main-ocs-navigation">
			<?php
				// 22 = homepage
				wp_list_pages("title_li=&exclude=22");
			?>
		</ul>
    </nav>
    <a class="brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>

