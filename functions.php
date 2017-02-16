<?php
/**
 * Hestia functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Hestia
 * @since Hestia 1.0
 */

define( 'HESTIA_PHP_INCLUDE',  get_template_directory() . '/inc' );

require_once( trailingslashit( get_template_directory() ) . 'inc/template-tags.php' );
require_once( trailingslashit( get_template_directory() ) . 'inc/wp-bootstrap-navwalker/wp_bootstrap_navwalker.php' );
require_once( trailingslashit( get_template_directory() ) . 'inc/customizer.php' );
if ( class_exists( 'woocommerce' ) ) {
	require_once( trailingslashit( get_template_directory() ) . 'inc/woocommerce/functions.php' );
	require_once( trailingslashit( get_template_directory() ) . 'inc/woocommerce/hooks.php' );
}

if ( ! function_exists( 'hestia_setup' ) ) {
	/**
	 * Get the number of items in the cart.
	 *
	 * @since Hestia 1.0
	 */
	function hestia_setup() {
		// Using this feature you can set the maximum allowed width for any content in the theme, like oEmbeds and images added to posts.  https://codex.wordpress.org/Content_Width
		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 750;
		}

		// Takes care of the <title> tag. https://codex.wordpress.org/Title_Tag
		add_theme_support( 'title-tag' );

		// Add theme support for custom logo. https://codex.wordpress.org/Theme_Logo
		add_theme_support( 'custom-logo', array(
			'flex-width' => true,
		) );

		// Loads texdomain. https://codex.wordpress.org/Function_Reference/load_theme_textdomain
		load_theme_textdomain( 'hestia-pro', get_template_directory() . '/languages' );

		// Add automatic feed links support. https://codex.wordpress.org/Automatic_Feed_Links
		add_theme_support( 'automatic-feed-links' );

		// Add post thumbnails support. https://codex.wordpress.org/Post_Thumbnails
		add_theme_support( 'post-thumbnails' );

		// Add custom background support. https://codex.wordpress.org/Custom_Backgrounds
		add_theme_support( 'custom-background', array(
			'default-color' => 'E5E5E5',
		));

		// Add custom header support. https://codex.wordpress.org/Custom_Headers
		add_theme_support( 'custom-header', array(
			// Height
			'height' => 2000,
			// Flex height
			'flex-height' => true,
			// Header image
			'default-image' => get_template_directory_uri() . '/assets/img/header.jpg',
			// Header text
			'header-text' => false,
		));
		// Add selective Widget refresh support
		add_theme_support( 'customize-selective-refresh-widgets' );

		// This theme uses wp_nav_menu(). https://codex.wordpress.org/Function_Reference/register_nav_menu
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'hestia-pro' ),
			'footer' => esc_html__( 'Footer Menu', 'hestia-pro' ),
		));

		// Adding image sizes. https://developer.wordpress.org/reference/functions/add_image_size/
		add_image_size( 'hestia-blog', 800, 534, true );
		add_image_size( 'hestia-shop', 390, 585, true );
		add_image_size( 'hestia-portfolio', 540, 360, true );

		// Added WooCommerce support.
		if ( class_exists( 'woocommerce' ) ) {
			add_theme_support( 'woocommerce' );
		}

		// Added Jetpack Portfolio Support.
		if ( class_exists( 'Jetpack' ) ) {
			add_theme_support( 'jetpack-portfolio' );
		}

		/* Customizer upsell. */
		require_once( trailingslashit( get_template_directory() ) . 'inc/customizer-info/class/class-singleton-customizer-info-section.php' );

	}

	add_action( 'after_setup_theme', 'hestia_setup' );
}// End if().


/**
 * Register widgets for the theme.
 *
 * @since Hestia 1.0
 */
