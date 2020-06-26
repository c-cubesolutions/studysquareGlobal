<?php

$theme_color = esc_attr(iGuru_Theme_Helper::get_option('theme-custom-color'));
$theme_color_secondary = esc_attr(iGuru_Theme_Helper::get_option('theme-secondary-color'));
$h_font_color = esc_attr(iGuru_Theme_Helper::get_option('header-font')['color']);
$main_font_color = esc_attr(iGuru_Theme_Helper::get_option('main-font')['color']);

$defaults = [
	// General
	'module_title' => '',
	'module_subtitle' => '',
	'courses_layout' => 'grid',
	'courses_navigation' => 'none',
	'courses_navigation_align' => 'center',
	'isotop_filter_use' => '',
	'isotop_filter_align' => 'center',
	'hover_animation' => '',
	'css_animation' => '',
	'extra_class' => '',
	// Content
	'grid_columns' => '3',
	'course_content_align' => '',
	'hide_media' => '',
	'hide_excerpt' => true,
	'hide_course_title' => '',
	'hide_all_meta' => '',
	'hide_instructor' => '',
	'hide_categories' => '',
	'hide_students' => '',
	'hide_reviews' => '',
	'img_placeholder_height' => '',
	'excerpt_chars' => '90',
	// Carousel
	'autoplay' => false,
	'autoplay_speed' => '3000',
	'use_pagination' => true,
	'use_navigation' => '',
	'pag_type' => 'circle',
	'pag_offset' => '',
	'custom_pag_color' => false,
	'pag_color' => $theme_color,
	'custom_resp' => false,
	'resp_medium' => '1025',
	'resp_medium_slides' => '',
	'resp_tablets' => '800',
	'resp_tablets_slides' => '',
	'resp_mobile' => '480',
	'resp_mobile_slides' => '',
	// Styles
	'module_title_align' => '',
	'heading_tag' => 'h3',
	'heading_margin_bottom' => '',
	'custom_h_font' => '',
	'h_font_size' => '30',
	'h_line_height' => '46',
	'h_font_weight' => '',
	'custom_h_color' => '',
	'h_color_idle' => '#ffffff',
	'h_color_hover_1' => $h_font_color,
	'h_color_hover_2' => $theme_color,
	'custom_excerpt_font' => '',
	'excerpt_font_size' => '16',
	'excerpt_line_height' => '30',
	'custom_excerpt_color' => '',
	'excerpt_color' => $main_font_color,
	'custom_meta_font' => '',
	'meta_font_size' => '14',
	'custom_meta_color' => '',
	'meta_text_color_idle' => '#ffffff',
	'meta_text_color_hover' => '#969696',
	'meta_icon_color_idle' => '#ffffff',
	'meta_icon_color_hover' => $theme_color_secondary,
	'custom_cat_font' => '',
	'cat_font_size' => '18',
	'cat_line_height' => '35',
	'custom_cat_colors' => '',
	'cat_color_idle' => '#ffffff',
	'cat_color_hover' => '#ffffff',
	'cat_bg_idle' => $theme_color_secondary,
	'cat_bg_hover' => $theme_color,
	'custom_button_colors' => '',
	'button_color_idle' => '#ffffff',
	'origin_price_button_color_idle' => '#aaaaaa',
	'button_color_hover' => $theme_color,
	'button_bg_idle' => $theme_color,
	'button_bg_hover' => '#ffffff',
	'custom_thumb_overlay' => '',
	'thumb_overlay_idle' => 'rgba(17, 17, 17, 0.4)',
	'thumb_overlay_hover' => '',
];
$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

list($query_args) = iGuru_Loop_Settings::buildQuery($atts);

$query_args['post_type'] = 'lp_course';

// Add Page to Query
global $paged;
if (empty($paged)) $paged = (get_query_var('page')) ? get_query_var('page') : 1;
$query_args['paged'] = $paged;

// Animation
$animation_class = !empty($atts['css_animation']) ? $this->getCSSAnimation( $atts['css_animation'] ) : '';

