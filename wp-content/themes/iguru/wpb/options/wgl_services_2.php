<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$theme_color = esc_attr(iGuru_Theme_Helper::get_option("theme-custom-color"));

if (function_exists('vc_map')) {
    // Add button
    vc_map(array(
        'name' => esc_html__('Services 2', 'iguru'),
        'base' => 'wgl_services_2',
        'class' => 'iguru_services_2',
        'category' => esc_html__('WGL Modules', 'iguru'),
        'icon' => 'wgl_icon_services_2',
        'content_element' => true,
        'description' => esc_html__('Add Services','iguru'),
        'params' => array(
            // General
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Custom Services Height', 'iguru'),
                'param_name' => 'custom_height',
                'value' => '',
                'description' => esc_html__( 'Enter custom services height in pixels.', 'iguru' ),
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__( 'Title', 'iguru' ),
                "param_name" => "title",
                'admin_label' => true,
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__( 'Subtitle', 'iguru' ),
                "param_name" => "subtitle",
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__('Logo Image', 'iguru'),
                'param_name' => 'logo_image',
                'description' => esc_html__( 'Select image from media library.', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__('Background Image', 'iguru'),
                'param_name' => 'bg_image',
                'description' => esc_html__( 'Select image from media library.', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__( 'Link', 'iguru' ),
                'param_name' => 'link',
                'description' => esc_html__('Add link to Service.', 'iguru')
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'iguru'),
                'param_name' => 'item_el_class',
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'iguru')
            ),
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__('Custom Colors', 'iguru'),
                'param_name' => 'h_custom_colors',
                'group' => esc_html__( 'Styles', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Title Color', 'iguru'),
                'param_name' => 'title_color',
                'value' => $theme_color,
                'group' => esc_html__( 'Styles', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Subtitle Color', 'iguru'),
                'param_name' => 'subtitle_color',
                'value' => '#ffffff',
                'group' => esc_html__( 'Styles', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_wgl_Services_2 extends WPBakeryShortCode {
        }
    }
}