<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage iGuru
 * @since 1.0
 * @version 1.0
 */

get_header();

$sb = iGuru_Theme_Helper::get_sidebar_params();
$row_class = $sb['row_class'];
$column = isset($sb['column']) ? $sb['column'] : '12';

?>
    <div class="wgl-container">
        <div class="row<?php echo apply_filters('iguru_row_class', $row_class); ?>">
            <div id='main-content' class="wgl_col-<?php echo apply_filters('iguru_column_class', $column); ?>">
                <?php
                get_template_part('templates/post/posts-list');
                echo iGuru_Theme_Helper::pagination();
                ?>
            </div>
            <?php
                if ($sb) iGuru_Theme_Helper::render_sidebar($sb);
            ?>
        </div>
    </div>
<?php

get_footer();

?>
