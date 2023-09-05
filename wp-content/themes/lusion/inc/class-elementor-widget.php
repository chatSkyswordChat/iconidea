<?php

namespace Elementor;

class Apr_Core_Widgets {

	/**
	 * Plugin constructor.
	 */
	public function __construct() {
		$this->apr_core_add_actions();
		$this->apr_core_register_posttypes();
	}

	private function apr_core_add_actions() {

		add_action( 'elementor/widgets/widgets_registered', [ $this, 'apr_core_widgets_registered' ] );
		add_action( 'elementor/init', [ $this, 'apr_core_widgets_int' ] );
		add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'apr_elementor_styles' ] );
		add_action( 'elementor/preview/enqueue_styles', [ $this, 'apr_elementor_styles_preview' ] );
		add_action( 'elementor/preview/enqueue_scripts', [ $this, 'apr_elementor_scripts_preview' ] );
	}

	private $shortcodes = array( "blog", "product", "sale-popup", "icon-box", "social", "advanced-tabs", "heading-modern", "banner", "testimolials", "woo-categories", "mailchimp", "countdown", "contact-form", "elementor-template", "header-group", "site-logo", "slide-carousel", "slide", "nav-menu", "counter", "search-form", "team", "single-product", "search-mobile", "lookbook", "brands", "image360" );
	private $widgets = array( 'category-product', 'active-theme', 'compare', 'contact', 'logo', 'posts', 'social', 'elementor-template' );

	private $posttype = array( 'header', 'footer', 'portfolio' );

	/**
	 * register all post type here
	 * @return void
	 */

	public static function get_animation_options() {
		return [
			''                  => __( 'None', 'apr-core' ),
			'fadeInDown'        => __( 'FadeInDown', 'apr-core' ),
			'fadeInUp'          => __( 'FadeInUp', 'apr-core' ),
			'fadeInRight'       => __( 'FadeInRight', 'apr-core' ),
			'fadeInLeft'        => __( 'FadeInLeft', 'apr-core' ),
			'fadeInDownBig'     => __( 'FadeInDownBig', 'apr-core' ),
			'fadeInLeftBig'     => __( 'FadeInLeftBig', 'apr-core' ),
			'fadeInRightBig'    => __( 'FadeInRightBig', 'apr-core' ),
			'fadeInUpBig'       => __( 'FadeInUpBig', 'apr-core' ),
			'lightSpeedIn'      => __( 'LightSpeedIn', 'apr-core' ),
			'lightSpeedOut'     => __( 'LightSpeedOut', 'apr-core' ),
			'zoomIn'            => __( 'Zoom', 'apr-core' ),
			'zoomInDown'        => __( 'ZoomInDown', 'apr-core' ),
			'zoomInLeft'        => __( 'ZoomInLeft', 'apr-core' ),
			'zoomInRight'       => __( 'ZoomInRight', 'apr-core' ),
			'zoomInUp'          => __( 'ZoomInUp', 'apr-core' ),
			'pulse'             => __( 'Pulse', 'apr-core' ),
			'bounceIn'          => __( 'BounceIn', 'apr-core' ),
			'bounceInDown'      => __( 'BounceInDown', 'apr-core' ),
			'bounceInLeft'      => __( 'BounceInLeft', 'apr-core' ),
			'bounceInRight'     => __( 'BounceInRight', 'apr-core' ),
			'bounceInUp'        => __( 'BounceInUp', 'apr-core' ),
			'rotateIn'          => __( 'RotateIn', 'apr-core' ),
			'rotateInDownLeft'  => __( 'RotateInDownLeft', 'apr-core' ),
			'rotateInDownRight' => __( 'RotateInDownRight', 'apr-core' ),
			'rotateInUpLeft'    => __( 'RotateInUpLeft', 'apr-core' ),
			'rotateInUpRight'   => __( 'RotateInUpRight', 'apr-core' ),
			'slideInUp'         => __( 'SlideInUp', 'apr-core' ),
			'slideInDown'       => __( 'SlideInDown', 'apr-core' ),
			'slideInLeft'       => __( 'SlideInLeft', 'apr-core' ),
			'slideInRight'      => __( 'SlideInRight', 'apr-core' ),
			'jackInTheBox'      => __( 'JackInTheBox', 'apr-core' ),
		];
	}

	protected function apr_core_register_posttypes() {

		foreach ( $this->posttype as $posttypes ) {
			require_once( LUSION_ADMIN . '/posttypes/' . $posttypes . '.php' );
		}
	}

	protected function apr_core_add_widget() {
		foreach ( $this->widgets as $widgets ) {
			require_once( LUSION_FRAMEWORK_DIR . '/widgets/' . $widgets . '.php' );
		}
	}

	public function apr_core_widgets_registered() {
		$this->apr_core_includes();
	}

	public function apr_core_widgets_int() {
		$this->apr_core_register_widget();
	}

	private function apr_core_includes() {
		foreach ( $this->shortcodes as $shortcode ) {
			require_once( LUSION_FRAMEWORK_DIR . '/elementor/widgets/' . $shortcode . '.php' );
		}
	}

	private function apr_core_register_widget() {

		Plugin::instance()->elements_manager->add_category(
			'apr-core',
			[
				'title' => esc_html__( 'Apr Elementor PRO', 'apr-core' ),
				'icon'  => 'icon-goes-here'
			]
		);

	}

	public function apr_elementor_styles_preview() {
		$suffix = '';
		if ( is_rtl() ) {
			$suffix = '-rtl';
		}
		wp_enqueue_style(
			'apr-sc-lookbook', LUSION_CSS . '/elementor/lookbook' . esc_html( $suffix ) . '.css',
			array(), LUSION_THEME_VERSION
		);
		wp_enqueue_style( 'apr-sc-banner', LUSION_CSS . '/elementor/banner' . esc_html( $suffix ) . '.css', array(), LUSION_THEME_VERSION );
		wp_enqueue_style( 'apr-sc-advance-tabs', LUSION_CSS . '/elementor/advance-tabs' . esc_html( $suffix ) . '.css', array(), LUSION_THEME_VERSION );
		wp_enqueue_style( 'apr-sc-blog', LUSION_CSS . '/elementor/blog' . esc_html( $suffix ) . '.css', array(), LUSION_THEME_VERSION );
		wp_enqueue_style( 'apr-sc-contact-form', LUSION_CSS . '/elementor/contact-form' . esc_html( $suffix ) . '.css', array(), LUSION_THEME_VERSION );
		wp_enqueue_style( 'apr-sc-counter', LUSION_CSS . '/elementor/counter' . esc_html( $suffix ) . '.css', array(), LUSION_THEME_VERSION );
		wp_enqueue_style( 'apr-sc-heading-modern', LUSION_CSS . '/elementor/heading-modern' . esc_html( $suffix ) . '.css', array(), LUSION_THEME_VERSION );
		wp_enqueue_style( 'apr-sc-icon-box', LUSION_CSS . '/elementor/icon-box' . esc_html( $suffix ) . '.css', array(), LUSION_THEME_VERSION );
		wp_enqueue_style( 'apr-sc-mailchimp', LUSION_CSS . '/elementor/mailchimp' . esc_html( $suffix ) . '.css', array(), LUSION_THEME_VERSION );
		wp_enqueue_style( 'apr-sc-product', LUSION_CSS . '/elementor/product' . esc_html( $suffix ) . '.css', array(), LUSION_THEME_VERSION );
		wp_enqueue_style( 'apr-sc-single-product', LUSION_CSS . '/elementor/single-product' . esc_html( $suffix ) . '.css', array(), LUSION_THEME_VERSION );
		wp_enqueue_style( 'apr-sc-team-members', LUSION_CSS . '/elementor/team-members' . esc_html( $suffix ) . '.css', array(), LUSION_THEME_VERSION );
		wp_enqueue_style( 'apr-sc-testimonial', LUSION_CSS . '/elementor/testimonial' . esc_html( $suffix ) . '.css', array(), LUSION_THEME_VERSION );
		wp_enqueue_style( 'apr-sc-categories', LUSION_CSS . '/elementor/categories' . esc_html( $suffix ) . '.css', array(), LUSION_THEME_VERSION );
		wp_enqueue_style( 'apr-sc-brand', LUSION_CSS . '/elementor/brand' . esc_html( $suffix ) . '.css', array(), LUSION_THEME_VERSION );
		wp_enqueue_style( 'apr-sc-header', LUSION_CSS . '/elementor/header-group' . esc_html( $suffix ) . '.css', array(), LUSION_THEME_VERSION );
		wp_enqueue_style( 'apr-sc-slides', LUSION_CSS . '/elementor/slides-carousel' . esc_html( $suffix ) . '.css', array() );
		wp_enqueue_style( 'apr-sc-image360', LUSION_CSS . '/elementor/image360' . esc_html( $suffix ) . '.css', array() );
		wp_enqueue_style( 'countdown-css', LUSION_CSS . '/elementor/countdown' . esc_html( $suffix ) . '.css', array() );
 	}

	public function apr_elementor_scripts_preview() {
		wp_enqueue_script( 'threesixty-script', LUSION_JS . '/elementor/threesixty.min.js', array() );
		wp_enqueue_script( 'apr-tab-script', LUSION_JS . '/elementor/advanced-tabs.min.js', array() );
		wp_enqueue_script( 'countdown-scripts', LUSION_JS . '/elementor/jquery.countdown.min.js', array() );
	}

	public function apr_elementor_styles() {
		wp_register_style( 'apr-icon', LUSION_CSS . '/elementor/apr-font.min.css', array(), LUSION_THEME_VERSION );
		wp_enqueue_style( 'apr-icon' );
	}
}

