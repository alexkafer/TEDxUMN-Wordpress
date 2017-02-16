<?php
/**
 * Customizer functionality for the Testimonials section.
 *
 * @package WordPress
 * @subpackage Hestia
 * @since Hestia 1.0
 */

// Load Customizer repeater control.
require_once( trailingslashit( get_template_directory() ) . '/inc/customizer-repeater/functions.php' );

/**
 * Hook controls for Testimonials section to Customizer.
 *
 * @since Hestia 1.0
 */
function hestia_testimonials_customize_register( $wp_customize ) {

	$wp_customize->add_section( 'hestia_testimonials', array(
		'title' => esc_html__( 'Testimonials', 'hestia-pro' ),
		'panel' => 'hestia_frontpage_sections',
		'priority' => apply_filters( 'hestia_section_priority', 40, 'hestia_testimonials' ),
	));

	$wp_customize->add_setting( 'hestia_testimonials_hide', array(
		'sanitize_callback' => 'hestia_sanitize_checkbox',
		'default' => false,
	) );

	$wp_customize->add_control( 'hestia_testimonials_hide', array(
		'type' => 'checkbox',
		'label' => esc_html__( 'Disable section','hestia-pro' ),
		'section' => 'hestia_testimonials',
		'priority' => 1,
	) );

	$wp_customize->add_setting( 'hestia_testimonials_title', array(
		'default' => esc_html__( 'What clients say', 'hestia-pro' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( 'hestia_testimonials_title', array(
		'label' => esc_html__( 'Section Title', 'hestia-pro' ),
		'section' => 'hestia_testimonials',
		'priority' => 5,
	));

	$wp_customize->add_setting( 'hestia_testimonials_subtitle', array(
		'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'hestia-pro' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( 'hestia_testimonials_subtitle', array(
		'label' => esc_html__( 'Section Subtitle', 'hestia-pro' ),
		'section' => 'hestia_testimonials',
		'priority' => 10,
	));

	$wp_customize->add_setting( 'hestia_testimonials_content', array(
		'sanitize_callback' => 'hestia_repeater_sanitize',
		'default' => json_encode( array(
			array(
				'image_url' => get_template_directory_uri() . '/assets/img/5.jpg',
				'title' => esc_html__( 'Inverness McKenzie', 'hestia-pro' ),
				'subtitle' => esc_html__( 'Business Owner', 'hestia-pro' ),
				'text' => esc_html__( '"We have no regrets! After using your product my business skyrocketed! I made back the purchase price in just 48 hours! I couldn\'t have asked for more than this."', 'hestia-pro' ),
				'id' => 'customizer_repeater_56d7ea7f40d56',
			),
			array(
				'image_url' => get_template_directory_uri() . '/assets/img/6.jpg',
				'title' => esc_html__( 'Hanson Deck', 'hestia-pro' ),
				'subtitle' => esc_html__( 'Independent Artist', 'hestia-pro' ),
				'text' => esc_html__( '"Your company is truly upstanding and is behind its product 100 percent. Hestia is worth much more than I paid. I like Hestia more each day because it makes easier."', 'hestia-pro' ),
				'id' => 'customizer_repeater_56d7ea7f40d66',
			),
			array(
				'image_url' => get_template_directory_uri() . '/assets/img/7.jpg',
				'title' => esc_html__( 'Natalya Undergrowth', 'hestia-pro' ),
				'subtitle' => esc_html__( 'Freelancer', 'hestia-pro' ),
				'text' => esc_html__( '"Thank you for making it painless, pleasant and most of all hassle free! I am so pleased with this product. Dude, your stuff is great! I will refer everyone I know."', 'hestia-pro' ),
				'id' => 'customizer_repeater_56d7ea7f40d76',
			),
		)),
	));

	$wp_customize->add_control( new Hestia_Repeater( $wp_customize, 'hestia_testimonials_content', array(
		'label'   => esc_html__( 'Testimonials Content','hestia-pro' ),
		'section' => 'hestia_testimonials',
		'priority' => 15,
		'customizer_repeater_image_control' => true,
		'customizer_repeater_title_control' => true,
		'customizer_repeater_subtitle_control' => true,
		'customizer_repeater_text_control' => true,
		'customizer_repeater_link_control' => true,
	)));

}

add_action( 'customize_register', 'hestia_testimonials_customize_register' );
