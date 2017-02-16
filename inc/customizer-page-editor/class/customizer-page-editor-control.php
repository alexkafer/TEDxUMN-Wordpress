<?php
/**
 * Page editor control
 *
 * @package WordPress
 * @subpackage Hestia
 * @since Hestia 1.1.3
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}
/**
 * Class to create a custom tags control
 */
class Hestia_Page_Editor extends WP_Customize_Control {


	/**
	 * Enqueue scripts
	 */
	public function enqueue() {
		wp_enqueue_script( 'hestia_text_editor', get_template_directory_uri() . '/inc/customizer-page-editor/js/hestia-text-editor.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'tinymce_js', includes_url( 'js/tinymce/' ) . 'wp-tinymce.php', array( 'jquery' ), false, true );
		wp_enqueue_script( 'hestia_controls_script', get_template_directory_uri() . '/inc/customizer-page-editor/js/hestia-update-controls.js', array( 'jquery', 'customize-preview', 'tinymce_js' ), '', true );
		wp_localize_script( 'hestia_controls_script', 'requestpost', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'thumbnail_control' => 'hestia_feature_thumbnail',
			'editor_control' => 'hestia_page_editor',
		));
	}


	/**
	 * Render the content on the theme customizer page
	 */
	public function render_content() {
		?>

		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_textarea( $this->value() ); ?>">
		<?php
		$settings = array(
			'textarea_name' => $this->id,
			'drag_drop_upload' => false,
			'teeny' => true,
		);
		$control_content = $this->value();
		$frontpage_id = get_option( 'page_on_front' );
		$page_content = '';
		if ( ! empty( $frontpage_id ) ) {
			$content_post = get_post( $frontpage_id );
			$page_content = $content_post->post_content;
			$page_content = apply_filters( 'the_content', $page_content );
			$page_content = str_replace( ']]>', ']]&gt;', $page_content );
		}

		if ( $control_content !== $page_content ) {
			$control_content = $page_content;
		}

		wp_editor( $control_content, $this->id, $settings );

		do_action( 'admin_footer' );
		do_action( 'admin_print_footer_scripts' );

	}
}
