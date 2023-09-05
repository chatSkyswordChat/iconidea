<?php
function arrow_get_all_plugins_require( $plugins ) {
	//	$remote_url = 'https://demo.arrowtheme.com/plugins';
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		array(
			'name'     => esc_html__( 'Elementor', 'lusion' ),
			'slug'     => 'elementor',
			'required' => true
		),
		array(
			'name'     => esc_html__( 'Classic Widgets', 'lusion' ),
			'slug'     => 'classic-widgets',
			'required' => false,
			'icon'     => 'https://s.w.org/plugins/geopattern-icon/classic-widgets.svg'
		),

		array(
			'name'     => esc_html__( 'Revolution Slider ', 'lusion' ),
			'slug'     => 'revslider',
			//			'source'   => $remote_url . '/revslider.zip',
			'required' => true,
			'icon'     => 'https://arrowtheme.github.io/arrowpress-core/icon-plugins/revslider.png',
			'premium'  => true,
		),

		array(
			'name'     => esc_html__( 'Woocommerce', 'lusion' ),
			'slug'     => 'woocommerce',
			'required' => true
		),
		array(
			'name'     => esc_html__( 'WOOCS - WooCommerce Currency Switcher', 'lusion' ),
			'slug'     => 'woocommerce-currency-switcher',
			'required' => false
		),

		array(
			'name'     => esc_html__( 'WooSwatches - Woocommerce Color or Image Variation Swatches', 'lusion' ),
			'slug'     => 'woocommerce-colororimage-variation-select',
			//			'source'   => $remote_url . '/lusion/woocommerce-colororimage-variation-select.zip',
			'required' => false,
			'premium'  => true,
		),
		array(
			'name'     => esc_html__( 'Advanced AJAX Product Filters for WooCommerce', 'lusion' ),
			'slug'     => 'woocommerce-ajax-filters',
			'required' => false,
			'icon'     => 'https://ps.w.org/woocommerce-ajax-filters/assets/icon-256x256.gif'
		),
		array(
			'name'     => esc_html__( 'YITH WooCommerce Compare', 'lusion' ),
			'slug'     => 'yith-woocommerce-compare',
			'required' => false,
			'icon'     => 'https://ps.w.org/yith-woocommerce-compare/assets/icon-128x128.jpg'
		),
		array(
			'name'     => esc_html__( 'YITH WooCommerce Quick View', 'lusion' ),
			'slug'     => 'yith-woocommerce-quick-view',
			'required' => false,
			'icon'     => 'https://ps.w.org/yith-woocommerce-quick-view/assets/icon-128x128.jpg'
		),
		array(
			'name'     => esc_html__( 'YITH WooCommerce Wishlist', 'lusion' ),
			'slug'     => 'yith-woocommerce-wishlist',
			'required' => false,
			'icon'     => 'https://ps.w.org/yith-woocommerce-wishlist/assets/icon-128x128.jpg'
		),
		array(
			'name'     => esc_html__( 'Yith Woocommerce Brands Add-on', 'lusion' ),
			'slug'     => 'yith-woocommerce-brands-add-on',
			'required' => false,
			'icon'     => 'https://ps.w.org/yith-woocommerce-brands-add-on/assets/icon-128x128.jpg'

		),
		array(
			'name'     => esc_html__( 'MailChimp for WordPress', 'lusion' ),
			'slug'     => 'mailchimp-for-wp',
			'required' => false
		),
		array(
			'name'     => esc_html__( 'Contact Form 7', 'lusion' ), 
			'slug'     => 'contact-form-7',
			'required' => false
		),
		array(
			'name'     => esc_html__( 'Regenerate Thumbnails', 'lusion' ), 
			'slug'     => 'regenerate-thumbnails',
			'required' => false
		),

	);

	return $plugins;
}

add_filter( 'arrowpress_core_get_all_plugins_require', 'arrow_get_all_plugins_require' );

