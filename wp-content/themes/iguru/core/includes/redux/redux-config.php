<?php
	
if ( ! class_exists( 'iGuru_Core' ) ) return;

if ( ! function_exists('iguru_get_preset') ) {
	function iguru_get_preset() {
		$custom_preset = get_option('iguru_set_preset');
		$presets = function_exists('iguru_default_preset') ? iguru_default_preset() : '';

		$out = [];
		$i = 1;
		if ( is_array($presets) ) {
			foreach ($presets as $key => $value) :
				if ($key != 'img') {
					$out[$key] = $key;
					$i++;
				}
			endforeach;
		}
		if ( is_array($custom_preset) ) {
			foreach ( $custom_preset as $preset_id => $preset) :
				if ($preset_id != 'default' && $preset_id != 'img') {
					$out[$preset_id] = $preset_id;
				}
			endforeach;
		}
		return $out;
	}
}

// This is theme option name where all the Redux data is stored.
$theme_slug = 'iguru_set';
	
/**
 * ---> SET ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 * */
$theme = wp_get_theme(); 
	
$args = [
	'opt_name'             => $theme_slug, // This is where your data is stored in the database and also becomes your global variable name.
	'display_name'         => $theme->get( 'Name' ), // Name that appears at the top of your panel
	'display_version'      => $theme->get( 'Version' ), // Version that appears at the top of your panel
	'menu_type'            => 'menu', // Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
	'allow_sub_menu'       => true,	// Show the sections below the admin menu item or not
	'menu_title'           => esc_html__( 'Theme Options', 'iguru' ),
	'page_title'           => esc_html__( 'Theme Options', 'iguru' ), // You will need to generate a Google API key to use this feature. Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
	'google_api_key'       => '', // Set it you want google fonts to update weekly. A google_api_key value is required.
	'google_update_weekly' => false, // Must be defined to add google fonts to the typography module
	'async_typography'     => true, // Show the panel pages on the admin bar
	'admin_bar'            => true,
	'admin_bar_icon'       => 'dashicons-admin-generic', // Choose an icon for the admin bar menu
	'admin_bar_priority'   => 50, // Choose an priority for the admin bar menu
	'global_variable'      => '', // Set a different name for your global variable other than the opt_name
	'dev_mode'             => false, // Show the time the page took to load, etc
	'update_notice'        => true,	// If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
	'customizer'           => true,	// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	'page_priority'        => 3, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	'page_parent'          => 'wgl-dashboard-panel', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	'page_permissions'     => 'manage_options',	// Permissions needed to access the options panel.
	'menu_icon'            => 'dashicons-admin-generic', // Specify a custom URL to an icon
	'last_tab'             => '', // Force your panel to always open to a specific tab (by id)
	'page_icon'            => 'icon-themes', // Icon displayed in the admin panel next to your menu_title
	'page_slug'            => 'wgl-theme-options-panel', // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
	'save_defaults'        => true,	// On load save the defaults to DB before user clicks save or not
	'default_show'         => false, // If true, shows the default value next to each field that is not the default value.
	'default_mark'         => '', // What to print by the field's title if the value shown is default. Suggested: *
	'show_import_export'   => true,	 // Shows the Import/Export panel when not used as a field.
	'transient_time'       => 60 * MINUTE_IN_SECONDS,
	'output'               => true,	// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
	'output_tag'           => true,	// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	'database'             => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	'use_cdn'              => true,
];



Redux::setArgs( $theme_slug, $args );

// -> START Basic Fields
Redux::setSection(
	$theme_slug,
	[
		'title'  => esc_html__( 'General', 'iguru' ),
		'id'     => 'general',
		'icon'   => 'el el-cog',
		'fields' => array(
			array(
				'id'       => 'use_minify',
				'type'     => 'switch',
				'title'    => esc_html__( 'Use minify css/js files', 'iguru' ),
				'desc'     => esc_html__( 'Recommended for site load speed.', 'iguru' ),
			),
			array(
				'id'       => 'preloder_settings',
				'type'     => 'section',
				'title'    => esc_html__( 'Preloader', 'iguru' ),
				'indent'   => true,
			),
			array(
				'id'       => 'preloader',
				'type'     => 'switch',
				'title'    => esc_html__( 'Preloader Switch', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'       => 'preloader_background',
				'type'     => 'color',
				'title'    => esc_html__( 'Preloader Background', 'iguru' ),
				'default'  => '#ffffff',
				'transparent' => false,
				'required' => [ 'preloader', '=', '1' ],
			),
			array(
				'id'       => 'preloader_color_1',
				'type'     => 'color',
				'title'    => esc_html__( 'Preloader Color', 'iguru' ),
				'default'  => '#f57479',
				'transparent' => false,
				'required' => [ 'preloader', '=', '1' ],
			),
			array(
				'id'       => 'preloader_settings-end',
				'type'     => 'section',
				'indent'   => false,
			),
			array(
				'id'       => 'search_settings',
				'type'     => 'section',
				'title'    => esc_html__( 'Header Search', 'iguru' ),
				'indent'   => true,
			),
			array(
				'id'       => 'search_style',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Search Style', 'iguru' ),
				'options'  => [
					'standard' => esc_html__( 'Standard', 'iguru' ),
					'alt'      => esc_html__( 'Full Page Width', 'iguru' ),
				],
				'default'  => 'standard'
			),
			 array(
				'id'       => 'search_settings-end',
				'type'     => 'section',
				'indent'   => false,
			),
			array(
				'id'       => 'scroll_up_settings',
				'type'     => 'section',
				'title'    => esc_html__( 'Scroll Up Button', 'iguru' ),
				'indent'   => true,
			),
			array(
				'id'       => 'scroll_up',
				'type'     => 'switch',
				'title'    => esc_html__( 'Button Switch', 'iguru' ),
				'default'  => true,
			),
			array(
				'id'       => 'scroll_up_arrow_color',
				'type'     => 'color', 
				'title'    => esc_html__( 'Button Arrow Color', 'iguru' ),
				'default'  => '#ffffff',
				'transparent' => false,
				'required' => [ 'scroll_up', '=', '1' ],
			),
			array(
				'id'       => 'scroll_up_bg_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Button Background Color', 'iguru' ),
				'default'  => '#00bda6',
				'transparent' => false,
				'required' => [ 'scroll_up', '=', '1' ],
			),
			array(
				'id'       => 'scroll_up_settings-end',
				'type'     => 'section', 
				'indent'   => false,
			),
		),
	]
);

Redux::setSection(
	$theme_slug,
	[
		'title'      => esc_html__( 'Custom JS', 'iguru' ),
		'id'         => 'editors-option',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'custom_js',
				'type'     => 'ace_editor',
				'title'    => esc_html__( 'Custom JS', 'iguru' ),
				'subtitle' => esc_html__( 'Paste your JS code here.', 'iguru' ),
				'mode'     => 'javascript',
				'theme'    => 'chrome',
				'default'  => ''
			),
			array(
				'id'       => 'header_custom_js',
				'type'     => 'ace_editor',
				'title'    => esc_html__( 'Custom JS', 'iguru' ),
				'subtitle' => esc_html__( 'Code to be added inside HEAD tag', 'iguru' ),
				'mode'     => 'html',
				'theme'    => 'chrome',
				'default'  => ''
			),
		),
	]
);

// -> START Basic Fields
Redux::setSection(
	$theme_slug,
	[
		'title' => esc_html__( 'Header', 'iguru' ),
		'id'    => 'header_section',
	]
);

Redux::setSection(
	$theme_slug,
	[
		'title'      => esc_html__( 'Logo', 'iguru' ),
		'id'         => 'logo',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'header_logo',
				'type'     => 'media',
				'title'    => esc_html__( 'Header Logo', 'iguru' ),
			),
			array(
				'id'       => 'logo_height_custom',
				'type'     => 'switch',
				'title'    => esc_html__( 'Enable Logo Height', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'       => 'logo_height',
				'type'     => 'dimensions',
				'units'    => false, 
				'units_extended' => false,
				'title'    => esc_html__( 'Set Logo Height' , 'iguru' ),
				'height'   => true,
				'width'    => false,
				'default'  => array( 'height' => 100 ),
				'required' => [ 'logo_height_custom', '=', '1' ],
			),
			array(
				'id'       => 'logo_sticky',
				'type'     => 'media',
				'title'    => esc_html__( 'Sticky Logo', 'iguru' ),
			),
			array(
				'id'       => 'sticky_logo_height_custom',
				'type'     => 'switch',
				'title'    => esc_html__( 'Enable Sticky Logo Height', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'       => 'sticky_logo_height',
				'type'     => 'dimensions',
				'units'    => false, 
				'units_extended' => false,
				'title'    => esc_html__( 'Set Sticky Logo Height' , 'iguru' ),
				'height'   => true,
				'width'    => false,
				'default'  => array( 'height' => '' ),
				'required' => array(
					array( 'sticky_logo_height_custom', '=', '1' ),
				),
			),
			array(
				'id'      => 'logo_mobile',
				'type'    => 'media',
				'title'   => esc_html__( 'Mobile Logo', 'iguru' ),
			),
			array(
				'id'      => 'mobile_logo_height_custom',
				'type'    => 'switch',
				'title'   => esc_html__( 'Enable Mobile Logo Height', 'iguru' ),
				'default' => false,
			),
			array(
				'id'      => 'mobile_logo_height',
				'type'    => 'dimensions',
				'units'   => false, 
				'units_extended' => false,
				'title'   => esc_html__( 'Set Mobile Logo Height' , 'iguru' ),
				'height'  => true,
				'width'   => false,
				'default' => array( 'height' => '' ),
				'required' => array(
					array( 'mobile_logo_height_custom', '=', '1' ),
				),
			),
		)
	]
);

