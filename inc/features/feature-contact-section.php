<?php
/**
 * Customizer functionality for the Contact section.
 *
 * @package WordPress
 * @subpackage Hestia
 * @since Hestia 1.0
 */

// Load Customizer repeater control.
require_once( trailingslashit( get_template_directory() ) . '/inc/customizer-repeater/functions.php' );

/**
 * Hook controls for Contact section to Customizer.
 *
 * @since Hestia 1.0
 */
function hestia_contact_customize_register( $wp_customize ) {

	/**
	 * A custom text control for Contact info.
	 *
	 * @since Hestia 1.0
	 */
	class Hestia_Contact_Info extends WP_Customize_Control {
		/**
		 * Render content for the control.
		 *
		 * @since Hestia 1.0
		 */
		public function render_content() {
			if ( defined( 'PIRATE_FORMS_VERSION' ) ) :
				printf( esc_html__( 'You should be able to see the form on your front-page. You can configure settings from %s, in your WordPress dashboard.','hestia-pro' ), sprintf( '<b>%s</b>', esc_html__( 'Settings > Pirate Forms', 'hestia-pro' ) ) );
			else :
				printf( esc_html__( 'In order to add a contact form to this section, you need need to install %s.','hestia-pro' ), sprintf( '<a href="https://wordpress.org/plugins/pirate-forms/" target="_blank"> %s</a>', esc_html__( 'Pirate Forms plugin', 'hestia-pro' ) ) );
			endif;
		}
	}

	$wp_customize->add_section( 'hestia_contact', array(
		'title' => esc_html__( 'Contact', 'hestia-pro' ),
		'panel' => 'hestia_frontpage_sections',
		'priority' => apply_filters( 'hestia_section_priority', 55, 'hestia_contact' ),
	));

	$wp_customize->add_setting( 'hestia_contact_hide', array(
		'sanitize_callback' => 'hestia_sanitize_checkbox',
		'default' => false,
	) );

	$wp_customize->add_control( 'hestia_contact_hide', array(
		'type' => 'checkbox',
		'label' => esc_html__( 'Disable section','hestia-pro' ),
		'section' => 'hestia_contact',
		'priority' => 1,
	) );

	$wp_customize->add_setting( 'hestia_contact_background', array(
		'default' => get_template_directory_uri() . '/assets/img/contact.jpg',
		'sanitize_callback' => 'esc_url_raw',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hestia_contact_background', array(
		'label' => esc_html__( 'Background Image', 'hestia-pro' ),
		'section' => 'hestia_contact',
		'priority' => 5,
	)));

	$wp_customize->add_setting( 'hestia_contact_title', array(
		'default' => esc_html__( 'Get in Touch', 'hestia-pro' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( 'hestia_contact_title', array(
		'label' => esc_html__( 'Section Title', 'hestia-pro' ),
		'section' => 'hestia_contact',
		'priority' => 10,
	));

	$wp_customize->add_setting( 'hestia_contact_subtitle', array(
		'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'hestia-pro' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( 'hestia_contact_subtitle', array(
		'label' => esc_html__( 'Section Subtitle', 'hestia-pro' ),
		'section' => 'hestia_contact',
		'priority' => 15,
	));

	$wp_customize->add_setting( 'hestia_contact_area_title', array(
		'default' => esc_html__( 'Contact Us', 'hestia-pro' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( 'hestia_contact_area_title', array(
		'label' => esc_html__( 'Form Title', 'hestia-pro' ),
		'section' => 'hestia_contact',
		'priority' => 20,
	));

	$wp_customize->add_setting( 'hestia_contact_info', array(
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control( new Hestia_Contact_Info( $wp_customize, 'hestia_contact_info', array(
		'label' => esc_html__( 'Instructions', 'hestia-pro' ),
		'section' => 'hestia_contact',
		'priority' => 25,
	)));

	$wp_customize->add_setting( 'hestia_contact_content', array(
		'sanitize_callback' => 'hestia_repeater_sanitize',
		'default' => json_encode( array(
			 array(
				'icon_value' => 'fa-map-marker',
				'title' => esc_html__( 'Find us at the office', 'hestia-pro' ),
				'text' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'hestia-pro' ),
				'id' => 'customizer_repeater_56d7ea7f40f56',
			),
			array(
				'icon_value' => 'fa-mobile',
				'title' => esc_html__( 'Give us a ring', 'hestia-pro' ),
				'text' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'hestia-pro' ),
				'id' => 'customizer_repeater_56d7ea7f40f66',
			),
		)),
	));

	$wp_customize->add_control( new Hestia_Repeater( $wp_customize, 'hestia_contact_content', array(
		'label'   => esc_html__( 'Contact Content','hestia-pro' ),
		'section' => 'hestia_contact',
		'priority' => 30,
		'customizer_repeater_icon_control' => true,
		'customizer_repeater_title_control' => true,
		'customizer_repeater_text_control' => true,
	)));

}

add_action( 'customize_register', 'hestia_contact_customize_register' );
