<?php
/**
 * Custom functionality relating to our tree-o-meter feature.
 * For now, this just registers a shortcode for use in our pages.
 *
 * @package Just_One_Tree
 */

/**
 * Get number of registered trees.
 */
function justonetree_get_registered_trees() {

	// First of all, let's check to see if we have a transient set already.
	$transient = get_transient( 'justonetree_registered_tree_count' );

	if( ! empty( $transient ) ) :
		// Return the transient and exit the function.
		return $transient;

	else:
		// We'll need to count our registered trees.

		// Our tree count starts at zero.
		$tree_count = 0;

		// Query all published tree CPT posts.
		$the_query = new WP_Query( array(
			'post_type'      => 'tree',
			'posts_per_page' => 1000000
		) );

		if ( $the_query->have_posts() ) :

			while ( $the_query->have_posts() ) : $the_query->the_post();
				// Get the number of registered trees.
				$trees = get_post_meta( get_the_ID(), 'tree_info_number' );
				if ( $trees ):
					$tree_count = $tree_count + $trees[0];
				endif;
			endwhile;

			// Reset post data.
			wp_reset_postdata();

		endif;

		// Save our result in a transient for one hour.
		set_transient( 'justonetree_registered_tree_count', $tree_count, HOUR_IN_SECONDS );

		// Return our count.
		return $tree_count;

	endif;
}


/**
 * Get the numbers are tree-o-meter wants.
 * This function just gets us some numbers used by the tree-o-meter,
 * either by querying posts, getting a theme mod, or doing some maths.
 */
function justonetree_treeometer_number( $request ) {
	$goal = get_theme_mod( 'justonetree_tree_goal' );
	$registered = justonetree_get_registered_trees();

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
