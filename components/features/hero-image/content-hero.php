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

<?php elseif ( get_header_image() ) : ?>
	<div class="justonetree-hero">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</div>
<?php endif; // End header image check. ?>
