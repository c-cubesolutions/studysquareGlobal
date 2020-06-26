<?php

defined( 'ABSPATH' ) || exit();

/**
 * Template for displaying wrap start of archive course within the loop.
 *
 * This template is overridden by WGL team for fine customizing.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

$class = '';
if ( learn_press_is_courses() || learn_press_is_search() ) {
	$columns = iGuru_Theme_Helper::get_option('learnpress_archive_columns');
	$columns = $columns ?: 3;

	$class .= " grid-col-{$columns}";
}

echo '<div class="learn-press-courses', esc_attr($class), '">';
