<?php 

// Class Theme Helper
require_once ( get_template_directory() . '/core/class/theme-helper.php' );

// Class Theme Cache
require_once ( get_template_directory() . '/core/class/theme-cache.php' );

// Class Walker comments
require_once ( get_template_directory() . '/core/class/walker-comment.php' );

// Class Walker Mega Menu
require_once ( get_template_directory() . '/core/class/walker-mega-menu.php' );

// Class Theme Likes
require_once ( get_template_directory() . '/core/class/theme-likes.php' );

// Class Theme Cats Meta
require_once ( get_template_directory() . '/core/class/theme-cat-meta.php' );

// Class Single Post
require_once ( get_template_directory() . '/core/class/single-post.php' );

// Class Theme Autoload
require_once ( get_template_directory() . '/core/class/theme-autoload.php' );

// Class Theme Dashboard
require_once ( get_template_directory() . '/core/class/theme-panel.php' );

// Class Theme Verify
require_once ( get_template_directory() . '/core/class/theme-verify.php' );

// Class Tinymce
require_once(get_template_directory() . "/core/class/tinymce-icon.php");

function iguru_editor() {

    /* This theme styles the visual editor with editor-style.css to match the theme style. */
    add_editor_style( 'css/editor-styles.css' );
    add_editor_style('fonts/flaticon/flaticon.css');
    
    add_theme_support( 'editor-styles' );
    
}
add_action( 'after_setup_theme', 'iguru_editor' );

function iguru_content_width() {
    if ( ! isset( $content_width ) ) {
        $content_width = 940;
    }
}
add_action( 'after_setup_theme', 'iguru_content_width', 0 );

function iguru_theme_slug_setup() {
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'iguru_theme_slug_setup');

require_once(get_template_directory() . '/wpb/wpb-init.php');


add_action('init', 'iguru_page_init');
if (!function_exists('iguru_page_init')) {
    function iguru_page_init()
    {
        add_post_type_support('page', 'excerpt');
    }
}

if (!function_exists('iguru_main_menu')) {
    function iguru_main_menu ($location = '') {
        wp_nav_menu(
            [
                'theme_location' => 'main_menu',
                'menu'  => $location,
                'container' => '',
                'container_class' => '',  
                'after' => '',
                'link_before' => '<span>',
                'link_after' => '</span>',
                'walker' => new iGuru_Mega_Menu_Waker()
            ]
        );
    }
}

// return all sidebars
if (!function_exists('iguru_get_all_sidebar')) {
    function iguru_get_all_sidebar() {
        global $wp_registered_sidebars;
        $out = array();
        if ( empty( $wp_registered_sidebars ) )
            return;
         foreach ( $wp_registered_sidebars as $sidebar_id => $sidebar) :
            $out[$sidebar_id] = $sidebar['name'];
         endforeach; 
         return $out;
    }
}

if (!function_exists('iguru_get_custom_preset')) {
    function iguru_get_custom_preset() {
        $custom_preset = get_option('iguru_set_preset');
        $presets =  iguru_default_preset();
        
        $out = [];
        $out['default'] = esc_html__( 'Default', 'iguru' );
        $i = 1;
        if (is_array($presets)) {
            foreach ($presets as $key => $value) {
                $out[$key] = $key;
                $i++;
            }            
        }
        if (is_array($custom_preset)) {
            foreach ( $custom_preset as $preset_id => $preset) :
                $out[$preset_id] = $preset_id;
            endforeach;             
        }
        return $out;
    }
}

if (!function_exists('iguru_get_custom_menu')) {
    function iguru_get_custom_menu() {
        $taxonomies = array();

        $menus = get_terms('nav_menu');
        foreach ($menus as $key => $value) {
            $taxonomies[$value->name] = $value->name;
        }
        return $taxonomies;   
    }
}

function iguru_get_attachment( $attachment_id ) {
    $attachment = get_post( $attachment_id );
    return [
        'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
        'caption' => $attachment->post_excerpt,
        'description' => $attachment->post_content,
        'href' => get_permalink( $attachment->ID ),
        'src' => $attachment->guid,
        'title' => $attachment->post_title
    ];
}

if (!function_exists('iguru_reorder_comment_fields')) {
    function iguru_reorder_comment_fields($fields ) {
        $new_fields = array();

        $myorder = array('author', 'email', 'url', 'comment');

        foreach( $myorder as $key ){
            $new_fields[ $key ] = isset($fields[ $key ]) ? $fields[ $key ] : '';
            unset( $fields[ $key ] );
        }

        if ( $fields ) foreach ( $fields as $key => $val ) {
            $new_fields[ $key ] = $val;
        }
        

        return $new_fields;
    }
}
add_filter('comment_form_fields', 'iguru_reorder_comment_fields');

function iguru_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
add_filter( 'mce_buttons_2', 'iguru_mce_buttons_2' );


