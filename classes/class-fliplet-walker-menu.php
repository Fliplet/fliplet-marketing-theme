<?php
/**
 * A custom Class to render a custom menu.
 *
 * @package Fliplet
 * @subpackage Fliplet_Marketing
 * @since 2.0.0
 */

/* Custom navigation menu */
class Nav_Menu_Walker extends Walker_Nav_Menu {
  public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    $class_names = $value = 'nav-item';
    $classes = empty($item->classes) ? '' : implode(' ', $item->classes);

    $class_names = in_array("current_page_item", $item->classes) ? ' active' : '';

    $children_count;

    if ($args->walker->has_children) {
      $locations = get_nav_menu_locations();

      // Get the main menu location
      $menu = wp_get_nav_menu_object( $locations['main_menu'] );

      $menu_items = wp_get_nav_menu_items($menu->term_id);
      $menu_item_parents = array_map(function($o) { return $o->menu_item_parent; }, $menu_items);
      $children_count = array_count_values($menu_item_parents)[$item->ID];
    }

    $class_names = $children_count > 6 ? ' menu-item-many-children' : '';

    $output .= '<li id="menu-item-' . $item->ID . '" class="' . $value . $classes . $class_names . '">';
    $attributes = '';

    !empty($item->attr_title)
    // Avoid redundant titles
    and $item->attr_title !== $item->title
    and $attributes .= ' title="' . esc_attr($item->attr_title) . '"';

    !empty($item->url)
    and $attributes .= ' href="' . esc_attr($item->url) . '"';

    !empty($item->target)
    and $attributes .= ' target="' . esc_attr($item->target) . '"';

    $attributes = trim($attributes);
    $title = apply_filters('the_title', $item->title, $item->ID);
    $item_output = "$args->before<a class='nav-link' $attributes>$args->link_before $title</a>" . "$args->link_after $args->after";

    // Since $output is called by reference we don't need to return anything.
    $output .= apply_filters(
      'walker_nav_menu_start_el',
      $item_output,
      $item,
      $depth,
      $args
    );
  }

  public function start_lvl(&$output, $depth = 0, $args = null) {
    $output .= '<ul class="sub-menu">';
  }

  public function end_lvl(&$output, $depth = 0, $args = null) {
    $output .= '</ul>';
  }

  public function end_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    $output .= '</li>';
  }
}

/* Main mobile menu */
class Main_Mobile_Menu_Walker extends Walker_Nav_Menu {
  public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    $class_names = $value = 'nav-item';
    $classes = empty($item->classes) ? '' : implode(' ', $item->classes);

    $class_names = in_array("current_page_item", $item->classes) ? ' active' : '';

    $output .= '<li id="menu-item-' . $item->ID . '" class="' . $value . $classes . $class_names . '">';
    $attributes = '';

    !empty($item->attr_title)
    // Avoid redundant titles
    and $item->attr_title !== $item->title
    and $attributes .= ' title="' . esc_attr($item->attr_title) . '"';

    !empty($item->url)
    and $attributes .= ' href="' . esc_attr($item->url) . '"';

    !empty($item->target)
    and $attributes .= ' target="' . esc_attr($item->target) . '"';

    $attributes = trim($attributes);
    $title = apply_filters('the_title', $item->title, $item->ID);
    $item_output = "$args->before<a class='nav-link' $attributes>$args->link_before $title</a>" . "$args->link_after $args->after";

    // Since $output is called by reference we don't need to return anything.
    $output .= apply_filters(
      'walker_nav_menu_start_el',
      $item_output,
      $item,
      $depth,
      $args
    );
  }

  public function start_lvl(&$output, $depth = 0, $args = null) {
    $output .= '<ul class="main-mobile-sub-menu">';
  }

  public function end_lvl(&$output, $depth = 0, $args = null) {
    $output .= '</ul>';
  }

  public function end_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    $output .= '</li>';
  }
}