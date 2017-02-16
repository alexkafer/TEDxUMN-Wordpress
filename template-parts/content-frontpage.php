<?php
/**
 * The default template for displaying content
 *
 * Used for frontpage.
 *
 * @package WordPress
 * @subpackage Hestia
 * @since Hestia 1.0
 */
if ( is_customize_preview() ) {
	$frontpage_id = get_option( 'page_on_front' );
	$default = '';
	if ( ! empty( $frontpage_id ) ) {
		$content_post = get_post( $frontpage_id );
		$default = $content_post->post_content;
		$default = apply_filters( 'the_content', $default );
		$default = str_replace( ']]>', ']]&gt;', $default );
		$content = get_theme_mod( 'hestia_page_editor', $default );
		echo wp_kses_post( $content );
	} else {
		the_content();
	}
} else {
	the_content();
}

