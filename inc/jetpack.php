<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package Just_One_Tree
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.me/support/infinite-scroll/
 * See: https://jetpack.me/support/responsive-videos/
 */
function justonetree_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'justonetree_infinite_scroll_render',
		'footer'    => 'page',
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Social Menus
	add_theme_support( 'jetpack-social-menu' );
}
add_action( 'after_setup_theme', 'justonetree_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function justonetree_infinite_scroll_render() {
	while ( have_posts() ) :
		the_post();
		if ( is_search() ) :
		    get_template_part( 'components/post/content', 'search' );
		else :
		    get_template_part( 'components/post/content', get_post_format() );
		endif;
	endwhile;
}

function justonetree_social_menu() {
	if ( ! function_exists( 'jetpack_social_menu' ) ) :
		return;
	else :
		if ( has_nav_menu( 'jetpack-social-menu' ) ) : ?>
			<nav class="jetpack-social-navigation" role="navigation">
				<?php
					wp_nav_menu( array(
						'theme_location'  => 'jetpack-social-menu',
						'link_before'     => '',
						'link_after'      => '',
						'depth'           => 1,
					) );
				?>
			</nav><!-- .jetpack-social-navigation -->
		<?php endif;
	endif;
}
