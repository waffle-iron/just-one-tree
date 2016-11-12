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
function justonetree_treeometer_number( $request ) {
	$goal = get_theme_mod( 'justonetree_tree_goal' );
	$registered = get_theme_mod( 'justonetree_trees_registered' );

	$percent = round( ($registered/$goal) * 100 );

	switch( $request ) :
		case 'goal':
			return $goal;
			break;
		case 'registered':
			return $registered;
			break;
		case 'percent':
			return $percent;
			break;
	endswitch;
}

/**
 * Output the tree-o-meter via a shortcode.
 */
function justonetree_treeometer_shortcode( $attr, $content = '', $shortcode_tag ) {
	ob_start(); ?>
	<div class="justonetree-treeometer">
		<dl>
			<dt><?php esc_html_e( 'Our Goal:', 'justonetree' ); ?> <?php echo justonetree_treeometer_number( 'goal' ); ?> <?php esc_html_e( 'trees', 'justonetree' ); ?></dt>
			<dd><?php esc_html_e( 'Current total:', 'justonetree' ); ?> <?php echo justonetree_treeometer_number( 'registered' ); ?> (<?php echo justonetree_treeometer_number( 'percent' ); ?>%)</dd>
	</div>
	<?php return ob_get_clean();
}