function hestia_widgets_init() {

	register_sidebar( array(
		'name'		  => esc_html__( 'Sidebar', 'hestia-pro' ),
		'id'			=> 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'		  => esc_html__( 'Subscribe Section', 'hestia-pro' ),
		'id'			=> 'subscribe-widgets',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'		  => esc_html__( 'Blog Subscribe Section', 'hestia-pro' ),
		'id'			=> 'blog-subscribe-widgets',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'		  => esc_html__( 'Footer One', 'hestia-pro' ),
		'id'			=> 'footer-one-widgets',
		'before_widget' => '<div id="%1$s" class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'		  => esc_html__( 'Footer Two', 'hestia-pro' ),
		'id'			=> 'footer-two-widgets',
		'before_widget' => '<div id="%1$s" class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'		  => esc_html__( 'Footer Three', 'hestia-pro' ),
		'id'			=> 'footer-three-widgets',
		'before_widget' => '<div id="%1$s" class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	) );

}

add_action( 'widgets_init', 'hestia_widgets_init' );

/**
 * Register Fonts
 *
 * @return string
 */
function hestia_fonts_url() {
	$fonts_url = '';

	/*
     Translators: If there are characters in your language that are not
     * supported by Roboto or Roboto Slab, translate this to 'off'. Do not translate
     * into your own language.
	 */
	$roboto = _x( 'on', 'Roboto font: on or off', 'hestia-pro' );
	$roboto_slab = _x( 'on', 'Roboto Slab font: on or off', 'hestia-pro' );

	if ( 'off' != $roboto || 'off' != $roboto_slab ) {
		$font_families = array();

		if ( 'off' != $roboto ) {
			$font_families[] = 'Roboto:300,400,500,700';
		}

		if ( 'off' != $roboto_slab ) {
			$font_families[] = 'Roboto Slab:400,700';
		}

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}
	return $fonts_url;
}

/**
 * Registering and enqueuing scripts/stylesheets to header/footer.
 *
 * @since Hestia 1.0
 */
function hestia_scripts() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css' );
	wp_enqueue_style( 'font_awesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css' );
	wp_enqueue_style( 'hestia_style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'hestia_fonts', hestia_fonts_url(), array(), null );
	if ( is_singular() ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', array( 'jquery' ),'',true );
	wp_enqueue_script( 'hestia_material', get_template_directory_uri() . '/assets/js/material.js', array( 'jquery' ),'',true );
	if ( ( 'page' == get_option( 'show_on_front' ) ) || is_home() || is_single() || is_archive() ) {
		wp_enqueue_script( 'matchHeight', get_template_directory_uri() . '/assets/js/jquery.matchHeight.js', array( 'jquery' ),'',true );
	}
	wp_enqueue_script( 'hestia_scripts', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery', 'hestia_material' ),'',true );
}
add_action( 'wp_enqueue_scripts', 'hestia_scripts' );

/**
 * Add appropriate classes to body tag.
 *
 * @since Hestia 1.0
 */
function hestia_body_classes( $classes ) {
	if ( is_singular() ) {
		$classes[] = 'blog-post';
	}
	return $classes;
}

add_filter( 'body_class', 'hestia_body_classes' );

/**
 * Define excerpt length.
 *
 * @since Hestia 1.0
 */
function hestia_excerpt_length( $length ) {
	if ( ( 'page' == get_option( 'show_on_front' ) ) || is_single()  ) {
		return 35;
	} elseif ( is_home() ) {
		if ( is_active_sidebar( 'sidebar-1' ) ) {
			return 40;
		} else {
			return 75;
		}
	} else {
		return 50;
	}
}

add_filter( 'excerpt_length', 'hestia_excerpt_length', 999 );

/**
 * Replace excerpt "Read More" text with a link.
 *
 * @since Hestia 1.0
 */
function hestia_excerpt_more( $more ) {
	global $post;
	if ( ( ( 'page' == get_option( 'show_on_front' ) ) ) || is_single() || is_archive() || is_home() ) {
		return '<a class="moretag" href="' . get_permalink( $post->ID ) . '"> ' . esc_html__( 'Read more...', 'hestia-pro' ) . '</a>';
	}
}
add_filter( 'excerpt_more', 'hestia_excerpt_more' );

/**
 * Modify comment reply link.
 *
 * @since Hestia 1.0
 */
function hestia_reply_link_class( $class ) {
	$class = str_replace( "class='comment-reply-link", "class='comment-reply-link pull-right", $class );
	return $class;
}

add_filter( 'comment_reply_link', 'hestia_reply_link_class' );

/**
 * Move comment field above user details.
 *
 * @since Hestia 1.0
 */
function hestia_comment_message( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}

add_filter( 'comment_form_fields', 'hestia_comment_message' );

/**
 * Define Allowed Files to be included.
 *
 * @since Hestia 1.0
 */
function hestia_filter_features( $array ) {
	return array_merge( $array, array(
		'/features/feature-general-settings',
		'/features/feature-blog-settings',
		'/features/feature-general-credits',
		'/features/feature-slider-section',
		'/features/feature-big-title-section',
		'/features/feature-features-section',
		'/features/feature-features-on-product',
		'/features/feature-about-section',
		'/features/feature-shop-section',
		'/features/feature-portfolio-section',
		'/features/feature-team-section',
		'/features/feature-pricing-section',
		'/features/feature-testimonials-section',
		'/features/feature-subscribe-section',
		'/features/feature-blog-section',
		'/features/feature-contact-section',
		'/features/feature-color-settings',
		'/features/feature-advanced-color-settings',
		'/features/feature-section-ordering',
		'/features/feature-theme-info-section',

		'/sections/feature-blog-authors-section',
		'/sections/feature-blog-subscribe-section',
		'/sections/hestia-slider-section',
		'/sections/hestia-big-title-section',
		'/sections/hestia-features-section',
		'/sections/hestia-about-section',
		'/sections/hestia-shop-section',
		'/sections/hestia-portfolio-section',
		'/sections/hestia-team-section',
		'/sections/hestia-pricing-section',
		'/sections/hestia-testimonials-section',
		'/sections/hestia-subscribe-section',
		'/sections/hestia-blog-section',
		'/sections/hestia-contact-section',
		'/sections/hestia-authors-blog-section',
		'/sections/hestia-subscribe-blog-section',

		'/customizer-theme-info/class-customizer-theme-info-root',
		'/features/feature-pro-manager',

	));
}

add_filter( 'hestia_filter_features', 'hestia_filter_features' );

/**
 * Include features files.
 *
 * @since Hestia 1.0
 */
function hestia_include_features() {
	$hestia_inc_dir = rtrim( HESTIA_PHP_INCLUDE, '/' );
	$hestia_allowed_phps = array();
	$hestia_allowed_phps = apply_filters( 'hestia_filter_features',$hestia_allowed_phps );

	foreach ( $hestia_allowed_phps as $file ) {
		$hestia_file_to_include = $hestia_inc_dir . $file . '.php';
		if ( file_exists( $hestia_file_to_include ) ) {
			include_once( $hestia_file_to_include );
		}
	}
}

add_action( 'after_setup_theme','hestia_include_features' );

/**
 * Adds inline style from customizer
 *
 * @since Hestia 1.0
 */
function hestia_inline_style() {
	$custom_css              = '';
	$hestia_features_content = get_theme_mod( 'hestia_features_content', json_encode( array(
		array(
			'icon_value' => 'fa-wechat',
			'title'      => esc_html__( 'Responsive', 'hestia-pro' ),
			'text'       => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'hestia-pro' ),
			'link'       => '#',
			'id'         => 'customizer_repeater_56d7ea7f40b56',
			'color'      => '#e91e63',
		),
		array(
			'icon_value' => 'fa-check',
			'title'      => esc_html__( 'Quality', 'hestia-pro' ),
			'text'       => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'hestia-pro' ),
			'link'       => '#',
			'id'         => 'customizer_repeater_56d7ea7f40b66',
			'color'      => '#00bcd4',
		),
		array(
			'icon_value' => 'fa-support',
			'title'      => esc_html__( 'Support', 'hestia-pro' ),
			'text'       => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'hestia-pro' ),
			'link'       => '#',
			'id'         => 'customizer_repeater_56d7ea7f40b86',
			'color'      => '#4caf50',
		),
	) ) );

	if ( ! empty( $hestia_features_content ) ) {
		$hestia_features_content = json_decode( $hestia_features_content );
		foreach ( $hestia_features_content as $features_item ) {
			if ( ! empty( $features_item->id ) && ! empty( $features_item->color ) ) {
				$box_id = '.' . $features_item->id;
				$color = ! empty( $features_item->color ) ? apply_filters( 'hestia_translate_single_string', $features_item->color, 'Features section', 'Color' ) : '';
				$custom_css .= esc_attr( $box_id ) . ' .icon {
                            color: ' . esc_attr( $color ) . ';
				}';
			}
		}
	}

	wp_add_inline_style( 'hestia_style', $custom_css );
}

