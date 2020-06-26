<?php

defined( 'ABSPATH' ) || exit;

$theme_color = esc_attr(iGuru_Theme_Helper::get_option('theme-custom-color'));
$theme_color_secondary = esc_attr(iGuru_Theme_Helper::get_option('theme-secondary-color'));
$header_font_color = esc_attr(iGuru_Theme_Helper::get_option('header-font')['color']);
$main_font_color = esc_attr(iGuru_Theme_Helper::get_option('main-font')['color']);
$theme_gradient = iGuru_Theme_Helper::get_option('theme-gradient');

if (function_exists('vc_map')) {
  vc_map( array(
	'name' => esc_html__( 'Portfolio List', 'iguru-core' ),
	'base' => $this->shortcodeName,
	'class' => 'iguru_portfolio_list',
	'category' => esc_html__( 'WGL Modules', 'iguru-core' ),
	'icon' => 'wgl_icon_portfolio_module',
	'content_element' => true,
	'description' => esc_html__( 'Portfolio List', 'iguru-core' ),
	'params' => array(
		array(
			'type' => 'iguru_radio_image',
			'heading' => esc_html__( 'Overall Layout', 'iguru-core' ),
			'param_name' => 'portfolio_layout',
			'fields' => [
				'grid' => [
					'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/layout_grid.png',
					'label' => esc_html__( 'Grid', 'iguru-core' )
				],
				'carousel' => [
					'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/layout_carousel.png',
					'label' => esc_html__( 'Carousel', 'iguru-core' )
				],
				'masonry' => [
					'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/layout_masonry.png',
					'label' => esc_html__( 'Masonry', 'iguru-core' )
				],
				'masonry2' => [
					'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/layout_masonry.png',
					'label' => esc_html__( 'Masonry 2', 'iguru-core' )
				],
				'masonry3' => [
					'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/layout_masonry.png',
					'label' => esc_html__( 'Masonry 3', 'iguru-core' )
				],
				'masonry4' => [
					'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/layout_masonry.png',
					'label' => esc_html__( 'Masonry 4', 'iguru-core' )
				],
			],
			'value' => 'grid',
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Columns Amount', 'iguru-core' ),
			'param_name' => 'posts_per_row',
			'admin_label' => true,
			'value' => [
				esc_html__( '1', 'iguru-core' ) => '1',
				esc_html__( '2', 'iguru-core' ) => '2',
				esc_html__( '3', 'iguru-core' ) => '3',
				esc_html__( '4', 'iguru-core' ) => '4',
				esc_html__( '5', 'iguru-core' ) => '5',
			],
			'std' => '3',
			'dependency' => [
				'element' => 'portfolio_layout',
				'value' => [ 'grid', 'masonry', 'carousel' ]
			],
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Grid Gap', 'iguru-core' ),
			'param_name' => 'grid_gap',
			'value' => [
				esc_html__( '0', 'iguru-core' ) => '0px',
				esc_html__( '1', 'iguru-core' ) => '1px',
				esc_html__( '2', 'iguru-core' ) => '2px',
				esc_html__( '3', 'iguru-core' ) => '3px',
				esc_html__( '4', 'iguru-core' ) => '4px',
				esc_html__( '5', 'iguru-core' ) => '5px',
				esc_html__( '10', 'iguru-core' ) => '10px',
				esc_html__( '15', 'iguru-core' ) => '15px',
				esc_html__( '20', 'iguru-core' ) => '20px',
				esc_html__( '25', 'iguru-core' ) => '25px',
				esc_html__( '30', 'iguru-core' ) => '30px',
				esc_html__( '35', 'iguru-core' ) => '35px',
			],
			'std' => '30px',
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'type' => 'iguru_param_heading',
			'param_name' => 'divider_1',
			'edit_field_class' => 'divider',
		),
		array(
			'type' => 'wgl_checkbox',
			'heading' => esc_html__( 'Show Filter', 'iguru-core' ),
			'param_name' => 'show_filter',
			'value' => [ esc_html__( 'Yes', 'iguru-core' ) => 'yes' ],
			'std' => '',
			'save_always' => true,
			'dependency' => [
				'element' => 'portfolio_layout',
				'value' => [ 'grid', 'masonry', 'masonry2', 'masonry3', 'masonry4' ]
			],
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Filter Align', 'iguru-core' ),
			'param_name' => 'filter_align',
			'value' => array(
				esc_html__( 'Left', 'iguru-core' ) => 'left',
				esc_html__( 'Right', 'iguru-core' ) => 'right',
				esc_html__( 'Center', 'iguru-core' ) => 'center',
			),
			'std' => 'center',
			'dependency' => [
				'element' => 'show_filter',
				'value' => 'yes'
			],
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'type' => 'wgl_checkbox',
			'heading' => esc_html__( 'Crop Images', 'iguru-core' ),
			'param_name' => 'crop_images',
			'value' => [ esc_html__( 'Yes', 'iguru-core' ) => 'yes' ],
			'std' => 'yes',
			'save_always' => true,
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Navigation Type', 'iguru-core' ),
			'param_name' => 'navigation',
			'admin_label' => true,
			'save_always' => true,
			'value' => array(
				esc_html__( 'None', 'iguru-core' ) => 'none',
				esc_html__( 'Pagination', 'iguru-core' ) => 'pagination',
				esc_html__( 'Infinite Scroll', 'iguru-core' ) => 'infinite',
				esc_html__( 'Load More', 'iguru-core' ) => 'load_more',
			),
			'dependency' => [
				'element' => 'portfolio_layout',
				'value' => [ 'grid', 'masonry', 'masonry2', 'masonry3', 'masonry4' ]
			],
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Navigation\'s Alignment', 'iguru-core' ),
			'param_name' => 'nav_align',
			'value' => [
				esc_html__( 'Center', 'iguru-core' ) => 'center',
				esc_html__( 'Left', 'iguru-core' ) => 'left',
				esc_html__( 'Right', 'iguru-core' ) => 'right'
			],
			'std' => 'center',
			'dependency' => [
				'element' => 'navigation',
				'value' => 'pagination',
			],
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Items amount to be loaded', 'iguru-core' ),
			'param_name' => 'items_load',
			'value' => '4',
			'save_always' => true,
			'dependency' => [
				'element' => 'navigation',
				'value' => [ 'load_more', 'infinite' ]
			],
			'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Button Text', 'iguru-core' ),
			'param_name' => 'name_load_more',
			'value' => esc_html__( 'Load More', 'iguru-core' ),
			'save_always' => true,
			'dependency' => [
				'element' => 'navigation',
				'value' => 'load_more'
			],
			'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type' => 'iguru_param_heading',
			'param_name' => 'divider_2',
			'edit_field_class' => 'divider',
		),
		array(
			'type' => 'wgl_checkbox',
			'heading' => esc_html__( 'Add Appear Animation', 'iguru-core' ),
			'param_name' => 'add_animation',
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Animation Style', 'iguru-core' ),
			'param_name' => 'appear_animation',
			'value' => [
				esc_html__( 'Fade In', 'iguru-core' ) => 'fade-in',
				esc_html__( 'Slide Top', 'iguru-core' ) => 'slide-top',
				esc_html__( 'Slide Bottom', 'iguru-core' ) => 'slide-bottom',
				esc_html__( 'Slide Left', 'iguru-core' ) => 'slide-left',
				esc_html__( 'Slide Right', 'iguru-core' ) => 'slide-right',
				esc_html__( 'Zoom', 'iguru-core' ) => 'zoom',
			],
			'std' => 'fade-in',
			'dependency' => [
				'element' => 'add_animation',
				'value' => 'true'
			],
			'edit_field_class' => 'vc_col-sm-3',
		), 
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra Class', 'iguru-core' ),
			'param_name' => 'item_el_class',
			'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'iguru-core' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Action if Item Clicked', 'iguru-core' ),
			'param_name' => 'click_area',
			'admin_label' => true,
			'value' => [
				esc_html__( 'Open Portfolio Single', 'iguru-core' ) => 'single',
				esc_html__( 'Popup the Image', 'iguru-core' ) => 'popup',
				esc_html__( 'Open Custom Link', 'iguru-core' ) => 'custom',
				esc_html__( 'Do Nothing', 'iguru-core' ) => 'none',
			],
			'std' => 'popup',
			'group' => esc_html__( 'Content', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-8',
		),
		array(
			'type' => 'wgl_checkbox',
			'heading' => esc_html__( 'Link the Title with Single Page', 'iguru-core' ),
			'param_name' => 'single_link_title',
			'std' => 'true',
			'group' => esc_html__( 'Content', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-4 no-top-padding',
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Content Position', 'iguru-core' ),
			'param_name' => 'info_position',
			'value' => [
				esc_html__( 'Inside Image', 'iguru-core' ) => 'inside_image',
				esc_html__( 'Under Image', 'iguru-core' ) => 'under_image',
			],
			'std' => 'inside_image',
			'group' => esc_html__( 'Content', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Content Appear Animation', 'iguru-core' ),
			'param_name' => 'image_anim',
			'value' => [
				esc_html__( 'Fade Out', 'iguru-core' ) => 'fade_out',
				esc_html__( 'Outline', 'iguru-core' ) => 'outline',
				esc_html__( 'Zoom In', 'iguru-core' ) => 'zoom_in',
				esc_html__( 'Side Offset', 'iguru-core' ) => 'offset',
			],
			'dependency' => [
				'element' => 'info_position',
				'value' => 'inside_image'
			],
			'group' => esc_html__( 'Content', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type' => 'wgl_checkbox',
			'heading' => esc_html__( 'Reverse Animation?', 'iguru-core' ),
			'param_name' => 'image_anim_reverse',
			'value' => [ esc_html__( 'Yes', 'iguru-core' ) => 'yes' ],
			'std' => '',
			'description' => esc_html__( 'Show content until hover.', 'iguru-core' ),
			'dependency' => [
				'element' => 'info_position',
				'value' => 'inside_image'
			],
			'group' => esc_html__( 'Content', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Content Alignment', 'iguru-core' ),
			'param_name' => 'horizontal_align',
			'value' => [
				esc_html__( 'Left', 'iguru-core' ) => 'Left',
				esc_html__( 'Center', 'iguru-core' ) => 'center',
				esc_html__( 'Right', 'iguru-core' ) => 'right'
			],
			'std' => 'center',
			'dependency' => [
				'element' => 'info_position',
				'value' => [ 'under_image' ]
			],
			'group' => esc_html__( 'Content', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type' => 'iguru_param_heading',
			'heading' => esc_html__( 'Content Elements', 'iguru-core' ),
			'param_name' => 'h_content_elements',
			'group' => esc_html__( 'Content', 'iguru-core' ),
		),
		array(
			'type' => 'wgl_checkbox',
			'heading' => esc_html__( 'Show Title?', 'iguru-core' ),
			'param_name' => 'show_portfolio_title',
			'std' => 'true',
			'group' => esc_html__( 'Content', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'type' => 'wgl_checkbox',
			'heading' => esc_html__( 'Show Categories?', 'iguru-core' ),
			'param_name' => 'show_meta_categories',
			'std' => 'true',
			'group' => esc_html__( 'Content', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'type' => 'wgl_checkbox',
			'heading' => esc_html__( 'Show Content?', 'iguru-core' ),
			'param_name' => 'show_content',
			'group' => esc_html__( 'Content', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		// Content Letter Count
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Characters Amount in Content', 'iguru-core' ),
			'param_name' => 'content_letter_count',
			'value' => '85',
			'description' => esc_html__( 'Limit the content to be displayed.', 'iguru-core' ),
			'dependency' => [
				'element' => 'show_content',
				'value' => 'true'
			],
			'group' => esc_html__( 'Content', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-6',
		),
		// CAROUSEL TAB
		array(
			'type' => 'iguru_param_heading',
			'heading' => esc_html__( 'Carousel Options', 'iguru-core' ),
			'param_name' => 'h_portfolio_carousel',
			'dependency' => [
				'element' => 'portfolio_layout',
				'value' => 'carousel'
			],
			'group' => esc_html__( 'Carousel', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-12 no-top-margin',
		),
		array(
			'type' => 'wgl_checkbox',
			'heading' => esc_html__( 'Autoplay', 'iguru-core' ),
			'param_name' => 'autoplay',
			'dependency' => [
				'element' => 'portfolio_layout',
				'value' => 'carousel'
			],
			'group' => esc_html__( 'Carousel', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-2',
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Autoplay Speed', 'iguru-core' ),
			'param_name' => 'autoplay_speed',
			'dependency' => [
				'element' => 'autoplay',
				'value' => 'true'
			],
			'value' => '3000',
			'description' => esc_html__( 'Value in miliseconds.', 'iguru-core' ),
			'group' => esc_html__( 'Carousel', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-3',
		),

		array(
			'type' => 'wgl_checkbox',
			'heading' => esc_html__( 'Slide Multiple Items', 'iguru-core' ),
			'param_name' => 'multiple_items',
			'dependency' => [
				'element' => 'portfolio_layout',
				'value' => 'carousel'
			],
			'group' => esc_html__( 'Carousel', 'iguru-core' ),
		),
		// carousel pagination heading
		array(
			'type' => 'iguru_param_heading',
			'heading' => esc_html__( 'Pagination Controls', 'iguru-core' ),
			'param_name' => 'h_pag_controls',
			'dependency' => [
				'element' => 'portfolio_layout',
				'value' => 'carousel'
			],
			'group' => esc_html__( 'Carousel', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-12',
		),
		array(
			'type' => 'wgl_checkbox',
			'heading' => esc_html__( 'Add Pagination control', 'iguru-core' ),
			'param_name' => 'use_pagination',
			'dependency' => [
				'element' => 'portfolio_layout',
				'value' => 'carousel'
			],
			'std' => 'true',
			'group' => esc_html__( 'Carousel', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-12',
		),
		array(
			'type' => 'iguru_radio_image',
			'heading' => esc_html__( 'Pagination Type', 'iguru-core' ),
			'param_name' => 'pag_type',
			'fields' => [
				'circle' => [
					'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_circle.png',
					'label' => esc_html__( 'Circle', 'iguru-core' )
				],
				'circle_border' => [
					'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_circle_border.png',
					'label' => esc_html__( 'Empty Circle', 'iguru-core' )
				],
				'square' => [
					'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_square.png',
					'label' => esc_html__( 'Square', 'iguru-core' )
				],
				'line' => [
					'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_line.png',
					'label' => esc_html__( 'Line', 'iguru-core' )
				],
				'line_circle' => [
					'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_line_circle.png',
					'label' => esc_html__( 'Line - Circle', 'iguru-core' )
				],
			],
			'value' => 'circle',
			'dependency' => [
				'element' => 'use_pagination',
				'value' => 'true',
			],
			'group' => esc_html__( 'Carousel', 'iguru-core' ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Pagination Top Offset', 'iguru-core' ),
			'param_name' => 'pag_offset',
			'value' => '',
			'description' => esc_html__( 'Value in pixels.', 'iguru-core' ),
			'dependency' => [
				'element' => 'use_pagination',
				'value' => 'true',
			],
			'group' => esc_html__( 'Carousel', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type' => 'wgl_checkbox',
			'heading' => esc_html__( 'Customize Color', 'iguru-core' ),
			'param_name' => 'custom_pag_color',
			'dependency' => [
				'element' => 'use_pagination',
				'value' => 'true',
			],
			'group' => esc_html__( 'Carousel', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Pagination Color', 'iguru-core' ),
			'param_name' => 'pag_color',
			'value' => $theme_color,
			'dependency' => [
				'element' => 'custom_pag_color',
				'value' => 'true'
			],
			'group' => esc_html__( 'Carousel', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		// Responsive settings
		array(
			'type' => 'iguru_param_heading',
			'heading' => esc_html__( 'Responsive Settings', 'iguru-core' ),
			'param_name' => 'h_resp',
			'dependency'    => array(
				'element'   => 'portfolio_layout',
				'value' => 'carousel'
			),
			'group' => esc_html__( 'Carousel', 'iguru-core' ),
		),
		array(
			'type' => 'wgl_checkbox',
			'heading' => esc_html__( 'Customize Responsive', 'iguru-core' ),
			'param_name' => 'custom_resp',
			'dependency'    => array(
				'element'   => 'portfolio_layout',
				'value' => 'carousel'
			),
			'group' => esc_html__( 'Carousel', 'iguru-core' ),
		),
		// Medium desktop
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Desktop Screen Breakpoint', 'iguru-core' ),
			'param_name' => 'resp_medium',
			'value' => '1025',
			'description' => esc_html__( 'Value in pixels.', 'iguru-core' ),
			'dependency' => [
				'element' => 'custom_resp',
				'value' => 'true',
			],
			'group' => esc_html__( 'Carousel', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Slides to show', 'iguru-core' ),
			'param_name' => 'resp_medium_slides',
			'value' => '',
			'dependency' => [
				'element' => 'custom_resp',
				'value' => 'true',
			],
			'group' => esc_html__( 'Carousel', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'type' => 'iguru_param_heading',
			'param_name' => 'divider_c_1',
			'dependency' => [
				'element' => 'custom_resp',
				'value' => 'true',
			],
			'group' => esc_html__( 'Carousel', 'iguru-core' ),
			'edit_field_class' => 'divider',
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Tablets Screen Breakpoint', 'iguru-core' ),
			'param_name' => 'resp_tablets',
			'value' => '800',
			'description' => esc_html__( 'Value in pixels.', 'iguru-core' ),
			'dependency' => [
				'element' => 'custom_resp',
				'value' => 'true',
			],
			'group' => esc_html__( 'Carousel', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Slides to show', 'iguru-core' ),
			'param_name' => 'resp_tablets_slides',
			'value' => '',
			'dependency' => [
				'element' => 'custom_resp',
				'value' => 'true',
			],
			'group' => esc_html__( 'Carousel', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'type' => 'iguru_param_heading',
			'param_name' => 'divider_c_2',
			'dependency' => [
				'element' => 'custom_resp',
				'value' => 'true',
			],
			'group' => esc_html__( 'Carousel', 'iguru-core' ),
			'edit_field_class' => 'divider',
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Mobiles Screen Breakpoint', 'iguru-core' ),
			'param_name' => 'resp_mobile',
			'value' => '480',
			'description' => esc_html__( 'Value in pixels.', 'iguru-core' ),
			'dependency' => [
				'element' => 'custom_resp',
				'value' => 'true',
			],
			'group' => esc_html__( 'Carousel', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Slides to show', 'iguru-core' ),
			'param_name' => 'resp_mobile_slides',
			'value' => '',
			'dependency' => [
				'element' => 'custom_resp',
				'value' => 'true',
			],
			'group' => esc_html__( 'Carousel', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		// STYLE TAB
		// Portfolio Headings Font
		array(
			'type' => 'iguru_param_heading',
			'heading' => esc_html__( 'Typography', 'iguru-core' ),
			'param_name' => 'h_typography',
			'group' => esc_html__( 'Style', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-12 no-top-margin',
		),
		// Heading Font Size
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Headings Font Size', 'iguru-core' ),
			'param_name' => 'heading_font_size',
			'value' => '',
			'save_always' => true,
			'description' => esc_html__( 'Value in pixels.', 'iguru-core' ),
			'group' => esc_html__( 'Style', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Categories Font Size', 'iguru-core' ),
			'param_name' => 'cat_font_size',
			'value' => '',
			'save_always' => true,
			'description' => esc_html__( 'Value in pixels.', 'iguru-core' ),
			'group' => esc_html__( 'Style', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type' => 'iguru_param_heading',
			'param_name' => 'divider_s_1',
			'group' => esc_html__( 'Style', 'iguru-core' ),
			'edit_field_class' => 'divider',
		),
		array(
			'type' => 'wgl_checkbox',
			'heading' => esc_html__( 'Customize Headings Font Family', 'iguru-core' ),
			'param_name' => 'custom_fonts_portfolio_headings',
			'group' => esc_html__( 'Style', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-4',
		),
		array(
			'type' => 'google_fonts',
			'param_name' => 'google_fonts_portfolio_headings',
			'value' => '',
			'settings' => array(
				'fields' => array(
					'font_family_description' => esc_html__( 'Select font family.', 'iguru-core' ),
					'font_style_description' => esc_html__( 'Select font styling.', 'iguru-core' ),
				),
			),
			'dependency' => [
				'element' => 'custom_fonts_portfolio_headings',
				'value' => 'true'
			],
			'group' => esc_html__( 'Style', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-8',
		),
		// Colors Settings
		array(
			'type' => 'iguru_param_heading',
			'heading' => esc_html__( 'Colors Settings', 'iguru-core' ),
			'param_name' => 'h_heading_colors',
			'group' => esc_html__( 'Style', 'iguru-core' ),
		),
		array(
			'type' => 'wgl_checkbox',
			'heading' => esc_html__( 'Customize Headings', 'iguru-core' ),
			'param_name' => 'custom_heading',
			'group' => esc_html__( 'Style', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Heading Idle', 'iguru-core' ),
			'param_name' => 'heading_color',
			'value' => '#ffffff',
			'save_always' => true,
			'dependency' => [
				'element' => 'custom_heading',
				'value' => 'true'
			],
			'group' => esc_html__( 'Style', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Heading Hover', 'iguru-core' ),
			'param_name' => 'heading_color_hover',
			'value' => $theme_color,
			'save_always' => true,
			'dependency' => [
				'element' => 'custom_heading',
				'value' => 'true'
			],
			'group' => esc_html__( 'Style', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'type' => 'iguru_param_heading',
			'param_name' => 'divider_s_2',
			'group' => esc_html__( 'Style', 'iguru-core' ),
			'edit_field_class' => 'divider',
		),
		array(
			'type' => 'wgl_checkbox',
			'heading' => esc_html__( 'Customize Categories', 'iguru-core' ),
			'param_name' => 'custom_cat',
			'group' => esc_html__( 'Style', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Categories Idle', 'iguru-core' ),
			'param_name' => 'cat_color',
			'value' => $theme_color_secondary,
			'dependency' => [
				'element' => 'custom_cat',
				'value' => 'true'
			],
			'group' => esc_html__( 'Style', 'iguru-core' ),
			'save_always' => true,
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Categories Hover', 'iguru-core' ),
			'param_name' => 'cat_color_hover',
			'value' => 'rgba(255,255,255,0.8)',
			'dependency' => [
				'element' => 'custom_cat',
				'value' => 'true'
			],
			'group' => esc_html__( 'Style', 'iguru-core' ),
			'save_always' => true,
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'type' => 'iguru_param_heading',
			'param_name' => 'divider_s_3',
			'group' => esc_html__( 'Style', 'iguru-core' ),
			'edit_field_class' => 'divider',
		),
		array(
			'type' => 'wgl_checkbox',
			'heading' => esc_html__( 'Customize Content', 'iguru-core' ),
			'param_name' => 'custom_content',
			'group' => esc_html__( 'Style', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Content Color', 'iguru-core' ),
			'param_name' => 'content_color',
			'value' => $main_font_color,
			'save_always' => true,
			'dependency' => [
				'element' => 'custom_content',
				'value' => 'true'
			],
			'group' => esc_html__( 'Style', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'type' => 'iguru_param_heading',
			'param_name' => 'divider_s_4',
			'group' => esc_html__( 'Style', 'iguru-core' ),
			'edit_field_class' => 'divider',
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Customize Overlay', 'iguru-core' ),
			'param_name' => 'bg_color_type',
			'value' => [
				esc_html__( 'Theme Default', 'iguru-core' ) => 'def',
				esc_html__( 'Color', 'iguru-core' ) => 'color',
				esc_html__( 'Gradient', 'iguru-core' ) => 'gradient',
			],
			'std' => 'def',
			'group' => esc_html__( 'Style', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		// Overlay bg color
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Overlay Background', 'iguru-core' ),
			'param_name' => 'background_color',
			'value' => 'rgba(65, 65, 65, 0.65)',
			'dependency' => [
				'element' => 'bg_color_type',
				'value' => 'color'
			],
			'group' => esc_html__( 'Style', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		// Overlay bg gradient start
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Overlay Background Start', 'iguru-core' ),
			'param_name' => 'background_gradient_start',
			'value' => 'rgba( '.iGuru_Theme_Helper::HexToRGB($theme_gradient['from']).', 0.85)',
			'dependency' => [
				'element' => 'bg_color_type',
				'value' => 'gradient'
			],
			'group' => esc_html__( 'Style', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		// Overlay bg gradient end
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Overlay Background End', 'iguru-core' ),
			'param_name' => 'background_gradient_end',
			'value' => 'rgba( '.iGuru_Theme_Helper::HexToRGB($theme_gradient['to']).', 0.85)',
			'dependency' => [
				'element' => 'bg_color_type',
				'value' => 'gradient'
			],
			'group' => esc_html__( 'Style', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'type' => 'iguru_param_heading',
			'param_name' => 'divider_s_5',
			'group' => esc_html__( 'Style', 'iguru-core' ),
			'edit_field_class' => 'divider',
		),
		// Outline color
		array(
			'type' => 'wgl_checkbox',
			'heading' => esc_html__( 'Customize Outline', 'iguru-core' ),
			'param_name' => 'custom_outline',
			'dependency' => [
				'element' => 'image_anim',
				'value' => array( 'outline', 'offset' )
			],
			'group' => esc_html__( 'Style', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Outline Color', 'iguru-core' ),
			'param_name' => 'outline_color',
			'value' => $theme_color,
			'save_always' => true,
			'dependency' => [
				'element' => 'custom_outline',
				'value' => 'true'
			],
			'group' => esc_html__( 'Style', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Outline Background', 'iguru-core' ),
			'param_name' => 'outline_bg',
			'value' => $theme_color,
			'save_always' => true,
			'dependency' => [
				'element' => 'custom_outline',
				'value' => 'true'
			],
			'group' => esc_html__( 'Style', 'iguru-core' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
	)
) );

	iGuru_Loop_Settings::init(
		$this->shortcodeName,
		[
			'hide_cats' => true,
			'hide_tags' => true
		]
	);
}
?>