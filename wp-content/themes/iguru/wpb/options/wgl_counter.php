<?php

defined( 'ABSPATH' ) || exit;

$theme_color = esc_attr(iGuru_Theme_Helper::get_option('theme-custom-color'));
$header_font_color = esc_attr(iGuru_Theme_Helper::get_option('header-font')['color']);

if ( function_exists('vc_map') ) {
    vc_map( [
        'name' => esc_html__( 'Counter', 'iguru' ),
        'base' => 'wgl_counter',
        'class' => 'iguru_counter',
        'category' => esc_html__( 'WGL Modules', 'iguru' ),
        'icon' => 'wgl_icon_counter',
        'content_element' => true,
        'description' => esc_html__( 'Counter','iguru' ),
        'params' => [
            array(
                'type' => 'iguru_radio_image',
                'heading' => esc_html__( 'Overall Layout', 'iguru' ),
                'param_name' => 'counter_layout',
                'fields' => [
                    'top' => [
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/style_def.png',
                        'label' => esc_html__( 'Top', 'iguru' )
                    ],
                    'left' => [
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/style_left.png',
                        'label' => esc_html__( 'Left', 'iguru' )
                    ],
                    'right' => [
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/style_right.png',
                        'label' => esc_html__( 'Right', 'iguru' )
                    ],
                ],
                'value' => 'top',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Alignment', 'iguru' ),
                'param_name' => 'counter_align',
                'value' => [
                    esc_html__( 'Left', 'iguru' ) => 'left',
                    esc_html__( 'Center', 'iguru' ) => 'center',
                    esc_html__( 'Right', 'iguru' ) => 'right',
                ],
                'edit_field_class' => 'vc_col-sm-6',
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'iguru' ),
                'param_name' => 'extra_class',
                'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'iguru' )
            ),
            // CONTENT TAB
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Title', 'iguru' ),
                'param_name' => 'count_title',
                'admin_label' => true,
                'group' => esc_html__( 'Content', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-8',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Counter Divider', 'iguru' ),
                'param_name' => 'add_counter_divider',
                'group' => esc_html__( 'Content', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4 no-top-padding',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Value Prefix', 'iguru' ),
                'description' => esc_html__( 'Shown before value.', 'iguru' ),
                'param_name' => 'count_prefix',
                'group' => esc_html__( 'Content', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Value', 'iguru' ),
                'description' => esc_html__( 'Enter number without any special character', 'iguru' ),
                'param_name' => 'count_value',
                'admin_label' => true,
                'group' => esc_html__( 'Content', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Value Suffix', 'iguru' ),
                'description' => esc_html__( 'Shown after value.', 'iguru' ),
                'param_name' => 'count_suffix',
                'group' => esc_html__( 'Content', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'css_editor',
                'heading' => esc_html__( 'Counter Offsets', 'iguru' ),
                'param_name' => 'counter_offsets',
                'group' => esc_html__( 'Content', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12 wgl_css_editor',
            ),
            array(
                'type' => 'iguru_param_heading',
                'param_name' => 'h_shadow',
                'group' => esc_html__( 'Content', 'iguru' ),
            ),
            // Counter shadow
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Counter Shadow', 'iguru' ),
                'param_name' => 'add_shadow',
                'group' => esc_html__( 'Content', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Counter shadow appearance
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Shadow Appearance', 'iguru' ),
                'param_name' => 'shadow_appearance',
                'value' => [
                    esc_html__( 'Visible While Hover', 'iguru' ) => 'on_hover',
                    esc_html__( 'Visible Until Hover', 'iguru' ) => 'before_hover',
                    esc_html__( 'Always Visible', 'iguru' ) => 'always',
                ],
                'std' => 'always',
                'dependency' => [
                    'element' => 'add_shadow',
                    'value' => 'true'
                ],
                'group' => esc_html__( 'Content', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-8',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Shadow Type', 'iguru' ),
                'param_name' => 'shadow_type',
                'value' => [
                    esc_html__( 'Outset', 'iguru' ) => '',
                    esc_html__( 'Inset', 'iguru' ) => 'inset',
                ],
                'std' => 'inset',
                'dependency' => [
                    'element' => 'add_shadow',
                    'value' => 'true'
                ],
                'group' => esc_html__( 'Content', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'X Offset', 'iguru' ),
                'param_name' => 'shadow_offset_x',
                'value' => '0',
                'dependency' => [
                    'element' => 'add_shadow',
                    'value' => 'true',
                ],
                'group' => esc_html__( 'Content', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Y Offset', 'iguru' ),   
                'param_name' => 'shadow_offset_y',
                'value' => '14',
                'dependency' => [
                    'element' => 'add_shadow',
                    'value' => 'true',
                ],
                'group' => esc_html__( 'Content', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Blur', 'iguru' ),
                'param_name' => 'shadow_blur',
                'value' => '10',
                'dependency' => [
                    'element' => 'add_shadow',
                    'value' => 'true',
                ],
                'group' => esc_html__( 'Content', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-1',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Spread', 'iguru' ),
                'param_name' => 'shadow_spread',
                'value' => '0',
                'dependency' => [
                    'element' => 'add_shadow',
                    'value' => 'true',
                ],
                'group' => esc_html__( 'Content', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-1',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Color', 'iguru' ),
                'param_name' => 'shadow_color',
                'value' => 'rgba(0,0,0,0.06)',
                'dependency' => [
                    'element' => 'add_shadow',
                    'value' => 'true'
                ],
                'group' => esc_html__( 'Content', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // ICON TAB
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Add icon/image', 'iguru' ),
                'param_name' => 'icon_type',
                'value' => [
                    esc_html__( 'None', 'iguru' ) => '',
                    esc_html__( 'Font', 'iguru' ) => 'font',
                    esc_html__( 'Image', 'iguru' ) => 'image',
                ],
                'save_always' => true,
                'group' => esc_html__( 'Icon', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Icon Pack', 'iguru' ),
                'param_name' => 'icon_pack',
                'value' => [
                    esc_html__( 'Fontawesome', 'iguru' ) => 'fontawesome',
                    esc_html__( 'Flaticon', 'iguru' ) => 'flaticon',
                ],
                'save_always' => true,
                'dependency' => [
                    'element' => 'icon_type',
                    'value' => 'font',
                ],
                'group' => esc_html__( 'Icon', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4 no-top-padding',
            ),
            // Custom icon size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Custom Icon Size', 'iguru' ),
                'param_name' => 'custom_icon_size',
                'description' => esc_html__( 'Value in pixels.', 'iguru' ),
                'dependency' => [
                    'element' => 'icon_type',
                    'value' => 'font',
                ],
                'group' => esc_html__( 'Icon', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4 no-top-padding',
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'iguru' ),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-adjust',
                'description' => esc_html__( 'Select icon from library.', 'iguru' ),
                'settings' => [
                    'emptyIcon' => false, // default true, display an 'EMPTY' icon?
                    'iconsPerPage' => 200, // ddefault 100, defines how many icons will be displayed per page. Use big number to display all icons in single page
                ],
                'dependency' => [
                    'element' => 'icon_pack',
                    'value' => 'fontawesome',
                ],
                'group' => esc_html__( 'Icon', 'iguru' ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'iguru' ),
                'param_name' => 'icon_flaticon',
                'value' => '',
                'description' => esc_html__( 'Select icon from library.', 'iguru' ),
                'settings' => [
                    'emptyIcon' => false,
                    'type' => 'flaticon',
                    'iconsPerPage' => 200, 
                ],
                'dependency' => [
                    'element' => 'icon_pack',
                    'value' => 'flaticon',
                ],
                'group' => esc_html__( 'Icon', 'iguru' ),
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Image', 'iguru' ),
                'param_name' => 'thumbnail',
                'value' => '',
                'description' => esc_html__( 'Select image from media library.', 'iguru' ),
                'dependency' => [
                    'element' => 'icon_type',
                    'value' => 'image',
                ],
                'group' => esc_html__( 'Icon', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-8 no-top-padding',
            ),
            // Image width
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Image Width', 'iguru' ),
                'param_name' => 'custom_image_width',
                'description' => esc_html__( 'Value in pixels.', 'iguru' ),
                'dependency' => [
                    'element' => 'icon_type',
                    'value' => 'image',
                ],
                'group' => esc_html__( 'Icon', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Image height
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Image Height', 'iguru' ),
                'param_name' => 'custom_image_height',
                'description' => esc_html__( 'Value in pixels.', 'iguru' ),
                'dependency' => [
                    'element' => 'icon_type',
                    'value' => 'image',
                ],
                'group' => esc_html__( 'Icon', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // ICON CONTAINER TAB
            // Icon container width
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Container Width', 'iguru' ),
                'param_name' => 'custom_icon_bg_width',
                'description' => esc_html__( 'Value in pixels.', 'iguru' ),
                'dependency' => [
                    'element' => 'icon_type',
                    'value' => [ 'font', 'image' ]
                ],
                'group' => esc_html__( 'Icon Container', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-5 no-top-padding',
            ),
			// Icon container height
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Container Height', 'iguru' ),
				'param_name' => 'custom_icon_bg_height',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'icon_type',
					'value' => [ 'font', 'image' ]
				],
				'group' => esc_html__( 'Icon Container', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-5 no-top-padding',
			),
			array(
				'type' => 'css_editor',
				'heading' => esc_html__( 'Icon Offsets', 'iguru' ),
				'param_name' => 'icon_offsets',
				'dependency' => [
					'element' => 'icon_type',
					'value' => [ 'font', 'image' ]
				],
				'group' => esc_html__( 'Icon Container', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12 wgl_css_editor',
			),
            // COLORS TAB
            // Value colors
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__( 'Value colors', 'iguru' ),
                'param_name' => 'h_title_styles',
                'group' => esc_html__( 'Colors', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            // Value color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'iguru' ),
                'param_name' => 'custom_value_color',
                'group' => esc_html__( 'Colors', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Value color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Value Color', 'iguru' ),
                'param_name' => 'value_color',
                'value' => $header_font_color,
                'dependency' => [
                    'element' => 'custom_value_color',
                    'value' => 'true'
                ],
                'group' => esc_html__( 'Colors', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Use text-stroke effect
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Use Text-Stroke', 'iguru' ),
                'param_name' => 'add_value_text_stroke',
                'dependency' => [
                    'element' => 'custom_value_color',
                    'value' => 'true'
                ],
                'group' => esc_html__( 'Colors', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Text-stroke color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Text-stroke Color', 'iguru' ),
                'param_name' => 'value_text_stroke_color',
                'value' => $theme_color,
                'dependency' => [
                    'element' => 'add_value_text_stroke',
                    'value' => 'true'
                ],
                'group' => esc_html__( 'Colors', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__( 'Title Colors', 'iguru' ),
                'param_name' => 'h_title_styles',
                'group' => esc_html__( 'Colors', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Title color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'iguru' ),
                'param_name' => 'custom_title_color',
                'group' => esc_html__( 'Colors', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Title color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Title Color', 'iguru' ),
                'param_name' => 'title_color',
                'value' => $header_font_color,
                'dependency' => [
                    'element' => 'custom_title_color',
                    'value' => 'true'
                ],
                'group' => esc_html__( 'Colors', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Icon colors heading
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__( 'Icon Colors', 'iguru' ),
                'param_name' => 'h_icon_colors',
                'dependency' => [
                    'element' => 'icon_type',
                    'value' => 'font',
                ],
                'group' => esc_html__( 'Colors', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Icon color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'iguru' ),
                'param_name' => 'custom_icon_color',
                'dependency' => [
                    'element' => 'icon_type',
                    'value' => 'font',
                ],
                'group' => esc_html__( 'Colors', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Icon color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Icon Idle', 'iguru' ),
                'param_name' => 'icon_color',
                'value' => '#000000',
                'dependency' => [
                    'element' => 'custom_icon_color',
                    'value' => 'true'
                ],
                'group' => esc_html__( 'Colors', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Icon hover color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Icon Hover', 'iguru' ),
                'param_name' => 'icon_color_hover',
                'dependency' => [
                    'element' => 'custom_icon_color',
                    'value' => 'true'
                ],
                'group' => esc_html__( 'Colors', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'iguru_param_heading',
                'param_name' => 'divider_c_1',
                'group' => esc_html__( 'Colors', 'iguru' ),
                'edit_field_class' => 'divider',
            ),
            // IC border color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Border Colors', 'iguru' ),
                'param_name' => 'custom_icon_border_color',
                'dependency' => [
                    'element' => 'icon_type',
                    'value' => [ 'font', 'image' ]
                ],
                'group' => esc_html__( 'Colors', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // IC border idle
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Container Border Idle', 'iguru' ),
                'param_name' => 'icon_border_color',
                'value' => '#ffffff',
                'dependency' => [
                    'element' => 'custom_icon_border_color',
                    'value' => 'true'
                ],
                'group' => esc_html__( 'Colors', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // IC border hover
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Container Border Hover', 'iguru' ),
                'param_name' => 'icon_border_color_hover',
                'value' => '#ffffff',
                'dependency' => [
                    'element' => 'custom_icon_border_color',
                    'value' => 'true'
                ],
                'group' => esc_html__( 'Colors', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'iguru_param_heading',
                'param_name' => 'divider_c_2',
                'group' => esc_html__( 'Colors', 'iguru' ),
                'edit_field_class' => 'divider',
            ),
            // IC bg color dropdown
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Customize Backgrounds', 'iguru' ),
                'param_name' => 'icon_bg_color_type',
                'value' => [
                    esc_html__( 'Theme defaults', 'iguru' ) => '',
                    esc_html__( 'Flat colors', 'iguru' ) => 'color',
                    esc_html__( 'Gradient colors', 'iguru' ) => 'gradient',
                ],
                'dependency' => [
                    'element' => 'icon_type',
                    'value' => [ 'font', 'image' ]
                ],
                'group' => esc_html__( 'Colors', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // IC bg idle
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Idle', 'iguru' ),
                'param_name' => 'icon_bg_color',
                'value' => '#000000',
                'dependency' => [
                    'element' => 'icon_bg_color_type',
                    'value' => 'color'
                ],
                'group' => esc_html__( 'Colors', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // IC bg hover
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Hover', 'iguru' ),
                'param_name' => 'icon_bg_color_hover',
                'dependency' => [
                    'element' => 'icon_bg_color_type',
                    'value' => 'color'
                ],
                'group' => esc_html__( 'Colors', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ), 
            // IC Background gradient start
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Start Color', 'iguru' ),
                'param_name' => 'icon_bg_gradient_start',
                'value' => '',
                'dependency' => [
                    'element' => 'icon_bg_color_type',
                    'value' => 'gradient'
                ],
                'group' => esc_html__( 'Colors', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // IC Background gradient end
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background End Color', 'iguru' ),
                'param_name' => 'icon_bg_gradient_end',
                'value' => '',
                'dependency' => [
                    'element' => 'icon_bg_color_type',
                    'value' => 'gradient'
                ],
                'group' => esc_html__( 'Colors', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Counter Divider
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__( 'Divider Colors', 'iguru' ),
                'param_name' => 'h_divider',
                'group' => esc_html__( 'Colors', 'iguru' ),
            ),
            // Divider color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'iguru' ),
                'param_name' => 'custom_divider_color',
                'group' => esc_html__( 'Colors', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Divider color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Divider Color', 'iguru' ),
                'param_name' => 'divider_color',
                'value' => '#dfdfdf',
                'dependency' => [
                    'element' => 'custom_divider_color',
                    'value' => 'true'
                ],
                'group' => esc_html__( 'Colors', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // TYPOGRAPHY TAB
            // Title styles heading
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__( 'Counter Title Styles', 'iguru' ),
                'param_name' => 'h_title_styles',
                'group' => esc_html__( 'Typography', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            // Title Tag dropdown
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Title Tag', 'iguru' ),
                'param_name' => 'title_tag',
                'value' => [
                    esc_html__( '‹div›', 'iguru' ) => 'div',
                    esc_html__( '‹h2›', 'iguru' ) => 'h2',
                    esc_html__( '‹h3›', 'iguru' ) => 'h3',
                    esc_html__( '‹h4›', 'iguru' ) => 'h4',
                    esc_html__( '‹h5›', 'iguru' ) => 'h5',
                    esc_html__( '‹h6›', 'iguru' ) => 'h6',
                    esc_html__( '‹span›', 'iguru' ) => 'span',
                ],
                'std' => 'div',
                'group' => esc_html__( 'Typography', 'iguru' ),
                'description' => esc_html__( 'Select html tag for title.', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            // Title margin top
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Title Margin Top', 'iguru' ),
                'param_name' => 'title_margin_top',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'iguru' ),
                'group' => esc_html__( 'Typography', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            // Title font size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Title Font Size', 'iguru' ),
                'param_name' => 'title_size',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'iguru' ),
                'group' => esc_html__( 'Typography', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            // Title font weight
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Title Font Weight', 'iguru' ),
                'param_name' => 'title_weight',
                'value' => [
                    esc_html__( 'Theme Default', 'iguru' ) => '',
                    esc_html__( '300 / Light', 'iguru' ) => '300',
                    esc_html__( '400 / Regular', 'iguru' ) => '400',
                    esc_html__( '500 / Medium', 'iguru' ) => '500',
                    esc_html__( '600 / SemiBold', 'iguru' ) => '600',
                    esc_html__( '700 / Bold', 'iguru' ) => '700',
                    esc_html__( '800 / Extra-Bold', 'iguru' ) => '800',
                ],
                'group' => esc_html__( 'Typography', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            // Title fonts
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize font family', 'iguru' ),
                'param_name' => 'custom_fonts_title',
                'group' => esc_html__( 'Typography', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_title',
                'value' => '',
                'dependency' => [
                    'element' => 'custom_fonts_title',
                    'value' => 'true',
                ],
                'group' => esc_html__( 'Typography', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-9',
            ),
            // Value styles heading
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__( 'Counter Value Styles', 'iguru' ),
                'param_name' => 'h_count_value_styles',
                'group' => esc_html__( 'Typography', 'iguru' ),
            ),
            // Value container height
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Value Container Height', 'iguru' ),
                'param_name' => 'value_height',
                'value' => '',
                'description' => esc_html__( 'Value wrapper height in pixels. Note: value may be cropped from bottom.', 'iguru' ),
                'group' => esc_html__( 'Typography', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-10',
            ),
            // Value font size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Value Font Size', 'iguru' ),
                'param_name' => 'value_size',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'iguru' ),
                'group' => esc_html__( 'Typography', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            // Value font weight
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Value Font Weight', 'iguru' ),
                'param_name' => 'value_weight',
                'value' => [
                    esc_html__( 'Theme Default', 'iguru' ) => '',
                    esc_html__( '300 / Light', 'iguru' ) => '300',
                    esc_html__( '400 / Regular', 'iguru' ) => '400',
                    esc_html__( '500 / Medium', 'iguru' ) => '500',
                    esc_html__( '600 / SemiBold', 'iguru' ) => '600',
                    esc_html__( '700 / Bold', 'iguru' ) => '700',
                    esc_html__( '800 / Extra Bold', 'iguru' ) => '800',
                ],
                'group' => esc_html__( 'Typography', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            // Value custom fonts
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize font family', 'iguru' ),
                'param_name' => 'custom_fonts_count_value',
                'group' => esc_html__( 'Typography', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_count_value',
                'value' => '',
                'dependency' => [
                    'element' => 'custom_fonts_count_value',
                    'value' => 'true',
                ],
                'group' => esc_html__( 'Typography', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-9',
            ),
        ]
    ]);

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_wgl_Counter extends WPBakeryShortCode {
        }
    }
}