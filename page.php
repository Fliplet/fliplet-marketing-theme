<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the wordpress construct of pages
 * and that other 'pages' on your wordpress site will use a
 * different template.
 *
 * @package WordPress
 */

get_header(); ?>

<div class="band" id="content">
	<div class="container group">

		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<h1 class="page-title"><?php the_title(); ?></h1>

				<div class="content-main column column-8">

				<?php the_content(); ?>

				</div>

		<?php endwhile; ?>

	</div>
</div>
<?php get_footer('page'); ?>
