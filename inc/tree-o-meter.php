<?php
/**
 * Custom functionality relating to our tree-o-meter feature.
 * For now, this just registers a shortcode for use in our pages.
 *
 * @package Just_One_Tree
 */

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

		<?php echo file_get_contents( esc_url( get_template_directory_uri() ) . '/assets/svg/tree-o-meter.svg' ); ?>

		<progress max="<?php echo justonetree_treeometer_number( 'goal' ); ?>" value="<?php echo justonetree_treeometer_number( 'registered' ); ?>" class="progress-bar" aria-labelledby="justonetree-treeometer-progress">
			<div class="fallback-progress-bar" role="presentation">
				<span class="fallback-progress-value" style="width: <?php echo justonetree_treeometer_number( 'percent' ); ?>%;">&nbsp;</span>
			</div>
		</progress>

		<div id="justonetree-treeometer-text">
			<h3>Goal:
				<span class="number"><?php echo number_format( justonetree_treeometer_number( 'goal' ) ); ?></span>
				lemon trees
			</h3>
			<h3><?php esc_html_e( 'Current total:', 'justonetree' ); ?>
				<span class="number"><?php echo number_format( justonetree_treeometer_number( 'registered' ) ); ?></span>
			</h3>

			<p>Register yours and be counted.</p>

			<a class="button" href="/register">Register a tree</a>
		</div>

	</div>
	<?php return ob_get_clean();
}
