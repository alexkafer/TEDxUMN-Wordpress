<?php
/**
 * Customizer info singleton class file.
 *
 * @package WordPress
 * @subpackage Hestia
 * @since Hestia 1.0
 */

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Customizer_Info_Singleton {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object $manager WordPress customizer object.
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		require_once( trailingslashit( get_template_directory() ) . 'inc/customizer-info/class/class-customizer-info-section.php' );

		// Register custom section types.
		$manager->register_section_type( 'Customizer_Info' );

		// Register sections.
		if ( ! class_exists( 'Jetpack' ) ) {
			$manager->add_section( new Customizer_Info( $manager, 'hestia_info_jetpack', array(
						'section_text' => sprintf(
							esc_html__( 'To have access to a portfolio section please install and configure %1$s.', 'hestia-pro' ),
							sprintf( '<a href="' . esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=jetpack' ), 'install-plugin_jetpack' ) ) . '" rel="nofollow">%s</a>', esc_html__( 'Jetpack plugin', 'hestia-pro' ) )
						),
						'panel' => 'hestia_frontpage_sections',
						'priority' => 500,
			) ) );
		}

		if ( ! class_exists( 'woocommerce' ) ) {
			$manager->add_section( new Customizer_Info( $manager, 'hestia_info_woocommerce', array(
				'section_text' => sprintf(
					esc_html__( 'To have access to a shop section please install and configure %1$s.', 'hestia-pro' ),
					sprintf( '<a href="' . esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=woocommerce' ), 'install-plugin_woocommerce' ) ) . '" rel="nofollow">%s</a>', esc_html__( 'WooCommerce plugin', 'hestia-pro' ) )
				),
				'panel' => 'hestia_frontpage_sections',
				'priority' => 501,
			) ) );
		}
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'customizer-info-js', trailingslashit( get_template_directory_uri() ) . 'inc/customizer-info/js/customizer-info-controls.js', array( 'customize-controls' ) );

	}
}

Customizer_Info_Singleton::get_instance();
