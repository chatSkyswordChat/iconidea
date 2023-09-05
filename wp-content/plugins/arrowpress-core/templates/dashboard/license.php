<?php
$token = get_option( 'arrowpress_purchase_token' );
$personal_token = get_option( 'arrowpress_personal_token' );
$purchase_code = get_option( 'arrowpress_purchase_code' );
$user  = wp_get_current_user();
$theme_data = Arrowpress_Theme_Manager::get_metadata();
$theme = $theme_data['template'];
$version = $theme_data['version'];
?>

<div class="tc-box tc-box-theme-license">
	<div class="tc-box-header">
		<h2 class="box-title">Activate your theme license</h2>
	</div>

	<div class="tc-box-body">
		<h3>Theme license activation form</h3>

		<?php if ( $token ) : ?>
			<p class="tc-license-activated">
				<p>Your theme license is activated. Thank you!</p>
				<table class="form-table">
					<tbody>
							<?php if ( ! empty( $purchase_code ) ) : ?>
								<tr>
									<th scope="row">
										<?php esc_html_e( 'Purchase code: ', 'arrowpress-core' ); ?>
									</th>
									<td>
										<?php // Show purchase code with **** and last 3 characters of the purchase code with format uuid4 ?>
										<?php echo esc_html( str_repeat( '*', strlen( $purchase_code ) - 7 ) . substr( $purchase_code, -4 ) ); ?>
									</td>
								</tr>
							<?php endif; ?>
							<?php if ( ! empty( $personal_token ) ) : ?>
								<tr>
									<th scope="row">
										<?php esc_html_e( 'Personal token: ', 'arrowpress-core' ); ?>
									</th>
									<td>
										<?php // Show personal token with **** and show last 3 characters of the personal token ?>
										<?php echo esc_html( str_repeat( '*', strlen( $personal_token ) - 7 ) . substr( $personal_token, -4 ) ); ?>
									</td>
								</tr>
							<?php endif; ?>
					</tbody>
				</table>
			</p>
			<?php if ( empty( $personal_token ) ) : ?>
				<form class="arrowpress-form-personal" action="" method="post">
					<table class="form-table">
						<tbody>
							<tr>
								<th scope="row">Personal token (optional)</th>
								<td>
									<input type="text" id="personal_token" name="personal_token" value="" placeholder="Enter personal token" autocomplete="off" required>
									<p>Use for auto update theme.</p>
									<ol>
										<li><?php printf( esc_html__( 'Generate an Envato API Personal Token by %s.', 'arrowpress-core' ), '<a href="https://build.envato.com/create-token/?default=t&purchase:download=t&purchase:list=t" target="_blank">' . esc_html__( 'clicking this link', 'arrowpress-core' ) . '</a>' ); ?></li>
										<li><?php esc_html_e( 'Name the token eg “My WordPress site”.', 'arrowpress-core' ); ?></li>
										<li><?php esc_html_e( 'Ensure the following permissions are enabled:', 'arrowpress-core' ); ?>
											<ul>
												<li><?php esc_html_e( 'View and search Envato sites', 'arrowpress-core' ); ?></li>
												<li><?php esc_html_e( 'Download your purchased items', 'arrowpress-core' ); ?></li>
												<li><?php esc_html_e( "List purchases you've made", 'arrowpress-core' ); ?></li>
											</ul>
										</li>
									</ol>
								</td>
							</tr>
						</tbody>
					</table>

					<button class="arrow-personal-token button button-primary tc-button" type="submit">
						<?php esc_html_e( 'Update', 'arrowpress-core' ); ?>
					</button>
				<?php endif; ?>
					<button class="arrow-deactivate button button-secondary tc-button deactivate-btn tc-run-step">
						<?php esc_html_e( 'Deactivate theme', 'arrowpress-core' ); ?>
					</button>
			<?php if ( empty( $personal_token ) ) : ?>
				</form>
			<?php endif; ?>
		<?php else: ?>
			<p>Activate your purchase code for this domain to turn on auto updates function.</p>
			
			<form class="arrowpress-form-license" action="" method="post">
				<table class="form-table">
					<tbody>
						<tr>
							<th scope="row">Purchase code</th>
							<td>
								<input type="text" id="purchase_code" name="purchase_code" value="" placeholder="Enter purchase code" autocomplete="off" required>
								<p><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank" rel="noopener">Where can I get my purchase code?</a></p>
							</td>
						</tr>

						<?php if ( empty( $personal_token ) ) : ?>
							<tr>
								<th scope="row">Personal token (optional)</th>
								<td>
									<input type="text" id="personal_token" name="personal_token" value="" placeholder="Enter personal token" autocomplete="off">
									<p>Use for auto update theme.</p>
									<ol>
										<li><?php printf( esc_html__( 'Generate an Envato API Personal Token by %s.', 'envato-market' ), '<a href="https://build.envato.com/create-token/?default=t&purchase:download=t&purchase:list=t" target="_blank">' . esc_html__( 'clicking this link', 'envato-market' ) . '</a>' ); ?></li>
										<li><?php esc_html_e( 'Name the token eg “My WordPress site”.', 'envato-market' ); ?></li>
										<li><?php esc_html_e( 'Ensure the following permissions are enabled:', 'envato-market' ); ?>
											<ul>
												<li><?php esc_html_e( 'View and search Envato sites', 'envato-market' ); ?></li>
												<li><?php esc_html_e( 'Download your purchased items', 'envato-market' ); ?></li>
												<li><?php esc_html_e( "List purchases you've made", 'arrowpress-core' ); ?></li>
											</ul>
										</li>
									</ol>
								</td>
							</tr>
						<?php endif; ?>
					</tbody>
				</table>
				<p>
					<label for="agree_stored" class="agree-label">
						<input type="checkbox" name="agree_stored" id="agree_stored" required>
						I agree that my purchase code and user data will be stored by arrowtheme.com											
					</label>
				</p>
			
				<input type="hidden" name="domain" value="<?php echo esc_url( site_url() ); ?>">
				<input type="hidden" name="theme" value="<?php echo esc_attr( $theme ); ?>">
				<input type="hidden" name="theme_version" value="<?php echo esc_attr( $version ); ?>">
				<input type="hidden" name="user_email" value="<?php echo esc_attr( $user ? $user->user_email : '' ); ?>">

				<button class="button button-primary tc-button activate-btn tc-run-step" type="submit">
					<?php esc_html_e( 'Submit', 'arrowpress-core' ); ?>
				</button>
			</form>
		<?php endif; ?>

		<p>Note: you are allowed to use our theme only on one domain if you purchased a regular license.</p>
	</div>
</div>