// Use of custom styles
switch (true) {
	case (bool)$custom_h_color:
	case (bool)$custom_cat_font:
	case (bool)$custom_meta_font:
	case (bool)$custom_cat_colors:
	case (bool)$custom_meta_color:
	case (bool)$custom_excerpt_font:
	case (bool)$custom_button_colors:
	case (bool)$custom_excerpt_color:
	case (bool)$custom_thumb_overlay:
	case (bool)$img_placeholder_height:
	case (bool)$custom_h_font:
			 $custom_style = true; break;
	default: $custom_style = false;
}

// Module unique id
$courses_id = $custom_style ? uniqid( 'courses_module_' ) : '';
$courses_id_attr = !empty($courses_id) ? ' id='.$courses_id : '';

$courses_classes = $hover_animation ? ' hover_shift' : '';
$courses_classes = isset($caller) ? ' '.$caller : '';

// Custom styles
if ( $custom_style ) {
	// variables initialization: auto mode enabled
	$vars = [
		'font_sizes' => [
			'h_font_size', 
			'excerpt_font_size', 
			'meta_font_size',
			'cat_font_size',
		],
		'line_heights' => [
			'h_line_height', 
			'excerpt_line_height',
			'cat_line_height',
		],
		'font_weights' => [
			'h_font_weight', 
		],
		'colors' => [
			'h_color_idle',
			'h_color_hover_1',
			'h_color_hover_2',
			'excerpt_color',
			'meta_text_color_idle',
			'meta_text_color_hover',
			'meta_icon_color_idle',
			'meta_icon_color_hover',
			'cat_color_idle',
			'cat_color_hover',
			'button_color_idle',
			'origin_price_button_color_idle',
			'button_color_hover',
		],
		'bg_colors' => [
			'cat_bg_idle',
			'cat_bg_hover',
			'button_bg_idle',
			'button_bg_hover',
			'thumb_overlay_idle',
			'thumb_overlay_hover',
		],
		'heights' => [
			'img_placeholder_height',
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

		if ($pack == 'heights') foreach ($var_arr as $var) ${$var} = empty(${$var}) ? ''
			: ' height: '.esc_attr(${$var}).'px;';
	}
	
	ob_start();
		if ( $custom_h_font ) {
			if ( $h_font_size )
				echo "#$courses_id .lp_course .course-title { $h_font_size $h_line_height }";
			if ( $h_font_weight )
				echo "#$courses_id .lp_course .course-title { $h_font_weight }";
		}

		if ( $custom_h_color ) {
			if ($h_color_idle)
				echo "#$courses_id .lp_course .course-title { $h_color_idle }";
			if ($h_color_hover_1)
				echo "#$courses_id .lp_course:hover .course-title { $h_color_hover_1 }";
			if ($h_color_hover_2)
				echo "#$courses_id .lp_course .course-title:hover { $h_color_hover_2 }";
		}
		
		if ( $custom_excerpt_font && $excerpt_font_size ) 
			echo "#$courses_id .lp_course .course-excerpt { $excerpt_font_size $excerpt_line_height }";
		
		if ( $custom_excerpt_color && $excerpt_color )
			echo "#$courses_id .lp_course .course-excerpt { $excerpt_color }";

		if ( $custom_meta_font && $meta_font_size )
			echo "#$courses_id .lp_course .course-students,
				  #$courses_id .lp_course .course-reviews,
				  #$courses_id .lp_course .wishlist-button:before {
					  $meta_font_size
				  }";

		if ( $custom_meta_color ) {
			if ($meta_text_color_idle )
				echo "#$courses_id .lp_course .course-students,
					  #$courses_id .lp_course .course-reviews,
					  #$courses_id .lp_course .wishlist-button {
						  $meta_text_color_idle
					  }";
			if ($meta_text_color_hover )
				echo "#$courses_id .lp_course:hover .course-students,
					  #$courses_id .lp_course:hover .course-reviews,
					  #$courses_id .lp_course:hover .wishlist-button {
						  $meta_text_color_hover
					  }";
			if ( $meta_icon_color_idle )
				echo "#$courses_id .lp_course .course-students:before,
					  #$courses_id .lp_course .course-reviews:before,
					  #$courses_id .lp_course .wishlist-button:before {
						  $meta_icon_color_idle
					  }";
			if ( $meta_icon_color_hover )
				echo "#$courses_id .lp_course:hover .course-students:before,
					  #$courses_id .lp_course:hover .course-reviews:before,
					  #$courses_id .lp_course:hover .wishlist-button:before {
						  $meta_icon_color_hover
					  }";
		}

		if ( $custom_cat_font && $cat_font_size )
			echo "#$courses_id .lp_course .cat-links > a { $cat_font_size $cat_line_height }";

		if ( $custom_cat_colors ) {
			if ( $cat_color_idle )
				echo "#$courses_id .lp_course .cat-links > a { $cat_color_idle }";
			if ( $cat_color_hover )
				echo "#$courses_id .lp_course .cat-links > a:hover { $cat_color_hover }";
			if ( $cat_bg_idle )
				echo "#$courses_id .lp_course .cat-links > a { $cat_bg_idle }";
			if ( $cat_bg_hover )
				echo "#$courses_id .lp_course .cat-links > a:hover { $cat_bg_hover }";
		}

		if ( $custom_button_colors ) {
			if ( $button_color_idle )
				echo "#$courses_id .lp_course .lp-button { $button_color_idle }";
			if ( $origin_price_button_color_idle )
				echo "#$courses_id .lp_course .lp-button .origin-price { $origin_price_button_color_idle }";
			if ( $button_color_hover )
				echo
					"#$courses_id .lp_course .lp-button:hover { $button_color_hover }",
					"#$courses_id .lp_course .lp-button:hover .origin-price { color: inherit }"
				;
			if ( $button_bg_idle )
				echo "#$courses_id .lp_course .lp-button { $button_bg_idle }";
			if ( $button_bg_hover )
				echo "#$courses_id .lp_course .lp-button:hover { $button_bg_hover }";
		}

		if ( $custom_thumb_overlay ) {
			if ( $thumb_overlay_idle )
				echo "#$courses_id .lp_course .course-thumbnail:before { $thumb_overlay_idle }";
			if ( $thumb_overlay_hover )
				echo
					"#$courses_id .lp_course .course-thumbnail:after { content: '' }",
					"#$courses_id .lp_course:hover .course-thumbnail:after { $thumb_overlay_hover }"
				;
		}
		if ( $img_placeholder_height )
			echo "#$courses_id .lp_course .img-placeholder { $img_placeholder_height }";

	$styles = ob_get_clean();
}

