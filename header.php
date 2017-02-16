<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the page header div.
 *
 * @package WordPress
 * @subpackage Hestia
 * @since Hestia 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset='<?php bloginfo( 'charset' );?>'>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="wrapper">
		<header class="header">
			<nav class="navbar navbar-default navbar-transparent navbar-fixed-top navbar-color-on-scroll">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-navigation">
							<span class="sr-only"><?php _e( 'Toggle Navigation', 'hestia-pro' ); ?></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<div class="title-logo-wrapper">
							<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>"><?php echo hestia_logo(); ?></a>
						</div>
					</div>
					<?php
						wp_nav_menu( array(
							'menu'              => esc_html__( 'Primary Menu', 'hestia-pro' ),
							'theme_location'    => 'primary',
							'depth'             => 2,
							'container'         => 'div',
							'container_class'   => 'collapse navbar-collapse',
							'container_id'      => 'main-navigation',
							'menu_class'        => 'nav navbar-nav navbar-right',
							'fallback_cb'       => 'hestia_bootstrap_navwalker::fallback',
							'walker'            => new hestia_bootstrap_navwalker(),
						) );
					?>
				</div>
			</nav>
