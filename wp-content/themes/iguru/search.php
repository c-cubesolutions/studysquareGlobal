<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package    WordPress
 * @subpackage iGuru
 * @since      1.0
 * @version    1.0
 */

get_header();

$sb = iGuru_Theme_Helper::get_sidebar_params();
$row_class = $sb['row_class'];
$column = isset($sb['column']) ? $sb['column'] : '12';

?>
	<div class="wgl-container">
		<div class="row<?php echo apply_filters( 'iguru_row_class', $row_class ); ?>">
			<div id='main-content' class="wgl_col-<?php echo apply_filters( 'iguru_column_class', $column ); ?>">
			<?php
				if ( have_posts() ) : ?>
					<header class="searсh-header">
						<h1 class="page-title"><?php
							printf( esc_html__( 'Search Results for: %s', 'iguru' ), '<span>'.get_search_query().'</span>' ); ?>
						</h1>
					</header>
					<?php

					global $wgl_blog_atts;
					global $wp_query;

					$wgl_blog_atts = [
						// General
						'blog_layout' => 'grid',
						'animation_class' => '',
						// Content
						'blog_columns' => '12',
						'hide_media' => false,
						'hide_content' => false,
						'hide_blog_title' => false,
						'hide_postmeta' => false,
						'meta_author' => false,
						'meta_date' => false,
						'meta_comments' => false,
						'meta_categories' => true,
						'hide_likes' => true,
						'hide_share' => true,
						'read_more_hide' => false,
						'read_more_text' => esc_html__( 'View More', 'iguru' ),
						'content_letter_count' => '100',
						'crop_square_img' => 'true',
						'heading_tag' => 'h3',
						'items_load'  => 4,
						'heading_margin_bottom' => '10px',
						// Query
						'query' => $wp_query,
					];
					get_template_part('templates/post/posts-list');
					/* Start the Loop */
					echo iGuru_Theme_Helper::pagination();

				else : ?>

					<div class="page_404_wrapper">
						<header class="searсh-header">
							<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'iguru' ); ?></h1>
						</header>

						<div class="page-content"><?php
							if ( is_search() ) : ?>
								<p class="banner_404_text"><?php
									esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'iguru' ); ?>
								</p><?php
							else : ?>
								<p class="banner_404_text"><?php
									esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'iguru' ); ?>
								</p><?php
							endif; ?>
							<div class="search_result_form"><?php
								get_search_form(); ?>
							</div>
							<div class="iguru_404_button iguru_module_button wgl_button wgl_button-l">
								<a class="wgl_button_link" href="<?php echo esc_url(home_url('/')); ?>"><?php
									esc_html_e( 'Take me home', 'iguru' ); ?>
								</a>
							</div>
						</div>
						
					</div><?php
				endif; ?>
			</div>
			<?php
				if ($sb) iGuru_Theme_Helper::render_sidebar($sb);
			?>
		</div>
	</div>
<?php

get_footer();

?>