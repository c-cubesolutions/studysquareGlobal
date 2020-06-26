<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$theme_color = esc_attr(iGuru_Theme_Helper::get_option("theme-custom-color"));

$cats = get_terms( 'category' ); 
foreach ( $cats as $cat ) {
    $args = array(
        'separator' => ' > ',
        'format'    => 'name',          
    );
    $parent = iGuru_Loop_Settings::get_term_parents_list( $cat->term_id, $cat->taxonomy, $args);
    $label = $cat->name .(!empty($parent) ? esc_html__(' (Parent categories: (', 'iguru') .$parent.'))' : "");
    $cats_value[$label] = $cat->slug;
}

if (function_exists('vc_map')) {
    vc_map(array(
        'name' => esc_html__('Blog Categories', 'iguru'),
        'base' => 'wgl_blog_categories',
        'class' => 'iguru_blog_categories',
        'category' => esc_html__('WGL Modules', 'iguru'),
        'icon' => 'wgl_icon_blog_categories',
        'content_element' => true,
        'description' => esc_html__('Display Blog Categories','iguru'),
        'params' => array(
            array(
                "type"          => "dropdown_multi",
                "heading"       => esc_html__( 'Clients Grid', 'iguru' ),
                "param_name"    => "select_cats",
                "value"         => isset($cats_value) ? $cats_value : '',
                'edit_field_class' => 'vc_col-sm-12',
                'std' => '4'        
            ),
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__( 'Clients Grid', 'iguru' ),
                "param_name"    => "item_grid",
                "value"         => array(
                    esc_html__( 'One Column', 'iguru' )    => '1',
                    esc_html__( 'Two Columns', 'iguru' )   => '2',
                    esc_html__( 'Three Columns', 'iguru' ) => '3',
                    esc_html__( 'Four Columns', 'iguru' )  => '4',
                    esc_html__( 'Five Columns', 'iguru' )  => '5',
                    esc_html__( 'Six Columns', 'iguru' )  => '6',
                ),
                'edit_field_class' => 'vc_col-sm-6',
                'std' => '4'        
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'iguru'),
                'param_name' => 'extra_class',
                'description' => esc_html__('Add an extra class name to the element and refer to it from Custom CSS option.', 'iguru')
            ),
            // carousel heading
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__('Add Carousel for Clients Items', 'iguru'),
                'param_name' => 'h_carousel',
                'group' => esc_html__( 'Carousel', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                "type"          => "wgl_checkbox",
                'heading' => esc_html__( 'Use Carousel', 'iguru' ),
                "param_name"    => "use_carousel",
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Carousel', 'iguru' ),
            ),
            array(
                "type"          => "wgl_checkbox",
                'heading' => esc_html__( 'Autoplay', 'iguru' ),
                "param_name"    => "autoplay",
                "dependency"    => array(
                    "element"   => "use_carousel",
                    "value" => 'true'
                ),
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Carousel', 'iguru' ),
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Autoplay Speed', 'iguru' ),
                "param_name"    => "autoplay_speed",
                "dependency"    => array(
                    "element"   => "autoplay",
                    "value" => 'true'
                ),
                'edit_field_class' => 'vc_col-sm-4',
                "value"         => "3000",
                'group' => esc_html__( 'Carousel', 'iguru' ),
            ),
            // carousel pagination heading
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__('Pagination Controls', 'iguru'),
                'param_name' => 'h_pag_controls',
                'group' => esc_html__( 'Carousel', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12',
                "dependency"    => array(
                    "element"   => "use_carousel",
                    "value" => 'true'
                ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Pagination control', 'iguru' ),
                'param_name' => 'use_pagination',
                'edit_field_class' => 'vc_col-sm-12',
                'group' => esc_html__( 'Carousel', 'iguru' ),
                "dependency"    => array(
                    "element"   => "use_carousel",
                    "value" => 'true'
                ),
            ),
            array(
                'type' => 'iguru_radio_image',
                'heading' => esc_html__('Pagination Type', 'iguru'),
                'param_name' => 'pag_type',
                'fields' => array(
                    'circle' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_circle.png',
                        'label' => esc_html__('Circle', 'iguru')),
                    'circle_border' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_circle_border.png',
                        'label' => esc_html__('Empty Circle', 'iguru')),
                    'square' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_square.png',
                        'label' => esc_html__('Square', 'iguru')),
                    'line' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_line.png',
                        'label' => esc_html__('Line', 'iguru')),
                    'line_circle' => array(
                        'image_url' => get_template_directory_uri() . '/img/wgl_composer_addon/icons/pag_line_circle.png',
                        'label' => esc_html__('Line - Circle', 'iguru')),
                ),
                'group' => esc_html__( 'Carousel', 'iguru' ),
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
                'value' => 'circle',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Pagination Top Offset', 'iguru' ),
                'param_name' => 'pag_offset',
                'value' => '',
                'group' => esc_html__( 'Carousel', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-6',
                'description' => esc_html__( 'Enter pagination top offset in pixels.', 'iguru' ),
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Pagination Aligning', 'iguru'),
                'param_name' => 'pag_align',
                'value' => array(
                    esc_html__('Left', 'iguru') => 'left',
                    esc_html__('Right', 'iguru') => 'right',
                    esc_html__('Center', 'iguru') => 'center',
                ),
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
                'edit_field_class' => 'vc_col-sm-6',
                'std' => 'center',
                'group' => esc_html__( 'Carousel', 'iguru' ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Custom Pagination Color', 'iguru' ),
                'param_name' => 'custom_pag_color',
                'edit_field_class' => 'vc_col-sm-6',
                'group' => esc_html__( 'Carousel', 'iguru' ),
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Pagination Color', 'iguru'),
                'param_name' => 'pag_color',
                'value' => $theme_color,
                'dependency' => array(
                    'element' => 'custom_pag_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            // carousel navigation heading
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__('Navigation Controls', 'iguru'),
                'param_name' => 'h_nav_controls',
                'group' => esc_html__( 'Carousel', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency'    => array(
                    'element'   => 'use_carousel',
                    'value' => 'true'
                ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Add Navigation control', 'iguru' ),
                'param_name' => 'use_prev_next',
                'edit_field_class' => 'vc_col-sm-12',
                'group' => esc_html__( 'Carousel', 'iguru' ),
                'dependency'    => array(
                    'element'   => 'use_carousel',
                    'value' => 'true'
                ),
            ),
            // responsive
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__('Responsive', 'iguru'),
                'param_name' => 'h_resp',
                'group' => esc_html__( 'Carousel', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12',
                "dependency"    => array(
                    "element"   => "use_carousel",
                    "value" => 'true'
                ),
            ),
            array(
                'type' => 'wgl_checkbox',
                'heading' => esc_html__( 'Customize Responsive', 'iguru' ),
                'param_name' => 'custom_resp',
                "dependency"    => array(
                    "element"   => "use_carousel",
                    "value" => 'true'
                ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
                'group' => esc_html__( 'Carousel', 'iguru' ),
            ),
            // medium desktop
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__('Medium Desktop', 'iguru'),
                'param_name' => 'h_resp_medium',
                'group' => esc_html__( 'Carousel', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Screen resolution', 'iguru' ),
                'param_name' => 'resp_medium',
                'value' => '1025',
                'group' => esc_html__( 'Carousel', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'iguru' ),
                'param_name' => 'resp_medium_slides',
                'value' => '',
                'group' => esc_html__( 'Carousel', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            
            // tablets
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__('Tablets', 'iguru'),
                'param_name' => 'h_resp_tablets',
                'group' => esc_html__( 'Carousel', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Screen resolution', 'iguru' ),
                'param_name' => 'resp_tablets',
                'value' => '800',
                'group' => esc_html__( 'Carousel', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'iguru' ),
                'param_name' => 'resp_tablets_slides',
                'value' => '',
                'group' => esc_html__( 'Carousel', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            // mobile phones
            array(
                'type' => 'iguru_param_heading',
                'heading' => esc_html__('Mobile Phones', 'iguru'),
                'param_name' => 'h_resp_mobile',
                'group' => esc_html__( 'Carousel', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Screen resolution', 'iguru' ),
                'param_name' => 'resp_mobile',
                'value' => '480',
                'group' => esc_html__( 'Carousel', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'iguru' ),
                'param_name' => 'resp_mobile_slides',
                'value' => '',
                'group' => esc_html__( 'Carousel', 'iguru' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
        )
    ));

    if (class_exists('WPBakeryShortCode')) {
        class WPBakeryShortCode_wgl_blog_categories extends WPBakeryShortCode {
        }
    }
}
