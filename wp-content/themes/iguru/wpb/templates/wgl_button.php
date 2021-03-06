<?php

$theme_color = esc_attr(iGuru_Theme_Helper::get_option('theme-custom-color'));
$header_font_color = esc_attr(iGuru_Theme_Helper::get_option('header-font')['color']);

$defaults = array(
	// General
	'button_text' => 'Button text',
	'link' => '',
	'css_animation' => '',
	'extra_class' => '',
	// Style
	'size' => 'xl',
	'align' => 'left',
	'full_width' => false,
	'inline' => false,
	'border_radius' => '5px',
	'add_border' => true,
	'border_width' => '1px',
	'shadow_style' => '',
	// Typography
	'font_size' => '',
	'font_weight' => '',
	// Icon
	'icon_type' => 'none',
	'icon_pack' => 'fontawesome',
	'icon_fontawesome' => 'fa fa-adjust',
	'icon_flaticon' => '',
	'image' => '',
	'img_width' => '',
	'icon_position' => 'left',
	'icon_font_size' => '',
	// Spacing
	'left_pad' => '',
	'right_pad' => '',
	'top_pad' => '',
	'bottom_pad' => '',
	'left_mar' => '',
	'right_mar' => '',
	'top_mar' => '',
	'bottom_mar' => '',
	// Colors
	'custom_icon_color' => false,
	'icon_color_idle' => '#ffffff',
	'icon_color_hover' => $theme_color,
	'customize' => 'def',
	'text_color' => $header_font_color,
	'text_color_hover' => '#ffffff',
	'bg_color' => '#ffffff',
	'bg_color_hover' => $theme_color,
	'bg_gradient_idle_start' => '',
	'bg_gradient_idle_end' => '',
	'bg_gradient_hover_start' => '',
	'bg_gradient_hover_end' => '',
	'border_color' => $theme_color,
	'border_color_hover' => $theme_color,
	'border_gradient_idle_start' => '',
	'border_gradient_idle_end' => '',
	'border_gradient_hover_start' => '',
	'border_gradient_hover_end' => '',
);
$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

$button_attr = $button_id = $button_id_attr = $button_styles = $button_icon_content = $button_value_font = $button_content = '';

// Google Fonts
extract( iGuru_GoogleFontsRender::getAttributes( $atts, $this, array('google_fonts_button') ) );
if ( ! empty( $styles_google_fonts_button ) ) {
	$button_value_font = esc_attr($styles_google_fonts_button);
}

// Module unique id
if ($customize != 'def' || !empty($shadow_style) || (bool)$custom_icon_color || ((bool)$add_border && $border_width != '1px')) {
	$button_id = uniqid( "iguru_button_" );
	$button_id_attr = ' id='.$button_id;
}

// Variables validation
$bg_color_idle = !empty($bg_color) ? esc_attr($bg_color) : 'transparent';
$bg_color_hover = !empty($bg_color_hover) ? esc_attr($bg_color_hover) : 'transparent';

