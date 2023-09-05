<?php

/**
 * Class Arrowpress_Plugins_Manager.
 *
 * @since 0.5.0
 */
class Arrowpress_Plugins_Manager extends Arrowpress_Admin_Sub_Page {
	/**
	 * @since 1.1.0
	 *
	 * @var null
	 */
	private static $plugins = null;

	/**
	 * @since 0.8.5
	 *
	 * @var string
	 */
	public $key_page = 'plugins';

	/**
	 * @var string
	 *
	 * @since 0.4.0
	 */
	public static $page_key = 'plugins';

	/**
	 * @var null
	 *
	 * @since 0.5.0
	 */
	private static $all_plugins_require = null;

	/**
	 * Is writable.
	 *
	 * @since 0.5.0
	 *
	 * @var bool
	 */
	private static $is_writable = null;

	/**
	 * Add notice.
	 *
	 * @param string $content
	 * @param string $type
	 *
	 * @since 0.5.0
	 *
	 */
	public static function add_notification( $content = '', $type = 'success' ) {
		Arrowpress_Dashboard::add_notification(
			array(
				'content' => $content,
				'type'    => $type,
				'page'    => self::$page_key,
			)
		);
	}

	/**
	 * Get url plugin actions.
	 *
	 * @param $args
	 *
	 * @return string
	 * @since 0.8.8
	 *
	 */
	public static function get_url_plugin_actions( $args ) {
		$args = wp_parse_args(
			$args,
			array(
				'slug'          => '',
				'plugin-action' => '',
				'network'       => '',
			)
		);

		$args['action'] = 'arrowpress_plugins';

		$url = admin_url( 'admin.php' );
		$url = add_query_arg( $args, $url );

		return $url;
	}

	/**
	 * Get link delete plugin.
	 *
	 * @param $plugin_file
	 *
	 * @return string
	 * @since 1.0.3
	 *
	 */
	public static function get_url_delete_plugin( $plugin_file ) {
		$url = wp_nonce_url( 'plugins.php?action=delete-selected&checked[]=' . $plugin_file . '&plugin_status=all', 'bulk-plugins' );

		return network_admin_url( $url );
	}

	/**
	 * Arrowpress_Plugins_Manager constructor.
	 *
	 * @since 0.4.0
	 */
	protected function __construct() {
		parent::__construct();

		$this->init_hooks();
	}

	/**
	 * Get link download plugin by slug.
	 *
	 * @param $slug
	 *
	 * @return bool|string
	 * @since 1.4.1
	 *
	 */
	public static function get_link_download_plugin( $slug ) {
		$purchase_token = get_option('arrowpress_purchase_token');

		$url = 'https://updates.arrowtheme.com/wp-json/arrow-market/v1/download-plugin/';

		$url = add_query_arg(
			array(
				'plugin' => $slug,
				'site_code' => $purchase_token,
			),
			$url
		);

		return apply_filters( 'arrowpress_core_get_link_download_plugin', $url );
	}

