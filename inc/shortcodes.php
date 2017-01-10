<?php
/**
 * Set up and configure shortcodes.
 * Tree-o-meter rendering function lives in inc/tree-o-meter.php.
 *
 * @package Just_One_Tree
 */
/**
 * Register shortcodes used by theme.
 */
function justonetree_register_shortcodes() {
	add_shortcode( 'treeometer', 'justonetree_treeometer_shortcode' ); // tree-o-meter.php
	add_shortcode( 'learn_more', 'justonetree_learnmore_shortcode' );
	add_shortcode( 'take-action', 'justonetree_takeaction_shortcode' );
}
add_action( 'init', 'justonetree_register_shortcodes' );

/**
 * Output "learn more" box.
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

/**
 * Output "learn more" box.
 */
function justonetree_takeaction_shortcode( $atts, $content = '', $shortcode_tag ) {
	ob_start();

	$atts = shortcode_atts(
		array(
			'slug'        => '', // string
			'title'       => '', // string
			'button-link' => '', // string
			'button-text' => '', // string
			'text'        => '', // string
		), $atts, 'take-action' );
	?>

	<div class="action-widget <?php echo esc_html( $atts['slug'] ); ?> ">

		<?php easy_as_svg_icon( $atts['slug'] ); ?>

		<?php if ( '' !== $atts['title'] ) : ?>
			<h3><?php echo esc_html( $atts['title'] ); ?></h3>
		<?php endif; ?>

		<?php if ( '' !== $atts['text'] ) : ?>
			<p><?php echo esc_html( $atts['text'] ) ?></p>
		<?php endif; ?>

		<?php if ( '' !== $atts['button-link'] ) : ?>
			<p><a class="button" href="<?php echo esc_url( $atts['button-link'] ); ?>"><?php echo esc_html( $atts['button-text'] ); ?></a></p>
		<?php endif; ?>
	</div>

	<?php
	return ob_get_clean();
}
