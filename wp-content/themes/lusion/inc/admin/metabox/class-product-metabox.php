<?php

class Apr_Core_Product_Metabox extends Apr_Metabox {

	function register_page_metabox( $meta_boxes ) {
		$meta_boxes[] = array(
			'id'         => 'product_metabox',
			'title'      => __( 'Product Options', 'lusion' ),
			'post_types' => 'product',
			'tabs'       => true,
			'fields'     => $this->general_meta_fields()
		);

		return $meta_boxes;
	}

	public function general_meta_fields() {
		$meta_fields = array(
			array(
				'title'  => esc_attr__( 'Product', 'apr-core' ),
				'id'     => 'product_option',
				'fields' => array(
					array(
						'id'      => 'meta_single_style',
						'type'    => 'select',
						'label'   => esc_html__( 'Single Style', 'apr-core' ),
						'desc'    => esc_html__( 'Choose single product style ', 'apr-core' ),
						'options' => array(
							'default'        => esc_html__( 'Default', 'apr-core' ),
							'single_default' => esc_html__( 'Single Default', 'apr-core' ),
							'single_1'       => esc_html__( 'Single 1', 'apr-core' ),
							'single_2'       => esc_html__( 'Single 2', 'apr-core' ),
							'single_3'       => esc_html__( 'Single 3 (Full width)', 'apr-core' ),
							'single_4'       => esc_html__( 'Single 4 (Sticky)', 'apr-core' ),
						),
						'default' => 'default',
					),
					array(
						'id'      => 'sticky_product',
						'label'   => esc_attr__( 'Show Sticky Product', 'apr-core' ),
						'type'    => 'button_set',
						'default' => 'default',
						'desc'    => esc_attr__( 'Choose to show the sticky product', 'apr-core' ),
						'options' => array(
							'default' => esc_html__( 'Default', 'apr-core' ),
							'on'      => esc_html__( 'On', 'apr-core' ),
							'off'     => esc_html__( 'Off', 'apr-core' ),
						),
					),
					array(
						'id'      => 'product_thumbnail_style',
						'type'    => 'select',
						'label'   => esc_html__( 'Product Thumbnails Style', 'apr-core' ),
						'desc'    => esc_html__( 'Only use width single product style 1.', 'apr-core' ),
						'options' => array(
							'default'    => esc_html__( 'Default', 'apr-core' ),
							'horizontal' => esc_html__( 'Horizontal', 'apr-core' ),
							'vertical'   => esc_html__( 'Vertical', 'apr-core' ),
						),
						'default' => 'default',
					),
					array(
						'id'      => 'number_thumbnail_show',
						'type'    => 'number',
						'label'   => esc_html__( 'Number thumbnail show', 'apr-core' ),
						'desc'    => esc_html__( 'Only use product thumbnails style vertical.', 'apr-core' ),
						'default' => '',
					),
					array(
						'id'      => 'background_color_single_product',
						'label'   => esc_attr__( 'Background Color', 'apr-core' ),
						'desc'    => esc_attr__( 'Select background color for page', 'apr-core' ),
						'type'    => 'color',
						'default' => '',
					),
					array(
						'id'      => 'unit_price',
						'label'   => esc_attr__( 'Unit Price', 'apr-core' ),
						'desc'    => esc_attr__( 'Enter unit price for the product.', 'apr-core' ),
						'type'    => 'text',
						'default' => '',
					),
					array(
						'id'      => 'video_product',
						'label'   => esc_attr__( 'Link Video', 'apr-core' ),
						'desc'    => esc_attr__( 'Enter link video Youtube, Vimeo,... for the product. (Ex: https://player.vimeo.com/video/125562082?autoplay=1)', 'apr-core' ),
						'type'    => 'text',
						'default' => '',
					),
					array(
						'id'      => 'tab_width',
						'type'    => 'select',
						'label'   => esc_html__( 'Tab Width', 'apr-core' ),
						'options' => array(
							'default'    => esc_html__( 'Default', 'apr-core' ),
							'accordion'  => esc_html__( 'Accordion', 'apr-core' ),
							'full_width' => esc_html__( 'Full Width', 'apr-core' ),
							'general'    => esc_html__( 'General', 'apr-core' ),
						),
						'default' => 'default',
					),
					array(
						'id'      => 'custom_tab_title',
						'label'   => esc_attr__( 'Custom Tab Title', 'apr-core' ),
						'desc'    => esc_attr__( 'Input the custom tab title.', 'apr-core' ),
						'type'    => 'text',
						'default' => '',
					),
					array(
						'id'      => 'custom_tab_content',
						'label'   => esc_attr__( 'Content Tab', 'apr-core' ),
						'desc'    => esc_attr__( 'Input the content tab.', 'apr-core' ),
						'type'    => 'editor',
						'default' => '',
					),
					array(
						'id'      => 'shipping_template',
						'label'   => esc_attr__( 'Shipping template', 'apr-core' ),
						'desc'    => esc_attr__( 'Select shipping template that displays on this page.', 'apr-core' ),
						'type'    => 'select',
						'options' => $this->get_post_type_data( 'elementor_library' ),
						'default' => 'default',
					),
					array(
						'id'      => 'related_product',
						'label'   => esc_attr__( 'Hide Related Product', 'apr-core' ),
						'type'    => 'checkbox',
						'default' => '',
						'desc'    => esc_attr__( 'Choose to hide the related product', 'apr-core' ),
					),
					array(
						'id'      => 'upsell_product',
						'label'   => esc_attr__( 'Hide Upsell Product', 'apr-core' ),
						'type'    => 'checkbox',
						'default' => '',
						'desc'    => esc_attr__( 'Choose to hide the upsell product', 'apr-core' ),
					),
					array(
						'id'      => 'position_upsell_related',
						'type'    => 'select',
						'label'   => esc_html__( 'Position Related, Upsell', 'apr-core' ),
						'options' => array(
							'in'  => esc_html__( 'In', 'apr-core' ),
							'out' => esc_html__( 'Out', 'apr-core' ),
						),
						'default' => 'out',
					),
					array(
						'id'      => 'image_product',
						'label'   => esc_attr__( 'Image Product', 'apr-core' ),
						'desc'    => esc_attr__( 'Upload image when you use APR Single Product shortcode on Elementor.', 'apr-core' ),
//						'type'    => 'image',
						'type'             => 'image_advanced',
						'max_file_uploads' => 1,
						'default' => '',
					),
					array(
						'id'      => 'size_guide_image',
						'label'   => esc_attr__( 'Size Guide Image', 'apr-core' ),
//						'type'    => 'image',
						'type'             => 'image_advanced',
						'max_file_uploads' => 1,
						'default' => '',
					),
					array(
						'id'      => 'model_information',
						'label'   => esc_attr__( 'Model Information', 'apr-core' ),
						'type'    => 'editor',
						'default' => '',
					),
					array(
						'id'      => 'sub_title',
						'label'   => esc_attr__( 'Subtitle Product', 'apr-core' ),
						'desc'    => esc_attr__( 'Only works when you use APR Single Product shortcode on Elementor.', 'apr-core' ),
						'type'    => 'text',
						'default' => '',
					),
				),
			),
			$this->general_option(),
			$this->skin_option(),
			$this->header_option(),
			$this->footer_option(),
		);

		return $meta_fields;
	}

	private function get_post_type_data( $post_type = 'elementor_library' ) {

		$data            = array();
		$args            = array(
			'post_type'      => 'elementor_library',
			'posts_per_page' => - 1,
			'post_status'    => 'publish',
		);
		$data['default'] = esc_html__( 'Default', 'apr-core' );
		if ( $posts = get_posts( $args ) ) {
			foreach ( $posts as $post ) {
				/**
				 * @var $post WP_Post
				 */
				$data[$post->post_name] = $post->post_title;
			}
		}

		return $data;
	}
}

if ( class_exists( 'Apr_Core_Product_Metabox' ) ) {
	new Apr_Core_Product_Metabox;
};

