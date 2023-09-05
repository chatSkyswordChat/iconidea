<?php
define( 'LUSION_CSS', get_template_directory_uri() . '/assets/css' );
define( 'LUSION_JS', get_template_directory_uri() . '/assets/js' );
define( 'LUSION_THEME_VERSION', '2.0.5' );
define( 'LUSION_THEME_DIR', get_template_directory() );
define( 'LUSION_THEME_URI', get_template_directory_uri() );
define( 'LUSION_THEME_IMAGE_URI', get_template_directory_uri() . '/assets/images' );
define( 'LUSION_CHILD_THEME_URI', get_stylesheet_directory_uri() );
define( 'LUSION_CHILD_THEME_DIR', get_stylesheet_directory() );
define( 'LUSION_FRAMEWORK_DIR', get_template_directory() . '/inc' );
define( 'LUSION_ADMIN', get_template_directory() . '/inc/admin' );
define( 'LUSION_FRAMEWORK_FUNCTION', get_template_directory() . '/inc/functions' );
define( 'LUSION_FRAMEWORK_PLUGIN', get_template_directory() . '/inc/admin' );
define( 'LUSION_CUSTOMIZER_DIR', LUSION_ADMIN . '/customizer' );

require_once LUSION_FRAMEWORK_FUNCTION . '/function.php';
if ( ( class_exists( 'WooCommerce' ) ) ) {
	require_once LUSION_FRAMEWORK_FUNCTION . '/woocommerce.php';
}
require_once LUSION_FRAMEWORK_FUNCTION . '/ajax_search/ajax-search.php';
require_once LUSION_FRAMEWORK_FUNCTION . '/menus/menu.php';
require_once LUSION_FRAMEWORK_FUNCTION . '/menus/class-edit-menu-walker.php';
require_once LUSION_FRAMEWORK_FUNCTION . '/menus/class-walker-nav-menu.php';
require_once LUSION_FRAMEWORK_FUNCTION . '/ajax-account/custom-ajax.php';
require_once LUSION_FRAMEWORK_DIR . '/class-functions.php';
require_once LUSION_FRAMEWORK_DIR . '/class-helper.php';
require_once LUSION_FRAMEWORK_DIR . '/class-static.php';
require_once LUSION_FRAMEWORK_DIR . '/class-templates.php';
// require_once LUSION_FRAMEWORK_DIR . '/class-aqua-resizer.php';
require_once LUSION_FRAMEWORK_DIR . '/class-global.php';
require_once LUSION_FRAMEWORK_DIR . '/class-widgets.php';
require_once LUSION_FRAMEWORK_DIR . '/class-wpml.php';
require_once LUSION_FRAMEWORK_DIR . '/class-post-type-blog.php';
require_once LUSION_FRAMEWORK_DIR . '/class-post-type-portfolio.php';
require_once LUSION_FRAMEWORK_DIR . '/class-actions-filters.php';
require_once LUSION_FRAMEWORK_DIR . '/class-enqueue.php';
require_once LUSION_FRAMEWORK_DIR . '/class-custom-style.php';
require_once LUSION_FRAMEWORK_DIR . '/class-minify.php';

//APR_CORE_PATH
require LUSION_ADMIN . '/arrow-core-installer/installer.php';
// check with arrowcore 2.0
if ( defined( 'ARROWPRESS_CORE_VERSION' ) ) {
	require_once LUSION_ADMIN . '/metabox/metabox.php';
	require_once LUSION_ADMIN . '/metabox/class-taxonomy-metabox.php';
	require_once LUSION_ADMIN . '/metabox/class-taxonomy-product.php';
	require_once LUSION_ADMIN . '/plugins-require.php';
	require_once LUSION_FRAMEWORK_DIR . '/widgets/class-widget.php';
	require_once LUSION_FRAMEWORK_DIR . '/widgets/class-widgets.php';
	require_once LUSION_FRAMEWORK_DIR . '/class-elementor-widget.php';

	if ( ( class_exists( 'WooCommerce' ) ) ) {
		require_once LUSION_FRAMEWORK_FUNCTION . '/woocommerce-template-functions.php';
	}
	if ( function_exists( 'arrowpress_importer_files' ) || class_exists( 'Kirki' ) ) {
		deactivate_plugins( 'arrowpress-importer/arrowpress-importer.php' );
		deactivate_plugins( 'kirki/kirki.php' );
	}
} else {
	require_once LUSION_FRAMEWORK_DIR . '/class-kirki.php';
	require_once LUSION_FRAMEWORK_DIR . '/plugins/functions.php';
}

require_once LUSION_FRAMEWORK_DIR . '/class-customize.php';

if ( ! isset( $content_width ) ) {
	$content_width = 1170;
}

function lusion_theme_setup() {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-header' );
	add_theme_support( 'arrowpress-core' );
	add_theme_support(
		'custom-logo',
		array(
			'flex-width'  => false,
			'flex-height' => false,
		)
	);
}

add_action( 'after_setup_theme', 'lusion_theme_setup' );
