<?php
	$single = iGuru_SinglePost::getInstance();
	$single->set_data();

	$single_author_info = iGuru_Theme_Helper::get_option('single_author_info');
	$single_meta = iGuru_Theme_Helper::get_option('single_meta');
	$show_tags = iGuru_Theme_Helper::get_option('single_meta_tags');
	$show_share = iGuru_Theme_Helper::get_option('single_share');
	$featured_image = iGuru_Theme_Helper::options_compare('post_hide_featured_image', 'mb_post_hide_featured_image', '1');
?>

<div class="blog-post blog-post-single-item format-<?php echo esc_attr($single->get_pf()); ?>">
	<div <?php post_class("single_meta"); ?>>
		<div class="item_wrapper">
			<div class="blog-post_content">
				<?php
				if ( !(bool)$featured_image ) {
					$pf_type = $single->get_pf();
					$video_style = function_exists("rwmb_meta") ? rwmb_meta('post_format_video_style') : '';
					if ( $pf_type !== 'standard-image' && $pf_type !== 'standard' ) {
						if ( $pf_type === 'video' && $video_style === 'bg_video' ) {
						} else {
							$single->render_featured(false, 'full' );
						}
					}
				}

				the_content();

				wp_link_pages(array('before' => '<div class="page-link"><span class="pagger_info_text">' . esc_html__( 'Pages', 'iguru' ) . ': </span>', 'after' => '</div>'));

				if ( has_tag() && !(bool)$show_tags || $show_share ) {
					?>
					<div class="post_info single_post_info">
						<div class="meta-wrapper">

						<?php
						// Tags
						if ( has_tag() && !(bool)$show_tags ) {
							the_tags('<div class="tagcloud-wrapper"><div class="tagcloud">', ' ', '</div></div>');
						}
						
						// Shares
						if ( $show_share && function_exists('wgl_theme_helper') ) : ?>
						  <div class="blog-post_meta_share">
							<div class="single_info-share_social-wpapper">
							  <?php echo wgl_theme_helper()->render_post_share('yes'); ?>
							</div>
						  </div>
						  <?php
						endif;

						?>
						</div><?php // close meta-wrapper 
						
						if ( !(bool)$single_author_info )
							echo '<div class="post_info-divider"></div>';
						?>

					</div><?php // close post_info
				} else {
					?>
					<div class="post_info-divider"></div>
					<?php
				}

				if ( (bool)$single_author_info ) $single->render_author_info();

				?>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>