<?php
/**
 * Customizer functionality for the Blog section.
 *
 * @package WordPress
 * @subpackage Hestia
 * @since Hestia 1.0
 */

/**
 * Hook controls for Blog section to Customizer.
 *
 * @since Hestia 1.0
 */
function hestia_blog_customize_register( $wp_customize ) {

	$wp_customize->add_section( 'hestia_blog', array(
		'title' => esc_html__( 'Blog', 'hestia-pro' ),
		'panel' => 'hestia_frontpage_sections',
		'priority' => apply_filters( 'hestia_section_priority', 50, 'hestia_blog' ),
	));

	$wp_customize->add_setting( 'hestia_blog_hide', array(
		'sanitize_callback' => 'hestia_sanitize_checkbox',
		'default' => false,
	) );

	$wp_customize->add_control( 'hestia_blog_hide', array(
		'type' => 'checkbox',
		'label' => esc_html__( 'Disable section','hestia-pro' ),
		'section' => 'hestia_blog',
		'priority' => 1,
	) );

	$wp_customize->add_setting( 'hestia_blog_title', array(
		'default' => esc_html__( 'Blog', 'hestia-pro' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( 'hestia_blog_title', array(
		'label' => esc_html__( 'Section Title', 'hestia-pro' ),
		'section' => 'hestia_blog',
		'priority' => 5,
	));

	$wp_customize->add_setting( 'hestia_blog_subtitle', array(
		'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'hestia-pro' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( 'hestia_blog_subtitle', array(
		'label' => esc_html__( 'Section Subtitle', 'hestia-pro' ),
		'section' => 'hestia_blog',
		'priority' => 10,
	));

	$wp_customize->add_setting( 'hestia_blog_items', array(
		'default' => 3,
		'sanitize_callback' => 'absint',
	));

	$wp_customize->add_control( 'hestia_blog_items', array(
		'label' => esc_html__( 'Number of Items', 'hestia-pro' ),
		'section' => 'hestia_blog',
		'priority' => 15,
		'type' => 'number',
	));

}

add_action( 'customize_register', 'hestia_blog_customize_register' );
