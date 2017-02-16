<?php
/**
 * Contact section for the homepage.
 *
 * @package WordPress
 * @subpackage Hestia
 * @since Hestia 1.0
 */

if ( ! function_exists( 'hestia_contact' ) ) :
	/**
	 * Contact section content.
	 *
	 * @since Hestia 1.0
	 */
	function hestia_contact() {
		$hide_section = get_theme_mod( 'hestia_contact_hide', false );
		if ( (bool) $hide_section === true ) {
			return;
		}
		$hestia_contact_title      = get_theme_mod( 'hestia_contact_title', esc_html__( 'Get in Touch', 'hestia-pro' ) );
		$hestia_contact_subtitle   = get_theme_mod( 'hestia_contact_subtitle', esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'hestia-pro' ) );
		$hestia_contact_area_title = get_theme_mod( 'hestia_contact_area_title', esc_html__( 'Contact Us', 'hestia-pro' ) );
		?>
		<section class="contactus section-image" id="contact" data-sorder="hestia_contact"
				 style="background-image: url('<?php echo get_theme_mod( 'hestia_contact_background', get_template_directory_uri() . '/assets/img/contact.jpg' ); ?>')">
			<div class="container">
				<div class="row">
					<div class="col-md-5">
						<?php if ( ! empty( $hestia_contact_title ) || is_customize_preview() ) : ?>
							<h2 class="title"><?php echo esc_html( $hestia_contact_title ); ?></h2>
						<?php endif; ?>
						<?php if ( ! empty( $hestia_contact_subtitle ) || is_customize_preview() ) : ?>
							<h5 class="description"><?php echo esc_html( $hestia_contact_subtitle ); ?></h5>
						<?php endif; ?>
						<?php
						$hestia_contact_content     = get_theme_mod( 'hestia_contact_content', json_encode( array(
							array(
								'icon_value' => 'fa-map-marker',
								'title'      => esc_html__( 'Find us at the office', 'hestia-pro' ),
								'text'       => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'hestia-pro' ),
								'id'         => 'customizer_repeater_56d7ea7f40f56',
							),
							array(
								'icon_value' => 'fa-mobile',
								'title'      => esc_html__( 'Give us a ring', 'hestia-pro' ),
								'text'       => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'hestia-pro' ),
								'id'         => 'customizer_repeater_56d7ea7f40f66',
							),
						) ) );
						if ( ! empty( $hestia_contact_content ) ) :
							$hestia_contact_content = html_entity_decode( $hestia_contact_content );
							$hestia_contact_content = json_decode( $hestia_contact_content );
							foreach ( $hestia_contact_content as $contact_item ) :
								$icon = ! empty( $contact_item->icon_value ) ? apply_filters( 'hestia_translate_single_string', $contact_item->icon_value, 'Contact section', 'Icon' ) : '';
								$title = ! empty( $contact_item->title ) ? apply_filters( 'hestia_translate_single_string', $contact_item->title, 'Contact section', 'Title' ) : '';
								$text = ! empty( $contact_item->text ) ? apply_filters( 'hestia_translate_single_string', $contact_item->text, 'Contact section', 'Text' ) : '';
								?>
								<div class="info info-horizontal">
									<?php if ( ! empty( $icon ) ) : ?>
										<div class="icon icon-primary">
											<i class="fa <?php echo esc_attr( $icon ); ?>"></i>
										</div>
									<?php endif; ?>
									<div class="description">
										<?php if ( ! empty( $title ) ) : ?>
											<h4 class="info-title"><?php echo wp_kses_post( $title ); ?></h4>
										<?php endif; ?>
										<?php if ( ! empty( $text ) ) : ?>
											<p><?php echo wp_kses_post( $text ); ?></p>
										<?php endif; ?>
									</div>
								</div>
								<?php
							endforeach;
						endif;
						?>
					</div>
					<?php if ( defined( 'PIRATE_FORMS_VERSION' ) ) : ?>
						<div class="col-md-5 col-md-offset-2">
							<div class="card card-contact">
								<?php if ( ! empty( $hestia_contact_area_title ) || is_customize_preview() ) : ?>
									<div class="header header-raised header-primary text-center">
										<h4 class="card-title"><?php echo esc_html( $hestia_contact_area_title ); ?></h4>
									</div>
								<?php endif; ?>
								<div class="content">
									<?php echo do_shortcode( '[pirate_forms]' ) ?>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</section>
		<?php
	}
endif;


/**
 * Register polylang strings
 */
function hestia_contact_register_strings() {
	$default = json_encode( array(
		array(
			'icon_value' => 'fa-map-marker',
			'title'      => esc_html__( 'Find us at the office', 'hestia-pro' ),
			'text'       => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'hestia-pro' ),
			'id'         => 'customizer_repeater_56d7ea7f40f56',
		),
		array(
			'icon_value' => 'fa-mobile',
			'title'      => esc_html__( 'Give us a ring', 'hestia-pro' ),
			'text'       => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'hestia-pro' ),
			'id'         => 'customizer_repeater_56d7ea7f40f66',
		),
	) );

	hestia_pll_string_register_helper( 'hestia_contact_content', $default, 'Contact section' );
}


if ( function_exists( 'hestia_contact' ) ) {
	$section_priority = apply_filters( 'hestia_section_priority', 55, 'hestia_contact' );
	add_action( 'hestia_sections', 'hestia_contact', absint( $section_priority ) );
	add_action( 'after_setup_theme', 'hestia_contact_register_strings', 11 );
}