	/**
	 * Init hooks.
	 *
	 * @since 0.4.0
	 */
	private function init_hooks() {
		add_action( 'wp_ajax_arrowpress_plugins_manager', array( $this, 'handle_ajax_plugin_request_actions' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_filter( 'arrowpress_dashboard_sub_pages', array( $this, 'add_sub_page' ) );
		add_action( 'admin_action_arrowpress_plugins', array( $this, 'handle_plugin_actions' ) );
		add_action( 'arrowpress_core_dashboard_init', array( $this, 'notification' ) );
		add_filter( 'arrowpress_core_url_download_private_plugin', array( $this, 'filter_link_download_plugin' ), 10, 2 );
		add_action( 'arrowpress_core_pre_install_plugin', array( $this, 'raise_limit_plugin_installation' ) );
		add_action( 'arrowpress_core_pre_upgrade_plugin', array( $this, 'raise_limit_plugin_installation' ) );
	}

	/**
	 * Raise limit for plugin installation (install/upgrade)
	 *
	 * @since 1.4.8
	 */
	public function raise_limit_plugin_installation() {
		arrowpress_core_set_time_limit();
		wp_raise_memory_limit( 'arrowpress_core_admin' );
	}

	/**
	 * Get link download plugin.
	 *
	 * @param             $source
	 * @param Arrowpress_Plugin $plugin
	 *
	 * @return string
	 * @since 1.4.1
	 *
	 */
	public function filter_link_download_plugin( $source, $plugin ) {
		//        if ( ! Arrowpress_Product_Registration::is_active() && ! Arrowpress_Free_Theme::is_free() ) {
		//            $envato_id = Arrowpress_Theme_Manager::get_data( 'envato_item_id', false );
		//            if ( $envato_id ) {
		//                return $source;
		//            }
		//        }

		return self::get_link_download_plugin( $plugin->get_slug() );
	}

	/**
	 * Handle plugin actions like install, activate, deactivate.
	 *
	 * @since 0.8.8
	 */
	public function handle_plugin_actions() {
		$action   = isset( $_GET['plugin-action'] ) ? $_GET['plugin-action'] : false;
		$slug     = isset( $_GET['slug'] ) ? $_GET['slug'] : false;
		$network  = ! empty( $_GET['network'] ) ? true : false;
		$is_wporg = ! empty( $_GET['wporg'] ) ? true : false;

		if ( ! $action || ! $slug ) {
			return;
		}

		$plugin = new Arrowpress_Plugin( $slug, $is_wporg );

		if ( $action == 'install' ) {
			$plugin->install();

			// Activate after install.
			$link_activate = self::get_url_plugin_actions(
				array(
					'slug'          => $slug,
					'plugin-action' => 'activate',
					'network'       => $network,
				)
			);

			arrowpress_core_redirect( $link_activate );
		}

		if ( $action == 'activate' ) {
			$plugin->activate( false, $network );
		}

		if ( $action == 'deactivate' ) {
			$plugin->deactivate();
		}

		arrowpress_core_redirect( admin_url( 'plugins.php' ) );
	}

	/**
	 * Add sub page.
	 *
	 * @param $sub_pages
	 *
	 * @return mixed
	 * @since 0.8.5
	 *
	 */
	public function add_sub_page( $sub_pages ) {
		$sub_pages['plugins'] = array(
			'title' => __( 'Plugins', 'arrowpress-core' ),
		);

		return $sub_pages;
	}

	/**
	 * Handle ajax plugin request action.
	 *
	 * @since 0.4.0
	 */
	public function handle_ajax_plugin_request_actions() {
		$slug   = $_POST['slug'] ?? false;
		$action = $_POST['plugin_action'] ?? false;

		$plugins = self::get_plugins();
		foreach ( $plugins as $plugin ) {
			if ( $plugin->get_slug() == $slug ) {
				$result = false;

				$next_action = 'activate';

				switch ( $action ) {
					case 'install':
						$result = $plugin->install();
						break;
					case 'activate':
						$result      = $plugin->activate( false );
						$next_action = 'deactivate';
						break;
					case 'deactivate':
						$result = $plugin->deactivate();
						break;
					case 'update':
						$result    = $plugin->update();
						$is_active = $plugin->is_active();
						if ( $is_active ) {
							$next_action = 'deactivate';
						}
						break;
				}

				if ( is_wp_error( $result ) ) {
					wp_send_json_error( [ 'messages' => [ $result->get_error_message() ] ] );
				} elseif ( ! $result ) {
					wp_send_json_error( [ 'messages' => [ 'Install failed!' ] ] );
				}

				wp_send_json_success(
					array(
						'messages' => $plugin->get_messages(),
						'action'   => $next_action,
						'text'     => ucfirst( $next_action ),
						'slug'     => $plugin->get_slug(),
						'version'  => $plugin->get_current_version(),
						'info'     => $plugin->get_info(),
						'status'   => $plugin->get_status(),
					)
				);
			}
		}

		wp_send_json_error();
	}

	/**
	 * Enqueue scripts.
	 *
	 * @since 0.4.0
	 *
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'arrowpress-plugins', ARROWPRESS_CORE_ADMIN_URI . '/assets/js/plugins/arrowpress-plugins.js', array( 'jquery' ), ARROWPRESS_CORE_VERSION );
		$this->localize_script();

		if ( ! $this->is_myself() ) {
			return;
		}

		$min = '.min';
		$ver = ARROWPRESS_CORE_VERSION;
		if ( Apr_Core::is_debug() ) {
			$min = '';
			$ver = uniqid();
		}
		$extend = $min . '.js';

		wp_enqueue_script( 'arrowpress-isotope', ARROWPRESS_CORE_ADMIN_URI . '/assets/js/plugins/isotope.pkgd.min.js', array( 'jquery' ), ARROWPRESS_CORE_VERSION );
		wp_enqueue_script(
			'arrowpress-plugins-manager',
			ARROWPRESS_CORE_ADMIN_URI . '/assets/js/plugins/plugins-manager' . $extend,
			array(
				'arrowpress-plugins',
				'arrowpress-isotope',
				'updates',
				'arrowpress-core-admin',
			),
			$ver
		);
	}

	/**
	 * Localize script.
	 *
	 * @since 0.4.0
	 */
	public function localize_script() {
		wp_localize_script(
			'updates',
			'_wpUpdatesItemCounts',
			array(
				'totals' => wp_get_update_data(),
			)
		);

		wp_localize_script(
			'arrowpress-plugins',
			'arrowpress_plugins_manager',
			array(
				'admin_ajax_action' => admin_url( 'admin-ajax.php' ),
			)
		);
	}

	/**
	 * Get all plugins require.
	 *
	 * @return Arrowpress_Plugin[]
	 * @since 1.1.0
	 *
	 */
	public static function get_plugins() {
		if ( self::$plugins == null ) {
			$all_plugins = self::get_all_plugins();

 			$plugins = array();
			foreach ( $all_plugins as $index => $plugin ) {
				$arrowpress_plugin = new Arrowpress_Plugin();
				$arrowpress_plugin->set_args( $plugin );

				$plugins[] = $arrowpress_plugin;
			}

			self::$plugins = $plugins;
		}

 		return self::$plugins;
	}

	/**
	 * Get all plugins.
	 *
	 * @return array
	 * @since 0.4.0
	 *
	 */
	private static function get_all_plugins() {
		if ( self::$all_plugins_require == null ) {
			$plugins = array();

			$plugins = apply_filters( 'arrowpress_core_get_all_plugins_require', $plugins );

			foreach ( $plugins as $index => $plugin ) {
				$plugin = wp_parse_args(
					$plugin,
					array(
						'required' => false,
						'add-on'   => false,
						'silent'   => false,
					)
				);

				$plugins[ $index ] = $plugin;
			}

			uasort(
				$plugins,
				function ( $first, $second ) {
					if ( $first['required'] === $second['required'] ) {
						return 0;
					}

					if ( $first['required'] ) {
						return - 1;
					}

					return 1;
				}
			);
 			self::$all_plugins_require = apply_filters( 'arrowpress_core_list_plugins_required', $plugins );
		}

 		return self::$all_plugins_require;
	}

	/**
	 * Get external plugins (outside wp.org).
	 *
	 * @return Arrowpress_Plugin[]
	 * @since 1.1.0
	 *
	 */
	public static function get_external_plugins() {
		$required_plugins = self::get_plugins();

		$plugins = array();
		foreach ( $required_plugins as $arrowpress_plugin ) {
			if ( $arrowpress_plugin->is_wporg() ) {
				continue;
			}

			$plugins[] = $arrowpress_plugin;
		}

		return $plugins;
	}

	/**
	 * Get required plugins inactive or not installed.
	 *
	 * @return Arrowpress_Plugin[]
	 * @since 0.8.7
	 *
	 */
	public static function get_required_plugins_inactive() {
		$required_plugins = self::get_plugins();

		$plugins = array();

		foreach ( $required_plugins as $arrowpress_plugin ) {
 			$install_pl = false;
 			$no_install = array(  'js_composer', 'elementor', 'bbpress', 'widget-logic', 'classic-editor' );
			if ( ($arrowpress_plugin->is_required() == false && in_array( $arrowpress_plugin->get_slug(), $no_install )) ||   $arrowpress_plugin->no_install_default() ) {
				$install_pl = true;
			}
			if ( $install_pl || $arrowpress_plugin->is_active() || $arrowpress_plugin->is_add_on() ) {
				continue;
			}

			$plugins[] = $arrowpress_plugin;
		}

		return $plugins;
	}

	/**
	 * Get all add ons.
	 *
	 * @return Arrowpress_Plugin[]
	 * @since 0.8.6
	 *
	 */
	public static function get_all_add_ons() {
		$all_plugins = self::get_plugins();

		$plugins = array();
		foreach ( $all_plugins as $plugin ) {
			if ( ! $plugin->is_add_on() ) {
				continue;
			}

			$plugins[] = $plugin;
		}

		return $plugins;
	}

	/**
	 * Get list slug plugins require all demo.
	 *
	 * @return array
	 * @since 0.5.0
	 *
	 */
	public static function get_slug_plugins_require_all() {
		$all_plugins = self::get_plugins();

		$plugins_require_all = array();
		foreach ( $all_plugins as $index => $plugin ) {
			if ( $plugin->is_required() ) {
				array_push( $plugins_require_all, $plugin->get_slug() );
			}
		}

		return $plugins_require_all;
	}

	/**
	 * Get plugin by slug.
	 *
	 * @param $slug
	 *
	 * @return false|Arrowpress_Plugin
	 * @since 0.5.0
	 *
	 */
	public static function get_plugin_by_slug( $slug ) {
		$all_plugins = self::get_plugins();

		if ( count( $all_plugins ) === 0 ) {
			return false;
		}

		foreach ( $all_plugins as $plugin ) {
			if ( $plugin->get_slug() == $slug ) {
				return $plugin;
			}
		}

		return false;
	}

	/**
	 * Check permission plugins directory.
	 *
	 * @since 0.5.0
	 */
	private static function check_permission() {
		self::$is_writable = wp_is_writable( WP_PLUGIN_DIR );
	}

	/**
	 * Get permission writable plugins directory.
	 *
	 * @since 0.8.2
	 */
	public static function get_permission() {
		if ( is_null( self::$is_writable ) ) {
			self::check_permission();
		}

		return self::$is_writable;
	}

	/**
	 * Notice waring.
	 *
	 * @since 0.5.0
	 * @since 1.3.1
	 */
	public function notification() {
		if ( ! self::get_permission() ) {
			Arrowpress_Dashboard::add_notification(
				array(
					'content' => '<strong>Important!</strong> Please check permission directory <code>' . WP_PLUGIN_DIR . '</code>. Please follow <a href="https://goo.gl/guirO5" target="_blank">the guide</a>.',
					'type'    => 'error',
				)
			);
		}
	}
}
