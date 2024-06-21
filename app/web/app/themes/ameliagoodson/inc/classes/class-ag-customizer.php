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

		// Hero background image setting
		$wp_customize->add_setting('hero_transparent_header', array(
			'default' => '',
			'sanitize_callback' => 'esc_url_raw',
		));

		$wp_customize->add_control('hero_transparent_header', array(
			'label' => __('Transparent header', 'agtheme'),
			'type' => 'checkbox',
			'section' => 'hero_bg_image_section',
			'settings' => 'hero_transparent_header',
		));

		// Add a section for Hero image
		$wp_customize->add_section('hero_image_section', array(
			'title' => __('Hero Image', 'agtheme'),
			'panel' => 'hero_settings',
			'priority' => 30,
		));

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

		/* ------------------------------------------------------------------------------ /*
    /*  ARCHIVES
    /* ------------------------------------------------------------------------------ */

		$wp_customize->add_section('agtheme_archive_pages_options', array(
			'title'      => esc_html__('Archive Pages', 'agtheme'),
			'priority'   => 30,
			'capability' => 'edit_theme_options',
			'panel'      => 'agtheme_theme_options',
		));

		/* Home Text --------------- */

		$wp_customize->add_setting('agtheme_home_text', array(
			'capability'        => 'edit_theme_options',
			'default'           => '',
			'sanitize_callback' => 'sanitize_textarea_field',
		));

		$wp_customize->add_control('agtheme_home_text', array(
			'type'        => 'textarea',
			'section'     => 'agtheme_archive_pages_options',
			'label'       => esc_html__('Intro Text', 'agtheme'),
			'description' => esc_html__('Shown below the site title on the front page, when the front page is set to display latest posts.', 'agtheme'),
		));

		/* Show Archive Filters --------- */

		$wp_customize->add_setting('agtheme_show_archive_filters', array(
			'capability'        => 'edit_theme_options',
			'default'           => true,
			'sanitize_callback' => 'agtheme_sanitize_checkbox',
		));

		$wp_customize->add_control('agtheme_show_archive_filters', array(
			'type'        => 'checkbox',
			'section'     => 'agtheme_archive_pages_options',
			'label'       => esc_html__('Show Filter', 'agtheme'),
			'description' => esc_html__('Whether to display the category filter on the post archive.', 'agtheme'),
		));

		/* Show Category Post Count ------ */

		$wp_customize->add_setting('agtheme_show_filter_category_post_count', array(
			'capability'        => 'edit_theme_options',
			'default'           => false,
			'sanitize_callback' => 'agtheme_sanitize_checkbox',
		));

		$wp_customize->add_control('agtheme_show_filter_category_post_count', array(
			'type'        => 'checkbox',
			'section'     => 'agtheme_archive_pages_options',
			'label'       => esc_html__('Show Filter Category Post Count', 'agtheme'),
			'description' => esc_html__('Whether to display the number of posts in each category in the filter.', 'agtheme'),
		));

		/* Separator --------------------- */

		$wp_customize->add_setting('agtheme_archive_pages_options_sep_1', array(
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		));

		$wp_customize->add_control(new AG_Theme_Separator_Control($wp_customize, 'agtheme_archive_pages_options_sep_1', array(
			'section' => 'agtheme_archive_pages_options',
		)));

		/* Pagination Type --------------- */

		$wp_customize->add_setting('agtheme_pagination_type', array(
			'capability'        => 'edit_theme_options',
			'default'           => 'button',
			'sanitize_callback' => 'agtheme_sanitize_select',
		));

		$wp_customize->add_control('agtheme_pagination_type', array(
			'type'        => 'select',
			'section'     => 'agtheme_archive_pages_options',
			'label'       => esc_html__('Pagination Type', 'agtheme'),
			'description' => esc_html__('Determines how the pagination on archive pages should be displayed.', 'agtheme'),
			'choices'     => array(
				'button' => esc_html__('Load more button', 'agtheme'),
				'scroll' => esc_html__('Load more on scroll', 'agtheme'),
				'links'  => esc_html__('Links', 'agtheme'),
			),
		));

		/* Separator --------------------- */

		$wp_customize->add_setting('agtheme_archive_pages_options_sep_2', array(
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		));

		$wp_customize->add_control(new AG_Theme_Separator_Control($wp_customize, 'agtheme_archive_pages_options_sep_2', array(
			'section' => 'agtheme_archive_pages_options',
		)));

		/* Number of Post Columns -------- */

		// Store the different screen size options in an array for brevity.
		$post_column_option_sizes = AG_Customizer::get_archive_columns_options();

		// Loop over each screen size option and register it
		foreach ($post_column_option_sizes as $setting_name => $data) {
			$wp_customize->add_setting($setting_name, array(
				'capability'        => 'edit_theme_options',
				'default'           => $data['default'],
				'sanitize_callback' => 'agtheme_sanitize_select',
			));

			$wp_customize->add_control($setting_name, array(
				'type'        => 'select',
				'section'     => 'agtheme_archive_pages_options',
				'label'       => $data['label'],
				'description' => $data['description'],
				'choices'     => array(
					'1' => esc_html__('One', 'agtheme'),
					'2' => esc_html__(
						'Two',
						'agtheme'
					),
					'3' => esc_html__('Three', 'agtheme'),
					'4' => esc_html__('Four', 'agtheme'),
				),
			));
		}

		/* Separator --------------------- */

		$wp_customize->add_setting('agtheme_archive_pages_options_sep_3', array(
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		));

		$wp_customize->add_control(new AG_Theme_Separator_Control($wp_customize, 'agtheme_archive_pages_options_sep_3', array(
			'section' => 'agtheme_archive_pages_options',
		)));

		/* Post Meta --------------------- */

		// Get an array with the post types that support the post meta Customizer setting.
		$post_types_with_post_meta = self::get_post_types_with_post_meta();

		foreach ($post_types_with_post_meta as $post_type => $post_type_settings) {

			// Only output for registered post types.
			if (!post_type_exists($post_type)) {
				continue;
			}

			// Get the post type name for inclusion in the label and description.
			$post_type_obj  = get_post_type_object($post_type);
			$post_type_name = isset($post_type_obj->labels->name) ? $post_type_obj->labels->name : $post_type;

			// Parse the arguments of the post type.
			$post_type_settings = wp_parse_args($post_type_settings, array(
				'default' => array(
					'archive' => array(),
					'single'  => array(),
				),
			));

			$wp_customize->add_setting('agtheme_post_meta_' . $post_type, array(
				'capability'        => 'edit_theme_options',
				'default'           => $post_type_settings['default']['archive'],
				'sanitize_callback' => 'agtheme_sanitize_multiple_checkboxes',
			));

			$wp_customize->add_control(new AG_Theme_Customize_Control_Checkbox_Multiple($wp_customize, 'agtheme_post_meta_' . $post_type, array(
				'section'     => 'agtheme_archive_pages_options',
				'label'       => sprintf(esc_html_x('Post Meta for %s', 'Customizer setting name. %s = Post type plural name', 'agtheme'), $post_type_name),
				'description' => sprintf(esc_html_x('Select which post meta to display for %s on archive pages.', 'Customizer setting description. %s = Post type plural name', 'agtheme'), strtolower($post_type_name)),
				'choices'     => self::get_post_meta_options($post_type),
			)));
		}


		/* ------------------------------------------------------------------------------ /*
    /*  SINGLE POSTS
    /* ------------------------------------------------------------------------------ */

		$wp_customize->add_section('agtheme_single_options', array(
			'title'      => esc_html__('Single Posts', 'agtheme'),
			'priority'   => 30,
			'capability' => 'edit_theme_options',
			'panel'      => 'agtheme_theme_options',
		));

		/* Post Meta --------------------- */

		// Loop over the post types that support the post meta Customizer setting.
		foreach ($post_types_with_post_meta as $post_type => $post_type_settings) {

			// Only output for registered post types.
			if (!post_type_exists($post_type)) {
				continue;
			}

			// Get the post type name for inclusion in the label and description.
			$post_type_obj  = get_post_type_object($post_type);
			$post_type_name = isset($post_type_obj->labels->name) ? $post_type_obj->labels->name : $post_type;

			// Parse the arguments of the post type.
			$post_type_settings = wp_parse_args($post_type_settings, array(
				'default' => array(
					'archive' => array(),
					'single'  => array(),
				),
			));

			$wp_customize->add_setting('agtheme_post_meta_' . $post_type . '_single', array(
				'capability'        => 'edit_theme_options',
				'default'           => $post_type_settings['default']['single'],
				'sanitize_callback' => 'agtheme_sanitize_multiple_checkboxes',
			));

			$wp_customize->add_control(new AG_Theme_Customize_Control_Checkbox_Multiple($wp_customize, 'agtheme_post_meta_' . $post_type . '_single', array(
				'section'     => 'agtheme_single_options',
				'label'       => sprintf(esc_html_x('Post Meta for %s', 'Customizer setting name. %s = Post type plural name', 'agtheme'), $post_type_name),
				'description' => sprintf(esc_html_x('Select which post meta to display on single %s.', 'Customizer setting description. %s = Post type plural name', 'agtheme'), strtolower($post_type_name)),
				'choices'     => self::get_post_meta_options($post_type),
			)));
		}
	}

	/**
	 * Returns the post archive column options.
	 */
	public static function get_archive_columns_options()
	{

		return array(
			'agtheme_post_grid_columns_mobile' => array(
				'label'       => esc_html__('Columns on Mobile', 'agtheme'),
				'default'     => '1',
				'description' => esc_html__('Screen width: 0px - 700px', 'agtheme'),
			),
			'agtheme_post_grid_columns_tablet' => array(
				'label'       => esc_html__('Columns on Tablet', 'agtheme'),
				'default'     => '2',
				'description' => esc_html__('Screen width: 700px - 1000px', 'agtheme'),
			),
			'agtheme_post_grid_columns_laptop' => array(
				'label'       => esc_html__('Columns on Laptop', 'agtheme'),
				'default'     => '2',
				'description' => esc_html__('Screen width: 1000px - 1200px', 'agtheme'),
			),
			'agtheme_post_grid_columns_desktop' => array(
				'label'       => esc_html__('Columns on Desktop', 'agtheme'),
				'default'     => '3',
				'description' => esc_html__('Screen width: 1200px - 1600px', 'agtheme'),
			),
			'agtheme_post_grid_columns_desktop_xl' => array(
				'label'       => esc_html__('Columns on Desktop XL', 'agtheme'),
				'default'     => '4',
				'description' => esc_html__('Screen width: > 1600px', 'agtheme'),
			),
		);
	}

	/**
	 * Returns the available post meta options.
	 */
	public static function get_post_meta_options($post_type)
	{

		$post_meta_options = array(
			'post' => array(
				'author'     => esc_html__('Author', 'nctheme'),
				'categories' => esc_html__('Categories', 'nctheme'),
				'tags'       => esc_html__('Tags', 'nctheme'),
				'comments'   => esc_html__('Comments', 'nctheme'),
				'date'       => esc_html__('Date', 'nctheme'),
				'edit-link'  => esc_html__('Edit link (for logged in users)', 'nctheme'),
			),
		);

		return isset($post_meta_options[$post_type]) ? $post_meta_options[$post_type] : array();
	}


	/**
	 * Returns an array of post types with post meta options and their default values.
	 */
	public static function get_post_types_with_post_meta()
	{

		return array(
			'post' => array(
				'default' => array(
					'archive' => array('categories', 'date'),
					'single'  => array('categories', 'date', 'tags', 'edit-link'),
				),
			),
		);
	}
}

