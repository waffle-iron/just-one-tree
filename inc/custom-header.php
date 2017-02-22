<?php
/**
 * Implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...
 *
 *
 * @package Just_One_Tree
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses justonetree_header_style()
 */
function justonetree_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'justonetree_custom_header_args', array(
		'default-image'          => '',
		'header-text'            => false,
		'width'                  => 2000,
		'height'                 => 250,
		'flex-height'            => true,
	) ) );
}
add_action( 'after_setup_theme', 'justonetree_custom_header_setup' );
