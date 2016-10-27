<?php
/**
 * Template part for outputting a list of sponsors.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Just_One_Tree
 */
?>

<section class="justonetree-sponsor-logos">
	<?php // Query posts for our sponsors.
	$args = array(
		'post_type' => 'sponsor',

	);
	$the_query = new WP_Query( $args );

	// Loop through all sponsors and show them in a list.
	if ( $the_query->have_posts() ) :
		while ( $the_query->have_posts() ) :
			$the_query->the_post();
			get_template_part( 'components/sponsor/content-list' );
		endwhile;
		wp_reset_postdata();
	endif;
	?>
</section>
