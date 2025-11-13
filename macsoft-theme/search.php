<?php get_header(); ?>
<div class="container">
    <header class="section-title">
        <div>
            <p class="category-pill"><?php esc_html_e( 'Search results', 'macsoft' ); ?></p>
            <h1><?php printf( esc_html__( '“%s”', 'macsoft' ), get_search_query() ); ?></h1>
        </div>
    </header>
    <?php if ( have_posts() ) : ?>
        <div class="app-grid">
            <?php while ( have_posts() ) : the_post();
                get_template_part( 'template-parts/content', 'card' );
            endwhile; ?>
        </div>
        <?php the_posts_pagination(); ?>
    <?php else : ?>
        <?php get_template_part( 'template-parts/content', 'none' ); ?>
    <?php endif; ?>
</div>
<?php get_footer(); ?>
