<?php

do_action( 'arrowpress_core_background_check_update_theme' );

$theme_data      = Arrowpress_Theme_Manager::get_metadata();
$template        = $theme_data['template'];
$current_version = $theme_data['version'];

$update_themes = Arrowpress_Product_Registration::get_update_themes();
$themes        = $update_themes['themes'];
$last_checked  = $update_themes['last_checked'];

$data = isset( $themes[ $template ] ) ? $themes[ $template ] : false;

$is_active  = Arrowpress_Product_Registration::is_active();
$link_check = Arrowpress_Dashboard::get_link_main_dashboard(
	array(
		'force-check' => 1,
	)
);
$can_update = Arrowpress_Theme_Manager::can_update();

$class = $is_active ? 'active-registration' : 'inactive-registration';
$personal_token = get_option( 'arrowpress_personal_token' );
?>
<div class="tc-box-body">
	<div class="tc-box-update-wrapper <?php echo esc_attr( $class ); ?>">
		<?php if ( ! $data ) : ?>
			<div class="note">
				<?php esc_html_e( 'Something went wrong! Please try again later.', 'arrowpress-core' ); ?>
			</div>
		<?php else : ?>
			<button class="button button-link tc-button-deregister"><?php esc_html_e( 'Deregister', 'arrowpress-core' ); ?></button>

			<a class="item-icon" href="<?php echo esc_url( $data['url'] ); ?>" target="_blank">
				<img src="<?php echo esc_url( $data['icon'] ); ?>" alt="<?php echo esc_attr( $data['name'] ); ?>">
			</a>

			<div class="item-detail">
				<h4>
					<span class="name"><?php echo esc_html( $data['name'] ); ?></span>
					<span class="version"><?php printf( __( 'Version: <span class="version-number">%s</span>', 'arrowpress-core' ), $current_version ); ?></span>
				</h4>

				<?php
				if ( ! empty( $data['rating_count'] ) ) {
					wp_star_rating( array(
						'rating' => $data['rating'] * 100 / 5,
						'type'   => 'percent',
						'number' => $data['rating_count'],
					) );
				}
				?>

				<p class="description"><?php echo esc_html( $data['description'] ); ?></p>
				<p class="author">
					<cite><?php printf( __( 'By <a href="%1$s" target="_blank">%2$s</a>', 'arrowpress-core' ), $data['author_url'], $data['author'] ); ?></cite>
				</p>
			</div>

			<?php if ( $can_update ) : ?>
				<div class="update-message notice inline notice-warning notice-alt">
					<p><a href="<?php echo esc_url( $data['url'] ); ?>"
						  target="_blank"><?php printf( __( 'View version %1$s details.', 'arrowpress-core' ), $data['version'] ); ?></a>
						<?php if ( $is_active ) : ?>
							<?php if ( Arrowpress_Envato_Hosted::is_envato_hosted_site() ): ?>
								<?php printf( __( '<span>Use <strong>Envato Market</strong> plugin to update the theme.</span>', 'arrowpress-core' ) ); ?>
							<?php elseif ( empty( $personal_token ) ): ?>
								<strong><?php printf( __( 'Please <a href="%1$s">add personal token</a> to update theme.', 'arrowpress-core' ), esc_url( admin_url( '/admin.php?page=arrowpress-license') ) ); ?></strong>
							<?php else: ?>
								<button class="button-link tc-update-now" type="button"><?php esc_html_e( 'Update now.', 'arrowpress-core' ); ?></button>
							<?php endif; ?>
						<?php else : ?>
							<strong><?php printf( __( 'Please <a href="%1$s">activate theme</a> to update theme.', 'arrowpress-core' ), esc_url( admin_url( '/admin.php?page=arrowpress-license') ) ); ?></strong>
						<?php endif; ?>
					</p>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</div>

<div class="tc-box-footer">
	<?php
	if ( $last_checked ) {
		$last_checked = $last_checked + get_option( 'gmt_offset' ) * HOUR_IN_SECONDS;
		printf( __( '<span class="tc-last-check">Last checked on %1$s at %2$s.</span>', 'arrowpress-core' ), date_i18n( __( 'F j, Y' ), $last_checked ), date_i18n( __( 'g:i a' ), $last_checked ) );
	}
	?>
	<a class="button button-secondary tc-button"
	   href="<?php echo esc_url( $link_check ); ?>"><?php esc_html_e( 'Check again', 'arrowpress-core' ); ?></a>
</div>
