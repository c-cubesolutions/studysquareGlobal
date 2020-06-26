<?php

defined( 'ABSPATH' ) || exit();

/**
 * Template for displaying course content within the loop.
 *
 * This template is overridden by WGL team for fine customizing.
 *
 * @author   ThimPress
 * @package  LearnPress/Templates
 * @version  3.0.0
 */


$user = LP_Global::user();

// Render
echo '<div id="post-', the_ID(), '" ', post_class(), '>';

    do_action( 'learn-press/before-courses-loop-item' );

    echo '<a href="', the_permalink(), '" class="course-permalink">';

        do_action( 'learn-press/courses-loop-item-title' );

    echo '</a>';

	do_action( 'learn-press/after-courses-loop-item' );

echo '</div>';