<?php
/**
 * Class ArrowPress_Core
 *
 * @package   ArrowPress_Core
 * @since     0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Class ArrowPress Core.
 *
 * @since 0.1.0
 */
if ( ! class_exists( 'ArrowPress_Core' ) ) {
	class ArrowPress_Core extends Arrowpress_Singleton {
		/**
		 * ArrowPress_Core constructor.
		 *
		 * @since 0.1.0
		 */
		protected function __construct() {
			$this->init_global_variables();
			$this->init();
			$this->run();
		}

		/**
		 * Init global variables.
		 *
		 * @since 0.8.8
		 */
		private function init_global_variables() {
			/**
			 * List notifications in dashboard.
			 */
			global $arrowpress_notifications;
			$arrowpress_notifications = array();
		}

		/**
		 * Init functions.
		 *
		 * @since 0.1.0
		 */
		private function init() {
			$this->includes();
		}

		/**
		 * Run.
		 *
		 * @since 0.5.0
		 */
		private function run() {
			Arrowpress_Notification::instance();
			ArrowPress_Core_Customizer::instance();
		}

		/**
		 * Include functions.
		 *
		 * @since 0.1.0
		 */
		private function functions() {
			$this->_require( 'functions.php' );
			$this->_require( 'down_image_size.php' );
		}

		/**
		 * Include libraries and functions.
		 *
		 * @since 0.1.0
		 */
		private function includes() {
			$this->libraries();
			$this->functions();
		}

		/**
		 * Include libraries.
		 *
		 * @since 0.1.0
		 */
		private function libraries() {
			add_action( 'elementor/loaded', function () {
				$this->_require( 'library/singleton-trait.php' );
				$this->_require( 'class-rest-api.php' );
				$this->_require( 'library/class-init.php' );
			}, 1000 );

			// $this->_require( 'class-register-shortcode.php' );
			$this->_require( 'class-breadcrumb.php' );
		}

		/**
		 * Require file.
		 *
		 * @param $file
		 *
		 * @since 0.5.0
		 *
		 */
		private function _require( $file ) {
			$path = ARROWPRESS_CORE_INC_PATH . DIRECTORY_SEPARATOR . $file;
			if ( ! file_exists( $path ) ) {
				return;
			}

			require_once $path;
		}
	}
}

ArrowPress_Core::instance();
