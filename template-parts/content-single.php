<?php
/**
 * The default template for displaying content
 *
 * Used for single posts.
 *
 * @package WordPress
 * @subpackage Hestia
 * @since Hestia 1.0
 */

$hestia_remove_sidebar_on_single_post = get_theme_mod( 'hestia_sidebar_on_single_post', false );
if ( is_active_sidebar( 'sidebar-1' ) && ( $hestia_remove_sidebar_on_single_post == false ) ) {
	$class_to_add = 'col-md-8';
} else {
	$class_to_add = 'col-md-8 col-md-offset-2';
} ?>

<div class="row">
	<div class=" <?php echo esc_attr( $class_to_add ); ?>">
		<article id="post-<?php the_ID(); ?>" class="section section-text">
			<?php the_content();

			hestia_wp_link_pages( array(
				'before' => '<div class="text-center"> <ul class="nav pagination pagination-primary">',
				'after' => '</ul> </div>',
				'link_before' => '<li>',
				'link_after' => '</li>',
			) );
			?>
		</article>

		
	</div>
	<?php if ( $hestia_remove_sidebar_on_single_post != true ) {
		get_sidebar();
} ?>
</div>