// Register css
if ( isset($styles) ) iGuru_shortcode_css()->enqueue_iguru_css($styles);

if ( $courses_navigation == 'none' ) {
	$query_args['ignore_sticky_posts'] = 1;
}

$query = iGuru_Theme_Cache::cache_query($query_args);

global $wgl_courses_atts;
$wgl_courses_atts = [
	// Content
	'grid_columns' => $grid_columns,
	'hide_media' => $hide_media,
	'hide_course_title' => $hide_course_title,
	'hide_excerpt' => $hide_excerpt,
	'excerpt_chars' => $excerpt_chars,
	'hide_all_meta' => $hide_all_meta,
	'hide_categories' => $hide_categories,
	'hide_instructor' => $hide_instructor,
	'hide_students' => $hide_students,
	'hide_reviews' => $hide_reviews,
	// Styles
	'heading_tag' => $heading_tag,
	'heading_margin_bottom' => $heading_margin_bottom,
];

wp_enqueue_script( 'imagesloaded' ); 
$row_class = '';

if ( $courses_layout == 'masonry' || $isotop_filter_use ) {
	wp_enqueue_script('isotope');
	$row_class .= ' isotope';
}

// Filter
if ( $isotop_filter_use && $courses_layout != 'carousel' ) :

	$data_category = isset($query_args['tax_query']) ? $query_args['tax_query'] : []; 
	$include = $exclude = [];
	
	if ( isset($data_category[0]) ) {
		foreach ($data_category[0]['terms'] as $value) {
			$idObj = get_term_by( 'slug', $value, 'course_category' );
			$id_list[] = $idObj ? $idObj->term_id : '';
		}
		switch ($data_category[0]['operator']) {
			case 'NOT IN': $exclude = implode(',', $id_list); break;
			case 'IN':     $include = implode(',', $id_list); break;
		}
	}
	$cats = get_terms( [
		'taxonomy' => 'course_category',
		'include' => $include,
		'exclude' => $exclude,
		'hide_empty' => true
	] );
	$filter = '<a href="#" data-filter=".course" class="active">'.esc_html__( 'All', 'iguru' ).'<span class="number_filter"></span></a>';
	foreach ( $cats as $cat ) {
		if ( $cat->count > 0 ) {
			$filter .= '<a href="'.get_term_link($cat->term_id, 'course_category').'" data-filter=".'.$cat->taxonomy.'-'.$cat->slug.'">';
			$filter .= $cat->name;
			$filter .= '<span class="number_filter"></span>';
			$filter .= '</a>';
		}
	}
