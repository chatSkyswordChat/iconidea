<?php

class Apr_Core_Post_Metabox extends Apr_Metabox {
	function register_page_metabox( $meta_boxes ) {
		$meta_boxes[] = array(
			'id'         => 'post_metabox',
			'title'      => __( 'Post Options', 'lusion' ),
			'post_types' => 'post',
			'tabs'       => true,
			'fields'     => $this->general_meta_fields()
		);
		$meta_boxes[] = $this->arrowpress_metabox_video();
		$meta_boxes[] = $this->arrowpress_metabox_audio();
		$meta_boxes[] = $this->arrowpress_metabox_link();
		$meta_boxes[] = $this->arrowpress_metabox_quote();
		$meta_boxes[] = $this->arrowpress_metabox_gallery();

		return $meta_boxes;
	}

	public function general_meta_fields() {
		$meta_fields = array(
			array(
				'title'  => esc_attr__( 'Post', 'lusion' ),
				'id'     => 'post_option',
				'fields' => array(
					array(
						'id'      => 'featured_post',
						'label'   => esc_attr__( 'Featured Post', 'lusion' ),
						'type'    => 'checkbox',
						'default' => '',
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

	public function arrowpress_metabox_video() {
		return array(
			'id'         => 'metabox_video',
			'context'    => 'normal',
			'priority'   => 'high',
			'title'      => esc_html__( 'Post format: Video', 'arrowpress-core' ),
			'post_types' => array( 'post' ),
			'show'       => array(
				'post_format' => array( 'video' ),
			),
			'fields'     => array(
				array(
					'id'      => 'post_video',
					//					'label'             => esc_attr__( 'Video Format', 'lusion' ),
					'desc'    => esc_attr__( 'Insert link video. (Ex: https://vimeo.com/322065821)', 'lusion' ),
					'type'    => 'textarea',
					'default' => '',
				),
			),
		);
	}

	public function arrowpress_metabox_audio() {
		return array(
			'id'         => 'metabox_audio',
			'context'    => 'normal',
			'priority'   => 'high',
			'title'      => esc_html__( 'Post format: Audio', 'arrowpress-core' ),
			'post_types' => array( 'post' ),
			'show'       => array(
				'post_format' => array( 'audio' ),
			),
			'fields'     => array(
				array(
					'id'      => 'post_audio',
					//					'label'             => esc_attr__( 'Audio Format', 'lusion' ),
					'desc'    => esc_attr__( 'Insert link audio(Ex: https://soundcloud.com/powfu/death-bed-prod-otterpop).', 'lusion' ),
					'type'    => 'text',
					'default' => '',
				),
			),
		);
	}

	public function arrowpress_metabox_link() {

		$metabox_link = array(
			'id'         => 'metabox_metabox_link',
			'context'    => 'normal',
			'priority'   => 'high',
			'title'      => esc_html__( 'Post format: Link', 'arrowpress-core' ),
			'post_types' => array( 'post' ),
			'show'       => array(
				'post_format' => array( 'link' ),
			),
			'fields'     => array(
				array(
					'id'      => 'post_link',
					'desc'    => esc_attr__( 'Insert Link Format', 'lusion' ),
					'type'    => 'text',
					'default' => '',
				),
			),
		);

		return $metabox_link;
	}

	public function arrowpress_metabox_quote() {
		$metabox_quote = array(
			'id'         => 'metabox_quote',
			'context'    => 'normal',
			'priority'   => 'high',
			'title'      => esc_html__( 'Post format: Quote Source Text', 'arrowpress-core' ),
			'post_types' => array( 'post' ),
			'show'       => array(
				'post_format' => array( 'quote' ),
			),
			'fields'     => array(
				array(
					'id'      => 'post_quote_text',
					//					'label'             => esc_attr__( 'Quote Format - Source Text', 'lusion' ),
					'desc'    => esc_attr__( 'Insert Quote Format - Source Text.', 'lusion' ),
					'type'    => 'text',
					'default' => '',
				),
			),
		);

		return $metabox_quote;
	}

	public function arrowpress_metabox_gallery() {

		$metabox_gallery = array(
			'id'         => 'metabox_gallery',
			'context'    => 'normal',
			'priority'   => 'high',
			'title'      => esc_html__( 'Post format: Gallery', 'arrowpress-core' ),
			'post_types' => array( 'post' ),
			'show'       => array( 'post_format' => array( 'gallery' ) ),
			'fields'     => array(
				array(
					'id'               => 'gallery_metabox',
					'desc'             => esc_html__( ' Select or Upload Image ', 'lusion' ),
					'default'          => '',
					'type'             => 'image_advanced',
					'max_file_uploads' => 999,
				),

			),
		);

		return $metabox_gallery;
	}
}

if ( class_exists( 'Apr_Core_Post_Metabox' ) ) {
	new Apr_Core_Post_Metabox;
};