Redux::setSection(
	$theme_slug,
	[
		'title'      => esc_html__( 'Header Builder', 'iguru' ),
		'id'         => 'header-customize',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'header_def_js_preset',
				'type'     => 'select',
				'title'    => esc_html__( 'Default header template', 'iguru' ),
				'default'  => '',
				'select2'  => array( 'allowClear' => false ),
				'options'  => iguru_get_preset(),
				'desc'     => esc_html__( 'Please choose template to use it for all Pages by default. You can also choose your custom templates for any Page - the corresponding setting is available in every Page\'s metabox options.', 'iguru' ),
			),
			array(
				'id'       => 'opt-js-preset',
				'type'     => 'custom_preset',
				'title'    => esc_html__( 'Header Templates', 'iguru' ),
			), 
			array(
				'id'       => 'bottom_header_layout',
				'type'     => 'custom_header_builder',
				'title'    => esc_html__( 'Header Builder', 'iguru' ),
				'compiler' => 'true',
				'full_width' => true,
				'options'  => [
					'items' => [
						'html1' => [ 'title' => esc_html__( 'HTML 1', 'iguru' ), 'settings' => true ] ,
						'html2' => [ 'title' => esc_html__( 'HTML 2', 'iguru' ), 'settings' => true ] ,
						'html3' => [ 'title' => esc_html__( 'HTML 3', 'iguru' ), 'settings' => true ] ,
						'html4' => [ 'title' => esc_html__( 'HTML 4', 'iguru' ), 'settings' => true ] ,
						'html5' => [ 'title' => esc_html__( 'HTML 5', 'iguru' ), 'settings' => true ] ,
						'html6' => [ 'title' => esc_html__( 'HTML 6', 'iguru' ), 'settings' => true ] ,
						'html7' => [ 'title' => esc_html__( 'HTML 7', 'iguru' ), 'settings' => true ] ,
						'html8' => [ 'title' => esc_html__( 'HTML 8', 'iguru' ), 'settings' => true ] ,
						'delimiter1' => [ 'title' => esc_html__( '|', 'iguru' ), 'settings' => true ] ,
						'delimiter2' => [ 'title' => esc_html__( '|', 'iguru' ), 'settings' => true ] ,
						'delimiter3' => [ 'title' => esc_html__( '|', 'iguru' ), 'settings' => true ] ,
						'delimiter4' => [ 'title' => esc_html__( '|', 'iguru' ), 'settings' => true ] ,
						'delimiter5' => [ 'title' => esc_html__( '|', 'iguru' ), 'settings' => true ] ,
						'delimiter6' => [ 'title' => esc_html__( '|', 'iguru' ), 'settings' => true ] ,
						'spacer1'  =>  [ 'title' => esc_html__( 'Spacer 1', 'iguru' ), 'settings' => true ] ,
						'spacer2' => [ 'title' => esc_html__( 'Spacer 2', 'iguru' ), 'settings' => true ] ,
						'spacer3' => [ 'title' => esc_html__( 'Spacer 3', 'iguru' ), 'settings' => true ] ,
						'spacer4' => [ 'title' => esc_html__( 'Spacer 4', 'iguru' ), 'settings' => true ] ,
						'spacer5' => [ 'title' => esc_html__( 'Spacer 5', 'iguru' ), 'settings' => true ] ,
						'spacer6' => [ 'title' => esc_html__( 'Spacer 6', 'iguru' ), 'settings' => true ] ,
						'spacer7' => [ 'title' => esc_html__( 'Spacer 7', 'iguru' ), 'settings' => true ] ,
						'spacer8' => [ 'title' => esc_html__( 'Spacer 8', 'iguru' ), 'settings' => true ] ,
						'button1' => [ 'title' => esc_html__( 'Button', 'iguru' ), 'settings' => true ] ,
						'button2' => [ 'title' => esc_html__( 'Button', 'iguru' ), 'settings' => true ] ,
						'button3' => [ 'title' => esc_html__( 'Button', 'iguru' ), 'settings' => true ] ,
						'button4' => [ 'title' => esc_html__( 'Button', 'iguru' ), 'settings' => true ] ,
						'side_panel' => [ 'title' => esc_html__( 'Side Panel', 'iguru' ), 'settings' => false ] ,
						'wpml' => [ 'title' => esc_html__( 'WPML', 'iguru' ), 'settings' => false ] ,
						'cart' => [ 'title' => esc_html__( 'Cart', 'iguru' ), 'settings' => false ] ,
						'sign_in' => [ 'title' => esc_html__( 'Sign In', 'iguru' ), 'settings' => false ] ,
					], 
					'Top Left area' => [],
					'Top Center area' => [],
					'Top Right area' => [],
					'Middle Left area' => [
						'logo' => [ 'title' => esc_html__( 'Logo', 'iguru' ), 'settings' => false ],
					],
					'Middle Center area' => [
						'menu' => [ 'title' => esc_html__( 'Menu', 'iguru' ), 'settings' => false ],
					],
					'Middle Right area'  => [
						'item_search' => [ 'title' => esc_html__( 'Search', 'iguru' ), 'settings' => false ],
					],  
					'Bottom Left area'  => [],
					'Bottom Center area' => [],
					'Bottom Right area'  => [],
				],
				'default' => [
					'items' => [
						'html1' => [ 'title' => esc_html__( 'HTML 1', 'iguru' ), 'settings' => true ],
						'html2' => [ 'title' => esc_html__( 'HTML 2', 'iguru' ), 'settings' => true ],
						'html3' => [ 'title' => esc_html__( 'HTML 3', 'iguru' ), 'settings' => true ],
						'html4' => [ 'title' => esc_html__( 'HTML 4', 'iguru' ), 'settings' => true ],
						'html5' => [ 'title' => esc_html__( 'HTML 5', 'iguru' ), 'settings' => true ],
						'html6' => [ 'title' => esc_html__( 'HTML 6', 'iguru' ), 'settings' => true ],
						'html7' => [ 'title' => esc_html__( 'HTML 7', 'iguru' ), 'settings' => true ],
						'html8' => [ 'title' => esc_html__( 'HTML 8', 'iguru' ), 'settings' => true ],
						'spacer1' => [ 'title' => esc_html__( 'Spacer 1', 'iguru' ), 'settings' => true ],
						'spacer2' => [ 'title' => esc_html__( 'Spacer 2', 'iguru' ), 'settings' => true ],
						'spacer3' => [ 'title' => esc_html__( 'Spacer 3', 'iguru' ), 'settings' => true ],
						'spacer4' => [ 'title' => esc_html__( 'Spacer 4', 'iguru' ), 'settings' => true ],
						'spacer5' => [ 'title' => esc_html__( 'Spacer 5', 'iguru' ), 'settings' => true ],
						'spacer6' => [ 'title' => esc_html__( 'Spacer 6', 'iguru' ), 'settings' => true ],
						'spacer7' => [ 'title' => esc_html__( 'Spacer 7', 'iguru' ), 'settings' => true ],
						'spacer8' => [ 'title' => esc_html__( 'Spacer 8', 'iguru' ), 'settings' => true ],
						'button1' => [ 'title' => esc_html__( 'Button', 'iguru' ), 'settings' => true ],
						'button2' => [ 'title' => esc_html__( 'Button', 'iguru' ), 'settings' => true ],
						'button3' => [ 'title' => esc_html__( 'Button', 'iguru' ), 'settings' => true ],
						'button4' => [ 'title' => esc_html__( 'Button', 'iguru' ), 'settings' => true ],
						'delimiter1' => [ 'title' => esc_html__( '|', 'iguru' ), 'settings' => true ],
						'delimiter2' => [ 'title' => esc_html__( '|', 'iguru' ), 'settings' => true ],
						'delimiter3' => [ 'title' => esc_html__( '|', 'iguru' ), 'settings' => true ],
						'delimiter4' => [ 'title' => esc_html__( '|', 'iguru' ), 'settings' => true ],
						'delimiter5' => [ 'title' => esc_html__( '|', 'iguru' ), 'settings' => true ],
						'delimiter6' => [ 'title' => esc_html__( '|', 'iguru' ), 'settings' => true ],
						'side_panel' => [ 'title' => esc_html__( 'Side Panel', 'iguru' ), 'settings' => false ],
						'cart' =>  [ 'title' => esc_html__( 'Cart', 'iguru' ), 'settings' => false ],
						'wpml' => [ 'title' => esc_html__( 'WPML', 'iguru' ), 'settings' => false ],
						'sign_in' =>  [ 'title' => esc_html__( 'Sign In', 'iguru' ), 'settings' => false ] ,
					], 
					'Top Left area' => [],
					'Top Center area' => [],
					'Top Right area' => [],
					'Middle Left area' => [
						'logo' => [ 'title' => esc_html__( 'Logo', 'iguru' ), 'settings' => false ],
					],
					'Middle Center area' => [
						'menu' => [ 'title' => esc_html__( 'Menu', 'iguru' ), 'settings' => false ],
					],
					'Middle Right area' => [
						'item_search' => [ 'title' => esc_html__( 'Search', 'iguru' ), 'settings' => false ],
					],
					'Bottom Left area' => [],
					'Bottom Center area' => [],
					'Bottom Right area' => [],
				],
			),
			array(
				'id'             => 'bottom_header_spacer1',
				'type'           => 'dimensions',
				'units'          => false, 
				'units_extended' => false,
				'title'          => esc_html__( 'Header Spacer 1 Width', 'iguru' ),
				'height'         => false,
				'width'          => true,
				'default'        => [ 'width' => 25 ]
			),
			array(
				'id'             => 'bottom_header_spacer2',
				'type'           => 'dimensions',
				'units'          => false, 
				'units_extended' => false,
				'title'          => esc_html__( 'Header Spacer 2 Width', 'iguru' ),
				'height'         => false,
				'width'          => true,
				'default'        => [ 'width' => 110 ]
			),
			array(
				'id'             => 'bottom_header_spacer3',
				'type'           => 'dimensions',
				'units'          => false, 
				'units_extended' => false,
				'title'          => esc_html__( 'Header Spacer 3 Width', 'iguru' ),
				'height'         => false,
				'width'          => true,
				'default'        => [ 'width' => 25 ]
			),
			array(
				'id'             => 'bottom_header_spacer4',
				'type'           => 'dimensions',
				'units'          => false, 
				'units_extended' => false,
				'title'          => esc_html__( 'Header Spacer 4 Width', 'iguru' ),
				'height'         => false,
				'width'          => true,
				'default'        => [ 'width' => 25 ]
			),
			array(
				'id'             => 'bottom_header_spacer5',
				'type'           => 'dimensions',
				'units'          => false, 
				'units_extended' => false,
				'title'          => esc_html__( 'Header Spacer 5 Width', 'iguru' ),
				'height'         => false,
				'width'          => true,
				'default'        => [ 'width' => 25 ]
			),
			array(
				'id'             => 'bottom_header_spacer6',
				'type'           => 'dimensions',
				'units'          => false, 
				'units_extended' => false,
				'title'          => esc_html__( 'Header Spacer 6 Width', 'iguru' ),
				'height'         => false,
				'width'          => true,
				'default'        => [ 'width' => 25 ]
			),
			array(
				'id'             => 'bottom_header_spacer7',
				'type'           => 'dimensions',
				'units'          => false, 
				'units_extended' => false,
				'title'          => esc_html__( 'Header Spacer 7 Width', 'iguru' ),
				'height'         => false,
				'width'          => true,
				'default'        => [ 'width' => 25 ]
			),
			array(
				'id'             => 'bottom_header_spacer8',
				'type'           => 'dimensions',
				'units'          => false, 
				'units_extended' => false,
				'title'          => esc_html__( 'Header Spacer 8 Width', 'iguru' ),
				'height'         => false,
				'width'          => true,
				'default'        => [ 'width' => 25 ]
			),
			array(
				'id'             => 'bottom_header_delimiter1_height',
				'type'           => 'dimensions',
				'units'          => false, 
				'units_extended' => false,
				'title'          => esc_html__( 'Delimiter Height', 'iguru' ),
				'height'         => true,
				'width'          => false,
				'default'        => array( 'height' => 100 )
			),
			array(
				'id'             => 'bottom_header_delimiter1_width',
				'type'           => 'dimensions',
				'units'          => false, 
				'units_extended' => false,
				'title'          => esc_html__( 'Delimiter Width', 'iguru' ),
				'height'         => false,
				'width'          => true,
				'default'        => [ 'width' => 1 ]
			),
			array(
				'id'       => 'bottom_header_delimiter1_bg',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Delimiter Background', 'iguru' ),
				'default'  => array(
					'color' => '#ffffff',
					'alpha' => '.9',
					'rgba'  => 'rgba(255,255,255,0.9)'
				),
				'mode'     => 'background',
			),
			array(
				'id'      => 'bottom_header_delimiter1_margin',
				'type'    => 'spacing',
				'mode'    => 'margin',
				'all'     => false,
				'bottom'  => false,
				'top'     => false,
				'left'    => true,
				'right'   => true,
				'title'   => esc_html__( 'Delimiter Spacing', 'iguru' ),
				'default' => array(
					'margin-left' => '30', 
					'margin-right' => '30',  
				)
			), 
			array(
				'id'      => 'bottom_header_delimiter1_sticky_custom',
				'type'    => 'switch',
				'title'   => esc_html__( 'Customize Sticky Delimiter', 'iguru' ),
				'default' => false,
			),
			array(
				'id'       => 'bottom_header_delimiter1_sticky_color',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Delimiter Background', 'iguru' ),
				'default'  => array(
					'color' => '#ffffff',
					'alpha' => '1',
					'rgba'  => 'rgba(255,255,255,1)'
				),
				'mode'     => 'background',
				'required' => array(
					array( 'bottom_header_delimiter1_sticky_custom', '=', '1' ),
				),
			),
			array(
				'id'             => 'bottom_header_delimiter2_height',
				'type'           => 'dimensions',
				'units'          => false, 
				'units_extended' => false,
				'title'          => esc_html__( 'Delimiter Height', 'iguru' ),
				'height'         => true,
				'width'          => false,
				'default'        => array( 'height' => 100 )
			),
			array(
				'id'             => 'bottom_header_delimiter2_width',
				'type'           => 'dimensions',
				'units'          => false, 
				'units_extended' => false,
				'title'          => esc_html__( 'Delimiter Width', 'iguru' ),
				'height'         => false,
				'width'          => true,
				'default'        => array( 'width' => 1 )
			), 
			array(
				'id'       => 'bottom_header_delimiter2_bg',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Delimiter Background', 'iguru' ),
				'default'  => array(
					'color' => '#ffffff',
					'alpha' => '.9',
					'rgba'  => 'rgba(255,255,255,0.9)'
			 ),
				'mode'     => 'background',
			),
			array(
				'id'       => 'bottom_header_delimiter2_margin',
				'type'     => 'spacing',
				'mode'     => 'margin',
				'all'      => false,
				'bottom'   => false,
				'top'      => false,
				'left'     => true,
				'right'    => true,
				'title'    => esc_html__( 'Delimiter Spacing', 'iguru' ),
				'default'  => array(
					'margin-left' => '30', 
					'margin-right' => '30',  
				)
			), 
			array(
				'id'       => 'bottom_header_delimiter2_sticky_custom',
				'type'     => 'switch',
				'title'    => esc_html__( 'Customize Sticky Delimiter', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'       => 'bottom_header_delimiter2_sticky_color',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Delimiter Background', 'iguru' ),
				'default'  => array(
					'color' => '#ffffff',
					'alpha' => '1',
					'rgba'  => 'rgba(255,255,255,1)'
				),
				'mode'     => 'background',
				'required' => array(
					array( 'bottom_header_delimiter2_sticky_custom', '=', '1' ),
				),
			),
			array(
				'id'             => 'bottom_header_delimiter3_height',
				'type'           => 'dimensions',
				'units'          => false, 
				'units_extended' => false,
				'title'          => esc_html__( 'Delimiter Height', 'iguru' ),
				'height'         => true,
				'width'          => false,
				'default'        => array( 'height' => 100 )
			),
			array(
				'id'             => 'bottom_header_delimiter3_width',
				'type'           => 'dimensions',
				'units'          => false, 
				'units_extended' => false,
				'title'          => esc_html__( 'Delimiter Width', 'iguru' ),
				'height'         => false,
				'width'          => true,
				'default'        => array( 'width' => 1 )
			), 
			array(
				'id'       => 'bottom_header_delimiter3_bg',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Delimiter Background', 'iguru' ),
				'default'  => array(
					'color' => '#ffffff',
					'alpha' => '.9',
					'rgba'  => 'rgba(255,255,255,0.9)'
				),
				'mode'     => 'background',
			),
			array(
				'id'       => 'bottom_header_delimiter3_margin',
				'type'     => 'spacing',
				'mode'     => 'margin',
				'all'      => false,
				'bottom'   => false,
				'top'      => false,
				'left'     => true,
				'right'    => true,
				'title'    => esc_html__( 'Delimiter Spacing', 'iguru' ),
				'default'  => array(
					'margin-left' => '30', 
					'margin-right' => '30',  
				)
			), 
			array(
				'id'       => 'bottom_header_delimiter3_sticky_custom',
				'type'     => 'switch',
				'title'    => esc_html__( 'Customize Sticky Delimiter', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'       => 'bottom_header_delimiter3_sticky_color',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Delimiter Background', 'iguru' ),
				'default'  => array(
					'color' => '#ffffff',
					'alpha' => '1',
					'rgba'  => 'rgba(255,255,255,1)'
				),
				'mode'     => 'background',
				'required' => array(
					array( 'bottom_header_delimiter3_sticky_custom', '=', '1' ),
				),
			),
			array(
				'id'             => 'bottom_header_delimiter4_height',
				'type'           => 'dimensions',
				'units'          => false, 
				'units_extended' => false,
				'title'          => esc_html__( 'Delimiter Height', 'iguru' ),
				'height'         => true,
				'width'          => false,
				'default'        => array( 'height' => 100 )
			),
			array(
				'id'             => 'bottom_header_delimiter4_width',
				'type'           => 'dimensions',
				'units'          => false, 
				'units_extended' => false,
				'title'          => esc_html__( 'Delimiter Width', 'iguru' ),
				'height'         => false,
				'width'          => true,
				'default'        => array( 'width' => 1 )
			), 
			array(
				'id'       => 'bottom_header_delimiter4_bg',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Delimiter Background', 'iguru' ),
				'default'  => array(
					'color' => '#ffffff',
					'alpha' => '.9',
					'rgba'  => 'rgba(255,255,255,0.9)'
				),
				'mode'     => 'background',
			),
			array(
				'id'       => 'bottom_header_delimiter4_margin',
				'type'     => 'spacing',
				'mode'     => 'margin',
				'all'      => false,
				'bottom'   => false,
				'top'      => false,
				'left'     => true,
				'right'    => true,
				'title'    => esc_html__( 'Delimiter Spacing', 'iguru' ),
				'default'  => array(
					'margin-left' => '30', 
					'margin-right' => '30',  
				)
			),
			array(
				'id'       => 'bottom_header_delimiter4_sticky_custom',
				'type'     => 'switch',
				'title'    => esc_html__( 'Customize Sticky Delimiter', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'       => 'bottom_header_delimiter4_sticky_color',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Delimiter Background', 'iguru' ),
				'default'  => array(
					'color' => '#ffffff',
					'alpha' => '1',
					'rgba'  => 'rgba(255,255,255,1)'
				),
				'mode'     => 'background',
				'required' => array(
					array( 'bottom_header_delimiter4_sticky_custom', '=', '1' ),
				),
			), 
			array(
				'id'             => 'bottom_header_delimiter5_height',
				'type'           => 'dimensions',
				'units'          => false, 
				'units_extended' => false,
				'title'          => esc_html__( 'Delimiter Height', 'iguru' ),
				'height'         => true,
				'width'          => false,
				'default'        => array( 'height' => 100 )
			),
			array(
				'id'             => 'bottom_header_delimiter5_width',
				'type'           => 'dimensions',
				'units'          => false, 
				'units_extended' => false,
				'title'          => esc_html__( 'Delimiter Width', 'iguru' ),
				'height'         => false,
				'width'          => true,
				'default'        => array( 'width' => 1 )
			), 
			array(
				'id'       => 'bottom_header_delimiter5_bg',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Delimiter Background', 'iguru' ),
				'default'  => array(
					'color' => '#ffffff',
					'alpha' => '.9',
					'rgba'  => 'rgba(255,255,255,0.9)'
				),
				'mode'     => 'background',
			),
			array(
				'id'       => 'bottom_header_delimiter5_margin',
				'type'     => 'spacing',
				'mode'     => 'margin',
				'all'      => false,
				'bottom'   => false,
				'top'      => false,
				'left'     => true,
				'right'    => true,
				'title'    => esc_html__( 'Delimiter Spacing', 'iguru' ),
				'default'  => array(
					'margin-left' => '30', 
					'margin-right' => '30',  
				)
			), 
			array(
				'id'       => 'bottom_header_delimiter5_sticky_custom',
				'type'     => 'switch',
				'title'    => esc_html__( 'Customize Sticky Delimiter', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'       => 'bottom_header_delimiter5_sticky_color',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Delimiter Background', 'iguru' ),
				'default'  => array(
					'color' => '#ffffff',
					'alpha' => '1',
					'rgba'  => 'rgba(255,255,255,1)'
				),
				'mode'     => 'background',
				'required' => array(
					array( 'bottom_header_delimiter5_sticky_custom', '=', '1' ),
				),
			),
			array(
				'id'       => 'bottom_header_delimiter6_height',
				'type'     => 'dimensions',
				'units'    => false, 
				'units_extended' => false,
				'title'    => esc_html__( 'Delimiter Height', 'iguru' ),
				'height'   => true,
				'width'    => false,
				'default'  => [ 'height' => 100 ]
			),
			array(
				'id'       => 'bottom_header_delimiter6_width',
				'type'     => 'dimensions',
				'units'    => false, 
				'units_extended' => false,
				'title'    => esc_html__( 'Delimiter Width', 'iguru' ),
				'height'   => false,
				'width'    => true,
				'default'  => [ 'width' => 1 ]
			), 
			array(
				'id'       => 'bottom_header_delimiter6_bg',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Delimiter Background', 'iguru' ),
				'mode'     => 'background',
				'default'  => [
					'color' => '#ffffff',
					'alpha' => '.9',
					'rgba'  => 'rgba(255,255,255,0.9)'
				],
			),
			array(
				'id'       => 'bottom_header_delimiter6_margin',
				'type'     => 'spacing',
				'title'    => esc_html__( 'Delimiter Spacing', 'iguru' ),
				'mode'     => 'margin',
				'all'      => false,
				'bottom'   => false,
				'top'      => false,
				'left'     => true,
				'right'    => true,
				'default'  => [
					'margin-left' => '30', 
					'margin-right' => '30',  
				],
			),
			array(
				'id'       => 'bottom_header_delimiter6_sticky_custom',
				'type'     => 'switch',
				'title'    => esc_html__( 'Customize Sticky Delimiter', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'       => 'bottom_header_delimiter6_sticky_color',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Delimiter Background', 'iguru' ),
				'default'  => array(
					'color' => '#ffffff',
					'alpha' => '1',
					'rgba'  => 'rgba(255,255,255,1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_delimiter6_sticky_custom', '=', '1' ],
			), 
			array(
				'id'      => 'bottom_header_button1_title',
				'type'    => 'text',
				'title'   => esc_html__( 'Button Text', 'iguru' ),
				'default' => esc_html__( 'Buy Course', 'iguru' ),
			),
			array(
				'id'      => 'bottom_header_button1_link',
				'type'    => 'text',
				'title'   => esc_html__( 'Link', 'iguru' )
			), 
			array(
				'id'      => 'bottom_header_button1_target',
				'type'    => 'switch',
				'title'   => esc_html__( 'Open link in a new tab', 'iguru' ),
				'default' => true,
			),
			array(
				'id'      => 'bottom_header_button1_size',
				'type'    => 'select',
				'title'   => esc_html__( 'Button Size', 'iguru' ),
				'options' => array(
					's' => esc_html__( 'Small', 'iguru' ),
					'm' => esc_html__( 'Medium', 'iguru' ),
					'l' => esc_html__( 'Large', 'iguru' ),
					'xl' => esc_html__( 'Extra Large', 'iguru' ),
				),
				'default' => 's'
			), 
			array(
				'id'      => 'bottom_header_button1_custom',
				'type'    => 'switch',
				'title'   => esc_html__( 'Customize Button', 'iguru' ),
				'default' => false,
			),
			array(
				'id'      => 'bottom_header_button1_color_txt',
				'type'    => 'color_rgba',
				'title'   => esc_html__( 'Text Color', 'iguru' ),
				'default' => array(
					'color' => '#ffffff',
					'alpha' => '1',
					'rgba'  => 'rgba(255,255,255,1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button1_custom', '=', '1' ],
			), 
			array(
				'id'       => 'bottom_header_button1_hover_color_txt',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Hover Text Color', 'iguru' ),
				'default'  => array(
					'color' => '#2c2c2c',
					'alpha' => '1',
					'rgba'  => 'rgba(51, 57, 73, 1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button1_custom', '=', '1' ],
			),
			array(
				'id'       => 'bottom_header_button1_bg',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Background Color', 'iguru' ),
				'default'  => array(
					'color' => '#2c2c2c',
					'alpha' => '1',
					'rgba'  => 'rgba(51, 57, 73, 1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button1_custom', '=', '1' ],
			), 
			array(
				'id'       => 'bottom_header_button1_hover_bg',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Hover Background Color', 'iguru' ),
				'default'  => array(
					'color' => '#ffffff',
					'alpha' => '1',
					'rgba'  => 'rgba(255,255,255,1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button1_custom', '=', '1' ],
			),
			array(
				'id'       => 'bottom_header_button1_border',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Border Color', 'iguru' ),
				'default'  => array(
					'color' => '#2c2c2c',
					'alpha' => '1',
					'rgba'  => 'rgba(51, 57, 73, 1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button1_custom', '=', '1' ],
			), 
			array(
				'id'       => 'bottom_header_button1_hover_border',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Hover Border Color', 'iguru' ),
				'default'  => array(
					'color' => '#2c2c2c',
					'alpha' => '1',
					'rgba'  => 'rgba(51, 57, 73, 1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button1_custom', '=', '1' ],
			),
			array(
				'id'       => 'bottom_header_button1_custom_sticky',
				'type'     => 'switch',
				'title'    => esc_html__( 'Customize Sticky Button', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'       => 'bottom_header_button1_color_txt_sticky',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Sticky Text Color', 'iguru' ),
				'default'  => array(
					'color' => '#ffffff',
					'alpha' => '1',
					'rgba'  => 'rgba(255,255,255,1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button1_custom_sticky', '=', '1' ],
			), 
			array(
				'id'       => 'bottom_header_button1_hover_color_txt_sticky',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Sticky Hover Text Color', 'iguru' ),
				'default'  => array(
					'color' => '#2c2c2c',
					'alpha' => '1',
					'rgba'  => 'rgba(51, 57, 73, 1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button1_custom_sticky', '=', '1' ],
			),
			array(
				'id'       => 'bottom_header_button1_bg_sticky',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Sticky Background Color', 'iguru' ),
				'default'  => array(
					'color' => '#2c2c2c',
					'alpha' => '1',
					'rgba'  => 'rgba(51, 57, 73, 1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button1_custom_sticky', '=', '1' ],
			), 
			array(
				'id'       => 'bottom_header_button1_hover_bg_sticky',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Sticky Hover Background Color', 'iguru' ),
				'default'  => array(
					'color' => '#ffffff',
					'alpha' => '1',
					'rgba'  => 'rgba(255,255,255,1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button1_custom_sticky', '=', '1' ],
			),
			array(
				'id'       => 'bottom_header_button1_border_sticky',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Sticky Border Color', 'iguru' ),
				'default'  => array(
					'color' => '#2c2c2c',
					'alpha' => '1',
					'rgba'  => 'rgba(51, 57, 73, 1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button1_custom_sticky', '=', '1' ],
			),
			array(
				'id'       => 'bottom_header_button1_hover_border_sticky',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Sticky Hover Border Color', 'iguru' ),
				'default'  => array(
					'color' => '#2c2c2c',
					'alpha' => '1',
					'rgba'  => 'rgba(51, 57, 73, 1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button1_custom_sticky', '=', '1' ],
			),
			array(
				'id'      => 'bottom_header_button2_title',
				'type'    => 'text',
				'title'   => esc_html__( 'Button Text', 'iguru' ),
				'default' => esc_html__( 'Buy Course', 'iguru' ),
			), 
			array(
				'id'      => 'bottom_header_button2_link',
				'type'    => 'text',
				'title'   => esc_html__( 'Link', 'iguru' )
			), 
			array(
				'id'      => 'bottom_header_button2_target',
				'type'    => 'switch',
				'title'   => esc_html__( 'Open link in a new tab', 'iguru' ),
				'default' => true,
			),
			array(
				'id'      => 'bottom_header_button2_size',
				'type'    => 'select',
				'title'   => esc_html__( 'Button Size', 'iguru' ),
				'options' => array(
					's' => esc_html__( 'Small', 'iguru' ),
					'm' => esc_html__( 'Medium', 'iguru' ),
					'l' => esc_html__( 'Large', 'iguru' ),
					'xl' => esc_html__( 'Extra Large', 'iguru' ),
				),
				'default'  => 'm'
			), 
			array(
				'id'      => 'bottom_header_button2_custom',
				'type'    => 'switch',
				'title'   => esc_html__( 'Customize Button', 'iguru' ),
				'default' => false,
			),
			array(
				'id'      => 'bottom_header_button2_color_txt',
				'type'    => 'color_rgba',
				'title'   => esc_html__( 'Text Color', 'iguru' ),
				'default' => array(
					'color' => '#ffffff',
					'alpha' => '1',
					'rgba'  => 'rgba(255,255,255,1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button2_custom', '=', '1' ],
			), 
			array(
				'id'       => 'bottom_header_button2_hover_color_txt',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Hover Text Color', 'iguru' ),
				'default'  => array(
					'color' => '#2c2c2c',
					'alpha' => '1',
					'rgba'  => 'rgba(51, 57, 73, 1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button2_custom', '=', '1' ],
			),
			array(
				'id'       => 'bottom_header_button2_bg',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Background Color', 'iguru' ),
				'default'  => array(
					'color' => '#2c2c2c',
					'alpha' => '1',
					'rgba'  => 'rgba(51, 57, 73, 1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button2_custom', '=', '1' ],
			), 
			array(
				'id'       => 'bottom_header_button2_hover_bg',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Hover Background Color', 'iguru' ),
				'default'  => array(
					'color' => '#ffffff',
					'alpha' => '1',
					'rgba'  => 'rgba(255,255,255,1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button2_custom', '=', '1' ],
			),
			array(
				'id'       => 'bottom_header_button2_border',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Border Color', 'iguru' ),
				'default'  => array(
					'color' => '#2c2c2c',
					'alpha' => '1',
					'rgba'  => 'rgba(51, 57, 73, 1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button2_custom', '=', '1' ],
			), 
			array(
				'id'       => 'bottom_header_button2_hover_border',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Hover Border Color', 'iguru' ),
				'default'  => array(
					'color' => '#2c2c2c',
					'alpha' => '1',
					'rgba'  => 'rgba(51, 57, 73, 1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button2_custom', '=', '1' ],
			),
			array(
				'id'       => 'bottom_header_button2_custom_sticky',
				'type'     => 'switch',
				'title'    => esc_html__( 'Customize Sticky Button', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'       => 'bottom_header_button2_color_txt_sticky',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Sticky Text Color', 'iguru' ),
				'default'  => array(
					'color' => '#ffffff',
					'alpha' => '1',
					'rgba'  => 'rgba(255,255,255,1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button2_custom_sticky', '=', '1' ],
			), 
			array(
				'id'       => 'bottom_header_button2_hover_color_txt_sticky',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Sticky Hover Text Color', 'iguru' ),
				'default'  => array(
					'color' => '#2c2c2c',
					'alpha' => '1',
					'rgba'  => 'rgba(51, 57, 73, 1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button2_custom_sticky', '=', '1' ],
			),
			array(
				'id'       => 'bottom_header_button2_bg_sticky',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Sticky Background Color', 'iguru' ),
				'default'  => array(
					'color' => '#2c2c2c',
					'alpha' => '1',
					'rgba'  => 'rgba(51, 57, 73, 1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button2_custom_sticky', '=', '1' ],
			), 
			array(
				'id'       => 'bottom_header_button2_hover_bg_sticky',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Sticky Hover Background Color', 'iguru' ),
				'default'  => array(
					'color' => '#ffffff',
					'alpha' => '1',
					'rgba'  => 'rgba(255,255,255,1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button2_custom_sticky', '=', '1' ],
			),
			array(
				'id'       => 'bottom_header_button2_border_sticky',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Sticky Border Color', 'iguru' ),
				'default'  => array(
					'color' => '#2c2c2c',
					'alpha' => '1',
					'rgba'  => 'rgba(51, 57, 73, 1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button2_custom_sticky', '=', '1' ],
			), 
			array(
				'id'       => 'bottom_header_button2_hover_border_sticky',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Sticky Hover Border Color', 'iguru' ),
				'default'  => array(
					'color' => '#2c2c2c',
					'alpha' => '1',
					'rgba'  => 'rgba(51, 57, 73, 1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button2_custom_sticky', '=', '1' ],
			),
			array(
				'id'      => 'bottom_header_button3_title',
				'type'    => 'text',
				'title'   => esc_html__( 'Button Text', 'iguru' ),
				'default' => esc_html__( 'Buy Course', 'iguru' ),
			), 
			array(
				'id'      => 'bottom_header_button3_link',
				'type'    => 'text',
				'title'   => esc_html__( 'Link', 'iguru' )
			), 
			array(
				'id'      => 'bottom_header_button3_target',
				'type'    => 'switch',
				'title'   => esc_html__( 'Open link in a new tab', 'iguru' ),
				'default' => true,
			),
			array(
				'id'      => 'bottom_header_button3_size',
				'type'    => 'select',
				'title'   => esc_html__( 'Button Size', 'iguru' ),
				'options' => array(
					's' => esc_html__( 'Small', 'iguru' ),
					'm' => esc_html__( 'Medium', 'iguru' ),
					'l' => esc_html__( 'Large', 'iguru' ),
					'xl' => esc_html__( 'Extra Large', 'iguru' ),
					
				),
				'default'  => 'm'
			), 
			array(
				'id'      => 'bottom_header_button3_custom',
				'type'    => 'switch',
				'title'   => esc_html__( 'Customize Button', 'iguru' ),
				'default' => false,
			),
			array(
				'id'      => 'bottom_header_button3_color_txt',
				'type'    => 'color_rgba',
				'title'   => esc_html__( 'Text Color', 'iguru' ),
				'default' => array(
					'color' => '#ffffff',
					'alpha' => '1',
					'rgba'  => 'rgba(255,255,255,1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button3_custom', '=', '1' ],
			), 
			array(
				'id'       => 'bottom_header_button3_hover_color_txt',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Hover Text Color', 'iguru' ),
				'default'  => array(
					'color' => '#2c2c2c',
					'alpha' => '1',
					'rgba'  => 'rgba(51, 57, 73, 1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button3_custom', '=', '1' ],
			),
			array(
				'id'       => 'bottom_header_button3_bg',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Background Color', 'iguru' ),
				'default'  => array(
					'color' => '#2c2c2c',
					'alpha' => '1',
					'rgba'  => 'rgba(51, 57, 73, 1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button3_custom', '=', '1' ],
			), 
			array(
				'id'       => 'bottom_header_button3_hover_bg',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Hover Background Color', 'iguru' ),
				'default'  => array(
					'color' => '#ffffff',
					'alpha' => '1',
					'rgba'  => 'rgba(255,255,255,1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button3_custom', '=', '1' ],
			),
			array(
				'id'       => 'bottom_header_button3_border',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Border Color', 'iguru' ),
				'default'  => array(
					'color' => '#2c2c2c',
					'alpha' => '1',
					'rgba'  => 'rgba(51, 57, 73, 1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button3_custom', '=', '1' ],
			), 
			array(
				'id'       => 'bottom_header_button3_hover_border',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Hover Border Color', 'iguru' ),
				'default'  => array(
					'color' => '#2c2c2c',
					'alpha' => '1',
					'rgba'  => 'rgba(51, 57, 73, 1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button3_custom', '=', '1' ],
			),
			array(
				'id'      => 'bottom_header_button3_custom_sticky',
				'type'    => 'switch',
				'title'   => esc_html__( 'Customize Sticky Button', 'iguru' ),
				'default' => false,
			),
			array(
				'id'      => 'bottom_header_button3_color_txt_sticky',
				'type'    => 'color_rgba',
				'title'   => esc_html__( 'Sticky Text Color', 'iguru' ),
				'default' => array(
					'color' => '#ffffff',
					'alpha' => '1',
					'rgba'  => 'rgba(255,255,255,1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button3_custom_sticky', '=', '1' ],
			), 
			array(
				'id'      => 'bottom_header_button3_hover_color_txt_sticky',
				'type'    => 'color_rgba',
				'title'   => esc_html__( 'Sticky Hover Text Color', 'iguru' ),
				'default' => array(
					'color' => '#2c2c2c',
					'alpha' => '1',
					'rgba'  => 'rgba(51, 57, 73, 1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button3_custom_sticky', '=', '1' ],
			),
			array(
				'id'      => 'bottom_header_button3_bg_sticky',
				'type'    => 'color_rgba',
				'title'   => esc_html__( 'Sticky Background Color', 'iguru' ),
				'default' => array(
					'color' => '#2c2c2c',
					'alpha' => '1',
					'rgba'  => 'rgba(51, 57, 73, 1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button3_custom_sticky', '=', '1' ],
			), 
			array(
				'id'      => 'bottom_header_button3_hover_bg_sticky',
				'type'    => 'color_rgba',
				'title'   => esc_html__( 'Sticky Hover Background Color', 'iguru' ),
				'default' => array(
					'color' => '#ffffff',
					'alpha' => '1',
					'rgba'  => 'rgba(255,255,255,1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button3_custom_sticky', '=', '1' ],
			),
			array(
				'id'      => 'bottom_header_button3_border_sticky',
				'type'    => 'color_rgba',
				'title'   => esc_html__( 'Sticky Border Color', 'iguru' ),
				'default' => array(
					'color' => '#2c2c2c',
					'alpha' => '1',
					'rgba'  => 'rgba(51, 57, 73, 1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button3_custom_sticky', '=', '1' ],
			), 
			array(
				'id'      => 'bottom_header_button3_hover_border_sticky',
				'type'    => 'color_rgba',
				'title'   => esc_html__( 'Sticky Hover Border Color', 'iguru' ),
				'default' => array(
					'color' => '#2c2c2c',
					'alpha' => '1',
					'rgba'  => 'rgba(51, 57, 73, 1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button3_custom_sticky', '=', '1' ],
			),
			array(
				'id'      => 'bottom_header_button4_title',
				'type'    => 'text',
				'title'   => esc_html__( 'Button Text', 'iguru' ),
				'default' => esc_html__( 'Sign In / Sign Up', 'iguru' ),
			), 
			array(
				'id'      => 'bottom_header_button4_link',
				'type'    => 'text',
				'title'   => esc_html__( 'Link', 'iguru' ),
			), 
			array(
				'id'      => 'bottom_header_button4_target',
				'type'    => 'switch',
				'title'   => esc_html__( 'Open link in a new tab', 'iguru' ),
				'default' => true,
			),
			array(
				'id'      => 'bottom_header_button4_size',
				'type'    => 'select',
				'title'   => esc_html__( 'Button Size', 'iguru' ),
				'options' => array(
					's' => esc_html__( 'Small', 'iguru' ),
					'm' => esc_html__( 'Medium', 'iguru' ),
					'l' => esc_html__( 'Large', 'iguru' ),
					'xl' => esc_html__( 'Extra Large', 'iguru' ),
				),
				'default'  => 'm'
			), 
			array(
				'id'       => 'bottom_header_button4_custom',
				'type'     => 'switch',
				'title'    => esc_html__( 'Customize Button', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'       => 'bottom_header_button4_color_txt',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Text Color', 'iguru' ),
				'default'  => array(
					'color' => '#ffffff',
					'alpha' => '1',
					'rgba'  => 'rgba(255,255,255,1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button4_custom', '=', '1' ],
			), 
			array(
				'id'       => 'bottom_header_button4_hover_color_txt',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Hover Text Color', 'iguru' ),
				'default'  => array(
					'color' => '#2c2c2c',
					'alpha' => '1',
					'rgba'  => 'rgba(51, 57, 73, 1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button4_custom', '=', '1' ],
			),
			array(
				'id'       => 'bottom_header_button4_bg',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Background Color', 'iguru' ),
				'default'  => array(
					'color' => '#fd226a',
					'alpha' => '1',
					'rgba'  => 'rgba(253,34,106,1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button4_custom', '=', '1' ],
			), 
			array(
				'id'       => 'bottom_header_button4_hover_bg',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Hover Background Color', 'iguru' ),
				'default'  => array(
					'color' => '#ffffff',
					'alpha' => '1',
					'rgba'  => 'rgba(255,255,255,1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button4_custom', '=', '1' ],
			),
			array(
				'id'       => 'bottom_header_button4_border',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Border Color', 'iguru' ),
				'default'  => array(
					'color' => '#2c2c2c',
					'alpha' => '1',
					'rgba'  => 'rgba(51, 57, 73, 1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button4_custom', '=', '1' ],
			), 
			array(
				'id'       => 'bottom_header_button4_hover_border',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Hover Border Color', 'iguru' ),
				'default'  => array(
					'color' => '#2c2c2c',
					'alpha' => '1',
					'rgba'  => 'rgba(51, 57, 73, 1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button4_custom', '=', '1' ],
			),
			array(
				'id'       => 'bottom_header_button4_custom_sticky',
				'type'     => 'switch',
				'title'    => esc_html__( 'Customize Sticky Button', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'       => 'bottom_header_button4_color_txt_sticky',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Sticky Text Color', 'iguru' ),
				'default'  => array(
					'color' => '#ffffff',
					'alpha' => '1',
					'rgba'  => 'rgba(255,255,255,1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button4_custom_sticky', '=', '1' ],
			), 
			array(
				'id'       => 'bottom_header_button4_hover_color_txt_sticky',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Sticky Hover Text Color', 'iguru' ),
				'default'  => array(
					'color' => '#2c2c2c',
					'alpha' => '1',
					'rgba'  => 'rgba(51, 57, 73, 1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button4_custom_sticky', '=', '1' ],
			),
			array(
				'id'       => 'bottom_header_button4_bg_sticky',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Sticky Background Color', 'iguru' ),
				'default'  => array(
					'color' => '#fd226a',
					'alpha' => '1',
					'rgba'  => 'rgba(253,34,106,1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button4_custom_sticky', '=', '1' ],
			), 
			array(
				'id'       => 'bottom_header_button4_hover_bg_sticky',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Sticky Hover Background Color', 'iguru' ),
				'default'  => array(
					'color' => '#ffffff',
					'alpha' => '1',
					'rgba'  => 'rgba(255,255,255,1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button4_custom_sticky', '=', '1' ],
			),
			array(
				'id'       => 'bottom_header_button4_border_sticky',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Sticky Border Color', 'iguru' ),
				'default'  => array(
					'color' => '#2c2c2c',
					'alpha' => '1',
					'rgba'  => 'rgba(51, 57, 73, 1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button4_custom_sticky', '=', '1' ],
			), 
			array(
				'id'       => 'bottom_header_button4_hover_border_sticky',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Sticky Hover Border Color', 'iguru' ),
				'default'  => array(
					'color' => '#2c2c2c',
					'alpha' => '1',
					'rgba'  => 'rgba(51, 57, 73, 1)'
				),
				'mode'     => 'background',
				'required' => [ 'bottom_header_button4_custom_sticky', '=', '1' ],
			),
			array(
				'id'      => 'bottom_header_bar_html1_editor',
				'type'    => 'ace_editor',
				'mode'    => 'html',
				'title'   => esc_html__( 'HTML Element 1 Editor', 'iguru' ),
				'default' => '',
			),
			array(
				'id'      => 'bottom_header_bar_html2_editor',
				'type'    => 'ace_editor',
				'mode'    => 'html',
				'title'   => esc_html__( 'HTML Element 2 Editor', 'iguru' ),
				'default' => '',
			),
			array(
				'id'      => 'bottom_header_bar_html3_editor',
				'type'    => 'ace_editor',
				'mode'    => 'html',
				'title'   => esc_html__( 'HTML Element 3 Editor', 'iguru' ),
				'default' => '',
			),
			array(
				'id'      => 'bottom_header_bar_html4_editor',
				'type'    => 'ace_editor',
				'mode'    => 'html',
				'title'   => esc_html__( 'HTML Element 4 Editor', 'iguru' ),
				'default' => '',
			),array(
				'id'      => 'bottom_header_bar_html5_editor',
				'type'    => 'ace_editor',
				'mode'    => 'html',
				'title'   => esc_html__( 'HTML Element 5 Editor', 'iguru' ),
				'default' => '',
			),
			array(
				'id'      => 'bottom_header_bar_html6_editor',
				'type'    => 'ace_editor',
				'mode'    => 'html',
				'title'   => esc_html__( 'HTML Element 6 Editor', 'iguru' ),
				'default' => '',
			),
			array(
				'id'      => 'bottom_header_bar_html7_editor',
				'type'    => 'ace_editor',
				'mode'    => 'html',
				'title'   => esc_html__( 'HTML Element 7 Editor', 'iguru' ),
				'default' => '',
			),
			array(
				'id'      => 'bottom_header_bar_html8_editor',
				'type'    => 'ace_editor',
				'mode'    => 'html',
				'title'   => esc_html__( 'HTML Element 8 Editor', 'iguru' ),
				'default' => '',
			), 
			array(
				'id'       => 'header_top-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Header Top Options', 'iguru' ),
				'indent'   => true,
			),
			array(
				'id'       => 'header_top_full_width',
				'type'     => 'switch',
				'title'    => esc_html__( 'Full Width Top Header', 'iguru' ),
				'subtitle' => esc_html__( 'Set header content in full width top layout', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'             => 'header_top_height',
				'type'           => 'dimensions',
				'units'          => false, 
				'units_extended' => false,
				'title'          => esc_html__( 'Header Top Height', 'iguru' ),
				'height'         => true,
				'width'          => false,
				'default'        => [ 'height' => 40 ]
			),
			array(
				'id'       => 'header_top_background_image',
				'type'     => 'media',
				'title'    => esc_html__( 'Header Top Background Image', 'iguru' ),
			),
			array(
				'id'       => 'header_top_background',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Header Top Background', 'iguru' ),
				'mode'     => 'background',
				'default'  => [
					'color' => '#181b24',
					'alpha' => '1',
					'rgba'  => 'rgba(24, 27, 36, 1)'
				],
			),
			array(
				'id'       => 'header_top_color',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Header Top Text Color', 'iguru' ),
				'mode'     => 'background',
				'default'  => [
					'color' => '#ffffff',
					'alpha' => '1',
					'rgba'  => 'rgba(255,255,255,1)'
				],
			),
			array(
				'id'       => 'header_top_bottom_border',
				'type'     => 'switch',
				'title'    => esc_html__( 'Use Bottom Border?', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'       => 'header_top_border_height',
				'type'     => 'dimensions',
				'units'    => false, 
				'units_extended' => false,
				'title'    => esc_html__( 'Bottom Border Width' , 'iguru' ),
				'height'   => true,
				'width'    => false,
				'default'  => array( 'height' => '1' ),
				'required' => array( array( 'header_top_bottom_border', '=', '1' ) ),
			),
			array(
				'id'       => 'header_top_bottom_border_color',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Bottom Border Color', 'iguru' ),
				'default'  => array(
					'color' => '#2b3258',
					'alpha' => '1',
					'rgba'  => 'rgba(43,50,88,1)'
				),
				'mode'     => 'background',
				'required' => array( array( 'header_top_bottom_border', '=', '1' ) ), 
			),
			array(
				'id'     => 'header_top-end',
				'type'   => 'section',
				'indent' => false, 
			), 
			array(
				'id'       => 'header_middle-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Header Middle Options', 'iguru' ),
				'indent'   => true,
			),
			array(
				'id'       => 'header_middle_full_width',
				'type'     => 'switch',
				'title'    => esc_html__( 'Full Width Middle Header', 'iguru' ),
				'subtitle' => esc_html__( 'Let content fill the full width of header', 'iguru' ),
				'default'  => true,
			),
			array(
				'id'       => 'header_middle_height',
				'type'     => 'dimensions',
				'units'    => false, 
				'units_extended' => false,
				'title'    => esc_html__( 'Header Middle Height', 'iguru' ),
				'height'   => true,
				'width'    => false,
				'default'  => array( 'height' => 110 )
			),
			array(
				'id'       => 'header_middle_background_image',
				'type'     => 'media',
				'title'    => esc_html__( 'Header Middle Background Image', 'iguru' ),
			),
			array(
				'id'       => 'header_middle_background',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Header Middle Background', 'iguru' ),
				'default'  => array(
					'color' => '#ffffff',
					'alpha' => '1',
					'rgba'  => 'rgba(255,255,255,1)'
				),
				'mode'     => 'background',
			),
			array(
				'id'       => 'header_middle_color',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Header Middle Text Color', 'iguru' ),
				'default'  => array(
					'color' => '#2c2c2c',
					'alpha' => '1',
					'rgba'  => 'rgba(51,57,73,1)'
				),
				'mode'     => 'background',
			),
			array(
				'id'       => 'header_middle_bottom_border',
				'type'     => 'switch',
				'title'    => esc_html__( 'Use Bottom Border', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'             => 'header_middle_border_height',
				'type'           => 'dimensions',
				'units'          => false, 
				'units_extended' => false,
				'title'          => esc_html__( 'Header Middle Border Width' , 'iguru' ),
				'height'         => true,
				'width'          => false,
				'default'        => array(
					'height' => '1',
				),
				'required' => array(
					array( 'header_middle_bottom_border', '=', '1' )
				),
			),
			array(
				'id'       => 'header_middle_bottom_border_color',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Header Middle Border Color', 'iguru' ),
				'default'  => array(
					'color' => '#2b3258',
					'alpha' => '1',
					'rgba'  => 'rgba(43,50,88,1)'
				),
				'mode'     => 'background',
				'required' => array( array( 'header_middle_bottom_border', '=', '1' ) ), 
			),
			array(
				'id'     => 'header_middle-end',
				'type'   => 'section',
				'indent' => false, 
			),

			array(
				'id'       => 'header_bottom-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Header Bottom Options', 'iguru' ),
				'indent'   => true,
			),
			array(
				'id'       => 'header_bottom_full_width',
				'type'     => 'switch',
				'title'    => esc_html__( 'Full Width Bottom Header', 'iguru' ),
				'subtitle' => esc_html__( 'Set header content in full width bottom layout', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'       => 'header_bottom_height',
				'type'     => 'dimensions',
				'units'    => false, 
				'units_extended' => false,
				'title'    => esc_html__( 'Header Bottom Height', 'iguru' ),
				'height'   => true,
				'width'    => false,
				'default'  => array( 'height' => 100 )
			),
			array(
				'id'       => 'header_bottom_background_image',
				'type'     => 'media',
				'title'    => esc_html__( 'Header Bottom Background Image', 'iguru' ),
			),
			array(
				'id'       => 'header_bottom_background',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Header Bottom Background', 'iguru' ),
				'default'  => array(
					'color' => '#ffffff',
					'alpha' => '.9',
					'rgba'  => 'rgba(255,255,255,0.9)'
				),
				'mode'     => 'background',
			),
			array(
				'id'       => 'header_bottom_color',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Header Bottom Text Color', 'iguru' ),
				'subtitle' => esc_html__( 'Set Bottom header text color', 'iguru' ),
				'default'  => array(
					'color' => '#fefefe',
					'alpha' => '.5',
					'rgba'  => 'rgba(254,254,254,0.5)'
				),
				'mode'     => 'background',
			),
			array(
				'id'       => 'header_bottom_bottom_border',
				'type'     => 'switch',
				'title'    => esc_html__( 'Set Header Bottom Border', 'iguru' ),
				'default'  => true,
			),
			array(
				'id'       => 'header_bottom_border_height',
				'type'     => 'dimensions',
				'units'    => false, 
				'units_extended' => false,
				'title'    => esc_html__( 'Header Bottom Border Width' , 'iguru' ),
				'height'   => true,
				'width'    => false,
				'default'  => array( 'height' => '1' ),
				'required' => array( array( 'header_bottom_bottom_border', '=', '1' ) ),
			),
			array(
				'id'       => 'header_bottom_bottom_border_color',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Header Bottom Border Color', 'iguru' ),
				'default'  => array(
					'color' => '#2b3258',
					'alpha' => '1',
					'rgba'  => 'rgba(43,50,88,1)'
				),
				'mode'     => 'background',
				'required' => array( array( 'header_bottom_bottom_border', '=', '1' ) ), 
			),
			array(
				'id'     => 'header_bottom-end',
				'type'   => 'section',
				'indent' => false, 
			),
			array(
				'id'       => 'header_column-top-left-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Top Left Column Options', 'iguru' ),
				'indent'   => true,
			),
			array(
				'id'       => 'header_column_top_left_horz',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Horizontal Align', 'iguru' ),
				'options'  => array(
					'left' => esc_html__( 'Left', 'iguru' ),
					'center' => esc_html__( 'Center', 'iguru' ),
					'right' => esc_html__( 'Right', 'iguru' ),
				),
				'default'  => 'left'
			),
			array(
				'id'       => 'header_column_top_left_vert',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Vertical Align', 'iguru' ),
				'options'  => array(
					'top'    => esc_html__( 'Top', 'iguru' ),
					'middle' => esc_html__( 'Middle', 'iguru' ),
					'bottom' => esc_html__( 'Bottom', 'iguru' ),
				),
				'default'  => 'middle'
			),
			array(
				'id'       => 'header_column_top_left_display',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Display', 'iguru' ),
				'options'  => array(
					'normal' => esc_html__( 'Normal', 'iguru' ),
					'grow'   => esc_html__( 'Grow', 'iguru' ),
				),
				'default'  => 'normal'
			),
			array(
				'id'     => 'header_column-top-left-end',
				'type'   => 'section',
				'indent' => false, 
			),
			array(
				'id'       => 'header_column-top-center-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Top Center Column Options', 'iguru' ),
				'indent'   => true,
			),
			array(
				'id'       => 'header_column_top_center_horz',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Horizontal Align', 'iguru' ),
				'options'  => array(
					'left'   => esc_html__( 'Left', 'iguru' ),
					'center' => esc_html__( 'Center', 'iguru' ),
					'right'  => esc_html__( 'Right', 'iguru' ),
				),
				'default'  => 'left'
			),
			array(
				'id'       => 'header_column_top_center_vert',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Vertical Align', 'iguru' ),
				'options'  => array(
					'top'    => esc_html__( 'Top', 'iguru' ),
					'middle' => esc_html__( 'Middle', 'iguru' ),
					'bottom' => esc_html__( 'Bottom', 'iguru' ),
				),
				'default'  => 'middle'
			),
			array(
				'id'       => 'header_column_top_center_display',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Display', 'iguru' ),
				'options'  => array(
					'normal' => esc_html__( 'Normal', 'iguru' ),
					'grow'   => esc_html__( 'Grow', 'iguru' ),
				),
				'default'  => 'normal'
			),
			array(
				'id'     => 'header_column-top-center-end',
				'type'   => 'section',
				'indent' => false, 
			),
			array(
				'id'       => 'header_column-top-center-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Top Center Column Options', 'iguru' ),
				'indent'   => true,
			),
			array(
				'id'       => 'header_column_top_center_horz',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Horizontal Align', 'iguru' ),
				'options'  => array(
					'left' => esc_html__( 'Left', 'iguru' ),
					'center' => esc_html__( 'Center', 'iguru' ),
					'right' => esc_html__( 'Right', 'iguru' ),
				),
				'default'  => 'left'
			),
			array(
				'id'       => 'header_column_top_center_vert',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Vertical Align', 'iguru' ),
				'options'  => array(
					'top' => esc_html__( 'Top', 'iguru' ),
					'middle' => esc_html__( 'Middle', 'iguru' ),
					'bottom' => esc_html__( 'Bottom', 'iguru' ),
				),
				'default'  => 'middle'
			),
			array(
				'id'       => 'header_column_top_center_display',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Display', 'iguru' ),
				'options'  => array(
					'normal' => esc_html__( 'Normal', 'iguru' ),
					'grow' => esc_html__( 'Grow', 'iguru' ),
				),
				'default'  => 'normal'
			),
			array(
				'id'     => 'header_column-top-center-end',
				'type'   => 'section',
				'indent' => false, 
			),
			array(
				'id'       => 'header_column-top-right-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Top Right Column Options', 'iguru' ),
				'indent'   => true,
			),
			array(
				'id'       => 'header_column_top_right_horz',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Horizontal Align', 'iguru' ),
				'options'  => array(
					'left' => esc_html__( 'Left', 'iguru' ),
					'center' => esc_html__( 'Center', 'iguru' ),
					'right' => esc_html__( 'Right', 'iguru' ),
				),
				'default'  => 'right'
			),
			array(
				'id'       => 'header_column_top_right_vert',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Vertical Align', 'iguru' ),
				'options'  => array(
					'top' => esc_html__( 'Top', 'iguru' ),
					'middle' => esc_html__( 'Middle', 'iguru' ),
					'bottom' => esc_html__( 'Bottom', 'iguru' ),
				),
				'default'  => 'middle'
			),
			array(
				'id'       => 'header_column_top_right_display',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Display', 'iguru' ),
				'options'  => array(
					'normal' => esc_html__( 'Normal', 'iguru' ),
					'grow' => esc_html__( 'Grow', 'iguru' ),
				),
				'default'  => 'normal'
			),
			array(
				'id'     => 'header_column-top-right-end',
				'type'   => 'section',
				'indent' => false, 
			),
			array(
				'id'       => 'header_column-middle-left-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Middle Left Column Options', 'iguru' ),
				'indent'   => true,
			),
			array(
				'id'       => 'header_column_middle_left_horz',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Horizontal Align', 'iguru' ),
				'options'  => array(
					'left' => esc_html__( 'Left', 'iguru' ),
					'center' => esc_html__( 'Center', 'iguru' ),
					'right' => esc_html__( 'Right', 'iguru' ),
				),
				'default'  => 'left'
			),
			array(
				'id'       => 'header_column_middle_left_vert',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Vertical Align', 'iguru' ),
				'options'  => array(
					'top' => esc_html__( 'Top', 'iguru' ),
					'middle' => esc_html__( 'Middle', 'iguru' ),
					'bottom' => esc_html__( 'Bottom', 'iguru' ),
				),
				'default'  => 'middle'
			),
			array(
				'id'       => 'header_column_middle_left_display',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Display', 'iguru' ),
				'options'  => array(
					'normal' => esc_html__( 'Normal', 'iguru' ),
					'grow' => esc_html__( 'Grow', 'iguru' ),
				),
				'default'  => 'normal'
			),
			array(
				'id'     => 'header_column-middle-left-end',
				'type'   => 'section',
				'indent' => false, 
			),
			array(
				'id'       => 'header_column-middle-center-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Middle Center Column Options', 'iguru' ),
				'indent'   => true,
			),
			array(
				'id'       => 'header_column_middle_center_horz',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Horizontal Align', 'iguru' ),
				'options'  => array(
					'left' => esc_html__( 'Left', 'iguru' ),
					'center' => esc_html__( 'Center', 'iguru' ),
					'right' => esc_html__( 'Right', 'iguru' ),
				),
				'default'  => 'left'
			),
			array(
				'id'       => 'header_column_middle_center_vert',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Vertical Align', 'iguru' ),
				'options'  => array(
					'top' => esc_html__( 'Top', 'iguru' ),
					'middle' => esc_html__( 'Middle', 'iguru' ),
					'bottom' => esc_html__( 'Bottom', 'iguru' ),
				),
				'default'  => 'middle'
			),
			array(
				'id'       => 'header_column_middle_center_display',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Display', 'iguru' ),
				'options'  => array(
					'normal' => esc_html__( 'Normal', 'iguru' ),
					'grow' => esc_html__( 'Grow', 'iguru' ),
				),
				'default'  => 'normal'
			),
			array(
				'id'     => 'header_column-middle-center-end',
				'type'   => 'section',
				'indent' => false, 
			),
			array(
				'id'       => 'header_column-middle-center-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Middle Center Column Options', 'iguru' ),
				'indent'   => true,
			),
			array(
				'id'       => 'header_column_middle_center_horz',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Horizontal Align', 'iguru' ),
				'options'  => array(
					'left' => esc_html__( 'Left', 'iguru' ),
					'center' => esc_html__( 'Center', 'iguru' ),
					'right' => esc_html__( 'Right', 'iguru' ),
				),
				'default'  => 'left'
			),
			array(
				'id'       => 'header_column_middle_center_vert',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Vertical Align', 'iguru' ),
				'options'  => array(
					'top' => esc_html__( 'Top', 'iguru' ),
					'middle' => esc_html__( 'Middle', 'iguru' ),
					'bottom' => esc_html__( 'Bottom', 'iguru' ),
				),
				'default'  => 'middle'
			),
			array(
				'id'       => 'header_column_middle_center_display',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Display', 'iguru' ),
				'options'  => array(
					'normal' => esc_html__( 'Normal', 'iguru' ),
					'grow' => esc_html__( 'Grow', 'iguru' ),
				),
				'default'  => 'normal'
			),
			array(
				'id'     => 'header_column-middle-center-end',
				'type'   => 'section',
				'indent' => false, 
			),
			array(
				'id'       => 'header_column-middle-right-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Middle Right Column Options', 'iguru' ),
				'indent'   => true,
			),
			array(
				'id'       => 'header_column_middle_right_horz',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Horizontal Align', 'iguru' ),
				'options'  => array(
					'left' => esc_html__( 'Left', 'iguru' ),
					'center' => esc_html__( 'Center', 'iguru' ),
					'right' => esc_html__( 'Right', 'iguru' ),
				),
				'default'  => 'right'
			),
			array(
				'id'       => 'header_column_middle_right_vert',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Vertical Align', 'iguru' ),
				'options'  => array(
					'top' => esc_html__( 'Top', 'iguru' ),
					'middle' => esc_html__( 'Middle', 'iguru' ),
					'bottom' => esc_html__( 'Bottom', 'iguru' ),
				),
				'default'  => 'middle'
			),
			array(
				'id'       => 'header_column_middle_right_display',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Display', 'iguru' ),
				'options'  => array(
					'normal' => esc_html__( 'Normal', 'iguru' ),
					'grow' => esc_html__( 'Grow', 'iguru' ),
				),
				'default'  => 'normal'
			),
			array(
				'id'     => 'header_column-middle-right-end',
				'type'   => 'section',
				'indent' => false, 
			),
			array(
				'id'       => 'header_column-bottom-left-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Bottom Left Column Options', 'iguru' ),
				'indent'   => true,
			),
			array(
				'id'       => 'header_column_bottom_left_horz',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Horizontal Align', 'iguru' ),
				'options'  => array(
					'left' => esc_html__( 'Left', 'iguru' ),
					'center' => esc_html__( 'Center', 'iguru' ),
					'right' => esc_html__( 'Right', 'iguru' ),
				),
				'default'  => 'left'
			),
			array(
				'id'       => 'header_column_bottom_left_vert',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Vertical Align', 'iguru' ),
				'options'  => array(
					'top' => esc_html__( 'Top', 'iguru' ),
					'middle' => esc_html__( 'Middle', 'iguru' ),
					'bottom' => esc_html__( 'Bottom', 'iguru' ),
				),
				'default'  => 'middle'
			),
			array(
				'id'       => 'header_column_bottom_left_display',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Display', 'iguru' ),
				'options'  => array(
					'normal' => esc_html__( 'Normal', 'iguru' ),
					'grow' => esc_html__( 'Grow', 'iguru' ),
				),
				'default'  => 'normal'
			),
			array(
				'id'     => 'header_column-bottom-left-end',
				'type'   => 'section',
				'indent' => false, 
			),
			array(
				'id'       => 'header_column-bottom-center-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Middle Center Column Options', 'iguru' ),
				'indent'   => true,
			),
			array(
				'id'       => 'header_column_bottom_center_horz',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Horizontal Align', 'iguru' ),
				'options'  => array(
					'left' => esc_html__( 'Left', 'iguru' ),
					'center' => esc_html__( 'Center', 'iguru' ),
					'right' => esc_html__( 'Right', 'iguru' ),
				),
				'default'  => 'left'
			),
			array(
				'id'       => 'header_column_bottom_center_vert',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Vertical Align', 'iguru' ),
				'options'  => array(
					'top' => esc_html__( 'Top', 'iguru' ),
					'middle' => esc_html__( 'Middle', 'iguru' ),
					'bottom' => esc_html__( 'Bottom', 'iguru' ),
				),
				'default'  => 'middle'
			),
			array(
				'id'       => 'header_column_bottom_center_display',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Display', 'iguru' ),
				'options'  => array(
					'normal' => esc_html__( 'Normal', 'iguru' ),
					'grow' => esc_html__( 'Grow', 'iguru' ),
				),
				'default'  => 'normal'
			),
			array(
				'id'     => 'header_column-bottom-center-end',
				'type'   => 'section',
				'indent' => false, 
			),
			array(
				'id'       => 'header_column-bottom-center-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Bottom Center Column Options', 'iguru' ),
				'indent'   => true,
			),
			array(
				'id'       => 'header_column_bottom_center_horz',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Horizontal Align', 'iguru' ),
				'options'  => array(
					'left' => esc_html__( 'Left', 'iguru' ),
					'center' => esc_html__( 'Center', 'iguru' ),
					'right' => esc_html__( 'Right', 'iguru' ),
				),
				'default'  => 'left'
			),
			array(
				'id'       => 'header_column_bottom_center_vert',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Vertical Align', 'iguru' ),
				'options'  => array(
					'top' => esc_html__( 'Top', 'iguru' ),
					'middle' => esc_html__( 'Middle', 'iguru' ),
					'bottom' => esc_html__( 'Bottom', 'iguru' ),
				),
				'default'  => 'middle'
			),
			array(
				'id'       => 'header_column_bottom_center_display',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Display', 'iguru' ),
				'options'  => array(
					'normal' => esc_html__( 'Normal', 'iguru' ),
					'grow' => esc_html__( 'Grow', 'iguru' ),
				),
				'default'  => 'normal'
			),
			array(
				'id'     => 'header_column-bottom-center-end',
				'type'   => 'section',
				'indent' => false, 
			),
			array(
				'id'       => 'header_column-bottom-right-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Bottom Right Column Options', 'iguru' ),
				'indent'   => true,
			),
			array(
				'id'       => 'header_column_bottom_right_horz',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Horizontal Align', 'iguru' ),
				'options'  => array(
					'left' => esc_html__( 'Left', 'iguru' ),
					'center' => esc_html__( 'Center', 'iguru' ),
					'right' => esc_html__( 'Right', 'iguru' ),
				),
				'default'  => 'right'
			),
			array(
				'id'       => 'header_column_bottom_right_vert',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Vertical Align', 'iguru' ),
				'options'  => array(
					'top' => esc_html__( 'Top', 'iguru' ),
					'middle' => esc_html__( 'Middle', 'iguru' ),
					'bottom' => esc_html__( 'Bottom', 'iguru' ),
				),
				'default'  => 'middle'
			),
			array(
				'id'       => 'header_column_bottom_right_display',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Display', 'iguru' ),
				'options'  => array(
					'normal' => esc_html__( 'Normal', 'iguru' ),
					'grow'   => esc_html__( 'Grow', 'iguru' ),
				),
				'default'  => 'normal'
			),
			array(
				'id'     => 'header_column-bottom-right-end',
				'type'   => 'section',
				'indent' => false, 
			),
			array(
				'id'       => 'header_row_settings-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Settings for selected Template', 'iguru' ),
				'indent'   => true,
			),
			array(
				'id'       => 'header_shadow',
				'type'     => 'switch',
				'title'    => esc_html__( 'Header Bottom Shadow', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'       => 'header_on_bg',
				'type'     => 'switch',
				'title'    => esc_html__( 'Over content', 'iguru' ),
				'subtitle' => esc_html__( 'Display Header over the page content.', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'       => 'lavalamp_active',
				'type'     => 'switch',
				'title'    => esc_html__( 'Lavalamp Marker', 'iguru' ),
				'subtitle' => esc_html__( 'Transition effect between hover states of menu items.', 'iguru' ),
				'default'  => true,
			),
			array(
				'id'       => 'sub_menu_background',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Sub Menu Background', 'iguru' ),
				'default'  => [
					'color' => '#242937',
					'alpha' => '1',
					'rgba'  => 'rgba(36,41,55,1)'
				],
				'mode'     => 'background',
			),
			array(
				'id'       => 'sub_menu_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Sub Menu Text Color', 'iguru' ),
				'default'  => '#ffffff',
				'transparent' => false,
			),
			array(
				'id'       => 'header_mobile_queris',
				'type'     => 'slider',
				'title'    => esc_html__( 'Mobile Header resolution breakpoint', 'iguru'),
				'default'  => 1200,
				'min'      => 1,
				'step'     => 1,
				'max'      => 1700,
				'display_value' => 'text',
				'required' => [ 'mobile_header', '=', '1' ],
			),
			array(
				'id'       => 'header_row_settings-end',
				'type'     => 'section',
				'indent'   => false, 
			),
		)
	]
);

