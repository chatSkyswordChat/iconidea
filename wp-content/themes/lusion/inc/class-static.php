<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Lusion {
	const PRIMARY_FONT = 'Jost, sans-serif';
	/*const SECONDARY_FONT = 'Poppins';*/
	const PRIMARY_COLOR = '#2c2c2c';
	const SECONDARY_COLOR = '#2c2c2c';
	const THIRD_COLOR = '#2c2c2c';
	const HEADING_COLOR = '#2c2c2c';
	const BODY_COLOR = '#707070';
	const WIDGET_COLOR = '#9a9a9a';


	/**
	 * Get setting from Kirki
	 *
	 * @param string $setting
	 *
	 * @return mixed
	 */
	public static function setting( $setting = '' ) {
		if ( defined( 'ARROWPRESS_CORE_VERSION' ) ) {
			$settings = ArrowPress_Core_Customizer::get_option_default( $setting );
		}else{
			$settings = get_theme_mod( $setting );
		}
//

		return $settings;
	}

	/**
	 * Requirement one file.
	 *
	 * @param string $file Enter your file path here (included .php)
	 */
	public static function require_file( $file = '' ) {
		if ( file_exists( $file ) ) {
			require_once $file;
		} else {
			wp_die( esc_html__( 'Could not load theme file: ', 'lusion' ) . $file );
		}
	}

	/**
	 * Primary Menu
	 */
	public static function menu_primary( $args = array() ) {
		$menu = get_post_meta( get_the_ID(), 'menu_display', true );
		if ( $menu === '' ) {
			if ( has_nav_menu( 'primary' ) && class_exists( 'Lusion_Primary_Walker_Nav_Menu' ) ) {
				$defaults       = array(
					'theme_location' => 'primary',
					'container'      => 'ul',
					'menu_class'     => 'mega-menu',
				);
				$args['walker'] = new Lusion_Primary_Walker_Nav_Menu;

			} else {
				$defaults = array(
					'container'  => 'ul',
					'menu_class' => 'mega-menu',
				);
			}
			$args = wp_parse_args( $args, $defaults );
		} else {
			$defaults       = array(
				'menu'       => $menu,
				'container'  => 'ul',
				'menu_class' => 'mega-menu',
			);
			$args['walker'] = new Lusion_Primary_Walker_Nav_Menu;
			$args           = wp_parse_args( $args, $defaults );
		}
		wp_nav_menu( $args );
	}

	public static function menu_builder( $menu_builder ) { 
		$menu = get_post_meta( get_the_ID(), 'menu_display', true );
		$args = array();
		
		if ( empty( $menu ) ) {
			$defaults = array(
				'menu'       => $menu_builder,
				'container'  => 'ul',
				'menu_class' => 'mega-menu',
			);
		} else {
			$defaults = array(
				'menu'       => $menu,
				'container'  => 'ul',
				'menu_class' => 'mega-menu',
			);
		}
		$args['walker'] = new Lusion_Primary_Walker_Nav_Menu;
		$args           = wp_parse_args( $args, $defaults );
		 wp_nav_menu( $args );
	}

	public static function menu_vertical( $menu_builder ) {
		$args           = array();
		$defaults       = array(
			'menu'       => $menu_builder,
			'container'  => 'ul',
			'menu_class' => 'mega-menu',
		);
		 $args['walker'] = new Lusion_Primary_Walker_Nav_Menu;
		$args           = wp_parse_args( $args, $defaults );

		wp_nav_menu( $args );
	}

	/**
	 * Adds custom attributes to the body tag.
	 */
	public static function body_attributes() {
		$attrs = apply_filters( 'insight_body_attributes', array() );

		$attrs_string = '';
		if ( ! empty( $attrs ) ) {
			foreach ( $attrs as $attr => $value ) {
				$attrs_string .= " {$attr}=" . '"' . esc_attr( $value ) . '"';
			}
		}
		echo '' . $attrs_string;
	}

	/**
	 * Adds custom classes to the branding.
	 */
	public static function branding_class( $class = '' ) {
		$classes = array( 'branding' );

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}

		$classes = apply_filters( 'insight_branding_class', $classes, $class );

		echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
	}

	/**
	 * Adds custom classes to the navigation.
	 */
	public static function navigation_class( $class = '' ) {
		$classes = array( 'navigation page-navigation' );

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}
		$classes = apply_filters( 'insight_navigation_class', $classes, $class );

		echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
	}

	public static function get_header_type() {
		$enable_header_builder = Lusion::setting( 'enable_header_builder' );

		$header_type           = lusion_get_meta_value( 'header_type' );
 		$header_customize_id   = Lusion::setting( 'choose_header_builder' );
		if ( class_exists( 'Apr_Core' ) ):
			if ( is_category() ) {
				if ( ( $enable_header_builder == true && ! empty( $header_customize_id ) ) || ( ! empty( $header_type ) && $header_type !== 'default' ) ) {
					get_template_part( 'headers/header-builder' );
				} else {
					get_template_part( 'headers/header-default' );
				}
			} elseif ( is_tax( 'product_cat' ) ) {
				if ( ( $enable_header_builder == true && ! empty( $header_customize_id ) ) || ( ! empty( $header_type ) && $header_type !== 'default' ) ) {
					get_template_part( 'headers/header-builder' );
				} else {
					get_template_part( 'headers/header-default' );
				}
			} elseif ( is_archive() ) {
				if ( ( $enable_header_builder == true && ! empty( $header_customize_id ) ) || ( ! empty( $header_type ) && $header_type !== 'default' ) ) {
					get_template_part( 'headers/header-builder' );
				} else {
					get_template_part( 'headers/header-default' );
				}
			} else {
				if ( ( $enable_header_builder == true && ! empty( $header_customize_id ) ) || ( ! empty( $header_type ) && $header_type !== 'default' ) ) {
					get_template_part( 'headers/header-builder' );
				} else {
					get_template_part( 'headers/header-default' );
				}
			}
		else:
			get_template_part( 'headers/header-default' );
		endif;
	}

	public static function header_class( $class = '' ) {
		$classes = array( 'site-header page-header' );
		if ( class_exists( 'Apr_Core' ) ) {
			$enable_header_builder = Lusion::setting( 'enable_header_builder' );
			$header_type           = lusion_get_meta_value( 'header_type' );
			$header_customize_id   = Lusion::setting( 'choose_header_builder' );
			if ( $enable_header_builder == true || $header_type !== 'default' ) {
				$classes[] = "header-builder";
				if ( $header_type !== '' && $header_type !== 'default' ) {
					$classes[] = $header_type;
				} else {
					$classes[] = $header_customize_id;
				}
			} else {
				$classes[] = "header-default";
			}
		} else {
			$classes[] = "header-default";
		}
		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}
		$classes = apply_filters( 'lusion_header_class', $classes, $class );
		echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
	}

	public static function get_footer_type() {
		$enable_footer_builder = Lusion::setting( 'enable_footer_builder' );
		$footer_type           = lusion_get_meta_value( 'footer_type' );
		$footer_customize_id   = Lusion::setting( 'choose_footer_builder' );
		if ( class_exists( 'Apr_Core' ) ):
			if ( is_category() ) {
				if ( ( $enable_footer_builder == true && ! empty( $footer_customize_id ) ) || ( ! empty( $footer_type ) && $footer_type !== 'default' ) ) {
					get_template_part( 'footers/footer-builder' );
				} else {
					get_template_part( 'footers/footer-default' );
				}
			} elseif ( is_tax( 'product_cat' ) ) {
				if ( ( $enable_footer_builder == true && ! empty( $footer_customize_id ) ) || ( ! empty( $footer_type ) && $footer_type !== 'default' ) ) {
					get_template_part( 'footers/footer-builder' );
				} else {
					get_template_part( 'footers/footer-default' );
				}
			} elseif ( is_archive() ) {
				if ( ( $enable_footer_builder == true && ! empty( $footer_customize_id ) ) || ( ! empty( $footer_type ) && $footer_type !== 'default' ) ) {
					get_template_part( 'footers/footer-builder' );
				} else {
					get_template_part( 'footers/footer-default' );
				}
			} else {
				if ( ( $enable_footer_builder == true && ! empty( $footer_customize_id ) ) || ( ! empty( $footer_type ) && $footer_type !== 'default' ) ) {
					get_template_part( 'footers/footer-builder' );
				} else {
					get_template_part( 'footers/footer-default' );
				}
			}
		else:
			get_template_part( 'footers/footer-default' );
		endif;
	}

	/**
	 * Adds custom classes to the footer.
	 */
	public static function footer_class( $class = '' ) {
		$classes     = array( 'page-footer' );
		$footer_type = Lusion_Global::instance()->set_footer_type();
		$classes[]   = "footer-{$footer_type}";
		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = array();
		}
		$classes = apply_filters( 'lusion_footer_class', $classes, $class );
		echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
	}
}
