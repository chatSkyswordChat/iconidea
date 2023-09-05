<?php

do_action( 'arrowpress_core_check_update_external_plugins' );

$plugins  = Arrowpress_Plugins_Manager::get_plugins();
$add_ons  = Arrowpress_Plugins_Manager::get_all_add_ons();
$writable = Arrowpress_Plugins_Manager::get_permission();
?>

<div class="wrap plugin-tab">
	<?php
	do_action( 'arrowpress_dashboard_registration_box' );
	?>

	<h2 class="screen-reader-text"><?php esc_html_e( 'Filter plugins list', 'arrowpress-core' ); ?></h2>
	<div class="wp-filter">
		<ul class="filter-links">
			<li class="all" data-filter="*"><a href="#all" class="current"><?php esc_html_e( 'All ', 'arrowpress-core' ); ?>
					(<span>__</span>)</a></li>
			<li class="required" data-filter=".required"><a href="#required"
			                                                class=""><?php esc_html_e( 'Required ', 'arrowpress-core' ); ?>
					(<span>__</span>)</a></li>
			<li class="recommended" data-filter=".recommended"><a
					href="#recommended"><?php esc_html_e( 'Recommended', 'arrowpress-core' ); ?>(<span>__</span>)</a></li>
			<?php if ( count( $add_ons ) ) : ?>
				<li class="add-ons" data-filter=".add-on"><a
						href="#add-ons"><?php printf( __( 'Add-ons (%s)', 'arrowpress-core' ), count( $add_ons ) ); ?></a>
				</li>
			<?php endif; ?>
			<li class="updates" data-filter=".can-update"><a
					href="#updates"><?php esc_html_e( 'Update Available ', 'arrowpress-core' ); ?>(<span>__</span>)</a>
			</li>
		</ul>

		<div class="search-form search-plugins">
			<input type="hidden" name="tab" value="search">
			<label><span class="screen-reader-text"><?php esc_html_e( 'Search plugins', 'arrowpress-core' ); ?></span>
				<input type="search" name="s" value="" class="wp-filter-search"
				       placeholder="<?php esc_attr_e( 'Search plugins', 'arrowpress-core' ); ?>"
				       aria-describedby="live-search-desc">
			</label>
			<input type="submit" id="search-submit" class="button hide-if-js"
			       value="<?php esc_attr_e( 'Search Plugins', 'arrowpress-core' ); ?>"></div>
	</div>
	<br class="clear">

	<div id="plugin-filter">
		<div class="list-plugins">
			<?php
			foreach ( $plugins as $index => $plugin ) :
				$slug = $plugin->get_slug();
				$status      = $plugin->get_status();
 				$is_wporg    = $plugin->is_wporg();
				$plugin_info = $plugin->get_info();
				$can_update  = $plugin->can_update();
				$premium     = '1';
				$plugin_icon = ARROWPRESS_CORE_ADMIN_URI . '/assets/images/logo.svg';
				if ( $plugin->get_icon() ) {
					$plugin_icon = $plugin->get_icon();
				} elseif ( $is_wporg ) {
					$plugin_icon = 'https://ps.w.org/' . $plugin->get_slug() . '/assets/icon-128x128.png';
					$premium     = '0';
				}
				$plugin_icon = apply_filters( 'arrowpress_core_plugin_icon_install', $plugin_icon, $plugin );

				$plugin_classes = $plugin->is_required() ? 'required' : 'recommended';
				if ( $plugin->is_add_on() ) {
					$plugin_classes = 'add-on';
				}
				$plugin_classes .= " plugin-card-$slug";

				$current_version = $plugin->get_current_version();
				$version         = $current_version ? $current_version : $plugin->get_require_version();

				$plugin_classes     .= $can_update ? ' can-update' : '';
				$disable_deactivate = $plugin->disable_deactivate();
//				if ( $status == 'not_installed' ) {
//					continue;
//				}
				?>
				<div class="plugin-card <?php echo esc_attr( $plugin_classes ); ?>"
					 data-status="<?php echo esc_attr( $status ); ?>"
					 id="plugin-<?php echo esc_attr( $slug ); ?>">
					<div class="plugin-card-top">
						<div class="name column-name">
							<div class="plugin-icon">
								<img src="<?php echo esc_url( $plugin_icon ); ?>"
									 alt="<?php echo esc_attr( $plugin->get_name() ); ?>">
							</div>

							<h3>
								<span class="data_Name"><?php echo esc_html( $plugin->get_name() ); ?></span>

							</h3>
						</div>
						<div class="action-links">
							<ul class="plugin-action-buttons"
								data-slug="<?php echo esc_attr( $plugin->get_slug() ); ?>">
								<li>
									<?php if ( $can_update ) : ?>
										<button type="button" class="button" data-premium="<?php echo $premium; ?>"
												data-action="update" <?php disabled( $writable, false ); ?> ><?php esc_html_e( 'Update', 'arrowpress-core' ); ?></button>
									<?php elseif ( $status == 'not_installed' ) : ?>
										<button type="button" class="button" data-premium="<?php echo $premium; ?>"
												data-action="install" <?php disabled( $writable, false ); ?> ><?php esc_html_e( 'Install Now', 'arrowpress-core' ); ?></button>
									<?php elseif ( $status == 'inactive' ) : ?>
										<button type="button" class="button"
												data-action="activate"><?php esc_html_e( 'Activate', 'arrowpress-core' ); ?></button>
									<?php else : ?>
										<button type="button" class="button"
											<?php disabled( true, $disable_deactivate, true ); ?>
												data-action="deactivate"><?php esc_html_e( 'Deactivate', 'arrowpress-core' ); ?></button>
									<?php endif; ?>
								</li>
							</ul>
						</div>
						<div class="desc column-description">
							<p class="data_Description"><?php echo $plugin->get_description(); ?></p>
						</div>
					</div>
					<?php if ( $version || $plugin->is_required() ) : ?>
						<div class="plugin-card-bottom">
							<?php if ( $version ): ?>
								<div class="column-downloaded"><?php echo __( 'Version: ', 'arrowpress-core' ); ?><span
										class="data_Version"><?php echo esc_html( $version ); ?></span></div>
							<?php endif; ?>
							<?php if ( $plugin->is_required() ) : ?>
								<div class="column-updated"><span
										class="plugin-required"><?php esc_html_e( 'Required', 'arrowpress-core' ); ?></span>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	<span class="spinner"></span>
</div>