Redux::setSection(
	$theme_slug,
	[
		'title'      => esc_html__( 'Header Sticky', 'iguru' ),
		'id'         => 'header_builder_sticky',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'header_sticky',
				'type'     => 'switch',
				'title'    => esc_html__( 'Sticky Header', 'iguru' ),
				'default'  => true,
			),
			array(
				'id'       => 'header_sticky-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Sticky Settings', 'iguru' ),
				'indent'   => true,
				'required' => [ 'header_sticky', '=', '1' ],
			),
			array(
				'id'       => 'header_sticky_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Sticky Header Text Color', 'iguru' ),
				'subtitle' => esc_html__( 'Set sticky header text color', 'iguru' ),
				'default'  => '#2c2c2c',
				'transparent' => false,
			),
			array(
				'id'       => 'header_sticky_background',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Sticky Header Background', 'iguru' ),
				'subtitle' => esc_html__( 'Set sticky header background color', 'iguru' ),
				'default'  => [
					'color' => '#ffffff',
					'alpha' => '1.0',
					'rgba'  => 'rgba(255,255,255,1)'
				],
				'mode'     => 'background',
			),
			array(
				'id'             => 'header_sticky_height',
				'type'           => 'dimensions',
				'units'          => false, 
				'units_extended' => false,
				'title'          => esc_html__( 'Sticky Header Height', 'iguru' ),
				'height'         => true,
				'width'          => false,
				'default'        => [ 'height' => 100 ]
			),
			array(
				'id'       => 'header_sticky_style',
				'type'     => 'select',
				'title'    => esc_html__( 'Choose your sticky style.', 'iguru' ),
				'options'  => array(
					'standard' => esc_html__( 'Show when scroll down', 'iguru' ),
					'scroll_up' => esc_html__( 'Show when scroll up', 'iguru' ),
				),
				'default'  => 'scroll_up'
			),
			array(
				'id'       => 'header_sticky_border',
				'type'     => 'switch',
				'title'    => esc_html__( 'Bottom Border On/Off', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'       => 'header_sticky_border_height',
				'type'     => 'dimensions',
				'units'    => false, 
				'units_extended' => false,
				'title'    => esc_html__( 'Bottom Border Width' , 'iguru' ),
				'height'   => true,
				'width'    => false,
				'default'  => array( 'height' => '1' ),
				'required' => [ [ 'header_sticky_border', '=', '1' ] ],
			),
			array(
				'id'       => 'header_sticky_border_color',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Bottom Border Color', 'iguru' ),
				'default'  => array(
					'color' => '#525252',
					'alpha' => '1',
					'rgba'  => 'rgba(82, 82, 82, 1)'
				),
				'mode'     => 'background',
				'required' => [ [ 'header_sticky_border', '=', '1' ] ], 
			),
			array(
				'id'       => 'header_sticky_shadow',
				'type'     => 'switch',
				'title'    => esc_html__( 'Bottom Shadow On/Off', 'iguru' ),
				'default'  => true,
			),
			array(
				'id'       => 'sticky_header',
				'type'     => 'switch',
				'title'    => esc_html__( 'Custom Sticky Header ', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'       => 'sticky_header_layout',
				'type'     => 'sorter',
				'title'    => esc_html__( 'Sticky Header Order', 'iguru' ),
				'desc'     => esc_html__( 'Organize the layout of the sticky header', 'iguru' ),
				'compiler' => 'true',
				'full_width'    => true,
				'options'  => array(
					'items'  => array(
						'html1' => esc_html__( 'HTML 1', 'iguru' ),
						'html2' => esc_html__( 'HTML 2', 'iguru' ), 
						'html3' => esc_html__( 'HTML 3', 'iguru' ),
						'html4' => esc_html__( 'HTML 4', 'iguru' ), 
						'html5' => esc_html__( 'HTML 5', 'iguru' ),
						'html6' => esc_html__( 'HTML 6', 'iguru' ),
						'item_search' => esc_html__( 'Search', 'iguru' ),
						'wpml'        => esc_html__( 'WPML', 'iguru' ),
						'delimiter1'  => esc_html__( '|', 'iguru' ),
						'delimiter2'  => esc_html__( '|', 'iguru' ),
						'delimiter3'  => esc_html__( '|', 'iguru' ),
						'delimiter4'  => esc_html__( '|', 'iguru' ),
						'delimiter5'  => esc_html__( '|', 'iguru' ),
						'delimiter6'  => esc_html__( '|', 'iguru' ),
						'spacer1' => esc_html__( 'Spacer 1', 'iguru' ),
						'spacer2' => esc_html__( 'Spacer 2', 'iguru' ),
						'spacer3' => esc_html__( 'Spacer 3', 'iguru' ),
						'spacer4' => esc_html__( 'Spacer 4', 'iguru' ),
						'spacer5' => esc_html__( 'Spacer 5', 'iguru' ),
						'spacer6' => esc_html__( 'Spacer 6', 'iguru' ),
						'side_panel' => esc_html__( 'Side Panel', 'iguru' ),
						'cart'  => esc_html__( 'Cart', 'iguru' ),
						'sign_in' => esc_html__( 'Sign In', 'iguru' ),
					),
					'Left align side' => [
						'logo' => esc_html__( 'Logo', 'iguru' ),
					],
					'Center align side' => [],
					'Right align side' => [
						'menu' => esc_html__( 'Menu', 'iguru' ),
					],
				), 
				'default'  => array(
					'items'  => array(
						'html1' => esc_html__( 'HTML 1', 'iguru' ),
						'html2' => esc_html__( 'HTML 2', 'iguru' ), 
						'html3' => esc_html__( 'HTML 3', 'iguru' ),
						'html4' => esc_html__( 'HTML 4', 'iguru' ), 
						'html5' => esc_html__( 'HTML 5', 'iguru' ),
						'html6' => esc_html__( 'HTML 6', 'iguru' ),
						'item_search' => esc_html__( 'Search', 'iguru' ),
						'wpml'        => esc_html__( 'WPML', 'iguru' ),
						'delimiter1'  => esc_html__( '|', 'iguru' ),
						'delimiter2'  => esc_html__( '|', 'iguru' ),
						'delimiter3'  => esc_html__( '|', 'iguru' ),
						'delimiter4'  => esc_html__( '|', 'iguru' ),
						'delimiter5'  => esc_html__( '|', 'iguru' ),
						'delimiter6'  => esc_html__( '|', 'iguru' ),
						'spacer1' => esc_html__( 'Spacer 1', 'iguru' ),
						'spacer2' => esc_html__( 'Spacer 2', 'iguru' ),
						'spacer3' => esc_html__( 'Spacer 3', 'iguru' ),
						'spacer4' => esc_html__( 'Spacer 4', 'iguru' ),
						'spacer5' => esc_html__( 'Spacer 5', 'iguru' ),
						'spacer6' => esc_html__( 'Spacer 6', 'iguru' ),
						'side_panel' => esc_html__( 'Side Panel', 'iguru' ),
						'cart' => esc_html__( 'Cart', 'iguru' ),
						'sign_in' => esc_html__( 'Sign In', 'iguru' ),
					),
					'Left align side' => [
						'logo' => esc_html__( 'Logo', 'iguru' ),
					],
					'Center align side' => [],
					'Right align side' => [
						'menu' => esc_html__( 'Menu', 'iguru' ),
					],
				),
				'required' => [ 'sticky_header', '=', '1' ],
			),
			array(
				'id'       => 'header_custom_sticky_full_width',
				'type'     => 'switch',
				'title'    => esc_html__( 'Full Width Sticky Header', 'iguru' ),
				'default'  => false,
				'required' => [ 'sticky_header', '=', '1' ],
			),
			array(
				'id'      => 'sticky_header_bar_html1_editor',
				'type'    => 'ace_editor',
				'mode'    => 'html',
				'title'   => esc_html__( 'HTML Element 1 Editor', 'iguru' ),
				'default' => '',
				'required' => [ 'sticky_header', '=', '1' ],
			),
			array(
				'id'      => 'sticky_header_bar_html2_editor',
				'type'    => 'ace_editor',
				'mode'    => 'html',
				'title'   => esc_html__( 'HTML Element 2 Editor', 'iguru' ),
				'default' => '',
				'required' => [ 'sticky_header', '=', '1' ],
			), 
			array(
				'id'      => 'sticky_header_bar_html3_editor',
				'type'    => 'ace_editor',
				'mode'    => 'html',
				'title'   => esc_html__( 'HTML Element 3 Editor', 'iguru' ),
				'default' => '',
				'required' => [ 'sticky_header', '=', '1' ],
			),
			array(
				'id'      => 'sticky_header_bar_html4_editor',
				'type'    => 'ace_editor',
				'mode'    => 'html',
				'title'   => esc_html__( 'HTML Element 4 Editor', 'iguru' ),
				'default' => '',
				'required' => [ 'sticky_header', '=', '1' ],
			), 
			array(
				'id'      => 'sticky_header_bar_html5_editor',
				'type'    => 'ace_editor',
				'mode'    => 'html',
				'title'   => esc_html__( 'HTML Element 5 Editor', 'iguru' ),
				'default' => '',
				'required' => [ 'sticky_header', '=', '1' ],
			),
			array(
				'id'      => 'sticky_header_bar_html6_editor',
				'type'    => 'ace_editor',
				'mode'    => 'html',
				'title'   => esc_html__( 'HTML Element 6 Editor', 'iguru' ),
				'default' => '',
				'required' => [ 'sticky_header', '=', '1' ],
			),
			array(
				'id'             => 'sticky_header_spacer1',
				'type'           => 'dimensions',
				'units'          => false, 
				'units_extended' => false,
				'title'          => esc_html__( 'Spacer 1 Width', 'iguru' ),
				'height'         => false,
				'width'          => true,
				'default'        => [ 'width' => 25 ],
				'required'       => [ 'sticky_header', '=', '1' ],
			),
			array(
				'id'             => 'sticky_header_spacer2',
				'type'           => 'dimensions',
				'units'          => false, 
				'units_extended' => false,
				'title'          => esc_html__( 'Spacer 2 Width', 'iguru' ),
				'height'         => false,
				'width'          => true,
				'default'        => [ 'width' => 25 ],
				'required'       => [ 'sticky_header', '=', '1' ],
			),
			array(
				'id'             => 'sticky_header_spacer3',
				'type'           => 'dimensions',
				'units'          => false, 
				'units_extended' => false,
				'title'          => esc_html__( 'Spacer 3 Width', 'iguru' ),
				'height'         => false,
				'width'          => true,
				'default'        => [ 'width' => 25 ],
				'required'       => [ 'sticky_header', '=', '1' ],
			),
			array(
				'id'             => 'sticky_header_spacer4',
				'type'           => 'dimensions',
				'units'          => false, 
				'units_extended' => false,
				'title'          => esc_html__( 'Spacer 4 Width', 'iguru' ),
				'height'         => false,
				'width'          => true,
				'default'        => [ 'width' => 25 ],
				'required'       => [ 'sticky_header', '=', '1' ],
			),
			array(
				'id'             => 'sticky_header_spacer5',
				'type'           => 'dimensions',
				'units'          => false, 
				'units_extended' => false,
				'title'          => esc_html__( 'Spacer 5 Width', 'iguru' ),
				'height'         => false,
				'width'          => true,
				'default'        => [ 'width' => 25 ],
				'required'       => [ 'sticky_header', '=', '1' ],
			),
			array(
				'id'             => 'sticky_header_spacer6',
				'type'           => 'dimensions',
				'units'          => false, 
				'units_extended' => false,
				'title'          => esc_html__( 'Spacer 6 Width', 'iguru' ),
				'height'         => false,
				'width'          => true,
				'default'        => [ 'width' => 25 ],
				'required'       => [ 'sticky_header', '=', '1' ],
			), 
			array(
				'id'     => 'header_sticky-end',
				'type'   => 'section',
				'indent' => false, 
				'required' => [ 'header_sticky', '=', '1' ],
			),
		)
	]
);

