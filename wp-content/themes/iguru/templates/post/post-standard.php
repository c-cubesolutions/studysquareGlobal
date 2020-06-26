<?php

global $wgl_blog_atts;

// Default settings for blog item
$trim = true;
if ( ! (bool)$wgl_blog_atts ) :
	$opt_likes = iGuru_Theme_Helper::get_option('blog_list_likes');
	$opt_share = iGuru_Theme_Helper::get_option('blog_list_share');
	$opt_meta = iGuru_Theme_Helper::get_option('blog_list_meta');
	$opt_meta_author = iGuru_Theme_Helper::get_option('blog_list_meta_author');
	$opt_meta_comments = iGuru_Theme_Helper::get_option('blog_list_meta_comments');
	$opt_meta_categories = iGuru_Theme_Helper::get_option('blog_list_meta_categories');
	$opt_meta_date = iGuru_Theme_Helper::get_option('blog_list_meta_date');
	$opt_read_more = iGuru_Theme_Helper::get_option('blog_list_read_more');
	$opt_hide_media = iGuru_Theme_Helper::get_option('blog_list_hide_media');
	$opt_hide_title = iGuru_Theme_Helper::get_option('blog_list_hide_title');
	$opt_hide_content = iGuru_Theme_Helper::get_option('blog_list_hide_content');
	$opt_letter_count = iGuru_Theme_Helper::get_option('blog_list_letter_count');
	$opt_blog_columns = iGuru_Theme_Helper::get_option('blog_list_columns');
	$opt_blog_columns = empty($opt_blog_columns) ? '12' : $opt_blog_columns;

	global $wp_query;
	$wgl_blog_atts = [
		// General
		'blog_layout' => 'grid',
		'animation_class' => '',
		// Content
		'blog_columns' => $opt_blog_columns,
		'hide_media' => $opt_hide_media,
		'hide_content' => $opt_hide_content,
		'hide_blog_title' => $opt_hide_title,
		'hide_postmeta' => $opt_meta,
		'meta_author' => $opt_meta_author,
		'meta_comments' => $opt_meta_comments,
		'meta_categories' => $opt_meta_categories,
		'meta_date' => $opt_meta_date,
		'hide_likes' => !(bool)$opt_likes,
		'hide_share' => !(bool)$opt_share,
		'read_more_hide' => $opt_read_more,
		'content_letter_count' => empty($opt_letter_count) ? '100' : $opt_letter_count,
		'crop_square_img' => 'true',
		'heading_tag' => 'h3',
		'read_more_text' => esc_html__( 'View More', 'iguru' ),
		'items_load'  => 4,
		'heading_margin_bottom' => '17px',
		// Query
		'query' => $wp_query,
	];
	$trim = false;
endif;

extract($wgl_blog_atts);

if ( $crop_square_img ) {
	switch ($blog_columns) {
		case  '3': $image_size = 'iguru-440w';  break; // col-4
		case  '4':                                     // col-3
		case  '6': $image_size = 'iguru-600w';  break; // col-2
		case '12': 									   // col-1
		default:   $image_size = 'iguru-1170w'; break; 
	}
} else {
	$image_size = 'full';
}

global $wgl_query_vars;
if (!empty($wgl_query_vars) ) $query = $wgl_query_vars;

// Allowed HTML render
$allowed_html = [
	'a' => [
		'href' => true, 'title' => true, 'target' => true,
		'class' => true, 'style' => true
	],
	'br' => [ 'class' => true, 'style' => true ],
	'b' =>  [ 'class' => true, 'style' => true ],
	'em' => [ 'class' => true, 'style' => true ],
	'strong' => [ 'class' => true, 'style' => true ],
]; 

$blog_styles = '';

$blog_attr = !empty($blog_styles) ? ' style="'.esc_attr($blog_styles).'"' : '';

