<?php

/**
 * Admin functions
 *
 * @package   ArrowPress_Core
 * @since     0.1.0
 */

/**
 * Clean all keys which is a number, e.g: Array( [0] => ..., ..., [69] => ...);
 *
 * @since 0.4.0
 *
 * @param $theme_mods
 *
 * @return mixed
 */
if ( ! function_exists( 'arrowpress_clean_theme_mods' ) ) {
	function arrowpress_clean_theme_mods( $theme_mods ) {
		// Gets mods keys
		$mod_keys = array_keys( $theme_mods );
		foreach ( $mod_keys as $mod_key ) {
			// Removes from array if the key is a number
			if ( is_numeric( $mod_key ) ) {
				unset( $theme_mods[ $mod_key ] );
			}
		}

		return $theme_mods;
	}
}

if ( ! function_exists( '_arrowpress_export_skip_object_meta' ) ) {
	function _arrowpress_export_skip_object_meta( $return_me, $meta_key, $meta_value = false ) {
		if ( '_arrowpress_demo_content' == $meta_key ) {
			$return_me = true;
		}

		return $return_me;
	}

	/**
	 * Skip export object's meta data if it's _arrowpress_demo_content
	 */
	add_filter( 'wxr_export_skip_postmeta', '_arrowpress_export_skip_object_meta', 1000, 2 );
	add_filter( 'wxr_export_skip_commentmeta', '_arrowpress_export_skip_object_meta', 1000, 2 );
	add_filter( 'wxr_export_skip_termmeta', '_arrowpress_export_skip_object_meta', 1000, 3 );
}

/**
 * Parse url youtube to id.
 *
 * @since 1.0.0
 *
 * @param $url
 *
 * @return mixed
 */
if ( ! function_exists( 'arrowpress_parse_id_youtube' ) ) {
	function arrowpress_parse_id_youtube( $url ) {
		if ( preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match ) ) {
			$video_id = $match[1];

			return $video_id;
		}

		return false;
	}
}

/**
 * Redirect to url.
 *
 * @since 0.8.9
 *
 * @param $url
 */
if ( ! function_exists( 'arrowpress_core_redirect' ) ) {
	function arrowpress_core_redirect( $url ) {
		if ( headers_sent() ) {
			echo "<meta http-equiv='refresh' content='0;URL=$url' />";
		} else {
			wp_redirect( $url );
		}

		exit();
	}
}

/**
 * Unserialize (avoid whitespace string).
 *
 * @since 1.0.0
 *
 * @param $string
 *
 * @return mixed
 */
if ( ! function_exists( 'arrowpress_maybe_unserialize' ) ) {
	function arrowpress_maybe_unserialize( $string ) {
		$value = maybe_unserialize( $string );

		if ( ! $value && strlen( $string ) ) {
			$string = trim( $string );
			$value  = maybe_unserialize( $string );
		}

		return $value;
	}
}

/**
 * Wrapper for set_time_limit to see if it is enabled.
 *
 * @since 1.1.1
 *
 * @param $limit integer
 */
function arrowpress_core_set_time_limit( $limit = 0 ) {
	if ( function_exists( 'set_time_limit' ) && false === strpos( ini_get( 'disable_functions' ), 'set_time_limit' ) ) {
		set_time_limit( $limit );
	}
}


/**
 * Get is child theme.
 *
 * @since 1.0.3
 *
 * @return bool
 */
function arrowpress_core_is_child_theme() {
	$stylesheet = get_stylesheet();
	$template   = get_template();

	return ( $stylesheet != $template );
}

/**
 * Generate token.
 *
 * @since 1.2.1
 *
 * @return string
 */
function arrowpress_core_generate_token() {
	$text  = bin2hex( openssl_random_pseudo_bytes( 16 ) );
	$token = md5( $text );

	return $token;
}

/**
 * Generate code to request to private server.
 *
 * @since 1.4.2
 *
 * @param $key string
 *
 * @return string
 */
function arrowpress_core_generate_code_by_site_key( $key ) {
	$code = time() . '.' . $key;

	return base64_encode( $code );
}

