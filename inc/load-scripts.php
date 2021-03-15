<?php
/**
 * Functions that enqueue the scripts and loads them.
 *
 * @package Fliplet
 * @subpackage Fliplet_Marketing
 * @since 2.0.0
 */

/* Enqueues the scripts */
function load_jquery() {
  wp_register_script('jquery_3_5_1', get_template_directory_uri() . '/assets/js/jquery-3.5.1.min.js', '', '3.5.1', false);

  wp_enqueue_script('jquery_3_5_1');
}

function load_lodash() {
  wp_register_script('lodash_js', get_template_directory_uri() . '/assets/js/lodash.js', '', '4.17.16', false);

  wp_enqueue_script('lodash_js');
}

function load_bootstrap_js() {
  wp_register_script('bootstrap_js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', '', '3.4.1', false);

  wp_enqueue_script('bootstrap_js');
}

function load_hammer_js() {
  wp_register_script('hammer_js', get_template_directory_uri() . '/assets/js/hammer.min.js', '', '2.0.8', false);

  wp_enqueue_script('hammer_js');
}

function load_modernizr_js() {
  wp_register_script('modernizr_js', get_template_directory_uri() . '/assets/js/modernizr.js', '', '3.3.1', false);

  wp_enqueue_script('modernizr_js');
}

function load_swiper_js() {
  wp_register_script('swiper_js', get_template_directory_uri() . '/assets/js/swiper.min.js', '', '6.1.2', false);

  wp_enqueue_script('swiper_js');
}

function load_selectivizr_js() {
  wp_register_script('selectivizr_js', get_template_directory_uri() . '/assets/js/selectivizr-min.js', '', '1.0.2', false);

  wp_enqueue_script('selectivizr_js');
}

function load_toLocalePoly_js() {
  wp_register_script('toLocalePoly_js', get_template_directory_uri() . '/assets/js/toLocaleStringPolyfill.js', '', '1.0.0', false);

  wp_enqueue_script('toLocalePoly_js');
}

function load_theme_js() {
  wp_register_script('theme_js', get_template_directory_uri() . '/assets/js/init.js', '', '2.0.7', false);

  wp_enqueue_script('theme_js');
}

function load_mtu_slider() {
  global $post;

  $pricing_page_slug = 'pricing';

  if((is_page()
    || is_single())
    && preg_match('/\b' . $pricing_page_slug . '\b/', $post->post_name)) {
    wp_register_script('mtu_slider', get_template_directory_uri() . '/assets/js/mtu-slider.js', '', '1.0.2', false);

    wp_enqueue_script('mtu_slider');
  }
}

function load_pricing_js() {
  global $post;

  $pricing_page_slug = 'pricing';

  if((is_page()
    || is_single())
    && preg_match('/\b' . $pricing_page_slug . '\b/', $post->post_name)) {
    wp_register_script('pricing_js', get_template_directory_uri() . '/assets/js/pricing-script.js', '', '1.0.0', false);

    wp_enqueue_script('pricing_js');
  }
}

add_action('wp_enqueue_scripts', 'load_jquery');
add_action('wp_enqueue_scripts', 'load_lodash');
add_action('wp_enqueue_scripts', 'load_hammer_js');
add_action('wp_enqueue_scripts', 'load_bootstrap_js');
add_action('wp_enqueue_scripts', 'load_modernizr_js');
add_action('wp_enqueue_scripts', 'load_swiper_js');
add_action('wp_enqueue_scripts', 'load_selectivizr_js');
add_action('wp_enqueue_scripts', 'load_toLocalePoly_js');
add_action('wp_enqueue_scripts', 'load_theme_js');
add_action('wp_enqueue_scripts', 'load_mtu_slider');
add_action('wp_enqueue_scripts', 'load_pricing_js');
?>