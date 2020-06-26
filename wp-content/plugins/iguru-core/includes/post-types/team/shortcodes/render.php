<?php

defined( 'ABSPATH' ) || exit;

class WglTeam {

	private $shortcodeName;
	public $post_count;

	public function __construct() {
		$this->shortcodeName = 'wgl_team';
		add_action('vc_before_init', array($this, 'shortcodesMap'));
		$this->addShortcode();
	}

	public function shortcodesMap() {
		require_once(WP_PLUGIN_DIR . '/' .trim(dirname(plugin_basename(__FILE__)), '/'). '/options.php');
	}

	public function addShortcode() {
		add_shortcode($this->shortcodeName, [ $this, 'render' ]);
	}

	public function render($atts, $content = null) {
		$theme_color = esc_attr(iGuru_Theme_Helper::get_option('theme-custom-color'));
		$theme_color_secondary = esc_attr(iGuru_Theme_Helper::get_option('theme-secondary-color'));
		$header_font_color = esc_attr(iGuru_Theme_Helper::get_option('header-font')['color']);

		$defaults = [
			// General
			'posts_per_line' => '3',
			'info_align' => 'left',
			'grid_gap' => '30',
			'single_link_wrapper' => false,
			'single_link_heading' => true,
			'hide_title' => false,
			'hide_department' => false,
			'hide_soc_icons' => false,
			'hide_content' => true,
			'letter_count' => '100',
			'item_el_class' => '',
			'animation_class' => '',
			// Carousel
			'use_carousel' => false,
			'autoplay' => false,
			'carousel_infinite' => false,
			'scroll_items' => false,
			'autoplay_speed' => '3000',
			'use_pagination' => false,
			'pag_type' => 'circle',
			'pag_offset' => '',
			'custom_pag_color' => false,
			'pag_color' => $theme_color,
			'use_prev_next' => false,
			'custom_buttons_color' => false,
			'buttons_color' => $theme_color,
			'custom_resp' => false,
			'resp_medium' => '1025',
			'resp_medium_slides' => '',
			'resp_tablets' => '800',
			'resp_tablets_slides' => '',
			'resp_mobile' => '480',
			'resp_mobile_slides' => '',
			// Colors
			'meta_bg_type' => 'def',
			'meta_bg_color_idle' => '#ffffff',
			'meta_bg_color_hover' => '#ffffff',
			'meta_bg_img' => '',
			'custom_title_color' => false,
			'title_color' => $header_font_color,
			'title_hover_color' => $theme_color,
			'custom_depart_color' => false,
			'depart_color' => $theme_color_secondary,
			'custom_soc_color' => false,
			'soc_color' => '#ffffff',
			'soc_hover_color' => $theme_color,
			'custom_soc_bg_color' => false,
			'soc_bg_color' => '#f3f3f3',
			'soc_bg_hover_color' => '#f3f3f3',
			'custom_ovelay' => false,
			'overlay_color' => $header_font_color,
		];

		$atts = vc_shortcode_attribute_parse($defaults, $atts);

		// Animation
		$atts['animation_class'] .= !empty($atts['css_animation']) ? $this->getCSSAnimation( $atts['css_animation'] ) : '';
		extract($atts);

		if ( $use_carousel ) {
			// carousel options array
			$carousel_options_arr = [
				'slide_to_show' => $posts_per_line,
				'autoplay' => $autoplay,
				'autoplay_speed' => $autoplay_speed,
				'use_pagination' => $use_pagination,
				'pag_type' => $pag_type,
				'pag_offset' => $pag_offset,
				'custom_pag_color' => $custom_pag_color,
				'pag_color' => $pag_color,
				'use_prev_next' => $use_prev_next,
				'custom_prev_next_color' => $custom_buttons_color,
				'prev_next_color' => $buttons_color,
				'custom_resp' => $custom_resp,
				'resp_medium' => $resp_medium,
				'resp_medium_slides' => $resp_medium_slides,
				'resp_tablets' => $resp_tablets,
				'resp_tablets_slides' => $resp_tablets_slides,
				'resp_mobile' => $resp_mobile,
				'resp_mobile_slides' => $resp_mobile_slides,
				'infinite' => $carousel_infinite,
				'slides_to_scroll' => $scroll_items,
			];

			// carousel options
			$carousel_options = array_map(function($k, $v) { return "$k=\"$v\" "; }, array_keys($carousel_options_arr), $carousel_options_arr);
			$carousel_options = implode('', $carousel_options);

			wp_enqueue_script('slick', get_template_directory_uri() . '/js/slick.min.js', [], false, false);
		}

		$team_id_attr = '';

		if ( $custom_title_color || $custom_depart_color || $custom_soc_color || $custom_soc_bg_color || $meta_bg_type != 'def' || $custom_ovelay ) {
			$team_id = uniqid( 'iguru_team_' );
			$team_id_attr = 'id='.$team_id;
		}

		// Custom styles
		ob_start();
			if ( $custom_title_color )
				echo
					"#$team_id .team-title {",
						'color: ', (!empty($title_color) ? esc_attr($title_color) : 'transparent'), ';',
					'}',
					"#$team_id .team-title:hover {",
						'color: ', (!empty($title_hover_color) ? esc_attr($title_hover_color) : 'transparent'), ';',
					'}'
				;

			if ( $custom_depart_color ) 
				echo "#$team_id .team-department {",
						  'color: ', (!empty($depart_color) ? esc_attr($depart_color) : 'transparent'), ';',
					  '}';

			if ( $custom_soc_color )
				echo
					"#$team_id .team-info_icons {",
						'color: ', (!empty($soc_color) ? esc_attr($soc_color) : 'transparent'), ';',
					'}',
					"#$team_id .team-info_icons .team-icon:hover {",
						'color: ', (!empty($soc_hover_color) ? esc_attr($soc_hover_color) : 'transparent'), ';',
					'}'
			    ;

			if ( $custom_soc_bg_color )
				echo
					"#$team_id .team-info_icons {",
						'background: ', (!empty($soc_bg_color) ? esc_attr($soc_bg_color) : 'transparent'), ';',
					'}',
					"#$team_id .team-item_content:hover .team-info_icons {",
						'background: ', (!empty($soc_bg_hover_color) ? esc_attr($soc_bg_hover_color) : 'transparent'), ';',
					'}'
				;

			if ( $meta_bg_type == 'color' )
				echo
					"#$team_id .team-item_info {",
						'background: ', (!empty($meta_bg_color_idle) ? esc_attr($meta_bg_color_idle) : '#ffffff'), ';',
					'}',
					"#$team_id .team-item:hover .team-item_info {",
						'background: ', (!empty($meta_bg_color_hover) ? esc_attr($meta_bg_color_hover) : '#ffffff'), ';',
					'}'
				;

			if ( $meta_bg_type == 'image' ) {
				$img_src = esc_url(wp_get_attachment_image_src($meta_bg_img, 'full')[0]);
				$bg_img = !empty($img_src) ? 'background-image: url('.$img_src.')' : '';
				echo "#$team_id .team-item_info {",
						  'background-color: #fff;',
						  "$bg_img;",
					  '}';
			}
			if ( $custom_ovelay )
				echo "#$team_id .overlay {",
						  'background-color: ', (!empty($overlay_color) ? esc_attr($overlay_color) : 'transparent'), ';',
					  '}';

		$styles = ob_get_clean();
		iGuru_shortcode_css()->enqueue_iguru_css($styles);

		$style_gap = ($grid_gap != '0') ? ' style="margin-right: -'.esc_attr($grid_gap/2).'px; margin-left: -'.esc_attr($grid_gap/2).'px;"' : '';
		$team_classes = 'team-col_'.$posts_per_line;
		$team_classes .= ' a'.$info_align;
		
		ob_start();
			render_wgl_team($atts);
		$team_items = ob_get_clean();

		ob_start(); ?>
		<div <?php echo esc_attr($team_id_attr); ?> class="wgl_module_team <?php echo esc_attr($team_classes); ?>">
			<div class="team-items_wrap" <?php echo iGuru_Theme_Helper::render_html($style_gap); ?>>
				<?php
				switch ( $use_carousel ) {
					case true: echo do_shortcode('[wgl_carousel '.$carousel_options.']'.$team_items.'[/wgl_carousel]'); break;
					default: echo iGuru_Theme_Helper::render_html($team_items); break;
				}
				?>
			</div>
		</div>
		<?php

		return ob_get_clean();
	}
}