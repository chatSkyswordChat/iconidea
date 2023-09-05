<?php

/**
 * ArrowPress Core Plugin.
 * Plugin Name:       ArrowPress Core
 * Plugin URI:        https://arrowtheme.github.io/arrowpress-core/
 * Description:       The Ultimate Core Processor of all WordPress themes by ArrowTheme - Manage your website easier with ArrowPress Core.
 * Version:           2.0.4
 * Author:            ArrowTheme
 * Author URI:        https://arrowtheme.com
 * Text Domain:       arrowpress-core
 * Domain Path:       /languages
 * Tested up to: 6.0
 * Requires PHP: 7.0
 * @package   ArrowPress_Core
 * @since     0.1.0
 * @author    ArrowTheme <contact@arrowtheme.com>
 * @link      https://arrowtheme.com
 * @copyright 2016 ArrowTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Class Apr_Core
 *
 * @since 0.1.0
 */
if ( ! class_exists( 'Apr_Core' ) ) {
	class Apr_Core {
		/**
		 * @var null
		 *
		 * @since 0.1.0
		 */
		protected static $_instance = null;

		/**
		 * @var string
		 *
		 * @since 0.1.0
		 */
		public static $prefix = 'arrowpress_';

		/**
		 * @var string
		 *
		 * @since 0.8.5
		 */
		public static $slug = 'arrowpress-core';

		/**
		 * @var string
		 *
		 * @since 0.2.0
		 */
		private static $option_version = 'arrowpress_core_version';

		/**
		 * Return unique instance of Apr_Core.
		 *
		 * @since 0.1.0
		 */
		static function instance() {
			if ( ! self::$_instance ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		/**
		 * Arrowpress_Framework constructor.
		 *
		 * @since 0.1.0
		 */
		private function __construct() {
			$this->init();
			$this->hooks();

			do_action( 'arrowpress_core_loaded' );
		}

		/**
		 * Get is debug?
		 *
		 * @return bool
		 * @since 0.1.0
		 */
		public static function is_debug() {
			if ( ! defined( 'ARROWPRESS_DEBUG' ) ) {
				return false;
			}

			return (bool) ARROWPRESS_DEBUG;
		}

		/**
		 * Init class.
		 *
		 * @since 0.1.0
		 */
		public function init() {
			do_action( 'before_arrowpress_core_init' );

			add_action( 'admin_notices', array( $this, 'show_note_should_update_theme' ), 0 );

			$this->define_constants();
			$this->providers();

			spl_autoload_register( array( $this, 'autoload' ) );

			$this->inc();
			$this->admin();

			do_action( 'arrowpress_core_init' );
		}

		/**
		 * Define constants.
		 *
		 * @since 0.2.0
		 */
		private function define_constants() {
			$this->define( 'ARROWPRESS_CORE_FILE', __FILE__ );
			$this->define( 'ARROWPRESS_CORE_PATH', dirname( __FILE__ ) );

			$this->define( 'ARROWPRESS_CORE_URI', untrailingslashit( plugins_url( '/', ARROWPRESS_CORE_FILE ) ) );
			$this->define( 'ARROWPRESS_CORE_ASSETS_URI', ARROWPRESS_CORE_URI . '/assets' );

			include_once ABSPATH . 'wp-admin/includes/plugin.php';
			$arrowpress_core_info = get_plugin_data( ARROWPRESS_CORE_FILE );
			$this->define( 'ARROWPRESS_CORE_VERSION', $arrowpress_core_info['Version'] );

			$this->define( 'ARROWPRESS_CORE_ADMIN_PATH', ARROWPRESS_CORE_PATH . '/admin' );
			$this->define( 'ARROWPRESS_CORE_ADMIN_URI', ARROWPRESS_CORE_URI . '/admin' );
			$this->define( 'ARROWPRESS_CORE_INC_PATH', ARROWPRESS_CORE_PATH . '/inc' );
			$this->define( 'ARROWPRESS_CORE_INC_URI', ARROWPRESS_CORE_URI . '/inc' );

			$this->define( 'TP_THEME_ARROWPRESS_DIR', trailingslashit( get_template_directory() ) );
			$this->define( 'TP_THEME_ARROWPRESS_URI', trailingslashit( get_template_directory_uri() ) );
			$this->define( 'TP_CHILD_THEME_ARROWPRESS_DIR', trailingslashit( get_stylesheet_directory() ) );
			$this->define( 'TP_CHILD_THEME_ARROWPRESS_URI', trailingslashit( get_stylesheet_directory_uri() ) );
		}

		/**
		 * Define constant.
		 *
		 * @param $name
		 * @param $value
		 *
		 * @since 1.0.0
		 *
		 */
		private function define( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

		/**
		 * Init hooks.
		 *
		 * @since 0.1.0
		 */
		private function hooks() {
			register_activation_hook( __FILE__, array( $this, 'install' ) );
			add_action( 'activated_plugin', array( $this, 'activated' ) );
			add_action( 'plugins_loaded', array( $this, 'text_domain' ), 1 );
		}

		/**
		 * Autoload classes.
		 *
		 * @param $class
		 *
		 * @return bool
		 * @since 1.0.0
		 *
		 */
		public function autoload( $class ) {
			$class = strtolower( $class );

			$file_name = 'class-' . str_replace( '_', '-', $class ) . '.php';

			/**
			 * Helper classes.
			 */
			if ( strpos( $class, 'helper' ) !== false ) {
				$path = ARROWPRESS_CORE_PATH . '/helpers/' . $file_name;

				return $this->_require( $path );
			}

			/**
			 * Inc
			 */
			$path = ARROWPRESS_CORE_INC_PATH . DIRECTORY_SEPARATOR . $file_name;
			if ( is_readable( $path ) ) {
				return $this->_require( $path );
			}

			/**
			 * Admin
			 */
			$path = ARROWPRESS_CORE_ADMIN_PATH . DIRECTORY_SEPARATOR . $file_name;
			if ( is_readable( $path ) ) {
				return $this->_require( $path );
			}

			return false;
		}

		/**
		 * Require file.
		 *
		 * @param $path
		 *
		 * @return bool
		 * @since 1.0.5
		 *
		 */
		private function _require( $path ) {
			if ( ! is_readable( $path ) ) {
				return false;
			}

			require_once $path;

			return true;
		}

		/**
		 * Providers.
		 *
		 * @since 0.8.5
		 */
		private function providers() {
			require_once ARROWPRESS_CORE_PATH . '/providers/class-singleton.php';
		}

		/**
		 * Core.
		 *
		 * @since 0.1.0
		 */
		private function inc() {
			require_once ARROWPRESS_CORE_INC_PATH . '/class-core.php';
		}

		/**
		 * Admin.
		 *
		 * @since 0.1.0
		 */
		private function admin() {
			require_once ARROWPRESS_CORE_PATH . '/admin/class-core-admin.php';
		}

		/**
		 * Activation hook.
		 *
		 * @since 0.2.0
		 */
		public function install() {
			add_option( self::$option_version, ARROWPRESS_CORE_VERSION );

			do_action( 'arrowpress_core_activation' );
		}

		/**
		 * Hook after plugin was activated.
		 *
		 * @param $plugin
		 *
		 * @since 0.2.0
		 *
		 */
		public function activated( $plugin ) {
			$plugins_are_activating = isset( $_POST['checked'] ) ? $_POST['checked'] : array();

			if ( count( $plugins_are_activating ) > 1 ) {
				return;
			}

			if ( 'arrowpress-core/arrowpress-core.php' !== $plugin ) {
				return;
			}

			ArrowPress_Core_Admin::go_to_theme_dashboard();
		}

		/**
		 * Get active network.
		 *
		 * @return bool
		 * @since 0.8.1
		 *
		 */
		public static function is_active_network() {
			if ( ! is_multisite() ) {
				return true;
			}

			$plugin_file            = 'arrowpress-core/arrowpress-core.php';
			$active_plugins_network = get_site_option( 'active_sitewide_plugins' );

			if ( isset( $active_plugins_network[$plugin_file] ) ) {
				return true;
			}

			return false;
		}

		public function show_note_should_update_theme() {

			if ( $this->theme_version_compare( 'Lusion', '1.9.9', '<' ) || $this->theme_version_compare( 'Barber', '1.9.9', '<' ) ) {
				?>
				<div class="notice notice-error">
					<p><?php echo( 'Please update the theme to latest version compatible with ArrowCore' ); ?></p>
				</div>
				<?php
			}
		}

		/**
		 * Load text domain.
		 *
		 * @since 0.1.0
		 *
		 */
		function text_domain() {
			$locale = apply_filters( 'plugin_locale', get_locale(), 'arrowpress-core' );

			load_textdomain(
				'arrowpress-core',
				trailingslashit( WP_LANG_DIR ) . 'arrowpress-core' . '/' . 'arrowpress-core' . '-' . $locale . '.mo'
			);
			load_plugin_textdomain(
				'arrowpress-core', false,
				basename( plugin_dir_path( dirname( __FILE__ ) ) ) . '/languages/'
			);
		}

		public static function theme_version_compare( $theme_name, $version2, $operator ) {
			$theme_data = wp_get_theme();
			// child theme
			if ($theme_data->parent()) {
 				$theme_data = $theme_data->parent();
 			}

			if ( ('AHT' === $theme_data->get( 'Author' ) || 'ArrowTheme' === $theme_data->get( 'Author' )) &&
				$theme_name ===
				$theme_data->get( 'Name' ) &&
				version_compare( $theme_data->get( 'Version' ), $version2, $operator ) ) {
				return true;
			}
		}
	}

	Apr_Core::instance();
}// End if().
