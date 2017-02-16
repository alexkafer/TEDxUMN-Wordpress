<?php
/**
 * Shop section for the homepage.
 *
 * @package WordPress
 * @subpackage Hestia
 * @since Hestia 1.0
 */

if ( ! function_exists( 'hestia_shop' ) ) :
	/**
	 * Shop section content.
	 *
	 * @since Hestia 1.0
	 */
	function hestia_shop() {
		$hide_section = get_theme_mod( 'hestia_shop_hide', false );
		if ( (bool) $hide_section === true ) {
			return;
		}
		if ( class_exists( 'woocommerce' ) ) :
			$hestia_shop_title = get_theme_mod( 'hestia_shop_title', esc_html__( 'Products', 'hestia-pro' ) );
			$hestia_shop_subtitle = get_theme_mod( 'hestia_shop_subtitle', esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'hestia-pro' ) );
			$hestia_shop_items = get_theme_mod( 'hestia_shop_items', 4 );
		?>
		<section class="products section-gray" id="products" data-sorder="hestia_shop">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center">
					<?php if ( ! empty( $hestia_shop_title ) || is_customize_preview() ) : ?>
						<h2 class="title"><?php echo esc_html( $hestia_shop_title ); ?></h2>
					<?php endif; ?>
					<?php if ( ! empty( $hestia_shop_subtitle ) || is_customize_preview() ) : ?>
						<h5 class="description"><?php echo esc_html( $hestia_shop_subtitle ); ?></h5>
					<?php endif; ?>
					</div>
				</div>
				<div class="row">
				<?php if ( ! empty( $hestia_shop_items ) ) : ?>
					<?php $loop = new WP_Query( array( 'post_type' => 'product', 'posts_per_page' => absint( $hestia_shop_items ) ) ); ?>
				<?php else : ?>
					<?php $loop = new WP_Query( array( 'post_type' => 'product', 'posts_per_page' => 4 ) ); ?>
				<?php endif; ?>
				<?php
				if ( $loop->have_posts() ) :
					while ( $loop->have_posts() ) : $loop->the_post();
						global $product;
						global $post;
				?>
					<div class="col-sm-6 col-md-3 shop-item">
						<div class="card card-product">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="card-image">
								<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php esc_attr( the_title() ); ?>">
									<?php the_post_thumbnail( 'hestia-shop' ); ?>
								</a>
								<div class="ripple-container"></div>
							</div>
						<?php endif; ?>
							<div class="content">
								<?php $product_categories = $product->get_categories();

								if ( ! empty( $product_categories ) ) {

									$allowed_html = array(
										'a' => array(
											'href' => array(),
											'rel' => array(),
										),
									);

									echo '<h6 class="category">';

										echo wp_kses( $product_categories, $allowed_html );

									echo '</h6>';
								}
								?>

								<h4 class="card-title">

									<a class="shop-item-title-link" href="<?php the_permalink(); ?>" title="<?php esc_attr( the_title() ); ?>"><?php esc_html( the_title() ); ?></a>

								</h4>

								<?php if ( $post->post_excerpt ) : ?>

									<div class="card-description"><?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?></div>

								<?php endif; ?>

								<div class="footer">

									<?php $product_price = $product->get_price_html();

									if ( ! empty( $product_price ) ) {

										echo '<div class="price"><h4>';

												echo wp_kses( $product_price, array( 'span' => array( 'class' => array() ) ) );

										echo '</h4></div>';

									} ?>

									<div class="stats">
									<?php hestia_add_to_cart(); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php
					endwhile;
				endif;
				?>
				</div>
			</div>
		</section>
		<?php
		endif;
	}

endif;

if ( function_exists( 'hestia_shop' ) ) {
	$section_priority = apply_filters( 'hestia_section_priority', 20, 'hestia_shop' );
	add_action( 'hestia_sections', 'hestia_shop', absint( $section_priority ) );
}
