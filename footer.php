<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "wrapper" div and all content after.
 *
 * @package WordPress
 * @subpackage Hestia
 * @since Hestia 1.0
 */

$hestia_general_credits = get_theme_mod( 'hestia_general_credits',
	sprintf(
		esc_html__( '%1$s | Powered by %2$s', 'hestia-pro' ),
		sprintf( '<a href="https://themeisle.com/themes/hestia/" target="_blank" rel="nofollow">%s</a>', esc_html__( 'Hestia', 'hestia-pro' ) ),
	sprintf( '<a href="http://wordpress.org/" rel="nofollow">%s</a>', esc_html__( 'WordPress', 'hestia-pro' ) ) )
); ?>

				<footer class="footer footer-black footer-big">
					<div class="container">
						<div class="content">
							<div class="row">
								<div class="col-md-12">
								<?php if ( is_active_sidebar( 'footer-one-widgets' ) ) : ?>
									<div class="col-md-4">
									<?php dynamic_sidebar( 'footer-one-widgets' ); ?>
									</div>
								<?php endif; ?>
								<?php if ( is_active_sidebar( 'footer-two-widgets' ) ) : ?>
									<div class="col-md-4">
									<?php dynamic_sidebar( 'footer-two-widgets' ); ?>
									</div>
								<?php endif; ?>
								<?php if ( is_active_sidebar( 'footer-three-widgets' ) ) : ?>
									<div class="col-md-4">
									<?php dynamic_sidebar( 'footer-three-widgets' ); ?>
									</div>
								<?php endif; ?>
								</div>
							</div>
						</div>
						<hr />
						<?php
							wp_nav_menu( array(
								'menu'              => esc_html__( 'Footer Menu', 'hestia-pro' ),
								'theme_location'    => 'footer',
								'depth'             => 1,
								'container'         => 'ul',
								'menu_class'   => 'footer-menu pull-left',
							) );
						?>
						<?php if ( ! empty( $hestia_general_credits ) || is_customize_preview() ) : ?>
						<div class="copyright pull-right">
							<?php echo wp_kses_post( $hestia_general_credits ); ?>
						</div>
						<?php endif; ?>
					</div>
				</footer>
		</div>
	</div>
<?php wp_footer(); ?>
</body>
</html>
