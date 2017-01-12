<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Just_One_Tree
 */

?>
	</div><!-- #content -->
</div><!-- #page -->

<footer id="colophon" class="site-footer" role="contentinfo">
	<?php get_template_part( 'components/footer/sidebar', 'footer' ); ?>
</footer>

<?php get_template_part( 'components/footer/sponsors' ); ?>

<?php wp_footer(); ?>
</body>
</html>
