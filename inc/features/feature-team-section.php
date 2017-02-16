<?php
/**
 * Customizer functionality for the Team section.
 *
 * @package WordPress
 * @subpackage Hestia
 * @since Hestia 1.0
 */

// Load Customizer repeater control.
require_once( trailingslashit( get_template_directory() ) . '/inc/customizer-repeater/functions.php' );

/**
 * Hook controls for Team section to Customizer.
 *
 * @since Hestia 1.0
 */
function hestia_team_customize_register( $wp_customize ) {

	$wp_customize->add_section( 'hestia_team', array(
		'title' => esc_html__( 'Team', 'hestia-pro' ),
		'panel' => 'hestia_frontpage_sections',
		'priority' => apply_filters( 'hestia_section_priority', 30, 'hestia_team' ),
	));

	$wp_customize->add_setting( 'hestia_team_hide', array(
		'sanitize_callback' => 'hestia_sanitize_checkbox',
		'default' => false,
	) );

	$wp_customize->add_control( 'hestia_team_hide', array(
		'type' => 'checkbox',
		'label' => esc_html__( 'Disable section','hestia-pro' ),
		'section' => 'hestia_team',
		'priority' => 1,
	) );

	$wp_customize->add_setting( 'hestia_team_title', array(
		'default' => esc_html__( 'Meet our team', 'hestia-pro' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( 'hestia_team_title', array(
		'label' => esc_html__( 'Section Title', 'hestia-pro' ),
		'section' => 'hestia_team',
		'priority' => 5,
	));

	$wp_customize->add_setting( 'hestia_team_subtitle', array(
		'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'hestia-pro' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( 'hestia_team_subtitle', array(
		'label' => esc_html__( 'Section Subtitle', 'hestia-pro' ),
		'section' => 'hestia_team',
		'priority' => 10,
	));

	$wp_customize->add_setting( 'hestia_team_content', array(
		'sanitize_callback' => 'hestia_repeater_sanitize',
		'default' => json_encode( array(
			 array(
				'image_url' => get_template_directory_uri() . '/assets/img/1.jpg',
				'title' => esc_html__( 'Desmond Purpleson', 'hestia-pro' ),
				'subtitle' => esc_html__( 'CEO', 'hestia-pro' ),
				'text' => esc_html__( 'Locavore pinterest chambray affogato art party, forage coloring book typewriter. Bitters cold selfies, retro celiac sartorial mustache.', 'hestia-pro' ),
				'id' => 'customizer_repeater_56d7ea7f40c56',
				'social_repeater' => json_encode( array(
					array(
						'id' => 'customizer-repeater-social-repeater-57fb908674e06',
						'link' => 'facebook.com',
						'icon' => 'fa-facebook',
					),
					array(
						'id' => 'customizer-repeater-social-repeater-57fb9148530ft',
						'link' => 'plus.google.com',
						'icon' => 'fa-google-plus',
					),
					array(
						'id' => 'customizer-repeater-social-repeater-57fb9148530fc',
						'link' => 'twitter.com',
						'icon' => 'fa-twitter',
					),
					array(
						'id' => 'customizer-repeater-social-repeater-57fb9150e1e89',
						'link' => 'linkedin.com',
						'icon' => 'fa-linkedin',
					),
				) ),
			),
			array(
				'image_url' => get_template_directory_uri() . '/assets/img/2.jpg',
				'title' => esc_html__( 'Parsley Pepperspray', 'hestia-pro' ),
				'subtitle' => esc_html__( 'Marketing Specialist', 'hestia-pro' ),
				'text' => esc_html__( 'Craft beer salvia celiac mlkshk. Pinterest celiac tumblr, portland salvia skateboard cliche thundercats. Tattooed chia austin hell.', 'hestia-pro' ),
				'id' => 'customizer_repeater_56d7ea7f40c66',
				'social_repeater' => json_encode( array(
					array(
						'id' => 'customizer-repeater-social-repeater-57fb9155a1072',
						'link' => 'facebook.com',
						'icon' => 'fa-facebook',
					),
					array(
						'id' => 'customizer-repeater-social-repeater-57fb9160ab683',
						'link' => 'twitter.com',
						'icon' => 'fa-twitter',
					),
					array(
						'id' => 'customizer-repeater-social-repeater-57fb9160ab484',
						'link' => 'pinterest.com',
						'icon' => 'fa-pinterest',
					),
					array(
						'id' => 'customizer-repeater-social-repeater-57fb916ddffc9',
						'link' => 'linkedin.com',
						'icon' => 'fa-linkedin',
					),
				) ),
			),
		   	array(
				'image_url' => get_template_directory_uri() . '/assets/img/3.jpg',
				'title' => esc_html__( 'Desmond Eagle', 'hestia-pro' ),
				'subtitle' => esc_html__( 'Graphic Designer', 'hestia-pro' ),
				'text' => esc_html__( 'Pok pok direct trade godard street art, poutine fam typewriter food truck narwhal kombucha wolf cardigan butcher whatever pickled you.', 'hestia-pro' ),
				'id' => 'customizer_repeater_56d7ea7f40c76',
				'social_repeater' => json_encode( array(
					array(
						'id' => 'customizer-repeater-social-repeater-57fb917e4c69e',
						'link' => 'facebook.com',
						'icon' => 'fa-facebook',
					),
					array(
						'id' => 'customizer-repeater-social-repeater-57fb91830825c',
						'link' => 'twitter.com',
						'icon' => 'fa-twitter',
					),
					array(
						'id' => 'customizer-repeater-social-repeater-57fb918d65f2e',
						'link' => 'linkedin.com',
						'icon' => 'fa-linkedin',
					),
					array(
						'id' => 'customizer-repeater-social-repeater-57fb918d65f2x',
						'link' => 'dribbble.com',
						'icon' => 'fa-dribbble',
					),
				) ),
			),
		   	array(
				'image_url' => get_template_directory_uri() . '/assets/img/4.jpg',
				'title' => esc_html__( 'Ruby Von Rails', 'hestia-pro' ),
				'subtitle' => esc_html__( 'Lead Developer', 'hestia-pro' ),
				'text' => esc_html__( 'Small batch vexillologist 90\'s blue bottle stumptown bespoke. Pok pok tilde fixie chartreuse, VHS gluten-free selfies wolf hot.', 'hestia-pro' ),
				'id' => 'customizer_repeater_56d7ea7f40c86',
				'social_repeater' => json_encode( array(
					array(
						'id' => 'customizer-repeater-social-repeater-57fb925cedcg5',
						'link' => 'github.com',
						'icon' => 'fa-github-square',
					),
					array(
						'id' => 'customizer-repeater-social-repeater-57fb925cedcb2',
						'link' => 'facebook.com',
						'icon' => 'fa-facebook',
					),
					array(
						'id' => 'customizer-repeater-social-repeater-57fb92615f030',
						'link' => 'twitter.com',
						'icon' => 'fa-twitter',
					),
					array(
						'id' => 'customizer-repeater-social-repeater-57fb9266c223a',
						'link' => 'linkedin.com',
						'icon' => 'fa-linkedin',
					),
				) ),
			),
		)),
	));

	$wp_customize->add_control( new Hestia_Repeater( $wp_customize, 'hestia_team_content', array(
		'label'   => esc_html__( 'Team Content','hestia-pro' ),
		'section' => 'hestia_team',
		'priority' => 15,
		'customizer_repeater_image_control' => true,
		'customizer_repeater_title_control' => true,
		'customizer_repeater_subtitle_control' => true,
		'customizer_repeater_text_control' => true,
		'customizer_repeater_link_control' => true,
		'customizer_repeater_repeater_control' => true,
	)));

}

add_action( 'customize_register', 'hestia_team_customize_register' );
