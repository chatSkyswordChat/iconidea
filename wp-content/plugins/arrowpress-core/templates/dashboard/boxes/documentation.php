<?php
$theme_data = Arrowpress_Theme_Manager::get_metadata();
$links      = $theme_data['links'];

wp_enqueue_script( 'arrowpress-developer-access' );
$is_granted              = Arrowpress_Developer_Access::is_granted();
$enable_developer_access = apply_filters( 'arrowpress_core_enable_developer_access', true );

?>
<div class="tc-box-body">
    <div class="tc-documentation-wrapper">
        <div class="list-boxes">
            <div class="box">
                <div class="left">
                    <span class="dashicons dashicons-admin-site"></span>
                </div>
                <div class="right">
                    <h3><?php esc_html_e( 'Knowledge Base', 'arrowpress-core' ); ?></h3>
                    <p class="description"><?php esc_html_e( 'You can find detailed answers to almost all common issues regarding theme and plugins usage here.', 'arrowpress-core' ); ?></p>
                    <a href="<?php echo esc_url( $links['knowledge'] ); ?>"
                       target="_blank"><?php esc_html_e( 'Read more', 'arrowpress-core' ); ?></a>
                </div>
            </div>
            <div class="box">
                <div class="left">
                    <span class="dashicons dashicons-book"></span>
                </div>
                <div class="right">
                    <h3><?php esc_html_e( 'Theme Documentation', 'arrowpress-core' ); ?></h3>
                    <p class="description"><?php esc_html_e( 'A collection of step-by-step guides to help you install, customize and work effectively with the theme.', 'arrowpress-core' ); ?></p>
                    <a href="<?php echo esc_url( $links['docs'] ); ?>"
                       target="_blank"><?php esc_html_e( 'Read more', 'arrowpress-core' ); ?></a>
                </div>
            </div>
            <div class="box">
                <div class="left">
                    <span class="dashicons dashicons-sos"></span>
                </div>

                <div class="right">
                    <h3><?php esc_html_e( 'Support Forum', 'arrowpress-core' ); ?></h3>
                    <p class="description"><?php esc_html_e( 'If any problem arise while using the theme, this is where you can ask our technical supporters so that we can help you out.', 'arrowpress-core' ); ?></p>
                    <a href="<?php echo esc_url( $links['support'] ); ?>"
                       target="_blank"><?php esc_html_e( 'Visit now', 'arrowpress-core' ); ?></a>

                    <?php if ( $enable_developer_access ): ?>
                        <div class="tc-developer-access">
                            <form method="post">
                                <?php
                                wp_nonce_field( 'arrowpress_core_developer_access', 'arrowpress_core_developer_access' );
                                ?>
                                <?php
                                if ( $is_granted ) :
                                    $link_access = Arrowpress_Developer_Access::get_link_access();
                                    ?>
                                    <input type="hidden" name="tc-revoke-developer-access" value="1" title="revoke">
                                    <button class="button button-secondary"
                                            type="submit"><?php esc_html_e( 'Revoke developer access', 'arrowpress-core' ); ?></button>
                                    <button class="button button-primary tc-btn-copy-link" type="button"
                                            data-clipboard-target="#tc-link-developer-access"><?php esc_html_e( 'Copy link', 'arrowpress-core' ); ?></button>

                                    <div class="link">
                                    <textarea id="tc-link-developer-access" class="widefat" title="link" rows="3"
                                              readonly><?php echo esc_url( $link_access ); ?></textarea>
                                    </div>
                                <?php else : ?>
                                    <input type="hidden" name="tc-grant-developer-access" value="1" title="grant">
                                    <button class="button button-primary"
                                            type="submit"><?php esc_html_e( 'Allow developer access', 'arrowpress-core' ); ?></button>
                                <?php endif; ?>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            
        </div>
    </div>
</div>
