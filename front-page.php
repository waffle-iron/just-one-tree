<?php
/**
 * The front page template file.
 *
 * If the user has selected a static page for their homepage,
 * this is what will appear.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Just_One_Tree
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

	<?php // Show the selected frontpage content
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
			get_template_part( 'components/content', 'hero' );
		endwhile;
	else : // I'm not sure it's possible to have no posts when this page is shown, but WTH
		get_template_part( 'components/content', 'none' );
	endif;
	?>

	<?php get_sidebar( 'frontpage' ); ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
