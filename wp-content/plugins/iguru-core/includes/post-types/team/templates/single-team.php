<?php

$sb = iGuru_Theme_Helper::get_sidebar_params();
$row_class = $sb['row_class'];
$column = isset($sb['column']) ? $sb['column'] : '12';

$defaults = [
    'title' => '',
    'posts_per_line' => '2',
    'grid_gap' => '',
    'info_align' => 'center',
    'single_link_wrapper' => false,
    'single_link_heading' => true,
    'hide_title' => false,
    'hide_department' => false,
    'hide_soc_icons' => false,
];
extract($defaults);

$team_image_dims = [ 'width' => '880', 'height' => '977' ]; // ratio = 0.9

get_header ();

?>
<div class="wgl-container">
	<div class="row<?php echo esc_attr($row_class); ?>">
		<div id='main-content' class="wgl_col-<?php echo (int)$column; ?>"><?php
			while ( have_posts() ):
				the_post();
			?>
				<div class="row single_team_page">
					<div class="wgl_col-12"><?php
						echo render_wgl_team_item(true, $defaults, $team_image_dims); ?>
					</div>
					<div class="wgl_col-12"><?php
						the_content(); ?>
					</div>
				</div><?php
			endwhile;
			wp_reset_postdata();
			?>
		</div>
		<?php
			if ($sb) iGuru_Theme_Helper::render_sidebar($sb);
		?>
	</div>
</div><?php

get_footer();

?>