<?php

defined( 'ABSPATH' ) || exit;

$theme_color = esc_attr(iGuru_Theme_Helper::get_option('theme-custom-color'));
$theme_color_secondary = esc_attr(iGuru_Theme_Helper::get_option('theme-secondary-color'));
$header_font_color = esc_attr(iGuru_Theme_Helper::get_option('header-font')['color']);

if (function_exists( 'vc_map' )) {
    vc_map(array(
        'name' => esc_html__( 'Flip Box', 'iguru' ),
        'base' => 'wgl_flip_box',
        'class' => 'iguru_flip_box',
        'category' => esc_html__( 'WGL Modules', 'iguru' ),
        'icon' => 'wgl_icon_flip_box',
        'content_element' => true,
        'description' => esc_html__( 'Add Flip Box','iguru' ),
        'params' => array(
            // GENERAL TAB
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Flip Direction', 'iguru' ),
				'param_name' => 'fb_dir',
				'value' => array(
					esc_html__( 'Flip to Right', 'iguru' ) => 'flip_right',
					esc_html__( 'Flip to Left', 'iguru' ) => 'flip_left',
					esc_html__( 'Flip to Top', 'iguru' ) => 'flip_top',
					esc_html__( 'Flip to Bottom', 'iguru' ) => 'flip_bottom',
				),
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-6',
			),
            array(
                'type' => 'iguru_param_heading',
                'param_name' => 'divider_1',
                'edit_field_class' => 'divider',
            ),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Alignment', 'iguru' ),
				'param_name' => 'fb_align',
				'value' => array(
					esc_html__( 'Left', 'iguru' ) => 'left',
					esc_html__( 'Center', 'iguru' ) => 'center',
					esc_html__( 'Right', 'iguru' ) => 'right',
				),
				'std' => 'center',
				'edit_field_class' => 'vc_col-sm-6',
			),
            array(
                'type' => 'iguru_param_heading',
                'param_name' => 'divider_2',
                'edit_field_class' => 'divider',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Flip Box Height', 'iguru' ),
                'param_name' => 'fb_height',
                'value' => '',
                'description' => esc_html__( 'Enter value in pixels.', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'iguru' ),
                'param_name' => 'extra_class',
                'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'iguru' )
            ),
            // FRONT SIDE TAB
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__( 'Front Side Background', 'iguru' ),
                'param_name' => 'h_front_bg',
                'group' => esc_html__( 'Front Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Customize', 'iguru' ),
                'param_name' => 'front_bg_style',
                'value' => array(
                    esc_html__( 'Color', 'iguru' ) => 'front_color',
                    esc_html__( 'Image', 'iguru' ) => 'front_image',
                ),
                'group' => esc_html__( 'Front Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Color', 'iguru' ),
                'param_name' => 'front_bg_color',
                'value' => '',
                'dependency' => array(
                    'element' => 'front_bg_style',
                    'value' => 'front_color'
                ),
                'group' => esc_html__( 'Front Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Background Image', 'iguru' ),
                'param_name' => 'front_bg_image',
                'description' => esc_html__( 'Select image from media library.', 'iguru' ),
                'dependency' => array(
                    'element' => 'front_bg_style',
                    'value' => 'front_image'
                ),
                'group' => esc_html__( 'Front Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__( 'Front Side Content', 'iguru' ),
                'param_name' => 'h_front_content',
                'group' => esc_html__( 'Front Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Logo Image', 'iguru' ),
				'param_name' => 'front_logo_image',
				'description' => esc_html__( 'Select image from media library.', 'iguru' ),
				'group' => esc_html__( 'Front Side', 'iguru' ),
			),
            // Subtitle
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Subtitle', 'iguru' ),
                'param_name' => 'front_subtitle',
                'group' => esc_html__( 'Front Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Subtitle color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Subtitle Color', 'iguru' ),
                'param_name' => 'front_subtitle_color',
                'value' => '',
                'group' => esc_html__( 'Front Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Subtitle font size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Subtitle Font Size', 'iguru' ),
                'param_name' => 'front_subtitle_font_size',
                'description' => esc_html__( 'Enter value in pixels.', 'iguru' ),
                'group' => esc_html__( 'Front Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Title
            array(
                'type' => 'textarea',
                'heading' => esc_html__( 'Title', 'iguru' ),
                'param_name' => 'front_title',
                'group' => esc_html__( 'Front Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Title color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Title Color', 'iguru' ),
                'param_name' => 'front_title_color',
                'value' => '',
                'group' => esc_html__( 'Front Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Title font size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Title Font Size', 'iguru' ),
                'param_name' => 'front_title_font_size',
                'description' => esc_html__( 'Enter value in pixels.', 'iguru' ),
                'group' => esc_html__( 'Front Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Description
            array(
                'type' => 'textarea',
                'heading' => esc_html__( 'Description', 'iguru' ),
                'param_name' => 'front_descr',
                'group' => esc_html__( 'Front Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Description color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Description Color', 'iguru' ),
                'param_name' => 'front_descr_color',
                'value' => '',
                'group' => esc_html__( 'Front Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Description font size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Description Font Size', 'iguru' ),
                'param_name' => 'front_descr_font_size',
                'description' => esc_html__( 'Enter value in pixels.', 'iguru' ),
                'group' => esc_html__( 'Front Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // BACK SIDE TAB
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__( 'Back Side Background', 'iguru' ),
                'param_name' => 'h_back_bg',
                'group' => esc_html__( 'Back Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Customize', 'iguru' ),
                'param_name' => 'back_bg_style',
                'value' => array(
                    esc_html__( 'Color', 'iguru' ) => 'back_color',
                    esc_html__( 'Image', 'iguru' ) => 'back_image',
                ),
                'group' => esc_html__( 'Back Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Color', 'iguru' ),
                'param_name' => 'back_bg_color',
                'value' => '',
                'dependency' => array(
                    'element' => 'back_bg_style',
                    'value' => 'back_color'
                ),
                'group' => esc_html__( 'Back Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Background Image', 'iguru' ),
                'param_name' => 'back_bg_image',
                'description' => esc_html__( 'Select image from media library.', 'iguru' ),
                'dependency' => array(
                    'element' => 'back_bg_style',
                    'value' => 'back_image'
                ),
                'group' => esc_html__( 'Back Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__( 'Back Side Content', 'iguru' ),
                'param_name' => 'h_back_title',
                'group' => esc_html__( 'Back Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Logo Image', 'iguru' ),
				'param_name' => 'add_back_logo_image',
				'group' => esc_html__( 'Back Side', 'iguru' ),
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Logo Image', 'iguru' ),
				'param_name' => 'back_logo_image',
				'description' => esc_html__( 'Select image from media library.', 'iguru' ),
				'dependency' => array(
					'element' => 'add_back_logo_image',
					'value' => 'true'
				),
				'group' => esc_html__( 'Back Side', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-9',
			),
            array(
                'type' => 'textfield',
                'param_name' => 'back_title',
                'heading' => esc_html__( 'Title', 'iguru' ),
                'group' => esc_html__( 'Back Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-8',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Title Color', 'iguru' ),
                'param_name' => 'back_title_color',
                'value' => '',
                'group' => esc_html__( 'Back Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'textarea',
                'param_name' => 'back_descr',
                'heading' => esc_html__( 'Content', 'iguru' ),
                'group' => esc_html__( 'Back Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-8',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Content Color', 'iguru' ),
                'param_name' => 'back_descr_color',
                'value' => '',
                'group' => esc_html__( 'Back Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__( 'Back Side Button', 'iguru' ),
                'param_name' => 'h_back_button',
                'group' => esc_html__( 'Back Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add \'Read More\' Button', 'iguru' ),
                'param_name' => 'add_read_more',
                'group' => esc_html__( 'Back Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Button Text', 'iguru' ),
                'param_name' => 'read_more_text',
                'value' => esc_html__( 'View More', 'iguru' ),
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Back Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Button Color Idle', 'iguru' ),
                'param_name' => 'read_more_color_idle',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Back Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Button Color Hover', 'iguru' ),
                'param_name' => 'read_more_color_hover',
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Back Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__( 'Link', 'iguru' ),
                'param_name' => 'link',
                'description' => esc_html__( 'Add link to \'Read more\' button.', 'iguru' ),
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Back Side', 'iguru' ),
            ),
            // SPACING TAB
            // Front side positioning
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Front Side Positioning', 'iguru' ),
				'param_name' => 'h_front_positioning',
				'group' => esc_html__( 'Spacings', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			array(
				'type' => 'css_editor',
				'param_name' => 'front_offsets',
				'group' => esc_html__( 'Spacings', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12 wgl_css_editor',
			),
			// Back side positioning
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Back Side Positioning', 'iguru' ),
				'param_name' => 'h_back_positioning',
				'group' => esc_html__( 'Spacings', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			array(
				'type' => 'css_editor',
				'param_name' => 'back_offsets',
				'group' => esc_html__( 'Spacings', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12 wgl_css_editor',
			),
        )
    ));

    if ( class_exists('WPBakeryShortCode') ) {
        class WPBakeryShortCode_wgl_Flip_Box extends WPBakeryShortCode {
        }
    }
}