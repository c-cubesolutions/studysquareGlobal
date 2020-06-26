<?php

defined( 'ABSPATH' ) || exit;

$theme_color = esc_attr(iGuru_Theme_Helper::get_option('theme-custom-color'));
$theme_secondary_color = esc_attr(iGuru_Theme_Helper::get_option('theme-secondary-color'));
$header_font_color = esc_attr(iGuru_Theme_Helper::get_option('header-font')['color']);

if (function_exists( 'vc_map' )) {
    vc_map(array(
        'name' => esc_html__( 'Countdown Timer', 'iguru' ),
        'base' => 'wgl_countdown',
        'class' => 'iguru_countdown',
        'content_element' => true,
        'description' => esc_html__( 'Countdown','iguru' ),
        'category' => esc_html__( 'WGL Modules', 'iguru' ),
        'icon' => 'wgl_icon_countdown',
        'params' => array(
            // GENERAL TAB
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__( 'Countdown to this date:', 'iguru' ),
                'param_name' => 'h_date',
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Year', 'iguru' ),
                'param_name' => 'countdown_year',
                'description' => esc_html__( 'Example: 2020', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Month', 'iguru' ),
                'param_name' => 'countdown_month',
                'description' => esc_html__( 'Example: 12', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-2',
            ),            
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Day', 'iguru' ),
                'param_name' => 'countdown_day',
                'description' => esc_html__( 'Example: 31', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Hours', 'iguru' ),
                'param_name' => 'countdown_hours', 
                'description' => esc_html__( 'Example: 24', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Minutes', 'iguru' ),
                'param_name' => 'countdown_min',
                'description' => esc_html__( 'Example: 59', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-2',
            ), 
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__( 'Hidden Content', 'iguru' ),
                'param_name' => 'h_hide',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide Days?', 'iguru' ),
                'param_name' => 'hide_day',
                'edit_field_class' => 'vc_col-sm-2',
            ),            
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide Hours?', 'iguru' ),
                'param_name' => 'hide_hours',
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide Minutes?', 'iguru' ),
                'param_name' => 'hide_minutes',
                'edit_field_class' => 'vc_col-sm-2',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Hide Seconds?', 'iguru' ),
                'param_name' => 'hide_seconds',
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Show Value Names?', 'iguru' ),
                'param_name' => 'show_value_names',
                'value' => 'true',
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // STYLE TAB
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Countdown Size', 'iguru' ),
                'param_name' => 'size',
                'value' => array(
                    esc_html__( 'Large','iguru' ) => 'large',
                    esc_html__( 'Medium','iguru' ) => 'medium',
                    esc_html__( 'Small','iguru' ) => 'small',
                    esc_html__( 'Custom','iguru' ) => 'custom',
                ),
                'group' => esc_html__( 'Style', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Alignment', 'iguru' ),
                'param_name' => 'align',
                'value' => array(
                    esc_html__( 'Left', 'iguru' ) => 'left',
                    esc_html__( 'Center', 'iguru' ) => 'center',
                    esc_html__( 'Right', 'iguru' ) => 'right',
                ),
                'std' => 'center',
                'group' => esc_html__( 'Style', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3 no-top-padding',
            ),
            array(
                'type' => 'iguru_param_heading',
                'param_name' => 'divider_s_1',
                'group' => esc_html__( 'Style', 'iguru' ),
                'edit_field_class' => 'divider',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Font Size', 'iguru' ),
                'param_name' => 'font_size',
                'description' => esc_html__( 'Enter value in pixels.', 'iguru' ),
                'dependency' => array(
                    'element' => 'size',
                    'value' => 'custom',
                ),
                'group' => esc_html__( 'Style', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Number Font Size ', 'iguru' ),
                'param_name' => 'font_size_number',
                'description' => esc_html__( 'Enter value in em.', 'iguru' ),
                'dependency' => array(
                    'element' => 'size',
                    'value' => 'custom',
                ),
                'group' => esc_html__( 'Style', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),           
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Text Font Size ', 'iguru' ),
                'param_name' => 'font_size_text',
                'description' => esc_html__( 'Enter value in em.', 'iguru' ),
                'dependency' => array(
                    'element' => 'size',
                    'value' => 'custom',
                ),
                'group' => esc_html__( 'Style', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'iguru_param_heading',
                'param_name' => 'divider_s_2',
                'group' => esc_html__( 'Style', 'iguru' ),
                'edit_field_class' => 'divider',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Number Font Weight', 'iguru' ),
                'param_name' => 'font_weight',
                'description' => esc_html__( 'Select custom value.', 'iguru' ),
                'value' => array(
                    esc_html__( 'Theme Defaults', 'iguru' ) => '',
                    esc_html__( '300 / Light', 'iguru' ) => '300',
                    esc_html__( '400 / Regular', 'iguru' ) => '400',
                    esc_html__( '500 / Medium', 'iguru' ) => '500',
                    esc_html__( '600 / SemiBold', 'iguru' ) => '600',
                    esc_html__( '700 / Bold', 'iguru' ) => '700',
                    esc_html__( '800 / Extra-Bold', 'iguru' ) => '800',
                    esc_html__( '900 / Black', 'iguru' ) => '900',
                ),
                'group' => esc_html__( 'Style', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Text Font Weight', 'iguru' ),
                'param_name' => 'font_text_weight',
                'description' => esc_html__( 'Select custom value.', 'iguru' ),
                'value' => array(
                    esc_html__( 'Theme Defaults', 'iguru' ) => '',
                    esc_html__( '300 / Light', 'iguru' ) => '300',
                    esc_html__( '400 / Regular', 'iguru' ) => '400',
                    esc_html__( '500 / Medium', 'iguru' ) => '500',
                    esc_html__( '600 / SemiBold', 'iguru' ) => '600',
                    esc_html__( '700 / Bold', 'iguru' ) => '700',
                    esc_html__( '800 / Extra-Bold', 'iguru' ) => '800',
                    esc_html__( '900 / Black', 'iguru' ) => '900',
                ),
                'group' => esc_html__( 'Style', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'iguru_param_heading',
                'param_name' => 'divider_s_3',
                'group' => esc_html__( 'Style', 'iguru' ),
                'edit_field_class' => 'divider',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Values Color', 'iguru' ),
                'param_name' => 'values_color',
                'value' => $theme_color,
                'group' => esc_html__( 'Style', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ), 
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Value Names Color', 'iguru' ),
                'param_name' => 'value_names_color',
                'value' => $header_font_color,
                'dependency' => array(
                    'element' => 'show_value_names',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Style', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Separating Points Color', 'iguru' ),
                'param_name' => 'points_color',
                'value' => $theme_secondary_color,
                'group' => esc_html__( 'Style', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'iguru_param_heading',
                'param_name' => 'divider_s_4',
                'group' => esc_html__( 'Style', 'iguru' ),
                'edit_field_class' => 'divider',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize font family', 'iguru' ),
                'param_name' => 'custom_fonts_countdown',
                'group' => esc_html__( 'Style', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_countdown',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_fonts_countdown',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Style', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-9',
            ),
        )
    ));
    
    if (class_exists( 'WPBakeryShortCode' )) {
        class WPBakeryShortCode_wgl_countdown extends WPBakeryShortCode {}
    } 
}