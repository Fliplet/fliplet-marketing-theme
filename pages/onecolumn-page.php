<?php
/**
 * Template Name: One column, no sidebar
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>

<div class="band" id="content">
	<div class="container group">
		
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		
				<?php if ( is_front_page() ) { ?>
					<h2 class="alpha page-title"><?php the_title(); ?></h2>
				<?php } else { ?>
					<h1 class="page-title"><?php the_title(); ?></h1>
				<?php } ?>
				
				<?php the_content(); ?>
				
		<?php endwhile; ?>
				
	</div>
</div>

<?php get_footer('page'); ?>