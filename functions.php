<?php

// Paths setup
define('FUNCTIONSPATH', STYLESHEETPATH . '/functions');
define('EXTERNALPATH', FUNCTIONSPATH . '/external');
define('PLUGINSPATH', FUNCTIONSPATH . '/plugins');
define('PROCESSFUNCPATH', FUNCTIONSPATH . '/process');
define('VIEWFUNCPATH', FUNCTIONSPATH . '/view');

/* *************************************************************************
 *
 * 	Functions are named using the following convention
 * 		[functionality type]-[functionality-scope]-[functionality (group)].php
 *
 * 	Most functionality fall under 1 of the 3 following types:
 * 		- Template
 * 		- Widget
 * 		- Plugin
 *
 * ************************************************************************/

/* *************************************************************************
 *
 * 	Custom plugin changes
 *
 * 	custom-post-widget
 *  ==================
 *  To remove the erroneous </p> tag, comment the line below:
 *  $content = apply_filters('the_content', $content);
 *
 * *************************************************************************/

/* *************************************************************************
 *
 * 	Config functions
 *
 * *************************************************************************/

// Theme configuration
require_once(PROCESSFUNCPATH . '/theme-config.php');

// Custom functions
require_once(PLUGINSPATH . '/custom-functions.php');

// Custom MIME types
require_once(PROCESSFUNCPATH . '/theme-mime.php');

/* *************************************************************************
 *
 * 	External functions
 *
 * *************************************************************************/

// Starkers Utilities
require_once(EXTERNALPATH . '/starkers-utilities.php');


/* *************************************************************************
 *
 * 	Plugin functions
 *
 * *************************************************************************/


/* *************************************************************************
 *
 * 	Template functions
 *
 * *************************************************************************/

// Posts
require_once(PROCESSFUNCPATH . '/template-posts.php');

function addCustomJavascriptLibraries() {
  wp_register_script ('swiperJS', get_template_directory_uri() . '/assets/js/swiper.min.js');
  wp_enqueue_script('swiperJS');
}

add_action( 'wp_enqueue_scripts', 'addCustomJavascriptLibraries' );

//remove pings to self on posts
function no_self_ping( &$links ) {
    $home = get_option( 'home' );
    foreach ( $links as $l => $link )
        if ( 0 === strpos( $link, $home ) )
            unset($links[$l]);
}
add_action( 'pre_ping', 'no_self_ping' );

// Comments
require_once(VIEWFUNCPATH . '/template-comments.php');

// Admin
require_once(VIEWFUNCPATH . '/template-admin.php');

// Header
require_once(VIEWFUNCPATH . '/template-header.php');

// Menu setup
require_once(VIEWFUNCPATH . '/template-menus.php');

// Sidebar setup
require_once(VIEWFUNCPATH . '/template-sidebars.php');

// Shortcode setup
require_once(VIEWFUNCPATH . '/template-shortcodes.php');

// Search setup
require_once(VIEWFUNCPATH . '/template-search.php');



/* *************************************************************************
 *
 * 	Widget functions
 *
 * *************************************************************************/

//not sure where this should go
add_theme_support( 'post-thumbnails' );
add_image_size( 'blog-featured-image', 1000, 300 ); //300 pixels wide (and unlimited height)

/**
 * Fix Gravity Form Tabindex Conflicts
 * http://gravitywiz.com/fix-gravity-form-tabindex-conflicts/
 */
add_filter( 'gform_tabindex', 'gform_tabindexer', 10, 2 );
function gform_tabindexer( $tab_index, $form = false ) {
    $starting_index = 1000; // if you need a higher tabindex, update this number
    if( $form )
        add_filter( 'gform_tabindex_' . $form['id'], 'gform_tabindexer' );
    return GFCommon::$tab_index >= $starting_index ? GFCommon::$tab_index : $starting_index;
}

/* *************************************************************************
 *
 * 	Fliplet Custom Functions
 *
 * *************************************************************************/

// Limit number of characters of the excerpt of the Fliplet Loop
function excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
    } else {
        $excerpt = implode(" ",$excerpt);
    }
    $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
    return $excerpt;
}

// Add class to category menu item
function be_menu_item_classes( $classes, $item, $args ) {

    if( ( is_singular( 'post' ) || is_category() || is_tag() ) && 'Blog' == $item->title )
        $classes[] = 'current-menu-item';

    return array_unique( $classes );
}
add_filter( 'nav_menu_css_class', 'be_menu_item_classes', 10, 3 );


// Blog Pagination
function numeric_posts_nav() {

    if( is_singular() )
        return;

    global $wp_query;

    if( $wp_query->max_num_pages <= 1 )
        return;

    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

    if ( $paged >= 1 )
        $links[] = $paged;

    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<div class="navigation"><ul>' . "\n";

    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';

        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }

    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }

    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";

        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }

    if ( get_next_posts_link() )
        printf( '<li>%s</li>' . "\n", get_next_posts_link() );

    echo '</ul></div>' . "\n";

}
