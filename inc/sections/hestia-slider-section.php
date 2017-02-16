<?php
/**
 * Slider section for the homepage.
 *
 * @package WordPress
 * @subpackage Hestia
 * @since Hestia 1.0
 */

if ( ! function_exists( 'hestia_slider' ) ) :
	/**
	 * Slider section content.
	 *
	 * @since Hestia 1.0
	 */
	function hestia_slider() {
		?>
		<div id="carousel-hestia-generic" class="carousel slide" data-ride="carousel">
		<div class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				<?php
				$slider_default = hestia_get_slider_default();
				$hestia_slider_content = get_theme_mod( 'hestia_slider_content', json_encode( $slider_default ) );
				$i = 0;
				if ( ! empty( $hestia_slider_content ) ) :
					$hestia_slider_content = json_decode( $hestia_slider_content );
					foreach ( $hestia_slider_content as $slider_item ) :
						$title = ! empty( $slider_item->title ) ? apply_filters( 'hestia_translate_single_string', $slider_item->title, 'Slider section', 'Title' ) : '';
					    $subtitle = ! empty( $slider_item->subtitle ) ? apply_filters( 'hestia_translate_single_string', $slider_item->subtitle, 'Slider section', 'Subtitle' ) : '';
					    $button = ! empty( $slider_item->text ) ? apply_filters( 'hestia_translate_single_string', $slider_item->text, 'Slider section', 'Button text' ) : '';
					    $link = ! empty( $slider_item->link ) ? apply_filters( 'hestia_translate_single_string', $slider_item->link, 'Slider section', 'Button link' ) : '';
					    $image = ! empty( $slider_item->image_url ) ? apply_filters( 'hestia_translate_single_string', $slider_item->image_url, 'Slider section', 'Image' ) : '';
					    ?>
						<div class="item <?php $i ++;
						if ( $i == 1 ) {
							echo 'active';
						} ?>">
							<?php if ( ! empty( $image ) ) : ?>
							<div class="page-header header-filter"
								 style="background-image: url('<?php echo esc_url( $image ); ?>');">
								<?php else : ?>
								<div class="page-header header-filter">
									<?php endif; ?>
									<div class="container">
										<div class="row">
											<div class="col-md-8 col-md-offset-2 text-center">
												<?php if ( ! empty( $title ) ) : ?>
													<h2 class="title"><?php echo esc_html( $title ); ?></h2>
												<?php endif; ?>
												<?php if ( ! empty( $subtitle ) ) : ?>
													<h4><?php echo esc_html( $subtitle ); ?></h4>
												<?php endif; ?>
												<?php if ( ! empty( $link ) || ! empty( $button ) ) : ?>
													<div class="buttons">
														<a href="<?php echo esc_url( $link ); ?>"
														   class="btn btn-primary btn-lg"><?php echo esc_html( $button ); ?></a>
													</div>
												<?php endif; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php
					endforeach;
				endif; ?>
				</div>
				<?php if ( $i >= 2 ) : ?>
					<a class="left carousel-control" href="#carousel-hestia-generic" data-slide="prev"> <i
							class="fa fa-angle-left"></i> </a>
					<a class="right carousel-control" href="#carousel-hestia-generic" data-slide="next"> <i
							class="fa fa-angle-right"></i> </a>
				<?php endif; ?>
			</div>
		</div>
		<?php

	}

endif;

/**
 * Import lite content to slider
 *
 * @return array
 */
function hestia_get_slider_default() {
	$default = array(
		array(
			'image_url' => get_template_directory_uri() . '/assets/img/slider1.jpg',
			'title'     => esc_html__( 'Lorem Ipsum', 'hestia-pro' ),
			'subtitle'  => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'hestia-pro' ),
			'text'      => esc_html__( 'Button', 'hestia-pro' ),
			'link'      => '#',
			'id'        => 'customizer_repeater_56d7ea7f40a56',
		),
		array(
			'image_url' => get_template_directory_uri() . '/assets/img/slider2.jpg',
			'title'     => esc_html__( 'Lorem Ipsum', 'hestia-pro' ),
			'subtitle'  => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'hestia-pro' ),
			'text'      => esc_html__( 'Button', 'hestia-pro' ),
			'link'      => '#',
			'id'        => 'customizer_repeater_56d7ea7f40a57',
		),
		array(
			'image_url' => get_template_directory_uri() . '/assets/img/slider3.jpg',
			'title'     => esc_html__( 'Lorem Ipsum', 'hestia-pro' ),
			'subtitle'  => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'hestia-pro' ),
			'text'      => esc_html__( 'Button', 'hestia-pro' ),
			'link'      => '#',
			'id'        => 'customizer_repeater_56d7ea7f40a58',
		),
	);

	$lite_content = get_option( 'theme_mods_hestia' );

	if ( $lite_content ) {

		$hestia_big_title_title = $hestia_big_title_text = $hestia_big_title_button_text = $hestia_big_title_button_link = $hestia_big_title_background = '';
		if ( array_key_exists( 'hestia_big_title_title', $lite_content ) ) {
			$hestia_big_title_title = $lite_content['hestia_big_title_title'];
		}
		if ( array_key_exists( 'hestia_big_title_text', $lite_content ) ) {
			$hestia_big_title_text = $lite_content['hestia_big_title_text'];
		}
		if ( array_key_exists( 'hestia_big_title_button_text', $lite_content ) ) {
			$hestia_big_title_button_text = $lite_content['hestia_big_title_button_text'];
		}
		if ( array_key_exists( 'hestia_big_title_button_link', $lite_content ) ) {
			$hestia_big_title_button_link = $lite_content['hestia_big_title_button_link'];
		}
		if ( array_key_exists( 'hestia_big_title_background', $lite_content ) ) {
			$hestia_big_title_background = $lite_content['hestia_big_title_background'];
		}
		if ( ! empty( $hestia_big_title_title ) || ! empty( $hestia_big_title_text ) || ! empty( $hestia_big_title_button_text ) || ! empty( $hestia_big_title_button_link ) || ! empty( $hestia_big_title_background ) ) {
			array_unshift( $default, array(
				'id'          => 'customizer_repeater_56d7ea7f40a56',
				'title'       => $hestia_big_title_title,
				'subtitle'        => $hestia_big_title_text,
				'text' => $hestia_big_title_button_text,
				'link'        => $hestia_big_title_button_link,
				'image_url'   => $hestia_big_title_background,
			) );
		}
	}

	hestia_pll_string_register_helper( 'hestia_slider_content', json_encode( $default ), 'Slider section' );
	return $default;
}
