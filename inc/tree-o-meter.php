<?php
/**
 * Custom functionality relating to our tree-o-meter feature.
 * For now, this just registers a shortcode for use in our pages.
 *
 * @package Just_One_Tree
 */
/**
 * Register shortcodes used by theme.
 */
function justonetree_register_shortcodes() {
	add_shortcode( 'treeometer', 'justonetree_treeometer_shortcode' );
}
add_action( 'init', 'justonetree_register_shortcodes' );


/**
 * Output the tree-o-meter via a shortcode.
 */
function justonetree_treeometer_shortcode( $attr, $content = '', $shortcode_tag ) {
	ob_start(); ?>
	<div class="justonetree-treeometer">
		Our Goal: 12,000 Lemon Trees,
		This Week's Total 1831.
	</div>
	<?php return ob_get_clean();
}
