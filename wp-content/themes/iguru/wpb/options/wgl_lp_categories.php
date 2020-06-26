<?php

defined( 'ABSPATH' ) || exit;

$theme_color = esc_attr(iGuru_Theme_Helper::get_option('theme-custom-color'));
$secondary_color = esc_attr(iGuru_Theme_Helper::get_option('theme-secondary-color'));
$h_font_color = esc_attr(iGuru_Theme_Helper::get_option('header-font')['color']);
$main_font_color = esc_attr(iGuru_Theme_Helper::get_option('main-font')['color']);

$cats = get_terms( [ 'taxonomy' => 'course_category' ] );
$cats_arr = [];
foreach ( $cats as $cat ) {
	$parent_id = $cat->parent;
	$parent_name = $parent_id ? get_term($parent_id)->name : '';
	$parent = !empty($parent_name) ? sprintf( ' (%s %s)', esc_html__( 'Child for:', 'iguru' ), esc_html($parent_name) ) : '';
	$label = $cat->name . $parent;
	$cats_arr[$label] = $cat->term_id;
}

if ( function_exists('vc_map') ) {
	vc_map( [
		'base' => 'wgl_lp_categories',
		'name' => esc_html__( 'LP Categories', 'iguru' ),
		'description' => esc_html__( 'Display LP Categories', 'iguru' ),
		'category' => esc_html__( 'LearnPress', 'iguru' ),
		'icon' => 'wgl_icon_learnpress',
		'params' => [
			[
				'type' => 'dropdown',
				'heading' => esc_html__( 'Grid Columns Amount', 'iguru' ),
				'param_name' => 'grid_columns',
				'value' => [
					esc_html__( 'One', 'iguru' ) => '1',
					esc_html__( 'Two', 'iguru' ) => '2',
					esc_html__( 'Three', 'iguru' ) => '3',
					esc_html__( 'Four', 'iguru' ) => '4',
					esc_html__( 'Five', 'iguru' ) => '5',
				],
				'std' => '4',
				'edit_field_class' => 'vc_col-sm-4',
			],
			[
				'type' => 'param_group',
				'heading' => esc_html__( 'Items', 'iguru' ),
				'param_name' => 'items',
				'description' => esc_html__( 'Set options for each category item.', 'iguru' ),
				'value' => urlencode( json_encode(
					[
						[ 'cat_id' => reset($cats_arr) ],
						[ 'cat_id' => next($cats_arr)  ],
						[ 'cat_id' => next($cats_arr)  ],
					]
				) ),
				'params' => [
					[
						'type' => 'dropdown',
						'heading' => esc_html__( 'Category', 'iguru' ),
						'param_name' => 'cat_id',
						'value' => isset($cats_arr) ? $cats_arr : '',
						'admin_label' => true,
						'edit_field_class' => 'vc_col-sm-4',
					],
					[
						'type' => 'iconpicker',
						'heading' => esc_html__( 'Icon', 'iguru' ),
						'param_name' => 'cat_icon',
						'settings' => [
							'emptyIcon' => true, // 'true' - displays an 'EMPTY' icon.
							'type' => 'flaticon',
							'iconsPerPage' => 200, // how many icons will be displayed per page.
						],
						'edit_field_class' => 'vc_col-sm-8 no-top-padding',
					],
					[
						'type' => 'attach_image',
						'heading' => esc_html__( 'Thumbnail Idle', 'iguru' ),
						'param_name' => 'thumb_idle',
						'edit_field_class' => 'vc_col-sm-5',
					],
				],
			],
			[
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Link', 'iguru' ),
				'param_name' => 'link_use',
				'std' => 'true',
				'description' => esc_html__( 'Link each item to archive.', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Open in a new tab', 'iguru' ),
				'param_name' => 'link_target',
				'description' => esc_html__( 'Define target as "_blank".', 'iguru' ),
				'dependency' => [
					'element' => 'link_use',
					'value' => 'true'
				],
				'edit_field_class' => 'vc_col-sm-3',
			],
			[
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_1',
				'edit_field_class' => 'divider',
			],
			[
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Use Hover Animation?', 'iguru' ),
				'param_name' => 'hover_anim',
				'description' => esc_html__( 'Lift up each item on Hover.', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Hide All Icons?', 'iguru' ),
				'param_name' => 'hide_icon',
				'edit_field_class' => 'vc_col-sm-3',
			],
			vc_map_add_css_animation( true ),
			[
				'type' => 'textfield',
				'heading' => esc_html__( 'Extra Class', 'iguru' ),
				'param_name' => 'extra_class',
				'description' => esc_html__('Add an extra class name to the element and refer to it from Custom CSS option.', 'iguru' )
			],
			// CAROUSEL TAB
			[
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Use Carousel', 'iguru' ),
				'param_name' => 'use_carousel',
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Autoplay', 'iguru' ),
				'param_name' => 'autoplay',
				'dependency' => [
					'element' => 'use_carousel',
					'value' => 'true'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-2 no-top-padding',
			],
			[
				'type' => 'textfield',
				'heading' => esc_html__( 'Autoplay Speed', 'iguru' ),
				'param_name' => 'autoplay_speed',
				'value' => '3000',
				'description' => esc_html__( 'Value in milliseconds.', 'iguru' ),
				'dependency' => [
					'element' => 'autoplay',
					'value' => 'true'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3 no-top-padding',
			],
			[ // Carousel pagination heading
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Pagination Controls', 'iguru' ),
				'param_name' => 'h_pag_controls',
				'dependency' => [
					'element' => 'use_carousel',
					'value' => 'true'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
			],
			[
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Pagination control', 'iguru' ),
				'param_name' => 'use_pagination',
				'dependency' => [
					'element' => 'use_carousel',
					'value' => 'true'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
			],
			[
				'type' => 'iguru_radio_image',
				'heading' => esc_html__( 'Pagination Type', 'iguru' ),
				'param_name' => 'pag_type',
				'fields' => [
					'circle' => [
						'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_circle.png',
						'label' => esc_html__( 'Circle', 'iguru' )
					],
					'circle_border' => [
						'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_circle_border.png',
						'label' => esc_html__( 'Empty Circle', 'iguru' )
					],
					'square' => [
						'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_square.png',
						'label' => esc_html__( 'Square', 'iguru' )
					],
					'line' => [
						'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_line.png',
						'label' => esc_html__( 'Line', 'iguru' )
					],
					'line_circle' => [
						'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_line_circle.png',
						'label' => esc_html__( 'Line - Circle', 'iguru' )
					],
				],
				'value' => 'circle',
				'dependency' => [
					'element' => 'use_pagination',
					'value' => 'true',
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
			],
			[
				'type' => 'textfield',
				'heading' => esc_html__( 'Pagination Top Offset', 'iguru' ),
				'param_name' => 'pag_offset',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'use_pagination',
					'value' => 'true',
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			],
			[
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Custom Pagination Color', 'iguru' ),
				'param_name' => 'custom_pag_color',
				'dependency' => [
					'element' => 'use_pagination',
					'value' => 'true',
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Pagination Color', 'iguru' ),
				'param_name' => 'pag_color',
				'value' => $secondary_color,
				'dependency' => [
					'element' => 'custom_pag_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[ // Carousel navigation controls
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Navigation Controls', 'iguru' ),
				'param_name' => 'h_nav_controls',
				'dependency' => [
					'element' => 'use_carousel',
					'value' => 'true'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
			],
			[
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Prev/Next Buttons', 'iguru' ),
				'param_name' => 'use_prev_next',
				'dependency' => [
					'element' => 'use_carousel',
					'value' => 'true'
				],
				'std' => 'true',
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[ // Prev/Next colors checkbox
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Colors', 'iguru' ),
				'param_name' => 'custom_prev_next_color',
				'dependency' => [
					'element' => 'use_prev_next',
					'value' => 'true',
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-9',
			],
			[ // Prev/Next color
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Arrows Idle', 'iguru' ),
				'param_name' => 'prev_next_color',
				'value' => '#ffffff',
				'dependency' => [
					'element' => 'custom_prev_next_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[ // Prev/Next hover color
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Arrows Hover', 'iguru' ),
				'param_name' => 'prev_next_color_hover',
				'value' => '#ffffff',
				'dependency' => [
					'element' => 'custom_prev_next_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_c_1',
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'divider',
			],
			[ // Prev/Next bg idle
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Idle', 'iguru' ),
				'param_name' => 'prev_next_bg_idle',
				'value' => $secondary_color,
				'dependency' => [
					'element' => 'custom_prev_next_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[ // Prev/Next bg hover
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background Hover', 'iguru' ),
				'param_name' => 'prev_next_bg_hover',
				'value' => $secondary_color,
				'dependency' => [
					'element' => 'custom_prev_next_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[ // Carousel responsive settings
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Responsive Settings', 'iguru' ),
				'param_name' => 'h_resp',
				'dependency' => [
					'element' => 'use_carousel',
					'value' => 'true'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
			],
			[
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Responsive', 'iguru' ),
				'param_name' => 'custom_resp',
				'dependency' => [
					'element' => 'use_carousel',
					'value' => 'true'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			],
			[ // Desktop resolution
				'type' => 'textfield',
				'heading' => esc_html__( 'Desktop Screen Breakpoint', 'iguru' ),
				'param_name' => 'resp_medium',
				'value' => '1025',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'custom_resp',
					'value' => 'true',
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			],
			[
				'type' => 'textfield',
				'heading' => esc_html__( 'Slides to show', 'iguru' ),
				'param_name' => 'resp_medium_slides',
				'value' => '',
				'dependency' => [
					'element' => 'custom_resp',
					'value' => 'true',
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			],
			[
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_c_2',
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'divider',
			],
			[ // Tablets resolution
				'type' => 'textfield',
				'heading' => esc_html__( 'Tablet Screen Breakpoint', 'iguru' ),
				'param_name' => 'resp_tablets',
				'value' => '800',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'custom_resp',
					'value' => 'true',
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			],
			[
				'type' => 'textfield',
				'heading' => esc_html__( 'Slides to show', 'iguru' ),
				'param_name' => 'resp_tablets_slides',
				'value' => '',
				'dependency' => [
					'element' => 'custom_resp',
					'value' => 'true',
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			],
			[
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_c_3',
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'divider',
			],
			[ // Mobile resolution
				'type' => 'textfield',
				'heading' => esc_html__( 'Mobile Screen Breakpoint', 'iguru' ),
				'param_name' => 'resp_mobile',
				'value' => '480',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'custom_resp',
					'value' => 'true',
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			],
			[
				'type' => 'textfield',
				'heading' => esc_html__( 'Slides to show', 'iguru' ),
				'param_name' => 'resp_mobile_slides',
				'value' => '',
				'dependency' => [
					'element' => 'custom_resp',
					'value' => 'true',
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			],
			// STYLES TAB
			[
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Name Settings', 'iguru' ),
				'param_name' => 'cat_name_h',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			],
			[
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize colors', 'iguru' ),
				'param_name' => 'custom_name_colors',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3'
			],
			[
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Name Idle', 'iguru' ),
				'param_name' => 'name_color_idle',
				'value' => $h_font_color,
				'dependency' => [
					'element' => 'custom_name_colors',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Name Hover', 'iguru' ),
				'param_name' => 'name_color_hover',
				'value' => $h_font_color,
				'dependency' => [
					'element' => 'custom_name_colors',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_1',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			],
			[
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize font', 'iguru' ),
				'param_name' => 'custom_name_font',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3'
			],
			[
				'type' => 'textfield',
				'heading' => esc_html__( 'Font Size', 'iguru' ),
				'param_name' => 'name_font_size',
				'value' => '48px',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'custom_name_font',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[ // Name line height
				'type' => 'textfield',
				'heading' => esc_html__( 'Line Height', 'iguru' ),
				'param_name' => 'name_line_height',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'custom_name_font',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[ // Name font weight
				'type' => 'dropdown',
				'heading' => esc_html__( 'Font Weight', 'iguru' ),
				'param_name' => 'name_font_weight',
				'description' => esc_html__( 'Select custom value.', 'iguru' ),
				'value' => [
					esc_html__( 'Theme defaults', 'iguru' ) => '',
					esc_html__( '300 / Light', 'iguru' ) => '300',
					esc_html__( '400 / Regular', 'iguru' ) => '400',
					esc_html__( '500 / Medium', 'iguru' ) => '500',
					esc_html__( '600 / SemiBold', 'iguru' ) => '600',
					esc_html__( '700 / Bold', 'iguru' ) => '700',
					esc_html__( '800 / Extra-Bold', 'iguru' ) => '800',
					esc_html__( '900 / Black', 'iguru' ) => '900',
				],
				'dependency' => [
					'element' => 'custom_name_font',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_2',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			],
			[ // Counter settings
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Counter Settings', 'iguru' ),
				'param_name' => 'counter_h',
				'group' => esc_html__( 'Styles', 'iguru' ),
			],
			[
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize colors', 'iguru' ),
				'param_name' => 'custom_count_colors',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3'
			],
			[
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Counter Idle', 'iguru' ),
				'param_name' => 'count_color_idle',
				'value' => $theme_color,
				'dependency' => [
					'element' => 'custom_count_colors',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Counter Hover', 'iguru' ),
				'param_name' => 'count_color_hover',
				'value' => $secondary_color,
				'dependency' => [
					'element' => 'custom_count_colors',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_3',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			],
			[
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Backgrounds', 'iguru' ),
				'param_name' => 'custom_count_backgrounds',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3'
			],
			[
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Counter BG Idle', 'iguru' ),
				'param_name' => 'count_bg_idle',
				'value' => '#ffffff',
				'dependency' => [
					'element' => 'custom_count_backgrounds',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Counter BG Hover', 'iguru' ),
				'param_name' => 'count_bg_hover',
				'value' => '#ffffff',
				'dependency' => [
					'element' => 'custom_count_backgrounds',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_4',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			],
			[
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize font', 'iguru' ),
				'param_name' => 'custom_count_font',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3'
			],
			[
				'type' => 'textfield',
				'heading' => esc_html__( 'Font Size', 'iguru' ),
				'param_name' => 'count_font_size',
				'value' => '16px',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'custom_count_font',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[
				'type' => 'textfield',
				'heading' => esc_html__( 'Line Height', 'iguru' ),
				'param_name' => 'count_line_height',
				'value' => '19px',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'custom_count_font',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Icon Settings', 'iguru' ),
				'param_name' => 'cat_name_h',
				'dependency' => [
					'element' => 'hide_icon',
					'value_not_equal_to' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			],
			[
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Color/Size', 'iguru' ),
				'param_name' => 'custom_icon_settings',
				'dependency' => [
					'element' => 'hide_icon',
					'value_not_equal_to' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3'
			],
			[
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Icon Color Idle', 'iguru' ),
				'param_name' => 'icon_color_idle',
				'value' => '',
				'dependency' => [
					'element' => 'custom_icon_settings',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Icon Color Hover', 'iguru' ),
				'param_name' => 'icon_color_hover',
				'dependency' => [
					'element' => 'custom_icon_settings',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Icon Background Circle', 'iguru' ),
				'param_name' => 'icon_color_bg',
				'value' => '',
				'dependency' => [
					'element' => 'custom_icon_settings',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_5',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			],
			[
				'type' => 'textfield',
				'heading' => esc_html__( 'Icon Font Size', 'iguru' ),
				'param_name' => 'icon_font_size',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'custom_icon_settings',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[
				'type' => 'textfield',
				'heading' => esc_html__( 'Icon Margin Top', 'iguru' ),
				'param_name' => 'icon_margin_top',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'custom_icon_settings',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[
				'type' => 'textfield',
				'heading' => esc_html__( 'Icon Margin Bottom', 'iguru' ),
				'param_name' => 'icon_margin_bottom',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'custom_icon_settings',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Category Item Settings', 'iguru' ),
				'param_name' => 'images_h',
				'group' => esc_html__( 'Styles', 'iguru' ),
			],
			[
				'type' => 'textfield',
				'heading' => esc_html__( 'Items Minimum Height', 'iguru' ),
				'param_name' => 'items_min_height',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_6',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			],
			[
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Backgrounds', 'iguru' ),
				'param_name' => 'custom_cat_backgrounds',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3'
			],
			[
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Item BG Idle', 'iguru' ),
				'param_name' => 'cat_bg_idle',
				'value' => $h_font_color,
				'description' => esc_html__( 'Visible if thumbnails are missing.', 'iguru' ),
				'dependency' => [
					'element' => 'custom_cat_backgrounds',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Item BG Hover', 'iguru' ),
				'param_name' => 'cat_bg_hover',
				'value' => $h_font_color,
				'description' => esc_html__( 'Visible if thumbnails are missing.', 'iguru' ),
				'dependency' => [
					'element' => 'custom_cat_backgrounds',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			],
			[
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_7',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			],
			[
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Disable box-shadow', 'iguru' ),
				'param_name' => 'hide_box_shadow',
				'description' => esc_html__( 'Hide theme default shadows.', 'iguru' ),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3'
			],
		],
	]);

	class WPBakeryShortCode_wgl_lp_categories extends WPBakeryShortCode {
	}
}