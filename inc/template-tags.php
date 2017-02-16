<?php
/**
 * Custom template tags for Hestia
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WordPress
 * @subpackage Hestia
 * @since Hestia 1.0
 */

if ( ! function_exists( 'hestia_layout' ) ) :
	/**
	 * Return class based on the layout.
	 *
	 * @since Hestia 1.0
	 */
	function hestia_layout() {
		$hestia_general_layout = get_theme_mod( 'hestia_general_layout', 1 );
		if ( isset( $hestia_general_layout ) && $hestia_general_layout != 1 ) {
			$layout = 'main';
		} else {
			$layout = 'main main-raised';
		}
		return $layout;
	}
endif;

if ( ! function_exists( 'hestia_logo' ) ) :
	/**
	 * Display your custom logo if present.
	 *
	 * @since Hestia 1.0
	 */
	function hestia_logo() {
		if ( get_theme_mod( 'custom_logo' ) ) {
			$logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ) , 'full' );
			$logo = '<img src="' . esc_url( $logo[0] ) . '">';
		} else {
			if ( is_front_page() ) {
				$logo = '<h1>' . get_bloginfo( 'name' ) . '</h1>';
			} else {
				$logo = '<p>' . get_bloginfo( 'name' ) . '</p>';
			}
		}
		return $logo;
	}
endif;

if ( ! function_exists( 'hestia_category' ) ) :
	/**
	 * Display the first category of the post.
	 *
	 * @since Hestia 1.0
	 */
	function hestia_category() {
		$category = get_the_category();
		if ( $category ) {
			echo '<a href="' . esc_url( get_category_link( $category[0]->term_id ) ) . '" title="' . sprintf( esc_html__( 'View all posts in %s', 'hestia-pro' ), esc_html( $category[0]->name ) ) . '" ' . '>' . esc_html( $category[0]->name ) . '</a> ';
		}
	}
endif;

if ( ! function_exists( 'hestia_pagination' ) ) :
	/**
	 * Display a custom number page navigation.
	 *
	 * @since Hestia 1.0
	 */
	function hestia_pagination() {
		global $wp_query;
		$big = 999999999; // need an unlikely integer
		$pages = paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var( 'paged' ) ),
			'total' => $wp_query->max_num_pages,
			'type'  => 'array',
		) );
		if ( is_array( $pages ) ) {
			echo '<div class="col-md-8 col-md-offset-2 text-center"><ul class="nav pagination pagination-primary">';
			foreach ( $pages as $page ) {
				echo '<li>' . $page . '</li>';
			}
			echo '</ul></div>';
		}
	}
endif;

if ( ! function_exists( 'hestia_get_author' ) ) :
	/**
	 * Returns the author meta data outside the loop.
	 *
	 * @since Hestia 1.0
	 */
	function hestia_get_author( $info ) {
		global $post;
		$author_id = $post->post_author;
		$author = get_the_author_meta( $info, $author_id );
		return $author;
	}
endif;

if ( ! function_exists( 'hestia_author_box' ) ) :
	/**
	 * Display author box below the posts.
	 *
	 * @since Hestia 1.0
	 */
	function hestia_author_box() {
		?>
		<div class="card card-profile card-plain">
			<div class="row">
				<div class="col-md-2">
					<div class="card-avatar">
						<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php esc_attr( the_author() ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?></a>
					</div>
				</div>
				<div class="col-md-10">
					<h4 class="card-title"><?php esc_html( the_author() ); ?></h4>
					<p class="description"><?php esc_html( the_author_meta( 'description' ) ); ?></p>
				</div>
			</div>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'hestia_featured_header' ) ) :
	/**
	 * Returns the header image if the featured image isn't available.
	 *
	 * @since Hestia 1.0
	 */
	function hestia_featured_header() {
		$thumbnail = esc_url( get_the_post_thumbnail_url() );
		if ( ! $thumbnail ) {
			$thumbnail = esc_url( get_header_image() );
		}
		return esc_url( $thumbnail );
	}
endif;

