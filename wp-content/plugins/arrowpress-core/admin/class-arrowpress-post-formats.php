<?php

/**
 * Class Arrowpress_Post_Formats.
 *
 * @package   ArrowPress_Core
 * @since     0.1.0
 * @docs      docs/post-formats.md
 */
class Arrowpress_Post_Formats extends Arrowpress_Singleton {
	/**
	 * Arrowpress_Post_Formats constructor.
	 *
	 * @since 0.1.0
	 */
	protected function __construct() {
			$this->init_hooks();
 	}

	/**
	 * Init hooks.
	 *
	 * @since 0.1.0
	 */
	private function init_hooks() {
		add_filter( 'arrowpress_add_meta_boxes', array( $this, 'metabox' ) );
 	}

	/**
	 * Metabox post format: Audio
	 *
	 * @since 0.1.0
	 */
	private function metabox_audio() {
		$prefix = Apr_Core::$prefix;

		$metabox_audio = array(
			'id'         => $prefix . 'metabox_audio',
			'context'    => 'normal',
			'priority'   => 'high',
			'title'      => esc_html__( 'Post format: Audio', 'arrowpress-core' ),
			'post_types' => array( 'post' ),
			'show'       => array(
				'post_format' => array( 'audio' ),
			),
			'fields'     => array(
				array(
					'id'   => $prefix . 'audio',
					'name' => __( 'Audio URL or Embeded Code', 'arrowpress-core' ),
					'desc' => '',
					'type' => 'textarea',
				),
			),
		);

		return apply_filters( 'arrowpress_metabox_audio', $metabox_audio );
	}

	/**
	 * Metabox post format: Video
	 *
	 * @since 0.1.0
	 */
	private function metabox_video() {
		$prefix = Apr_Core::$prefix;

		$metabox_video = array(
			'id'         => $prefix . 'metabox_video',
			'context'    => 'normal',
			'priority'   => 'high',
			'title'      => esc_html__( 'Post format: Video', 'arrowpress-core' ),
			'post_types' => array( 'post' ),
			'show'       => array(
				'post_format' => array( 'video' ),
			),
			'fields'     => array(
				array(
					'id'   => $prefix . 'video',
					'name' => __( 'Video URL or Embeded Code', 'arrowpress-core' ),
					'desc' => '',
					'type' => 'textarea',
				),
			),
		);

		return apply_filters( 'arrowpress_metabox_video', $metabox_video );
	}

	/**
	 * Metabox post format: Image
	 *
	 * @since 0.1.0
	 */
	private function metabox_image() {
		$prefix = Apr_Core::$prefix;

		$metabox_image = array(
			'id'         => $prefix . 'metabox_image',
			'context'    => 'normal',
			'priority'   => 'high',
			'title'      => esc_html__( 'Post format: Image', 'arrowpress-core' ),
			'post_types' => array( 'post' ),
			'show'       => array(
				'post_format' => array( 'image' ),
			),
			'fields'     => array(
				array(
					'id'               => $prefix . 'image',
					'name'             => __( 'Select or Upload Image', 'arrowpress-core' ),
					'desc'             => '',
					'type'             => 'image_advanced',
					'max_file_uploads' => 1,
				),
			),
		);

		return apply_filters( 'arrowpress_metabox_image', $metabox_image );
	}

	/**
	 * Metabox post format: Gallery
	 *
	 * @since 0.1.0
	 */
	private function metabox_gallery() {
		$prefix = Apr_Core::$prefix;

		$metabox_gallery = array(
			'id'         => $prefix . 'metabox_gallery',
			'context'    => 'normal',
			'priority'   => 'high',
			'title'      => esc_html__( 'Post format: Gallery', 'arrowpress-core' ),
			'post_types' => array( 'post' ),
			'show'       => array(
				'post_format' => array( 'gallery' ),
			),
			'fields'     => array(
				array(
					'id'               => $prefix . 'gallery',
					'name'             => __( 'Select or Upload Image', 'arrowpress-core' ),
					'desc'             => '',
					'type'             => 'image_advanced',
					'max_file_uploads' => 999,
				),
			),
		);

		return apply_filters( 'arrowpress_metabox_gallery', $metabox_gallery );
	}

