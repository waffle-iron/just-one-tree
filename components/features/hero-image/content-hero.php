<?php
/**
 * The template used for displaying hero content.
 *
 * @package Just_One_Tree
 */
?>

<?php // Determine width of featured image to ensure it's large enough.
	if ( has_post_thumbnail() ) {
		$image_width = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' )[1];
	}
?>

<?php if ( has_post_thumbnail() && $image_width > 1000 ) : ?>

	<div class="justonetree-hero">
		<?php the_post_thumbnail( 'justonetree-hero' ); ?>
	</div>

<?php elseif ( get_header_image() ) : ?>
	<div class="justonetree-hero">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</div>
<?php endif; // End header image check. ?>