Redux::setSection(
	$theme_slug,
	[
		'title'      => esc_html__( 'Header Mobile', 'iguru' ),
		'id'         => 'header_builder_mobile',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'mobile_header',
				'type'     => 'switch',
				'title'    => esc_html__( 'Custom Mobile Header ', 'iguru' ),
				'default'  => true,
			),
			array(
				'id'       => 'mobile_background',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Mobile Header Background', 'iguru' ),
				'default'  => array(
					'color' => '#2d2d2d',
					'alpha' => '1',
					'rgba'  => 'rgba(45, 45, 45, 1)'
				),
				'mode'     => 'background',
				'required' => [ 'mobile_header', '=', '1' ],
			),
			array(
				'id'       => 'mobile_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Mobile Header Text Color', 'iguru' ),
				'default'  => '#ffffff',
				'transparent' => false,
				'required' => [ 'mobile_header', '=', '1' ],
			),
			array(
				'id'       => 'mobile_sub_menu_background',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Mobile Sub Menu Background', 'iguru' ),
				'default'  => array(
					'color' => '#ffffff',
					'alpha' => '1',
					'rgba'  => 'rgba(255,255,255,1)'
				),
				'mode'     => 'background',
				'required' => [ 'mobile_header', '=', '1' ],
			),
			array(
				'id'       => 'mobile_sub_menu_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Mobile Sub Menu Text Color', 'iguru' ),
				'default'  => '#5f5f5f',
				'transparent' => false,
				'required' => [ 'mobile_header', '=', '1' ],
			),
			array(
				'id'       => 'header_mobile_height',
				'type'     => 'dimensions',
				'units'    => false, 
				'units_extended' => false,
				'title'    => esc_html__( 'Mobile Height' , 'iguru' ),
				'height'   => true,
				'width'    => false,
				'default'  => array( 'height' => '100' ),
				'required' => array( array( 'mobile_header', '=', '1' ) ),
			),
			array(
				'id'       => 'mobile_over_content',
				'type'     => 'switch',
				'title'    => esc_html__( 'Mobile Over Content', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'       => 'mobile_header_layout',
				'type'     => 'sorter',
				'title'    => esc_html__( 'Mobile Header Order', 'iguru' ),
				'desc'     => esc_html__( 'Organize the layout of the mobile header', 'iguru' ),
				'compiler' => 'true',
				'full_width' => true,
				'options'  => array(
					'items'  => array(
						'html1' => esc_html__( 'HTML 1', 'iguru' ),
						'html2' => esc_html__( 'HTML 2', 'iguru' ), 
						'html3' => esc_html__( 'HTML 3', 'iguru' ),
						'html4' => esc_html__( 'HTML 4', 'iguru' ), 
						'html5' => esc_html__( 'HTML 5', 'iguru' ),
						'html6' => esc_html__( 'HTML 6', 'iguru' ),
						'wpml'  => esc_html__( 'WPML', 'iguru' ),
						'spacer1' => esc_html__( 'Spacer 1', 'iguru' ),
						'spacer2' => esc_html__( 'Spacer 2', 'iguru' ),
						'spacer3' => esc_html__( 'Spacer 3', 'iguru' ),
						'spacer4' => esc_html__( 'Spacer 4', 'iguru' ),
						'spacer5' => esc_html__( 'Spacer 5', 'iguru' ),
						'spacer6' => esc_html__( 'Spacer 6', 'iguru' ),
						'side_panel' => esc_html__( 'Side Panel', 'iguru' ),
						'cart'  =>  esc_html__( 'Cart', 'iguru' ),
						'item_search' => esc_html__( 'Search', 'iguru' ),
					),
					'Left align side' => array(
						'menu' => esc_html__( 'Menu', 'iguru' ),
					),
					'Center align side' => array(
						'logo' => esc_html__( 'Logo', 'iguru' ),
					),
					'Right align side' => array(
						'sign_in' => esc_html__( 'Sign In', 'iguru' ),
					),
				),
				'default' => [
					'items' => [
						'html1' => esc_html__( 'HTML 1', 'iguru' ),
						'html2' => esc_html__( 'HTML 2', 'iguru' ), 
						'html3' => esc_html__( 'HTML 3', 'iguru' ),
						'html4' => esc_html__( 'HTML 4', 'iguru' ), 
						'html5' => esc_html__( 'HTML 5', 'iguru' ),
						'html6' => esc_html__( 'HTML 6', 'iguru' ),
						'wpml'  => esc_html__( 'WPML', 'iguru' ),
						'spacer1' => esc_html__( 'Spacer 1', 'iguru' ),
						'spacer2' => esc_html__( 'Spacer 2', 'iguru' ),
						'spacer3' => esc_html__( 'Spacer 3', 'iguru' ),
						'spacer4' => esc_html__( 'Spacer 4', 'iguru' ),
						'spacer5' => esc_html__( 'Spacer 5', 'iguru' ),
						'spacer6' => esc_html__( 'Spacer 6', 'iguru' ),
						'side_panel' => esc_html__( 'Side Panel', 'iguru' ),
						'cart'  =>  esc_html__( 'Cart', 'iguru' ),
						'item_search' => esc_html__( 'Search', 'iguru' ),
					],
					'Left align side' => [
						'menu' => esc_html__( 'Menu', 'iguru' ),
					],
					'Center align side' => [
						'logo' => esc_html__( 'Logo', 'iguru' ),
					],
					'Right align side' => [
						'sign_in' =>  esc_html__( 'Sign In', 'iguru' ),
					],
				],
				'required' => array( array( 'mobile_header', '=', '1' ) ),
			),
			array(
				'id'      => 'mobile_header_bar_html1_editor',
				'type'    => 'ace_editor',
				'mode'    => 'html',
				'title'   => esc_html__( 'HTML Element 1 Editor', 'iguru' ),
				'default' => '',
				'required' => [ [ 'mobile_header', '=', '1' ] ],
			),
			array(
				'id'      => 'mobile_header_bar_html2_editor',
				'type'    => 'ace_editor',
				'mode'    => 'html',
				'title'   => esc_html__( 'HTML Element 2 Editor', 'iguru' ),
				'default' => '',
				'required' => [ [ 'mobile_header', '=', '1' ] ],
			),
			array(
				'id'      => 'mobile_header_bar_html3_editor',
				'type'    => 'ace_editor',
				'mode'    => 'html',
				'title'   => esc_html__( 'HTML Element 3 Editor', 'iguru' ),
				'default' => '',
				'required' => [ [ 'mobile_header', '=', '1' ] ],
			),
			array(
				'id'      => 'mobile_header_bar_html4_editor',
				'type'    => 'ace_editor',
				'mode'    => 'html',
				'title'   => esc_html__( 'HTML Element 4 Editor', 'iguru' ),
				'default' => '',
				'required' => [ [ 'mobile_header', '=', '1' ] ],
			), 
			array(
				'id'      => 'mobile_header_bar_html5_editor',
				'type'    => 'ace_editor',
				'mode'    => 'html',
				'title'   => esc_html__( 'HTML Element 5 Editor', 'iguru' ),
				'default' => '',
				'required' => [ [ 'mobile_header', '=', '1' ] ],
			),
			array(
				'id'      => 'mobile_header_bar_html6_editor',
				'type'    => 'ace_editor',
				'mode'    => 'html',
				'title'   => esc_html__( 'HTML Element 6 Editor', 'iguru' ),
				'default' => '',
				'required' => [ [ 'mobile_header', '=', '1' ] ],
			),
			array(
				'id'       => 'mobile_header_spacer1',
				'type'     => 'dimensions',
				'units'    => false, 
				'units_extended' => false,
				'title'    => esc_html__( 'Spacer 1 Width', 'iguru' ),
				'height'   => false,
				'width'    => true,
				'default'  => array( 'width' => 25 ),
				'required' => [ [ 'mobile_header', '=', '1' ] ],
			),
			array(
				'id'       => 'mobile_header_spacer2',
				'type'     => 'dimensions',
				'units'    => false, 
				'units_extended' => false,
				'title'    => esc_html__( 'Spacer 2 Width', 'iguru' ),
				'height'   => false,
				'width'    => true,
				'default'  => array( 'width' => 25 ),
				'required' => [ [ 'mobile_header', '=', '1' ] ],
			),
			array(
				'id'             => 'mobile_header_spacer3',
				'type'           => 'dimensions',
				'units'          => false, 
				'units_extended' => false,
				'title'          => esc_html__( 'Spacer 3 Width', 'iguru' ),
				'height'         => false,
				'width'          => true,
				'default'        => array( 'width' => 25 ),
				'required' => [ [ 'mobile_header', '=', '1' ] ],
			),
			array(
				'id'             => 'mobile_header_spacer4',
				'type'           => 'dimensions',
				'units'          => false, 
				'units_extended' => false,
				'title'          => esc_html__( 'Spacer 4 Width', 'iguru' ),
				'height'         => false,
				'width'          => true,
				'default'        => array( 'width' => 25 ),
				'required' => [ [ 'mobile_header', '=', '1' ] ],
			),
			array(
				'id'             => 'mobile_header_spacer5',
				'type'           => 'dimensions',
				'units'          => false, 
				'units_extended' => false,
				'title'          => esc_html__( 'Spacer 5 Width', 'iguru' ),
				'height'         => false,
				'width'          => true,
				'default'        => array( 'width' => 25 ),
				'required' => [ [ 'mobile_header', '=', '1' ] ],
			),
			array(
				'id'             => 'mobile_header_spacer6',
				'type'           => 'dimensions',
				'units'          => false, 
				'units_extended' => false,
				'title'          => esc_html__( 'Spacer 6 Width', 'iguru' ),
				'height'         => false,
				'width'          => true,
				'default'        => array( 'width' => 25 ),
				'required' => [ [ 'mobile_header', '=', '1' ] ],
			),
		)
	]
);

