<?php get_header(); ?>
<div class="container">
    <div class="section-title">
        <h2><?php esc_html_e( 'All apps', 'macsoft' ); ?></h2>
    </div>
    <?php if ( have_posts() ) : ?>
        <div class="app-grid">
            <?php
            while ( have_posts() ) {
                the_post();
                get_template_part( 'template-parts/content', 'card' );
            }
            ?>
        </div>
        <?php the_posts_pagination(); ?>
    <?php else : ?>
        <?php get_template_part( 'template-parts/content', 'none' ); ?>
    <?php endif; ?>
</div>
<?php get_footer(); ?>
