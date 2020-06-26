<?php

defined( 'ABSPATH' ) || exit();

/**
 * Template for displaying search course form.
 *
 * This template is overridden by WGL team for fine customizing.
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 3.0.0
 */


if ( ! ( learn_press_is_courses() || learn_press_is_search() ) ) return;

?>
<form role="search" method="get" name="search-course" class="learn-press-search-course-form"
      action="<?php echo learn_press_get_page_link( 'courses' ); ?>">

    <input type="text" name="s" class="search-course-input" value="<?php echo esc_attr($s); ?>"
           placeholder="<?php _e( 'Search course&hellip;', 'iguru' ); ?>"/>
    <input type="hidden" name="ref" value="course"/>

    <button class="lp-button button search-course-button search-button"><?php _e( 'Search', 'iguru' ); ?></button>
	
	<i class="search__icon"></i>

</form>