add_action( 'wp_enqueue_scripts', 'hestia_inline_style' );

// Add Reading Time to Blog Section.
add_action( 'hestia_blog_reading_time', 'hestia_reading_time' );

// Add Related Posts to Single Posts.
add_action( 'hestia_blog_related_posts', 'hestia_related_posts' );

// Add Social Icons to Single Posts.
add_action( 'hestia_blog_social_icons', 'hestia_social_icons' );

/**
 * Filter the front page template so it's bypassed entirely if the user selects
 * to display blog posts on their homepage instead of a static page.
 */
function hestia_filter_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template', 'hestia_filter_front_page_template' );

/**
 * Filter to modify input label in repeater control
 * You can filter by control id and input name.
 *
 * @param string $string Input label.
 * @param string $id Input id.
 * @param string $control Control name.
 *
 * @return string
 */
function hestia_repeater_labels( $string, $id, $control ) {

	if ( $id === 'hestia_slider_content' ) {
		if ( $control === 'customizer_repeater_text_control' ) {
			return esc_html__( 'Button Text','hestia-pro' );
		}
	}
	return $string;
}
add_filter( 'repeater_input_labels_filter','hestia_repeater_labels', 10 , 3 );

/**
 * Filter to modify input type in repeater control
 * You can filter by control id and input name.
 *
 * @param string $string Input label.
 * @param string $id Input id.
 * @param string $control Control name.
 *
 * @return string
 */