Redux::setSection(
	$theme_slug,
	[
		'title'      => esc_html__( 'Page Title', 'iguru' ),
		'id'         => 'page_title',
	]
);

Redux::setSection(
	$theme_slug,
	[
		'title'      => esc_html__( 'Settings', 'iguru' ),
		'id'         => 'page_title_settings',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'page_title_switch',
				'type'     => 'switch',
				'title'    => esc_html__( 'Page Title Switch', 'iguru' ),
				'default'  => true,
			),
			array(
				'id'       => 'page_title-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Page Title Settings', 'iguru' ),
				'indent'   => true,
				'required' => [ 'page_title_switch', '=', '1' ],
			),
			array(
				'id'       => 'page_title_bg_switch',
				'type'     => 'switch',
				'title'    => esc_html__( 'Use Color/Image Background?', 'iguru' ),
				'default'  => true,
			),
			array(
				'id'       => 'page_title_bg_image',
				'type'     => 'background',
				'title'    => esc_html__( 'Background', 'iguru' ),
				'preview'  => false,
				'preview_media' => true,
				'background-color' => true,
				'transparent' => false,
				'default'  => [
					'background-repeat'     => 'no-repeat',
					'background-size'       => 'cover',
					'background-attachment' => 'scroll',
					'background-position'   => 'center bottom',
					'background-color'      => '#103f40',
				],
				'required' => [ 'page_title_bg_switch', '=', true ],
			),
			array(
				'id'       => 'page_title_height',
				'type'     => 'dimensions',
				'units'    => false, 
				'units_extended' => false,
				'title'    => esc_html__( 'Height', 'iguru' ),
				'height'   => true,
				'width'    => false,
				'default'  => [ 'height' => 430 ],
				'required' => [ 'page_title_bg_switch', '=', true ],
			),
			array(
				'id'      => 'page_title_padding',
				'type'    => 'spacing',
				'title'   => esc_html__( 'Paddings Top/Bottom', 'iguru' ),
				'mode'    => 'padding',
				'all'     => false,
				'bottom'  => true,
				'top'     => true,
				'left'    => false,
				'right'   => false,
				'default' => [
					'padding-top'    => '82',
					'padding-bottom' => '72',
				],
			),
			array(
				'id'      => 'page_title_margin',
				'type'    => 'spacing',
				'title'   => esc_html__( 'Margin Bottom', 'iguru' ),
				'mode'    => 'margin',
				'all'     => false,
				'bottom'  => true,
				'top'     => false,
				'left'    => false,
				'right'   => false,
				'default' => [ 'margin-bottom' => '40' ],
			),
			array(
				'id'      => 'page_title_align',
				'type'    => 'button_set',
				'title'   => esc_html__( 'Title Alignment', 'iguru' ),
				'options' => [
					'left'   => 'Left',
					'center' => 'Center',
					'right'  => 'Right'
				], 
				'default' => 'center',
			),
			array(
				'id'      => 'page_title_breadcrumbs_switch',
				'type'    => 'switch',
				'title'   => esc_html__( 'Breadcrumbs Switch', 'iguru' ),
				'default' => true,
			),
			array(
				'id'      => 'page_title_breadcrumbs_align',
				'type'    => 'button_set',
				'title'   => esc_html__( 'Breadcrumbs Alignment', 'iguru' ),
				'options' => [
					'left'   => 'Left',
					'center' => 'Center',
					'right'  => 'Right'
				], 
				'default' => 'center',
				'required' => [ 'page_title_breadcrumbs_switch', '=', true ],
			),
			array(
				'id'      => 'page_title_tag',
				'type'    => 'select',
				'title'   => esc_html__( 'Title HTML tag', 'iguru' ),
				'options' => [
					'def' => 'Theme Default',
					'div' => '‹div›',
					'h1' => '‹h1›',
					'h2' => '‹h2›',
					'h3' => '‹h3›',
					'h4' => '‹h4›',
					'h5' => '‹h5›',
					'h6' => '‹h6›',
				],
				'default'  => 'def'
			),
			array(
				'id'      => 'page_title_parallax',
				'type'    => 'switch',
				'title'   => esc_html__( 'Parallax Switch', 'iguru' ),
				'default' => false,
			),
			array(
				'id'       => 'page_title_parallax_speed',
				'type'     => 'spinner',
				'title'    => esc_html__( 'Parallax Speed', 'iguru' ),
				'default'  => '0.3',
				'min'      => '-5',
				'step'     => '0.1',
				'max'      => '5',
				'required' => [ 'page_title_parallax', '=', '1' ],
			),
			array(
				'id'     => 'page_title-end',
				'type'   => 'section',
				'indent' => false, 
				'required' => [ 'page_title_switch', '=', '1' ],
			),
		)
	]
);

Redux::setSection(
	$theme_slug,
	[
		'title'      => esc_html__( 'Typography', 'iguru' ),
		'id'         => 'page_title_typography',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'          => 'page_title_font',
				'type'        => 'custom_typography',
				'title'       => esc_html__( 'Page Title Font', 'iguru' ),
				'font-size'   => true,
				'google'      => false,
				'font-weight' => false,
				'font-family' => false,
				'font-style'  => false,
				'color'       => true,
				'line-height' => true,
				'font-backup' => false,
				'text-align'  => false,
				'all_styles'  => false,
				'default'     => [
					'font-size'   => '48px',
					'line-height' => '72px',
					'color'       => '#ffffff',
				],
			),
			array(
				'id'          => 'page_title_breadcrumbs_font',
				'type'        => 'custom_typography',
				'title'       => esc_html__( 'Page Title Breadcrumbs Font', 'iguru' ),
				'font-size'   => true,
				'google'      => false,
				'font-weight' => false,
				'font-family' => false,
				'font-style'  => false,
				'color'       => true,
				'line-height' => true,
				'font-backup' => false,
				'text-align'  => false,
				'all_styles'  => false,
				'default'     => [
					'font-size'   => '16px',
					'line-height' => '24px',
					'color'       => '#ffffff',
				],
			),
		)
	]
);

Redux::setSection(
	$theme_slug,
	[ 
		'title'      => esc_html__( 'Responsive', 'iguru' ),
		'id'         => 'page_title_responsive',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'page_title_resp_switch',
				'type'     => 'switch',
				'title'    => esc_html__( 'Responsive Layout Switch', 'iguru' ),
				'default'  => true,
			),
			array(
				'id'       => 'page_title_resp_resolution',
				'type'     => 'slider',
				'title'    => esc_html__('Screen breakpoint', 'iguru'),
				'default'  => 768,
				'min'      => 1,
				'step'     => 1,
				'max'      => 1700,
				'display_value' => 'text',
				'required' => [ 'page_title_resp_switch', '=', '1' ],
			),
			array(
				'id'       => 'page_title_resp_height',
				'type'     => 'dimensions',
				'units'    => false, 
				'units_extended' => false,
				'title'    => esc_html__( 'Height', 'iguru' ),
				'height'   => true,
				'width'    => false,
				'default'  => [ 'height' => 370 ],
				'required' => [ 'page_title_resp_switch', '=', '1' ],
			),
			array(
				'id'       => 'page_title_resp_padding',
				'type'     => 'spacing',
				'title'    => esc_html__( 'Paddings Top/Bottom', 'iguru' ),
				'mode'     => 'padding',
				'all'      => false,
				'bottom'   => true,
				'top'      => true,
				'left'     => false,
				'right'    => false,
				'default'  => [
					'padding-top' => '15',
					'padding-bottom' => '40',
				],
				'required' => [ 'page_title_resp_switch', '=', '1' ],
			),
			array(
				'id'          => 'page_title_resp_font',
				'type'        => 'custom_typography',
				'title'       => esc_html__( 'Page Title Font', 'iguru' ),
				'font-size'   => true,
				'google'      => false,
				'font-weight' => false,
				'font-family' => false,
				'font-style'  => false,
				'color'       => true,
				'line-height' => true,
				'font-backup' => false,
				'text-align'  => false,
				'all_styles'  => false,
				'default'     => [
					'font-size'   => '42px',
					'line-height' => '60px',
					'color'       => '#ffffff',
				],
				'required' => [ 'page_title_resp_switch', '=', '1' ],
			),
			array(
				'id'       => 'page_title_resp_breadcrumbs_switch',
				'type'     => 'switch',
				'title'    => esc_html__( 'Breadcrumbs On/Off', 'iguru' ),
				'default'  => true,
				'required' => [ 'page_title_resp_switch', '=', '1' ],
			),
			array(
				'id'          => 'page_title_resp_breadcrumbs_font',
				'type'        => 'custom_typography',
				'title'       => esc_html__( 'Page Title Breadcrumbs Font', 'iguru' ),
				'font-size'   => true,
				'google'      => false,
				'font-weight' => false,
				'font-family' => false,
				'font-style'  => false,
				'color'       => true,
				'line-height' => true,
				'font-backup' => false,
				'text-align'  => false,
				'all_styles'  => false,
				'default'     => [
					'font-size'   => '14px',
					'line-height' => '24px',
					'color'       => '#ffffff',
				],
				'required' => [ 'page_title_resp_breadcrumbs_switch', '=', '1' ],
			),
		)
	]
);

// -> START Footer Options
Redux::setSection(
	$theme_slug,
	[
		'title' => esc_html__( 'Footer', 'iguru' ),
		'id'    => 'footer',
	]
); 

Redux::setSection(
	$theme_slug,
	[
		'title'      => esc_html__( 'Settings', 'iguru' ),
		'id'         => 'footer_settings',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'footer_switch',
				'type'     => 'switch',
				'title'    => esc_html__( 'Footer On/Off', 'iguru' ),
				'default'  => true,
			),
			array(
				'id'       => 'footer-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Footer Settings', 'iguru' ),
				'indent'   => true,
				'required' => [ 'footer_switch', '=', '1' ],
			),
			array(
				'id'        => 'footer_add_wave',
				'type'      => 'switch',
				'title'     => esc_html__( 'Add Wave', 'iguru' ),
				'default'   => false,
				 'required' => [ 'footer_switch', '=', '1' ],
			), 
			array(
				'id'        => 'footer_wave_height',
				'type'      => 'dimensions',
				'units'     => false, 
				'units_extended' => false,
				'title'     => esc_html__( 'Set Wave Height' , 'iguru' ),
				'height'    => true,
				'width'     => false,
				'default'   => array( 'height' => 158 ),
				'required'  => [ 'footer_add_wave', '=', '1' ],
			), 
			array(
				'id'       => 'footer_content_type',
				'type'     => 'select',
				'title'    => esc_html__( 'Content Type', 'iguru' ),
				'options'  => array(
					'widgets' => 'Get Widgets',
					'pages' => 'Get Pages'
				),
				'default'  => 'widgets'
			),
			array(
				'id'    => 'footer_page_select',
				'type'  => 'select',
				'title' => esc_html__( 'Page Select', 'iguru' ),
				'data'  => 'posts',
				'args'  => array(
					'post_type'      => 'footer',
					'posts_per_page' => -1,
					'orderby'        => 'title',
					'order'          => 'ASC',
				),
				'required' => [ 'footer_content_type', '=', 'pages'],
			),
			array(
				'id'    => 'widget_columns',
				'type'  => 'button_set',
				'title' => esc_html__( 'Columns', 'iguru' ),
				'options' => array(
					'1' => '1', 
					'2' => '2',
					'3' => '3',
					'4' => '4',
				 ), 
				'default' => '4',
				'required' => [ 'footer_content_type', '=', 'widgets'],
			),
			array(
				'id'      => 'widget_columns_2',
				'type'    => 'image_select',
				'title'   => esc_html__( 'Columns Layout', 'iguru' ),
				'options' => array(
					'6-6' => [
						'alt' => '50-50',
						'img' => get_template_directory_uri() . '/core/admin/img/options/50-50.png'
					],
					'3-9' => [
						'alt' => '25-75',
						'img' => get_template_directory_uri() . '/core/admin/img/options/25-75.png'
					],
					'9-3' => [
						'alt' => '75-25',
						'img' => get_template_directory_uri() . '/core/admin/img/options/75-25.png'
					],
					'4-8' => [
						'alt' => '33-66',
						'img' => get_template_directory_uri() . '/core/admin/img/options/33-66.png'
					],
					'8-4' => [
						'alt' => '66-33',
						'img' => get_template_directory_uri() . '/core/admin/img/options/66-33.png'
					]
				),
				'default'  => '6-6',
				'required' => [ 'widget_columns', '=', '2' ],
			),
			array(
				'id'       => 'widget_columns_3',
				'type'     => 'image_select',
				'title'    => esc_html__( 'Columns Layout', 'iguru' ),
				'options'  => array(
					'4-4-4' => array(
						'alt' => '33-33-33',
						'img' => get_template_directory_uri() . '/core/admin/img/options/33-33-33.png'
					),
					'3-3-6' => array(
						'alt' => '25-25-50',
						'img' => get_template_directory_uri() . '/core/admin/img/options/25-25-50.png'
					),
					'3-6-3' => array(
						'alt' => '25-50-25',
						'img' => get_template_directory_uri() . '/core/admin/img/options/25-50-25.png'
					),
					'6-3-3' => array(
						'alt' => '50-25-25',
						'img' => get_template_directory_uri() . '/core/admin/img/options/50-25-25.png'
					),
				),
				'default'  => '4-4-4',
				'required' => [ 'widget_columns', '=', '3' ],
			),
			array(
				'id'       => 'footer_spacing',
				'type'     => 'spacing',
				'output'   => array( '.wgl-footer' ),
				'mode'     => 'padding',
				'units'    => 'px',
				'all'      => false,
				'title'    => esc_html__( 'Paddings', 'iguru' ),
				'default'  => array(
					'padding-top'    => '100px',
					'padding-right'  => '0px',
					'padding-bottom' => '10px',
					'padding-left'   => '0px'
				)
			),
			array(
				'id'       => 'footer_full_width',
				'type'     => 'switch',
				'title'    => esc_html__( 'Full Width On/Off', 'iguru' ),
				'default'  => false,
				'required' => [ 'footer_content_type', '=', 'widgets' ],
			),
			array(
				'id'     => 'footer-end',
				'type'   => 'section',
				'indent' => false, 
				'required' => [ 'footer_switch', '=', '1' ],
			),
			array(
				'id'       => 'footer-start-styles',
				'type'     => 'section',
				'title'    => esc_html__( 'Footer Styling', 'iguru' ),
				'indent'   => true,
			),
			array(
				'id'       => 'footer_bg_image',
				'type'     => 'background',
				'background-color' => false,
				'preview_media' => true,
				'preview'  => false,
				'title'    => esc_html__( 'Background Image', 'iguru' ),
				'default'  => array(
					'background-repeat'     => 'repeat',
					'background-size'       => 'cover',
					'background-attachment' => 'scroll',
					'background-position'   => 'center center',
				)
			),
			array(
				'id'       => 'footer_align',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Content Align', 'iguru'),
				'options'  => [
					'left'   => 'Left', 
					'center' => 'Center',
					'right'  => 'Right'
				], 
				'default'  => 'left',
				'required' => [ 'footer_content_type', '=', 'widgets' ],
			),
			array(
				'id'       => 'footer_bg_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Background Color', 'iguru' ),
				'default'  => '#1b2133',
				'transparent' => false
			),
			array(
				'id'       => 'footer_heading_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Headings color', 'iguru' ),
				'default'  => '#ffffff',
				'transparent' => false
			),
			array(
				'id'       => 'footer_text_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Content color', 'iguru' ),
				'default'  => '#cccccc',
				'transparent' => false
			),
			array(
				'id'     => 'footer-end-styles',
				'type'   => 'section',
				'indent' => false, 
			),
		)
	]
);

// -> START Copyright Options
Redux::setSection(
	$theme_slug,
	[
		'title'      => esc_html__( 'Copyright', 'iguru' ),
		'id'         => 'copyright',
	]
);

Redux::setSection(
	$theme_slug,
	[
		'title'      => esc_html__( 'Settings', 'iguru' ),
		'id'         => 'copyright-settings',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'copyright_switch',
				'type'    => 'switch',
				'title'   => esc_html__( 'Copyright On/Off', 'iguru' ),
				'default' => true,
			),
			array(
				'id'      => 'copyright-start',
				'type'    => 'section',
				'title'   => esc_html__( 'Copyright Settings', 'iguru' ),
				'indent'  => true,
			),
			array(
				'id'      => 'copyright_editor',
				'type'    => 'editor',
				'title'   => esc_html__( 'Editor', 'iguru' ),
				'default' => '<p>Copyright © 2019 iGuru by <a href="https://themeforest.net/user/webgeniuslab" target="_blank" rel="nofollow">WebGeniusLab</a>. All Rights Reserved</p>',
				'args'    => [
					'wpautop'       => false,
					'media_buttons' => false,
					'textarea_rows' => 2,
					'teeny'         => false,
					'quicktags'     => true,
				],
				'required' => [ 'copyright_switch', '=', '1' ],
			),
			array(
				'id'       => 'copyright_text_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Text Color', 'iguru' ),
				'default'  => '#7b7b7b',
				'transparent' => false,
				'required' => [ 'copyright_switch', '=', '1' ],
			),
			array(
				'id'       => 'copyright_bg_color',
				'type'     => 'color',
				'title'    => esc_html__( 'Background Color', 'iguru' ),
				'default'  => '#090a0e',
				'transparent' => false,
				'required' => [ 'copyright_switch', '=', '1' ],
			),
			array(
				'id'       => 'copyright_spacing',
				'type'     => 'spacing',
				'mode'     => 'padding',
				'left'     => false,
				'right'    => false,
				'all'      => false,
				'title'    => esc_html__( 'Paddings', 'iguru' ),
				'default'  => [
					'padding-top'    => '12',
					'padding-bottom' => '12',
				],
				'required' => [ 'copyright_switch', '=', '1' ],
			),
			array(
				'id'     => 'copyright-end',
				'type'   => 'section',
				'indent' => false, 
				'required' => [ 'footer_switch', '=', '1' ],
			),
		)
	]
);

