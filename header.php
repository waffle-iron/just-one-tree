<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Just_One_Tree
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'justonetree' ); ?></a>

	<div class="justonetree-lemon-sprigs">
		<img class="left-sprig" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/lemon-sprig.png" alt="" />

		<img class="centre-sprig" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/lemon-sprig.png" alt="" />

		<img class="right-sprig" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/lemon-sprig.png" alt="" />
	</div>

	<header id="masthead" class="site-header" role="banner">

		<?php get_template_part( 'components/features/hero-image/content', 'hero' ); ?>

		<?php
			get_template_part( 'components/header/site', 'branding' );

			get_template_part( 'components/navigation/navigation', 'header' );
		?>

	</header>
	<div id="content" class="site-content">
