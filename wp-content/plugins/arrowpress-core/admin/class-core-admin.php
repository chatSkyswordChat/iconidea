<?php

/**
 * Class ArrowPress_Core_Admin.
 *
 * @package   ArrowPress_Core
 * @since     0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'ArrowPress_Core_Admin' ) ) {
	class ArrowPress_Core_Admin extends Arrowpress_Singleton {
		/**
		 * Go to theme dashboard.
		 *
		 * @since 0.8.1
		 */
		public static function go_to_theme_dashboard() {
			$link_page = admin_url( '?arrowpress-core-redirect-to-dashboard' );

			arrowpress_core_redirect( $link_page );
		}

		/**
		 * Detect my theme.
		 *
		 * @return bool
		 * @since 0.8.0
		 *
		 */
		public static function is_my_theme() {
			return (bool) get_theme_support( 'arrowpress-core' );
		}

		/**
		 * ArrowPress_Core_Admin constructor.
		 *
		 * @since 0.1.0
		 */
		protected function __construct() {
			spl_autoload_register( array( $this, 'autoload' ) );

			if ( ! self::is_my_theme() ) {
				return;
			}

			$this->init();
			$this->init_hooks();
		}

		/**
		 * Fake page to redirect to dashboard.
		 *
		 * @since 0.8.1
		 */
		public function redirect_to_dashboard() {
			$request = isset( $_REQUEST['arrowpress-core-redirect-to-dashboard'] );

			if ( ! $request ) {
				return;
			}

			$this->redirect_user();
		}

		/**
		 * Handle redirect the user.
		 *
		 * @since 0.8.5
		 */
		private function redirect_user() {
			$url = Arrowpress_Dashboard::get_link_main_dashboard();

			if ( Arrowpress_Dashboard::check_first_install() ) {
				Arrowpress_Admin_Settings::set( 'first_install', false );

				$url = Arrowpress_Dashboard::get_link_page_by_slug( 'getting-started' );
			}

			arrowpress_core_redirect( $url );
		}

		/**
		 * Init.
		 *
		 * @since 0.1.0
		 */
		private function init() {
			$this->run();
		}

		/**
		 * Autoload classes.
		 *
		 * @param $class
		 *
		 * @since 0.3.0
		 *
		 */
		public function autoload( $class ) {
			$class = strtolower( $class );

			$file_name = 'class-' . str_replace( '_', '-', $class ) . '.php';

			if ( strpos( $class, 'service' ) !== false ) {
				$file_name = 'services/' . $file_name;
			}

			$file = ARROWPRESS_CORE_ADMIN_PATH . DIRECTORY_SEPARATOR . $file_name;
			if ( is_readable( $file ) ) {
				require_once $file;
			}
		}

		/**
		 * Notice permission uploads.
		 *
		 * @since 0.8.9
		 */
		public function notice_permission_uploads() {
			$dir = WP_CONTENT_DIR;

			$writable = wp_is_writable( $dir );
			if ( $writable ) {
				return;
			}

			Arrowpress_Notification::add_notification(
				array(
					'id'          => 'permission_uploads',
					'type'        => 'error',
					'content'     => __(
						"<h3>Important!</h3>Your server doesn't not have a permission to write in <strong>WP Uploads</strong> folder ($dir).
									The theme may not work properly with the issue. Please check this <a href='https://goo.gl/guirO5' target='_blank'>guide</a> to fix it.", 'arrowpress-core'
					),
					'dismissible' => false,
					'global'      => true,
				)
			);
		}

		/**
		 * Run admin core.
		 *
		 * @since 0.3.0
		 */
		private function run() {
			Arrowpress_Admin_Config::instance();

			Arrowpress_Modal::instance();
			Arrowpress_Metabox::instance();
//			Arrowpress_Post_Formats::instance();
//  		Arrowpress_Singular_Settings::instance();
 			Arrowpress_Dashboard::instance();
			Arrowpress_Importer_Mapping::instance();
			Arrowpress_Self_Update::instance();
			Arrowpress_Welcome_Panel::instance();
//			Arrowpress_Exporter::instance();
			Arrowpress_Developer_Access::instance();
 			Arrowpress_Pointers::instance();
			Arrowpress_Free_Theme::instance();
			Arrowpress_Envato_Hosted::instance();
		}

		/**
		 * Init hooks.
		 *
		 * @since 0.1.0
		 */
		private function init_hooks() {
			add_action( 'admin_init', array( $this, 'redirect_to_dashboard' ) );
			add_action( 'admin_menu', array( $this, 'remove_unnecessary_menus' ), 999 );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ), 5 );
			add_filter( 'plugin_action_links_arrowpress-core/arrowpress-core.php', array( $this, 'add_action_links' ) );
			add_action( 'admin_head', array( $this, 'admin_styles' ) );
			add_filter( 'arrowpress_core_installer_hidden_menu', array( $this, 'hidden_menu_installer' ) );
			add_action( 'arrowpress_core_dashboard_init', array( $this, 'notice_permission_uploads' ) );
			add_filter( 'arrowpress_core_admin_memory_limit', array( $this, 'memory_limit' ) );

			add_action( 'arrowpress_core_installer_complete', array( 'ArrowPress_Core_Admin', 'go_to_theme_dashboard' ) );
		}

		/**
		 * Raise memory limit.
		 *
		 * @param $current
		 *
		 * @return string
		 * @since 1.4.8.1
		 *
		 */
		public function memory_limit( $current ) {
			$current_limit_int = wp_convert_hr_to_bytes( $current );

			if ( $current_limit_int > 268435456 ) {
				return $current;
			}

			return '256M';
		}


		/**
		 * Hidden menu installer.
		 *
		 * @return bool
		 * @since 1.0.0
		 *
		 */
		public function hidden_menu_installer() {
			return true;
		}

		/**
		 * Add custom style inline in admin.
		 *
		 * @since 0.9.1
		 */
		public function admin_styles() {
			global $_wp_admin_css_colors;

			$colors = array(
				'#222',
				'#333',
				'#0073aa',
				'#00a0d2',
			);

			$pack = get_user_meta( get_current_user_id(), 'admin_color', true );
			if ( is_array( $_wp_admin_css_colors ) ) {
				foreach ( $_wp_admin_css_colors as $key => $package ) {
					if ( $pack == $key ) {
						$package = (array) $package;
						$colors  = $package['colors'];
					}
				}
			}

			Arrowpress_Template_Helper::template( 'admin-styles.php', array( 'colors' => $colors, 'key' => $pack ), true );
		}

		/**
		 * Remove unnecessary menus.
		 *
		 * @since 0.8.8
		 */
		public function remove_unnecessary_menus() {
			global $submenu;
			unset( $submenu['themes.php'][15] );
			unset( $submenu['themes.php'][20] );
		}

		/**
		 * Add action links.
		 *
		 * @param $links
		 *
		 * @return string[]
		 * @since 0.8.0
		 *
		 */
		public function add_action_links( $links ) {
			$links[] = '<a href="https://arrowhitech.ticksy.com/public-tickets/" target="_blank">' . __( 'Support', 'arrowpress-core' ) . '</a>';

			return $links;
		}

		/**
		 * Enqueue scripts.
		 *
		 * @since 0.2.1
		 */
		public function enqueue_scripts() {
			$min = '.min';
			$ver = ARROWPRESS_CORE_VERSION;
			if ( Apr_Core::is_debug() ) {
				$min = '';
				$ver = uniqid();
			}
			$extend = $min . '.js';

			wp_register_script( 'arrowpress-core-admin', ARROWPRESS_CORE_ADMIN_URI . '/assets/js/core' . $extend, array( 'jquery' ), $ver );
			wp_register_script( 'arrowpress-core-clipboard', ARROWPRESS_CORE_ADMIN_URI . '/assets/js/clipboard.min.js', array(), '1.6.0' );

			wp_register_script( 'youtube-api', 'https://www.youtube.com/iframe_api', array() );
			wp_register_script(
				'arrowpress-video-youtube',
				ARROWPRESS_CORE_ADMIN_URI . '/assets/js/youtube.js',
				array(
					'jquery',
					'youtube-api',
				),
				ARROWPRESS_CORE_VERSION
			);

			wp_enqueue_style( 'arrowpress-admin', ARROWPRESS_CORE_ADMIN_URI . '/assets/css/admin.css', array(), ARROWPRESS_CORE_VERSION );

			$this->localize_script();
		}

		/**
		 * Localize script.
		 *
		 * @since 1.3.4
		 */
		private function localize_script() {
			$theme_metadata = Arrowpress_Theme_Manager::get_metadata();

			wp_localize_script( 'arrowpress-core-admin', 'arrowpress_core_settings', array(
				'active'  => Arrowpress_Product_Registration::is_active() ? 'yes' : 'no',
				'is_free' => Arrowpress_Free_Theme::is_free() ? 'yes' : 'no',
				'theme'   => $theme_metadata
			) );
		}
	}

	/**
	 * ArrowPress Core Admin init.
	 *
	 * @since 0.8.1
	 */
	function arrowpress_core_admin_init() {
		ArrowPress_Core_Admin::instance();
	}

	add_action( 'after_setup_theme', 'arrowpress_core_admin_init', 99999 );
}

/**
 * Include functions.
 *
 * @since 0.1.0
 */
include_once ARROWPRESS_CORE_ADMIN_PATH . '/functions.php';
