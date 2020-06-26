<?php
/**
 * The template for displaying image attachments
 *
 * @package WordPress
 * @subpackage iGuru
 * @since 1.0
 */

get_header();

$sb = iGuru_Theme_Helper::get_sidebar_params();
$row_class = $sb['row_class'];
$column = isset($sb['column']) ? $sb['column'] : '12';

?>
	<div class="wgl-container">
        <div class="row<?php echo apply_filters('iguru_row_class', $row_class); ?>">
			<div id='main-content' class="wgl_col-<?php echo apply_filters('iguru_column_class', $column); ?>">
				<?php
					// Start the loop.
					while ( have_posts() ) :
						the_post();
				?>
					<?php
						/**
						* Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
						* or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
						*/
						$attachments = array_values(
							get_children(
								[
									'post_parent' => $post->post_parent,
									'post_status' => 'inherit',
									'post_type' => 'attachment',
									'post_mime_type' => 'image',
									'order'   => 'ASC',
									'orderby' => 'menu_order ID',
								]
							)
						);
						
						foreach ( $attachments as $k => $attachment ) {
							if ( $attachment->ID == $post->ID ) break;
						}
						$k++;
						// If there is more than 1 attachment in a gallery
						if ( count( $attachments ) > 1 ) {
							if ( isset( $attachments[ $k ] ) ) {
								// get the URL of the next image attachment
								$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
							} else {                                        // or get the URL of the first image attachment
								$next_attachment_url = get_attachment_link( $attachments[0]->ID );
							}
						} else {
							// or, if there's only 1 image, get the URL of the image
							$next_attachment_url = wp_get_attachment_url();
						}

						?>
						<div class="blog-post">
							<div class="single_meta attachment_media">
								<div class="blog-post_content"><?php
										echo '<h4 class="blog-post_title">', esc_html(get_the_title()), '</h4>'; ?>
									<div class="meta-wrapper"><?php
										iGuru_Theme_Helper::posted_meta_on(); ?>
									</div>
									<div class="blog-post_media">
										<a href="<?php echo esc_url($next_attachment_url); ?>" title="<?php the_title_attribute(); ?>" rel="attachment">
											<?php
											$attachment_size = array(1170, 725); // image size.
											echo wp_get_attachment_image( get_the_ID(), $attachment_size );
											?>
										</a>
									</div><?php

									the_content();
									
									wp_link_pages(
										[
											'before' => '<div class="page-links">'.esc_html__( 'Pages:', 'iguru' ),
											'after' => '</div>'
										]
									); ?>
								</div>
							</div>		
						</div><?php

					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // end of the loop. ?>
			</div>
			<?php
				if ($sb) iGuru_Theme_Helper::render_sidebar($sb);
			?>
		</div>
	</div>
<?php

get_footer();

?>