$heading_attr = isset($heading_margin_bottom) && $heading_margin_bottom != '' ? ' style="margin-bottom: '.(int)$heading_margin_bottom.'px"' : '';
while ($query->have_posts()) : $query->the_post();

	echo '<div class="wgl_col-'.esc_attr($blog_columns).' item">';

	$single = iGuru_SinglePost::getInstance();
	$single->set_data();

	$title = get_the_title();

	$blog_item_classes = ' format-'.$single->get_pf();
	$blog_item_classes .= ' '.$animation_class;
	$blog_item_classes .= (bool)$hide_media ? ' hide_media' : '';
	$blog_item_classes .= is_sticky() ? ' sticky-post' : '';

	$content_class = !(bool)$meta_date ? ' has-date' : '';

	$single->set_data_image(true, $image_size, $aq_image = true);
	$has_media = $single->meta_info_render;

	if ( (bool)$hide_media ) $has_media = false;
	$blog_item_classes .= !(bool)$has_media ? ' format-no_featured' : '';

	$post_meta_args = [
		'category' => !(bool)$meta_categories,
		'author' => !(bool)$meta_author,
		'comments' => !(bool)$meta_comments,
	];
	$post_meta_date = [
		'date' => !(bool)$meta_date,
	];
	$shortened = true;

	?>
	<div class="blog-post<?php echo esc_attr($blog_item_classes); ?>"<?php echo iGuru_Theme_Helper::render_html($blog_attr);?>>
		<div class="blog-post_wrapper"><?php

			// Media
			if ( !(bool)$hide_media ) {
				$link_feature = true;
				$single->render_featured(
					$link_feature,
					$image_size,
					$aq_image = true
				);
			}

			?>
			<div class="blog-post_content<?php echo esc_attr($content_class);?>"><?php

				// Date
				if ( !(bool)$hide_postmeta )
					$single->render_post_meta($post_meta_date);

				?>
				<div class="blog-post_meta-wrap"><?php

				// Cats, Author, Comments
				if ( !(bool)$hide_postmeta )
					$single->render_post_meta($post_meta_args, $shortened);

				?>
				</div><?php

				// Title
				if ( !(bool)$hide_blog_title && !empty($title) )
					printf('<%1$s class="blog-post_title"%2$s><a href="%3$s">%4$s</a></%1$s>',
						esc_html($heading_tag),
						$heading_attr,
						esc_url(get_permalink()),
						wp_kses( $title, $allowed_html )
					);

				// Content
				if ( !(bool)$hide_content )
					$single->render_excerpt($content_letter_count, $trim, !(bool)$read_more_hide, $read_more_text);
				
				if ( !(bool)$read_more_hide || !(bool)$hide_share || !(bool)$hide_likes ) {

					?>
					<div class='blog-post_meta-desc'><?php

						// Read more
						if ( !(bool)$read_more_hide ) : ?>
						  <div class="read-more-wrap">
							<a href="<?php echo esc_url(get_permalink()); ?>" class="button-read-more"><?php echo esc_html($read_more_text); ?></a> 
						  </div><?php
						endif;

						// Shares
						if ( !(bool)$hide_share && function_exists('wgl_theme_helper') ) :
						  echo wgl_theme_helper()->render_post_list_share();
						endif;

						// Likes
						if ( !(bool)$hide_likes ) : ?>
							<div class="blog-post_likes-wrap"><?php
								if ( !(bool)$hide_likes && function_exists('wgl_simple_likes')) {
									echo wgl_simple_likes()->likes_button( get_the_ID(), 0, true);
								} ?>
							</div><?php

						endif;
						?>

					</div><?php
				}
				wp_link_pages(
					[
						'before' => '<div class="page-link">' .esc_html__( 'Pages', 'iguru' ). ': ',
						'after' => '</div>'
					]
				);
				?>
			</div>
		</div>
	</div><?php

	echo '</div>';

endwhile;
wp_reset_postdata();
