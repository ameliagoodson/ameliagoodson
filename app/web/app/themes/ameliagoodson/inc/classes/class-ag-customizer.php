<?php

class AG_Customizer
{
	// Method
	public function agtheme_register($wp_customize)
	{
		// ------------------------------------------------------------------------------ //
		//  HERO SETTINGS
		// ------------------------------------------------------------------------------ //
		// Add the panel for Hero settings
		$wp_customize->add_panel('hero_settings', array(
			'title' => __('Hero Settings', 'agtheme'),
			'priority' => 10,
		));

		// Add a section for Hero layout
		$wp_customize->add_section('hero_layout_section', array(
			'title' => __('Hero Layout', 'agtheme'),
			'panel' => 'hero_settings',
			'priority' => 10,
		));

		// Hero layout setting
		$wp_customize->add_setting('hero_layout', array(
			'default' => 'Half image',
			'sanitize_callback' => 'sanitize_text_field',
		));

		$wp_customize->add_control('hero_layout', array(
			'label' => __('Hero Layout', 'agtheme'),
			'section' => 'hero_layout_section',
			'type' => 'select',
			'choices' => array(
				'Half image' => __('Half Image', 'agtheme'),
				'Full image' => __('Full Image', 'agtheme'),
				'transparent header' => __('Full Image Transparent Header', 'agtheme'),
				'No image' => __('No Image', 'agtheme'),
			),
		));

		// Add a section for Hero background image
		$wp_customize->add_section('hero_bg_image_section', array(
			'title' => __('Hero Background Image', 'agtheme'),
			'panel' => 'hero_settings',
			'priority' => 20,
		));

		// Hero background image setting
		$wp_customize->add_setting('hero_bg_image_setting', array(
			'default' => '',
			'sanitize_callback' => 'esc_url_raw',
		));

		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_bg_image_setting', array(
			'label' => __('Hero Background Image', 'agtheme'),
			'section' => 'hero_bg_image_section',
			'settings' => 'hero_bg_image_setting',
		)));

		// Hero background image position setting
		$wp_customize->add_setting('hero_bg_image_position', array(
			'default' => 'center center',
			'sanitize_callback' => 'sanitize_text_field',
		));

		$wp_customize->add_control('hero_bg_image_position', array(
			'label' => __('Hero Background Image Position', 'agtheme'),
			'section' => 'hero_bg_image_section',
			'type' => 'select',
			'default' => 'center center',
			'choices' => array(
				'left top' => __('Top Left', 'agtheme'),
				'center top' => __('Top Center', 'agtheme'),
				'right top' => __('Top Right', 'agtheme'),
				'left center' => __('Center Left', 'agtheme'),
				'center center' => __('Center Center', 'agtheme'),
				'right center' => __('Center Right', 'agtheme'),
				'left bottom' => __('Bottom Left', 'agtheme'),
				'center bottom' => __('Bottom Center', 'agtheme'),
				'right bottom' => __('Bottom Right', 'agtheme'),
			),
		));

		// Add a section for Hero image
		$wp_customize->add_section('hero_image_section', array(
			'title' => __('Hero Image', 'agtheme'),
			'panel' => 'hero_settings',
			'priority' => 30,
		));

		// Hero image setting
		$wp_customize->add_setting('hero_image', array(
			'default' => '',
			'sanitize_callback' => 'esc_url_raw',
		));

		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_image', array(
			'label' => __('Hero Image', 'agtheme'),
			'section' => 'hero_image_section',
			'settings' => 'hero_image',
		)));

		// Add a section for Hero text alignment
		$wp_customize->add_section('hero_text_alignment_section', array(
			'title' => __('Hero Text Alignment', 'agtheme'),
			'panel' => 'hero_settings',
			'priority' => 40,
		));

		// Hero text alignment setting
		$wp_customize->add_setting('text_alignment', array(
			'default' => 'left',
			'sanitize_callback' => 'sanitize_text_field',
		));

		$wp_customize->add_control('text_alignment', array(
			'label' => __('Text Alignment', 'agtheme'),
			'section' => 'hero_text_alignment_section',
			'type' => 'select',
			'choices' => array(
				'left' => __('Left', 'agtheme'),
				'center' => __('Center', 'agtheme'),
				'right' => __('Right', 'agtheme'),
			),
		));


		// ------------------------------------------------------------------------------ //
		//  SITE HEADER
		// ------------------------------------------------------------------------------ //
		$wp_customize->add_section('site_header', array(
			'title' => __('Header', 'agtheme'),
		));

		$wp_customize->add_setting('header_color', array(
			'default' => 'transparent',
		));

		$wp_customize->add_control('header_color', array(
			'label' => __('Header color', 'agtheme'),
			'section' => 'site_header',
			'type' => 'color',
		));
	}
}

// Create new instance of the AG_Customizer class. 
$ag_customizer = new AG_Customizer();

// Tells WordPress to call the agtheme_register method of the $ag_customizer instance when it's time to register customizer settings.
add_action('customize_register', array($ag_customizer, 'agtheme_register'));
