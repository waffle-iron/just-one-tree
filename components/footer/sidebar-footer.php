<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Just_One_Tree
 */

if ( ! is_active_sidebar( 'sidebar-footer' ) ) {
	return;
}
?>

<aside id="footer-widgets" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-footer' ); ?>
</aside>