// -> START LearnPress Options
if ( class_exists( 'LearnPress' ) )  {
	Redux::setSection(
		$theme_slug,
		[
			'title'   => esc_html__( 'LearnPress', 'iguru' ),
			'id'      => 'learnpress-option',
			'icon'    => 'el el-th-large',
		]
	);

	Redux::setSection(
		$theme_slug,
		[
			'title'      => esc_html__( 'Single', 'iguru' ),
			'id'         => 'learnpress-single-option',
			'subsection' => true,
			'fields'     => array(
				array(
					'id'       => 'learnpress_single_post_title-start',
					'type'     => 'section',
					'title'    => esc_html__( 'Post Title Settings', 'iguru' ),
					'indent'   => true,
				),
				array(
					'id'      => 'learnpress_single_title_switch',
					'type'    => 'switch',
					'title'   => esc_html__( 'Use Custom Post Title Text?', 'iguru' ),
					'default' => true,
				),
				array(
					'id'       => 'learnpress_single_page_title_text',
					'type'     => 'text',
					'title'    => esc_html__( 'Post Title Text', 'iguru' ),
					'default'  => esc_html__( 'Courses', 'iguru' ),
					'required' => [ 'learnpress_single_title_switch', '=', true ],
				),
				array(
					'id'      => 'learnpress_single_title_align',
					'type'    => 'button_set',
					'title'   => esc_html__( 'Title Alignment', 'iguru' ),
					'options' => array(
						'left'   => esc_html__( 'Left', 'iguru' ),
						'center' => esc_html__( 'Center', 'iguru' ),
						'right'  => esc_html__( 'Right', 'iguru' ),
					),
					'default' => 'center',
				),
				array(
					'id'      => 'learnpress_single_breadcrumbs_align',
					'type'    => 'button_set',
					'title'   => esc_html__( 'Title Breadcrumbs Alignment', 'iguru' ),
					'options' => [
						'left'   => esc_html__( 'Left', 'iguru' ),
						'center' => esc_html__( 'Center', 'iguru' ),
						'right'  => esc_html__( 'Right', 'iguru' ),
					],
					'default' => 'center',
				),
				array(
					'id'      => 'learnpress_single_title_bg_switch',
					'type'    => 'switch',
					'title'   => esc_html__( 'Use Color/Image Background?', 'iguru' ),
					'default' => true,
				),
				array(
					'id'      => 'learnpress_single_page_title_bg_image',
					'type'    => 'background',
					'title'   => esc_html__( 'Background', 'iguru' ),
					'preview' => false,
					'preview_media' => true,
					'background-color' => true,
					'transparent' => false,
					'default' => [
						'background-repeat'     => 'repeat',
						'background-size'       => 'cover',
						'background-attachment' => 'scroll',
						'background-position'   => 'center center',
						'background-color'      => '#103f40',
					],
					'required' => [ 'learnpress_single_title_bg_switch', '=', true ],
				),
				array(
					'id'      => 'learnpress_single_page_title_padding',
					'type'    => 'spacing',
					'title'   => esc_html__( 'Paddings Top/Bottom', 'iguru' ),
					'mode'    => 'padding',
					'all'     => false,
					'bottom'  => true,
					'top'     => true,
					'left'    => false,
					'right'   => false,
					'default' => [
						'padding-top'    => '82',
						'padding-bottom' => '72',
					],
				),
				array(
					'id'      => 'learnpress_single_page_title_margin',
					'type'    => 'spacing',
					'title'   => esc_html__( 'Margin Bottom', 'iguru' ),
					'mode'    => 'margin',
					'all'     => false,
					'bottom'  => true,
					'top'     => false,
					'left'    => false,
					'right'   => false,
					'default' => [ 'margin-bottom' => '40' ],
				),
				array(
					'id'      => 'learnpress_single_post_title-end',
					'type'    => 'section',
					'indent'  => false,
				),
				array(
					'id'      => 'learnpress_single_sidebar-start',
					'type'    => 'section',
					'title'   => esc_html__( 'Sidebar Settings', 'iguru' ),
					'indent'  => true,
				),
				array(
					'id'      => 'learnpress_single_sidebar_layout',
					'type'    => 'image_select',
					'title'   => esc_html__( 'Sidebar Layout', 'iguru' ),
					'options' => [
						'none' => [
							'alt' => 'None',
							'img' => get_template_directory_uri() . '/core/admin/img/options/1col.png'
						],
						'left' => [
							'alt' => 'Left',
							'img' => get_template_directory_uri() . '/core/admin/img/options/2cl.png'
						],
						'right' => [
							'alt' => 'Right',
							'img' => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
						],
					],
					'default' => 'none',
				),
				array(
					'id'       => 'learnpress_single_sidebar_def_width',
					'type'     => 'button_set',
					'title'    => esc_html__( 'Sidebar Width', 'iguru' ),
					'options'  => [
						'9' => '25%',
						'8' => '33%',
					],
					'default'  => '9',
					'required' => [ 'learnpress_single_sidebar_layout', '!=', 'none' ],
				),
				array(
					'id'       => 'learnpress_single_sidebar_def',
					'type'     => 'select',
					'title'    => esc_html__( 'Sidebar Template', 'iguru' ),
					'data'     => 'sidebars',
					'required' => [ 'learnpress_single_sidebar_layout', '!=', 'none' ],
				),
				array(
					'id'       => 'learnpress_single_sidebar_course_essentials_switch',
					'type'     => 'switch',
					'title'    => esc_html__( 'Course Essentials on top of Sidebar?', 'iguru' ),
					'desc'     => esc_html__( 'Use essential course info (with price and CTA button) as first in a widget area.', 'iguru' ),
					'default'  => true,
					'required' => [ 'learnpress_single_sidebar_layout', '!=', 'none' ],
				),
				array(
					'id'       => 'learnpress_single_sidebar_sticky',
					'type'     => 'switch',
					'title'    => esc_html__( 'Use Sticky Sidebar?', 'iguru' ),
					'default'  => false,
					'required' => [ 'learnpress_single_sidebar_layout', '!=', 'none' ],
				),
				array(
					'id'      => 'learnpress_single_sidebar_gap',
					'type'    => 'select',
					'title'   => esc_html__( 'Sidebar Side Gap', 'iguru' ),
					'options' => [
						'def' => esc_html__( 'Default', 'iguru' ),
						'0'  => '0',
						'15' => '15',
						'20' => '20',
						'25' => '25',
						'30' => '30',
						'35' => '35',
						'40' => '40',
						'45' => '45',
						'50' => '50',
					],
					'default'  => 'def',
					'required' => [ 'learnpress_single_sidebar_layout', '!=', 'none' ],
				),
				array(
					'id'     => 'learnpress_single_sidebar-end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'      => 'learnpress_single_related-start',
					'type'    => 'section',
					'title'   => esc_html__( 'Related Courses', 'iguru' ),
					'indent'  => true,
				),
				array(
					'id'       => 'learnpress_related_switch',
					'type'     => 'switch',
					'title'    => esc_html__( 'Display Related Courses?', 'iguru' ),
					'default'  => true,
					'on'       => esc_html__( 'Yes', 'iguru'),
					'off'      => esc_html__( 'No', 'iguru'),
				),
				array(
					'id'       => 'learnpress_related_title',
					'type'     => 'text',
					'title'    => esc_html__( 'Section Title', 'iguru' ),
					'default'  => esc_html__( 'Related Courses', 'iguru' ),
					'required' => [ 'learnpress_related_switch', '=', '1' ],
				), 
				array(
					'id'       => 'learnpress_related_columns',
					'type'     => 'button_set',
					'title'    => esc_html__( 'Columns Amount', 'iguru'),
					'options'  => array(
						'2' => 'Two', 
						'3' => 'Three',
						'4' => 'Four'
					), 
					'default'  => '3',
					'required' => [ 'learnpress_related_switch', '=', '1' ],
				),
				array(
					'id'       => 'learnpress_related_items',
					'type'     => 'text',
					'title'    => esc_html__( 'Number of Related Items', 'iguru' ),
					'default'  => '3',
					'required' => [ 'learnpress_related_switch', '=', '1' ],
				),
				array(
					'id'     => 'learnpress_single_related-end',
					'type'   => 'section',
					'indent' => false,
				),
			)
		]
	);

	Redux::setSection(
		$theme_slug,
		[
			'title'      => esc_html__( 'Archive', 'iguru' ),
			'id'         => 'learnpress-list-option',
			'subsection' => true,
			'fields'     => array(
				array(
					'id'       => 'learnpress_archive_page_title-start',
					'type'     => 'section',
					'title'    => esc_html__( 'Post Title Settings', 'iguru' ),
					'indent'   => true,
				),
				array(
					'id'       => 'learnpress_archive_title_switch',
					'type'     => 'switch',
					'title'    => esc_html__( 'Use Custom Page Title Text?', 'iguru' ),
					'default'  => true,
				),
				array(
					'id'       => 'learnpress_archive_page_title_text',
					'type'     => 'text',
					'title'    => esc_html__( 'Custom Page Title Text', 'iguru' ),
					'default'  => esc_html__( 'Courses', 'iguru' ),
					'required' => [ 'learnpress_archive_title_switch', '=', true ],
				),
				array(
					'id'       => 'learnpress_archive_page_title_bg_image',
					'type'     => 'background',
					'background-color' => false,
					'preview_media' => true,
					'preview'  => false,
					'title'    => esc_html__( 'Page Title Background Image', 'iguru' ),
					'default'  => [
						'background-repeat'     => 'repeat',
						'background-size'       => 'cover',
						'background-attachment' => 'scroll',
						'background-position'   => 'center center',
					],
				),
				array(
					'id'     => 'learnpress_archive_page_title-end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'       => 'learnpress_archive_columns',
					'type'     => 'button_set',
					'title'    => esc_html__( 'Grid Columns Amount', 'iguru'),
					'options'  => [
						'1' => 'One', 
						'2' => 'Two', 
						'3' => 'Three',
						'4' => 'Four'
					], 
					'default' => '3'
				),
				array(
					'id'       => 'learnpress_archive_sidebar-start',
					'type'     => 'section',
					'title'    => esc_html__( 'Sidebar Settings', 'iguru' ),
					'indent'   => true,
				),
				array(
					'id'       => 'learnpress_archive_sidebar_layout',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Sidebar Layout', 'iguru' ),
					'options'  => [
						'none' => [
							'alt' => 'None',
							'img' => get_template_directory_uri() . '/core/admin/img/options/1col.png'
						],
						'left' => [
							'alt' => 'Left',
							'img' => get_template_directory_uri() . '/core/admin/img/options/2cl.png'
						],
						'right' => [
							'alt' => 'Right',
							'img' => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
						],
					],
					'default'  => 'none',
				),
				array(
					'id'       => 'learnpress_archive_sidebar_def_width',
					'type'     => 'button_set',
					'title'    => esc_html__( 'Sidebar Width', 'iguru' ),
					'options'  => [
						'9' => '25%',
						'8' => '33%',
					],
					'default'  => '9',
					'required' => [ 'learnpress_archive_sidebar_layout', '!=', 'none' ],
				),
				array(
					'id'       => 'learnpress_archive_sidebar_def',
					'type'     => 'select',
					'title'    => esc_html__( 'Sidebar Template', 'iguru' ),
					'data'     => 'sidebars',
					'required' => [ 'learnpress_archive_sidebar_layout', '!=', 'none' ],
				), 
				array(
					'id'       => 'learnpress_archive_sidebar_sticky',
					'type'     => 'switch',
					'title'    => esc_html__( 'Use Sticky Sidebar?', 'iguru' ),
					'default'  => false,
					'required' => [ 'learnpress_archive_sidebar_layout', '!=', 'none' ],
				),
				array(
					'id'      => 'learnpress_archive_sidebar_gap',
					'type'    => 'select',
					'title'   => esc_html__( 'Sidebar Side Gap', 'iguru' ),
					'options' => [
						'def' => esc_html__( 'Default', 'iguru' ),
						'0'  => '0',
						'15' => '15',
						'20' => '20',
						'25' => '25',
						'30' => '30',
						'35' => '35',
						'40' => '40',
						'45' => '45',
						'50' => '50',
					],
					'default'  => 'def',
					'required' => [ 'learnpress_archive_sidebar_layout', '!=', 'none' ],
				),
				array(
					'id'     => 'learnpress_archive_sidebar-end',
					'type'   => 'section',
					'indent' => false,
				),
			)
		]
	);
}

// -> START Blog Options
Redux::setSection(
	$theme_slug,
	[
		'title' => esc_html__( 'Blog', 'iguru' ),
		'id'    => 'blog-option',
		'icon'  => 'el-icon-th',
	]
);

