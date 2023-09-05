<?php

class Apr_Core_Portfolio_Metabox extends Apr_Metabox {

	function register_page_metabox( $meta_boxes ) {
		$meta_boxes[] = array(
			'id'         => 'portfolio_metabox',
			'title'      => __( 'Portfolio Options', 'lusion' ),
			'post_types' => 'portfolio',
			'tabs'       => true,
			'fields'     => $this->general_meta_fields()
		);

		return $meta_boxes;
	}

	public function general_meta_fields() {
		$meta_fields = array(
			array(
				'title'  => esc_attr__( 'Portfolio', 'apr-core' ),
				'id'     => 'portfolio_option',
				'fields' => array(
					array(
						'id'      => 'portfolio_layout_single',
						'type'    => 'select',
						'label'   => esc_html__( 'Single Layout', 'apr-core' ),
						'desc'    => esc_html__( 'Choose single product layout ', 'apr-core' ),
						'options' => array(
							'default'           => esc_html__( 'Default', 'apr-core' ),
							'portfolio-layout1' => esc_html__( 'Layout 1', 'apr-core' ),
							'portfolio-layout2' => esc_html__( 'Layout 2', 'apr-core' ),
							'portfolio-layout3' => esc_html__( 'Layout 3', 'apr-core' ),
						),
						'default' => 'default',
					),
					array(
						'id'      => 'gallery_metabox',
//						'type'    => 'gallery',
						'label'   => esc_html__( 'Galery Format', 'apr-core' ),
						'desc'    => esc_html__( ' Upload images gallery ', 'apr-core' ),
						'default' => '',
						'type'             => 'image_advanced',
						'max_file_uploads' => 999,
					),
					array(
						'id'      => 'client_portfolio',
						'label'   => esc_attr__( 'Client', 'apr-core' ),
						'desc'    => esc_attr__( 'Enter client', 'apr-core' ),
						'type'    => 'text',
						'default' => 'Wordpress',
					),
					array(
						'id'      => 'designer_portfolio',
						'label'   => esc_attr__( 'Designer', 'apr-core' ),
						'desc'    => esc_attr__( 'Enter designer', 'apr-core' ),
						'type'    => 'text',
						'default' => 'Lypt',
					),
					array(
						'id'      => 'materials_portfolio',
						'label'   => esc_attr__( 'Materials', 'apr-core' ),
						'desc'    => esc_attr__( 'Enter materials', 'apr-core' ),
						'type'    => 'text',
						'default' => 'Materials',
					),
					array(
						'id'      => 'link_portfolio',
						'label'   => esc_attr__( 'Website', 'apr-core' ),
						'desc'    => esc_attr__( 'Enter Website', 'apr-core' ),
						'type'    => 'text',
						'default' => 'Lusion.com/Maxi',
					),
				),
			),
			$this->general_option(),
			$this->skin_option(),
			$this->breadcrumbs_option(),
			$this->header_option(),
			$this->footer_option(),
		);

		return $meta_fields;
	}
}

if ( class_exists( 'Apr_Core_Portfolio_Metabox' ) ) {
	new Apr_Core_Portfolio_Metabox;
};

