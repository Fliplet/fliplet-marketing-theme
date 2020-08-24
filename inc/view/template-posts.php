<?php

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Twenty Ten 1.0
 * @return int
 */
function twentyten_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'twentyten_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Twenty Ten 1.0
 * @return string "Continue Reading" link
 */
function twentyten_continue_reading_link() {
	return ' <a class="button" href="'. get_permalink() . '">' . __( 'Continue reading<span class="meta-nav"> &rarr;</span>', 'twentyten' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and twentyten_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string An ellipsis
 */
function twentyten_auto_excerpt_more( $more ) {
	return ' &hellip;</p><p class="continue-reading">' . twentyten_continue_reading_link() . '</p>';
}
add_filter( 'excerpt_more', 'twentyten_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function twentyten_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= '</p><p class="continue-reading">' . twentyten_continue_reading_link() . '</p>';
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'twentyten_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css.
 *
 * @since Twenty Ten 1.0
 * @return string The gallery style filter, with the styles themselves removed.
 */
function twentyten_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'twentyten_remove_gallery_css' );

if ( ! function_exists( 'twentyten_posted_on' ) ) :

/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_on() {

	printf( __( '<div class="post-meta"><span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s</div>', 'twentyten' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'twentyten' ), get_the_author() ),
			get_the_author()
		)
	);

}

endif;

if ( ! function_exists( 'twentyten_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyten' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

/*******************************
*
*	Total posts count
*
*******************************/
function get_total_posts_count () {
	global $wp_query;
	
	return $wp_query->found_posts;
}

/*******************************
*
*	Posts on page
*
*******************************/
function get_post_count () {
	global $wp_query;
	
	return $wp_query->post_count;
}

/*******************************
*
*	Posts per page
*
*******************************/
function get_posts_per_page () {
	global $wp_query;
	
	return $wp_query->posts_per_page;
}

/*******************************
*
*	Page count
*
*******************************/
function get_page_count () {
	global $wp_query;
	
	return $wp_query->max_num_pages;
}

/*******************************
*
*	Custom pagination
*
*******************************/
function pagination( $query = '', $baseURL = '' ) {
	if ($query == '') {
		global $wp_query, $post;
		$query = $wp_query;
	}
	if ( ! $baseURL ) {
		$baseURL = get_bloginfo( 'url' );
	} else {
		$baseURL = get_bloginfo( 'url' ) . $baseURL;
	}
	$page = $query->query_vars["paged"];
	if ( !$page ) $page = 1;
	$qs = $_SERVER["QUERY_STRING"] ? "?".$_SERVER["QUERY_STRING"] : "";
	// Only necessary if there's more posts than posts-per-page
	if ( $query->found_posts > $query->query_vars["posts_per_page"] ) {
		echo '<ul class="paging">';
		echo '<li>Page</li>';
		// Previous link?
		if ( $page > 1 ) {
			//echo '<li class="previous"><a href="'.$baseURL.'/page/'.($page-1).'/'.$qs.'">Previous</a></li>';
		}
		// Loop through pages
		for ( $i=1; $i <= $query->max_num_pages; $i++ ) {
			// Current page or linked page?
			if ( $i == $page ) {
				echo '<li class="active">'.$i.'</li>';
			} else {
				echo '<li><a href="'.$baseURL.'/page/'.$i.'/'.$qs.'">'.$i.'</a></li>';
			}
		}
		// Next link?
		if ( $page < $query->max_num_pages ) {
			//echo '<li><a href="'.$baseURL.'/page/'.($page+1).'/'.$qs.'">Next</a></li>';
		}
		echo '</ul>';
	}
}

?>