Redux::setSection(
	$theme_slug,
	[
		'title'      => esc_html__( 'Single', 'iguru' ),
		'id'         => 'blog-single-option',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'single_type_layout',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Blog Single Type', 'iguru' ),
				'options'  => array(
					'1' => esc_html__( 'Title First', 'iguru' ),
					'2' => esc_html__( 'Image First', 'iguru' ),
					'3' => esc_html__( 'Overlay Image', 'iguru' )
				),
				'default'  => '3',
			),
			array(
				'id'       => 'blog_single_post_title-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Post Title Settings', 'iguru' ),
				'indent'   => true,
			),
			array(
				'id'       => 'blog_title_conditional',
				'type'     => 'switch',
				'title'    => esc_html__( 'Post Title Switch', 'iguru' ),
				'default'  => true,
				'required' => [ 'single_type_layout', '!=', '3' ],
			),
			array(
				'id'       => 'post_single_page_title_text',
				'type'     => 'text',
				'title'    => esc_html__( 'Custom Post Title', 'iguru' ),
				'default'  => esc_html__( '', 'iguru' ),
				'required' => [ 'blog_title_conditional', '=', true ],
			),
			array(
				'id'       => 'post_single_page_title_bg_image',
				'type'     => 'background',
				'preview'  => false,
				'preview_media' => true,
				'background-color' => false,
				'title'    => esc_html__( 'Background Image', 'iguru' ),
				'default'  => [
					'background-repeat'     => 'repeat',
					'background-size'       => 'cover',
					'background-attachment' => 'scroll',
					'background-position'   => 'center center',
					'background-color'      => '#103f40',
				],
				'required' => [ 'single_type_layout', '!=', '3' ],
			),
			array(
				'id'       => 'single_padding_layout_3',
				'type'     => 'spacing',
				'title'    => esc_html__( 'Padding Top', 'iguru' ),
				'mode'     => 'padding',
				'all'      => false,
				'bottom'   => false,
				'top'      => true,
				'left'     => false,
				'right'    => false,
				'default'  => [
					'padding-top' => '75px',
				],
				'required' => [ 'single_type_layout', '=', '3' ],
			),
			array(
				'id'       => 'single_apply_animation',
				'type'     => 'switch',
				'title'    => esc_html__( 'Apply Animation?', 'iguru' ),
				'default'  => false,
				'required' => [ 'single_type_layout', '=', '3' ],
			),
			array(
				'id'      => 'blog_single_page_title_breadcrumbs_switch',
				'type'    => 'switch',
				'title'   => esc_html__( 'Breadcrumbs Switch', 'iguru' ),
				'default' => false,
			),
			array(
				'id'       => 'blog_single_border_top_color',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Border Top Color', 'iguru' ),
				'subtitle' => esc_html__( 'For Single Type 1 and 2 w/out background', 'iguru' ),
				'default'  => [
					'color' => '#8d8d8d',
					'alpha' => '0.2',
					'rgba'  => 'rgba(141,141,141,0.2)'
				],
				'mode'     => 'background',
			),
			array(
				'id'     => 'blog_single_post_title--end',
				'type'   => 'section',
				'indent' => false,
			),
			array(
				'id'       => 'blog_single_sidebar-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Sidebar Settings', 'iguru' ),
				'indent'   => true,
			),
			array(
				'id'       => 'single_sidebar_layout',
				'type'     => 'image_select',
				'title'    => esc_html__( 'Sidebar Layout', 'iguru' ),
				'options'  => array(
					'none' => array(
						'alt' => 'None',
						'img' => get_template_directory_uri() . '/core/admin/img/options/1col.png'
					),
					'left' => array(
						'alt' => 'Left',
						'img' => get_template_directory_uri() . '/core/admin/img/options/2cl.png'
					),
					'right' => array(
						'alt' => 'Right',
						'img' => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
					)
				),
				'default'  => 'right'
			),
			array(
				'id'       => 'single_sidebar_def_width',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Sidebar Width', 'iguru' ),
				'options'  => array(
					'9' => '25%',
					'8' => '33%',
				),
				'default'  => '9',
				'required' => [ 'single_sidebar_layout', '!=', 'none' ],
			),
			array(
				'id'       => 'single_sidebar_def',
				'type'     => 'select',
				'title'    => esc_html__( 'Sidebar Template', 'iguru' ),
				'data'     => 'sidebars',
				'default'  =>  'sidebar_main-sidebar',
				'required' => [ 'single_sidebar_layout', '!=', 'none' ],
			), 
			array(
				'id'       => 'single_sidebar_sticky',
				'type'     => 'switch',
				'title'    => esc_html__( 'Use Sticky Sidebar?', 'iguru' ),
				'default'  => true,
				'required' => [ 'single_sidebar_layout', '!=', 'none' ],
			),
			array(
				'id'       => 'single_sidebar_gap',
				'type'     => 'select',
				'title'    => esc_html__( 'Sidebar Side Gap', 'iguru' ), 
				'options'  => array(
					'def' => esc_html__( 'Default', 'iguru' ),
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
				'default'  => 'def',
				'required' => [ 'single_sidebar_layout', '!=', 'none' ],
			),
			array(
				'id'     => 'blog_single_sidebar-end',
				'type'   => 'section',
				'indent' => false,
			),
			array(
				'id'       => 'blog_single_appearance-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Appearance Settings', 'iguru' ),
				'indent'   => true,
			),
			array(
				'id'       => 'single_related_posts',
				'type'     => 'switch',
				'title'    => esc_html__( 'Related Posts', 'iguru' ),
				'default'  => true,
			),
			array(
				'id'       => 'single_likes',
				'type'     => 'switch',
				'title'    => esc_html__( 'Likes', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'       => 'single_views',
				'type'     => 'switch',
				'title'    => esc_html__( 'Views', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'       => 'single_share',
				'type'     => 'switch',
				'title'    => esc_html__( 'Shares', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'       => 'single_author_info',
				'type'     => 'switch',
				'title'    => esc_html__( 'Author Info', 'iguru' ),
				'default'  => true,
			),
			array(
				'id'       => 'single_meta',
				'type'     => 'switch',
				'title'    => esc_html__( 'Hide all post-meta?', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'       => 'single_meta_author',
				'type'     => 'switch',
				'title'    => esc_html__( 'Hide post-meta author?', 'iguru' ),
				'default'  => false,
				'required' => [ 'single_meta', '=', false ],
			),
			array(
				'id'       => 'single_meta_comments',
				'type'     => 'switch',
				'title'    => esc_html__( 'Hide post-meta comments?', 'iguru' ),
				'default'  => true,
				'required' => [ 'single_meta', '=', false ],
			),
			array(
				'id'       => 'single_meta_categories',
				'type'     => 'switch',
				'title'    => esc_html__( 'Hide post-meta categories?', 'iguru' ),
				'default'  => false,
				'required' => [ 'single_meta', '=', false ],
			),
			array(
				'id'       => 'single_meta_date',
				'type'     => 'switch',
				'title'    => esc_html__( 'Hide post-meta date?', 'iguru' ),
				'default'  => false,
				'required' => [ 'single_meta', '=', false ],
			),
			array(
				'id'       => 'single_meta_tags',
				'type'     => 'switch',
				'title'    => esc_html__( 'Hide tags?', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'     => 'blog_single_appearance-end',
				'type'   => 'section',
				'indent' => false,
			),
		)
	]
);

Redux::setSection(
	$theme_slug,
	[
		'title'      => esc_html__( 'Archive', 'iguru' ),
		'id'         => 'blog-list-option',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'post_archive_page_title_bg_image',
				'type'    => 'background',
				'background-color' => false,
				'preview_media' => true,
				'preview' => false,
				'title'   => esc_html__( 'Page Title Background Image', 'iguru' ),
				'default' => [
					'background-repeat'     => 'repeat',
					'background-size'       => 'cover',
					'background-attachment' => 'scroll',
					'background-position'   => 'center center',
					'background-color'      => '#103f40',
				],
			),
			array(
				'id'       => 'blog_list_sidebar_layout',
				'type'     => 'image_select',
				'title'    => esc_html__( 'Blog Archive Sidebar Layout', 'iguru' ),
				'options'  => array(
					'none' => array(
						'alt' => 'None',
						'img' => get_template_directory_uri() . '/core/admin/img/options/1col.png'
					),
					'left' => array(
						'alt' => 'Left',
						'img' => get_template_directory_uri() . '/core/admin/img/options/2cl.png'
					),
					'right' => array(
						'alt' => 'Right',
						'img' => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
					)
				),
				'default'  => 'none'
			),
			array(
				'id'       => 'blog_list_sidebar_def',
				'type'     => 'select',
				'title'    => esc_html__( 'Blog Archive Sidebar', 'iguru' ),
				'data'     => 'sidebars',
				'required' => [ 'blog_list_sidebar_layout', '!=', 'none' ],
			),
			array(
				'id'       => 'blog_list_sidebar_def_width',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Blog Archive Sidebar Width', 'iguru' ),
				'options'  => array(          
					'9' => '25%',
					'8' => '33%',
				),
				'default'  => '9',
				'required' => [ 'blog_list_sidebar_layout', '!=', 'none' ],
			),
			array(
				'id'       => 'blog_list_sidebar_sticky',
				'type'     => 'switch',
				'title'    => esc_html__( 'Blog Archive Sticky Sidebar On?', 'iguru' ),
				'default'  => false,
				'required' => [ 'blog_list_sidebar_layout', '!=', 'none' ],
			),
			array(
				'id'       => 'blog_list_sidebar_gap',
				'type'     => 'select',
				'title'    => esc_html__( 'Blog Archive Sidebar Side Gap', 'iguru' ),
				'options'  => array(
					'def' => esc_html__( 'Default', 'iguru' ),
					'0'  =>  '0',
					'15' => '15',
					'20' => '20',
					'25' => '25',
					'30' => '30',
					'35' => '35',
					'40' => '40',
					'45' => '45',
					'50' => '50',
				),
				'default'  => '15',
				'required' => [ 'blog_list_sidebar_layout', '!=', 'none' ],
			),
			array(
				'id'       => 'blog_list_columns',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Columns in Archive', 'iguru'),
				'options' => array(
					'12' => 'One', 
					'6'  => 'Two', 
					'4'  => 'Three',
					'3'  => 'Four'
				 ), 
				'default' => '12'
			),
			array(
				'id'       => 'blog_list_likes',
				'type'     => 'switch',
				'title'    => esc_html__( 'Likes On/Off', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'       => 'blog_list_share',
				'type'     => 'switch',
				'title'    => esc_html__( 'Share On/Off', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'       => 'blog_list_hide_media',
				'type'     => 'switch',
				'title'    => esc_html__( 'Hide Media?', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'       => 'blog_list_hide_title',
				'type'     => 'switch',
				'title'    => esc_html__( 'Hide Title?', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'       => 'blog_list_hide_content',
				'type'     => 'switch',
				'title'    => esc_html__( 'Hide Content?', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'       => 'blog_post_listing_content',
				'type'     => 'switch',
				'title'    => esc_html__( 'Cut Off Text in Blog Listing', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'       => 'blog_list_letter_count',
				'type'     => 'text',
				'title'    => esc_html__( 'Number of character to show before trim.', 'iguru'),
				'default'  => '85',
				'required' => [ 'blog_post_listing_content', '=', true ],
			),
			array(
				'id'       => 'blog_list_read_more',
				'type'     => 'switch',
				'title'    => esc_html__( 'Hide Read More Button?', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'       => 'blog_list_meta',
				'type'     => 'switch',
				'title'    => esc_html__( 'Hide all post-meta?', 'iguru' ),
				'default'  => false,
			),
			array(
				'id'       => 'blog_list_meta_author',
				'type'     => 'switch',
				'title'    => esc_html__( 'Hide post-meta author?', 'iguru' ),
				'default'  => false,
				'required' => [ 'blog_list_meta', '=', false ],
			),
			array(
				'id'       => 'blog_list_meta_comments',
				'type'     => 'switch',
				'title'    => esc_html__( 'Hide post-meta comments?', 'iguru' ),
				'default'  => true,
				'required' => [ 'blog_list_meta', '=', false ],
			),
			array(
				'id'       => 'blog_list_meta_categories',
				'type'     => 'switch',
				'title'    => esc_html__( 'Hide post-meta categories?', 'iguru' ),
				'default'  => false,
				'required' => [ 'blog_list_meta', '=', false ],
			),
			array(
				'id'       => 'blog_list_meta_date',
				'type'     => 'switch',
				'title'    => esc_html__( 'Hide post-meta date?', 'iguru' ),
				'default'  => false,
				'required' => [ 'blog_list_meta', '=', false ],
			),
		)
	]
);

// -> START Portfolio Options
Redux::setSection(
	$theme_slug,
	[
		'title' => esc_html__( 'Portfolio', 'iguru' ),
		'id'    => 'portfolio-option',
		'icon'  => 'el-icon-th',
	]
);

Redux::setSection(
	$theme_slug,
	array(
	'title'      => esc_html__( 'Archive', 'iguru' ),
	'id'         => 'portfolio-list-option',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'       => 'portfolio_archive_page_title_bg_image',
			'type'     => 'background',
			'background-color' => false,
			'preview_media' => true,
			'preview'  => false,
			'title'    => esc_html__( 'Archive Page Title Background Image', 'iguru' ),
			'default'  => [
				'background-repeat'     => 'repeat',
				'background-size'       => 'cover',
				'background-attachment' => 'scroll',
				'background-position'   => 'center center',
				'background-color'      => '#103f40',
			],
		),
		array(
			'id'       => 'portfolio_list_sidebar_layout',
			'type'     => 'image_select',
			'title'    => esc_html__( 'Portfolio Archive Sidebar Layout', 'iguru' ),
			'options'  => [
				'none' => [
					'alt' => 'None',
					'img' => get_template_directory_uri() . '/core/admin/img/options/1col.png'
				],
				'left' => [
					'alt' => 'Left',
					'img' => get_template_directory_uri() . '/core/admin/img/options/2cl.png'
				],
				'right' => [
					'alt' => 'Right',
					'img' => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
				],
			],
			'default'  => 'none',
		),
		array(
			'id'       => 'portfolio_list_sidebar_def',
			'type'     => 'select',
			'title'    => esc_html__( 'Portfolio Archive Sidebar', 'iguru' ),
			'data'     => 'sidebars',
			'required' => [ 'portfolio_list_sidebar_layout', '!=', 'none' ],
		),
		array(
			'id'       => 'portfolio_list_columns',
			'type'     => 'button_set',
			'title'    => esc_html__( 'Columns in Archive', 'iguru'),
			'options' => array(
				'1' => 'One', 
				'2' => 'Two', 
				'3' => 'Three',
				'4' => 'Four'
			), 
			'default' => '3'
		),
		array(
			'id'       => 'portfolio_slug',
			'type'     => 'text',
			'title'    => esc_html__( 'Portfolio Slug', 'iguru' ),
			'default'  => 'portfolio',
		), 
		array(
			'id'       => 'portfolio_list_show_filter',
			'type'     => 'switch',
			'title'    => esc_html__( 'Filter On/Off', 'iguru' ),
			'default'  => false,
		),
		array(
			'id'       => 'portfolio_list_filter_cats',
			'type'     => 'select',
			'multi'    => true,
			'title'    => esc_html__( 'Select Categories', 'iguru' ), 
			'data'     => 'terms',
			'args'     => array( 'taxonomies' => 'portfolio-category' ),
			'required' => [ 'portfolio_list_show_filter', '=', '1' ],
		),
		array(
			'id'       => 'portfolio_list_show_title',
			'type'     => 'switch',
			'title'    => esc_html__( 'Title On/Off', 'iguru' ),
			'default'  => true,
		),
		array(
			'id'       => 'portfolio_list_show_content',
			'type'     => 'switch',
			'title'    => esc_html__( 'Content On/Off', 'iguru' ),
			'default'  => false,
		),
		array(
			'id'       => 'portfolio_list_show_cat',
			'type'     => 'switch',
			'title'    => esc_html__( 'Categories On/Off', 'iguru' ),
			'default'  => true,
		),
	)
) );

Redux::setSection(
	$theme_slug,
	[
		'title'            => esc_html__( 'Single', 'iguru' ),
		'id'               => 'portfolio-single-option',
		'subsection'       => true,
		'fields'           => array(
			array(
				'id'      => 'portfolio_single_type_layout',
				'type'    => 'button_set',
				'title'   => esc_html__( 'Portfolio Single Type', 'iguru' ),
				'options' => array(
					'1' => esc_html__( 'Title First', 'iguru' ),
					'2' => esc_html__( 'Image First', 'iguru' ),
					'3' => esc_html__( 'Overlay Image', 'iguru' ),
					'4' => esc_html__( 'Overlay Image with Info', 'iguru' ),
				),
				'default' => '2',
			),
			array(
				'id'       => 'portfolio_single_post_title-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Post Title Settings', 'iguru' ),
				'indent'   => true,
			),
			array(
				'id'       => 'portfolio_title_conditional',
				'type'     => 'switch',
				'title'    => esc_html__( 'Use Custom Post Title Text?', 'iguru' ),
				'default'  => true,
			),
			array(
				'id'       => 'portfolio_single_page_title_text',
				'type'     => 'text',
				'title'    => esc_html__( 'Post Title Text', 'iguru' ),
				'default'  => esc_html__( 'Portfolio Single', 'iguru' ),
				'required' => [ 'portfolio_title_conditional', '=', true ],
			), 
			array(
				'id'      => 'portfolio_single_title_align',
				'type'    => 'button_set',
				'title'   => esc_html__( 'Title Alignment', 'iguru' ),
				'options' => array(
					'left'   => esc_html__( 'Left', 'iguru' ),
					'center' => esc_html__( 'Center', 'iguru' ),
					'right'  => esc_html__( 'Right', 'iguru' ),
				),
				'default' => 'center',
			),
			array(
				'id'      => 'portfolio_single_breadcrumbs_align',
				'type'    => 'button_set',
				'title'   => esc_html__( 'Title Breadcrumbs Alignment', 'iguru' ),
				'options' => array(
					'left'   => esc_html__( 'Left', 'iguru' ),
					'center' => esc_html__( 'Center', 'iguru' ),
					'right'  => esc_html__( 'Right', 'iguru' ),
				),
				'default' => 'center',
			),
			array(
				'id'      => 'portfolio_single_title_bg_switch',
				'type'    => 'switch',
				'title'   => esc_html__( 'Use Color/Image Background?', 'iguru' ),
				'default' => true,
			),
			array(
				'id'      => 'portfolio_single_page_title_bg_image',
				'type'    => 'background',
				'title'   => esc_html__( 'Background', 'iguru' ),
				'preview' => false,
				'transparent' => false,
				'preview_media' => true,
				'background-color' => true,
				'default' => [
					'background-repeat'     => 'repeat',
					'background-size'       => 'cover',
					'background-attachment' => 'scroll',
					'background-position'   => 'center center',
					'background-color'      => '#103f40',
				],
				'required' => [ 'portfolio_single_title_bg_switch', '=', true ],
			),
			array(
				'id'      => 'portfolio_single_page_title_padding',
				'type'    => 'spacing',
				'title'   => esc_html__( 'Paddings Top/Bottom', 'iguru' ),
				'mode'    => 'padding',
				'all'     => false,
				'bottom'  => true,
				'top'     => true,
				'left'    => false,
				'right'   => false,
				'default' => [
					'padding-top'    => '82',
					'padding-bottom' => '72',
				],
			),
			array(
				'id'      => 'portfolio_single_page_title_margin',
				'type'    => 'spacing',
				'title'   => esc_html__( 'Margin Bottom', 'iguru' ),
				'mode'    => 'margin',
				'all'     => false,
				'bottom'  => true,
				'top'     => false,
				'left'    => false,
				'right'   => false,
				'default' => array( 'margin-bottom' => '40' ),
			),
			array(
				'id'      => 'portfolio_single_post_title-end',
				'type'    => 'section',
				'indent'  => false,
			),
			array(
				'id'      => 'portfolio_single_sidebar-start',
				'type'    => 'section',
				'title'   => esc_html__( 'Sidebar Settings', 'iguru' ),
				'indent'  => true,
			),
			array(
				'id'      => 'portfolio_single_sidebar_layout',
				'type'    => 'image_select',
				'title'   => esc_html__( 'Sidebar Layout', 'iguru' ),
				'options' => array(
					'none' => array(
						'alt' => 'None',
						'img' => get_template_directory_uri() . '/core/admin/img/options/1col.png'
					),
					'left' => array(
						'alt' => 'Left',
						'img' => get_template_directory_uri() . '/core/admin/img/options/2cl.png'
					),
					'right' => array(
						'alt' => 'Right',
						'img' => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
					)
				),
				'default'  => 'none'
			),
			array(
				'id'       => 'portfolio_single_sidebar_def',
				'type'     => 'select',
				'title'    => esc_html__( 'Sidebar Template', 'iguru' ),
				'data'     => 'sidebars',
				'required' => [ 'portfolio_single_sidebar_layout', '!=', 'none' ],
			),
			array(
				'id'       => 'portfolio_single_sidebar_def_width',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Sidebar Width', 'iguru' ),
				'options'  => array(
					'9' => '25%',
					'8' => '33%',
				),
				'default'  => '8',
				'required' => [ 'portfolio_single_sidebar_layout', '!=', 'none' ],
			),
			array(
				'id'       => 'portfolio_single_sidebar_sticky',
				'type'     => 'switch',
				'title'    => esc_html__( 'Sticky Sidebar', 'iguru' ),
				'default'  => false,
				'required' => [ 'portfolio_single_sidebar_layout', '!=', 'none' ],
			),
			array(
				'id'       => 'portfolio_single_sidebar_gap',
				'type'     => 'select',
				'title'    => esc_html__( 'Side Offset', 'iguru' ),
				'options'  => array(
					'def' => esc_html__( 'Default', 'iguru' ),
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
				'default'  => 'def',
				'required' => [ 'portfolio_single_sidebar_layout', '!=', 'none' ],
			),
			array(
				'id'     => 'portfolio_single_sidebar-end',
				'type'   => 'section',
				'indent' => false,
			),
			array(
				'id'      => 'portfolio_single_appearance-start',
				'type'    => 'section',
				'title'   => esc_html__( 'Appearance Settings', 'iguru' ),
				'indent'  => true,
			),
			array(
				'id'      => 'portfolio_single_align',
				'type'    => 'button_set',
				'title'   => esc_html__( 'Title Alignment', 'iguru' ),
				'options' => array(
					'left'   => esc_html__( 'Left', 'iguru' ),
					'center' => esc_html__( 'Center', 'iguru' ),
					'right'  => esc_html__( 'Right', 'iguru' ),
				),
				'default'  => 'left',
			),
			array(
				'id'      => 'portfolio_single_padding',
				'type'    => 'spacing',
				'mode'    => 'padding',
				'all'     => false,
				'bottom'  => true,
				'top'     => true,
				'left'    => false,
				'right'   => false,
				'title'   => esc_html__( 'Portfolio Single Padding', 'iguru' ),
				'default' => [
					'padding-top'    => '165px',
					'padding-bottom' => '165px',
				],
				'required' => [
					[ 'portfolio_single_type_layout', '!=', '1' ],
					[ 'portfolio_single_type_layout', '!=', '2' ],
				],
			),
			array(
				'id'       => 'portfolio_parallax',
				'type'     => 'switch',
				'title'    => esc_html__( 'Add Portfolio Parallax', 'iguru' ),
				'default'  => false,
				'required' => [
					[ 'portfolio_single_type_layout', '!=', '1' ],
					[ 'portfolio_single_type_layout', '!=', '2' ],
				],
			),
			array(
				'id'       => 'portfolio_parallax_speed',
				'type'     => 'spinner',
				'title'    => esc_html__( 'Parallax Speed', 'iguru' ),
				'default'  => '0.3',
				'min'      => '-5',
				'step'     => '0.1',
				'max'      => '5',
				'required' => [ 'portfolio_parallax', '=', '1' ],
			),
			array(
				'id'      => 'portfolio_above_content_cats',
				'type'    => 'switch',
				'title'   => esc_html__( 'Tags', 'iguru' ),
				'default' => true,
			),
			array(
				'id'      => 'portfolio_above_content_share',
				'type'    => 'switch',
				'title'   => esc_html__( 'Shares', 'iguru' ),
				'default' => true,
			),
			array(
				'id'      => 'portfolio_single_meta_likes',
				'type'    => 'switch',
				'title'   => esc_html__( 'Likes', 'iguru' ),
				'default' => false,
			),
			array(
				'id'      => 'portfolio_single_meta',
				'type'    => 'switch',
				'title'   => esc_html__( 'Hide all post-meta?', 'iguru' ),
				'default' => false,
			),
			array(
				'id'      => 'portfolio_single_meta_author',
				'type'    => 'switch',
				'title'   => esc_html__( 'Post-meta author', 'iguru' ),
				'default' => false,
				'required' => [ 'portfolio_single_meta', '=', false ],
			),
			array(
				'id'      => 'portfolio_single_meta_comments',
				'type'    => 'switch',
				'title'   => esc_html__( 'Post-meta comments', 'iguru' ),
				'default' => false,
				'required' => [ 'portfolio_single_meta', '=', false ],
			),
			array(
				'id'      => 'portfolio_single_meta_categories',
				'type'    => 'switch',
				'title'   => esc_html__( 'Post-meta categories', 'iguru' ),
				'default' => false,
				'required' => [ 'portfolio_single_meta', '=', false ],
			),
			array(
				'id'      => 'portfolio_single_meta_date',
				'type'    => 'switch',
				'title'   => esc_html__( 'Post-meta date', 'iguru' ),
				'default' => false,
				'required' => [ 'portfolio_single_meta', '=', false ],
			),
			array(
				'id'      => 'portfolio_single_sidebar-end',
				'type'    => 'section',
				'indent'  => false,
			),
		)
	]
);

Redux::setSection(
	$theme_slug,
	[
		'title'            => esc_html__( 'Related Posts', 'iguru' ),
		'id'               => 'portfolio-related-option',
		'subsection'       => true,
		'fields'           => array(
			array(
				'id'       => 'portfolio_related_switch',
				'type'     => 'switch',
				'title'    => esc_html__( 'Related Posts On/Off', 'iguru' ),
				'default'  => true,
			),
			array(
				'id'       => 'pf_title_r',
				'type'     => 'text',
				'title'    => esc_html__( 'Title', 'iguru' ),
				'default'  => esc_html__( 'Related Portfolio', 'iguru' ),
				'required' => [ 'portfolio_related_switch', '=', '1' ],
			), 
			array(
				'id'       => 'pf_carousel_r',
				'type'     => 'switch',
				'title'    => esc_html__( 'Display items carousel for this portfolio post', 'iguru' ),
				'default'  => true,
				'required' => [ 'portfolio_related_switch', '=', '1' ],
			),
			array(
				'id'       => 'pf_column_r',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Related Columns', 'iguru'),
				'options'  => array(
					'2' => 'Two', 
					'3' => 'Three',
					'4' => 'Four'
				), 
				'default'  => '3',
				'required' => [ 'portfolio_related_switch', '=', '1' ],
			),
			array(
				'id'       => 'pf_number_r',
				'type'     => 'text',
				'title'    => esc_html__( 'Number of Related Items', 'iguru' ),
				'default'  => '3',
				'required' => [ 'portfolio_related_switch', '=', '1' ],
			), 
		)
	]
); 

// -> START Team Options
Redux::setSection(
	$theme_slug,
	[
		'title'           => esc_html__( 'Team', 'iguru' ),
		'id'              => 'team-option',
		'icon'            => 'el-icon-th',
		'fields'          => array(
			array(
				'id'      => 'team_slug',
				'type'    => 'text',
				'title'   => esc_html__( 'Team Slug', 'iguru' ),
				'default' => 'team',
			),
		)
	]
);

Redux::setSection(
	$theme_slug,
	[
		'title'      => esc_html__( 'Single', 'iguru' ),
		'id'         => 'team-single-option',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'      => 'team_single_post_title-start',
				'type'    => 'section',
				'title'   => esc_html__( 'Post Title Settings', 'iguru' ),
				'indent'  => true,
			),
			array(
				'id'      => 'team_title_conditional',
				'type'    => 'switch',
				'title'   => esc_html__( 'Use Custom Post Title Text?', 'iguru' ),
				'default' => true,
			),
			array(
				'id'      => 'team_single_page_title_text',
				'type'    => 'text',
				'title'   => esc_html__( 'Post Title Text', 'iguru' ),
				'default' => esc_html__( 'Team', 'iguru' ),
				'required' => [ 'team_title_conditional', '=', true ],
			),
			array(
				'id'      => 'team_single_page_title_bg_image',
				'type'    => 'background',
				'preview' => false,
				'preview_media' => true,
				'background-color' => false,
				'title'   => esc_html__( 'Background Image', 'iguru' ),
				'default' => [
					'background-repeat'     => 'repeat',
					'background-size'       => 'cover',
					'background-attachment' => 'scroll',
					'background-position'   => 'center center',
					'background-color'      => '#103f40',
				],
			),
			array(
				'id'     => 'team_single_post_title-end',
				'type'   => 'section',
				'indent' => false,
			),
		)
	]
);

// -> START Page 404 Options
Redux::setSection(
	$theme_slug,
	[
		'title'            => esc_html__( 'Page 404', 'iguru' ),
		'id'               => '404-option',
		'icon'             => 'el-icon-th',
		'fields'           => array(
			array(
				'id'       => '404_post_title-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Page Title Settings', 'iguru' ),
				'indent'   => true,
			),
			array(
				'id'       => '404_custom_title_switch',
				'type'     => 'switch',
				'title'    => esc_html__( 'Use Custom Page Title?', 'iguru' ),
				'default'  => true,
			),
			array(
				'id'       => '404_page_title_text',
				'type'     => 'text',
				'title'    => esc_html__( 'Custom Page Title', 'iguru' ),
				'default'  => esc_html__( 'Error Page', 'iguru' ),
				'required' => [ '404_custom_title_switch', '=', true ],
			),

			array(
				'id'      => '404_title_bg_switch',
				'type'    => 'switch',
				'title'   => esc_html__( 'Use Color/Image Background?', 'iguru' ),
				'default' => true,
			),
			array(
				'id'       => '404_page_title_bg_image',
				'type'     => 'background',
				'preview'  => false,
				'preview_media' => true,
				'background-color' => true,
				'transparent' => false,
				'title'    => esc_html__( 'Background', 'iguru' ),
				'default'  => [
					'background-repeat'     => 'repeat',
					'background-size'       => 'cover',
					'background-attachment' => 'scroll',
					'background-position'   => 'center center',
					'background-color'      => '#103f40',
				],
				'required' => [ '404_title_bg_switch', '=', true ],
			),
			array(
				'id'      => '404_page_title_padding',
				'type'    => 'spacing',
				'title'   => esc_html__( 'Paddings Top/Bottom', 'iguru' ),
				'mode'    => 'padding',
				'all'     => false,
				'bottom'  => true,
				'top'     => true,
				'left'    => false,
				'right'   => false,
				'default' => [
					'padding-top'    => '82',
					'padding-bottom' => '72',
				],
			),
			array(
				'id'      => '404_page_title_margin',
				'type'    => 'spacing',
				'title'   => esc_html__( 'Margin Bottom', 'iguru' ),
				'mode'    => 'margin',
				'all'     => false,
				'bottom'  => true,
				'top'     => false,
				'left'    => false,
				'right'   => false,
				'default' => array( 'margin-bottom' => '0' ),
			),
			array(
				'id'     => '404_post_title-end',
				'type'   => 'section',
				'indent' => false,
			),
		)
	]
); 

// -> START Side Panel Options
Redux::setSection(
	$theme_slug,
	[
		'title'            => esc_html__( 'Side Panel', 'iguru' ),
		'id'               => 'side_panel',
		'icon'             => 'el-icon-th',
		'fields'           => array(
			array(
				'id'       => 'side_panel_text_color',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Text Color', 'iguru' ),
				'default'  => [
					'color' => '#2c2c2c',
					'alpha' => '1',
					'rgba'  => 'rgba(44, 44, 44, 1)'
				],
				'mode'     => 'background',
			),
			array(
				'id'       => 'side_panel_bg',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Background', 'iguru' ),
				'default'  => [
					'color' => '#ffffff',
					'alpha' => '1',
					'rgba'  => 'rgba(255,255,255,1)'
				],
				'mode'     => 'background',
			),
			array(
				'id'       => 'side_panel_text_alignment',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Text Align', 'iguru' ),
				'options'  => [
					'left'   => esc_html__( 'Left', 'iguru' ),
					'center' => esc_html__( 'Center', 'iguru' ),
					'right'  => esc_html__( 'Right', 'iguru' ),
				],
				'default'  => 'center'
			),
			array(
				'id'       => 'side_panel_width',
				'type'     => 'dimensions',
				'units'    => false, 
				'units_extended' => false,
				'title'    => esc_html__( 'Width', 'iguru' ),
				'height'   => false,
				'width'    => true,
				'default'  => array( 'width' => 480 )
			),
			array(
				'id'       => 'side_panel_position',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Position', 'iguru' ),
				'options'  => [
					'left'  => esc_html__( 'Left', 'iguru' ),
					'right' => esc_html__( 'Right', 'iguru' ),
				],
				'default'  => 'right'
			),
		)
	]
);

// -> START Layout Options
Redux::setSection(
	$theme_slug,
	[
		'title'  => esc_html__( 'Sidebars', 'iguru' ),
		'id'     => 'layout_options',
		'icon'   => 'el el-braille',
		'fields' => array(
			array(
				'id'       => 'sidebars', 
				'type'     => 'multi_text',
				'validate' => 'no_html',
				'add_text' => esc_html__( 'Add Sidebar', 'iguru' ),
				'title'    => esc_html__( 'Register Sidebars', 'iguru' ),
				'default'  => array('Main Sidebar'),
			),
			array(
				'id'       => 'sidebars-start',
				'type'     => 'section',
				'title'    => esc_html__( 'Sidebar Page Settings', 'iguru' ),
				'indent'   => true,
			),
			array(
				'id'       => 'page_sidebar_layout',
				'type'     => 'image_select',
				'title'    => esc_html__( 'Page Sidebar Layout', 'iguru' ),
				'options'  => array(
					'none' => array(
						'alt' => 'None',
						'img' => get_template_directory_uri() . '/core/admin/img/options/1col.png'
					),
					'left' => array(
						'alt' => 'Left',
						'img' => get_template_directory_uri() . '/core/admin/img/options/2cl.png'
					),
					'right' => array(
						'alt' => 'Right',
						'img' => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
					)
				),
				'default'  => 'none'
			),
			array(
				'id'       => 'page_sidebar_def',
				'type'     => 'select',
				'title'    => esc_html__( 'Page Sidebar', 'iguru' ),
				'data'     => 'sidebars',
				'required' => [ 'page_sidebar_layout', '!=', 'none' ],
			), 
			array(
				'id'       => 'page_sidebar_def_width',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Page Sidebar Width', 'iguru' ),
				'options'  => array(
					'9' => '25%',
					'8' => '33%',
				),
				'default'  => '9',
				'required' => [ 'page_sidebar_layout', '!=', 'none' ],
			),
			array(
				'id'       => 'page_sidebar_sticky',
				'type'     => 'switch',
				'title'    => esc_html__( 'Sticky Sidebar On?', 'iguru' ),
				'default'  => false,
				'required' => [ 'page_sidebar_layout', '!=', 'none' ],
			),
			array(
				'id'       => 'page_sidebar_gap',
				'type'     => 'select',
				'title'    => esc_html__( 'Sidebar Side Gap', 'iguru' ),
				'options'  => array(
					'def' => esc_html__( 'Default', 'iguru' ),
					'0'  =>  '0',
					'15' => '15',
					'20' => '20',
					'25' => '25',
					'30' => '30',
					'35' => '35',
					'40' => '40',
					'45' => '45',
					'50' => '50',
				),
				'default'  => '15',
				'required' => [ 'page_sidebar_layout', '!=', 'none' ],
			),
			array(
				'id'     => 'sidebars-end',
				'type'   => 'section',
				'indent' => false,
			),
		)
	]
);

// -> START Social Share Options
Redux::setSection(
	$theme_slug,
	[
		'title'  => esc_html__( 'Social Shares', 'iguru' ),
		'id'     => 'soc_shares',
		'icon'   => 'el el-share-alt',
		'fields' => array(         
			array(
				'id'       => 'show_soc_icon_page',
				'type'     => 'switch',
				'title'    => esc_html__( 'Show Social Share on Pages On/Off', 'iguru' ),
				'default'  => false,
			), 
			array(
				'id'       => 'soc_icon_style',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Choose your share style.', 'iguru' ),
				'options'  => [
					'standard' => esc_html__( 'Standard', 'iguru' ),
					'hovered' => esc_html__( 'Hovered', 'iguru' ),
				],
				'default'  => 'standard',
				'required' => [ 'show_soc_icon_page', '=', '1' ],
			), 
			array(
				'id'       => 'soc_icon_position',
				'type'     => 'switch',
				'title'    => esc_html__( 'Fixed Position On/Off', 'iguru' ),
				'default'  => false,
				'required' => [ 'show_soc_icon_page', '=', '1' ],
			),
			array(
				'id'       => 'soc_icon_offset',
				'type'     => 'spacing',
				'mode'     => 'margin',
				'all'      => false,
				'bottom'   => true,
				'top'      => false,
				'left'     => false,
				'right'    => false,
				'title'    => esc_html__( 'Offset Top', 'iguru' ),
				'desc'     => esc_html__( 'Measurement units defined as "percents" while position fixed is enabled, and as "pixels" while position is off.', 'iguru' ),
				'default'  => array( 'margin-bottom' => '40%' ),
				'required' => [ 'show_soc_icon_page', '=', '1' ],
			), 
			array(
				'id'       => 'soc_icon_facebook',
				'type'     => 'switch',
				'title'    => esc_html__( 'Facebook Share On/Off', 'iguru' ),
				'default'  => false,
				'required' => [ 'show_soc_icon_page', '=', '1' ],
			),
			array(
				'id'       => 'soc_icon_twitter',
				'type'     => 'switch',
				'title'    => esc_html__( 'Twitter Share On/Off', 'iguru' ),
				'default'  => false,
				'required' => [ 'show_soc_icon_page', '=', '1' ],
			),
			array(
				'id'       => 'soc_icon_linkedin',
				'type'     => 'switch',
				'title'    => esc_html__( 'Linkedin Share On/Off', 'iguru' ),
				'default'  => false,
				'required' => [ 'show_soc_icon_page', '=', '1' ],
			),
			array(
				'id'       => 'soc_icon_pinterest',
				'type'     => 'switch',
				'title'    => esc_html__( 'Pinterest Share On/Off', 'iguru' ),
				'default'  => false,
				'required' => [ 'show_soc_icon_page', '=', '1' ],
			), 
			array(
				'id'       => 'soc_icon_tumblr',
				'type'     => 'switch',
				'title'    => esc_html__( 'Tumblr Share On/Off', 'iguru' ),
				'default'  => false,
				'required' => [ 'show_soc_icon_page', '=', '1' ],
			),
		)
	]
);

// -> START Styling Options
Redux::setSection(
	$theme_slug,
	[
		'title'  => esc_html__( 'Color Options', 'iguru' ),
		'id'     => 'color_options_color',
		'icon'   => 'el-icon-tint',
		'fields' => [
			[
				'id'        => 'theme-custom-color',
				'type'      => 'color',
				'title'     => esc_html__( 'Prime Theme Color', 'iguru' ),
				'transparent' => false,
				'default'   => '#00bda6',
				'validate'  => 'color',
			], [
				'id'        => 'theme-secondary-color',
				'type'      => 'color',
				'title'     => esc_html__( 'Secondary Theme Color', 'iguru' ),
				'transparent' => false,
				'default'   => '#ff6d34',
				'validate'  => 'color',
			], [
				'id'        => 'body-background-color',
				'type'      => 'color',
				'title'     => esc_html__( 'Body Background Color', 'iguru' ),
				'transparent' => false,
				'default'   => '#ffffff',
				'validate'  => 'color',
			], 
		]
	]
);

// -> Start Typography config
Redux::setSection(
	$theme_slug,
	[
		'title' => esc_html__( 'Typography', 'iguru' ),
		'id'    => 'Typography',
		'icon'  => 'el-icon-font',
	]
);

$typography = [];
$main_typography = [
	[
		'id'          => 'main-font',
		'title'       => esc_html__( 'Content Font', 'iguru' ),
		'color'       => true,
		'line-height' => true,
		'font-size'   => true,
		'subsets'     => false,
		'all_styles'  => true,
		'font-weight-multi' => true,
		'defs' => [
			'font-size'   => '16px',
			'line-height' => '30px',
			'color'       => '#5f5f5f',
			'font-family' => 'Open Sans',
			'font-weight' => '400',
			'font-weight-multi' => '600',
		],
	],
	[
		'id'          => 'header-font',
		'title'       => esc_html__( 'Headings Main Settings', 'iguru' ),
		'font-size'   => false,
		'line-height' => false,
		'color'       => true,
		'subsets'     => false,
		'all_styles'  => true,
		'font-weight-multi' => true,
		'defs' => [
			'google'      => true,
			'font-family' => 'Muli',
			'font-weight' => '900',
			'font-weight-multi' => '700,800',
			'color'       => '#2c2c2c',
		],
	],
	[
		'id'          => 'secondary-font',
		'title'       => esc_html__( 'Additional Font', 'iguru' ),
		'font-size'   => false,
		'line-height' => false,
		'color'       => false,
		'subsets'     => false,
		'all_styles'  => true,
		'font-weight-multi' => true,
		'defs'        => [
			'google'      => true,
			'font-family' => 'Quicksand',
			'font-weight' => '500',
			'font-weight-multi' => '700',
		],
	],
];
foreach ($main_typography as $key => $value) {
	array_push(
		$typography,
		[
			'id' => $value['id'],
			'type' => 'custom_typography',
			'title' => $value['title'], 
			'color' => $value['color'],
			'line-height' => $value['line-height'],
			'font-size' => $value['font-size'],
			'subsets' => $value['subsets'],
			'all_styles'  => $value['all_styles'],
			'font-weight-multi' => isset($value['font-weight-multi']) ? $value['font-weight-multi'] : '',
			'subtitle' => isset($value['subtitle']) ? $value['subtitle'] : '',
			'google' => true,
			'font-style'  => true,
			'font-backup' => false,
			'text-align'  => false,
			'default' => $value['defs'],
		]
	);
}
Redux::setSection(
	$theme_slug,
	[
		'title' => esc_html__( 'Main Content', 'iguru' ),
		'id' => 'main_typography',
		'subsection' => true,
		'fields' => $typography
	]
);

// -> Start menu typography
$menu_typography = [
	[
		'id'          => 'menu-font',
		'title'       => esc_html__( 'Menu Font', 'iguru' ),
		'color'       => false,
		'line-height' => true,
		'font-size'   => true,
		'subsets'     => true,
		'defs' => [
			'font-family' => 'Muli',
			'google'      => true,
			'font-size'   => '16px',
			'font-weight' => '700',
			'line-height' => '30px'
		],
	], [
		'id'          => 'sub-menu-font',
		'title'       => esc_html__( 'Submenu Font', 'iguru' ),
		'color'       => false,
		'line-height' => true,
		'font-size'   => true,
		'subsets'     => true,
		'defs' => [
			'font-family' => 'Muli',
			'google'      => true,
			'font-size'   => '16px',
			'font-weight' => '600',
			'line-height' => '30px'
		],
	],
];
$menu_typography_array = [];
foreach ($menu_typography as $key => $value) {
	array_push(
		$menu_typography_array,
		[
			'id'          => $value['id'],
			'type'        => 'custom_typography',
			'title'       => $value['title'],
			'color'       => $value['color'],
			'line-height' => $value['line-height'],
			'font-size'   => $value['font-size'],
			'subsets'     => $value['subsets'],
			'google'      => true,
			'font-style'  => true,
			'font-backup' => false,
			'text-align'  => false,
			'all_styles'  => false,
			'default'     => $value['defs'],
		]
	);
}
Redux::setSection(
	$theme_slug,
	[
		'title'      => esc_html__( 'Menu', 'iguru' ),
		'id'         => 'main_menu_typography',
		'subsection' => true,
		'fields'     => $menu_typography_array
	]
);
// End menu Typography

// -> Start headings typography
$headings = [
	[
		'id'    => 'header-h1',
		'title' => esc_html__( 'H1', 'iguru' ),
		'defs'  => [
			'font-family' => 'Muli',
			'font-size'   => '48px',
			'line-height' => '60px', 
			'font-weight' => '900',
		],
	],
	[
		'id' => 'header-h2',
		'title' => esc_html__( 'H2', 'iguru' ),
		'defs' => [
			'font-family' => 'Muli',
			'font-size'   => '42px',
			'line-height' => '52px',
			'font-weight' => '900',
		],
	],
	[
		'id' => 'header-h3',
		'title' => esc_html__( 'H3', 'iguru' ),
		'defs' => [
			'font-family' => 'Muli',
			'font-size'   => '36px',
			'line-height' => '48px',
			'font-weight' => '900',
		],
	],
	[
		'id' => 'header-h4',
		'title' => esc_html__( 'H4', 'iguru' ),
		'defs' => [
			'font-family' => 'Muli',
			'font-size'   => '30px',
			'line-height' => '40px',
			'font-weight' => '900',
		],
	],
	[
		'id' => 'header-h5',
		'title' => esc_html__( 'H5', 'iguru' ),
		'defs' => [
			'font-family' => 'Muli',
			'font-size'   => '24px',
			'line-height' => '30px',
			'font-weight' => '900'
		],
	],
	[
		'id' => 'header-h6',
		'title' => esc_html__( 'H6', 'iguru' ),
		'defs' => [
			'font-family' => 'Muli',
			'font-size'   => '18px',
			'line-height' => '22px',
			'font-weight' => '900',
		],
	],
];
$headings_array = [];
foreach ($headings as $key => $heading) {
	array_push(
		$headings_array,
		[
			'id' => $heading['id'],
			'type' => 'custom_typography',
			'title' => $heading['title'],
			'google' => true,
			'font-backup' => false,
			'font-size' => true,
			'line-height' => true,
			'color' => false,
			'word-spacing' => false,
			'letter-spacing' => true,
			'text-align' => false,
			'text-transform' => true,
			'default' => $heading['defs'],
		]
	);
}

// Typogrophy section
Redux::setSection(
	$theme_slug,
	[
		'title'      => esc_html__( 'Headings', 'iguru' ),
		'id'         => 'main_headings_typography',
		'subsection' => true,
		'fields'     => $headings_array
	]
);
// End Typography config

if ( class_exists( 'WooCommerce' ) )  {
	Redux::setSection(
		$theme_slug,
		[
			'title'   => esc_html__( 'Shop', 'iguru' ),
			'id'      => 'shop-option',
			'icon'    => 'el-icon-shopping-cart',
			'fields'  => array(
			)
		]
	);
	Redux::setSection(
		$theme_slug,
		array(
			'title'            => esc_html__( 'Catalog', 'iguru' ),
			'id'               => 'shop-catalog-option',
			'subsection'       => true,
			'fields'           => array(
				array(
					'id'       => 'shop_catalog_page_title_bg_image',
					'type'     => 'background',
					'preview'  => false,
					'preview_media' => true,
					'background-color' => false,
					'title'    => esc_html__( 'Catalog Page Title Background Image', 'iguru' ),
					'default'  => [
						'background-repeat'     => 'repeat',
						'background-size'       => 'cover',
						'background-attachment' => 'scroll',
						'background-position'   => 'center center',
						'background-color'      => '#103f40',
					],
				), 
				array(
					'id'       => 'shop_catalog_sidebar_layout',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Shop Catalog Sidebar Layout', 'iguru' ),
					'options'  => [
						'none' => [
							'alt' => 'None',
							'img' => get_template_directory_uri() . '/core/admin/img/options/1col.png'
						],
						'left' => [
							'alt' => 'Left',
							'img' => get_template_directory_uri() . '/core/admin/img/options/2cl.png'
						],
						'right' => [
							'alt' => 'Right',
							'img' => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
						],
					],
					'default'  => 'left'
				),
				array(
					'id'       => 'shop_catalog_sidebar_def',
					'type'     => 'select',
					'title'    => esc_html__( 'Shop Catalog Sidebar', 'iguru' ),
					'data'     => 'sidebars',
					'required' => [ 'shop_catalog_sidebar_layout', '!=', 'none' ],
				), 
				array(
					'id'       => 'shop_catalog_sidebar_def_width',
					'type'     => 'button_set',
					'title'    => esc_html__( 'Shop Sidebar Width', 'iguru' ),
					'options'  => [
						'9' => '25%',
						'8' => '33%',
					],
					'default'  => '9',
					'required' => [ 'shop_catalog_sidebar_layout', '!=', 'none' ],
				), 
				array(
					'id'       => 'shop_sidebar_sticky',
					'type'     => 'switch',
					'title'    => esc_html__( 'Sticky Sidebar On?', 'iguru' ),
					'default'  => false,
					'required' => [ 'shop_catalog_sidebar_layout', '!=', 'none' ],
				),
				array(
					'id'       => 'shop_sidebar_gap',
					'type'     => 'select',
					'title'    => esc_html__( 'Sidebar Side Gap', 'iguru' ),
					'options'  => array(
						'def' => esc_html__( 'Default', 'iguru' ),
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
					'default'  => 'def',
					'required' => [ 'shop_catalog_sidebar_layout', '!=', 'none' ],
				),
				array(
					'id'       => 'shop_layout',
					'type'     => 'button_set',
					'title'    => esc_html__( 'Shop Layout', 'iguru' ),
					'options'  => array(
						'grid' => esc_html__( 'Grid', 'iguru' ),
						'list' => esc_html__( 'List', 'iguru' ),
					),
					'default'  => 'grid',
				),
				array(
					'id'       => 'shop_column',
					'type'     => 'button_set',
					'title'    => esc_html__( 'Shop Column', 'iguru' ),
					'options'  => array(
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4'
					),
					'default'  => '3',
					'required' => [ 'shop_layout', '=', 'grid' ],
				),
				array(
					'id'       => 'shop_products_per_page',
					'type'     => 'spinner',
					'title'    => esc_html__('Products per page', 'iguru'),
					'default'  => '12',
					'min'      => '1',
					'step'     => '1',
					'max'      => '100',
				),
				array(
					'id'       => 'use_animation_shop',
					'type'     => 'switch',
					'title'    => esc_html__( 'Use Animation Shop?', 'iguru' ),
					'default'  => true,
				), 
				array(
					'id'      => 'shop_catalog_animation_style',
					'type'    => 'select',
					'select2' => array('allowClear' => false),
					'title'   => esc_html__( 'Animation Style', 'iguru' ),
					'options' => array(
						'fade-in'      => esc_html__( 'Fade In', 'iguru'),
						'slide-top'    => esc_html__( 'Slide Top', 'iguru'),
						'slide-bottom' => esc_html__( 'Slide Bottom', 'iguru'),
						'slide-left'   => esc_html__( 'Slide Left', 'iguru'),
						'slide-right'  => esc_html__( 'Slide Right', 'iguru'),
						'zoom'         => esc_html__( 'Zoom', 'iguru'),
					),
					'default'  => 'slide-left',
					'required' => [ 'use_animation_shop', '=', true ],
				),
			)
		)
	);

	Redux::setSection(
		$theme_slug,
		[ 
			'title'      => esc_html__( 'Single', 'iguru' ),
			'id'         => 'shop-single-option',
			'subsection' => true,
			'fields'     => array(
				array(
					'id'       => 'shop_single_post_title-start',
					'type'     => 'section',
					'title'    => esc_html__( 'Post Title Settings', 'iguru' ),
					'indent'   => true,
				),
				array(
					'id'      => 'shop_title_conditional',
					'type'    => 'switch',
					'title'   => esc_html__( 'Use Custom Post Title Text?', 'iguru' ),
					'default' => true,
				),
				array(
					'id'       => 'shop_single_page_title_text',
					'type'     => 'text',
					'title'    => esc_html__( 'Post Title Text', 'iguru' ),
					'default'  => esc_html__( 'Shop Single', 'iguru' ),
					'required' => [ 'shop_title_conditional', '=', true ],
				),
				array(
					'id'      => 'shop_single_title_align',
					'type'    => 'button_set',
					'title'   => esc_html__( 'Title Alignment', 'iguru' ),
					'options' => array(
						'left'   => esc_html__( 'Left', 'iguru' ),
						'center' => esc_html__( 'Center', 'iguru' ),
						'right'  => esc_html__( 'Right', 'iguru' ),
					),
					'default' => 'center',
				),
				array(
					'id'      => 'shop_single_breadcrumbs_align',
					'type'    => 'button_set',
					'title'   => esc_html__( 'Title Breadcrumbs Alignment', 'iguru' ),
					'options' => array(
						'left'   => esc_html__( 'Left', 'iguru' ),
						'center' => esc_html__( 'Center', 'iguru' ),
						'right'  => esc_html__( 'Right', 'iguru' ),
					),
					'default' => 'center',
				),
				array(
					'id'      => 'shop_single_title_bg_switch',
					'type'    => 'switch',
					'title'   => esc_html__( 'Use Color/Image Background?', 'iguru' ),
					'default' => true,
				),
				array(
					'id'      => 'shop_single_page_title_bg_image',
					'type'    => 'background',
					'title'   => esc_html__( 'Background', 'iguru' ),
					'preview' => false,
					'preview_media' => true,
					'background-color' => true,
					'transparent' => false,
					'default' => [
						'background-repeat'     => 'repeat',
						'background-size'       => 'cover',
						'background-attachment' => 'scroll',
						'background-position'   => 'center center',
						'background-color'      => '#103f40',
					],
					'required' => [ 'shop_single_title_bg_switch', '=', true ],
				),
				array(
					'id'      => 'shop_single_page_title_padding',
					'type'    => 'spacing',
					'title'   => esc_html__( 'Paddings Top/Bottom', 'iguru' ),
					'mode'    => 'padding',
					'all'     => false,
					'bottom'  => true,
					'top'     => true,
					'left'    => false,
					'right'   => false,
					'default' => [
						'padding-top'    => '82',
						'padding-bottom' => '72',
					],
				),
				array(
					'id'      => 'shop_single_page_title_margin',
					'type'    => 'spacing',
					'title'   => esc_html__( 'Margin Bottom', 'iguru' ),
					'mode'    => 'margin',
					'all'     => false,
					'bottom'  => true,
					'top'     => false,
					'left'    => false,
					'right'   => false,
					'default' => [ 'margin-bottom' => '50' ],
				),
				array(
					'id'     => 'shop_single_post_title-end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'      => 'shop_single_image_layout',
					'type'    => 'image_select',
					'title'   => esc_html__( 'Select Single Product Layout', 'iguru' ),
					'options' => array( 
						'default' => array(
							'title' => esc_html__('Default', 'iguru'),
							'alt' => 'Default',
							'img' => get_template_directory_uri() . '/core/admin/img/options/1col.png'
						),
						'sticky_layout' => array(
							'title' => esc_html__('Sticky Image', 'iguru'),
							'alt'   => '1',
							'img'   => get_template_directory_uri() . '/core/admin/img/options/2cl.png'
						),
						'image_gallery' => array(
							'title' => esc_html__('Image Gallery', 'iguru'),
							'alt'   => '2',
							'img'   => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
						), 
						'full_width_image_gallery' => array(
							'title' => esc_html__('Full Width Image Gallery', 'iguru'),
							'alt'   => '3',
							'img'   => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
						),
						'with_background' => array(
							'title' => esc_html__('With Background', 'iguru'),
							'alt'   => '4',
							'img'   => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
						), 
					),
					'default'  => 'default'
				),
				array(
					'id'       => 'shop_single_sidebar-start',
					'type'     => 'section',
					'title'    => esc_html__( 'Sidebar Settings', 'iguru' ),
					'indent'   => true,
				),
				array(
					'id'       => 'shop_single_sidebar_layout',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Sidebar Layout', 'iguru' ),
					'options'  => array(
						'none' => array(
							'alt' => 'None',
							'img' => get_template_directory_uri() . '/core/admin/img/options/1col.png'
						),
						'left' => array(
							'alt' => 'Left',
							'img' => get_template_directory_uri() . '/core/admin/img/options/2cl.png'
						),
						'right' => array(
							'alt' => 'Right',
							'img' => get_template_directory_uri() . '/core/admin/img/options/2cr.png'
						)
					),
					'default'  => 'none',
					'required' => array(
						array('shop_single_image_layout','!=','with_background'),
						array('shop_single_image_layout','!=','full_width_image_gallery')
					)
				),
				array(
					'id'       => 'shop_single_sidebar_def_width',
					'type'     => 'button_set',
					'title'    => esc_html__( 'Sidebar Width', 'iguru' ),
					'options'  => array(
						'9' => '25%',
						'8' => '33%',
					),
					'default'  => '9',
					'required' => [ 'shop_single_sidebar_layout', '!=', 'none' ],
				),
				array(
					'id'       => 'shop_single_sidebar_def',
					'type'     => 'select',
					'title'    => esc_html__( 'Sidebar Template', 'iguru' ),
					'data'     => 'sidebars',
					'required' => [ 'shop_single_sidebar_layout', '!=', 'none' ],
				), 
				array(
					'id'       => 'shop_single_sidebar_sticky',
					'type'     => 'switch',
					'title'    => esc_html__( 'Use Sticky Sidebar?', 'iguru' ),
					'default'  => false,
					'required' => [ 'shop_single_sidebar_layout', '!=', 'none' ],
				),
				array(
					'id'      => 'shop_single_sidebar_gap',
					'type'    => 'select',
					'title'   => esc_html__( 'Sidebar Side Gap', 'iguru' ),
					'options' => array(
						'def' => esc_html__( 'Default', 'iguru' ),
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
					'default'  => 'def',
					'required' => [ 'shop_single_sidebar_layout', '!=', 'none' ],
				),
				array(
					'id'     => 'shop_single_sidebar-end',
					'type'   => 'section',
					'indent' => false,
				),
				array(
					'id'       => 'shop_layout_with_background',
					'type'     => 'color_rgba',
					'title'    => esc_html__( 'Background', 'iguru' ),
					'default'  => array(
						'color' => '#f3f3f3',
						'alpha' => '1',
						'rgba'  => 'rgba(243,243,243,1)'
					),
					'mode'     => 'background',
					'required' => [ 'shop_single_image_layout', '=', 'with_background' ],
				),
				array(
					'id'       => 'shop_single_share',
					'type'     => 'switch',
					'title'    => esc_html__( 'Shares On/Off', 'iguru' ),
					'default'  => false,
				),
			)
		]
	);

	Redux::setSection(
		$theme_slug,
		[
			'title'      => esc_html__( 'Related', 'iguru' ),
			'id'         => 'shop-related-option',
			'subsection' => true,   
			'fields'     => [
				[
					'id'       => 'shop_related_columns',
					'type'     => 'button_set',
					'title'    => esc_html__( 'Related products column', 'iguru' ),
					'options'  => [
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4'
					],
					'default'  => '4',
				],
				[
					'id'       => 'shop_r_products_per_page',
					'type'     => 'spinner',
					'title'    => esc_html__( 'Related products per page', 'iguru'),
					'default'  => '4',
					'min'      => '1',
					'step'     => '1',
					'max'      => '100',
				],
			]
		]
	);
	Redux::setSection(
		$theme_slug,
		[
			'title'      => esc_html__( 'Cart', 'iguru' ),
			'id'         => 'shop-cart-option',
			'subsection' => true,
			'fields'     => array(
				array(
					'id'       => 'shop_cart_page_title_bg_image',
					'type'     => 'background',
					'background-color' => false,
					'preview_media' => true,
					'preview'  => false,
					'title'    => esc_html__( 'Cart Page Title Background Image', 'iguru' ),
					'default'  => [
						'background-repeat'     => 'repeat',
						'background-size'       => 'cover',
						'background-attachment' => 'scroll',
						'background-position'   => 'center center',
						'background-color'      => '#103f40',
					],
				),
			)
		]
	);
	Redux::setSection(
		$theme_slug,
		[
			'title'            => esc_html__( 'Checkout', 'iguru' ),
			'id'               => 'shop-checkout-option',
			'subsection'       => true,
			'fields'           => array(
				array(
					'id'       => 'shop_checkout_page_title_bg_image',
					'type'     => 'background',
					'background-color' => false,
					'preview_media' => true,
					'preview'  => false,
					'title'    => esc_html__( 'Checkout Page Title Background Image', 'iguru' ),
					'default'  => [
						'background-repeat'     => 'repeat',
						'background-size'       => 'cover',
						'background-attachment' => 'scroll',
						'background-position'   => 'center center',
						'background-color'      => '#103f40',
					],
				), 
			)
		]
	);
}