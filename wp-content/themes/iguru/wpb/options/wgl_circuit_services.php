<?php
if ( !defined( 'ABSPATH' ) ) { die( '-1' ); }

$theme_color = esc_attr(iGuru_Theme_Helper::get_option('theme-custom-color'));
$theme_color_secondary = esc_attr(iGuru_Theme_Helper::get_option('second-custom-color'));
$theme_gradient = iGuru_Theme_Helper::get_option('theme-gradient');

if (function_exists( 'vc_map' )) {
    vc_map(array(
        'name' => esc_html__( 'Circuit Services', 'iguru' ),
        'base' => 'wgl_circuit_services',
        'class' => 'iguru_circuit_services',
        'category' => esc_html__( 'WGL Modules', 'iguru' ),
        'icon' => 'wgl_icon_circuit_services',
        'content_element' => true,
        'description' => esc_html__( 'Add Services', 'iguru' ),
        'params' => array(
            // GENERAL TAB
			array(
				'type' => 'param_group',
				'heading' => esc_html__( 'Values', 'iguru' ),
				'param_name' => 'values',
                'save_always' => true,
				'params' => array(
                    array(
                        'type' => 'dropdown',
                        'param_name' => 'icon_font_type',
                        'value' => array(
                            esc_html__( 'Flaticon', 'iguru' ) => 'type_flaticon',
                            esc_html__( 'Fontawesome', 'iguru' ) => 'type_fontawesome',
                        ),
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => esc_html__( 'Icon', 'iguru' ),
                        'param_name' => 'icon_fontawesome',
                        'value' => 'fa fa-adjust',
                        'description' => esc_html__( 'Select icon from library.', 'iguru' ),
                        'settings' => array(
                            'emptyIcon' => false,
                            'type' => 'fontawesome',
                            'iconsPerPage' => 200,
                        ),
                        'dependency' => array(
                            'element' => 'icon_font_type',
                            'value' => 'type_fontawesome',
                        ),
                    ),
                    array(
                        'type' => 'iconpicker',
                        'heading' => esc_html__( 'Icon', 'iguru' ),
                        'param_name' => 'icon_flaticon',
                        'value' => 'fa fa-adjust',
                        'description' => esc_html__( 'Select icon from library.', 'iguru' ),
                        'settings' => array(
                            'emptyIcon' => false,
                            'type' => 'flaticon',
                            'iconsPerPage' => 200,
                        ),
                        'dependency' => array(
                            'element' => 'icon_font_type',
                            'value' => 'type_flaticon',
                        ),
                    ),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Title', 'iguru' ),
						'param_name' => 'title',
						'admin_label' => true,
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Subtitle', 'iguru' ),
						'param_name' => 'subtitle',
					),
					array(
						'type' => 'textarea',
						'heading' => esc_html__( 'Description', 'iguru' ),
						'param_name' => 'descr',
					),
				),
			),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'iguru' ),
                'param_name' => 'item_el_class',
                'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'iguru' )
            ),
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__( 'Icon Colors', 'iguru' ),
                'param_name' => 'h_icon_type',
                'group' => esc_html__( 'Icons Styles', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            // Icon color dropdown
            array(
                'type' => 'dropdown',
                'param_name' => 'icon_color_type',
                'value' => array(
                    esc_html__( 'Theme Defaults', 'iguru' ) => 'def',
                    esc_html__( 'Color', 'iguru' ) => 'color',
                    esc_html__( 'Gradient', 'iguru' ) => 'gradient',
                ),
                'group' => esc_html__( 'Icons Styles', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Icon color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Icon Idle', 'iguru' ),
                'param_name' => 'icon_color_idle',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'icon_color_type',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Icons Styles', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Icon hover color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Icon Hover', 'iguru' ),
                'param_name' => 'icon_color_hover',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'icon_color_type',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Icons Styles', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Icon gradient start color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Icon Gradient From', 'iguru' ),
                'param_name' => 'icon_color_from',
                'value' => $theme_gradient['from'],
                'description' => esc_html__( 'Select icon gradient color from', 'iguru' ),
                'dependency' => array(
                    'element' => 'icon_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Icons Styles', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Icon gradient end color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Icon Gradient To', 'iguru' ),
                'param_name' => 'icon_color_to',
                'value' => $theme_gradient['to'],
                'description' => esc_html__( 'Select icon gradient color to', 'iguru' ),
                'dependency' => array(
                    'element' => 'icon_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Icons Styles', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Icon gradient start color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Icon Hover Gradient From', 'iguru' ),
                'param_name' => 'icon_hover_color_from',
                'value' => $theme_gradient['to'],
                'description' => esc_html__( 'Select icon gradient color from', 'iguru' ),
                'dependency' => array(
                    'element' => 'icon_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Icons Styles', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Icon gradient end color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Icon Hover Gradient To', 'iguru' ),
                'param_name' => 'icon_hover_color_to',
                'value' => $theme_gradient['from'],
                'description' => esc_html__( 'Select icon gradient color to', 'iguru' ),
                'dependency' => array(
                    'element' => 'icon_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Icons Styles', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Custom icon size
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__( 'Custom Icon Size', 'iguru' ),
                'param_name' => 'h_size_icon_type',
                'group' => esc_html__( 'Icons Styles', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Custom Icon Size', 'iguru' ),
                'param_name' => 'custom_icon_size',
                'description' => esc_html__( 'Enter value in pixels (default 50px)', 'iguru' ),
                'group' => esc_html__( 'Icons Styles', 'iguru' ),
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => 'font',
                ),
            ),
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__( 'Icons Background Colors', 'iguru' ),
                'param_name' => 'h_bg_icon_type',
                'group' => esc_html__( 'Icons Styles', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Icon color dropdown
            array(
                'type' => 'dropdown',
                'param_name' => 'bg_color_type',
                'value' => array(
                    esc_html__( 'Theme Defaults', 'iguru' ) => 'def',
                    esc_html__( 'Color', 'iguru' ) => 'color',
                    esc_html__( 'Gradient', 'iguru' ) => 'gradient',
                ),
                'std' => 'gradient',
                'group' => esc_html__( 'Icons Styles', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Icon idle color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Idle', 'iguru' ),
                'param_name' => 'bg_color_idle',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Icons Styles', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Icon hover color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Hover', 'iguru' ),
                'param_name' => 'bg_color_hover',
                'value' => $theme_color_secondary,
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'color'
                ),
                'group' => esc_html__( 'Icons Styles', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Icon bg gradient idle start
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Gradient Start', 'iguru' ),
                'param_name' => 'bg_color_from',
                'value' => '#ffffff',
                'description' => esc_html__( 'For Idle State.', 'iguru' ),
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Icons Styles', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Icon bg gradient idle end
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Gradient End', 'iguru' ),
                'param_name' => 'bg_color_to',
                'value' => '#ffffff',
                'description' => esc_html__( 'For Idle State.', 'iguru' ),
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Icons Styles', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Icon bg gradient hover start
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Gradient Start', 'iguru' ),
                'param_name' => 'bg_hover_color_from',
                'value' => $theme_gradient['from'],
                'description' => esc_html__( 'For Hover State.', 'iguru' ),
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Icons Styles', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Icon bg gradient hover end
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Gradient End', 'iguru' ),
                'param_name' => 'bg_hover_color_to',
                'value' => $theme_gradient['to'],
                'description' => esc_html__( 'For Hover State.', 'iguru' ),
                'dependency' => array(
                    'element' => 'bg_color_type',
                    'value' => 'gradient'
                ),
                'group' => esc_html__( 'Icons Styles', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Styling
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__( 'Custom Title Color', 'iguru' ),
                'param_name' => 'h_custom_colors',
                'group' => esc_html__( 'Typography', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'iguru' ),
                'param_name' => 'custom_title_color',
                'group' => esc_html__( 'Typography', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Title Color', 'iguru' ),
                'param_name' => 'title_color',
                'value' => '#252525',
                'dependency' => array(
                    'element' => 'custom_title_color',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Typography', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__( 'Custom Subtitle Color', 'iguru' ),
                'param_name' => 'h_custom_subtitle_colors',
                'group' => esc_html__( 'Typography', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'iguru' ),
                'param_name' => 'custom_subtitle_color',
                'description' => esc_html__( 'Select custom color', 'iguru' ),
                'group' => esc_html__( 'Typography', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Subtitle Color', 'iguru' ),
                'param_name' => 'subtitle_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'custom_subtitle_color',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Typography', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__( 'Custom Content Color', 'iguru' ),
                'param_name' => 'h_custom_content_colors',
                'group' => esc_html__( 'Typography', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'iguru' ),
                'param_name' => 'custom_content_color',
                'group' => esc_html__( 'Typography', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Content Color', 'iguru' ),
                'param_name' => 'content_color',
                'value' => '#6e6e6e',
                'dependency' => array(
                    'element' => 'custom_content_color',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Typography', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
        )
    ));

    if (class_exists( 'WPBakeryShortCode' )) {
        class WPBakeryShortCode_wgl_Circuit_Services extends WPBakeryShortCode {
        }
    }
}