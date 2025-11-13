<?php get_header(); ?>
<div class="container">
    <div class="single-content" style="text-align:center;">
        <h1><?php esc_html_e( '404', 'macsoft' ); ?></h1>
        <p><?php esc_html_e( 'We could not find the page you were looking for.', 'macsoft' ); ?></p>
        <a class="hero-cta" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to home', 'macsoft' ); ?></a>
    </div>
</div>
<?php get_footer(); ?>
