<?php

defined( 'ABSPATH' ) || exit();

/**
 * Template for displaying course thumbnail within the loop.
 *
 * @author   WebGeniusLab
 * @package  iGuru/templates/learnpress
 * @version  1.0
 */

if ( ! class_exists('iGuru_Core') ) return;

global $wgl_courses_atts; // fetch global var 

$defaults = [
	// Content
	'grid_columns' => '',
	'hide_media' => '',
	// Extra
	'current_profile_tab' => learn_press_get_current_profile_tab(),
];

if ($wgl_courses_atts) {
	$atts = vc_shortcode_attribute_parse($defaults, $wgl_courses_atts);
	extract($atts);
} else {
	extract($defaults);
}

// Is it whishlist tab on profile page?
$is_whishlist_tab = $current_profile_tab == 'wishlist' ? true : false;

if ( $hide_media ) {
	echo '<div class="img-placeholder"></div>';
	return;
}

$url_full = wp_get_attachment_image_url(get_post_thumbnail_id($post->ID), 'full');

// Resize to smaller images
$url_lg = aq_resize($url_full, 600, 800, true, true, true);
$url_sm = aq_resize($url_full, 435, 580, true, true, true);

$grid_1 = learn_press_is_courses() && 1 == iGuru_Theme_Helper::get_option('learnpress_archive_columns') || 1 == $grid_columns;
$grid_2 = learn_press_is_courses() && 2 == iGuru_Theme_Helper::get_option('learnpress_archive_columns') || 2 == $grid_columns;

// Image URL
if ($grid_1) {
	$url = $url_full;
} elseif ($grid_2) {
	$url = $url_lg;
} else {
	$url = $url_sm;
}

if ( empty($url) ) {
	if ( $is_whishlist_tab ) echo '<div class="course-thumbnail">';
	echo '<div class="img-placeholder"></div>';
	if ( $is_whishlist_tab ) echo '</div>';
	return;
}

$src_set = esc_url($url_sm).' 435w,' .esc_url($url_lg).' 600w';

// Image attributes
if ( $grid_1 ) {
	$sizes = '(max-width: 600px) 435px, (max-width: 992px) 600px, 1170px';
	$src_set .= ','.esc_url($url_full).' 1700w';
} else {
	$sizes = '(min-width: 600px) 600px, 435px';
}

$src_set = !empty($url_sm) ? 'srcset="'.$src_set.'"' : '';
$sizes = isset($sizes) && !empty($url_sm) ? 'sizes="'.$sizes.'"' : '';

$class = isset($class) ? 'class="'.$class.'"' : '';
$alt = 'alt="'.learn_press_get_course()->get_title().'"';
$src = 'src="'.esc_url($url).'"';


// Render
if ( $is_whishlist_tab ) echo '<div class="course-thumbnail">';

echo '<img ', $class, ' ', $src, ' ', $src_set, ' ', $sizes, ' ', $alt, '/>';

if ( $is_whishlist_tab ) echo '</div>';