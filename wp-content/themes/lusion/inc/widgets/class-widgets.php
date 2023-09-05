<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'Apr_Core_Widgets' ) ) {
	class Apr_Core_Widgets {
		public function __construct() {
			$this->require_widgets();
			add_action( 'widgets_init', array(
				$this,
				'register_widgets',
			) );
		}
		public function require_widgets() {
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			require_once 'posts.php';
			require_once 'contact.php';
			require_once 'logo.php';
			require_once 'social.php';
			require_once 'brands.php';
			require_once 'elementor-template.php';
			if (is_plugin_active('yith-woocommerce-brands-add-on/init.php') && class_exists('WooCommerce')) {
				require_once 'brands.php';
			}
			if (is_plugin_active('yith-woocommerce-compare/init.php') && class_exists('WooCommerce')) {
				require_once 'compare.php';
			}
			require_once 'category-product.php';
//			require_once 'active-theme.php';
		}
		public function register_widgets() {
			include_once( ABSPATH . 'wp-admin/includes/plugin.php');
			register_widget( 'Apr_Core_Posts_Widget' );
			register_widget( 'Apr_Core_Contact_Widget' );
			register_widget( 'Apr_Core_Logo_Widget' );
			register_widget( 'Apr_Core_Social_Widget' );
			register_widget( 'Apr_Core_Elementor_Template_Widget' );
			if (is_plugin_active('yith-woocommerce-brands-add-on/init.php') && class_exists('WooCommerce')) {
				register_widget( 'Apr_Core_Brand_Widget' );
			}
			if (is_plugin_active('yith-woocommerce-compare/init.php') && class_exists('WooCommerce')) {
				register_widget( 'Apr_Core_Compare' );
			}
			register_widget( 'Apr_Core_Category_Product_Widget' );
		}
	}
	new Apr_Core_Widgets();
}
