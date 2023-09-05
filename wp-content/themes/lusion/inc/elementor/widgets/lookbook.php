<?php

namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( class_exists( 'WooCommerce' ) ) {
	class Apr_Core_Lookbook extends Widget_Base {
		public function apr_sc_lookbook( $lookbook_layout ) {
			/* Add css */
			if ( is_rtl() ) {
				wp_enqueue_style( 'apr-sc-lookbook', LUSION_CSS . '/elementor/lookbook-rtl.css', array(), LUSION_THEME_VERSION );
			} else {
				wp_enqueue_style( 'apr-sc-lookbook', LUSION_CSS . '/elementor/lookbook.css', array(), LUSION_THEME_VERSION );
			}
			if ( $lookbook_layout !== 'style3' ) {
				wp_register_style( 'fancybox', LUSION_CSS . '/elementor/jquery.fancybox.min.css', array(), LUSION_THEME_VERSION );
				wp_enqueue_style( 'fancybox' );
			}
		}

		public function get_name() {
			return 'apr_lookbook';
		}

		public function get_title() {
			return esc_html__( 'APR Lookbook', 'apr-core' );
		}

		public function get_icon() {
			return 'eicon-eye';
		}

		public function get_categories() {
			return [ 'apr-core' ];
		}

		protected function register_controls() {
			$this->start_controls_section(
				'section_lookbook',
				[
					'label' => esc_html__( 'Contents', 'apr-core' ),
				]
			);
			$this->add_control(
				'section_lookbook_style',
				[
					'label'   => __( 'Lookbook Layout', 'apr-core' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'style1',
					'options' => [
						'style3' => __( 'Text Content', 'apr-core' ),
						'style1' => __( 'Layout 1', 'apr-core' ),
						'style2' => __( 'Layout 2', 'apr-core' ),
					],
				]
			);
			$this->add_control(
				'title_section',
				[
					'label'       => __( 'Title', 'apr-core' ),
					'type'        => Controls_Manager::TEXT,
					'placeholder' => 'Enter title',
					'condition'   => [
						'section_lookbook_style' => [ 'style3' ],
					],
				]
			);
			$this->add_control(
				'lookbook_image',
				[
					'label'     => __( 'Image', 'apr-core' ),
					'type'      => Controls_Manager::MEDIA,
					'default'   => [
						'url' => Utils::get_placeholder_image_src(),
					],
					'condition' => [
						'section_lookbook_style' => [ 'style1' ],
						'section_lookbook_style' => [ 'style3' ],
						'section_lookbook_style' => [ 'style1', 'style3' ],
					],
				]
			);
			$this->add_control(
				'limit_title',
				[
					'label'       => __( 'Limit title', 'apr-core' ),
					'type'        => Controls_Manager::TEXT,
					'placeholder' => 'Enter limit title',
					'description' => __( 'Ex: 45', 'apr-core' ),
					'default'     => 45,
					'condition'   => [
						'section_lookbook_style!' => [ 'style3' ],
					],
				]
			);
			$this->add_control(
				'id_product_parent',
				[
					'label'       => __( 'Product id', 'apr-core' ),
					'type'        => Controls_Manager::SELECT2,
					'options'     => $this->get_products_group_id(),
					'description' => __( 'Please choose Grouped product id.', 'apr-core' ),
					'condition'   => [
						'section_lookbook_style' => [ 'style2' ],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name'      => 'lookbook_image_size',
					'default'   => 'full',
					'separator' => 'none',
					'condition' => [
						'section_lookbook_style' => [ 'style1', 'style3' ],
					],
				]
			);
			$this->add_control(
				'show_custom_image',
				[
					'label'     => __( 'Show Custom Image Size', 'apr-core' ),
					'type'      => Controls_Manager::SWITCHER,
					'label_on'  => __( 'On', 'apr-core' ),
					'label_off' => __( 'Off', 'apr-core' ),
					'default'   => 'Off',
					'condition' => [
						'section_lookbook_style' => [ 'style2' ],
					],
				]
			);
			$this->add_control(
				'custom_dimension_image',
				[
					'label'       => __( 'Image Size', 'apr-core' ),
					'type'        => Controls_Manager::IMAGE_DIMENSIONS,
					'description' => __( 'You can crop the original image size to any custom size. You can also set a single value for height or width in order to keep the original size ratio.', 'apr-core' ),
					'condition'   => [
						'section_lookbook_style' => [ 'style2' ],
						'show_custom_image'      => 'yes',
					],
				]
			);
			$this->add_control(
				'box_background_overlay',
				[
					'label' => __( 'Background Overlay', 'apr-core' ),
					'type'  => Controls_Manager::COLOR,

					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .lookbook-inner:before' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'opacity_images',
				[
					'label'     => __( 'Opacity', 'apr-core' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'max'  => 1,
							'min'  => 0.10,
							'step' => 0.01,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .lookbook-inner:before' => 'opacity: {{SIZE}};',
					],
					'separator' => 'after',
				]
			);

			$lookbook_repeater = new Repeater();
			$lookbook_repeater->add_control(
				'position_content',
				[
					'label'   => __( 'Alignment Content', 'apr-core' ),
					'type'    => Controls_Manager::CHOOSE,
					'options' => [
						'top'    => [
							'title' => __( 'Top', 'apr-core' ),
							'icon'  => 'eicon-v-align-top',
						],
						'right'  => [
							'title' => __( 'Right', 'apr-core' ),
							'icon'  => 'eicon-h-align-right',
						],
						'bottom' => [
							'title' => __( 'Bottom', 'apr-core' ),
							'icon'  => 'eicon-v-align-bottom',
						],
						'left'   => [
							'title' => __( 'Left', 'apr-core' ),
							'icon'  => 'eicon-h-align-left',
						],
					],
					'default' => 'top',
				]
			);
			$lookbook_repeater->add_control(
				'id_product',
				[

					'label'       => __( 'Product id', 'apr-core' ),
					'type'        => Controls_Manager::TEXT,
					'placeholder' => 'Enter product ID',
					'description' => __( 'You can find the id by going to All Products. You then hover on a product ID shown below the product steen', 'apr-core' ),
					'default'     => '',
				]
			);
			$lookbook_repeater->add_responsive_control(
				'box_width',
				[
					'label'      => __( 'Min Width Of The Box', 'apr-core' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 1000,
							'step' => 5,
						],
					],
					'selectors'  => [
						'{{WRAPPER}} {{CURRENT_ITEM}}.repeater-item .product-item .content-product' => 'min-width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$lookbook_repeater->add_responsive_control(
				'images_width',
				[
					'label'      => __( 'Width Of The Image', 'apr-core' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 1000,
							'step' => 5,
						],
					],
					'selectors'  => [
						'{{WRAPPER}} {{CURRENT_ITEM}}.repeater-item .product-item .content-product .images'      => 'width: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} {{CURRENT_ITEM}}.repeater-item .product-item .content-product .title-price' => 'width: calc(100% - {{SIZE}}{{UNIT}});',
					],
				]
			);
			$lookbook_repeater->add_responsive_control(
				'position_left',
				[
					'label'     => __( 'Position On The Left', 'apr-core' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default'   => [
						'size' => 50,
					],
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}}.repeater-item' => 'left: {{SIZE}}%;',
					],
				]
			);
			$lookbook_repeater->add_responsive_control(
				'position_top',
				[
					'label'     => __( 'Position On The Top', 'apr-core' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default'   => [
						'size' => 50,
					],
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}}.repeater-item' => 'top: {{SIZE}}%;',
					],
				]
			);
			$lookbook_repeater->add_control(
				'box_border_color_top',
				[
					'label' => __( 'Border Content Color', 'apr-core' ),
					'type'  => Controls_Manager::COLOR,

					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}}.repeater-item .product-item .content-product'                    => 'border-color: {{VALUE}};',
						'{{WRAPPER}} {{CURRENT_ITEM}}.repeater-item .product-item .content-product .triangular-arrows' => 'border-color: {{VALUE}} transparent transparent transparent;',
					],
					'condition' => [
						'position_content' => 'top',
					],
				]
			);
			$lookbook_repeater->add_control(
				'box_border_color_right',
				[
					'label' => __( 'Border Content Color', 'apr-core' ),
					'type'  => Controls_Manager::COLOR,

					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}}.repeater-item .product-item .content-product'                    => 'border-color: {{VALUE}};',
						'{{WRAPPER}} {{CURRENT_ITEM}}.repeater-item .product-item .content-product .triangular-arrows' => 'border-color: transparent {{VALUE}} transparent transparent;',
					],
					'condition' => [
						'position_content' => 'right',
					],
				]
			);
			$lookbook_repeater->add_control(
				'box_border_color_bottom',
				[
					'label' => __( 'Border Content Color', 'apr-core' ),
					'type'  => Controls_Manager::COLOR,

					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}}.repeater-item .product-item .content-product'                    => 'border-color: {{VALUE}};',
						'{{WRAPPER}} {{CURRENT_ITEM}}.repeater-item .product-item .content-product .triangular-arrows' => 'border-color: transparent transparent {{VALUE}} transparent;',
					],
					'condition' => [
						'position_content' => 'bottom',
					],
				]
			);
			$lookbook_repeater->add_control(
				'box_border_color_left',
				[
					'label' => __( 'Border Content Color', 'apr-core' ),
					'type'  => Controls_Manager::COLOR,

					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}}.repeater-item .product-item .content-product'                    => 'border-color: {{VALUE}};',
						'{{WRAPPER}} {{CURRENT_ITEM}}.repeater-item .product-item .content-product .triangular-arrows' => 'border-color: transparent transparent transparent {{VALUE}};',
					],
					'condition' => [
						'position_content' => 'left',
					],
				]
			);
			$this->add_control(
				'lookbook_repeater',
				[
					'type'        => Controls_Manager::REPEATER,
					'fields'      => $lookbook_repeater->get_controls(),
					'default'     => [
						[
							'id_product'    => __( '', 'apr-core' ),
							'position_left' => __( '', 'apr-core' ),
							'position_top'  => __( '', 'apr-core' ),
						],
					],
					'title_field' => '{{{ id_product }}}',
					'condition'   => [
						'section_lookbook_style!' => [ 'style3' ],
					],
				]
			);

			//Style 3
			$lookbook_repeater_style3 = new Repeater();
			$lookbook_repeater_style3->add_control(
				'location_popup_lookbook',
				[
					'label'   => __( 'Location popup', 'apr-core' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'position-top-left',
					'options' => [
						'position-top-left'     => __( 'Top left', 'apr-core' ),
						'position-top-right'    => __( 'Top right', 'apr-core' ),
						'position-bottom-left'  => __( 'Bottom left', 'apr-core' ),
						'position-bottom-right' => __( 'Bottom right', 'apr-core' ),
					],
				]
			);
			$lookbook_repeater_style3->add_control(
				'title_item',
				[
					'label'       => __( 'Title Item', 'apr-core' ),
					'type'        => Controls_Manager::TEXT,
					'placeholder' => 'Enter title',
				]
			);
			$lookbook_repeater_style3->add_control(
				'description_item',
				[
					'label'       => __( 'Description Item', 'apr-core' ),
					'type'        => Controls_Manager::TEXT,
					'placeholder' => 'Enter description',
				]
			);
			$lookbook_repeater_style3->add_responsive_control(
				'content_item_padding',
				[
					'label'      => __( 'Padding', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} {{CURRENT_ITEM}}.repeater-item .product-item .content-product' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$lookbook_repeater_style3->add_responsive_control(
				'box_width',
				[
					'label'      => __( 'Min Width Of The Box', 'apr-core' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 1000,
							'step' => 5,
						],
					],
					'selectors'  => [
						'{{WRAPPER}} {{CURRENT_ITEM}}.repeater-item .product-item .content-product' => 'min-width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$lookbook_repeater_style3->add_responsive_control(
				'position_left',
				[
					'label'     => __( 'Position On The Left', 'apr-core' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default'   => [
						'size' => 50,
					],
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}}.repeater-item' => 'left: {{SIZE}}%;',
					],
				]
			);
			$lookbook_repeater_style3->add_responsive_control(
				'position_top',
				[
					'label'     => __( 'Position On The Top', 'apr-core' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default'   => [
						'size' => 50,
					],
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}}.repeater-item' => 'top: {{SIZE}}%;',
					],
				]
			);
			$lookbook_repeater_style3->add_control(
				'box_border_color_top',
				[
					'label' => __( 'Border Content Color', 'apr-core' ),
					'type'  => Controls_Manager::COLOR,

					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}}.repeater-item .product-item .content-product'                             => 'border-color: {{VALUE}};',
						'{{WRAPPER}} {{CURRENT_ITEM}}.repeater-item .product-item .content-product.position-bottom-left:after'  => 'background: linear-gradient(180deg, rgba(255, 255, 255, 0) 0%, {{VALUE}} 100%);',
						'{{WRAPPER}} {{CURRENT_ITEM}}.repeater-item .product-item .content-product.position-top-left:after'     => 'background: linear-gradient(90deg,rgba(255,255,255,0) 0,{{VALUE}} 100%);',
						'{{WRAPPER}} {{CURRENT_ITEM}}.repeater-item .product-item .content-product.position-bottom-right:after' => 'background: linear-gradient(0deg,rgba(255,255,255,0) 0,{{VALUE}} 100%);',
						'{{WRAPPER}} {{CURRENT_ITEM}}.repeater-item .product-item .content-product.position-top-right:after'    => 'background: linear-gradient(270deg,rgba(255,255,255,0) 0,{{VALUE}} 100%);',
					],
				]
			);
			$this->add_control(
				'lookbook_repeater_style3',
				[
					'type'        => Controls_Manager::REPEATER,
					'fields'      => $lookbook_repeater_style3->get_controls(),
					'default'     => [
						[
							'title_item'       => __( '', 'apr-core' ),
							'description_item' => __( '', 'apr-core' ),
							'position_left'    => __( '', 'apr-core' ),
							'position_top'     => __( '', 'apr-core' ),
						],
					],
					'title_field' => '{{{ title_item }}}',
					'condition'   => [
						'section_lookbook_style' => [ 'style3' ],
					],
				]
			);
			//end repeater style3

			$this->add_control(
				'hide_add_to_cart',
				[
					'label'     => __( 'Hide Cart', 'apr-core' ),
					'type'      => Controls_Manager::SWITCHER,
					'default'   => 'Yes',
					'condition' => [
						'section_lookbook_style!' => [ 'style3' ],
					],
				]
			);

			$this->add_control(
				'mobile_slider_item',
				[
					'label'     => __( 'Enable slider mobile', 'apr-core' ),
					'type'      => Controls_Manager::SWITCHER,
					'default'   => 'Yes',
					'condition' => [
						'section_lookbook_style' => [ 'style3' ],
					],
				]
			);

			$this->add_control(
				'text_bottom',
				[
					'label'     => __( 'Text Bottom', 'apr-core' ),
					'type'      => Controls_Manager::HEADING,
					'condition' => [
						'section_lookbook_style' => [ 'style3' ],
					],
				]
			);
			$this->add_responsive_control(
				'text_align',
				[
					'label'     => __( 'Alignment', 'apr-core' ),
					'type'      => Controls_Manager::CHOOSE,
					'options'   => [
						'left'    => [
							'title' => __( 'Left', 'apr-core' ),
							'icon'  => 'fa fa-align-left',
						],
						'center'  => [
							'title' => __( 'Center', 'apr-core' ),
							'icon'  => 'fa fa-align-center',
						],
						'right'   => [
							'title' => __( 'Right', 'apr-core' ),
							'icon'  => 'fa fa-align-right',
						],
						'justify' => [
							'title' => __( 'Justified', 'apr-core' ),
							'icon'  => 'fa fa-align-justify',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .content-bottom' => 'text-align: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'description_section',
				[
					'label'       => __( 'Description', 'apr-core' ),
					'type'        => Controls_Manager::TEXT,
					'placeholder' => 'Enter description',
					'condition'   => [
						'section_lookbook_style' => [ 'style3' ],
					],
				]
			);
			$this->add_control(
				'button_text',
				[
					'label'       => __( 'Text Button', 'apr-core' ),
					'type'        => Controls_Manager::TEXT,
					'placeholder' => 'Enter text',
					'dynamic'     => [
						'active' => true,
					],
					'default'     => __( '', 'apr-core' ),
					'condition'   => [
						'section_lookbook_style' => [ 'style3' ],
					],
				]
			);
			$this->add_control(
				'link',
				[
					'label'       => __( 'Link', 'apr-core' ),
					'type'        => Controls_Manager::URL,
					'placeholder' => __( 'https://your-link.com', 'apr-core' ),
					'dynamic'     => [
						'active' => true,
					],
					'default'     => [
						'url' => '',
					],
					'condition'   => [
						'section_lookbook_style' => [ 'style3' ],
					],
				]
			);
			$this->end_controls_section();

			//style

			$this->start_controls_section(
				'title_section_lookbook',
				[
					'label'     => esc_html__( 'Title Section ', 'apr-core' ),
					'tab'       => Controls_Manager::TAB_STYLE,
					'condition' => [
						'section_lookbook_style' => [ 'style3' ],
					],
				]
			);

			$this->add_responsive_control(
				'title_section_align',
				[
					'label'     => __( 'Alignment', 'apr-core' ),
					'type'      => Controls_Manager::CHOOSE,
					'options'   => [
						'left'    => [
							'title' => __( 'Left', 'apr-core' ),
							'icon'  => 'fa fa-align-left',
						],
						'center'  => [
							'title' => __( 'Center', 'apr-core' ),
							'icon'  => 'fa fa-align-center',
						],
						'right'   => [
							'title' => __( 'Right', 'apr-core' ),
							'icon'  => 'fa fa-align-right',
						],
						'justify' => [
							'title' => __( 'Justified', 'apr-core' ),
							'icon'  => 'fa fa-align-justify',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .title-section-lb' => 'text-align: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'title_section_lookbook_typography',
					'label'    => __( 'Typography', 'apr-core' ),
					'selector' => '{{WRAPPER}} .title-section-lb',
				]
			);

			$this->add_control(
				'title_section_lookbook_color',
				[
					'label'     => __( 'Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .title-section-lb' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'title_section_padding',
				[
					'label'      => __( 'Padding', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .title-section-lb' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'title_section_margin',
				[
					'label'      => __( 'Margin', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}}  .title-section-lb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'box_lookbook',
				[
					'label' => esc_html__( 'Box Content', 'apr-core' ),
					'tab'   => Controls_Manager::TAB_STYLE
				]
			);
			$this->add_responsive_control(
				'content_padding_box',
				[
					'label'      => esc_html__( 'Content Padding', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .lookbook-inner .product-item .content-product' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'content__bg_color',
				[
					'label'     => __( 'Background Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .lookbook-inner .repeater-item .product-item .content-product' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'product_title_text',
				[
					'label'     => __( 'Title', 'apr-core' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'section_lookbook_style' => [ 'style3' ],
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'product_title_text_typography',
					'label'     => __( 'Typography', 'apr-core' ),
					'selector'  => '{{WRAPPER}} .lookbook-inner .repeater-item.style3 .content-product h4',
					'condition' => [
						'section_lookbook_style' => [ 'style3' ],
					],
				]
			);

			$this->add_control(
				'product_title_text_color',
				[
					'label'     => __( 'Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .lookbook-inner .repeater-item.style3 .content-product h4' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'product_title_text_bottom_space',
				[
					'label'     => __( 'Spacing', 'apr-core' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'min' => - 100,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .lookbook-inner .repeater-item.style3 .content-product h4' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'product_description_text',
				[
					'label'     => __( 'Description', 'apr-core' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'section_lookbook_style' => [ 'style3' ],
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'product_description_text_typography',
					'label'     => __( 'Typography', 'apr-core' ),
					'selector'  => '{{WRAPPER}} .lookbook-inner .repeater-item.style3 .content-product p',
					'condition' => [
						'section_lookbook_style' => [ 'style3' ],
					],
				]
			);

			$this->add_control(
				'product_description_text_color',
				[
					'label'     => __( 'Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .lookbook-inner .repeater-item.style3 .content-product p' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'product_tags',
				[
					'label'     => __( 'Tags', 'apr-core' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'section_lookbook_style!' => [ 'style3' ],
					],
				]
			);
			$this->add_control(
				'Tags_color',
				[
					'label'     => __( 'Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .lookbook-inner .repeater-item .product-item .product-tooltip .theme-icon-tag-icon' => 'color: {{VALUE}};',
					],
					'condition' => [
						'section_lookbook_style!' => [ 'style3' ],
					],
				]
			);
			$this->add_control(
				'Tags__background_color',
				[
					'label'     => __( 'Background Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .lookbook-inner .repeater-item .product-item .product-tooltip .theme-icon-tag-icon'       => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .lookbook-inner .repeater-item .product-item .product-tooltip .theme-icon-tag-icon:after' => 'border-color: {{VALUE}} transparent transparent transparent;',
					],
					'condition' => [
						'section_lookbook_style!' => [ 'style3' ],
					],
				]
			);
			$this->add_control(
				'product_dots',
				[
					'label'     => __( 'Dots', 'apr-core' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_control(
				'dots_color',
				[
					'label'     => __( 'Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .lookbook-inner .repeater-item .product-item .product-tooltip:after'         => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .lookbook-inner .repeater-item.style3 .product-item .product-tooltip:before' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'border_dots_color',
				[
					'label'     => __( 'Border Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .lookbook-inner .repeater-item .product-item .product-tooltip:before' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'section_lookbook_style' => [ 'style3' ],
					],
				]
			);
			$this->add_control(
				'dots_bg_color',
				[
					'label'     => __( 'Background Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .lookbook-inner .repeater-item .product-item' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->end_controls_section();


			$this->start_controls_section(
				'content_product_parent',
				[
					'label'     => esc_html__( 'Product', 'apr-core' ),
					'tab'       => Controls_Manager::TAB_STYLE,
					'condition' => [
						'section_lookbook_style' => [ 'style2' ],
					],
				]
			);
			$this->add_responsive_control(
				'content_padding_parent',
				[
					'label'      => esc_html__( 'Padding', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .contnet-product-group' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'product_title_parent',
				[
					'label'     => __( 'Title', 'apr-core' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_control(
				'product_title_color_parent',
				[
					'label'     => __( 'Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .contnet-product-group .title a' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'product_title_color_hover_parent',
				[
					'label'     => __( 'Hover Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .contnet-product-group .title a:hover' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'product_title_typography_parent',
					'selector' => '{{WRAPPER}} .contnet-product-group .title a',
				]
			);
			$this->add_responsive_control(
				'title_spacing_parent',
				[
					'label'      => __( 'Spacing', 'apr-core' ),
					'type'       => Controls_Manager::SLIDER,
					'default'    => [
						'size' => '',
						'unit' => 'px',
					],
					'range'      => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'size_units' => [ 'px' ],
					'selectors'  => [
						'{{WRAPPER}} .contnet-product-group .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'product_cart_parent',
				[
					'label'     => __( 'Cart', 'apr-core' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_control(
				'product_cart_color_parent',
				[
					'label'     => __( 'Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .contnet-product-group .action-item.add-cart a' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'product_cart_color_hover_parent',
				[
					'label'     => __( 'Hover Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .contnet-product-group .action-item.add-cart a:hover' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'product_cart_typography_parent',
					'selector' => '{{WRAPPER}} .contnet-product-group .action-item.add-cart a:before',
				]
			);
			$this->add_control(
				'product_wishlist_parent',
				[
					'label'     => __( 'Wishlist', 'apr-core' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_control(
				'product_wishlist_color_parent',
				[
					'label'     => __( 'Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .contnet-product-group div.yith-wcwl-add-to-wishlist .yith-wcwl-add-button a' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'product_wishlist_color_hover_parent',
				[
					'label'     => __( 'Color Hover', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .contnet-product-group div.yith-wcwl-add-to-wishlist .yith-wcwl-add-button a:hover' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'product_wishlist_active_color_parent',
				[
					'label'     => __( 'Added Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .contnet-product-group div.yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a,
                         {{WRAPPER}} .contnet-product-group div.yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'icon_size_parent',
				[
					'label'      => __( 'Size', 'apr-core' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ '%', 'px' ],
					'range'      => [
						'px' => [
							'min' => 6,
							'max' => 100,
						],
					],
					'selectors'  => [
						'{{WRAPPER}} .contnet-product-group div.yith-wcwl-add-to-wishlist .yith-wcwl-add-button a,
                        {{WRAPPER}} .contnet-product-group div.yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a,
                         {{WRAPPER}} .contnet-product-group div.yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a' => 'font-size: {{SIZE}}{{UNIT}} !important;',
					],
				]
			);
			$this->end_controls_section();


			$this->start_controls_section(
				'content_product',
				[
					'label'     => esc_html__( 'Product Lookbook Content', 'apr-core' ),
					'tab'       => Controls_Manager::TAB_STYLE,
					'condition' => [
						'section_lookbook_style!' => [ 'style3' ],
					],
				]
			);
			$this->add_responsive_control(
				'content_padding',
				[
					'label'      => esc_html__( 'Content Padding', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .lookbook-inner .repeater-item .product-item .content-product .title-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'product_image',
				[
					'label'     => __( 'Image', 'apr-core' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'product_image_border',
					'label'    => esc_html__( 'Border', 'apr-core' ),
					'selector' => '{{WRAPPER}} .lookbook-inner .repeater-item .product-item .content-product .images',
				]
			);
			$this->add_control(
				'product_title',
				[
					'label'     => __( 'Title', 'apr-core' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_control(
				'product_title_color',
				[
					'label'     => __( 'Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .lookbook-inner .repeater-item .product-item .content-product .title-price .title a' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'product_title_color_hover',
				[
					'label'     => __( 'Hover Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .lookbook-inner .repeater-item .product-item .content-product .title-price .title a:hover' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'product_title_typography',
					'selector' => '{{WRAPPER}} .lookbook-inner .repeater-item .product-item .content-product .title-price .title a',
				]
			);
			$this->add_responsive_control(
				'title_spacing',
				[
					'label'      => __( 'Spacing', 'apr-core' ),
					'type'       => Controls_Manager::SLIDER,
					'default'    => [
						'size' => '',
						'unit' => 'px',
					],
					'range'      => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'size_units' => [ 'px' ],
					'selectors'  => [
						'{{WRAPPER}} .lookbook-inner .repeater-item .product-item .content-product .title-price .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'product_price',
				[
					'label'     => __( 'Price', 'apr-core' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_control(
				'product_price_color',
				[
					'label'     => __( 'Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .lookbook-inner .repeater-item .product-item .content-product .title-price .price' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'product_price_typography',
					'selector' => '{{WRAPPER}} .lookbook-inner .repeater-item .product-item .content-product .title-price .price',
				]
			);
			$this->add_responsive_control(
				'price_spacing',
				[
					'label'      => __( 'Spacing', 'apr-core' ),
					'type'       => Controls_Manager::SLIDER,
					'default'    => [
						'size' => '',
						'unit' => 'px',
					],
					'range'      => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'size_units' => [ 'px' ],
					'selectors'  => [
						'{{WRAPPER}} .lookbook-inner .repeater-item .product-item .content-product .title-price .price' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'product_cart',
				[
					'label'     => __( 'Cart', 'apr-core' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_control(
				'product_cart_color',
				[
					'label'     => __( 'Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .lookbook-inner .repeater-item .product-item .content-product .title-price .action-item.add-cart a' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'product_cart_color_hover',
				[
					'label'     => __( 'Hover Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .lookbook-inner .repeater-item .product-item .content-product .title-price .action-item.add-cart a:hover' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'product_cart_typography',
					'selector' => '{{WRAPPER}} .lookbook-inner .repeater-item .product-item .content-product .title-price .action-item.add-cart a',
				]
			);
			$this->add_control(
				'btn_get_outfit_parent',
				[
					'label'     => __( 'Button Get the outfit', 'apr-core' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'section_lookbook_style' => [ 'style2' ],
					],
				]
			);
			$this->add_control(
				'btn_get_outfit_color_parent',
				[
					'label'     => __( 'Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .contnet-product-group .button-get-outfit a' => 'color: {{VALUE}};',
					],
					'condition' => [
						'section_lookbook_style' => [ 'style2' ],
					],
				]
			);
			$this->add_control(
				'btn_get_outfit_color_hover_parent',
				[
					'label'     => __( 'Hover Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .contnet-product-group .button-get-outfit a:hover'   => 'color: {{VALUE}};',
						'{{WRAPPER}} .contnet-product-group .button-get-outfit a:hover i' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'section_lookbook_style' => [ 'style2' ],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'btn_get_outfit_typography_parent',
					'selector'  => '{{WRAPPER}} .contnet-product-group .button-get-outfit a',
					'condition' => [
						'section_lookbook_style' => [ 'style2' ],
					],
				]
			);
			$this->add_control(
				'product_wishlist',
				[
					'label'     => __( 'Wishlist', 'apr-core' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'section_lookbook_style' => [ 'style1' ],
					],
				]
			);
			$this->add_control(
				'product_wishlist_color',
				[
					'label'     => __( 'Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .lookbook-inner .repeater-item .product-item .content-product .images div.yith-wcwl-add-to-wishlist .yith-wcwl-add-button a' => 'color: {{VALUE}};',
					],
					'condition' => [
						'section_lookbook_style' => [ 'style1' ],
					],
				]
			);
			$this->add_control(
				'product_wishlist_active_color',
				[
					'label'     => __( 'Added Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .lookbook-inner .repeater-item .product-item .content-product .images div.yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a,
                         {{WRAPPER}} .lookbook-inner .repeater-item .product-item .content-product .images div.yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a' => 'color: {{VALUE}};',
					],
					'condition' => [
						'section_lookbook_style' => [ 'style1' ],
					],

				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'text_bottom_lookbook',
				[
					'label'     => esc_html__( 'Text Bottom', 'apr-core' ),
					'tab'       => Controls_Manager::TAB_STYLE,
					'condition' => [
						'section_lookbook_style' => [ 'style3' ],
					],
				]
			);

			$this->add_control(
				'text_bottom_heading',
				[
					'type'      => Controls_Manager::HEADING,
					'label'     => esc_html__( 'Text', 'apr-core' ),
					'separator' => 'before',
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'text_bottom_lookbook_typography',
					'label'    => __( 'Typography', 'apr-core' ),
					'selector' => '{{WRAPPER}} .content-bottom .description',
				]
			);

			$this->add_control(
				'text_bottom_lookbook_color',
				[
					'label'     => __( 'Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .content-bottom .description' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'text_bottom_padding',
				[
					'label'      => __( 'Padding', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .content-bottom .description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'text_bottom_margin',
				[
					'label'      => __( 'Margin', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .content-bottom .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'text_bottom_btn',
				[
					'type'      => Controls_Manager::HEADING,
					'label'     => esc_html__( 'Buttom', 'apr-core' ),
					'separator' => 'before',
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'text_bottom_btn_typography',
					'selector' => '{{WRAPPER}} .content-bottom .button-bottom a',
				]
			);

			$this->start_controls_tabs( 'button_tabs' );

			$this->start_controls_tab( 'normal', [ 'label' => __( 'Normal', 'apr-core' ) ] );

			$this->add_control(
				'button_text_color',
				[
					'label'     => __( 'Button Text Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .content-bottom .button-bottom a' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'button_background_color',
				[
					'label'     => __( 'Background Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .content-bottom .button-bottom a' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'button_border_color',
				[
					'label'     => __( 'Border Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .content-bottom .button-bottom a' => 'border-color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab( 'hover', [ 'label' => __( 'Hover', 'apr-core' ) ] );

			$this->add_control(
				'button_hover_text_color',
				[
					'label'     => __( 'Text Hover Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .content-bottom .button-bottom a:hover' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'button_hover_background_color',
				[
					'label'     => __( 'Background Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .content-bottom .button-bottom a:hover' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'button_hover_border_color',
				[
					'label'     => __( 'Border Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .content-bottom .button-bottom a:hover' => 'border-color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_responsive_control(
				'text_bottom_btn_padding',
				[
					'label'      => esc_html__( 'Padding', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .content-bottom .button-bottom a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'text_bottom_btn_margin',
				[
					'label'      => esc_html__( 'Padding', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .content-bottom .button-bottom a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'style_dots_lookbook',
				[
					'label'     => esc_html__( 'Dots', 'apr-core' ),
					'tab'       => Controls_Manager::TAB_STYLE,
					'condition' => [
						'section_lookbook_style' => [ 'style3' ],
						'mobile_slider_item'     => 'yes',
					],
				]
			);

			$this->add_control(
				'style_dots__background_color',
				[
					'label'     => __( 'Background Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .slick-dots li button' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'style_dots__background_color_active',
				[
					'label'     => __( 'Active Background Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .slick-dots li.slick-active button' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_section();
		}

		protected function get_products_group_id() {
			$results  = [];
			$args     = array(
				'post_type'      => 'product',
				'posts_per_page' => - 1,
				'post_status'    => 'publish',
				'tax_query'      => array(
					array(
						'taxonomy'         => 'product_type',
						'field'            => 'slug',
						'terms'            => 'grouped',
						'include_children' => false,
					),
				),
			);
			$products = get_posts( $args );
			foreach ( $products as $product ) {
				$results[$product->ID] = $product->post_title;
			}

			return $results;
		}

		protected function render() {
			$settings        = $this->get_settings_for_display();
			$lookbook_layout = $settings['section_lookbook_style'];
			$this->apr_sc_lookbook( $lookbook_layout );
			$limit_title       = $settings['limit_title'];
			$hide_cart         = $settings['hide_add_to_cart'];
			$show_custom_image = $settings['show_custom_image'];
			$custom_dimension  = $settings['custom_dimension_image'];
			$is_rtl            = is_rtl();
			if ( empty( $settings['lookbook_repeater'] ) && empty( $settings['lookbook_repeater_style3'] ) ) {
				return;
			}
			$lookbook_id = wp_rand();
			if ( $lookbook_layout !== 'style3' ) {
				/* Import js */
				wp_register_script( 'fancybox', LUSION_JS . '/elementor/jquery.fancybox.min.js', array() );
				wp_enqueue_script( 'fancybox' );
			}
			?>
			<?php if ( $lookbook_layout === 'style3' && $settings['title_section'] ):
				echo '<h3 class="title-section-lb">' . $settings['title_section'] . '</h3>';
			endif; ?>
			<div
				class="lookbook-inner lookbook-inner-<?php echo $lookbook_id; ?> <?php if ( $settings['mobile_slider_item'] ) {
					echo 'mobile_slider_item';
				} ?>">
				<?php
				if ( $lookbook_layout === 'style1' || $lookbook_layout === 'style3' ):
					echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'lookbook_image_size', 'lookbook_image' );
				endif;
				if ( $lookbook_layout === 'style2' ):
					if ( $show_custom_image === 'yes' ) {
						$has_custom_size = false;
						if ( ! empty( $custom_dimension['width'] ) ) {
							$has_custom_size    = true;
							$attachment_size[0] = $custom_dimension['width'];
						}

						if ( ! empty( $custom_dimension['height'] ) ) {
							$has_custom_size    = true;
							$attachment_size[1] = $custom_dimension['height'];
						}

						if ( ! $has_custom_size ) {
							$attachment_size = 'full';
						}
					} else {
						$attachment_size = 'full';
					}
					echo get_the_post_thumbnail($settings['id_product_parent'],array($attachment_size[0], $attachment_size[1]), array(
						'alt'  =>  get_the_title( $settings['id_product_parent'] )
					));
				endif;
				if ( $lookbook_layout !== 'style3' ):
					foreach ( $settings['lookbook_repeater'] as $key => $lookbook ) :
						$product = wc_get_product( $lookbook['id_product'] );
						$lookbook_id_poppup = wp_rand();
						?>
						<div class="repeater-item elementor-repeater-item-<?php echo $lookbook['_id']; ?>">
							<div class="product-item">
								<div class="product-tooltip">
									<span class="theme-icon-tag-icon"></span>
								</div>
								<?php if ( $product ): ?>
									<div class="content-product <?php echo $lookbook['position_content']; ?>"
										 id="content-product-<?php echo $lookbook_id_poppup; ?>">
										<div class="images">
											<a href="<?php echo get_permalink( $lookbook['id_product'] ); ?>">
												<?php
												echo get_the_post_thumbnail($lookbook['id_product'],array(290,390), array(
													'alt'  =>  get_the_title(  $lookbook['id_product'] )
												));
												?>
											</a>
											<?php
											if ( class_exists( 'YITH_WCWL' ) && $lookbook_layout === 'style1' ):
												echo( do_shortcode( '[yith_wcwl_add_to_wishlist product_id="' . $lookbook['id_product'] . '"]' ) );
											endif;
											?>
										</div>
										<div class="title-price">
											<h3 class="title">
												<a href="<?php echo get_permalink( $lookbook['id_product'] ); ?>">
													<?php
													$tit = get_the_title( $lookbook['id_product'] );
													echo substr( $tit, 0, $limit_title );
													if ( strlen( $tit ) > $limit_title ) {
														echo esc_html__( '...', 'lusion' );
													}
													?>

												</a>
											</h3>
											<span class="price"><?php echo $product->get_price_html(); ?></span>
											<?php
											if ( $hide_cart !== 'yes' ):
												echo( do_shortcode( '[add_to_cart show_price="false" id="' . $lookbook['id_product'] . '"]' ) );
											endif;
											?>
										</div>
										<span
											class="triangular-arrows <?php echo $lookbook['position_content']; ?>"></span>
									</div>
									<a data-fancybox data-width="500" data-height="700"
									   href="#content-product-<?php echo $lookbook_id_poppup; ?>"
									   class="poppup-lookbook"><?php echo esc_html__( 'Poppup', 'apr-core' ); ?></a>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach;
				else:
					echo '<div class="content-group-lookbook">';
					foreach ( $settings['lookbook_repeater_style3'] as $key => $lookbook ) :
						?>
						<div class="repeater-item elementor-repeater-item-<?php echo $lookbook['_id'];
						echo " " . $lookbook_layout; ?> ">
							<div class="product-item active">
								<div class="product-tooltip"></div>
								<?php if ( $lookbook_layout === 'style3' ) { ?>
									<div class="content-product <?php echo $lookbook['location_popup_lookbook']; ?>">
										<?php if ( $lookbook['title_item'] ) {
											echo '<h4>' . $lookbook['title_item'] . '</h4>';
										} ?>
										<?php if ( $lookbook['description_item'] ) {
											echo '<p>' . $lookbook['description_item'] . '</p>';
										} ?>
									</div>
								<?php } ?>
							</div>
						</div>
					<?php endforeach;
					echo '</div>';
				endif;
				?>
			</div>
			<?php if ( $lookbook_layout === 'style2' ): ?>
				<div class="contnet-product-group">
					<h3 class="title"><a href="<?php echo get_permalink( $settings['id_product_parent'] ); ?>">
							<?php echo get_the_title( $settings['id_product_parent'] ); ?>
						</a></h3>
					<div class="button-get-outfit"><a
							href="<?php echo get_permalink( $settings['id_product_parent'] ); ?>">
							<?php echo esc_html__( 'Get the outfit now', 'apr-core' ); ?> <i
								class="fas fa-play"></i></a>
					</div>
					<?php
					if ( class_exists( 'YITH_WCWL' ) ):
						echo( do_shortcode( '[yith_wcwl_add_to_wishlist product_id="' . $settings['id_product_parent'] . '"]' ) );
					endif;
					?>
				</div>
			<?php endif; ?>
			<?php if ( $lookbook_layout === 'style3' && $settings['description_section'] ):
				$button_text = $settings['button_text'];
				$link    = '';
				if ( ! empty( $settings['link']['url'] ) ) {
					$this->add_render_attribute( 'url', 'href', $settings['link']['url'] );

					if ( $settings['link']['is_external'] ) {
						$this->add_render_attribute( 'url', 'target', '_blank' );
					}

					if ( ! empty( $settings['link']['nofollow'] ) ) {
						$this->add_render_attribute( 'url', 'rel', 'nofollow' );
					}
					$link = $this->get_render_attribute_string( 'url' );
				}
				?>
				<div class="content-bottom">
					<?php if ( $settings['description_section'] ) {
						echo '<p class="description">' . $settings['description_section'] . '</p>';
					}
					if ( $button_text != '' ) {
						?>
						<div class="button-bottom">
							<a <?php if ( $link != '' ) {
								echo $link;
							} else {
								echo 'href="#"';
							} ?> class="btn-lb"><?php echo $button_text; ?></a>
						</div>

					<?php } ?>
				</div>
			<?php endif; ?>
			<script>
				jQuery(document).ready(function ($) {
					<?php if ($lookbook_layout !== 'style3') :?>
					$('.lookbook-inner-<?php echo $lookbook_id ?> .product-item').mouseover(function () {
						var lookbook_inner_width = $('.lookbook-inner-<?php echo $lookbook_id ?>').width();
						var lookbookinner = $('.lookbook-inner-<?php echo $lookbook_id ?> .product-item').width();
						var lookbookWidth = $(this).children('.content-product').width();
						var offsetLookbookInner = $('.lookbook-inner-<?php echo $lookbook_id ?>').offset().left;
						var offsetProductItem = $(this).offset().left;
						var widthcontentproducthalf = (lookbookWidth / 2 - lookbookinner / 2) + 15;
						if (widthcontentproducthalf >= (offsetProductItem - offsetLookbookInner)) {
							var widthcontentproducthalf_left = widthcontentproducthalf - (offsetProductItem - offsetLookbookInner);
							$(this).children('.content-product:not(.right):not(.left)').css({
								'left'            : 'calc(50% + ' + widthcontentproducthalf_left + 'px',
								'transform-origin': +(widthcontentproducthalf_left * (-1)) + 'px 100%'
							});
							$(this).children('.content-product:not(.right):not(.left)').children('.triangular-arrows').css('left', 'calc(50% - ' + widthcontentproducthalf_left + 'px');
						} else {
							var widthRight = (offsetLookbookInner + lookbook_inner_width) - (offsetProductItem + lookbookinner);
							if (widthcontentproducthalf >= widthRight) {
								var widthcontentproducthalf_right = widthcontentproducthalf - widthRight;
								$(this).children('.content-product:not(.right):not(.left)').css({
									'left'            : 'calc(50% - ' + widthcontentproducthalf_right + 'px',
									'transform-origin': +widthcontentproducthalf_right + 'px 100%'
								});
								$(this).children('.content-product:not(.right):not(.left)').children('.triangular-arrows').css('left', 'calc(50% + ' + widthcontentproducthalf_right + 'px');
							} else {
								$(this).children('.content-product').removeAttr('style');
								$(this).children('.content-product').children('.triangular-arrows').removeAttr('style');
							}
						}
					});
					<?php endif; ?>
					<?php if ($lookbook_layout === 'style3') :?>
					function closeContent() {
						var $parent = $('.lookbook-inner-<?php echo $lookbook_id ?>');
						$parent.on('click', '.product-item', function (e) {
							e.preventDefault();
							if ($(this).hasClass('active')) {
								$(this).removeClass('active');
							} else {
								$(this).addClass('active');
							}
						});
					}

					closeContent();
					<?php if ($settings['mobile_slider_item']) :?>
					function sliderLooklookMobile() {
						var wdw = $(window).width();
						if (wdw < 1025) {
							$('.lookbook-inner-<?php echo $lookbook_id ?> .content-group-lookbook').not('.slick-initialized').slick({
								slidesToShow  : 1,
								slidesToScroll: 1,
								arrows        : false,
								dots          : true,
								rtl           : <?php echo $is_rtl ? 'true' : 'false';?>,
							});
						} else {
							$('.lookbook-inner-<?php echo $lookbook_id ?> .content-group-lookbook').filter('.slick-initialized').slick('unslick');
						}
					}

					sliderLooklookMobile();
					$(window).resize(function () {
						sliderLooklookMobile();
					});
					<?php endif; ?>
					<?php endif; ?>
				});
			</script>
			<?php
		}
	}

	Plugin::instance()->widgets_manager->register( new Apr_Core_Lookbook );
}