function hestia_repeater_input_types( $string, $id, $control ) {

	if ( $id === 'hestia_slider_content' ) {
		if ( $control === 'customizer_repeater_text_control' ) {
			return '';
		}
		if ( $control === 'customizer_repeater_subtitle_control' ) {
			return 'textarea';

		}
	}
	return $string;
}
add_filter( 'repeater_input_types_filter','hestia_repeater_input_types', 10 , 3 );




add_action( 'wp_ajax_nopriv_request_post', 'hestia_requestpost' );
add_action( 'wp_ajax_request_post', 'hestia_requestpost' );
/**
 * Ajax function for refresh purposes.
 */
function hestia_requestpost() {
	$pid = $_POST['pid'];

	if ( ! empty( $pid ) && $pid !== 0 ) {
		hestia_sync_control_from_page( $pid, true );
	}
	echo '';
	die();
}

/**
 * Filter to translate strings
 */
function hestia_translate_single_string( $original_value, $domain, $name ) {
	$wpml_translation = apply_filters( 'wpml_translate_single_string', $original_value, $domain, $name );
	if ( $wpml_translation === $original_value && function_exists( 'pll__' ) ) {
		return pll__( $original_value );
	}
	return $wpml_translation;
}
add_filter( 'hestia_translate_single_string', 'hestia_translate_single_string', 10, 3 );

/**
 * Helper to register pll string.
 *
 * @param String    $theme_mod Theme mod name.
 * @param bool/json $default Default value.
 * @param String    $name Name for polylang backend.
 */
function hestia_pll_string_register_helper( $theme_mod, $default = false, $name ) {
	if ( ! function_exists( 'pll_register_string' ) ) {
		return;
	}

	$repeater_content = get_theme_mod( $theme_mod, $default );
	$repeater_content = json_decode( $repeater_content );
	if ( ! empty( $repeater_content ) ) {
		foreach ( $repeater_content as $repeater_item ) {
			foreach ( $repeater_item as $field_name => $field_value ) {
				if ( $field_name === 'social_repeater' ) {
					$social_repeater_value = json_decode( $field_value );
					foreach ( $social_repeater_value as $social ) {
						foreach ( $social as $key => $value ) {
							if ( $key === 'link' ) {
								pll_register_string( 'Social link', $value, $name );
							}
							if ( $key === 'icon' ) {
								pll_register_string( 'Social icon', $value, $name );
							}
						}
					}
				} else {
					if ( $field_name !== 'id' ) {
						$f_n = ucfirst( $field_name );
						pll_register_string( $f_n, $field_value, $name );
					}
				}
			}
		}
	}
}



function hestia_themeisle_sdk(){
	require dirname(__FILE__).'/vendor/themeisle/load.php';
	themeisle_sdk_register (
		array(
			'product_slug'=>'hestia',
			'store_url'=>'https://themeisle.com',
			'store_name'=>'Themeisle',
			'product_type'=>'theme',
			'wordpress_available'=>false,
			'paid'=>false,
		)
	);
}

hestia_themeisle_sdk(); 

 
