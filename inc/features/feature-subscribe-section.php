<?php
/**
 * Customizer functionality for the Subscribe section.
 *
 * @package WordPress
 * @subpackage Hestia
 * @since Hestia 1.0
 */

/**
 * Hook controls for Subscribe section to Customizer.
 *
 * @since Hestia 1.0
 */
function hestia_subscribe_customize_register( $wp_customize ) {

	/**
	 * A custom text control for Subscribe info.
	 *
	 * @since Hestia 1.0
	 */
	class Hestia_Subscribe_Info extends WP_Customize_Control {
		/**
		 * Render content for the control.
		 *
		 * @since Hestia 1.0
		 */
		public function render_content() {
			printf( esc_html__( 'The main content of this section is customizable in: %1$s. There you must add the "SendinBlue Newsletter" widget. But first you will need to install %2$s.','hestia-pro' ), sprintf( '<b>%s</b>', esc_html__( 'Customize > Widgets > Subscribe Section', 'hestia-pro' ) ), sprintf( '<a href="https://wordpress.org/plugins/mailin/" target="_blank">%s</a>', esc_html__( 'SendinBlue plugin', 'hestia-pro' ) ) );

			echo '<br/><br/>';
			printf( esc_html__( 'After installing the plugin, you need to navigate to %s, and configure the plugin.','hestia-pro' ), sprintf( '<b>%s</b>', esc_html( 'Sendinblue > Home', 'hestia-pro' ) ) );
			echo '<br/><br/>';
			echo esc_html__( 'And then you need to navigate to its Settings, and use the following in Subscription form:','hestia-pro' );
			echo '<br/><br/>';
			echo '<textarea style="width:100%;height:180px;font-size:12px;" readonly="">';
		?>
<div class="col-sm-8">
	<div class="input-group">
		<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
		<input type="email" class="sib-email-area form-control" name="email" required="required" placeholder="Your Email Here">
	</div>
</div>
<div class="col-sm-4">
	<input type="submit" class="btn btn-primary btn-block sib-default-btn" name="submit" value="Subscribe">
</div>
		<?php
			echo '</textarea>';
		}
	}

	$wp_customize->add_section( 'hestia_subscribe', array(
		'title' => esc_html__( 'Subscribe', 'hestia-pro' ),
		'panel' => 'hestia_frontpage_sections',
		'priority' => apply_filters( 'hestia_section_priority', 45, 'hestia_subscribe' ),
	));

	$wp_customize->add_setting( 'hestia_subscribe_hide', array(
		'sanitize_callback' => 'hestia_sanitize_checkbox',
		'default' => true,
	) );

	$wp_customize->add_control( 'hestia_subscribe_hide', array(
		'type' => 'checkbox',
		'label' => esc_html__( 'Disable section','hestia-pro' ),
		'section' => 'hestia_subscribe',
		'priority' => 1,
	) );

	$wp_customize->add_setting( 'hestia_subscribe_background', array(
		'default' => get_template_directory_uri() . '/assets/img/about.jpg',
		'sanitize_callback' => 'esc_url_raw',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hestia_subscribe_background', array(
		'label' => esc_html__( 'Background Image', 'hestia-pro' ),
		'section' => 'hestia_subscribe',
		'priority' => 5,
	)));

	$wp_customize->add_setting( 'hestia_subscribe_title', array(
		'default' => esc_html__( 'Subscribe to our Newsletter', 'hestia-pro' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( 'hestia_subscribe_title', array(
		'label' => esc_html__( 'Section Title', 'hestia-pro' ),
		'section' => 'hestia_subscribe',
		'priority' => 10,
	));

	$wp_customize->add_setting( 'hestia_subscribe_subtitle', array(
		'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'hestia-pro' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( 'hestia_subscribe_subtitle', array(
		'label' => esc_html__( 'Section Subtitle', 'hestia-pro' ),
		'section' => 'hestia_subscribe',
		'priority' => 15,
	));

	$wp_customize->add_setting( 'hestia_subscribe_info', array(
		'sanitize_callback' => 'sanitize_text_field',
	));

	$wp_customize->add_control( new Hestia_Subscribe_Info( $wp_customize, 'hestia_subscribe_info', array(
		'label' => esc_html__( 'Instructions', 'hestia-pro' ),
		'section' => 'hestia_subscribe',
		'priority' => 20,
	)));

}

add_action( 'customize_register', 'hestia_subscribe_customize_register' );
