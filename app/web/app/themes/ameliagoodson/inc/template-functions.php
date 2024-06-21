<?php

/**
 * Template functions.
 *
 */

/**
 * Returns the custom archive title prefix.
 */
function agtheme_get_the_archive_title_prefix()
{

  $prefix = '';

  if (is_search()) {
    $prefix = esc_html_x('Search Results', 'search archive title prefix', 'agtheme');
  } elseif (is_category()) {
    $prefix = esc_html_x('Category', 'category archive title prefix', 'agtheme');
  } elseif (is_tag()) {
    $prefix = esc_html_x('Tag', 'tag archive title prefix', 'agtheme');
  } elseif (is_author()) {
    $prefix = esc_html_x('Author', 'author archive title prefix', 'agtheme');
  } elseif (is_year()) {
    $prefix = esc_html_x('Year', 'date archive title prefix', 'agtheme');
  } elseif (is_month()) {
    $prefix = esc_html_x('Month', 'date archive title prefix', 'agtheme');
  } elseif (is_day()) {
    $prefix = esc_html_x('Day', 'date archive title prefix', 'agtheme');
  } elseif (is_post_type_archive()) {
    // No prefix for post type archives.
    $prefix = '';
  } elseif (is_tax('post_format')) {
    // No prefix for post format archives.
    $prefix = '';
  } elseif (is_tax()) {
    $queried_object = get_queried_object();
    if ($queried_object) {
      $tax    = get_taxonomy($queried_object->taxonomy);
      $prefix = sprintf(
        /* translators: %s: Taxonomy singular name. */
        esc_html_x('%s:', 'taxonomy term archive title prefix', 'agtheme'),
        $tax->labels->singular_name
      );
    }
  } elseif (is_home() && is_paged()) {
    $prefix = esc_html_x('Archives', 'general archive title prefix', 'agtheme');
  }

  return $prefix;
}
