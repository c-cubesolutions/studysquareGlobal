<?php

defined( 'ABSPATH' ) || exit;

if (function_exists( 'vc_map' )) {
	vc_map(array(
		'name' => esc_html__( 'Spacing', 'iguru' ),
		'base' => 'wgl_spacing',
		'class' => 'iguru_spacing',
		'category' => esc_html__( 'WGL Modules', 'iguru' ),
		'icon' => 'wgl_icon_spacing',
		'content_element' => true,
		'description' => esc_html__( 'Blank space with responsive', 'iguru' ),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Vertical Spacer Size', 'iguru' ),
				'param_name' => 'spacer_size',
				'value' => '30px',
				'save_always' => true,
				'admin_label' => true,
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
			),
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Responsive settings', 'iguru' ),
				'param_name' => 'h_responsive_elements',
				'edit_field_class' => 'vc_col-sm-12',
			),
			// Desktop
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Desktop', 'iguru' ),
				'param_name' => 'responsive_desktop',
				'edit_field_class' => 'vc_col-sm-2',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Screen resolution breakpoint', 'iguru' ),
				'param_name' => 'screen_desktops',
				'value' => '1024',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => array(
					'element' => 'responsive_desktop',
					'value' => 'true'
				),
				'edit_field_class' => 'vc_col-sm-4',
			),           
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Spacer size', 'iguru' ),
				'param_name' => 'size_desktops',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => array(
					'element' => 'responsive_desktop',
					'value' => 'true'
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Tablet
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'h_responsive_tablet',
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Tablet', 'iguru' ),
				'param_name' => 'responsive_tablet',
				'edit_field_class' => 'vc_col-sm-2',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Screen resolution breakpoint', 'iguru' ),
				'param_name' => 'screen_tablet',
				'value' => '800',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => array(
					'element' => 'responsive_tablet',
					'value' => 'true'
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Spacer size', 'iguru' ),
				'param_name' => 'size_tablet',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => array(
					'element' => 'responsive_tablet',
					'value' => 'true'
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Mobile
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'h_responsive_tablet',
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Mobile', 'iguru' ),
				'param_name' => 'responsive_mobile',
				'edit_field_class' => 'vc_col-sm-2',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Screen resolution breakpoint', 'iguru' ),
				'param_name' => 'screen_mobile',
				'value' => '480',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => array(
					'element' => 'responsive_mobile',
					'value' => 'true'
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Spacer size', 'iguru' ),
				'param_name' => 'size_mobile',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => array(
					'element' => 'responsive_mobile',
					'value' => 'true'
				),
				'edit_field_class' => 'vc_col-sm-4',
			),                    
		)
	));
	
	if (class_exists( 'WPBakeryShortCode' )) {
		class WPBakeryShortCode_wgl_spacing extends WPBakeryShortCode {
			
		}
	} 
}