if ( ! function_exists( 'hestia_wp_link_pages' ) ) :
	/**
	 * Display a custom wp_link_pages for singular view.
	 *
	 * @since Hestia 1.0
	 */
	function hestia_wp_link_pages( $args = '' ) {
		$defaults = array(
			'before' => '<ul class="nav pagination pagination-primary">',
			'after' => '</ul>',
			'link_before' => '',
			'link_after' => '',
			'next_or_number' => 'number',
			'nextpagelink' => esc_html__( 'Next page', 'hestia-pro' ),
			'previouspagelink' => esc_html__( 'Previous page', 'hestia-pro' ),
			'pagelink' => '%',
			'echo' => 1,
		);

		$r = wp_parse_args( $args, $defaults );
		$r = apply_filters( 'wp_link_pages_args', $r );

		global $page, $numpages, $multipage, $more, $pagenow;

		$output = '';
		if ( $multipage ) {
			if ( 'number' == $r['next_or_number'] ) {
				$output .= $r['before'];
				for ( $i = 1; $i < ( $numpages + 1 ); $i = $i + 1 ) {
					$j = str_replace( '%', $i, $r['pagelink'] );
					$output .= ' ';
					$output .= $r['link_before'];
					if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) ) {
						$output .= _wp_link_page( $i );
					} else {
						$output .= '<span class="page-numbers current">';
					}
					$output .= $j;
					if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) ) {
						$output .= '</a>';
					} else {
						$output .= '</span>';
					}
					$output .= $r['link_after'];
				}
				$output .= $r['after'];
			} else {
				if ( $more ) {
					$output .= $r['before'];
					$i = $page - 1;
					if ( $i && $more ) {
						$output .= _wp_link_page( $i );
						$output .= $r['link_before'] . $r['previouspagelink'] . $r['link_after'] . '</a>';
					}
					$i = $page + 1;
					if ( $i <= $numpages && $more ) {
						$output .= _wp_link_page( $i );
						$output .= $r['link_before'] . $r['nextpagelink'] . $r['link_after'] . '</a>';
					}
					$output .= $r['after'];
				}
			}// End if().
		}// End if().

		if ( $r['echo'] ) {
			echo wp_kses( $output, array(
				'div' => array(
					'class' => array(),
					'id' => array(),
				),
				'ul' => array(
					'class' => array(),
				),
				'a' => array(
					'href' => array(),
				),
				'li' => array(),
				'span' => array(
					'class' => array(),
				),
			) );
		}

		return $output;
	}
endif;

if ( ! function_exists( 'hestia_comments_list' ) ) :
	/**
	 * Custom list of comments for the theme.
	 *
	 * @since Hestia 1.0
	 */
	function hestia_comments_list( $comment, $args, $depth ) {
		?>
		<div <?php comment_class( empty( $args['has_children'] ) ? 'media' : 'parent media' ) ?> id="comment-<?php comment_ID() ?>">
		<?php if ( $args['type'] != 'pings' ) : ?>
			<a class="pull-left" href="<?php echo esc_url( get_comment_author_url( $comment ) ); ?> ">
				<div class="comment-author avatar vcard">
					<?php if ( $args['avatar_size'] != 0 ) { echo get_avatar( $comment, 64 ); } ?>
				</div>
			</a>
		<?php endif; ?>
			<div class="media-body">
				<h4 class="media-heading">
					<?php echo get_comment_author_link(); ?>
					<small>
					<?php
					// * translators: 1: date, 2: time */
					printf( esc_html__( '. %1$s at %2$s', 'hestia-pro' ), get_comment_date(),  get_comment_time() );
					edit_comment_link( esc_html__( '(Edit)', 'hestia-pro' ), '  ', '' );
					?>
					</small>
				</h4>
				<?php comment_text(); ?>
				<div class="media-footer">
					<?php
						echo get_comment_reply_link(
							array(
								'depth' => $depth,
								'max_depth' => $args['max_depth'],
								'reply_text' => sprintf( '<i class="fa fa-mail-reply"></i> %s', esc_html__( 'Reply', 'hestia-pro' ) ),
							),
							$comment->comment_ID,
							$comment->comment_post_ID
						); ?>
				</div>
			</div>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'hestia_comments_template' ) ) :
	/**
	 * Custom list of comments for the theme.
	 *
	 * @since Hestia 1.0
	 */
	function hestia_comments_template() {
		if ( is_user_logged_in() ) {
			$current_user = get_avatar( wp_get_current_user(), 64 );
		} else {
			$current_user = '<img src="' . get_template_directory_uri() . '/assets/img/placeholder.jpg" height="64" width="64"/>';
		}
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$args = array(
			'class_form' => 'form',
			'class_submit' => 'btn btn-primary pull-right',
			'title_reply_before' => '<h3 class="title text-center">',
			'title_reply_after' => '</h3> <span class="pull-left author"> <div class="avatar">' . $current_user . '</div> </span> <div class="media-body">',
			'fields' => apply_filters( 'comment_form_default_fields', array(
				'author' => '<div class="row"> <div class="col-md-4"> <div class="form-group label-floating is-empty"> <label class="control-label">' . esc_html__( 'Name', 'hestia-pro' ) . '</label><input id="author" name="author" class="form-control" type="text"' . $aria_req . ' /> <span class="hestia-input"></span> </div> </div>',
				'email' => '<div class="col-md-4"> <div class="form-group label-floating is-empty"> <label class="control-label">' . esc_html__( 'Email', 'hestia-pro' ) . '</label><input id="author" name="author" class="form-control" type="email"' . $aria_req . ' /> <span class="hestia-input"></span> </div> </div>',
				'url' => '<div class="col-md-4"> <div class="form-group label-floating is-empty"> <label class="control-label">' . esc_html__( 'Website', 'hestia-pro' ) . '</label><input id="author" name="author" class="form-control" type="url"' . $aria_req . ' /> <span class="hestia-input"></span> </div> </div> </div>',
			) ),
			'comment_field' => '<div class="form-group label-floating is-empty"> <label class="control-label">' . esc_html__( 'What\'s in your mind?', 'hestia-pro' ) . '</label><textarea id="comment" name="comment" class="form-control" rows="6" aria-required="true"></textarea><span class="hestia-input"></span> </div> </div>',
		);
		return $args;
	}
