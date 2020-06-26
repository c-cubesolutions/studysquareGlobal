<?php

$theme_color = esc_attr(iGuru_Theme_Helper::get_option('theme-custom-color'));
$theme_secondary_color = esc_attr(iGuru_Theme_Helper::get_option('theme-secondary-color'));
$header_font_color = esc_attr(iGuru_Theme_Helper::get_option('header-font')['color']);

$defaults = [
	// General
	'title' => '',
	'subtitle' => '',
	'subtitle_img_check' => false,
	'subtitle_img' => '',
	'align' => 'left',
	'extra_class' => '',
	// Title
	'title_tag' => 'span',
	'title_size' => '48px',
	'title_line_height' => '52px',
	'title_weight' => '',
	'custom_title_color' => false,
	'title_color' => $header_font_color,
	'responsive_font' => false,
	'font_size_desktop' => '',
	'font_size_tablet' => '',
	'font_size_mobile' => '',
	'custom_fonts_title' => false,
	// Subtitle
	'subtitle_tag' => 'span',
	'subtitle_size' => '16px',
	'subtitle_line_height' => '20px',
	'subtitle_weight' => '',
	'custom_subtitle_color' => false,
	'subtitle_color' => $header_font_color,
	'custom_fonts_subtitle' => false,
];
$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

$title = $content;
$title_render = $subtitle_render = $image_render = '';

// Allowed HTML render
$allowed_html = [
	'a' => [
		'href' => true,
		'title' => true,
	],
	'br' => [],
	'em' => [],
	'strong' => [],
	'span' => [
		'class' => true,
		'style' => true,
	],
	'p' => [
		'class' => true,
		'style' => true,
	],
];

// Module unique id
$dbl_id = uniqid( "iguru_dlh_" );
$dbl_attr = ' id='.$dbl_id;

// Animation
$animation_class = !empty($atts['css_animation']) ? $this->getCSSAnimation( $atts['css_animation'] ) : '';

// Render Google Fonts
extract( iGuru_GoogleFontsRender::getAttributes( $atts, $this, array('google_fonts_title','google_fonts_subtitle') ) );
$title_font_style = !empty($styles_google_fonts_title) ? esc_attr( $styles_google_fonts_title ) : '';
$subtitle_font_style = !empty($styles_google_fonts_subtitle) ? esc_attr( $styles_google_fonts_subtitle ) : '';

ob_start();
	if ((bool)$custom_subtitle_color)
		echo "#$dbl_id .dlh_subtitle {",
				  'color: ', (!empty($subtitle_color) ? esc_attr($subtitle_color) : 'transparent'), ';',
			  '}';

$styles = ob_get_clean();
iGuru_shortcode_css()->enqueue_iguru_css($styles);

// Wrapper classes
$wrap_classes = ' a'.$align;
$wrap_classes .= ' '.$extra_class;
$wrap_classes .= !empty($animation_class) ? ' '.$animation_class : '';

// Title styles
$title_size_style = !empty($title_size) ? 'font-size: '.esc_attr((int)$title_size).'px; ' : '';
$title_line_height_responsive = !empty($title_line_height) ? round(((int)$title_line_height / (int)$title_size), 3) : '';
$title_line_height_style = !empty($title_line_height_responsive) ? 'line-height:' .esc_attr($title_line_height_responsive).'; ' : '';
$title_weight_style = !empty($title_weight) ? 'font-weight: '.(int)$title_weight.'; ' : '';
$title_color_style = !empty($title_color && (bool)$custom_title_color) ? 'color: '. esc_attr($title_color) . '; ' : '';
$title_styles = $title_size_style.$title_line_height_style.$title_weight_style.$title_color_style.$title_font_style;
$title_styles = !empty($title_styles) ? ' style="'.$title_styles.'"' : '';

// Subtitle styles
$subtitle_size_style = !empty($subtitle_size) ? 'font-size:' .esc_attr((int)$subtitle_size).'px; ' : '';
$subtitle_line_height_style = !empty($subtitle_line_height) ? 'line-height:' .esc_attr((int)$subtitle_line_height).'px; ' : '';
$subtitle_weight_style = !empty($subtitle_weight) ? 'font-weight:' . (int)$subtitle_weight . '; ' : '';
$subtitle_color_style = !empty($subtitle_color && (bool)$custom_subtitle_color) ? 'color:' . esc_attr($subtitle_color) . '; ' : '';
$subtitle_styles = $subtitle_size_style.$subtitle_line_height_style.$subtitle_weight_style.$subtitle_font_style.$subtitle_color_style;
$subtitle_styles = 'style="'.$subtitle_styles.'"';

// Title output
if (!empty($title)) {
	$title_render .= '<div class="dlh_title" '.$title_styles.'>';
	if ((bool)$responsive_font) {
		$title_render .= !empty($font_size_desktop) ? '<div class="dlh_title_desktop" style="font-size:'.esc_attr((int)$font_size_desktop).'px;">' : '';
		$title_render .= !empty($font_size_tablet) ? '<div class="dlh_title_tablet" style="font-size:'.esc_attr((int)$font_size_tablet).'px;">' : '';
		$title_render .= !empty($font_size_mobile) ? '<div class="dlh_title_mobile" style="font-size:'.esc_attr((int)$font_size_mobile).'px;">' : '';
	}
	$title_render .= '<'.esc_attr($title_tag).'>'.wp_kses($title, $allowed_html).'</'.esc_attr($title_tag).'>';
	if ((bool)$responsive_font) {
		$title_render .= !empty($font_size_desktop) ? '</div>' : '';
		$title_render .= !empty($font_size_tablet) ? '</div>' : '';
		$title_render .= !empty($font_size_mobile) ? '</div>' : '';
	}
	$title_render .= '</div>';
}

// Subtitle output
if (!empty($subtitle)) {
	$subtitle_render .= '<div class="dlh_subtitle" '.$subtitle_styles.'>';
		$subtitle_render .= '<'.esc_attr($subtitle_tag).'>'.esc_html($subtitle).'</'.esc_attr($subtitle_tag).'>';
	$subtitle_render .= '</div>';
}

// Subtitle image
if ((bool)$subtitle_img_check && !empty($subtitle_img)) {
	$sub_img = wp_get_attachment_image_src($subtitle_img, 'full');
	$sub_img_alt = get_post_meta($subtitle_img, '_wp_attachment_image_alt', true);
	$sub_img_alt = ' alt="'.(!empty($sub_img_alt) ? esc_attr($sub_img_alt) : 'heading-logo').'"';
	$image_render = '<div class="dlh_img">';
	$image_render .= '<img src="'.esc_url($sub_img[0]).'"'.$sub_img_alt.'/>';
	$image_render .= '</div>';
}

// Render
echo
	'<div', esc_attr($dbl_attr), ' class="iguru_module_double_headings', esc_attr($wrap_classes), '">',
		$image_render,
		$subtitle_render,
		$title_render,
	'</div>'
;

?>
