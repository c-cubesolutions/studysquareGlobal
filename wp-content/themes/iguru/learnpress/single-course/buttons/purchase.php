<?php

defined( 'ABSPATH' ) || exit();

/**
 * Template for displaying Purchase button in single course.
 *
 * This template is overridden by WGL team for fine customizing.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

if ( ! isset( $course ) ) $course = learn_press_get_course();

do_action( 'learn-press/before-purchase-form' );
?>

    <form name="purchase-course" class="purchase-course" method="post" enctype="multipart/form-data">

		<?php do_action( 'learn-press/before-purchase-button' ); ?>

        <input type="hidden" name="purchase-course" value="<?php echo esc_attr( $course->get_id() ); ?>"/>
        <input type="hidden" name="purchase-course-nonce"
               value="<?php echo esc_attr( LP_Nonce_Helper::create_course( 'purchase' ) ); ?>"/>

        <button class="lp-button button button-purchase-course" title="<?php echo esc_html__( 'Buy this course', 'iguru' ); ?>">
			<?php echo apply_filters( 'learn-press/purchase-course-button-text', esc_html__( 'Buy this course', 'iguru' ) ); ?>
        </button>

		<?php do_action( 'learn-press/after-purchase-button' ); ?>

    </form>

<?php do_action( 'learn-press/after-purchase-form' ); ?>