ob_start();
	if ((bool)$add_border && $border_width != '1px') {
		$border_width = !empty($border_width) ? esc_attr((int)$border_width).'px' : '0px';
		switch ($customize) {
			case 'gradient':
				echo "#$button_id .btn_border_gradient:before,
					  #$button_id .btn_border_gradient:after {
						  top: -$border_width;
						  right: -$border_width;
						  bottom: -$border_width;
						  left: -$border_width;
					  }";
				break;
			default:
				echo "#$button_id .wgl_button_link {
						  border-width: $border_width;
					  }";
				break;
		}
	}
	if ($customize != 'def') {
		echo "#$button_id .wgl_button_link {
				  color: ".(!empty($text_color) ? esc_attr($text_color) : 'transparent').";
			  }";
		echo "#$button_id .wgl_button_link:hover {
				  color: ".(!empty($text_color_hover) ? esc_attr($text_color_hover) : 'transparent').";
			  }";
		if ($customize == 'color') {
			$border_color_idle = !empty($border_color) ? esc_attr($border_color) : 'transparent';
			echo "#$button_id .wgl_button_link {
					  border-color: $border_color_idle;
					  background-color: $bg_color_idle;
				  }";
			echo "#$button_id .wgl_button_link:hover {
					  border-color: ".(!empty($border_color_hover) ? esc_attr($border_color_hover) : 'transparent').";
					  background-color: $bg_color_hover;
				  }";
		}
		if ($customize == 'gradient') {
			$bg_idle_start = !empty($bg_gradient_idle_start) ? esc_attr($bg_gradient_idle_start) : 'transparent';
			$bg_idle_end = !empty($bg_gradient_idle_end) ? esc_attr($bg_gradient_idle_end) : 'transparent';
			$gradient_idle = 'background-image: -webkit-radial-gradient(100% 150%, circle farthest-corner, '.$bg_idle_end.' 10%, '.$bg_idle_start.' 50%);';
			$gradient_idle .= 'background-image: radial-gradient(circle farthest-corner at 100% 150%, '.$bg_idle_end.' 10%, '.$bg_idle_start.' 50%);';
			echo "#$button_id .wgl_button_link:before { $gradient_idle }";
			
			$bg_hover_start = !empty($bg_gradient_hover_start) ? esc_attr($bg_gradient_hover_start) : 'transparent';
			$bg_hover_end = !empty($bg_gradient_hover_end) ? esc_attr($bg_gradient_hover_end) : 'transparent';
			$gradient_hover = 'background-image: -webkit-radial-gradient(100% 150%, circle farthest-corner, '.$bg_hover_end.' 10%, '.$bg_hover_start.' 50%);';
			$gradient_hover .= 'background-image: radial-gradient(circle farthest-corner at 100% 150%, '.$bg_hover_end.' 10%, '.$bg_hover_start.' 50%);';
			echo "#$button_id .wgl_button_link:after { $gradient_hover }";

			$border_gradient_idle_start = !empty($border_gradient_idle_start) ? esc_attr($border_gradient_idle_start) : 'transparent';
			$border_gradient_idle_end = !empty($border_gradient_idle_end) ? esc_attr($border_gradient_idle_end) : 'transparent';
			$border_idle = 'background-image: -webkit-radial-gradient(100% 150%, circle farthest-corner, '.$border_gradient_idle_end.' 10%, '.$border_gradient_idle_start.' 50%);';
			$border_idle .= 'background-image: radial-gradient(circle farthest-corner at 100% 150%, '.$border_gradient_idle_end.' 10%, '.$border_gradient_idle_start.' 50%);';
			echo "#$button_id .btn_border_gradient:before { $border_idle }";

			$border_gradient_hover_start = !empty($border_gradient_hover_start) ? esc_attr($border_gradient_hover_start) : 'transparent';
			$border_gradient_hover_end = !empty($border_gradient_hover_end) ? esc_attr($border_gradient_hover_end) : 'transparent';
			$border_hover = 'background-image: -webkit-radial-gradient(100% 150%, circle farthest-corner, '.$border_gradient_hover_end.' 10%, '.$border_gradient_hover_start.' 50%);';
			$border_hover .= 'background-image: radial-gradient(circle farthest-corner at 100% 150%, '.$border_gradient_hover_end.' 10%, '.$border_gradient_hover_start.' 50%);';
			echo "#$button_id .btn_border_gradient:after { $border_hover }";
		}
	}
	if (!empty($shadow_style)) {
		$shadow_values = '0px 10px 10px 0';
		$shadow_transparency = '0.4';

		$rgba_pattern = '/^rgba\((\s*\d+\s*,\s*\d+\s*,\s*\d+\s*),\s*[\d\.]+\s*\)/';

		if ($customize == 'def') {
			if (preg_match('/^#/', $theme_color)) $shadow_idle = $shadow_hover = $shadow_values.' rgba('.iGuru_Theme_Helper::hexToRGB($theme_color).','.$shadow_transparency.')';
			if (preg_match($rgba_pattern, $theme_color, $matches)) $shadow_idle = $shadow_hover = $shadow_values.' rgba('.$matches[1].','.$shadow_transparency.')';
		}
		if ($customize == 'color') {
			// idle shadow selection depending on used color format ('empty' color, HEX color, RGBA color)
			if ($bg_color_idle == 'transparent' ) {
				$shadow_idle = '0 0 rgba(0,0,0,0)';
			} else if (preg_match('/^#/', $bg_color_idle)) { 
				$shadow_idle = $shadow_values.' rgba('.iGuru_Theme_Helper::hexToRGB($bg_color_idle).','.$shadow_transparency.')';
			} else if (preg_match($rgba_pattern, $bg_color_idle, $matches)) { 
				$shadow_idle = $shadow_values.' rgba('.$matches[1].','.$shadow_transparency.')';
			}

			// hover shadow selection depending on used color format ('empty' color, HEX color, RGBA color)
			if ($bg_color_hover == 'transparent' ) {
				$shadow_hover = '0 0 rgba(0,0,0,0)';
			} else if (preg_match('/^#/', $bg_color_hover)) {
				$shadow_hover = $shadow_values.' rgba('.iGuru_Theme_Helper::hexToRGB($bg_color_hover).','.$shadow_transparency.')';
			} else if (preg_match($rgba_pattern, $bg_color_hover, $matches)) {
				$shadow_hover = $shadow_values.' rgba('.$matches[1].','.$shadow_transparency.')';
			}
		}
		if ($customize == 'gradient') {
			// idle shadow selection depending on used color format ('empty' color, HEX color, RGBA color)
			if ($bg_gradient_idle_start == 'transparent' ) {
				$shadow_idle = '0 0 rgba(0,0,0,0)';
			} else if (preg_match('/^#/', $bg_gradient_idle_start)) {
				$shadow_idle = $shadow_values.' rgba('.iGuru_Theme_Helper::hexToRGB($bg_gradient_idle_start).','.$shadow_transparency.')';
			} else if (preg_match($rgba_pattern, $bg_gradient_idle_start, $matches)) {
				$shadow_idle = $shadow_values.' rgba('.$matches[1].','.$shadow_transparency.')';
			}

			// hover shadow selection depending on used color format ('empty' color, HEX color, RGBA color)
			if ($bg_gradient_hover_start == 'transparent' ) {
				$shadow_hover = '0 0 rgba(0,0,0,0)';
			} else if (preg_match('/^#/', $bg_gradient_hover_start)) {
				$shadow_hover = $shadow_values.' rgba('.iGuru_Theme_Helper::hexToRGB($bg_gradient_hover_start).','.$shadow_transparency.')';
			} else if (preg_match($rgba_pattern, $bg_gradient_hover_start, $matches)) {
				$shadow_hover = $shadow_values.' rgba('.$matches[1].','.$shadow_transparency.')';
			}
		}
		switch ($shadow_style) {
			case 'none':
				echo "#$button_id a { box-shadow: none }";
				break;
			case 'before_hover':
				echo "#$button_id a { box-shadow: $shadow_idle }";
				echo "#$button_id a:hover { box-shadow: none }";
				break;
			case 'on_hover':
				echo "#$button_id a { box-shadow: none }";
				echo "#$button_id a:hover { box-shadow: $shadow_hover }";
				break;
			case 'always':
				echo "#$button_id a { box-shadow: $shadow_idle }";
				echo "#$button_id a:hover { box-shadow: $shadow_hover }";
				break;
			default: break;
		}
	}
	if ((bool)$custom_icon_color) {
		echo "#$button_id a .wgl_button-icon {
			 	  color: ".(!empty($icon_color_idle) ? esc_html($icon_color_idle) : 'transparent').";
			  }";
		echo "#$button_id a:hover .wgl_button-icon {
				  color: ".(!empty($icon_color_hover) ? esc_html($icon_color_hover) : 'transparent').";
			  }";
	}
