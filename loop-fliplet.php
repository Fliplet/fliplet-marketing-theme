<?php
/**
 * The loop that displays posts.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
		<h1 class="page-title"><?php _e( 'Not Found', 'twentyten' ); ?></h1>
		<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyten' ); ?></p>
		<?php get_search_form(); ?>

<?php endif; ?>

<?php /* Start the loop */ ?>
<div class="band" id="content">
	<div class="container-fluid">

		<div class="row blog-nav-wrap">
			<div class="second-nav col-lg-6 col-md-6 col-sm-6">
				<?php wp_nav_menu( array('blog_menu' => 'Blog Menu' )); ?>
				<ul id="searchTrigger" class="search-trigger">
					<li>Search</li>
				</ul>
			</div>

			<div class="subscribe col-lg-6 col-md-6 col-sm-6">
			<?php	if ( is_active_sidebar( 'subscribe-box-widget' ) ) : ?>
				<?php
					dynamic_sidebar( 'subscribe-box-widget' );
				?>
			<?php endif; ?>
			</div>
		</div>

		<div class="row blog-search-wrap">
			<div id="searchField"><?php get_search_form(); ?></div>
		</div>

		<div class="row blog-loop-wrap">
		<?php while($wp_query->have_posts()) : $wp_query->the_post(); ?>

		<?php if($count < 1){ ?>
		<?php $count++; ?>

			<div class="col-lg-12 featured">
				<div class="hover-wrap">
					<div class="upper-post-image">
						<?php the_post_thumbnail('full'); ?>
					</div>
					<div class="upper-post-content">
						<div class="pre-post-meta">
							<?php the_category( ', ' ); ?>
							<span>|</span>
							<?php the_date('j M Y'); ?>
						</div>

						<a href="<?php the_permalink(); ?>">
							<h2><?php the_title(); ?></h2>
						</a>

						<div class="upper-post-text"><?php echo excerpt(30); ?></div>
						<a class="btn btn-dark" href="<?php the_permalink(); ?>">
							More
							<span class="meta-nav"> →</span>
						</a>
					</div>
				</div>
			</div>  <!-- end .col -->

		<?php } else { ?>

			<div class="col-lg-4 col-md-6 col-sm-6 lower-posts">
				<div class="hover-wrap">
					<div class="lower-post-image">
						<?php the_post_thumbnail('large'); ?>
					</div>
					<div class="lower-post-content">
						<div class="pre-post-meta">
							<?php the_category( ', ' ); ?>
							<span>|</span>
							<?php the_date('j M Y'); ?>
						</div>

						<a href="<?php the_permalink(); ?>">
							<h2><?php the_title(); ?></h2>
						</a>
						<div class="lower-post-text"><?php echo excerpt(18); ?></div>
						<a class="btn btn-dark" href="<?php the_permalink(); ?>">
							More
							<span class="meta-nav"> →</span>
						</a>
					</div>
				</div>
			</div><!-- end .col -->

		<?php } ?>

		<?php endwhile; wp_reset_query(); ?>
		</div> <!-- End .row -->

		<div class="blog-pagination">
			<?php numeric_posts_nav(); ?>
		</div>
	</div> <!-- End .container -->
</div> <!-- End .band #content -->
