<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Custom filters that act independently of the theme templates
 */
if ( ! class_exists( 'Lusion_Actions_Filters' ) ) {
	class Lusion_Actions_Filters {
		protected static $instance = null;
		public function __construct() {
			add_filter( 'wp_kses_allowed_html', array( $this, 'wp_kses_allowed_html' ), 2, 99 );
			add_filter( 'excerpt_length', array(
				$this,
				'custom_excerpt_length',
			), 999 ); // Change excerpt length is set to 55 words by default.
			add_action( 'wp_footer', array( $this, 'shortcode_style' ) );
		}
		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}
			return self::$instance;
		}
		public function wp_kses_allowed_html( $allowedtags, $context ) {
			switch ( $context ) {
				case 'lusion-default' :
					$allowedtags = array(
						'a'      => array(
							'id'     => array(),
							'class'  => array(),
							'style'  => array(),
							'href'   => array(),
							'target' => array(),
							'rel'    => array(),
							'title'  => array(),
						),
						'img'    => array(
							'id'     => array(),
							'class'  => array(),
							'style'  => array(),
							'src'    => array(),
							'width'  => array(),
							'height' => array(),
							'alt'    => array(),
							'srcset' => array(),
							'sizes'  => array(),
						),
						'div'    => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
						),
						'strong' => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
						),
						'b'      => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
						),
						'span'   => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
						),
						'i'      => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
						),
						'del'    => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
						),
						'ins'    => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
						),
						'br'     => array(),
						'ul'     => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
							'type'  => array(),
						),
						'ol'     => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
							'type'  => array(),
						),
						'li'     => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
						),
						'mark'   => array(
							'id'    => array(),
							'class' => array(),
							'style' => array(),
						),
					);
					break;
			}
			return $allowedtags;
		}
		public function custom_excerpt_length() {
			return 50;
		}
		function shortcode_style() {
			$css = '';
			if ( $css !== '' ) :
				$css = Lusion_Minify::css( $css );
				echo '<style scoped>' . $css . '</style>';
			endif;
		}
	}
	new Lusion_Actions_Filters();
}