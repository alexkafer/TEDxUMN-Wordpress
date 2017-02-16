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

		<div class="section section-blog-info">
			<div class="row">
				<div class="col-md-6">
					<div class="entry-categories"><?php _e( 'Categories:', 'hestia-pro' ); ?>
						<?php
						$categories = get_the_category( $post->ID );
						foreach ( $categories as $category ) {
							echo '<span class="label label-primary"><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a></span>';
						}
						?>
					</div>
					<?php the_tags( '<div class="entry-tags">' . esc_html__( 'Tags: ', 'hestia-pro' ) . '<span class="entry-tag">', '</span><span class="entry-tag">', '</span></div>' ); ?>
				</div>
				<div class="col-md-6">
					<?php do_action( 'hestia_blog_social_icons' ); ?>
				</div>
			</div>
			<hr>
			<?php
			$author_description = get_the_author_meta( 'description' );
			if ( ! empty( $author_description ) ) :
				hestia_author_box();
			endif;
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>
		</div>
	</div>
	<?php if ( $hestia_remove_sidebar_on_single_post != true ) {
		get_sidebar();
} ?>
</div>

