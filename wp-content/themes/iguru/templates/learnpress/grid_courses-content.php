<?php

defined( 'ABSPATH' ) || exit();

/**
 * Template for displaying course content within the loop.
 *
 * @author   WebGeniusLab
 * @package  iGuru/templates/learnpress
 * @version  1.0
 */

global $wgl_courses_atts; // fetch global var 

$defaults = [
	// Content
	'hide_course_title' => '',
	'hide_excerpt' => true,
	'excerpt_chars' => '90',
	'hide_all_meta' => '',
	'hide_categories' => '',
	'hide_instructor' => '',
	'hide_students' => '',
	'hide_reviews' => '',
	// Styles
	'heading_tag' => 'h3',
	'heading_margin_bottom' => '',
	// Extra
	'caller' => learn_press_get_current_profile_tab(),
];

if ($wgl_courses_atts) {
	$atts = vc_shortcode_attribute_parse($defaults, $wgl_courses_atts);
	extract($atts);
} else {
	extract($defaults);
}

// Hide all meta data
if ($hide_all_meta)
	$hide_categories = $hide_instructor = $hide_students = $hide_reviews = true;

// Is it whishlist tab on profile page?
$is_whishlist_tab = $caller == 'wishlist' ? true : false;

// Render
$hide_categories || learn_press_course_categories();

echo '<div class="course-content">';

  learn_press_courses_loop_item_begin_meta();
	if ( ! $hide_instructor ) {
		$course = LP_Global::course();
		$author_link = learn_press_user_profile_link( get_post_field('post_author', $course->get_id()) );
		echo 
			'<a href="', esc_url($author_link), '" class="course-instructor__img">',
				$course->get_instructor()->get_profile_picture(),
			'</a>'
		;
		
			$cid =  $course->get_id();
		
		if($cid == 12)
		{
	        echo '<span class="course-instructor">
	        <a href="#">Diploma</a></span>';
		}
		
		if($cid == 1011)
		{
	        echo '<span class="course-instructor">
	        <a href="#">Graduate Certificate </a></span>';
		}
		
		if($cid == 1091)
		{
	        echo '<span class="course-instructor">
	        <a href="#">Bachelors </a></span>';
		}
		
		if($cid == 1141)
		{
	        echo '<span class="course-instructor">
	        <a href="#">Masters</a></span>';
		}
		
		if($cid == 1221)
		{
	        echo '<span class="course-instructor">
	        <a href="#">Graduate Certificate </a></span>';
		}
		
		if($cid == 1300)
		{
	        echo '<span class="course-instructor">
	        <a href="#">Bachelors </a></span>';
		}
	
	
	}

	if ( ! $hide_course_title ) {
		$margin = $heading_margin_bottom ? 'margin-bottom: '.(int)$heading_margin_bottom.'px;' : '';
		$style = $margin ? ' style="'.esc_attr($margin).'"' : '';
		
		$title = sprintf( '<%1$s class="course-title"%3$s>%2$s</%1$s>',
			$heading_tag,
			esc_html( get_the_title() ),
			$style
		);
		printf( '<a href="%s" class="course-title-wrapper">%s</a>',
			esc_url(get_permalink()),
			$title
		);
	}

	if ( ! $hide_excerpt ) {
		switch ( has_excerpt() ) {
			case true: $info = get_the_excerpt(); break;
			default:   $info = get_the_content(); break;
		}
		$excerpt = preg_replace( '~\[[^\]]+\]~', '', $info);
		$excerpt = strip_tags( $info );
		$excerpt = iGuru_Theme_Helper::modifier_character( $info, $excerpt_chars, '…' );
		printf( '<p class="course-excerpt">%s</p>', $excerpt );
	}
  learn_press_courses_loop_item_end_meta();

  if ( ! $is_whishlist_tab ) :

	echo '<div class="course-divider"></div>';
	echo '<div class="course-meta grid">';
		if ( ! $hide_students )
			printf( '<span class="course-students" title="%s">%d</span>',
				esc_attr(strip_tags(learn_press_get_course()->get_students_html())),
				(int)learn_press_get_course()->count_students()
			);

		if ( ! $hide_reviews && class_exists('LP_Addon_Course_Review_Preload') ) {
			$total_reviews = learn_press_get_course_rate_total( get_the_ID() );
			$total_reviews = $total_reviews != 0 ? $total_reviews : '';
			$reviews_title = !empty($total_reviews) ? sprintf( _n( 'review is submitted', 'reviews are submitted', $total_reviews, 'iguru' ), number_format_i18n( $total_reviews ) ) : esc_html__( 'No any reviews yet', 'iguru' );
			printf( '<span class="course-reviews" title="%1$s %2$s">%1$d</span>',
				$total_reviews, $reviews_title
			);
		}

		if ( class_exists('LP_Addon_Wishlist_Preload') ) {
			remove_action( 'learn-press/after-course-buttons', [ LP_Addon_Wishlist::instance(), 'wishlist_button' ], 100 );
			LP_Addon_Wishlist::instance()->wishlist_button();
		}

		iGuru_LearnPress::iguru_course_button();

		learn_press_course_loop_item_user_progress();

	echo '</div>';

  endif;

echo '</div>';

global $course__content_wrapper;
if ( $course__content_wrapper == 'opened' ) {
	echo '</div>';
}