endif;

if ( ! function_exists( 'hestia_comments_pagination' ) ) :
	/**
	 * Display a custom number page navigation for comments.
	 *
	 * @since Hestia 1.0
	 */
	function hestia_comments_pagination() {
		$pages = paginate_comments_links( array(
					'echo' => false,
					'type' => 'array',
		) );
		if ( is_array( $pages ) ) {
			echo '<div class="text-center"><ul class="nav pagination pagination-primary">';
			foreach ( $pages as $page ) {
				echo '<li>' . $page . '</li>';
			}
			echo '</ul></div>';
		}
	}
endif;

if ( ! function_exists( 'hestia_related_posts' ) ) :
	/**
	 * Related posts for single view.
	 *
	 * @since Hestia 1.0
	 */
	function hestia_related_posts() {
		global $post;
		$cats = wp_get_object_terms( $post->ID, 'category', array( 'fields' => 'ids' ) );
		$args = array(
			'posts_per_page' => 3,
			'cat' => $cats,
			'orderby' => 'rand',
			'ignore_sticky_posts' => true,
			'post__not_in' => array( $post->ID ),
		);
		$loop = new WP_Query( $args );
		if ( $loop->have_posts() ) :
?>
<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="title text-center"><?php _e( 'Related Posts', 'hestia-pro' ); ?></h2>
				<div class="row">
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<div class="col-md-4">
						<div class="card card-blog">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="card-image">
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<?php the_post_thumbnail( 'hestia-blog' ); ?>
								</a>
							</div>
						<?php endif; ?>
							<div class="content">
								<h6 class="category text-info"><?php hestia_category(); ?></h6>
								<?php the_title( sprintf( '<h4 class="card-title"><a class="blog-item-title-link"  href="%s" title="%s" rel="bookmark">', esc_url( get_permalink() ), esc_attr( get_the_title() ) ), '</a></h4>' ); ?>
								<p class="card-description"><?php echo wp_kses_post( get_the_excerpt() ); ?></p>
							</div>
						</div>
					</div>
		<?php endwhile; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
		endif;
	}
endif;

if ( ! function_exists( 'hestia_social_icons' ) ) :
	/**
	 * Social sharing icons for single view.
	 *
	 * @since Hestia 1.0
	 */
	function hestia_social_icons() {
?>
		<div class="entry-social">
			<a target="_blank" rel="tooltip" data-original-title="<?php _e( 'Share on Facebook', 'hestia-pro' ); ?>" class="btn btn-just-icon btn-round btn-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php esc_url( the_permalink() ); ?>"><i class="fa fa-facebook"></i></a>
			<a target="_blank" rel="tooltip" data-original-title="<?php _e( 'Share on Twitter', 'hestia-pro' ); ?>" class="btn btn-just-icon btn-round btn-twitter" href="https://twitter.com/home?status=<?php echo wp_strip_all_tags( get_the_title() ); ?> - <?php esc_url( the_permalink() ); ?>"><i class="fa fa-twitter"></i></a>
			<a target="_blank" rel="tooltip" data-original-title="<?php _e( 'Share on Google+', 'hestia-pro' ); ?>" class="btn btn-just-icon btn-round btn-google" href="https://plus.google.com/share?url=<?php esc_url( the_permalink() ); ?>"><i class="fa fa-google"></i></a>
		</div>
<?php
	}
endif;

if ( ! function_exists( 'hestia_get_image_sizes' ) ) :
	/**
	 * Output image sizes for attachment single page.
	 *
	 * @since Hestia 1.0
	 */
	function hestia_get_image_sizes() {

		/* If not viewing an image attachment page, return. */
		if ( ! wp_attachment_is_image( get_the_ID() ) ) {
			return;
		}

		/* Set up an empty array for the links. */
		$links = array();

		/* Get the intermediate image sizes and add the full size to the array. */
		$sizes = get_intermediate_image_sizes();
		$sizes[] = 'full';

		/* Loop through each of the image sizes. */
		foreach ( $sizes as $size ) {

			/* Get the image source, width, height, and whether it's intermediate. */
			$image = wp_get_attachment_image_src( get_the_ID(), $size );

			/* Add the link to the array if there's an image and if $is_intermediate (4th array value) is true or full size. */
			if ( ! empty( $image ) && ( true == $image[3] || 'full' == $size ) ) {
				$links[] = "<a target='_blank' class='image-size-link' href='{$image[0]}'>{$image[1]} &times; {$image[2]}</a>";
			}
		}

		/* Join the links in a string and return. */
		return join( ' <span class="sep">|</span> ', $links );
	}
endif;
