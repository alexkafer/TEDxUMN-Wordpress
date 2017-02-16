<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage Hestia
 * @since Hestia 1.0
 */

$hestia_alternative_blog_layout = get_theme_mod( 'hestia_alternative_blog_layout', false );
$hestia_remove_sidebar_on_index = get_theme_mod( 'hestia_sidebar_on_index', false );
if ( is_active_sidebar( 'sidebar-1' ) && ( $hestia_remove_sidebar_on_index == false ) ) {
	$class_to_add = 'col-md-8 blog-posts-wrap';
} else {
	$class_to_add = 'col-md-10 col-md-offset-1 blog-posts-wrap';
}

get_header();

?>
<div id="primary" class="page-header header-filter header-small" data-parallax="active" style="background-image: url('<?php echo( get_header_image() ); ?>');">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center">
				<h2 class="title"><?php bloginfo( 'description' ); ?></h2>
			</div>
		</div>
	</div>
</div>
</header>
<div class="<?php echo hestia_layout(); ?>">
	<div class="blogs">
		<div class="container">
			<div class="row">
				<div class="<?php echo esc_attr( $class_to_add ); ?>">
					<?php

					if ( have_posts() ) :

						$post_counter = 1;

						while ( have_posts() ) : the_post();
							if ( ( $hestia_alternative_blog_layout == true ) && ( $post_counter % 2 == 0 ) ) {
								get_template_part( 'template-parts/content', 'alternative' );
							} else {
								get_template_part( 'template-parts/content' );
							}
							$post_counter ++;
						endwhile;
						hestia_pagination();
					else :
						get_template_part( 'template-parts/content', 'none' );
					endif;
					?>
				</div>
				<?php if ( $hestia_remove_sidebar_on_index != true ) {
					get_sidebar();
}?>
			</div>
		</div>
	</div>
	<?php do_action( 'hestia_after_archive_content' ) ?>

	<?php get_footer(); ?>
