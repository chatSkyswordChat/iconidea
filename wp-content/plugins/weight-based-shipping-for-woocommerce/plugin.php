<?php
/**
 * Plugin Family Id: dangoodman/wc-weight-based-shipping
 * Plugin Name: WooCommerce Weight Based Shipping
 * Plugin URI: https://wordpress.org/plugins/weight-based-shipping-for-woocommerce/
 * Description: Simple yet flexible shipping method for WooCommerce.
 * Version: 5.5.5
 * Author: weightbasedshipping.com
 * Author URI: https://weightbasedshipping.com
 * Requires PHP: 7.1
 * Requires at least: 4.6
 * Tested up to: 6.2
 * WC requires at least: 3.2
 * WC tested up to: 7.9
 */

if (!class_exists('WbsVendors_DgmWpPluginBootstrapGuard', false)) {
    require_once(__DIR__.'/server/vendor/dangoodman/wp-plugin-bootstrap-guard/DgmWpPluginBootstrapGuard.php');
}

WbsVendors_DgmWpPluginBootstrapGuard::checkPrerequisitesAndBootstrap(
    'WooCommerce Weight Based Shipping',
    '7.1', '4.6', '3.2',
    __DIR__.'/bootstrap.php'
);