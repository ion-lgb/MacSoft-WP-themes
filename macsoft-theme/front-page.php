<?php
get_header();

$hero_title    = get_theme_mod( 'macsoft_hero_title' );
$hero_subtitle = get_theme_mod( 'macsoft_hero_subtitle' );
$hero_cta      = get_theme_mod( 'macsoft_hero_cta_label' );
$hero_cta_link = get_theme_mod( 'macsoft_hero_cta_link' );

$default_apps_count = number_format_i18n( wp_count_posts()->publish ) . '+';
$categories_total   = wp_count_terms( 'category' );
if ( is_wp_error( $categories_total ) ) {
    $categories_total = 0;
}
$default_categories_count = number_format_i18n( $categories_total );
$default_reviews_count    = number_format_i18n( wp_count_comments()->approved );

$hero_stats = [
    'apps'       => macsoft_get_theme_option( 'hero_apps_count', $default_apps_count ),
    'categories' => macsoft_get_theme_option( 'hero_categories_count', $default_categories_count ),
    'reviews'    => macsoft_get_theme_option( 'hero_reviews_count', $default_reviews_count ),
];

$curated_title     = macsoft_get_theme_option( 'curated_title', __( 'Curated collections', 'macsoft' ) );
$curated_cta_label = macsoft_get_theme_option( 'curated_cta_label', __( 'View all', 'macsoft' ) );
$curated_cta_link  = macsoft_get_theme_option( 'curated_cta_link', get_post_type_archive_link( 'post' ) );

$latest_query = new WP_Query( [
    'posts_per_page' => 9,
] );

$featured_query = new WP_Query( [
    'posts_per_page' => 3,
    'meta_key'       => 'macsoft_featured',
    'meta_value'     => 'yes',
] );

$categories = get_categories( [
    'number'  => 6,
    'orderby' => 'count',
    'order'   => 'DESC',
] );
?>
<section class="hero">
    <div class="container">
        <div class="hero-card">
            <div>
                <p class="category-pill"><?php esc_html_e( '精选 macOS 应用', 'macsoft' ); ?></p>
                <h1><?php echo esc_html( $hero_title ); ?></h1>
                <p><?php echo esc_html( $hero_subtitle ); ?></p>
                <?php if ( $hero_cta && $hero_cta_link ) : ?>
                    <a class="hero-cta" href="<?php echo esc_url( $hero_cta_link ); ?>">
                        <?php echo esc_html( $hero_cta ); ?>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12" />
                            <polyline points="12 5 19 12 12 19" />
                        </svg>
                    </a>
                <?php endif; ?>
            </div>
            <div class="hero-stats">
                <div class="hero-stat">
                    <strong><?php echo esc_html( $hero_stats['apps'] ); ?></strong>
                    <p><?php esc_html_e( 'Apps indexed', 'macsoft' ); ?></p>
                </div>
                <div class="hero-stat">
                    <strong><?php echo esc_html( $hero_stats['categories'] ); ?></strong>
                    <p><?php esc_html_e( 'Categories', 'macsoft' ); ?></p>
                </div>
                <div class="hero-stat">
                    <strong><?php echo esc_html( $hero_stats['reviews'] ); ?></strong>
                    <p><?php esc_html_e( 'User reviews', 'macsoft' ); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="section-title">
        <h2><?php esc_html_e( 'Latest releases', 'macsoft' ); ?></h2>
        <?php if ( ! empty( $categories ) ) : ?>
            <div class="filter-tabs">
                <a href="#" class="active" data-filter="all"><?php esc_html_e( 'All', 'macsoft' ); ?></a>
                <?php foreach ( $categories as $category ) : ?>
                    <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" data-filter="<?php echo esc_attr( $category->slug ); ?>">
                        <?php echo esc_html( $category->name ); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <?php if ( $latest_query->have_posts() ) : ?>
        <div class="app-grid">
            <?php
            while ( $latest_query->have_posts() ) {
                $latest_query->the_post();
                get_template_part( 'template-parts/content', 'card' );
            }
            wp_reset_postdata();
            ?>
        </div>
    <?php else : ?>
        <?php get_template_part( 'template-parts/content', 'none' ); ?>
    <?php endif; ?>

    <section class="home-secondary">
        <div class="section-title">
            <h2><?php echo esc_html( $curated_title ); ?></h2>
            <?php if ( $curated_cta_label && $curated_cta_link ) : ?>
                <a class="hero-cta" href="<?php echo esc_url( $curated_cta_link ); ?>"><?php echo esc_html( $curated_cta_label ); ?></a>
            <?php endif; ?>
        </div>
        <div class="app-grid">
            <?php if ( $featured_query->have_posts() ) : ?>
                <?php
                while ( $featured_query->have_posts() ) {
                    $featured_query->the_post();
                    get_template_part( 'template-parts/content', 'card' );
                }
                wp_reset_postdata();
                ?>
            <?php else : ?>
                <?php get_template_part( 'template-parts/content', 'none' ); ?>
            <?php endif; ?>
        </div>
    </section>
</div>

<?php
get_footer();
