<?php

class Apr_Core_Header_Metabox extends Apr_Metabox {

	function register_page_metabox( $meta_boxes ) {
		$meta_boxes[] = array(
			'id'         => 'header_metabox',
			'title'      => __( 'Header Options', 'lusion' ),
			'post_types' => 'header',
			'tabs'       => true,
			'fields'     => $this->general_meta_fields()
		);

		return $meta_boxes;
	}

	public function general_meta_fields() {
		$meta_fields = array(
			array(
				'title'  => esc_attr__( 'Header', 'apr-core' ),
				'id'     => 'header_option',
				'fields' => array(
					array(
						'id'      => 'header_fix_bg',
						'label'   => esc_attr__( 'Header Fix Background', 'apr-core' ),
						'desc'    => esc_attr__( 'You should input hex color(ex: #ffffff).', 'apr-core' ),
						'type'    => 'color',
						'default' => 'transparent'
					),
					array(
						'id'      => 'header_fix_color',
						'label'   => esc_attr__( 'Header Fix Link Color', 'apr-core' ),
						'desc'    => esc_attr__( 'You should input hex color(ex: #ffffff).', 'apr-core' ),
						'type'    => 'color',
						'default' => 'transparent'
					),
					array(
						'id'      => 'header_fix_color_hover',
						'label'   => esc_attr__( 'Header Fix Link Hover Color', 'apr-core' ),
						'desc'    => esc_attr__( 'You should input hex color(ex: #ffffff).', 'apr-core' ),
						'type'    => 'color',
						'default' => 'transparent'
					),
				),
			),
			$this->general_option(),
		);

		return $meta_fields;
	}
}

if ( class_exists( 'Apr_Core_Header_Metabox' ) ) {
	new Apr_Core_Header_Metabox;
};

