<?php
/**
 * The Footer widget areas.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
?>

<?php if ( is_active_sidebar( 'blog-footer-widget-area' ) ) : ?>
		<ul class="xoxo group">
			<?php dynamic_sidebar( 'blog-footer-widget-area' ); ?>
		</ul>
<?php endif; ?>