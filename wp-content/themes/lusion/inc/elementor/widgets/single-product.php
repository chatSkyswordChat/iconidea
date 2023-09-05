<?php

namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if ( ! apr_is_woocommerce_activated() ) {
	return;
}
/**
 * Elementor Single product.
 *
 * @since 1.0.0
 */
if ( class_exists( 'WooCommerce' ) ) {
	class Apr_Core_Single_Product extends Widget_Base {

		public function apr_sc_single_product() {
			/* Import Css */
			if ( is_rtl() ) {
				wp_enqueue_style( 'apr-sc-single-product', LUSION_CSS . '/elementor/single-product-rtl.css', array(), LUSION_THEME_VERSION );
			} else {
				wp_enqueue_style( 'apr-sc-single-product', LUSION_CSS . '/elementor/single-product.css', array(), LUSION_THEME_VERSION );
			}
		}

		public function get_categories() {
			return array( 'apr-core' );
		}

		public function get_name() {
			return 'apr-single-product';
		}

		public function get_title() {
			return __( 'APR Single Product', 'apr-core' );
		}

		public function get_icon() {
			return 'eicon-woocommerce';
		}

		protected function register_controls() {

			$this->start_controls_section(
				'section_setting',
				[
					'label' => __( 'Settings', 'apr-core' ),
					'tab'   => Controls_Manager::TAB_CONTENT,
				]
			);
			$repeater = new Repeater();
			$repeater->add_control(
				'id_product',
				[

					'label'       => __( 'Product id', 'apr-core' ),
					'type'        => Controls_Manager::TEXT,
					'placeholder' => 'Enter product ID',
					'description' => __( 'You can find the id by going to All Products. You then hover on a product ID shown below the product steen', 'apr-core' ),
					'default'     => '',
				]
			);
			$this->add_control(
				'slides',
				[
					'type'        => Controls_Manager::REPEATER,
					'fields'      => $repeater->get_controls(),
					'default'     => [
						[
							'id_product' => __( '', 'apr-core' ),
						],
					],
					'title_field' => '{{{ id_product }}}',
				]
			);
			$this->add_control(
				'single_type',
				array(
					'label'   => __( 'Type', 'apr-core' ),
					'type'    => Controls_Manager::SELECT,
					'options' => array(
						'3' => __( 'Get Content Product', 'apr-core' ),
						'1' => __( 'Style 1', 'apr-core' ),
						'2' => __( 'Style 2', 'apr-core' ),
						'3' => __( 'Get Content Product', 'apr-core' ),
					),
					'default' => '1',
				)
			);
			$this->add_control(
				'show_title',
				[
					'label'        => __( 'Hide Title', 'apr-core' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => '',
					'return_value' => 'none',
					'selectors'    => [
						'{{WRAPPER}} .woocommerce-loop-product__title' => 'display: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'hide_cate',
				[
					'label'        => __( 'Hide Category', 'apr-core' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => '',
					'return_value' => 'none',
					'selectors'    => [
						'{{WRAPPER}} .cate-product' => 'display: {{VALUE}};',
					],
					'condition'    => [
						'single_type!' => '3',
					]
				]
			);
			$this->add_control(
				'show_price',
				[
					'label'        => __( 'Hide Price', 'apr-core' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => '',
					'return_value' => 'none',
					'selectors'    => [
						'{{WRAPPER}} .price .amount' => 'display: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'show_description',
				[
					'label'        => __( 'Hide Description', 'apr-core' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => '',
					'return_value' => 'none',
					'selectors'    => [
						'{{WRAPPER}} .woocommerce-product-details__short-description' => 'display: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'show_add_to_cart',
				[
					'label'        => __( 'Hide Add to cart', 'apr-core' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'yes',
					'return_value' => 'none',
					'selectors'    => [
						'{{WRAPPER}} form.cart' => 'display: {{VALUE}} !important;',
					],
				]
			);
			$this->add_control(
				'show_wishlist',
				[
					'label'   => __( 'Show Wishlist', 'apr-core' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'no',
				]
			);
			$this->add_control(
				'show_compare',
				[
					'label'   => __( 'Show Compare', 'apr-core' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'no',
				]
			);
			$this->add_responsive_control(
				'align',
				[
					'label'        => __( 'Text Alignment', 'apr-core' ),
					'type'         => Controls_Manager::CHOOSE,
					'options'      => [
						'left'   => [
							'title' => __( 'Left', 'apr-core' ),
							'icon'  => 'fa fa-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'apr-core' ),
							'icon'  => 'fa fa-align-center',
						],
						'right'  => [
							'title' => __( 'Right', 'apr-core' ),
							'icon'  => 'fa fa-align-right',
						],
					],
					'default'      => 'left',
					'prefix_class' => 'elementor-align-',
					'selectors'    => [
						'{{WRAPPER}} .single-product div.product .entry-summary' => 'text-align: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'show_custom_image',
				[
					'label'   => __( 'Show Custom Image Size', 'apr-core' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'no',
				]
			);
			$this->add_control(
				'custom_dimension',
				[
					'label'       => __( 'Image Size', 'apr-core' ),
					'type'        => Controls_Manager::IMAGE_DIMENSIONS,
					'description' => __( 'You can crop the original image size to any custom size. You can also set a single value for height or width in order to keep the original size ratio.', 'apr-core' ),
					'condition'   => [
						'show_custom_image' => 'yes',
					],
				]
			);
			$this->add_control(
				'show_slider',
				[
					'label'     => __( 'Slider', 'apr-core' ),
					'type'      => Controls_Manager::SWITCHER,
					'label_on'  => __( 'On', 'apr-core' ),
					'label_off' => __( 'Off', 'apr-core' ),
					'default'   => 'no',
					'condition' => [
						'single_type!' => '3',
					]
				]
			);
			$this->end_controls_section();
			$this->start_controls_section(
				'section_slider_options',
				[
					'label'     => __( 'Slider Options', 'apr-core' ),
					'type'      => Controls_Manager::SECTION,
					'condition' => [
						'show_slider' => 'yes',
					],
				]
			);
			$this->add_responsive_control(
				'navigation',
				[
					'label'           => __( 'Navigation', 'apr-core' ),
					'type'            => Controls_Manager::SELECT,
					'options'         => [
						'arrows' => __( 'Arrows', 'apr-core' ),
						'none'   => __( 'None', 'apr-core' ),
					],
					'devices'         => [ 'desktop', 'tablet', 'mobile' ],
					'desktop_default' => 'none',
					'tablet_default'  => 'none',
					'mobile_default'  => 'arrows',
				]
			);
			$this->add_control(
				'pause_on_hover',
				[
					'label'   => __( 'Pause on Hover', 'apr-core' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
				]
			);
			$this->add_control(
				'autoplay',
				[
					'label'   => __( 'Autoplay', 'apr-core' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'none',
				]
			);
			$this->add_control(
				'autoplay_speed',
				[
					'label'     => __( 'Autoplay Speed', 'apr-core' ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => 5000,
					'condition' => [
						'autoplay' => 'yes',
					],
				]
			);
			$this->add_control(
				'infinite',
				[
					'label'   => __( 'Infinite Loop', 'apr-core' ),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
				]
			);
			$this->add_control(
				'transition_speed',
				[
					'label'   => __( 'Transition Speed (ms)', 'apr-core' ),
					'type'    => Controls_Manager::NUMBER,
					'default' => 500,
				]
			);
			$this->end_controls_section();
			$this->start_controls_section(
				'cate_style',
				[
					'label'     => __( 'Category', 'apr-core' ),
					'tab'       => Controls_Manager::TAB_STYLE,
					'condition' => [
						'hide_cate' => '',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'cate_typography',

					'selector' => '{{WRAPPER}} .cate-product a',
				]
			);

			$this->add_control(
				'cate_color',
				[
					'label'     => __( 'Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .cate-product a' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'cate_color_hover',
				[
					'label'     => __( 'Color hover', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .cate-product a:hover' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'cate_padding',
				[
					'label'      => __( 'Padding', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .cate-product' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'  => 'before',
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'subtitle_style',
				[
					'label' => __( 'Subtitle', 'apr-core' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'subtitle_typography',

					'selector' => '{{WRAPPER}} .single-product .subtitle-product-sc h5',
				]
			);

			$this->add_control(
				'subtitle_color',
				[
					'label'     => __( 'Subtitle Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .single-product .subtitle-product-sc h5' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'bg_subtitle_color_sale',
				[
					'label'     => __( 'Background Color Sale Image', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .single-product .product-detail .sale_perc' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'section_style',
				[
					'label'     => __( 'Title', 'apr-core' ),
					'tab'       => Controls_Manager::TAB_STYLE,
					'condition' => [
						'show_title' => '',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',

					'selector' => '{{WRAPPER}} .single-product .woocommerce-loop-product__title, {{WRAPPER}} .product_title',

				]
			);

			$this->add_control(
				'title_color',
				[
					'label'     => __( 'Title Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .single-product .woocommerce-loop-product__title, {{WRAPPER}} .product_title'
						=> 'color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'title_padding',
				[
					'label'      => __( 'Padding', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .single-product .woocommerce-loop-product__title, {{WRAPPER}} .product_title'
						=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'  => 'before',
				]
			);

			$this->add_responsive_control(
				'title_margin',
				[
					'label'      => __( 'Margin', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .single-product .woocommerce-loop-product__title',
						'{{WRAPPER}} .product_title'
						=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'  => 'before',
				]
			);

			$this->end_controls_section();
			$this->start_controls_section(
				'section_style_image',
				[
					'label'     => __( 'Image', 'apr-core' ),
					'tab'       => Controls_Manager::TAB_STYLE,
					'condition' => [
						'single_type!' => '3',
					]
				]
			);
			$this->add_responsive_control(
				'image_padding',
				[
					'label'      => __( 'Padding', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .single-product .image-product-sc'

						=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'  => 'before',
				]
			);

			$this->add_responsive_control(
				'image_margin',
				[
					'label'      => __( 'Margin', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .single-product .image-product-sc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'  => 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'      => 'image_border',
					'selector'  => '{{WRAPPER}} .image-product-sc',
					'separator' => 'before',
				]
			);
			$this->end_controls_section();
			$this->start_controls_section(
				'section_style_desc',
				[
					'label'     => __( 'Description', 'apr-core' ),
					'tab'       => Controls_Manager::TAB_STYLE,
					'condition' => [
						'show_description' => '',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'desc_typography',
					'selector' => '{{WRAPPER}} .single-product div.product .woocommerce-product-details__short-description p, {{WRAPPER}} .content-product-description',
				]
			);

			$this->add_control(
				'desc_color',
				[
					'label'     => __( 'Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .single-product div.product .woocommerce-product-details__short-description p, {{WRAPPER}} .content-product-description'
						=> 'color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'desc_width',
				array(
					'label'      => __( 'Max width', 'apr-core' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => array( 'px', '%' ),
					'range'      => array(
						'%'  => array(
							'min' => 1,
							'max' => 100,
						),
						'px' => array(
							'min'  => 1,
							'max'  => 1600,
							'step' => 5
						)
					),
					'selectors'  => array(
						'{{WRAPPER}} .woocommerce div.entry-summary .woocommerce-product-details__short-description, {{WRAPPER}} .content-product-description'
						=> 'max-width:{{SIZE}}{{UNIT}};'
					),
				)
			);
			$this->add_responsive_control(
				'desc_padding',
				[
					'label'      => __( 'Padding', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .single-product div.product .woocommerce-product-details__short-description, {{WRAPPER}} .content-product-description'
						=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					],
					'separator'  => 'before',
				]
			);

			$this->add_responsive_control(
				'desc_margin',
				[
					'label'      => __( 'Margin', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .elementor-single-product .product-detail-summary .woocommerce-product-details__short-description',
						'{{WRAPPER}} .content-product-description'
						=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
					],
					'separator'  => 'before',
				]
			);

			$this->end_controls_section();
			$this->start_controls_section(
				'section_style_price',
				[
					'label'     => __( 'Price', 'apr-core' ),
					'tab'       => Controls_Manager::TAB_STYLE,
					'condition' => [
						'show_price' => '',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'price_typography',

					'selector' => '{{WRAPPER}} .single-product div.product .summary .price, {{WRAPPER}} .woocommerce div.entry-summary p.price del, {{WRAPPER}} .price, {{WRAPPER}} p.price del',
				]
			);

			$this->add_control(
				'price_color',
				[
					'label'     => __( 'Price Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .single-product div.product .summary .price, {{WRAPPER}} .single-product div.product .summary .price del, {{WRAPPER}} .price, {{WRAPPER}} .price del'
						=> 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'  => 'sale-price_typography',
					'label' => __( 'Typography Sale Price', 'apr-core' ),

					'selector' => '{{WRAPPER}} .single-product div.product .summary .price ins .amount, {{WRAPPER}} .price ins .amount',
				]
			);

			$this->add_control(
				'sale_price_color',
				[
					'label'     => __( 'Color Sale Price', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .single-product div.product .summary .price ins .amount, {{WRAPPER}} .price ins .amount'
						=> 'color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'price_padding',
				[
					'label'      => __( 'Padding', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .single-product div.product .summary .price, {{WRAPPER}} .price'
						=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'  => 'before',
				]
			);

			$this->add_responsive_control(
				'price_margin',
				[
					'label'      => __( 'Margin', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .single-product div.product .summary .price, {{WRAPPER}} .price'
						=> 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'  => 'before',
				]
			);

			$this->end_controls_section();

			// Button add to cart
			$this->start_controls_section(
				'section_style_button_cart',
				[
					'label'     => __( 'Button Add to cart', 'apr-core' ),
					'tab'       => Controls_Manager::TAB_STYLE,
					'condition' => [
						'show_add_to_cart' => '',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'typography_cart',
					'selector' => '{{WRAPPER}} .woocommerce div.entry-summary form.cart button[type=submit], {{WRAPPER}} .add_to_cart_button',
				]
			);

			$this->start_controls_tabs( 'tabs_button_style_cart' );

			$this->start_controls_tab(
				'tab_button_normal_cart',
				[
					'label' => __( 'Normal', 'apr-core' ),
				]
			);

			$this->add_control(
				'button_text_color_cart',
				[
					'label'     => __( 'Text Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .woocommerce div.entry-summary form.cart button[type=submit], {{WRAPPER}} .add_to_cart_button'
						=> 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'button_bg_color_cart',
				[
					'label'     => __( 'Background Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .woocommerce div.entry-summary form.cart button[type=submit], {{WRAPPER}} .add_to_cart_button'
						=> 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        => 'border_cart',
					'placeholder' => '1px',
					'default'     => '1px',
					'selector'    => '{{WRAPPER}} .woocommerce div.entry-summary form.cart button[type=submit], {{WRAPPER}} .add_to_cart_button ',
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_button_cart_hover',
				[
					'label' => __( 'Hover', 'apr-core' ),
				]
			);

			$this->add_control(
				'hover_color_cart',
				[
					'label'     => __( 'Text Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .woocommerce div.entry-summary form.cart button[type=submit]:hover, {{WRAPPER}} .add_to_cart_button:hover'
						=> 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'button_cart_bg_color_hover',
				[
					'label'     => __( 'Background Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .woocommerce div.entry-summary form.cart button[type=submit]:hover, {{WRAPPER}} .add_to_cart_button:hover'
						=> 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        => 'border_cart_hover',
					'placeholder' => '1px',
					'default'     => '1px',
					'selector'    => '{{WRAPPER}} .woocommerce div.entry-summary form.cart button[type=submit]:hover, {{WRAPPER}} .add_to_cart_button:hover',
				]
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_control(
				'border_cart_radius',
				[
					'label'      => __( 'Border Radius', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'separator'  => 'before',
					'selectors'  => [
						'{{WRAPPER}} .woocommerce div.entry-summary form.cart button[type=submit], {{WRAPPER}} .add_to_cart_button'
						=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'text_cart_padding',
				[
					'label'      => __( 'Padding', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .woocommerce div.entry-summary form.cart button[type=submit], {{WRAPPER}} .add_to_cart_button'
						=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'  => 'before',
				]
			);

			$this->end_controls_section();

			// Button Wishlist
			$this->start_controls_section(
				'section_style_button_wishlist',
				[
					'label'     => __( 'Button Wishlist', 'apr-core' ),
					'tab'       => Controls_Manager::TAB_STYLE,
					'condition' => [
						'show_wishlist' => 'yes',
					],
				]
			);

			$this->add_responsive_control(
				'button_wishlist_width',
				array(
					'label'      => __( 'Size', 'apr-core' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => array( 'px', '%' ),
					'range'      => array(
						'%'  => array(
							'min' => 1,
							'max' => 100,
						),
						'px' => array(
							'min'  => 1,
							'max'  => 1600,
							'step' => 5
						)
					),
					'selectors'  => array(
						'{{WRAPPER}} .elementor-single-product.single-style-3 .yith-wcwl-add-to-wishlist a'
						=> 'font-size:{{SIZE}}{{UNIT}};'
					),
				)
			);

			$this->start_controls_tabs( 'tabs_button_style_wishlist' );

			$this->start_controls_tab(
				'tab_button_normal_wishlist',
				[
					'label' => __( 'Normal', 'apr-core' ),
				]
			);

			$this->add_control(
				'button_text_color_wishlist',
				[
					'label'     => __( 'Text Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .elementor-single-product.single-style-3 .yith-wcwl-add-to-wishlist a'
						=> 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'button_bg_color_wishlist',
				[
					'label'     => __( 'Background Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .elementor-single-product.single-style-3 .yith-wcwl-add-to-wishlist a'
						=> 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        => 'border_wishlist',
					'placeholder' => '1px',
					'default'     => '1px',
					'selector'    => '{{WRAPPER}} .elementor-single-product.single-style-3 .yith-wcwl-add-to-wishlist a',
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_button_wishlist_hover',
				[
					'label' => __( 'Hover', 'apr-core' ),
				]
			);

			$this->add_control(
				'hover_color_wishlist',
				[
					'label'     => __( 'Text Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .elementor-single-product.single-style-3 .yith-wcwl-add-to-wishlist a:hover'
						=> 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'button_wishlist_bg_color_hover',
				[
					'label'     => __( 'Background Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .elementor-single-product.single-style-3 .yith-wcwl-add-to-wishlist a:hover'
						=> 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        => 'border_wishlist_hover',
					'placeholder' => '1px',
					'default'     => '1px',
					'selector'    => '{{WRAPPER}} .elementor-single-product.single-style-3 .yith-wcwl-add-to-wishlist a:hover',
				]
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_control(
				'border_wishlist_radius',
				[
					'label'      => __( 'Border Radius', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'separator'  => 'before',
					'selectors'  => [
						'{{WRAPPER}} .elementor-single-product.single-style-3 .yith-wcwl-add-to-wishlist a'
						=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'text_wishlist_padding',
				[
					'label'      => __( 'Padding', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .elementor-single-product.single-style-3 .yith-wcwl-add-to-wishlist a'
						=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'  => 'before',
				]
			);

			$this->end_controls_section();

			//Button Compare
			$this->start_controls_section(
				'section_style_button_compare',
				[
					'label'     => __( 'Button Compare', 'apr-core' ),
					'tab'       => Controls_Manager::TAB_STYLE,
					'condition' => [
						'show_compare' => 'yes',
					],
				]
			);

			$this->add_responsive_control(
				'button_compare_width',
				array(
					'label'      => __( 'Size', 'apr-core' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => array( 'px', '%' ),
					'range'      => array(
						'%'  => array(
							'min' => 1,
							'max' => 100,
						),
						'px' => array(
							'min'  => 1,
							'max'  => 1600,
							'step' => 5
						)
					),
					'selectors'  => array(
						'{{WRAPPER}} .elementor-single-product.single-style-3 div.product.compare-button a:before'
						=> 'font-size:{{SIZE}}{{UNIT}};'
					),
				)
			);

			$this->start_controls_tabs( 'tabs_button_style_compare' );

			$this->start_controls_tab(
				'tab_button_normal_compare',
				[
					'label' => __( 'Normal', 'apr-core' ),
				]
			);

			$this->add_control(
				'button_text_color_compare',
				[
					'label'     => __( 'Text Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .elementor-single-product.single-style-3 div.product.compare-button a:before'
						=> 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'button_bg_color_compare',
				[
					'label'     => __( 'Background Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .elementor-single-product.single-style-3 div.product.compare-button'
						=> 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        => 'border_compare',
					'placeholder' => '1px',
					'default'     => '1px',
					'selector'    => '{{WRAPPER}} .elementor-single-product.single-style-3 div.product.compare-button',
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_button_compare_hover',
				[
					'label' => __( 'Hover', 'apr-core' ),
				]
			);

			$this->add_control(
				'hover_color_compare',
				[
					'label'     => __( 'Text Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .elementor-single-product.single-style-3 div.product.compare-button:hover a:before'
						=> 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'button_compare_bg_color_hover',
				[
					'label'     => __( 'Background Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .elementor-single-product.single-style-3 div.product.compare-button:hover'
						=> 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        => 'border_compare_hover',
					'placeholder' => '1px',
					'default'     => '1px',
					'selector'    => '{{WRAPPER}} .elementor-single-product.single-style-3 div.product.compare-button:hover',
				]
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_control(
				'border_compare_radius',
				[
					'label'      => __( 'Border Radius', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'separator'  => 'before',
					'selectors'  => [
						'{{WRAPPER}} .elementor-single-product.single-style-3 div.product.compare-button'
						=> 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'text_compare_padding',
				[
					'label'      => __( 'Padding', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .elementor-single-product.single-style-3 div.product.compare-button a:before'
						=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'  => 'before',
				]
			);

			$this->end_controls_section();

			// Button
			$this->start_controls_section(
				'section_style_button',
				[
					'label' => __( 'Button', 'apr-core' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'typography',

					'selector' => '{{WRAPPER}} .btn-single-product a, {{WRAPPER}} .btn-single-product a:before',
				]
			);

			$this->start_controls_tabs( 'tabs_button_style' );

			$this->start_controls_tab(
				'tab_button_normal',
				[
					'label' => __( 'Normal', 'apr-core' ),
				]
			);

			$this->add_control(
				'button_text_color',
				[
					'label'     => __( 'Text Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .btn-single-product a' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'button_bg_color',
				[
					'label'     => __( 'Background Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .btn-single-product a' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        => 'border',
					'placeholder' => '1px',
					'default'     => '1px',
					'selector'    => '{{WRAPPER}} .btn-single-product a',
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'tab_button_hover',
				[
					'label' => __( 'Hover', 'apr-core' ),
				]
			);

			$this->add_control(
				'hover_color',
				[
					'label'     => __( 'Text Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .btn-single-product a:hover' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'button_bg_color_hover',
				[
					'label'     => __( 'Background Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .btn-single-product a:hover,{{WRAPPER}} .elementor-single-product.single-style-2 .btn-single-product a:after' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        => 'border_hover',
					'placeholder' => '1px',
					'default'     => '1px',
					'selector'    => '{{WRAPPER}} .btn-single-product a:hover',
				]
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_control(
				'border_radius',
				[
					'label'      => __( 'Border Radius', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'separator'  => 'before',
					'selectors'  => [
						'{{WRAPPER}} .btn-single-product a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'text_padding',
				[
					'label'      => __( 'Padding', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .btn-single-product a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator'  => 'before',
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_style_navigation',
				[
					'label'     => __( 'Arrows', 'apr-core' ),
					'tab'       => Controls_Manager::TAB_STYLE,
					'condition' => [
						'navigation' => 'arrows',
					],
				]
			);
			$this->add_control(
				'heading_style_arrows',
				[
					'label'     => __( 'Arrows', 'apr-core' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'navigation' => 'arrows',
					],
				]
			);
			$this->add_control(
				'arrows_color',
				[
					'label'     => __( 'Arrows Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .slick-arrow' => 'color: {{VALUE}};',
					],
					'condition' => [
						'navigation' => 'arrows',
					],
				]
			);
			$this->add_control(
				'arrows_border_color',
				[
					'label'     => __( 'Arrows Border Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .slick-arrow' => 'border-color: {{VALUE}};',
					],
					'condition' => [
						'navigation' => 'arrows',
					],
				]
			);
			$this->add_control(
				'arrows_hover_color',
				[
					'label'     => __( 'Arrows Hover Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .slick-arrow:hover' => 'color: {{VALUE}};',
					],
					'condition' => [
						'navigation' => 'arrows',
					],
				]
			);
			$this->add_control(
				'arrows_hover_border_color',
				[
					'label'     => __( 'Arrows Hover Border Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .slick-arrow:hover' => 'border-color: {{VALUE}};',
					],
					'condition' => [
						'navigation' => 'arrows',
					],
				]
			);
			$this->add_control(
				'line_color',
				[
					'label'     => __( 'Line Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .btn-prev:before' => 'border-color: {{VALUE}};',
					],
					'condition' => [
						'navigation'  => 'arrows',
						'single_type' => '2',
					],
				]
			);
			$this->end_controls_section();

		}

		private function remove_hook() {
			remove_all_actions( 'woocommerce_before_single_product_summary' );
			remove_all_actions( 'woocommerce_after_single_product_summary' );
			remove_all_actions( 'woocommerce_single_product_summary' );
		}

		private function add_hook() {
			add_action( 'woocommerce_before_single_product_summary', 'lusion_image_single_product_sc', 20 );
			add_action( 'woocommerce_single_product_summary', 'apr_core_woocommerce_category', 3 );
			add_action( 'woocommerce_single_product_summary', 'apr_core_woocommerce_subtitle', 4 );
			add_action( 'woocommerce_single_product_summary', 'apr_core_woocommerce_template_single_title', 5 );
			add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
			add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 9 );
			add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 15 );
			add_action( 'woocommerce_single_product_summary', 'apr_core_woocommerce_template_link_details', 25 );
		}

		protected function render() {
			$this->apr_sc_single_product();
			$settings = $this->get_settings_for_display();
			if ( empty( $settings['slides'] ) ) {
				return;
			}
			global $woocommerce_loop;
			$slides                                = [];
			$slide_count                           = 0;
			$single_class                          = '';
			$single_type                           = $settings['single_type'];
			$show_custom_image                     = $settings['show_custom_image'];
			$custom_dimension                      = $settings['custom_dimension'];
			$woocommerce_loop['custom_dimension']  = $custom_dimension;
			$woocommerce_loop['show_custom_image'] = $show_custom_image; 
			$woocommerce_loop['single_type']       = $single_type;

			if ( $single_type == '1' ) {
				$single_class = 'single-style-1';
			} elseif ( $single_type == '2' ) {
				$single_class = 'single-style-2';
			} else {
				$single_class = 'single-style-3';
			}
			$show_arr = $show_arr_tablet = $show_arr_mobile = 'false';
			if ( $settings['navigation'] == 'arrows' ) {
				$show_arr = 'true';
			}
			if ( isset($settings['navigation_tablet']) && $settings['navigation_tablet'] == 'arrows' ) {
				$show_arr_tablet = 'true';
			}
			if ( isset( $settings['navigation_mobile'] ) ) {
				if ( $settings['navigation_mobile'] == 'arrows' ) {
					$show_arr_mobile = 'true';
				}
			}
			$pause_on_hover = $autoplay = $infinite = '';
			if ( $settings['pause_on_hover'] == 'yes' ) {
				$pause_on_hover = 'true';
			} else {
				$pause_on_hover = 'false';
			}
			if ( $settings['autoplay'] == 'yes' ) {
				$autoplay = 'true';
			} else {
				$autoplay = 'false';
			}
			if ( $settings['infinite'] == 'yes' ) {
				$infinite = 'true';
			} else {
				$infinite = 'false';
			}
			$is_rtl    = is_rtl();
			$direction = $is_rtl ? 'true' : 'false';
			$id        = 'apr-single-product-' . wp_rand();
			$this->add_render_attribute( 'wrapper', 'class', 'elementor-single-product' );
			$this->add_render_attribute( 'wrapper', 'class', $single_class );
			$this->add_render_attribute( 'wrapper', 'id', $id );
			$this->remove_hook();
			$this->add_hook();
			global $product;
			foreach ( $settings['slides'] as $slide ) {
				if ( $single_type !== '3' ) {
					$slides[] = do_shortcode( '[product_page id="' . $slide['id_product'] . '"]' );
				} else {
					$slides[] = '<h3 class="product_title entry-title">' . get_the_title( $slide['id_product'] ) . '</h3>';
					$slides[] = '<p class="content-product-description">' . get_the_excerpt( $slide['id_product'] ) . '</p>';
					$slides[] = '<p class="price">' . wc_get_product( $slide['id_product'] )->get_price_html() . '</p>';

					$slides[] = '<div class="content-product-button" >';

					$slides[] = do_shortcode( '[add_to_cart show_price="false" id="' . $slide['id_product'] . '"]' );

					if ( class_exists( 'YITH_WCWL' ) && $settings['show_wishlist'] === 'yes' ) {
						$slides[] = do_shortcode( '[yith_wcwl_add_to_wishlist product_id="' . $slide['id_product'] . '"]' );
					}

					if ( get_option( 'yith_woocompare_compare_button_in_products_list' ) == 'yes' && $settings['show_compare'] === 'yes' ) {
						$slides[] = do_shortcode( '[yith_compare_button product=' . $slide['id_product'] . ']' );
					}
					$slides[] = '</div>';
				}

				$slide_count ++;
			}

			echo '<div ' . $this->get_render_attribute_string( 'wrapper' ) . '>';
			echo implode( '', $slides );
			echo '</div>';
			?>
			<?php if ( $settings['show_slider'] === 'yes' ) : ?>
				<script>
					jQuery(document).ready(function ($) {
						$('#<?php echo esc_js( $id );?>').slick({
							slidesToShow  : 1,
							slidesToScroll: 1,
							dots          : false,
							arrows        : <?php echo esc_attr( $show_arr );?>,
							nextArrow     : '<button class="btn-next"><i class="theme-icon-next"></i></button>',
							prevArrow     : '<button class="btn-prev"><i class="theme-icon-back"></i></button>',
							rtl           : <?php echo esc_attr( $direction );?>,
							autoplay      : <?php echo esc_attr( $autoplay );?>,
							pauseOnHover  : <?php echo esc_attr( $pause_on_hover );?>,
							infinite      : <?php echo esc_attr( $infinite );?>,
							autoplaySpeed : <?php echo absint( $settings['autoplay_speed'] );?>,
							speed         : <?php echo absint( $settings['transition_speed'] );?>,
							fade          : true,
							cssEase       : 'ease-in-out',
							responsive    : [
								{
									breakpoint: 1024.2,
									settings  : {
										arrows: <?php echo esc_attr( $show_arr_tablet );?>,
									}
								},
								{
									breakpoint: 767.2,
									settings  : {
										arrows: <?php echo esc_attr( $show_arr_mobile );?>,
									}
								}
							]

						});

						function arrowScSingleProduct() {
							clearTimeout(window.resizedFinished);
							window.resizedFinished = setTimeout(function () {
								height_images = $('.single-style-1 .image-product-sc img').height() - 42 + 'px';
								$(".single-style-1 .btn-prev").css({"top": height_images});
								$(".single-style-1 .btn-next").css({"top": height_images});
								height_images_type_2 = $('.single-style-2 .image-product-sc').height() / 2 + 'px';
								$(".single-style-2 .btn-prev").css({"bottom": height_images_type_2});
								$(".single-style-2 .btn-next").css({"bottom": height_images_type_2});
							}, 250);
						}

						arrowScSingleProduct();
						$(window).resize(function () {
							arrowScSingleProduct();
						});
					});
				</script>

			<?php
			endif;
		}
	}

	Plugin::instance()->widgets_manager->register( new Apr_Core_Single_Product );
}
