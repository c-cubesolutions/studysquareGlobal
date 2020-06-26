<?php

defined( 'ABSPATH' ) || exit;

if ( function_exists( 'vc_map' ) ) {
    vc_map( array(
        'name' => esc_html__( 'Clients', 'iguru' ),
        'base' => 'wgl_clients',
        'class' => 'iguru_clients',
        'category' => esc_html__( 'WGL Modules', 'iguru' ),
        'icon' => 'wgl_icon_clients',
        'content_element' => true,
        'description' => esc_html__( 'Display Clients', 'iguru' ),
        'params' => [
            // GENERAL TAB
            array(
                'type' => 'param_group',
                'heading' => esc_html__( 'Values', 'iguru' ),
                'param_name' => 'values',
                'description' => esc_html__( 'Specify values for each item - thumbnail(s) and link.', 'iguru' ),
                'params' => [
                    [
                        'type' => 'attach_image',
                        'heading' => esc_html__( 'Thumbnail', 'iguru' ),
                        'param_name' => 'thumbnail',
                        'edit_field_class' => 'vc_col-sm-5',
                    ],
                    [
                        'type' => 'attach_image',
                        'heading' => esc_html__( 'Hover Thumbnail', 'iguru' ),
                        'param_name' => 'hover_thumbnail',
                        'description' => esc_html__( 'Need for \'Exchange Images\' and \'Shadow\' animations only.', 'iguru' ),
                        'edit_field_class' => 'vc_col-sm-6 no-top-padding',
                    ],
                    [
                        'type' => 'wgl_checkbox',
                        'heading' => esc_html__( 'Add Link', 'iguru' ),
                        'param_name' => 'add_link',
                        'edit_field_class' => 'vc_col-sm-12',
                    ],
                    [
                        'type' => 'vc_link',
                        'heading' => esc_html__( 'Link', 'iguru' ),
                        'param_name' => 'link',
                        'description' => esc_html__( 'Add link to client image.', 'iguru' ),
                        'dependency' => [
                            'element' => 'add_link',
                            'value' => 'true'
                        ],
                    ],
                ],
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Grid Columns Amount', 'iguru' ),
                'param_name' => 'item_grid',
                'value' => [
                    esc_html__( '1 Column', 'iguru' ) => '1',
                    esc_html__( '2 Columns', 'iguru' ) => '2',
                    esc_html__( '3 Columns', 'iguru' ) => '3',
                    esc_html__( '4 Columns', 'iguru' ) => '4',
                    esc_html__( '5 Columns', 'iguru' ) => '5',
                    esc_html__( '6 Columns', 'iguru' ) => '6',
                ],
                'std' => '4',
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Thumbnail Animation', 'iguru' ),
                'param_name' => 'item_anim',
                'value' => [
                    esc_html__( 'Grayscale', 'iguru' ) => 'grayscale',
                    esc_html__( 'Opacity', 'iguru' ) => 'opacity',
                    esc_html__( 'Shadow', 'iguru' ) => 'shadow',
                    esc_html__( 'Zoom', 'iguru' ) => 'zoom',
                    esc_html__( 'Contrast', 'iguru' ) => 'contrast',
                    esc_html__( 'Blur', 'iguru' ) => 'blur',
                    esc_html__( 'Invert', 'iguru' ) => 'invert',
                    esc_html__( 'Exchange Images', 'iguru' ) => 'ex_images',
                ],
                'admin_label' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'iguru' ),
                'param_name' => 'extra_class',
                'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'iguru' )
            ),
            // CAROUSEl TAB
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Use Carousel', 'iguru' ),
                'param_name' => 'use_carousel',
                'group' => esc_html__( 'Carousel', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Autoplay', 'iguru' ),
                'param_name' => 'autoplay',
                'dependency' => [
                    'element' => 'use_carousel',
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
                'heading' => esc_html__( 'Responsive Settings', 'iguru' ),
                'param_name' => 'h_resp',
                'dependency' => [
                    'element' => 'use_carousel',
                    'value' => 'true'
                ],
                'group' => esc_html__( 'Carousel', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Responsive', 'iguru' ),
                'param_name' => 'custom_resp',
                'dependency' => [
                    'element' => 'use_carousel',
                    'value' => 'true'
                ],
                'group' => esc_html__( 'Carousel', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            // Desktop resolution
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Desktop Screen Breakpoint', 'iguru' ),
                'param_name' => 'resp_medium',
                'value' => '1025',
                'description' => esc_html__( 'Value in pixels.', 'iguru' ),
                'dependency' => [
                    'element' => 'custom_resp',
                    'value' => 'true',
                ],
                'group' => esc_html__( 'Carousel', 'iguru' ),
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
                'group' => esc_html__( 'Carousel', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'iguru_param_heading',
                'param_name' => 'divider_1',
                'group' => esc_html__( 'Carousel', 'iguru' ),
                'edit_field_class' => 'divider',
            ),
            // Tablets resolution
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Tablet Screen Breakpoint', 'iguru' ),
                'param_name' => 'resp_tablets',
                'value' => '800',
                'description' => esc_html__( 'Value in pixels.', 'iguru' ),
                'dependency' => [
                    'element' => 'custom_resp',
                    'value' => 'true',
                ],
                'group' => esc_html__( 'Carousel', 'iguru' ),
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
                'group' => esc_html__( 'Carousel', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'iguru_param_heading',
                'param_name' => 'divider_2',
                'group' => esc_html__( 'Carousel', 'iguru' ),
                'edit_field_class' => 'divider',
            ),
            // Mobile resolution
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Mobile Screen Breakpoint', 'iguru' ),
                'param_name' => 'resp_mobile',
                'value' => '480',
                'description' => esc_html__( 'Value in pixels.', 'iguru' ),
                'dependency' => [
                    'element' => 'custom_resp',
                    'value' => 'true',
                ],
                'group' => esc_html__( 'Carousel', 'iguru' ),
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
                'group' => esc_html__( 'Carousel', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
        ]
    ));

    if (class_exists( 'WPBakeryShortCode' )) {
        class WPBakeryShortCode_wgl_Clients extends WPBakeryShortCode {}
    }
}
