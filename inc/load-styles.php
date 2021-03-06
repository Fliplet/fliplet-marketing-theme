<?php
/**
 * Functions that enqueue the styles and loads them.
 *
 * @package Fliplet
 * @subpackage Fliplet_Marketing
 * @since 2.0.0
 */

/* Enqueues the styles */
function load_reset_css() {
  wp_register_style('reset_css', get_template_directory_uri() . '/assets/css/reset.css', array(), '1.0.0', 'all');

  wp_enqueue_style('reset_css');
}

function load_bootstrap_css() {
  wp_register_style('bootstrap_css', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '3.4.1', 'all');

  wp_enqueue_style('bootstrap_css');
}

function load_animate_css() {
  wp_register_style('animate_css', get_template_directory_uri() . '/assets/css/animate.css', array(), '4.0.0', 'all');

  wp_enqueue_style('animate_css');
}

function load_fontawesome_css() {
  wp_register_style('fontawesome_css', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.7.0', 'all');

  wp_enqueue_style('fontawesome_css');
}

function load_swiper_css() {
  wp_register_style('swiper_css', get_template_directory_uri() . '/assets/css/swiper.min.css', array(), '6.1.2', 'all');

  wp_enqueue_style('swiper_css');
}

function load_fliplet_fonts() {
  wp_register_style('fliplet_fonts', get_template_directory_uri() . '/assets/fonts/fliplet-icons/style.css', array(), '1.0.0', 'all');

  wp_enqueue_style('fliplet_fonts');
}

function load_typography() {
  wp_register_style('fliplet_typography', get_template_directory_uri() . '/assets/css/typography.css', array(), '1.0.1', 'all');

  wp_enqueue_style('fliplet_typography');
}

function load_theme_styles() {
  wp_register_style('theme_style', get_template_directory_uri() . '/style.css', array(), '2.1.1', 'all');

  wp_enqueue_style('theme_style');
}

function load_pricing_styles() {
  global $post;

  $pricing_page_slug = 'pricing';

  if((is_page()
    || is_single())
    && preg_match('/\b' . $pricing_page_slug . '\b/', $post->post_name)) {
    wp_register_style('pricing_styles', get_template_directory_uri() . '/assets/css/pricing-style.css', array(), '1.0.2', 'all');

    wp_enqueue_style('pricing_styles');
  }
}

add_action('wp_enqueue_scripts', 'load_reset_css');
add_action('wp_enqueue_scripts', 'load_bootstrap_css');
add_action('wp_enqueue_scripts', 'load_animate_css');
add_action('wp_enqueue_scripts', 'load_fontawesome_css');
add_action('wp_enqueue_scripts', 'load_swiper_css');
add_action('wp_enqueue_scripts', 'load_fliplet_fonts');
add_action('wp_enqueue_scripts', 'load_typography');
add_action('wp_enqueue_scripts', 'load_theme_styles');
add_action('wp_enqueue_scripts', 'load_pricing_styles');
?>