endif;

// Allowed HTML render
if ( $module_title || $module_subtitle) :
	$allowed_html = [
		'a' => [
			'href' => true, 'title' => true, 'target' => true,
			'style' => true, 'class' => true,
		],
		'br' => [ 'style' => true, 'class' => true ],
		'em' => [ 'style' => true, 'class' => true ],
		'strong' => [ 'style' => true, 'class' => true ],
		'span' => [ 'style' => true, 'class' => true ],
	];
endif;

// Wrapper classes
$row_class .= " grid-col-{$grid_columns}";
$row_class .= ' '.$courses_layout;
$row_class .= ' '.$courses_classes;
$row_class .= !empty($course_content_align) ? ' a'.$course_content_align : '';

$title_class = $module_title && $module_title_align ? ' a'.$module_title_align : '';

// Build courses items
ob_start();
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) : $query->the_post();
			learn_press_get_template_part( 'content', 'course' );
		endwhile;
		wp_reset_postdata();
	} else {
		learn_press_display_message( __( 'Sorry, no any course found.', 'iguru' ), 'error' );
	}
$courses_out = ob_get_clean();

// Carousel options 
if ( $courses_layout == 'carousel' ) :
	$carousel_options_arr = [
		'slide_to_show' => $grid_columns,
		'autoplay' => $autoplay,
		'autoplay_speed' => $autoplay_speed,
		'use_pagination' => $use_pagination,
		'use_navigation' => $use_navigation,
		'pag_type' => $pag_type,
		'pag_offset' => $pag_offset,
		'custom_pag_color' => $custom_pag_color,
		'pag_color' => $pag_color,
		'custom_resp' => $custom_resp,
		'resp_medium' => $resp_medium,
		'resp_medium_slides' => $resp_medium_slides,
		'resp_tablets' => $resp_tablets,
		'resp_tablets_slides' => $resp_tablets_slides,
		'resp_mobile' => $resp_mobile,
		'resp_mobile_slides' => $resp_mobile_slides,
		'adaptive_height' => true
	];

	if ( $use_navigation ) $carousel_options_arr['use_prev_next'] = 'true';

	$carousel_options = array_map(
		function($k, $v) { return "$k=\"$v\" "; },
		array_keys($carousel_options_arr),
		$carousel_options_arr
	);
	$carousel_options = implode('', $carousel_options);

	$courses_out = do_shortcode('[wgl_carousel '.$carousel_options.']'.$courses_out.'[/wgl_carousel]');
endif;


// Render wrapper
if ( $courses_out ): ?>
	<section class="wgl_cpt_section">
		<div <?php echo esc_attr($courses_id_attr); ?> class="iguru_module_courses"><?php

			if ( $module_title || $module_subtitle) :
				$module_title = !empty($module_title) ? '<h3 class="module_title">'.wp_kses( $module_title, $allowed_html ).'</h3>' : '';
				$module_subtitle = !empty($module_subtitle) ? '<p class="module_subtitle">'.wp_kses( $module_subtitle, $allowed_html ).'</p>' : '';
				printf( '<div class="wgl_module_title item_title%s">%s%s</div>',
					esc_attr($title_class),
					$module_title,
					$module_subtitle
				);
			endif;
			if ( isset($filter) ) :
				printf( '<div class="courses_cat_list isotope-filter a%s">%s</div>', 
					esc_attr($isotop_filter_align),
					$filter
				);
			endif;
			printf( '<div class="learn-press-courses container-grid%s">%s</div>', 
				esc_attr($row_class),
				$courses_out
			);
			?>
		</div><?php

		if ( $courses_navigation == 'pagination' ) {
			echo iGuru_Theme_Helper::pagination( '10', $query, $courses_navigation_align);
		}
		?>
	</section>
<?php
endif;

// Clear global var
unset($wgl_courses_atts);

// Prevent calling comments form
add_filter( 'comments_open', 'learn_press_course_comments_open', 10, 2 );