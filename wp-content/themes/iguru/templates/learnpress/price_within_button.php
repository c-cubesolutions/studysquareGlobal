<?php

defined( 'ABSPATH' ) || exit();

/**
 * Template for displaying course price within the loop.
 *
 * @author   WebGeniusLab
 * @package  iGuru/templates/learnpress
 * @version  1.0
 */

$course = LP_Global::course();

// Render
echo '<span class="course-price">';

	if ( $price = $course->get_price_html() ) :

		if ( $course->get_origin_price() != $course->get_price() ) :

            echo '<span class="origin-price">', esc_html( $course->get_origin_price_html() ), '</span>';

		endif;

        echo "<span class='price'> Sep'20 Intake</span>";

	endif;

echo '</span>';
