<?php

$theme_color = esc_attr(iGuru_Theme_Helper::get_option('theme-custom-color'));
$secondary_color = esc_attr(iGuru_Theme_Helper::get_option('theme-secondary-color'));

if ( function_exists( 'vc_map' ) ) {
    vc_map( [
        'base' => 'wgl_carousel',
        'name' => esc_html__( 'Carousel', 'iguru' ),
		'class' => 'iguru_carousel_module',
        'content_element' => true,      
        'category' => esc_html__( 'WGL Modules', 'iguru' ),
        'icon' => 'wgl_icon_carousel',
        'show_settings_on_create' => true,
        'is_container' => true,
		'as_parent' => [ 'only' => 'wgl_counter, wgl_button, vc_column_text, wgl_pricing_table, wgl_info_box, wgl_custom_text, vc_single_image, vc_tta_tabs, vc_tta_tour, vc_tta_accordion, vc_images_carousel, vc_gallery, vc_message, vc_row, wgl_flip_box' ],
        'params' => [
            // GENERAL TAB
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Columns Amount', 'iguru' ),
				'param_name' => 'slide_to_show',
				'value' => [
					esc_html__( '1', 'iguru' ) => '1',
					esc_html__( '2', 'iguru' ) => '2',
					esc_html__( '3', 'iguru' ) => '3',
					esc_html__( '4', 'iguru' ) => '4',
					esc_html__( '5', 'iguru' ) => '5',
					esc_html__( '6', 'iguru' ) => '6',
				],
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
			    'type' => 'iguru_param_heading',
			    'param_name' => 'divider_1',
			    'edit_field_class' => 'divider',
			),
			array(
			    'type' => 'textfield',
			    'heading' => esc_html__( 'Animation Speed', 'iguru' ),
			    'param_name' => 'speed',
			    'value' => '300',
			    'description' => esc_html__( 'Value in milliseconds.', 'iguru' ),
			    'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Autoplay', 'iguru' ),
				'param_name' => 'autoplay',
				'value' => 'true',
				'edit_field_class' => 'vc_col-sm-2',
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
				'edit_field_class' => 'vc_col-sm-3',
			),
            array(
                'type' => 'iguru_param_heading',
                'param_name' => 'divider_2',
                'edit_field_class' => 'divider',
            ),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Slide One Item per time', 'iguru' ),
				'param_name' => 'slides_to_scroll',
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Infinite loop sliding', 'iguru' ),
				'param_name' => 'infinite',
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Adaptive Height', 'iguru' ),
				'param_name' => 'adaptive_height',
				'edit_field_class' => 'vc_col-sm-2',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Fade Animation', 'iguru' ),
				'param_name' => 'fade_animation',
				'dependency' => [
					'element' => 'slide_to_show',
					'value' => '1'
				],
				'edit_field_class' => 'vc_col-sm-3',
			),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'iguru' ),
                'param_name' => 'extra_class',
                'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'iguru' )
            ),
            // NAVIGATION TAB
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__( 'Pagination Controls', 'iguru' ),
                'param_name' => 'h_pag_controls',
                'group' => esc_html__( 'Navigation', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Pagination control', 'iguru' ),
                'param_name' => 'use_pagination',
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
                'group' => esc_html__( 'Navigation', 'iguru' ),
                'std' => 'true'
            ),
            array(
                'type' => 'iguru_radio_image',
                'heading' => esc_html__( 'Pagination Type', 'iguru' ),
                'param_name' => 'pag_type',
                'fields' => [
                    'circle' => [
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_circle.png',
                        'label' => esc_html__( 'Circle', 'iguru' )
                    ],
                    'circle_border' => [
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_circle_border.png',
                        'label' => esc_html__( 'Empty Circle', 'iguru' )
                    ],
                    'square' => [
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_square.png',
                        'label' => esc_html__( 'Square', 'iguru' )
                    ],
                    'line' => [
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_line.png',
                        'label' => esc_html__( 'Line', 'iguru' )
                    ],
                    'line_circle' => [
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_line_circle.png',
                        'label' => esc_html__( 'Line - Circle', 'iguru' )
                    ],
                ],
                'value' => 'circle',
                'dependency' => [
                    'element' => 'use_pagination',
                    'value' => 'true',
                ],
                'group' => esc_html__( 'Navigation', 'iguru' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Pagination Aligning', 'iguru' ),
                'param_name' => 'pag_align',
                'value' => [
                    esc_html__( 'Left', 'iguru' ) => 'left',
                    esc_html__( 'Right', 'iguru' ) => 'right',
                    esc_html__( 'Center', 'iguru' ) => 'center',
                ],
                'std' => 'center',
                'dependency' => [
                    'element' => 'use_pagination',
                    'value' => 'true',
                ],
                'group' => esc_html__( 'Navigation', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Pagination Top Offset', 'iguru' ),
                'param_name' => 'pag_offset',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'iguru' ),
                'dependency' => [
                    'element' => 'use_pagination',
                    'value' => 'true',
                ],
                'group' => esc_html__( 'Navigation', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_3',
				'group' => esc_html__( 'Navigation', 'iguru' ),
				'edit_field_class' => 'divider',
			),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom Pagination Color', 'iguru' ),
                'param_name' => 'custom_pag_color',
                'dependency' => [
                    'element' => 'use_pagination',
                    'value' => 'true',
                ],
                'edit_field_class' => 'vc_col-sm-3',
                'group' => esc_html__( 'Navigation', 'iguru' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Pagination Color', 'iguru' ),
                'param_name' => 'pag_color',
                'value' => $theme_color,
                'dependency' => [
                    'element' => 'custom_pag_color',
                    'value' => 'true'
                ],
                'group' => esc_html__( 'Navigation', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // carousel prev/next heading
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__( 'Prev/Next Buttons', 'iguru' ),
                'param_name' => 'h_prev_buttons',
                'group' => esc_html__( 'Navigation', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Prev/Next buttons', 'iguru' ),
                'param_name' => 'use_prev_next',
                'group' => esc_html__( 'Navigation', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),            
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom offset', 'iguru' ),
                'param_name' => 'custom_prev_next_offset',
                 'dependency' => [
                    'element' => 'use_prev_next',
                    'value' => 'true',
                ],
                'edit_field_class' => 'vc_col-sm-2',
                'group' => esc_html__( 'Navigation', 'iguru' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Buttons Top Offset', 'iguru' ),
                'param_name' => 'prev_next_offset',
                'value' => '50%',
                'description' => esc_html__( 'Value in percentages.', 'iguru' ),
                'dependency' => [
                    'element' => 'custom_prev_next_offset',
                    'value' => 'true',
                ],
                'group' => esc_html__( 'Navigation', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_4',
				'group' => esc_html__( 'Navigation', 'iguru' ),
				'edit_field_class' => 'divider',
			),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Colors', 'iguru' ),
                'param_name' => 'custom_prev_next_color',
                'dependency' => [
                    'element' => 'use_prev_next',
                    'value' => 'true',
                ],
                'group' => esc_html__( 'Navigation', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_5',
				'group' => esc_html__( 'Navigation', 'iguru' ),
				'edit_field_class' => 'divider',
			),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Arrows Idle', 'iguru' ),
                'param_name' => 'prev_next_color',
                'value' => '#ffffff',
                'dependency' => [
                    'element' => 'custom_prev_next_color',
                    'value' => 'true'
                ],
                'group' => esc_html__( 'Navigation', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Arrows Hover', 'iguru' ),
                'param_name' => 'prev_next_color_hover',
                'value' => '#ffffff',
                'dependency' => [
                    'element' => 'custom_prev_next_color',
                    'value' => 'true'
                ],
                'group' => esc_html__( 'Navigation', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_6',
				'group' => esc_html__( 'Navigation', 'iguru' ),
				'edit_field_class' => 'divider',
			),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Buttons Background Idle', 'iguru' ),
                'param_name' => 'prev_next_bg_idle',
                'value' => $secondary_color,
                'dependency' => [
                    'element' => 'custom_prev_next_color',
                    'value' => 'true'
                ],
                'group' => esc_html__( 'Navigation', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Buttons Background Hover', 'iguru' ),
                'param_name' => 'prev_next_bg_hover',
                'value' => $secondary_color,
                'dependency' => [
                    'element' => 'custom_prev_next_color',
                    'value' => 'true'
                ],
                'group' => esc_html__( 'Navigation', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // RESPONSIVE TAB
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Responsive', 'iguru' ),
                'param_name' => 'custom_resp',
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
                'group' => esc_html__( 'Responsive', 'iguru' ),
            ),
            // Desktop breakpoint
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
                'group' => esc_html__( 'Responsive', 'iguru' ),
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
                'group' => esc_html__( 'Responsive', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'iguru_param_heading',
                'param_name' => 'divider_7',
                'group' => esc_html__( 'Responsive', 'iguru' ),
                'edit_field_class' => 'divider',
            ),
            // Tablet breakpoint
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
                'group' => esc_html__( 'Responsive', 'iguru' ),
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
                'group' => esc_html__( 'Responsive', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'iguru_param_heading',
                'param_name' => 'divider_8',
                'group' => esc_html__( 'Responsive', 'iguru' ),
                'edit_field_class' => 'divider',
            ),
            // Mobile breakpoint
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
                'group' => esc_html__( 'Responsive', 'iguru' ),
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
                'group' => esc_html__( 'Responsive', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),			
        ],
		'js_view' => 'VcColumnView'
    ]);


    if (class_exists( 'WPBakeryShortCodesContainer' )) {
        class WPBakeryShortCode_wgl_carousel extends WPBakeryShortCodesContainer {}
    }
}