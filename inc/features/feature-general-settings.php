<?php
/**
 * Customizer functionality for the General settings.
 *
 * @package WordPress
 * @subpackage Hestia
 * @since Hestia 1.0
 */

/**
 * Hook controls for General section to Customizer.
 *
 * @since Hestia 1.0
 */
function hestia_general_customize_register( $wp_customize ) {

	// Add general panel.
	$wp_customize->add_section( 'hestia_general', array(
		'title' => esc_html__( 'General Settings', 'hestia-pro' ),
		'panel' => 'hestia_appearance_settings',
		'priority' => 15,
	));

	// Boxed layout toggle.
	$wp_customize->add_setting( 'hestia_general_layout', array(
		'default' => 1,
		'sanitize_callback' => 'hestia_sanitize_checkbox',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( 'hestia_general_layout',array(
		'label' => esc_html__( 'Boxed Layout?','hestia-pro' ),
		'description' => esc_html__( 'If enabled, the theme will use a boxed layout.', 'hestia-pro' ),
		'section' => 'hestia_general',
		'priority' => 5,
		'type' => 'checkbox',
	));
}

add_action( 'customize_register', 'hestia_general_customize_register' );
