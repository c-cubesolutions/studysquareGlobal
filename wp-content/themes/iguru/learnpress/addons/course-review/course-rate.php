<?php

defined( 'ABSPATH' ) || exit;

/**
 * Template for displaying course rate.
 *
 * This template is overridden by WGL team for fine customizing.
 *
 * @author    ThimPress
 * @package   LearnPress/Course-Review/Templates
 * @version   3.0.1
 */


$course_rate_res = learn_press_get_course_rate( get_the_ID(), false );
$course_rate = $course_rate_res['rated'];
$total = $course_rate_res['total'];

?>
<div class="course-rate">
	<div class="average"><?php
		printf( '<div class="rating" title="%s">%.1f</div>', __( 'Average Rating', 'iguru' ), $course_rate );
		learn_press_course_review_template( 'rating-stars.php', ['rated' => $course_rate] );
		printf( '<div class="total-reviews">%d %s</div>', $total, _n( 'Rating', 'Ratings', $total, 'iguru' ) );
	?>
	</div>
	<div class="precise"><?php
		if ( isset( $course_rate_res['items'] ) && ! empty( $course_rate_res['items'] ) ):
			foreach ( $course_rate_res['items'] as $item ) :
				echo
					'<div class="precise-rate">',
						'<span class="review-name">',
							esc_html( $item['rated'] ),
							' ',
							esc_html__( 'Star', 'iguru' ),
						'</span>',
						'<div class="review-bar">',
							'<div class="rating" style="width: ', esc_attr( $item['percent'].'%;' ), '"></div>',
						'</div>',
						'<span class="review-percent">',
							esc_html( $item['percent'].'%' ),
						'</span>',
					'</div>'
				;
			endforeach;
		endif;
		?>
	</div>
</div>
