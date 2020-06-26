<?php

defined( 'ABSPATH' ) || exit;

$theme_color = esc_attr(iGuru_Theme_Helper::get_option('theme-custom-color'));
$theme_color_secondary  = esc_attr(iGuru_Theme_Helper::get_option('theme-secondary-color'));
$h_font_color = esc_attr(iGuru_Theme_Helper::get_option('header-font')['color']);
$main_font_color = esc_attr(iGuru_Theme_Helper::get_option('main-font')['color']);

add_action( 'admin_enqueue_scripts', 'load_admin_style' );
function load_admin_style() {
	wp_enqueue_style( 'flaticon', get_template_directory_uri().'/fonts/flaticon/flaticon.css' );
}

if (function_exists( 'vc_map')) {
	vc_map( array(
		'name' => esc_html__( 'Info Box', 'iguru' ),
		'base' => 'wgl_info_box',
		'class' => 'iguru_info_box',
		'category' => esc_html__( 'WGL Modules', 'iguru' ),
		'icon' => 'wgl_icon_info_box',
		'content_element' => true,
		'description' => esc_html__( 'Block with icon','iguru' ),
		'params' => array(
			// GENERAL TAB
			// Overall layout radio
			array(
				'type' => 'iguru_radio_image',
				'heading' => esc_html__( 'Overall Layout', 'iguru' ),
				'param_name' => 'layout',
				'fields' => [
					'top' => [
						'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/style_def.png',
						'label' => esc_html__( 'Top', 'iguru')
					],
					'left' => [
						'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/style_left.png',
						'label' => esc_html__( 'Left', 'iguru')
					],
					'right' => [
						'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/style_right.png',
						'label' => esc_html__( 'Right', 'iguru')
					],
				],
				'value' => 'top',
			),
			// Alignment dropdown
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Alignment', 'iguru' ),
				'param_name' => 'alignment',
				'value' => [
					esc_html__( 'Left', 'iguru' ) => 'left',
					esc_html__( 'Center', 'iguru' ) => 'center',
					esc_html__( 'Right', 'iguru' ) => 'right',
				],
				'std' => 'center',
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Hover effect
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Enable Hover Animation', 'iguru' ),
				'param_name' => 'hover_animation',
				'description' => esc_html__( 'Lift up the item on Hover State.', 'iguru'),
				'edit_field_class' => 'vc_col-sm-4',
			),
			vc_map_add_css_animation( true ),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Extra Class', 'iguru' ),
				'param_name' => 'extra_class',
				'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'iguru')
			),
			// CONTENT TAB
			array(
				'type' => 'textarea',
				'heading' => esc_html__( 'Info Box Title', 'iguru' ),
				'param_name' => 'ib_title',
				'admin_label' => true,
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__( 'Info Box Text', 'iguru' ),
				'param_name' => 'ib_content',
				'save_always' => true,
				'group' => esc_html__( 'Content', 'iguru' ),
			),
			array(
				'type' => 'css_editor',
				'heading' => esc_html__( 'Info Box Offsets', 'iguru' ),
				'param_name' => 'ib_offsets',
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12 wgl_css_editor',
			),
			// IB background image
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Module Background Image', 'iguru' ),
				'param_name' => 'ib_bg_image',
				'group' => esc_html__( 'Content', 'iguru' ),
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'h_shadow',
				'group' => esc_html__( 'Content', 'iguru' ),
			),
			// IB shadow
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Info-Box Shadow', 'iguru' ),
				'param_name' => 'add_shadow',
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// IB shadow appearance
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Shadow Appearance', 'iguru' ),
				'param_name' => 'shadow_appearance',
				'value'	=> [
					esc_html__( 'Visible While Hover', 'iguru' ) => 'on_hover',
					esc_html__( 'Visible Until Hover', 'iguru' ) => 'before_hover',
					esc_html__( 'Always Visible', 'iguru' ) => 'always',
				],
				'std' => 'before_hover',
				'dependency' => [
					'element' => 'add_shadow',
					'value' => 'true'
				],
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-8',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Shadow Type', 'iguru' ),
				'param_name' => 'shadow_type',
				'value'	=> [
					esc_html__( 'Outset', 'iguru' ) => '',
					esc_html__( 'Inset', 'iguru' ) => 'inset',
				],
				'dependency' => [
					'element' => 'add_shadow',
					'value' => 'true'
				],
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-2',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'X Offset', 'iguru' ),
				'param_name' => 'shadow_offset_x',
				'value' => '6',
				'dependency' => [
					'element' => 'add_shadow',
					'value' => 'true',
				],
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-2',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Y Offset', 'iguru' ),   
				'param_name' => 'shadow_offset_y',
				'value' => '5',
				'dependency' => [
					'element' => 'add_shadow',
					'value' => 'true',
				],
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-2',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Blur', 'iguru' ),
				'param_name' => 'shadow_blur',
				'value' => '25',
				'dependency' => [
					'element' => 'add_shadow',
					'value' => 'true',
				],
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-1',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Spread', 'iguru' ),
				'param_name' => 'shadow_spread',
				'value' => '0',
				'dependency' => [
					'element' => 'add_shadow',
					'value' => 'true',
				],
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-1',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Color', 'iguru' ),
				'param_name' => 'shadow_color',
				'value' => 'rgba(0, 0, 0, 0.08)',
				'dependency' => [
					'element' => 'add_shadow',
					'value' => 'true'
				],
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'h_button_2',
				'group' => esc_html__( 'Content', 'iguru' ),
			),
			// Read more button dropdown
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Add \'Read More\' Button', 'iguru' ),
				'param_name' => 'add_read_more',
				'value'	=> [
					esc_html__( 'None', 'iguru' ) => '',
					esc_html__( 'With Custom Text', 'iguru' ) => 'alphameric',
					esc_html__( 'With Custom Icon', 'iguru' ) => 'icon',
				],
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Button Text', 'iguru' ),
				'param_name' => 'read_more_text',
				'value' => 'Read More',
				'dependency' => [
					'element' => 'add_read_more',
					'value'   => 'alphameric'
				],
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Icon Font Size', 'iguru' ),
				'param_name' => 'read_more_icon_size',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Content', 'iguru' ),
				'dependency' => [
					'element' => 'add_read_more',
					'value' => 'icon',
				],
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Full-module link checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Full-Module Button', 'iguru' ),
				'param_name' => 'read_more_full_module',
				'description' => esc_html__( 'Clickable at any place.', 'iguru' ),
				'dependency' => [
					'element' => 'add_read_more',
					'value' => [ 'alphameric', 'icon' ]
				],
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Stick button checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Stick the Icon', 'iguru' ),
				'param_name' => 'read_more_icon_sticky',
				'description' => esc_html__( 'Attach to the bottom-right corner.', 'iguru' ),
				'dependency' => [
					'element' => 'add_read_more',
					'value' => 'icon'
				],
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Icon', 'iguru' ),
				'param_name' => 'read_more_icon',
				'value' => 'flaticon-next-1',
				'settings' => [
					'emptyIcon' => false, // default true, display an 'EMPTY' icon
					'type' => 'flaticon',
					'iconsPerPage' => 200, // default 100, defines how many icons will be displayed per page
				],
				'description' => esc_html__( 'Select icon from library.', 'iguru' ),
				'dependency' => [
					'element' => 'add_read_more',
					'value' => 'icon',
				],
				'group' => esc_html__( 'Content', 'iguru' ),
			),
			array(
				'type' => 'vc_link',
				'heading' => esc_html__( 'Link', 'iguru' ),
				'param_name' => 'link',
				'description' => esc_html__( 'Specify URL to \'Read More\' button.', 'iguru' ),
				'dependency' => [
					'element' => 'add_read_more',
					'value' => [ 'alphameric', 'icon' ]
				],
				'group' => esc_html__( 'Content', 'iguru' ),
			),
			// ICON TAB
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Add Icon or Image', 'iguru' ),
				'param_name' => 'icon_type',
				'value' => [
					esc_html__( 'None', 'iguru' ) => 'none',
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
				'param_name' => 'icon_font_type',
				'value' => [
					esc_html__( 'Flaticon', 'iguru' ) => 'type_flaticon',
					esc_html__( 'Fontawesome', 'iguru' ) => 'type_fontawesome',
				],
				'save_always' => true,
				'dependency' => [
					'element' => 'icon_type',
					'value' => 'font',
				],
				'group' => esc_html__( 'Icon', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4 no-top-padding',
			),
			// Icon font size
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Icon Font Size', 'iguru' ),
				'param_name' => 'custom_icon_size',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Icon', 'iguru' ),
				'dependency' => [
					'element' => 'icon_type',
					'value' => 'font',
				],
				'edit_field_class' => 'vc_col-sm-4 no-top-padding',
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Icon', 'iguru' ),
				'param_name' => 'icon_fontawesome',
				'value' => 'fa fa-adjust',
				'settings' => array(
					'emptyIcon' => false,
					'type' => 'fontawesome',
					'iconsPerPage' => 200,
				),
				'description' => esc_html__( 'Select icon from library.', 'iguru' ),
				'dependency' => [
					'element' => 'icon_font_type',
					'value' => 'type_fontawesome',
				],
				'group' => esc_html__( 'Icon', 'iguru' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => esc_html__( 'Icon', 'iguru' ),
				'param_name' => 'icon_flaticon',
				'value' => '',
				'settings' => array(
					'emptyIcon' => false, // default true, display an 'EMPTY' icon
					'type' => 'flaticon',
					'iconsPerPage' => 200, // default 100, defines how many icons will be displayed per page. Use big number to display all icons in single page
				),
				'description' => esc_html__( 'Select icon from library.', 'iguru' ),
				'dependency' => [
					'element' => 'icon_font_type',
					'value' => 'type_flaticon',
				],
				'group' => esc_html__( 'Icon', 'iguru' ),
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Image from Media Library ', 'iguru' ),
				'param_name' => 'thumbnail',
				'value' => '',
				'dependency' => [
					'element' => 'icon_type',
					'value' => 'image',
				],
				'group' => esc_html__( 'Icon', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-8 no-top-padding',
			),
			// Image width
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Image Width', 'iguru' ),
				'param_name' => 'custom_image_width',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'icon_type',
					'value' => 'image',
				],
				'group' => esc_html__( 'Icon', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Image height
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Image Height', 'iguru' ),
				'param_name' => 'custom_image_height',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'icon_type',
					'value' => 'image',
				],
				'group' => esc_html__( 'Icon', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// ICON CONTAINER TAB
			// Icon full width
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Full Width Image', 'iguru' ),
				'param_name' => 'bg_full_width',
				'description' => esc_html__( 'Define as \'100%\'.', 'iguru' ),
				'dependency' => [
					'element' => 'icon_type',
					'value' => 'image'
				],
				'group' => esc_html__( 'Icon Container', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-2 no-top-padding',
			),
			// Icon container width
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Container Width', 'iguru' ),
				'param_name' => 'custom_icon_bg_width',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'icon_type',
					'value' => [ 'font', 'image' ]
				],
				'group' => esc_html__( 'Icon Container', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-5 no-top-padding',
			),
			// Icon container height
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Container Height', 'iguru' ),
				'param_name' => 'custom_icon_bg_height',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'icon_type',
					'value' => [ 'font', 'image' ]
				],
				'group' => esc_html__( 'Icon Container', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-5 no-top-padding',
			),
			array(
				'type' => 'css_editor',
				'heading' => esc_html__( 'Icon Offsets', 'iguru' ),
				'param_name' => 'icon_offsets',
				'dependency' => [
					'element' => 'icon_type',
					'value' => [ 'font', 'image' ]
				],
				'group' => esc_html__( 'Icon Container', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12 wgl_css_editor',
			),
			// Icon container background image
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Container Background Image', 'iguru' ),
				'param_name' => 'icon_bg_image',
				'group' => esc_html__( 'Icon Container', 'iguru' ),
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'h_icon_shadow',
				'dependency' => [
					'element' => 'icon_type',
					'value' => [ 'font', 'image' ]
				],
				'group' => esc_html__( 'Icon Container', 'iguru' ),
			),
			// Icon container shadow checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Container Shadow', 'iguru' ),
				'param_name' => 'add_icon_shadow',
				'dependency' => [
					'element' => 'icon_type',
					'value' => [ 'font', 'image' ]
				],
				'group' => esc_html__( 'Icon Container', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Icon container shadow appearance
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Shadow Appearance', 'iguru' ),
				'param_name' => 'icon_shadow_appearance',
				'value'	=> [
					esc_html__( 'Visible While Hover', 'iguru' ) => 'on_hover',
					esc_html__( 'Visible Until Hover', 'iguru' ) => 'before_hover',
					esc_html__( 'Always Visible', 'iguru' ) => 'always',
				],
				'std' => 'always',
				'dependency' => [
					'element' => 'add_icon_shadow',
					'value' => 'true'
				],
				'group' => esc_html__( 'Icon Container', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-8',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Shadow Type', 'iguru' ),
				'param_name' => 'icon_shadow_type',
				'value'	=> [
					esc_html__( 'Outset', 'iguru' ) => '',
					esc_html__( 'Inset', 'iguru' ) => 'inset',
				],
				'dependency' => [
					'element' => 'add_icon_shadow',
					'value' => 'true'
				],
				'group' => esc_html__( 'Icon Container', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-2',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'X Offset', 'iguru' ),
				'param_name' => 'icon_shadow_offset_x',
				'value' => '0',
				'dependency' => [
					'element' => 'add_icon_shadow',
					'value' => 'true',
				],
				'group' => esc_html__( 'Icon Container', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-2',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Y Offset', 'iguru' ),
				'param_name' => 'icon_shadow_offset_y',
				'value' => '6',
				'dependency' => [
					'element' => 'add_icon_shadow',
					'value' => 'true',
				],
				'group' => esc_html__( 'Icon Container', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-2',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Blur', 'iguru' ),
				'param_name' => 'icon_shadow_blur',
				'value' => '13',
				'dependency' => [
					'element' => 'add_icon_shadow',
					'value' => 'true',
				],
				'group' => esc_html__( 'Icon Container', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-1',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Spread', 'iguru' ),
				'param_name' => 'icon_shadow_spread',
				'value' => '0',
				'dependency' => [
					'element' => 'add_icon_shadow',
					'value' => 'true',
				],
				'group' => esc_html__( 'Icon Container', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-1',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Color', 'iguru' ),
				'param_name' => 'icon_shadow_color',
				'value' => 'rgba(145,145,145,0.2)',
				'dependency' => [
					'element' => 'add_icon_shadow',
					'value' => 'true'
				],
				'group' => esc_html__( 'Icon Container', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// COLORS TAB
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Title Colors', 'iguru' ),
				'param_name' => 'h_title_colors',
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			// Title color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Colors', 'iguru' ),
				'param_name' => 'custom_title_color',
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Title color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Title Idle', 'iguru' ),
				'param_name' => 'title_color',
				'value' => $h_font_color,
				'dependency' => [
					'element' => 'custom_title_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Title hover color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Title Hover', 'iguru' ),
				'param_name' => 'title_color_hover',
				'value' => $h_font_color,
				'description' => esc_html__( 'While Info Box at Hover State', 'iguru' ),
				'dependency' => [
					'element' => 'custom_title_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Content colors heading
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Content Colors', 'iguru' ),
				'param_name' => 'h_content_colors',
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			// Content color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Colors', 'iguru' ),
				'param_name' => 'custom_content_color',
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Content color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Content Idle', 'iguru' ),
				'param_name' => 'content_color',
				'value' => $main_font_color,
				'dependency' => [
					'element' => 'custom_content_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Content Hover', 'iguru' ),
				'param_name' => 'content_color_hover',
				'value' => $main_font_color,
				'description' => esc_html__( 'While Info Box at Hover State', 'iguru' ),
				'dependency' => [
					'element' => 'custom_content_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Icon Colors', 'iguru' ),
				'param_name' => 'h_icon_colors',
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			// Icon color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Colors', 'iguru' ),
				'param_name' => 'custom_icon_color',
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Icon color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Icon Idle', 'iguru' ),
				'param_name' => 'icon_color_idle',
				'value' => '#00bda6',
				'dependency' => [
					'element' => 'custom_icon_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Icon hover color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Icon Hover', 'iguru' ),
				'param_name' => 'icon_color_hover',
				'value' => $theme_color_secondary,
				'description' => esc_html__( 'While Info Box at Hover State', 'iguru' ),
				'dependency' => [
					'element' => 'custom_icon_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Icon/image container color heading
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Icon Container Colors', 'iguru' ),
				'param_name' => 'h_icon_bg_colors',
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			// Icon container colors dropdown
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Customize Colors', 'iguru' ),
				'param_name' => 'custom_icon_bg_color',
				'value' => [
					esc_html__( 'Theme defaults', 'iguru' ) => '',
					esc_html__( 'Flat colors', 'iguru' ) => 'color',
					esc_html__( 'Gradient colors', 'iguru' ) => 'gradient',
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Icon container color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Container Background Idle', 'iguru' ),
				'param_name' => 'icon_bg_color',
				'value' => '#ffffff',
				'dependency' => [
					'element' => 'custom_icon_bg_color',
					'value' => 'color'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Icon container hover color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Container Background Hover', 'iguru' ),
				'param_name' => 'icon_bg_color_hover',
				'value' => '#ffffff',
				'description' => esc_html__( 'While Info Box at Hover State', 'iguru' ),
				'dependency' => [
					'element' => 'custom_icon_bg_color',
					'value' => 'color'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Icon container gradient start color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Container Gradient Start', 'iguru' ),
				'param_name' => 'icon_bg_gradient_start',
				'value' => '',
				'dependency' => [
					'element' => 'custom_icon_bg_color',
					'value' => 'gradient'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Icon container gradient end color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Container Gradient End', 'iguru' ),
				'param_name' => 'icon_bg_gradient_end',
				'value' => '',
				'dependency' => [
					'element' => 'custom_icon_bg_color',
					'value' => 'gradient'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Icon/image border
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Icon Border Colors', 'iguru' ),
				'param_name' => 'h_icon_border_colors',
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			// Icon container border color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Colors', 'iguru' ),
				'param_name' => 'custom_icon_border_color',
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Icon container border color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Idle', 'iguru' ),
				'param_name' => 'icon_border_color',
				'value' => '#ffffff',
				'dependency' => [
					'element' => 'custom_icon_border_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Icon container border hover color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Hover', 'iguru' ),
				'param_name' => 'icon_border_color_hover',
				'value' => '#ffffff',
				'description' => esc_html__( 'While Info Box at Hover State', 'iguru' ),
				'dependency' => [
					'element' => 'custom_icon_border_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Background color
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Info Box Background Colors', 'iguru' ),
				'param_name' => 'h_bg_colors',
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			// Background color dropdown
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Customize Colors', 'iguru' ),
				'param_name' => 'custom_bg_color',
				'value' => [
					esc_html__( 'Theme defaults', 'iguru' ) => '',
					esc_html__( 'Flat colors', 'iguru' ) => 'color',
					esc_html__( 'Gradient colors', 'iguru' ) => 'gradient',
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Background idle color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Idle', 'iguru' ),
				'param_name' => 'ib_bg_color_idle',
				'value' => '#ffffff',
				'dependency' => [
					'element' => 'custom_bg_color',
					'value' => 'color'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Background hover color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Hover', 'iguru' ),
				'param_name' => 'ib_bg_color_hover',
				'value' => '#f9f9f9',
				'description' => esc_html__( 'While Info Box at Hover State', 'iguru' ),
				'dependency' => [
					'element' => 'custom_bg_color',
					'value' => 'color'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Background gradient start color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient Start', 'iguru' ),
				'param_name' => 'ib_bg_gradient_start',
				'value' => '',
				'dependency' => [
					'element' => 'custom_bg_color',
					'value' => 'gradient'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Background gradient end color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Gradient End', 'iguru' ),
				'param_name' => 'ib_bg_gradient_end',
				'value' => '',
				'dependency' => [
					'element' => 'custom_bg_color',
					'value' => 'gradient'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Info Box Border Colors', 'iguru' ),
				'param_name' => 'h_border_colors',
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			// Border color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Colors', 'iguru' ),
				'param_name' => 'custom_border_color',
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Border color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Idle', 'iguru' ),
				'param_name' => 'border_color',
				'value' => '#cbcbcb',
				'dependency' => [
					'element' => 'custom_border_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Border color hover
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Border Hover', 'iguru' ),
				'param_name' => 'border_color_hover',
				'value' => '#cbcbcb',
				'description' => esc_html__( 'While Info Box at Hover State', 'iguru' ),
				'dependency' => [
					'element' => 'custom_border_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			), 
			// Button colors
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Button Colors', 'iguru' ),
				'param_name' => 'h_button_colors',
				'dependency' => [
					'element' => 'add_read_more',
					'value' => [ 'alphameric', 'icon' ]
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
			),
			// Button color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Colors', 'iguru' ),
				'param_name' => 'custom_button_color',
				'dependency' => [
					'element' => 'add_read_more',
					'value' => [ 'alphameric', 'icon' ]
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button color
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Button Idle', 'iguru' ),
				'param_name' => 'button_color',
				'value' => $theme_color,
				'dependency' => [
					'element' => 'custom_button_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button color hover
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Button Hover', 'iguru' ),
				'param_name' => 'button_color_hover',
				'value' => $h_font_color,
				'description' => esc_html__( 'While Button at Hover State', 'iguru' ),
				'dependency' => [
					'element' => 'custom_button_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button color on IB hover
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Button Hover Color', 'iguru' ),
				'param_name' => 'button_color_item_hover',
				'value' => $h_font_color,
				'description' => esc_html__( 'While Info Box at Hover State', 'iguru' ),
				'dependency' => [
					'element' => 'custom_button_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_c_1',
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			// Button color checkbox
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Underline', 'iguru' ),
				'param_name' => 'custom_undeline',
				'dependency' => [
					'element' => 'custom_button_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button underline idle
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Underline Idle', 'iguru' ),
				'param_name' => 'button_underline_color_idle',
				'value' => '#dfdfdf',
				'description' => esc_html__( 'While Button at Hover State', 'iguru' ),
				'dependency' => [
					'element' => 'custom_undeline',
					'value' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Button underline hover
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Underline Hover', 'iguru' ),
				'param_name' => 'button_underline_color_hover',
				'value' => $theme_color,
				'dependency' => [
					'element' => 'custom_undeline',
					'value' => 'true'
				],
				'group' => esc_html__( 'Colors', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Title styles heading
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Title Styles', 'iguru' ),
				'param_name' => 'h_title_styles',
				'group' => esc_html__( 'Typography', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Title Tag', 'iguru' ),
				'param_name' => 'title_tag',
				'value' => [
					esc_html__( '‹span›', 'iguru' ) => 'span',
					esc_html__( '‹div›', 'iguru' ) => 'div',
					esc_html__( '‹h2›', 'iguru' ) => 'h2',
					esc_html__( '‹h3›', 'iguru' ) => 'h3',
					esc_html__( '‹h4›', 'iguru' ) => 'h4',
					esc_html__( '‹h5›', 'iguru' ) => 'h5',
					esc_html__( '‹h6›', 'iguru' ) => 'h6',
				],
				'std' => 'h3',
				'description' => esc_html__( 'Choose your tag for info box title', 'iguru' ),
				'group' => esc_html__( 'Typography', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-5',
			),
			// Title font size
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title Font Size', 'iguru' ),
				'param_name' => 'title_size',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Typography', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-5',
			),
			// Title font weight
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Title Font Weight', 'iguru' ),
				'param_name' => 'title_weight',
				'value' => [
					esc_html__( 'Theme defaults', 'iguru' ) => '',
					esc_html__( '300 / Light', 'iguru' ) => '300',
					esc_html__( '400 / Regular', 'iguru' ) => '400',
					esc_html__( '500 / Medium', 'iguru' ) => '500',
					esc_html__( '600 / SemiBold', 'iguru' ) => '600',
					esc_html__( '700 / Bold', 'iguru' ) => '700',
					esc_html__( '800 / Extra-Bold', 'iguru' ) => '800',
				],
				'group' => esc_html__( 'Typography', 'iguru' ),
				'description' => esc_html__( 'Select custom value.', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-5',
			),
			// Title margin bottom
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Title Bottom Offset', 'iguru' ),
				'param_name' => 'title_bot_offset',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Typography', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-5',
			),
			// Title Fonts
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
				'dependency' => [
					'element' => 'custom_fonts_title',
					'value' => 'true',
				],
				'group' => esc_html__( 'Typography', 'iguru' ),
			),
			// Content styles heading
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Content Styles', 'iguru' ),
				'param_name' => 'h_content_styles',
				'group' => esc_html__( 'Typography', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Content Tag', 'iguru' ),
				'param_name' => 'content_tag',
				'value' => [
					esc_html__( '‹span›', 'iguru' ) => 'span',
					esc_html__( '‹div›', 'iguru' ) => 'div',
					esc_html__( '‹h2›', 'iguru' ) => 'h2',
					esc_html__( '‹h3›', 'iguru' ) => 'h3',
					esc_html__( '‹h4›', 'iguru' ) => 'h4',
					esc_html__( '‹h5›', 'iguru' ) => 'h5',
					esc_html__( '‹h6›', 'iguru' ) => 'h6',
				],
				'std' => 'div',
				'group' => esc_html__( 'Typography', 'iguru' ),
				'description' => esc_html__( 'Select html tag for content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-5',
			),
			// Content font weight
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Content Font Weight', 'iguru' ),
				'param_name' => 'content_weight',
				'value' => [
					esc_html__( 'Theme defaults', 'iguru' ) => '',
					esc_html__( '300 / Light', 'iguru' ) => '300',
					esc_html__( '400 / Regular', 'iguru' ) => '400',
					esc_html__( '500 / Medium', 'iguru' ) => '500',
					esc_html__( '600 / SemiBold', 'iguru' ) => '600',
					esc_html__( '700 / Bold', 'iguru' ) => '700',
					esc_html__( '800 / Extra-Bold', 'iguru' ) => '800',
				],
				'group' => esc_html__( 'Typography', 'iguru' ),
				'description' => esc_html__( 'Select custom value.', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-5',
			),
			// Content font size
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Content Font Size', 'iguru' ),
				'param_name' => 'content_size',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Typography', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-5',
			),
			// Content line height
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Content Line Height', 'iguru' ),
				'param_name' => 'content_line_height',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Typography', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-5',
			),
			// Content Fonts
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize font family', 'iguru' ),
				'param_name' => 'custom_fonts_content',
				'group' => esc_html__( 'Typography', 'iguru' ),
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'google_fonts_content',
				'value' => '',
				'dependency' => [
					'element' => 'custom_fonts_content',
					'value' => 'true',
				],
				'group' => esc_html__( 'Typography', 'iguru' ),
			),
			// Button styles heading
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( '\'Read More\' Button Styles', 'iguru' ),
				'param_name' => 'h_button_styles',
				'group' => esc_html__( 'Typography', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12',
			),
			// Button Font Size
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Button Font Size', 'iguru' ),
				'param_name' => 'button_size',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Typography', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-5',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Button Top Offset', 'iguru' ),
				'param_name' => 'read_more_offset',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Typography', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-5',
			),
			// Button Fonts
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize font family', 'iguru' ),
				'param_name' => 'custom_fonts_button',
				'group' => esc_html__( 'Typography', 'iguru' ),
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'google_fonts_button',
				'value' => '',
				'dependency' => [
					'element' => 'custom_fonts_button',
					'value' => 'true',
				],
				'group' => esc_html__( 'Typography', 'iguru' ),
			),
		)
	));
	
	if (class_exists( 'WPBakeryShortCode')) {
		class WPBakeryShortCode_wgl_info_box extends WPBakeryShortCode {
			
		}
	} 
}
