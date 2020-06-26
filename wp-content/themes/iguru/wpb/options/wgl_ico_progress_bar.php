<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$theme_color = esc_attr(iGuru_Theme_Helper::get_option("theme-custom-color"));

if (function_exists('vc_map')) {
    vc_map(array(
        'name' => esc_html__('Ico Progress Bar', 'iguru'),
        'base' => 'wgl_ico_progress_bar',
        'class' => 'iguru_ico_progress_bar',
        'category' => esc_html__('WGL Modules', 'iguru'),
        'icon' => 'wgl_ico-mod',
        'content_element' => true,
        'description' => esc_html__('Display Ico Progress Bar','iguru'),
        'params' => array(
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Min Value', 'iguru' ),
                "param_name"    => "min_value",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Min Value Label', 'iguru' ),
                "param_name"    => "min_value_label",
                'edit_field_class' => 'vc_col-sm-6 no-top-padding',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Max Value', 'iguru' ),
                "param_name"    => "max_value",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Max Value Label', 'iguru' ),
                "param_name"    => "max_value_label",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Completed', 'iguru' ),
                "param_name"    => "completed",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Completed Label', 'iguru' ),
                "param_name"    => "completed_label",
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Units', 'iguru' ),
                "param_name"    => "units",
                "value"    => "$",
                "description"   => esc_html__( 'Enter measurement units (Example: %, px, points, etc.)', 'iguru' ),
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Max Ico Progress Bar Width', 'iguru' ),
                "param_name"    => "max_width",
                "description"   => esc_html__( 'Enter max width in pixels', 'iguru' ),
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'iguru'),
                'param_name' => 'extra_class',
                'description' => esc_html__('Add an extra class name to the element and refer to it from Custom CSS option.', 'iguru')
            ),
            // Ico Progress Bar Points
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__('Ico Progress Bar Points', 'iguru'),
                'param_name' => 'h_bar_points',
                'group' => esc_html__( 'Points', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'param_group',
                'param_name' => 'values',
                'description' => esc_html__( 'Enter values for graph - point label and point value.', 'iguru' ),
                'group' => esc_html__( 'Points', 'iguru' ),
                'value' => urlencode( json_encode( array(
                    array(
                        'point_label' => esc_html__( 'Soft Cap', 'iguru' ),
                        'point_value' => '25',
                    ),
                    array(
                        'point_label' => esc_html__( 'Hard Cap', 'iguru' ),
                        'point_value' => '75',
                    ),
                ) ) ),
                'params' => array(
                    array(
                        "type"          => "textfield",
                        "heading"       => esc_html__( 'Point Label', 'iguru' ),
                        "param_name"    => "point_label",
                        'admin_label'   => true,
                    ),
                    array(
                        "type"          => "textfield",
                        "heading"       => esc_html__( 'Point Value', 'iguru' ),
                        "param_name"    => "point_value",
                        "description"    => esc_html__( 'Enter value in percentage', 'iguru' ),
                    ),
                ),
            ),
            // Colors
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__('Bar Colors', 'iguru'),
                'param_name' => 'h_bar_colors',
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
                'group' => esc_html__( 'Colors', 'iguru' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom Bar Colors', 'iguru' ),
                'param_name' => 'custom_bar_color',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Colors', 'iguru' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Bacground Color', 'iguru'),
                'param_name' => 'bg_color',
                'value' => '#ecf1f9',
                'edit_field_class' => 'vc_col-sm-4',
                "dependency"    => array(
                    "element"   => "custom_bar_color",
                    "value" => 'true'
                ),
                'group' => esc_html__( 'Colors', 'iguru' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Comleted Color', 'iguru'),
                'param_name' => 'completed_color',
                'value' => $theme_color,
                'edit_field_class' => 'vc_col-sm-4',
                "dependency"    => array(
                    "element"   => "custom_bar_color",
                    "value" => 'true'
                ),
                'group' => esc_html__( 'Colors', 'iguru' ),
            ),
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__('Text Colors', 'iguru'),
                'param_name' => 'h_text_colors',
                'edit_field_class' => 'vc_col-sm-12',
                'group' => esc_html__( 'Colors', 'iguru' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom Text Color', 'iguru' ),
                'param_name' => 'custom_text_color',
                'edit_field_class' => 'vc_col-sm-6',
                'group' => esc_html__( 'Colors', 'iguru' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Values Color', 'iguru'),
                'param_name' => 'value_color',
                'value' => '#8b9baf',
                'edit_field_class' => 'vc_col-sm-6',
                "dependency"    => array(
                    "element"   => "custom_text_color",
                    "value" => 'true'
                ),
                'group' => esc_html__( 'Colors', 'iguru' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Labels Color', 'iguru'),
                'param_name' => 'label_color',
                'value' => '#8b9baf',
                'edit_field_class' => 'vc_col-sm-6',
                "dependency"    => array(
                    "element"   => "custom_text_color",
                    "value" => 'true'
                ),
                'group' => esc_html__( 'Colors', 'iguru' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Completed Color', 'iguru'),
                'param_name' => 'completed_text_color',
                'value' => '#ffffff',
                'edit_field_class' => 'vc_col-sm-6',
                "dependency"    => array(
                    "element"   => "custom_text_color",
                    "value" => 'true'
                ),
                'group' => esc_html__( 'Colors', 'iguru' ),
            ),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_wgl_Ico_Progress_Bar extends WPBakeryShortCode {
        }
    }
}
