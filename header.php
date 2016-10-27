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

	<header id="masthead" class="site-header" role="banner">

		<?php
			get_template_part( 'components/header/site', 'branding' );

			if ( get_custom_logo() ) :
				// Show the custom logo if one's been uploaded via wp-admin.
				the_custom_logo();
			else :
				// Otherwise, show our logo in SVG format.
				?>
				<a class="custom-logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo file_get_contents( esc_url( get_template_directory_uri() ) . '/assets/svg/just-one-tree.svg' ); ?></a>
		<?php
			endif;

			get_template_part( 'components/navigation/navigation', 'header' );
		?>

	</header>
	<div id="content" class="site-content">
