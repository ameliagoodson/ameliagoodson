<?php
/**
 * Customizer settings.
 *
 */

class AG_Theme_Customizer {

  /**
	 * Customizer options.
	 */
	public static function ag_register( $wp_customize ) {

    /* ------------------------------------------------------------------------------ /*
    /*  THEME OPTIONS
    /* ------------------------------------------------------------------------------ */

		$wp_customize->add_panel( 'ag_theme_options', array(
			'priority'       => 30,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => esc_html__( 'Theme Options', 'agtheme' ),
		) );


    /* ------------------------------------------------------------------------------ /*
    /*  SITE IDENTITY
    /* ------------------------------------------------------------------------------ */

		/* Dark Mode Logo ---------------- */

		$wp_customize->add_setting( 'ag_dark_mode_logo', array(
			'capability' 				=> 'edit_theme_options',
			'sanitize_callback' => 'absint'
		) );

		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'ag_dark_mode_logo', array(
			'label'						=> esc_html__( 'Dark Mode Logo', 'agtheme' ),
			'description'			=> esc_html__( 'Used when a visitor views the site with dark mode active and the "Enable Dark Mode Color Palette" setting is enabled in Customizer → Colors.', 'agtheme' ),
			'mime_type'				=> 'image',
			'priority'				=> 9,
			'section' 				=> 'title_tagline',
			'active_callback' => function(){
        return get_theme_mod( 'ag_enable_dark_mode_palette', false );
      },
		) ) );

		/* 2X Header Logo ---------------- */

		// $wp_customize->add_setting( 'ag_retina_logo', array(
		// 	'capability' 		=> 'edit_theme_options',
		// 	'sanitize_callback' => 'ag_sanitize_checkbox',
		// ) );

		// $wp_customize->add_control( 'ag_retina_logo', array(
		// 	'type' 			=> 'checkbox',
		// 	'section' 		=> 'title_tagline',
		// 	'priority'		=> 9,
		// 	'label' 		=> esc_html__( 'Retina logo', 'agtheme' ),
		// 	'description' 	=> esc_html__( 'Scales the logo to half its uploaded size, making it sharp on high-res screens.', 'agtheme' ),
		// ) );

		/* Site Logo --------------------- */

		// Make the core custom_logo setting use refresh transport, so we update the markup around the site logo element as well.
		$wp_customize->get_setting( 'custom_logo' )->transport = 'refresh';
		
		// Remove the ability to display site name and description in header.
		$wp_customize->remove_control( 'header_text' );


    /* ------------------------------------------------------------------------------ /*
    /*  COLORS
    /* ------------------------------------------------------------------------------ */

		$color_options = self::get_color_options();

		// Contains two groups of colors: regular and dark_mode.
		$color_options_regular 	 = isset( $color_options['regular'] ) ? $color_options['regular'] : array();
		$color_options_dark_mode = isset( $color_options['dark_mode'] ) ? $color_options['dark_mode'] : array();

		/* Regular Colors ---------------- */

		if ( $color_options_regular ) {
			foreach ( $color_options_regular as $color_option_name => $color_option ) {

				$wp_customize->add_setting( $color_option_name, array(
					'default' 					=> $color_option['default'],
					'type' 							=> 'theme_mod',
					'sanitize_callback' => 'sanitize_hex_color',
				) );

				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $color_option_name, array(
					'label' 	 => $color_option['label'],
					'section'  => 'colors',
					'settings' => $color_option_name,
				) ) );

			}
		}

		/* Separator --------------------- */

		$wp_customize->add_setting( 'ag_colors_sep_1', array(
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		) );

		$wp_customize->add_control( new AG_Theme_Separator_Control( $wp_customize, 'ag_colors_sep_1', array(
			'section' => 'colors',
		) ) );

		/* Dark Mode Palette Checkbox ---- */

		$wp_customize->add_setting( 'ag_enable_dark_mode_palette', array(
			'capability' 				=> 'edit_theme_options',
			'default'						=> false,
			'sanitize_callback' => 'ag_sanitize_checkbox'
		) );

		$wp_customize->add_control( 'ag_enable_dark_mode_palette', array(
			'type' 				=> 'checkbox',
			'section' 		=> 'colors',
			'label' 			=> esc_html__( 'Enable Dark Mode Color Palette', 'agtheme' ),
			'description'	=> esc_html__( 'The palette is used when the visitor has set their operating system to a light-on-dark color scheme. The feature is supported by most modern OSs and browsers, but not all. Your OS needs to be set to a light-on-dark color scheme for you to preview the color palette.', 'agtheme' ),
		) );

		/* Dark Mode Colors -------------- */

		if ( $color_options_dark_mode ) {
			foreach ( $color_options_dark_mode as $color_option_name => $color_option ) {

				$wp_customize->add_setting( $color_option_name, array(
					'default' 					=> $color_option['default'],
					'type' 							=> 'theme_mod',
					'sanitize_callback' => 'sanitize_hex_color',
				) );

				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $color_option_name, array(
					'label' 	 => sprintf( esc_html_x( 'Dark Mode %s', 'Customizer option label. %s = Name of the color.', 'agtheme' ), $color_option['label'] ),
					'section'  => 'colors',
					'settings' => $color_option_name,
					'priority' => 10,
				) ) );

			}
		}

		/* Background Color -------------- */

		// Make the core background_color setting use refresh transport, for consistency.
		$wp_customize->get_setting( 'background_color' )->transport = 'refresh';


    /* ------------------------------------------------------------------------------ /*
    /*  GENERAL OPTIONS
    /* ------------------------------------------------------------------------------ */

		$wp_customize->add_section( 'ag_general_options', array(
			'title' 		 => esc_html__( 'General Options', 'agtheme' ),
			'priority' 	 => 10,
			'capability' => 'edit_theme_options',
			'panel'			 => 'ag_theme_options',
		) );

		/* Disable Animations ------------ */

		$wp_customize->add_setting( 'ag_disable_animations', array(
			'capability' 				=> 'edit_theme_options',
			'default'						=> false,
			'sanitize_callback' => 'ag_sanitize_checkbox'
		) );

		$wp_customize->add_control( 'ag_disable_animations', array(
			'type' 				=> 'checkbox',
			'section' 		=> 'ag_general_options',
			'label' 			=> esc_html__( 'Disable Animations', 'agtheme' ),
			'description'	=> esc_html__( 'Check to disable animations and transitions in the theme.', 'agtheme' ),
		) );


    /* ------------------------------------------------------------------------------ /*
    /*  SITE HEADER
    /* ------------------------------------------------------------------------------ */

		$wp_customize->add_section( 'ag_site_header_options', array(
			'title' 			=> esc_html__( 'Site Header', 'agtheme' ),
			'priority' 		=> 20,
			'capability' 	=> 'edit_theme_options',
			'description' => esc_html__( 'Settings for the site header.', 'agtheme' ),
			'panel'				=> 'ag_theme_options',
		) );

		/* Enable Sticky Header ---------- */

		$wp_customize->add_setting( 'ag_enable_sticky_header', array(
			'capability' 				=> 'edit_theme_options',
			'default'						=> true,
			'sanitize_callback' => 'ag_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'ag_enable_sticky_header', array(
			'type' 				=> 'checkbox',
			'section' 		=> 'ag_site_header_options',
			'priority'		=> 10,
			'label' 			=> esc_html__( 'Enable Sticky Header', 'agtheme' ),
			'description' => esc_html__( 'Determines whether to header should stick to the top of the screen when scrolling.', 'agtheme' ),
		) );

		/* Enable Search ----------------- */

		$wp_customize->add_setting( 'ag_enable_search', array(
			'capability' 				=> 'edit_theme_options',
			'default'						=> true,
			'sanitize_callback' => 'ag_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'ag_enable_search', array(
			'type' 				=> 'checkbox',
			'section' 		=> 'ag_site_header_options',
			'priority'		=> 10,
			'label' 			=> esc_html__( 'Enable Search', 'agtheme' ),
			'description' => esc_html__( 'Uncheck to disable the search button in the header, and the search form in the mobile menu.', 'agtheme' ),
		) );

		/* Enable Menu Button Labels ----- */

		$wp_customize->add_setting( 'ag_enable_menu_button_labels', array(
			'capability' 				=> 'edit_theme_options',
			'default'						=> false,
			'sanitize_callback' => 'ag_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'ag_enable_menu_button_labels', array(
			'type' 				=> 'checkbox',
			'section' 		=> 'ag_site_header_options',
			'priority'		=> 10,
			'label' 			=> esc_html__( 'Enable Menu Button Labels', 'agtheme' ),
			'description' => esc_html__( 'Check to display text labels for the menu buttons in the header and sidebar.', 'agtheme' ),
		) );


    /* ------------------------------------------------------------------------------ /*
    /*  ARCHIVES
    /* ------------------------------------------------------------------------------ */

		$wp_customize->add_section( 'ag_archive_pages_options', array(
			'title' 		 => esc_html__( 'Archive Pages', 'agtheme' ),
			'priority' 	 => 30,
			'capability' => 'edit_theme_options',
			'panel'			 => 'ag_theme_options',
		) );

		/* Home Text --------------- */

		$wp_customize->add_setting( 'ag_home_text', array(
			'capability' 				=> 'edit_theme_options',
			'default'						=> '',
			'sanitize_callback' => 'sanitize_textarea_field',
		) );

		$wp_customize->add_control( 'ag_home_text', array(
			'type' 				=> 'textarea',
			'section' 		=> 'ag_archive_pages_options',
			'label' 			=> esc_html__( 'Intro Text', 'agtheme' ),
			'description' => esc_html__( 'Shown below the site title on the front page, when the front page is set to display latest posts.', 'agtheme' ),
		) );

		/* Show Archive Filters --------- */

		$wp_customize->add_setting( 'ag_show_archive_filters', array(
			'capability' 				=> 'edit_theme_options',
			'default'						=> true,
			'sanitize_callback' => 'ag_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'ag_show_archive_filters', array(
			'type' 				=> 'checkbox',
			'section' 		=> 'ag_archive_pages_options',
			'label' 			=> esc_html__( 'Show Filter', 'agtheme' ),
			'description' => esc_html__( 'Whether to display the category filter on the post archive.', 'agtheme' ),
		) );

		/* Show Category Post Count ------ */

		$wp_customize->add_setting( 'ag_show_filter_category_post_count', array(
			'capability' 				=> 'edit_theme_options',
			'default'						=> false,
			'sanitize_callback' => 'ag_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'ag_show_filter_category_post_count', array(
			'type' 				=> 'checkbox',
			'section' 		=> 'ag_archive_pages_options',
			'label' 			=> esc_html__( 'Show Filter Category Post Count', 'agtheme' ),
			'description' => esc_html__( 'Whether to display the number of posts in each category in the filter.', 'agtheme' ),
		) );

		/* Separator --------------------- */

		$wp_customize->add_setting( 'ag_archive_pages_options_sep_1', array(
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		) );

		$wp_customize->add_control( new AG_Theme_Separator_Control( $wp_customize, 'ag_archive_pages_options_sep_1', array(
			'section' => 'ag_archive_pages_options',
		) ) );

		/* Pagination Type --------------- */

		$wp_customize->add_setting( 'ag_pagination_type', array(
			'capability' 				=> 'edit_theme_options',
			'default'           => 'button',
			'sanitize_callback' => 'ag_sanitize_select',
		) );

		$wp_customize->add_control( 'ag_pagination_type', array(
			'type'				=> 'select',
			'section' 		=> 'ag_archive_pages_options',
			'label'   		=> esc_html__( 'Pagination Type', 'agtheme' ),
			'description'	=> esc_html__( 'Determines how the pagination on archive pages should be displayed.', 'agtheme' ),
			'choices' 		=> array(
				'button' => esc_html__( 'Load more button', 'agtheme' ),
				'scroll' => esc_html__( 'Load more on scroll', 'agtheme' ),
				'links'	 => esc_html__( 'Links', 'agtheme' ),
			),
		) );

		/* Separator --------------------- */

		$wp_customize->add_setting( 'ag_archive_pages_options_sep_2', array(
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		) );

		$wp_customize->add_control( new AG_Theme_Separator_Control( $wp_customize, 'ag_archive_pages_options_sep_2', array(
			'section' => 'ag_archive_pages_options',
		) ) );

		/* Number of Post Columns -------- */

		// Store the different screen size options in an array for brevity.
		$post_column_option_sizes = AG_Theme_Customizer::get_archive_columns_options();

		// Loop over each screen size option and register it
		foreach ( $post_column_option_sizes as $setting_name => $data ) {
			$wp_customize->add_setting( $setting_name, array(
				'capability' 				=> 'edit_theme_options',
				'default'           => $data['default'],
				'sanitize_callback' => 'ag_sanitize_select',
			) );

			$wp_customize->add_control( $setting_name, array(
				'type'				=> 'select',
				'section' 		=> 'ag_archive_pages_options',
				'label'   		=> $data['label'],
				'description' => $data['description'],
				'choices' 		=> array(
					'1'	=> esc_html__( 'One', 'agtheme' ),
					'2'	=> esc_html__( 'Two', 'agtheme' ),
					'3'	=> esc_html__( 'Three', 'agtheme' ),
					'4'	=> esc_html__( 'Four', 'agtheme' ),
				),
			) );
		}

		/* Separator --------------------- */

		$wp_customize->add_setting( 'ag_archive_pages_options_sep_3', array(
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		) );

		$wp_customize->add_control( new AG_Theme_Separator_Control( $wp_customize, 'ag_archive_pages_options_sep_3', array(
			'section' => 'ag_archive_pages_options',
		) ) );

		/* Post Meta --------------------- */

		// Get an array with the post types that support the post meta Customizer setting.
		$post_types_with_post_meta = self::get_post_types_with_post_meta();

		foreach ( $post_types_with_post_meta as $post_type => $post_type_settings ) {

			// Only output for registered post types.
			if ( ! post_type_exists( $post_type ) ) {
				continue;
			}

			// Get the post type name for inclusion in the label and description.
			$post_type_obj 	= get_post_type_object( $post_type );
			$post_type_name	= isset( $post_type_obj->labels->name ) ? $post_type_obj->labels->name : $post_type;

			// Parse the arguments of the post type.
			$post_type_settings = wp_parse_args( $post_type_settings, array(
				'default'	=> array(
					'archive'	=> array(),
					'single'	=> array(),
				),
			) );

			$wp_customize->add_setting( 'ag_post_meta_' . $post_type, array(
				'capability' 				=> 'edit_theme_options',
				'default'           => $post_type_settings['default']['archive'],
				'sanitize_callback' => 'ag_sanitize_multiple_checkboxes',
			) );

			$wp_customize->add_control( new AG_Theme_Customize_Control_Checkbox_Multiple( $wp_customize, 'ag_post_meta_' . $post_type, array(
				'section' 		=> 'ag_archive_pages_options',
				'label'   		=> sprintf( esc_html_x( 'Post Meta for %s', 'Customizer setting name. %s = Post type plural name', 'agtheme' ), $post_type_name ),
				'description'	=> sprintf( esc_html_x( 'Select which post meta to display for %s on archive pages.', 'Customizer setting description. %s = Post type plural name', 'agtheme' ), strtolower( $post_type_name ) ),
				'choices' 		=> self::get_post_meta_options( $post_type ),
			) ) );

		}


    /* ------------------------------------------------------------------------------ /*
    /*  SINGLE POSTS
    /* ------------------------------------------------------------------------------ */

		$wp_customize->add_section( 'ag_single_options', array(
			'title' 		 => esc_html__( 'Single Posts', 'agtheme' ),
			'priority' 	 => 30,
			'capability' => 'edit_theme_options',
			'panel'			 => 'ag_theme_options',
		) );

		/* Post Meta --------------------- */

		// Loop over the post types that support the post meta Customizer setting.
		foreach ( $post_types_with_post_meta as $post_type => $post_type_settings ) {

			// Only output for registered post types.
			if ( ! post_type_exists( $post_type ) ) {
				continue;
			}

			// Get the post type name for inclusion in the label and description.
			$post_type_obj 	= get_post_type_object( $post_type );
			$post_type_name	= isset( $post_type_obj->labels->name ) ? $post_type_obj->labels->name : $post_type;

			// Parse the arguments of the post type.
			$post_type_settings = wp_parse_args( $post_type_settings, array(
				'default'	=> array(
					'archive'	=> array(),
					'single'	=> array(),
				),
			) );

			$wp_customize->add_setting( 'ag_post_meta_' . $post_type . '_single', array(
				'capability' 				=> 'edit_theme_options',
				'default'           => $post_type_settings['default']['single'],
				'sanitize_callback' => 'ag_sanitize_multiple_checkboxes',
			) );

			$wp_customize->add_control( new AG_Theme_Customize_Control_Checkbox_Multiple( $wp_customize, 'ag_post_meta_' . $post_type . '_single', array(
				'section' 		=> 'ag_single_options',
				'label'   		=> sprintf( esc_html_x( 'Post Meta for %s', 'Customizer setting name. %s = Post type plural name', 'agtheme' ), $post_type_name ),
				'description'	=> sprintf( esc_html_x( 'Select which post meta to display on single %s.', 'Customizer setting description. %s = Post type plural name', 'agtheme' ), strtolower( $post_type_name ) ),
				'choices' 		=> self::get_post_meta_options( $post_type ),
			) ) );

		}

    /* ------------------------------------------------------------------------------ /*
    /*  FALLBACK IMAGES
    /* ------------------------------------------------------------------------------ */

		$wp_customize->add_section( 'ag_image_options', array(
			'title' 			=> esc_html__( 'Images', 'agtheme' ),
			'priority' 		=> 40,
			'capability' 	=> 'edit_theme_options',
			'description' => esc_html__( 'Settings for images.', 'agtheme' ),
			'panel'				=> 'ag_theme_options',
		) );

		/* Fallback Image Setting -------- */

		$wp_customize->add_setting( 'ag_fallback_image', array(
			'capability' 				=> 'edit_theme_options',
			'sanitize_callback' => 'absint'
		) );

		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'ag_fallback_image', array(
			'label'				=> esc_html__( 'Fallback Image', 'agtheme' ),
			'description'	=> esc_html__( 'The selected image will be used on archive pages when a post is missing a featured image. A default fallback image included in the theme will be used if no image is set.', 'agtheme' ),
			'mime_type'		=> 'image',
			'section' 		=> 'ag_image_options',
		) ) );


    /* ------------------------------------------------------------------------------ /*
    /*  SANITATION FUNCTIONS
    /* ------------------------------------------------------------------------------ */
		
		/* Sanitize Checkbox ------------- */

		function ag_sanitize_checkbox( $checked ) {
			return ( ( isset( $checked ) && true == $checked ) ? true : false );
		}

		/* Sanitize Multiple Checkboxes -- */

		function ag_sanitize_multiple_checkboxes( $values ) {
			$multi_values = ! is_array( $values ) ? explode( ',', $values ) : $values;
			return ! empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
		}

		/* Sanitize Select --------------- */

		function ag_sanitize_select( $input, $setting ) {
			$input = sanitize_key( $input );
			$choices = $setting->manager->get_control( $setting->id )->choices;
			return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
		}

	}


	/**
	 * Returns the available post meta options.
	 */
	public static function get_post_meta_options( $post_type ) {

		$post_meta_options = array(
			'post' => array(
				'author'		 => esc_html__( 'Author', 'agtheme' ),
				'categories' => esc_html__( 'Categories', 'agtheme' ),
				'tags'			 => esc_html__( 'Tags', 'agtheme' ),
				'comments'	 => esc_html__( 'Comments', 'agtheme' ),
				'date'			 => esc_html__( 'Date', 'agtheme' ),
				'edit-link'	 => esc_html__( 'Edit link (for logged in users)', 'agtheme' ),
			),
		);

		return isset( $post_meta_options[$post_type] ) ? $post_meta_options[$post_type] : array();
		
	}


	/**
	 * Returns an array of post types with post meta options and their default values.
	 */
	public static function get_post_types_with_post_meta() {

		return array( 
			'post' => array(
				'default' => array(
					'archive' => array( 'categories', 'date' ),
					'single'  => array( 'categories', 'date', 'tags', 'edit-link' ),
				),
			),
		);
		
	}


	/**
	 * Returns the global color options.
	 */
	public static function get_color_options() {

		return array(
			'regular'		=> array(
				// Note: The body background color uses the built-in WordPress theme mod, which is why it isn't included in this array.
				'ag_light_background_color' => array(
					'default'	=> '#f3efe9',
					'label'		=> esc_html__( 'Light Background Color', 'agtheme' ),
					'slug'		=> 'light-background',
					'palette'	=> true,
				),
				'ag_primary_color' => array(
					'default'	=> '#1e2d32',
					'label'		=> esc_html__( 'Primary Text Color', 'agtheme' ),
					'slug'		=> 'primary',
					'palette'	=> true,
				),
				'ag_secondary_color' => array(
					'default'	=> '#707376',
					'label'		=> esc_html__( 'Secondary Text Color', 'agtheme' ),
					'slug'		=> 'secondary',
					'palette'	=> true,
				),
				'ag_border_color' => array(
					'default'	=> '#d6d5d4',
					'label'		=> esc_html__( 'Border Color', 'agtheme' ),
					'slug'		=> 'border',
					'palette'	=> true,
				),
				'ag_accent_color' => array(
					'default'	=> '#d23c50',
					'label'		=> esc_html__( 'Accent Color', 'agtheme' ),
					'slug'		=> 'accent',
					'palette'	=> true,
				),
				'ag_menu_modal_text_color' => array(
					'default'	=> '#ffffff',
					'label'		=> esc_html__( 'Menu Modal Text Color', 'agtheme' ),
					'slug'		=> 'menu-modal-text',
					'palette'	=> false,
				),
				'ag_menu_modal_background_color' => array(
					'default'	=> '#1e2d32',
					'label'		=> esc_html__( 'Menu Modal Background Color', 'agtheme' ),
					'slug'		=> 'menu-modal-background',
					'palette'	=> false,
				),
			),
			'dark_mode'		=> array(
				'ag_dark_mode_background_color' => array(
					'default'	=> '#1E2D32',
					'label'		=> esc_html__( 'Background Color', 'agtheme' ),
					'slug'		=> 'background',
					'palette'	=> false,
				),
				'ag_dark_mode_light_background_color' => array(
					'default'	=> '#29373C',
					'label'		=> esc_html__( 'Light Background Color', 'agtheme' ),
					'slug'		=> 'light-background',
					'palette'	=> false,
				),
				'ag_dark_mode_primary_color' => array(
					'default'	=> '#ffffff',
					'label'		=> esc_html__( 'Primary Text Color', 'agtheme' ),
					'slug'		=> 'primary',
					'palette'	=> false,
				),
				'ag_dark_mode_secondary_color' => array(
					'default'	=> '#939699',
					'label'		=> esc_html__( 'Secondary Text Color', 'agtheme' ),
					'slug'		=> 'secondary',
					'palette'	=> false,
				),
				'ag_dark_mode_border_color' => array(
					'default'	=> '#404C51',
					'label'		=> esc_html__( 'Border Color', 'agtheme' ),
					'slug'		=> 'border',
					'palette'	=> false,
				),
				'ag_dark_mode_accent_color' => array(
					'default'	=> '#d23c50',
					'label'		=> esc_html__( 'Accent Color', 'agtheme' ),
					'slug'		=> 'accent',
					'palette'	=> false,
				),
				'ag_dark_mode_menu_modal_text_color' => array(
					'default'	=> '#ffffff',
					'label'		=> esc_html__( 'Menu Modal Text Color', 'agtheme' ),
					'slug'		=> 'menu-modal-text',
					'palette'	=> false,
				),
				'ag_dark_mode_menu_modal_background_color' => array(
					'default'	=> '#344247',
					'label'		=> esc_html__( 'Menu Modal Background Color', 'agtheme' ),
					'slug'		=> 'menu-modal-background',
					'palette'	=> false,
				),
			),
		);
		
	}


	/**
	 * Returns the post archive column options.
	 */
	public static function get_archive_columns_options() {
		
		return array(
			'ag_post_grid_columns_mobile' => array(
				'label'				=> esc_html__( 'Columns on Mobile', 'agtheme' ),
				'default'			=> '1',
				'description'	=> esc_html__( 'Screen width: 0px - 700px', 'agtheme' ),
			),
			'ag_post_grid_columns_tablet' => array(
				'label'				=> esc_html__( 'Columns on Tablet', 'agtheme' ),
				'default'			=> '2',
				'description'	=> esc_html__( 'Screen width: 700px - 1000px', 'agtheme' ),
			),
			'ag_post_grid_columns_laptop' => array(
				'label'				=> esc_html__( 'Columns on Laptop', 'agtheme' ),
				'default'			=> '2',
				'description'	=> esc_html__( 'Screen width: 1000px - 1200px', 'agtheme' ),
			),
			'ag_post_grid_columns_desktop' => array(
				'label'				=> esc_html__( 'Columns on Desktop', 'agtheme' ),
				'default'			=> '3',
				'description'	=> esc_html__( 'Screen width: 1200px - 1600px', 'agtheme' ),
			),
			'ag_post_grid_columns_desktop_xl' => array(
				'label'				=> esc_html__( 'Columns on Desktop XL', 'agtheme' ),
				'default'			=> '4',
				'description'	=> esc_html__( 'Screen width: > 1600px', 'agtheme' ),
			),
		);

	}


	/**
	 * Enqueue the Customizer JavaScript.
	 */
	public static function enqueue_customizer_javascript() {
		wp_enqueue_script( 'ag-customizer-javascript', get_template_directory_uri() . '/assets/js/customizer.js', array( 'jquery', 'customize-controls' ), '', true );
	}

}
add_action( 'customize_register', array( 'AG_Theme_Customizer', 'ag_register' ) );
add_action( 'customize_controls_enqueue_scripts', array( 'AG_Theme_Customizer', 'enqueue_customizer_javascript' ) );


