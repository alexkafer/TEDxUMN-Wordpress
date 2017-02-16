<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Hestia
 */

if ( is_active_sidebar( 'sidebar-1' )  ) : ?>
	<aside id="secondary" class="col-md-3 col-md-offset-1 blog-sidebar" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>
