<?php

defined( 'ABSPATH' ) || exit;

$theme_color = esc_attr(iGuru_Theme_Helper::get_option('theme-custom-color'));
$theme_color_secondary = esc_attr(iGuru_Theme_Helper::get_option('theme-secondary-color'));
$h_font_color = esc_attr(iGuru_Theme_Helper::get_option('header-font')['color']);

if (function_exists( 'vc_map' )) {
	vc_map( array(
		'name' => esc_html__( 'Progress Bar', 'iguru' ),
		'base' => 'wgl_progress_bar',
		'class' => 'iguru_progress_bar',
		'category' => esc_html__( 'WGL Modules', 'iguru' ),
		'icon' => 'wgl_icon_progress_bar',
		'content_element' => true,
		'description' => esc_html__( 'Display Progress Bar','iguru' ),
		'params' => array(
			array(
				'type' => 'param_group',
				'param_name' => 'values',
				'description' => esc_html__( 'Define values for each bar, such as label, value or colors.', 'iguru' ),
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Label', 'iguru' ),
						'param_name' => 'label',
						'admin_label' => true,
						'description' => esc_html__( 'Enter the bar title.', 'iguru' ),
						'edit_field_class' => 'vc_col-sm-4',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Value', 'iguru' ),
						'param_name' => 'point_value',
						'description' => esc_html__( 'Enter the bar value.', 'iguru' ),
						'edit_field_class' => 'vc_col-sm-4 no-top-padding',
					),
					// Customize colors dropdown
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Customize Colors', 'iguru' ),
						'param_name' => 'bar_color_type',
						'value' => [
							esc_html__( 'Theme Defaults', 'iguru' ) => '',
							esc_html__( 'Flat Colors', 'iguru' ) => 'color',
							esc_html__( 'Gradient Colors', 'iguru' ) => 'gradient',
						],
						'edit_field_class' => 'vc_col-sm-4 no-top-padding',
					),
					// Bar color
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Bar Color', 'iguru' ),
						'param_name' => 'bar_color',
						'value' => $theme_color_secondary,
						'dependency' => [
							'element' => 'bar_color_type',
							'value' => 'color'
						],
						'edit_field_class' => 'vc_col-sm-4 clear-left',
					),
					// Bar gradient start color
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Bar Gradient Start Color', 'iguru' ),
						'param_name' => 'bar_gradient_start',
						'value' => $theme_gradient_start,
						'dependency' => [
							'element' => 'bar_color_type',
							'value' => 'gradient'
						],
						'edit_field_class' => 'vc_col-sm-4 clear-left',
					),
					// Bar gradient end color
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Bar Gradient End Color', 'iguru' ),
						'param_name' => 'bar_gradient_end',
						'value' => $theme_gradient_end,
						'dependency' => [
							'element' => 'bar_color_type',
							'value' => 'gradient'
						],
						'edit_field_class' => 'vc_col-sm-4',
					),
					// Bg bar color
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Background Bar Color', 'iguru' ),
						'param_name' => 'bar_bg_color',
						'value' => '#e4e4e4',
						'dependency' => [
							'element' => 'bar_color_type',
							'value' => [ 'color', 'gradient' ]
						],
						'edit_field_class' => 'vc_col-sm-4',
					),
					// Label color
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Label Text Color', 'iguru' ),
						'param_name' => 'label_color',
						'value' => $h_font_color,
						'dependency' => [
							'element' => 'bar_color_type',
							'value' => [ 'color', 'gradient' ]
						],
						'edit_field_class' => 'vc_col-sm-4 clear-left',
					),
					// Value color
					array(
						'type' => 'colorpicker',
						'heading' => esc_html__( 'Value Text Color', 'iguru' ),
						'param_name' => 'value_color',
						'value' => $theme_color_secondary,
						'dependency' => [
							'element' => 'bar_color_type',
							'value' => [ 'color', 'gradient' ]
						],
						'edit_field_class' => 'vc_col-sm-4',
					),
				),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Units', 'iguru' ),
				'param_name' => 'units',
				'value' => '%',
				'description' => esc_html__( 'Enter measurement units (Example: %, px, points, etc.)', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-6',
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
		class WPBakeryShortCode_wgl_Progress_Bar extends WPBakeryShortCode {
		}
	}
}
