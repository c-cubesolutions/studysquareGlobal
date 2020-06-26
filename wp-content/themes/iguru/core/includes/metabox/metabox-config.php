<?php 

if ( ! class_exists('RWMB_Loader') ) { return; }

class iGuru_Metaboxes{
	public function __construct(){
		// Team Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'team_meta_boxes' ) );

		// Portfolio Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'portfolio_meta_boxes' ) );
		add_filter( 'rwmb_meta_boxes', array( $this, 'portfolio_post_settings_meta_boxes' ) );
		add_filter( 'rwmb_meta_boxes', array( $this, 'portfolio_related_meta_boxes' ) );

		// Blog Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'blog_settings_meta_boxes' ) );
		add_filter( 'rwmb_meta_boxes', array( $this, 'blog_meta_boxes' ) );
		add_filter( 'rwmb_meta_boxes', array( $this, 'blog_related_meta_boxes' ));
		
		// Page Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_layout_meta_boxes' ) );
		// Colors Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_color_meta_boxes' ) );
		// Logo Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_logo_meta_boxes' ) );
		// Header Builder Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_header_meta_boxes' ) );
		// Title Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_title_meta_boxes' ) );
		// Side Panel Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_side_panel_meta_boxes' ) );

		// Social Shares Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_soc_icons_meta_boxes' ) );
		// Footer Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_footer_meta_boxes' ) );
		// Copyright Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'page_copyright_meta_boxes' ) );

		// Shop Single Fields Metaboxes
		add_filter( 'rwmb_meta_boxes', array( $this, 'shop_catalog_meta_boxes' ) );
		add_filter( 'rwmb_meta_boxes', array( $this, 'shop_single_meta_boxes' ) );
	}

	public function team_meta_boxes( $meta_boxes ) {
		$meta_boxes[] = [
			'title'      => esc_html__( 'Team Options', 'iguru' ),
			'post_types' => [ 'team' ],
			'context'    => 'advanced',
			'fields'     => [
				[
					'name'  => esc_html__( 'Department Name', 'iguru' ),
					'id'    => 'department_name',
					'type'  => 'text',
					'class' => 'name-field'
				], [
					'name'  => esc_html__( 'Position', 'iguru' ),
					'id'    => 'department',
					'type'  => 'text',
					'class' => 'field-inputs'
				], [
					'name'  => esc_html__( 'Member Info', 'iguru' ),
					'id'    => 'info_items',
					'type'  => 'social',
					'clone' => true,
					'sort_clone' => true,
					'options' => [
						'name' => [
							'name' => esc_html__( 'Name', 'iguru' ),
							'type_input' => 'text'
						],
						'description' => [
							'name' => esc_html__( 'Description', 'iguru' ),
							'type_input' => 'text'
						],
						'link' => [
							'name' => esc_html__( 'Link', 'iguru' ),
							'type_input' => 'text'
						],
					],
				], [
					'name' => esc_html__( 'Social Icons', 'iguru' ),
					'id' => 'soc_icon',
					'type' => 'select_icon',
					'options' => WglAdminIcon()->get_icons_name(),
					'clone' => true,
					'sort_clone' => true,
					'placeholder' => esc_html__( 'Select an icon', 'iguru' ),
					'multiple'  => false,
					'std' => 'default',
				], [
					'name' => esc_html__( 'Info Description', 'iguru' ),
					'id' => 'mb_team_editor',
					'type' => 'wysiwyg',
					'multiple'  => false,
					'desc' => esc_html__( 'Info description is shown in one row with a main info', 'iguru' ),
				], [
					'name' => esc_html__( 'Info Background Image', 'iguru' ),
					'id' => 'mb_info_bg',
					'type' => 'file_advanced',
					'max_file_uploads' => 1,
					'mime_type' => 'image',
					'desc' => esc_html__( 'For instance, personal signature.', 'iguru' ),
				], 
			],
		];
		return $meta_boxes;
	}
	
