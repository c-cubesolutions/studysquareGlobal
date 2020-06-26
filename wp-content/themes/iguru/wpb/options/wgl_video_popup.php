<?php

defined( 'ABSPATH' ) || exit;

$theme_color = esc_attr(iGuru_Theme_Helper::get_option("theme-custom-color"));
$header_font_color = esc_attr(iGuru_Theme_Helper::get_option('header-font')['color']);
$theme_gradient_start = esc_attr(iGuru_Theme_Helper::get_option('theme-gradient')['from']);
$theme_gradient_end = esc_attr(iGuru_Theme_Helper::get_option('theme-gradient')['to']);


if (function_exists('vc_map')) {
    vc_map( array(
        'base' => 'wgl_video_popup',
        'name' => esc_html__( 'Video Popup', 'iguru' ),
        'description' => esc_html__( 'Create a Button or Poster for Video Popup.', 'iguru' ),
        'category' => esc_html__( 'WGL Modules', 'iguru' ),
        'icon' => 'wgl_icon_video_popup',
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Title', 'iguru' ),
                'param_name' => 'title',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Title Position', 'iguru' ),
                'param_name' => 'title_pos',
                'value' => [
                    esc_html__( 'Left', 'iguru' ) => 'left',
                    esc_html__( 'Right', 'iguru' ) => 'right',
                    esc_html__( 'Top', 'iguru' ) => 'top',
                    esc_html__( 'Bottom', 'iguru' ) => 'bot',
                ],
                'std' => 'bot',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Video Popup Button Alignment', 'iguru' ),
                'param_name' => 'button_pos',
                'value' => [
                    esc_html__( 'Left', 'iguru' ) => 'left',
                    esc_html__( 'Center', 'iguru' ) => 'center',
                    esc_html__( 'Right', 'iguru' ) => 'right',
                    esc_html__( 'Inline', 'iguru' ) => 'inline',
                ],
                'std' => 'center',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Video Link', 'iguru' ),
                'param_name' => 'link',
                'description' => esc_html__( 'Enter video link from youtube or vimeo.', 'iguru')
            ),
            array(
                'type' => 'attach_image',
                'heading' => esc_html__( 'Background Image/Video', 'iguru' ),
                'param_name' => 'bg_image',
                'description' => esc_html__( 'Select video background image.', 'iguru')
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Extra Class', 'iguru' ),
                'param_name' => 'extra_class',
                'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'iguru')
            ),
            // STYLING TAB
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__( 'Title Styles', 'iguru' ),
                'param_name' => 'h_background_title_styles',
                'group' => esc_html__( 'Style', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Title Font Size', 'iguru' ),
                'param_name' => 'title_size',
                'value' => '',
                'description' => esc_html__( 'Value in pixels.', 'iguru' ),
                'group' => esc_html__( 'Style', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Title color', 'iguru' ),
                'param_name' => 'title_color',
                'value' => $header_font_color,
                'group' => esc_html__( 'Style', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize font family', 'iguru' ),
                'param_name' => 'custom_fonts_title',
                'group' => esc_html__( 'Style', 'iguru' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_title',
                'value' => '',
                'dependency' => [
                    'element' => 'custom_fonts_title',
                    'value' => 'true',
                ],
                'group' => esc_html__( 'Style', 'iguru' ),
            ),
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__( 'Button Styles', 'iguru' ),
                'param_name' => 'h_background_title_styles',
                'group' => esc_html__( 'Style', 'iguru' ),
            ),
            // Button diameter
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Button Size', 'iguru' ),
                'param_name' => 'btn_size',
                'description' => esc_html__( 'Enter button diameter in pixels.', 'iguru' ),
                'group' => esc_html__( 'Style', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_1',
				'group' => esc_html__( 'Style', 'iguru' ),
				'edit_field_class' => 'divider',
			),
            // Triangle size
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Triangle Size', 'iguru' ),
                'param_name' => 'triangle_size',
                'description' => esc_html__( 'Value in pixels.', 'iguru' ),
                'group' => esc_html__( 'Style', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // Triangle color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Triangle Color', 'iguru' ),
                'param_name' => 'triangle_color',
                'value' => '#ffffff',
                'group' => esc_html__( 'Style', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-9',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Customize Background', 'iguru' ),
                'param_name' => 'bg_color_type',
                'value' => [
                    esc_html__( 'Theme Defaults', 'iguru' ) => 'def',
                    esc_html__( 'Flat Colors', 'iguru' ) => 'color',
                    esc_html__( 'Gradient Colors', 'iguru' ) => 'gradient',
                ],
                'group' => esc_html__( 'Style', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Border Color', 'iguru' ),
                'param_name' => 'border_color',
                'value' => $theme_color,
                'dependency' => [
                    'element' => 'bg_color_type',
                    'value' => 'color'
                ],
                'group' => esc_html__( 'Style', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Color', 'iguru' ),
                'param_name' => 'background_color',
                'value' => $theme_color,
                'dependency' => [
                    'element' => 'bg_color_type',
                    'value' => 'color'
                ],
                'group' => esc_html__( 'Style', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background Start Color', 'iguru' ),
                'param_name' => 'background_gradient_start',
                'value' => $theme_gradient_start,
                'description' => esc_html__( 'For Idle State.', 'iguru' ),
                'dependency' => [
                    'element' => 'bg_color_type',
                    'value' => 'gradient'
                ],
                'group' => esc_html__( 'Style', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Background End Color', 'iguru' ),
                'param_name' => 'background_gradient_end',
                'value' => $theme_gradient_end,
                'description' => esc_html__( 'For Idle State.', 'iguru' ),
                'dependency' => [
                    'element' => 'bg_color_type',
                    'value' => 'gradient'
                ],
                'group' => esc_html__( 'Style', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-3',
            ),
            // ANIMATION TAB
            // Animation style
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Select Animation Style', 'iguru' ),
                'param_name' => 'animation_style',
                'value' => [
                    esc_html__( 'Pulsing Circles', 'iguru' ) => 'animation_circles',
                    esc_html__( 'Pulsing Ring', 'iguru' ) => 'animation_ring_pulse',
                    esc_html__( 'Rotating Ring', 'iguru' ) => 'animation_ring_rotate',
                ],
                'std' => 'animation_ring_pulse',
                'group' => esc_html__( 'Animation', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Instantly Run Animation', 'iguru' ),
                'param_name' => 'always_run_animation',
                'description' => esc_html__( 'Run until hover state.', 'iguru' ),
                'group' => esc_html__( 'Animation', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-4 no-top-padding',
            ),
            // Animation circles color
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Animation Color', 'iguru' ),
                'param_name' => 'animation_color',
                'value' => $theme_color,
                'description' => esc_html__( 'Animated circles color', 'iguru' ),
                'dependency' => [
                    'element' => 'animation_style',
                    'value' => 'animation_circles'
                ],
                'group' => esc_html__( 'Animation', 'iguru' ),
            ),
        ),
    ));

    class WPBakeryShortCode_wgl_Video_Popup extends WPBakeryShortCode { }

}