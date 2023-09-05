<?php

namespace Elementor;

use Lusion_Templates;
use WC_Cart;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Apr_Core_Header_Group extends Widget_Base {
	public function apr_sc_header_group() {
		/* Add css */
		if ( is_rtl() ) {
			wp_enqueue_style( 'apr-sc-header-group', LUSION_CSS . '/elementor/header-group-rtl.css', array(), LUSION_THEME_VERSION );
		} else {
			wp_enqueue_style( 'apr-sc-header-group', LUSION_CSS . '/elementor/header-group.css', array(), LUSION_THEME_VERSION );
		}
	}

	public function get_name() {
		return 'apr-header-group';
	}

	public function get_title() {
		return __( 'APR Header Group', 'apr-core' );
	}

	public function get_icon() {
		return 'eicon-lock-user';
	}

	public function get_categories() {
		return [ 'apr-core' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'account_config',
			[
				'label' => __( 'Config', 'apr-core' ),
			]
		);
		$this->add_control(
			'show_header_mb',
			[
				'label' => __( 'Show This header on Mobile', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);
		if ( is_plugin_active( 'yith-woocommerce-wishlist/init.php' ) ):
			$this->add_control(
				'show_wishlist',
				[
					'label' => __( 'Show wishlist', 'apr-core' ),
					'type'  => Controls_Manager::SWITCHER,
				]
			);
		endif;
		$this->add_control(
			'icon_visit_home',
			[
				'label' => __( 'Show Icon Home', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'show_social',
			[
				'label' => __( 'Show Social', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'show_language',
			[
				'label' => __( 'Show language', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);


		$this->add_control(
			'show_search',
			[
				'label' => __( 'Show search form', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);
		if ( apr_is_woocommerce_activated() ):
			$this->add_control(
				'show_account',
				[
					'label' => __( 'Show account', 'apr-core' ),
					'type'  => Controls_Manager::SWITCHER,
				]
			);

			$this->add_control(
				'show_cart',
				[
					'label' => __( 'Show cart', 'apr-core' ),
					'type'  => Controls_Manager::SWITCHER,
				]
			);
			$this->add_control(
				'show_currency',
				[
					'label' => __( 'Show Currency', 'apr-core' ),
					'type'  => Controls_Manager::SWITCHER,
				]
			);
		endif;
		$this->add_control(
			'show_link',
			[
				'label' => __( 'Show link custom', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'show_address',
			[
				'label' => __( 'Show Address', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);
		$this->add_responsive_control(
			'align_items',
			[
				'label'        => __( 'Align', 'apr-core' ),
				'type'         => Controls_Manager::CHOOSE,
				'label_block'  => false,
				'options'      => [
					'left'   => [
						'title' => __( 'Left', 'apr-core' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'apr-core' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'apr-core' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'apr-header-group__align-',
			]
		);
		$this->end_controls_section();

		if ( is_plugin_active( 'yith-woocommerce-wishlist/init.php' ) ):
			//Wishlist config
			$this->start_controls_section(
				'wishlist_config',
				[
					'label'     => __( 'Header Wishlist', 'apr-core' ),
					'condition' => [
						'show_wishlist!' => '',
					],
				]
			);

			$this->add_control(
				'wishlist_icon',
				[
					'label'   => __( 'Choose Icon', 'apr-core' ),
					'type'    => Controls_Manager::ICON,
					'default' => 'theme-icon-heart',
				]
			);

			$this->add_control(
				'show_subtotal',
				[
					'label' => __( 'Show Total', 'apr-core' ),
					'type'  => Controls_Manager::SWITCHER,
				]
			);
			$this->add_control(
				'responsive_wishlist',
				[
					'label' => __( 'Responsive wishlist', 'apr-core' ),
					'type'  => Controls_Manager::HEADING,

				]
			);
			$this->add_control(
				'show_wishlist_desktop',
				[
					'label' => __( 'Hide On Desktop', 'apr-core' ),
					'type'  => Controls_Manager::SWITCHER,
				]
			);

			$this->add_control(
				'show_wishlist_tablet',
				[
					'label' => __( 'Hide On Tablet', 'apr-core' ),
					'type'  => Controls_Manager::SWITCHER,
				]
			);

			$this->add_control(
				'show_wishlist_mobile',
				[
					'label' => __( 'Hide On mobile', 'apr-core' ),
					'type'  => Controls_Manager::SWITCHER,
				]
			);
			$this->end_controls_section();
			//End Wishlist config
		endif;
		//Search form config
		$this->start_controls_section(
			'search_config',
			[
				'label'     => __( 'Header Search', 'apr-core' ),
				'condition' => [
					'show_search!' => '',
				],
			]
		);

		$this->add_control(
			'icon_skin',
			[
				'label'     => __( 'Choose Icon', 'apr-core' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'theme-icon-search',
				'condition' => [
					'show_field_search' => '',
				],
			]
		);
		$this->add_control(
			'show_field_search',
			[
				'label' => __( 'Show Field Search', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'responsive_search',
			[
				'label'     => __( 'Responsive', 'apr-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'show_search_desktop',
			[
				'label' => __( 'Hide On Desktop', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'show_search_tablet',
			[
				'label' => __( 'Hide On Tablet', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'show_search_mobile',
			[
				'label' => __( 'Hide On mobile', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'hide_icon_search_mobile',
			[
				'label' => __( 'Hide icon tablet, mobile', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'search_field_input',
			[
				'label'     => __( 'Search field Input', 'apr-core' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Search',
				'condition' => [
					'show_field_search!' => '',
				],
			]
		);
		$this->end_controls_section();
		//End Search form config
		//Start icon home config
		$this->start_controls_section(
			'icon_home_config',
			[
				'label'     => __( 'Header Icon Home', 'apr-core' ),
				'condition' => [
					'icon_visit_home!' => '',
				],
			]
		);
		$this->add_control(
			'visit_home_icon',
			[
				'label'   => __( 'Choose Icon', 'apr-core' ),
				'type'    => Controls_Manager::ICON,
				'default' => 'theme-icon-home',
			]
		);
		$this->add_control(
			'responsive_icon_home',
			[
				'label'     => __( 'Responsive', 'apr-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'show_icon_home_desktop',
			[
				'label' => __( 'Hide On Desktop', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'show_icon_home_tablet',
			[
				'label' => __( 'Hide On Tablet', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'show_icon_home_mobile',
			[
				'label' => __( 'Hide On mobile', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);
		$this->end_controls_section();
		//End Icon home config
		//Start icon social config
		$this->start_controls_section(
			'icon_social_config',
			[
				'label'     => __( 'Header Social', 'apr-core' ),
				'condition' => [
					'show_social!' => '',
				],
			]
		);
		$this->add_control(
			'social_facebook',
			[
				'label'       => __( 'Facebook URL', 'apr-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'apr-core' ),
				'label_block' => true,
				'default'     => [
					'url'         => '',
					'is_external' => true,
				],
			]
		);

		$this->add_control(
			'social_twitter',
			[
				'label'       => __( 'Twitter URL', 'apr-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'apr-core' ),
				'label_block' => true,
				'default'     => [
					'url'         => '',
					'is_external' => true,
				],
			]
		);

		$this->add_control(
			'social_instagram',
			[
				'label'       => __( 'Instagram URL', 'apr-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'apr-core' ),
				'label_block' => true,
				'default'     => [
					'url'         => '',
					'is_external' => true,
				],
			]
		);

		$this->add_control(
			'social_google',
			[
				'label'       => __( 'Google URL', 'apr-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'apr-core' ),
				'label_block' => true,
				'default'     => [
					'url'         => '',
					'is_external' => true,
				],
			]
		);

		$this->add_control(
			'social_pinterest',
			[
				'label'       => __( 'Pinterest URL', 'apr-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'apr-core' ),
				'label_block' => true,
				'default'     => [
					'url'         => '',
					'is_external' => true,
				],
			]
		);
		$this->add_control(
			'responsive_social',
			[
				'label'     => __( 'Responsive', 'apr-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'show_social_desktop',
			[
				'label' => __( 'Hide On Desktop', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'show_social_tablet',
			[
				'label' => __( 'Hide On Tablet', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'show_social_mobile',
			[
				'label' => __( 'Hide On mobile', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);
		$this->end_controls_section();
		//End Icon social config

		if ( apr_is_woocommerce_activated() ):
			//Account config
			$this->start_controls_section(
				'account_content',
				[
					'label'     => __( 'Header Account', 'apr-core' ),
					'condition' => [
						'show_account!' => '',
					],
				]
			);
			$this->add_control(
				'responsive_account',
				[
					'label'     => __( 'Responsive', 'apr-core' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'show_account_desktop',
				[
					'label' => __( 'Hide On Desktop', 'apr-core' ),
					'type'  => Controls_Manager::SWITCHER,
				]
			);

			$this->add_control(
				'show_account_tablet',
				[
					'label' => __( 'Hide On Tablet', 'apr-core' ),
					'type'  => Controls_Manager::SWITCHER,
				]
			);

			$this->add_control(
				'show_account_mobile',
				[
					'label' => __( 'Hide On mobile', 'apr-core' ),
					'type'  => Controls_Manager::SWITCHER,
				]
			);
			$this->end_controls_section();
			//End account config
			//Start cart config
			$this->start_controls_section(
				'cart_content',
				[
					'label'     => __( 'Header Cart', 'apr-core' ),
					'condition' => [
						'show_cart!' => '',
					],
				]
			);

			$this->add_control(
				'cart_icon',
				[
					'label'   => __( 'Choose Icon', 'apr-core' ),
					'type'    => Controls_Manager::ICON,
					'default' => 'theme-icon-shopping-cart1',
				]
			);

			$this->add_control(
				'show_count',
				[
					'label' => __( 'Show Count', 'apr-core' ),
					'type'  => Controls_Manager::SWITCHER,
				]
			);
			$this->add_control(
				'responsive_cart',
				[
					'label'     => __( 'Responsive', 'apr-core' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'show_cart_desktop',
				[
					'label' => __( 'Hide On Desktop', 'apr-core' ),
					'type'  => Controls_Manager::SWITCHER,
				]
			);

			$this->add_control(
				'show_cart_tablet',
				[
					'label' => __( 'Hide On Tablet', 'apr-core' ),
					'type'  => Controls_Manager::SWITCHER,
				]
			);

			$this->add_control(
				'show_cart_mobile',
				[
					'label' => __( 'Hide On mobile', 'apr-core' ),
					'type'  => Controls_Manager::SWITCHER,
				]
			);

			$this->end_controls_section();
			//Start currency config
			$this->start_controls_section(
				'currency_content',
				[
					'label'     => __( 'Header Currency', 'apr-core' ),
					'condition' => [
						'show_currency!' => '',
					],
				]
			);
			$this->add_control(
				'responsive_currency',
				[
					'label'     => __( 'Responsive', 'apr-core' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_control(
				'show_currency_flag_dropdown',
				[
					'label' => __( 'Hide flag dropdown', 'apr-core' ),
					'type'  => Controls_Manager::SWITCHER,
				]
			);

			$this->add_control(
				'show_currency_desktop',
				[
					'label' => __( 'Hide On Desktop', 'apr-core' ),
					'type'  => Controls_Manager::SWITCHER,
				]
			);

			$this->add_control(
				'show_currency_tablet',
				[
					'label' => __( 'Hide On Tablet', 'apr-core' ),
					'type'  => Controls_Manager::SWITCHER,
				]
			);

			$this->add_control(
				'show_currency_mobile',
				[
					'label' => __( 'Hide On mobile', 'apr-core' ),
					'type'  => Controls_Manager::SWITCHER,
				]
			);

			$this->end_controls_section();
		endif;
		//End WooCommerce cart
		// Start Link custom config
		$this->start_controls_section(
			'link_content',
			[
				'label'     => __( 'Header Link ', 'apr-core' ),
				'condition' => [
					'show_link!' => '',
				],
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'link',
			[
				'label'       => __( 'Link to', 'apr-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'apr-core' ),
			]
		);
		$repeater->add_control(
			'text_link',
			[

				'label'       => __( 'Link text', 'apr-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => 'Enter your link text',
				'dynamic'     => [
					'active' => true,
				],
				'default'     => __( '', 'apr-core' ),
			]
		);
		$this->add_control(
			'list_link',
			[
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'link'      => __( '#', 'apr-core' ),
						'text_link' => __( 'Help', 'apr-core' ),
					],
				],
				'title_field' => '{{{ text_link }}}',
			]
		);
		$this->add_control(
			'responsive_link',
			[
				'label'     => __( 'Responsive link', 'apr-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'show_link_desktop',
			[
				'label' => __( 'Hide On Desktop', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'show_link_tablet',
			[
				'label' => __( 'Hide On Tablet', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'show_link_mobile',
			[
				'label' => __( 'Hide On mobile', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);
		$this->end_controls_section();
		// End Link custom config

		// Start Address config
		$this->start_controls_section(
			'address-content',
			[
				'label'     => __( 'Header Address', 'apr-core' ),
				'condition' => [
					'show_address!' => '',
				],
			]
		);
		$this->add_control(
			'show_icon_address',
			[
				'label'   => __( 'Show Icon', 'apr-core' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_text_address',
			[
				'label'   => __( 'Show Text', 'apr-core' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'name-address',
			[

				'label'       => __( 'Name Address', 'apr-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => 'Viet Nam',
				'dynamic'     => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'responsive_address',
			[
				'label'     => __( 'Responsive link', 'apr-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'show_address_desktop',
			[
				'label' => __( 'Hide On Desktop', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'show_address_tablet',
			[
				'label' => __( 'Hide On Tablet', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'show_address_mobile',
			[
				'label' => __( 'Hide On mobile', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->end_controls_section();
		// End Address custom config

		// Start Address config
		$this->start_controls_section(
			'language-content',
			[
				'label'     => __( 'Header Language', 'apr-core' ),
				'condition' => [
					'show_language!' => '',
				],
			]
		);
		$this->add_control(
			'show_icon_language',
			[
				'label'   => __( 'Language Type', 'apr-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => __( 'Default', 'apr-core' ),
					'style2' => __( 'Show icon', 'apr-core' ),
					'style3' => __( 'Show text', 'apr-core' ),
					'style4' => __( 'Show text & flag', 'apr-core' ),
					'style5' => __( 'Show flag', 'apr-core' ),
				],
			]
		);
		$this->add_control(
			'responsive_language',
			[
				'label'     => __( 'Responsive Language', 'apr-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'show_language_desktop',
			[
				'label' => __( 'Hide On Desktop', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'show_language_tablet',
			[
				'label' => __( 'Hide On Tablet', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'show_language_mobile',
			[
				'label' => __( 'Hide On mobile', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->end_controls_section();
		// End languague custom config

		$this->start_controls_section(
			'section_general',
			[
				'label' => __( 'General', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'space_icon',
			[
				'label'      => esc_html__( 'Space icon', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range'      => [
					'px' => [
						'min' => - 200,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .header-group>div' => 'margin:0 {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'general_border_icon',
			[
				'label' => __( 'Show Border Icon', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'border-icon-color',
			[
				'label' => __( 'Border Color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .show-border-icon .header-social ul li a, 
                    {{WRAPPER}} .show-border-icon .not-show-field .btn-search, 
                    {{WRAPPER}} .show-border-icon .menu-icon, 
                    {{WRAPPER}} .show-border-icon .header-language .lang-1, 
                    {{WRAPPER}} .show-border-icon .header-address > i, 
                    {{WRAPPER}} .show-border-icon .header-cart > a, 
                    {{WRAPPER}} .show-border-icon .header-wishlist > a, 
                    {{WRAPPER}} .show-border-icon .header-visit-home > a, 
                    {{WRAPPER}} .show-border-icon .header-account > a' => 'border-color: {{VALUE}};',
				],

			]
		);
		$this->end_controls_section();
		if ( is_plugin_active( 'yith-woocommerce-wishlist/init.php' ) ):
			//Start style wishlist
			$this->start_controls_section(
				'section_lable_style_wishlist',
				[
					'label'     => __( 'Header Wishlist', 'apr-core' ),
					'tab'       => Controls_Manager::TAB_STYLE,
					'condition' => [
						'show_wishlist' => 'yes',
					],
				]
			);
			$this->add_control(
				'wishlist_style',
				[
					'label'     => __( 'STYLE', 'apr-core' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_responsive_control(
				'padding_wishlist',
				[
					'label'      => __( 'Padding', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .header-wishlist' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'icon_wishlist_style',
				[
					'label'     => __( 'ICON', 'apr-core' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_responsive_control(
				'icon_wishlist_color',
				[
					'label' => __( 'Color', 'apr-core' ),
					'type'  => Controls_Manager::COLOR,

					'selectors' => [
						'{{WRAPPER}} .apr-header-wishlist' => 'color: {{VALUE}};',
					],

				]
			);

			$this->add_responsive_control(
				'icon_wishlist__hover_color',
				[
					'label' => __( 'Hover Color', 'apr-core' ),
					'type'  => Controls_Manager::COLOR,

					'selectors' => [
						'{{WRAPPER}} .apr-header-wishlist:hover' => 'color: {{VALUE}};',
					],

				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'icon_wishlist_size',
					'label'    => __( 'Typography', 'apr-core' ),
					'selector' => '{{WRAPPER}} .apr-header-wishlist',
				]
			);
			$this->add_responsive_control(
				'icon_wishlist_spacing',
				[
					'label'     => __( 'Spacing', 'apr-core' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .apr-header-wishlist i' => 'margin-right: {{SIZE}}{{UNIT}};',
					],
				]
			);


			$this->add_control(
				'count_wl_style',
				[
					'label'     => __( 'COUNT', 'apr-core' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_responsive_control(
				'count_wl_color',
				[
					'label'     => __( 'Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .apr-header-wishlist span.count' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'count_wl_background_color',
				[
					'label'     => __( 'Background Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .apr-header-wishlist span.count' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'  => 'count_wl_font_size',
					'label' => __( 'Typography', 'apr-core' ),

					'selector' => '{{WRAPPER}} .apr-header-wishlist span.count',
				]
			);
			$this->add_responsive_control(
				'count_wl_margin',
				[
					'label'      => __( 'Margin', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .apr-header-wishlist span.count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'count_wl_position',
				[
					'label'              => __( 'Custom Position', 'apr-core' ),
					'type'               => Controls_Manager::SELECT,
					'default'            => '',
					'options'            => [
						'relative' => __( 'Default', 'apr-core' ),
						'absolute' => __( 'Absolute', 'apr-core' ),
					],
					'frontend_available' => true,
					'selectors'          => [
						'{{WRAPPER}} .apr-header-wishlist span.count' => 'position: {{VALUE}};',
					],
				]
			);

			$start = is_rtl() ? __( 'Right', 'apr-core' ) : __( 'Left', 'apr-core' );
			$end   = ! is_rtl() ? __( 'Right', 'apr-core' ) : __( 'Left', 'apr-core' );

			$this->add_control(
				'count_wl_offset_orientation_h',
				[
					'label'       => __( 'Horizontal Orientation', 'apr-core' ),
					'type'        => Controls_Manager::CHOOSE,
					'label_block' => false,
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
						'count_position!' => 'relative',
					],
				]
			);

			$this->add_responsive_control(
				'count_wl_offset_x',
				[
					'label'      => __( 'Offset', 'apr-core' ),
					'type'       => Controls_Manager::SLIDER,
					'range'      => [
						'px' => [
							'min'  => - 100,
							'max'  => 100,
							'step' => 1,
						],
						'%'  => [
							'min' => - 200,
							'max' => 200,
						],
						'vw' => [
							'min' => - 200,
							'max' => 200,
						],
						'vh' => [
							'min' => - 200,
							'max' => 200,
						],
					],
					'default'    => [
						'size' => '0',
					],
					'size_units' => [ 'px', '%' ],
					'selectors'  => [
						'body:not(.rtl) {{WRAPPER}} .apr-header-wishlist span.count' => 'left: {{SIZE}}{{UNIT}}',
						'body.rtl {{WRAPPER}} .apr-header-wishlist span.count'       => 'right: {{SIZE}}{{UNIT}}',
					],
					'condition'  => [
						'count_offset_orientation_h!' => 'end',
						'count_position!'             => 'relative',
					],
				]
			);

			$this->add_responsive_control(
				'count_wl_offset_x_end',
				[
					'label'      => __( 'Offset', 'apr-core' ),
					'type'       => Controls_Manager::SLIDER,
					'range'      => [
						'px' => [
							'min'  => - 100,
							'max'  => 100,
							'step' => 0.1,
						],
						'%'  => [
							'min' => - 200,
							'max' => 200,
						],
					],
					'default'    => [
						'size' => '0',
					],
					'size_units' => [ 'px', '%' ],
					'selectors'  => [
						'body:not(.rtl) {{WRAPPER}} .apr-header-wishlist span.count' => 'right: {{SIZE}}{{UNIT}}',
						'body.rtl {{WRAPPER}} .apr-header-wishlist span.count'       => 'left: {{SIZE}}{{UNIT}}',
					],
					'condition'  => [
						'count_offset_orientation_h' => 'end',
						'count_position!'            => 'relative',
					],
				]
			);

			$this->add_control(
				'count_wl_offset_orientation_v',
				[
					'label'       => __( 'Vertical Orientation', 'apr-core' ),
					'type'        => Controls_Manager::CHOOSE,
					'label_block' => false,
					'toggle'      => false,
					'default'     => 'start',
					'options'     => [
						'start' => [
							'title' => __( 'Top', 'apr-core' ),
							'icon'  => 'eicon-v-align-top',
						],
						'end'   => [
							'title' => __( 'Bottom', 'apr-core' ),
							'icon'  => 'eicon-v-align-bottom',
						],
					],
					'render_type' => 'ui',
					'condition'   => [
						'count_position!' => 'relative',
					],
				]
			);

			$this->add_responsive_control(
				'count_wl_offset_y',
				[
					'label'      => __( 'Offset', 'apr-core' ),
					'type'       => Controls_Manager::SLIDER,
					'range'      => [
						'px' => [
							'min'  => - 100,
							'max'  => 100,
							'step' => 1,
						],
						'%'  => [
							'min' => - 100,
							'max' => 200,
						],
					],
					'size_units' => [ 'px', '%' ],
					'default'    => [
						'size' => '0',
					],
					'selectors'  => [
						'{{WRAPPER}} .count' => 'top: {{SIZE}}{{UNIT}}',
					],
					'condition'  => [
						'count_offset_orientation_v!' => 'end',
						'count_position!'             => 'relative',
					],
				]
			);

			$this->add_responsive_control(
				'count_wl_offset_y_end',
				[
					'label'      => __( 'Offset', 'apr-core' ),
					'type'       => Controls_Manager::SLIDER,
					'range'      => [
						'px' => [
							'min'  => - 100,
							'max'  => 100,
							'step' => 1,
						],
						'%'  => [
							'min' => - 200,
							'max' => 200,
						],
					],
					'size_units' => [ 'px', '%' ],
					'default'    => [
						'size' => '0',
					],
					'selectors'  => [
						'{{WRAPPER}} .apr-header-wishlist span.count' => 'bottom: {{SIZE}}{{UNIT}}',
					],
					'condition'  => [
						'count_offset_orientation_v' => 'end',
						'count_position!'            => 'relative',
					],
				]
			);
			$this->end_controls_section();
			//End style wishlist
		endif;

		//Style Search Form
		$this->start_controls_section(
			'section_input_style',
			[
				'label'     => __( 'Header Search', 'apr-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_search!' => '',
				],
			]
		);

		$this->add_control(
			'style_search_icon',
			[
				'label' => __( 'Icon Search', 'apr-core' ),
				'type'  => Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'toggle_search_size',
			[
				'label'     => __( 'Icon Size', 'apr-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .btn-search ,
                    {{WRAPPER}} .submit.btn-search' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_input_colors' );

		$this->start_controls_tab(
			'tab_input_normal',
			[
				'label' => __( 'Normal', 'apr-core' ),
			]
		);
		$this->add_control(
			'button_search_color',
			[
				'label'     => __( 'Icon Search Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn-search.toggle-search' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'input_text_color',
			[
				'label'     => __( 'Text Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .not-show-field .search-box .search-form .search-input,
                    {{WRAPPER}} .not-show-field .search-box .search-form .search-input::placeholder,
                    {{WRAPPER}} .show-field .searchform .search-form .product-search,
                    {{WRAPPER}} .show-field .searchform .search-form .product-search::placeholder' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'border_input_search_color',
			[
				'label'     => __( 'Border color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .not-show-field .search-box .search-form .search-input,
                    {{WRAPPER}} .show-field .searchform .search-form .product-search
                    ' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_input_focus',
			[
				'label' => __( 'Hover', 'apr-core' ),
			]
		);
		$this->add_control(
			'button_search_hover_color',
			[
				'label'     => __( 'Icon Search Hover Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn-search.toggle-search:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'input_text_color_focus',
			[
				'label'     => __( 'Text Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .not-show-field .search-box .search-form .search-input:hover,
                    {{WRAPPER}} .not-show-field .search-box .search-form .search-input:hover::placeholder,
                    {{WRAPPER}} .show-field .searchform .search-form .product-search:hover,
                    {{WRAPPER}} .show-field .searchform .search-form .product-search:hover::placeholder,
                    {{WRAPPER}} .not-show-field .search-box .search-form .search-input:focus,
                    {{WRAPPER}} .not-show-field .search-box .search-form .search-input:focus::placeholder,
                    {{WRAPPER}} .show-field .searchform .search-form .product-search:focus,
                    {{WRAPPER}} .show-field .searchform .search-form .product-search:focus::placeholder' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'border_input_search_color_focus',
			[
				'label'     => __( 'Border color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .not-show-field .search-box .search-form .search-input:hover,
                        {{WRAPPER}} .show-field .searchform .search-form .product-search:hover,
                        {{WRAPPER}} .not-show-field .search-box .search-form .search-input:focus,
                        {{WRAPPER}} .show-field .searchform .search-form .product-search:focus
                        ' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->add_responsive_control(
			'text_padding_search',
			[
				'label'      => __( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .not-show-field.header-search,
                    {{WRAPPER}} .show-field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->add_responsive_control(
			'config_search_margin',
			[
				'label'      => __( 'Margin', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .not-show-field.header-search,
                    {{WRAPPER}} .show-field' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Style Search Form

		//Language config
		$this->start_controls_section(
			'language_config',
			[
				'label'     => __( 'Header Language', 'apr-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_language!' => '',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'name_lang_size',
				'label'    => __( 'Typography', 'apr-core' ),
				'selector' => ' {{WRAPPER}} .content-filter.languges > ul li a, {{WRAPPER}} .header-language .languges-flags .lang-1 ,{{WRAPPER}} .link-language',
			]
		);
		$this->add_responsive_control(
			'name_lang_color',
			[
				'label'     => __( 'Text Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .link-language,
                    {{WRAPPER}} .languges-flags .lang-1,
                    {{WRAPPER}} .languges-flags .lang-1 a,
                    {{WRAPPER}} .languges-flags .lang-1 .link-language i' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'name_lang_hover_color',
			[
				'label'     => __( 'Text Hover Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .languges-flags:hover .lang-1 a,
                    {{WRAPPER}} .languges-flags:hover .link-language, 
                    {{WRAPPER}} .link-language:hover,
                    {{WRAPPER}} .languges-flags .lang-1 a:hover,
                    {{WRAPPER}} .languges-flags:hover .lang-1 i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'lang_padding',
			[
				'label'      => __( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .header-language .languges-flags' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'lang_margin',
			[
				'label'      => __( 'Margin', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .header-group .languges-flags' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'lang_dropdown_color',
			[
				'label'     => __( 'Text Dropdown Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .content-filter.languges > ul li a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'lang_dropdown_hover_color',
			[
				'label'     => __( 'Text Hover Dropdown Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .content-filter.languges>ul li:hover a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'show_line_right',
			[
				'label' => __( 'Show space line', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'line_lang_line_color',
			[
				'label'     => __( ' Icon Spacing Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .content-filter.languges li:before' => 'background-color: {{VALUE}};',

				],
			]
		);
		$this->add_responsive_control(
			'language_dropdown_margin',
			[
				'label'      => __( 'Margin Dropdown', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .header-language-text .language-content__text,{{WRAPPER}} .header-language-flag .language-content__text,
                     {{WRAPPER}} .header-language-text-flag .language-content__text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// Icon Home config
		$this->start_controls_section(
			'visit_home_config',
			[
				'label'     => __( 'Header Icon Visit Home', 'apr-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon_visit_home!' => '',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'visit_home_size',
				'label'    => __( 'Typography', 'apr-core' ),
				'selector' => '{{WRAPPER}} .header-visit-home i',
			]
		);
		$this->add_control(
			'visit_home_color',
			[
				'label'     => __( 'Icon Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .header-visit-home i' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'visit_home_padding',
			[
				'label'      => __( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .header-visit-home' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		//Start Style Link
		$this->start_controls_section(
			'section_style_link',
			[
				'label'     => __( 'Header Link', 'apr-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_link' => 'yes',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'  => 'text_link_size',
				'label' => __( 'Typography', 'apr-core' ),

				'selector' => '{{WRAPPER}} .header-link a',
			]
		);
		$this->add_responsive_control(
			'link_color',
			[
				'label' => __( 'Link Color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .header-link a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'link_hover_color',
			[
				'label' => __( 'Link Hover Color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .header-link a:hover' => 'color: {{VALUE}};',

				],
			]
		);
		$this->add_control(
			'line_space_line_color',
			[
				'label' => __( ' Icon Spacing Color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .header-link li:before' => 'background-color: {{VALUE}};',

				],
			]
		);
		$this->add_control(
			'border_link_color',
			[
				'label'     => __( 'Border color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .header-link' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'border_link_style',
			[
				'label'       => __( 'Border Style', 'apr-core' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'none',
				'label_block' => false,
				'options'     => [
					'none'   => __( 'None', 'apr-core' ),
					'solid'  => __( 'Solid', 'apr-core' ),
					'double' => __( 'Double', 'apr-core' ),
					'dotted' => __( 'Dotted', 'apr-core' ),
					'dashed' => __( 'Dashed', 'apr-core' ),
				],
				'selectors'   => [
					'{{WRAPPER}} .header-link' => 'border-style: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'border_link_size',
			[
				'label'      => __( 'Border Width', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default'    => [
					'top'    => '',
					'bottom' => '',
					'left'   => '',
					'right'  => '',
					'unit'   => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .header-link' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'link_style_padding',
			[
				'label'      => __( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .header-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default'    => [
					'top'    => '',
					'bottom' => '',
					'left'   => '',
					'right'  => '',
					'unit'   => 'px',
				],
			]
		);
		$this->end_controls_section();

		//Start Style Address
		$this->start_controls_section(
			'section_style_address',
			[
				'label'     => __( 'Header Address', 'apr-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_address' => 'yes',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'  => 'address_size',
				'label' => __( 'Typography Address', 'apr-core' ),

				'selector' => '{{WRAPPER}} .header-address address a',
			]
		);
		$this->add_control(
			'address_color',
			[
				'label' => __( 'Text Address Color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .header-address address a,
                        {{WRAPPER}} .header-address i' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'address_icon_color',
			[
				'label'     => __( ' Hover Text Address Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .header-address:hover address a,
                        {{WRAPPER}} .header-address:hover i' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_address_size',
			[
				'label'     => __( 'Icon Size', 'apr-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .header-address i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'address_style_padding',
			[
				'label'      => __( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .header-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default'    => [
					'top'    => '',
					'bottom' => '',
					'left'   => '',
					'right'  => '',
					'unit'   => 'px',
				],
			]
		);
		$this->end_controls_section();
		//Start Style Social
		$this->start_controls_section(
			'section_style_social',
			[
				'label'     => __( 'Header Social', 'apr-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_social' => 'yes',
				],
			]
		);
		$this->add_control(
			'social_color',
			[
				'label' => __( 'Text Social Color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .header-social ul li a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'social_hover_color',
			[
				'label' => __( 'Social Hover Color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .header-social ul li a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_social_size',
			[
				'label'     => __( 'Icon Size', 'apr-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .header-social ul li a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'social_style_padding',
			[
				'label'      => __( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .header-social' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default'    => [
					'top'    => '',
					'bottom' => '',
					'left'   => '',
					'right'  => '',
					'unit'   => 'px',
				],
			]
		);
		$this->end_controls_section();
		if ( apr_is_woocommerce_activated() ):
			//Start Style Account
			$this->start_controls_section(
				'section_style_account',
				[
					'label'     => __( ' Header Account', 'apr-core' ),
					'tab'       => Controls_Manager::TAB_STYLE,
					'condition' => [
						'show_account' => 'yes',
					],
				]
			);
			$this->add_responsive_control(
				'config_account_padding',
				[
					'label'      => __( 'Padding', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .header-account' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'config_account_margin',
				[
					'label'      => __( 'Margin', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .header-account' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'account_text_color',
				[
					'label' => __( 'Account Color', 'apr-core' ),
					'type'  => Controls_Manager::COLOR,

					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .header-account > a' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'account_text_hover_color',
				[
					'label' => __( 'Text Hover Color', 'apr-core' ),
					'type'  => Controls_Manager::COLOR,

					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .header-account > a:hover' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'  => 'text_account_size',
					'label' => __( 'Typography text account', 'apr-core' ),

					'selector' => '{{WRAPPER}}  .header-account > a',
				]
			);

			$this->add_responsive_control(
				'icon_account_size',
				[
					'label'     => __( 'Icon Size', 'apr-core' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .header-account > a i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->end_controls_section();

			//Start style cart
			$this->start_controls_section(
				'section_lable_style',
				[
					'label'     => __( 'Header Cart', 'apr-core' ),
					'tab'       => Controls_Manager::TAB_STYLE,
					'condition' => [
						'show_cart' => 'yes',
					],
				]
			);

			$this->add_responsive_control(
				'config_padding_cart',
				[
					'label'      => __( 'Padding', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .header-cart ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'config_cart_margin',
				[
					'label'      => __( 'Margin', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .header-cart ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'Sub_cart',
				[
					'label'     => __( 'Dropdown Cart', 'apr-core' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_responsive_control(
				'sub_cart_top_distance',
				[
					'label'     => __( 'Distance', 'apr-core' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'min' => - 100,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .header-cart .shopping_cart' => 'margin-top: {{SIZE}}{{UNIT}} !important',
					],
					'separator' => 'before',
				]
			);
			$this->add_control(
				'icon_cart_style',
				[
					'label'     => __( 'ICON', 'apr-core' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_responsive_control(
				'icon_cart_size',
				[
					'label'     => __( 'Icon Size', 'apr-core' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .header-cart a i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'icon_cart_color',
				[
					'label' => __( 'Color', 'apr-core' ),
					'type'  => Controls_Manager::COLOR,

					'selectors' => [
						'{{WRAPPER}} .header-cart a i' => 'color: {{VALUE}};',
					],

				]
			);

			$this->add_responsive_control(
				'icon_cart_hover_color',
				[
					'label' => __( 'Hover Color', 'apr-core' ),
					'type'  => Controls_Manager::COLOR,

					'selectors' => [
						'{{WRAPPER}} .header-cart:hover i'       => 'color: {{VALUE}};',
						'{{WRAPPER}} .header-cart:hover .amount' => 'color: {{VALUE}};',
					],

				]
			);

			$this->add_control(
				'countcart_style',
				[
					'label'     => __( 'COUNT', 'apr-core' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'show_count!' => '',
					],
				]
			);

			$this->add_responsive_control(
				'count_color',
				[
					'label'     => __( 'Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .header-cart span.count' => 'color: {{VALUE}};',
					],
					'condition' => [
						'show_count!' => '',
					],
				]
			);

			$this->add_responsive_control(
				'count_hover_color',
				[
					'label'     => __( 'Hover Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .header-cart:hover span.count' => 'color: {{VALUE}};',
					],
					'condition' => [
						'show_count!' => '',
					],
				]
			);

			$this->add_responsive_control(
				'count_background_color',
				[
					'label'     => __( 'Background Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .header-cart span.count' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'show_count!' => '',
					],
				]
			);

			$this->add_responsive_control(
				'count_background_hover_color',
				[
					'label'     => __( 'Background Hover Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .header-cart:hover span.count' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'show_count!' => '',
					],
				]
			);

			$this->add_responsive_control(
				'count_font_size',
				[
					'label'     => __( 'Font Size', 'apr-core' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .header-cart span.count' => 'font-size: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'show_count!' => '',
					],
				]
			);


			$this->add_responsive_control(
				'count_size',
				[
					'label'     => __( 'Size', 'apr-core' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .header-cart span.count' => 'line-height: {{SIZE}}{{UNIT}};min-width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'show_count!' => '',
					],
				]
			);

			$this->add_responsive_control(
				'count_margin',
				[
					'label'      => __( 'Margin', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .header-cart span.count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'  => [
						'show_count!' => '',
					],
				]
			);
			$this->add_control(
				'count_position',
				[
					'label'              => __( 'Custom Position', 'apr-core' ),
					'type'               => Controls_Manager::SELECT,
					'default'            => '',
					'options'            => [
						'relative' => __( 'Default', 'apr-core' ),
						'absolute' => __( 'Absolute', 'apr-core' ),
					],
					'frontend_available' => true,
					'selectors'          => [
						'{{WRAPPER}} .header-cart span.count' => 'position: {{VALUE}};',
					],
				]
			);

			$start = is_rtl() ? __( 'Right', 'apr-core' ) : __( 'Left', 'apr-core' );
			$end   = ! is_rtl() ? __( 'Right', 'apr-core' ) : __( 'Left', 'apr-core' );

			$this->add_control(
				'count_offset_orientation_h',
				[
					'label'       => __( 'Horizontal Orientation', 'apr-core' ),
					'type'        => Controls_Manager::CHOOSE,
					'label_block' => false,
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
						'count_position!' => 'relative',
					],
				]
			);

			$this->add_responsive_control(
				'count_offset_x',
				[
					'label'      => __( 'Offset', 'apr-core' ),
					'type'       => Controls_Manager::SLIDER,
					'range'      => [
						'px' => [
							'min'  => - 100,
							'max'  => 100,
							'step' => 1,
						],
						'%'  => [
							'min' => - 200,
							'max' => 200,
						],
						'vw' => [
							'min' => - 200,
							'max' => 200,
						],
						'vh' => [
							'min' => - 200,
							'max' => 200,
						],
					],
					'default'    => [
						'size' => '0',
					],
					'size_units' => [ 'px', '%' ],
					'selectors'  => [
						'body:not(.rtl) {{WRAPPER}} .header-cart span.count' => 'left: {{SIZE}}{{UNIT}}',
						'body.rtl {{WRAPPER}} .header-cart span.count'       => 'right: {{SIZE}}{{UNIT}}',
					],
					'condition'  => [
						'count_offset_orientation_h!' => 'end',
						'count_position!'             => 'relative',
					],
				]
			);

			$this->add_responsive_control(
				'count_offset_x_end',
				[
					'label'      => __( 'Offset', 'apr-core' ),
					'type'       => Controls_Manager::SLIDER,
					'range'      => [
						'px' => [
							'min'  => - 100,
							'max'  => 100,
							'step' => 0.1,
						],
						'%'  => [
							'min' => - 200,
							'max' => 200,
						],
					],
					'default'    => [
						'size' => '0',
					],
					'size_units' => [ 'px', '%' ],
					'selectors'  => [
						'body:not(.rtl) {{WRAPPER}} .header-cart span.count' => 'right: {{SIZE}}{{UNIT}}',
						'body.rtl {{WRAPPER}} .header-cart span.count'       => 'left: {{SIZE}}{{UNIT}}',
					],
					'condition'  => [
						'count_offset_orientation_h' => 'end',
						'count_position!'            => 'relative',
					],
				]
			);

			$this->add_control(
				'count_offset_orientation_v',
				[
					'label'       => __( 'Vertical Orientation', 'apr-core' ),
					'type'        => Controls_Manager::CHOOSE,
					'label_block' => false,
					'toggle'      => false,
					'default'     => 'start',
					'options'     => [
						'start' => [
							'title' => __( 'Top', 'apr-core' ),
							'icon'  => 'eicon-v-align-top',
						],
						'end'   => [
							'title' => __( 'Bottom', 'apr-core' ),
							'icon'  => 'eicon-v-align-bottom',
						],
					],
					'render_type' => 'ui',
					'condition'   => [
						'count_position!' => 'relative',
					],
				]
			);

			$this->add_responsive_control(
				'count_offset_y',
				[
					'label'      => __( 'Offset', 'apr-core' ),
					'type'       => Controls_Manager::SLIDER,
					'range'      => [
						'px' => [
							'min'  => - 100,
							'max'  => 100,
							'step' => 1,
						],
						'%'  => [
							'min' => - 100,
							'max' => 200,
						],
					],
					'size_units' => [ 'px', '%' ],
					'default'    => [
						'size' => '0',
					],
					'selectors'  => [
						'{{WRAPPER}} .header-cart span.count' => 'top: {{SIZE}}{{UNIT}}',
					],
					'condition'  => [
						'count_offset_orientation_v!' => 'end',
						'count_position!'             => 'relative',
					],
				]
			);

			$this->add_responsive_control(
				'count_offset_y_end',
				[
					'label'      => __( 'Offset', 'apr-core' ),
					'type'       => Controls_Manager::SLIDER,
					'range'      => [
						'px' => [
							'min'  => - 100,
							'max'  => 100,
							'step' => 1,
						],
						'%'  => [
							'min' => - 200,
							'max' => 200,
						],
					],
					'size_units' => [ 'px', '%' ],
					'default'    => [
						'size' => '0',
					],
					'selectors'  => [
						'{{WRAPPER}} .header-cart span.count' => 'bottom: {{SIZE}}{{UNIT}}',
					],
					'condition'  => [
						'count_offset_orientation_v' => 'end',
						'count_position!'            => 'relative',
					],
				]
			);
			$this->end_controls_section();
			//Start Style Account
			$this->start_controls_section(
				'section_style_currency',
				[
					'label'     => __( ' Header Currency', 'apr-core' ),
					'tab'       => Controls_Manager::TAB_STYLE,
					'condition' => [
						'show_currency' => 'yes',
					],
				]
			);
			$this->add_responsive_control(
				'config_currency_padding',
				[
					'label'      => __( 'Padding', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .header-currency .woocs-style-1-dropdown  ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'config_currency_margin',
				[
					'label'      => __( 'Margin', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .header-currency .woocs-style-1-dropdown ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        => 'currency_border',
					'label'       => __( 'Border', 'apr-core' ),
					'placeholder' => '1px',
					'default'     => '1px',
					'selector'    => '{{WRAPPER}} .woocs-style-1-select',
				]
			);
			$this->add_responsive_control(
				'currency_border_radius',
				[
					'label'      => __( 'Border Radius', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .woocs-style-1-select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],

				]
			);
			$this->add_control(
				'icon_currency_cs',
				[
					'label' => __( 'Icon Style 2', 'apr-core' ),
					'type'  => Controls_Manager::SWITCHER,
				]
			);
			$this->add_responsive_control(
				'content_currency_padding',
				[
					'label'      => __( 'Padding', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .header-currency .woocs-style-1-dropdown .woocs-style-1-select  ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'currency_text_color',
				[
					'label' => __( 'Currency Color', 'apr-core' ),
					'type'  => Controls_Manager::COLOR,

					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .header-currency .woocs-style-1-dropdown .woocs-style-1-select > i,{{WRAPPER}} .header-currency .woocs-style-1-dropdown ' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'  => 'text_currency_size',
					'label' => __( 'Typography currency', 'apr-core' ),

					'selector' => '{{WRAPPER}}  .header-currency .woocs-style-1-dropdown .woocs-style-1-dropdown-menu li, {{WRAPPER}} .header-currency .woocs-style-1-dropdown',
				]
			);

			$this->add_control(
				'currency_text_hover_color',
				[
					'label' => __( 'Text Hover Color', 'apr-core' ),
					'type'  => Controls_Manager::COLOR,

					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .header-currency .woocs-style-1-dropdown:hover .woocs-style-1-select > i,{{WRAPPER}} .header-currency .woocs-style-1-dropdown:hover' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'icon_currency_size',
				[
					'label'     => __( 'Icon Size', 'apr-core' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .header-currency .woocs-style-1-dropdown .woocs-style-1-select > i:before' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'currency_dropdown_margin',
				[
					'label'      => __( 'Margin Dropdown', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .header-currency .woocs-style-1-dropdown .woocs-style-1-dropdown-menu' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'currency_dropdown_padding',
				[
					'label'      => __( 'Padding Dropdown', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .header-currency .woocs-style-1-dropdown .woocs-style-1-dropdown-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'  => 'typography_currency_dropdown',
					'label' => __( 'Typography dropdown currency', 'apr-core' ),

					'selector' => '{{WRAPPER}}  .header-currency .woocs-style-1-dropdown .woocs-style-1-dropdown-menu li',
				]
			);
			$this->add_control(
				'currency_text_dropdown_color',
				[
					'label' => __( 'Currency Dropdown Color', 'apr-core' ),
					'type'  => Controls_Manager::COLOR,

					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .header-currency .woocs-style-1-dropdown .woocs-style-1-dropdown-menu li' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'currency_text_dropdown_hover_color',
				[
					'label' => __( 'Text Hover Color', 'apr-core' ),
					'type'  => Controls_Manager::COLOR,

					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .header-currency .woocs-style-1-dropdown .woocs-style-1-dropdown-menu li:hover' => 'color: {{VALUE}};',
					],
				]
			);
			$this->end_controls_section();
		endif;
	}

	protected function render() {
		$this->apr_sc_header_group();
		$settings = $this->get_settings();

		if ( wp_is_mobile() ) {
			$this->add_render_attribute( 'wrapper', 'class', 'check-screen-mb' );
		}
		$header_classes = [ 'header-group' ];
		if ( $settings['show_header_mb'] == 'yes' ) {
			$header_classes[] = 'header-moblie-show';
		}
		if ( $settings['general_border_icon'] == 'yes' ) {
			$header_classes[] = 'show-border-icon';
		}
		$this->add_render_attribute( 'wrapper', [
			'class' => $header_classes,
		] );
		?>
		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<?php
			if ( $settings['show_search'] == 'yes' ) {
				$this->render_search_form();
			}
			if ( $settings['icon_visit_home'] == 'yes' ) {
				$classes = array( 'header-visit-home' );
				if ( $settings['show_icon_home_desktop'] == 'yes' ) {
					$classes[] = "hidden-desktop";
				}
				if ( $settings['show_icon_home_tablet'] == 'yes' ) {
					$classes[] = "hidden-tablet";
				}
				if ( $settings['show_icon_home_mobile'] == 'yes' ) {
					$classes[] = "hidden-mobile";
				}
				?>
				<div class="<?php echo implode( ' ', $classes ); ?>">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
					   rel="home"><i class="<?php echo $settings['visit_home_icon']; ?>" aria-hidden="true"></i></a>
				</div>
				<?php
			}
			if ( apr_is_woocommerce_activated() ):
				if ( $settings['show_account'] == 'yes' ) {
					?>
					<div <?php $this->render_account_class() ?>>
						<?php
						$this->render_account();
						?>
					</div>
					<?php
				}
			endif;
			if ( $settings['show_language'] == 'yes' ) {
				$classes = array( 'header-language' );
				if ( $settings['show_icon_language'] === 'style2' ) {
					$classes[] = "header-language-icon";
				} elseif ( $settings['show_icon_language'] === 'style3' ) {
					$classes[] = "header-language-text";
				} elseif ( $settings['show_icon_language'] === 'style4' ) {
					$classes[] = "header-language-text-flag";
				} elseif ( $settings['show_icon_language'] === 'style5' ) {
					$classes[] = "header-language-flag";
				} else {
					$classes[] = "header-language-default";
				}
				if ( $settings['show_language_desktop'] == 'yes' ) {
					$classes[] = "hidden-desktop";
				}
				if ( $settings['show_language_tablet'] == 'yes' ) {
					$classes[] = "hidden-tablet";
				}
				if ( $settings['show_language_mobile'] == 'yes' ) {
					$classes[] = "hidden-mobile";
				}
				if ( $settings['show_line_right'] == 'yes' ) {
					$classes[] = "show-line-right";
				}
				?>
				<div class="<?php echo implode( ' ', $classes ); ?>">
					<?php
					get_template_part( 'templates/header/language' );
					?>
				</div>
				<?php
			}
			if ( apr_is_woocommerce_activated() ):
				if ( $settings['show_currency'] == 'yes' ) {
					$classes = array( 'header-currency' );
					if ( $settings['show_currency_desktop'] == 'yes' ) {
						$classes[] = "hidden-desktop";
					}
					if ( $settings['show_currency_tablet'] == 'yes' ) {
						$classes[] = "hidden-tablet";
					}
					if ( $settings['show_currency_mobile'] == 'yes' ) {
						$classes[] = "hidden-mobile";
					}
					if ( $settings['show_currency_flag_dropdown'] == 'yes' ) {
						$classes[] = "hidden-flag-dropdown";
					}
					if ( $settings['icon_currency_cs'] == 'yes' ) {
						$classes[] = "icon_currency_cs";
					}
					?>
					<div class="<?php echo implode( ' ', $classes ); ?>">
						<?php echo do_shortcode( '[woocs show_flags=1 style=1]' ); ?>
					</div>
					<?php
				}
			endif;
			if ( $settings['show_link'] == 'yes' ) {
				if ( empty( $settings['list_link'] ) ) {
					return;
				}
				$this->render_link_custom();
			}

			if ( $settings['show_address'] == 'yes' ) {
				$this->render_address();
			}
			if ( $settings['show_social'] == 'yes' ) {
				$this->render_social();
			}
			if ( is_plugin_active( 'yith-woocommerce-wishlist/init.php' ) ):
				if ( $settings['show_wishlist'] == 'yes' ) {

					$this->render_wishlist();
				}
			endif;
			if ( apr_is_woocommerce_activated() ):
				if ( $settings['show_cart'] == 'yes' ) {
					$this->render_cart();
				}
			endif;
			?>
		</div>
		<?php
	}

	public function render_cart_class() {
		$settings = $this->get_settings();
		$classes  = array( 'header-cart' );
		if ( $settings['show_cart_desktop'] == 'yes' ) {
			$classes[] = "hidden-desktop";
		}
		if ( $settings['show_cart_tablet'] == 'yes' ) {
			$classes[] = "hidden-tablet";
		}
		if ( $settings['show_cart_mobile'] == 'yes' ) {
			$classes[] = "hidden-mobile";
		}

		$classes = apply_filters( 'cart_class', $classes );
		echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
	}

	public function render_account_class() {
		$settings = $this->get_settings();
		$classes  = array( 'header-account' );
		if ( $settings['show_account_desktop'] == 'yes' ) {
			$classes[] = "hidden-desktop";
		}
		if ( $settings['show_account_tablet'] == 'yes' ) {
			$classes[] = "hidden-tablet";
		}
		if ( $settings['show_account_mobile'] == 'yes' ) {
			$classes[] = "hidden-mobile";
		}

		$classes = apply_filters( 'account_class', $classes );
		echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
	}

	public function render_search_class() {
		$settings = $this->get_settings();
		$classes  = array( 'header-search' );
		if ( $settings['show_search_desktop'] == 'yes' ) {
			$classes[] = "hidden-desktop";
		}
		if ( $settings['show_search_tablet'] == 'yes' ) {
			$classes[] = "hidden-tablet";
		}
		if ( $settings['show_search_mobile'] == 'yes' ) {
			$classes[] = "hidden-mobile";
		}

		if ( $settings['show_field_search'] == 'yes' ) {
			$classes[] = "show-field";
		} else {
			$classes[] = "not-show-field";
		}
		if ( $settings['hide_icon_search_mobile'] == 'yes' ) {
			$classes[] = "hiden-icon-search";
		}
		$classes = apply_filters( 'search_class', $classes );
		echo 'class="' . esc_attr( join( ' ', $classes ) ) . '"';
	}

	protected function render_wishlist() {
		$settings = $this->get_settings();
		$classes  = [];
		if ( $settings['show_wishlist_desktop'] == 'yes' ) {
			$classes[] = "hidden-desktop";
		}
		if ( $settings['show_wishlist_tablet'] == 'yes' ) {
			$classes[] = "hidden-tablet";
		}
		if ( $settings['show_wishlist_mobile'] == 'yes' ) {
			$classes[] = "hidden-mobile";
		}
		if ( $settings['show_subtotal'] == 'yes' ) {
			$classes[] = "show_count";
		}
		$items = '';

		if ( function_exists( 'yith_wcwl_count_all_products' ) ) {
			$items .= '<div class="header-wishlist ' . implode( ' ', $classes ) . ' ">';
			$items .= '<a class="apr-header-wishlist" title="' . esc_attr__( 'View wishlist ', 'apr-core' ) . '" href="' . esc_url( get_permalink( get_option( 'yith_wcwl_wishlist_page_id' ) ) ) . '">';
			$items .= '<i class="' . $settings['wishlist_icon'] . '" aria-hidden="true"></i>';
			if ( $settings['show_subtotal'] ) {
				$items .= '<span class="count ajax-wishlist">' . esc_html( yith_wcwl_count_all_products() ) . '</span>';
			}
			$items .= '</a>';
			$items .= '</div>';
		}
		echo( $items );

	}

	protected function render_address() {
		$settings = $this->get_settings();
		$classes  = [];
		if ( $settings['show_address_desktop'] == 'yes' ) {
			$classes[] = "hidden-desktop";
		}
		if ( $settings['show_address_tablet'] == 'yes' ) {
			$classes[] = "hidden-tablet";
		}
		if ( $settings['show_address_mobile'] == 'yes' ) {
			$classes[] = "hidden-mobile";
		}
		?>
		<div class="header-address <?php if ( $settings['show_text_address'] !== 'yes' ) {
			echo 'address-hidden-text';
		} ?> <?php if ( $settings['show_icon_address'] == 'yes' ) {
			echo 'show-icon-address';
		} ?> <?php echo implode( ' ', $classes ); ?>">
			<address>
				<?php echo $settings['name-address']; ?>
			</address>
		</div>
		<?php
	}

	protected function render_social() {
		$settings = $this->get_settings();
		$classes  = [];
		if ( $settings['show_social_desktop'] == 'yes' ) {
			$classes[] = "hidden-desktop";
		}
		if ( $settings['show_social_tablet'] == 'yes' ) {
			$classes[] = "hidden-tablet";
		}
		if ( $settings['show_social_mobile'] == 'yes' ) {
			$classes[] = "hidden-mobile";
		}
		?>
		<div class="header-social <?php echo implode( ' ', $classes ) ?> ">
			<ul class="socials">
				<?php if ( ! empty( $settings['social_facebook']['url'] ) ) : ?>
					<?php $target = $settings['social_facebook']['is_external'] ? ' target="_blank"' : ''; ?>
					<li>
						<a href="<?php echo esc_url( $settings['social_facebook']['url'] ); ?>"<?php echo $target; ?>><i
								class="theme-icon-facebook"></i></a>
					</li>
				<?php endif; ?>
				<?php if ( ! empty( $settings['social_twitter']['url'] ) ) : ?>
					<?php $target = $settings['social_twitter']['is_external'] ? ' target="_blank"' : ''; ?>
					<li>
						<a href="<?php echo esc_url( $settings['social_twitter']['url'] ); ?>"<?php echo $target; ?>><i
								class="theme-icon-twitter"></i></a>
					</li>
				<?php endif; ?>
				<?php if ( ! empty( $settings['social_google']['url'] ) ) : ?>
					<?php $target = $settings['social_google']['is_external'] ? ' target="_blank"' : ''; ?>
					<li>
						<a href="<?php echo esc_url( $settings['social_google']['url'] ); ?>"<?php echo $target; ?>><i
								class="theme-icon-google-hangouts"></i></a>
					</li>
				<?php endif; ?>
				<?php if ( ! empty( $settings['social_pinterest']['url'] ) ) : ?>
					<?php $target = $settings['social_pinterest']['is_external'] ? ' target="_blank"' : ''; ?>
					<li>
						<a href="<?php echo esc_url( $settings['social_pinterest']['url'] ); ?>"<?php echo $target; ?>><i
								class="theme-icon-pinterest"></i></a>
					</li>
				<?php endif; ?>
				<?php if ( ! empty( $settings['social_instagram']['url'] ) ) : ?>
					<?php $target = $settings['social_instagram']['is_external'] ? ' target="_blank"' : ''; ?>
					<li>
						<a href="<?php echo esc_url( $settings['social_instagram']['url'] ); ?>"<?php echo $target; ?>><i
								class="theme-icon-instagram"></i></a>
					</li>
				<?php endif; ?>

			</ul>
		</div>
		<?php
	}

	protected function render_search_form() {
		$settings = $this->get_settings();
		if ( $settings['hide_icon_search_mobile'] == 'yes' ) {
			$hide_icon = "hiden-icon-search";
		} else {
			$hide_icon = '';
		}
		?>
		<?php if ( wp_is_mobile() ): ?>
			<div class="header-search not-show-field <?php echo esc_attr( $hide_icon ); ?>">
				<div class="btn-search toggle-search">
					<i class="<?php echo $settings['icon_skin']; ?>" aria-hidden="true"></i>
				</div>
				<?php Lusion_Templates::get_search_box(); ?>
			</div>
		<?php else: ?>
			<div <?php $this->render_search_class(); ?>>
				<?php if ( $settings['show_field_search'] == 'yes' ): ?>
					<?php $lusion_search_template = lusion_get_search_form();
					echo wp_kses( $lusion_search_template, lusion_allow_html() );
					?>
				<?php else: ?>
					<div class="btn-search toggle-search">
						<i class="<?php echo $settings['icon_skin']; ?>" aria-hidden="true"></i>
					</div>
					<?php Lusion_Templates::get_search_box(); ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<?php
	}

	protected function render_link_custom() {
		$settings = $this->get_settings();
		$link     = '';
		$classes  = [];
		if ( $settings['show_link_desktop'] == 'yes' ) {
			$classes[] = "hidden-desktop";
		}
		if ( $settings['show_link_tablet'] == 'yes' ) {
			$classes[] = "hidden-tablet";
		}
		if ( $settings['show_link_mobile'] == 'yes' ) {
			$classes[] = "hidden-mobile";
		}
		?>
		<div class="header-link <?php echo implode( ' ', $classes ) ?>">
			<ul>
				<?php foreach ( $settings['list_link'] as $key => $list_link ) : ?>
					<?php
					$url         = ! empty( $list_link['link']['url'] ) ? 'href="' . $list_link['link']['url'] . '"' : 'href="#"  ';
					$is_external = ! empty( $list_link['link']['is_external'] ) ? 'target="_blank" ' : ' ';
					$nofollow    = ! empty( $list_link['link']['nofollow'] ) ? 'rel="nofollow" ' : ' ';
					$atts        = $url . ' ' . $is_external . $nofollow;

					?>

					<li><a <?php echo wp_kses_post( $atts ); ?>>
							<?php echo $list_link['text_link']; ?>
						</a></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php
	}

	protected function render_cart() {
		$settings = $this->get_settings(); ?>

		<div <?php $this->render_cart_class(); ?>>
			<?php if ( is_cart() || is_checkout() ): ?>
				<a class="shopping-cart <?php if ( $settings['show_count'] ) {
					echo 'show-count';
				} ?>"
				   href="<?php echo wc_get_cart_url(); ?>" title="">
					<i class="<?php echo $settings['cart_icon']; ?>"></i>
					<?php if ( $settings['show_count'] ): ?>
						<span class="count d-inline-block text-center">
                        <?php echo is_object( WC()->cart ) ? WC()->cart->get_cart_contents_count() : ''; ?>
                    </span>
					<?php endif; ?>
				</a>
			<?php else: ?>
				<a class="shopping-cart-button <?php if ( $settings['show_count'] ) { 
					echo 'show-count';
				} ?>"
				   href="#" title="">
					<i class="<?php echo $settings['cart_icon']; ?>"></i>
					<?php if ( $settings['show_count'] ): ?>
						<span class="count d-inline-block text-center">
                        <?php echo is_object( WC()->cart ) ? WC()->cart->get_cart_contents_count() : ''; ?>
                    </span>
					<?php endif; ?>
				</a>
			<?php endif; ?>
		</div>
		<?php
	}

	protected function render_account() {
		$settings = $this->get_settings();
		if ( apr_is_woocommerce_activated() ) {
			$account_link = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
			$logout_url   = wp_logout_url( get_permalink( $account_link ) );
		} else {
			$account_link = wp_login_url();
		}
		if ( get_option( 'woocommerce_force_ssl_checkout' ) == 'yes' ) {
			$logout_url = str_replace( 'http:', 'https:', $logout_url );
		}
		?>
		<?php if ( ! is_user_logged_in() ): ?>
			<?php if ( wp_is_mobile() ): ?>
				<a href="#" class="icon-login">
					<i class="theme-icon-user2"></i>
				</a>
			<?php else: ?>
				<a href="#popup-account" class="icon-login only_icon" data-fancybox>
					<i class="theme-icon-user2"></i>
				</a>
			<?php endif; ?>
		<?php else: ?>
			<a href="<?php echo esc_url( $account_link ) ?>">
				<i class="theme-icon-user2"></i>
			</a>
		<?php endif; ?>
		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Apr_Core_Header_Group );
