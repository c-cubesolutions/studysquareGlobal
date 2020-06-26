<?php
/**
 * The template for displaying 404 page
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package    WordPress
 * @subpackage iGuru
 * @since      1.0
 * @version    1.0
 */
get_header();
	
	?>
	<div class="wgl-container full-width">
		<div class="row">
			<div class="wgl_col-12">
				<section class="page_404_wrapper" style="background-image: url(<?php echo esc_url(get_template_directory_uri()."/img/404-bg.png"); ?>); ">
					<div class="banner_404">
						<span>4</span>
						<img src="<?php echo esc_url(get_template_directory_uri()."/img/404_moon.png"); ?>">
						<span>4</span>
					</div>
					<h2 class="banner_404_title"><?php echo esc_html__( 'Sorry We Can\'t Find That Page!', 'iguru' ); ?></h2>
					<p class="banner_404_text"><?php echo esc_html__( 'The page you are looking for was moved, removed, renamed or never existed.', 'iguru' ); ?></p>
					<div class="iguru_404_search">
						<?php get_search_form(); ?>
					</div>
					<div class="iguru_404_button iguru_module_button wgl_button wgl_button-l">
						<a class="wgl_button_link" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e( 'Take Me Home', 'iguru' ); ?></a>
					</div>
				</section>
			</div>
		</div>
	</div><?php

get_footer(); ?>