<?php

$theme_color = esc_attr(iGuru_Theme_Helper::get_option('theme-custom-color'));
$secondary_color = esc_attr(iGuru_Theme_Helper::get_option('theme-secondary-color'));
$h_font_color = esc_attr(iGuru_Theme_Helper::get_option('header-font')['color']);
$main_font_color = esc_attr(iGuru_Theme_Helper::get_option('main-font')['color']);

$defaults = [
	// General
	'grid_columns' => '4',
	'items' => '',
	'link_use' => true,
	'link_target' => '',
	'hover_anim' => '',
	'hide_icon' => '',
	'css_animation' => '',
	'extra_class' => '',
	// Carousel
	'use_carousel' => '',
	'autoplay' => '',
	'autoplay_speed' => '3000',
	'use_pagination' => '',
	'pag_type' => 'circle',
	'pag_offset' => '',
	'custom_pag_color' => '',
	'pag_color' => $secondary_color,
	'use_prev_next' => true,
	'custom_prev_next_color' => '',
	'prev_next_color' => '#ffffff',
	'prev_next_color_hover' => '#ffffff',
	'prev_next_bg_idle' => $secondary_color,
	'prev_next_bg_hover' => $secondary_color,
	'custom_resp' => '',
	'resp_medium' => '1025',
	'resp_medium_slides' => '',
	'resp_tablets' => '800',
	'resp_tablets_slides' => '',
	'resp_mobile' => '480',
	'resp_mobile_slides' => '',
	// Styles
	'custom_name_colors' => '',
	'name_color_idle' => $h_font_color,
	'name_color_hover' => $h_font_color,
	'custom_name_font' => '',
	'name_font_size' => '48px',
	'name_line_height' => '',
	'name_font_weight' => '',
	'custom_count_colors' => '',
	'count_color_idle' => $theme_color,
	'count_color_hover' => $secondary_color,
	'custom_count_backgrounds' => '',
	'count_bg_idle' => '#ffffff',
	'count_bg_hover' => '#ffffff',
	'custom_count_font' => '',
	'count_font_size' => '16px',
	'count_line_height' => '19px',
	'custom_icon_settings' => '',
	'icon_color_idle' => '',
	'icon_color_hover' => '',
	'icon_color_bg' => '',
	'icon_font_size' => '',
	'icon_margin_top' => '',
	'icon_margin_bottom' => '',
	'items_min_height' => '',
	'custom_cat_backgrounds' => '',
	'cat_bg_idle' => $h_font_color,
	'cat_bg_hover' => $h_font_color,
	'hide_box_shadow' => '',
];
$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

$content = '';

if ( ! $hide_icon ) {
	wp_enqueue_style('flaticon', get_template_directory_uri() . '/fonts/flaticon/flaticon.css');
}

if ( $use_carousel ) :
	$carousel_options_arr = [ // carousel options
		'slide_to_show' => $grid_columns,
		'autoplay' => $autoplay,
		'autoplay_speed' => $autoplay_speed,
		'use_pagination' => $use_pagination,
		'use_prev_next' => $use_prev_next,
		'pag_type' => $pag_type,
		'pag_offset' => $pag_offset,
		'custom_pag_color' => $custom_pag_color,
		'pag_color' => $pag_color,
		'custom_prev_next_color' => $custom_prev_next_color,
		'prev_next_color' => $prev_next_color,
		'prev_next_color_hover' => $prev_next_color_hover,
		'prev_next_bg_idle' => $prev_next_bg_idle,
		'prev_next_bg_hover' => $prev_next_bg_hover,
		'custom_resp' => $custom_resp,
		'resp_medium' => $resp_medium,
		'resp_medium_slides' => $resp_medium_slides,
		'resp_tablets' => $resp_tablets,
		'resp_tablets_slides' => $resp_tablets_slides,
		'resp_mobile' => $resp_mobile,
		'resp_mobile_slides' => $resp_mobile_slides,
		'infinite' => true,
		'slides_to_scroll' => true,
	];
	$carousel_options = array_map(
		function($k, $v) { return "$k=\"$v\" "; },
		array_keys($carousel_options_arr),
		$carousel_options_arr
	);
	$carousel_options = implode('', $carousel_options);
endif;

