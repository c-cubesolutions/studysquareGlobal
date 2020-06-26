<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$theme_color = esc_attr(iGuru_Theme_Helper::get_option("theme-custom-color"));

if (function_exists('vc_map')) {
	vc_map(array(
		'name'		=> esc_html__('Time Tab Container', 'iguru'),
		'base'		=> 'wgl_timetabs_container',
		'class'		=> 'iguru_time_line_vertical',
		'category'	=> esc_html__('WGL Modules', 'iguru'),
		'icon'		=> 'wgl_icon_vertical-timeline',
		'as_child'  => array('only' => 'wgl_timetabs_wrapper'),
		'as_parent' => array('only' => 'wgl_timetabs_item'),
		'content_element' => true,
		'is_container' 	  => true,
		'description'	  => esc_html__('Container for tab items','iguru'),
		'params' => array(
			array(
				'type'		  => 'textfield',
				'heading'	  => esc_html__('Tab Title', 'iguru'),
				'param_name'  => 'tab_title',
				'admin_label' => true,
				'value'		  => '',
				'save_always' => true,
			),
			array(
				'type'		  => 'textfield',
				'heading'	  => esc_html__('Tab Sub Title', 'iguru'),
				'param_name'  => 'tab_sub_title',
				'admin_label' => true,
				'value'		  => '',
				'save_always' => true,
			),
			array(
				'type'		 => 'el_id',
				'heading' 	 => esc_html__( 'Tab ID', 'iguru' ),
				'param_name' => 'tab_id',
				'settings' 	 => array(
					'auto_generate' => true,
				),
			),
		),
		'js_view' => 'VcColumnView'
	));

	if (class_exists('WPBakeryShortCode')) {
		class WPBakeryShortCode_wgl_timetabs_container extends WPBakeryShortCodesContainer {
		}
	}
}