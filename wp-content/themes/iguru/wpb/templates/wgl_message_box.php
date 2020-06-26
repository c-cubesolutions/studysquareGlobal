<?php
    $theme_color = esc_attr(iGuru_Theme_Helper::get_option("theme-custom-color"));

	$defaults = array(
		// General
		'type' => 'info',
		'icon_fontawesome' => 'fa fa-adjust',
		'icon_color' => $theme_color,
		'title' => '',
		'text' => '',
		'closable' => false,
		'animation_class' => '',
		'extra_class' => '',
		// Typography
        'title_tag' => 'h4',
        'title_size' => '',
        'custom_title_color' => false,
        'title_color' => $theme_color,
        'text_tag' => 'div',
        'text_size' => '',
        'custom_text_color' => false,
        'text_color' => '#000000',
	);
	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);

	$message_id = $message_id_attr = $animation_class = $fontawesome = '';

	// Module unique id
	if ($type == 'custom') {
		$message_id = uniqid( "iguru_message_" );
		$message_id_attr = 'id='.$message_id;
	}

	// Custom styles
	ob_start();
		if ($type == 'custom') {
			echo "#$message_id .message_icon_wrap{
				background-color: ".esc_attr($icon_color).";
			}";
			echo "#$message_id .message_title{
				color: ".esc_attr($icon_color).";
			}";
		}
		if ((bool)$custom_title_color) {
			echo "#$message_id .message_title{
				color: ".esc_attr($title_color).";
			}";
		}
		if ((bool)$custom_text_color) {   
			echo "#$message_id .message_text{
				color: ".esc_attr($text_color).";
			}";
		}
	$styles = ob_get_clean();
	iGuru_shortcode_css()->enqueue_iguru_css($styles);

	// Animation
	$animation_class = !empty($atts['css_animation']) ? $this->getCSSAnimation($atts['css_animation']) : '';

	// Wrapper classes
	$message_wrap_classes = ' type_'.$type;
	$message_wrap_classes .= (bool)$closable ? ' closable' : '';
	$message_wrap_classes .= $animation_class;

	// Render Google Fonts
	extract( iGuru_GoogleFontsRender::getAttributes( $atts, $this, array('google_fonts_title', 'google_fonts_text') ) );
	$title_font = (!empty($styles_google_fonts_title)) ? esc_attr($styles_google_fonts_title) : '';
	$text_font = (!empty($styles_google_fonts_text)) ? esc_attr($styles_google_fonts_text) : '';

	// font sizes
	$title_font_size = ($title_size != '') ? 'font-size: '.(int)$title_size.'px; ' : '';
	$text_font_size = ($text_size != '') ? 'font-size: '.(int)$text_size.'px; ' : '';

	// title, text styles
	$title_styles = (!empty($title_font_size) || !empty($title_font)) ? 'style="'.esc_attr($title_font_size).$title_font.'"' : '';
	$text_styles = (!empty($text_font_size) || !empty($text_font)) ? 'style="'.esc_attr($text_font_size).$text_font.'"' : '';

	// title output
	$message_title = !empty($title) ? '<'.esc_attr($title_tag).' class="message_title" '.$title_styles.'>'.esc_html($title).'</'.esc_attr($title_tag).'>' : '';

	// text output
	$message_text = !empty($text) ? '<'.esc_attr($text_tag).' class="message_text" '.$text_styles.'>'.esc_html($text).'</'.esc_attr($text_tag).'>' : '';

	// custom message icon
	if ($type == 'custom' && !empty($icon_fontawesome)) {
		wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
		$fontawesome .= $icon_fontawesome;
	} 
	$message_icon = '<i class="message_icon '.esc_attr($fontawesome).'"></i>';

	// message close button
	$message_close = (bool)$closable ? '<span class="message_close_button"></span>' : '';


	$message_inner = '<div class="message_icon_wrap">'.$message_icon.'</div>';
	$message_inner .= (!empty($message_title) || !empty($message_text)) ? '<div class="message_content">' : '';
	$message_inner .= $message_title;
	$message_inner .= $message_text;
	$message_inner .= (!empty($message_title) || !empty($message_text)) ? '</div>' : '';
	$message_inner .= $message_close;

	// render html
	$output .=  '<div '.esc_attr($message_id_attr).' class="iguru_module_message_box'.esc_attr($message_wrap_classes).'">';
		$output .= $message_inner;
	$output .= '</div>';

	echo iGuru_Theme_Helper::render_html($output);

?>  