//Add info for Dashboard Admin
if ( ! function_exists( 'arrowpress_lusion_links_guide_user' ) ) {
	function arrowpress_lusion_links_guide_user() {
		return array(
			'docs'      => 'https://guid.arrowtheme.com/lusion/',
			'support'   => 'https://arrowhitech.ticksy.com/',
			'knowledge' => 'https://arrowhitech.ticksy.com/articles/',
		);
	}
}
add_filter( 'arrowpress_theme_links_guide_user', 'arrowpress_lusion_links_guide_user' );

/**
 * Link purchase theme.
 */
if ( ! function_exists( 'arrowpress_lusion_link_purchase' ) ) {
	function arrowpress_lusion_link_purchase() {
		return 'https://1.envato.market/9Wv0By';
	}
}
add_filter( 'arrowpress_envato_link_purchase', 'arrowpress_lusion_link_purchase' );

/**
 * Envato id.
 */
if ( ! function_exists( 'arrowpress_lusion_envato_item_id' ) ) {
	function arrowpress_lusion_envato_item_id() {
		return '27657550';
	}
}

add_filter( 'arrowpress_envato_item_id', 'arrowpress_lusion_envato_item_id' );

add_filter( 'arrowpress_prefix_folder_download_data_demo', function () {
	return 'lusion';
} );

add_filter( 'arrowpress_importer_basic_settings', 'arrowpress_import_add_basic_settings' );
add_filter( 'arrowpress_importer_page_id_settings', 'arrowpress_import_add_page_id_settings' );
function arrowpress_import_add_basic_settings( $settings ) {
	$settings[] = 'elementor_css_print_method';
	$settings[] = 'elementor_experiment-e_font_icon_svg';
	$settings[] = 'elementor_cpt_support';
	$settings[] = 'elementor_scheme_color';
	$settings[] = 'elementor_scheme_typography';
	$settings[] = 'elementor_scheme_color-picker';
	$settings[] = 'elementor_google_font';
	$settings[] = 'permalink_structure';
	$settings[] = '_transient_wc_attribute_taxonomies';
	return $settings;
}

function arrowpress_import_add_page_id_settings( $settings ) {
	$settings[] = 'elementor_active_kit';

	return $settings;
}

add_action('arrowpress_core_importer_start_step','arrowpress_import_wc_attribute_taxonomies_product',1);
function arrowpress_import_wc_attribute_taxonomies_product(){
	$vc_att_taxonomies = 'a:3:{i:0;O:8:"stdClass":6:{s:12:"attribute_id";s:1:"2";s:14:"attribute_name";s:5:"color";s:15:"attribute_label";s:5:"color";s:14:"attribute_type";s:6:"select";s:17:"attribute_orderby";s:10:"menu_order";s:16:"attribute_public";s:1:"0";}i:1;O:8:"stdClass":6:{s:12:"attribute_id";s:1:"1";s:14:"attribute_name";s:4:"size";s:15:"attribute_label";s:4:"size";s:14:"attribute_type";s:6:"select";s:17:"attribute_orderby";s:10:"menu_order";s:16:"attribute_public";s:1:"0";}i:2;O:8:"stdClass":6:{s:12:"attribute_id";s:1:"3";s:14:"attribute_name";s:5:"size3";s:15:"attribute_label";s:5:"size3";s:14:"attribute_type";s:6:"select";s:17:"attribute_orderby";s:10:"menu_order";s:16:"attribute_public";s:1:"0";}}';
	update_option('_transient_wc_attribute_taxonomies', maybe_unserialize($vc_att_taxonomies));
}

add_filter( 'arrowpress_core_list_child_themes', 'arrowpress_list_child_themes' );
function arrowpress_list_child_themes() {
	return array(
		'lusion-child' => array(
			'name'       => 'Lusion Child',
			'slug'       => 'lusion-child',
			'screenshot' => 'https://arrowtheme.github.io/demo-data/lusion/child-themes/screenshot.png',
			'source'     => 'https://arrowtheme.github.io/demo-data/lusion/child-themes/lusion-child.zip',
			'version'    => '1.0.0'
		),
	);
}
