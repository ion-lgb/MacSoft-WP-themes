<?php get_header(); ?>
<div class="container">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="single-hero">
                <div class="thumb">
                    <?php if ( has_post_thumbnail() ) {
                        the_post_thumbnail( 'macsoft-featured' );
                    } else {
                        echo '<img src="' . esc_url( get_template_directory_uri() . '/assets/images/placeholder-app.svg' ) . '" alt="' . esc_attr( get_the_title() ) . '">';
                    } ?>
                </div>
                <div>
                    <div class="category-pill">
                        <?php
                        $cats = get_the_category();
                        echo esc_html( $cats ? $cats[0]->name : __( 'Apps', 'macsoft' ) );
                        ?>
                    </div>
                    <h1><?php the_title(); ?></h1>
                    <?php macsoft_app_meta_badges(); ?>
                    <div class="card-meta">
                        <?php macsoft_posted_on(); ?>
                        <span><?php echo esc_html( sprintf( __( '%s comments', 'macsoft' ), get_comments_number() ) ); ?></span>
                    </div>
                </div>
            </div>

            <div class="single-content">
                <?php the_content(); ?>
            </div>

            <div class="single-download-panel">
                <div>
                    <h2><?php esc_html_e( 'Download options', 'macsoft' ); ?></h2>
                    <p><?php esc_html_e( 'Clean CDN mirrors with resume support.', 'macsoft' ); ?></p>
                </div>
                <?php macsoft_download_button(); ?>
            </div>

            <?php comments_template(); ?>
        </article>
    <?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>
