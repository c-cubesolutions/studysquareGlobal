<?php

defined( 'ABSPATH' ) || exit;

/**
*  Page Title area
*
*
*  @class       iGuru_get_page_title
*  @version     1.0
*  @category    Class
*  @author      WebGeniusLab
*/

if (!class_exists('iGuru_get_page_title')) {
	class iGuru_get_page_title{

		private static $instance = null;
		public static function get_instance( ) {
			if ( null == self::$instance ) {
				self::$instance = new self( );
			}

			return self::$instance;
		}

		public function __construct() {
			$this->init();
		}

		private $page_title_switch;
		private $mb_page_title_switch;
		private $heading_page_title;
		private $single;

		protected $id;
 
		public function init() {
			$this->id = get_queried_object_id();
			$this->page_title_switch = iGuru_Theme_Helper::get_option('page_title_switch') == '1' || iGuru_Theme_Helper::get_option('page_title_switch') == true ? 'on' : 'off';
			if ( class_exists('RWMB_Loader') && $this->id !== 0 ) {
				$this->mb_page_title_switch = rwmb_meta('mb_page_title_switch');
			}
			/**
			* The following post types don't have Page Titles:
			*	- blog single type 3;
			*	- portfolio single type 3 and 4;
			*
			* @since  1.0
			* @access private
			*/
			$this->check_single_type();
			
			/**
			*  Generate html header rendered
			*
			*
			*  @since  1.0
			*  @access public
			*/
			$this->page_title_render_html();
		}

		private function check_single_type() {
			if ( get_post_type($this->id) == 'post' && is_single() ) {
				$single['type'] = 'post';
				$single['layout'] = iGuru_Theme_Helper::options_compare('single_type_layout', 'mb_post_layout_conditional', 'custom');
				if ( $single['layout'] === '3' ) {
					$this->page_title_switch = 'off';
				}
			}
			if ( get_post_type($this->id) == 'portfolio' && is_single() ) {
				$single['type'] = 'portfolio';
				$single['layout'] = iGuru_Theme_Helper::options_compare('portfolio_single_type_layout', 'mb_portfolio_post_conditional', 'custom');
				if ( in_array($single['layout'], range(3, 4)) ) {
					$this->page_title_switch = 'off';
				}
			}
			$this->single = isset($single) ? $single : null;

			return $this->single;
		}

		public function page_title_render_html() {
			if ( $this->mb_page_title_switch == 'on' ) {
				$this->page_title_switch = 'on'; 
			}

			if ( is_home() || is_front_page() || $this->mb_page_title_switch == 'off' ) {
				$this->page_title_switch = 'off';
			}

			if ($this->page_title_switch == 'on') {
				// Title
				$iguru_page_title = $this->iguru_page_title();
				if ( !empty($iguru_page_title) ) {
					$page_title_font = iGuru_Theme_Helper::options_compare('page_title_font', 'mb_page_title_switch', 'on');
					$page_title_font_color = !empty($page_title_font['color']) ? 'color: '.$page_title_font['color'].';' : '';
					$page_title_font_size = !empty($page_title_font['font-size']) ? ' font-size: '.(int)$page_title_font['font-size'].'px;' : '';
					$page_title_font_height = !empty($page_title_font['line-height']) ? ' line-height: '.(int)$page_title_font['line-height'].'px;' : '';
					$title_style = 'style="'.$page_title_font_color.$page_title_font_size.$page_title_font_height.'"';
				}

				// Breadcrumbs
				if ( $this->single['type'] == 'post' && in_array($this->single['layout'], range(1,2)) ) { // Blog type 1-2 have individual options for fine customization
					$page_title_breadcrumbs_switch = ($this->mb_page_title_switch == 'on') ? rwmb_meta('mb_page_title_breadcrumbs_switch') : iGuru_Theme_Helper::get_option('blog_single_page_title_breadcrumbs_switch');
				} else {
					$page_title_breadcrumbs_switch = iGuru_Theme_Helper::options_compare('page_title_breadcrumbs_switch', 'mb_page_title_switch', 'on');
				}
				if ( (bool)$page_title_breadcrumbs_switch ) {
					$page_title_breadcrumbs_font = iGuru_Theme_Helper::options_compare('page_title_breadcrumbs_font', 'mb_page_title_switch', 'on');
					$page_title_breadcrumbs_font_color = !empty($page_title_breadcrumbs_font['color']) ? 'color: '.$page_title_breadcrumbs_font['color'].';' : '';
					$page_title_breadcrumbs_font_size = !empty($page_title_breadcrumbs_font['font-size']) ? ' font-size: '.(int)$page_title_breadcrumbs_font['font-size'].'px;' : '';
					$page_title_breadcrumbs_font_height = !empty($page_title_breadcrumbs_font['line-height']) ? ' line-height: '.(int)$page_title_breadcrumbs_font['line-height'].'px;' : '';
					$breadcrumbs_style = ' style="'.$page_title_breadcrumbs_font_color.$page_title_breadcrumbs_font_size.$page_title_breadcrumbs_font_height.'"';
					ob_start(); 
						get_template_part( 'templates/breadcrumbs' );
					$breadcrumbs_part = ob_get_clean();
				}

				// Parallax
				$page_title_parallax = iGuru_Theme_Helper::options_compare('page_title_parallax', 'mb_page_title_switch', 'on');
				if ( (bool)$page_title_parallax ) wp_enqueue_script('paroller', get_template_directory_uri() . '/js/jquery.paroller.min.js', array(), false, false);
				$page_title_parallax_speed = apply_filters("pagetitle_parallax_speed", iGuru_Theme_Helper::options_compare('page_title_parallax_speed', 'mb_page_title_switch', 'on'));
				$page_title_parallax_class = (bool)$page_title_parallax ? ' page_title_parallax' : '';
				$page_title_parallax_data_speed = !empty($page_title_parallax_speed) ? $page_title_parallax_speed : '0.3';

				$classes = $this->page_title_classes();
				$classes = !empty($classes) ? esc_attr($classes) : '';
				$styles = $this->page_title_styles();
				$styles = !empty($styles) ? ' style="'.esc_attr($styles).'"' : '';
				$data_attr = (!empty($page_title_parallax_data_speed) && (bool)$page_title_parallax) ? ' data-paroller-factor='.$page_title_parallax_data_speed : '';	

				$output = '<div class="page-header'. $classes . $page_title_parallax_class .'"'. $styles . $data_attr .'>';
				  $output .= '<div class="page-header_wrapper">';
					$output .= '<div class="wgl-container">';
					  $output .= '<div class="page-header_content">';
						if ( !empty($iguru_page_title) ) {
							$user_tag = iGuru_Theme_Helper::options_compare('page_title_tag', 'mb_page_title_switch', 'on');
							$theme_tag = !empty($this->heading_page_title) ? $this->heading_page_title : 'div';
							$tag = !empty($user_tag) && $user_tag != 'def' ? $user_tag : $theme_tag;
							$output .= sprintf( '<%1$s class="page-header_title" %2$s>%3$s</%1$s>',
								$tag, $title_style, $iguru_page_title
							);
						}
						if ( function_exists('is_product') && is_product() ) {
							$output .= "<div class='page-header_wrapper_product'>";
						}
						if ( (bool)$page_title_breadcrumbs_switch ) {
							$output .= '<div class="page-header_breadcrumbs"'.$breadcrumbs_style.'>';
								$output .= $breadcrumbs_part;
							$output .= '</div>';
						}
						if ( function_exists('is_product') && is_product() && function_exists('iguru_woocommerce_prev_next') ) {
							$output .= iguru_woocommerce_prev_next();
						}
						if ( function_exists('is_product') && is_product() ) {
							$output .= "</div>";
						}
					  $output .= '</div>';
					$output .= '</div>';
				  $output .= '</div>';
				$output .= '</div>';
				
				echo iGuru_Theme_Helper::render_html($output);
			}
		}

		public function iguru_page_title() {
			$title = '';
			if (is_home() || is_front_page()) {
				$title = '';

			} elseif ( is_category() ) {
				$title = single_cat_title('', false);

			} elseif ( is_tag() ) {
				$title = single_term_title("", false).esc_html__( ' Tag', 'iguru' );

			} elseif ( is_date() ) {
				$title = get_the_time('F Y');

			} elseif( is_author() ) {
				$title = esc_html__( 'Author:', 'iguru' ) .' '. get_the_author();

			} elseif ( is_search() ) {
				$title = esc_html__( 'Search', 'iguru' );

			} elseif ( function_exists('learn_press_is_search') && learn_press_is_search() ) {
				$title = esc_html__( 'Search Courses', 'iguru' );

			} elseif ( is_404() ) {
				$this->heading_page_title = 'h1';
				$title = (bool)iGuru_Theme_Helper::get_option('404_custom_title_switch') ? iGuru_Theme_Helper::get_option('404_page_title_text') : esc_html__( 'Error Page', 'iguru' );

			} elseif ( is_singular('portfolio') ) {
				$portfolio_title_conditional = iGuru_Theme_Helper::get_option('portfolio_title_conditional') == '1' ? 'on' : 'off';
				$portfolio_title_text = !empty(iGuru_Theme_Helper::get_option('portfolio_single_page_title_text')) ? iGuru_Theme_Helper::get_option('portfolio_single_page_title_text') : '';

				$title = $portfolio_title_conditional == 'on' ? esc_html($portfolio_title_text) : esc_html(get_the_title());
				$title = apply_filters( 'iguru_page_title_portfolio_text', $title );

			} elseif ( is_singular('team') ) {
				$team_title_condition = iGuru_Theme_Helper::get_option('team_title_conditional') == '1' ? 'on' : 'off';
				$team_title_text = !empty(iGuru_Theme_Helper::get_option('team_single_page_title_text')) ? iGuru_Theme_Helper::get_option('team_single_page_title_text') : '';

				$title = $team_title_condition == 'on' ? esc_html($team_title_text) : esc_html(get_the_title());
				$title = apply_filters( 'iguru_page_title_team_text', $title );

			} elseif ( function_exists('is_product') && ( is_product() ) ) {
				$shop_title_conditional = iGuru_Theme_Helper::get_option('shop_title_conditional') == '1' ? 'on' : 'off';
				$shop_title_text = !empty(iGuru_Theme_Helper::get_option('shop_single_page_title_text')) ? iGuru_Theme_Helper::get_option('shop_single_page_title_text') : '';

				$title = $shop_title_conditional == 'on' ? esc_html($shop_title_text) : esc_html(get_the_title());
				$title = apply_filters( 'iguru_page_title_shop_text', $title );

			} elseif ( function_exists('is_learnpress') && is_learnpress() ) {
				switch (true) {
					case ( learn_press_is_course() ): $lp_type = 'single'; break;
					case ( learn_press_is_courses() ): $lp_type = 'archive'; break;
				}
				$lp_title_switch = iGuru_Theme_Helper::get_option('learnpress_'.$lp_type.'_title_switch');
				$lp_title_text = !empty(iGuru_Theme_Helper::get_option('learnpress_'.$lp_type.'_page_title_text')) ? iGuru_Theme_Helper::get_option('learnpress_'.$lp_type.'_page_title_text') : '';

				$title = $lp_title_switch ? esc_html($lp_title_text) : esc_html(get_the_title());

			} elseif ( is_archive() ) {
				if ( function_exists('is_shop') && (is_shop() || is_product_category() || is_product_tag()) ) {
					$title = esc_html__( 'Shop', 'iguru' );
				} else {
					$title = esc_html__( 'Archive', 'iguru' );
				}

			} else {

				global $post;

				if ( !empty($post) ) {
					$id = $post->ID;
					$posttype = get_post_type($post);
					$blog_title_conditional = iGuru_Theme_Helper::get_option('blog_title_conditional') == '1' ? 'on' : 'off';
					$blog_title_text = !empty(iGuru_Theme_Helper::get_option('post_single_page_title_text')) ? iGuru_Theme_Helper::get_option('post_single_page_title_text') : '';
					if ( $posttype == 'post' ) {
						$title = ($blog_title_conditional == 'on') ? esc_html($blog_title_text) : esc_html(get_the_title($id));
						$title = apply_filters( 'iguru_page_title_blog_text', $title );
					} else {
						$this->heading_page_title = 'h1';
						$title = esc_html(get_the_title($id));
					}
				} else {
					$title = esc_html__( 'No Posts', 'iguru' );
				}

			}
			if ( $this->mb_page_title_switch == 'on' ) {
				$custom_title_switch = rwmb_meta( 'mb_page_change_tile_switch' ); 
				
				if ( !empty($custom_title_switch) ) {
					$custom_title = rwmb_meta('mb_page_change_tile'); 
					$title = !empty($custom_title) ? esc_html($custom_title) : '';
					$title = apply_filters( 'iguru_page_title_custom_text', $title );
				}
			}
			
			return $title;
		}
		public function page_title_classes() {
		
			if ( is_singular('lp_course') || is_singular('portfolio') || function_exists('is_product') && is_product() ) {
				// The following post types have individual options for fine customization
				switch (true) {
					case (is_singular('lp_course'))                      : $post_type = 'learnpress'; break;
					case (is_singular('portfolio'))                      : $post_type = 'portfolio'; break;
					case (function_exists('is_product') && is_product()) : $post_type = 'shop';      break;
				}
				$page_title_align = iGuru_Theme_Helper::get_option($post_type.'_single_title_align');
				$breadcrumbs_align = iGuru_Theme_Helper::get_option($post_type.'_single_breadcrumbs_align');
				if ( class_exists('RWMB_Loader') && ($this->id !== 0) && (rwmb_meta('mb_page_title_switch') == 'on') ) {
					$page_title_align = rwmb_meta('mb_page_title_align');
					$breadcrumbs_align = rwmb_meta('mb_page_title_breadcrumbs_align');
				}
			} else {
				$page_title_align = iGuru_Theme_Helper::options_compare( 'page_title_align', 'mb_page_title_switch', 'on' );
				$breadcrumbs_align = iGuru_Theme_Helper::options_compare( 'page_title_breadcrumbs_align', 'mb_page_title_switch', 'on' );
			}

			$breadcrumbs_align_class = ($breadcrumbs_align != $page_title_align) ? ' breadcrumbs_align_'.esc_attr($breadcrumbs_align) : '';

			$page_title_classes = ' page-header_align_'. (!empty($page_title_align) ? esc_attr($page_title_align) : 'left');
			$page_title_classes .= $breadcrumbs_align_class;
			return $page_title_classes;
		}

		public function page_title_styles() {

			// Check custom post types
			switch ( get_post_type($this->id) ) {
				case 'post':
					$cpt_type_title = 'post';
					$cpt_title = is_single() ? 'single' : 'archive';
					break;
				case 'team':
					$cpt_type_title = 'team';
					$cpt_title = is_single() ? 'single' : 'archive';
					break;
				case 'portfolio':
					$cpt_type_title = 'portfolio';
					$cpt_title = is_single() ? 'single' : 'archive';
					break;
				default: $cpt_title = $cpt_type_title = '';
			}

			// Check the LearnPress page type
			if ( function_exists('is_learnpress') && is_learnpress() ) {
				$cpt_type_title = 'learnpress';

				switch (true) {
					case ( is_single() ):
						$cpt_title = 'single';
						break;
					case ( function_exists('learn_press_is_courses') && learn_press_is_courses() ):
						$cpt_title = 'archive';
						break;
					default:
						$cpt_title = $cpt_type_title = '';
				}
			}

			// Check the Shop page type
			switch (true) {
				case ( function_exists('is_shop') && is_shop() )         : $shop_title = 'catalog';  break;
				case ( function_exists('is_product') && is_product() )   : $shop_title = 'single';   break;
				case ( function_exists('is_cart') && is_cart() )         : $shop_title = 'cart';     break;
				case ( function_exists('is_checkout') && is_checkout() ) : $shop_title = 'checkout'; break;
				default: $shop_title = '';
			}

			// Following post types have individual options for fine customization
			if ( is_singular('lp_course') || is_singular('portfolio') || function_exists('is_product') && is_product() || is_404() ) {
				switch (true) {
					case (is_404())                                      : $post_type = '404';              break;
					case (is_singular('lp_course'))                      : $post_type = 'learnpress_single'; break;
					case (is_singular('portfolio'))                      : $post_type = 'portfolio_single'; break;
					case (function_exists('is_product') && is_product()) : $post_type = 'shop_single';      break;
				}
				$page_title_bg_switch = iGuru_Theme_Helper::get_option($post_type.'_title_bg_switch');
				$page_title_bg_color = iGuru_Theme_Helper::get_option($post_type.'_page_title_bg_image')['background-color'];
				$page_title_height = iGuru_Theme_Helper::get_option('page_title_height')['height'];
				$page_title_padding = iGuru_Theme_Helper::get_option($post_type.'_page_title_padding');
				$page_title_margin = iGuru_Theme_Helper::get_option($post_type.'_page_title_margin');
				if ( class_exists('RWMB_Loader') && ($this->id !== 0) && (rwmb_meta('mb_page_title_switch') == 'on') ) {
					$page_title_bg_switch = rwmb_meta('mb_page_title_bg_switch');
					$page_title_bg_color = rwmb_meta('mb_page_title_bg')['color'];
					$page_title_height = rwmb_meta('mb_page_title_height');
					$page_title_margin = rwmb_meta('mb_page_title_margin');
					$page_title_padding = rwmb_meta('mb_page_title_padding');
				}
			}
			// Blog type [1-2]
			elseif ( $this->single['type'] == 'post' && in_array($this->single['layout'], range(1,2)) ) {
				$page_title_bg_switch = false;
				$page_title_margin = iGuru_Theme_Helper::options_compare('page_title_margin', 'mb_page_title_switch', 'on');
				$page_title_padding = array('padding-top' => '', 'padding-bottom' => '');
				if ( class_exists('RWMB_Loader') && ($this->id !== 0) && (rwmb_meta('mb_page_title_switch') == 'on') ) {
					$page_title_bg_switch = rwmb_meta('mb_page_title_bg_switch');
					$page_title_bg_color = rwmb_meta('mb_page_title_bg')['color'];
					$page_title_height = rwmb_meta('mb_page_title_height');
					$page_title_margin = rwmb_meta('mb_page_title_margin');
					$page_title_padding = rwmb_meta('mb_page_title_padding');
				}
				$border_top = !(bool)$page_title_bg_switch ? true : false;
				$border_top_color = iGuru_Theme_Helper::get_option('blog_single_border_top_color')['rgba'];
			}
			// Default page title variables
			else {
				$page_title_bg_color = iGuru_Theme_Helper::get_option('page_title_bg_image')['background-color'];
				$page_title_height = iGuru_Theme_Helper::get_option('page_title_height')['height'];
				if ( class_exists('RWMB_Loader') && $this->mb_page_title_switch == 'on' ) {
					$page_title_bg_color = rwmb_meta('mb_page_title_bg')['color'];
					$page_title_height = rwmb_meta('mb_page_title_height');
				}
				$page_title_bg_switch = iGuru_Theme_Helper::options_compare('page_title_bg_switch', 'mb_page_title_switch', 'on');
				$page_title_margin = iGuru_Theme_Helper::options_compare('page_title_margin', 'mb_page_title_switch', 'on');
				$page_title_padding = iGuru_Theme_Helper::options_compare('page_title_padding', 'mb_page_title_switch', 'on');
			}

			$style = '';
			if ( is_404() ) {
				switch ( (bool)$page_title_bg_switch ) {
					case true:
						$style .= !empty(iGuru_Theme_Helper::bg_render('404_page_title')) ? iGuru_Theme_Helper::bg_render('404_page_title') : iGuru_Theme_Helper::bg_render('page_title');
						break;
					default: break;
				}
			} elseif ( (bool)$shop_title && !empty(iGuru_Theme_Helper::bg_render('shop_'.$shop_title.'_page_title')) ) {
				$style .= function_exists('is_product') && !is_product() ? iGuru_Theme_Helper::bg_render('shop_'.$shop_title.'_page_title') : ((bool)$page_title_bg_switch ? iGuru_Theme_Helper::bg_render('shop_single_page_title') : '');
			} elseif ( (bool)$cpt_title && (bool)$page_title_bg_switch && !empty(iGuru_Theme_Helper::bg_render($cpt_type_title.'_'.$cpt_title.'_page_title')) ) {
				$style .= iGuru_Theme_Helper::bg_render($cpt_type_title.'_'.$cpt_title.'_page_title');
			} else {
				$style .= (bool)$page_title_bg_switch ? iGuru_Theme_Helper::bg_render('page_title','mb_page_title_switch','on') : '';
			}
			$style .= ((bool)$page_title_bg_switch && !empty($page_title_bg_color)) ? 'background-color: '.$page_title_bg_color.';' : '';
			$style .= ((bool)$page_title_bg_switch && !empty($page_title_height)) ? ' height: '.(int)$page_title_height.'px;' : '';
			$style .= ($page_title_margin['margin-bottom'] != '') ? ' margin-bottom: '.(int)$page_title_margin['margin-bottom'].'px;' : '';
			$style .= ($page_title_padding['padding-top'] != '') ? ' padding-top: '.(int)$page_title_padding['padding-top'].'px;' : '';
			$style .= ($page_title_padding['padding-bottom'] != '') ? ' padding-bottom: '.(int)$page_title_padding['padding-bottom'].'px;' : '';
			$style .= (isset($border_top) && (bool)$border_top) ? ' border-top: 1px solid '.$border_top_color : '';

			return $style;
		}
	}

	new iGuru_get_page_title();
}