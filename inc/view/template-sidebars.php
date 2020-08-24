<?php

/**
 * Allow short codes in widgets
 */
//add_filter('widget_text', 'do_shortcode');

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override twentyten_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Twenty Ten 1.0
 * @uses register_sidebar
 */
function twentyten_widgets_init() {
	// Area 1, located at the standard sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'twentyten' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located in page footers. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Page Footer Widget Area', 'twentyten' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title alpha">',
		'after_title' => '</h3>',
	) );

	/*
	// Area 3, located in page footers. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Page Footer Widget Area', 'twentyten' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title alpha">',
		'after_title' => '</h3>',
	) );

	// Area 4, located in page footers. Empty by default.
	register_sidebar( array(
		'name' => __( 'Thirds Page Footer Widget Area', 'twentyten' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title alpha">',
		'after_title' => '</h3>',
	) );
	*/

	// Area 5, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Blog Banner', 'twentyten' ),
		'id' => 'blog-banner-widget-area',
		'description' => __( 'The blog banner widget area', 'twentyten' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );

	// Area 6, located below the Header. Empty by default.
	register_sidebar( array(
		'name' => __( 'Blog Post CTA', 'twentyten' ),
		'id' => 'blog-post-cta-widget-area',
		'description' => __( 'The blog post CTA widget area', 'twentyten' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );

	// Area 7, located in the blog footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Blog Footer Widget Area', 'twentyten' ),
		'id' => 'blog-footer-widget-area',
		'description' => __( 'The blog footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s column column-4">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title alpha">',
		'after_title' => '</h3>',
	) );

	// Area 8, located in blog post. Empty by default.
	register_sidebar( array(
		'name' => __( 'Blog promotion widget', 'twentyten' ),
		'id' => 'blog-post-promotion-widget',
		'description' => __( 'The blog promotion widget area', 'twentyten' ),
	    'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );

	// Area 9, located in blog post. Empty by default.
	register_sidebar( array(
		'name' => __( 'Blog Trial CTA', 'twentyten' ),
		'id' => 'blog-post-trial-promotion-widget',
		'description' => __( 'The blog trial promotion widget area', 'twentyten' ),
	    'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );

	// Area 10, located in blog post. Empty by default.
	register_sidebar( array(
		'name' => __( 'Blog Bottom Form', 'twentyten' ),
		'id' => 'blog-post-form-widget',
		'description' => __( 'The blog contact form widget area', 'twentyten' ),
	    'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );

	// Area 11, located in blog post. Empty by default.
	register_sidebar( array(
		'name' => __( 'Subscribe box', 'twentyten' ),
		'id' => 'subscribe-box-widget',
		'description' => __( 'Widget area for the subscribe box', 'twentyten' ),
	  'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );


}
/** Register sidebars by running twentyten_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'twentyten_widgets_init' );

?>
