<?php
/**
 * Basic Customizer settings for hero section.
 */

function macsoft_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'macsoft_hero_section', [
        'title'       => __( 'Hero Section', 'macsoft' ),
        'description' => __( 'Controls the hero area displayed on the front page.', 'macsoft' ),
        'priority'    => 30,
    ] );

    $wp_customize->add_setting( 'macsoft_hero_title', [
        'default'           => __( 'Discover curated macOS apps', 'macsoft' ),
        'sanitize_callback' => 'sanitize_text_field',
    ] );

    $wp_customize->add_control( 'macsoft_hero_title', [
        'label'   => __( 'Hero Title', 'macsoft' ),
        'section' => 'macsoft_hero_section',
        'type'    => 'text',
    ] );

    $wp_customize->add_setting( 'macsoft_hero_subtitle', [
        'default'           => __( 'Handpicked apps, clean download experience, zero clutter.', 'macsoft' ),
        'sanitize_callback' => 'sanitize_textarea_field',
    ] );

    $wp_customize->add_control( 'macsoft_hero_subtitle', [
        'label'   => __( 'Hero Subtitle', 'macsoft' ),
        'section' => 'macsoft_hero_section',
        'type'    => 'textarea',
    ] );

    $wp_customize->add_setting( 'macsoft_hero_cta_label', [
        'default'           => __( 'Browse latest apps', 'macsoft' ),
        'sanitize_callback' => 'sanitize_text_field',
    ] );

    $wp_customize->add_setting( 'macsoft_hero_cta_link', [
        'default'           => home_url( '/category/utilities/' ),
        'sanitize_callback' => 'esc_url_raw',
    ] );

    $wp_customize->add_control( 'macsoft_hero_cta_label', [
        'label'   => __( 'CTA Label', 'macsoft' ),
        'section' => 'macsoft_hero_section',
        'type'    => 'text',
    ] );

    $wp_customize->add_control( 'macsoft_hero_cta_link', [
        'label'   => __( 'CTA Link', 'macsoft' ),
        'section' => 'macsoft_hero_section',
        'type'    => 'url',
    ] );
}
add_action( 'customize_register', 'macsoft_customize_register' );
