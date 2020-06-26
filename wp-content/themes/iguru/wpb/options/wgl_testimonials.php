<?php

defined( 'ABSPATH' ) || exit;

$theme_color = esc_attr(iGuru_Theme_Helper::get_option('theme-custom-color'));
$theme_color_secondary = esc_attr(iGuru_Theme_Helper::get_option('theme-secondary-color'));
$header_font_color = esc_attr(iGuru_Theme_Helper::get_option('header-font')['color']);
$main_font_color = esc_attr(iGuru_Theme_Helper::get_option('main-font')['color']);

if ( function_exists( 'vc_map' ) ) {
	vc_map( array(
		'name' => esc_html__( 'Testimonials', 'iguru' ),
		'base' => 'wgl_testimonials',
		'class' => 'iguru_testimonials',
		'category' => esc_html__( 'WGL Modules', 'iguru' ),
		'icon' => 'wgl_icon_testimonial',
		'content_element' => true,
		'description' => esc_html__( 'Represent clients feedback.','iguru' ),
		'params' => array(
			// GENERAL TAB
			array(
				'type' => 'iguru_radio_image',
				'heading' => esc_html__( 'Overall Layout', 'iguru' ),
				'param_name' => 'item_type',
				'fields' => [
					'author_top' => [
						'image_url' => get_template_directory_uri().'/img/wgl_composer_addon/icons/testimonials_1.png',
						'label' => esc_html__( 'Top', 'iguru' )
					],
					'author_bottom' => [
						'image_url' => get_template_directory_uri().'/img/wgl_composer_addon/icons/testimonials_4.png',
						'label' => esc_html__( 'Bottom', 'iguru' )
					],
					'inline_top' => [
						'image_url' => get_template_directory_uri().'/img/wgl_composer_addon/icons/testimonials_2.png',
						'label' => esc_html__( 'Top Inline', 'iguru' )
					],
					'inline_bottom' => [
						'image_url' => get_template_directory_uri().'/img/wgl_composer_addon/icons/testimonials_3.png',
						'label' => esc_html__( 'Bottom Inline', 'iguru' )
					],
				],
				'value' => 'author_top',
				'admin_label' => true,
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Grid Columns Amount', 'iguru' ),
				'param_name' => 'item_grid',
				'value' => array(
					esc_html__( 'One Column', 'iguru' ) => '1',
					esc_html__( 'Two Columns', 'iguru' ) => '2',
					esc_html__( 'Three Columns', 'iguru' ) => '3',
					esc_html__( 'Four Columns', 'iguru' ) => '4',
					esc_html__( 'Five Columns', 'iguru' ) => '5',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_1',
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Alignment', 'iguru' ),
				'param_name' => 'item_align',
				'value' => array(
					esc_html__( 'Left', 'iguru' ) => 'left',
					esc_html__( 'Center', 'iguru' ) => 'center',
					esc_html__( 'Right', 'iguru' ) => 'right',
				),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_2',
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Enable Hover Animation', 'iguru' ),
				'param_name' => 'hover_animation',
				'description' => esc_html__( 'Lift up the item on hover.', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_3',
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Background Image', 'iguru' ),
				'param_name' => 'add_bg_image',
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Background Image', 'iguru' ),
				'param_name' => 'bg_image',
				'dependency' => [
					'element' => 'add_bg_image',
					'value' => 'true',
				],
				'edit_field_class' => 'vc_col-sm-4',
			),
			vc_map_add_css_animation( true ),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Extra Class', 'iguru' ),
				'param_name' => 'extra_class',
				'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'iguru' )
			),
			array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Items', 'iguru' ),
				'description' => esc_html__( 'Enter values for each item - thumbnail, content, author name, author position.', 'iguru' ),
				'param_name' => 'values',
				'params' => array(
					array(
						'type' => 'attach_image',
						'heading' => esc_html__( 'Thumbnail Image', 'iguru' ),
						'param_name' => 'thumbnail',
					),
					array(
						'type' => 'textarea',
						'heading' => esc_html__( 'Content', 'iguru' ),
						'param_name' => 'quote',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Author Name', 'iguru' ),
						'param_name' => 'author_name',
						'admin_label' => true,
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Author Position', 'iguru' ),
						'param_name' => 'author_position',
					),
				),
				'group' => esc_html__( 'Items', 'iguru' ),
			),
			// Thumbnail image dimensions
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Thumbnail Image Dimensions', 'iguru' ),
				'param_name' => 'h_image_styles',
				'group' => esc_html__( 'Items', 'iguru' ),
			),
			// Thumbnail width
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Image Width', 'iguru' ),
				'param_name' => 'custom_img_width',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Items', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Thumbnail height
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Image Height', 'iguru' ),
				'param_name' => 'custom_img_height',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Items', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Thumbnail border radius
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Image Border Radius', 'iguru' ),
				'param_name' => 'custom_img_radius',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Items', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// STYLES TAB
			// Content styles
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Content', 'iguru' ),
				'param_name' => 'h_quote_styles',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'HTML Tag', 'iguru' ),
                'param_name' => 'quote_tag',
                'description' => esc_html__( 'Select custom tag.', 'iguru' ),
                'value' => [
                    esc_html__( '‹div›', 'iguru' )  => 'div',
                    esc_html__( '‹span›', 'iguru' ) => 'span',
                    esc_html__( '‹h2›', 'iguru' )   => 'h2',
                    esc_html__( '‹h3›', 'iguru' )   => 'h3',
                    esc_html__( '‹h4›', 'iguru' )   => 'h4',
                    esc_html__( '‹h5›', 'iguru' )   => 'h5',
                    esc_html__( '‹h6›', 'iguru' )   => 'h6',
                ],
                'std' => 'div',
                'group' => esc_html__( 'Styles', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
			// Content font size
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Font Size', 'iguru' ),
				'param_name' => 'quote_size',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Content font weight
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Font Weight', 'iguru' ),
                'param_name' => 'quote_weight',
                'value' => [
                    esc_html__( 'Theme defaults', 'iguru' ) => '',
                    esc_html__( '300 / Light', 'iguru' ) => '300',
                    esc_html__( '400 / Regular', 'iguru' ) => '400',
                    esc_html__( '500 / Medium', 'iguru' ) => '500',
                    esc_html__( '600 / SemiBold', 'iguru' ) => '600',
                    esc_html__( '700 / Bold', 'iguru' ) => '700',
                    esc_html__( '800 / Extra-Bold', 'iguru' ) => '800',
                ],
                'group' => esc_html__( 'Styles', 'iguru' ),
                'description' => esc_html__( 'Select custom value.', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_1',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			// Content font
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize font family', 'iguru' ),
				'param_name' => 'custom_fonts_quote',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'google_fonts_quote',
				'value' => '',
				'dependency' => [
					'element' => 'custom_fonts_quote',
					'value' => 'true',
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-9',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_2',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			// Content color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Color', 'iguru' ),
				'param_name' => 'custom_quote_color',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Content colorpicker
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Content Color', 'iguru' ),
				'param_name' => 'quote_color',
				'value' => $main_font_color,
				'dependency' => [
					'element' => 'custom_quote_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_3',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			// Author name styles
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Author Name', 'iguru' ),
				'param_name' => 'h_name_styles',
				'group' => esc_html__( 'Styles', 'iguru' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'HTML Tag', 'iguru' ),
				'param_name' => 'name_tag',
				'value' => array(
                    esc_html__( '‹div›', 'iguru' )  => 'div',
                    esc_html__( '‹span›', 'iguru' ) => 'span',
                    esc_html__( '‹h2›', 'iguru' )   => 'h2',
                    esc_html__( '‹h3›', 'iguru' )   => 'h3',
                    esc_html__( '‹h4›', 'iguru' )   => 'h4',
                    esc_html__( '‹h5›', 'iguru' )   => 'h5',
                    esc_html__( '‹h6›', 'iguru' )   => 'h6',
				),
				'std' => 'h3',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'description' => esc_html__( 'Select your html tag.', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Author name Font Size
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Name Font Size', 'iguru' ),
				'param_name' => 'name_size',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_4',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			// Author name color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Colors', 'iguru' ),
				'param_name' => 'custom_name_color',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Author name color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Author Name Color', 'iguru' ),
				'param_name' => 'name_color',
				'value' => '#000000',
				'dependency' => [
					'element' => 'custom_name_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_5',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			// Author name Fonts
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize font family', 'iguru' ),
				'param_name' => 'custom_fonts_name',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'google_fonts_name',
				'value' => '',
				'dependency' => [
					'element' => 'custom_fonts_name',
					'value' => 'true',
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-9',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_6',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			// Author position styles heading
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Author Position', 'iguru' ),
				'param_name' => 'h_status_styles',
				'group' => esc_html__( 'Styles', 'iguru' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'HTML Tag', 'iguru' ),
				'param_name' => 'position_tag',
				'value' => array(
                    esc_html__( '‹span›', 'iguru' ) => 'span',
                    esc_html__( '‹div›', 'iguru' ) => 'div',
                    esc_html__( '‹h2›', 'iguru' ) => 'h2',
                    esc_html__( '‹h3›', 'iguru' ) => 'h3',
                    esc_html__( '‹h4›', 'iguru' ) => 'h4',
                    esc_html__( '‹h5›', 'iguru' ) => 'h5',
                    esc_html__( '‹h6›', 'iguru' ) => 'h6',
				),
				'std' => 'span',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'description' => esc_html__( 'Select custom tag.', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Author position font size
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Font Size', 'iguru' ),
				'param_name' => 'position_size',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_7',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			// Author position fonts
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize font family', 'iguru' ),
				'param_name' => 'custom_fonts_status',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'google_fonts_status',
				'value' => '',
				'dependency' => [
					'element' => 'custom_fonts_status',
					'value' => 'true',
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-9',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_8',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			// Author position color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Color', 'iguru' ),
				'param_name' => 'custom_position_color',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Author position color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Author Position Color', 'iguru' ),
				'param_name' => 'position_color',
				'value' => $theme_color_secondary,
				'dependency' => [
					'element' => 'custom_position_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Item Background
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Item Background', 'iguru' ),
				'param_name' => 'h_status_styles',
				'group' => esc_html__( 'Styles', 'iguru' ),
			),
			// Item bg checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize BG Colors', 'iguru' ),
				'param_name' => 'custom_item_bg',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Item bg idle
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Idle', 'iguru' ),
				'param_name' => 'item_bg_idle',
				'value' => '',
				'dependency' => [
					'element' => 'custom_item_bg',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Item bg hover
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Hover', 'iguru' ),
				'param_name' => 'item_bg_hover',
				'value' => '',
				'dependency' => [
					'element' => 'custom_item_bg',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// CAROUSEL TAB
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Use Carousel', 'iguru' ),
				'param_name' => 'use_carousel',
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-2 no-top-margin',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Autoplay', 'iguru' ),
				'param_name' => 'autoplay',
				'dependency' => [
					'element'   => 'use_carousel',
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
					'element' => 'autoplay',
					'value' => 'true'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3 no-top-padding',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_c_1',
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Fade Animation', 'iguru' ),
				'param_name' => 'fade_animation',
				'description' => esc_html__( 'Requires single full-width column.', 'iguru' ),
				'dependency' => [
					'element'   => 'use_carousel',
					'value' => 'true'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Carousel pagination controls
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Pagination Controls', 'iguru' ),
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
				'std' => 'true',
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
				'type' => 'dropdown',
				'heading' => esc_html__( 'Pagination Alignment', 'iguru' ),
				'param_name' => 'pag_align',
				'value' => array(
					esc_html__( 'Left', 'iguru' ) => 'left',
					esc_html__( 'Center', 'iguru' ) => 'center',
					esc_html__( 'Right', 'iguru' )	=> 'right',
				),
				'std' => 'center',
				'dependency' => [
					'element' => 'use_pagination',
					'value' => 'true',
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
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
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_c_2',
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'divider',
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
				'value' => $header_font_color,
				'dependency' => [
					'element' => 'custom_pag_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Prev/Next buttons
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__( 'Prev/Next Buttons', 'iguru' ),
                'param_name' => 'h_prev_next',
                'dependency' => [
					'element' => 'use_carousel',
					'value' => 'true'
				],
                'group' => esc_html__( 'Carousel', 'iguru' ),
            ),
            // Prev/Next checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Prev/Next buttons', 'iguru' ),
                'param_name' => 'use_prev_next',
                'dependency' => [
					'element' => 'use_carousel',
					'value' => 'true'
				],
                'group' => esc_html__( 'Carousel', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Prev/Next positioning dropdown
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Buttons Positioning', 'iguru' ),
				'param_name' => 'prev_next_position',
				'value' => array(
					esc_html__( 'Opposite each other', 'iguru' ) => '',
					esc_html__( 'Top right corner', 'iguru' ) => 'right',
				),
				'dependency' => [
					'element' => 'use_prev_next',
					'value' => 'true',
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_c_3',
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'divider',
			),
            // Prev/Next colors checkbox
			array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'iguru' ),
                'param_name' => 'custom_prev_next_color',
                'dependency' => [
                    'element' => 'use_prev_next',
                    'value' => 'true',
                ],
                'group' => esc_html__( 'Carousel', 'iguru' ),
            ),
            // Prev/Next color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Arrows Idle', 'iguru' ),
                'param_name' => 'prev_next_color',
                'value' => 'rgba( '.iGuru_Theme_Helper::hexToRGB($theme_color).',1)',
                'dependency' => [
                    'element' => 'custom_prev_next_color',
                    'value' => 'true'
                ],
                'group' => esc_html__( 'Carousel', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Prev/Next hover color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Arrows Hover', 'iguru' ),
                'param_name' => 'prev_next_color_hover',
                'value' => $theme_color,
                'dependency' => [
                    'element' => 'custom_prev_next_color',
                    'value' => 'true'
                ],
                'group' => esc_html__( 'Carousel', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_c_4',
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'divider',
			),
            // Prev/Next bg color
			array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Idle', 'iguru' ),
                'param_name' => 'prev_next_bg_idle',
                'value' => '',
                'dependency' => [
                    'element' => 'custom_prev_next_color',
                    'value' => 'true'
                ],
                'group' => esc_html__( 'Carousel', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Prev/Next bg color hover
			array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Hover', 'iguru' ),
                'param_name' => 'prev_next_bg_hover',
                'value' => '',
                'dependency' => [
                    'element' => 'custom_prev_next_color',
                    'value' => 'true'
                ],
                'group' => esc_html__( 'Carousel', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
			// RESPONSIVE TAB
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Responsive', 'iguru' ),
				'param_name' => 'custom_resp',
				'dependency'  => array(
					'element' => 'use_carousel',
					'value' => 'true'
				),
				'group' => esc_html__( 'Responsive', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
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
				'group' => esc_html__( 'Responsive', 'iguru' ),
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
				'group' => esc_html__( 'Responsive', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_r_1',
				'dependency' => [
					'element' => 'custom_resp',
					'value' => 'true',
				],
				'group' => esc_html__( 'Responsive', 'iguru' ),
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
				'group' => esc_html__( 'Responsive', 'iguru' ),
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
				'group' => esc_html__( 'Responsive', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_r_2',
				'dependency' => [
					'element' => 'custom_resp',
					'value' => 'true',
				],
				'group' => esc_html__( 'Responsive', 'iguru' ),
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
				'group' => esc_html__( 'Responsive', 'iguru' ),
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
				'group' => esc_html__( 'Responsive', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
		)
	));

	if (class_exists( 'WPBakeryShortCode' )) {
		class WPBakeryShortCode_wgl_Testimonials extends WPBakeryShortCode {}
	}
}
