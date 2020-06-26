<?php

defined( 'ABSPATH' ) || exit;

/**
* LearnPress for iGuru theme
*
*
* @class       iGuru_LearnPress
* @author      WebGeniusLab
* @category    Class
* @version     1.0
*/

if ( ! class_exists('iGuru_LearnPress') ) {
	/** 
	* iGuru_LearnPress
	*
	* @since    1.0
	* @access   private
	*/
	class iGuru_LearnPress {


		/**
		 *  Constructor
		 */
		public function __construct() {
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

			$this->wgl_learnpress_init();
		}

		/**
		* Initialize iGuru functions for LearnPress plugin
		*/
		public function wgl_learnpress_init() {
			add_filter( 'learn_press_course_settings_meta_box_args', [ $this, 'add_extra_course_meta'] );
			add_filter( 'iguru/theme-helper/get-sidebar-params/cpt', [ $this, 'get_lp_page_type' ] );
			
			$this->wgl_learnpress_single();
			$this->wgl_learnpress_grid();
			$this->wgl_learnpress_profile();
			$this->wgl_learnpress_become_teacher();
		}

		/**
 		* Build a single course page
 		*/
		protected function wgl_learnpress_single() {
			remove_action( 'learn-press/before-main-content', 'learn_press_breadcrumb', 10 );
			remove_action( 'learn-press/content-landing-summary', 'learn_press_course_price', 25 );
			remove_action( 'learn-press/content-landing-summary', 'learn_press_course_buttons', 30 );
			remove_action( 'learn-press/content-learning-summary', 'learn_press_course_students', 15 );
			remove_action( 'learn-press/content-learning-summary', 'learn_press_course_buttons', 40 );

			add_action( 'learn-press/content-landing-summary', [ $this, 'course_title' ], 2 );
			add_action( 'learn-press/content-landing-summary', [ $this, 'render_course_meta' ], 8 );
			add_action( 'learn-press/content-landing-summary', [ $this, 'single_course_thumbnail' ], 17 );
			add_action( 'learn-press/content-landing-summary', [ $this, 'related_courses' ], 30 );
			add_filter( 'learn-press/course-tabs', [ $this, 'course_tab_rename' ] );
			add_filter( 'learn-press/content-learning-summary', [ $this, 'render_course_meta' ], 15 );
			// add_action( 'learn-press/content-learning-summary', [ $this, 'related_courses' ], 40 );

			$this->course_essentials();
		}

		/**
 		* Build an archive of courses
 		*/
		protected function wgl_learnpress_grid() {
			remove_action( 'learn-press/courses-loop-item-title', 'learn_press_courses_loop_item_title', 15 );
			remove_action( 'learn-press/after-courses-loop-item', 'learn_press_courses_loop_item_begin_meta', 10 );
			remove_action( 'learn-press/after-courses-loop-item', 'learn_press_courses_loop_item_price', 20 );
			remove_action( 'learn-press/after-courses-loop-item', 'learn_press_courses_loop_item_instructor', 25 );
			remove_action( 'learn-press/after-courses-loop-item', 'learn_press_courses_loop_item_end_meta', 30 );
			remove_action( 'learn-press/after-courses-loop-item', 'learn_press_course_loop_item_buttons', 35 );
			remove_action( 'learn-press/after-courses-loop-item', 'learn_press_course_loop_item_user_progress', 40 );
			remove_action( 'learn_press_wishlist_loop_item_title', 'learn_press_wishlist_loop_item_title', 5 );

			add_action( 'learn-press/before-courses-loop-item', [ $this, 'course_content_wrapper' ] );
			add_filter( 'learn-press/course/image', [ $this, 'grid_course_thumbnails' ], 10 );
			add_action( 'learn-press/after-courses-loop-item', [ $this, 'grid_course_content' ], 5 );
			add_action( 'learn_press_wishlist_loop_item_title', [ $this, 'grid_course_thumbnails' ], 5 );
			add_action( 'learn_press_after_profile_tab_wishlist_loop_course', [ $this, 'grid_course_content' ], 10 );
			add_action( 'learn-press/after-main-content', [ $this, 'close_comments' ], 10 );
		}

		/**
 		* Build a profile page
 		*/
		protected function wgl_learnpress_profile() {
			remove_action( 'learn-press/before-user-profile', 'learn_press_user_profile_header', 5 );

			add_action( 'wp_login', [ $this, 'just_signed_in' ] );
			add_action( 'iguru/learn-press/above-user-profile', [ $this, 'instructor_featured_info' ], 10 );
			add_filter( 'learn-press/profile-tabs', [ $this, 'modify_profile_tabs' ] );
			add_action( 'iguru/learn-press/beneath-user-profile', [ $this, 'related_courses' ], 10 );
		}

		/**
 		* Modify "Become a Techaer" page
 		*/
		protected function wgl_learnpress_become_teacher() {
			add_action( 'learn-press/before-become-teacher-form', [ $this, 'become_teacher_form_wrapper' ], 2 );
		}

		/**
 		* Display a course title
 		*/
		public function course_title() {
			return the_title( '<h1 class="course-title">', '</h1>' );
		}

		/**
 		* Build a course meta data
 		*/
		public function render_course_meta() {
			remove_action( 'learn-press/content-landing-summary', 'learn_press_course_students', 10 );

			$this->meta_instructor();
			$this->meta_categories();
			$this->meta_ratings();

			if ( class_exists('LP_Addon_Wishlist_Preload') ) {
				remove_action( 'learn-press/after-course-buttons', [ LP_Addon_Wishlist::instance(), 'wishlist_button' ], 100 );
				add_action( 'learn-press/before-course-buttons', [ LP_Addon_Wishlist::instance(), 'wishlist_button' ] );
			}

			$this->iguru_course_button();
		}

		/**
 		* Display a course instructor
 		*/
		protected function meta_instructor() {
			$course = LP_Global::course();
			$author_link = learn_press_user_profile_link( get_post_field('post_author', $course->get_id()) );

			echo
				'<span class="course-author">',
					'<a href="', esc_url($author_link), '" class="author-img">',
						$course->get_instructor()->get_profile_picture(),
					'</a>',
					'<span class="author-data">',
						'<span class="meta_title">', esc_html__( 'Teacher', 'iguru' ), '</span>',
						'<span class="meta_data">', $course->get_instructor_html(), '</span>',
					'</span>',
				'</span>'
			;
		}

		/**
 		* Display list of course categories
 		*/
		protected function meta_categories() {
			ob_start();
				learn_press_course_categories();
			$cats = ob_get_clean();

			if ( empty(ltrim($cats)) ) return;
			?>
			<span class="course-category">
				<i class="cat-icon flaticon-folder"></i>
				<span class="cat_data">
					<span class="meta_title"><?php esc_html_e( 'Category', 'iguru' ); ?></span><?php
					printf( '<span class="meta_data">%s</span>', $cats ); ?>
				</span>
			</span><?php
		}
		
		/**
 		* Display rating and reviews amount for a course
 		*/
		protected function meta_ratings() {
			if ( ! class_exists('LP_Addon_Course_Review_Preload') ) return;
			?>
			<div class="course-review">
			  <span class="meta_title"><?php esc_html_e( 'Review', 'iguru' ); ?></span>
			  <div class="meta_data"><?php
				$course_rate = learn_press_get_course_rate( get_the_ID(), false )['rated'];
				learn_press_course_review_template( 'rating-stars.php', [ 'rated' => $course_rate ] );

				$total_reviews = learn_press_get_course_rate_total( get_the_ID() );
				?>
				<span class="reviews-total"><?php
					!empty($total_reviews)
						? printf( _n( '(%s review)', '(%s reviews)', $total_reviews, 'iguru' ), number_format_i18n( $total_reviews ) )
						: esc_html_e( '(0 reviews)', 'iguru' ); ?>
				</span>
			  </div>
			</div><?php
		}

		/**
 		* Display featured image for a single course
 		*/
		public function single_course_thumbnail() {
			add_filter( 'learn_press_single_course_image_html', 'single_thumbnail' );
			function single_thumbnail($link) {
				preg_match('/<img.*?>/', $link, $match);
				$img = $match[0];
				return $img;
			}
			learn_press_get_template( 'single-course/thumbnail.php' );
		}

		/**
 		* Display related courses
 		*/
 		public function related_courses( $profile = '' ) {
 			switch (true) {
 				case is_object($profile):
		 			global $this_profile;
					$this_profile = $profile;
 					get_template_part('templates/learnpress/profile_courses-related');
					unset($this_profile);
 					break;

 				default:
		 			get_template_part('templates/learnpress/single_courses-related');
 					break;
 			}
 		}

		/**
 		* Rename the default course tabs
 		*/
		public function course_tab_rename($defaults) {
			if ( $defaults['overview']['title'] == 'Overview' ) {
				$defaults['overview']['title'] = esc_html__( 'Description', 'iguru' );
			}
			return $defaults;
		}
		
		/**
		 * Add extra meta fields on LearnPress back-end
		 */
		public function add_extra_course_meta($meta_box) {
			$meta_box['fields'][] = [
				'name' => esc_html__( 'Skill Level', 'iguru' ),
				'id'   => 'iguru_course_skill_level',
				'type' => 'text',
				'std'  => esc_html__( 'Any level', 'iguru' ),
				'desc' => esc_html__( 'Expected student level.', 'iguru' ),
			];
			$meta_box['fields'][] = [
				'name' => esc_html__( 'Language', 'iguru' ),
				'id'   => 'iguru_course_language',
				'type' => 'text',
				'std'  => esc_html__( 'English', 'iguru' ),
				'desc' => esc_html__( 'Language(s) used for communication.', 'iguru' ),
			];
			$meta_box['fields'][] = [
				'name' => esc_html__( 'Downloadable Items', 'iguru' ),
				'id'   => 'iguru_course_downloadable',
				'type' => 'text',
				'desc' => esc_html__( 'Items to be downloaded within studying (if any).', 'iguru' ),
			];
			$meta_box['fields'][] = [
				'name' => esc_html__( 'Applicable Techniques', 'iguru' ),
				'id'   => 'iguru_course_applicables',
				'type' => 'text',
				'desc' => esc_html__( 'Methods used in the context of learning.', 'iguru' ),
			];
			$meta_box['fields'][] = [
				'name' => esc_html__( 'Certificate', 'iguru' ),
				'id'   => 'iguru_course_certificate',
				'type' => 'text',
				'desc' => esc_html__( 'Evidance of completion.', 'iguru' ),
			];
			$meta_box['fields'][] = [
				'name' => esc_html__( 'Description', 'iguru' ),
				'id'   => 'iguru_course_description',
				'type' => 'textarea',
				'desc' => esc_html__( 'Additional explanations.', 'iguru' ),
			];

			return $meta_box;
		}

		/**
		 * Determine page type for rendering the sidebar
		 */
		public function get_lp_page_type($cpt) {
			if ( learn_press_is_course() ) : return 'learnpress_single';
			elseif ( learn_press_is_courses() ) : return 'learnpress_archive';
			else : return $cpt;
			endif;
		}

		/**
		 * Display course essentials
		 */
		public function course_essentials() {
			$sidebar_layout = iGuru_Theme_Helper::get_option('learnpress_single_sidebar_layout');
			$info_in_sidebar = iGuru_Theme_Helper::get_option('learnpress_single_sidebar_course_essentials_switch');

			if ( $sidebar_layout != 'none' && $info_in_sidebar ) {
				$hook = 'iguru/theme-helper/render-sidebar/before-widgets';
				add_filter( 'learn-press/purchase-course-button-text', function() {
					return esc_html__( 'Buy Course', 'iguru' );
				} );
				add_action( 'iguru/learn-press/after-course-essentials', 'learn_press_course_buttons' );
			} else {
				$hook = 'iguru/learn-press/last-in-tab-panel-overview';
				add_filter( 'iguru/learn-press/render-course-essentials/title', function() { 
					return esc_html__( 'Overview', 'iguru' );
				} );
			}

			add_action( $hook, [ $this, 'render_course_essentials' ] );
		}

		/**
		 * Build course essentials
		 */
		public function render_course_essentials() {
			// Affects only the course single
			if ( function_exists('learn_press_is_course') && ! learn_press_is_course() ) return;

			get_template_part('templates/learnpress/single_course-essentials');
		}

		/**
 		* Insert content-wrapper for each course in a grid/archive
 		*/
		public function course_content_wrapper() {
			if ( ! learn_press_is_search() && is_search() ) {
				// Prevent rendering courses grid within default Search results  
				remove_all_actions( 'learn-press/before-courses-loop-item' );
				remove_all_actions( 'learn-press/courses-loop-item-title' );
				remove_all_actions( 'learn_press_after_courses_loop_item' );
			}
			echo '<div class="course__content-wrapper">';
			global $course__content_wrapper;
			$course__content_wrapper = 'opened';
		}

		/**
 		* Display thumbnails for courses grid/archive
 		*/
		public function grid_course_thumbnails() {
			get_template_part('templates/learnpress/grid_courses-thumbnail');
		}

		/**
 		* Display courses content for courses grid/archive
 		*/
		public function grid_course_content() {
			if ( ! learn_press_is_search() && is_search() ) return;

			get_template_part('templates/learnpress/grid_courses-content');
		}

		/**
 		* Prevent calling the comments form on Search Courses page
 		*/
		public function close_comments() {
			if ( learn_press_is_search() || learn_press_is_course_tag() ) {
				add_filter( 'comments_open', function() { return false; }, 10, 2 );
			}
		}

		/**
 		* Display course price within CTA button
 		*/
		public static function iguru_course_button() {
			add_filter( 'learn-press/purchase-course-button-text', [ 'iGuru_LearnPress', 'course_price_html' ] );
			add_filter( 'learn-press/enroll-course-button-text', [ 'iGuru_LearnPress', 'course_price_html' ] );

			learn_press_course_buttons();

			remove_filter( 'learn-press/purchase-course-button-text', [ 'iGuru_LearnPress', 'course_price_html' ] );
			remove_filter( 'learn-press/enroll-course-button-text', [ 'iGuru_LearnPress', 'course_price_html' ] );
			remove_action( 'learn-press/before-course-buttons', [ LP_Addon_Wishlist::instance(), 'wishlist_button' ] );
		}

		/**
 		* Get html of course price 
 		*/
		public static function course_price_html() {
			ob_start();
				get_template_part('templates/learnpress/price_within_button');
			return ob_get_clean();
		}

		/**
 		* Mark user that was just signed in
 		*/
		function just_signed_in() {
			LP()->session->set( 'wgl_user_just_signed_in', 'yes' );
		}

		/**
 		* Build instructor's featured info
 		*/
		public function instructor_featured_info($profile) {
			global $this_profile;
			$this_profile = $profile;
			
			get_template_part('templates/learnpress/profile_instructor-featured');
			unset($this_profile);
		}

		/**
 		* Display a logged-in message with logout option
 		*/
		public static function logged_in_message() {
			ob_start();
				learn_press_profile_dashboard_logged_in();
			$message = ob_get_clean();

			! $message || printf( '<div class="lp-user-profile logged_in_message">%s</div>', $message );
		}

		/**
 		* Modify default profile page
 		*/
		public function modify_profile_tabs($tabs) {
			unset( $tabs['dashboard'] );
			return $tabs;
		}

		/**
 		* Insert form-wrapper for "Become a teacher" page
 		*/
		public function become_teacher_form_wrapper() {
			$messages = LP_Shortcode_Become_A_Teacher::get_messages();
			if ( $messages ) return;
			
			echo '<div class="form__inner-wrap">';
		}
	}
}

new iGuru_LearnPress();