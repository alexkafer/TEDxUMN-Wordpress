<?php
/**
 * Customizer functionality for the Features section.
 *
 * @package WordPress
 * @subpackage Hestia
 * @since Hestia 1.0
 */

// Load Customizer repeater control.
require_once( trailingslashit( get_template_directory() ) . '/inc/customizer-repeater/functions.php' );

/**
 * Hook controls for Features section to Customizer.
 *
 * @since Hestia 1.0
 */
function hestia_features_customize_register( $wp_customize ) {

	$wp_customize->add_section( 'hestia_features', array(
		'title' => esc_html__( 'Features', 'hestia-pro' ),
		'panel' => 'hestia_frontpage_sections',
		'priority' => apply_filters( 'hestia_section_priority', 10, 'hestia_features' ),
	));

	$wp_customize->add_setting( 'hestia_features_hide', array(
		'sanitize_callback' => 'hestia_sanitize_checkbox',
		'default' => false,
	) );

	$wp_customize->add_control( 'hestia_features_hide', array(
		'type' => 'checkbox',
		'label' => esc_html__( 'Disable section','hestia-pro' ),
		'section' => 'hestia_features',
		'priority' => 1,
	) );

	$wp_customize->add_setting( 'hestia_features_title', array(
		'default' => esc_html__( 'Why our product is the best', 'hestia-pro' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( 'hestia_features_title', array(
		'label' => esc_html__( 'Section Title', 'hestia-pro' ),
		'section' => 'hestia_features',
		'priority' => 5,
	));

	$wp_customize->add_setting( 'hestia_features_subtitle', array(
		'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'hestia-pro' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( 'hestia_features_subtitle', array(
		'label' => esc_html__( 'Section Subtitle', 'hestia-pro' ),
		'section' => 'hestia_features',
		'priority' => 10,
	));

	$wp_customize->add_setting( 'hestia_features_content', array(
		'sanitize_callback' => 'hestia_repeater_sanitize',
		'default' => json_encode( array(
			 array(
				'icon_value' => 'fa-wechat',
				'title' => esc_html__( 'Responsive', 'hestia-pro' ),
				'text' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'hestia-pro' ),
				'link' => '#',
				'id' => 'customizer_repeater_56d7ea7f40b56',
				'color' => '#e91e63',
			),
			array(
				'icon_value' => 'fa-check',
				'title' => esc_html__( 'Quality', 'hestia-pro' ),
				'text' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'hestia-pro' ),
				'link' => '#',
				'id' => 'customizer_repeater_56d7ea7f40b66',
				'color' => '#00bcd4',
			),
		   	array(
				'icon_value' => 'fa-support',
				'title' => esc_html__( 'Support', 'hestia-pro' ),
				'text' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'hestia-pro' ),
				'link' => '#',
				'id' => 'customizer_repeater_56d7ea7f40b86',
				'color' => '#4caf50',
			),
		)),
	));

	$wp_customize->add_control( new Hestia_Repeater( $wp_customize, 'hestia_features_content', array(
		'label'   => esc_html__( 'Features Content','hestia-pro' ),
		'section' => 'hestia_features',
		'priority' => 15,
		'customizer_repeater_icon_control' => true,
		'customizer_repeater_title_control' => true,
		'customizer_repeater_text_control' => true,
		'customizer_repeater_link_control' => true,
		'customizer_repeater_color_control' => true,
	)));

}

add_action( 'customize_register', 'hestia_features_customize_register' );

/**
 * Callback for WooCommerce customizer controls.
 *
 * @return bool
 */
function hestia_woocommerce_check() {
	if ( class_exists( 'woocommerce' ) ) {
		return true;
	}
}
