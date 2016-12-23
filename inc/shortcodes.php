<?php
/**
 * Set up and configure shortcodes.
 * Tree-o-meter rending function lives in tree-o-meter.php
 *
 * @package Just_One_Tree
 */
/**
 * Register shortcodes used by theme.
 */
function justonetree_register_shortcodes() {
	add_shortcode( 'treeometer', 'justonetree_treeometer_shortcode' );
	add_shortcode( 'learn_more', 'justonetree_learnmore_shortcode' );
}
add_action( 'init', 'justonetree_register_shortcodes' );

/**
 * Output text that should be hidden from print, identified via a div class.
 */
function justonetree_learnmore_shortcode( $attr, $content = '', $shortcode_tag ) {
	ob_start();
	?>

	<h2><a class="justonetree-learnmore-toggle" href="#">
		<span><?php echo esc_html__( 'Learn more', 'justonetree' ); ?></span>
		<?php easy_as_svg_icon( 'caret' ); ?>
	</a></h2>
	<div class="justonetree-learnmore hidden">
		<?php echo do_shortcode( wpautop( wp_kses_post( $content ) ) ); ?>
	</div>

	<?php
	return ob_get_clean();
}
