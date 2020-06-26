<?php

$theme_color = esc_attr(iGuru_Theme_Helper::get_option("theme-custom-color"));
$theme_color_secondary = esc_attr(iGuru_Theme_Helper::get_option("theme-secondary-color"));
$theme_gradient_start = esc_attr(iGuru_Theme_Helper::get_option('theme-gradient')['from']);
$theme_gradient_end = esc_attr(iGuru_Theme_Helper::get_option('theme-gradient')['to']);
$header_font_color = esc_attr(iGuru_Theme_Helper::get_option('header-font')['color']);
$main_font_color = esc_attr(iGuru_Theme_Helper::get_option('main-font')['color']);

$defaults = array(
	// General
	'layout' => 'top',
	'alignment' => 'center',
	'hover_animation' => false,
	'extra_class' => '',
    // Content
	'ib_title' => '',
	'ib_content' => '',
	'ib_offsets' => '',
	'ib_bg_image' => '',
	'add_shadow' => false,
	'shadow_appearance' => 'before_hover',
	'shadow_type' => '',
	'shadow_offset_x' => '6',
	'shadow_offset_y' => '5',
	'shadow_blur' => '25',
	'shadow_spread' => '0',
	'shadow_color' => 'rgba(0,0,0,0.08)',
	'add_read_more' => '',
	'read_more_text' => esc_html__( 'Read More', 'iguru' ),
	'read_more_icon' => 'flaticon-next-1',
	'read_more_icon_size' => '',
	'read_more_full_module' => '',
	'read_more_icon_sticky' => false,
	'link' => '',
	// Icon/Image
	'icon_type' => 'none',
	'icon_font_type' => 'type_flaticon',
	'icon_fontawesome' => 'fa fa-adjust',
	'icon_flaticon' => '',
	'custom_icon_size' => '',
	'thumbnail' => '',
	'custom_image_width' => '',
	'custom_image_height' => '',
	// Icon/Image Container
	'bg_full_width' => '',
	'custom_icon_bg_width' => '',
	'custom_icon_bg_height' => '',
	'icon_offsets' => '',
	'icon_bg_image' => '',
	'add_icon_shadow' => false,
	'icon_shadow_appearance' => 'always',
	'icon_shadow_type' => '',
	'icon_shadow_offset_x' => '6',
	'icon_shadow_offset_y' => '5',
	'icon_shadow_blur' => '25',
	'icon_shadow_spread' => '0',
	'icon_shadow_color' => 'rgba(0,0,0,0.08)',
	// Colors
	'custom_title_color' => false,
	'title_color' => $header_font_color,
	'title_color_hover' => $header_font_color,
	'custom_content_color' => false,
	'content_color' => $main_font_color,
	'content_color_hover' => $main_font_color,
	'custom_icon_color' => false,
	'icon_color_idle' => '#00bda6',
	'icon_color_hover' => $theme_color_secondary,
	'custom_icon_bg_color' => '',
	'icon_bg_color' => '#ffffff',
	'icon_bg_color_hover' => '#ffffff',
	'icon_bg_gradient_start' => $theme_gradient_start,
	'icon_bg_gradient_end' => $theme_gradient_end,
	'custom_icon_border_color' => false,
	'icon_border_color' => '#ffffff',
	'icon_border_color_hover' => '#ffffff',
	'custom_bg_color' => '',
	'ib_bg_color_idle' => '#ffffff',
	'ib_bg_color_hover' => '#f9f9f9',
	'ib_bg_gradient_start' => $theme_gradient_start,
	'ib_bg_gradient_end' => $theme_gradient_end,
	'custom_border_color' => false,
	'border_color' => '#cbcbcb',
	'border_color_hover' => '#cbcbcb',
	'custom_button_color' => '',
	'button_color' => $theme_color,
	'button_color_hover' => $header_font_color,
	'button_color_item_hover' => $header_font_color,
	'custom_undeline' => '',
	'button_underline_color_idle' => '#dfdfdf',
	'button_underline_color_hover' => $theme_color,
	// Typography
	'title_tag' => 'h3',
	'title_size' => '',
	'title_weight' => '',
	'title_bot_offset' => '',
	'content_tag' => 'div',
	'content_size' => '',
	'content_line_height' => '',
	'content_weight' => '',
	'button_size' => '',
	'read_more_offset' => '',
);
$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

