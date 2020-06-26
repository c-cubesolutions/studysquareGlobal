<?php

$theme_secondary_color = esc_attr(iGuru_Theme_Helper::get_option("theme-secondary-color"));

if (function_exists('vc_map')) {
    vc_map(array(		
		
        'base' => 'wgl_split_slider',
        'name' => esc_html__('Vertical Split Slider', 'iguru'),
		'class' => 'iguru_split_slider_module',
        'content_element' => true,      
        'category' => esc_html__('WGL Modules', 'iguru'),
        'icon' => 'wgl_icon_split_slider',
        'show_settings_on_create' => true,
        'is_container' => true,
		'as_parent' => array('only' => 'wgl_split_slider_left, wgl_split_slider_right'),
        'params' => array(
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__('Prev/Next Buttons', 'iguru'),
                'param_name' => 'h_buttons',
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Prev/Next buttons', 'iguru' ),
                'param_name' => 'use_prev_next',
                'edit_field_class' => 'vc_col-sm-12',
                'std'  => 'true'
            ),            
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom offset', 'iguru' ),
                'param_name' => 'custom_prev_next_offset',
                'edit_field_class' => 'vc_col-sm-12',
                 'dependency' => array(
                    'element' => 'use_prev_next',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Pagination Top Offset', 'iguru' ),
                'param_name' => 'prev_next_offset',
                'value' => '50%',
                'edit_field_class' => 'vc_col-sm-8',
                'description' => esc_html__( 'Enter buttons top offset in percentages.', 'iguru' ),
                'dependency' => array(
                    'element' => 'custom_prev_next_offset',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'iguru_param_heading',
                'param_name' => 'h_buttons',
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
                'dependency' => array(
                    'element' => 'use_prev_next',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom Buttons Color', 'iguru' ),
                'param_name' => 'custom_prev_next_color',
                'edit_field_class' => 'vc_col-sm-4',
                'dependency' => array(
                    'element' => 'use_prev_next',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Buttons Color', 'iguru'),
                'param_name' => 'active_color',
                'value' => $theme_secondary_color,
                'dependency' => array(
                    'element' => 'custom_prev_next_color',
                    'value' => 'true'
                ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'iguru'),
                'param_name' => 'extra_class',
                'description' => esc_html__('Add an extra class name to the element and refer to it from Custom CSS option.', 'iguru')
            )			
        ),
		'js_view' => 'VcColumnView'
    ));


    if (class_exists('WPBakeryShortCodesContainer')) {
        class WPBakeryShortCode_wgl_split_slider extends WPBakeryShortCodesContainer {}
    }
}