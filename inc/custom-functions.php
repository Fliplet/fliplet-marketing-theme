<?php

// Remove nonce check for CF7 so that studio can submit forms
define ('WPCF7_VERIFY_NONCE', false);

if( ! ( function_exists( 'wp_get_attachment_by_post_name' ) ) ) {
  function wp_get_attachment_by_post_name( $post_name ) {
    $args           = array(
      'posts_per_page' => 1,
      'post_type'      => 'attachment',
      'name'           => trim( $post_name ),
    );

    $get_attachment = new WP_Query( $args );

    if ( ! $get_attachment || ! isset( $get_attachment->posts, $get_attachment->posts[0] ) ) {
      return false;
    }

    return $get_attachment->posts[0];
  }
}

// stop wp removing div tags
function uncoverwp_tiny_mce_fix( $init )
{
    // html elements being stripped
    $init['extended_valid_elements'] = 'div[*], style[*], script[*]';

    // don't remove line breaks
    $init['remove_linebreaks'] = false;

    // convert newline characters to BR
    $init['convert_newlines_to_brs'] = true;

    // don't remove redundant BR
    $init['remove_redundant_brs'] = false;

    // pass back to wordpress
    return $init;
}

add_filter( 'tiny_mce_before_init', 'uncoverwp_tiny_mce_fix' );
?>
