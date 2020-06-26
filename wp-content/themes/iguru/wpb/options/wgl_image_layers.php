<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

if (function_exists('vc_map')) {
    vc_map(array(
        'name' => esc_html__('Image Layers', 'iguru'),
        'base' => 'wgl_image_layers',
        'class' => 'iguru_image_layers',
        'category' => esc_html__('WGL Modules', 'iguru'),
        'icon' => 'wgl_icon_image_layers',
        'content_element' => true,
        'description' => esc_html__('Display Image Layers','iguru'),
        'params' => array(
            // image styles heading
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__('Layers Settings', 'iguru'),
                'param_name' => 'h_settings',
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'param_group',
                'heading' => esc_html__( 'Values', 'iguru' ),
                'param_name' => 'values',
                'description' => esc_html__( 'Enter values for graph', 'iguru' ),
                'params' => array(
                    array(
                        'type'          => 'attach_image',
                        'heading'       => esc_html__( 'Thumbnail', 'iguru' ),
                        'param_name'    => 'thumbnail',
                    ),
                    array(
                        'type'          => 'textfield',
                        'heading'       => esc_html__( 'Top Offset', 'iguru' ),
                        'param_name'    => 'top_offset',
                        'edit_field_class' => 'vc_col-sm-6',
                        'description' => esc_html__( 'Enter offset in %, for example -100% or 100%', 'iguru' ),
                    ),
                    array(
                        'type'          => 'textfield',
                        'heading'       => esc_html__( 'Left Offset', 'iguru' ),
                        'param_name'    => 'left_offset',
                        'edit_field_class' => 'vc_col-sm-6',
                        'description' => esc_html__( 'Enter offset in %, for example -100% or 100%', 'iguru' ),
                    ),          
                    array(
                        'type'          => 'dropdown',
                        'heading'       => esc_html__( 'Image Animation', 'iguru' ),
                        'param_name'    => 'image_animation',
                        'edit_field_class' => 'vc_col-sm-6',
                        'value'         => array(
                            esc_html__( 'Fade In', 'iguru' )      => 'fade_in',
                            esc_html__( 'Slide Up', 'iguru' )      => 'slide_up',
                            esc_html__( 'Slide Down', 'iguru' )     => 'slide_down',
                            esc_html__( 'Slide Left', 'iguru' )     => 'slide_left',
                            esc_html__( 'Slide Right', 'iguru' )     => 'slide_right',
                            esc_html__( 'Slide Big Up', 'iguru' )      => 'slide_big_up',
                            esc_html__( 'Slide Big Down', 'iguru' )     => 'slide_big_down',
                            esc_html__( 'Slide Big Left', 'iguru' )     => 'slide_big_left',
                            esc_html__( 'Slide Big Right', 'iguru' )     => 'slide_big_right',
                            esc_html__( 'Slide Big Right', 'iguru' )     => 'slide_big_right',
                            esc_html__( 'Flip Horizontally', 'iguru' )     => 'flip_x',
                            esc_html__( 'Flip Vertically', 'iguru' )     => 'flip_y',
                            esc_html__( 'Zoom In', 'iguru' )     => 'zoom_in',
                        ),
                    ),         
                    array(
                        'type'          => 'textfield',
                        'heading'       => esc_html__( 'Image z-index', 'iguru' ),
                        'param_name'    => 'image_order',
                        'value'         => '1',
                        'edit_field_class' => 'vc_col-sm-6',
                    ),  
                ),
            ),
            // images interval
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Enter Interval Images Appearing', 'iguru'),
                'param_name' => 'interval',
                'value' => '600',
                'description' => esc_html__( 'Enter interval in milliseconds', 'iguru' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Enter Transition Speed', 'iguru'),
                'param_name' => 'transition',
                'value' => '800',
                'description' => esc_html__( 'Enter transition speed in milliseconds', 'iguru' ),
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__( 'Link', 'iguru' ),
                'param_name' => 'link',
                'description' => esc_html__('Add link to button.', 'iguru')
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'iguru'),
                'param_name' => 'extra_class',
                'description' => esc_html__('Add an extra class name to the element and refer to it from Custom CSS option.', 'iguru')
            ),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_wgl_Image_Layers extends WPBakeryShortCode {
        }
    }
}
