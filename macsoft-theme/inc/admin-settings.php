<?php
/**
 * Theme options page for backend customization.
 */

function macsoft_register_theme_settings() {
    register_setting( 'macsoft_theme_options_group', 'macsoft_theme_options', 'macsoft_sanitize_theme_options' );

    add_settings_section(
        'macsoft_hero_metrics',
        __( 'Hero metrics', 'macsoft' ),
        function () {
            esc_html_e( 'Override the automatically calculated numbers shown in the homepage hero.', 'macsoft' );
        },
        'macsoft_theme_options'
    );

    add_settings_field(
        'hero_apps_count',
        __( 'Apps count', 'macsoft' ),
        'macsoft_render_text_field',
        'macsoft_theme_options',
        'macsoft_hero_metrics',
        [
            'label_for'   => 'hero_apps_count',
            'description' => __( 'Displayed next to “Apps indexed”. Leave blank to use the real post count.', 'macsoft' ),
        ]
    );

    add_settings_field(
        'hero_categories_count',
        __( 'Categories count', 'macsoft' ),
        'macsoft_render_text_field',
        'macsoft_theme_options',
        'macsoft_hero_metrics',
        [
            'label_for'   => 'hero_categories_count',
            'description' => __( 'Shown next to “Categories”. Leave blank to use the automatic total.', 'macsoft' ),
        ]
    );

    add_settings_field(
        'hero_reviews_count',
        __( 'User reviews count', 'macsoft' ),
        'macsoft_render_text_field',
        'macsoft_theme_options',
        'macsoft_hero_metrics',
        [
            'label_for'   => 'hero_reviews_count',
            'description' => __( 'Shown next to “User reviews”. Leave blank to use the approved comments total.', 'macsoft' ),
        ]
    );

    add_settings_section(
        'macsoft_curated_section',
        __( 'Curated section', 'macsoft' ),
        function () {
            esc_html_e( 'Control the heading and CTA of the curated area on the homepage.', 'macsoft' );
        },
        'macsoft_theme_options'
    );

    add_settings_field(
        'curated_title',
        __( 'Section title', 'macsoft' ),
        'macsoft_render_text_field',
        'macsoft_theme_options',
        'macsoft_curated_section',
        [
            'label_for'   => 'curated_title',
            'description' => __( 'Defaults to “Curated collections”.', 'macsoft' ),
        ]
    );

    add_settings_field(
        'curated_cta_label',
        __( 'CTA label', 'macsoft' ),
        'macsoft_render_text_field',
        'macsoft_theme_options',
        'macsoft_curated_section',
        [
            'label_for'   => 'curated_cta_label',
            'description' => __( 'Defaults to “View all”.', 'macsoft' ),
        ]
    );

    add_settings_field(
        'curated_cta_link',
        __( 'CTA link', 'macsoft' ),
        'macsoft_render_text_field',
        'macsoft_theme_options',
        'macsoft_curated_section',
        [
            'label_for'   => 'curated_cta_link',
            'type'        => 'url',
            'description' => __( 'Defaults to the posts archive.', 'macsoft' ),
        ]
    );
}
add_action( 'admin_init', 'macsoft_register_theme_settings' );

function macsoft_render_text_field( $args ) {
    $type        = isset( $args['type'] ) ? $args['type'] : 'text';
    $field_id    = $args['label_for'];
    $value       = macsoft_get_theme_option( $field_id );
    $description = isset( $args['description'] ) ? $args['description'] : '';

    printf(
        '<input type="%1$s" id="%2$s" name="macsoft_theme_options[%2$s]" value="%3$s" class="regular-text" />',
        esc_attr( $type ),
        esc_attr( $field_id ),
        esc_attr( $value )
    );

    if ( $description ) {
        printf( '<p class="description">%s</p>', esc_html( $description ) );
    }
}

function macsoft_sanitize_theme_options( $input ) {
    $output = [];

    $output['hero_apps_count']       = isset( $input['hero_apps_count'] ) ? sanitize_text_field( $input['hero_apps_count'] ) : '';
    $output['hero_categories_count'] = isset( $input['hero_categories_count'] ) ? sanitize_text_field( $input['hero_categories_count'] ) : '';
    $output['hero_reviews_count']    = isset( $input['hero_reviews_count'] ) ? sanitize_text_field( $input['hero_reviews_count'] ) : '';
    $output['curated_title']         = isset( $input['curated_title'] ) ? sanitize_text_field( $input['curated_title'] ) : '';
    $output['curated_cta_label']     = isset( $input['curated_cta_label'] ) ? sanitize_text_field( $input['curated_cta_label'] ) : '';
    $output['curated_cta_link']      = isset( $input['curated_cta_link'] ) ? esc_url_raw( $input['curated_cta_link'] ) : '';

    return $output;
}

function macsoft_register_options_page() {
    add_theme_page(
        __( 'MacSoft Options', 'macsoft' ),
        __( 'MacSoft Options', 'macsoft' ),
        'manage_options',
        'macsoft-theme-options',
        'macsoft_render_options_page'
    );
}
add_action( 'admin_menu', 'macsoft_register_options_page' );

function macsoft_render_options_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'MacSoft Theme Options', 'macsoft' ); ?></h1>
        <?php settings_errors( 'macsoft_theme_options' ); ?>
        <form action="options.php" method="post">
            <?php
            settings_fields( 'macsoft_theme_options_group' );
            do_settings_sections( 'macsoft_theme_options' );
            submit_button();
            ?>
        </form>
    </div>
    <?php
}
