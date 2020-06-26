<?php

defined( 'ABSPATH' ) || exit();

/**
 * Template for displaying instructor of single course.
 *
 * This template is overridden by WGL team for fine customizing.
 *
 * @author    ThimPress
 * @package   Learnpress/Templates
 * @version   3.0.0
 */


$course = LP_Global::course();

$author_link = learn_press_user_profile_link( get_post_field( 'post_author', $course->get_id() ));

?>
<div class="course-author">

    <?php do_action( 'learn-press/before-single-course-instructor' ); ?>

	<?php 
	printf( '<a href="%s" class="author-avatar">%s</a>',
		$author_link,
		$course->get_instructor()->get_profile_picture()
	);
	?>

    <div class="author-meta">
		<?php 
		printf( '<a href="%s" class="author-name">%s</a>',
			$author_link,
			$course->get_instructor_name() 
		); 
		printf( '<p class="author-bio">%s</p>', 
			$course->get_author()->get_description() 
		);
	
		$author_socials = array(
			'twitter'   => get_the_author_meta('twitter'),
			'facebook'  => get_the_author_meta('facebook'),
			'linkedin'  => get_the_author_meta('linkedin'),
			'instagram' => get_the_author_meta('instagram'),
		);
		$social_out = '';
		foreach ($author_socials as $k => $v) {
			$social_out .= !empty($v) ? '<a href="'.esc_url($v).'" class="author-info_social-link fa fa-'.esc_attr($k).'"></a>' : '';
		}
		$social_out = !empty($social_out) ? printf('<div class="author-info_social-wrapper">%s</div>', $social_out) : '';
		?>
    </div>

	<?php do_action( 'learn-press/after-single-course-instructor' ); ?>

</div>