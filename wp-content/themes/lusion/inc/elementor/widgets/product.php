<?php

namespace Elementor;

if (!defined('ABSPATH')) {
	exit;
}
if (class_exists('WooCommerce')) {
	class Apr_Core_Products extends Widget_Base
	{
		public function apr_sc_product()
		{
			/* Import Css */
			if (is_rtl()) {
				wp_enqueue_style('apr-sc-product', LUSION_CSS . '/elementor/product-rtl.css', array(), LUSION_THEME_VERSION);
			} else {
				wp_enqueue_style('apr-sc-product', LUSION_CSS . '/elementor/product.css', array(), LUSION_THEME_VERSION);
			}
		}

		public function get_categories()
		{
			return array('apr-core');
		}

		public function get_name()
		{
			return 'apr_products';
		}

		public function get_title()
		{
			return __('APR Products', 'apr-core');
		}

		public function get_icon()
		{
			return 'eicon-woocommerce';
		}

		protected function register_controls()
		{

			$this->start_controls_section(
				'product_section',
				[
					'label' => __('APR Products', 'apr-core')
				]
			);
			$this->add_control(
				'product_layout',
				array(
					'label'   => __('Product Layout', 'apr-core'),
					'type'    => Controls_Manager::SELECT,
					'options' => array(
						'grid' => __('Grid', 'apr-core'),
						'tab'  => __('Tab', 'apr-core'),
						'list' => __('List', 'apr-core'),
					),
					'default' => 'grid',
				)
			);
			$this->add_control(
				'product_type',
				array(
					'label'     => __('Product Type', 'apr-core'),
					'type'      => Controls_Manager::SELECT,
					'options'   => array(
						'default' => __('Default', 'apr-core'),
						'1'       => __('Style 1', 'apr-core'),
						'2'       => __('Style 2', 'apr-core'),
						'3'       => __('Style 3', 'apr-core'),
						'4'       => __('Style 4', 'apr-core'),
						'5'       => __('Style 5', 'apr-core'),
						'6'       => __('Style 6', 'apr-core'),
						'7'       => __('Style 7', 'apr-core'),
						'8'       => __('Style 8', 'apr-core'),
					),
					'condition' => [
						'product_layout' => ['grid', 'tab'],
					],
				)
			);
			$this->add_control(
				'show_border_product',
				[
					'label'     => __('Show Border', 'apr-core'),
					'type'      => Controls_Manager::SWITCHER,
					'default'   => 'yes',
					'condition' => [
						'product_type' => '5',
					],
				]
			);

			$this->add_control(
				'layout_product_type_3',
				[
					'label'     => __('Layout 2 Product Type 3', 'apr-core'),
					'type'      => Controls_Manager::SWITCHER,
					'default'   => 'no',
					'condition' => [
						'product_type'   => '3',
						'product_layout' => ['grid'],
					],
				]
			);


			$this->add_control(
				'apr_tab_product',
				[
					'type'        => Controls_Manager::REPEATER,
					'seperator'   => 'before',
					'default'     => [
						['apr_tab_product_title' => esc_html__('Tab 1', 'apr-core')],
						['apr_tab_product_title' => esc_html__('Tab 2', 'apr-core')],
						['apr_tab_product_title' => esc_html__('Tab 3', 'apr-core')],
					],
					'fields'      => [

						[
							'name'    => 'apr_tab_product_title',
							'label'   => esc_html__('Tab Title', 'apr-core'),
							'type'    => Controls_Manager::TEXT,
							'default' => esc_html__('Tab Title', 'apr-core')
						],
						[
							'name'        => 'apr_tab_product_cat',
							'label'       => esc_html__('Product Categories', 'apr-core'),
							'type'        => Controls_Manager::SELECT2,
							'options'     => apr_core_check_get_cat('product_cat'),
							'multiple'    => true,
							'label_block' => true
						],
						[
							'name'    => 'apr_tab_filter_by',
							'label'   => __('Filter By', 'apr-core'),
							'type'    => Controls_Manager::SELECT,
							'default' => 'recent_products',
							'options' => [
								'featured_products'     => __('Featured', 'apr-core'),
								'sale_products'         => __('Sale', 'apr-core'),
								'recent_products'       => __('Recent', 'apr-core'),
								'top_rated_products'    => __('Top Rate', 'apr-core'),
								'best_selling_products' => __('Best Selling', 'apr-core'),
							],
						],

					],
					'title_field' => '{{apr_tab_product_title}}',

					'condition' => [
						'product_layout' => 'tab',
					],
				]
			);

			$this->add_control(
				'change_to_a_filter_box',
				[
					'label'       => __('Change To A Filter Box', 'apr-core'),
					'description' => __('Only works when the screen is less than 1366px.', 'apr-core'),
					'type'        => Controls_Manager::SWITCHER,
					'default'     => 'no',
					'condition'   => [
						'product_layout' => 'tab',
					],
				]
			);
			$this->add_control(
				'change_to_a_filter_box_767',
				[
					'label'       => __('Change To A Filter Box from screen 767', 'apr-core'),
					'description' => __('Only works when the screen is less than 1366px.', 'apr-core'),
					'type'        => Controls_Manager::SWITCHER,
					'default'     => 'no',
					'condition'   => [
						'product_layout' => 'tab',
					],
				]
			);
			$this->add_responsive_control(
				'product_column_number',
				[
					'label'           => __('Column', 'apr-core'),
					'type'            => Controls_Manager::SELECT,
					'options'         => [
						6 => __('6 Column', 'apr-core'),
						5 => __('5 Column', 'apr-core'),
						4 => __('4 Column', 'apr-core'),
						3 => __('3 Column', 'apr-core'),
						2 => __('2 Column', 'apr-core'),
						1 => __('1 Column', 'apr-core'),
					],
					'desktop_default' => 3,
					'tablet_default'  => 3,
					'mobile_default'  => 2,
				]
			);

			$this->add_control(
				'title_list_product',
				[

					'label'       => __('Title', 'apr-core'),
					'type'        => Controls_Manager::TEXT,
					'placeholder' => 'Enter your title',
					'dynamic'     => [
						'active' => true,
					],
					'default'     => __('Title', 'apr-core'),
					'condition'   => [
						'product_layout' => 'list',
					],
				]
			);
			$this->add_control(
				'show_content_mobile',
				[
					'label'     => __('Show Content Mobile', 'apr-core'),
					'type'      => Controls_Manager::SWITCHER,
					'default'   => 'no',
					'condition' => [
						'product_layout' => 'list',
					],
				]
			);

			$this->add_control(
				'change_content_position',
				[
					'label'     => __('Change Content Position', 'apr-core'),
					'type'      => Controls_Manager::SWITCHER,
					'default'   => 'no',
					'condition' => [
						'product_layout' => 'grid',
						'product_type'   => '2',
					],
				]
			);
			$this->add_control(
				'filter_product_by',
				[
					'label'     => __('Filter Product By', 'apr-core'),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'categories',
					'options'   => [
						'categories' => __('Categories', 'apr-core'),
						'ids'        => __('IDs', 'apr-core'),
					],
					'condition' => [
						'product_layout' => ['grid', 'list'],
					],
				]
			);
			$this->add_control(
				'product_cat',
				[
					'label'       => __('Product Categories', 'apr-core'),
					'type'        => Controls_Manager::SELECT2,
					'options'     => apr_core_check_get_cat('product_cat'),
					'multiple'    => true,
					'label_block' => true,
					'condition'   => [
						'product_layout'    => ['grid', 'list'],
						'filter_product_by' => ['categories'],
					],
				]
			);
			$this->add_control(
				'id_product',
				[
					'label'       => __('Product by IDs', 'apr-core'),
					'type'        => Controls_Manager::TEXTAREA,
					'placeholder' => 'Enter product IDs - Ex: 15, 16, 17.',
					'description' => __('You can find the id by going to All Products. You then hover on a product ID shown below the product steen', 'apr-core'),
					'label_block' => true,
					'condition'   => [
						'product_layout'    => ['grid', 'list'],
						'filter_product_by' => ['ids'],
					],
				]
			);
			$this->add_control(
				'product_limit',
				[
					'label'   => __('Number of Products', 'apr-core'),
					'type'    => Controls_Manager::NUMBER,
					'default' => 6,
					'min'     => 1,
					'max'     => 100,
					'step'    => 1,
				]
			);
			$this->add_control(
				'hide_desc_product',
				[
					'label'     => __('Hide Description', 'apr-core'),
					'type'      => Controls_Manager::SWITCHER,
					'default'   => 'no',
					'condition' => [
						'product_layout' => 'list',
					],
				]
			);
			$this->add_control(
				'show_btn_loadmore_product',
				[
					'label'     => __('Show Button Load more', 'apr-core'),
					'type'      => Controls_Manager::SWITCHER,
					'default'   => 'no',
					'condition' => [
						'product_layout' => ['grid', 'list'],
					],
				]
			);
			$this->add_control(
				'text_button',
				[
					'label'     => __('Text button', 'apr-core'),
					'type'      => Controls_Manager::TEXT,
					'default'   => __('Load more', 'apr-core'),
					'condition' => [
						'show_btn_loadmore_product' => 'yes',
						'product_layout' => ['grid', 'list'],
					],
				]
			);
			$this->add_control(
				'show_btn_specs',
				[
					'label'     => __('Show Button Specs', 'apr-core'),
					'type'      => Controls_Manager::SWITCHER,
					'default'   => 'yes',
					'condition' => [
						'product_type' => '8',
					],
				]
			);
			$this->add_control(
				'text_button_specs',
				[
					'label'     => __('Text button specs', 'apr-core'),
					'type'      => Controls_Manager::TEXT,
					'default'   => __('View the Specs', 'apr-core'),
					'condition' => [
						'show_btn_specs' => 'yes',
						'product_type'   => '8',
					],
				]
			);
			$this->add_control(
				'filter_by',
				[
					'label'     => __('Filter By', 'apr-core'),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'recent_products',
					'options'   => [
						'featured_products'     => __('Featured', 'apr-core'),
						'sale_products'         => __('Sale', 'apr-core'),
						'recent_products'       => __('Recent', 'apr-core'),
						'top_rated_products'    => __('Top Rate', 'apr-core'),
						'best_selling_products' => __('Best Selling', 'apr-core'),
					],
					'condition' => [
						'product_layout'    => ['grid', 'list'],
						'filter_product_by' => ['categories'],
					],
				]
			);

			$this->add_control(
				'orderby',
				[
					'label'   => __('Order By', 'apr-core'),
					'type'    => Controls_Manager::SELECT,
					'default' => 'date',
					'options' => [
						'date'       => __('Date', 'apr-core'),
						'title'      => __('Title', 'apr-core'),
						'price'      => __('Price', 'apr-core'),
						'popularity' => __('Popularity', 'apr-core'),
						'rating'     => __('Rating', 'apr-core'),
						'rand'       => __('Random', 'apr-core'),
						'menu_order' => __('Menu Order', 'apr-core'),
					],
				]
			);

			$this->add_control(
				'order',
				[
					'label'   => __('Order', 'apr-core'),
					'type'    => Controls_Manager::SELECT,
					'default' => 'ASC',
					'options' => [
						'ASC'  => __('Ascending', 'apr-core'),
						'DESC' => __('Descending', 'apr-core'),
					],
				]
			);

			$this->add_control(
				'paginate',
				[
					'label'     => __('Paginate', 'apr-core'),
					'type'      => Controls_Manager::SWITCHER,
					'default'   => '',
					'condition' => [
						'filter_product_by' => ['categories'],
					],
				]
			);
			$this->add_control(
				'show_category_product',
				[
					'label'     => __('Show Category Product', 'apr-core'),
					'type'      => Controls_Manager::SWITCHER,
					'default'   => 'yes',
					'condition' => [
						'product_type!' => '5',
					],
				]
			);
			$this->add_control(
				'show_attribute_on_title',
				[
					'label'   => __('Show Attribute On Title', 'apr-core'),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'no',
				]
			);
			$this->add_control(
				'product_attr',
				[
					'label'       => __('Product attribute', 'apr-core'),
					'type'        => Controls_Manager::SELECT,
					'options'     => apr_core_check_get_artribute(),
					'multiple'    => true,
					'label_block' => true,
					'condition'   => [
						'show_attribute_on_title' => 'yes',
					],
				]
			);
			$this->add_control(
				'show_add_to_cart_bottom',
				[
					'label'     => __('Show Add To Cart Bottom', 'apr-core'),
					'type'      => Controls_Manager::SWITCHER,
					'label_on'  => __('On', 'apr-core'),
					'label_off' => __('Off', 'apr-core'),
					'default'   => 'no',
					'condition' => [
						'product_type' => '1',
					],
					'separator' => 'before',
				]
			);
			$this->add_control(
				'hide_add_to_cart_bottom_table',
				[
					'label'     => __('Hide Add To Cart Bottom On Table', 'apr-core'),
					'type'      => Controls_Manager::SWITCHER,
					'label_on'  => __('On', 'apr-core'),
					'label_off' => __('Off', 'apr-core'),
					'default'   => 'no',
					'condition' => [
						'show_add_to_cart_bottom' => 'yes',
					],
				]
			);
			$this->add_control(
				'hide_add_to_cart_bottom_mobile',
				[
					'label'     => __('Hide Add To Cart Bottom On Mobile', 'apr-core'),
					'type'      => Controls_Manager::SWITCHER,
					'label_on'  => __('On', 'apr-core'),
					'label_off' => __('Off', 'apr-core'),
					'default'   => 'no',
					'condition' => [
						'show_add_to_cart_bottom' => 'yes',
					],
				]
			);
			$this->add_control(
				'hide_title_product_mobile',
				[
					'label'     => __('Hide Title Product On Mobile', 'apr-core'),
					'type'      => Controls_Manager::SWITCHER,
					'label_on'  => __('On', 'apr-core'),
					'label_off' => __('Off', 'apr-core'),
					'default'   => 'no',
					'separator' => 'before',
				]
			);
			$this->add_control(
				'hide_title_product_tablet',
				[
					'label'     => __('Hide Title Product On Tablet', 'apr-core'),
					'type'      => Controls_Manager::SWITCHER,
					'label_on'  => __('On', 'apr-core'),
					'label_off' => __('Off', 'apr-core'),
					'default'   => 'no',
					'separator' => 'after',
				]
			);
			$this->add_control(
				'show_percentage_lable',
				[
					'label'   => __('Show Percentage Lable', 'apr-core'),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
				]
			);
			$this->add_control(
				'show_quickview',
				[
					'label'   => __('Show Quickview', 'apr-core'),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'no',
				]
			);
			$this->add_control(
				'show_compare',
				[
					'label'   => __('Show Compare', 'apr-core'),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'no',
				]
			);
			$this->add_control(
				'show_wishlist',
				[
					'label'   => __('Show Wishlist', 'apr-core'),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'no',
				]
			);
			$this->add_control(
				'action_icon_position',
				[
					'label'     => __('Action icon position', 'apr-core'),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'vertical',
					'options'   => [
						'vertical'                   => __('Vertical', 'apr-core'),
						'horizontal_middle'          => __('Horizontal and Middle no Wishlist', 'apr-core'),
						'horizontal_middle_wishlist' => __('Horizontal and Middle has Wishlist', 'apr-core'),
						'horizontal_bottom'          => __('Horizontal and Bottom', 'apr-core'),
					],
					'condition' => [
						'product_type' => '2',
						'product_layout' => ['grid', 'tab'],
					],
				]
			);
			$this->add_control(
				'hide_wishlist_before_hover',
				[
					'label'     => __('Hide wishlist before hover', 'apr-core'),
					'type'      => Controls_Manager::SWITCHER,
					'default'   => 'no',
					'condition' => [
						'product_type'         => '2',
						'action_icon_position' => ['horizontal_bottom', 'horizontal_middle_wishlist'],
						'product_layout' => ['grid', 'tab'],
					],
				]
			);
			$this->add_control(
				'wishlist_position2',
				[
					'label'     => __('Wishlist Positon', 'apr-core'),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'bottom',
					'options'   => [
						'top'    => __('Top', 'apr-core'),
						'bottom' => __('Bottom', 'apr-core'),
					],
					'condition' => [
						'show_wishlist' => 'yes',
						'product_type'  => '2',
					],
				]
			);
			$this->add_control(
				'wishlist_position',
				[
					'label'     => __('Wishlist Positon', 'apr-core'),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'bottom',
					'options'   => [
						'top'    => __('Top', 'apr-core'),
						'bottom' => __('Bottom', 'apr-core'),
					],
					'condition' => [
						'show_wishlist'            => 'yes',
						'product_type'             => '1',
						'show_add_to_cart_bottom!' => 'yes',
					],
				]
			);
			$this->add_control(
				'show_attr_image',
				[
					'label'     => __('Show Attribute product', 'apr-core'),
					'type'      => Controls_Manager::SWITCHER,
					'default'   => 'no',
					'condition' => [
						'product_type'         => '2',
						'action_icon_position' => 'horizontal_middle',

					],
				]
			);
			$this->add_control(
				'show_custom_image',
				[
					'label'   => __('Show Custom Image Size', 'apr-core'),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'no',
				]
			);
			$this->add_control(
				'show_product_descriptions',
				[
					'label'     => __('Show Product Descriptions', 'apr-core'),
					'type'      => Controls_Manager::SWITCHER,
					'default'   => 'yes',
					'condition' => [
						'product_type' => '8',
					],
				]
			);
			$this->add_control(
				'custom_dimension',
				[
					'label'       => __('Image Size', 'apr-core'),
					'type'        => Controls_Manager::IMAGE_DIMENSIONS,
					'description' => __('You can crop the original image size to any custom size. You can also set a single value for height or width in order to keep the original size ratio.', 'apr-core'),
					'condition'   => [
						'show_custom_image' => 'yes',
					],
				]
			);
			$this->add_control(
				'show_slider',
				[
					'label'     => __('Slider', 'apr-core'),
					'type'      => Controls_Manager::SWITCHER,
					'label_on'  => __('On', 'apr-core'),
					'label_off' => __('Off', 'apr-core'),
					'default'   => 'no',
					'condition' => [
						'product_layout!' => 'list',
					],
				]
			);
			$this->end_controls_section();

			$this->start_controls_section(
				'section_slider_options',
				[
					'label'     => __('Slider Options', 'apr-core'),
					'type'      => Controls_Manager::SECTION,
					'condition' => [
						'show_slider' => 'yes',
						'product_layout!' => 'list',
					],
				]
			);
			$this->add_control(
				'slidestoshow',
				[
					'label'       => __('Slides To Show', 'apr-core'),
					'description' => __('Set how many item for screen > 1400px.', 'apr-core'),
					'type'        => Controls_Manager::NUMBER,
					'default'     => '3',
				]
			);
			$this->add_control(
				'slidestoscroll',
				[
					'label'       => __('Slides To Scroll', 'apr-core'),
					'description' => __('Set how many item for screen < 1200px.', 'apr-core'),
					'type'        => Controls_Manager::NUMBER,
					'default'     => '1',
				]
			);
			$this->add_control(
				'slidestoshow_desktop',
				[
					'label'   => __('Desktop 1024 - 1399', 'apr-core'),
					'type'    => Controls_Manager::NUMBER,
					'default' => '3',
				]
			);
			$this->add_control(
				'slidestoshow_tablet',
				[
					'label'   => __('Tablet Lanscape', 'apr-core'),
					'type'    => Controls_Manager::NUMBER,
					'default' => '3',
				]
			);
			$this->add_control(
				'slidestoshow_mobile',
				[
					'label'   => __('Mobile', 'apr-core'),
					'type'    => Controls_Manager::NUMBER,
					'default' => '1',
				]
			);
			$this->add_control(
				'slidestoshow_mobile_mini',
				[
					'label'   => __('Mobile mini 480 - 320', 'apr-core'),
					'type'    => Controls_Manager::NUMBER,
					'default' => '1',
				]
			);
			$this->add_responsive_control(
				'slidesrow',
				[
					'label'           => __('Row', 'apr-core'),
					'type'            => Controls_Manager::NUMBER,
					'devices'         => ['desktop', 'tablet', 'mobile'],
					'desktop_default' => '1',
					'tablet_default'  => '1',
					'mobile_default'  => '1',
				]
			);
			$this->add_control(
				'navigation',
				[
					'label'   => __('Navigation', 'apr-core'),
					'type'    => Controls_Manager::SELECT,
					'default' => 'arrows',
					'options' => [
						'both'   => __('Arrows and Dots', 'apr-core'),
						'arrows' => __('Arrows', 'apr-core'),
						'dots'   => __('Dots', 'apr-core'),
						'none'   => __('None', 'apr-core'),
					],
				]
			);
			$this->add_control(
				'custom_arr_position',
				[
					'label'     => __('Custom Arrows Position', 'apr-core'),
					'type'      => Controls_Manager::SWITCHER,
					'default'   => '',
					'condition' => [
						'navigation' => ['both', 'arrows'],
					],
				]
			);
			$this->add_control(
				'arrow_align',
				[
					'label'   => __('Align arrow', 'apr-core'),
					'type'    => Controls_Manager::SELECT,
					'default' => 'middle',
					'options' => [
						'middle' => __('Middle', 'apr-core'),
						'top'    => __('Top', 'apr-core'),
						'bottom' => __('Bottom', 'apr-core'),
					],
				]
			);
			$start = is_rtl() ? __('Right', 'elementor') : __('Left', 'elementor');
			$end   = !is_rtl() ? __('Right', 'elementor') : __('Left', 'elementor');

			$this->add_control(
				'prev_offset_orientation_h',
				[
					'label'       => __('Horizontal Orientation Prev', 'elementor'),
					'type'        => Controls_Manager::CHOOSE,
					'toggle'      => false,
					'default'     => 'start',
					'options'     => [
						'start' => [
							'title' => $start,
							'icon'  => 'eicon-h-align-left',
						],
						'end'   => [
							'title' => $end,
							'icon'  => 'eicon-h-align-right',
						],
					],
					'classes'     => 'elementor-control-start-end',
					'render_type' => 'ui',
					'condition'   => [
						'custom_arr_position' => 'yes',
					],
				]
			);

			$this->add_responsive_control(
				'prev_offset_x',
				[
					'label'      => __('Offset', 'elementor'),
					'type'       => Controls_Manager::SLIDER,
					'range'      => [
						'px' => [
							'min'  => -1000,
							'max'  => 1000,
							'step' => 1,
						],
						'%'  => [
							'min' => -200,
							'max' => 200,
						],
						'vw' => [
							'min' => -200,
							'max' => 200,
						],
						'vh' => [
							'min' => -200,
							'max' => 200,
						],
					],
					'default'    => [
						'size' => '0',
					],
					'size_units' => ['px', '%', 'vw', 'vh'],
					'selectors'  => [
						'body:not(.rtl) {{WRAPPER}} .slick-prev'       => 'left: {{SIZE}}{{UNIT}}',
						'body:not(.rtl) {{WRAPPER}} button.slick-prev' => 'right: auto',
						'body.rtl {{WRAPPER}} .slick-prev'             => 'right: {{SIZE}}{{UNIT}}',
						'body.rtl {{WRAPPER}} button.slick-prev'       => 'left: auto',
					],
					'condition'  => [
						'prev_offset_orientation_h!' => 'end',
						'custom_arr_position'        => 'yes',
					],
				]
			);

			$this->add_responsive_control(
				'prev_offset_x_end',
				[
					'label'      => __('Offset', 'elementor'),
					'type'       => Controls_Manager::SLIDER,
					'range'      => [
						'px' => [
							'min'  => -1000,
							'max'  => 1000,
							'step' => 0.1,
						],
						'%'  => [
							'min' => -200,
							'max' => 200,
						],
						'vw' => [
							'min' => -200,
							'max' => 200,
						],
						'vh' => [
							'min' => -200,
							'max' => 200,
						],
					],
					'default'    => [
						'size' => '0',
					],
					'size_units' => ['px', '%', 'vw', 'vh'],
					'selectors'  => [
						'body:not(.rtl) {{WRAPPER}} .slick-prev'       => 'right: {{SIZE}}{{UNIT}}',
						'body:not(.rtl) {{WRAPPER}} button.slick-prev' => 'left: auto',
						'body.rtl {{WRAPPER}} .slick-prev'             => 'left: {{SIZE}}{{UNIT}}',
						'body.rtl {{WRAPPER}} button.slick-prev'       => 'right: auto',
					],
					'condition'  => [
						'prev_offset_orientation_h!' => 'start',
						'custom_arr_position'        => 'yes',
					],
				]
			);

			$this->add_control(
				'prev_offset_orientation_v',
				[
					'label'       => __('Vertical Orientation Prev', 'elementor'),
					'type'        => Controls_Manager::CHOOSE,
					'toggle'      => false,
					'default'     => 'start',
					'options'     => [
						'start' => [
							'title' => __('Top', 'elementor'),
							'icon'  => 'eicon-v-align-top',
						],
						'end'   => [
							'title' => __('Bottom', 'elementor'),
							'icon'  => 'eicon-v-align-bottom',
						],
					],
					'render_type' => 'ui',
					'condition'   => [
						'custom_arr_position' => 'yes',
					],
				]
			);

			$this->add_responsive_control(
				'prev_offset_y',
				[
					'label'      => __('Offset', 'elementor'),
					'type'       => Controls_Manager::SLIDER,
					'range'      => [
						'px' => [
							'min'  => -1000,
							'max'  => 1000,
							'step' => 1,
						],
						'%'  => [
							'min' => -200,
							'max' => 200,
						],
						'vh' => [
							'min' => -200,
							'max' => 200,
						],
						'vw' => [
							'min' => -200,
							'max' => 200,
						],
					],
					'size_units' => ['px', '%', 'vh', 'vw'],
					'default'    => [
						'size' => '0',
					],
					'selectors'  => [
						'{{WRAPPER}} .slick-prev'       => 'top: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} button.slick-prev' => 'bottom: auto',
					],
					'condition'  => [
						'prev_offset_orientation_v!' => 'end',
						'custom_arr_position'        => 'yes',
					],
				]
			);

			$this->add_responsive_control(
				'prev_offset_y_end',
				[
					'label'      => __('Offset', 'elementor'),
					'type'       => Controls_Manager::SLIDER,
					'range'      => [
						'px' => [
							'min'  => -1000,
							'max'  => 1000,
							'step' => 1,
						],
						'%'  => [
							'min' => -200,
							'max' => 200,
						],
						'vh' => [
							'min' => -200,
							'max' => 200,
						],
						'vw' => [
							'min' => -200,
							'max' => 200,
						],
					],
					'size_units' => ['px', '%', 'vh', 'vw'],
					'default'    => [
						'size' => '0',
					],
					'selectors'  => [
						'{{WRAPPER}} .slick-prev'       => 'bottom: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} button.slick-prev' => 'top: auto',
					],
					'condition'  => [
						'prev_offset_orientation_v!' => 'start',
						'custom_arr_position'        => 'yes',
					],
					'separator'  => 'after',
				]
			);
			$this->add_control(
				'next_offset_orientation_h',
				[
					'label'       => __('Horizontal Orientation Next', 'elementor'),
					'type'        => Controls_Manager::CHOOSE,
					'toggle'      => false,
					'default'     => 'start',
					'options'     => [
						'start' => [
							'title' => $start,
							'icon'  => 'eicon-h-align-left',
						],
						'end'   => [
							'title' => $end,
							'icon'  => 'eicon-h-align-right',
						],
					],
					'classes'     => 'elementor-control-start-end',
					'render_type' => 'ui',
					'condition'   => [
						'custom_arr_position' => 'yes',
					],
				]
			);

			$this->add_responsive_control(
				'next_offset_x',
				[
					'label'      => __('Offset', 'elementor'),
					'type'       => Controls_Manager::SLIDER,
					'range'      => [
						'px' => [
							'min'  => -1000,
							'max'  => 1000,
							'step' => 1,
						],
						'%'  => [
							'min' => -200,
							'max' => 200,
						],
						'vw' => [
							'min' => -200,
							'max' => 200,
						],
						'vh' => [
							'min' => -200,
							'max' => 200,
						],
					],
					'default'    => [
						'size' => '0',
					],
					'size_units' => ['px', '%', 'vw', 'vh'],
					'selectors'  => [
						'body:not(.rtl) {{WRAPPER}} .slick-next'       => 'left: {{SIZE}}{{UNIT}}',
						'body:not(.rtl) {{WRAPPER}} button.slick-next' => 'right: auto',
						'body.rtl {{WRAPPER}} .slick-next'             => 'right: {{SIZE}}{{UNIT}}',
						'body.rtl {{WRAPPER}} button.slick-next'       => 'left: auto',
					],
					'condition'  => [
						'next_offset_orientation_h!' => 'end',
						'custom_arr_position'        => 'yes',
					],
				]
			);

			$this->add_responsive_control(
				'next_offset_x_end',
				[
					'label'      => __('Offset', 'elementor'),
					'type'       => Controls_Manager::SLIDER,
					'range'      => [
						'px' => [
							'min'  => -1000,
							'max'  => 1000,
							'step' => 0.1,
						],
						'%'  => [
							'min' => -200,
							'max' => 200,
						],
						'vw' => [
							'min' => -200,
							'max' => 200,
						],
						'vh' => [
							'min' => -200,
							'max' => 200,
						],
					],
					'default'    => [
						'size' => '0',
					],
					'size_units' => ['px', '%', 'vw', 'vh'],
					'selectors'  => [
						'body:not(.rtl) {{WRAPPER}} .slick-next'       => 'right: {{SIZE}}{{UNIT}}',
						'body:not(.rtl) {{WRAPPER}} button.slick-next' => 'left: auto',
						'body.rtl {{WRAPPER}} .slick-next'             => 'left: {{SIZE}}{{UNIT}}',
						'body.rtl {{WRAPPER}} button.slick-next'       => 'right: auto',
					],
					'condition'  => [
						'next_offset_orientation_h!' => 'start',
						'custom_arr_position'        => 'yes',
					],
				]
			);

			$this->add_control(
				'next_offset_orientation_v',
				[
					'label'       => __('Vertical Orientation Next', 'elementor'),
					'type'        => Controls_Manager::CHOOSE,
					'toggle'      => false,
					'default'     => 'start',
					'options'     => [
						'start' => [
							'title' => __('Top', 'elementor'),
							'icon'  => 'eicon-v-align-top',
						],
						'end'   => [
							'title' => __('Bottom', 'elementor'),
							'icon'  => 'eicon-v-align-bottom',
						],
					],
					'render_type' => 'ui',
					'condition'   => [
						'custom_arr_position' => 'yes',
					],
				]
			);

			$this->add_responsive_control(
				'next_offset_y',
				[
					'label'      => __('Offset', 'elementor'),
					'type'       => Controls_Manager::SLIDER,
					'range'      => [
						'px' => [
							'min'  => -1000,
							'max'  => 1000,
							'step' => 1,
						],
						'%'  => [
							'min' => -200,
							'max' => 200,
						],
						'vh' => [
							'min' => -200,
							'max' => 200,
						],
						'vw' => [
							'min' => -200,
							'max' => 200,
						],
					],
					'size_units' => ['px', '%', 'vh', 'vw'],
					'default'    => [
						'size' => '0',
					],
					'selectors'  => [
						'{{WRAPPER}} .slick-next'       => 'top: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} button.slick-next' => 'bottom: auto',
					],
					'condition'  => [
						'next_offset_orientation_v!' => 'end',
						'custom_arr_position'        => 'yes',
					],
				]
			);

			$this->add_responsive_control(
				'next_offset_y_end',
				[
					'label'      => __('Offset', 'elementor'),
					'type'       => Controls_Manager::SLIDER,
					'range'      => [
						'px' => [
							'min'  => -1000,
							'max'  => 1000,
							'step' => 1,
						],
						'%'  => [
							'min' => -200,
							'max' => 200,
						],
						'vh' => [
							'min' => -200,
							'max' => 200,
						],
						'vw' => [
							'min' => -200,
							'max' => 200,
						],
					],
					'size_units' => ['px', '%', 'vh', 'vw'],
					'default'    => [
						'size' => '0',
					],
					'selectors'  => [
						'{{WRAPPER}} .slick-next'       => 'bottom: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} button.slick-next' => 'top: auto',
					],
					'condition'  => [
						'next_offset_orientation_v!' => 'start',
						'custom_arr_position'        => 'yes',
					],
				]
			);

			$this->add_control(
				'transition_speed',
				[
					'label'   => __('Transition Speed (ms)', 'apr-core'),
					'type'    => Controls_Manager::NUMBER,
					'default' => 500,
				]
			);
			$this->add_control(
				'autoplay_speed',
				[
					'label'     => __('Autoplay Speed', 'apr-core'),
					'type'      => Controls_Manager::NUMBER,
					'default'   => 5000,
					'condition' => [
						'autoplay' => 'yes',
					],
					'selectors' => [
						'{{WRAPPER}} .slick-slide-bg' => 'animation-duration: calc({{VALUE}}ms*1.2); transition-duration: calc({{VALUE}}ms)',
					],
				]
			);
			$this->add_control(
				'autoplay',
				[
					'label'   => __('Autoplay', 'apr-core'),
					'type'    => Controls_Manager::SWITCHER,
					'default' => '',
				]
			);
			$this->add_control(
				'infinite',
				[
					'label'   => __('Infinite Loop', 'apr-core'),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
				]
			);
			$this->add_control(
				'centermode',
				[
					'label'   => __('Center Mode', 'apr-core'),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'no',
				]
			);
			$this->add_responsive_control(
				'centerpadding',
				[
					'label'     => __('Center Padding', 'apr-core'),
					'type'      => Controls_Manager::TEXT,
					'default'   => '50',
					'condition' => [
						'centermode' => 'yes',
					],
				]
			);
			$this->add_control(
				'pause_on_hover',
				[
					'label'   => __('Pause on Hover', 'apr-core'),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'yes',
				]
			);
			$this->end_controls_section();
			//style
			$this->start_controls_section(
				'section_title_list',
				[
					'label'      => __('Title', 'apr-core'),
					'tab'        => Controls_Manager::TAB_STYLE,
					'show_label' => false,
					'condition'  => [
						'product_layout' => 'list',
					],
				]
			);

			$this->add_responsive_control(
				'title_list_padding',
				[
					'label'      => esc_html__('Padding', 'apr-core'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', 'em', '%'],
					'selectors'  => [
						'{{WRAPPER}} .apr-product .title-list-product' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'title_list_margin',
				[
					'label'      => esc_html__('margin', 'apr-core'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', 'em', '%'],
					'selectors'  => [
						'{{WRAPPER}} .apr-product .title-list-product' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'background_title_list',
				[
					'label'       => __('Background', 'apr-core'),
					'type'        => Controls_Manager::COLOR,
					'description' => __('Active only from screen 767px and below.'),
					'default'     => '',
					'selectors'   => [
						'{{WRAPPER}} .apr-product .title-list-product' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'background_title_list_active',
				[
					'label'       => __('Background Active', 'apr-core'),
					'type'        => Controls_Manager::COLOR,
					'default'     => '',
					'description' => __('Active only from screen 767px and below.'),
					'selectors'   => [
						'{{WRAPPER}} .apr-product.active .title-list-product' => 'background-color: {{VALUE}};',
					],
				]
			);


			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'number_typography',
					'selector' => '{{WRAPPER}} .apr-product .title-list-product',
				]
			);

			$this->add_control(
				'number_color',
				[
					'label'     => __('Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .apr-product .title-list-product' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'number_spacing_parent',
				[
					'label'      => __('Spacing', 'apr-core'),
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
					'size_units' => ['px'],
					'selectors'  => [
						'{{WRAPPER}} .apr-product .title-list-product' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_box_product',
				[
					'label'      => __('Box Product', 'apr-core'),
					'tab'        => Controls_Manager::TAB_STYLE,
					'show_label' => false,
				]
			);
			$this->add_control(
				'box_bg_color',
				[
					'label'     => __('Background Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}}' => 'background-color: {{VALUE}}',
					],
				]
			);
			$this->add_responsive_control(
				'box_padding',
				[
					'label'      => __('Padding', 'apr-core'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%', 'em'],
					'selectors'  => [
						'{{WRAPPER}} .apr-product div.woocommerce ul.products' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'box_margin',
				[
					'label'      => __('Margin', 'apr-core'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%', 'em'],
					'selectors'  => [
						'{{WRAPPER}} .apr-product div.woocommerce ul.products' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();
			$this->start_controls_section(
				'section_item_product',
				[
					'label'      => __('Item Product', 'apr-core'),
					'tab'        => Controls_Manager::TAB_STYLE,
					'show_label' => false,
				]
			);
			$this->add_responsive_control(
				'bg_item_product',
				[
					'label'     => esc_html__('Background Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .product-content' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'item_border',
					'label'    => esc_html__('Border', 'apr-core'),
					'selector' => '{{WRAPPER}} .product-content',
				]
			);

			$this->add_control(
				'button_border_radius',
				[
					'label'      => __('Border Radius', 'elementor'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%'],
					'selectors'  => [
						'{{WRAPPER}} .product-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'item_product_padding',
				[
					'label'      => __('Padding', 'apr-core'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%', 'em'],
					'selectors'  => [
						'{{WRAPPER}} div.woocommerce ul.products li.product'                => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} body.woocommerce ul.products, {{WRAPPER}} ul.products' => 'margin: {{TOP}}{{UNIT}} -{{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} -{{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'item_product_margin',
				[
					'label'      => __('Margin', 'apr-core'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%', 'em'],
					'selectors'  => [
						'{{WRAPPER}} div.woocommerce ul.products li.product' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();
			$this->start_controls_section(
				'tab_list_item_style',
				[
					'label'     => __('Title Tab', 'apr-core'),
					'tab'       => Controls_Manager::TAB_STYLE,
					'condition' => [
						'product_layout!' => 'grid',
					],
				]

			);

			$this->add_control(
				'title_tab_align',
				[
					'label'     => __('Alignment', 'apr-core'),
					'type'      => Controls_Manager::CHOOSE,
					'default'   => 'center',
					'options'   => [
						'flex-start' => [
							'title' => __('Left', 'apr-core'),
							'icon'  => 'fa fa-align-left',
						],
						'center'     => [
							'title' => __('Center', 'apr-core'),
							'icon'  => 'fa fa-align-center',
						],
						'flex-end'   => [
							'title' => __('Right', 'apr-core'),
							'icon'  => 'fa fa-align-right',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .apr-product-tab .product-tab-header ul' => 'justify-content:{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'spacing_content_margin_bottom',
				[
					'label'      => __('Spacing Content Tabs', 'apr-core'),
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
					'size_units' => ['px'],
					'selectors'  => [
						'{{WRAPPER}} ul.apr-product-tab-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'item_padding',
				[
					'label'      => esc_html__('Padding', 'apr-core'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', 'em', '%'],
					'selectors'  => [
						'{{WRAPPER}} ul.apr-product-tab-title li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'item_margin',
				[
					'label'      => esc_html__('Margin', 'apr-core'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', 'em', '%'],
					'selectors'  => [
						'{{WRAPPER}} ul.apr-product-tab-title li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'show_separator_out',
				[
					'label'   => __('Show Separator Out', 'apr-core'),
					'type'    => Controls_Manager::SWITCHER,
					'default' => 'no',
				]
			);
			$this->add_control(
				'tab_product_title_dot_color',
				[
					'label'     => esc_html__('Separator Background Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} ul.apr-product-tab-title li:after,
                        {{WRAPPER}} ul.apr-product-tab-title li:before' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'tab_product_title_dot_width',
				[
					'label'     => __('Width Separator', 'apr-core'),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} ul.apr-product-tab-title li:after,
                        {{WRAPPER}} ul.apr-product-tab-title li:before' => 'width: {{SIZE}}{{UNIT}};right: calc(-{{SIZE}}{{UNIT}}/2);left: calc(-{{SIZE}}{{UNIT}}/2);',
					],
				]
			);
			$this->add_responsive_control(
				'tab_product_title_dot_height',
				[
					'label'     => __('Height Separator', 'apr-core'),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} ul.apr-product-tab-title li:after,
                        {{WRAPPER}} ul.apr-product-tab-title li:before' => 'height: {{SIZE}}{{UNIT}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'typography_title_tab',

					'selector' => '{{WRAPPER}} ul.apr-product-tab-title li',
				]
			);
			$this->start_controls_tabs('tab_product_title');
			// Normal State Tab
			$this->start_controls_tab('tab_product_title_normal', ['label' => esc_html__('Normal', 'apr-core')]);
			$this->add_control(
				'tab_product_title_color',
				[
					'label'     => esc_html__('Background Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} ul.apr-product-tab-title li' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'tab_product_title_text_color',
				[
					'label'     => esc_html__('Text Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} ul.apr-product-tab-title li' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'tab_product_title_border',
					'label'    => esc_html__('Border', 'apr-core'),
					'selector' => '{{WRAPPER}} ul.apr-product-tab-title li',
				]
			);
			$this->add_responsive_control(
				'tab_product_title_border_radius',
				[
					'label'      => esc_html__('Border Radius', 'apr-core'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', 'em', '%'],
					'selectors'  => [
						'{{WRAPPER}} ul.apr-product-tab-title li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_tab();
			// Hover State Tab
			$this->start_controls_tab('tab_product_title_hover', ['label' => esc_html__('Hover', 'apr-core')]);
			$this->add_control(
				'tab_product_title_color_hover',
				[
					'label'     => esc_html__('Background Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} ul.apr-product-tab-title li:hover' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'tab_product_title_text_color_hover',
				[
					'label'     => esc_html__('Text Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} ul.apr-product-tab-title li:hover' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'tab_product_title_border_hover',
					'label'    => esc_html__('Border', 'apr-core'),
					'selector' => '{{WRAPPER}} ul.apr-product-tab-title li:hover',
				]
			);
			$this->add_responsive_control(
				'tab_product_title_border_radius_hover',
				[
					'label'      => esc_html__('Border Radius', 'apr-core'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', 'em', '%'],
					'selectors'  => [
						'{{WRAPPER}} ul.apr-product-tab-title li:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_tab();
			// Active State Tab
			$this->start_controls_tab('tab_product_title_active', ['label' => esc_html__('Active', 'apr-core')]);
			$this->add_control(
				'tab_product_title_color_active',
				[
					'label'     => esc_html__('Background Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} ul.apr-product-tab-title li.item-current' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'tab_product_title_text_color_active',
				[
					'label'     => esc_html__('Text Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} ul.apr-product-tab-title li.item-current ' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'tab_product_title_border_active',
					'label'    => esc_html__('Border', 'apr-core'),
					'selector' => '{{WRAPPER}} ul.apr-product-tab-title li.item-current',
				]
			);
			$this->add_responsive_control(
				'tab_product_title_border_radius_active',
				[
					'label'      => esc_html__('Border Radius', 'apr-core'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', 'em', '%'],
					'selectors'  => [
						'{{WRAPPER}} ul.apr-product-tab-title li.item-current' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->end_controls_section();
			$this->start_controls_section(
				'product_image_style',
				[
					'label' => __('Product Image', 'apr-core'),
					'tab'   => Controls_Manager::TAB_STYLE,
				]

			);
			$this->add_responsive_control(
				'product_image_bg_color',
				[
					'label'     => esc_html__('Background Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .product-top, {{WRAPPER}} .wcvashopswatchlabel ' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'border_width_img_size',
				[
					'label'      => __('Border Width', 'apr-core'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px'],
					'default'    => [
						'top'    => '',
						'bottom' => '',
						'left'   => '',
						'right'  => '',
						'unit'   => 'px',
					],
					'selectors'  => [
						'{{WRAPPER}} ul.products .product-content .product-top' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'item_product_img_padding',
				[
					'label'      => __('Padding', 'apr-core'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%', 'em'],
					'selectors'  => [
						'{{WRAPPER}} div.woocommerce ul.products li.product .image-product' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();
			$this->start_controls_section(
				'section_content_product',
				[
					'label'      => __('Content Product', 'apr-core'),
					'tab'        => Controls_Manager::TAB_STYLE,
					'show_label' => false,
				]
			);
			$this->add_responsive_control(
				'content_align',
				[
					'label'     => __('Alignment', 'apr-core'),
					'type'      => Controls_Manager::CHOOSE,
					'options'   => [
						'left'    => [
							'title' => __('Left', 'apr-core'),
							'icon'  => 'eicon-text-align-left',
						],
						'center'  => [
							'title' => __('Center', 'apr-core'),
							'icon'  => 'eicon-text-align-center',
						],
						'right'   => [
							'title' => __('Right', 'apr-core'),
							'icon'  => 'eicon-text-align-right',
						],
						'justify' => [
							'title' => __('Justified', 'apr-core'),
							'icon'  => 'eicon-text-align-justify',
						],
					],
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} div.woocommerce .product-style ul.products .product-content .product-desc' => 'text-align: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'content_bg',
				[
					'label'     => esc_html__('Background Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .product-desc, {{WRAPPER}} .shopswatchinput' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'content_border',
					'selector' => '{{WRAPPER}} div.woocommerce .product-style ul.products .product-content .product-desc',
				]
			);
			$this->add_responsive_control(
				'content_padding',
				[
					'label'      => __('padding', 'apr-core'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%', 'em'],
					'selectors'  => [
						'{{WRAPPER}} div.woocommerce .product-style ul.products .product-content .product-desc'    => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
						'{{WRAPPER}} .product-style-1.product-style-5 .product-grid .product-desc .product-action' => 'margin-right:{{RIGHT}}{{UNIT}} ;',
					],
				]
			);
			$this->add_responsive_control(
				'content_margin',
				[
					'label'      => __('Margin', 'apr-core'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%', 'em'],
					'selectors'  => [
						'{{WRAPPER}} div.woocommerce .product-style ul.products .product-content .product-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'heading_style_wishlist',
				[
					'label'     => __('Wislist', 'apr-core'),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'product_type' => '1',
					],
				]
			);
			$this->add_control(
				'icon_size_wishlist',
				[
					'label'     => __('Font Size Wishlist', 'apr-core'),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'min' => 10,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .product-action .yith-wcwl-add-to-wishlist i,{{WRAPPER}} .yith-wcwl-wishlistaddedbrowse a:before, .yith-wcwl-wishlistexistsbrowse a:before ,{{WRAPPER}} .yith-wcwl-wishlistaddedbrowse a:before, .yith-wcwl-wishlistexistsbrowse a:before' => 'font-size: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'product_type' => '1',
					],
				]
			);
			$this->add_responsive_control(
				'wishlist_padding',
				[
					'label'      => __('Padding', 'apr-core'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%', 'em'],
					'selectors'  => [
						'{{WRAPPER}} .product-grid .product-desc .product-action .action-item.wishlist-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'  => [
						'product_type' => '1',
					],
				]
			);
			$this->add_responsive_control(
				'wishlist_margin',
				[
					'label'      => __('Margin', 'apr-core'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%', 'em'],
					'selectors'  => [
						'{{WRAPPER}} .product-grid .product-desc .product-action .action-item.wishlist-btn a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'  => [
						'product_type' => '1',
					],
				]
			);
			$this->start_controls_tabs('tab_wishlist');
			// Normal State Tab
			$this->start_controls_tab('tab_wishlist_normal', ['label' => esc_html__('Normal', 'apr-core')]);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'  => 'product_title_typo',
					'label' => __('Title', 'apr-core'),

					'selector' => '{{WRAPPER}} .product-grid .product-desc .woocommerce-loop-product__title .product-name,
                    {{WRAPPER}} .product-grid .product-desc .woocommerce-loop-product__title,
                     {{WRAPPER}} .woocommerce ul.products li.product .woocommerce-loop-product__title',
				]
			);
			$this->add_control(
				'tab_title_color',
				[
					'label'     => esc_html__('Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} div.woocommerce ul.products .product-content .product-desc .woocommerce-loop-product__title .product-name,
                        {{WRAPPER}} .woocommerce-loop-product__title' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'title_margin_bottom',
				[
					'label'      => __('Spacing', 'apr-core'),
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
					'size_units' => ['px'],
					'selectors'  => [
						'{{WRAPPER}} .woocommerce ul.products li.product .woocommerce-loop-product__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
					'separator'  => 'after',
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'  => 'product_price_typo',
					'label' => __('Price', 'apr-core'),

					'selector' => '{{WRAPPER}} div.woocommerce ul.products .product-content .product-desc .product-price .price,
                        {{WRAPPER}} div.woocommerce ul.products .product-content .product-desc .product-price .price ins',
				]
			);
			$this->add_control(
				'tab_price_color',
				[
					'label'     => esc_html__('Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} div.woocommerce ul.products .product-content .product-desc .product-price .price,
                        {{WRAPPER}} div.woocommerce ul.products .product-content .product-desc .product-price .price ins' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'  => 'regular_price_price_typo',
					'label' => __('Regular Price', 'apr-core'),

					'selector' => '{{WRAPPER}} div.woocommerce ul.products .product-content .product-desc .product-price .price del .amount',
				]
			);
			$this->add_control(
				'tab_regular_price_color',
				[
					'label'     => esc_html__('Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .product-grid .product-desc .product-price .price del .amount,
                         {{WRAPPER}} .woocommerce ul.products li.product .price del' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'  => 'unit_price_typo',
					'label' => __('Unit Price', 'apr-core'),

					'selector' => '{{WRAPPER}} .unit_price',
				]
			);
			$this->add_control(
				'unit_price_color',
				[
					'label'     => esc_html__('Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .unit_price' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'price_product_margin_bottom',
				[
					'label'      => __('Spacing', 'apr-core'),
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
					'size_units' => ['px'],
					'selectors'  => [
						'{{WRAPPER}} div.woocommerce ul.products .product-content .product-desc .product-price' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
					'separator'  => 'after',
				]
			);
			$this->add_responsive_control(
				'price_product_padding_top',
				[
					'label'      => __('Top Spacing ', 'apr-core'),
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
					'size_units' => ['px'],
					'selectors'  => [
						'{{WRAPPER}} div.woocommerce ul.products .product-content .product-desc .product-price' => 'padding-top: {{SIZE}}{{UNIT}};',
					],
					'separator'  => 'after',
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'  => 'category_typo',
					'label' => __('Category', 'apr-core'),

					'selector'  => '{{WRAPPER}} div.woocommerce ul.products .product-content .product-desc .category-product a,{{WRAPPER}} ul.products .show-attribute p',
					'condition' => [
						'show_category_product' => 'yes',
					],
				]
			);
			$this->add_control(
				'tab_category_color',
				[
					'label'     => esc_html__('Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .product-grid .product-desc .category-product a,
                         {{WRAPPER}} ul.products .show-attribute p' => 'color: {{VALUE}};',
					],
					'condition' => [
						'show_category_product' => 'yes',
					],
				]
			);

			$this->add_responsive_control(
				'category_product_margin_bottom',
				[
					'label'      => __('Spacing', 'apr-core'),
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
					'size_units' => ['px'],
					'selectors'  => [
						'{{WRAPPER}} div.woocommerce ul.products .product-content .product-desc .category-product' => 'padding-bottom: {{SIZE}}{{UNIT}};',
					],
					'separator'  => 'after',
					'condition'  => [
						'show_category_product' => 'yes',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'  => 'product_button_typo',
					'label' => __('Button add to cart', 'apr-core'),

					'selector' => '{{WRAPPER}} div.woocommerce ul.products .product-action .action-item .add-cart-btn a',
				]
			);
			$this->add_control(
				'tab_button_color',
				[
					'label'     => esc_html__('Button Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} div.woocommerce ul.products .product-action .action-item .add-cart-btn a' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'tab_button_bg_color',
				[
					'label'     => esc_html__('Button Background Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} div.woocommerce ul.products .product-action .action-item .add-cart-btn a' => 'background: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'      => 'tab_button_border',
					'selector'  => '{{WRAPPER}} div.woocommerce ul.products .product-action .action-item .add-cart-btn a',
					'separator' => 'before',
				]
			);
			$this->add_responsive_control(
				'tab_padding_button',
				[
					'label'      => __('Button Padding', 'apr-core'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', 'em', '%'],
					'selectors'  => [
						'{{WRAPPER}} div.woocommerce ul.products .product-action .action-item .add-cart-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'  => 'attribute_typo',
					'label' => __('Attribute', 'apr-core'),

					'selector'  => '{{WRAPPER}} div.woocommerce ul.products .product-content .product-desc .name-attr',
					'condition' => [
						'show_attribute_on_title' => 'yes',
					],
				]
			);
			$this->add_control(
				'tab_attr_color',
				[
					'label'     => esc_html__('Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} div.woocommerce ul.products .product-content .product-desc .name-attr' => 'color: {{VALUE}};',
					],
					'condition' => [
						'show_attribute_on_title' => 'yes',
					],
				]
			);


			$this->add_control(
				'tab_wishlist_bg_color',
				[
					'label'     => esc_html__('Background Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .product-grid .product-desc .product-action .action-item.wishlist-btn a' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'product_type' => '1',
					],
				]
			);

			$this->add_control(
				'tab_wishlist_color',
				[
					'label'     => esc_html__('Text Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .product-grid .product-desc .product-action .action-item.wishlist-btn a' => 'color: {{VALUE}};',
					],
					'condition' => [
						'product_type' => '1',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'      => 'tab_wishlist_border',
					'label'     => esc_html__('Border', 'apr-core'),
					'selector'  => '{{WRAPPER}} .product-grid .product-desc .product-action .action-item.wishlist-btn a',
					'condition' => [
						'product_type' => '1',
					],
				]
			);
			$this->add_responsive_control(
				'tab_wishlist_border_radius',
				[
					'label'      => esc_html__('Border Radius', 'apr-core'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', 'em', '%'],
					'selectors'  => [
						'{{WRAPPER}} .product-grid .product-desc .product-action .action-item.wishlist-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

					],
					'condition'  => [
						'product_type' => '1',
					],
				]
			);
			$this->end_controls_tab();
			// Hover State Tab
			$this->start_controls_tab('tab_wishlist_hover', ['label' => esc_html__('Hover', 'apr-core')]);

			$this->add_control(
				'tab_title_color_hover',
				[
					'label'     => esc_html__('Title Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} div.woocommerce ul.products .product-content .product-desc .woocommerce-loop-product__title .product-name:hover' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'tab_category_color_hover',
				[
					'label'     => esc_html__('Category Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .div.woocommerce ul.products .product-content .product-desc .category-product a:hover' => 'color: {{VALUE}};',
					],
					'condition' => [
						'show_category_product' => 'yes',
					],
				]
			);
			$this->add_control(
				'tab_button_hover_color',
				[
					'label'     => esc_html__('Button Hover Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} div.woocommerce ul.products .product-action .action-item .add-cart-btn a:hover' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'tab_button_bg_hover_color',
				[
					'label'     => esc_html__('Button Background Hover Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} div.woocommerce ul.products .product-action .action-item .add-cart-btn a:hover' => 'background: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'tab_button_hover_border',
					'selector' => '{{WRAPPER}} div.woocommerce ul.products .product-action .action-item .add-cart-btn a:hover',
				]
			);
			$this->add_control(
				'tab_wishlist_bg_color_hover',
				[
					'label'     => esc_html__('Background Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .product-grid .product-desc .product-action .action-item.wishlist-btn a:hover' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'product_type' => '1',
					],
				]
			);
			$this->add_control(
				'tab_wishlist_color_hover',
				[
					'label'     => esc_html__('Text Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .product-grid .product-desc .product-action .action-item.wishlist-btn a:hover,
                         {{WRAPPER}} .product-action .yith-wcwl-wishlistaddedbrowse a:hover:before,
                          {{WRAPPER}} .product-action .yith-wcwl-wishlistexistsbrowse a:hover:before' => 'color: {{VALUE}};',
					],
					'condition' => [
						'product_type' => '1',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'      => 'tab_wishlist_border_hover',
					'label'     => esc_html__('Border', 'apr-core'),
					'selector'  => '{{WRAPPER}} .product-grid .product-desc .product-action .action-item.wishlist-btn a:hover',
					'condition' => [
						'product_type' => '1',
					],
				]
			);
			$this->add_responsive_control(
				'tab_wishlist_border_radius_hover',
				[
					'label'      => esc_html__('Border Radius', 'apr-core'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', 'em', '%'],
					'selectors'  => [
						'{{WRAPPER}} .product-grid .product-desc .product-action .action-item.wishlist-btn a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'  => [
						'product_type' => '1',
					],
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_control(
				'color_star_rating',
				[
					'label'     => esc_html__('Star Rating Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} div.woocommerce ul.products .star-rating::before,
                        {{WRAPPER}} div.woocommerce ul.products .star-rating span::before
                        ' => 'color: {{VALUE}};',
					],
				]
			);
			$this->end_controls_section();
			// style section descriptions
			$this->start_controls_section(
				'section_style_description',
				[
					'label'     => __('Descriptions', 'apr-core'),
					'tab'       => Controls_Manager::TAB_STYLE,
					'condition' => [
						'product_type'              => '8',
						'show_product_descriptions' => 'yes',
					],
				]
			);
			$this->add_control(
				'description_color',
				[
					'label'     => __('Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .product-content .product-description' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'description_typo',
					'label'    => __('Typography', 'apr-core'),
					'selector' => '{{WRAPPER}} .product-content .product-description',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'description_border',
					'label'    => esc_html__('Border', 'apr-core'),
					'selector' => '{{WRAPPER}} .product-content .product-description',
				]
			);
			$this->add_responsive_control(
				'description_padding',
				[
					'label'      => __('Padding', 'apr-core'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%', 'em'],
					'selectors'  => [
						'{{WRAPPER}} .product-content .product-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'description_margin',
				[
					'label'      => esc_html__('Margin', 'apr-core'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', 'em', '%'],
					'selectors'  => [
						'{{WRAPPER}} .product-content .product-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();
			// end style section description

			$this->start_controls_section(
				'section_style_navigation',
				[
					'label'     => __('Navigation ', 'apr-core'),
					'tab'       => Controls_Manager::TAB_STYLE,
					'condition' => [
						'navigation'  => ['arrows', 'dots', 'both'],
						'show_slider' => 'yes',
					],
				]
			);

			$this->add_control(
				'heading_style_arrows',
				[
					'label'     => __('Arrows', 'apr-core'),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'navigation' => ['arrows', 'both'],
					],
				]
			);
			$this->add_responsive_control(
				'button_arrows_size',
				[
					'label'     => __('Button Icon Size', 'apr-core'),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'min' => 10,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .apr-product .slick-slider .slick-arrow i' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .apr-product .slick-slider .slick-arrow '  => 'width: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'navigation' => ['arrows', 'both'],
					],
				]
			);
			$this->add_responsive_control(
				'arrows_size',
				[
					'label'     => __('Size', 'apr-core'),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'min' => 20,
							'max' => 60,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .apr-product .slick-slider .slick-arrow, {{WRAPPER}} .apr-product .slick-slider .slick-arrow i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'navigation' => ['arrows', 'both'],
					],
				]
			);
			$this->start_controls_tabs('tab_arrow');
			$this->start_controls_tab(
				'tab_arrow_normal',
				[
					'label' => __('Normal', 'apr-core'),
				]
			);
			$this->add_control(
				'arrows_color',
				[
					'label'     => __('Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .apr-product .slick-slider .slick-arrow i' => 'color: {{VALUE}};',
					],
					'condition' => [
						'navigation' => ['arrows', 'both'],
					],
				]
			);
			$this->add_control(
				'arrows_bg_color',
				[
					'label'     => __('Background Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .apr-product .slick-slider .slick-arrow i' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'navigation' => ['arrows', 'both'],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        => 'arr_border',
					'label'       => __('Border', 'apr-core'),
					'placeholder' => '1px',
					'default'     => '1px',
					'selector'    => '{{WRAPPER}} .apr-product .slick-slider .slick-arrow i',
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'tab_arrow_hover',
				[
					'label' => __('Hover', 'apr-core'),
				]
			);
			$this->add_control(
				'arrows_color_hover',
				[
					'label'     => __('Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .apr-product .slick-slider .slick-arrow i:hover,{{WRAPPER}} .apr-product .slick-slider .slick-arrow i:focus' => 'color: {{VALUE}};',
					],
					'condition' => [
						'navigation' => ['arrows', 'both'],
					],
				]
			);
			$this->add_control(
				'arrows_bg_color_hover',
				[
					'label'     => __('Background Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .apr-product .slick-slider .slick-arrow i:hover,{{WRAPPER}} .apr-product .slick-slider .slick-arrow i:focus' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'navigation' => ['arrows', 'both'],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        => 'arr_border_hover',
					'label'       => __('Border', 'apr-core'),
					'placeholder' => '1px',
					'default'     => '1px',
					'selector'    => '{{WRAPPER}} .apr-product .slick-slider .slick-arrow:hover i,{{WRAPPER}} .apr-product .slick-slider .slick-arrow:focus i',
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->add_control(
				'heading_style_dots',
				[
					'label'     => __('Dots', 'apr-core'),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'navigation' => ['dots', 'both'],
					],
				]
			);
			$this->add_control(
				'dots_size',
				[
					'label'     => __('Size', 'apr-core'),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'min' => 5,
							'max' => 30,
						],
					],
					'selectors' => [
						'{{WRAPPER}}  .slick-dots li button' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'navigation' => ['dots', 'both'],
					],
				]
			);

			$this->add_control(
				'dots_color',
				[
					'label'     => __('Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .slick-dots li button' => 'background: {{VALUE}};',
					],
					'condition' => [
						'navigation' => ['dots', 'both'],
					],
				]
			);
			$this->end_controls_section();
			$this->start_controls_section(
				'add_to_cart_btn',
				[
					'label'     => __('Button Add to cart  ', 'apr-core'),
					'tab'       => Controls_Manager::TAB_STYLE,
					'condition' => [
						'product_type' => ['default', '2', '3', '4'],
					],
				]
			);
			$this->add_responsive_control(
				'add_to_cart_btn_padding',
				[
					'label'      => __('Padding', 'apr-core'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', '%', 'em'],
					'selectors'  => [
						'{{WRAPPER}} div.woocommerce ul.products  .product-action .action-item .add-cart-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'  => 'add_to_cart_btn_typography',
					'label' => __('Typography', 'apr-core'),

					'selector' => '{{WRAPPER}} div.woocommerce ul.products .product-action .action-item .add-cart-btn a',
				]
			);
			$this->start_controls_tabs(
				'tabs_add_to_cart_btn_style'
			);

			$this->start_controls_tab(
				'tab_add_to_cart_btn_normal',
				[
					'label' => __('Normal', 'apr-core'),
				]
			);
			$this->add_control(
				'add_to_cart_btn_color',
				[
					'label' => __('Color', 'apr-core'),
					'type'  => Controls_Manager::COLOR,

					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} div.woocommerce ul.products .product-action .action-item .add-cart-btn a, {{WRAPPER}} .product-grid .product-top .product-action .action-item .add-cart-btn a:before' => 'color: {{VALUE}};',
					],

				]
			);
			$this->add_control(
				'add_to_cart_btn_bg_color',
				[
					'label'     => __('Background Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} div.woocommerce ul.products .product-action .action-item .add-cart-btn a' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        => 'add_to_cart_btn_border',
					'label'       => __('Border', 'apr-core'),
					'placeholder' => '1px',
					'default'     => '1px',
					'selector'    => '{{WRAPPER}} div.woocommerce ul.products .product-action .action-item .add-cart-btn a',
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'tab_add_to_cart_btn_hover',
				[
					'label' => __('Hover', 'apr-core'),
				]
			);
			$this->add_control(
				'add_to_cart_btn_hover_color',
				[
					'label' => __('Color', 'apr-core'),
					'type'  => Controls_Manager::COLOR,

					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} div.woocommerce ul.products .product-action .action-item .add-cart-btn a:hover,
                        {{WRAPPER}} .product-grid .product-top .product-action .action-item .add-cart-btn a:hover:before' => 'color: {{VALUE}};',
					],

				]
			);
			$this->add_control(
				'add_to_cart_btn_hover_bg_color',
				[
					'label'     => __('Background Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						' {{WRAPPER}} div.woocommerce ul.products .product-action .action-item .add-cart-btn a:hover,
                        {{WRAPPER}} .product-grid .product-action .action-item .add-cart-btn a:hover' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        => 'add_to_cart_btn_hover_border',
					'label'       => __('Border', 'apr-core'),
					'placeholder' => '1px',
					'default'     => '1px',
					'selector'    => '{{WRAPPER}} div.woocommerce ul.products .product-action .action-item .add-cart-btn a:hover,{{WRAPPER}} .product-grid .product-action .action-item .add-cart-btn a:hover',
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->end_controls_section();
			//Style 2
			$this->start_controls_section(
				'product_action_2',
				[
					'label'     => __('Quick View, Add to cart, Campare', 'apr-core'),
					'tab'       => Controls_Manager::TAB_STYLE,
					'condition' => [
						'product_type' => ['1', '5'],
					],
				]
			);
			$this->add_control(
				'add_to_cart_2',
				[
					'label'     => __('Add to cart', 'apr-core'),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->start_controls_tabs(
				'tabs_add_to_cart_btn_style_2'
			);

			$this->start_controls_tab(
				'tab_add_to_cart_btn_normal_2',
				[
					'label' => __('Normal', 'apr-core'),
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'  => 'user_name_typo',
					'label' => __('Typography', 'apr-core'),

					'selector'  => '{{WRAPPER}} .show-add-to-cart-bottom div.woocommerce ul.products .product-content .product-desc .product-action .add-cart a',
					'condition' => [
						'show_add_to_cart_bottom' => 'yes',
					],
				]
			);
			$this->add_control(
				'add_to_cart_btn_color_2',
				[
					'label' => __('Color', 'apr-core'),
					'type'  => Controls_Manager::COLOR,

					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .product-grid .product-top .product-action .action-item .add-cart-btn a:before' => 'color: {{VALUE}};',
					],
					'condition' => [
						'show_add_to_cart_bottom!' => 'yes',
					],
				]
			);
			$this->add_control(
				'add_to_cart_btn_color_2_bottom',
				[
					'label' => __('Color', 'apr-core'),
					'type'  => Controls_Manager::COLOR,

					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .show-add-to-cart-bottom div.woocommerce ul.products .product-content .product-desc .product-action .add-cart a' => 'color: {{VALUE}};',
					],
					'condition' => [
						'show_add_to_cart_bottom' => 'yes',
					],
				]
			);

			$this->add_control(
				'add_to_cart_btn_bg_color_2',
				[
					'label'     => __('Background Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .product-grid .product-top .product-action .action-item .add-cart-btn a' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'show_add_to_cart_bottom!' => 'yes',
					],
				]
			);

			$this->add_control(
				'add_to_cart_btn_bg_color_2_bottom',
				[
					'label'     => __('Background Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .show-add-to-cart-bottom div.woocommerce ul.products .product-content .product-desc .product-action .add-cart a' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'show_add_to_cart_bottom' => 'yes',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        => 'add_to_cart_btn_border_2',
					'label'       => __('Border', 'apr-core'),
					'placeholder' => '1px',
					'default'     => '1px',
					'selector'    => '{{WRAPPER}} .product-grid .product-top .product-action .action-item .add-cart-btn a',
					'condition'   => [
						'show_add_to_cart_bottom!' => 'yes',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'      => 'add_to_cart_btn_border_2_bottom',
					'label'     => __('Border', 'apr-core'),
					'selector'  => '{{WRAPPER}} .show-add-to-cart-bottom div.woocommerce ul.products .product-content .product-desc .product-action .add-cart a',
					'condition' => [
						'show_add_to_cart_bottom' => 'yes',
					],
				]
			);

			$this->add_responsive_control(
				'margin_add_to_cart_btn_2_bottom',
				[
					'label'      => esc_html__('Margin', 'apr-core'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', 'em', '%'],
					'selectors'  => [
						'{{WRAPPER}} .show-add-to-cart-bottom div.woocommerce ul.products .product-content .product-desc .product-action' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'padding_add_to_cart_btn_2_bottom',
				[
					'label'      => esc_html__('Padding', 'apr-core'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', 'em', '%'],
					'selectors'  => [
						'{{WRAPPER}} .show-add-to-cart-bottom div.woocommerce ul.products .product-content .product-desc .product-action .add-cart a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_tab();
			$this->start_controls_tab(
				'tab_add_to_cart_btn_hover_2',
				[
					'label' => __('Hover', 'apr-core'),
				]
			);
			$this->add_control(
				'add_to_cart_btn_hover_color_2',
				[
					'label' => __('Color', 'apr-core'),
					'type'  => Controls_Manager::COLOR,

					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} div.woocommerce ul.products .product-action .action-item .add-cart-btn a:hover,{{WRAPPER}} .product-grid .product-top .product-action .action-item .add-cart-btn a:hover:before' => 'color: {{VALUE}};',
					],
					'condition' => [
						'show_add_to_cart_bottom!' => 'yes',
					],
				]
			);
			$this->add_control(
				'add_to_cart_btn_hover_color_2_bottom',
				[
					'label' => __('Color', 'apr-core'),
					'type'  => Controls_Manager::COLOR,

					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} div.woocommerce ul.products .product-action .action-item .add-cart-btn a:hover,{{WRAPPER}} .show-add-to-cart-bottom div.woocommerce ul.products .product-content .product-desc .product-action .add-cart a:hover' => 'color: {{VALUE}};',
					],
					'condition' => [
						'show_add_to_cart_bottom' => 'yes',
					],
				]
			);
			$this->add_control(
				'add_to_cart_btn_hover_bg_color_2',
				[
					'label'     => __('Background Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} div.woocommerce ul.products .product-action .action-item .add-cart-btn a:hover, {{WRAPPER}} .product-grid .product-top .product-action .action-item .add-cart-btn a:hover' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'show_add_to_cart_bottom!' => 'yes',
					],
				]
			);

			$this->add_control(
				'add_to_cart_btn_hover_bg_color_2_bottom',
				[
					'label'     => __('Background Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} div.woocommerce ul.products .product-action .action-item .add-cart-btn a:hover, {{WRAPPER}} .show-add-to-cart-bottom div.woocommerce ul.products .product-content .product-desc .product-action .add-cart a:hover' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'show_add_to_cart_bottom' => 'yes',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        => 'add_to_cart_btn_hover_border_2',
					'label'       => __('Border', 'apr-core'),
					'placeholder' => '1px',
					'default'     => '1px',
					'selector'    => '{{WRAPPER}} div.woocommerce ul.products .product-action .action-item .add-cart-btn a:hover,{{WRAPPER}} .product-grid .product-top .product-action .action-item .add-cart-btn a:hover',
					'condition'   => [
						'show_add_to_cart_bottom!' => 'yes',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'      => 'add_to_cart_btn_hover_border_2_bottom',
					'label'     => __('Border', 'apr-core'),
					'selector'  => '{{WRAPPER}} .show-add-to-cart-bottom div.woocommerce ul.products .product-content .product-desc .product-action .add-cart a:hover',
					'condition' => [
						'show_add_to_cart_bottom' => 'yes',
					],
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			//quick view
			$this->add_control(
				'quickview_title_2',
				[
					'label'     => __('Quick View', 'apr-core'),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'show_quickview' => 'yes',
					],
				]
			);
			$this->start_controls_tabs(
				'tabs_quickview_btn_style_2'
			);

			$this->start_controls_tab(
				'tab_quickview_normal_2',
				[
					'label'     => __('Normal', 'apr-core'),
					'condition' => [
						'show_quickview' => 'yes',
					],
				]
			);
			$this->add_control(
				'quickview_btn_color_2',
				[
					'label' => __('Color', 'apr-core'),
					'type'  => Controls_Manager::COLOR,

					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .product-grid .product-top .product-action .quick-view a' => 'color: {{VALUE}};',
					],
					'condition' => [
						'show_quickview' => 'yes',
					],

				]
			);
			$this->add_control(
				'quickview_btn_bg_color_2',
				[
					'label'     => __('Background Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .product-grid .product-top .product-action .quick-view a' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'show_quickview' => 'yes',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        => 'quickview_btn_border_2',
					'label'       => __('Border', 'apr-core'),
					'placeholder' => '1px',
					'default'     => '1px',
					'selector'    => '{{WRAPPER}} .product-grid .product-top .product-action .quick-view a',
					'condition'   => [
						'show_quickview' => 'yes',
					],
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'tab_quickview_btn_hover_2',
				[
					'label'     => __('Hover', 'apr-core'),
					'condition' => [
						'show_quickview' => 'yes',
					],
				]
			);
			$this->add_control(
				'quickview_hover_color_2',
				[
					'label' => __('Color', 'apr-core'),
					'type'  => Controls_Manager::COLOR,

					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .product-grid .product-top .product-action .quick-view a:hover' => 'color: {{VALUE}};',
					],
					'condition' => [
						'show_quickview' => 'yes',
					],

				]
			);
			$this->add_control(
				'quickview_hover_bg_color_2',
				[
					'label'     => __('Background Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .product-grid .product-top .product-action .quick-view a:hover' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'show_quickview' => 'yes',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        => 'quickview_hover_border_2',
					'label'       => __('Border', 'apr-core'),
					'placeholder' => '1px',
					'default'     => '1px',
					'selector'    => '{{WRAPPER}} .product-grid .product-top .product-action .quick-view a:hover',
					'condition'   => [
						'show_quickview' => 'yes',
					],
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();

			//Campare
			$this->add_control(
				'campare_title_2',
				[
					'label'     => __('Campare', 'apr-core'),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'show_compare' => 'yes',
					],
				]
			);
			$this->start_controls_tabs(
				'tabs_campare_btn_style_2'
			);

			$this->start_controls_tab(
				'tab_campare_normal_2',
				[
					'label'     => __('Normal', 'apr-core'),
					'condition' => [
						'show_compare' => 'yes',
					],
				]
			);
			$this->add_control(
				'campare_btn_color_2',
				[
					'label' => __('Color', 'apr-core'),
					'type'  => Controls_Manager::COLOR,

					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} div.woocommerce ul.products .product-content  .product-action .group-action .compare-product a' => 'color: {{VALUE}};',
					],
					'condition' => [
						'show_compare' => 'yes',
					],

				]
			);
			$this->add_control(
				'campare_btn_bg_color_2',
				[
					'label'     => __('Background Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} div.woocommerce ul.products .product-content .product-action .group-action .compare-product a' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'show_compare' => 'yes',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        => 'campare_btn_border_2',
					'label'       => __('Border', 'apr-core'),
					'placeholder' => '1px',
					'default'     => '1px',
					'selector'    => '{{WRAPPER}} div.woocommerce ul.products .product-content .product-action .group-action .compare-product a',
					'condition'   => [
						'show_compare' => 'yes',
					],
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'tab_campare_btn_hover_2',
				[
					'label'     => __('Hover', 'apr-core'),
					'condition' => [
						'show_compare' => 'yes',
					],
				]
			);
			$this->add_control(
				'campare_hover_color_2',
				[
					'label' => __('Color', 'apr-core'),
					'type'  => Controls_Manager::COLOR,

					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} div.woocommerce ul.products .product-content .product-action .group-action .compare-product a:hover' => 'color: {{VALUE}};',
					],
					'condition' => [
						'show_compare' => 'yes',
					],

				]
			);
			$this->add_control(
				'campare_hover_bg_color_2',
				[
					'label'     => __('Background Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} div.woocommerce ul.products .product-content .product-action .group-action .compare-product a:hover' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'show_compare' => 'yes',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        => 'campare_hover_border_2',
					'label'       => __('Border', 'apr-core'),
					'placeholder' => '1px',
					'default'     => '1px',
					'selector'    => '{{WRAPPER}} div.woocommerce ul.products .product-content .product-action .group-action .compare-product a:hover',
					'condition'   => [
						'show_compare' => 'yes',
					],
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->end_controls_section();

			//Default,2,3,4
			$this->start_controls_section(
				'product_action',
				[
					'label'     => __('Quick View, Campare, Wishlist', 'apr-core'),
					'tab'       => Controls_Manager::TAB_STYLE,
					'condition' => [
						'product_type' => ['default', '2', '3', '4'],
					],
				]
			);
			$this->add_control(
				'quickview_title',
				[
					'label'     => __('Quick View', 'apr-core'),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'show_quickview' => 'yes',
					],
				]
			);
			$this->start_controls_tabs(
				'tabs_quickview_btn_style'
			);

			$this->start_controls_tab(
				'tab_quickview_normal',
				[
					'label'     => __('Normal', 'apr-core'),
					'condition' => [
						'show_quickview' => 'yes',
					],
				]
			);
			$this->add_control(
				'quickview_btn_color',
				[
					'label' => __('Color', 'apr-core'),
					'type'  => Controls_Manager::COLOR,

					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} div.woocommerce ul.products .product-content .product-desc .product-action .group-action .quick-view a, 
                        {{WRAPPER}} .product-grid .product-content .product-top .group-action .quick-view a' => 'color: {{VALUE}};',
					],
					'condition' => [
						'show_quickview' => 'yes',
					],

				]
			);
			$this->add_control(
				'quickview_btn_bg_color',
				[
					'label'     => __('Background Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} div.woocommerce ul.products .product-content .product-action .group-action .quick-view a' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'show_quickview' => 'yes',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        => 'quickview_btn_border',
					'label'       => __('Border', 'apr-core'),
					'placeholder' => '1px',
					'default'     => '1px',
					'selector'    => '{{WRAPPER}} div.woocommerce ul.products .product-content .product-action .group-action .quick-view a',
					'condition'   => [
						'show_quickview' => 'yes',
					],
				]
			);
			$this->add_responsive_control(
				'padding_quickview',
				[
					'label'      => esc_html__('Padding', 'apr-core'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', 'em', '%'],
					'selectors'  => [
						'{{WRAPPER}} div.woocommerce ul.products .product-content .product-action .group-action .quick-view a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'  => [
						'show_quickview' => 'yes',
					],
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'tab_quickview_btn_hover',
				[
					'label'     => __('Hover', 'apr-core'),
					'condition' => [
						'show_quickview' => 'yes',
					],
				]
			);
			$this->add_control(
				'quickview_hover_color',
				[
					'label' => __('Color', 'apr-core'),
					'type'  => Controls_Manager::COLOR,

					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} div.woocommerce ul.products .product-content .product-action .group-action .quick-view a:hover' => 'color: {{VALUE}};',
					],
					'condition' => [
						'show_quickview' => 'yes',
					],

				]
			);
			$this->add_control(
				'quickview_hover_bg_color',
				[
					'label'     => __('Background Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} div.woocommerce ul.products .product-content .product-action .group-action .quick-view a:hover' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'show_quickview' => 'yes',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        => 'quickview_hover_border',
					'label'       => __('Border', 'apr-core'),
					'placeholder' => '1px',
					'default'     => '1px',
					'selector'    => '{{WRAPPER}} div.woocommerce ul.products .product-content .product-action .group-action .quick-view a:hover',
					'condition'   => [
						'show_quickview' => 'yes',
					],
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			//Campare
			$this->add_control(
				'campare_title',
				[
					'label'     => __('Campare', 'apr-core'),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'show_compare' => 'yes',
					],
				]
			);
			$this->start_controls_tabs(
				'tabs_campare_btn_style'
			);

			$this->start_controls_tab(
				'tab_campare_normal',
				[
					'label'     => __('Normal', 'apr-core'),
					'condition' => [
						'show_compare' => 'yes',
					],
				]
			);
			$this->add_control(
				'campare_btn_color',
				[
					'label' => __('Color', 'apr-core'),
					'type'  => Controls_Manager::COLOR,

					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} div.woocommerce ul.products .product-content .product-action .group-action .compare-product a' => 'color: {{VALUE}};',
					],
					'condition' => [
						'show_compare' => 'yes',
					],

				]
			);
			$this->add_control(
				'campare_btn_bg_color',
				[
					'label'     => __('Background Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} div.woocommerce ul.products .product-content .product-action .group-action .compare-product a' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'show_compare' => 'yes',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        => 'campare_btn_border',
					'label'       => __('Border', 'apr-core'),
					'placeholder' => '1px',
					'default'     => '1px',
					'selector'    => '{{WRAPPER}} div.woocommerce ul.products .product-content .product-action .group-action .compare-product a',
					'condition'   => [
						'show_compare' => 'yes',
					],
				]
			);

			$this->add_responsive_control(
				'padding_campare',
				[
					'label'      => esc_html__('Padding', 'apr-core'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', 'em', '%'],
					'selectors'  => [
						'{{WRAPPER}} div.woocommerce ul.products .product-content .product-action .group-action .compare-product a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'  => [
						'show_compare' => 'yes',
					],
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'tab_campare_btn_hover',
				[
					'label'     => __('Hover', 'apr-core'),
					'condition' => [
						'show_compare' => 'yes',
					],
				]
			);
			$this->add_control(
				'campare_hover_color',
				[
					'label' => __('Color', 'apr-core'),
					'type'  => Controls_Manager::COLOR,

					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} div.woocommerce ul.products .product-content .product-desc .product-action .group-action .compare-product a:hover,
                        {{WRAPPER}} div.woocommerce ul.products .product-content .product-action .group-action .compare-product a:hover,
                         {{WRAPPER}} div.woocommerce ul.products .product-content .product-action .group-action .compare-product a:hover:before' => 'color: {{VALUE}};',
					],
					'condition' => [
						'show_compare' => 'yes',
					],

				]
			);
			$this->add_control(
				'campare_hover_bg_color',
				[
					'label'     => __('Background Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} div.woocommerce ul.products .product-content .product-action .group-action .compare-product a:hover' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'show_compare' => 'yes',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        => 'campare_hover_border',
					'label'       => __('Border', 'apr-core'),
					'placeholder' => '1px',
					'default'     => '1px',
					'selector'    => '{{WRAPPER}} div.woocommerce ul.products .product-content .product-action .group-action .compare-product a:hover',
					'condition'   => [
						'show_compare' => 'yes',
					],
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			//Wishlist
			$this->add_control(
				'wishlist_title',
				[
					'label'     => __('Wishlist', 'apr-core'),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'show_wishlist' => 'yes',
					],
				]
			);
			$this->start_controls_tabs(
				'tabs_wishlist_btn_style'
			);

			$this->start_controls_tab(
				'tab_wishlist_btn_normal',
				[
					'label'     => __('Normal', 'apr-core'),
					'condition' => [
						'show_wishlist' => 'yes',
					],
				]
			);
			$this->add_control(
				'wishlist_btn_color',
				[
					'label' => __('Color', 'apr-core'),
					'type'  => Controls_Manager::COLOR,

					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} div.woocommerce ul.products .product-content .product-action .group-action .wishlist-btn a,
                        {{WRAPPER}} .product-grid .product-top .product-action .group-action .action-item .yith-wcwl-wishlistaddedbrowse a:before,
                        {{WRAPPER}} .product-action .yith-wcwl-wishlistaddedbrowse a:before,
                        {{WRAPPER}} .product-action .yith-wcwl-wishlistexistsbrowse a:before' => 'color: {{VALUE}};',
					],
					'condition' => [
						'show_wishlist' => 'yes',
					],

				]
			);
			$this->add_control(
				'wishlist_btn_bg_color',
				[
					'label'     => __('Background Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} div.woocommerce ul.products .product-content .product-action .group-action .wishlist-btn a' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'show_wishlist' => 'yes',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        => 'wishlist_btn_border',
					'label'       => __('Border', 'apr-core'),
					'placeholder' => '1px',
					'default'     => '1px',
					'selector'    => '{{WRAPPER}} div.woocommerce ul.products .product-content .product-action .group-action .wishlist-btn a',
					'condition'   => [
						'show_wishlist' => 'yes',
					],
				]
			);

			$this->add_responsive_control(
				'padding_wishlist',
				[
					'label'      => esc_html__('Padding', 'apr-core'),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => ['px', 'em', '%'],
					'selectors'  => [
						'{{WRAPPER}} div.woocommerce ul.products .product-content .product-action .group-action .wishlist-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'  => [
						'show_wishlist' => 'yes',
					],
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'tab_wishlist_btn_hover',
				[
					'label'     => __('Hover', 'apr-core'),
					'condition' => [
						'show_wishlist' => 'yes',
					],
				]
			);
			$this->add_control(
				'wishlist_hover_color',
				[
					'label' => __('Color', 'apr-core'),
					'type'  => Controls_Manager::COLOR,

					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} div.woocommerce ul.products .product-content .product-action .group-action .wishlist-btn a:hover,
                        {{WRAPPER}} .product-action .yith-wcwl-wishlistexistsbrowse a:hover:before' => 'color: {{VALUE}};',
					],
					'condition' => [
						'show_wishlist' => 'yes',
					],

				]
			);
			$this->add_control(
				'wishlist_hover_bg_color',
				[
					'label'     => __('Background Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} div.woocommerce ul.products .product-content .product-action .group-action .wishlist-btn a:hover' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'show_wishlist' => 'yes',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        => 'wishlist_hover_border',
					'label'       => __('Border', 'apr-core'),
					'placeholder' => '1px',
					'default'     => '1px',
					'selector'    => '{{WRAPPER}} div.woocommerce ul.products .product-content .product-action .group-action .wishlist-btn a:hover',
					'condition'   => [
						'show_wishlist' => 'yes',
					],
				]
			);
			$this->end_controls_tab();
			$this->end_controls_tabs();
			$this->end_controls_section();

			$this->start_controls_section(
				'button_loadmore',
				[
					'label'     => __('Button Load More', 'apr-core'),
					'tab'       => Controls_Manager::TAB_STYLE,
					'condition' => [
						'show_btn_loadmore_product' => 'yes',
					],
				]

			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'button_loadmore_typo',

					'selector' => '{{WRAPPER}} .view-more-button',
				]
			);
			$this->start_controls_tabs('tab_button_loadmore');
			// Normal State Tab
			$this->start_controls_tab('tab_button_loadmore_normal', ['label' => esc_html__('Normal', 'apr-core')]);
			$this->add_control(
				'button_loadmore_bg_color',
				[
					'label'     => esc_html__('Background Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .view-more-button ' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'button_loadmore_color',
				[
					'label'     => esc_html__('Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .view-more-button ' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'button_loadmore_border',
					'label'    => esc_html__('Border', 'apr-core'),
					'selector' => '{{WRAPPER}} .view-more-button',
				]
			);
			$this->end_controls_tab();
			// Hover State Tab
			$this->start_controls_tab('tab_button_loadmore_hover', ['label' => esc_html__('Hover', 'apr-core')]);
			$this->add_control(
				'button_loadmore_bg_color_hover',
				[
					'label'     => esc_html__('Background Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .view-more-button:hover ,{{WRAPPER}} .view-more-button:focus' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'button_loadmore_color_hover',
				[
					'label'     => esc_html__('Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .view-more-button:hover,{{WRAPPER}} .view-more-button:focus ' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'button_loadmore_border_color_hover',
				[
					'label'     => esc_html__('Border Color', 'apr-core'),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .view-more-button:hover,{{WRAPPER}} .view-more-button:focus ' => 'border-color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();
			$this->end_controls_tabs();

			$this->end_controls_section();
		}

		protected function render()
		{
			wp_enqueue_script('widget-product');
			$this->apr_sc_product();
			global $woocommerce_loop;
			$show_custom_image         = $custom_dimension_width = $custom_dimension_height = $product_class = $change_content_position_lable = $show_wishlist_not_full = $class_position_price = $category_prd_class = $hide_title = $hide_title_tablet = $wishlist_position_class = $wishlist_position_class2 = $action_icon_position_class = $none_wishlist_class = $show_attr_class = $content_align_class = $content_align_tablet_class = $content_align_mobile_class = $show_add_cart_bottom = $hide_add_cart_bottom_table = $hide_add_cart_bottom_mobile = $class_show_percentage_lable = $show_border_product_class = $pagination_type = $pagination_number = $hide_desc_product = $filter_product_by_class = '';
			$settings                  = $this->get_settings_for_display();
			$product_type              = $settings['product_type'];
			$product_layout            = $settings['product_layout'];
			$show_btn_loadmore_product = $settings['show_btn_loadmore_product'];
			$text_button               = $settings['text_button'];
			$show_border_product       = $settings['show_border_product'];
			$filter_by                 = $settings['filter_by'];
			$columns                   = $settings['product_column_number'];
			$columns_tablet            = isset($settings['product_column_number_tablet']);
			$columns_mobile            = isset($settings['product_column_number_mobile']);
			if ($columns_tablet) {
				$columns_tablet = $settings['product_column_number_tablet'];
			} else {
				$columns_tablet = 3;
			}
			if ($columns_mobile) {
				$columns_mobile = $settings['product_column_number_mobile'];
			} else {
				$columns_mobile = 2;
			}
			$content_align        = $settings['content_align'];
			$content_align_tablet = isset($settings['content_align_tablet']);
			$content_align_mobile = isset($settings['content_align_mobile']);
			$cat_slug             = $settings['product_cat'];
			$limit_post           = $settings['product_limit'];
			$orderby              = $settings['orderby'];
			$order                = $settings['order'];
			$show_custom_images   = $settings['show_custom_image'];
			if ($show_custom_images) {
				$show_custom_image = $show_custom_images;
			}
			$custom_dimension = $settings['custom_dimension'];
			if ($show_custom_images && $custom_dimension) {
				$custom_dimension_width  = $custom_dimension['width'];
				$custom_dimension_height = $custom_dimension['height'];
			}
			$wishlist_position                             = $settings['wishlist_position'];
			$wishlist_position2                            = $settings['wishlist_position2'];
			$show_add_to_cart_bottom                       = $settings['show_add_to_cart_bottom'];
			$show_percentage_lable                         = $settings['show_percentage_lable'];
			$hide_add_to_cart_bottom_table                 = isset($settings['hide_add_to_cart_bottom_table']);
			$hide_add_to_cart_bottom_mobile                = isset($settings['hide_add_to_cart_bottom_mobile']);
			$hide_title_product_mobile                     = isset($settings['hide_title_product_mobile']);
			$hide_title_product_tablet                     = isset($settings['hide_title_product_tablet']);
			$show_category_product                         = $settings['show_category_product'];
			$show_compare                                  = $settings['show_compare'];
			$show_wishlist                                 = $settings['show_wishlist'];
			$show_quickview                                = $settings['show_quickview'];
			$show_attr_image                               = $settings['show_attr_image'];
			$hide_wishlist_before_hover                    = $settings['hide_wishlist_before_hover'];
			$action_icon_position                          = $settings['action_icon_position'];
			$change_content_position                       = $settings['change_content_position'];
			$product_attr                                  = $settings['product_attr'];
			$show_attribute_on_title                       = $settings['show_attribute_on_title'];
			$show_separator_out                            = $settings['show_separator_out'];
			$change_to_a_filter_box                        = $settings['change_to_a_filter_box'];
			$title_list_product                            = $settings['title_list_product'];
			$change_to_a_filter_box_767                    = $settings['change_to_a_filter_box_767'];
			$woocommerce_loop['show_attribute_on_title']   = $show_attribute_on_title;
			$woocommerce_loop['product_attr']              = $product_attr;
			$woocommerce_loop['show_compare']              = $show_compare;
			$woocommerce_loop['show_wishlist']             = $show_wishlist;
			$woocommerce_loop['show_quickview']            = $show_quickview;
			$woocommerce_loop['show_category_product']     = $show_category_product;
			$woocommerce_loop['custom_dimension']          = $custom_dimension;
			$woocommerce_loop['show_custom_image']         = $show_custom_image;
			$woocommerce_loop['product_column_number']     = $columns;
			$woocommerce_loop['product_type']              = $product_type;
			$woocommerce_loop['product_layout']            = $product_layout;
			$woocommerce_loop['show_product_descriptions'] = $settings['show_product_descriptions'];
			$woocommerce_loop['show_btn_specs']            = $settings['show_btn_specs'];
			$woocommerce_loop['text_button_specs']         = $settings['text_button_specs'];
			$arrow_align                                   = $settings['arrow_align'];
			$hide_desc_product                             = $settings['hide_desc_product'];
			$product_id                                    = $settings['id_product'];

			//print_r($product_ids);
			$filter_product_by = $settings['filter_product_by'];
			if ($product_type == 'default' && (($columns == '2' || $columns == '3') || ($settings['slidestoshow'] == '2' || $settings['slidestoshow'] == '3'))) {
				$class_position_price = 'price-position';
			}
			if ($show_btn_loadmore_product === 'yes' && $text_button != '') {
				$pagination_type = 'pagination_load_more';
			}
			if ($settings['paginate'] == 'yes') {
				$pagination_number = 'pagination_number';
			}
			if ($change_to_a_filter_box === 'yes') {
				$change_to_a_filter_box = 'product-box-filter-1366';
			}
			if ($change_to_a_filter_box_767 === 'yes') {
				$change_to_a_filter_box_767 = 'product-box-filter-767';
			}
			$class_widget = "";	


			if ($settings['hide_desc_product'] == 'yes') {
				$class_widget .= ' hide_desc_product ';
			}
			if ($show_percentage_lable !== 'yes') {
				$class_widget .= ' none-percentage_lable ';
			}
			if ($content_align == 'right') {
				$class_widget .= ' content-right ';
			} elseif ($content_align == 'center') {
				$class_widget .= ' content-center ';
			} else {
				$class_widget .= ' content-left ';
			}
			if ($content_align_tablet == 'center') {
				$class_widget .= ' content-tl-center ';
			} elseif ($content_align_tablet == 'right') {
				$class_widget .= ' content-tl-right ';
			} else {
				$class_widget .= ' content-tl-left ';
			}
			if ($content_align_mobile == 'center') {
				$class_widget .= ' content-mb-center ';
			} elseif ($content_align_mobile == 'right') {
				$class_widget .= ' content-mb-right ';
			} else {
				$class_widget .= ' content-mb-left ';
			}
			if ($hide_wishlist_before_hover === 'yes') {
				$class_widget .= ' none-wishlist-before-hover ';
			}
			if ($change_content_position === 'yes') {
				$class_widget .= ' furniture-product ';
			}

			if ($show_attr_image === 'yes') {
				$class_widget .= ' show-attr ';
			}
			if ($show_border_product !== 'yes') {
				$class_widget .= ' no-border-content ';
			}
			if ($show_separator_out === 'yes') {
				$class_widget .= ' show-separator-out ';
			}
			if ($action_icon_position === 'horizontal_middle') {
				$class_widget .= ' product-action-horizontal-middle ';
			} elseif ($action_icon_position === 'horizontal_middle_wishlist') {
				$class_widget .= ' product-action-horizontal-middle middle-has-wishlist ';
			} else {
				$class_widget .= ' product-action-horizontal-bottom ';
			}
			if ($wishlist_position === 'top') {
				$class_widget .= ' wishlist-position-top ';
			}
			if ($wishlist_position2 === 'bottom') {
				$class_widget .= ' wishlist--bottom ';
			} else {
				$class_widget .= ' wishlist--top ';
			}
			if ($show_category_product !== 'yes') {
				$class_widget .= ' hide-category-product ';
			}
			if ($show_add_to_cart_bottom === 'yes') {
				$class_widget .= ' show-add-to-cart-bottom ';
			}
			if ($hide_add_to_cart_bottom_table === 'yes') {
				$class_widget .= ' hide-add-to-cart-bottom-on-table ';
			}
			if ($hide_add_to_cart_bottom_mobile === 'yes') {
				$class_widget .= 'hide-add-to-cart-bottom-on-mobile';
			}
			if ($show_wishlist === 'yes') {
				$class_widget .= ' show-wishlist-not-full ';
			}
			if ($hide_title_product_mobile === 'yes') {
				$class_widget .= ' hide-title-product ';
			}
			if ($hide_title_product_tablet === 'yes') {
				$class_widget .= ' hide-title-tablet ';
			}
			if ($filter_product_by == 'ids') {
				$class_widget .= " products-ids ";
			} else {
				$class_widget .= " products-by-categories ";
			}
			if ($arrow_align == 'top') {
				$class_widget .= 'arrow_align_top';
			} elseif ($arrow_align == 'bottom') {
				$class_widget .= 'arrow_align_bottom';
			} else {
				$class_widget .= 'arrow_align_middle';
			}

			if (!empty($cat_slug)) {
				$cat = implode(",", $cat_slug);
			} else {
				$cat = '';
			}

			if (!empty($product_id)) {
				$product_id_arr = is_string($product_id) ? explode(',', $product_id) : $product_id;
				$product_ids    = implode(",", $product_id_arr);
			} else {
				$product_ids = '';
			}
			$id_w       = 'widget_product_' . wp_rand();
			$id          = 'apr_product_' . wp_rand();
			$id_tab      = 'apr_tab_item_' . wp_rand();
			
			if ($settings['paginate'] == 'yes' || $settings['show_btn_loadmore_product'] == 'yes') {
				$paginate = 'true';
			} else {
				$paginate = 'false';
			}

?>
			<div id="<?php echo esc_attr($id_w); ?>" class="widget-product-warper" data-config='<?php echo json_encode($this->get_option_data_json($settings)); ?>'>
				<?php if ($settings['product_layout'] == 'tab') : ?>
					<div id="<?php echo esc_attr($id_tab); ?>" class="apr-product-tab <?php echo esc_attr($change_to_a_filter_box); ?> <?php echo esc_attr($change_to_a_filter_box_767); ?>">
						<div class="product-tab-header">
							<ul class="apr-product-tab-title <?php echo esc_attr($show_separator_out); ?>">
								<?php foreach ($settings['apr_tab_product'] as $tab) :
									if (!empty($tab['apr_tab_product_cat'])) {
										$tab['apr_tab_product_cat'];
									} else {
										$tab['apr_tab_product_cat'] = array('');
									}
								?>
									<li class="tab-item" data-attr-value="<?php echo $tab['apr_tab_filter_by']; ?>" data-cat-slug="<?php echo implode(',', $tab['apr_tab_product_cat']); ?>">
										<span><?php echo $tab['apr_tab_product_title']; ?></span>
									</li>
								<?php endforeach; ?>
							</ul>

							<div class="lds-ellipsis" style="display: none;"></div>

						</div>
						<div class="tab-content-inner">
							<div class="apr-product  col-tablet-<?php echo esc_attr($columns_tablet); ?> col-mobile-<?php echo esc_attr($columns_mobile); ?> <?php echo esc_attr($class_widget); ?>">
								<div class="content-tab-product">

									<?php
									if (!empty($settings['apr_tab_product'][0]['apr_tab_product_cat'])) {
										$settings['apr_tab_product'][0]['apr_tab_product_cat'];
									} else {
										$settings['apr_tab_product'][0]['apr_tab_product_cat'] = array('');
									}

									$filter_by_tab = $settings['apr_tab_product'][0]['apr_tab_filter_by'];
									$cat           = implode(',', $settings['apr_tab_product'][0]['apr_tab_product_cat']);
									echo do_shortcode('[' . $filter_by_tab . '  category="' . $cat . '"  paginate="' . $paginate . '" columns="' . $columns . '" limit="' . $limit_post . '" orderby="' . $orderby . '" order="' . $order . '"]');
									?>
								</div>
							</div>
						</div>
					</div>
				<?php else : ?>
					<div id="<?php echo esc_attr($id); ?>"  class="apr-product  col-tablet-<?php echo esc_attr($columns_tablet); ?> col-mobile-<?php echo esc_attr($columns_mobile); ?> <?php echo esc_attr($class_widget); ?>">
						<?php if ($settings['product_layout'] == 'list' && $title_list_product) : ?>
							<h2 class="title-list-product"><?php echo $title_list_product; ?><i class="theme-icon-download"></i></h2>
						<?php endif; ?>
						<?php if ($filter_product_by == 'ids') :
							echo do_shortcode('[products ids ="' . $product_ids . '" per_page="' . $limit_post . '" orderby="' . $orderby . '" order="' . $order . '"]');
						else :
							echo do_shortcode('[' . $filter_by . '  category="' . $cat . '" paginate="' . $paginate . '" columns="' . $columns . '" limit="' . $limit_post . '" orderby="' . $orderby . '" order="' . $order . '"]');
						endif; ?>
						<?php if ($show_btn_loadmore_product === 'yes' && $text_button != '') : ?>
							<div class="loadmore-product">
								<button class="view-more-button"><?php echo $text_button; ?></button>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>

			</div>


<?php
		}
		protected function get_option_data_json($settings)
		{
			$custom_dimension_width  = $show_custom_image = $custom_dimension_height = "";
			$show_custom_images   = $settings['show_custom_image'];
			if ($show_custom_images) {
				$show_custom_image = $show_custom_images;
			}
			$custom_dimension = $settings['custom_dimension'];
			if ($show_custom_images && $custom_dimension) {
				$custom_dimension_width  = $custom_dimension['width'];
				$custom_dimension_height = $custom_dimension['height'];
			}
			if ($settings['paginate'] == 'yes' || $settings['show_btn_loadmore_product'] == 'yes') {
				$paginate = 'true';
			} else {
				$paginate = 'false';
			}
			$is_rtl      = is_rtl();
			$direction   = $is_rtl ? true : false;
			$show_dots   = (in_array($settings['navigation'], ['dots', 'both']));
			$show_arrows = (in_array($settings['navigation'], ['arrows', 'both']));
			$show_arr    = false;
			$show_dot    = false;
			if ($settings['navigation'] == 'both') {
				$show_arr = true;
				$show_dot = true;
			} elseif ($settings['navigation'] == 'arrows') {
				$show_arr = true;
			} elseif ($settings['navigation'] == 'dots') {
				$show_dot = true;
			}
			if ($settings['centermode'] == 'yes') {
				$centermode = true;
			} else {
				$centermode = false;
			}
			if ($settings['infinite'] == 'yes') {
				$infinite = true;
			} else {
				$infinite = false;
			}
			if ($settings['autoplay'] == 'yes') {
				$autoplay = true;
			} else {
				$autoplay = false;
			}
			if ($settings['pause_on_hover'] == 'yes') {
				$pauseonhover = true;
			} else {
				$pauseonhover = false;
			}
			$slidesrow        = (isset($settings['slidesrow']) && ($settings['slidesrow'] != '')) ? $settings['slidesrow'] : 1;
			$slidesrow_tablet = isset($settings['slidesrow_tablet']) ?  $settings['slidesrow_tablet'] : 1;
			$slidesrow_mobile = isset($settings['slidesrow_mobile']) ? $settings['slidesrow_mobile'] : 1;
			$centerpadding        = isset($settings['centerpadding']) ? $settings['centerpadding'] : 0;
			$centerpadding_tablet = isset($settings['centerpadding_tablet']) ?  $settings['centerpadding_tablet']  : 0;
			$centerpadding_mobile = isset($settings['centerpadding_mobile']) ? $settings['centerpadding_mobile'] : 0;
			$data_config = array(
				'orderby' => $settings['orderby'],
				'order'  => $settings['order'],
				'columns' => $settings['product_column_number'],
				'posts_per_page' => $settings['product_limit'],
				'show_quickview' => $settings['show_quickview'],
				'show_wishlist'  => $settings['show_wishlist'],
				'show_compare'	=> $settings['show_compare'],
				'show_attribute_on_title' => $settings['show_attribute_on_title'],
				'product_attr' => $settings['product_attr'],
				'product_type'	=> esc_attr($settings['product_type']),
				'product_layout' =>  esc_attr($settings['product_layout']),
				'show_custom_image' =>  $show_custom_image,
				'custom_dimension_width' => $custom_dimension_width,
				'custom_dimension_height' => $custom_dimension_height,
				'show_slider' => $settings['show_slider'],
				'paginate'   => $paginate,
				'change_to_a_filter_box' => $settings['change_to_a_filter_box'],
				'change_to_a_filter_box_767' => $settings['change_to_a_filter_box_767']

			);
			if ($settings['show_slider'] = 'yes') {
				$data_config_sllider = array(
					'slidesToShow' => absint($settings['slidestoshow']),
					'slidesToScroll' => absint($settings['slidestoscroll']),
					'slidestoshow_mobile_mini' =>  absint($settings['slidestoshow_mobile_mini']),
					'slidestoshow_mobile' => absint($settings['slidestoshow_mobile']),
					'slidestoshow_tablet' =>  absint($settings['slidestoshow_tablet']),
					'slidestoshow_desktop' => absint($settings['slidestoshow_desktop']),
					'autoplay_speed' =>  absint((!empty($settings['autoplay_speed']) ? $settings['autoplay_speed'] :'500' )),
					'direction' => $direction,
					'dots'		=> $show_dots,
					'show_arr'   => $show_arr,
					'navigation' => $show_arrows,
					'centermode' => $centermode,
					'infinite'   => $infinite,
					'autoplay'  => $autoplay,
					'pause_on_hover' => $pauseonhover,
					'slidesrow' => absint($slidesrow),
					'slidesrow_tablet' => absint($slidesrow_tablet),
					'slidesrow_mobile' => absint($slidesrow_mobile),
					'centerpadding' =>  absint($centerpadding),
					'centerpadding_tablet' =>  absint($centerpadding_tablet),
					'centerpadding_mobile' => absint($centerpadding_mobile),
					'speed'      => absint($settings['transition_speed'])
				);
			}else{
				$data_config_sllider = array();
			}
			return array_merge($data_config,$data_config_sllider) ;
		}
		protected function content_template()
		{
		}
	}

	Plugin::instance()->widgets_manager->register(new Apr_Core_Products);
}