new Apr_Core_Widgets();

/* Start get Category check box */
function apr_core_check_get_cat( $type_taxonomy ) {
	$category  = get_categories( array( 'taxonomy' => $type_taxonomy ) );
	$cat_check = array();
	if ( isset( $category ) && ! empty( $category ) ):
		foreach ( $category as $item ) {
			$cat_check[$item->slug] = $item->name . '(' . $item->count . ')';
		}
	endif;

	return $cat_check;
}

//get artribute
function apr_core_check_get_artribute() {
	$attr_tax = wc_get_attribute_taxonomies();
	$attr     = array();

	foreach ( $attr_tax as $tax ) {
		$attr[wc_attribute_taxonomy_name( $tax->attribute_name )] = $tax->attribute_label;
	}

	return $attr;
}

function apr_core_get_post_id( $post_type ) {
	$block_options = array();
	$args          = array(
		'numberposts' => - 1,
		'post_type'   => $post_type,
		'post_status' => 'publish',
	);
	$posts         = get_posts( $args );
	foreach ( $posts as $_post ) {
		$block_options[$_post->ID] = $_post->post_title;
	}

	return $block_options;
}

if ( ! is_admin() ) {
	add_action( 'wp_enqueue_scripts', function () {
		wp_deregister_script( 'jquery-slick' );
		wp_deregister_style( 'jquery-slick' );
		wp_deregister_script( 'wcva-slick' );
		wp_deregister_style( 'wcva-slick-css' );
	}, 11 );
}

