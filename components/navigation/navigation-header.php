<nav id="site-navigation" class="main-navigation" role="navigation">
	<?php
				wp_nav_menu( array(
					'theme_location'  => 'menu-1',
					'menu_id'         => 'header-menu',
					'fallback_cb'     => 'wp_page_menu',
					'items_wrap'      => '<ul id="%1$s" class="%2$s"><span class="justonetree-split-nav">%3$s</span></ul>',
					'walker'          => new JustOneTree_Menu(),
				) );
			?>
</nav>
