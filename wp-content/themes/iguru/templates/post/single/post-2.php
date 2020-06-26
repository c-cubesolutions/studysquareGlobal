<?php

$single = iGuru_SinglePost::getInstance();
$single->set_data();

$show_likes = iGuru_Theme_Helper::get_option('single_likes');
$show_share = iGuru_Theme_Helper::get_option('single_share');
$show_views = iGuru_Theme_Helper::get_option('single_views');
$show_tags = iGuru_Theme_Helper::get_option('single_meta_tags');
$single_author_info = iGuru_Theme_Helper::get_option('single_author_info');
$single_meta = iGuru_Theme_Helper::get_option('single_meta');
$single_cats = iGuru_Theme_Helper::get_option('single_meta_categories');
$featured_image = iGuru_Theme_Helper::options_compare('post_hide_featured_image', 'mb_post_hide_featured_image', '1');
$single->set_post_views(get_the_ID());

$meta_args = $meta_date = $meta_comments = [];

if ( !(bool)$single_meta ) {
	$meta_args['category'] = !(bool)iGuru_Theme_Helper::get_option('single_meta_categories');	
	$meta_args['author'] = !(bool)iGuru_Theme_Helper::get_option('single_meta_author');
	$meta_date['date'] = !(bool)iGuru_Theme_Helper::get_option('single_meta_date');
	$meta_comments['comments'] = !(bool)iGuru_Theme_Helper::get_option('single_meta_comments');
}

?>
<div class="blog-post blog-post-single-item format-<?php echo esc_attr($single->get_pf()); ?>">
	<div <?php post_class("single_meta"); ?>>
		<div class="item_wrapper">
			<div class="blog-post_content">
				<?php

				if ( !(bool)$featured_image )
					$single->render_featured(false, 'full');

				// Date
				if ( !(bool)$single_meta )
					$single->render_post_meta($meta_date);

				?>
				<div class="blog-post_meta-wrap"><?php

 				// Categories, Author
				if ( !(bool)$single_meta )
					$single->render_post_meta($meta_args);
				
				?>
				</div><?php // close meta-wrap ?>
				
				<h2 class="blog-post_title"><?php echo get_the_title(); ?></h2> 
				<?php

				the_content();

				wp_link_pages(
					[
						'before' => '<div class="page-link"><span class="pagger_info_text">' .esc_html__( 'Pages', 'iguru' ). ': </span>',
						'after' => '</div>'
					]
				);

				$condition = has_tag() && ! $show_tags || $show_likes || $show_views || ( ! $single_meta && ! empty($meta_comments['comments']) );
				if ( $condition || $show_share ) {

					echo '<div class="post_info single_post_info">';
						if ( $condition ) :
						  echo '<div class="meta-wrapper">';
							
							// Tags
							if ( ! $show_tags && has_tag() )
								the_tags('<div class="tagcloud-wrapper"><div class="tagcloud">', ' ', '</div></div>');

							// Views
							if ( $show_views )
								echo '<div class="blog-post_views-wrap">',
										 $single->get_post_views(get_the_ID()),
									 '</div>';

							// Comments
							if ( ! $single_meta && !empty($meta_comments['comments']) )
								$single->render_post_meta($meta_comments);

							// Likes
							if ( $show_likes && function_exists('wgl_simple_likes') )
								echo '<div class="blog-post_likes-wrap">',
										 wgl_simple_likes()->likes_button( get_the_ID(), 0 ),
									 '</div>';

						  echo '</div>'; // close meta-wrapper
						endif;
						
						// Shares
						if ( $show_share && function_exists('wgl_theme_helper') )
							echo '<div class="post_info-divider"></div>',
								 '<div class="single_info-share_social-wpapper">',
									 wgl_theme_helper()->render_post_share('yes'),
								 '</div>';

					echo '</div>'; // close post_info

				} else {

					echo '<div class="post_info-divider"></div>';

				}

				if ( (bool)$single_author_info ) $single->render_author_info();

				?>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>