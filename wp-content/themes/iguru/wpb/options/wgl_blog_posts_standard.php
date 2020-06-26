<?php

defined( 'ABSPATH' ) || exit;

$theme_color = esc_attr(iGuru_Theme_Helper::get_option('theme-custom-color'));
$header_font_color = esc_attr(iGuru_Theme_Helper::get_option('header-font')['color']);
$main_font_color = esc_attr(iGuru_Theme_Helper::get_option('main-font')['color']);

if (function_exists( 'vc_map' )) {
	vc_map(array(
		'base' => 'wgl_blog_posts_standard',
		'name' => esc_html__( 'Blog Posts', 'iguru' ),
		'description' => esc_html__( 'Display the blog posts', 'iguru' ),
		'category' => esc_html__( 'WGL Blog Modules', 'iguru' ),
		'icon' => 'wgl_icon_blog',
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Blog Title', 'iguru' ),
				'param_name' => 'blog_title',
				'admin_label' => true,
			),
			array(
				'type' => 'textarea', 
				'heading' => esc_html__( 'Blog Subtitle', 'iguru' ),
				'param_name' => 'blog_subtitle',
				'admin_label' => true,
			),
			array(
				'type' => 'iguru_radio_image',
				'heading' => esc_html__( 'Layout', 'iguru' ),
				'param_name' => 'blog_layout',
				'fields' => [
					'grid' => [
						'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/layout_grid.png',
						'label' => esc_html__( 'Grid', 'iguru' )
					],
					'masonry' => [
						'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/layout_masonry.png',
						'label' => esc_html__( 'Masonry', 'iguru' )
					],
					'carousel' => [
						'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/layout_carousel.png',
						'label' => esc_html__( 'Carousel', 'iguru' )
					],
				],
				'value' => 'grid',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Navigation Type', 'iguru' ),
				'param_name' => 'blog_navigation',
				'value' => [
					esc_html__( 'None', 'iguru' ) => 'none',
					esc_html__( 'Pagination', 'iguru' ) => 'pagination',
					esc_html__( 'Load More', 'iguru' ) => 'load_more',
				],
				'std' => 'none',
				'dependency' => [
					'element' => 'blog_layout',
					'value_not_equal_to' => 'carousel',
				],
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Navigation\'s Alignment', 'iguru' ),
				'param_name' => 'blog_navigation_align',
				'value' => [
					esc_html__( 'Left', 'iguru' ) => 'left',
					esc_html__( 'Center', 'iguru' ) => 'center',
					esc_html__( 'Right', 'iguru' ) => 'right'
				],
				'std' => 'left',
				'dependency' => [
					'element' => 'blog_navigation',
					'value' => 'pagination'
				],
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Items to be loaded', 'iguru' ),
				'param_name' => 'items_load',
				'value' => '4',
				'save_always' => true,
				'description' => esc_html__( 'Items amount loaded by \'Load More\' button.', 'iguru' ),
				'dependency' => [
					'element' => 'blog_navigation',
					'value' => 'load_more'
				],
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Button Text', 'iguru' ),
				'param_name' => 'name_load_more',
				'value' => esc_html__( 'Load More', 'iguru' ),
				'save_always' => true,
				'dependency' => [
					'element' => 'blog_navigation',
					'value' => 'load_more'
				],
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_1',
				'edit_field_class' => 'divider',
			),
			// Hover effect
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Enable Hover Animation', 'iguru' ),
				'param_name' => 'hover_animation',
				'description' => esc_html__( 'Lift up the item on Hover State.', 'iguru'),
				'edit_field_class' => 'vc_col-sm-3',
			),
			vc_map_add_css_animation( true ),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Extra Class', 'iguru' ),
				'param_name' => 'extra_class',
				'description' => esc_html__('Add an extra class name to the element and refer to it from Custom CSS option.', 'iguru' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Grid Columns Amount', 'iguru' ),
				'param_name' => 'blog_columns',
				'value' => [
					esc_html__( 'One', 'iguru' ) => '12',
					esc_html__( 'Two', 'iguru' ) => '6',
					esc_html__( 'Three', 'iguru' ) => '4',
					esc_html__( 'Four', 'iguru' ) => '3'
				],
				'std' => '12',
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4 no-top-margin',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_co_1',
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Post Content Alignment', 'iguru' ),
				'param_name' => 'blog_content_align',
				'value' => [
					esc_html__( 'Left', 'iguru' ) => '',
					esc_html__( 'Center', 'iguru' ) => 'center',
					esc_html__( 'Right', 'iguru' ) => 'right',
				],
				'std' => '',
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4 no-top-margin',
			),
			// Post Meta settings
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Content Elements Switches', 'iguru' ),
				'param_name' => 'h_content_elements',
				'group' => esc_html__( 'Content', 'iguru' ),
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Hide Media?', 'iguru' ),
				'param_name' => 'hide_media',
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Hide Title?', 'iguru' ),
				'param_name' => 'hide_blog_title',
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Hide Content?', 'iguru' ),
				'param_name' => 'hide_content',
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Hide all meta data?', 'iguru' ),
				'param_name' => 'hide_postmeta',
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Hide post author?', 'iguru' ),
				'param_name' => 'meta_author',
				'dependency' => [
					'element' => 'hide_postmeta',
					'value_not_equal_to' => 'true',
				],
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Hide post comments?', 'iguru' ),
				'param_name' => 'meta_comments',
				'std' => 'true',
				'dependency' => [
					'element' => 'hide_postmeta',
					'value_not_equal_to' => 'true',
				],
				'edit_field_class' => 'vc_col-sm-4',
				'group' => esc_html__( 'Content', 'iguru' ),
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Hide post categories?', 'iguru' ),
				'param_name' => 'meta_categories',
				'dependency' => array(
					'element' => 'hide_postmeta',
					'value_not_equal_to' => 'true',
				),
				'edit_field_class' => 'vc_col-sm-4',
				'group' => esc_html__( 'Content', 'iguru' ),
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Hide post date?', 'iguru' ),
				'param_name' => 'meta_date',
				'dependency' => [
					'element' => 'hide_postmeta',
					'value_not_equal_to' => 'true',
				],
				'edit_field_class' => 'vc_col-sm-4',
				'group' => esc_html__( 'Content', 'iguru' ),
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Hide post likes?', 'iguru' ),
				'param_name' => 'hide_likes',
				'std' => 'true',
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Hide post shares?', 'iguru' ),
				'param_name' => 'hide_share',
				'std' => 'true',
				'edit_field_class' => 'vc_col-sm-4',
				'group' => esc_html__( 'Content', 'iguru' ),
			),
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Content Settings', 'iguru' ),
				'param_name' => 'h_content_trime',
				'group' => esc_html__( 'Content', 'iguru' ),
			),
			// Read more button
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Hide \'Read More\' button?', 'iguru' ),
				'param_name' => 'read_more_hide',
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Read More Text', 'iguru' ),
				'param_name' => 'read_more_text',
				'description' => esc_html__( 'Enter button text.', 'iguru' ),
				'value' => esc_html__( 'View More', 'iguru' ),
				'dependency' => [
					'element' => 'read_more_hide',
					'value_not_equal_to' => 'true',
				],
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_co_2',
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			// Content limitation
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Characters Amount in Content', 'iguru' ),
				'param_name' => 'content_letter_count',
				'value' => '216',
				'description' => esc_html__( 'Limit the content to be displayed.', 'iguru' ),
				'dependency' => [
					'element' => 'hide_content',
					'value_not_equal_to' => 'true',
				],
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Crop Images for Posts List?', 'iguru' ),
				'param_name' => 'crop_square_img',
				'std' => 'true',
				'description' => esc_html__( 'For correctly work uploaded image size should be larger than 700px height and width.', 'iguru' ),
				'group' => esc_html__( 'Content', 'iguru' ),
			),
			// CAROUSEL TAB
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Autoplay', 'iguru' ),
				'param_name' => 'autoplay',
				'dependency' => [
					'element' => 'blog_layout',
					'value' => 'carousel'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-1',
			),
			array(
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
			),
			// carousel pagination heading
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Pagination Controls', 'iguru' ),
				'param_name' => 'h_pag_controls',
				'dependency' => [
					'element' => 'blog_layout',
					'value' => 'carousel'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Pagination control', 'iguru' ),
				'param_name' => 'use_pagination',
				'dependency' => [
					'element' => 'blog_layout',
					'value' => 'carousel'
				],
				'std' => 'true',
				'group' => esc_html__( 'Carousel', 'iguru' ),
			),
			array(
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
				'dependency' => array(
					'element' => 'use_pagination',
					'value' => 'true',
				),
				'group' => esc_html__( 'Carousel', 'iguru' ),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Pagination Top Offset', 'iguru' ),
				'param_name' => 'pag_offset',
				'value' => '',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'use_pagination',
					'value' => 'true',
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Custom Pagination Color', 'iguru' ),
				'param_name' => 'custom_pag_color',
				'dependency' => [
					'element' => 'use_pagination',
					'value' => 'true',
				],
				'edit_field_class' => 'vc_col-sm-3',
				'group' => esc_html__( 'Carousel', 'iguru' ),
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Pagination Color', 'iguru' ),
				'param_name' => 'pag_color',
				'value' => $theme_color,
				'dependency' => [
					'element' => 'custom_pag_color',
					'value' => 'true'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Carousel navigation controls
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Navigation Controls', 'iguru' ),
				'param_name' => 'h_nav_controls',
				'dependency' => [
					'element' => 'blog_layout',
					'value' => 'carousel'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Navigation control', 'iguru' ),
				'param_name' => 'use_navigation',
				'dependency' => [
					'element' => 'blog_layout',
					'value' => 'carousel'
				],
				'std' => 'true',
				'group' => esc_html__( 'Carousel', 'iguru' ),
			),
			// Carousel responsive settings
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Responsive Settings', 'iguru' ),
				'param_name' => 'h_resp',
				'dependency' => [
					'element' => 'blog_layout',
					'value' => 'carousel'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Responsive', 'iguru' ),
				'param_name' => 'custom_resp',
				'dependency' => [
					'element' => 'blog_layout',
					'value' => 'carousel'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
			),
			// Desktop screen breakpoint
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Desktop Screen Breakpoint', 'iguru' ),
				'param_name' => 'resp_medium',
				'value' => '1025',
				'dependency' => [
					'element' => 'custom_resp',
					'value' => 'true',
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
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
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_c_1',
				'dependency' => [
					'element' => 'custom_resp',
					'value' => 'true',
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			// Tablet screen breakpoint
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Tablet Screen Breakpoint', 'iguru' ),
				'param_name' => 'resp_tablets',
				'value' => '800',
				'dependency' => [
					'element' => 'custom_resp',
					'value' => 'true',
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
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
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_c_2',
				'dependency' => array(
					'element' => 'custom_resp',
					'value' => 'true',
				),
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			// Mobile screen breakpoint
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Mobile Screen Breakpoint', 'iguru' ),
				'param_name' => 'resp_mobile',
				'value' => '480',
				'dependency' => array(
					'element' => 'custom_resp',
					'value' => 'true',
				),
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Slides to show', 'iguru' ),
				'param_name' => 'resp_mobile_slides',
				'value' => '',
				'dependency' => array(
					'element' => 'custom_resp',
					'value' => 'true',
				),
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// STYLES TAB
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Headings Styles', 'iguru' ),
				'param_name' => 'blog_heading_styles',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			// Heading tag dropdown
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Heading Tag', 'iguru' ),
				'param_name' => 'heading_tag',
				'value' => [
					esc_html__( '‹h1›', 'iguru' ) => 'h1',
					esc_html__( '‹h2›', 'iguru' ) => 'h2',
					esc_html__( '‹h3›', 'iguru' ) => 'h3',
					esc_html__( '‹h4›', 'iguru' ) => 'h4',
					esc_html__( '‹h5›', 'iguru' ) => 'h5',
					esc_html__( '‹h6›', 'iguru' ) => 'h6',
				],
				'std' => 'h3',
				'description' => esc_html__( 'Select your html tag.', 'iguru' ),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Heading Margin Bottom', 'iguru' ),
				'param_name' => 'heading_margin_bottom',
				'value' => '13px',
				'save_always' => true,
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_1',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize font family', 'iguru' ),
				'param_name' => 'custom_fonts_blog_headings',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'google_fonts_blog_headings',
				'value' => '',
				'dependency' => array(
					'element' => 'custom_fonts_blog_headings',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-9',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_2',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize font size', 'iguru' ),
				'param_name' => 'custom_fonts_blog_size_headings',
				'std' => 'true',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Headings font size
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Font Size', 'iguru' ),
				'param_name' => 'heading_font_size',
				'value' => '30',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'custom_fonts_blog_size_headings',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Line Height', 'iguru' ),
				'param_name' => 'heading_line_height',
				'value' => '46',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => [
					'element' => 'custom_fonts_blog_size_headings',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Font Weight', 'iguru' ),
				'param_name' => 'heading_font_weight',
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
				'std' => '800',
				'dependency' => [
					'element' => 'custom_fonts_blog_size_headings',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'description' => esc_html__( 'Select custom value.', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_3',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize colors', 'iguru' ),
				'param_name' => 'use_custom_heading_color',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'class' => '',
				'heading' => esc_html__( 'Heading Idle', 'iguru' ),
				'param_name' => 'custom_headings_color',
				'value' => $header_font_color,
				'dependency' => array(
					'element' => 'use_custom_heading_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'class' => '',
				'heading' => esc_html__( 'Heading Hover', 'iguru' ),
				'param_name' => 'custom_hover_headings_color',
				'value' => $theme_color,
				'dependency' => array(
					'element' => 'use_custom_heading_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Content Styles', 'iguru' ),
				'param_name' => 'blog_content_styles',
				'group' => esc_html__( 'Styles', 'iguru' ),
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize font family', 'iguru' ),
				'param_name' => 'custom_fonts_blog_content',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'google_fonts_blog_content',
				'value' => '',
				'dependency' => [
					'element' => 'custom_fonts_blog_content',
					'value' => 'true'
				],
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-9',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_4',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize font size', 'iguru' ),
				'param_name' => 'custom_fonts_blog_size_content',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Font Size
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Content Font Size', 'iguru' ),
				'param_name' => 'content_font_size',
				'value' => '16',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => array(
					'element' => 'custom_fonts_blog_size_content',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Content Line Height', 'iguru' ),
				'param_name' => 'content_line_height',
				'value' => '30',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => array(
					'element' => 'custom_fonts_blog_size_content',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_5',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize colors', 'iguru' ),
				'param_name' => 'use_custom_content_color',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Content Color', 'iguru' ),
				'param_name' => 'custom_content_color',
				'value' => $main_font_color,
				'dependency' => array(
					'element' => 'use_custom_content_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Meta styles
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Meta Styles', 'iguru' ),
				'param_name' => 'blog_meta_styles',
				'group' => esc_html__( 'Styles', 'iguru' ),
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize font family', 'iguru' ),
				'param_name' => 'custom_fonts_blog_meta',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'google_fonts_blog_meta',
				'value' => '',
				'dependency' => array(
					'element' => 'custom_fonts_blog_meta',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-9',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_6',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize font size', 'iguru' ),
				'param_name' => 'custom_fonts_blog_size_meta',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Heading Font Size
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Blog Meta Font Size', 'iguru' ),
				'param_name' => 'meta_font_size',
				'value' => '14',
				'description' => esc_html__( 'Value in pixels.', 'iguru' ),
				'dependency' => array(
					'element' => 'custom_fonts_blog_size_meta',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3 clearfix-col',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_7',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize main color', 'iguru' ),
				'param_name' => 'use_custom_main_color',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Custom blog style
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Main Color', 'iguru' ),
				'param_name' => 'custom_main_color',
				'value' => '#abaebe',
				'description' => esc_html__( 'Custom blog meta info color.', 'iguru' ),
				'dependency' => array(
					'element' => 'use_custom_main_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_8',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize \'Read More\' Color', 'iguru' ),
				'param_name' => 'use_custom_read_color',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Custom blog style
			array(
				'type' => 'colorpicker',
				'class' => '',
				'heading' => esc_html__( 'Read More Idle', 'iguru' ),
				'param_name' => 'custom_read_more_color',
				'value' => $theme_color,
				'dependency' => array(
					'element' => 'use_custom_read_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Read More Hover', 'iguru' ),
				'param_name' => 'custom_hover_read_more_color',
				'value' => $main_font_color,
				'dependency' => array(
					'element' => 'use_custom_read_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			// Blog Style
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Media Styles', 'iguru' ),
				'param_name' => 'blog_content_styles',
				'group' => esc_html__( 'Styles', 'iguru' ),
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Image Idle Overlay', 'iguru' ),
				'param_name' => 'custom_blog_mask',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'class' => '',
				'heading' => esc_html__( 'Image Overlay Idle', 'iguru' ),
				'param_name' => 'custom_image_mask_color',
				'value' => esc_attr( 'rgba(14,21,30,.6)' ),
				'dependency' => array(
					'element' => 'custom_blog_mask',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Image Hover Overlay', 'iguru' ),
				'param_name' => 'custom_blog_hover_mask',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Image Overlay Hover', 'iguru' ),
				'param_name' => 'custom_image_hover_mask_color',
				'value' => esc_attr( 'rgba(14,21,30,.6)' ),
				'dependency' => array(
					'element' => 'custom_blog_hover_mask',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_9',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Items Background', 'iguru' ),
				'param_name' => 'custom_blog_bg_item',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Background', 'iguru' ),
				'param_name' => 'custom_bg_color',
				'value' => esc_attr( 'rgba(19,17,31,1)' ),
				'dependency' => array(
					'element' => 'custom_blog_bg_item',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-3',
			),
		),
	));
	
	iGuru_Loop_Settings::init( 'wgl_blog_posts_standard' );
	
	class WPBakeryShortCode_wgl_Blog_Posts_Standard extends WPBakeryShortCode {
	}
}