<?php

namespace Arrow_EL_Lib\Elementor;

use Arrow_EL_Lib\SingletonTrait;

class Library {
	use SingletonTrait;

	public function __construct() {
		$this->includes();

		add_action( 'elementor/editor/after_enqueue_scripts', array( $this, 'enqueue_editor_scripts' ), 100 );
	}

	public function includes() {
		require_once ARROWPRESS_CORE_PATH . '/inc/library/class-rest-api.php';
		require_once ARROWPRESS_CORE_PATH . '/inc/library/class-import.php';
	}

	public function enqueue_editor_scripts() {
		wp_enqueue_script( 'arrowpress-elementor-library', ARROWPRESS_CORE_URI . '/inc/library/assets/library.js', array( 'wp-api-fetch', 'wp-i18n' ), ARROWPRESS_CORE_VERSION, true );
		wp_enqueue_style( 'arrowpress-elementor-library', ARROWPRESS_CORE_URI . '/inc/library/assets/library.css', array(), ARROWPRESS_CORE_VERSION );

		$theme = wp_get_theme();

		if ( is_child_theme() ) {
			$theme = wp_get_theme( $theme->parent()->template );
		}

		wp_localize_script(
			'arrowpress-elementor-library',
			'ArrowElementorLibrary',
			array(
				'logo'   => ARROWPRESS_CORE_URI . '/admin/assets/images/logo.svg',
				'postID' => get_the_ID(),
				'theme'  => $theme->get( 'TextDomain' ),
			)
		);
	}
}

Library::instance();
