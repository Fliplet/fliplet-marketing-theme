<?php

/*******************************
*
*	Add Open Graph headers
*
*******************************/
function og_header_meta () {
	if (have_posts()):while(have_posts()):the_post();endwhile;endif;
	?>
	<?php /* ?>
	<!-- Facebook Opengraph -->
	ÊÊÊÊ<meta property="fb:app_id" content="your_app_id" />
	ÊÊÊÊ<meta property="fb:admins" content="your_admin_id" />
	<?php */ ?>
		<meta property="og:url" content="<?php the_permalink() ?>"/>
	<?php if (is_single()) { ?>
		<meta property="og:title" content="<?php single_post_title(''); ?>" />
		<meta property="og:description" content="<?php echo strip_tags(get_the_excerpt($post->ID)); ?>" />
		<meta property="og:type" content="article" />
		<meta property="og:image" content="<?= (get_post_thumbnail_id( $post->ID )) ? wp_get_attachment_thumb_url( get_post_thumbnail_id( $post->ID ) ) : ( get_bloginfo('stylesheet_directory') . '/assets/images/thus-og-logo.png' ) ?>" />
	<?php } else { ?>
		<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
		<meta property="og:description" content="<?php bloginfo('description'); ?>" />
		<meta property="og:type" content="website" />
		<meta property="og:image" content="<?php bloginfo('stylesheet_directory') ?>/assets/images/thus-og-logo.png" />
	<?php
	}
};

add_action('wp_head','og_header_meta');

?>