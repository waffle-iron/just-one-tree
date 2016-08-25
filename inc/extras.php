<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Just_One_Tree
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function justonetree_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add a class of no-sidebar when there is no sidebar present
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'justonetree_body_classes' );

/*
 * Add an extra li to our nav for our priority+ navigation to use
 */
function justonetree_add_more_to_nav( $items, $args ) {
	if ( 'menu-1' === $args->theme_location ) :
		$items .= '<li id="more-menu" class="menu-item menu-item-has-children"><a href="#">';
		$items .= easy_as_svg_get_icon( 'more' );
		$items .= '<span class="screen-reader-text">'. esc_html( 'More') . '</span></a><ul class="sub-menu"></ul></li>';
	endif;
	return $items;
}
add_filter( 'wp_nav_menu_items', 'justonetree_add_more_to_nav', 10, 2 );
