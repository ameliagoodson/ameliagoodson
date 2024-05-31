<?php

function ag_register_styles()
{
  wp_enqueue_style('ag_styles', get_template_directory_uri() . '/assets/css/theme.css');
  wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap', false);

  wp_enqueue_script('custom-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array(), false, true);
}
add_action('wp_enqueue_scripts', 'ag_register_styles');




function ag_add_features()
{
  // Add featured image
  add_theme_support('post-thumbnails');

  // Add excerpts for pages
  add_post_type_support('page', 'excerpt');
}
add_action('after_setup_theme', 'ag_add_features');


function ag_theme_setup()
{
  register_nav_menus(array(
    'primary' => __('Main menu', 'agtheme'),
    'footer' => __('Footer menu', 'agtheme'),
  ));
};


/* ------------------------------------------------------------------------------ /*
/*  REQUIRED FILES
/* ------------------------------------------------------------------------------ */

// Helpers.
require get_template_directory() . '/inc/helpers.php';

// Template functions
require get_template_directory() . '/inc/template-functions.php';
