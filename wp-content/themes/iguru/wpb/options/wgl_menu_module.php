<?php

defined( 'ABSPATH' ) || exit;

if (function_exists( 'vc_map' )) {
    vc_map(array(
        'name' => esc_html__( 'Menu Module', 'iguru' ),
        'base' => 'wgl_menu_module',
        'class' => 'iguru_menu_module',
        'category' => esc_html__( 'WGL Modules', 'iguru' ),
        'content_element' => true,
        'description' => esc_html__( 'Display Menu Module','iguru' ),
        'params' => array(
            array(
                'type' => 'param_group',
                'heading' => esc_html__( 'Values', 'iguru' ),
                'param_name' => 'values',
                'description' => esc_html__( 'Specify values for each item - menu item and link.', 'iguru' ),
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Menu Item', 'iguru' ),
                        'param_name' => 'menu_item',
                        'edit_field_class' => 'vc_col-sm-5',
                    ),
                    array(
                        'type' => 'vc_link',
                        'heading' => esc_html__( 'Menu Link', 'iguru' ),
                        'param_name' => 'link',
                        'edit_field_class' => 'vc_col-sm-7 no-top-padding',
                    ),
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Menu Alignment', 'iguru' ),
                'param_name' => 'menu_alignment',
                'value' => array(
                    esc_html__( 'Left', 'iguru' ) => 'left',
                    esc_html__( 'Center', 'iguru' ) => 'center',
                    esc_html__( 'Right', 'iguru' ) => 'right',
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Icon font size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Menu Font Size', 'iguru' ),
                'param_name' => 'menu_size',
                'description' => esc_html__( 'Enter value in pixels.', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Menu colors
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Menu Colors', 'iguru' ),
                'param_name' => 'menu_color',
                'value' => $header_font_color,
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Icon hover colors
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Menu Hover Color', 'iguru' ),
                'param_name' => 'menu_hover_color',
                'value' => $theme_color,
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Menu Divider', 'iguru' ),
                'param_name' => 'add_menu_divider',
                'edit_field_class'  => 'vc_col-sm-3',
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'iguru' ),
                'param_name' => 'extra_class',
                'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'iguru' )
            ),
        )
    ));

    if (class_exists( 'WPBakeryShortCode' )) {
        class WPBakeryShortCode_wgl_menu_module extends WPBakeryShortCode {
        }
    }
}