// Create new instance of the AG_Customizer class. 
$ag_customizer = new AG_Customizer();

// Tells WordPress to call the agtheme_register method of the $ag_customizer instance when it's time to register customizer settings.
add_action('customize_register', array($ag_customizer, 'agtheme_register'));

/* ------------------------------------------------------------------------------ /*
/*  CUSTOM CUSTOMIZER CONTROLS
/* ------------------------------------------------------------------------------ */

if (class_exists('WP_Customize_Control')) {
	/**
	 * Separator Control
	 */
	class AG_Theme_Separator_Control extends WP_Customize_Control
	{
		public $type = 'agtheme_separator_control';
		public function render_content()
		{
			echo '<hr/>';
		}
	}

	/**
	 * Multiple Checkboxes control.
	 * Based on a solution by Justin Tadlock: http://justintadlock.com/archives/2015/05/26/multiple-checkbox-customizer-control
	 */
	class AG_Theme_Customize_Control_Checkbox_Multiple extends WP_Customize_Control
	{

		public $type = 'checkbox-multiple';

		public function render_content()
		{

			if (empty($this->choices)) {
				return;
			}

			if (!empty($this->label)) {
				echo '<span class="customize-control-title">' . esc_html($this->label) . '</span>';
			}

			if (!empty($this->description)) {
				echo '<span class="description customize-control-description">' . esc_html($this->description) . '</span>';
			}

			$multi_values = !is_array($this->value()) ? explode(',', $this->value()) : $this->value();
?>

			<ul>
				<?php foreach ($this->choices as $value => $label) : ?>
					<li>
						<label>
							<input type="checkbox" value="<?php echo esc_attr($value); ?>" <?php checked(in_array($value, $multi_values)); ?> />
							<?php echo esc_html($label); ?>
						</label>
					</li>
				<?php endforeach; ?>
			</ul>

			<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr(implode(',', $multi_values)); ?>" />

<?php
		}
	}
}
