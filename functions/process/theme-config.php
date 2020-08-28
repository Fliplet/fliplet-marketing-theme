<?php
/**
 * TwentyTen functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, twentyten_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'twentyten_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640;

/** Tell WordPress to run twentyten_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'twentyten_setup' );

if ( ! function_exists( 'twentyten_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override twentyten_setup() in a child theme, add your own twentyten_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'twentyten', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme allows users to set a custom background
	add_theme_support( 'custom-background' );

	// Your changeable header business starts here
	define( 'HEADER_TEXTCOLOR', '' );
	// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
	define( 'HEADER_IMAGE', '%s/images/headers/path.jpg' );

	// The height and width of your custom header. You can hook into the theme's own filters to change these values.
	// Add a filter to twentyten_header_image_width and twentyten_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'twentyten_header_image_width', 940 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'twentyten_header_image_height', 198 ) );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be 940 pixels wide by 198 pixels tall.
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	// Don't support text inside the header image.
	define( 'NO_HEADER_TEXT', true );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See twentyten_admin_header_style(), below.
	add_theme_support( 'custom-header' );

	// ... and thus ends the changeable header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'berries' => array(
			'url' => '%s/images/headers/starkers.png',
			'thumbnail_url' => '%s/images/headers/starkers-thumbnail.png',
			/* translators: header image description */
			'description' => __( 'Starkers', 'twentyten' )
		)
	) );
}
endif;

//Adding theme scripts
function fliplet_script_enqueuer() {
	wp_register_style( 'fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i', '', '', 'all' );
  wp_enqueue_style( 'fonts' );

	wp_register_style( 'bootstrapStyles', get_template_directory_uri().'/assets/css/bootstrap.min.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/bootstrap.min.css'), 'all' );
  wp_enqueue_style( 'bootstrapStyles' );

	wp_register_style( 'screen', get_stylesheet_uri(), array( 'fonts' ), filemtime(get_stylesheet_directory() . '/style.css'), 'all' );
  wp_enqueue_style( 'screen' );

	wp_register_script( 'bootstrapJS', get_template_directory_uri().'/assets/js/bootstrap.min.js', array(), filemtime(get_stylesheet_directory() . '/assets/js/bootstrap.min.js') );
	wp_enqueue_script( 'bootstrapJS' );

	wp_register_script( 'modernizr', get_template_directory_uri().'/assets/js/modernizr.js', array( 'jquery' ), filemtime(get_stylesheet_directory() . '/assets/js/modernizr.js'), true );
	wp_enqueue_script( 'modernizr' );

  // wp_register_script( 'selectivizr', get_stylesheet_directory_uri(). '/assets/js/selectivizr-min.js', array( 'jquery' ), filemtime(get_stylesheet_directory() . '/assets/js/selectivizr-min.js'), true );
  // wp_enqueue_script( 'selectivizr' );
  //
	// wp_register_script( 'toLocaleStringPolyfill', get_stylesheet_directory_uri(). '/assets/js/toLocaleStringPolyfill.js', array( 'jquery' ), '', true );
  // wp_enqueue_script( 'toLocaleStringPolyfill' );

  wp_register_script( 'init', get_stylesheet_directory_uri().'/assets/js/init.js', array( 'jquery' ), filemtime(get_stylesheet_directory() . '/assets/js/init.js'), true );
  wp_enqueue_script( 'init' );

	wp_register_script( 'swiper4.0.7', get_template_directory_uri().'/assets/js/swiper.min.js', array(), filemtime(get_stylesheet_directory().'/assets/js/swiper.min.js'), true );
  wp_enqueue_script( 'swiper4.0.7' );

	// wp_register_style( 'animateCss', get_template_directory_uri().'/assets/css/animate.css', array(), filemtime(get_stylesheet_directory() . '/assets/css/animate.css'), 'screen' );
  // wp_enqueue_style( 'animateCss' );
}
add_action( 'wp_enqueue_scripts', 'fliplet_script_enqueuer' );

//Removes versioning for enqueued files to avoid old files being cached
function remove_cssjs_ver( $src ) {
  if( strpos( $src, '?ver=' ) )
    $src = remove_query_arg( 'ver', $src );
    return $src;
}
//add_filter( 'style_loader_src', 'remove_cssjs_ver', 1000 );
//add_filter( 'script_loader_src', 'remove_cssjs_ver', 1000 );

?>
