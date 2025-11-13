<?php
if ( post_password_required() ) {
    return;
}
?>
<div id="comments" class="single-content">
    <?php if ( have_comments() ) : ?>
        <h2>
            <?php
            $count = get_comments_number();
            printf( esc_html__( '%s comments', 'macsoft' ), number_format_i18n( $count ) );
            ?>
        </h2>
        <ol class="comment-list">
            <?php
            wp_list_comments( [
                'style'      => 'ol',
                'avatar_size'=> 48,
                'short_ping' => true,
            ] );
            ?>
        </ol>
        <?php the_comments_pagination(); ?>
    <?php endif; ?>

    <?php if ( comments_open() ) : ?>
        <div class="comment-form-wrapper">
            <?php comment_form(); ?>
        </div>
    <?php endif; ?>
</div>
