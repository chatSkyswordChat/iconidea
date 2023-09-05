<?php
/**
 * Core functions
 *
 * @package   ArrowPress_Core
 * @since     1.0.0
 */

/**
 * Get instance ArrowPress_Core_Customizer.
 *
 * @return ArrowPress_Core_Customizer
 * @since 0.1.0
 */
if ( ! function_exists( 'arrowpress_customizer' ) ) {
	function arrowpress_customizer() {
		return ArrowPress_Core_Customizer::instance();
	}
}

/**
 * Get page id by path. If not found return false.
 *
 * @param $page_slug
 *
 * @return bool|int
 * @since 0.5.0
 *
 */
if ( ! function_exists( 'arrowpress_get_page_id_by_path' ) ) {
	function arrowpress_get_page_id_by_path( $page_slug ) {
		$page = get_page_by_path( $page_slug );

		if ( $page ) {
			return $page->ID;
		}

		return false;
	}
}

/**
 * Add log.
 *
 * @param        $message
 * @param string $handle
 * @param bool   $clear
 *
 * @since 0.8.3
 *
 */
if ( ! function_exists( 'arrowpress_add_log' ) ) {
	function arrowpress_add_log( $message, $handle = 'log', $clear = false ) {
		if ( ! Apr_Core::is_debug() ) {
			return;
		}

		if ( version_compare( phpversion(), '5.6', '<' ) ) {
			return;
		}

		$arrowpress_log = Arrowpress_Logger::instance();
		@$arrowpress_log->add( $message, $handle, $clear );
	}
}

/**
 * let_to_num function.
 *
 * This function transforms the php.ini notation for numbers (like '2M') to an integer.
 *
 * @param $size
 *
 * @return int
 * @since 1.1.1
 *
 */
function arrowpress_core_let_to_num( $size ) {
	$l   = substr( $size, - 1 );
	$ret = substr( $size, 0, - 1 );
	switch ( strtoupper( $l ) ) {
		case 'P':
			$ret *= 1024;
		case 'T':
			$ret *= 1024;
		case 'G':
			$ret *= 1024;
		case 'M':
			$ret *= 1024;
		case 'K':
			$ret *= 1024;
	}

	return $ret;
}


/**
 * arrowpress_core_breadcrumbs
 *
 * @author  tuanta
 * @since   2.1.2
 * @version 1.0.0
 */
if ( ! function_exists( 'arrowpress_core_breadcrumbs' ) ) {

	/**
	 * Output the Thim Breadcrumb.
	 *
	 */
	function arrowpress_core_breadcrumbs( $args = array() ) {

		$args = wp_parse_args(
			$args,
			apply_filters(
				'arrowpress_breadcrumb_defaults',
				array(
					'delimiter'   => '',
					'wrap_before' => '<ul class="breadcrumbs" id="breadcrumbs">',
					'wrap_after'  => '</ul>',
					'before'      => '<li>',
					'after'       => '</li>',
				)
			)
		);

		$breadcrumbs = new ArrowPressCoreBreadcrumbs\Arrowpress_Breadcrumbs();

		$breadcrumb = $breadcrumbs->render();
		if ( ! empty( $breadcrumb ) ) {
			echo $args['wrap_before'];

			foreach ( $breadcrumb as $key => $crumb ) {
				echo $args['before'];

				if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
					echo '<a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a>';
				} else {
					echo esc_html( $crumb[0] );
				}

				echo $args['after'];
				if ( sizeof( $breadcrumb ) !== $key + 1 ) {
					echo $args['delimiter'];
				}
			}

			echo $args['wrap_after'];
		}
	}
}

add_action( 'arrowpress_breadcrumbs', 'arrowpress_core_breadcrumbs', 5 );
if ( ! function_exists( 'arrowpress_breadcrumbs' ) ) {
	function arrowpress_breadcrumbs( $args = array() ) {
		arrowpress_core_breadcrumbs();
	}
}
