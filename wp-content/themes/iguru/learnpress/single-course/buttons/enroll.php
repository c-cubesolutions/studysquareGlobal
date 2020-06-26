<?php

defined( 'ABSPATH' ) || exit();

/**
 * Template for displaying Enroll button in single course.
 *
 * This template is overridden by WGL team for fine customizing.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

if ( ! isset( $course ) ) $course = learn_press_get_course();

do_action( 'learn-press/before-enroll-form' ); 

?>

    <form name="enroll-course" class="enroll-course" method="post" enctype="multipart/form-data">

		<?php do_action( 'learn-press/before-enroll-button' ); ?>

        <input type="hidden" name="enroll-course" value="<?php echo esc_attr( $course->get_id() ); ?>"/>
        <input type="hidden" name="enroll-course-nonce"
               value="<?php echo esc_attr( LP_Nonce_Helper::create_course( 'enroll' ) ); ?>"/>

        <button class="lp-button button button-enroll-course" title="<?php echo esc_html__( 'Enroll this course', 'iguru' ); ?>">
			<?php echo apply_filters( 'learn-press/enroll-course-button-text', esc_html__( 'Enroll', 'iguru' ) ); ?>
        </button>

		<?php do_action( 'learn-press/after-enroll-button' ); ?>

    </form>

<?php do_action( 'learn-press/after-enroll-form' ); ?>