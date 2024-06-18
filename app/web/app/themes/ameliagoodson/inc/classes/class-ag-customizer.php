<?php

class AG_Customizer
{
	// Method
	public function agtheme_register($wp_customize)
	{
		// ------------------------------------------------------------------------------ //
		//  HERO SETTINGS
		// ------------------------------------------------------------------------------ //
		$wp_customize->add_panel('hero_settings', array(
			'title' => __('Hero settings', 'agtheme'),
			'priority' => 10,
		));

		// Hero title ----------------------------------------- //

		$wp_customize->add_section('hero_title', array(
			'title' => __('Hero title', 'agtheme'),
			'panel' => 'hero_settings',
		));

		$wp_customize->add_setting('hero_title', array(
			'default' => 'Where creativity meets code',
		));

		$wp_customize->add_control('hero_title', array(
			'label' => __('Hero title', 'agtheme'),
			'section' => 'hero_title',
			'type' => 'text',
		));

		// Hero subtitle ----------------------------------------- //

		$wp_customize->add_section('hero_subtitle', array(
			'title' => __('Hero subtitle', 'agtheme'),
			'panel' => 'hero_settings',
		));

		$wp_customize->add_setting('hero_subtitle', array(
			'default' => 'Web developer specializing in WordPress and Shopify',
		));

		$wp_customize->add_control('hero_subtitle', array(
			'label' => __('Hero subtitle', 'agtheme'),
			'section' => 'hero_subtitle',
			'type' => 'text',
		));

		// Hero width ----------------------------------------- //
		$wp_customize->add_section('hero_width', array(
			'title' => __('Hero width', 'agtheme'),
			'panel' => 'hero_settings',
		));
		$wp_customize->add_setting('hero_width', array(
			'default' => 'medium',
		));
		$wp_customize->add_control('hero_width', array(
			'label' => __('Hero width', 'agtheme'),
			'section' => 'hero_width',
			'type' => 'select',
			// key => value (labels)
			'choices' => array(
				'thin' => 'Thin',
				'small' => 'Small',
				'medium' => 'Medium',
				'large' => 'Large',
				'max' => 'Max',
			),
		));

		// Hero text alignment
		$wp_customize->add_section(
			'text_alignment',
			array(
				'title' => __('Text alignment', 'agtheme'),
				'panel' => 'hero_settings',
			)
		);
		$wp_customize->add_setting('text_alignment', array(
			'default' => 'left',
		));
		$wp_customize->add_control('text_alignment', array(
			'label' => __('Text alignment', 'agtheme'),
			'section' => 'text_alignment',
			'type' => 'select',
			// key => value (labels)
			'choices' => array(
				'left' => 'Left',
				'center' => 'Centre',
				'right' => 'Right',
			),
		));

		// Hero image
		$wp_customize->add_section(
			'hero_image',
			array(
				'title' => __('Hero image', 'agtheme'),
				'panel' => 'hero_settings',
			)
		);
		$wp_customize->add_setting('hero_image', array(
			'default' => '',
		));
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'hero_image',
				array(
					'label' => __('Hero image', 'agtheme'),
					'section' => 'hero_image',
				)
			)
		);

		// Background image
		$wp_customize->add_section(
			'background_image',
			array(
				'title' => __('Background image', 'agtheme'),
				'panel' => 'hero_settings',
			)
		);
		$wp_customize->add_setting('background_image', array(
			'default' => 'center center',
		));
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'background_image',
				array(
					'label' => __('Background image', 'agtheme'),
					'section' => 'background_image',
				)
			)
		);



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
