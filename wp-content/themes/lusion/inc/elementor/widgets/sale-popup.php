<?php

namespace Elementor;

use Elementor\Core\Base\Base_Object;

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
	class Apr_Core_Sale_Popup extends Widget_Base {

		public function apr_sc_sale_popup() {
			/* Add css */
			if ( is_rtl() ) {
				wp_enqueue_style( 'apr-sc-sale-popup', LUSION_CSS . '/elementor/sale-popup-rtl.min.css', array(), LUSION_THEME_VERSION );
			} else {
				wp_enqueue_style( 'apr-sc-sale-popup', LUSION_CSS . '/elementor/sale-popup.min.css', array(), LUSION_THEME_VERSION );
			}
		}

		public function get_categories() {
			return array( 'apr-core' );
		}

		public function get_name() {
			return 'apr-sale-popup';
		}

		public function get_title() {
			return __( 'APR Sale Popup', 'apr-core' );
		}

		public function get_icon() {
			return 'eicon-post-list';
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
			$repeater->add_control(
				'client_name',
				[
					'label'   => __( 'Client name', 'apr-core' ),
					'type'    => Controls_Manager::TEXT,
					'default' => '',
				]
			);
			$repeater->add_control(
				'address_purchase',
				[
					'label'   => __( 'Address purchase', 'apr-core' ),
					'type'    => Controls_Manager::TEXT,
					'default' => '',
				]
			);
			$repeater->add_control(
				'purchase',
				[
					'label'   => __( 'Text purchase', 'apr-core' ),
					'type'    => Controls_Manager::TEXT,
					'default' => '',
				]
			);
			$repeater->add_control(
				'time_purchase',
				[
					'label'   => __( 'Time purchase', 'apr-core' ),
					'type'    => Controls_Manager::TEXT,
					'default' => '',
				]
			);
			$this->add_control(
				'slides',
				[
					'type'        => Controls_Manager::REPEATER,
					'fields'      => $repeater->get_controls(),
					'default'     => [
						[
							'id_product'       => __( '', 'apr-core' ),
							'client_name'      => __( '', 'apr-core' ),
							'address_purchase' => __( '', 'apr-core' ),
							'purchase'         => __( '', 'apr-core' ),
							'time_purchase'    => __( '', 'apr-core' ),
						],
					],
					'title_field' => '{{{ id_product }}}',
				]
			);
			$this->add_control(
				'position_popup',
				array(
					'label'   => __( 'Position Display Popup', 'apr-core' ),
					'type'    => Controls_Manager::SELECT,
					'options' => array(
						'left'  => __( 'Left', 'apr-core' ),
						'right' => __( 'Right', 'apr-core' ),
					),
					'default' => 'left'
				)
			);
			$this->add_responsive_control(
				'divider_left',
				[
					'label'      => __( 'Left Space', 'apr-core' ),
					'type'       => Controls_Manager::SLIDER,
					'default'    => [
						'size' => '',
						'unit' => 'px',
					],
					'range'      => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						],
					],
					'size_units' => [ 'px' ],
					'condition'  => [
						'position_popup' => 'left',
					],
					'selectors'  => [
						'{{WRAPPER}} ul.product-items .item.product-item' => 'left: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'divider_right',
				[
					'label'      => __( 'Right Space', 'apr-core' ),
					'type'       => Controls_Manager::SLIDER,
					'default'    => [
						'size' => '',
						'unit' => 'px',
					],
					'range'      => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						],
					],
					'size_units' => [ 'px' ],
					'condition'  => [
						'position_popup' => 'right',
					],
					'selectors'  => [
						'{{WRAPPER}} ul.product-items .item.product-item' => 'right: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'divider_bottom',
				[
					'label'      => __( 'Bottom Space', 'apr-core' ),
					'type'       => Controls_Manager::SLIDER,
					'default'    => [
						'size' => '',
						'unit' => 'px',
					],
					'range'      => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						],
					],
					'size_units' => [ 'px' ],
					'selectors'  => [
						'{{WRAPPER}} ul.product-items .item.product-item' => 'bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

		}

		protected function render() {
			$this->apr_sc_sale_popup();
			$settings = $this->get_settings_for_display();

			if ( empty( $settings['slides'] ) ) {
				return;
			}
			/* Add js */
			wp_enqueue_script( 'apr-sc-sale-popup-js', LUSION_JS . '/elementor/sale-popup.min.js' );

			$slides      = [];
			$slide_count = 0;

			$id             = 'apr-single-product-' . wp_rand();
			$target_post_id = '';
			$this->add_render_attribute( 'wrapper', 'class', 'elementor-sale-popup' );
			$this->add_render_attribute( 'wrapper', 'id', $id );
			echo '<div ' . $this->get_render_attribute_string( 'wrapper' ) . '> <ul class="product-items" >';
			foreach ( $settings['slides'] as $slide ) {
				$target_post_id = $slide['id_product'];
				$product        = wc_get_product( $target_post_id );
				$link_product   = get_post_permalink( $target_post_id );
				echo '<li class="item product-item" style="position: absolute;">';
				echo '<span class="x-close"><i class="theme-icon-close"></i></span>';
				echo '<div class="image-popup"><a href="' . $link_product . '">' . get_the_post_thumbnail( $target_post_id, 'thumbnail' ) . '</a></div>';
				echo '<div class="content-popup">';
				echo '<p class="purchase-top">' . $slide['client_name'] . ' (' . $slide['address_purchase'] . ')' . ' <span>' . $slide['purchase'] . '</span>' . '</p>';
				echo '<a href="' . $link_product . '">' . get_the_title( $target_post_id ) . '</a> <p class="time-purchase">' . $slide['time_purchase'] . '</p>';
				echo '</div></li>';

			}
			echo '</ul></div>';
		}
	}

	Plugin::instance()->widgets_manager->register( new Apr_Core_Sale_Popup );
}
