<?php
$category_slugs = wp_get_post_terms( get_the_ID(), 'category', [ 'fields' => 'slugs' ] );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'app-card' ); ?> data-categories="<?php echo esc_attr( implode( ',', $category_slugs ) ); ?>">
    <div class="thumb">
        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'macsoft-card' ); ?>
        <?php else : ?>
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/placeholder-app.svg' ); ?>" alt="<?php the_title_attribute(); ?>" />
        <?php endif; ?>
    </div>
    <div>
        <span class="category-pill">
            <?php
            $cats = get_the_category();
            echo esc_html( $cats ? $cats[0]->name : __( 'Apps', 'macsoft' ) );
            ?>
        </span>
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 16 ) ); ?></p>
        <?php macsoft_app_meta_badges(); ?>
    </div>
    <div class="card-meta">
        <?php macsoft_posted_on(); ?>
        <?php macsoft_download_button(); ?>
    </div>
</article>
