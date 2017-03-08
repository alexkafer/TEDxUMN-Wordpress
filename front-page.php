<?php
/**
 * The front page template file.
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Hestia
 * @since Hestia 1.0
 */

get_header(); ?>
	<?php
	/**
	 * Hestia Header hook.
	 *
	 * @hooked hestia_slider_section
	 */
	do_action( 'hestia_header' );
	?>
	</header>
	<div class="<?php echo hestia_layout(); ?>">
		<div class="blogs">
			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
					<?php
					if ( have_posts() ) :
						while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/content' );
						endwhile;
						hestia_pagination();
					else :
						get_template_part( 'template-parts/content', 'none' );
					endif;
					?>
					</div>
				</div>
			</div>
		</div>
<?php get_footer(); ?>
