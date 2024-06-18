<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php bloginfo('name'); ?></title>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <?php
  $background_image = get_theme_mod('background_image');
  ?>

  <?php if ($background_image) : ?>
    <div class="background-image" style="background-image: url(<?php echo esc_url($background_image); ?>);">
    <?php endif; ?>

    <?php get_template_part('parts/global/site-header'); ?>