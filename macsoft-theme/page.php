<?php get_header(); ?>
<div class="container">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-content' ); ?>>
            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>
        </article>
        <?php if ( comments_open() || get_comments_number() ) {
            comments_template();
        } ?>
    <?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>
