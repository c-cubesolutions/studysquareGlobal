<?php

defined( 'ABSPATH' ) || exit();

/**
 * Template for displaying author courses.
 *
 * @author   WebGeniusLab
 * @package  iGuru/templates/learnpress
 * @version  1.0
 */

global $this_profile; // fetch global var

$user = $this_profile->get_user();
$role = $user->get_role();
$id = $user->get_id();


if ( $user->is_guest() || $this_profile->is_current_user() || ! in_array($role, [ 'admin', 'instructor' ]) || (count_user_posts( $user->get_id(), 'lp_course') < 1) ) {
	return;
}

$name = $user->get_display_name();

$related_options = [
	// General
	'courses_layout' => 'carousel',
	// Content
	'grid_columns' => 4,
	// Carousel
	'use_pagination' => false,
	'use_navigation' => false,
	// Query
	'author' => $id,
	'order' => 'DSC',
	// Extra
	'caller' => 'related',
];

$attr_map = array_map(
	function($k, $v) { return "$k=\"$v\" "; },
	array_keys($related_options),
	$related_options
);
$related_options = implode( '', $attr_map);

$search_all = $id ? '/?s=&ref=course&order=DSC&author='.$id : '';

// Render
echo
	'<div class="related-courses lp-user-profile">',
		'<div class="iguru_module_title">',
			'<h4>',
				'<a href="', esc_url($search_all), '">',
					$name ? esc_html__( 'Courses by ', 'iguru' ).esc_html($name) : esc_html__( 'Related Courses', 'iguru' ),
				'</a>',
			'</h4>',
		'</div>',
		do_shortcode('[wgl_lp_courses '.$related_options.'][/wgl_lp_courses]'),
	'</div>'
;
