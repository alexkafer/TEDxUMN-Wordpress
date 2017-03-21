<?php
/**
 * The default template for displaying content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage Hestia
 * @since Hestia 1.0
 */
?>
<!---
<article id="post-<?php the_ID(); ?>" <?php ( is_sticky() && ! is_archive() ) ? post_class( 'card card-raised card-blog' ): post_class( 'card card-plain card-blog' ); ?>>
	<div class="row">
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="col-md-5">
			<div class="">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail( 'hestia-blog', ['class' => 'circular--landscape'] ); ?>
				</a>
			</div>
		</div>

		<div class="col-md-7">
			<?php else : ?>
			<div class="col-md-12">
				<?php endif; ?>
				<h6 class="category text-info"><?php hestia_category(); ?></h6>
				<?php the_title( sprintf( '<h2 class="card-title"><a href="%s" title="%s" rel="bookmark">', esc_url( get_permalink() ), esc_attr( get_the_title() ) ), '</a></h2>' ); ?>
				<div class="card-description">
					<p>
						<?php
						$hestia_more = strpos( $post->post_content, '<!--more-->' );
						if ( $hestia_more ) :
							echo get_the_content();
						else :
							echo get_the_excerpt();
						endif;
						?>
					</p>
				</div>
			</div>
		</div>
--->

<div class="item">
		<div class="card--new">
			<a style="margin: auto;" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail( 'hestia-blog', ['class' => 'circular--landscape center-block'] ); ?>
			</a>
			<div class="card--new--container">
					<h4><b><?php the_title( sprintf( '<h2 class="card-title"><a href="%s" title="%s" rel="bookmark">', esc_url( get_permalink() ), esc_attr( get_the_title() ) ), '</a></h2>' ); ?></b></h4>
				<p><?php
				$hestia_more = strpos( $post->post_content, '<!--more-->' );
				if ( $hestia_more ) :
					echo get_the_content();
				else :
					echo get_the_excerpt();
				endif;
				?></p>
			</div>
		</div>
	</div>


</article>