// Use of custom styles
switch (true) {
	case 'hide_icon':
	case 'custom_name_colors':
	case 'custom_name_font':
	case 'custom_count_colors':
	case 'custom_count_backgrounds':
	case 'custom_count_font':
	case 'custom_icon_settings':
	case 'items_min_height':
	case 'custom_cat_backgrounds':
	case 'hide_box_shadow':
			 $custom_style = true; break;
	default: $custom_style = false; break;
}

// Module unique id
$c_id = $custom_style ? uniqid( 'categories_module_' ) : '';
$c_id_attr = $c_id ? ' id='.$c_id : '';

// Animation
$animation_class = !empty($atts['css_animation']) ? $this->getCSSAnimation( $atts['css_animation'] ) : false;

// Custom styles
if ( $custom_style ) :
	$vars = [ // variables initialization: auto mode enabled
		'font_sizes' => [
			'name_font_size',
			'count_font_size',
			'icon_font_size',
		],
		'line_heights' => [
			'name_line_height',
			'count_line_height',
		],
		'font_weights' => [
			'name_font_weight',
		],
		'colors' => [
			'name_color_idle',
			'name_color_hover',
			'count_color_idle',
			'count_color_hover',
			'icon_color_idle',
			'icon_color_hover',
			'icon_color_bg',
		],
		'bg_colors' => [
			'count_bg_idle',
			'count_bg_hover',
			'cat_bg_idle',
			'cat_bg_hover',
		],
		'min_height' => [
			'items_min_height',
		],
		'margins' => [
			'top' => [ 'icon_margin_top' ],
			'bottom' => [ 'icon_margin_bottom' ],
		],
	];
	foreach ($vars as $pack => $var_arr) {

		if ($pack == 'font_sizes') foreach ($var_arr as $var) ${$var} = empty(${$var}) ? ''
			: ' font-size: '.esc_attr((int)${$var}).'px;';

		if ($pack == 'line_heights') foreach ($var_arr as $var) ${$var} = empty(${$var}) ? ''
			: ' line-height: '.esc_attr((int)${$var}).'px;';

		if ($pack == 'font_weights') foreach ($var_arr as $var) ${$var} = empty(${$var}) ? ''
			: ' font-weight: '.esc_attr((int)${$var}).';';
		
		if ($pack == 'colors') foreach ($var_arr as $var) ${$var} = empty(${$var}) ? ''
			: ' color: '.esc_attr(${$var}).';';

		if ($pack == 'bg_colors') foreach ($var_arr as $var) ${$var} = empty(${$var}) ? ''
			: ' background-color: '.esc_attr(${$var}).';';

		if ($pack == 'min_height') foreach ($var_arr as $var) ${$var} = empty(${$var}) ? ''
			: ' min-height: '.esc_attr((int)${$var}).'px;';

		if ($pack == 'margins') foreach ($var_arr as $vector => $vars) foreach ($vars as $var) ${$var} = empty(${$var}) ? ''
			: " margin-{$vector}: ".esc_attr((int)${$var}).'px;';

	}
	ob_start();
	if ( $custom_name_colors ) {
		! $name_color_idle  || printf( "#$c_id .cat_name { $name_color_idle }" );
		! $name_color_hover || printf( "#$c_id .cat_wrapper:hover .cat_name { $name_color_hover }" );
	}

	if ( $custom_name_font ) {
		! $name_font_size   || printf( "#$c_id .cat_name { $name_font_size }" );
		! $name_line_height || printf( "#$c_id .cat_name { $name_line_height }" );
		! $name_font_weight || printf( "#$c_id .cat_name { $name_font_weight }" );
	}

	if ( $custom_count_colors ) {
		! $count_color_idle  || printf( "#$c_id .cat_counter { $count_color_idle }" );
		! $count_color_hover || printf( "#$c_id .cat_wrapper:hover .cat_counter { $count_color_hover }" );
	}

	if ( $custom_count_backgrounds ) {
		! $count_bg_idle  || printf( "#$c_id .cat_counter { $count_bg_idle }" );
		! $count_bg_hover || printf( "#$c_id .cat_wrapper:hover .cat_counter { $count_bg_hover }" );
	}

	if ( $custom_count_font ) {
		! $count_font_size || printf( "#$c_id .cat_counter { $count_font_size $count_line_height }" );
	}

	if ( $custom_icon_settings ) {
		! $icon_color_idle    || printf( "#$c_id .cat_icon { $icon_color_idle }" );
		! $icon_color_hover   || printf( "#$c_id .cat_wrapper:hover .cat_icon { $icon_color_hover }" );
		! $icon_color_bg      || printf( "#$c_id .cat_wrapper .cat_icon:before { $icon_color_bg }" );
		! $icon_font_size     || printf( "#$c_id .cat_icon { $icon_font_size }" );
		! $icon_margin_top    || printf( "#$c_id .cat_icon_wrap { $icon_margin_top }" );
		! $icon_margin_bottom || printf( "#$c_id .cat_icon_wrap { $icon_margin_bottom }" );
	}

	if ( $custom_cat_backgrounds ) {
		! $cat_bg_idle  || printf( "#$c_id .cat_wrapper { $cat_bg_idle }" );
		! $cat_bg_hover || printf( "#$c_id .cat_wrapper:hover { $cat_bg_hover }" );
	}

	if ( $custom_cat_backgrounds ) {
		! $items_min_height || printf( "#$c_id .cat_wrapper { $items_min_height }" );
		! $items_min_height || printf( "#$c_id .iguru_module_carousel .content_wrap { $items_min_height }" );
	}

	! $hide_box_shadow || printf( "#$c_id .cat_wrapper { box-shadow: unset }" );

	$styles = ob_get_clean();
	iGuru_shortcode_css()->enqueue_iguru_css($styles);
