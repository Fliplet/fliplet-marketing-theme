<?php

// Register Menus
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
			'main_menu' => 'Main Menu',
			'main_menu_landing_page' => 'Landing Pages Main Menu',
			'main_menu_mobile' => 'Main Menu Mobile',
			'resources_menu_mobile' => 'Resources Menu Mobile',
		  'blog_menu' => 'Blog Menu',
			'contact_info' => 'Contact information',
			'footer_menu_one' => 'Footer Menu One',
			'footer_menu_two' => 'Footer Menu Two',
			'footer_menu_three' => 'Footer Menu Three',
			'footer_menu_four' => 'Footer Menu Four',
			'footer_menu_four_landing_page' => 'Landing Page Footer Menu Four'
		)
	);
}

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'twentyten_page_menu_args' );

?>
