<?php

// Add extra profile information
add_action( 'show_user_profile', 'wgl_extra_user_profile_fields' );
add_action( 'edit_user_profile', 'wgl_extra_user_profile_fields' );

function wgl_extra_user_profile_fields( $user ) {
	if ( user_can( $user->ID, 'edit_lp_courses' ) ) : ?>
		<h3><?php esc_html_e( 'Instructor Info', 'iguru-core' ); ?></h3>
		<table class="form-table">
		  <tr>
			<th><label for="occupation"><?php esc_html_e( 'Occupation', 'iguru-core' ); ?></label></th>
			<td>
				<input type="text" name="occupation" id="occupation" value="<?php echo esc_attr( get_the_author_meta( 'occupation', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e( 'Your area of specialty. Note: can be set for LearnPress Instructors only.', 'iguru-core' ); ?></span>
			</td>
		  </tr>
		</table>
		<?php
	endif; ?>

	<h3><?php esc_html_e( 'Socials', 'iguru-core' ); ?></h3>

	<table class="form-table">
	  <?php
		$extra_socials = array( 'instagram', 'facebook', 'linkedin', 'twitter', 'telegram' );
		foreach ($extra_socials as $soc_name) {
		  ?>
		  <tr>
			<th><label for="<?php echo esc_attr($soc_name); ?>" style="text-transform: capitalize;"><?php esc_html_e( $soc_name, 'iguru-core' ); ?></label></th>
			<td>
				<input type="text" name="<?php echo esc_attr($soc_name); ?>" id="<?php echo esc_attr($soc_name); ?>" value="<?php echo esc_attr( get_the_author_meta( $soc_name, $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e( 'Your '.$soc_name.' url.', 'iguru-core' ); ?></span>
			</td>
		  </tr>
		  <?php
		}
	  ?>
	</table>
	<?php
}

add_action( 'personal_options_update', 'wgl_save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'wgl_save_extra_user_profile_fields' );

function wgl_save_extra_user_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) ) { 
		return false; 
	}

	if ( current_user_can('edit_lp_courses') ) update_user_meta( $user_id, 'occupation', $_POST['occupation'] );

	$extra_socials = array( 'instagram', 'facebook', 'linkedin', 'twitter', 'telegram' );
	foreach ($extra_socials as $soc_name) {
		update_user_meta( $user_id, $soc_name, $_POST[ $soc_name ] );
	}
}

// Adding functions for theme
add_action( 'init', 'wgl_custom_fields' );
function wgl_custom_fields(){
	if (class_exists('Vc_Manager')) {
		$gtdu = get_template_directory_uri();
		vc_add_shortcode_param('iguru_radio_image', 'iguru_radio_image', $gtdu.'/wpb/addon_fields/js/wgl_vc_extenstions.js');
		vc_add_shortcode_param('dropdown_multi','iguru_dropdown_field');
		vc_add_shortcode_param('wgl_checkbox', 'iguru_checkbox_custom', $gtdu.'/wpb/addon_fields/js/wgl_vc_extenstions.js');
		vc_add_shortcode_param('iguru_param_heading', 'iguru_heading_line');
	}
}
		
//admin icon tinymce shortcode
if (!function_exists('wgl_admin_icon')) {
	function wgl_admin_icon($atts){
		if(!class_exists('WglAdminIcon')){
			return;
		}
		extract( shortcode_atts( array(
					'name'             => '',
					'class'            => '',
					'unprefixed_class' => '',
					'title'            => '', /* For compatibility with other plugins */
					'size'             => '', /* For compatibility with other plugins */
					'space'            => '',
			), $atts )
		);

		$title = $title ? 'title="' . $title . '" ' : '';
		$space = 'true' == $space ? '&nbsp;' : '';
		$size = $size ? ' '. WglAdminIcon()->prefix . '-' . $size : '';

		$prefixes = array( 'icon-', 'fa-' );
		foreach ( $prefixes as $prefix ) {

			if ( substr( $name, 0, strlen( $prefix ) ) == $prefix ) {
				$name = substr( $name, strlen( $prefix ) );
			}

		}

		$name = str_replace( 'fa-', '', $name );
		$icon_name = WglAdminIcon()->prefix ? WglAdminIcon()->prefix . '-' . $name : $name;

		$class = str_replace( 'icon-', '', $class );
		$class = str_replace( 'fa-', '', $class );

		$class = trim( $class );
		$class = preg_replace( '/\s{3,}/', ' ', $class );

		$class_array = explode( ' ', $class );
		foreach ( $class_array as $index => $class ) {
			$class_array[ $index ] = $class;
		}
		$class = implode( ' ', $class_array );

		// Add unprefixed classes.
		$class .= $unprefixed_class ? ' ' . $unprefixed_class : '';

		$class = apply_filters( 'wgl_icon_class', $class, $name );

		$es_2class = 'wgl-icon';

		$tag = apply_filters( 'wgl_icon_tag', 'i' );

		$output = sprintf( '<%s class="%s %s %s %s %s" %s>%s</%s>',
			$tag,
			$es_2class,
			WglAdminIcon()->prefix,
			$icon_name,
			$class,
			$size,
			$title,
			$space,
			$tag
		);

		return apply_filters( 'wgl_icon', $output );
	}
	add_shortcode('wgl_icon', 'wgl_admin_icon');
}



add_action('wp_head','wgl_wp_head_custom_code',1000);
function wgl_wp_head_custom_code() {
	// this code not only js or css / can insert any type of code
	
	if (class_exists('iGuru_Theme_Helper')) {
		$header_custom_code = iGuru_Theme_Helper::get_option('header_custom_js');
	}
	echo isset($header_custom_code) ? "<script>".$header_custom_code."</script>" : '';
}

add_action('wp_footer', 'wgl_custom_footer_js',1000);
function wgl_custom_footer_js() {
	 if (class_exists('iGuru_Theme_Helper')) {
		$custom_js = iGuru_Theme_Helper::get_option('custom_js');
	}
	echo isset($custom_js) ? '<script id="wgl_custom_footer_js">'.$custom_js.'</script>' : '';
}

// If Redux is running as a plugin, this will remove the demo notice and links
add_action( 'redux/loaded', 'remove_demo' );


/**
 * Removes the demo link and the notice of integrated demo from the redux-framework plugin
 */
if ( ! function_exists( 'remove_demo' ) ) {
	function remove_demo() {
		// Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
		if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
			remove_filter( 'plugin_row_meta', array(
				ReduxFrameworkPlugin::instance(),
				'plugin_metalinks'
			), null, 2 );

			// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
			remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
		}
	}
}

// Get User IP
if ( ! function_exists( 'wgl_get_ip' ) ) {
	function wgl_get_ip(){
		if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) && ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) && ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = ( isset( $_SERVER['REMOTE_ADDR'] ) ) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
		}
		$ip = filter_var( $ip, FILTER_VALIDATE_IP );
		$ip = ( $ip === false ) ? '0.0.0.0' : $ip;
		return $ip;
	}
}

?>
