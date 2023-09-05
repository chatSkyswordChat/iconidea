<?php
/**
 * New Customizer Class
 *
 * @package WordPress
 * @subpackage New Customizer Class
 * @author Nhamdv
 */

namespace ArrowTheme\Customizer;

define( 'ARROWPRESS_CUSTOMIZER_DIR', dirname( __FILE__ ) );
define( 'ARROWPRESS_CUSTOMIZER_URI', ARROWPRESS_CORE_URI . '/inc/customizer' );

class Init {

	private static $instance;

	public function __construct() {
		$this->autoload();
		$this->includes();
		$this->register();
		$this->hooks();
	}

	public function register() {
		$classes = array(
			'\ArrowTheme\Customizer\Modules\Css',
			'\ArrowTheme\Customizer\Modules\Webfonts',
			'\ArrowTheme\Customizer\Modules\Dependencies',
			'\ArrowTheme\Customizer\Modules\Postmessage',
			'\ArrowTheme\Customizer\Modules\Tooltips',
			'\ArrowTheme\Customizer\Modules\Loading',
		);

		foreach ( $classes as $class ) {
			if ( class_exists( $class ) ) {
				new $class();
			}
		}
	}

	public function hooks() {
		add_action(
			'customize_preview_init',
			function() {
				$script_info = include ARROWPRESS_CUSTOMIZER_DIR . '/build/preview.asset.php';

				wp_enqueue_script( 'arrowpress-customizer-control', ARROWPRESS_CUSTOMIZER_URI . '/build/preview.js', array_merge( $script_info['dependencies'], array( 'jquery', 'customize-preview' ) ), $script_info['version'], true );
			}
		);

		/**
		 * When use Kirki can't set variants mutilple so in theme use 'arrowpress_multiple_variants_fonts' for select variants.
		 * Use this hook to set when customer update ArrowPress Core use new customizer.
		 *
		 * TODO: Remove this code when Customer use this customizer.
		 */
		add_filter(
			'arrowpress_customizer_typography_family_variants_default',
			function( $variants, $id ) {
				$variant_fallback = get_theme_mod( 'arrowpress_multiple_variants_fonts', array() );

				if ( ! empty( $variant_fallback ) ) {
					// Convert '400' to 'regular'.
					$variant_fallback = array_map(
						function( $variant ) {
							if ( $variant === '400' ) {
								return 'regular';
							}

							return $variant;
						},
						$variant_fallback
					);

					$variants = array_merge( $variants, $variant_fallback );
				}

				return $variants;
			},
			10,
			2
		);
	}

	public function autoload() {
		require_once wp_normalize_path( ARROWPRESS_CUSTOMIZER_DIR . '/autoloader.php' );

		$autoloader = new \ArrowTheme\Customizer\Autoloader();
		$autoloader->add_namespace( 'ArrowTheme\Customizer\Modules', ARROWPRESS_CUSTOMIZER_DIR . '/modules/' );
		$autoloader->add_namespace( 'ArrowTheme\Customizer\Utils', ARROWPRESS_CUSTOMIZER_DIR . '/utils/' );
		$autoloader->register();
	}

	public function includes() {
		foreach ( glob( ARROWPRESS_CUSTOMIZER_DIR . '/controls/*/' ) as $control ) {
			if ( file_exists( $control . 'control.php' ) ) {
				require_once wp_normalize_path( $control . 'control.php' );
			}
			if ( file_exists( $control . 'field.php' ) ) {
				require_once wp_normalize_path( $control . 'field.php' );
			}
			if ( file_exists( $control . 'css.php' ) ) {
				require_once wp_normalize_path( $control . 'css.php' );
			}
		}

		// Load Kirki-Font use for in theme.
//		require_once wp_normalize_path( ARROWPRESS_CUSTOMIZER_DIR . '/class-kirki-fonts.php' );
	}

	public static function instance() {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}

Init::instance();