function iguru_tiny_mce_before_init( $settings ) {

    $settings['theme_advanced_blockformats'] = 'p,h1,h2,h3,h4';
    $style_formats = [
        [
            'title' => esc_html__( 'Dropcap', 'iguru' ),
            'items' => [
                [
                    'title' => esc_html__( 'On prime color', 'iguru' ),
                    'inline' => 'span',
                    'classes' => 'dropcap-bg',
                ], [
                    'title' => esc_html__( 'On secondary color', 'iguru' ),
                    'inline' => 'span',
                    'classes' => 'dropcap-bg secondary',
                ],
            ],
        ],
        [
            'title' => esc_html__( 'Highlighter', 'iguru' ),
            'items' => [
                [
                    'title' => esc_html__( 'On prime color', 'iguru' ),
                    'inline' => 'span',
                    'classes' => 'highlighter',
                ], [
                    'title' => esc_html__( 'On secondary color', 'iguru' ),
                    'inline' => 'span',
                    'classes' => 'highlighter secondary',
                ],
            ],
        ],
        [
            'title' => esc_html__( 'Font Weight', 'iguru' ), 
            'items' => [
                [
                    'title' => esc_html__( 'Default', 'iguru' ),
                    'inline' => 'span',
                    'classes' => '',
                    'styles' => [ 'font-weight' => 'inherit' ],
                ], [
                    'title' => esc_html__( 'Lightest (100)', 'iguru' ),
                    'inline' => 'span',
                    'classes' => '',
                    'styles' => [ 'font-weight' => '100' ],
                ], [
                    'title' => esc_html__( 'Lighter (200)', 'iguru' ),
                    'inline' => 'span',
                    'classes' => '',
                    'styles' => [ 'font-weight' => '200' ],
                ], [
                    'title' => esc_html__( 'Light (300)', 'iguru' ),
                    'inline' => 'span',
                    'classes' => '',
                    'styles' => [ 'font-weight' => '300' ],
                ], [
                    'title' => esc_html__( 'Normal (400)', 'iguru' ),
                    'inline' => 'span',
                    'classes' => '',
                    'styles' => [ 'font-weight' => '400' ],
                ], [
                    'title' => esc_html__( 'Medium (500)', 'iguru' ),
                    'inline' => 'span',
                    'classes' => '',
                    'styles' => [ 'font-weight' => '500' ],
                ], [
                    'title' => esc_html__( 'Semi-Bold (600)', 'iguru' ),
                    'inline' => 'span',
                    'classes' => '',
                    'styles' => [ 'font-weight' => '600' ],
                ], [
                    'title' => esc_html__( 'Bold (700)', 'iguru' ),
                    'inline' => 'span',
                    'classes' => '',
                    'styles' => [ 'font-weight' => '700' ],
                ], [
                    'title' => esc_html__( 'Bolder (800)', 'iguru' ),
                    'inline' => 'span',
                    'classes' => '',
                    'styles' => [ 'font-weight' => '800' ],
                ], [
                    'title' => esc_html__( 'Extra Bold (900)', 'iguru' ),
                    'inline' => 'span',
                    'classes' => '',
                    'styles' => [ 'font-weight' => '900' ],
                ],
            ]
        ],
        [
            'title' => esc_html__( 'List Style', 'iguru' ),
            'items' => [
                [
                    'title' => esc_html__( 'Dot, prime color', 'iguru' ),
                    'selector' => 'ul',
                    'classes' => 'iguru_dot',
                ], [
                    'title' => esc_html__( 'Dot, secondary color', 'iguru' ),
                    'selector' => 'ul',
                    'classes' => 'iguru_dot secondary',
                ], [
                    'title' => esc_html__( 'Check, prime color', 'iguru' ),
                    'selector' => 'ul',
                    'classes' => 'iguru_check',
                ], [
                    'title' => esc_html__( 'Check, secondary color', 'iguru' ),
                    'selector' => 'ul',
                    'classes' => 'iguru_check secondary',
                ], [
                    'title' => esc_html__( 'Plus, prime color', 'iguru' ),
                    'selector' => 'ul',
                    'classes' => 'iguru_plus',
                ], [
                    'title' => esc_html__( 'Plus, secondary color', 'iguru' ),
                    'selector' => 'ul',
                    'classes' => 'iguru_plus secondary',
                ], [
                    'title' => esc_html__( 'Dash', 'iguru' ),
                    'selector' => 'ul',
                    'classes' => 'iguru_dash',
                ], [
                    'title' => esc_html__( 'No List Style', 'iguru' ),
                    'selector' => 'ul',
                    'classes' => 'no-list-style',
                ],
            ]
        ],
    ];

    $settings['style_formats'] = str_replace( '"', "'", json_encode( $style_formats ) );
    $settings['extended_valid_elements'] = 'span[*],a[*],i[*]';
    return $settings;
}
add_filter( 'tiny_mce_before_init', 'iguru_tiny_mce_before_init' );

