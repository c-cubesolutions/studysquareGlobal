<?php

$theme_color_secondary = esc_attr(iGuru_Theme_Helper::get_option('theme-secondary-color'));
$header_font_color = esc_attr(iGuru_Theme_Helper::get_option('header-font')['color']);

$defaults = array(
    'values' => '',
    'menu_alignment' => 'left',
    'menu_size' => '16',
    'menu_color' => $header_font_color,
    'menu_hover_color' => $theme_color_secondary,
    'add_menu_divider' => false,
    'extra_class' => '',
);
$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

$content = '';

$menu_module_id = uniqid('wgl-menu-module_');
$menu_module_attr = ' id='.$menu_module_id;

ob_start();
	echo "#$menu_module_id a.wgl-menu-module_link {
			  color: ".(!empty($menu_color) ? esc_attr($menu_color) : $header_font_color).";
			  font-size: ".(!empty($menu_size) ? esc_attr((int)$menu_size)."px" : "").";
		  }";
	echo "#$menu_module_id a.wgl-menu-module_link:hover {
			  color: ".(!empty($menu_hover_color) ? esc_attr($menu_hover_color) : $theme_color).";
		  }";
	echo "#$menu_module_id a:before {
			  background-color: ".(!empty($menu_hover_color) ? esc_attr($menu_hover_color) : $theme_color).";
		  }";
$styles = ob_get_clean();
iGuru_shortcode_css()->enqueue_iguru_css($styles);

$menu_alignment = 'a' . $menu_alignment;

$divider = (bool)$add_menu_divider ? 'class=wgl-menu-module_link-wrapper' : '';

// Animation
$animation_class = !empty($atts['css_animation']) ? $this->getCSSAnimation($atts['css_animation']) : '';

$values = (array)vc_param_group_parse_atts($values);
$item_data = array();
foreach ( $values as $data ) {
	$data['menu_item'] = isset( $data['menu_item'] ) ? $data['menu_item'] : '';
	$data['link'] = isset( $data['link'] ) ? $data['link'] : '';

	// Link attributes
	$link_temp = vc_build_link($data['link']);
	$url = $link_temp['url'];
	$link_title = $link_temp['title'];
	$target = $link_temp['target'];

	$content .= '<div ';
	$content .= esc_attr($divider);
	$content .= '>';
	$content .= '<a href="';
	$content .= !empty($url) ? esc_url($url).'"' : '#"';
	$content .= !empty($link_title) ? " title='".esc_attr($link_title)."'" : '';
	$content .= !empty($target) ? ' target="'.esc_attr($target).'"' : '';

	$content .= ' class="wgl-menu-module_link"';
	$content .= '>' . esc_html($data['menu_item']) . '</a></div>';
}

$output = '<div '.esc_attr($menu_module_attr).' class="wgl-menu-module ' . esc_attr($menu_alignment) . '">';
	$output .= $content;
$output .= '</div>';

echo iGuru_Theme_Helper::render_html($output);