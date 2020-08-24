<?php
/**
 * Template Name: Blank canvas (no header & footer)
 *
 * A custom page template without sidebar, title or container.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>

	<div id="content">

		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		
				<?php the_content(); ?>
				
		<?php endwhile; ?>
		
	</div>
				
<?php get_footer('page'); ?>