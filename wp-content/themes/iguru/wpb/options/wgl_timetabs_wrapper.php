<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$theme_color = esc_attr(iGuru_Theme_Helper::get_option("theme-custom-color"));

if (function_exists('vc_map')) {
	vc_map(array(
		'name' => esc_html__('Time Tabs', 'iguru'),
		'base' => 'wgl_timetabs_wrapper',
		'class' => 'iguru_time_line_vertical',
		'category' => esc_html__('WGL Modules', 'iguru'),
		'icon' => 'wgl_icon_time_tabs',
		'as_parent' => array('only' => 'wgl_timetabs_container'),
		'content_element' => true,
		'show_settings_on_create' => false,
		'is_container' => true,
		'description' => esc_html__('Place Time Tabs','iguru'),
		'params' => array(
			// Title customize
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__('Title Customize', 'iguru'),
				'param_name' => 'h_title_colors',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			// Title colors
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Title Custom Color', 'iguru' ),
				'param_name' => 'title_custom_color',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__('Title Color', 'iguru'),
				'param_name' => 'title_color',
				'value' => '#919191',
				'description' => esc_html__('Select custom color', 'iguru'),
				'dependency' => array(
					'element' => 'title_custom_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__('Title Hover Color', 'iguru'),
				'param_name' => 'title_color_hover',
				'value' => '#ffffff',
				'description' => esc_html__('Select custom color', 'iguru'),
				'dependency' => array(
					'element' => 'title_custom_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Subtitle customize
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__('Subtitle Customize', 'iguru'),
				'param_name' => 'h_subtitle_colors',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Subtitle Custom Color', 'iguru' ),
				'param_name' => 'subtitle_custom_color',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__('Subtitle Color', 'iguru'),
				'param_name' => 'subtitle_color',
				'value' => '#dadada',
				'description' => esc_html__('Select custom color', 'iguru'),
				'dependency' => array(
					'element' => 'subtitle_custom_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__('Subtitle Hover Color', 'iguru'),
				'param_name' => 'subtitle_color_hover',
				'value' => '#dadada',
				'description' => esc_html__('Select custom color', 'iguru'),
				'dependency' => array(
					'element' => 'subtitle_custom_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Tab Bottom Bar
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__('Tab Bottom Bar Customize', 'iguru'),
				'param_name' => 'h_bar_colors',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Tab Bottom Bar Color', 'iguru' ),
				'param_name' => 'bar_custom_color',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__('Bar Idle Color', 'iguru'),
				'param_name' => 'bar_color',
				'value' => 'rgba(255, 255, 255, 0.1)',
				'description' => esc_html__('Select custom color', 'iguru'),
				'dependency' => array(
					'element' => 'bar_custom_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__('Bar Active Color', 'iguru'),
				'param_name' => 'bar_color_hover',
				'value' => $theme_color,
				'description' => esc_html__('Select custom color', 'iguru'),
				'dependency' => array(
					'element' => 'bar_custom_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
		),
		'js_view' => 'VcColumnView'
	));

	if (class_exists('WPBakeryShortCode')) {
		class WPBakeryShortCode_wgl_timetabs_wrapper extends WPBakeryShortCodesContainer {
		}
	}
}