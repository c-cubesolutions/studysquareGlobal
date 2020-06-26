<?php

defined( 'ABSPATH' ) || exit;

$theme_color = esc_attr(iGuru_Theme_Helper::get_option('theme-custom-color'));
$theme_color_secondary = esc_attr(iGuru_Theme_Helper::get_option('theme-secondary-color'));
$header_font_color = esc_attr(iGuru_Theme_Helper::get_option('header-font')['color']);

if (function_exists('vc_map')) {
	vc_map( [
		'base' => 'wgl_team',
		'name' => esc_html__( 'Team List', 'iguru' ),
		'description' => esc_html__( 'Show Team Grid', 'iguru' ),
		'icon' => 'wgl_icon_team',
		'category' => esc_html__( 'WGL Modules', 'iguru' ),
		'params' => array(
			// GENERAL TAB
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Columns in Row', 'iguru' ),
				'param_name' => 'posts_per_line',
				'admin_label' => true,
				'value' => [
					esc_html__( '1 Column', 'iguru' ) => '1',
					esc_html__( '2 Columns', 'iguru' ) => '2',
					esc_html__( '3 Columns', 'iguru' ) => '3',
					esc_html__( '4 Columns', 'iguru' ) => '4',
					esc_html__( '5 Columns', 'iguru' ) => '5',
				],
				'std' => '3',
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Team Info Alignment', 'iguru' ),
				'param_name' => 'info_align',
				'value' => [
					esc_html__( 'Left', 'iguru' ) => 'left',
					esc_html__( 'Center', 'iguru' ) => 'center',
					esc_html__( 'Right', 'iguru' ) => 'right',
				],
				'edit_field_class' => 'vc_col-sm-3 no-top-padding',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Gap Between Items', 'iguru' ),
				'param_name' => 'grid_gap',
				'value' => [
					esc_html__( '0px', 'iguru' ) => '0',
					esc_html__( '2px', 'iguru' ) => '2',
					esc_html__( '4px', 'iguru' ) => '4',
					esc_html__( '6px', 'iguru' ) => '6',
					esc_html__( '10px', 'iguru' ) => '10',
					esc_html__( '20px', 'iguru' ) => '20',
					esc_html__( '30px', 'iguru' ) => '30',
				],
				'std' => '30',
				'edit_field_class' => 'vc_col-sm-3 no-top-padding',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_1',
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Link for Image', 'iguru' ),
				'param_name' => 'single_link_wrapper',
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Link for Heading', 'iguru' ),
				'param_name' => 'single_link_heading',
				'value' => 'true',
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_2',
				'edit_field_class' => 'divider',
			),
			// Hide title checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Hide Title', 'iguru' ),
				'param_name' => 'hide_title',
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Hide department checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Hide Department', 'iguru' ),
				'param_name' => 'hide_department',
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Hide socials checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Hide Social Icons', 'iguru' ),
				'param_name' => 'hide_soc_icons',
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_3',
				'edit_field_class' => 'divider',
			),
			// Hide content checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Hide Content', 'iguru' ),
				'param_name' => 'hide_content',
				'value' => 'true',
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Characters Amount in Content', 'iguru' ),
				'param_name' => 'letter_count',
				'value' => '100',
				'description' => esc_html__( 'Limit the excerpt/content to be displayed.', 'iguru' ),
				'dependency' => [
					'element' => 'hide_content',
					'value_not_equal_to' => 'true'
				],
				'edit_field_class' => 'vc_col-sm-6',
			),
			vc_map_add_css_animation( true ),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Extra Class', 'iguru' ),
				'param_name' => 'item_el_class',
				'description' => esc_html__( 'To customly style particular element, use this field to add a class name and then refer to it fron Custom CSS settings.', 'iguru' ),
			),
			// CAROUSEL TAB
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Use Carousel', 'iguru' ),
				'param_name' => 'use_carousel',
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3 no-top-margin',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Autoplay', 'iguru' ),
				'param_name' => 'autoplay',
				'dependency' => [
					'element' => 'use_carousel',
					'value' => 'true'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-2 no-top-padding',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Autoplay Speed', 'iguru' ),
				'param_name' => 'autoplay_speed',
				'value' => '3000',
				'description' => esc_html__( 'Value in milliseconds.', 'iguru' ),
				'dependency' => [
					'element'   => 'autoplay',
					'value' => 'true'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3 no-top-padding',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_ca_1',
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Infinite Loop Sliding', 'iguru' ),
				'param_name' => 'carousel_infinite',
				'dependency' => [
					'element' => 'use_carousel',
					'value' => 'true'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Slide per single item at a time', 'iguru' ),
				'param_name' => 'scroll_items',
				'dependency' => [
					'element' => 'use_carousel',
					'value' => 'true'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-5',
			),
			// Сarousel pagination style
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Pagination Style', 'iguru' ),
				'param_name' => 'h_pag_controls',
				'dependency' => [
					'element' => 'use_carousel',
					'value' => 'true'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Pagination control', 'iguru' ),
				'param_name' => 'use_pagination',
				'dependency' => [
					'element' => 'use_carousel',
					'value' => 'true'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
			),
			array(
				'type' => 'iguru_radio_image',
				'heading' => esc_html__( 'Pagination Type', 'iguru' ),
				'param_name' => 'pag_type',
				'fields' => array(
					'circle' => array(
						'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_circle.png',
						'label' => esc_html__( 'Circle', 'iguru' )),
					'circle_border' => array(
						'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_circle_border.png',
						'label' => esc_html__( 'Empty Circle', 'iguru' )),
					'square' => array(
						'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_square.png',
						'label' => esc_html__( 'Square', 'iguru' )),
					'line' => array(
						'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_line.png',
						'label' => esc_html__( 'Line', 'iguru' )),
					'line_circle' => array(
						'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_line_circle.png',
						'label' => esc_html__( 'Line - Circle', 'iguru' )),
				),
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
				'heading' => esc_html__( 'Customize Colors', 'iguru' ),
				'param_name' => 'custom_pag_color',
				'dependency' => [
					'element' => 'use_pagination',
					'value' => 'true',
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
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
			// Carousel arrows style
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Arrows Style', 'iguru' ),
				'param_name' => 'h_arrow_control',
				'dependency' => [
					'element' => 'use_carousel',
					'value' => 'true'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Arrows control', 'iguru' ),
				'param_name' => 'use_prev_next',
				'dependency' => [
					'element' => 'use_carousel',
					'value' => 'true'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Colors', 'iguru' ),
				'param_name' => 'custom_buttons_color',
				'dependency' => [
					'element' => 'use_prev_next',
					'value' => 'true',
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Arrows Color', 'iguru' ),
				'param_name' => 'buttons_color',
				'value' => $theme_color,
				'dependency' => [
					'element' => 'custom_buttons_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Responsive settings
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Responsive Settings', 'iguru' ),
				'param_name' => 'h_resp',
				'dependency' => [
					'element' => 'use_carousel',
					'value' => 'true'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Responsive', 'iguru' ),
				'param_name' => 'custom_resp',
				'dependency' => [
					'element' => 'use_carousel',
					'value' => 'true'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			// Desktop breakpoint
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
				'param_name' => 'divider_ca_2',
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			// Tablet breakpoint
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
				'param_name' => 'divider_ca_3',
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			// Mobile breakpoint
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
			// COLORS TAB
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Meta Container', 'iguru' ),
				'param_name' => 'h_bg_styles',
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			// Meta container bg dropdown
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Customize Background', 'iguru' ),
				'param_name' => 'meta_bg_type',
				'value' => array(
					esc_html__( 'Theme Defaults', 'iguru' ) => 'def',
					esc_html__( 'Color', 'iguru' ) => 'color',
					esc_html__( 'Image', 'iguru' ) => 'image',
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Meta container bg idle color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Idle', 'iguru' ),
				'param_name' => 'meta_bg_color_idle',
				'value' => '#ffffff',
				'dependency' => [
					'element' => 'meta_bg_type',
					'value' => 'color'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Meta container bg hover color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Hover', 'iguru' ),
				'param_name' => 'meta_bg_color_hover',
				'value' => '#ffffff',
				'dependency' => [
					'element' => 'meta_bg_type',
					'value' => 'color'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Background Image', 'iguru' ),
				'param_name' => 'meta_bg_img',
				'description' => esc_html__( 'Choose from Media Library', 'iguru' ),
				'dependency' => [
					'element' => 'meta_bg_type',
					'value' => 'image'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Title heading
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Title', 'iguru' ),
				'param_name' => 'h_title_styles',
				'dependency' => [
					'element' => 'hide_title',
					'value_not_equal_to' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
			),
			// Title color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Colors', 'iguru' ),
				'param_name' => 'custom_title_color',
				'dependency' => [
					'element' => 'hide_title',
					'value_not_equal_to' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Title idle color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Title Idle', 'iguru' ),
				'param_name' => 'title_color',
				'value' => $header_font_color,
				'dependency' => [
					'element' => 'custom_title_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Title hover color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Title Hover', 'iguru' ),
				'param_name' => 'title_hover_color',
				'value' => $theme_color,
				'dependency' => [
					'element' => 'custom_title_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Department', 'iguru' ),
				'param_name' => 'h_depart_styles',
				'dependency' => [
					'element' => 'hide_department',
					'value_not_equal_to' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
			),
			// Department color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Color', 'iguru' ),
				'param_name' => 'custom_depart_color',
				'dependency' => [
					'element' => 'hide_department',
					'value_not_equal_to' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Department color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Department Color', 'iguru' ),
				'param_name' => 'depart_color',
				'value' => $theme_color_secondary,
				'dependency' => [
					'element' => 'custom_depart_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Social Icons', 'iguru' ),
				'param_name' => 'h_soc_styles',
				'dependency' => [
					'element' => 'hide_soc_icons',
					'value_not_equal_to' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
			),
			// Socials color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Colors', 'iguru' ),
				'param_name' => 'custom_soc_color',
				'dependency' => [
					'element' => 'hide_soc_icons',
					'value_not_equal_to' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Socials color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Icon Idle', 'iguru' ),
				'param_name' => 'soc_color',
				'value' => '#ffffff',
				'dependency' => [
					'element' => 'custom_soc_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Icon Hover', 'iguru' ),
				'param_name' => 'soc_hover_color',
				'value' => $theme_color,
				'dependency' => [
					'element' => 'custom_soc_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_co_1',
				'dependency' => [
					'element' => 'hide_soc_icons',
					'value_not_equal_to' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			// Socials bg color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Backgrounds', 'iguru' ),
				'param_name' => 'custom_soc_bg_color',
				'dependency' => [
					'element' => 'hide_soc_icons',
					'value_not_equal_to' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Background idle color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Idle', 'iguru' ),
				'param_name' => 'soc_bg_color',
				'value' => '#f3f3f3',
				'dependency' => [
					'element' => 'custom_soc_bg_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Background hover color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Hover', 'iguru' ),
				'param_name' => 'soc_bg_hover_color',
				'value' => '#f3f3f3',
				'dependency' => [
					'element' => 'custom_soc_bg_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Featured image overlay
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Featured Image Overlay', 'iguru' ),
				'param_name' => 'h_ovelay_styles',
				'group' => esc_html__( 'Colors', 'iguru' ),
			),
			// Overlay color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Colors', 'iguru' ),
				'param_name' => 'custom_ovelay',
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Socials color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Overlay', 'iguru' ),
				'param_name' => 'overlay_color',
				'value' => $header_font_color,
				'description' => esc_html__( 'Appears on module hover.', 'iguru' ),
				'dependency' => [
					'element' => 'custom_ovelay',
					'value' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
		)
	]);

	iGuru_Loop_Settings::init(
		'wgl_team',
		[
			'hide_cats' => true,
			'hide_tags' => true
		]
	);
	class WPBakeryShortCode_wgl_Team extends WPBakeryShortCode{}
}