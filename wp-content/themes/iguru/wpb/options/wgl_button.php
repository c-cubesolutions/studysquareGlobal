<?php

defined( 'ABSPATH' ) || exit;

$theme_color = esc_attr(iGuru_Theme_Helper::get_option('theme-custom-color'));
$header_font_color = esc_attr(iGuru_Theme_Helper::get_option('header-font')['color']);

if (function_exists('vc_map')) {
	vc_map( array(
		'name' => esc_html__( 'Button', 'iguru' ),
		'base' => 'wgl_button',
		'class' => 'iguru_button',
		'icon' => 'wgl_icon_button',
		'content_element' => true,
		'category' => esc_html__( 'WGL Modules', 'iguru' ),
		'description' => esc_html__( 'Add extended button','iguru'),
		'params' => array(
			// GENERAL TAB
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Button Text', 'iguru' ),
				'value' => esc_html__( 'Button Text', 'iguru' ),
				'param_name' => 'button_text',
				'admin_label' => true,
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'vc_link',
				'heading' => esc_html__( 'Button Link', 'iguru' ),
				'param_name' => 'link',
			),
			// Animations
			vc_map_add_css_animation( true ),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Extra Class', 'iguru' ),
				'param_name' => 'extra_class',
				'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'iguru' )
			),
			// STYLE TAB
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Button', 'iguru' ),
				'param_name' => 'h_button_style',
				'group' => esc_html__( 'Style', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Button Size', 'iguru' ),
				'param_name' => 'size',
				'value' => array(
					esc_html__( 'Extra Large', 'iguru' ) => 'xl',
					esc_html__( 'Large', 'iguru' ) => 'l',
					esc_html__( 'Medium', 'iguru' ) => 'm',
					esc_html__( 'Small', 'iguru' ) => 's',
				),
				'std' => 'xl',
				'group' => esc_html__( 'Style', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Button Full Width', 'iguru' ),
				'param_name' => 'full_width',
				'description' => esc_html__( 'Fill available width.', 'iguru' ),
				'group' => esc_html__( 'Style', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-2',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Display: Inline', 'iguru' ),
				'param_name' => 'inline',
				'description' => esc_html__( 'Fill content width.', 'iguru' ),
				'group' => esc_html__( 'Style', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-2',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_1',
				'group' => esc_html__( 'Style', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Button Alignment', 'iguru' ),
				'param_name' => 'align',
				'value' => [
					esc_html__( 'Left', 'iguru' ) => 'left',
					esc_html__( 'Center', 'iguru' ) => 'center',
					esc_html__( 'Right', 'iguru' ) => 'right',
				],
				'group' => esc_html__( 'Style', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Border heading
			array(
				'param_name' => 'h_button_border',
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Button Border', 'iguru' ),
				'group' => esc_html__( 'Style', 'iguru' ),
			),
			// Border Radius
			array(
				'param_name' => 'border_radius',
				'type' => 'textfield',
				'heading' => esc_html__( 'Button Border Radius', 'iguru' ),
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'value' => '5px',
				'group' => esc_html__( 'Style', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Border checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Border', 'iguru' ),
				'param_name' => 'add_border',
				'value' => 'true',
				'group' => esc_html__( 'Style', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-2',
			),
			// Border width
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Border Width', 'iguru' ),
				'param_name' => 'border_width',
				'value' => '1px',
				'dependency' => [
					'element' => 'add_border',
					'value' => 'true'
				],
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Style', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-2',
			),
			// Shadow
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Button Shadow', 'iguru' ),
				'param_name' => 'h_button_shadow',
				'group' => esc_html__( 'Style', 'iguru' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Shadow Appearance', 'iguru' ),
				'param_name' => 'shadow_style',
				'value' => array(
					esc_html__( 'Theme Defaults', 'iguru' ) => '',
					esc_html__( 'Disable Shadow', 'iguru' ) => 'none',
					esc_html__( 'Always Visible', 'iguru' ) => 'always',
					esc_html__( 'While Hover', 'iguru' ) => 'on_hover',
					esc_html__( 'Until Hover', 'iguru' ) => 'before_hover',
				),
				'std' => '',
				'group' => esc_html__( 'Style', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// TYPOGRAPHY TAB
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Button Text Font Size', 'iguru' ),
				'param_name' => 'font_size',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Typography', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Button Text Font Weight', 'iguru' ),
				'param_name' => 'font_weight',
				'value' => array(
					esc_html__( 'Theme Defaults', 'iguru' ) => '',
					esc_html__( '300 / Light', 'iguru' ) => '300',
					esc_html__( '400 / Regular', 'iguru' ) => '400',
					esc_html__( '500 / Medium', 'iguru' ) => '500',
					esc_html__( '600 / SemiBold', 'iguru' ) => '600',
					esc_html__( '700 / Bold', 'iguru' ) => '700',
					esc_html__( '800 / Extra-Bold', 'iguru' ) => '800',
					esc_html__( '900 / Black', 'iguru' ) => '900',
				),
				'group' => esc_html__( 'Typography', 'iguru' ),
				'description' => esc_html__( 'Select custom value.', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4 no-top-padding',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_t_1',
				'group' => esc_html__( 'Typography', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize font family', 'iguru' ),
				'param_name' => 'custom_fonts_button',
				'group' => esc_html__( 'Typography', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'google_fonts_button',
				'value' => '',
				'dependency' => array(
					'element' => 'custom_fonts_button',
					'value' => 'true',
				),
				'group' => esc_html__( 'Typography', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-9',
			),
			// ICON TAB
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Add Icon/Image', 'iguru' ),
				'param_name' => 'icon_type',
				'value' => array(
					esc_html__( 'None','iguru') => 'none',
					esc_html__( 'Font','iguru') => 'font',
					esc_html__( 'Image','iguru') => 'image',
				),
				'group' => esc_html__( 'Icon', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Icon Pack', 'iguru' ),
				'param_name' => 'icon_pack',
				'value' => array(
					esc_html__( 'Fontawesome', 'iguru' ) => 'fontawesome',
					esc_html__( 'Flaticon', 'iguru' ) => 'flaticon',
				),
				'save_always' => true,
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'font',
				),
				'group' => esc_html__( 'Icon', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3 no-top-padding',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Icon Font Size', 'iguru' ),
				'param_name' => 'icon_font_size',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'font'
				),
				'group' => esc_html__( 'Icon', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3 no-top-padding',
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Image', 'iguru' ),
				'param_name' => 'image',
				'value' => '',
				'description' => esc_html__( 'Select image from media library.', 'iguru' ),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'image'
				),
				'group' => esc_html__( 'Icon', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3 no-top-padding',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Icon Position', 'iguru' ),
				'param_name' => 'icon_position',
				'value' => array(
					esc_html__( 'Left', 'iguru' ) => 'left',
					esc_html__( 'Right', 'iguru' ) => 'right'
				),
				'description' => esc_html__( 'Select alignment.', 'iguru' ),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => array('image', 'font')
				),
				'group' => esc_html__( 'Icon', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3 no-top-padding',
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Icon', 'iguru' ),
				'param_name' => 'icon_fontawesome',
				'value' => 'fa fa-adjust',
				'settings' => array(
					'emptyIcon' => false,
					'iconsPerPage' => 200, 
				),
				'dependency' => array(
					'element' => 'icon_pack',
					'value' => 'fontawesome',
				),
				'description' => esc_html__( 'Select icon from library.', 'iguru' ),
				'group' => esc_html__( 'Icon', 'iguru' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Icon', 'iguru' ),
				'param_name' => 'icon_flaticon',
				'value' => '',
				'settings' => array(
					'emptyIcon' => false,
					'type' => 'flaticon',
					'iconsPerPage' => 200,
				),
				'description' => esc_html__( 'Select icon from library.', 'iguru' ),
				'dependency' => array(
					'element' => 'icon_pack',
					'value' => 'flaticon',
				),
				'group' => esc_html__( 'Icon', 'iguru' ),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Image Width', 'iguru' ),
				'param_name' => 'img_width',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'image'
				),
				'group' => esc_html__( 'Icon', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			// OFFSETS TAB
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Button Paddings', 'iguru' ),
				'param_name' => 'heading',
				'group' => esc_html__( 'Offsets', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Top Padding', 'iguru' ),
				'param_name' => 'top_pad',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Offsets', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Bottom Padding', 'iguru' ),
				'param_name' => 'bottom_pad',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Offsets', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Left Padding', 'iguru' ),
				'param_name' => 'left_pad',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Offsets', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Right Padding', 'iguru' ),
				'param_name' => 'right_pad',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Offsets', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Button Margins', 'iguru' ),
				'param_name' => 'heading',
				'group' => esc_html__( 'Offsets', 'iguru' ),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Top Margin', 'iguru' ),
				'param_name' => 'top_mar',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Offsets', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Bottom Margin', 'iguru' ),
				'param_name' => 'bottom_mar',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Offsets', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Left Margin', 'iguru' ),
				'param_name' => 'left_mar',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Offsets', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Right Margin', 'iguru' ),
				'param_name' => 'right_mar',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Offsets', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// COLORS TAB
			// Button colors heading
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Button', 'iguru' ),
				'param_name' => 'h_button_customize',
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Customize', 'iguru' ),
				'param_name' => 'customize',
				'value' => array(
					esc_html__( 'Theme Defaults', 'iguru' ) => 'def',
					esc_html__( 'Flat Colors', 'iguru' ) => 'color',
					esc_html__( 'Gradient Colors', 'iguru' ) => 'gradient',
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_c_1',
				'dependency' => array(
					'element' => 'customize',
					'value' => array('color', 'gradient')
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			// Text color idle
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Text Idle', 'iguru' ),
				'param_name' => 'text_color',
				'value' => $header_font_color,
				'dependency' => array(
					'element' => 'customize',
					'value' => array('color', 'gradient')
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Text color hover
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Text Hover', 'iguru' ),
				'param_name' => 'text_color_hover',
				'value' => '#ffffff',
				'dependency' => array(
					'element' => 'customize',
					'value' => array('color', 'gradient')
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_c_2',
				'dependency' => array(
					'element' => 'customize',
					'value' => array('color', 'gradient')
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			// Bg color idle
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Idle', 'iguru' ),
				'param_name' => 'bg_color',
				'value' => '#ffffff',
				'dependency' => array(
					'element' => 'customize',
					'value' => 'color'
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Bg color hover
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Hover', 'iguru' ),
				'param_name' => 'bg_color_hover',
				'value' => $theme_color,
				'dependency' => array(
					'element' => 'customize',
					'value' => 'color'
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Bg gradient idle start
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient Start', 'iguru' ),
				'param_name' => 'bg_gradient_idle_start',
				'value' => '',
				'description' => esc_html__( 'For Idle State.', 'iguru' ),
				'dependency' => array(
					'element' => 'customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Bg gradient idle end
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient End', 'iguru' ),
				'param_name' => 'bg_gradient_idle_end',
				'value' => '',
				'description' => esc_html__( 'For Idle State.', 'iguru' ),
				'dependency' => array(
					'element' => 'customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Bg gradient hover start
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient Start', 'iguru' ),
				'param_name' => 'bg_gradient_hover_start',
				'value' => '',
				'description' => esc_html__( 'For Hover State.', 'iguru' ),
				'dependency' => array(
					'element' => 'customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Bg gradient hover end
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient End', 'iguru' ),
				'param_name' => 'bg_gradient_hover_end',
				'value' => '',
				'description' => esc_html__( 'For Hover State.', 'iguru' ),
				'dependency' => array(
					'element' => 'customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_c_3',
				'dependency' => array(
					'element' => 'customize',
					'value' => array('color', 'gradient')
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Idle', 'iguru' ),
				'param_name' => 'border_color',
				'value' => $theme_color,
				'dependency' => array(
					'element' => 'customize',
					'value' => 'color'
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Hover', 'iguru' ),
				'param_name' => 'border_color_hover',
				'value' => $theme_color,
				'dependency' => array(
					'element' => 'customize',
					'value' => 'color'
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Border gradient idle start
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Gradient Start', 'iguru' ),
				'param_name' => 'border_gradient_idle_start',
				'value' => '',
				'description' => esc_html__( 'For Idle State.', 'iguru' ),
				'dependency' => array(
					'element' => 'customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Border gradient idle end
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Gradient End', 'iguru' ),
				'param_name' => 'border_gradient_idle_end',
				'value' => '',
				'description' => esc_html__( 'For Idle State.', 'iguru' ),
				'dependency' => array(
					'element' => 'customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Border gradient hover start
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Gradient Start', 'iguru' ),
				'param_name' => 'border_gradient_hover_start',
				'value' => '',
				'description' => esc_html__( 'For Hover State.', 'iguru' ),
				'dependency' => array(
					'element' => 'customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Border gradient hover end
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Gradient End', 'iguru' ),
				'param_name' => 'border_gradient_hover_end',
				'value' => '',
				'description' => esc_html__( 'For Hover State.', 'iguru' ),
				'dependency' => array(
					'element' => 'customize',
					'value' => 'gradient'
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Icon colors heading
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Icon', 'iguru' ),
				'param_name' => 'h_icon_color',
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'font'
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			// Icon color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Colors', 'iguru' ),
				'param_name' => 'custom_icon_color',
				'group' => esc_html__( 'Colors', 'iguru' ),
				'dependency' => array(
					'element' => 'icon_type',
					'value' => 'font'
				),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Icon color idle
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Icon Idle', 'iguru' ),
				'param_name' => 'icon_color_idle',
				'value' => '#ffffff',
				'dependency' => array(
					'element' => 'custom_icon_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Icon color hover
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Icon Hover', 'iguru' ),
				'param_name' => 'icon_color_hover',
				'value' => $theme_color,
				'dependency' => array(
					'element' => 'custom_icon_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
		)
	));

	if (class_exists('WPBakeryShortCode')) {
		class WPBakeryShortCode_wgl_Button extends WPBakeryShortCode {
		}
	}
}