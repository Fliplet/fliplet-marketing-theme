<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

	<div class="band" id="content">
		<main class="container-fluid">
			<?php 
				if (have_posts()) : while (have_posts()) : the_post();

				$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 5600,1000 ), false, '' );

				if ($src != "") :
			?>
			<div class="content-main column column-10 push-1">
				<div class='heading-holder'' style='background-image: url("<?php echo $src[0]; ?>") !important;'>
			</div><!-- .content-main.column.column-10.push-1 -->
			<?php endif; ?>

			<div class="title-wrapper blog-post-page">
				<div class="top-info-share-block">
					<div class="pre-post-meta">
						<?php if ( count( get_the_category() ) ) : ?>
							<?php printf( __( '%2$s', 'twentyten' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
						<?php endif; ?>
					</div><!-- .pre-post-meta -->
				</div><!-- .top-info-share-block -->
				
				<h1 class="page-title"><?php the_title(); ?></h1>
			</div><!-- .title-wrapper -->

			<div class="the_content">
				<?php the_content(); ?>
			<div>
			
			<?php endwhile; // end the loop ?>

			<?php if ( function_exists( "get_yuzo_related_posts" ) ) { get_yuzo_related_posts(); } ?>
			<?php endif; ?>
		</main><!-- .container-fluid -->
	</div><!-- .band -->

<?php get_footer(); ?>