$infobox_inner = $icon_type_html = $infobox_icon = $infobox_title = $infobox_content = $infobox_button_text = $icon_bg_width = $infobox_button_icon = '';

// RegExs for defining custom offsets
preg_match('/\{(.+)\}/', $ib_offsets, $ib_offsets_css);
$ib_offsets_css = !empty($ib_offsets_css) ? $ib_offsets_css[1] : '';

preg_match('/\{(.+)\}/', $icon_offsets, $icon_offsets_css);
$icon_offsets_css = !empty($icon_offsets_css) ? $icon_offsets_css[1] : '';

// $pattern = array('/(m|p)\w*-(l|r).*?;/');
// $button_offsets_css = preg_replace($pattern, [''], $icon_offsets_css);

// Adding unique id for info box item
switch (true) {
	case $custom_title_color:
	case $custom_content_color:
	case $custom_icon_color:
	case $custom_border_color:
	case $custom_icon_border_color:
	case $add_shadow:
	case $add_icon_shadow:
	case $custom_icon_bg_color:
	case $custom_button_color:
	case $custom_undeline:
	case !empty($ib_offsets_css):
	case !empty($icon_offsets_css):
	case !empty($ib_bg_image):
	case !empty($icon_bg_image):
	case !empty($custom_bg_color):
		$infobox_id = uniqid( "iguru_infobox_" );
		$infobox_id_attr = ' id='.$infobox_id;
		break;
	default:
		$infobox_id = $infobox_id_attr = '';
		break;
}

$ib_bg_image_src = $ib_bg_image ? wp_get_attachment_image_src($ib_bg_image, 'full') : '';
$icon_bg_image_src = $icon_bg_image ? wp_get_attachment_image_src($icon_bg_image, 'full') : '';

