<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$theme_color = esc_attr(iGuru_Theme_Helper::get_option("theme-custom-color"));

if (function_exists('vc_map')) {
    // Add button
    vc_map(array(
        'name' => esc_html__('Services', 'iguru'),
        'base' => 'wgl_services',
        'class' => 'iguru_services',
        'category' => esc_html__('WGL Modules', 'iguru'),
        'icon' => 'wgl_icon_services',
        'content_element' => true,
        'description' => esc_html__('Add Services','iguru'),
        'params' => array(
            // General
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Service Animation', 'iguru' ),
                'param_name' => 'service_anim',
                'value'         => array(
                    esc_html__( 'Fade', 'iguru' )      => 'fade',
                    esc_html__( 'Front Side Slide', 'iguru' )      => 'front_slide',
                    esc_html__( 'Back Side Slide', 'iguru' )      => 'back_slide',
                ),
                'admin_label' => true,
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Animation Direction', 'iguru' ),
                'param_name' => 'anim_dir',
                'value'         => array(
                    esc_html__( 'Slide to Right', 'iguru' )      => 'to_right',
                    esc_html__( 'Slide to Left', 'iguru' )      => 'to_left',
                    esc_html__( 'Slide to Top', 'iguru' )      => 'to_top',
                    esc_html__( 'Slide to Bottom', 'iguru' )      => 'to_bottom',
                ),
                'dependency' => array(
                    'element' => 'service_anim',
                    'value' => array('front_slide','back_slide'),
                ),
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Alignment', 'iguru' ),
                'param_name'    => 'service_align',
                'value'         => array(
					esc_html__( 'Left', 'iguru' )   => 'left',
					esc_html__( 'Center', 'iguru' ) => 'center',
					esc_html__( 'Right', 'iguru' )  => 'right',
                ),
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'iguru'),
                'param_name' => 'item_el_class',
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'iguru')
            ),
            // Front Side
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__('Front Side Background', 'iguru'),
                'param_name' => 'h_front_bg',
                'group' => esc_html__( 'Front Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'dropdown',
                'param_name' => 'front_bg_style',
                'value'         => array(
                    esc_html__( 'Frame', 'iguru' )      => 'front_frame',
                    esc_html__( 'Color', 'iguru' )      => 'front_color',
                    esc_html__( 'Image', 'iguru' )      => 'front_image',
                ),
                'group' => esc_html__( 'Front Side', 'iguru' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Frame Color', 'iguru'),
                'param_name' => 'front_frame_color',
                'value' => 'rgba(255,255,255,0.3)',
                'dependency' => array(
                    'element' => 'front_bg_style',
                    'value' => array('front_frame','front_color')
                ),
                'group' => esc_html__( 'Front Side', 'iguru' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Color', 'iguru'),
                'param_name' => 'front_bg_color',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'front_bg_style',
                    'value' => 'front_color'
                ),
                'group' => esc_html__( 'Front Side', 'iguru' ),
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__('Background Image', 'iguru'),
                'param_name' => 'front_bg_image',
                'description' => esc_html__( 'Select image from media library.', 'iguru' ),
                'dependency' => array(
                    'element' => 'front_bg_style',
                    'value' => 'front_image'
                ),
                'group' => esc_html__( 'Front Side', 'iguru' ),
            ),
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__('Front Side Icon', 'iguru'),
                'param_name' => 'h_front_content',
                'group' => esc_html__( 'Front Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            // Info Box Icon/Image
            array(
                'type'          => 'dropdown',
                'param_name'    => 'front_icon_type',
                'value'         => array(
                    esc_html__( 'None', 'iguru' )      => 'none',
                    esc_html__( 'Font', 'iguru' )      => 'font',
                    esc_html__( 'Image', 'iguru' )     => 'image',
                ),
                'save_always' => true,
                'group' => esc_html__( 'Front Side', 'iguru' ),
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'front_icon_font_type',
                'value'         => array(
                    esc_html__( 'Fontawesome', 'iguru' )      => 'type_fontawesome',
                    esc_html__( 'Flaticon', 'iguru' )      => 'type_flaticon',
                ),
                'save_always' => true,
                'group' => esc_html__( 'Front Side', 'iguru' ),
                'dependency' => array(
                    'element' => 'front_icon_type',
                    'value' => 'font',
                ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'iguru' ),
                'param_name' => 'icon_fontawesome',
                'value' => 'fa fa-adjust', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false,
                    // default true, display an 'EMPTY' icon?
                    'type' => 'fontawesome',
                    'iconsPerPage' => 200,
                    // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'description' => esc_html__( 'Select icon from library.', 'iguru' ),
                'dependency' => array(
                    'element' => 'front_icon_font_type',
                    'value' => 'type_fontawesome',
                ),
                'group' => esc_html__( 'Front Side', 'iguru' ),
            ),
            array(
                'type' => 'iconpicker',
                'heading' => esc_html__( 'Icon', 'iguru' ),
                'param_name' => 'icon_flaticon',
                'value' => '', // default value to backend editor admin_label
                'settings' => array(
                    'emptyIcon' => false,
                    // default true, display an 'EMPTY' icon?
                    'type' => 'flaticon',
                    'iconsPerPage' => 200,
                    // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                ),
                'description' => esc_html__( 'Select icon from library.', 'iguru' ),
                'dependency' => array(
                    'element' => 'front_icon_font_type',
                    'value' => 'type_flaticon',
                ),
                'group' => esc_html__( 'Front Side', 'iguru' ),
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Image', 'iguru' ),
                'param_name' => 'front_icon_thumbnail',
                'value' => '',
                'description' => esc_html__( 'Select image from media library.', 'iguru' ),
                'dependency' => array(
                    'element' => 'front_icon_type',
                    'value' => 'image',
                ),
                'group' => esc_html__( 'Front Side', 'iguru' ),
            ),
            // Custom image width
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Custom Image Width', 'iguru'),
                'param_name' => 'custom_image_width',
                'description' => esc_html__( 'Enter image size in pixels.', 'iguru' ),
                'group' => esc_html__( 'Front Side', 'iguru' ),
                'dependency' => array(
                    'element' => 'front_icon_type',
                    'value' => 'image',
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Custom image height
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Custom Image Height', 'iguru'),
                'param_name' => 'custom_image_height',
                'description' => esc_html__( 'Enter image size in pixels.', 'iguru' ),
                'group' => esc_html__( 'Front Side', 'iguru' ),
                'dependency' => array(
                    'element' => 'front_icon_type',
                    'value' => 'image',
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Custom icon size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Custom Icon Size', 'iguru'),
                'param_name' => 'custom_icon_size',
                'description' => esc_html__( 'Enter Icon size in pixels.', 'iguru' ),
                'group' => esc_html__( 'Front Side', 'iguru' ),
                'dependency' => array(
                    'element' => 'front_icon_type',
                    'value' => 'font',
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Icon Color', 'iguru'),
                'param_name' => 'front_icon_color',
                'value' => '#ffffff',
                'dependency' => array(
                    'element' => 'front_icon_type',
                    'value' => 'font',
                ),
                'group' => esc_html__( 'Front Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Front Side Title
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__('Front Side Title', 'iguru'),
                'param_name' => 'h_front_title',
                'group' => esc_html__( 'Front Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'textarea',
                'param_name' => 'front_title',
                'heading' => esc_html__('Title', 'iguru'),
                'group' => esc_html__( 'Front Side', 'iguru' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Title Color', 'iguru'),
                'param_name' => 'front_title_color',
                'value' => '#ffffff',
                'group' => esc_html__( 'Front Side', 'iguru' ),
            ),
            // Front Side Title
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__('Front Side Description', 'iguru'),
                'param_name' => 'h_front_descr',
                'group' => esc_html__( 'Front Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'textarea',
                'param_name' => 'front_descr',
                'heading' => esc_html__('Description', 'iguru'),
                'group' => esc_html__( 'Front Side', 'iguru' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Description Color', 'iguru'),
                'param_name' => 'front_descr_color',
                'value' => '#bebebe',
                'group' => esc_html__( 'Front Side', 'iguru' ),
            ),
            // Back Side
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__('Back Side Background', 'iguru'),
                'param_name' => 'h_back_bg',
                'group' => esc_html__( 'Back Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'dropdown',
                'param_name' => 'back_bg_style',
                'value'         => array(
                    esc_html__( 'Color', 'iguru' )      => 'back_color',
                    esc_html__( 'Image', 'iguru' )      => 'back_image',
                ),
                'group' => esc_html__( 'Back Side', 'iguru' ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Background Color', 'iguru'),
                'param_name' => 'back_bg_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'back_bg_style',
                    'value' => 'back_color'
                ),
                'group' => esc_html__( 'Back Side', 'iguru' ),
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__('Background Image', 'iguru'),
                'param_name' => 'back_bg_image',
                'description' => esc_html__( 'Select image from media library.', 'iguru' ),
                'dependency' => array(
                    'element' => 'back_bg_style',
                    'value' => 'back_image'
                ),
                'group' => esc_html__( 'Back Side', 'iguru' ),
            ),
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__('Back Side Button', 'iguru'),
                'param_name' => 'h_back_button',
                'group' => esc_html__( 'Back Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Read More Button', 'iguru' ),
                'param_name' => 'add_read_more',
                'group' => esc_html__( 'Back Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Read More Button Text', 'iguru'),
                'param_name' => 'read_more_text',
                'value' => esc_html__('Read More', 'iguru'),
                'group' => esc_html__( 'Back Side', 'iguru' ),
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true'
                ),
            ),
            array(
                'type' => 'vc_link',
                'heading' => esc_html__( 'Link', 'iguru' ),
                'param_name' => 'link',
                'description' => esc_html__('Add link to read more button.', 'iguru'),
                'group' => esc_html__( 'Back Side', 'iguru' ),
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true'
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Customize', 'iguru' ),
                'param_name' => 'button_customize',
                'value'         => array(
                    esc_html__( 'Default', 'iguru' )        => 'def',
                    esc_html__( 'Color', 'iguru' )          => 'color',
                ),
                'group' => esc_html__( 'Back Side', 'iguru' ),
                'dependency' => array(
                    'element' => 'add_read_more',
                    'value' => 'true'
                ),
            ),
            // Button text-color
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Text Color', 'iguru'),
                'param_name' => 'button_text_color',
                'value' => '#ffffff',
                'description' => esc_html__('Select custom text color for button.', 'iguru'),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'button_customize',
                    'value' => array('color', 'gradient')
                ),
                'group' => esc_html__( 'Back Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Hover text-color
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Hover Text Color', 'iguru'),
                'param_name' => 'button_text_color_hover',
                'value' => $theme_color,
                'description' => esc_html__('Select custom text color for hover button.', 'iguru'),
                'dependency' => array(
                    'element' => 'button_customize',
                    'value' => array('color', 'gradient')
                ),
                'group' => esc_html__( 'Back Side', 'iguru' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Bg
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Background', 'iguru'),
                'param_name' => 'button_bg_color',
                'value' => $theme_color,
                'description' => esc_html__('Select custom background for button.', 'iguru'),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'button_customize',
                    'value' => array('color')
                ),
                'group' => esc_html__( 'Back Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Hover Bg
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Hover Background', 'iguru'),
                'param_name' => 'button_bg_color_hover',
                'value' => '#ffffff',
                'description' => esc_html__('Select custom background for hover button.', 'iguru'),
                'dependency' => array(
                    'element' => 'button_customize',
                    'value' => array('color')
                ),
                'group' => esc_html__( 'Back Side', 'iguru' ),
                'save_always' => true,
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button border-color
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Border Color', 'iguru'),
                'param_name' => 'button_border_color',
                'value' => $theme_color,
                'description' => esc_html__('Select custom border color for button.', 'iguru'),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'button_customize',
                    'value' => array('color')
                ),
                'group' => esc_html__( 'Back Side', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // Button Hover border-color
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Hover Border Color', 'iguru'),
                'param_name' => 'button_border_color_hover',
                'value' => '#ffffff',
                'description' => esc_html__('Select custom border color for hover button.', 'iguru'),
                'group' => esc_html__( 'Back Side', 'iguru' ),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'button_customize',
                    'value' => array('color')
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_wgl_Services extends WPBakeryShortCode {
        }
    }
}