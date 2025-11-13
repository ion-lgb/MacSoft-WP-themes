</main>
<footer class="site-footer">
    <div class="container">
        <div class="footer-widgets">
            <div>
                <h3><?php esc_html_e( 'About', 'macsoft' ); ?></h3>
                <p><?php esc_html_e( 'MacSoft offers curated macOS applications with fast download mirrors and clear compatibility information.', 'macsoft' ); ?></p>
            </div>
            <div>
                <h3><?php esc_html_e( 'Categories', 'macsoft' ); ?></h3>
                <ul>
                    <?php
                    wp_list_categories( [
                        'title_li' => '',
                        'number'   => 5,
                    ] );
                    ?>
                </ul>
            </div>
            <div>
                <h3><?php esc_html_e( 'Newsletter', 'macsoft' ); ?></h3>
                <p><?php esc_html_e( 'Stay informed when new macOS apps or updates drop.', 'macsoft' ); ?></p>
                <form class="newsletter" method="post" action="#">
                    <input type="email" name="email" placeholder="<?php esc_attr_e( 'Email address', 'macsoft' ); ?>" required>
                    <button type="submit"><?php esc_html_e( 'Subscribe', 'macsoft' ); ?></button>
                </form>
            </div>
        </div>
        <div class="footer-bottom">
            <span>&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></span>
            <nav class="footer-nav" aria-label="<?php esc_attr_e( 'Footer menu', 'macsoft' ); ?>">
                <?php
                wp_nav_menu( [
                    'theme_location' => 'footer',
                    'menu_class'     => 'footer-menu',
                    'fallback_cb'    => false,
                ] );
                ?>
            </nav>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
