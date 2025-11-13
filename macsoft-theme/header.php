<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
    <div class="container nav-wrapper">
        <div class="logo">
            <?php
            if ( has_custom_logo() ) {
                the_custom_logo();
            } else {
                echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="site-title">' . esc_html( get_bloginfo( 'name' ) ) . '</a>';
            }
            ?>
        </div>
        <nav class="primary-nav" aria-label="<?php esc_attr_e( 'Primary menu', 'macsoft' ); ?>">
            <?php
            wp_nav_menu( [
                'theme_location' => 'primary',
                'menu_class'     => 'primary-menu',
                'fallback_cb'    => false,
            ] );
            ?>
        </nav>
        <div class="theme-search">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
                <input type="search" name="s" placeholder="<?php esc_attr_e( 'Search apps…', 'macsoft' ); ?>">
            </form>
        </div>
    </div>
</header>
<main id="primary" class="site-main">
