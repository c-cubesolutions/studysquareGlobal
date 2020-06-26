<?php

defined( 'ABSPATH' ) || exit;

$header_font = iGuru_Theme_Helper::get_option('header-font');
$main_font = iGuru_Theme_Helper::get_option('main-font');
$theme_color = iGuru_Theme_Helper::get_option('theme-custom-color');

if (function_exists( 'vc_map' )) {
	vc_map( array(
		'base' => 'wgl_blog_posts_medium_img',
		'name' => esc_html__( 'Medium Image', 'iguru' ),
		'description' => esc_html__( 'Display the blog posts', 'iguru' ),
		'category' => esc_html__( 'WGL Blog Modules', 'iguru' ),
		'icon' => 'wgl_icon_blog_medium_img',
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
				'fields' => array(
					'grid' => array(
						'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/layout_grid.png',
						'label' => esc_html__( 'Grid', 'iguru' )),
					'masonry' => array(
						'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/layout_masonry.png',
						'label' => esc_html__( 'Masonry', 'iguru' )),
					'carousel' => array(
						'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/layout_carousel.png',
						'label' => esc_html__( 'Carousel', 'iguru' )),
				),
				'value' => 'grid',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Navigation', 'iguru' ),
				'param_name' => 'blog_navigation',
				'value' => array(
					esc_html__( 'None', 'iguru' ) => 'none',
					esc_html__( 'Pagination', 'iguru' ) => 'pagination',
					esc_html__( 'Load More', 'iguru' ) => 'load_more',
				),
				'std' => 'none',
				'dependency' => array(
					'element' => 'blog_layout',
					'value_not_equal_to' => 'carousel',
				),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Navigation\'s Alignment', 'iguru' ),
				'param_name' => 'blog_navigation_align',
				'value' => array(
					esc_html__( 'Left', 'iguru' ) => 'left',
					esc_html__( 'Center', 'iguru' ) => 'center',
					esc_html__( 'Right', 'iguru' ) => 'right'
				),
				'std' => 'left',
				'dependency' => array(
					'element' => 'blog_navigation',
					'value' => 'pagination'
				),
				'edit_field_class' => 'vc_col-sm-3',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Items on load', 'iguru' ),
				'param_name' => 'items_load',
				'value' => '4',
				'save_always' => true,
				'description' => esc_html__( 'Items amount loaded by \'Load More\' button.', 'iguru' ),
				'dependency' => array(
					'element' => 'blog_navigation',
					"value" => "load_more"
				),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Button Text', 'iguru' ),
				'param_name' => 'name_load_more',
				'value' => esc_html__( 'Load More', 'iguru' ),
				'save_always' => true,
				'dependency' => array(
					'element' => 'blog_navigation',
					"value" => "load_more"
				),
				'edit_field_class' => 'vc_col-sm-3',
			),
			vc_map_add_css_animation( true ),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Extra Class', 'iguru' ),
				'param_name' => 'extra_class',
				'description' => esc_html__( 'Add an extra class name to the element and refer to it from Custom CSS option.', 'iguru' )
			),
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Layout Settings', 'iguru' ),
				'param_name' => 'h_layout_settings',
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Grid Columns Amount', 'iguru' ),
				'param_name' => 'blog_columns',
				'value' => array(
					esc_html__( 'One', 'iguru' ) => '12',
					esc_html__( 'Two', 'iguru' ) => '6',
					esc_html__( 'Three', 'iguru' ) => '4',
					esc_html__( 'Four', 'iguru' ) => '3'
				),
				'std' => '12',
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Post Meta settings
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Content Elements', 'iguru' ),
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
				'heading' => esc_html__( 'Hide all post-meta?', 'iguru' ),
				'param_name' => 'hide_postmeta',
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Hide post-meta author?', 'iguru' ),
				'param_name' => 'meta_author',
				'dependency' => array(
					'element' => 'hide_postmeta',
					'value_not_equal_to' => 'true',
				),
				'std' => 'true',
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Hide post-meta comments?', 'iguru' ),
				'param_name' => 'meta_comments',
				'dependency' => array(
					'element' => 'hide_postmeta',
					'value_not_equal_to' => 'true',
				),
				'std' => 'true',
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Hide post-meta categories?', 'iguru' ),
				'param_name' => 'meta_categories',
				'dependency' => array(
					'element' => 'hide_postmeta',
					'value_not_equal_to' => 'true',
				),
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Hide post-meta date?', 'iguru' ),
				'param_name' => 'meta_date',
				'dependency' => array(
					'element' => 'hide_postmeta',
					'value_not_equal_to' => 'true',
				),
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Hide Likes?', 'iguru' ),
				'param_name' => 'hide_likes',
				'std' => '',
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Hide Post Share?', 'iguru' ),
				'param_name' => 'hide_share',
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Post Read More Link
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Content Trim', 'iguru' ),
				'param_name' => 'h_content_trime',
				'group' => esc_html__( 'Content', 'iguru' ),
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Hide \'Read More\' button?', 'iguru' ),
				'param_name' => 'read_more_hide',
				'std' => '',
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Read More Text', 'iguru' ),
				'param_name' => 'read_more_text',
				'value' => esc_html__( 'View More', 'iguru' ),
				'description' => esc_html__( 'Enter button text.', 'iguru' ),
				'dependency' => [
					'element' => 'read_more_hide',
					'value_not_equal_to' => 'true',
				],
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_c_1',
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			// Content Letter Count
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Characters Amount in Content', 'iguru' ),
				'param_name' => 'content_letter_count',
				'value' => '160',
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
				"type" => "wgl_checkbox",
				'heading' => esc_html__( 'Autoplay', 'iguru' ),
				"param_name" => "autoplay",
				'dependency' => [
					'element' => 'blog_layout',
					'value' => 'carousel'
				],
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__( 'Autoplay Speed', 'iguru' ),
				"param_name" => "autoplay_speed",
				"dependency" => [
					"element" => "autoplay",
					"value" => 'true'
				],
				"value" => "3000",
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Carousel pagination heading
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
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'dependency' => [
					'element' => 'use_pagination',
					'value' => 'true',
				],
				'value' => 'circle',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Pagination Top Offset', 'iguru' ),
				'param_name' => 'pag_offset',
				'value' => '',
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
				'description' => esc_html__( 'Enter pagination top offset in pixels.', 'iguru' ),
				'dependency' => array(
					'element' => 'use_pagination',
					'value' => 'true',
				),
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Custom Pagination Color', 'iguru' ),
				'param_name' => 'custom_pag_color',
				'edit_field_class' => 'vc_col-sm-4',
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'dependency' => array(
					'element' => 'use_pagination',
					'value' => 'true',
				),
			),
			array(
				'type' => 'colorpicker',
				'heading' => esc_html__( 'Pagination Color', 'iguru' ),
				'param_name' => 'pag_color',
				'value' => esc_attr($theme_color),
				'dependency' => array(
					'element' => 'custom_pag_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// carousel pagination heading            
			// carousel navigation heading
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Navigation Controls', 'iguru' ),
				'param_name' => 'h_nav_controls',
				'dependency' => array(
					'element' => 'blog_layout',
					'value' => 'carousel'
				),
				'group' => esc_html__( 'Carousel', 'iguru' ),
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Navigation control', 'iguru' ),
				'param_name' => 'use_navigation',
				'dependency' => array(
					'element' => 'blog_layout',
					'value' => 'carousel'
				),
				'std' => 'true',
				'group' => esc_html__( 'Carousel', 'iguru' ),
			),
			// carousel navigation heading
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Responsive', 'iguru' ),
				'param_name' => 'h_resp',
				'dependency' => array(
					'element' => 'blog_layout',
					'value' => 'carousel'
				),
				'group' => esc_html__( 'Carousel', 'iguru' ),
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Customize Responsive', 'iguru' ),
				'param_name' => 'custom_resp',
				'dependency' => array(
					'element' => 'blog_layout',
					'value' => 'carousel'
				),
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-12 no-top-margin',
			),
			// medium desktop
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Medium Desktop', 'iguru' ),
				'param_name' => 'h_resp_medium',
				'dependency' => array(
					'element' => 'custom_resp',
					'value' => 'true',
				),
				'group' => esc_html__( 'Carousel', 'iguru' ),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Screen resolution', 'iguru' ),
				'param_name' => 'resp_medium',
				'value' => '1025',
				'dependency' => array(
					'element' => 'custom_resp',
					'value' => 'true',
				),
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Slides to show', 'iguru' ),
				'param_name' => 'resp_medium_slides',
				'value' => '',
				'dependency' => array(
					'element' => 'custom_resp',
					'value' => 'true',
				),
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			// tablets
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Tablets', 'iguru' ),
				'param_name' => 'h_resp_tablets',
				'dependency' => array(
					'element' => 'custom_resp',
					'value' => 'true',
				),
				'group' => esc_html__( 'Carousel', 'iguru' ),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Screen resolution', 'iguru' ),
				'param_name' => 'resp_tablets',
				'value' => '800',
				'dependency' => array(
					'element' => 'custom_resp',
					'value' => 'true',
				),
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Slides to show', 'iguru' ),
				'param_name' => 'resp_tablets_slides',
				'value' => '',
				'dependency' => array(
					'element' => 'custom_resp',
					'value' => 'true',
				),
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			// mobile phones
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Mobile Phones', 'iguru' ),
				'param_name' => 'h_resp_mobile',
				'dependency' => array(
					'element' => 'custom_resp',
					'value' => 'true',
				),
				'group' => esc_html__( 'Carousel', 'iguru' ),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Screen resolution', 'iguru' ),
				'param_name' => 'resp_mobile',
				'value' => '480',
				'dependency' => array(
					'element' => 'custom_resp',
					'value' => 'true',
				),
				'group' => esc_html__( 'Carousel', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-6',
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
				'edit_field_class' => 'vc_col-sm-6',
			),

			// STYLES TAB
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Heading tag', 'iguru' ),
				'param_name' => 'heading_tag',
				'value' => array(
					esc_html__( 'H1', 'iguru' ) => 'h1',
					esc_html__( 'H2', 'iguru' ) => 'h2',
					esc_html__( 'H3', 'iguru' ) => 'h3',
					esc_html__( 'H4', 'iguru' ) => 'h4',
					esc_html__( 'H5', 'iguru' ) => 'h5',
					esc_html__( 'H6', 'iguru' ) => 'h6',
				),
				'std' => 'h4',
				'description' => esc_html__( 'Select Type Heading tag.', 'iguru' ),
				'group' => esc_html__( 'Styles', 'iguru' ),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Heading margin bottom', 'iguru' ),
				'param_name' => 'heading_margin_bottom',
				'value' => '10px',
				'save_always' => true,
				'group' => esc_html__( 'Styles', 'iguru' ),
			),  
			// Blog Headings Font
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Blog Headings Styles', 'iguru' ),
				'param_name' => 'blog_heading_styles',
				'group' => esc_html__( 'Styles', 'iguru' ),
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Custom font family for Blog Headings', 'iguru' ),
				'param_name' => 'custom_fonts_blog_headings',
				'group' => esc_html__( 'Styles', 'iguru' ),
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
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Custom font size for Blog Headings', 'iguru' ),
				'param_name' => 'custom_fonts_blog_size_headings',
				'group' => esc_html__( 'Styles', 'iguru' ),
			),
			// Heading Font Size
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Heading Font Size', 'iguru' ),
				'param_name' => 'heading_font_size',
				'value' => '24',
				'description' => esc_html__( 'Enter heading font-size in pixels.', 'iguru' ),
				'dependency' => array(
					'element' => 'custom_fonts_blog_size_headings',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Heading Line Height', 'iguru' ),
				'param_name' => 'heading_line_height',
				'value' => '34',
				'description' => esc_html__( 'Enter heading line-height in pixels.', 'iguru' ),
				'dependency' => array(
					'element' => 'custom_fonts_blog_size_headings',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Use Custom Heading Color', 'iguru' ),
				'param_name' => 'use_custom_heading_color',
				'description' => esc_html__( 'Select custom color', 'iguru' ),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'colorpicker',
				'class' => '',
				'heading' => esc_html__( 'Custom Headings Color', 'iguru' ),
				'param_name' => 'custom_headings_color',
				'value' => esc_attr($header_font['color']),
				'description' => esc_html__( 'Select custom headings color.', 'iguru' ),
				'dependency' => array(
					'element' => 'use_custom_heading_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			array(
				'type' => 'colorpicker',
				'class' => '',
				'heading' => esc_html__( 'Custom Hover Headings Color', 'iguru' ),
				'param_name' => 'custom_hover_headings_color',
				'value' => esc_attr($theme_color),
				'description' => esc_html__( 'Select custom hover headings color.', 'iguru' ),
				'dependency' => array(
					'element' => 'use_custom_heading_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Blog Font
			// Blog Headings Font
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Blog Content Styles', 'iguru' ),
				'param_name' => 'blog_content_styles',
				'group' => esc_html__( 'Styles', 'iguru' ),
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Custom font family for Blog Content', 'iguru' ),
				'param_name' => 'custom_fonts_blog_content',
				'group' => esc_html__( 'Styles', 'iguru' ),
			),
			array(
				'type' => 'google_fonts',
				'param_name' => 'google_fonts_blog',
				'value' => '',
				'dependency' => array(
					'element' => 'custom_fonts_blog_content',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Custom font size for Blog Content', 'iguru' ),
				'param_name' => 'custom_fonts_blog_size_content',
				'group' => esc_html__( 'Styles', 'iguru' ),
			),
			// Heading Font Size
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Content Font Size', 'iguru' ),
				'param_name' => 'content_font_size',
				'value' => '16',
				'description' => esc_html__( 'Enter content font-size in pixels.', 'iguru' ),
				'dependency' => array(
					'element' => 'custom_fonts_blog_size_content',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Content Line Height', 'iguru' ),
				'param_name' => 'content_line_height',
				'value' => '30',
				'description' => esc_html__( 'Enter content line-height in pixels.', 'iguru' ),
				'dependency' => array(
					'element' => 'custom_fonts_blog_size_content',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Use Custom Content Color', 'iguru' ),
				'param_name' => 'use_custom_content_color',
				'description' => esc_html__( 'Select custom color', 'iguru' ),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			array(
				'type' => 'colorpicker',
				'class' => '',
				'heading' => esc_html__( 'Custom Content Color', 'iguru' ),
				'param_name' => 'custom_content_color',
				'value' => esc_attr($main_font['color']),
				'description' => esc_html__( 'Select custom content color.', 'iguru' ),
				'dependency' => array(
					'element' => 'use_custom_content_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-6',
			),
			 // Blog Style
			array(
				'type' => 'iguru_param_heading',
				'heading' => esc_html__( 'Blog Styles', 'iguru' ),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'param_name' => 'blog_content_styles',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Use Custom Main Color', 'iguru' ),
				'param_name' => 'use_custom_main_color',
				'description' => esc_html__( 'Custom blog font size and font color.', 'iguru' ),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-7',
			),
			// Custom blog style
			array(
				'type' => 'colorpicker',
				'class' => '',
				'heading' => esc_html__( 'Custom Main Color', 'iguru' ),
				'param_name' => 'custom_main_color',
				'value' => '#abaebe',
				'description' => esc_html__( 'Select custom main color.', 'iguru' ),
				'dependency' => array(
					'element' => 'use_custom_main_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-5 clearfix-col',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_1',
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Use Custom Read More Color', 'iguru' ),
				'param_name' => 'use_custom_read_color',
				'description' => esc_html__( 'Custom read more color.', 'iguru' ),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4',
			),
			// Custom blog style
			array(
				'type' => 'colorpicker',
				'class' => '',
				'heading' => esc_html__( 'Read More Color', 'iguru' ),
				'param_name' => 'custom_read_more_color',
				'value' => esc_attr($theme_color),
				'description' => esc_html__( 'Select read more color.', 'iguru' ),
				'dependency' => array(
					'element' => 'use_custom_read_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4 clearfix-col',
			), 
			array(
				'type' => 'colorpicker',
				'class' => '',
				'heading' => esc_html__( 'Hover Read More Color', 'iguru' ),
				'param_name' => 'custom_hover_read_more_color',
				'value' => esc_attr($main_font['color']),
				'description' => esc_html__( 'Select read more color.', 'iguru' ),
				'dependency' => array(
					'element' => 'use_custom_read_color',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-4 clearfix-col',
			),
			array(
				'type' => 'iguru_param_heading',
				'param_name' => 'divider_s_2',
				'group' => esc_html__( 'Content', 'iguru' ),
				'edit_field_class' => 'divider',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Mask Image', 'iguru' ),
				'param_name' => 'custom_blog_mask',
				'description' => esc_html__( 'Custom blog image', 'iguru' ),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-7',
			),
			array(
				'type' => 'colorpicker',
				'class' => '',
				'heading' => esc_html__( 'Mask Image Color', 'iguru' ),
				'param_name' => 'custom_image_mask_color',
				'value' => esc_attr( 'rgba(14,21,30,.6)' ),
				'dependency' => array(
					'element' => 'custom_blog_mask',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-5',
			),
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Hover Mask', 'iguru' ),
				'param_name' => 'custom_blog_hover_mask',
				'description' => esc_html__( 'Custom blog hover mask', 'iguru' ),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-7',
			),
			array(
				'type' => 'colorpicker',
				'class' => '',
				'heading' => esc_html__( 'Mask Hover Image Color', 'iguru' ),
				'param_name' => 'custom_image_hover_mask_color',
				'value' => esc_attr( 'rgba(14,21,30,.6)' ),
				'dependency' => array(
					'element' => 'custom_blog_hover_mask',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-5',
			), 
			array(
				'type' => 'wgl_checkbox',
				'heading' => esc_html__( 'Add Background to Items', 'iguru' ),
				'param_name' => 'custom_blog_bg_item',
				'description' => esc_html__( 'Custom background items', 'iguru' ),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-7',
			),
			array(
				'type' => 'colorpicker',
				'class' => '',
				'heading' => esc_html__( 'Background Color', 'iguru' ),
				'param_name' => 'custom_bg_color',
				'value' => esc_attr( 'rgba(19,17,31,1)' ),
				'dependency' => array(
					'element' => 'custom_blog_bg_item',
					'value' => 'true'
				),
				'group' => esc_html__( 'Styles', 'iguru' ),
				'edit_field_class' => 'vc_col-sm-5',
			), 
		),

	));
	
	iGuru_Loop_Settings::init( 'wgl_blog_posts_medium_img' );
	
	class WPBakeryShortCode_wgl_Blog_Posts_Medium_Img extends WPBakeryShortCode
	{
	}
	

}