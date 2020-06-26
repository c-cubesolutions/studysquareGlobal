<?php

/**
 * The template for displaying of all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link        https://codex.wordpress.org/Template_Hierarchy
 *
 * @package     WordPress
 * @subpackage  iGuru
 * @since       1.0
 * @version     1.0
 */


get_header();
the_post();

$sb = iGuru_Theme_Helper::get_sidebar_params();
$row_class = $sb['row_class'];
$column = isset($sb['column']) ? $sb['column'] : '12';

?>
<div class="wgl-container">
	<div class="row<?php echo apply_filters( 'iguru_row_class', $row_class ); ?>">
		<div id='main-content' class="wgl_col-<?php echo apply_filters( 'iguru_column_class', $column ); ?>">
			<?php
			the_content( esc_html__( 'Read more!', 'iguru' ) );
			wp_link_pages(
				[
					'before' => '<div class="page-link">' . esc_html__( 'Pages', 'iguru' ) . ': ',
					'after' => '</div>'
				]
			);
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