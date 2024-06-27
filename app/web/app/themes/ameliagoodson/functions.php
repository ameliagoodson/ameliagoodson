<?php

/* ------------------------------------------------------------------------------ /*
/*  ENQUEUE STYLES
/* ------------------------------------------------------------------------------ */

function ag_register_styles()
{
  wp_enqueue_style('ag_styles', get_template_directory_uri() . '/assets/css/theme.css');

  wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap', false);

  // Customizer styles.
  wp_add_inline_style('ag_styles', AG_Customizer_CSS::get_customizer_css());

  wp_enqueue_script('custom-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array(), false, true);
}
add_action('wp_enqueue_scripts', 'ag_register_styles');

/* ------------------------------------------------------------------------------ /*
/*  ENQUEUE SCRIPTS
/* ------------------------------------------------------------------------------ */

function agtheme_register_scripts()
{
  // Built-in JS assets.
  $js_dependencies = array('jquery', 'imagesloaded');

  // CSS variables ponyfill.
  wp_register_script('agtheme-css-vars-ponyfill', get_template_directory_uri() . '/assets/js/vendor/css-vars-ponyfill.min.js', array(), '3.6.0');
  $js_dependencies[] = 'agtheme-css-vars-ponyfill';

  // Isotope.
  wp_register_script('isotope', get_template_directory_uri() . '/assets/js/vendor/isotope.pkgd.min.js', array(), '3.0.6');
  $js_dependencies[] = 'isotope';

  // Theme scripts.
  wp_enqueue_script('agtheme-scripts', get_template_directory_uri() . '/assets/js/scripts.js', $js_dependencies, filemtime(get_template_directory() . '/assets/js/scripts.js'));

  // Setup AJAX.
  $ajax_url = admin_url('admin-ajax.php');

  // AJAX Load More.
  wp_localize_script('agtheme-scripts', 'agtheme_ajax_load_more', array(
    'ajaxurl' => esc_url($ajax_url),
  ));

  // AJAX Filters.
  wp_localize_script('agtheme-scripts', 'agtheme_ajax_filters', array(
    'ajaxurl' => esc_url($ajax_url),
  ));
}
add_action('wp_enqueue_scripts', 'agtheme_register_scripts');



function ag_add_features()
{
  // Add featured image
  add_theme_support('post-thumbnails');

  // Add menus
  add_theme_support('menus');

  // Add support for custom background colors and background images in customizer
  add_theme_support('custom-background', array(
    'default-color'  => 'FFFFFF'
  ));

  // Add excerpts for pages
  add_post_type_support('page', 'excerpt');
}
add_action('after_setup_theme', 'ag_add_features');


function ag_register_menus()
{
  register_nav_menus(array(
    'primary' => __('Main menu', 'agtheme'),
    'footer' => __('Footer menu', 'agtheme'),
  ));
};
add_action('after_setup_theme', 'ag_register_menus');



/* ------------------------------------------------------------------------------ /*
/*  REQUIRED FILES
/* ------------------------------------------------------------------------------ */

// Helpers.
require get_template_directory() . '/inc/helpers.php';

// Template functions
require get_template_directory() . '/inc/template-functions.php';

// Template tags.
require get_template_directory() . '/inc/template-tags.php';

// SVG Icons class.
require get_template_directory() . '/inc/classes/class-ag-svg-icons.php';

// Customizer class
require get_template_directory() . '/inc/classes/class-ag-customizer.php';

// Custom CSS class.
require get_template_directory() . '/inc/classes/class-ag-css-customizer.php';
