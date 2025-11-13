<?php
/**
 * Helper template tags for the MacSoft theme.
 */

function macsoft_posted_on() {
    echo '<span class="posted-on">' . esc_html( get_the_date() ) . '</span>';
}

function macsoft_app_meta_badges( $post_id = null ) {
    $post_id = $post_id ?: get_the_ID();
    $meta    = macsoft_get_app_meta_fields( $post_id );

    $badges = [];
    if ( $meta['version'] ) {
        $badges[] = sprintf( '<span class="badge version">v%s</span>', esc_html( $meta['version'] ) );
    }
    if ( $meta['file_size'] ) {
        $badges[] = sprintf( '<span class="badge size">%s</span>', esc_html( $meta['file_size'] ) );
    }
    if ( $meta['requirements'] ) {
        $badges[] = sprintf( '<span class="badge requirements">%s</span>', esc_html( $meta['requirements'] ) );
    }

    if ( $badges ) {
        echo '<div class="app-badges">' . implode( '', $badges ) . '</div>';
    }
}

function macsoft_download_button( $post_id = null, $label = null ) {
    $post_id = $post_id ?: get_the_ID();
    $meta    = macsoft_get_app_meta_fields( $post_id );

    $primary_label = $label ? $label : __( 'Download', 'macsoft' );

    if ( ! empty( $meta['download_url'] ) ) {
        printf(
            '<a class="download-button" href="%1$s" target="_blank" rel="noopener">%2$s</a>',
            esc_url( $meta['download_url'] ),
            esc_html( $primary_label )
        );
    }
}

function macsoft_get_mirror_links( $post_id = null ) {
    $post_id = $post_id ?: get_the_ID();
    $meta    = macsoft_get_app_meta_fields( $post_id );

    $mirrors_raw = isset( $meta['mirror_links'] ) ? $meta['mirror_links'] : '';
    $lines       = array_filter( array_map( 'trim', explode( "\n", (string) $mirrors_raw ) ) );
    $mirrors     = [];

    foreach ( $lines as $line ) {
        $parts = array_map( 'trim', explode( '|', $line ) );
        $label = $parts[0] ?? '';
        $url   = $parts[1] ?? '';
        if ( $label && $url ) {
            $mirrors[] = [
                'label' => $label,
                'url'   => $url,
            ];
        }
    }

    return $mirrors;
}
