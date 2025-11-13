<?php get_header(); ?>
<div class="container">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
        $meta          = macsoft_get_app_meta_fields( get_the_ID() );
        $mirrors       = macsoft_get_mirror_links();
        $downloads     = $meta['downloads'] ? number_format_i18n( (int) $meta['downloads'] ) : '—';
        $language      = $meta['language'] ?: __( 'Multi', 'macsoft' );
        $file_size     = $meta['file_size'] ?: '—';
        $requirements  = $meta['requirements'] ?: __( 'macOS 11+', 'macsoft' );
        $version       = $meta['version'] ?: __( 'Latest', 'macsoft' );
        $updated_label = $meta['update_date'] ?: get_the_date();
        $install_notes = $meta['install_notes'];
    ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="single-app">
                <div class="app-summary">
                    <div class="app-header">
                        <div class="app-thumb">
                            <?php if ( has_post_thumbnail() ) {
                                the_post_thumbnail( 'macsoft-featured' );
                            } else {
                                echo '<img src="' . esc_url( get_template_directory_uri() . '/assets/images/placeholder-app.svg' ) . '" alt="' . esc_attr( get_the_title() ) . '">';
                            } ?>
                        </div>
                        <div>
                            <div class="category-pill">
                                <?php
                                $cats = get_the_category();
                                echo esc_html( $cats ? $cats[0]->name : __( 'Apps', 'macsoft' ) );
                                ?>
                            </div>
                            <h1><?php the_title(); ?></h1>
                            <?php if ( has_excerpt() ) : ?>
                                <p><?php echo esc_html( get_the_excerpt() ); ?></p>
                            <?php endif; ?>
                            <?php macsoft_app_meta_badges(); ?>
                            <div class="card-meta">
                                <?php macsoft_posted_on(); ?>
                                <span><?php echo esc_html( sprintf( __( '%s comments', 'macsoft' ), get_comments_number() ) ); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="app-meta-grid">
                        <div class="app-meta-card">
                            <span><?php esc_html_e( 'Version', 'macsoft' ); ?></span>
                            <strong><?php echo esc_html( $version ); ?></strong>
                        </div>
                        <div class="app-meta-card">
                            <span><?php esc_html_e( 'Size', 'macsoft' ); ?></span>
                            <strong><?php echo esc_html( $file_size ); ?></strong>
                        </div>
                        <div class="app-meta-card">
                            <span><?php esc_html_e( 'Downloads', 'macsoft' ); ?></span>
                            <strong><?php echo esc_html( $downloads ); ?></strong>
                        </div>
                        <div class="app-meta-card">
                            <span><?php esc_html_e( 'Language', 'macsoft' ); ?></span>
                            <strong><?php echo esc_html( $language ); ?></strong>
                        </div>
                        <div class="app-meta-card">
                            <span><?php esc_html_e( 'Compatibility', 'macsoft' ); ?></span>
                            <strong><?php echo esc_html( $requirements ); ?></strong>
                        </div>
                        <div class="app-meta-card">
                            <span><?php esc_html_e( 'Updated', 'macsoft' ); ?></span>
                            <strong><?php echo esc_html( $updated_label ); ?></strong>
                        </div>
                    </div>
                </div>
                <aside class="app-panel">
                    <div>
                        <h3><?php esc_html_e( '立即下载', 'macsoft' ); ?></h3>
                        <?php macsoft_download_button( null, __( '高速下载', 'macsoft' ) ); ?>
                        <?php if ( ! empty( $meta['password'] ) ) : ?>
                            <div class="password-chip">
                                <?php esc_html_e( '提取码', 'macsoft' ); ?>: <?php echo esc_html( $meta['password'] ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if ( $mirrors ) : ?>
                        <div class="mirror-links">
                            <h4><?php esc_html_e( '镜像通道', 'macsoft' ); ?></h4>
                            <?php foreach ( $mirrors as $mirror ) : ?>
                                <a href="<?php echo esc_url( $mirror['url'] ); ?>" target="_blank" rel="noopener">
                                    <span><?php echo esc_html( $mirror['label'] ); ?></span>
                                    <span>⇣</span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <div class="panel-extra">
                        <p><?php esc_html_e( '软件安装、需求等问题请加入QQ群', 'macsoft' ); ?>：<strong>623760607</strong></p>
                        <a class="hero-cta" href="https://qm.qq.com/cgi-bin/qm/qr?_wv=1027&amp;k=QMe6PjtKnzoMnXd3qWHGDsFyAjnHC_HY&amp;group_code=623760607" target="_blank" rel="noopener">
                            <?php esc_html_e( '加入交流群', 'macsoft' ); ?>
                        </a>
                    </div>
                </aside>
            </div>

            <div class="app-tabs" role="tablist">
                <button type="button" class="active" data-tab="tab-overview"><?php esc_html_e( '详情介绍', 'macsoft' ); ?></button>
                <button type="button" data-tab="tab-install"><?php esc_html_e( '安装必读', 'macsoft' ); ?></button>
                <button type="button" data-tab="tab-comments"><?php esc_html_e( '用户评论', 'macsoft' ); ?></button>
            </div>
            <div id="tab-overview" class="tab-panel active">
                <?php the_content(); ?>
            </div>
            <div id="tab-install" class="tab-panel install-notes">
                <?php if ( $install_notes ) : ?>
                    <?php echo wp_kses_post( wpautop( $install_notes ) ); ?>
                <?php else : ?>
                    <p><?php esc_html_e( '暂无安装说明，下载包内含安装引导。', 'macsoft' ); ?></p>
                <?php endif; ?>
            </div>
            <div id="tab-comments" class="tab-panel">
                <?php comments_template(); ?>
            </div>
        </article>
    <?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>
