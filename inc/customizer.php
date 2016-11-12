<?php
/**
 * Just One Tree Theme Customizer.
 *
 * @package Just_One_Tree
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function justonetree_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/**
	 * Add the Theme Options section
	 */
	$wp_customize->add_panel( 'justonetree_options_panel', array(
		'title'          => __( 'Custom Options', 'justonetree' ),
		'description'    => __( 'Options specific to your theme.', 'justonetree' ),
	) );
	// General settings
	$wp_customize->add_section( 'justonetree_general_settings', array(
		'title'           => esc_html__( 'Tree-o-meter Settings', 'justonetree' ),
		'panel'           => 'justonetree_options_panel',
		'description'     => __( 'Here, you can enter the number of trees currently registered, and the total number of tree registrations aimed for.', 'justonetree' ),
	) );
	$wp_customize->add_setting( 'justonetree_trees_registered', array(
		'type' => 'theme_mod', // or 'option'
		'capability' => 'edit_theme_options',
		'default' => '',
		'transport' => 'refresh', // or postMessage
		'sanitize_callback' => 'justonetree_sanitize_numeric_value',
	) );
	$wp_customize->add_control( 'justonetree_trees_registered', array(
		'label'   => esc_html__( 'Total number of trees registered', 'justonetree' ),
		'section'   => 'justonetree_general_settings',
		'type'    => 'number',
	) );

	$wp_customize->add_setting( 'justonetree_tree_goal', array(
		'type' => 'theme_mod', // or 'option'
		'capability' => 'edit_theme_options',
		'default' => '',
		'transport' => 'refresh', // or postMessage
		'sanitize_callback' => 'justonetree_sanitize_numeric_value',
	) );
	$wp_customize->add_control( 'justonetree_tree_goal', array(
		'label'   => esc_html__( 'Registration goal', 'justonetree' ),
		'section'   => 'justonetree_general_settings',
		'type'    => 'number',
	) );
}
add_action( 'customize_register', 'justonetree_customize_register' );

/**
 * Sanitize a numeric value
 */
function justonetree_sanitize_numeric_value( $input ) {
	if ( is_numeric( $input ) ) :
		return intval( $input );
	else:
		return 0;
	endif;
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function justonetree_customize_preview_js() {
	wp_enqueue_script( 'justonetree_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'justonetree_customize_preview_js' );
