<?php

defined( 'ABSPATH' ) || exit();

/**
 * Template for displaying main user profile page.
 *
 * This template is overridden by WGL team for fine customizing.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */


$profile = LP_Global::profile();

if ( $profile->is_public() ) {

	do_action( 'iguru/learn-press/above-user-profile', $profile );

	?>
	<div id="learn-press-user-profile"<?php $profile->main_class(); ?>>
		<?php

		/**
		 * @since 3.0.0
		 */
		do_action( 'learn-press/before-user-profile', $profile );

		/**
		 * @since 3.0.0
		 */
		do_action( 'learn-press/user-profile', $profile );

		/**
		 * @since 3.0.0
		 */
		do_action( 'learn-press/after-user-profile', $profile );

		?>
	</div><?php

	do_action( 'iguru/learn-press/beneath-user-profile', $profile );

 } else {
	esc_html__( 'This user does not public their profile.', 'iguru' );
}