$styles = ob_get_clean();
iGuru_shortcode_css()->enqueue_iguru_css($styles);

// Animation
$animation_class = !empty($atts['css_animation']) ? $this->getCSSAnimation($atts['css_animation']) : '';

// Link attributes
$link_temp = vc_build_link($link);
$url = $link_temp['url'];
$button_title = $link_temp['title'];
$target = $link_temp['target'];
$button_attr .= !empty($url) ? ' href="'.esc_url($url).'"' : ' href="#"';
$button_attr .= !empty($button_title) ? " title='".esc_attr($button_title)."'" : '';
$button_attr .= !empty($target) ? ' target="'.esc_attr($target).'"' : '';

// Button classes
$button_wrap_classes = ' wgl_button-'.$size;
$button_wrap_classes .= (bool)$full_width ? ' wgl_button-full' : '';
$button_wrap_classes .= (bool)$inline ? ' wgl_button-inline' : '';
$button_wrap_classes .= ($icon_type != 'none') ? ' wgl_button-icon_'.$icon_position : '';
$button_wrap_classes .= $customize == 'gradient' ? ' btn-gradient' : '';
$button_wrap_classes .= ' a'.$align;
$button_wrap_classes .= $animation_class;
$button_wrap_classes .= !empty($extra_class) ? ' '.$extra_class : '';

