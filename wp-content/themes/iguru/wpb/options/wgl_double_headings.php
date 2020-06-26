<?php

defined( 'ABSPATH' ) || exit;

$theme_color = esc_attr(iGuru_Theme_Helper::get_option('theme-custom-color'));
$theme_secondary_color = esc_attr(iGuru_Theme_Helper::get_option('theme-secondary-color'));
$header_font_color = esc_attr(iGuru_Theme_Helper::get_option( 'header-font' )['color']);

if (function_exists( 'vc_map' )) {
	vc_map( array(
		'name' => esc_html__( 'Double Headings', 'iguru' ),
		'base' => 'wgl_double_headings',
		'class' => 'iguru_custom_text',
		'category' => esc_html__( 'WGL Modules', 'iguru' ),
		'icon' => 'wgl_icon_double-text',
		'content_element' => true,
		'description' => esc_html__( 'Double Headings','iguru' ),
		'params' => array(
			// GENERAL TAB
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Subtitle Image', 'iguru' ),
				'param_name' => 'subtitle_img',
				'description' => esc_html__( 'Choose from media library.', 'iguru' ),
				'dependency' => [
					'element' => 'subtitle_img_check',
					'value' => 'true',
				],
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Subtitle', 'iguru' ),
				'param_name' => 'subtitle',
				'edit_field_class' => 'vc_col-sm-9',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Image Above Subtitle?', 'iguru' ),
				'param_name' => 'subtitle_img_check',
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'textarea',
				'holder' => 'div',
				'heading' => esc_html__( 'Title', 'iguru' ) ,
				'param_name' => 'content',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Alignment', 'iguru' ),
				'param_name' => 'align',
				'value' => array(
					esc_html__( 'Left', 'iguru' ) => 'left',
					esc_html__( 'Center', 'iguru' ) => 'center',
					esc_html__( 'Right', 'iguru' ) => 'right',
				),
				'edit_field_class' => 'vc_col-sm-6',
			), 
			vc_map_add_css_animation( true ),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Extra Class', 'iguru' ),
				'param_name' => 'extra_class',
				'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'iguru' )
			),
			// TITLE STYLES TAB
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'HTML Tag', 'iguru' ),
				'param_name' => 'title_tag',
				'value' => [
					esc_html__( '‹span›', 'iguru' ) => 'span',
					esc_html__( '‹div›', 'iguru' ) => 'div',
					esc_html__( '‹h1›', 'iguru' ) => 'h1',
					esc_html__( '‹h2›', 'iguru' ) => 'h2',
					esc_html__( '‹h3›', 'iguru' ) => 'h3',
					esc_html__( '‹h4›', 'iguru' ) => 'h4',
					esc_html__( '‹h5›', 'iguru' ) => 'h5',
					esc_html__( '‹h6›', 'iguru' ) => 'h6',
				],
				'description' => esc_html__( 'Your html tag for title', 'iguru' ),
				'group' => esc_html__( 'Title Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3 no-top-margin',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Font Size', 'iguru' ),
				'param_name' => 'title_size',
				'value' => '48px',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Title Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3 no-top-padding',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Line Height', 'iguru' ),
				'param_name' => 'title_line_height',
				'value' => '52px',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Title Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3 no-top-padding',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Font Weight', 'iguru' ),
				'param_name' => 'title_weight',
				'value' => [
					esc_html__( 'Theme defaults', 'iguru' ) => '',
					esc_html__( '100 / Thin', 'iguru' ) => '100',
					esc_html__( '200 / Extra-Light', 'iguru' ) => '200',
					esc_html__( '300 / Light', 'iguru' ) => '300',
					esc_html__( '400 / Regular', 'iguru' ) => '400',
					esc_html__( '500 / Medium', 'iguru' ) => '500',
					esc_html__( '600 / SemiBold', 'iguru' ) => '600',
					esc_html__( '700 / Bold', 'iguru' ) => '700',
					esc_html__( '800 / Extra-Bold', 'iguru' ) => '800',
					esc_html__( '900 / Black', 'iguru' ) => '900',
				],
				'description' => esc_html__( 'Select custom value.', 'iguru' ),
				'group' => esc_html__( 'Title Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3 no-top-padding',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Colors', 'iguru' ),
				'param_name' => 'custom_title_color',
				'group' => esc_html__( 'Title Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Title Color', 'iguru' ),
				'param_name' => 'title_color',
				'value' => $header_font_color,
				'save_always' => true,
				'dependency' => [
					'element' => 'custom_title_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Title Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-9',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_ts_1',
				'group' => esc_html__( 'Title Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Responsive Font Size', 'iguru' ),
				'param_name' => 'responsive_font',
				'group' => esc_html__( 'Title Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Small Desktops', 'iguru' ),
				'param_name' => 'font_size_desktop',
				'description' => esc_html__( 'Font-size in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'responsive_font',
					'value' => 'true'
				],
				'group' => esc_html__( 'Title Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Tablets', 'iguru' ),
				'param_name' => 'font_size_tablet',
				'description' => esc_html__( 'Font-size in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'responsive_font',
					'value' => 'true'
				],
				'group' => esc_html__( 'Title Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Mobile', 'iguru' ),
				'param_name' => 'font_size_mobile',
				'description' => esc_html__( 'Font-size in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'responsive_font',
					'value' => 'true'
				],
				'group' => esc_html__( 'Title Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_ts_2',
				'group' => esc_html__( 'Title Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize font family', 'iguru' ),
				'param_name' => 'custom_fonts_title',
				'group' => esc_html__( 'Title Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'google_fonts_title',
				'value' => '',
				'dependency' => [
					'element' => 'custom_fonts_title',
					'value' => 'true',
				],
				'group' => esc_html__( 'Title Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-9',
			),   
			// SUBTITLE STYLES TAB
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'HTML Tag', 'iguru' ),
				'param_name' => 'subtitle_tag',
				'value' => [
					esc_html__( '‹span›', 'iguru' ) => 'span',
					esc_html__( '‹div›', 'iguru' ) => 'div',
					esc_html__( '‹h2›', 'iguru' ) => 'h2',
					esc_html__( '‹h3›', 'iguru' ) => 'h3',
					esc_html__( '‹h4›', 'iguru' ) => 'h4',
					esc_html__( '‹h5›', 'iguru' ) => 'h5',
					esc_html__( '‹h6›', 'iguru' ) => 'h6',
				],
				'description' => esc_html__( 'Select custom html tag.', 'iguru' ),
				'group' => esc_html__( 'Subtitle Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3 no-top-margin',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Font Size', 'iguru' ),
				'param_name' => 'subtitle_size',
				'value' => '16px',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Subtitle Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3 no-top-padding',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Line Height', 'iguru' ),
				'param_name' => 'subtitle_line_height',
				'value' => '20px',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Subtitle Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3 no-top-padding',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Font Weight', 'iguru' ),
				'param_name' => 'subtitle_weight',
				'description' => esc_html__( 'Select custom value.', 'iguru' ),
				'value' => [
					esc_html__( 'Theme Defaults', 'iguru' ) => '',
					esc_html__( '300 / Light', 'iguru' ) => '300',
					esc_html__( '400 / Regular', 'iguru' ) => '400',
					esc_html__( '500 / Medium', 'iguru' ) => '500',
					esc_html__( '600 / SemiBold', 'iguru' ) => '600',
					esc_html__( '700 / Bold', 'iguru' ) => '700',
					esc_html__( '800 / Extra-Bold', 'iguru' ) => '800',
				],
				'group' => esc_html__( 'Subtitle Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3 no-top-padding',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Colors', 'iguru' ),
				'param_name' => 'custom_subtitle_color',
				'group' => esc_html__( 'Subtitle Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Subtitle Color', 'iguru' ),
				'param_name' => 'subtitle_color',
				'value' => $header_font_color,
				'save_always' => true,
				'dependency' => [
					'element' => 'custom_subtitle_color',
					'value' => 'true',
				],
				'group' => esc_html__( 'Subtitle Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-9',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_ss_1',
				'group' => esc_html__( 'Subtitle Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize font family', 'iguru' ),
				'param_name' => 'custom_fonts_subtitle',
				'group' => esc_html__( 'Subtitle Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'google_fonts_subtitle',
				'value' => '',
				'dependency' => [
					'element' => 'custom_fonts_subtitle',
					'value' => 'true',
				],
				'group' => esc_html__( 'Subtitle Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-9',
			),
		)
	));
	
	if (class_exists( 'WPBakeryShortCode' )) {
		class WPBakeryShortCode_wgl_Double_Headings extends WPBakeryShortCode {
		}
	} 
}