	/**
	 * Metabox post format: Link
	 *
	 * @since 0.1.0
	 */
	private function metabox_link() {
		$prefix = Apr_Core::$prefix;

		$metabox_link = array(
			'id'         => $prefix . 'metabox_link',
			'context'    => 'normal',
			'priority'   => 'high',
			'title'      => esc_html__( 'Post format: Link', 'arrowpress-core' ),
			'post_types' => array( 'post' ),
			'show'       => array(
				'post_format' => array( 'link' ),
			),
			'fields'     => array(
				array(
					'id'   => $prefix . 'link_url',
					'name' => __( 'URL', 'arrowpress-core' ),
					'type' => 'text',
				),
				array(
					'id'   => $prefix . 'link_text',
					'name' => __( 'Text', 'arrowpress-core' ),
					'type' => 'text',
				),
			),
		);

		return apply_filters( 'arrowpress_metabox_link', $metabox_link );
	}

	/**
	 * Metabox post format: Quote
	 *
	 * @since 0.1.0
	 */
	private function metabox_quote() {
		$prefix = Apr_Core::$prefix;

		$metabox_quote = array(
			'id'         => $prefix . 'metabox_quote',
			'context'    => 'normal',
			'priority'   => 'high',
			'title'      => esc_html__( 'Post format: Quote', 'arrowpress-core' ),
			'post_types' => array( 'post' ),
			'show'       => array(
				'post_format' => array( 'quote' ),
			),
			'fields'     => array(
				array(
					'id'   => $prefix . 'quote_author_text',
					'name' => __( 'Author', 'arrowpress-core' ),
					'type' => 'text',
				),
				array(
					'id'   => $prefix . 'quote_author_url',
					'name' => __( 'Author URL', 'arrowpress-core' ),
					'type' => 'url',
				),
			),
		);

		return apply_filters( 'arrowpress_metabox_quote', $metabox_quote );
	}

	/**
	 * Metabox post format: Chat
	 *
	 * @since 0.1.0
	 */
	private function metabox_chat() {
		$prefix = Apr_Core::$prefix;

		$metabox_chat = array(
			'id'         => $prefix . 'metabox_chat',
			'context'    => 'normal',
			'priority'   => 'high',
			'title'      => esc_html__( 'Post format: Chat', 'arrowpress-core' ),
			'post_types' => array( 'post' ),
			'show'       => array(
				'post_format' => array( 'chat' ),
			),
			'fields'     => array(
				array(
					'id'     => $prefix . 'group_chat',
					'type'   => 'group',
					'clone'  => true,
					'fields' => array(
						array(
							'id'   => $prefix . 'chat_name',
							'name' => __( 'Name', 'arrowpress-core' ),
							'type' => 'text',
						),
						array(
							'id'   => $prefix . 'chat_content',
							'name' => __( 'Content', 'arrowpress-core' ),
							'type' => 'textarea',
						),
					),
				),
			),
		);

		return apply_filters( 'arrowpress_metabox_chat', $metabox_chat );
	}

	/**
	 * Add filter metabox for post formats.
	 *
	 * @param array $meta_boxes
	 *
	 * @return array
	 * @since 0.1.0
	 */
	public function metabox( $meta_boxes ) {
			$meta_boxes[] = $this->metabox_audio();
			$meta_boxes[] = $this->metabox_video();
		$meta_boxes[] = $this->metabox_image();
			$meta_boxes[] = $this->metabox_gallery();
			$meta_boxes[] = $this->metabox_link();
			$meta_boxes[] = $this->metabox_quote();
			$meta_boxes[] = $this->metabox_chat();

		return $meta_boxes;
	}
}