if ( ! function_exists( 'auxin_is_true' ) ) {

	function auxin_is_true( $var ) {
		if ( is_bool( $var ) ) {
			return $var;
		}

		if ( is_string( $var ) ) {
			$var = strtolower( $var );
			if ( in_array( $var, array( 'yes', 'on', 'true', 'checked' ) ) ) {
				return true;
			}
		}

		if ( is_numeric( $var ) ) {
			return (bool) $var;
		}

		return false;
	}

}
if ( ! function_exists( 'rwmb_meta' ) ) {
	function rwmb_meta( $key, $args = '', $post_id = null ) {
		return false;
	}
}
/* End get Category check box */

// Get all elementor page templates
if ( ! function_exists( 'apr_core_get_page_templates' ) ) {
	function apr_core_get_page_templates() {
		$page_templates = get_posts( array(
			'post_type'      => 'elementor_library',
			'posts_per_page' => - 1
		) );

		$options = array();

		if ( ! empty( $page_templates ) && ! is_wp_error( $page_templates ) ) {
			foreach ( $page_templates as $post ) {
				$options[$post->ID] = $post->post_title;
			}
		}

		return $options;
	}
}
if ( ! function_exists( 'apr_is_woocommerce_activated' ) ) {
	/**
	 * Query WooCommerce activation
	 */
	function apr_is_woocommerce_activated() {
		return class_exists( 'WooCommerce' ) ? true : false;
	}
}
