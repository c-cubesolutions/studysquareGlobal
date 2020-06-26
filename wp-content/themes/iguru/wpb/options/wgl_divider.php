<?php

defined( 'ABSPATH' ) || exit;

$theme_color = esc_attr(iGuru_Theme_Helper::get_option('theme-custom-color'));

if (function_exists('vc_map')) {
	vc_map(array(
		'name' => esc_html__( 'Divider', 'iguru' ),
		'base' => 'wgl_divider',
		'class' => 'iguru_divider',
		'category' => esc_html__( 'WGL Modules', 'iguru' ),
		'icon' => 'wgl_icon_divider',
		'content_element' => true,
		'description' => esc_html__( 'Dividing line', 'iguru' ),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Width', 'iguru' ),
				'param_name' => 'width',
				'description' => esc_html__( 'Enter value.', 'iguru' ),
				'value' => '100',
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Width Units', 'iguru' ),
				'param_name' => 'width_units',
				'value' => array(
					esc_html__( 'Pixels', 'iguru' )      => 'px',
					esc_html__( 'Percentages', 'iguru' ) => '%',
				),
				'std' => '%',
				'description' => esc_html__( 'Select value units.', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3 no-top-padding',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Height', 'iguru' ),
				'param_name' => 'height',
				'description' => esc_html__( 'Enter value in pixels.', 'iguru' ),
				'value' => '1px',
				'save_always' => true,
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-6 no-top-padding',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Alignment', 'iguru' ),
				'param_name' => 'divider_alignment',
				'value' => array(
					esc_html__( 'Left', 'iguru' )   => 'left',
					esc_html__( 'Center', 'iguru' ) => 'center',
					esc_html__( 'Right', 'iguru' )  => 'right',
				),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Divider Color', 'iguru' ),
				'param_name' => 'divider_color',
				'value' => '#e7e8e8',
				'save_always' => true,
				'edit_field_class' => 'vc_col-sm-6',
			),
			// EXTRA LINE TAB
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Extra Line', 'iguru' ),
				'param_name' => 'add_divider_line',
				'description' => esc_html__( 'Short line above Divider.', 'iguru' ),
				'group' => esc_html__( 'Extra Line', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Extra Line Alignment', 'iguru' ),
				'param_name' => 'divider_line_alignment',
				'value' => array(
					esc_html__( 'Left', 'iguru' )   => 'left',
					esc_html__( 'Center', 'iguru' ) => 'center',
					esc_html__( 'Right', 'iguru' )  => 'right',
				),
				'dependency' => array(
					'element' => 'add_divider_line',
					'value' => 'true'
				),
				'group' => esc_html__( 'Extra Line', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3 no-top-padding',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Extra Line Color', 'iguru' ),
				'param_name' => 'divider_line_color',
				'value' => $theme_color,
				'save_always' => true,
				'dependency' => array(
					'element' => 'add_divider_line',
					'value' => 'true'
				),
				'group' => esc_html__( 'Extra Line', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-6 no-top-padding',
			),
		)
	));
	
	if (class_exists( 'WPBakeryShortCode' )) {
		class WPBakeryShortCode_wgl_divider extends WPBakeryShortCode {}
	}
}