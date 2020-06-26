<?php

defined( 'ABSPATH' ) || exit;

if ( !class_exists('iGuru_header_mobile') ) {
	class iGuru_header_mobile extends iGuru_get_header{

	  public function __construct(){
		$this->header_vars();  
		$this->html_render = 'mobile';
		$name_preset = $this->name_preset;
		$def_preset = $this->def_preset;

		$header_mobile_background = iGuru_Theme_Helper::get_option('mobile_background');
		$header_mobile_color = iGuru_Theme_Helper::get_option('mobile_color');
		$mobile_header_custom =  iGuru_Theme_Helper::get_option('mobile_header');

		$mobile_styles = !empty($header_mobile_background['rgba']) ? 'background-color: '.$header_mobile_background['rgba'].';' : '';
		$mobile_styles .= !empty($header_mobile_color) ? ' color: '.$header_mobile_color.';' : '';
		$mobile_styles = !empty($mobile_styles) ? ' style="'.esc_attr($mobile_styles).'"' : '';
		
		echo
			'<div class="wgl-mobile-header"', $mobile_styles, '>',
			'<div class="container-wrapper">'
		;
		
		if ( !empty($mobile_header_custom) ) {
			$this->build_header_layout('mobile');
		} else {
			$this->default_header_mobile();
		}
		$this->build_header_mobile_menu($name_preset, $def_preset);

		?>
		</div>
		</div><?php
	  }

	  public function default_header_mobile(){
		$mobile_height = esc_attr((int)iGuru_Theme_Helper::get_option('header_mobile_height')['height']);

		$mobile_height_style = isset($mobile_height) ? 'height: '.$mobile_height.'px;' : '';
		$mobile_height_style = !empty($mobile_height_style) ? ' style="'.$mobile_height_style.'"' : '';

		?>
		<div class='wgl-header-row'>
		  <div class='fullwidth-wrapper'>
		    <div class="wgl-header-row_wrapper"<?php echo esc_attr($mobile_height_style); ?>>
			  <div class="header_side display_grow v_align_middle h_align_left">
				<div class="header_area_container"><?php
			
				if ( has_nav_menu('main_menu') ) : ?>
					<nav class='primary-nav'><?php
					if ( function_exists('iguru_main_menu') ) {
						$menu = '';
						if (class_exists( 'RWMB_Loader' ) && $this->id !== 0) {
							if (rwmb_meta('mb_customize_header_layout') == 'custom') {
								$menu = rwmb_meta('mb_menu_header');
							}
						}
						iguru_main_menu ($menu);
					} ?>
					</nav>
					<div class="mobile-hamburger-toggle">
					  <div class="hamburger-box">
						<div class="hamburger-inner"></div>
					  </div>
					</div><?php
				endif; ?>
				</div>
			  </div>

			  <div class='header_side display_grow v_align_middle h_align_center'>
				<div class='header_area_container'><?php
					parent::get_logo('mobile'); ?>
				</div>
			  </div>
			
			  <div class='header_side display_grow v_align_middle h_align_right'>
				<div class='header_area_container'><?php
				  echo iGuru_Theme_Helper::render_html($this->search('mobile', '', 'mobile')); ?>
				</div>
			  </div>
			</div>
		  </div>
		</div><?php
	  }

	}

    new iGuru_header_mobile();
}
