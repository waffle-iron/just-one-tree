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
	<?php justonetree_social_menu(); ?>
	<?php get_template_part( 'components/footer/site', 'info' ); ?>
	<?php get_template_part( 'components/navigation/navigation', 'footer' ); ?>
</footer>

<?php wp_footer(); ?>

</body>
</html>
