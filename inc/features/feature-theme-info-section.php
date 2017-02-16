<?php
/**
 * Customizer functionality for the Theme Info section.
 *
 * @package WordPress
 * @subpackage Hestia
 * @since Hestia 1.0
 */

/**
 * Hook controls for Features section to Customizer.
 *
 * @since Hestia 1.0
 */
function hestia_theme_info_customize_register( $wp_customize ) {
	require_once( trailingslashit( get_template_directory() ) . 'inc/customizer-theme-info/class-customizer-theme-info-control.php' );
	require_once( trailingslashit( get_template_directory() ) . 'inc/customizer-theme-info/class-customizer-theme-info-root.php' );

	$wp_customize->add_section( 'hestia_theme_info_main_section', array(
		'title'    => __( 'View PRO Features', 'hestia-pro' ),
		'priority' => 0,
	) );

	$wp_customize->add_setting( 'hestia_theme_info_main_control', array(
		'sanitize_callback' => 'esc_html',
	) );

	$wp_customize->add_control( new Hestia_Control_Upsell_Theme_Info( $wp_customize, 'hestia_theme_info_main_control', array(
		'section'            => 'hestia_theme_info_main_section',
		'priority'           => 100,
		'options'            => array(
			esc_html__( 'Header Slider', 'hestia-pro' ),
			esc_html__( 'Fully Customizable Colors', 'hestia-pro' ),
			esc_html__( 'Jetpack Portfolio', 'hestia-pro' ),
			esc_html__( 'Pricing Plans Section', 'hestia-pro' ),
			esc_html__( 'Section Reordering', 'hestia-pro' ),
			esc_html__( 'Quality Support', 'hestia-pro' ),
		),
		'explained_features' => array(
			esc_html__( 'You will be able to add more content to your site header with an awesome slider.', 'hestia-pro' ),
			esc_html__( 'Change colors for the header overlay, header text and navbar.', 'hestia-pro' ),
			esc_html__( 'Portfolio section with two possible layouts.', 'hestia-pro' ),
			esc_html__( 'A fully customizable pricing plans section.', 'hestia-pro' ),
			esc_html__( 'The ability to reorganize your front page sections easy and fast.', 'hestia-pro' ),
			esc_html__( '24/7 HelpDesk Professional Support.', 'hestia-pro' ),
		),
		'button_url'         => esc_url( 'https://www.themeisle.com/themes/hestia-pro/' ),
		'button_text'        => esc_html__( 'Get the PRO version!', 'hestia-pro' ),
	) ) );

	$wp_customize->add_setting( 'hestia_theme_info_colors_control', array(
		'sanitize_callback' => 'esc_html',
	) );

	$wp_customize->add_control( new Hestia_Control_Upsell_Theme_Info( $wp_customize, 'hestia_theme_info_colors_control', array(
		'section'            => 'colors',
		'priority'           => 100,
		'options'            => array(
			esc_html__( 'Advanced Color Options', 'hestia-pro' ),
		),
		'explained_features' => array(
			esc_html__( 'Change colors for the header overlay, header text and navbar.', 'hestia-pro' ),
		),
		'button_url'         => esc_url( 'https://www.themeisle.com/themes/hestia-pro/' ),
		'button_text'        => esc_html__( 'Get the PRO version!', 'hestia-pro' ),
	) ) );

	$wp_customize->add_setting( 'hestia_theme_info_blog_control', array(
		'sanitize_callback' => 'esc_html',
	) );

	$wp_customize->add_control( new Hestia_Control_Upsell_Theme_Info( $wp_customize, 'hestia_theme_info_blog_control', array(
		'section'            => 'hestia_blog',
		'priority'           => 100,
		'options'            => array(
			esc_html__( 'Alternative Blog Layout', 'hestia-pro' ),
			esc_html__( 'Sidebar Toggles', 'hestia-pro' ),
			esc_html__( 'Authors Section', 'hestia-pro' ),
			esc_html__( 'Subscribe Section', 'hestia-pro' ),
		),
		'explained_features' => array(
			esc_html__( 'Two different choices for how your blog posts are displayed.', 'hestia-pro' ),
			esc_html__( 'Remove the sidebar from archive pages and single post pages.', 'hestia-pro' ),
			esc_html__( 'A beautiful section where you can list the authors at the bottom of your blog page.', 'hestia-pro' ),
			esc_html__( 'A call to action ribbon fully integrated with the Sendinblue plugin.', 'hestia-pro' ),
		),
		'button_url'         => esc_url( 'https://www.themeisle.com/themes/hestia-pro/' ),
		'button_text'        => esc_html__( 'Get the PRO version!', 'hestia-pro' ),
	) ) );
}

add_action( 'customize_register', 'hestia_theme_info_customize_register' );

