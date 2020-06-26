<?php

defined( 'ABSPATH' ) || exit();

/**
 * Template for displaying related courses.
 *
 * @author   WebGeniusLab
 * @package  iGuru/templates/learnpress
 * @version  1.0
 */

$related_switch = iGuru_Theme_Helper::get_option('learnpress_related_switch');

if ( ! $related_switch || ! class_exists('Vc_Manager') ) return;

$related_title = iGuru_Theme_Helper::get_option('learnpress_related_title');
$related_columns = iGuru_Theme_Helper::get_option('learnpress_related_columns');
$related_items = iGuru_Theme_Helper::get_option('learnpress_related_items');

$related_columns = $related_columns ? $related_columns : 3;
$related_items = $related_items ? $related_items : 3;


$taxonomies = [];
$count = 0;
if ( $tags = get_the_terms( $post->ID, 'course_tag' ) ) 
	foreach ( $tags as $term ) {
		$taxonomies[] = $term->taxonomy.':'.$term->slug;
		if ( $count < $related_items ) $count += get_term_by('slug', $term->slug, $term->taxonomy)->count;
	}

if ( ! $count && $cats = get_the_terms( $post->ID, 'course_category' ) )
	foreach ( $cats as $term ) {
		$taxonomies[] = $term->taxonomy.':'.$term->slug;
		if ( $count < $related_items ) $count += get_term_by('slug', $term->slug, $term->taxonomy)->count;
	}

if ( $count < 2 ) return; // abort if no any related courses

$related_options = [
	// General
	'courses_layout' => 'carousel',
	// Content
	'grid_columns' => $related_columns,
	// Carousel
	'use_pagination' => false,
	'use_navigation' => false,
	// Query
	'number_of_posts' => $related_items,
	'taxonomies' => implode( ', ', $taxonomies),
	'by_posts' => $post->post_name,
	'exclude_any' => 'true',
	'order_by' => 'rand',
	// Extra
	'caller' => 'related',
];

$related_options = array_map(
	function($k, $v) { return "$k=\"$v\" "; },
	array_keys($related_options),
	$related_options
);
$related_options = implode( '', $related_options);


// Render
echo
	'<div class="related-courses">',
		'<div class="iguru_module_title">',
			'<h4>',
				$related_title ? esc_html($related_title) : esc_html__( 'Related Courses', 'iguru' ),
			'</h4>',
		'</div>',
		do_shortcode('[wgl_lp_courses '.$related_options.'][/wgl_lp_courses]'),
	'</div>'
;
