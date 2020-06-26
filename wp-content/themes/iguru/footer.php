<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #main div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage iGuru
 * @since 1.0
 * @version 1.0
 */

global $iguru_dynamic_css;

$scroll_up = iGuru_Theme_Helper::get_option('scroll_up');

?>
	</main><?php

		get_template_part('templates/section', 'footer');

		if ( is_page() ) {
			$social_shares = iGuru_Theme_Helper::get_option('show_soc_icon_page');

			if ( class_exists( 'RWMB_Loader' ) && get_queried_object_id() !== 0 ) {
			    $mb_social_shares = rwmb_meta('mb_customize_soc_shares');
			    
			    if ($mb_social_shares == 'on') {
			        $social_shares = '1'; 
			    } elseif ($mb_social_shares == 'off') {
			        $social_shares = '';
			    }
			}

			if ( !empty($social_shares) && function_exists('wgl_theme_helper') ) {
			    echo wgl_theme_helper()->render_social_shares();
			}			
		}

		if ( $scroll_up ) echo "<a href='#' id='scroll_up'></a>";

		echo '<span id="iguru-footer-inline-css" class="dynamic_styles-footer">';
			if ( isset($iguru_dynamic_css['style']) && !empty($iguru_dynamic_css['style']) ) {
				echo iGuru_Theme_Helper::render_html($iguru_dynamic_css['style']);
			}
		echo '</span>';

		wp_footer();
?>
</body>
</html>