// Custom styles
ob_start();
	// custom colors
	if ( $custom_title_color ) {
		echo "#$infobox_id .infobox_title {
				color: ", (!empty($title_color) ? esc_attr($title_color) : 'transparent'), ";
			  }";
		echo "#$infobox_id .infobox_wrapper:hover .infobox_title {
				color: ", (!empty($title_color_hover) ? esc_attr($title_color_hover) : 'transparent'), ";
			  }";
	}
	if ( $custom_content_color ) {
		echo "#$infobox_id .infobox_content {
				color: ", (!empty($content_color) ? esc_attr($content_color) : 'transparent'), ";
			  }";
		echo "#$infobox_id .infobox_wrapper:hover .infobox_content {
				color: ", (!empty($content_color_hover) ? esc_attr($content_color_hover) : 'transparent'), ";
			  }";
	}
	if ( $custom_icon_color ) {
		echo "#$infobox_id .infobox_icon {
				color: ", (!empty($icon_color_idle) ? esc_attr($icon_color_idle) : 'transparent'), ";
			  }";
		echo "#$infobox_id .infobox_wrapper:hover .infobox_icon {
				color: ", (!empty($icon_color_hover) ? esc_attr($icon_color_hover) : 'transparent'), ";
			  }";
	}
	if ( $custom_icon_bg_color ) {
		switch ( $custom_icon_bg_color ) {
			case 'color':
				echo "#$infobox_id .infobox_icon_container {
						background-color: ", (!empty($icon_bg_color) ? esc_attr($icon_bg_color) : 'transparent'), ";
					  }";
				echo "#$infobox_id:hover .infobox_icon_container {
						background-color: ", (!empty($icon_bg_color_hover) ? esc_attr($icon_bg_color_hover) : 'transparent'), ";
					  }";
					break;
			case 'gradient':
				$icon_bg_gradient_start = !empty($icon_bg_gradient_start) ? esc_attr($icon_bg_gradient_start) : 'transparent';
				$icon_bg_gradient_end = !empty($icon_bg_gradient_end) ? esc_attr($icon_bg_gradient_end) : 'transparent';
				$gradient_idle = 'background: -webkit-radial-gradient(100% 110%, circle farthest-corner, '.$icon_bg_gradient_end.' 10%, '.$icon_bg_gradient_start.' 50%);';
				$gradient_idle .= 'background: radial-gradient(circle farthest-corner at 100% 110%, '.$icon_bg_gradient_end.' 10%, '.$icon_bg_gradient_start.' 50%);';
				echo
					  "#$infobox_id .infobox_icon_container {
						$gradient_idle
					  }",
					  "#$infobox_id .infobox_icon_container:after {
						content: '';
						background: $icon_bg_gradient_start
					  }"
				;
			break;
		}
	}
	if ( $custom_icon_border_color ) {
		echo "#$infobox_id .infobox_icon_container {
				border-color: ".(!empty($icon_border_color) ? esc_attr($icon_border_color) : 'transparent').";
			  }";
		echo "#$infobox_id:hover .infobox_icon_container {
				border-color: ".(!empty($icon_border_color_hover) ? esc_attr($icon_border_color_hover) : 'transparent').";
			  }";
	}
	if ( $custom_border_color ) {
		echo "#$infobox_id .infobox_wrapper {
				border-color: ".(!empty($border_color) ? esc_attr($border_color) : 'transparent').";
			  }";
		echo "#$infobox_id .infobox_wrapper:hover {
				border-color: ".(!empty($border_color_hover) ? esc_attr($border_color_hover) : 'transparent').";
			  }";
	}
	if ( $custom_button_color ) {

		if ( $button_color )
			echo "#$infobox_id .infobox_button { color: ", esc_attr($button_color) , "; }";

		if ( $button_color_hover )
			echo "#$infobox_id .infobox_button:hover { color: ", esc_attr($button_color_hover), "; }";

		if ( $button_underline_color_idle && $custom_undeline ) 
			echo "#$infobox_id .infobox_button:before { background-color: ", esc_attr($button_underline_color_idle), "; }";
		
		if ( $button_underline_color_hover && $custom_undeline ) 
			echo "#$infobox_id .infobox_button:after { background-color: ", esc_attr($button_underline_color_hover), "; }";

	}
	if ( !empty($custom_bg_color) ) {
		switch ( $custom_bg_color ) {
			case 'color':
				echo "#$infobox_id .infobox_wrapper {
						background-color: ".(!empty($ib_bg_color_idle) ? esc_attr($ib_bg_color_idle) : 'transparent').";				
					  }";
				echo "#$infobox_id:hover .infobox_wrapper {
						background-color: ".(!empty($ib_bg_color_hover) ? esc_attr($ib_bg_color_hover) : 'transparent').";
					  }";
				break;
			case 'gradient':
				$ib_bg_gradient_start = !empty($ib_bg_gradient_start) ? esc_attr($ib_bg_gradient_start) : 'transparent';
				$ib_bg_gradient_end = !empty($ib_bg_gradient_end) ? esc_attr($ib_bg_gradient_end) : 'transparent';
				$gradient_idle = 'background: -webkit-radial-gradient(100% 110%, circle farthest-corner, '.$theme_gradient_end.' 10%, '.$ib_bg_gradient_start.' 50%);';
				$gradient_idle .= 'background: radial-gradient(circle farthest-corner at 100% 110%, '.$ib_bg_gradient_end.' 10%, '.$ib_bg_gradient_start.' 50%);';
				echo "#$infobox_id .infobox_wrapper {
						".$gradient_idle."
					  }";
				echo "#$infobox_id .infobox_wrapper:after {
						content: '';
						background: ".$ib_bg_gradient_start."
					  }";
				break;
		}
	}
	if (!empty($ib_bg_image)) {
		echo "#$infobox_id .infobox_wrapper {
				background-image: url(".esc_url($ib_bg_image_src[0]).");
				background-position: left top;
				background-repeat: no-repeat;
			  }";
	}
	if (!empty($icon_bg_image_src)) {
		echo "#$infobox_id .infobox_icon_container {
				background-image: url(".esc_url($icon_bg_image_src[0]).");
				background-position: left top;
				background-repeat: no-repeat;
			  }";
	}
	// ib offsets
	if ( !empty($ib_offsets_css) ) {
		echo "#$infobox_id .infobox_wrapper { $ib_offsets_css }";
	}
	// icon container offsets
	if ( !empty($icon_offsets_css) ) {
		echo "#$infobox_id .infobox_icon_container { $icon_offsets_css }";
	}
	// button wrapper offsets
	if ( $add_read_more == 'icon' && !empty($button_offsets_css) ) {
		switch ((bool)$read_more_icon_sticky) {
			case true: break;
			default: echo "#$infobox_id .infobox_button { $button_offsets_css }"; break;
		}
		echo "@media (max-width: 480px) {
				  #$infobox_id .infobox_wrapper {
					  padding: 20px !important;
				  }
			  }";
	}
	// info box shadow
	if ( $add_shadow ) {
		$ib_shadow = 'box-shadow: ';
		$ib_shadow .= !empty($shadow_type) ? 'inset ' : '';
		$ib_shadow .= ($shadow_offset_x !== '') ? esc_attr((int)$shadow_offset_x.'px ') : '0px ';
		$ib_shadow .= ($shadow_offset_y !== '') ? esc_attr((int)$shadow_offset_y.'px ') : '0px ';
		$ib_shadow .= ($shadow_blur !== '') ? esc_attr((int)$shadow_blur.'px ') : '0px ';
		$ib_shadow .= ($shadow_spread !== '') ? esc_attr((int)$shadow_spread.'px ') : '0px ';
		$ib_shadow .= !empty($shadow_color) ? esc_attr($shadow_color).';' : 'rgba(0,0,0,0.1);';

		switch ( $shadow_appearance ) {
			case 'before_hover':
				echo "#$infobox_id .infobox_wrapper{".$ib_shadow."}";
				echo "#$infobox_id:hover .infobox_wrapper{ box-shadow: none; }";
				break;
			case 'on_hover':
				echo "#$infobox_id .infobox_wrapper { box-shadow: none; }";
				echo "#$infobox_id:hover .infobox_wrapper {"
						.$ib_shadow.
						"border-color: transparent;
					}";
				break;
			case 'always':
				echo "#$infobox_id .infobox_wrapper{".$ib_shadow."}";
				break;
		}
	}
	// icon container shadow
	if ( $add_icon_shadow ) {
		$icon_shadow = 'box-shadow: ';
		$icon_shadow .= !empty($icon_shadow_type) ? 'inset ' : '';
		$icon_shadow .= ($icon_shadow_offset_x !== '') ? esc_attr((int)$icon_shadow_offset_x.'px ') : '0px ';
		$icon_shadow .= ($icon_shadow_offset_y !== '') ? esc_attr((int)$icon_shadow_offset_y.'px ') : '0px ';
		$icon_shadow .= ($icon_shadow_blur !== '') ? esc_attr((int)$icon_shadow_blur.'px ') : '0px ';
		$icon_shadow .= ($icon_shadow_spread !== '') ? esc_attr((int)$icon_shadow_spread.'px ') : '0px ';
		$icon_shadow .= !empty($icon_shadow_color) ? esc_attr($icon_shadow_color).';' : 'rgba(0,0,0,0.1);';
		
		switch ( $icon_shadow_appearance ) {
			case 'before_hover':
				echo "#$infobox_id .infobox_icon_container{".$icon_shadow."}";
				echo "#$infobox_id:hover .infobox_icon_container{box-shadow: none;}";
				break;
			case 'on_hover':
				echo "#$infobox_id .infobox_icon_container{ box-shadow: none; }";
				echo "#$infobox_id:hover .infobox_icon_container{".$icon_shadow."}";
				break;
			case 'always':
				echo "#$infobox_id .infobox_icon_container{".$icon_shadow."}";
				break;
		}
	}
