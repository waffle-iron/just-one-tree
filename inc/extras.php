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
	if ( ! is_active_sidebar( 'sidebar' ) || is_front_page () ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'justonetree_body_classes' );

/**
 * Filter the categories archive widget to add a span around post count
 */
function smittenkitchen_cat_count_span( $links ) {
	$links = str_replace( '</a> (', '</a><span class="post-count">(', $links );
	$links = str_replace( ')', ')</span>', $links );
	return $links;
}
add_filter( 'wp_list_categories', 'smittenkitchen_cat_count_span' );

/**
 * Filter the archives widget to add a span around post count
 */
function smittenkitchen_archive_count_span( $links ) {
	$links = str_replace( '</a>&nbsp;(', '</a><span class="post-count">(', $links );
	$links = str_replace( ')', ')</span>', $links );
	return $links;
}
add_filter( 'get_archives_link', 'smittenkitchen_archive_count_span' );

/**
 * We want to do some fancy-pants stuff with our navbar,
 * so we'll need to create a custom walker.
 *
 */
class JustOneTree_Menu extends Walker_Nav_Menu {
	var $current_menu	= null;
	var $break_point	 = null;
	var $id_to_split_on  = null;
	var $top_level_count = null;
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )  {
		global $wp_query;
			// Get the locations of nav menus
			$theme_locations = get_nav_menu_locations();

			// If we don't have any menu items, let's bail.
			if ( empty( array_filter( $theme_locations ) ) ) :
				return;
			endif;

			// Get the menu object of the current nav menu based on the returned theme location
			$menu_obj = get_term( $theme_locations[$args->theme_location], 'nav_menu' );

			if( !isset( $this->current_menu ) ) {
				$this->current_menu = wp_get_nav_menu_object( $menu_obj->term_id );
			}

			// Determine a break point for our menu
			$menu_items = wp_get_nav_menu_items( $menu_obj->term_id );

			if ( !isset ( $this->top_level_count ) ) {
				$this->top_level_count = 0;
						foreach ( $menu_items as $menu_item ) {
								if ( 0 == $menu_item->menu_item_parent ) {
										$this->top_level_count++;
								}
						}
				if ( !isset( $this->break_point ) ) {
					$this->break_point = ceil( $this->top_level_count / 2 );
				}
				$iterator = 0;
				foreach ( $menu_items as $menu_item ) {
							if ( 0 == $menu_item->menu_item_parent ) {
									if ( $iterator == $this->break_point ) {
										  $this->id_to_split_on = $menu_item->ID;
									}
									$iterator++;
							}
						}
					   }
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
		if ( $this->id_to_split_on === $item->ID ) {
			$output .= $indent . '</li></span><span class="justonetree-split-nav"><li' . $id . $value . $class_names .'>';
		} else {
			$output .= $indent . '<li' . $id . $value . $class_names . '>';
		}
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )	 ? ' target="' . esc_attr( $item->target	 ) .'"' : '';
		$attributes .= ! empty( $item->xfn )		? ' rel="'	. esc_attr( $item->xfn		) .'"' : '';
		$attributes .= ! empty( $item->url )		? ' href="'   . esc_attr( $item->url		) .'"' : '';
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
