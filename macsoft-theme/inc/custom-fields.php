<?php
/**
 * Register custom meta fields for app details.
 */

function macsoft_register_meta_boxes() {
    add_meta_box(
        'macsoft_app_details',
        __( 'App Details', 'macsoft' ),
        'macsoft_render_app_meta',
        'post',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'macsoft_register_meta_boxes' );

function macsoft_render_app_meta( $post ) {
    wp_nonce_field( 'macsoft_save_meta', 'macsoft_meta_nonce' );
    $fields = macsoft_get_app_meta_fields( $post->ID );
    ?>
    <p>
        <label for="macsoft_download_url"><strong><?php esc_html_e( 'Primary download URL', 'macsoft' ); ?></strong></label>
        <input type="url" id="macsoft_download_url" name="macsoft_download_url" class="widefat" value="<?php echo esc_attr( $fields['download_url'] ); ?>" />
    </p>
    <p>
        <label for="macsoft_mirror_links"><strong><?php esc_html_e( 'Mirror links', 'macsoft' ); ?></strong></label>
        <textarea id="macsoft_mirror_links" name="macsoft_mirror_links" class="widefat" rows="3" placeholder="<?php esc_attr_e( 'Label|https://example.com', 'macsoft' ); ?>"><?php echo esc_textarea( $fields['mirror_links'] ); ?></textarea>
        <span class="description"><?php esc_html_e( 'One mirror per line: Label|URL', 'macsoft' ); ?></span>
    </p>
    <hr>
    <p>
        <label for="macsoft_version"><strong><?php esc_html_e( 'Version', 'macsoft' ); ?></strong></label>
        <input type="text" id="macsoft_version" name="macsoft_version" class="widefat" value="<?php echo esc_attr( $fields['version'] ); ?>" />
    </p>
    <p>
        <label for="macsoft_file_size"><strong><?php esc_html_e( 'File Size', 'macsoft' ); ?></strong></label>
        <input type="text" id="macsoft_file_size" name="macsoft_file_size" class="widefat" value="<?php echo esc_attr( $fields['file_size'] ); ?>" />
    </p>
    <p>
        <label for="macsoft_language"><strong><?php esc_html_e( 'Language', 'macsoft' ); ?></strong></label>
        <input type="text" id="macsoft_language" name="macsoft_language" class="widefat" value="<?php echo esc_attr( $fields['language'] ); ?>" />
    </p>
    <p>
        <label for="macsoft_downloads"><strong><?php esc_html_e( 'Downloads (number)', 'macsoft' ); ?></strong></label>
        <input type="number" id="macsoft_downloads" name="macsoft_downloads" class="widefat" value="<?php echo esc_attr( $fields['downloads'] ); ?>" />
    </p>
    <p>
        <label for="macsoft_requirements"><strong><?php esc_html_e( 'Compatibility / Requirements', 'macsoft' ); ?></strong></label>
        <input type="text" id="macsoft_requirements" name="macsoft_requirements" class="widefat" value="<?php echo esc_attr( $fields['requirements'] ); ?>" />
    </p>
    <p>
        <label for="macsoft_update_date"><strong><?php esc_html_e( 'Update date override', 'macsoft' ); ?></strong></label>
        <input type="text" id="macsoft_update_date" name="macsoft_update_date" class="widefat" placeholder="2025-08-20" value="<?php echo esc_attr( $fields['update_date'] ); ?>" />
    </p>
    <p>
        <label for="macsoft_password"><strong><?php esc_html_e( 'Extraction password', 'macsoft' ); ?></strong></label>
        <input type="text" id="macsoft_password" name="macsoft_password" class="widefat" value="<?php echo esc_attr( $fields['password'] ); ?>" />
    </p>
    <p>
        <label for="macsoft_install_notes"><strong><?php esc_html_e( 'Installation notes', 'macsoft' ); ?></strong></label>
        <textarea id="macsoft_install_notes" name="macsoft_install_notes" class="widefat" rows="4" placeholder="<?php esc_attr_e( 'Bullet instructions...', 'macsoft' ); ?>"><?php echo esc_textarea( $fields['install_notes'] ); ?></textarea>
    </p>
    <?php
}

function macsoft_save_meta( $post_id ) {
    if ( ! isset( $_POST['macsoft_meta_nonce'] ) || ! wp_verify_nonce( $_POST['macsoft_meta_nonce'], 'macsoft_save_meta' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( isset( $_POST['post_type'] ) && 'page' === $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }
    } elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $fields = [
        'macsoft_download_url' => 'esc_url_raw',
        'macsoft_mirror_links' => 'macsoft_sanitize_textarea',
        'macsoft_version'      => 'sanitize_text_field',
        'macsoft_file_size'    => 'sanitize_text_field',
        'macsoft_language'     => 'sanitize_text_field',
        'macsoft_downloads'    => 'absint',
        'macsoft_requirements' => 'sanitize_text_field',
        'macsoft_update_date'  => 'sanitize_text_field',
        'macsoft_password'     => 'sanitize_text_field',
        'macsoft_install_notes'=> 'macsoft_sanitize_textarea',
    ];

    foreach ( $fields as $field => $sanitize_callback ) {
        if ( isset( $_POST[ $field ] ) ) {
            update_post_meta( $post_id, $field, call_user_func( $sanitize_callback, wp_unslash( $_POST[ $field ] ) ) );
        }
    }
}
add_action( 'save_post', 'macsoft_save_meta' );

function macsoft_get_app_meta_fields( $post_id ) {
    return [
        'download_url'  => get_post_meta( $post_id, 'macsoft_download_url', true ),
        'mirror_links'  => get_post_meta( $post_id, 'macsoft_mirror_links', true ),
        'version'       => get_post_meta( $post_id, 'macsoft_version', true ),
        'file_size'     => get_post_meta( $post_id, 'macsoft_file_size', true ),
        'language'      => get_post_meta( $post_id, 'macsoft_language', true ),
        'downloads'     => get_post_meta( $post_id, 'macsoft_downloads', true ),
        'requirements'  => get_post_meta( $post_id, 'macsoft_requirements', true ),
        'update_date'   => get_post_meta( $post_id, 'macsoft_update_date', true ),
        'password'      => get_post_meta( $post_id, 'macsoft_password', true ),
        'install_notes' => get_post_meta( $post_id, 'macsoft_install_notes', true ),
    ];
}

function macsoft_sanitize_textarea( $value ) {
    return wp_kses_post( $value );
}
