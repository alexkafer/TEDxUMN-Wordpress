<?php
/**
 * The template for displaying all single posts and attachments.
 *
 * @package WordPress
 * @subpackage Hestia
 * @since Hestia 1.0
 */

get_header(); ?>
			<div id="primary" class="page-header header-filter header-small" style="background-image: url('<?php echo hestia_featured_header(); ?>');">

			</div>
		</header>
		<div class="<?php echo hestia_layout(); ?>">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center">
						<?php single_post_title( '<h1 class="title">', '</h1>' ); ?>
						</div>
				</div>
			</div>
			<div class="blog-post">
				<div class="container">
					<?php
					if ( have_posts() ) :
						while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/content', 'single' );
						endwhile;
					else :
						get_template_part( 'template-parts/content', 'none' );
					endif;
					?>
				</div>
			</div>
		</div>
		<?php do_action( 'hestia_blog_related_posts' ); ?>
		<div class="footer-wrapper">
<?php get_footer(); ?>
