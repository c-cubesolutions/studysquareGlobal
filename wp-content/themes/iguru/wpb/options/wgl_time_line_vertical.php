<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$theme_color = esc_attr(iGuru_Theme_Helper::get_option("theme-custom-color"));

if (function_exists('vc_map')) {
    vc_map(array(
        'name' => esc_html__('Time Line Vertical', 'iguru'),
        'base' => 'wgl_time_line_vertical',
        'class' => 'iguru_time_line_vertical',
        'category' => esc_html__('WGL Modules', 'iguru'),
        'icon' => 'wgl_icon_vertical-timeline',
        'content_element' => true,
        'description' => esc_html__('Display Time Line Vertical','iguru'),
        'params' => array(
            array(
                'type' => 'param_group',
                'heading' => esc_html__( 'Time Line Items Content', 'iguru' ),
                'param_name' => 'values',
                'description' => esc_html__( 'Enter values for graph - title, description, date and color.', 'iguru' ),
                'params' => array(
                    array(
                        "type"          => "textfield",
                        "heading"       => esc_html__( 'Title', 'iguru' ),
                        "param_name"    => "title",
                        'admin_label'   => true,
                    ),
                    array(
                        "type"          => "textarea",
                        "heading"       => esc_html__( 'Description', 'iguru' ),
                        "param_name"    => "descr",
                    ),
                    array(
                        "type"          => "textfield",
                        "heading"       => esc_html__( 'Date', 'iguru' ),
                        "param_name"    => "date",
                    ),
                    array(
                        'type' => 'colorpicker',
                        'heading' => esc_html__('Main Color', 'iguru'),
                        'param_name' => 'color',
                        'value' => $theme_color,
                        'edit_field_class' => 'vc_col-sm-6',
                    ),
                    array(
                        "type"          => "wgl_checkbox",
                        'heading' => esc_html__( 'Active Item', 'iguru' ),
                        "param_name"    => "active",
                        'edit_field_class' => 'vc_col-sm-6',
                    ),
					array(
						"type"			=> "attach_image",
						"heading"		=> esc_html__( 'Thumbnail', 'iguru' ),
						"param_name"	=> "bg_image",
					),
                ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Appear Animation', 'iguru' ),
                'param_name' => 'appear_anim',
                'edit_field_class' => 'vc_col-sm-6',
                'std' => 'true'
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'iguru'),
                'param_name' => 'extra_class',
                'description' => esc_html__('Add an extra class name to the element and refer to it from Custom CSS option.', 'iguru')
            ),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_wgl_Time_Line_Vertical extends WPBakeryShortCode {
        }
    }
}
