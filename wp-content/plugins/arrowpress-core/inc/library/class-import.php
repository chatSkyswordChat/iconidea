<?php

namespace Arrow_EL_Lib\Elementor\Library;

use Elementor\TemplateLibrary\Source_Local;
use Elementor\Plugin;
use Elementor\TemplateLibrary;

class Import extends Source_Local {

	/**
	 * Update post meta.
	 *
	 * @param integer $post_id Post ID.
	 * @param array   $data    Elementor Data.
	 *
	 * @return array   $data Elementor Imported Data.
	 * @since 2.0.0
	 */
	public function import( $post_id = 0, $data = array() ) {
		if ( ! empty( $post_id ) && ! empty( $data ) ) {
			$data = wp_json_encode( $data, true );

			$data = json_decode( $data, true );

			// Import the data.
			$data = $this->replace_elements_ids( $data );
			$data = $this->process_export_import_content( $data, 'on_import' );

			update_post_meta( $post_id, '_elementor_data', wp_slash( wp_json_encode( $data ) ) );

			// !important, Clear the cache after images import.
			\Elementor\Plugin::$instance->files_manager->clear_cache();

			return $data;
		}

		return false;
	}
}
