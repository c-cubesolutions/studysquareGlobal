<?php

defined( 'ABSPATH' ) || exit;

$theme_color = esc_attr(iGuru_Theme_Helper::get_option('theme-custom-color'));
$theme_color_secondary = esc_attr(iGuru_Theme_Helper::get_option('theme-secondary-color'));
$h_font_color = esc_attr(iGuru_Theme_Helper::get_option('header-font')['color']);
$main_font_color = esc_attr(iGuru_Theme_Helper::get_option('main-font')['color']);

if ( function_exists('vc_map') ) {
	vc_map( array(
		'name' => esc_html__( 'Pricing Table', 'iguru' ),
		'base' => 'wgl_pricing_table',
		'class' => 'iguru_pricing_table',
		'category' => esc_html__( 'WGL Modules', 'iguru' ),
		'icon' => 'wgl_icon_price_table',
		'content_element' => true,
		'description' => esc_html__( 'Place Pricing Table', 'iguru' ),
		'params' => array(
			// GENERAL TAB
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title', 'iguru' ),
				'param_name' => 'pricing_title',
				'admin_label' => true,
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Currency', 'iguru' ),
				'param_name' => 'pricing_cur',
				'edit_field_class' => 'vc_col-sm-2',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Price', 'iguru' ),
				'param_name' => 'pricing_price',
				'edit_field_class' => 'vc_col-sm-2',
				'admin_label' => true,
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Payment Period', 'iguru' ),
				'param_name' => 'pricing_desc',
				'edit_field_class' => 'vc_col-sm-8',
			),
			// Shadow checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Idle Shadow', 'iguru' ),
				'param_name' => 'shadow',
				'value' => 'true',
			),
			// Hover animation checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Enable hover animation', 'iguru' ),
				'param_name' => 'hover_animation',
				'value' => 'true',
				'description' => esc_html__( 'Lift up the item on hover.', 'iguru' ),
			),
			vc_map_add_css_animation( true ),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Extra Class', 'iguru' ),
				'param_name' => 'extra_class',
				'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'iguru' )
			),
			// ICON TAB
			// Add icon/image
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Add Icon/Image', 'iguru' ),
				'param_name' => 'icon_type',
				'value' => [
					esc_html__( 'None', 'iguru' ) => '',
					esc_html__( 'Icon', 'iguru' ) => 'font',
					esc_html__( 'Image', 'iguru' ) => 'image',
				],
				'save_always' => true,
				'group' => esc_html__( 'Icon', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Icon pack dropdown
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Icon Pack', 'iguru' ),
				'param_name' => 'icon_pack',
				'value' => [
					esc_html__( 'Fontawesome', 'iguru' ) => 'fontawesome',
					esc_html__( 'Flaticon', 'iguru' ) => 'flaticon',
				],
				'save_always' => true,
				'dependency' => [
					'element' => 'icon_type',
					'value' => 'font',
				],
				'group' => esc_html__( 'Icon', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4 no-top-padding',
			),
			// Icon size
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Custom Icon Size', 'iguru' ),
				'param_name' => 'custom_icon_size',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'icon_type',
					'value' => 'font',
				],
				'group' => esc_html__( 'Icon', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4 no-top-padding',
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Icon', 'iguru' ),
				'param_name' => 'icon_fontawesome',
				'value' => 'fa fa-adjust',
				'settings' => [
					'emptyIcon' => false, // default true, display an 'EMPTY' icon?
					'iconsPerPage' => 200, // default 100, how many icons will be displayed per page
				],
				'description' => esc_html__( 'Select icon from library.', 'iguru' ),
				'dependency' => [
					'element' => 'icon_pack',
					'value' => 'fontawesome',
				],
				'group' => esc_html__( 'Icon', 'iguru' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Icon', 'iguru' ),
				'param_name' => 'icon_flaticon',
				'value' => '',
				'settings' => [
					'emptyIcon' => false,
					'type' => 'flaticon',
					'iconsPerPage' => 200,
				],
				'description' => esc_html__( 'Select icon from library.', 'iguru' ),
				'dependency' => [
					'element' => 'icon_pack',
					'value' => 'flaticon',
				],
				'group' => esc_html__( 'Icon', 'iguru' ),
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Image', 'iguru' ),
				'param_name' => 'thumbnail',
				'value' => '',
				'description' => esc_html__( 'Choose from media library.', 'iguru' ),
				'dependency' => [
					'element' => 'icon_type',
					'value' => 'image',
				],
				'group' => esc_html__( 'Icon', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-8 no-top-padding',
			),
			// Custom image width
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Custom Image Width', 'iguru' ),
				'param_name' => 'custom_image_width',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'icon_type',
					'value' => 'image',
				],
				'group' => esc_html__( 'Icon', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Custom image height
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Custom Image Height', 'iguru' ),
				'param_name' => 'custom_image_height',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'icon_type',
					'value' => 'image',
				],
				'group' => esc_html__( 'Icon', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// CONTENT TAB
			array(
				'type' => 'textarea_html',
				'heading' => esc_html__( 'Content.', 'iguru' ),
				'param_name' => 'content',
				'holder' => 'div',
				'admin_label' => false,
				'group' => esc_html__( 'Content', 'iguru' ),
			),
			// Description
			array(
				'type' => 'textarea',
				'heading' => esc_html__( 'Description Text', 'iguru' ),
				'param_name' => 'descr_text',
				'group' => esc_html__( 'Content', 'iguru' ),
			),
			// Add button heading
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'CTA Button', 'iguru' ),
				'param_name' => 'h_button',
				'group' => esc_html__( 'Content', 'iguru' ),
			),
			// Button text
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Button Text', 'iguru' ),
				'param_name' => 'button_title',
				'value' => esc_html__( 'Choose Plan', 'iguru' ),
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button link
			array(
				'type' => 'vc_link',
				'heading' => esc_html__( 'Button Link', 'iguru' ),
				'param_name' => 'link',
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-9',
			),
			// COLORS TAB
			// Header section customization
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Header Section', 'iguru' ),
				'param_name' => 'h_pricing_customize',
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			// Title color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Title', 'iguru' ),
				'param_name' => 'custom_title_color',
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Title color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Title Color', 'iguru' ),
				'param_name' => 'title_color',
				'value' => $theme_color,
				'dependency' => [
					'element' => 'custom_title_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_1',
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			// Price color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Price', 'iguru' ),
				'param_name' => 'custom_price_color',
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Price currency color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Currency Color', 'iguru' ),
				'param_name' => 'currency_color',
				'value' => $h_font_color,
				'dependency' => [
					'element' => 'custom_price_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Price color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Price Color', 'iguru' ),
				'param_name' => 'price_color',
				'value' => $h_font_color,
				'dependency' => [
					'element' => 'custom_price_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_2',
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			//  Description color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Description', 'iguru' ),
				'param_name' => 'custom_description_color',
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Description color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Description Color', 'iguru' ),
				'param_name' => 'description_color',
				'value' => '#ffffff',
				'dependency' => [
					'element' => 'custom_description_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Description background color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Description Background Color', 'iguru' ),
				'param_name' => 'description_bg_color',
				'value' => $theme_color_secondary,
				'dependency' => [
					'element' => 'custom_description_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-5',
			),
			// Sections backgrounds customization
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Sections Backgrounds', 'iguru' ),
				'param_name' => 'h_backgrounds_customization',
				'group' => esc_html__( 'Colors', 'iguru' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Pricing Table', 'iguru' ),
				'param_name' => 'pricing_customize',
				'value' => [
					esc_html__( 'Theme Defaults', 'iguru' ) => 'def',
					esc_html__( 'Color', 'iguru' ) => 'color',
					esc_html__( 'Image', 'iguru' ) => 'image',
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Pricing table bg color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Pricing Table Background', 'iguru' ),
				'param_name' => 'pricing_bg_color',
				'value' => '#fcf5f0',
				'dependency' => [
					'element' => 'pricing_customize',
					'value'   => 'color'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			// Pricing table bg image
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Pricing Table Background Image', 'iguru' ),
				'param_name'  => 'pricing_bg_image',
				'value' => '',
				'description' => esc_html__( 'Choose from media library.', 'iguru' ),
				'dependency' => [
					'element' => 'pricing_customize',
					'value'   => 'image',
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_3',
				'dependency' => [
					'element' => 'pricing_customize',
					'value'   => [ 'def', 'color'],
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			// Header section dropdown
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Header', 'iguru' ),
				'param_name' => 'header_customize',
				'value' => [
					esc_html__( 'Theme Defaults', 'iguru' ) => '',
					esc_html__( 'Color', 'iguru' ) => 'color',
					esc_html__( 'Image', 'iguru' ) => 'image',
				],
				'dependency' => [
					'element' => 'pricing_customize',
					'value'   => [ 'def', 'color' ],
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Header bg color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Header Background', 'iguru' ),
				'param_name' => 'header_bg_color',
				'value' => $theme_color,
				'dependency' => [
					'element' => 'header_customize',
					'value' => 'color'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Header bg image
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Header Background Image', 'iguru' ),
				'param_name'  => 'header_bg_image',
				'value' => '',
				'description' => esc_html__( 'Choose from media library.', 'iguru' ),
				'dependency' => [
					'element' => 'header_customize',
					'value' => 'image',
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-5',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_4',
				'dependency' => [
					'element' => 'pricing_customize',
					'value'   => [ 'def', 'color' ],
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			// Content section dropdown
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Content', 'iguru' ),
				'param_name' => 'content_customize',
				'value' => array(
					esc_html__( 'Theme Defaults', 'iguru' ) => '',
					esc_html__( 'Color', 'iguru' ) => 'color',
				),
				'dependency' => [
					'element' => 'pricing_customize',
					'value'   => [ 'def', 'color' ],
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Content bg color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Content Background', 'iguru' ),
				'param_name'  => 'content_bg_color',
				'value' => '#f9f9f9',
				'dependency' => [
					'element' => 'content_customize',
					'value' => [ 'color' ]
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-5',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_5',
				'dependency' => [
					'element' => 'pricing_customize',
					'value' => [ 'def', 'color' ],
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			// Footer section dropdown
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Footer', 'iguru' ),
				'param_name' => 'footer_customize',
				'value' => array(
					esc_html__( 'Theme Defaults', 'iguru' ) => '',
					esc_html__( 'Color', 'iguru' ) => 'color',
				),
				'dependency' => array(
					'element' => 'pricing_customize',
					'value' => [ 'def', 'color' ],
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Footer bg colorpicker
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Footer Background', 'iguru' ),
				'param_name'  => 'footer_bg_color',
				'value' => '#f9f9f9',
				'dependency' => [
					'element' => 'footer_customize',
					'value' => 'color'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-5',
			),
			// Button colors
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Button', 'iguru' ),
				'param_name' => 'h_button_colors',
				'group' => esc_html__( 'Colors', 'iguru' ),
			),
			// Button customization dropdown
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Customization', 'iguru' ),
				'param_name' => 'button_customize',
				'value' => [
					esc_html__( 'Theme Defaults', 'iguru' ) => 'def',
					esc_html__( 'Flat Colors', 'iguru' ) => 'color',
					esc_html__( 'Gradient Colors', 'iguru' ) => 'gradient',
				],
				'std' => 'color',
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_6',
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			// Button text color idle
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Text Color Idle', 'iguru' ),
				'param_name' => 'button_text_color',
				'value' => '#ffffff',
				'dependency' => [
					'element' => 'button_customize',
					'value' => [ 'color', 'gradient' ]
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button text color hover
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Text Color Hover', 'iguru' ),
				'param_name' => 'button_text_color_hover',
				'value' => $theme_color_secondary,
				'dependency' => [
					'element' => 'button_customize',
					'value' => [ 'color', 'gradient' ]
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-9',
			),
			// Button bg idle
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Idle', 'iguru' ),
				'param_name' => 'button_bg_color',
				'value' => $theme_color_secondary,
				'dependency' => [
					'element' => 'button_customize',
					'value' => 'color'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button bg hover
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Hover', 'iguru' ),
				'param_name' => 'button_bg_color_hover',
				'value' => '#ffffff',
				'dependency' => [
					'element' => 'button_customize',
					'value' => 'color'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button bg gradient idle start
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient Start', 'iguru' ),
				'param_name' => 'button_bg_gradient_idle_start',
				'value' => '#ffffff',
				'description' => esc_html__( 'For Idle State.', 'iguru' ),
				'dependency' => [
					'element' => 'button_customize',
					'value' => 'gradient'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button bg gradient idle end
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient End', 'iguru' ),
				'param_name' => 'button_bg_gradient_idle_end',
				'value' => '#ffffff',
				'description' => esc_html__( 'For Idle State.', 'iguru' ),
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button bg gradient hover start
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient Start', 'iguru' ),
				'param_name' => 'button_bg_gradient_hover_start',
				'value' => '',
				'description' => esc_html__( 'For Hover State.', 'iguru' ),
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button bg gradient hover end
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient End', 'iguru' ),
				'param_name' => 'button_bg_gradient_hover_end',
				'value' => '',
				'description' => esc_html__( 'For Hover State.', 'iguru' ),
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_7',
				'dependency' => array(
					'element' => 'button_customize',
					'value' => [ 'color', 'gradient' ]
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			// Button border color idle
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Color Idle', 'iguru' ),
				'param_name' => 'button_border_color',
				'value' => $theme_color_secondary,
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'color'
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button border color hover
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Color Hover', 'iguru' ),
				'param_name' => 'button_border_color_hover',
				'value' => $theme_color_secondary,
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'color'
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button border gradient idle start
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Gradient Start', 'iguru' ),
				'param_name' => 'button_border_gradient_idle_start',
				'value' => '',
				'description' => esc_html__( 'For Idle State.', 'iguru' ),
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button border gradient idle end
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Gradient End', 'iguru' ),
				'param_name' => 'button_border_gradient_idle_end',
				'value' => '',
				'description' => esc_html__( 'For Idle State.', 'iguru' ),
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button border gradient hover start
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Gradient Start', 'iguru' ),
				'param_name' => 'button_border_gradient_hover_start',
				'value' => '',
				'description' => esc_html__( 'For Hover State.', 'iguru' ),
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button border gradient hover end
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Gradient End', 'iguru' ),
				'param_name' => 'button_border_gradient_hover_end',
				'value' => '',
				'description' => esc_html__( 'For Hover State.', 'iguru' ),
				'dependency' => array(
					'element' => 'button_customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Icon color heading
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Icon', 'iguru' ),
				'param_name' => 'h_icon_color',
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'font',
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
			),
			// Icon color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Colors', 'iguru' ),
				'param_name' => 'custom_icon_color',
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'font',
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Icon color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Icon Color', 'iguru' ),
				'param_name' => 'icon_color',
				'value' => '#ffffff',
				'dependency' => array(
					'element' => 'custom_icon_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-5',
			),
			// TYPOGRAPHY TAB
			// Title styles heading
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Title Styles', 'iguru' ),
				'param_name' => 'h_title_styles',
				'group' => esc_html__( 'Typography', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			// Title font size
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Font Size', 'iguru' ),
				'param_name' => 'title_size',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Typography', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Title font weight
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Font Weight', 'iguru' ),
				'param_name' => 'title_weight',
				'value' => [
					esc_html__( 'Theme Default', 'iguru' ) => '',
					esc_html__( '300 / Light', 'iguru' ) => '300',
					esc_html__( '400 / Regular', 'iguru' ) => '400',
					esc_html__( '500 / Medium', 'iguru' ) => '500',
					esc_html__( '600 / SemiBold', 'iguru' ) => '600',
					esc_html__( '700 / Bold', 'iguru' ) => '700',
					esc_html__( '800 / Extra-Bold', 'iguru' ) => '800',
				],
				'group' => esc_html__( 'Typography', 'iguru' ),
				'description' => esc_html__( 'Select custom value.', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Title fonts
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize font family', 'iguru' ),
				'param_name' => 'custom_fonts_title',
				'group' => esc_html__( 'Typography', 'iguru' ),
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'google_fonts_title',
				'value' => '',
				'dependency' => array(
					'element' => 'custom_fonts_title',
					'value' => 'true',
				),
				'group' => esc_html__( 'Typography', 'iguru' ),
			),
			// Price styles 
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Price Styles', 'iguru' ),
				'param_name' => 'h_content_styles',
				'group' => esc_html__( 'Typography', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			// Price font size
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Font Size', 'iguru' ),
				'param_name' => 'price_size',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Typography', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Pricing description styles
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Descriptions Styles', 'iguru' ),
				'param_name' => 'description_styles',
				'group' => esc_html__( 'Typography', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			// Description font size 
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Font Size', 'iguru' ),
				'param_name' => 'description_size',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Typography', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
		)
	));

	if (class_exists( 'WPBakeryShortCode' )) {
		class WPBakeryShortCode_wgl_Pricing_Table extends WPBakeryShortCode {}
	}
}
