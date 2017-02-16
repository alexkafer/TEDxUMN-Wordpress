<?php
/**
 * Customizer functionality for the Slider section.
 *
 * @package WordPress
 * @subpackage Hestia
 * @since Hestia 1.0
 */

/**
 * Hook controls for Slider section to Customizer.
 *
 * @since Hestia 1.0
 */
function hestia_big_title_customize_register( $wp_customize ) {

	$wp_customize->add_section( 'hestia_big_title', array(
		'title'    => esc_html__( 'Big Title Section', 'hestia-pro' ),
		'panel'    => 'hestia_frontpage_sections',
		'priority' => 1,
	) );

	/**
	 * Control for big title background
	 */

	$wp_customize->add_setting( 'hestia_big_title_background', array(
		'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'hestia_big_title_background', array(
		'label'    => esc_html__( 'Big Title Background', 'hestia-pro' ),
		'section'  => 'hestia_big_title',
		'priority' => 10,
	) ) );

	/**
	 * Control for header title
	 */
	$wp_customize->add_setting( 'hestia_big_title_title', array(
		'sanitize_callback' => 'esc_html',
	) );

	$wp_customize->add_control( 'hestia_big_title_title', array(
		'label'    => esc_html__( 'Title', 'hestia-pro' ),
		'section'  => 'hestia_big_title',
		'priority' => 15,
	) );

	/**
	 * Control for header text
	 */
	$wp_customize->add_setting( 'hestia_big_title_text', array(
		'sanitize_callback' => 'esc_html',
	) );

	$wp_customize->add_control( 'hestia_big_title_text', array(
		'label'    => esc_html__( 'Text', 'hestia-pro' ),
		'section'  => 'hestia_big_title',
		'priority' => 20,
	) );

	/**
	 * Control for button text
	 */
	$wp_customize->add_setting( 'hestia_big_title_button_text', array(
		'sanitize_callback' => 'esc_html',
	) );
	$wp_customize->add_control( 'hestia_big_title_button_text', array(
		'label'    => esc_html__( 'Button text', 'hestia-pro' ),
		'section'  => 'hestia_big_title',
		'priority' => 25,
	) );

	/**
	 * Control for button link
	 */
	$wp_customize->add_setting( 'hestia_big_title_button_link', array(
		'sanitize_callback' => 'esc_url',
	) );
	$wp_customize->add_control( 'hestia_big_title_button_link', array(
		'label'    => esc_html__( 'Button URL', 'hestia-pro' ),
		'section'  => 'hestia_big_title',
		'priority' => 30,
	) );

	$hestia_slider_content = get_theme_mod( 'hestia_slider_content' );

	if ( empty( $hestia_slider_content ) ) {
		$wp_customize->get_setting( 'hestia_big_title_background' )->default = esc_url( get_template_directory_uri() . '/assets/img/slider2.jpg' );
		$wp_customize->get_setting( 'hestia_big_title_title' )->default = esc_html__( 'Lorem Ipsum', 'hestia-pro' );
		$wp_customize->get_setting( 'hestia_big_title_text' )->default = esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'hestia-pro' );
		$wp_customize->get_setting( 'hestia_big_title_button_text' )->default = esc_html__( 'Button', 'hestia-pro' );
		$wp_customize->get_setting( 'hestia_big_title_button_link' )->default = esc_url( '#' );
	}
}

add_action( 'customize_register', 'hestia_big_title_customize_register' );
