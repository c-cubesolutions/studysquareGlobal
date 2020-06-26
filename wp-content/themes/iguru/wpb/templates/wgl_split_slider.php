<?php

$theme_secondary_color = esc_attr(iGuru_Theme_Helper::get_option("theme-secondary-color"));

$defaults = array(
	'use_prev_next' => true,
	'custom_prev_next_offset' => false,
	'prev_next_offset' => '50%',	
	'custom_prev_next_color' => false,
	'active_color' => $theme_secondary_color,
	'extra_class' => '',
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

wp_enqueue_script('easings', get_template_directory_uri() . '/js/jquery.easings.min.js', array(), false, false);
wp_enqueue_script('multiscroll', get_template_directory_uri() . '/js/jquery.multiscroll.min.js', array(), false, false);

// Custom colors
ob_start();
	if ( (bool)$custom_prev_next_color ) {
		echo "#multiscroll-nav li .active span, #multiscroll-nav li span, #multiscroll-nav li a:hover span{
				  background-color: ".(!empty($active_color) ? esc_attr($active_color) : 'transparent').";
			  }";		
	}

	if ( (bool) $custom_prev_next_offset ) {
		if ( !empty($prev_next_offset) ) {
			echo "#multiscroll-nav{
				top: ".(int)$prev_next_offset."%;
			}";
		}
	}
$styles = ob_get_clean();
iGuru_shortcode_css()->enqueue_iguru_css($styles);

$classes = !empty($extra_class) ? ' '.$extra_class : '';
echo '<div class="iguru_module_split_slider-wrapper'.esc_attr($classes).'">';
	echo '<div class="iguru_module_split_slider">';
		echo do_shortcode($content);
	echo '</div>';

	echo '<div class="iguru_module_split_slider-responsive">';
	echo '</div>';
echo '</div>';

