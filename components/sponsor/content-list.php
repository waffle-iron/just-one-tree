<?php
/**
 * Template part for displaying sponsors in a list.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Just_One_Tree
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail(); ?>
		</a>
	<?php endif; ?>

</div><!-- #post-## -->
