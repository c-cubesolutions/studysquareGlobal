<?php

defined( 'ABSPATH' ) || exit;

$theme_color = esc_attr(iGuru_Theme_Helper::get_option( 'theme-custom-color' ));

if (function_exists( 'vc_map' )) {
    vc_map(array(
        'name' => esc_html__( 'Message Box', 'iguru' ),
        'base' => 'wgl_message_box',
        'class' => 'iguru_message_box',
        'category' => esc_html__( 'WGL Modules', 'iguru' ),
        'icon' => 'wgl_icon_message_box',
        'content_element' => true,
        'description' => esc_html__( 'Message Box','iguru' ),
        'params' => array(
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Message Type', 'iguru' ),
                'param_name' => 'type',
                'value' => array(
                    esc_html__( 'Informational', 'iguru' ) => 'info',
                    esc_html__( 'Success', 'iguru' ) => 'success',
                    esc_html__( 'Warning', 'iguru' ) => 'warning',
                    esc_html__( 'Error', 'iguru' ) => 'error',
                    esc_html__( 'Custom', 'iguru' ) => 'custom',
                ),              
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'iguru' ),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-adjust',
                'settings' => array(
                    'emptyIcon' => false,
                    'iconsPerPage' => 200,
                ),
                'description' => esc_html__( 'Select icon from library.', 'iguru' ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'custom'
                ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Message Color', 'iguru' ),
                'param_name' => 'icon_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'custom'
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Title', 'iguru' ),
                'param_name' => 'title',
                'admin_label' => true,
            ),  
            array(
                'type' => 'textarea',
                'heading' => esc_html__( 'Text', 'iguru' ),
                'param_name' => 'text',
            ),       
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Closable?', 'iguru' ),
                'param_name' => 'closable',
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'iguru' ),
                'param_name' => 'extra_class',
                'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'iguru' )
            ),
            // TYPOGRAPHY TAB
            // Title styles heading
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__( 'Title Styles', 'iguru' ),
                'param_name' => 'h_title_styles',
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'custom'
                ),
                'group' => esc_html__( 'Typography', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Title Tag', 'iguru' ),
                'param_name' => 'title_tag',
                'value' => array(
                    esc_html__( '‹div›', 'iguru' ) => 'div',
                    esc_html__( '‹span›', 'iguru' ) => 'span',
                    esc_html__( '‹h2›', 'iguru' ) => 'h2',
                    esc_html__( '‹h3›', 'iguru' ) => 'h3',
                    esc_html__( '‹h4›', 'iguru' ) => 'h4',
                    esc_html__( '‹h5›', 'iguru' ) => 'h5',
                    esc_html__( '‹h6›', 'iguru' ) => 'h6',
                ),
                'std' => 'h4',
                'description' => esc_html__( 'Custom HTML tag.', 'iguru' ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'custom'
                ),
                'group' => esc_html__( 'Typography', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Title font size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Title Font Size', 'iguru' ),
                'param_name' => 'title_size',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'iguru' ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'custom'
                ),
                'group' => esc_html__( 'Typography', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Title fonts
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize font family', 'iguru' ),
                'param_name' => 'custom_fonts_title',
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'custom'
                ),
                'group' => esc_html__( 'Typography', 'iguru' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_title',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_fonts_title',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Typography', 'iguru' ),
            ),
            // title color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Color', 'iguru' ),
                'param_name' => 'custom_title_color',
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'custom'
                ),
                'group' => esc_html__( 'Typography', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // title color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Title Color', 'iguru' ),
                'param_name' => 'title_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'custom_title_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Typography', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // text styles heading
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__( 'Text Styles', 'iguru' ),
                'param_name' => 'h_text_styles',
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'custom'
                ),
                'group' => esc_html__( 'Typography', 'iguru' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Text Tag', 'iguru' ),
                'param_name' => 'text_tag',
                'value' => array(
                    esc_html__( '‹div›', 'iguru' ) => 'div',
                    esc_html__( '‹span›', 'iguru' ) => 'span',
                    esc_html__( '‹h2›', 'iguru' ) => 'h2',
                    esc_html__( '‹h3›', 'iguru' ) => 'h3',
                    esc_html__( '‹h4›', 'iguru' ) => 'h4',
                    esc_html__( '‹h5›', 'iguru' ) => 'h5',
                    esc_html__( '‹h6›', 'iguru' ) => 'h6',
                ),
                'std' => 'div',
                'description' => esc_html__( 'Custom html tag.', 'iguru' ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'custom'
                ),
                'group' => esc_html__( 'Typography', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Text font size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Text Font Size', 'iguru' ),
                'param_name' => 'text_size',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'iguru' ),
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'custom'
                ),
                'group' => esc_html__( 'Typography', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Text fonts
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize font family', 'iguru' ),
                'param_name' => 'custom_fonts_text',
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'custom'
                ),
                'group' => esc_html__( 'Typography', 'iguru' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_text',
                'value' => '',
                'dependency' => array(
                    'element' => 'custom_fonts_text',
                    'value' => 'true',
                ),
                'group' => esc_html__( 'Typography', 'iguru' ),
            ),
            // text color checkbox
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Color', 'iguru' ),
                'param_name' => 'custom_text_color',
                'dependency' => array(
                    'element' => 'type',
                    'value' => 'custom'
                ),
                'group' => esc_html__( 'Typography', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Text color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Text Color', 'iguru' ),
                'param_name' => 'text_color',
                'value' => '#000000',
                'description' => esc_html__( 'Select text color', 'iguru' ),
                'dependency' => array(
                    'element' => 'custom_text_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Typography', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),             
        )
    ));
    
    if (class_exists( 'WPBakeryShortCode' )) {
        class WPBakeryShortCode_wgl_message_box extends WPBakeryShortCode {}
    } 
}
