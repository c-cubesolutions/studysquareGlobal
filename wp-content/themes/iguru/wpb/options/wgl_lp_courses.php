<?php

defined( 'ABSPATH' ) || exit;

$theme_color = esc_attr(iGuru_Theme_Helper::get_option('theme-custom-color'));
$theme_color_secondary = esc_attr(iGuru_Theme_Helper::get_option('theme-secondary-color'));
$h_font_color = esc_attr(iGuru_Theme_Helper::get_option('header-font')['color']);
$main_font_color = esc_attr(iGuru_Theme_Helper::get_option('main-font')['color']);

if ( function_exists( 'vc_map' ) ) {
	vc_map( [
		'base' => 'wgl_lp_courses',
		'name' => esc_html__( 'LP Courses', 'iguru' ),
		'description' => esc_html__( 'Display LP Courses', 'iguru' ),
		'category' => esc_html__( 'LearnPress', 'iguru' ),
		'icon' => 'wgl_icon_learnpress',
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title', 'iguru' ),
				'param_name' => 'module_title',
				'admin_label' => true,
			),
			array(
				'type' => 'textarea', 
				'heading' => esc_html__( 'Subtitle', 'iguru' ),
				'param_name' => 'module_subtitle',
				'admin_label' => true,
			),
			array(
				'type' => 'iguru_radio_image',
				'heading' => esc_html__( 'Layout', 'iguru' ),
				'param_name' => 'courses_layout',
				'fields' => [
					'grid' => [
						'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/layout_grid.png',
						'label' => esc_html__( 'Grid', 'iguru' )
					],
					'masonry' => [
						'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/layout_masonry.png',
						'label' => esc_html__( 'Masonry', 'iguru' )
					],
					'carousel' => [
						'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/layout_carousel.png',
						'label' => esc_html__( 'Carousel', 'iguru' )
					],
				],
				'value' => 'grid',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Navigation Type', 'iguru' ),
				'param_name' => 'courses_navigation',
				'value' => [
					esc_html__( 'None', 'iguru' ) => 'none',
					esc_html__( 'Pagination', 'iguru' ) => 'pagination',
				],
				'std' => 'none',
				'dependency' => [
					'element' => 'courses_layout',
					'value_not_equal_to' => 'carousel',
				],
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Navigation\'s Alignment', 'iguru' ),
				'param_name' => 'courses_navigation_align',
				'value' => [
					esc_html__( 'Left', 'iguru' ) => 'left',
					esc_html__( 'Center', 'iguru' ) => 'center',
					esc_html__( 'Right', 'iguru' ) => 'right'
				],
				'std' => 'center',
				'dependency' => [
					'element' => 'courses_navigation',
					'value' => 'pagination'
				],
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_1',
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Use Filter?', 'iguru' ),
				'param_name' => 'isotop_filter_use',
				'dependency' => [
					'element' => 'courses_layout',
					'value_not_equal_to' => 'carousel',
				],
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Filter Alignment', 'iguru' ),
				'param_name' => 'isotop_filter_align',
				'value' => [
					esc_html__( 'Left', 'iguru' ) => 'left',
					esc_html__( 'Center', 'iguru' ) => 'center',
					esc_html__( 'Right', 'iguru' ) => 'right',
				],
				'std' => 'center',
				'dependency' => [
					'element' => 'isotop_filter_use',
					'value' => 'true'
				],
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_2',
				'edit_field_class' => 'divider',
			),
			// Hover effect
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Enable Hover Animation', 'iguru' ),
				'param_name' => 'hover_animation',
				'description' => esc_html__( 'Lift up the item on Hover State.', 'iguru'),
				'edit_field_class' => 'vc_col-sm-3',
			),
			vc_map_add_css_animation( true ),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Extra Class', 'iguru' ),
				'param_name' => 'extra_class',
				'description' => esc_html__('Add an extra class name to the element and refer to it from Custom CSS option.', 'iguru' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Grid Columns Amount', 'iguru' ),
				'param_name' => 'grid_columns',
				'value' => [
					esc_html__( 'One', 'iguru' ) => '1',
					esc_html__( 'Two', 'iguru' ) => '2',
					esc_html__( 'Three', 'iguru' ) => '3',
					esc_html__( 'Four', 'iguru' ) => '4',
					esc_html__( 'Five', 'iguru' ) => '5',
				],
				'std' => '3',
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4 no-top-margin',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_co_1',
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Course Content Alignment', 'iguru' ),
				'param_name' => 'course_content_align',
				'value' => [
					esc_html__( 'Left', 'iguru' ) => '',
					esc_html__( 'Center', 'iguru' ) => 'center',
					esc_html__( 'Right', 'iguru' ) => 'right',
					esc_html__( 'Justify', 'iguru' ) => 'justify',
				],
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4 no-top-margin',
			),
			// Post Meta settings
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Content Elements Switches', 'iguru' ),
				'param_name' => 'h_content_elements',
				'group' => esc_html__( 'Content', 'iguru' ),
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Hide Thumbnail?', 'iguru' ),
				'param_name' => 'hide_media',
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Hide Heading?', 'iguru' ),
				'param_name' => 'hide_course_title',
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Hide Excerpt/Content?', 'iguru' ),
				'param_name' => 'hide_excerpt',
				'std' => 'true',
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Hide all meta data?', 'iguru' ),
				'param_name' => 'hide_all_meta',
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Hide instructor?', 'iguru' ),
				'param_name' => 'hide_instructor',
				'dependency' => [
					'element' => 'hide_all_meta',
					'value_not_equal_to' => 'true',
				],
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Hide students?', 'iguru' ),
				'param_name' => 'hide_students',
				'dependency' => [
					'element' => 'hide_all_meta',
					'value_not_equal_to' => 'true',
				],
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Hide reviews?', 'iguru' ),
				'param_name' => 'hide_reviews',
				'dependency' => [
					'element' => 'hide_all_meta',
					'value_not_equal_to' => 'true',
				],
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Hide category?', 'iguru' ),
				'param_name' => 'hide_categories',
				'dependency' => [
					'element' => 'hide_all_meta',
					'value_not_equal_to' => 'true',
				],
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Content Settings
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Content Settings', 'iguru' ),
				'param_name' => 'h_content_trime',
				'dependency' => [
					'element' => 'hide_excerpt',
					'value_not_equal_to' => 'true',
				],
				'group' => esc_html__( 'Content', 'iguru' ),
			),
			// Placeholder Height
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Image Placeholder Height', 'iguru' ),
				'param_name' => 'img_placeholder_height',
				'dependency' => [
					'element' => 'hide_media',
					'value' => 'true',
				],
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_co_2',
				'dependency' => [
					'element' => 'hide_media',
					'value' => 'true',
				],
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			// Content limitation
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Excerpt Characters Amount', 'iguru' ),
				'param_name' => 'excerpt_chars',
				'value' => '90',
				'description' => esc_html__( 'Chars limit to be displayed.', 'iguru' ),
				'dependency' => [
					'element' => 'hide_excerpt',
					'value_not_equal_to' => 'true',
				],
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// CAROUSEL TAB
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Autoplay', 'iguru' ),
				'param_name' => 'autoplay',
				'dependency' => [
					'element' => 'courses_layout',
					'value' => 'carousel'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-2',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Autoplay Speed', 'iguru' ),
				'param_name' => 'autoplay_speed',
				'value' => '3000',
				'description' => esc_html__( 'Value in milliseconds.', 'iguru' ),
				'dependency' => [
					'element' => 'autoplay',
					'value' => 'true'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3 no-top-padding',
			),
			// carousel pagination heading
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Pagination Controls', 'iguru' ),
				'param_name' => 'h_pag_controls',
				'dependency' => [
					'element' => 'courses_layout',
					'value' => 'carousel'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Pagination control', 'iguru' ),
				'param_name' => 'use_pagination',
				'dependency' => array(
					'element' => 'courses_layout',
					'value' => 'carousel'
				),
				'std' => 'true',
				'group' => esc_html__( 'Carousel', 'iguru' ),
			),
			array(
				'type' => 'iguru_radio_image',
				'heading' => esc_html__( 'Pagination Type', 'iguru' ),
				'param_name' => 'pag_type',
				'fields' => [
					'circle' => [
						'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_circle.png',
						'label' => esc_html__( 'Circle', 'iguru' )
					],
					'circle_border' => [
						'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_circle_border.png',
						'label' => esc_html__( 'Empty Circle', 'iguru' )
					],
					'square' => [
						'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_square.png',
						'label' => esc_html__( 'Square', 'iguru' )
					],
					'line' => [
						'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_line.png',
						'label' => esc_html__( 'Line', 'iguru' )
					],
					'line_circle' => [
						'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_line_circle.png',
						'label' => esc_html__( 'Line - Circle', 'iguru' )
					],
				],
				'value' => 'circle',
				'dependency' => [
					'element' => 'use_pagination',
					'value' => 'true',
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Pagination Top Offset', 'iguru' ),
				'param_name' => 'pag_offset',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'use_pagination',
					'value' => 'true',
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Custom Pagination Color', 'iguru' ),
				'param_name' => 'custom_pag_color',
				'dependency' => [
					'element' => 'use_pagination',
					'value' => 'true',
				],
				'edit_field_class' => 'vc_col-sm-3',
				'group' => esc_html__( 'Carousel', 'iguru' ),
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Pagination Color', 'iguru' ),
				'param_name' => 'pag_color',
				'value' => $theme_color,
				'dependency' => [
					'element' => 'custom_pag_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),          
			// Carousel navigation controls
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Navigation Controls', 'iguru' ),
				'param_name' => 'h_nav_controls',
				'dependency' => [
					'element' => 'courses_layout',
					'value' => 'carousel'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Navigation control', 'iguru' ),
				'param_name' => 'use_navigation',
				'dependency' => [
					'element' => 'courses_layout',
					'value' => 'carousel'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
			),
			// Carousel responsive settings
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Responsive Settings', 'iguru' ),
				'param_name' => 'h_resp',
				'dependency' => [
					'element' => 'courses_layout',
					'value' => 'carousel'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Responsive', 'iguru' ),
				'param_name' => 'custom_resp',
				'dependency' => [
					'element' => 'courses_layout',
					'value' => 'carousel'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
			),
			// Desktop screen breakpoint
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Desktop Screen Breakpoint', 'iguru' ),
				'param_name' => 'resp_medium',
				'value' => '1025',
				'dependency' => [
					'element' => 'custom_resp',
					'value' => 'true',
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Slides to show', 'iguru' ),
				'param_name' => 'resp_medium_slides',
				'value' => '',
				'dependency' => [
					'element' => 'custom_resp',
					'value' => 'true',
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_c_1',
				'dependency' => [
					'element' => 'custom_resp',
					'value' => 'true',
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			// Tablet screen breakpoint
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Tablet Screen Breakpoint', 'iguru' ),
				'param_name' => 'resp_tablets',
				'value' => '800',
				'dependency' => [
					'element' => 'custom_resp',
					'value' => 'true',
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Slides to show', 'iguru' ),
				'param_name' => 'resp_tablets_slides',
				'value' => '',
				'dependency' => [
					'element' => 'custom_resp',
					'value' => 'true',
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_c_2',
				'dependency' => [
					'element' => 'custom_resp',
					'value' => 'true',
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			// Mobile screen breakpoint
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Mobile Screen Breakpoint', 'iguru' ),
				'param_name' => 'resp_mobile',
				'value' => '480',
				'dependency' => [
					'element' => 'custom_resp',
					'value' => 'true',
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Slides to show', 'iguru' ),
				'param_name' => 'resp_mobile_slides',
				'value' => '',
				'dependency' => [
					'element' => 'custom_resp',
					'value' => 'true',
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// STYLES TAB
			// Module title styles
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Module Title / Subtitle Styles', 'iguru' ),
				'param_name' => 'module_title_styles',
				'dependency' => [
					'element' => 'module_title',
					'not_empty' => true
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Title/Subtitle Alignment', 'iguru' ),
				'param_name' => 'module_title_align',
				'value' => [
					esc_html__( 'Left', 'iguru' ) => '',
					esc_html__( 'Center', 'iguru' ) => 'center',
					esc_html__( 'Right', 'iguru' ) => 'right',
					esc_html__( 'Justify', 'iguru' ) => 'justify',
				],
				'dependency' => [
					'element' => 'module_title',
					'not_empty' => true
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4 no-top-margin',
			),
			// Headings styles
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Headings Styles', 'iguru' ),
				'param_name' => 'courses_heading_styles',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			// Heading tag dropdown
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Heading tag', 'iguru' ),
				'param_name' => 'heading_tag',
				'value' => [
					esc_html__( '‹h1›', 'iguru' ) => 'h1',
					esc_html__( '‹h2›', 'iguru' ) => 'h2',
					esc_html__( '‹h3›', 'iguru' ) => 'h3',
					esc_html__( '‹h4›', 'iguru' ) => 'h4',
					esc_html__( '‹h5›', 'iguru' ) => 'h5',
					esc_html__( '‹h6›', 'iguru' ) => 'h6',
				],
				'std' => 'h3',
				'description' => esc_html__( 'Select your html tag.', 'iguru' ),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Heading margin bottom', 'iguru' ),
				'param_name' => 'heading_margin_bottom',
				'value' => '',
				'save_always' => true,
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_1',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize font', 'iguru' ),
				'param_name' => 'custom_h_font',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Headings font size
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Font Size', 'iguru' ),
				'param_name' => 'h_font_size',
				'value' => '30',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'custom_h_font',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Headings line height
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Line Height', 'iguru' ),
				'param_name' => 'h_line_height',
				'value' => '46',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'custom_h_font',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Headings font weight
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Font Weight', 'iguru' ),
				'param_name' => 'h_font_weight',
				'value' => [
					esc_html__( 'Theme defaults', 'iguru' ) => '',
					esc_html__( '300 / Light', 'iguru' ) => '300',
					esc_html__( '400 / Regular', 'iguru' ) => '400',
					esc_html__( '500 / Medium', 'iguru' ) => '500',
					esc_html__( '600 / SemiBold', 'iguru' ) => '600',
					esc_html__( '700 / Bold', 'iguru' ) => '700',
					esc_html__( '800 / Extra-Bold', 'iguru' ) => '800',
				],
				'dependency' => array(
					'element' => 'custom_h_font',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_2',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize colors', 'iguru' ),
				'param_name' => 'custom_h_color',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Heading Idle', 'iguru' ),
				'param_name' => 'h_color_idle',
				'value' => '#ffffff',
				'dependency' => [
					'element' => 'custom_h_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Heading Hover 1', 'iguru' ),
				'param_name' => 'h_color_hover_1',
				'value' => $h_font_color,
				'description' => esc_html__( 'At Course Hover.', 'iguru' ),
				'dependency' => [
					'element' => 'custom_h_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Heading Hover 2', 'iguru' ),
				'param_name' => 'h_color_hover_2',
				'value' => $theme_color,
				'description' => esc_html__( 'At Header Hover.', 'iguru' ),
				'dependency' => [
					'element' => 'custom_h_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Excerpt/Content Styles', 'iguru' ),
				'param_name' => 'courses_excerpt_styles',
				'dependency' => [
					'element' => 'hide_excerpt',
					'value_not_equal_to' => 'true',
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize font', 'iguru' ),
				'param_name' => 'custom_excerpt_font',
				'dependency' => [
					'element' => 'hide_excerpt',
					'value_not_equal_to' => 'true',
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Excerpt font size
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Font Size', 'iguru' ),
				'param_name' => 'excerpt_font_size',
				'value' => '16',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'custom_excerpt_font',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Line Height', 'iguru' ),
				'param_name' => 'excerpt_line_height',
				'value' => '30',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'custom_excerpt_font',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_3',
				'dependency' => [
					'element' => 'hide_excerpt',
					'value_not_equal_to' => 'true',
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize color', 'iguru' ),
				'param_name' => 'custom_excerpt_color',
				'dependency' => [
					'element' => 'hide_excerpt',
					'value_not_equal_to' => 'true',
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Excerpt Color', 'iguru' ),
				'param_name' => 'excerpt_color',
				'value' => $main_font_color,
				'dependency' => [
					'element' => 'custom_excerpt_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Meta styles
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Meta Styles', 'iguru' ),
				'param_name' => 'courses_meta_styles_heading',
				'group' => esc_html__( 'Styles', 'iguru' ),
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize font', 'iguru' ),
				'param_name' => 'custom_meta_font',
				'dependency' => [
					'element' => 'hide_all_meta',
					'value_not_equal_to' => 'true',
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Meta font size
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Meta Font Size', 'iguru' ),
				'param_name' => 'meta_font_size',
				'value' => '14',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'custom_meta_font',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_4',
				'dependency' => [
					'element' => 'hide_all_meta',
					'value_not_equal_to' => 'true',
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			// Meta colors
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize color', 'iguru' ),
				'param_name' => 'custom_meta_color',
				'dependency' => [
					'element' => 'hide_all_meta',
					'value_not_equal_to' => 'true',
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Meta Counters Idle', 'iguru' ),
				'param_name' => 'meta_text_color_idle',
				'value' => '#ffffff',
				'dependency' => [
					'element' => 'custom_meta_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Meta Counters Hover', 'iguru' ),
				'param_name' => 'meta_text_color_hover',
				'value' => '#969696',
				'dependency' => [
					'element' => 'custom_meta_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_5',
				'dependency' => [
					'element' => 'hide_all_meta',
					'value_not_equal_to' => 'true',
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Meta Icons Idle', 'iguru' ),
				'param_name' => 'meta_icon_color_idle',
				'value' => '#ffffff',
				'dependency' => [
					'element' => 'custom_meta_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Meta Icons Hover', 'iguru' ),
				'param_name' => 'meta_icon_color_hover',
				'value' => $theme_color_secondary,
				'dependency' => [
					'element' => 'custom_meta_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Customize CTA button
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize CTA button', 'iguru' ),
				'param_name' => 'custom_button_colors',
				'group' => esc_html__( 'Styles', 'iguru' ),
			),
			// CTA button color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Button Idle', 'iguru' ),
				'param_name' => 'button_color_idle',
				'value' => '#ffffff',
				'dependency' => [
					'element' => 'custom_button_colors',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Button Hover', 'iguru' ),
				'param_name' => 'button_color_hover',
				'value' => $theme_color,
				'dependency' => [
					'element' => 'custom_button_colors',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Sale Price Idle', 'iguru' ),
				'param_name' => 'origin_price_button_color_idle',
				'value' => '#aaaaaa',
				'dependency' => [
					'element' => 'custom_button_colors',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_6',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			// CTA button bg color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Button Background Idle', 'iguru' ),
				'param_name' => 'button_bg_idle',
				'value' => $theme_color,
				'dependency' => array(
					'element' => 'custom_button_colors',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Button Background Hover', 'iguru' ),
				'param_name' => 'button_bg_hover',
				'value' => '#ffffff',
				'dependency' => array(
					'element' => 'custom_button_colors',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Categories Styles
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Categories Styles', 'iguru' ),
				'param_name' => 'course_cat_styles',
				'dependency' => [
					'element' => 'hide_categories',
					'value_not_equal_to' => 'true',
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize font', 'iguru' ),
				'param_name' => 'custom_cat_font',
				'dependency' => [
					'element' => 'hide_categories',
					'value_not_equal_to' => 'true',
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Categories font size
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Font Size', 'iguru' ),
				'param_name' => 'cat_font_size',
				'value' => '18',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'custom_cat_font',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Categories line height
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Line Height', 'iguru' ),
				'param_name' => 'cat_line_height',
				'value' => '35',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'custom_cat_font',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_7',
				'dependency' => [
					'element' => 'hide_categories',
					'value_not_equal_to' => 'true',
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize colors', 'iguru' ),
				'param_name' => 'custom_cat_colors',
				'dependency' => [
					'element' => 'hide_categories',
					'value_not_equal_to' => 'true',
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
			),
			// Categories color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Categories Idle', 'iguru' ),
				'param_name' => 'cat_color_idle',
				'value' => '#ffffff',
				'dependency' => [
					'element' => 'custom_cat_colors',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Categories Hover', 'iguru' ),
				'param_name' => 'cat_color_hover',
				'value' => '#ffffff',
				'dependency' => [
					'element' => 'custom_cat_colors',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_8',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			// Categories bg color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Idle', 'iguru' ),
				'param_name' => 'cat_bg_idle',
				'value' => $theme_color_secondary,
				'dependency' => [
					'element' => 'custom_cat_colors',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Hover', 'iguru' ),
				'param_name' => 'cat_bg_hover',
				'value' => $theme_color,
				'dependency' => [
					'element' => 'custom_cat_colors',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Thumbnail Styles
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Thumbnail Styles', 'iguru' ),
				'param_name' => 'course_thumb_styles',
				'group' => esc_html__( 'Styles', 'iguru' ),
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Overlay', 'iguru' ),
				'param_name' => 'custom_thumb_overlay',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Overlay Idle', 'iguru' ),
				'param_name' => 'thumb_overlay_idle',
				'value' => 'rgba(17, 17, 17, 0.4)',
				'dependency' => [
					'element' => 'custom_thumb_overlay',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Overlay Hover', 'iguru' ),
				'param_name' => 'thumb_overlay_hover',
				'dependency' => [
					'element' => 'custom_thumb_overlay',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
		),
	]);
	
	iGuru_Loop_Settings::init( 
		'wgl_lp_courses',
		[
			'hide_cats' => true,
			'hide_tags' => true
		]
	);
	
	class WPBakeryShortCode_wgl_lp_courses extends WPBakeryShortCode {
	}
}