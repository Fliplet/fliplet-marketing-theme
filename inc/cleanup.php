<?php
/**
 * Functions that removed the version string from wordpress files
 * and removes the generator metatag.
 * 
 * This is done to prevent malicious users from quickly knowing the WordPress version
 * and exploit its weaknesses.
 *
 * @package Fliplet
 * @subpackage Fliplet_Marketing
 * @since 2.0.0
 */

/* Removes version string from JS and CSS if they match the WordPress version */
function fliplet_remove_wp_version_strings($src) {
  global $wp_version;

  parse_str(parse_url($src, PHP_URL_QUERY), $query);

  if (!empty($query['ver']) && $query['ver'] === $wp_version) {
    $src = remove_query_arg('ver', $src);
  }

  return $src;
}

add_filter('script_loader_src', 'fliplet_remove_wp_version_strings');
add_filter('style_loader_src', 'fliplet_remove_wp_version_strings');

/* Removes meta tag generator from header */
function fliplet_remove_meta_version() {
  return '';
}

add_filter('the_generator', 'fliplet_remove_meta_version');
?>