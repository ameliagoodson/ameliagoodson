<?php 

function ag_register_styles() {
  wp_enqueue_style( 'ag_styles', get_template_directory_uri() . '/assets/css/main.css');
}
add_action( 'wp_enqueue_scripts', 'ag_register_styles' );