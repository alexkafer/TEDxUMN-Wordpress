<?php
/**
 * Customizer functionality for the Shop section.
 *
 * @package WordPress
 * @subpackage Hestia
 * @since Hestia 1.0
 */

/**
 * Hook controls for Shop section to Customizer.
 *
 * @since Hestia 1.0
 */
function hestia_shop_customize_register( $wp_customize ) {

	$wp_customize->add_section( 'hestia_shop', array(
		'title' => esc_html__( 'Shop', 'hestia-pro' ),
		'panel' => 'hestia_frontpage_sections',
		'priority' => apply_filters( 'hestia_section_priority', 20, 'hestia_shop' ),
	));

	if ( class_exists( 'woocommerce' ) ) {

		$wp_customize->add_setting( 'hestia_shop_hide', array(
			'sanitize_callback' => 'hestia_sanitize_checkbox',
			'default' => false,
		) );

		$wp_customize->add_control( 'hestia_shop_hide', array(
			'type' => 'checkbox',
			'label' => esc_html__( 'Disable section','hestia-pro' ),
			'section' => 'hestia_shop',
			'priority' => 1,
		) );

		$wp_customize->add_setting( 'hestia_shop_title', array(
			'default' => esc_html__( 'Products', 'hestia-pro' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
		));

		$wp_customize->add_control( 'hestia_shop_title', array(
			'label' => esc_html__( 'Section Title', 'hestia-pro' ),
			'section' => 'hestia_shop',
			'priority' => 5,
		));

		$wp_customize->add_setting( 'hestia_shop_subtitle', array(
			'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'hestia-pro' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
		));

		$wp_customize->add_control( 'hestia_shop_subtitle', array(
			'label' => esc_html__( 'Section Subtitle', 'hestia-pro' ),
			'section' => 'hestia_shop',
			'priority' => 10,
		));

		$wp_customize->add_setting( 'hestia_shop_items', array(
			'default' => 4,
			'sanitize_callback' => 'absint',
		));

		$wp_customize->add_control( 'hestia_shop_items', array(
			'label' => esc_html__( 'Number of Items', 'hestia-pro' ),
			'section' => 'hestia_shop',
			'priority' => 15,
			'type' => 'number',
		));

	} // End if().

}

add_action( 'customize_register', 'hestia_shop_customize_register' );
