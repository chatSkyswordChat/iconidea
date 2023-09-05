<div class="tc-system-status-wrapper wrap">
	<?php
	do_action( 'arrowpress_dashboard_registration_box' );

	do_action( 'arrowpress_core_developer_access_box' );
	?>

    <div class="tc-notice tc-info">
        <div class="content">
            <p><?php esc_html_e( 'Please get and paste this information in your ticket when contacting support:', 'arrowpress-core' ); ?></p>

            <textarea title="tc_draw_system_status" readonly class="widefat copy-text" name="tc_draw_system_status" id="tc_draw_system_status" rows="10"><?php echo $args['draw_text']; ?></textarea>

            <div class="btn-copy-container">
                <button class="button button-secondary btn-copy-system-status" data-clipboard-target="#tc_draw_system_status"><?php esc_html_e( 'Copy status report', 'arrowpress-core' ); ?></button>

                <span class="tc-close"></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="tc-box">
                <div class="tc-box-header">
                    <h2 class="box-title"><?php esc_html_e( 'WordPress Environment', 'arrowpress-core' ); ?></h2>
                </div>
                <table class="widefat striped" cellspacing="0">
                    <tbody>
                    <tr>
                        <td><?php esc_html_e( 'Home URL:', 'arrowpress-core' ); ?></td>
                        <td><?php echo $args['home_url']; ?></td>
                    </tr>
                    <tr>
                        <td><?php esc_html_e( 'Site URL:', 'arrowpress-core' ); ?></td>
                        <td><?php echo $args['site_url']; ?></td>
                    </tr>
                    <tr>
                        <td><?php esc_html_e( 'WP Version:', 'arrowpress-core' ); ?></td>
                        <td><?php echo $args['wp_version']; ?></td>
                    </tr>
                    <tr>
                        <td><?php esc_html_e( 'Theme Name:', 'arrowpress-core' ); ?></td>
                        <td><?php echo $args['theme_name']; ?></td>
                    </tr>
                    <tr>
                        <td><?php esc_html_e( 'Theme Version:', 'arrowpress-core' ); ?></td>
                        <td><?php echo $args['theme_version']; ?></td>
                    </tr>
                    <tr>
                        <td><?php esc_html_e( 'Theme Slug:', 'arrowpress-core' ); ?></td>
                        <td><?php echo $args['theme_slug']; ?></td>
                    </tr>
                    <tr>
                        <td><?php esc_html_e( 'WP Multisite:', 'arrowpress-core' ); ?></td>
                        <td>
							<?php
							if ( $args['is_multisite'] ) {
								esc_html_e( 'Yes', 'arrowpress-core' );
							} else {
								esc_html_e( 'No', 'arrowpress-core' );
							}
							?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php esc_html_e( 'WP Debug Mode:', 'arrowpress-core' ); ?></td>
                        <td>
							<?php
							if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
								esc_html_e( 'Yes', 'arrowpress-core' );
							} else {
								esc_html_e( 'No', 'arrowpress-core' );
							}
							?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php esc_html_e( 'Language:', 'arrowpress-core' ); ?></td>
                        <td><?php echo esc_html( $args['language'] ); ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-12 col-xs-12">
            <div class="tc-box">
                <div class="tc-box-header">
                    <h2 class="box-title"><?php esc_html_e( 'Server Environment', 'arrowpress-core' ); ?></h2>
                </div>
                <table class="widefat striped" cellspacing="0">
                    <tbody>
                    <tr>
                        <td><?php esc_html_e( 'Server Info:', 'arrowpress-core' ); ?></td>
                        <td><?php echo esc_html( $args['server_info'] ); ?></td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'PHP Version:', 'arrowpress-core' ); ?></td>
                        <td>
							<?php
							if ( version_compare( $args['php_version'], '5.6', '<' ) ) {
								echo '<mark class="error"><span class="dashicons dashicons-warning"></span> ' . sprintf( __( '%1$s - We recommend a minimum PHP version of 5.6. See: %2$s', 'arrowpress-core' ), esc_html( $args['php_version'] ), '<a href="https://goo.gl/WRBYv3" target="_blank">' . __( 'How to update your PHP version', 'arrowpress-core' ) . '</a>' ) . '</mark>';
							} else {
								echo '<mark class="yes">' . esc_html( $args['php_version'] ) . '</mark>';
							}
							?>
                        </td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'PHP Post Max Size:', 'arrowpress-core' ); ?></td>
                        <td>
							<?php
							echo size_format( $args['post_max_size'] );
							?>
                        </td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'PHP Memory Limit:', 'arrowpress-core' ); ?></td>
                        <td>
							<?php
							if ( $args['memory_limit'] < 134217728 ) {
								echo '<mark class="error">' . sprintf( __( '<strong>%1$s</strong> - We recommend setting memory to at least <strong>128MB</strong>. <br /> To import demo data, <strong>256MB</strong> of memory limit is required. To learn how, see: <a href="%2$s" target="_blank">Increasing memory allocated to PHP.</a>', 'arrowpress-core' ), size_format( $args['memory_limit'] ), 'https://goo.gl/dZMRBH' ) . '</mark>';
							} elseif ( $args['memory_limit'] < 268435456 ) {
								echo '<mark class="warning">' . sprintf( __( '<strong>%1$s</strong> - Your current memory limit is sufficient, but if you need to import demo content, the required memory limit is <strong>256MB.</strong>', 'arrowpress-core' ), size_format( $args['memory_limit'] ) ) . '</mark>';
							} else {
								echo '<mark class="yes">' . size_format( $args['memory_limit'] ) . '</mark>';
							}
							?>
                        </td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'PHP Time Limit:', 'arrowpress-core' ); ?></td>
                        <td>
							<?php
							if ( $args['max_execution_time'] >= 60 || $args['max_execution_time'] == 0 ) {
								echo '<mark class="yes">' . $args['max_execution_time'] . ' s</mark>';
							} else {
								echo '<mark class="warning">' . sprintf( __( '<strong>%1$s</strong> - We recommend setting max execution time to at least <strong>60</strong>. See: <a href="%2$s" target="_blank">Increasing max execution to PHP</a>', 'arrowpress-core' ), $args['max_execution_time'], 'https://goo.gl/RgZwQz' ) . '</mark>';
							}
							?>
                        </td>
                    </tr>

                    <tr>
                        <td><?php _e( 'MySQL Version:', 'arrowpress-core' ); ?></td>
                        <td>
							<?php echo esc_html( $args['mysql_version'] ); ?>
                        </td>
                    </tr>

                    <tr>
                        <td><?php esc_html_e( 'Max Upload Size:', 'arrowpress-core' ); ?></td>
                        <td>
							<?php echo size_format( $args['max_upload_size'] ); ?>
                        </td>
                    </tr>

                    <tr>
                        <td><?php _e( 'cURL version', 'arrowpress-core' ); ?>:</td>
                        <td><?php echo esc_html( $args['curl_version'] ); ?></td>
                    </tr>

                    <tr>
                        <td><?php _e( 'Remote GET:', 'arrowpress-core' ); ?></td>
                        <td>
							<?php
							if ( $args['remote_get_successful'] ) {
								echo '<mark class="yes"><span class="dashicons dashicons-yes"></span></mark>';
							} else {
								echo '<mark class="error"><span class="dashicons dashicons-warning"></span> ' . sprintf( __( 'wp_remote_get() failed. Contact your hosting provider with error: <code>%s</code></br> URL: <code>%s</code>', 'arrowpress-core' ), esc_html( $args['remote_get_response'] ), esc_url( $args['remote_get_test_url'] ) ) . '</mark>';
							}
							?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php _e( 'PHP DOM extension', 'arrowpress-core' ); ?></td>
                        <td>
							<?php
							if ( $args['dom_extension'] ) {
								echo '<mark class="yes"><span class="dashicons dashicons-yes"></span></mark>';
							} else {
								echo '<mark class="error"><span class="dashicons dashicons-warning"></span> ' . __( 'PHP DOM extension is missing. Contact your hosting provider.', 'arrowpress-core' ) . '</mark>';
							}
							?>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