endif;

// Wrapper classes
$wrap_class = ' grid-col-'.$grid_columns;
$wrap_class .= $use_carousel ? ' carousel' : '';
$wrap_class .= $animation_class ? ' '.$animation_class : '';
$wrap_class .= $hover_anim ? ' hover_lifting' : '';
$wrap_class .= !empty($extra_class) ? ' '.esc_attr($extra_class) : '';


$items = (array)vc_param_group_parse_atts($items);
foreach ( $items as $item ) :
	$thumb_idle = $cat_icon = null;
	$link = $wrap_style = $cat_icon = '';

	foreach ($item as $k => $v) ${$k} = isset( $item[$k] ) ? $item[$k] : false;

	if ( !isset($cat_id) ) continue;

	$cat = get_term( $cat_id );

	if ( isset($thumb_idle) ) {
		$img_idle_src = wp_get_attachment_image_src($thumb_idle, 'full')[0];
		$wrap_style = $img_idle_src ? ' style="background-image: url('.esc_url($img_idle_src).');"' : '';
	}
	if ( $link_use ) {
		$url = get_term_link( (int)$cat_id );
		$target = $link_target ? ' target="_blank"' : '';
		$link = sprintf( '<a href="%s" class="cat_wrapper cat_link" title="%s"%s%s>',
			esc_url($url),
			esc_attr( sprintf( __( 'Courses with &quot;%s&quot; category', 'iguru' ), $cat->name ) ),
			$wrap_style,
			$target
		);
	}
	if ( isset($cat_icon) && ! $hide_icon ) {
		$cat_icon = sprintf( '<span class="cat_icon_wrap"><i class="cat_icon %s"></i></span>', esc_attr($cat_icon));
	}
	$cat_name = sprintf( '<span class="cat_name">%s</span>', esc_html($cat->name) );
	$cat_count = sprintf( '<span class="cat_counter_wrap"><span class="cat_counter">%d %s</span></span>',
		esc_html($cat->count),
		esc_html( _n( 'Course', 'Courses', (int)$cat->count, 'iguru' )  )
	);

	// Build category
	$content .= '<div class="course_cat">';
		$content .= $link_use ? $link : sprintf('<div class="cat_wrapper"%s>', $wrap_style);
			$content .= '<div class="content_wrap">';
				$content .= $cat_icon;
				$content .= $cat_name;
				$content .= $cat_count;
			$content .= '</div>';
		$content .= $link_use ? '</a>' : '</div>';
	$content .= '</div>';
endforeach;

// Render
if ( $content ) :

	printf( '<div%s class="iguru_module_lp_cats%s">%s</div>',
		$c_id_attr,
		esc_attr($wrap_class),
		$use_carousel ? do_shortcode('[wgl_carousel '.$carousel_options.']'.$content.'[/wgl_carousel]') : $content
	);

endif;