// Typography
$button_styles .= ($font_size != '') ? 'font-size:'.esc_attr((int)$font_size).'px;' : '';
$button_styles .= ($font_weight != '') ? ' font-weight:'.(int)$font_weight.';' : '';

// Border styles
$button_styles .= ($border_radius != '') ? ' border-radius:'.esc_attr((int)$border_radius).'px;' : '';
$gradient_border = $customize == 'gradient' ? '<span class="btn_border_gradient"></span>' : '';

// Margins
$margin_offsets = ($top_mar != '') ? ' margin-top:'.esc_attr((int)$top_mar).'px;' : '';
$margin_offsets .= ($left_mar != '') ? ' margin-left:'.esc_attr((int)$left_mar).'px;' : '';
$margin_offsets .= ($right_mar != '') ? ' margin-right:'.esc_attr((int)$right_mar).'px;' : '';
$margin_offsets .= ($bottom_mar != '') ? ' margin-bottom:'.esc_attr((int)$bottom_mar).'px;' : '';
$button_styles .= $margin_offsets;

// Paddings
$button_styles .= ($top_pad != '') ? ' padding-top:'.esc_attr((int)$top_pad).'px;' : '';
$button_styles .= ($left_pad != '') ? ' padding-left:'.esc_attr((int)$left_pad).'px;' : '';
$button_styles .= ($right_pad != '') ? ' padding-right:'.esc_attr((int)$right_pad).'px;' : '';
$button_styles .= ($bottom_pad != '') ? ' padding-bottom:'.esc_attr((int)$bottom_pad).'px;' : '';
$button_styles .= (($left_pad != '') && ($right_pad != '')) ? ' min-width: unset;' : '';

// Google fonts
$button_styles .= $button_value_font;

// Styles output
$button_attr .= !empty($button_styles) ? ' style="'.esc_attr($button_styles).'"' : '';

// Icon/image
if ($icon_type == 'font' && (!empty($icon_fontawesome) || !empty($icon_flaticon))) {
	switch ($icon_pack) {
		case 'fontawesome':
			wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
			$icon_font = $icon_fontawesome;
			break;
		case 'flaticon':
			wp_enqueue_style('flaticon', get_template_directory_uri() . '/fonts/flaticon/flaticon.css');
			$icon_font = $icon_flaticon;
			break;
	}
	$button_icon_style = ($icon_font_size != '') ? 'style="font-size:'.(int)$icon_font_size.'px;"' : '';
	$button_icon_content = !empty($icon_font) ? '<i class="wgl_button-icon '.esc_attr($icon_font).'" '.$button_icon_style.'></i>' : '';
}
if ($icon_type == 'image' && !empty($image)) {
	$featured_image = wp_get_attachment_image_src($image, 'full');
	$featured_image_url = $featured_image[0];
	$button_image_src = ($img_width != '') ? (aq_resize($featured_image_url, $img_width*2, '', true, true, true)) : $featured_image_url;
	$button_img_width_style = ($img_width != '') ? 'style="width:'.(int)$img_width.'px;"' : '';
	$button_icon_content .= '<span class="wgl_button-icon"><img src="'.esc_url($button_image_src).'" alt="'.esc_attr($button_text).'" '.$button_img_width_style.' /></span>';
}

// Switch layout
switch ($icon_position) {
	case 'left':
		$button_content .= $button_icon_content;
		$button_content .= esc_html($button_text);
		break;
	case 'right':
		$button_content .= esc_html($button_text);
		$button_content .= $button_icon_content;
		break;
}

// Render
$output = '<div'.$button_id_attr.' class="iguru_module_button wgl_button'.esc_attr($button_wrap_classes).'">'; 
	$output .= '<a class="wgl_button_link"'.$button_attr.'>';
		$output .= $button_content;
		$output .= $gradient_border;
	$output .= '</a>';
$output .= '</div>';

echo iGuru_Theme_Helper::render_html($output);

?>