/**
 * Test request.
 *
 * @since 1.4.3
 *
 * @param $url
 *
 * @return array
 */
function arrowpress_core_test_request( $url ) {
	$response         = wp_remote_get( $url );
	$successful       = true;
	$message_response = 'success';

	if ( is_wp_error( $response ) ) {
		$successful       = false;
		$message_response = $response->get_error_message();
	}

	$status_code = wp_remote_retrieve_response_code( $response );

	if ( $status_code == 403 || $status_code >= 500 ) {
		$successful       = false;
		$message_response = wp_remote_retrieve_response_message( $response );
	}

	return array(
		'return'  => $successful,
		'message' => $message_response,
		'url'     => $url
	);
}

/**
 * Check import demo data page-builder
 */
add_action( 'wp_ajax_arrowpress_update_chosen_builder', 'arrowpress_core_page_builder' );
if ( ! function_exists( 'arrowpress_core_page_builder' ) ) {
	function arrowpress_core_page_builder() {
		$arrowpress_key   = sanitize_text_field( $_POST["arrowpress_key"] );
		$arrowpress_value = sanitize_text_field( $_POST["arrowpress_value"] );

		if ( ! is_multisite() ) {
			$active_plugins = get_option( 'active_plugins' );

			if ( $arrowpress_value == 'visual_composer' ) {
				if ( $site_origin = array_search( 'siteorigin-panels/siteorigin-panels.php', $active_plugins ) ) {
					unset( $active_plugins[$site_origin] );
				}

				if ( $elementor = array_search( 'elementor/elementor.php', $active_plugins ) ) {
					unset( $active_plugins[$elementor] );
				}

				if ( ! in_array( 'js_composer/js_composer.php', $active_plugins ) ) {
					$active_plugins[] = 'js_composer/js_composer.php';
				}
			} else {
				if ( $arrowpress_value == 'site_origin' ) {
					if ( $visual_composer = array_search( 'js_composer/js_composer.php', $active_plugins ) ) {
						unset( $active_plugins[$visual_composer] );
					}

					if ( $elementor = array_search( 'elementor/elementor.php', $active_plugins ) ) {
						unset( $active_plugins[$elementor] );
					}

					if ( ! in_array( 'siteorigin-panels/siteorigin-panels.php', $active_plugins ) ) {
						$active_plugins[] = 'siteorigin-panels/siteorigin-panels.php';
					}
				} else {
					if ( $arrowpress_value == 'elementor' ) {
						if ( $visual_composer = array_search( 'js_composer/js_composer.php', $active_plugins ) ) {
							unset( $active_plugins[$visual_composer] );
						}

						if ( $site_origin = array_search( 'siteorigin-panels/siteorigin-panels.php', $active_plugins ) ) {
							unset( $active_plugins[$site_origin] );
						}

						if ( ! in_array( 'elementor/elementor.php', $active_plugins ) ) {
							$active_plugins[] = 'elementor/elementor.php';
						}
					}
				}
			}

			update_option( 'active_plugins', $active_plugins );
		}

		if ( empty( $arrowpress_key ) || empty( $arrowpress_value ) ) {
			$output = 'update fail';
		} else {
			set_theme_mod( $arrowpress_key, $arrowpress_value );
			$output = 'update success';
		}

		echo ent2ncr( $output );
		die();
	}
}

/**
 * Do other tasks before import demo data
 */
add_action( 'arrowpress_core_importer_start_import_demo', 'arrowpress_core_before_start_import_demo', 10, 1 );
if ( ! function_exists( 'arrowpress_core_before_start_import_demo' ) ) {
	function arrowpress_core_before_start_import_demo( $demo ) {
		if ( isset( $demo['child_theme_required'] ) ) {
			$child_themes = Arrowpress_Child_Themes::child_themes();
			foreach ( $child_themes as $theme ) {
				$theme_slug   = $theme->get( 'slug' );
				$theme_status = $theme->get_status();
				if ( $demo['child_theme_required'] == $theme_slug ) {
					if ( $theme_status == 'not_installed' ) {
						$result_install = $theme->install();
					}
					$result_activate = $theme->activate();
					break;
				}
			}
		}
	}
}