/* ------------------------------------------------------------------------------ /*
/*  CUSTOM CUSTOMIZER CONTROLS
/* ------------------------------------------------------------------------------ */

if ( class_exists( 'WP_Customize_Control' ) ) {
	/**
   * Separator Control
   */
	class AG_Theme_Separator_Control extends WP_Customize_Control {
		public $type = 'ag_separator_control';
		public function render_content() {
			echo '<hr/>';
		}
	}

	/**
   * Multiple Checkboxes control.
   * Based on a solution by Justin Tadlock: http://justintadlock.com/archives/2015/05/26/multiple-checkbox-customizer-control
   */
	class AG_Theme_Customize_Control_Checkbox_Multiple extends WP_Customize_Control {

		public $type = 'checkbox-multiple';

		public function render_content() {

			if ( empty( $this->choices ) ) {
				return;
			}

			if ( ! empty( $this->label ) ) {
				echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
			}

			if ( ! empty( $this->description ) ) {
				echo '<span class="description customize-control-description">' . esc_html( $this->description ) . '</span>';
			}

			$multi_values = ! is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value(); 
			?>

			<ul>
				<?php foreach ( $this->choices as $value => $label ) : ?>
					<li>
						<label>
							<input type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( in_array( $value, $multi_values ) ); ?> />
							<?php echo esc_html( $label ); ?>
						</label>
					</li>
				<?php endforeach; ?>
			</ul>

			<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />

			<?php
		}
	}
}