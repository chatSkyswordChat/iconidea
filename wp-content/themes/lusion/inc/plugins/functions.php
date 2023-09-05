<?php

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once LUSION_FRAMEWORK_DIR . '/plugins/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'lusion_theme_register_required_plugins');

function lusion_theme_register_required_plugins() {
 	$remote_url = 'https://demo.arrowtheme.com/plugins';
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		array(
			'name' => esc_html__('Elementor','lusion'),
			'slug' => 'elementor',
			'required' => true
		),
		array(
			'name' => esc_html__('Classic Widgets','lusion'),
			'slug' => 'classic-widgets',
			'required' => true
		),
//		array(
//			'name' => esc_html__('Kirki Toolkit','lusion'),
//			'slug' => 'kirki',
//			'required' => true
//		),
		array(
			'name' => esc_html__('Revolution Slider ','lusion'),
			'slug' => 'revslider',
			'source' => $remote_url . '/revslider.zip',
			'required' => true
		),
		array(
			'name' => esc_html__('ArrowPress Core','lusion'),
			'slug' => 'arrowpress-core',
			'source' => 'https://arrowtheme.github.io/arrowpress-core/arrowpress-core.zip',
  			'version' => '2.0.0',
			'required' => true
		),
//		array(
//			'name' => esc_html__('ArrowPress Importer','lusion'),
//			'slug' => 'arrowpress-importer',
//			'source' => $remote_url . '/lusion/arrowpress-importer.zip',
//			'version' => '1.0',
//			'required' => true
//		),
		array(
			'name' => esc_html__('Woocommerce','lusion'),
			'slug' => 'woocommerce',
			'required' => false
		),
		array(
			'name' => esc_html__('WOOCS - WooCommerce Currency Switcher','lusion'),
			'slug' => 'woocommerce-currency-switcher',
			'required' => false
		),
		array(
			'name' => esc_html__('WooSwatches - Woocommerce Color or Image Variation Swatches','lusion'),
			'slug' => 'woocommerce-colororimage-variation-select',
			'source' => $remote_url . '/lusion/woocommerce-colororimage-variation-select.zip',
			'required' => false
		),
		array(
			'name' => esc_html__('Advanced AJAX Product Filters for WooCommerce','lusion'),
			'slug' => 'woocommerce-ajax-filters',
			'required' => false
		),
		array(
			'name' => esc_html__('YITH WooCommerce Compare','lusion'),
			'slug' => 'yith-woocommerce-compare',
			'required' => false
		),
		array(
			'name' => esc_html__('YITH WooCommerce Quick View','lusion'),
			'slug' => 'yith-woocommerce-quick-view',
			'required' => false
		),
		array(
			'name' => esc_html__('YITH WooCommerce Wishlist','lusion'),
			'slug' => 'yith-woocommerce-wishlist',
			'required' => false
		),
		array(
			'name' => esc_html__('Yith Woocommerce Brands Add-on','lusion'),
			'slug' => 'yith-woocommerce-brands-add-on',
			'required' => false
		),
		array(
			'name' => esc_html__('MailChimp for WordPress','lusion'),
			'slug' => 'mailchimp-for-wp',
			'required' => false
		),
		array(
			'name' => esc_html__('Contact Form 7','lusion'),
			'slug' => 'contact-form-7',
			'required' => false
		),
	);

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
		'id' => 'lusion', // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '', // Default absolute path to bundled plugins.
		'menu' => 'install-required-plugins', // Menu slug.
		'parent_slug' => 'themes.php', // Parent menu slug.
		'capability' => 'edit_theme_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices' => true, // Show admin notices or not.
		'dismissable' => true, // If false, a user cannot dismiss the nag message.
		'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false, // Automatically activate plugins after installation or not.
		'message' => '', // Message to output right before the plugins table.
		'strings' => array(
			'page_title' => esc_html__('Install Required Plugins', 'lusion'),
			'menu_title' => esc_html__('Install Plugins', 'lusion'),
			'installing' => esc_html__('Installing Plugin: %s', 'lusion'), // %s = plugin name.
			'oops' => esc_html__('Something went wrong with the plugin API.', 'lusion'),
			'notice_can_install_required' => _n_noop(
				'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'lusion'
			), // %1$s = plugin name(s).
			'notice_can_install_recommended' => _n_noop(
				'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'lusion'
			), // %1$s = plugin name(s).
			'notice_cannot_install' => _n_noop(
				'Sorry, but you do not have the correct permissions to install the %1$s plugin.', 'Sorry, but you do not have the correct permissions to install the %1$s plugins.', 'lusion'
			), // %1$s = plugin name(s).
			'notice_ask_to_update' => _n_noop(
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'lusion'
			), // %1$s = plugin name(s).
			'notice_ask_to_update_maybe' => _n_noop(
				'There is an update available for: %1$s.', 'There are updates available for the following plugins: %1$s.', 'lusion'
			), // %1$s = plugin name(s).
			'notice_cannot_update' => _n_noop(
				'Sorry, but you do not have the correct permissions to update the %1$s plugin.', 'Sorry, but you do not have the correct permissions to update the %1$s plugins.', 'lusion'
			), // %1$s = plugin name(s).
			'notice_can_activate_required' => _n_noop(
				'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'lusion'
			), // %1$s = plugin name(s).
			'notice_can_activate_recommended' => _n_noop(
				'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'lusion'
			), // %1$s = plugin name(s).
			'notice_cannot_activate' => _n_noop(
				'Sorry, but you do not have the correct permissions to activate the %1$s plugin.', 'Sorry, but you do not have the correct permissions to activate the %1$s plugins.', 'lusion'
			), // %1$s = plugin name(s).
			'install_link' => _n_noop(
				'Begin installing plugin', 'Begin installing plugins', 'lusion'
			),
			'update_link' => _n_noop(
				'Begin updating plugin', 'Begin updating plugins', 'lusion'
			),
			'activate_link' => _n_noop(
				'Begin activating plugin', 'Begin activating plugins', 'lusion'
			),
			'return' => esc_html__('Return to Required Plugins Installer', 'lusion'),
			'plugin_activated' => esc_html__('Plugin activated successfully.', 'lusion'),
			'activated_successfully' => esc_html__('The following plugin was activated successfully:', 'lusion'),
			'plugin_already_active' => esc_html__('No action taken. Plugin %1$s was already active.', 'lusion'), // %1$s = plugin name(s).
			'plugin_needs_higher_version' => esc_html__('Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'lusion'), // %1$s = plugin name(s).
			'complete' => esc_html__('All plugins installed and activated successfully. %1$s', 'lusion'), // %s = dashboard link.
			'contact_admin' => esc_html__('Please contact the administrator of this site for help.', 'lusion'),
			'nag_type' => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		),
	);

    tgmpa($plugins, $config);
}

