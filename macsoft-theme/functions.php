<?php
/**
 * MacSoft Theme functions and definitions
 */

if ( ! defined( 'MACSOFT_VERSION' ) ) {
    define( 'MACSOFT_VERSION', '1.0.0' );
}

require_once get_template_directory() . '/inc/custom-fields.php';
require_once get_template_directory() . '/inc/template-tags.php';

function macsoft_get_theme_option( $key, $default = '' ) {
    $options = get_option( 'macsoft_theme_options', [] );

    if ( ! is_array( $options ) ) {
        $options = [];
    }

    if ( isset( $options[ $key ] ) && '' !== $options[ $key ] ) {
        return $options[ $key ];
    }

    return $default;
}

function macsoft_theme_support() {
    load_theme_textdomain( 'macsoft', get_template_directory() . '/languages' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', [
        'height'      => 64,
        'width'       => 64,
        'flex-width'  => true,
        'flex-height' => true,
    ] );
    add_theme_support( 'html5', [ 'search-form', 'gallery', 'caption', 'style', 'script' ] );
    register_nav_menus( [
        'primary' => __( 'Primary Menu', 'macsoft' ),
        'secondary' => __( 'Secondary Menu', 'macsoft' ),
        'footer' => __( 'Footer Menu', 'macsoft' ),
    ] );
}
add_action( 'after_setup_theme', 'macsoft_theme_support' );

function macsoft_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'macsoft_content_width', 900 );
}
add_action( 'after_setup_theme', 'macsoft_content_width', 0 );

function macsoft_widgets_init() {
    register_sidebar( [
        'name'          => __( 'Sidebar', 'macsoft' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Add widgets here to appear in the sidebar.', 'macsoft' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ] );
}
add_action( 'widgets_init', 'macsoft_widgets_init' );

function macsoft_enqueue_scripts() {
    $theme_version = wp_get_theme()->get( 'Version' );

    wp_enqueue_style( 'macsoft-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap', [], null );
    wp_enqueue_style( 'macsoft-style', get_template_directory_uri() . '/assets/css/main.css', [], $theme_version );

    wp_enqueue_script( 'macsoft-script', get_template_directory_uri() . '/assets/js/main.js', [ 'jquery' ], $theme_version, true );
    wp_localize_script( 'macsoft-script', 'macsoftSettings', [
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'search_placeholder' => __( 'Search apps…', 'macsoft' ),
    ] );
}
add_action( 'wp_enqueue_scripts', 'macsoft_enqueue_scripts' );

function macsoft_register_image_sizes() {
    add_image_size( 'macsoft-card', 320, 200, true );
    add_image_size( 'macsoft-featured', 640, 360, true );
}
add_action( 'after_setup_theme', 'macsoft_register_image_sizes' );

require_once get_template_directory() . '/inc/admin-settings.php';
require_once get_template_directory() . '/inc/customizer.php';
