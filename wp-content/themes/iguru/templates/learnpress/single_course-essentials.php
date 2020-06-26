<?php

defined( 'ABSPATH' ) || exit();

/**
 * Template for displaying course essentials.
 *
 * @author   WebGeniusLab
 * @package  iGuru/templates/learnpress
 * @version  1.0
 */


$course = LP_Global::course();
$course_id = get_the_ID();

$title = sprintf( '%s %s', esc_html__( 'Price:', 'iguru' ), iGuru_LearnPress::course_price_html() );
$students_title = strip_tags( $course->get_students_html() );

$duration = get_post_meta( $course_id, '_lp_duration', true );

$meta_fields = [
	'language',
	'skill_level',
	'downloadable',
	'applicables',
	'certificate',
	'description'
];
foreach ($meta_fields as $meta)
	${$meta} = get_post_meta( $course_id, 'iguru_course_'.$meta, true );

?>
<div class="wgl-course-essentials">
	<h3 class="title"><?php echo apply_filters( 'iguru/learn-press/render-course-essentials/title', $title ) ; ?></h3>
	<ul>
		<li class="students" title="<?php echo esc_attr($students_title); ?>">
			<i class="fa fa-user"></i>
			<?php $users = $course->get_users_enrolled(); ?>
			<span class="value"><?php $users ? printf( '%d %s', esc_html($users), _n( 'Student Enrolled', 'Students Enrolled', $users, 'iguru' )) : esc_html_e( 'Be the first student', 'iguru' ); ?></span>
		</li><?php
		if ( $language ) : ?>
		  <li class="language">
			<i class="fa fa-globe"></i>
			<span class="label"><?php esc_html_e( 'Language:', 'iguru' ); ?></span>
			<span class="value"><?php echo esc_html($language); ?></span>
		  </li><?php
		endif;
		if ( $v = (int)$duration ) :
			preg_match('/\d (\w*)/', $duration, $match);
			if (isset($match[1])) {
				switch ($match[1]) {
					case 'minute': $s = _n( 'minute', 'minutes', $v, 'iguru' ); break;
					case 'hour': $s = _n( 'hour', 'hours', $v, 'iguru' ); break;
					case 'day': $s = _n( 'day', 'days', $v, 'iguru' ); break;
					case 'week': $s = _n( 'week', 'weeks', $v, 'iguru' ); break;
				}
				$duration = sprintf( '%d %s', $v, $s);
			}
			?>
			<li class="duration">
				<i class="fa fa-clock-o"></i>
				<span class="label"><?php esc_html_e( 'Duration:', 'iguru' ); ?></span>
				<span class="value"><?php printf('%s', $duration); ?></span>
			</li><?php
		endif;
		if ( $skill_level ) : ?>
		  <li class="skill">
			<i class="fa fa-unlock-alt"></i>
			<span class="label"><?php esc_html_e( 'Skill level:', 'iguru' ); ?></span>
			<span class="value"><?php echo esc_html( $skill_level ); ?></span>
		  </li><?php
		endif; ?>
		<li class="lectures">
			<i class="fa fa-files-o"></i>
			<span class="label"><?php esc_html_e( 'Lectures:', 'iguru' ); ?></span>
			<span class="value"><?php printf('%s', $course->get_curriculum_items( 'lp_lesson' ) ? count( $course->get_curriculum_items( 'lp_lesson' ) ) : 0); ?></span>
		</li><?php
		if ( $quizzes = $course->get_curriculum_items( 'lp_quiz' ) ) : ?>
		  <li class="quizzes">
			<i class="fa fa-puzzle-piece"></i>
			<span class="label"><?php esc_html_e( 'Quizzes:', 'iguru' ); ?></span>
			<span class="value"><?php printf('%s', $quizzes ? count($quizzes) : 0); ?></span>
		  </li><?php
		endif;
		if ( $downloadable ) : ?>
		  <li class="downloadable">
			<i class="fa fa-download"></i>
			<span class="value"><?php echo esc_html($downloadable); ?></span>
		  </li><?php
		endif;
		if ( $applicables ) : ?>
		  <li class="applicables">
			<i class="fa fa-tag"></i>
			<span class="value"><?php echo esc_html($applicables); ?></span>
		  </li><?php
		endif;
		if ( $certificate ) : ?>
		  <li class="certificate">
			<i class="fa fa-certificate"></i>
			<span class="value"><?php echo esc_html($certificate); ?></span>
		  </li><?php
		endif;
		if ( $description ) : ?>
		  <li class="description">
			<i class="fa fa-pencil"></i>
			<span class="value"><?php echo esc_html($description); ?></span>
		  </li><?php
		endif; ?>
	</ul><?php
	do_action( 'iguru/learn-press/after-course-essentials' ); ?>
</div><?php 
