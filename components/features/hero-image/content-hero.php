<?php
/**
 * The template used for displaying hero content.
 *
 * @package Just_One_Tree
 */
?>

<?php if ( has_post_thumbnail() ) : ?>
	<div class="justonetree-hero">
		<?php the_post_thumbnail( 'justonetree-hero' ); ?>
	</div>
<?php endif; ?>
