<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package       WordPress
 * @subpackage    iGuru
 * @since         1.0
 * @version       1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) { return; }


if (have_comments() || comments_open()) {
    echo '<div id="comments">';
}
if (have_comments()) : 
    ?>
    <h4 class="comments-title">
        <?php
        $comments_number = get_comments_number();
        if ( $comments_number < 10 ) $comments_number = '0'.$comments_number;
        if ( '1' === $comments_number ) {
            /* translators: %s: post title */
            printf( _x( 'Comment <span class="number-comments">(1)</span>', 'comments title', 'iguru' ));
        } else {
            printf(
                _nx(
                    'Comments <span class="number-comments">(%1$s)</span>',
                    'Comments <span class="number-comments">(%1$s)</span>',
                    $comments_number,
                    'comments title',
                    'iguru'
                ),
                $comments_number
            );
        }
        ?>
    </h4>

    <ol class="commentlist">
        <?php
        wp_list_comments(array(
            'walker' => new iGuru_Walker_Comment(),
            'avatar_size' => 80,
            'short_ping' => true
        ) );
        ?>
    </ol>
    <?php
    if (get_comment_pages_count() > 1 ){
        ?>
        <div><?php paginate_comments_links(); ?></div>
        <?php
    }
endif;
    $args = array();
    $args['fields'] = array(
        'author' => '<div class="comment-form-author wgl_col-6"><label for="author" class="label-name"></label><input type="text" placeholder="' . esc_attr__( 'Your Name *', 'iguru' ) . '" title="' . esc_attr__( 'Your Name *', 'iguru' ) . '" id="author" name="author" class="form_field"></div>',
        'email' => '<div class="comment-form-email wgl_col-6"><label for="email" class="label-email"></label><input type="text" placeholder="' . esc_attr__( 'Your Email *', 'iguru' ) . '" title="' . esc_attr__( 'Your Email *', 'iguru' ) . '" id="email" name="email" class="form_field"></div>',
        'url' => '<div class="comment-form-url wgl_col-12"><label for="url" class="label-url"></label><input type="text" placeholder="' . esc_attr__( 'Website', 'iguru' ) . '" title="' . esc_attr__( 'Website', 'iguru' ) . '" id="url" name="url" class="form_field"></div>'
    );
    $args['comment_field']  = '<div class="comment-form-comment wgl_col-12"><label for="comment" class="label-message" ></label><textarea name="comment" cols="45" rows="5" placeholder="' .esc_attr__( 'Your Comment...', 'iguru' ). '" id="comment" class="form_field"></textarea></div>';

    ob_start(); 
    comment_form( $args );
    $comment_form = ob_get_clean();
    echo trim( $comment_form );


if (have_comments() || comments_open()) {
    echo '</div>';
}

?>