$styles = ob_get_clean();
iGuru_shortcode_css()->enqueue_iguru_css($styles);

// Animation
if (!empty($css_animation)) {
	$animation_class = $this->getCSSAnimation( $atts['css_animation'] );
}

// Info box wrapper classes
$infobox_wrap_classes = (bool)$bg_full_width ? ' full_width' : '';
$infobox_wrap_classes .= ' layout_'.$layout;
$infobox_wrap_classes .= ' alignment_'.$alignment;
$infobox_wrap_classes .= (bool)$hover_animation ? ' hover_shift' : '';
$infobox_wrap_classes .= !empty($css_animation) ? $animation_class : '';
$infobox_wrap_classes .= !empty($extra_class) ? ' '.$extra_class : '';

// Render Google Fonts
extract( iGuru_GoogleFontsRender::getAttributes( $atts, $this, array('google_fonts_title', 'google_fonts_content', 'google_fonts_button') ) );
$title_font = (!empty($styles_google_fonts_title)) ? esc_attr($styles_google_fonts_title) : '';
$content_font = (!empty($styles_google_fonts_content)) ? esc_attr($styles_google_fonts_content) : '';
$button_font = (!empty($styles_google_fonts_button)) ? esc_attr($styles_google_fonts_button) : '';

// HTML tags allowed for rendering
$allowed_html = [
	'a' => [
		'href' => true,
		'title' => true,
	],
	'br' => [ 'class' => true, ],
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

// Typography
$title_font_size = ($title_size != '') ? 'font-size: '.$title_size.'px; ' : '';
$title_font_weight = ($title_weight != '') ? ' font-weight: '.$title_weight.'; ' : '';
$title_offset = ($title_bot_offset != '') ? 'margin-bottom: '.esc_attr((int)$title_bot_offset).'px; ' : '';
$content_font_size = $content_size != '' ? 'font-size: '.$content_size.'px; ' : '';
$content_line_height = !empty($content_line_height) ? 'line-height:' . esc_attr((int)$content_line_height) . 'px; ' : '';
$content_font_weight = !empty($content_weight) ? 'font-weight:' . $content_weight . '; ' : '';
$button_font_size = !empty($button_size) ? 'font-size: ' . esc_attr((int)$button_size) . 'px; ' : '';
$button_offset = $read_more_offset != '' ? 'margin-top: ' . esc_attr((int)$read_more_offset) . 'px;' : '';

// Styles for Title, Content and Button 
$title_styles = esc_attr($title_font_size).esc_attr($title_font_weight).$title_font.$title_offset;
$title_styles = !empty($title_styles) ? ' style="'.$title_styles.'"' : '';
$content_styles = esc_attr($content_font_size).esc_attr($content_line_height).$content_font.$content_font_weight;
$content_styles = !empty($content_styles) ? ' style="'.$content_styles.'"' : '';
$button_styles = esc_attr($button_font_size).$button_font.$button_offset;
$button_styles = !empty($button_styles) ? ' style="'.$button_styles.'"' : '';

// Title output
$infobox_title .= !empty($ib_title) ? '<'.esc_attr($title_tag).' class="infobox_title" '.$title_styles.'>'.wp_kses( $ib_title, $allowed_html ).'</'.esc_attr($title_tag).'>' : '';

// Content output
$infobox_content .= !empty($ib_content) ? '<'.esc_attr($content_tag).' class="infobox_content" '.$content_styles.'>'.wp_kses($ib_content, $allowed_html).'</'.esc_attr($content_tag).'>' : '';

// Icon/Image output
if ($icon_type != 'none') {
	if ($icon_type == 'font' && (!empty($icon_fontawesome) || !empty($icon_flaticon))) {
		switch ($icon_font_type) {
			case 'type_fontawesome':
				wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
				$icon_font = $icon_fontawesome;
				break;
			case 'type_flaticon':
				wp_enqueue_style('flaticon', get_template_directory_uri() . '/fonts/flaticon/flaticon.css');
				$icon_font = $icon_flaticon;
				break;
		}
		$icon_size = !empty($custom_icon_size) ? ' style="font-size: '.esc_attr((int)$custom_icon_size).'px;"' : '';
		$icon_type_html .= '<i class="infobox_icon '.esc_attr($icon_font).'" '.$icon_size.'></i>';
	} 
	if ($icon_type == 'image' && !empty($thumbnail)) {
		$featured_image = wp_get_attachment_image_src($thumbnail, 'full');
		$featured_image_url = $featured_image[0];
		$image_width_crop = ($custom_image_width != '') ? $custom_image_width*2 : '';
		$image_height_crop = ($custom_image_height != '') ? $custom_image_height*2 : '';
		$iconbox_image_src = ($custom_image_width != '' || $custom_image_height != '') ? (aq_resize($featured_image_url, $image_width_crop, $image_height_crop, true, true, true)) : $featured_image_url;
		$image_width = ($custom_image_width != '') ? 'width:'.esc_attr((int)$custom_image_width).'px; ' : '';
		$image_height = ($custom_image_height != '') ? 'height:'.esc_attr((int)$custom_image_height).'px;' : '';
		$iconbox_img_width_style = (!empty($image_width) || !empty($image_height))  ? ' style="'.$image_width.$image_height.'"' : '';
		$img_alt = get_post_meta($thumbnail, '_wp_attachment_image_alt', true);
		$icon_type_html .= '<div class="infobox_icon" '.(!empty($image_height) ? ' style="'.$image_height.'"' : '').'><img src="'.esc_url($iconbox_image_src).'" alt="'.(!empty($img_alt) ? esc_attr($img_alt) : '').'" '.$iconbox_img_width_style.' /></div>';
	}
	$icon_bg_width = ($custom_icon_bg_width != '') ? 'width: '.esc_attr((int)$custom_icon_bg_width).'px; ' : '';
	$icon_bg_height = ($custom_icon_bg_height != '') ? 'height: '.esc_attr((int)$custom_icon_bg_height).'px;' : '';
	if ( $bg_full_width ) {
		$icon_bg_style = ' style="width: 100%; height: auto;"';
	} else {
		$icon_bg_style = $icon_bg_width.$icon_bg_height;
		$icon_bg_style = ! empty($icon_bg_style) ? ' style="'.$icon_bg_style.'"' : '';
	}

	$infobox_icon .= '<div class="infobox_icon_wrapper">';
		$infobox_icon .= '<div class="infobox_icon_container"'.$icon_bg_style.'>'.$icon_type_html.'</div>';
	$infobox_icon .= '</div>';
}

// Read more button
$link_temp = vc_build_link($link);
$url = $link_temp['url'];
$button_title = $link_temp['title'];
$target = $link_temp['target'];
$url = 'href="'. (!empty($url) ? esc_url($url) : '#') .'"';
$button_attr = !empty($button_title) ? " title='".esc_attr($button_title)."'" : '';
$button_attr .= !empty($target) ? ' target="'.esc_attr($target).'"' : '';
if ( ! empty($add_read_more) ) {
	switch ($add_read_more) {
		case 'alphameric':
			$infobox_button_text .= '<a '.$url.' class="infobox_button button-read-more" '.$button_attr.'>'.esc_html($read_more_text).'</a>';
			break;
		case 'icon':
			wp_enqueue_style( 'flaticon', get_template_directory_uri() . '/fonts/flaticon/flaticon.css');
			$button_class = (bool)$read_more_icon_sticky ? ' corner-attached' : '';
			$button_style = !empty($icon_bg_width) ? ' style="'.$icon_bg_width.'"' : '';
			$icon_style = !empty($read_more_icon_size) ? ' style="font-size: '.esc_attr((int)$read_more_icon_size).'px;"' : '';
			$tag = $read_more_full_module ? 'div' : 'a '.$url;

			$infobox_button_icon .= '<div class="infobox_button_wrapper">';
				$infobox_button_icon .= sprintf( '<%s class="infobox_button read-more-icon%s" %s>', $tag, $button_class, $button_attr, $button_style );
					$infobox_button_icon .= '<i class="'.esc_attr($read_more_icon).'"'.$icon_style.'></i>';
				$infobox_button_icon .= $read_more_full_module ? '</div>' : '</a>';
			$infobox_button_icon .= '</div>';
			break;
	}
}

// Switch layout
switch ( $layout ) {
	case 'top':
		$infobox_inner .= $infobox_icon;
		$infobox_inner .= $infobox_title;
		$infobox_inner .= $infobox_content;
		$infobox_inner .= $infobox_button_text;
		$infobox_inner .= $infobox_button_icon;
		break;
	case 'left':
	case 'right':
		$infobox_inner .= $infobox_icon;
		$infobox_inner .= '<div class="infobox_content_wrapper">';
		$infobox_inner .= $infobox_title;
		$infobox_inner .= $infobox_content;
		$infobox_inner .= $infobox_button_text;
		$infobox_inner .= '</div>';
		$infobox_inner .= $infobox_button_icon;
		break;
}

// Render html
$output = '<div'.$infobox_id_attr.' class="iguru_module_infobox'.esc_attr($infobox_wrap_classes).'">';
	$output .=	$read_more_full_module ? sprintf('<a %s>', $url) : '';
		$output .= '<div class="infobox_wrapper">';
			$output .= $infobox_inner;
		$output .= '</div>';
	$output .= $read_more_full_module ? '</a>' : '';
$output .= '</div>';

echo iGuru_Theme_Helper::render_html($output);