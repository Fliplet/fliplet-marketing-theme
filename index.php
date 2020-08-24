<?php
	/**
	 * The main template file.
	 *
	 * This is the most generic template file in a WordPress theme
	 * and one of the two required files for a theme (the other being style.css).
	 * It is used to display a page when nothing more specific matches a query.
	 * E.g., it puts together the home page when no home.php file exists.
	 * Learn more: http://codex.wordpress.org/Template_Hierarchy
	 *
	 * @package WordPress
	 */

	get_header();
?>

<?php
	/* Run the loop to output the posts.
	 * If you want to overload this in a child theme then include a file
	 * called loop-index.php and that will be used instead.
	 * 
	 * Ale's notes:
	 * I've added a file called loop-fliplet.php,
	 * Change line below to ('loop', 'index') to get the default loop
	 * f this theme
	 */
	 get_template_part( 'loop', 'fliplet' );
?>

<?php get_footer(); ?>
