<?php

defined( 'ABSPATH' ) || exit();

/**
 * Template for displaying overview tab of single course.
 *
 * This template is overridden by WGL team for fine customizing.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

global $course;

do_action( 'iguru/learn-press/first-in-tab-panel-overview' );

?>

<div class="course-description" id="learn-press-course-description">

	<?php
	/**
	 * @deprecated
	 */
	do_action( 'learn_press_begin_single_course_description' );

	/**
	 * @since 3.0.0
	 */
	do_action( 'learn-press/before-single-course-description' );

	echo iGuru_Theme_Helper::render_html( $course->get_content() );

	/**
	 * @since 3.0.0
	 */
	do_action( 'learn-press/after-single-course-description' );

	/**
	 * @deprecated
	 */
	do_action( 'learn_press_end_single_course_description' );
	?>

</div>

<?php do_action( 'iguru/learn-press/last-in-tab-panel-overview' ); ?>