function iguru_theme_add_editor_styles() {
    add_editor_style( 'css/font-awesome.min.css' );
}
add_action( 'current_screen', 'iguru_theme_add_editor_styles' );

function iguru_categories_postcount_filter ($variable) {
    if (strpos($variable,'</a> (')) {
        $variable = str_replace('</a> (', '<span class="post_count">', $variable);
        $variable = str_replace(')', '</span></a>', $variable);
    } else {
        $variable = str_replace('</a> <span class="count">(', '</a><span class="post_count">(', $variable);
    }

    $pattern1 = '/cat-item-\d+/';
    preg_match_all( $pattern1, $variable, $matches );
    if ( isset($matches[0]) ) {
        foreach ($matches[0] as $key => $value) {
            $int = (int) str_replace('cat-item-','', $value);
            $icon_image_id = get_term_meta ( $int, 'category-icon-image-id', true );
            if ( !empty($icon_image_id) ) {
                $icon_image = wp_get_attachment_image_src ( $icon_image_id, 'full' );
                $icon_image_alt = get_post_meta($icon_image_id, '_wp_attachment_image_alt', true);
                $replacement = '$1<span><img class="cats_item-image" src="'. esc_url($icon_image[0]) .'" alt="'.(!empty($icon_image_alt) ? esc_attr($icon_image_alt) : '').'"/>';
                $pattern = '/(cat-item-'.$int.'+.*?><a.*?>)/';
                $variable = preg_replace( $pattern, $replacement, $variable );
            }
        }
    }
    return $variable;
}
add_filter( 'wp_list_categories', 'iguru_categories_postcount_filter' );

add_filter( 'get_archives_link', 'iguru_render_archive_widgets', 10, 6 );
function iguru_render_archive_widgets ( $link_html, $url, $text, $format, $before, $after ) {

    $text = wptexturize( $text );
    $url  = esc_url( $url );

    if ( 'link' == $format ) {
        $link_html = "\t<link rel='archives' title='" . esc_attr( $text ) . "' href='$url' />\n";
    } elseif ( 'option' == $format ) {
        $link_html = "\t<option value='$url'>$before $text $after</option>\n";
    } elseif ( 'html' == $format ) {
        $after = str_replace('(', '', $after);
        $after = str_replace(' ', '', $after);
        $after = str_replace('&nbsp;', '', $after);
        $after = str_replace(')', '', $after);
        $after = !empty($after) ? "<span class='post_count'>".esc_html($after)."</span>" : "";

        $text = !empty($after) ? '<span class="archived_period">'.esc_html($text).'</span>' : esc_html($text);
        $class = !empty($after) ? ' class="archive_counted"' : '';

        $link_html = '<li>'.esc_html($before).'<a href="'.esc_url($url).'"'.$class.'>'. $text . $after .'</a></li>';
    } else { // custom
        $link_html = "\t$before<a href='$url'>$text</a>$after\n";
    }
    
    return $link_html;
}

// Add image size
if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'iguru-700-700', 700, 570, true );
    add_image_size( 'iguru-440-440', 440, 440, true );
    add_image_size( 'iguru-220-180', 220, 180, true );
    add_image_size( 'iguru-120-120', 120, 120, true );
}

// Include Woocommerce init if plugin is active
if ( class_exists( 'WooCommerce' ) ) {
    require_once( get_template_directory() . '/woocommerce/woocommerce-init.php' ); 
}

// Include LearPress init if plugin is active
if ( class_exists( 'LearnPress' ) ) {
    require_once( get_template_directory() . '/learnpress/learnpress-init.php' ); 
}

add_filter('vc_css_editor_border_radius_options_data','iguru_border_radius_options');

function iguru_border_radius_options() {
    $output = [
        '' => esc_html__( 'None', 'iguru' ),
        '1px' => esc_html__( '1px', 'iguru' ),
        '2px' => esc_html__( '2px', 'iguru' ),
        '3px' => esc_html__( '3px', 'iguru' ),
        '4px' => esc_html__( '4px', 'iguru' ),
        '5px' => esc_html__( '5px', 'iguru' ),
        '10px' => esc_html__( '10px', 'iguru' ),
        '15px' => esc_html__( '15px', 'iguru' ),
        '20px' => esc_html__( '20px', 'iguru' ),
        '25px' => esc_html__( '25px', 'iguru' ),
        '30px' => esc_html__( '30px', 'iguru' ),
        '35px' => esc_html__( '35px', 'iguru' ),
        '50%' => esc_html__( '50%', 'iguru' ),
    ];
    return $output;
}

add_filter('iguru_enqueue_shortcode_css', 'iguru_render_css');
function iguru_render_css($styles) {
    global $iguru_dynamic_css;
    if ( ! isset($iguru_dynamic_css['style']) ) {
        $iguru_dynamic_css = [];
        $iguru_dynamic_css['style'] = $styles;
    } else {
        $iguru_dynamic_css['style'] .= $styles;
    }
}