	public function portfolio_meta_boxes( $meta_boxes ) {
		$meta_boxes[] = array(
			'title'      => esc_html__( 'Portfolio Options', 'iguru' ),
			'post_types' => [ 'portfolio' ],
			'context'    => 'advanced',
			'fields'     => array(
				array(
					'id'   => 'mb_portfolio_featured_img',
					'name' => esc_html__( 'Show Featured image on single', 'iguru' ),
					'type' => 'switch',
					'std'  => 'true',
				), 	
				array(
					'id'   => 'mb_portfolio_title',
					'name' => esc_html__( 'Show Title on single', 'iguru' ),
					'type' => 'switch',
					'std'  => 'true',
				),
				array(
					'id'   => 'mb_portfolio_link',
					'name' => esc_html__( 'Add Custom Link for Portfolio Grid', 'iguru' ),
					'type' => 'switch',
				),
				array(
					'name' => esc_html__( 'Custom Url for Portfolio Grid', 'iguru' ),
					'id'   => 'portfolio_custom_url',
					'type' => 'text',
					'class' => 'field-inputs',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_portfolio_link', '=', '1' ]
						] ],
					),
				),
				array(
					'id'   => 'portfolio_custom_url_target',
					'name' => esc_html__( 'Open Custom Url in New Window', 'iguru' ),
					'type' => 'switch',
					'std' => 'true',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_portfolio_link', '=', '1' ]
						] ],
					),
				),
				array(
					'name' => esc_html__( 'Info', 'iguru' ),
					'id'   => 'mb_portfolio_info_items',
					'type' => 'social',
					'clone' => true,
					'sort_clone' => true,
					'desc' => esc_html__( 'Description', 'iguru' ),
					'options' => array(
						'name' => array(
							'name'       => esc_html__( 'Name', 'iguru' ),
							'type_input' => 'text'
						),
						'description' => array(
							'name'       => esc_html__( 'Description', 'iguru' ),
							'type_input' => 'text'
						),
						'link' => array(
							'name'       => esc_html__( 'Url', 'iguru' ),
							'type_input' => 'text'
						),
					),
				),
				array(
					'name'     => esc_html__( 'Info Description', 'iguru' ),
					'id'       => 'mb_portfolio_editor',
					'type'     => 'wysiwyg',
					'multiple' => false,
					'desc'     => esc_html__( 'Info description is shown in one row with a main info', 'iguru' ),
				),
				array(
					'name'     => esc_html__( 'Categories On/Off', 'iguru' ),
					'id'       => "mb_portfolio_single_meta_categories",
					'type'     => 'button_group',
					'options'  => array(
						'default' => esc_html__( 'Default', 'iguru' ),
						'yes'     => esc_html__( 'On', 'iguru' ),
						'no'      => esc_html__( 'Off', 'iguru' ),
					),
					'multiple' => false,
					'std'      => 'default',
				),
				array(
					'name'     => esc_html__( 'Date On/Off', 'iguru' ),
					'id'       => "mb_portfolio_single_meta_date",
					'type'     => 'button_group',
					'options'  => array(
						'default' => esc_html__( 'Default', 'iguru' ),
						'yes'     => esc_html__( 'On', 'iguru' ),
						'no'      => esc_html__( 'Off', 'iguru' ),
					),
					'multiple' => false,
					'std'      => 'default',
				),
				array(
					'name'     => esc_html__( 'Tags On/Off', 'iguru' ),
					'id'       => "mb_portfolio_above_content_cats",
					'type'     => 'button_group',
					'options'  => array(
						'default' => esc_html__( 'Default', 'iguru' ),
						'yes'     => esc_html__( 'On', 'iguru' ),
						'no'      => esc_html__( 'Off', 'iguru' ),
					),
					'multiple' => false,
					'std'      => 'default',
				),
				array(
					'name'     => esc_html__( 'Share Links On/Off', 'iguru' ),
					'id'       => "mb_portfolio_above_content_share",
					'type'     => 'button_group',
					'options'  => array(
						'default' => esc_html__( 'Default', 'iguru' ),
						'yes'     => esc_html__( 'On', 'iguru' ),
						'no'      => esc_html__( 'Off', 'iguru' ),
					),
					'multiple' => false,
					'std'      => 'default',
				),
			),
		);
		return $meta_boxes;
	}

	public function portfolio_post_settings_meta_boxes( $meta_boxes ) {
		$meta_boxes[] = array(
			'title'      => esc_html__( 'Portfolio Post Settings', 'iguru' ),
			'post_types' => [ 'portfolio' ],
			'context'    => 'advanced',
			'fields'     => array(
				array(
					'name'     => esc_html__( 'Post Layout', 'iguru' ),
					'id'       => "mb_portfolio_post_conditional",
					'type'     => 'button_group',
					'options'  => array(
						'default' => esc_html__( 'Default', 'iguru' ),
						'custom'  => esc_html__( 'Custom', 'iguru' ),
					),
					'multiple' => false,
					'std'      => 'default',
				), 
				array(
					'name'     => esc_html__( 'Post Layout Settings', 'iguru' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_portfolio_post_conditional', '=', 'custom' ]
						] ],
					),
				),
				array(
					'name'     => esc_html__( 'Post Content Layout', 'iguru' ),
					'id'       => "mb_portfolio_single_type_layout",
					'type'     => 'button_group',
					'multiple' => false,
					'options'  => array(
						'1' => esc_html__( 'Title First', 'iguru' ),
						'2' => esc_html__( 'Image First', 'iguru' ),
						'3' => esc_html__( 'Overlay Image', 'iguru' ),
						'4' => esc_html__( 'Overlay Image with Info', 'iguru' ),
					),
					'std'      => '2',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_portfolio_post_conditional', '=', 'custom' ]
						] ],
					),
				), 
				array(
					'name'     => esc_html__( 'Post Title Alignment', 'iguru' ),
					'id'       => "mb_portfolio_single_align",
					'type'     => 'button_group',
					'multiple' => false,
					'options'  => array(
						'left'   => esc_html__( 'Left', 'iguru' ),
						'center' => esc_html__( 'Center', 'iguru' ),
						'right'  => esc_html__( 'Right', 'iguru' ),
					),
					'std'      => 'left',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_portfolio_post_conditional', '=', 'custom' ]
						] ],
					),
				), 
				array(
					'name' => esc_html__( 'Spacing', 'iguru' ),
					'id'   => 'mb_portfolio_single_padding',
					'type' => 'wgl_offset',
					'options' => array(
						'mode'   => 'padding',
						'top'    => true,
						'right'  => false,
						'bottom' => true,
						'left'   => false,
					),
					'attributes' => array(
						'data-conditional-logic' => [[
							[ 'mb_portfolio_post_conditional', '=', 'custom'],
							[ 'mb_portfolio_single_type_layout', '!=', '1'],
							[ 'mb_portfolio_single_type_layout', '!=', '2'],
						]],
					),
					'std' => array(
						'padding-top'    => '165',
						'padding-bottom' => '165'
					)
				),
				array(
					'id'   => 'mb_portfolio_parallax',
					'name' => esc_html__( 'Add Portfolio Parallax', 'iguru' ),
					'type' => 'switch',
					'attributes' => array(
						'data-conditional-logic'  =>  [[
							[ 'mb_portfolio_post_conditional', '=', 'custom'],
							[ 'mb_portfolio_single_type_layout','!=','1'],
							[ 'mb_portfolio_single_type_layout','!=','2'],
						]],
					),
				),
				array(
					'name' => esc_html__( 'Prallax Speed', 'iguru' ),
					'id'   => "mb_portfolio_parallax_speed",
					'type' => 'number',
					'std'  => 0.3,
					'step' => 0.1,
					'attributes' => array(
						'data-conditional-logic' => [[
							[ 'mb_portfolio_post_conditional', '=', 'custom'],
							[ 'mb_portfolio_single_type_layout','!=','1'],
							[ 'mb_portfolio_single_type_layout','!=','2'],
							[ 'mb_portfolio_parallax','=',true],
						]],
					),
				),
			),
		);
		return $meta_boxes;
	}

	public function portfolio_related_meta_boxes( $meta_boxes ) {
		$meta_boxes[] = array(
			'title'      => esc_html__( 'Related Portfolio', 'iguru' ),
			'post_types' => [ 'portfolio' ],
			'context'    => 'advanced',
			'fields'     => array(
				array(
					'id'      => 'mb_portfolio_related_switch',
					'name'    => esc_html__( 'Portfolio Related', 'iguru' ),
					'type'    => 'button_group',
					'options' => array(
						'default' => esc_html__( 'Default', 'iguru' ),
						'on' => esc_html__( 'On', 'iguru' ),
						'off' => esc_html__( 'Off', 'iguru' ),
					),
					'inline'   => true,
					'multiple' => false,
					'std'      => 'default'
				),
				array(
					'name'     => esc_html__( 'Portfolio Related Settings', 'iguru' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_portfolio_related_switch', '=', 'on' ]
						] ],
					),
				),
				array(
					'id'   => 'mb_pf_carousel_r',
					'name' => esc_html__( 'Display items carousel for this portfolio post', 'iguru' ),
					'type' => 'switch',
					'std'  => 1,
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_portfolio_related_switch', '=', 'on' ]
						] ],
					),
				),
				array(
					'name' => esc_html__( 'Title', 'iguru' ),
					'id'   => "mb_pf_title_r",
					'type' => 'text',
					'std'  => esc_html__( 'Related Portfolio', 'iguru' ),
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_portfolio_related_switch', '=', 'on' ]
						] ],
					),
				), 			
				array(
					'name' => esc_html__( 'Categories', 'iguru' ),
					'id'   => "mb_pf_cat_r",
					'multiple'    => true,
					'type' => 'taxonomy_advanced',
					'taxonomy' => 'portfolio-category',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_portfolio_related_switch', '=', 'on' ]
						] ],
					),
				),   
				array(
					'name'    => esc_html__( 'Columns', 'iguru' ),
					'id'      => "mb_pf_column_r",
					'type'    => 'button_group',
					'options' => array(
						'2' => esc_html__( '2', 'iguru' ),
						'3' => esc_html__( '3', 'iguru' ),
						'4' => esc_html__( '4', 'iguru' ),
					),
					'multiple'   => false,
					'std'        => '3',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_portfolio_related_switch', '=', 'on' ]
						] ],
					),
				),
				array(
					'name' => esc_html__( 'Number of Related Items', 'iguru' ),
					'id'   => "mb_pf_number_r",
					'type' => 'number',
					'min'  => 0,
					'step' => 1,
					'std'  => 3,
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_portfolio_related_switch', '=', 'on' ]
						] ],
					),
				),
			),
		);
		return $meta_boxes;
	}

	public function blog_settings_meta_boxes( $meta_boxes ) {
		$meta_boxes[] = array(
			'title'      => esc_html__( 'Post Settings', 'iguru' ),
			'post_types' => [ 'post' ],
			'context'    => 'advanced',
			'fields'     => array(
				array(
					'name'    => esc_html__( 'Post Layout', 'iguru' ),
					'id'      => 'mb_post_layout_conditional',
					'type'    => 'button_group',
					'options' => array(
						'default' => esc_html__( 'Default', 'iguru' ),
						'custom'  => esc_html__( 'Custom', 'iguru' ),
					),
					'multiple' => false,
					'std'      => 'default',
				), 
				array(
					'name' => esc_html__( 'Post Layout Settings', 'iguru' ),
					'type' => 'wgl_heading',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_post_layout_conditional', '=', 'custom' ]
						] ],
					),
				),
				array(
					'name'    => esc_html__( 'Post Layout', 'iguru' ),
					'id'      => 'mb_single_type_layout',
					'type'    => 'button_group',
					'options' => array(
						'1' => esc_html__( 'Title First', 'iguru' ),
						'2' => esc_html__( 'Image First', 'iguru' ),
						'3' => esc_html__( 'Overlay Image', 'iguru' ),
					),
					'multiple' => false,
					'std'      => '1',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_post_layout_conditional', '=', 'custom' ]
						] ],
					),
				), 
				array(
					'name' => esc_html__( 'Spacing', 'iguru' ),
					'id'   => 'mb_single_padding_layout_3',
					'type' => 'wgl_offset',
					'options' => [
						'mode'   => 'padding',
						'top'    => true,
						'right'  => false,
						'bottom' => false,
						'left'   => false,
					],
					'attributes' => [
						'data-conditional-logic' => [[
							[ 'mb_post_layout_conditional', '=', 'custom' ],
							[ 'mb_single_type_layout', '=', '3' ],
						]],
					],
					'std' => [
						'padding-top' => '285',
					]
				),
				array(
					'id'   => 'mb_single_apply_animation',
					'name' => esc_html__( 'Apply Animation', 'iguru' ),
					'type' => 'switch',
					'std'  => 1,
					'attributes' => [
						'data-conditional-logic' => [[
							[ 'mb_post_layout_conditional', '=', 'custom' ],
							[ 'mb_single_type_layout', '=', '3' ],
						]],
					],
				),
			),
		);
		return $meta_boxes;
	}

	public function blog_meta_boxes( $meta_boxes ) {
		$meta_boxes[] = array(
			'title'      => esc_html__( 'Post Format Layout', 'iguru' ),
			'post_types' => [ 'post' ],
			'context'    => 'advanced',
			'fields'     => array(
				// Standard Post Format
				array(
					'name'  => esc_html__( 'Standard Post( Enabled only Featured Image for this post format)', 'iguru' ),
					'id'    => "post_format_standard",
					'type'  => 'static-text',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'formatdiv', '=', '0' ]
						] ],
					),
				),
				// Gallery Post Format  
				array(
					'name'  => esc_html__( 'Gallery Settings', 'iguru' ),
					'type'  => 'wgl_heading',
				),
				array(
					'name'  => esc_html__( 'Add Images', 'iguru' ),
					'id'    => "post_format_gallery",
					'type'  => 'image_advanced',
					'max_file_uploads' => '',
				),
				// Video Post Format
				array(
					'name' => esc_html__( 'Video Settings', 'iguru' ),
					'type' => 'wgl_heading',
				), 
				array(
					'name' => esc_html__( 'Video Style', 'iguru' ),
					'id'   => "post_format_video_style",
					'type' => 'select',
					'options' => array(
						'bg_video' => esc_html__( 'Background Video', 'iguru' ),
						'popup' => esc_html__( 'Popup', 'iguru' ),
					),
					'multiple' => false,
					'std'      => 'bg_video',
				),
				array(
					'name' => esc_html__( 'Start Video', 'iguru' ),
					'id'   => "start_video",
					'type' => 'number',
					'std'  => '0',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'post_format_video_style', '=', 'bg_video' ],
						] ],
					),
				),
				array(
					'name' => esc_html__( 'End Video', 'iguru' ),
					'id'   => "end_video",
					'type' => 'number',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'post_format_video_style', '=', 'bg_video' ],
						] ],
					),
				),
				array(
					'name' => esc_html__( 'oEmbed URL', 'iguru' ),
					'id'   => "post_format_video_url",
					'type' => 'oembed',
				),
				// Quote Post Format
				array(
					'name' => esc_html__( 'Quote Settings', 'iguru' ),
					'type' => 'wgl_heading',
				), 
				array(
					'name' => esc_html__( 'Quote Text', 'iguru' ),
					'id'   => "post_format_qoute_text",
					'type' => 'textarea',
				),
				array(
					'name' => esc_html__( 'Author Name', 'iguru' ),
					'id'   => "post_format_qoute_name",
					'type' => 'text',
				),
				array(
					'name' => esc_html__( 'Author Position', 'iguru' ),
					'id'   => "post_format_qoute_position",
					'type' => 'text',
				),
				array(
					'name' => esc_html__( 'Author Avatar', 'iguru' ),
					'id'   => "post_format_qoute_avatar",
					'type' => 'image_advanced',
					'max_file_uploads' => 1,
				),
				// Audio Post Format
				array(
					'name' => esc_html__( 'Audio Settings', 'iguru' ),
					'type' => 'wgl_heading',
				), 
				array(
					'name' => esc_html__( 'oEmbed URL', 'iguru' ),
					'id'   => "post_format_audio_url",
					'type' => 'oembed',
				),
				// Link Post Format
				array(
					'name' => esc_html__( 'Link Settings', 'iguru' ),
					'type' => 'wgl_heading',
				), 
				array(
					'name' => esc_html__( 'URL', 'iguru' ),
					'id'   => "post_format_link_url",
					'type' => 'url',
				),
				array(
					'name' => esc_html__( 'Text', 'iguru' ),
					'id'   => "post_format_link_text",
					'type' => 'text',
				),
			)
		);
		return $meta_boxes;
	}

	public function blog_related_meta_boxes( $meta_boxes ) {
		$meta_boxes[] = array(
			'title'      => esc_html__( 'Related Blog Post', 'iguru' ),
			'post_types' => [ 'post' ],
			'context'    => 'advanced',
			'fields'     => array(        	
				array(
					'id'   => 'mb_blog_show_r',
					'name' => esc_html__( 'Related On/Off', 'iguru' ),
					'type' => 'switch',
					'std'  => 1,
				),
				array(
					'name' => esc_html__( 'Related Settings', 'iguru' ),
					'type' => 'wgl_heading',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_blog_show_r', '=', '1' ]
						] ],
					),
				), 
				array(
					'name' => esc_html__( 'Title', 'iguru' ),
					'id'   => "mb_blog_title_r",
					'type' => 'text',
					'std'  => 'Related Posts',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_blog_show_r', '=', '1' ]
						] ],
					),
				), 			
				array(
					'name' => esc_html__( 'Categories', 'iguru' ),
					'id'   => "mb_blog_cat_r",
					'multiple'    => true,
					'type' => 'taxonomy_advanced',
					'taxonomy' => 'category',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_blog_show_r', '=', '1' ]
						] ],
					),
				),   
				array(
					'name' => esc_html__( 'Columns', 'iguru' ),
					'id'   => "mb_blog_column_r",
					'type' => 'button_group',
					'options' => array(
						'12' => esc_html__( '1', 'iguru' ),
						'6'  => esc_html__( '2', 'iguru' ),
						'4'  => esc_html__( '3', 'iguru' ),
						'3'  => esc_html__( '4', 'iguru' ),
					),
					'multiple'   => false,
					'std'        => '6',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_blog_show_r', '=', '1' ]
						] ],
					),
				),
				array(
					'name' => esc_html__( 'Number of Related Items', 'iguru' ),
					'id'   => "mb_blog_number_r",
					'type' => 'number',
					'min'  => 0,
					'step' => 1,
					'std'  => 2,
					'attributes' => array(
						'data-conditional-logic' => array(
							array(
								array('mb_blog_show_r', '=', '1')
							),
						),
					),
				),
				array(
					'id'   => 'mb_blog_carousel_r',
					'name' => esc_html__( 'Display items carousel for this blog post', 'iguru' ),
					'type' => 'switch',
					'std'  => 1,
					'attributes' => array(
						'data-conditional-logic' => array(
							array(
								array('mb_blog_show_r', '=', '1')
							),
						),
					),
				),
			),
		);
		return $meta_boxes;
	}

	public function page_layout_meta_boxes( $meta_boxes ) {

		$meta_boxes[] = array(
			'title'      => esc_html__( 'Page Layout', 'iguru' ),
			'post_types' => [ 'page', 'post', 'team', 'practice', 'portfolio', 'product' ],
			'context'    => 'advanced',
			'fields'     => array(
				array(
					'name'    => esc_html__( 'Page Sidebar Layout', 'iguru' ),
					'id'      => 'mb_page_sidebar_layout',
					'type'    => 'wgl_image_select',
					'options' => array(
						'default' => get_template_directory_uri() . '/core/admin/img/options/1c.png',
						'none'    => get_template_directory_uri() . '/core/admin/img/options/none.png',
						'left'    => get_template_directory_uri() . '/core/admin/img/options/2cl.png',
						'right'   => get_template_directory_uri() . '/core/admin/img/options/2cr.png',
					),
					'std'     => 'default',
				),
				array(
					'name'     => esc_html__( 'Sidebar Settings', 'iguru' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_page_sidebar_layout','!=','default' ],
							[ 'mb_page_sidebar_layout','!=','none' ],
						] ],
					),
				),
				array(
					'name'        => esc_html__( 'Page Sidebar', 'iguru' ),
					'id'          => "mb_page_sidebar_def",
					'type'        => 'select',
					'placeholder' => 'Select a Sidebar',
					'options'     => iguru_get_all_sidebar(),
					'multiple'    => false,
					'attributes'  => array(
						'data-conditional-logic' => [ [
							[ 'mb_page_sidebar_layout','!=','default' ],
							[ 'mb_page_sidebar_layout','!=','none' ],
						] ],
					),
				),
				array(
					'name'    => esc_html__( 'Page Sidebar Width', 'iguru' ),
					'id'      => "mb_page_sidebar_def_width",
					'type'    => 'button_group',
					'options' => array(	
						'9' => esc_html( '25%' ),
						'8' => esc_html( '33%' ),
					),
					'std'  => '9',
					'multiple'   => false,
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_page_sidebar_layout','!=','default' ],
							[ 'mb_page_sidebar_layout','!=','none' ],
						] ],
					),
				),
				array(
					'id'   => 'mb_sticky_sidebar',
					'name' => esc_html__( 'Use Sticky Sidebar?', 'iguru' ),
					'type' => 'switch',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_page_sidebar_layout','!=','default' ],
							[ 'mb_page_sidebar_layout','!=','none' ],
						] ],
					),
				),
				array(
					'name'  => esc_html__( 'Sidebar Side Gap', 'iguru' ),
					'id'    => "mb_sidebar_gap",
					'type'  => 'select',
					'options' => array(	
						'def' => 'Default',
						'0'  => '0',
						'15' => '15',
						'20' => '20',
						'25' => '25',
						'30' => '30',
						'35' => '35',
						'40' => '40',
						'45' => '45',
						'50' => '50',
					),
					'std'        => 'def',
					'multiple'   => false,
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_page_sidebar_layout','!=','default' ],
							[ 'mb_page_sidebar_layout','!=','none' ],
						] ],
					),
				),
			)
		);
		return $meta_boxes;
	}

	public function page_color_meta_boxes( $meta_boxes ) {

		$meta_boxes[] = array(
			'title'      => esc_html__( 'Page Colors', 'iguru' ),
			'post_types' => [ 'page' , 'post', 'team', 'practice','portfolio' ],
			'context'    => 'advanced',
			'fields'     => array(
				array(
					'name'     => esc_html__( 'Page Colors', 'iguru' ),
					'id'       => "mb_page_colors_switch",
					'type'     => 'button_group',
					'options'  => array(
						'default' => esc_html__( 'Default', 'iguru' ),
						'custom'  => esc_html__( 'Custom', 'iguru' ),
					),
					'inline'   => true,
					'multiple' => false,
					'std'      => 'default',
				),
				array(
					'name' => esc_html__( 'Colors Settings', 'iguru' ),
					'type' => 'wgl_heading',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_page_colors_switch', '=', 'custom' ]
						] ],
					),
				),
				array(
					'name' => esc_html__( 'General Theme Color', 'iguru' ),
					'id'   => 'mb_page_theme_color',
					'type' => 'color',
					'std'  => '#fdb900',
					'js_options' => array( 'defaultColor' => '#fdb900' ),
					'validate' => 'color',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_page_colors_switch', '=', 'custom' ],
						] ],
					),
				),
				array(
					'name' => esc_html__( 'Body Background Color', 'iguru' ),
					'id'   => 'mb_body_background_color',
					'type' => 'color',
					'std'  => '#ffffff',
					'js_options' => array( 'defaultColor' => '#ffffff' ),
					'validate'  => 'color',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_page_colors_switch', '=', 'custom' ],
						] ],
					),
				),
				array(
					'name' => esc_html__( 'Scroll Up Settings', 'iguru' ),
					'type' => 'wgl_heading',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_page_colors_switch', '=', 'custom' ]
						] ],
					),
				),
				array(
					'name' => esc_html__( 'Button Background Color', 'iguru' ),
					'id'   => 'mb_scroll_up_bg_color',
					'type' => 'color',
					'std'  => '#fc7268',
					'js_options' => array( 'defaultColor' => '#fc7268' ),
					'validate'  => 'color',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_page_colors_switch', '=', 'custom' ],
						] ],
					),
				),
				array(
					'name' => esc_html__( 'Button Arrow Color', 'iguru' ),
					'id'   => 'mb_scroll_up_arrow_color',
					'type' => 'color',
					'std'  => '#ffffff',
					'js_options' => array( 'defaultColor' => '#ffffff' ),
					'validate'  => 'color',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_page_colors_switch', '=', 'custom' ],
						] ],
					),
				),
			)
		);
		return $meta_boxes;
	}

	public function page_logo_meta_boxes( $meta_boxes ) {
		$meta_boxes[] = array(
			'title'      => esc_html__( 'Logo', 'iguru' ),
			'post_types' => [ 'page', 'post' ],
			'context'    => 'advanced',
			'fields'     => array(
				array(
					'name'     => esc_html__( 'Logo', 'iguru' ),
					'id'       => "mb_customize_logo",
					'type'     => 'button_group',
					'options'  => array(
						'default' => esc_html__( 'Default', 'iguru' ),
						'custom'  => esc_html__( 'Custom', 'iguru' ),
					),
					'multiple' => false,
					'inline'   => true,
					'std'      => 'default',
				),
				array(
					'name' => esc_html__( 'Logo Settings', 'iguru' ),
					'type' => 'wgl_heading',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_customize_logo', '=', 'custom' ]
						] ],
					),
				),
				array(
					'name' => esc_html__( 'Header Logo', 'iguru' ),
					'id'   => "mb_header_logo",
					'type' => 'image_advanced',
					'max_file_uploads' => 1,
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_customize_logo', '=', 'custom' ]
						] ],
					),
				),
				array(
					'id'   => 'mb_logo_height_custom',
					'name' => esc_html__( 'Enable Logo Height', 'iguru' ),
					'type' => 'switch',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_customize_logo', '=', 'custom' ]
						] ],
					),
				),
				array(
					'name' => esc_html__( 'Set Logo Height', 'iguru' ),
					'id'   => "mb_logo_height",
					'type' => 'number',
					'min'  => 0,
					'step' => 1,
					'std'  => 50,
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_customize_logo', '=', 'custom' ],
							[ 'mb_logo_height_custom','=',true ],
						] ],
					),
				),
				array(
					'name' => esc_html__( 'Sticky Logo', 'iguru' ),
					'id'   => "mb_logo_sticky",
					'type' => 'image_advanced',
					'max_file_uploads' => 1,
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_customize_logo', '=', 'custom' ]
						] ],
					),
				),
				array(
					'id'   => 'mb_sticky_logo_height_custom',
					'name' => esc_html__( 'Enable Sticky Logo Height', 'iguru' ),
					'type' => 'switch',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_customize_logo', '=', 'custom' ]
						] ],
					),
				),
				array(
					'name' => esc_html__( 'Set Sticky Logo Height', 'iguru' ),
					'id'   => "mb_sticky_logo_height",
					'type' => 'number',
					'min'  => 0,
					'step' => 1,
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_customize_logo', '=', 'custom' ],
							[ 'mb_sticky_logo_height_custom', '=', true ]
						] ],
					),
				),
				array(
					'name' => esc_html__( 'Mobile Logo', 'iguru' ),
					'id'   => "mb_logo_mobile",
					'type' => 'image_advanced',
					'max_file_uploads' => 1,
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_customize_logo', '=', 'custom' ]
						] ],
					),
				),
				array(
					'id'   => 'mb_mobile_logo_height_custom',
					'name' => esc_html__( 'Enable Mobile Logo Height', 'iguru' ),
					'type' => 'switch',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_customize_logo', '=', 'custom' ]
						] ],
					),
				),
				array(
					'name' => esc_html__( 'Set Mobile Logo Height', 'iguru' ),
					'id'   => "mb_mobile_logo_height",
					'type' => 'number',
					'min'  => 0,
					'step' => 1,
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_customize_logo', '=', 'custom' ],
							[ 'mb_mobile_logo_height_custom', '=', true ]
						] ],
					),
				),
			)
		);
		return $meta_boxes;
	}

	public function page_header_meta_boxes( $meta_boxes ) {
		$meta_boxes[] = array(
			'title'      => esc_html__( 'Header', 'iguru' ),
			'post_types' => [ 'page', 'post', 'portfolio', 'product' ],
			'context'    => 'advanced',
			'fields'     => array(
				array(
					'name'     => esc_html__( 'Header Settings', 'iguru' ),
					'id'       => "mb_customize_header_layout",
					'type'     => 'button_group',
					'options'  => array(
						'default' => esc_html__( 'default', 'iguru' ),
						'custom'  => esc_html__( 'custom', 'iguru' ),
						'hide'    => esc_html__( 'hide', 'iguru' ),
					),
					'multiple' => false,
					'std'      => 'default',
				),
				array(
					'name'     => esc_html__( 'Header Builder', 'iguru' ),
					'id'       => "mb_customize_header",
					'type'     => 'select',
					'options'  => iguru_get_custom_preset(),
					'multiple' => false,
					'std'      => 'default',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_customize_header_layout','!=','hide' ]
						] ],
					),
				),
				// It is works 
				array(
					'id'   => 'mb_menu_header',
					'name' => esc_html__( 'Menu ', 'iguru' ),
					'type' => 'select',
					'options'     => iguru_get_custom_menu(),
					'multiple'    => false,
					'std'         => 'default',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_customize_header_layout', '=', 'custom' ]
						] ],
					),
				),
				array(
					'id'   => 'mb_header_sticky',
					'name' => esc_html__( 'Sticky Header', 'iguru' ),
					'type' => 'switch',
					'std'  => 1,
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_customize_header_layout', '=', 'custom' ]
						] ],
					),
				),
			)
		);
		return $meta_boxes;
	}

	public function page_title_meta_boxes( $meta_boxes ) {
		$meta_boxes[] = array(
			'title'      => esc_html__( 'Page Title', 'iguru' ),
			'post_types' => [ 'page', 'post', 'team', 'practice', 'portfolio', 'product' ],
			'context'    => 'advanced',
			'fields'     => array(
				array(
					'id'      => 'mb_page_title_switch',
					'name'    => esc_html__( 'Page Title', 'iguru' ),
					'type'    => 'button_group',
					'options' => array(
						'default' => esc_html__( 'Default', 'iguru' ),
						'on'      => esc_html__( 'On', 'iguru' ),
						'off'     => esc_html__( 'Off', 'iguru' ),
					),
					'std'      => 'default',
					'inline'   => true,
					'multiple' => false
				),
				array(
					'name' => esc_html__( 'Page Title Settings', 'iguru' ),
					'type' => 'wgl_heading',
					'attributes' => array(
						'data-conditional-logic' => [[
							array( 'mb_page_title_switch', '=', 'on' )
						]],
					),
				),
				array( 
					'id'   => 'mb_page_title_bg_switch',
					'name' => esc_html__( 'Use Color/Image Background?', 'iguru' ),
					'type' => 'switch',
					'std'  => true,
					'attributes' => [
						'data-conditional-logic' => [[
							[ 'mb_page_title_switch', '=', 'on' ]
						]],
					],
				),
				array(
					'id'         => 'mb_page_title_bg',
					'name'       => esc_html__( 'Background', 'iguru' ),
					'type'       => 'wgl_background',
					'image'      => '',
					'position'   => 'center bottom',
					'attachment' => 'scroll',
					'size'       => 'cover',
					'repeat'     => 'no-repeat',
					'color'      => '#f2f2f4',
					'attributes' => [
						'data-conditional-logic' => [[
							[ 'mb_page_title_switch', '=', 'on' ],
							[ 'mb_page_title_bg_switch', '=', true ],
						]],
					],
				),
				array(
					'name' => esc_html__( 'Height', 'iguru' ),
					'id'   => 'mb_page_title_height',
					'type' => 'number',
					'min'  => 0,
					'step' => 1,
					'std'  => 430,
					'attributes' => [
						'data-conditional-logic' => [[
							[ 'mb_page_title_switch', '=', 'on' ],
							[ 'mb_page_title_bg_switch', '=', true ],
						]],
					],
				),
				array(
					'name'    => esc_html__( 'Title HTML Tag', 'iguru' ),
					'id'      => 'mb_page_title_tag',
					'type'    => 'select',
					'options' => [	
						'def' => 'Theme Default',
						'div' => '‹div›',
						'h1'  => '‹h1›',
						'h2'  => '‹h2›',
						'h3'  => '‹h3›',
						'h4'  => '‹h4›',
						'h5'  => '‹h5›',
						'h6'  => '‹h6›',
					],
					'std'    => 'def',
					'multiple' => false,
					'attributes' => [
						'data-conditional-logic' => [[
							[ 'mb_page_title_switch', '=', 'on' ]
						]],
					],
				),
				array(
					'name'     => esc_html__( 'Title Alignment', 'iguru' ),
					'id'       => 'mb_page_title_align',
					'type'     => 'button_group',
					'multiple' => false,
					'options'  => array(
						'left'   => esc_html__( 'left', 'iguru' ),
						'center' => esc_html__( 'center', 'iguru' ),
						'right'  => esc_html__( 'right', 'iguru' ),
					),
					'std'      => 'center',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_page_title_switch', '=', 'on' ]
						] ],
					),
				),
				array(
					'name' => esc_html__( 'Paddings Top/Bottom', 'iguru' ),
					'id'   => 'mb_page_title_padding',
					'type' => 'wgl_offset',
					'options' => array(
						'mode'   => 'padding',
						'top'    => true,
						'right'  => false,
						'bottom' => true,
						'left'   => false,
					),
					'std' => [
						'padding-top'    => '82',
						'padding-bottom' => '72',
					],
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_page_title_switch', '=', 'on' ]
						] ],
					),
				),
				array(
					'name' => esc_html__( 'Margin Bottom', 'iguru' ),
					'id'   => "mb_page_title_margin",
					'type' => 'wgl_offset',
					'options' => array(
						'mode'   => 'margin',
						'top'    => false,
						'right'  => false,
						'bottom' => true,
						'left'   => false,
					),
					'std' => array( 'margin-bottom' => '40' ),
					'attributes' => array(
						'data-conditional-logic'  =>  [[
							[ 'mb_page_title_switch', '=', 'on' ]
						]],
					),
				),
				array(
					'id'   => 'mb_page_title_parallax',
					'name' => esc_html__( 'Parallax Switch', 'iguru' ),
					'type' => 'switch',
					'attributes' => array(
						'data-conditional-logic'  =>  [[
							[ 'mb_page_title_switch', '=', 'on' ]
						]],
					),
				),
				array(
					'name' => esc_html__( 'Prallax Speed', 'iguru' ),
					'id'   => "mb_page_title_parallax_speed",
					'type' => 'number',
					'std'  => 0.3,
					'step' => 0.1,
					'attributes' => array(
						'data-conditional-logic' => [[
							[ 'mb_page_title_parallax','=',true ],
							[ 'mb_page_title_switch', '=', 'on' ],
						]],
					),
				),
				array(
					'id'   => 'mb_page_change_tile_switch',
					'name' => esc_html__( 'Custom Page Title Text', 'iguru' ),
					'type' => 'switch',
					'attributes' => array(
						'data-conditional-logic' => [[
							[ 'mb_page_title_switch', '=', 'on' ]
						]],
					),
				),
				array(
					'id'   => 'mb_page_change_tile',
					'name' => esc_html__( 'Page Title Text', 'iguru' ),
					'type' => 'text',
					'attributes' => array(
						'data-conditional-logic' => [[
							[ 'mb_page_change_tile_switch', '=', '1' ],
							[ 'mb_page_title_switch', '=', 'on' ],
						]],
					),
				),
				array(
					'id'   => 'mb_page_title_breadcrumbs_switch',
					'name' => esc_html__( 'Show Breadcrumbs', 'iguru' ),
					'type' => 'switch',
					'std'  => 1,
					'attributes' => array(
						'data-conditional-logic' => [ [
							array( 'mb_page_title_switch', '=', 'on' )
						] ],
					),
				),
				array(
					'name'     => esc_html__( 'Breadcrumbs Alignment', 'iguru' ),
					'id'       => 'mb_page_title_breadcrumbs_align',
					'type'     => 'button_group',
					'options'  => array(
						'left' => esc_html__( 'left', 'iguru' ),
						'center' => esc_html__( 'center', 'iguru' ),
						'right' => esc_html__( 'right', 'iguru' ),
					),
					'std'      => 'center',
					'multiple' => false,
					'attributes' => [
						'data-conditional-logic' => [[
							[ 'mb_page_title_switch', '=', 'on' ],
							[ 'mb_page_title_breadcrumbs_switch', '=', '1' ]
						]],
					],
				),
				array(
					'name' => esc_html__( 'Page Title Typography', 'iguru' ),
					'type' => 'wgl_heading',
					'attributes' => [
						'data-conditional-logic' => [[
							[ 'mb_page_title_switch', '=', 'on' ]
						]],
					],
				),
				array(
					'name' => esc_html__( 'Page Title Font', 'iguru' ),
					'id'   => 'mb_page_title_font',
					'type' => 'wgl_font',
					'options' => [
						'font-size' => true,
						'line-height' => true,
						'font-weight' => false,
						'color' => true,
					],
					'std' => [
						'font-size' => '48',
						'line-height' => '72',
						'color' => '#ffffff',
					],
					'attributes' => [
						'data-conditional-logic' => [[
							[ 'mb_page_title_switch', '=', 'on' ]
						]],
					],
				),
				array(
					'name' => esc_html__( 'Page Title Breadcrumbs Font', 'iguru' ),
					'id'   => 'mb_page_title_breadcrumbs_font',
					'type' => 'wgl_font',
					'options' => [
						'font-size' => true,
						'line-height' => true,
						'font-weight' => false,
						'color' => true,
					],
					'std' => [
						'font-size' => '16',
						'line-height' => '24',
						'color' => '#ffffff',
					],
					'attributes' => [
						'data-conditional-logic' => [[
							[ 'mb_page_title_switch', '=', 'on' ]
						]],
					],
				),
				array(
					'name' => esc_html__( 'Responsive Layout', 'iguru' ),
					'type' => 'wgl_heading',
					'attributes' => [
						'data-conditional-logic' => [[
							[ 'mb_page_title_switch', '=', 'on' ]
						]],
					],
				),
				array(
					'id'   => 'mb_page_title_resp_switch',
					'name' => esc_html__( 'Responsive Layout On/Off', 'iguru' ),
					'type' => 'switch',
					'attributes' => [
						'data-conditional-logic' => [[
							[ 'mb_page_title_switch', '=', 'on' ]
						]],
					],
				),
				array(
					'name' => esc_html__( 'Screen breakpoint', 'iguru' ),
					'id'   => 'mb_page_title_resp_resolution',
					'type' => 'number',
					'std'  => 768,
					'min'  => 1,
					'step' => 1,
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_page_title_switch', '=', 'on' ],
							[ 'mb_page_title_resp_switch', '=', '1' ],
						] ],
					),
				),
				array(
					'name' => esc_html__( 'Height', 'iguru' ),
					'id'   => 'mb_page_title_resp_height',
					'type' => 'number',
					'std'  => 370,
					'min'  => 0,
					'step' => 1,
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_page_title_switch', '=', 'on' ],
							[ 'mb_page_title_resp_switch', '=', '1' ],
						] ],
					),
				),
				array(
					'name' => esc_html__( 'Padding Top/Bottom', 'iguru' ),
					'id'   => 'mb_page_title_resp_padding',
					'type' => 'wgl_offset',
					'options' => array(
						'mode'   => 'padding',
						'top'    => true,
						'right'  => false,
						'bottom' => true,
						'left'   => false,
					),
					'std' => array(
						'padding-top'    => '15',
						'padding-bottom' => '40',
					),
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_page_title_switch', '=', 'on' ],
							[ 'mb_page_title_resp_switch', '=', '1' ],
						] ],
					),
				),
				array(
					'name' => esc_html__( 'Page Title Font', 'iguru' ),
					'id'   => 'mb_page_title_resp_font',
					'type' => 'wgl_font',
					'options' => array(
						'font-size' => true,
						'line-height' => true,
						'font-weight' => false,
						'color' => true,
					),
					'std' => [
						'font-size' => '42',
						'line-height' => '72',
						'color' => '#292929',
					],
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_page_title_switch', '=', 'on' ],
							[ 'mb_page_title_resp_switch', '=', '1' ],
						] ],
					),
				),
				array(
					'id'   => 'mb_page_title_resp_breadcrumbs_switch',
					'name' => esc_html__( 'Show Breadcrumbs', 'iguru' ),
					'type' => 'switch',
					'std'  => 1,
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_page_title_switch', '=', 'on' ],
							[ 'mb_page_title_resp_switch', '=', '1' ],
						] ],
					),
				),
				array(
					'name' => esc_html__( 'Page Title Breadcrumbs Font', 'iguru' ),
					'id'   => 'mb_page_title_resp_breadcrumbs_font',
					'type' => 'wgl_font',
					'options' => array(
						'font-size' => true,
						'line-height' => true,
						'font-weight' => false,
						'color' => true,
					),
					'std' => array(
						'font-size' => '14',
						'line-height' => '24',
						'color' => '#9a9a9a',
					),
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_page_title_switch', '=', 'on' ],
							[ 'mb_page_title_resp_switch', '=', '1' ],
							[ 'mb_page_title_resp_breadcrumbs_switch', '=', '1' ],
						] ],
					),
				),
			),
		);
		return $meta_boxes;
	}

	public function page_side_panel_meta_boxes( $meta_boxes ) {
		$meta_boxes[] = array(
			'title'      => esc_html__( 'Side Panel', 'iguru' ),
			'post_types' => [ 'page' ],
			'context' => 'advanced',
			'fields'     => array(
				array(
					'name'     => esc_html__( 'Side Panel', 'iguru' ),
					'id'       => "mb_customize_side_panel",
					'type'     => 'button_group',
					'options'  => array(
						'default' => esc_html__( 'Default', 'iguru' ),
						'custom' => esc_html__( 'Custom', 'iguru' ),
					),
					'multiple' => false,
					'inline'   => true,
					'std'      => 'default',
				),
				array(
					'name'     => esc_html__( 'Side Panel Settings', 'iguru' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_customize_side_panel', '=', 'custom' ]
						] ],
					),
				),
				array(
					'name' => esc_html__( 'Text Color', 'iguru' ),
					'id'   => "mb_side_panel_text_color",
					'type' => 'color',
					'std'  => '#313538',
					'js_options' => array(
						'defaultColor' => '#313538',
					),
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_customize_side_panel', '=', 'custom' ]
						] ],
					),
				),
				array(
					'name' => esc_html__( 'Background Color', 'iguru' ),
					'id'   => "mb_side_panel_bg",
					'type' => 'color',
					'std'  => '#ffffff',
					'alpha_channel' => true,
					'js_options' => array(
						'defaultColor' => '#ffffff',
					),
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_customize_side_panel', '=', 'custom' ]
						] ],
					),
				),
				array(
					'name'     => esc_html__( 'Text Align', 'iguru' ),
					'id'       => "mb_side_panel_text_alignment",
					'type'     => 'button_group',
					'options'  => array(
						'left' => esc_html__( 'Left', 'iguru' ),
						'center' => esc_html__( 'Center', 'iguru' ),
						'right' => esc_html__( 'Right', 'iguru' ),
					),
					'multiple'   => false,
					'std'        => 'center',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_customize_side_panel', '=', 'custom' ]
						] ],
					),
				),
				array(
					'name' => esc_html__( 'Width', 'iguru' ),
					'id'   => "mb_side_panel_width",
					'type' => 'number',
					'min'  => 0,
					'step' => 1,
					'std'  => 480,
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_customize_side_panel', '=', 'custom' ]
						] ],
					),
				),
				array(
					'name'     => esc_html__( 'Position', 'iguru' ),
					'id'          => "mb_side_panel_position",
					'type'        => 'button_group',
					'options'     => array(
						'left' => esc_html__( 'Left', 'iguru' ),
						'right' => esc_html__( 'Right', 'iguru' ),
					),
					'multiple'    => false,
					'std'         => 'right',
					'attributes' => array(
						'data-conditional-logic' => array(
							array(
								array('mb_customize_side_panel', '=', 'custom')
							),
						),
					),
				),
			)
		);
		return $meta_boxes;
	}

	public function page_soc_icons_meta_boxes( $meta_boxes ) {
		$meta_boxes[] = array(
			'title'      => esc_html__( 'Social Shares', 'iguru' ),
			'post_types' => [ 'page' ],
			'context' => 'advanced',
			'fields'     => array(
				array(
					'name'     => esc_html__( 'Social Shares', 'iguru' ),
					'id'          => "mb_customize_soc_shares",
					'type'        => 'button_group',
					'options'     => array(
						'default' => esc_html__( 'Default', 'iguru' ),
						'on' => esc_html__( 'On', 'iguru' ),
						'off' => esc_html__( 'Off', 'iguru' ),
					),
					'multiple'    => false,
					'inline'    => true,
					'std'         => 'default',
				),
				array(
					'name'     => esc_html__( 'Choose your share style.', 'iguru' ),
					'id'          => "mb_soc_icon_style",
					'type'        => 'button_group',
					'options'     => array(
						'standard' => esc_html__( 'Standard', 'iguru' ),
						'hovered' => esc_html__( 'Hovered', 'iguru' ),
					),
					'multiple'    => false,
					'std'         => 'standard',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_customize_soc_shares', '=', 'on' ]
						] ],
					),
				),
				array(
					'id'   => 'mb_soc_icon_position',
					'name' => esc_html__( 'Fixed Position On/Off', 'iguru' ),
					'type' => 'switch',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_customize_soc_shares', '=', 'on' ]
						] ],
					),
				),
				array( 
					'name' => esc_html__( 'Offset Top(in percentage)', 'iguru' ),
					'id'   => 'mb_soc_icon_offset',
					'type' => 'number',
					'std'  => 50,
					'min'  => 0,
					'step' => 1,
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_customize_soc_shares', '=', 'on' ]
						] ],
					),
					'desc' => esc_html__( 'Measurement units defined as "percents" while position fixed is enabled, and as "pixels" while position is off.', 'iguru' ),
				),
				array(
					'id'   => 'mb_soc_icon_facebook',
					'name' => esc_html__( 'Facebook Share On/Off', 'iguru' ),
					'type' => 'switch',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_customize_soc_shares', '=', 'on' ]
						] ],
					),
				),
				array(
					'id'   => 'mb_soc_icon_twitter',
					'name' => esc_html__( 'Twitter Share On/Off', 'iguru' ),
					'type' => 'switch',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_customize_soc_shares', '=', 'on' ]
						] ],
					),
				),
				array(
					'id'   => 'mb_soc_icon_linkedin',
					'name' => esc_html__( 'Linkedin Share On/Off', 'iguru' ),
					'type' => 'switch',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_customize_soc_shares', '=', 'on' ]
						] ],
					),
				),
				array(
					'id'   => 'mb_soc_icon_pinterest',
					'name' => esc_html__( 'Pinterest Share On/Off', 'iguru' ),
					'type' => 'switch',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_customize_soc_shares', '=', 'on' ]
						] ],
					),
				),
				array(
					'id'   => 'mb_soc_icon_tumblr',
					'name' => esc_html__( 'Tumblr Share On/Off', 'iguru' ),
					'type' => 'switch',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_customize_soc_shares', '=', 'on' ]
						] ],
					),
				),
			)
		);
		return $meta_boxes;
	}

	public function page_footer_meta_boxes( $meta_boxes ) {
		$meta_boxes[] = array(
			'title'      => esc_html__( 'Footer', 'iguru' ),
			'post_types' => [ 'page' ],
			'context'    => 'advanced',
			'fields'     => array(
				array(
					'name' => esc_html__( 'Footer', 'iguru' ),
					'id'   => "mb_footer_switch",
					'type' => 'button_group',
					'multiple' => false,
					'options' => array(
						'default' => esc_html__( 'Default', 'iguru' ),
						'on'      => esc_html__( 'On', 'iguru' ),
						'off'     => esc_html__( 'Off', 'iguru' ),
					),
					'std'  => 'default',
				),
				array(
					'name' => esc_html__( 'Footer Settings', 'iguru' ),
					'type' => 'wgl_heading',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_footer_switch', '=', 'on' ]
						] ],
					),
				), 
				array(
					'id'   => 'mb_footer_add_wave',
					'name' => esc_html__( 'Add Wave', 'iguru' ),
					'type' => 'switch',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_footer_switch', '=', 'on' ]
						] ],
					),
				),
				array(
					'name' => esc_html__( 'Set Wave Height', 'iguru' ),
					'id'   => "mb_footer_wave_height",
					'type' => 'number',
					'min'  => 0,
					'step' => 1,
					'std'  => 158,
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_footer_switch', '=', 'on' ],
							[ 'mb_footer_add_wave', '=', '1' ],
						] ],
					),
				),
				array(
					'name' => esc_html__( 'Content Type', 'iguru' ),
					'id'   => 'mb_footer_content_type',
					'type' => 'button_group',
					'multiple' => false,
					'options' => array(
						'widgets' => esc_html__( 'Default', 'iguru' ),
						'pages'   => esc_html__( 'Page', 'iguru' )
					),
					'std'  => 'widgets',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_footer_switch', '=', 'on' ]
						] ],
					),
				),
				array(
					'name'  => 'Select a page',
					'id'    => 'mb_footer_page_select',
					'type'  => 'post',
					'post_type' => 'footer',
					'field_type' => 'select_advanced',
					'placeholder' => 'Select a page',
					'query_args' => array(
						'post_status'    => 'publish',
						'posts_per_page' => - 1,
					),
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_footer_switch', '=', 'on' ],
							[ 'mb_footer_content_type', '=', 'pages' ],
						] ],
					),
				),
				array(
					'name' => esc_html__( 'Paddings', 'iguru' ),
					'id'   => 'mb_footer_spacing',
					'type' => 'wgl_offset',
					'options' => array(
						'mode'   => 'padding',
						'top'    => true,
						'right'  => true,
						'bottom' => true,
						'left'   => true,
					),
					'std' => array(
						'padding-top'    => '100',
						'padding-right'  => '0',
						'padding-bottom' => '10',
						'padding-left'   => '0'
					),
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_footer_switch', '=', 'on' ]
						] ],
					),
				),
				array(
					'name'   => esc_html__( 'Background', 'iguru' ),
					'id'     => "mb_footer_bg",
					'type'   => 'wgl_background',
					'image'  => '',
					'position' => 'center center',
					'attachment' => 'scroll',
					'size'   => 'cover',
					'repeat' => 'no-repeat',	
					'color'  => '#2e323e',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_footer_switch', '=', 'on' ]
						] ],
					),
				),
			),
		);
		return $meta_boxes;
	}	

	public function page_copyright_meta_boxes( $meta_boxes ) {
		$meta_boxes[] = array(
			'title'      => esc_html__( 'Copyright', 'iguru' ),
			'post_types' => [ 'page' ],
			'context'    => 'advanced',
			'fields'     => array(
				array(
					'name'     => esc_html__( 'Copyright', 'iguru' ),
					'id'       => "mb_copyright_switch",
					'type'     => 'button_group',
					'multiple' => false,
					'options'  => array(
						'default' => esc_html__( 'Default', 'iguru' ),
						'on'      => esc_html__( 'On', 'iguru' ),
						'off'     => esc_html__( 'Off', 'iguru' ),
					),
					'std'      => 'default',
				),
				array(
					'name' => esc_html__( 'Copyright Settings', 'iguru' ),
					'type' => 'wgl_heading',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_copyright_switch', '=', 'on' ]
						] ],
					),
				),
				array(
					'name' => esc_html__( 'Editor', 'iguru' ),
					'id'   => "mb_copyright_editor",
					'type' => 'textarea',
					'cols' => 20,
					'rows' => 3,
					'std'  => 'Copyright © 2019 iGuru by WebGeniusLab. All Rights Reserved',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_copyright_switch', '=', 'on' ]
						] ],
					),
				),
				array(
					'name' => esc_html__( 'Text Color', 'iguru' ),
					'id'   => "mb_copyright_text_color",
					'type' => 'color',
					'std'  => '#838383',
					'js_options' => array(
						'defaultColor' => '#838383',
					),
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_copyright_switch', '=', 'on' ]
						] ],
					),
				),
				array(
					'name' => esc_html__( 'Background Color', 'iguru' ),
					'id'   => "mb_copyright_bg_color",
					'type' => 'color',
					'std'  => '#171a1e',
					'js_options' => array(
						'defaultColor' => '#171a1e',
					),
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_copyright_switch', '=', 'on' ]
						] ],
					),
				),
				array(
					'name' => esc_html__( 'Paddings', 'iguru' ),
					'id'   => 'mb_copyright_spacing',
					'type' => 'wgl_offset',
					'options' => array(
						'mode'   => 'padding',
						'top'    => true,
						'right'  => false,
						'bottom' => true,
						'left'   => false,
					),
					'std' => array(
						'padding-top'    => '10',
						'padding-bottom' => '10',
					),
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_copyright_switch', '=', 'on' ]
						] ],
					),
				),
			),
		);
		return $meta_boxes;

	}

	public function shop_catalog_meta_boxes( $meta_boxes ) {
		$meta_boxes[] = array(
			'title'      => esc_html__( 'Catalog Options', 'iguru' ),
			'post_types' => [ 'product' ],
			'context'    => 'advanced',
			'fields'     => array(
				array(
					'id'   => 'mb_product_carousel',
					'name' => esc_html__( 'Product Carousel', 'iguru' ),
					'type' => 'switch',
					'std'  => '',
				),
			),
		);
		return $meta_boxes;
	}

	public function shop_single_meta_boxes( $meta_boxes ) {

		$meta_boxes[] = array(
			'title'      => esc_html__( 'Post Settings', 'iguru' ),
			'post_types' => [ 'product' ],
			'context'    => 'advanced',
			'fields'     => array(
				array(
					'name'     => esc_html__( 'Post Layout', 'iguru' ),
					'id'       => "mb_product_layout",
					'type'     => 'button_group',
					'options'  => array(
						'default' => esc_html__( 'Default', 'iguru' ),
						'custom'  => esc_html__( 'Custom', 'iguru' ),
					),
					'multiple' => false,
					'std'      => 'default',
				),
				array(
					'name'     => esc_html__( 'Product Layout Settings', 'iguru' ),
					'type'     => 'wgl_heading',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_product_layout', '=', 'custom' ]
						] ],
					),
				),
				
				array(		
					'name'     => esc_html__( 'Single Image Layout', 'iguru' ),
					'id'       => "mb_shop_single_image_layout",
					'type'     => 'wgl_image_select',
					'placeholder' => 'Select a Single Layout',
					'options'  => array(
						'default'                  => get_template_directory_uri() . '/core/admin/img/options/1c.png',
						'sticky_layout'            => get_template_directory_uri() . '/core/admin/img/options/none.png',
						'image_gallery'            => get_template_directory_uri() . '/core/admin/img/options/2cl.png',
						'full_width_image_gallery' => get_template_directory_uri() . '/core/admin/img/options/2cr.png',
						'with_background'          => get_template_directory_uri() . '/core/admin/img/options/2cr.png',
					),
					'std'      => 'default',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_product_layout', '=', 'custom' ],
						] ],
					),
				),
				array(
					'id'   => 'mb_shop_layout_with_background',
					'name' => esc_html__( 'Background', 'iguru' ),
					'type' => 'color',
					'attributes' => array(
						'data-conditional-logic' => [ [
							[ 'mb_product_layout', '=', 'custom' ],
							[ 'mb_shop_single_image_layout', '=', 'with_background' ],
						] ],
					),
					'js_options' => array(
						'defaultColor' => '#f3f3f3',
					),
					'std' => '#f3f3f3',
					'validate' => 'color',
				),
			),
		);
		return $meta_boxes;
	}

}
new iGuru_Metaboxes();

?>