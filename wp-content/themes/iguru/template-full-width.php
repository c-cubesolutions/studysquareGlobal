<?php
/**
 * Template Name: Full Width Page
*/

get_header();
the_post();

$sb = iGuru_Theme_Helper::get_sidebar_params();
$row_class = $sb['row_class'];
$column = isset($sb['column']) ? $sb['column'] : '12';

?>
    <div class="wgl-container full-width">
        <div class="row<?php echo apply_filters( 'iguru_row_class', $row_class ); ?>">
            <div id='main-content' class="wgl_col-<?php echo apply_filters( 'iguru_column_class', $column ); ?>">
                <?php
                the_content(esc_html__( 'Read more!', 'iguru' ));
                wp_link_pages(array('before' => '<div class="page-link">' . esc_html__( 'Pages', 'iguru' ) . ': ', 'after' => '</div>'));
                
                if ( comments_open() || get_comments_number() ) comments_template();
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