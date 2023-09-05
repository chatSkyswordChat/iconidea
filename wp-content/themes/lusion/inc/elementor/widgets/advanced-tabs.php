<?php

namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Apr_Core_Widget_Advanced_Tabs extends Widget_Base {

	public function apr_sc_tabs() {
		/* Add css */
		if ( is_rtl() ) {
			wp_enqueue_style( 'apr-sc-tabs', LUSION_CSS . '/elementor/advance-tabs-rtl.css', array(), LUSION_THEME_VERSION );
		} else {
			wp_enqueue_style( 'apr-sc-tabs', LUSION_CSS . '/elementor/advance-tabs.css', array(), LUSION_THEME_VERSION );
		}
	}

	public function get_name() {
		return 'apr-adv-tabs';
	}

	public function get_title() {
		return esc_html__( 'APR Advanced Tabs', 'apr-core' );
	}

	public function get_script_depends() {
		return [
			'apr-scripts'
		];
	}

	public function get_icon() {
		return 'eicon-tabs';
	}

	public function get_categories() {
		return [ 'apr-core' ];
	}

	protected function register_controls() {
		/**
		 * Advance Tabs Settings
		 */
		$this->start_controls_section(
			'apr_section_adv_tabs_settings',
			[
				'label' => esc_html__( 'General Settings', 'apr-core' )
			]
		);
		$this->add_control(
			'apr_adv_tabs_icon_show',
			[
				'label'        => esc_html__( 'Enable Icon', 'apr-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			]
		);
		$this->add_control(
			'apr_adv_tabs_type',
			[
				'label'   => __( 'Type', 'apr-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1'                   => __( 'Layer 1', 'apr-core' ),
					'2'                   => __( 'Layer 2', 'apr-core' ),
					'apr-tabs-vertical'   => __( 'Layer 3', 'apr-core' ),
					'apr-tabs-vertical-2' => __( 'Layer 4', 'apr-core' ),
				],
			]
		);
		$this->end_controls_section();

		/**
		 * Advance Tabs Content Settings
		 */
		$this->start_controls_section(
			'apr_section_adv_tabs_content_settings',
			[
				'label' => esc_html__( 'Content', 'apr-core' )
			]
		);
		$this->add_control(
			'apr_adv_tabs_tab',
			[
				'type'        => Controls_Manager::REPEATER,
				'seperator'   => 'before',
				'default'     => [
					[ 'apr_adv_tabs_tab_title' => esc_html__( 'Tab 1', 'apr-core' ) ],
					[ 'apr_adv_tabs_tab_title' => esc_html__( 'Tab 2', 'apr-core' ) ],
					[ 'apr_adv_tabs_tab_title' => esc_html__( 'Tab 3', 'apr-core' ) ],
				],
				'fields'      => [
					[
						'name'         => 'apr_adv_tabs_tab_show_as_default',
						'label'        => __( 'Set as Default', 'apr-core' ),
						'type'         => Controls_Manager::SWITCHER,
						'default'      => 'inactive',
						'return_value' => 'active-default',
					],
					[
						'name'        => 'apr_adv_tabs_icon_type',
						'label'       => esc_html__( 'Icon Type', 'apr-core' ),
						'type'        => Controls_Manager::CHOOSE,
						'label_block' => false,
						'options'     => [
							'none'  => [
								'title' => esc_html__( 'None', 'apr-core' ),
								'icon'  => 'fa fa-ban',
							],
							'icon'  => [
								'title' => esc_html__( 'Icon', 'apr-core' ),
								'icon'  => 'fa fa-gear',
							],
							'image' => [
								'title' => esc_html__( 'Image', 'apr-core' ),
								'icon'  => 'fa fa-picture-o',
							],
						],
						'default'     => 'icon',
					],
					[
						'name'      => 'apr_adv_tabs_tab_title_icon',
						'label'     => esc_html__( 'Icon', 'apr-core' ),
						'type'      => Controls_Manager::ICON,
						'default'   => '',
						'condition' => [
							'apr_adv_tabs_icon_type' => 'icon'
						]
					],
					[
						'name'      => 'apr_adv_tabs_tab_title_image',
						'label'     => esc_html__( 'Image', 'apr-core' ),
						'type'      => Controls_Manager::MEDIA,
						'default'   => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'condition' => [
							'apr_adv_tabs_icon_type' => 'image'
						]
					],
					[
						'name'    => 'apr_adv_tabs_tab_title',
						'label'   => esc_html__( 'Tab Title', 'apr-core' ),
						'type'    => Controls_Manager::TEXT,
						'default' => esc_html__( 'Tab Title', 'apr-core' ),
						'dynamic' => [ 'active' => true ]
					],
					[
						'name'    => 'apr_adv_tabs_text_type',
						'label'   => __( 'Content Type', 'apr-core' ),
						'type'    => Controls_Manager::SELECT,
						'options' => [
							'content'  => __( 'Content', 'apr-core' ),
							'template' => __( 'Saved Templates', 'apr-core' ),
						],
						'default' => 'content',
					],
					[
						'name'      => 'apr_primary_templates',
						'label'     => __( 'Choose Template', 'apr-core' ),
						'type'      => Controls_Manager::SELECT,
						'options'   => apr_core_get_page_templates(),
						'condition' => [
							'apr_adv_tabs_text_type' => 'template',
						],
					],
					[
						'name'      => 'apr_adv_tabs_tab_content',
						'label'     => esc_html__( 'Tab Content', 'apr-core' ),
						'type'      => Controls_Manager::WYSIWYG,
						'default'   => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur.', 'apr-core' ),
						'dynamic'   => [ 'active' => true ],
						'condition' => [
							'apr_adv_tabs_text_type' => 'content',
						],
					],
					[
						'name'      => 'apr_adv_tabs_tab_content_image',
						'label'     => esc_html__( 'Image', 'apr-core' ),
						'type'      => Controls_Manager::MEDIA,
						'default'   => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'condition' => [
							'apr_adv_tabs_text_type' => 'content',
						],
					],
				],
				'title_field' => '{{apr_adv_tabs_tab_title}}',
			]
		);
		$this->end_controls_section();

		/**
		 * -------------------------------------------
		 * Tab Style Advance Tabs Generel Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'apr_section_adv_tabs_style_settings',
			[
				'label' => esc_html__( 'General', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'apr_adv_tabs_padding',
			[
				'label'      => esc_html__( 'Padding Tabs', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .apr-advance-tabs' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'apr_adv_tabs_margin',
			[
				'label'      => esc_html__( 'Margin Tabs', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .apr-advance-tabs' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'apr_adv_tabs_border',
				'label'    => esc_html__( 'Border', 'apr-core' ),
				'selector' => '{{WRAPPER}} .apr-advance-tabs',
			]
		);
		$this->add_responsive_control(
			'apr_adv_tabs_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .apr-advance-tabs' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'apr_adv_tabs_box_shadow',
				'selector' => '{{WRAPPER}} .apr-advance-tabs',
			]
		);
		$this->end_controls_section();
		/**
		 * -------------------------------------------
		 * Tab Style Advance Tabs Content Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'apr_section_adv_tabs_tab_style_settings',
			[
				'label' => esc_html__( 'Tab Title', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'apr_adv_tabs_tab_padding',
			[
				'label'      => esc_html__( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > apr-tab-top-icon .item-tab,
	 					{{WRAPPER}} .apr-advance-tabs:not(.apr-tabs-vertical).type-2 .apr-tabs-nav .apr-tab-top-icon .item-tab' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'apr_adv_tabs_tab_margin',
			[
				'label'      => esc_html__( 'Margin', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > apr-tab-top-icon .item-tab,
	 					{{WRAPPER}} .apr-advance-tabs:not(.apr-tabs-vertical).type-2 .apr-tabs-nav .apr-tab-top-icon .item-tab' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'item_adv_tabs__shadow',
				'selector' => '{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav',
			]
		);

		$this->add_responsive_control(
			'apr_adv_tabs_tab_line_right_height',
			[
				'label'      => __( 'Line Height', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'size' => 0,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > .apr-tab-top-icon .item-tab:after' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'apr_adv_tabs_type!' => [ 'apr-tabs-vertical-2', 'apr-tabs-vertical' ],
				],
			]
		);
		$this->add_responsive_control(
			'apr_adv_tabs_tab_line_right_width',
			[
				'label'      => __( 'Line Width', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'size' => 1,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > .apr-tab-top-icon .item-tab:after' => 'width: {{SIZE}}{{UNIT}};right: calc(-{{SIZE}}{{UNIT}}/2);',
				],
				'condition'  => [
					'apr_adv_tabs_type!' => [ 'apr-tabs-vertical-2', 'apr-tabs-vertical' ],
				],
			]
		);
		$this->add_control(
			'apr_adv_tabs_tab_line_color',
			[
				'label'     => esc_html__( 'Line Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > .apr-tab-top-icon .item-tab:after' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'apr_adv_tabs_type!' => [ 'apr-tabs-vertical-2', 'apr-tabs-vertical' ],
				],
			]
		);
		$this->start_controls_tabs( 'apr_adv_tabs_header_tabs' );
		// Normal State Tab
		$this->start_controls_tab( 'apr_adv_tabs_header_normal', [ 'label' => esc_html__( 'Normal', 'apr-core' ) ] );
		$this->add_control(
			'apr_adv_tabs_tab_color',
			[
				'label'     => esc_html__( 'Tab Background Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > .apr-tab-top-icon .item-tab' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'apr_adv_tabs_tab_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > .apr-tab-top-icon .item-tab span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'apr_adv_tabs_tab_icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > .apr-tab-top-icon .item-tab i' => 'color: {{VALUE}};',
				],
				'condition' => [
					'apr_adv_tabs_icon_show' => 'yes'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'apr_adv_tabs_tab_border',
				'label'    => esc_html__( 'Border', 'apr-core' ),
				'selector' => '{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > .apr-tab-top-icon .item-tab',
			]
		);
		$this->add_responsive_control(
			'apr_adv_tabs_tab_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > .apr-tab-top-icon .item-tab' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		// Hover State Tab
		$this->start_controls_tab( 'apr_adv_tabs_header_hover', [ 'label' => esc_html__( 'Hover', 'apr-core' ) ] );
		$this->add_control(
			'apr_adv_tabs_tab_color_hover',
			[
				'label'     => esc_html__( 'Tab Background Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > .apr-tab-top-icon .item-tab:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'apr_adv_tabs_tab_text_color_hover',
			[
				'label'     => esc_html__( 'Text Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > .apr-tab-top-icon .item-tab:hover span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'apr_adv_tabs_tab_icon_color_hover',
			[
				'label'     => esc_html__( 'Icon Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > .apr-tab-top-icon .item-tab:hover i' => 'color: {{VALUE}};',
				],
				'condition' => [
					'apr_adv_tabs_icon_show' => 'yes'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'apr_adv_tabs_tab_border_hover',
				'label'    => esc_html__( 'Border', 'apr-core' ),
				'selector' => '{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > .apr-tab-top-icon .item-tab:hover',
			]
		);
		$this->add_responsive_control(
			'apr_adv_tabs_tab_border_radius_hover',
			[
				'label'      => esc_html__( 'Border Radius', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > .apr-tab-top-icon .item-tab:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		// Active State Tab
		$this->start_controls_tab( 'apr_adv_tabs_header_active', [ 'label' => esc_html__( 'Active', 'apr-core' ) ] );
		$this->add_control(
			'apr_adv_tabs_tab_color_active',
			[
				'label'     => esc_html__( 'Tab Background Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > .apr-tab-top-icon .item-tab.active'         => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > .apr-tab-top-icon .item-tab.active-default' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'apr_adv_tabs_tab_text_color_active',
			[
				'label'     => esc_html__( 'Text Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > .apr-tab-top-icon .item-tab.active .apr-tab-title'         => 'color: {{VALUE}};',
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > .apr-tab-top-icon .item-tab.active-deafult .apr-tab-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'apr_adv_tabs_tab_icon_color_active',
			[
				'label'     => esc_html__( 'Icon Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > .apr-tab-top-icon .item-tab.active i'         => 'color: {{VALUE}};',
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > .apr-tab-top-icon .item-tab.active-default i' => 'color: {{VALUE}};',
				],
				'condition' => [
					'apr_adv_tabs_icon_show' => 'yes'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'apr_adv_tabs_tab_border_active',
				'label'    => esc_html__( 'Border', 'apr-core' ),
				'selector' => '{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > .apr-tab-top-icon .item-tab.active, {{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > ul .item-tab.active-default',
			]
		);
		$this->add_responsive_control(
			'apr_adv_tabs_tab_border_radius_active',
			[
				'label'      => esc_html__( 'Border Radius', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > .apr-tab-top-icon .item-tab.active'         => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > .apr-tab-top-icon .item-tab.active-default' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		//icon
		$this->start_controls_section(
			'apr_section_icon_settings',
			[
				'label' => esc_html__( 'Icon', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'apr_adv_tabs_tab_icon_size',
			[
				'label'      => __( 'Icon Size', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'size' => 16,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > .apr-tab-top-icon .item-tab i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > .apr-tab-top-icon .item-tab img' => 'width: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'apr_adv_tabs_tab_icon_gap',
			[
				'label'      => __( 'Icon Gap', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'size' => 0,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .apr-tab-inline-icon .item-tab i, {{WRAPPER}} .apr-tab-inline-icon .item-tab img' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .apr-tab-top-icon .item-tab i, {{WRAPPER}} .apr-tab-top-icon .item-tab img'       => 'margin-bottom: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'apr_icon_tab_padding',
			[
				'label'      => esc_html__( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > .apr-tab-top-icon .item-tab i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'apr_icon_tab_margin',
			[
				'label'      => esc_html__( 'Margin', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > .apr-tab-top-icon .item-tab i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		//Title
		$this->start_controls_section(
			'apr_section_title_settings',
			[
				'label' => esc_html__( 'Title', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'apr_adv_tabs_tab_title_typography',
				'selector' => '{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > .apr-tab-top-icon .item-tab .apr-tab-title',
			]
		);
		$this->add_responsive_control(
			'apr_title_tab_padding',
			[
				'label'      => esc_html__( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > .apr-tab-top-icon .item-tab .apr-tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'apr_title_tab_margin',
			[
				'label'      => esc_html__( 'Margin', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-nav > .apr-tab-top-icon .item-tab .apr-tab-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		/**
		 * -------------------------------------------
		 * Tab Style Advance Tabs Content Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'apr_section_adv_tabs_tab_content_style_settings',
			[
				'label' => esc_html__( 'Content', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'adv_tabs_content_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-content .tabs-content-adv' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'adv_tabs_content_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333',
				'selectors' => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-content .tabs-content-adv, .apr-advance-tabs .apr-tabs-content > div p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'apr_adv_tabs_content_typography',
				'selector' => '{{WRAPPER}} .apr-advance-tabs .apr-tabs-content .tabs-content-adv',
			]
		);
		$this->add_responsive_control(
			'apr_adv_tabs_content_padding',
			[
				'label'      => esc_html__( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-content .tabs-content-adv' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'apr_adv_tabs_content_margin',
			[
				'label'      => esc_html__( 'Margin', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-content .tabs-content-adv' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'apr_adv_tabs_content_border',
				'label'    => esc_html__( 'Border', 'apr-core' ),
				'selector' => '{{WRAPPER}} .apr-advance-tabs .apr-tabs-content > div',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'apr_adv_tabs_content_shadow',
				'selector'  => '{{WRAPPER}} .apr-advance-tabs .apr-tabs-content > div',
				'separator' => 'before'
			]
		);
		$this->end_controls_section();
		/**
		 * -------------------------------------------
		 * Tab Style Advance Tabs Images Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'apr_section_adv_tabs_tab_images_style_settings',
			[
				'label' => esc_html__( 'Image', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'apr_adv_tabs_image_padding',
			[
				'label'      => esc_html__( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-content .tabs-image-adv' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'apr_adv_tabs_image_margin',
			[
				'label'      => esc_html__( 'Margin', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-content .tabs-image-adv' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'adv_tabs_image_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-content .tabs-image-adv' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'apr_adv_tabs_tab_border_radius_image',
			[
				'label'      => esc_html__( 'Border Radius', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .apr-advance-tabs .apr-tabs-content .tabs-image-adv img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

	}

	protected function render() {
		$this->apr_sc_tabs();
		$settings             = $this->get_settings_for_display();
		$apr_find_default_tab = array();

		/* Import js */
		wp_enqueue_script( 'apr-tab-script', LUSION_JS . '/elementor/advanced-tabs.min.js', array() );

		$this->add_render_attribute(
			'apr_tab_wrapper',
			[
				'id'         => "apr-advance-tabs-{$this->get_id()}",
				'class'      => [ 'apr-advance-tabs apr-tabs-horizontal apr-tabs-type-1 active-caret-on', $settings['apr_adv_tabs_type'] ],
				'data-tabid' => $this->get_id()
			]
		);
		if ( $settings['apr_adv_tabs_type'] === 'apr-tabs-vertical-2' ) {
			$this->add_render_attribute( 'apr_tab_wrapper', 'class', 'apr-tabs-vertical' );
		}
		if ( $settings['apr_adv_tabs_type'] === '2' ) {
			$this->add_render_attribute( 'apr_tab_wrapper', 'class', 'type-2' );
		}
		$this->add_render_attribute( 'apr_tab_icon_position', 'class', esc_attr( 'apr-tab-top-icon' ) );
		?>
		<div <?php echo $this->get_render_attribute_string( 'apr_tab_wrapper' ); ?>>
			<?php if ( $settings['apr_adv_tabs_type'] === 'apr-tabs-vertical' || $settings['apr_adv_tabs_type'] === 'apr-tabs-vertical-2' ) { ?>
				<div class="apr-tabs-nav">
					<div <?php echo $this->get_render_attribute_string( 'apr_tab_icon_position' ); ?>>
						<?php foreach ( $settings['apr_adv_tabs_tab'] as $tab ) : ?>
							<?php $link_image = isset( $tab['apr_adv_tabs_tab_content_image']['url'] ) ? $tab['apr_adv_tabs_tab_content_image']['url'] : ''; ?>
							<div
								class="item-tab <?php echo esc_attr( $tab['apr_adv_tabs_tab_show_as_default'] ); ?>"><?php if ( $settings['apr_adv_tabs_icon_show'] === 'yes' ) :
									if ( $tab['apr_adv_tabs_icon_type'] === 'icon' ) : ?>
										<i class="<?php echo esc_attr( $tab['apr_adv_tabs_tab_title_icon'] ); ?>"></i>
									<?php elseif ( $tab['apr_adv_tabs_icon_type'] === 'image' ) : ?>
										<img
											src="<?php echo esc_attr( $tab['apr_adv_tabs_tab_title_image']['url'] ); ?>">
									<?php endif; ?>
								<?php endif; ?>
								<span class="apr-tab-title"><?php echo $tab['apr_adv_tabs_tab_title']; ?></span>
							</div>
							<div class="apr-tabs-content">
								<?php $apr_find_default_tab[] = $tab['apr_adv_tabs_tab_show_as_default']; ?>
								<div
									class="clearfix tabs-content tabs-scroll <?php echo esc_attr( $tab['apr_adv_tabs_tab_show_as_default'] );
									if ( $link_image !== '' ) {
										echo esc_attr( ' tabs-content-flex' );
									} ?>">
									<div class="tabs-content-adv<?php if ( $link_image !== '' ) {
										echo esc_attr( ' tabs-content-w50' );
									} ?>">
										<?php if ( 'content' == $tab['apr_adv_tabs_text_type'] ) : ?>
											<?php echo do_shortcode( $tab['apr_adv_tabs_tab_content'] ); ?>
										<?php elseif ( 'template' == $tab['apr_adv_tabs_text_type'] ) : ?>
											<?php
											if ( ! empty( $tab['apr_primary_templates'] ) ) {
												$apr_template_id = $tab['apr_primary_templates'];
												$apr_frontend    = new Frontend;
												echo $apr_frontend->get_builder_content( $apr_template_id, true );
											}
											?>
										<?php endif; ?>
									</div>
									<?php
									if ( 'content' == $tab['apr_adv_tabs_text_type'] && $link_image !== '' ) { ?>
										<div class="tabs-image-adv">
											<img src="<?php echo esc_attr( $link_image ); ?>">
										</div>
									<?php }
									?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php } ?>
			<div class="apr-tabs-content">
				<?php foreach ( $settings['apr_adv_tabs_tab'] as $tab ) : $apr_find_default_tab[] = $tab['apr_adv_tabs_tab_show_as_default']; ?>
					<?php $link_image = isset( $tab['apr_adv_tabs_tab_content_image']['url'] ) ? $tab['apr_adv_tabs_tab_content_image']['url'] : ''; ?>
					<div
						class="clearfix tabs-content tabs-scroll <?php echo esc_attr( $tab['apr_adv_tabs_tab_show_as_default'] );
						if ( $link_image !== '' ) {
							echo esc_attr( ' tabs-content-flex' );
						} ?>">
						<div class="tabs-content-adv<?php if ( $link_image !== '' ) {
							echo esc_attr( ' tabs-content-w50' );
						} ?>">
							<?php if ( 'content' == $tab['apr_adv_tabs_text_type'] ) : ?>
								<?php echo do_shortcode( $tab['apr_adv_tabs_tab_content'] ); ?>
							<?php elseif ( 'template' == $tab['apr_adv_tabs_text_type'] ) : ?>
								<?php
								if ( ! empty( $tab['apr_primary_templates'] ) ) {
									$apr_template_id = $tab['apr_primary_templates'];
									$apr_frontend    = new Frontend;
									echo $apr_frontend->get_builder_content( $apr_template_id, true );
								}
								?>
							<?php endif; ?>
						</div>
						<?php
						if ( 'content' == $tab['apr_adv_tabs_text_type'] && $link_image !== '' ) { ?>
							<div class="tabs-image-adv">
								<img src="<?php echo esc_attr( $link_image ) ?>">
							</div>
							<?php
						}
						?>
					</div>
				<?php endforeach; ?>
			</div>
			<?php if ( $settings['apr_adv_tabs_type'] !== 'apr-tabs-vertical' && $settings['apr_adv_tabs_type'] !== 'apr-tabs-vertical-2' ) { ?>
				<div class="apr-tabs-nav">
					<div <?php echo $this->get_render_attribute_string( 'apr_tab_icon_position' ); ?>>
						<?php foreach ( $settings['apr_adv_tabs_tab'] as $tab ) : ?>
							<div
								class="item-tab <?php echo esc_attr( $tab['apr_adv_tabs_tab_show_as_default'] ); ?>"><?php if ( $settings['apr_adv_tabs_icon_show'] === 'yes' ) :
									if ( $tab['apr_adv_tabs_icon_type'] === 'icon' ) : ?>
										<i class="<?php echo esc_attr( $tab['apr_adv_tabs_tab_title_icon'] ); ?>"></i>
									<?php elseif ( $tab['apr_adv_tabs_icon_type'] === 'image' ) : ?>
										<img
											src="<?php echo esc_attr( $tab['apr_adv_tabs_tab_title_image']['url'] ); ?>">
									<?php endif; ?>
								<?php endif; ?>
								<span class="apr-tab-title"><?php echo $tab['apr_adv_tabs_tab_title']; ?></span>
							</div>
							<div class="apr-tabs-content"></div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php } ?>
		</div>
		<?php
	}

	protected function content_template() {
	}
}


Plugin::instance()->widgets_manager->register( new Apr_Core_Widget_Advanced_Tabs() );
