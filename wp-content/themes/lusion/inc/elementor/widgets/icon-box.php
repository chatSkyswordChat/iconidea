<?php

namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor icon box widget.
 *
 * Elementor widget that displays an icon, a headline and a text.
 *
 * @since 1.0.0
 */
class Apr_Core_Icon_Box extends Widget_Base {

	public function apr_sc_icon_box() {
		/* Import Css */
		if ( is_rtl() ) {
			wp_enqueue_style( 'apr-sc-icon-box', LUSION_CSS . '/elementor/icon-box-rtl.css', array(), LUSION_THEME_VERSION );
		} else {
			wp_enqueue_style( 'apr-sc-icon-box', LUSION_CSS . '/elementor/icon-box.css', array(), LUSION_THEME_VERSION );
		}
	}

	public function get_categories() {
		return array( 'apr-core' );
	}

	public function get_name() {
		return 'icon-box';
	}

	public function get_title() {
		return __( ' APR Icon Box', 'apr-core' );
	}

	public function get_icon() {
		return 'eicon-icon-box';
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => __( 'Block Icon Box', 'apr-core' ),
			]
		);
		$icon_box_repeater = new Repeater();
		$icon_box_repeater->add_control(
			'icon',
			[
				'label'   => __( 'Icon', 'apr-core' ),
				'type'    => Controls_Manager::ICON,
				'default' => 'fa fa-star',
			]
		);

		$icon_box_repeater->add_control(
			'title_text',
			[
				'label'       => __( 'Title & Description', 'apr-core' ),
				'type'        => Controls_Manager::WYSIWYG,
				'dynamic'     => [
					'active' => true,
				],
				'default'     => __( 'This is the heading', 'apr-core' ),
				'placeholder' => __( 'Enter your title', 'apr-core' ),
				'label_block' => true,
			]
		);

		$icon_box_repeater->add_control(
			'description_text',
			[
				'label'       => '',
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'default'     => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'apr-core' ),
				'placeholder' => __( 'Enter your description', 'apr-core' ),
				'rows'        => 10,
				'separator'   => 'none',
				'show_label'  => false,
			]
		);
		$icon_box_repeater->add_control(
			'button_text',
			[
				'label'       => __( 'Text Button', 'apr-core' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 'Detail',
				'dynamic'     => [
					'active' => true,
				],
				'default'     => __( '', 'apr-core' ),
			]
		);
		$icon_box_repeater->add_control(
			'link',
			[
				'label'       => __( 'Title Link', 'apr-core' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'apr-core' ),
				'separator'   => 'before',
			]
		);
		$this->add_control(
			'slides',
			[
				'label'       => esc_html__( 'Icon Box Carousel', 'apr-core' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $icon_box_repeater->get_controls(),
				'title_field' => '{{{ title_text }}}',
				'default'     => [
					[
						'title_text'       => __( 'Freshly #1', 'apr-core' ),
						'description_text' => __( 'Choose your desired delivery date at checkout – We can also leave in a safe place if not home!', 'apr-core' ),
					],
					[
						'title_text'       => __( 'Freshly #2', 'apr-core' ),
						'description_text' => __( 'Choose your desired delivery date at checkout – We can also leave in a safe place if not home!', 'apr-core' ),
					],
					[
						'title_text'       => __( 'Freshly #3', 'apr-core' ),
						'description_text' => __( 'Choose your desired delivery date at checkout – We can also leave in a safe place if not home!', 'apr-core' ),
					],
				]
			]
		);
		$this->add_control(
			'view',
			[
				'label'        => __( 'View', 'apr-core' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => [
					'default' => __( 'Default', 'apr-core' ),
					'stacked' => __( 'Stacked', 'apr-core' ),
					'framed'  => __( 'Framed', 'apr-core' ),
				],
				'default'      => 'default',
				'prefix_class' => 'elementor-view-',

			]
		);

		$this->add_control(
			'shape',
			[
				'label'        => __( 'Shape', 'apr-core' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => [
					'circle' => __( 'Circle', 'apr-core' ),
					'square' => __( 'Square', 'apr-core' ),
				],
				'default'      => 'circle',
				'condition'    => [
					'view!' => 'default',
				],
				'prefix_class' => 'elementor-shape-',
			]
		);
		$this->add_control(
			'position',
			[
				'label'        => __( 'Icon Position', 'apr-core' ),
				'type'         => Controls_Manager::CHOOSE,
				'default'      => 'top',
				'options'      => [
					'left'  => [
						'title' => __( 'Left', 'apr-core' ),
						'icon'  => 'eicon-h-align-left',
					],
					'top'   => [
						'title' => __( 'Top', 'apr-core' ),
						'icon'  => 'eicon-v-align-top',
					],
					'right' => [
						'title' => __( 'Right', 'apr-core' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'elementor-position-',
				'toggle'       => false,
			]
		);
		$this->add_control(
			'custom_icon_position',
			[
				'label'     => __( 'Custom Icon Position', 'apr-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'On', 'apr-core' ),
				'label_off' => __( 'Off', 'apr-core' ),
				'default'   => 'no',
				'condition' => [
					'position' => 'top',
				],
			]
		);
		$this->add_responsive_control(
			'icon_margin_top',
			[
				'label'      => esc_html__( 'Top', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range'      => [
					'px' => [
						'min' => - 200,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .elementor-icon-box-icon' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'custom_icon_position' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'icon_box_column_number',
			[
				'label'           => __( 'Column', 'apr-core' ),
				'type'            => Controls_Manager::SELECT,
				'options'         => [
					5 => __( '5 Column', 'apr-core' ),
					4 => __( '4 Column', 'apr-core' ),
					3 => __( '3 Column', 'apr-core' ),
					2 => __( '2 Column', 'apr-core' ),
					1 => __( '1 Column', 'apr-core' ),
				],
				'desktop_default' => 3,
				'tablet_default'  => 3,
				'mobile_default'  => 1,
				'condition'       => [
					'show_slider!' => 'yes',
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
		$this->add_control(
			'number_item',
			[
				'label'   => __( 'Number Item Desktop', 'apr-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'1' => __( '1', 'apr-core' ),
					'2' => __( '2', 'apr-core' ),
					'3' => __( '3', 'apr-core' ),
					'4' => __( '4', 'apr-core' ),
					'5' => __( '5', 'apr-core' ),
				],
				'default' => '3',
			]
		);
		$this->add_control(
			'number_item_1200',
			[
				'label'   => __( 'Number Item Width Screen 1200px', 'apr-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					'1' => __( '1', 'apr-core' ),
					'2' => __( '2', 'apr-core' ),
					'3' => __( '3', 'apr-core' ),
					'4' => __( '4', 'apr-core' ),
					'5' => __( '5', 'apr-core' ),
				],
			]
		);
		$this->add_control(
			'number_item_tablet',
			[
				'label'   => __( 'Number Item Tablet', 'apr-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'1' => __( '1', 'apr-core' ),
					'2' => __( '2', 'apr-core' ),
					'3' => __( '3', 'apr-core' ),
					'4' => __( '4', 'apr-core' ),
					'5' => __( '5', 'apr-core' ),
				],
				'default' => '2',
			]
		);
		$this->add_control(
			'number_item_mobile',
			[
				'label'   => __( 'Number Item Mobile', 'apr-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'1' => __( '1', 'apr-core' ),
					'2' => __( '2', 'apr-core' ),
					'3' => __( '3', 'apr-core' ),
					'4' => __( '4', 'apr-core' ),
					'5' => __( '5', 'apr-core' ),
				],
				'default' => '1',
			]
		);
		$this->add_control(
			'navigation',
			[
				'label'   => __( 'Navigation', 'apr-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'both'   => __( 'Arrows and Dots', 'apr-core' ),
					'arrows' => __( 'Arrows', 'apr-core' ),
					'dots'   => __( 'Dots', 'apr-core' ),
					'none'   => __( 'None', 'apr-core' ),
				],
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
		$this->add_control(
			'center_mode',
			[
				'label'   => __( 'Center Mode on Mobile', 'apr-core' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$this->add_control(
			'center_padding',
			[
				'label'     => __( 'Center Padding', 'apr-core' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 20,
				'condition' => [
					'center_mode' => 'yes',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_style_icon_box',
			[
				'label' => __( 'Block Icon Box', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'icon_box_space',
			[
				'label'      => esc_html__( 'Space', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .icon-box-list .slider-multiple .slick-list .slick-slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'show_slider' => 'yes',
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
					'{{WRAPPER}} .elementor-icon-box-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_box_padding',
			[
				'label'      => esc_html__( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-icon-box-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_box_margin',
			[
				'label'      => esc_html__( 'Margin', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-icon-box-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'tt_box_bg_color',
			[
				'label' => __( 'Background Color', 'apr-core' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'box_bg_color',
				'label'    => __( 'Background Color', 'apr-core' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}}.elementor-widget-icon-box .elementor-icon-box-wrapper',
			]
		);

		$this->add_control(
			'tt_box_hover_bg_color',
			[
				'label' => __( 'Background Hover Color', 'apr-core' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'box_hover_bg_color',
				'label'    => __( 'Background Hover Color', 'apr-core' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .elementor-icon-box-wrapper:hover,{{WRAPPER}} .elementor-icon-box-wrapper.type1:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border',
				'label'    => esc_html__( 'Border', 'apr-core' ),
				'selector' => '{{WRAPPER}} .elementor-icon-box-wrapper, {{WRAPPER}} .icon-box-button:before',
			]
		);
		$this->add_control(
			'tt_box_hover_border_color',
			[
				'label' => __( 'Border Hover Color', 'apr-core' ),
				'type'  => Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'box_border_hover',
				'label'    => esc_html__( 'Border', 'apr-core' ),
				'selector' => '{{WRAPPER}} .elementor-icon-box-wrapper:hover, {{WRAPPER}} .icon-box-button:hover:before',
			]
		);
		$this->add_responsive_control(
			'block_icon_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-icon-box-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'block_icon_min_height',
			[
				'label'      => __( 'Min Height', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .elementor-icon-box-wrapper' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'block_icon_max_width',
			[
				'label'      => __( 'Max width', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .elementor-icon-box-wrapper' => 'max-width: {{SIZE}}{{UNIT}};width:{{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => __( 'Icon', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'show_border_right',
			[
				'label'   => __( 'Show Border Right', 'apr-core' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$this->start_controls_tabs( 'icon_colors' );

		$this->start_controls_tab(
			'icon_colors_normal',
			[
				'label' => __( 'Normal', 'apr-core' ),
			]
		);

		$this->add_control(
			'primary_color',
			[
				'label' => __( 'Icon Color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'default'   => '',
				'selectors' => [
					'{{WRAPPER}}.elementor-view-stacked .elementor-icon'                                                    => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-framed .elementor-icon, {{WRAPPER}}.elementor-view-default .elementor-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'secondary_color',
			[
				'label'     => __( 'Secondary Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'condition' => [
					'view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-view-framed .elementor-icon'  => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'color: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'primary_border_color',
			[
				'label'     => __( 'Border Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}}.elementor-view-framed .elementor-icon, {{WRAPPER}}.elementor-view-default .elementor-icon' => 'border-color: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'primary_background_color',
			[
				'label'     => __( 'background Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}}.elementor-view-framed .elementor-icon, {{WRAPPER}}.elementor-view-default .elementor-icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_colors_hover',
			[
				'label' => __( 'Hover', 'apr-core' ),
			]
		);

		$this->add_control(
			'hover_primary_color',
			[
				'label'     => __( 'Primary Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}}.elementor-view-framed .elementor-widget-container:hover .elementor-icon, 
					 {{WRAPPER}}.elementor-view-default .elementor-widget-container:hover .elementor-icon'                                                                                   => 'color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-default.elementor-widget-icon-box .elementor-icon-box-wrapper:not(.type2):hover .elementor-icon-box-icon .elementor-icon,
					{{WRAPPER}}.elementor-view-stacked.elementor-widget-icon-box .elementor-icon-box-wrapper:not(.type2):hover .elementor-icon-box-icon .elementor-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_secondary_color',
			[
				'label'     => __( 'Secondary Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'condition' => [
					'view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-view-stacked .elementor-icon:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_primary_border_color',
			[
				'label'     => __( 'Border Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}}.elementor-view-framed .elementor-widget-container:hover .elementor-icon, {{WRAPPER}}.elementor-view-default .elementor-widget-container:hover .elementor-icon' => 'border-color: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'hover_primary_background_color',
			[
				'label'     => __( 'background Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}}.elementor-view-framed .elementor-widget-container:hover .elementor-icon,
                     {{WRAPPER}}.elementor-view-default .elementor-widget-container:hover .elementor-icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'apr-core' ),
				'type'  => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'icon_size',
			[
				'label'      => __( 'Size', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range'      => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .elementor-icon-box-icon .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'icon_space',
			[
				'label'      => __( 'Icon Spacing', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}}.elementor-position-right .elementor-icon-box-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-position-left .elementor-icon-box-icon'  => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-position-top .elementor-icon-box-icon'   => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_border_size',
			[
				'label'      => __( 'Border Size', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .elementor-icon' => 'border-width: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'view' => 'framed',
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label'      => esc_html__( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-icon-box-wrapper .elementor-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_min_width',
			[
				'label'      => __( 'Min Width', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .elementor-icon-box-icon'                                                                    => 'min-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-widget-icon-box .elementor-icon-box-wrapper.type2 .elementor-icon-box-icon:before' => 'width: calc({{SIZE}}{{UNIT}} + 3{{UNIT}});',
				],
			]
		);

		$this->add_responsive_control(
			'icon_min_height',
			[
				'label'      => __( 'Min Height', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .elementor-icon-box-icon'                                                                    => 'min-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-icon-box-icon'                                                                    => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-widget-icon-box .elementor-icon-box-wrapper.type2 .elementor-icon-box-icon:before' => 'height: calc({{SIZE}}{{UNIT}} + 4{{UNIT}});',
				],
			]
		);

		$this->add_responsive_control(
			'icon_line_height',
			[
				'label'      => __( 'Line Height', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .elementor-icon-box-icon' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'rotate',
			[
				'label'     => __( 'Rotate', 'apr-core' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 0,
					'unit' => 'deg',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_control(
			'left_icon',
			[
				'label'      => __( 'Left', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-icon i:before' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'icon_box_content_padding',
			[
				'label'      => esc_html__( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-icon-box-wrapper .elementor-icon-box-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_box_content_margin',
			[
				'label'      => esc_html__( 'Margin', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-icon-box-wrapper .elementor-icon-box-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_title',
			[
				'label'     => __( 'Title', 'apr-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_bottom_space',
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
					'{{WRAPPER}} .elementor-icon-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title,
					{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title a' => 'color: {{VALUE}};',
				],

			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label'     => __( 'Color Hover', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title:hover,
					{{WRAPPER}} .elementor-icon-box-wrapper:hover .elementor-icon-box-content .elementor-icon-box-title' => 'color: {{VALUE}};',
				],

			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title',

			]
		);

		$this->add_control(
			'heading_description',
			[
				'label'     => __( 'Description', 'apr-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     => __( 'Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description,
					{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description a' => 'color: {{VALUE}};',
				],

			]
		);

		$this->add_control(
			'description_hover_color',
			[
				'label'     => __( 'Hover Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-wrapper:hover .elementor-icon-box-content .elementor-icon-box-description,
					{{WRAPPER}} .elementor-icon-box-wrapper:hover .elementor-icon-box-content .elementor-icon-box-description a' => 'color: {{VALUE}};',
				],

			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'selector' => '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description',

			]
		);
		$this->start_controls_tabs( 'button_colors' );
		$this->add_control(
			'button',
			[
				'label'     => __( 'Button', 'apr-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .elementor-icon-box-button',

			]
		);
		$this->start_controls_tab(
			'button_normal',
			[
				'label' => __( 'Normal', 'apr-core' ),
			]
		);
		$this->add_control(
			'button_color',
			[
				'label'     => __( 'Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-button' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .elementor-icon-box-button' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'button_hover',
			[
				'label' => __( 'Hover', 'apr-core' ),
			]
		);
		$this->add_control(
			'button_hover_color',
			[
				'label'     => __( 'Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-button:hover' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .elementor-icon-box-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	/**
	 * Render icon box widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function render() {
		$this->apr_sc_icon_box();
		$settings             = $this->get_settings_for_display();
		$columns              = $settings['icon_box_column_number'];
		$columns_tablet       = isset( $settings['icon_box_column_number_tablet'] ) ?   $settings['icon_box_column_number_tablet'] : 4;
		$columns_mobile       = isset( $settings['icon_box_column_number_mobile'] ) ?  $settings['icon_box_column_number_mobile'] : 2;
		$item_desktop         = $settings['number_item'];
		$item_tablet      		= isset( $settings['number_item_tablet'] ) ? $settings['number_item_tablet'] : 2;
		$item_mobile      		= isset( $settings['number_item_mobile'] ) ? $settings['number_item_mobile'] : 1;
		$item_1200      		= isset( $settings['number_item_1200'] ) ? $settings['number_item_1200'] : 4;
		$custom_icon_position = $settings['custom_icon_position'];
		if ( empty( $settings['slides'] ) ) {
			return;
		}
		$this->add_render_attribute( 'icon', 'class', [ 'elementor-icon', 'elementor-animation-' . $settings['hover_animation'] ] );


		$show_dots   = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
		$show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
		$id          = 'apr-testimolial-' . wp_rand();
		$show_arr    = 'false';
		$show_dot    = 'false';
		if ( $settings['navigation'] == 'both' ) {
			$show_arr = 'true';
			$show_dot = 'true';
		} elseif ( $settings['navigation'] == 'arrows' ) {
			$show_arr = 'true';
		} elseif ( $settings['navigation'] == 'dots' ) {
			$show_dot = 'true';
		}
		$pause_on_hover = $autoplay = $infinite = $border_right_class = $center_mode = $center_padding = $class_text_align_mobile = $custom_icon_position_class = '';
		if ( $settings['center_padding'] != '' ) {
			$center_padding = $settings['center_padding'] . 'px';
		}
		if ( $settings['show_border_right'] == 'yes' ) {
			$border_right_class = 'icon-has-border';
		}
		if ( $settings['custom_icon_position'] == 'yes' ) {
			$custom_icon_position_class = 'custom-icon-position';
		}
		if ( $settings['pause_on_hover'] == 'yes' ) {
			$pause_on_hover = 'true';
		} else {
			$pause_on_hover = 'false';
		}
		if ( $settings['center_mode'] == 'yes' ) {
			$center_mode = 'true';
		} else {
			$center_mode = 'false';
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
		$is_rtl        = is_rtl();
		$direction     = $is_rtl ? 'true' : 'false';
		$slick_options = [
			'rtl' => $is_rtl,
		];
		if ( $settings['text_align'] ) {
			$this->add_render_attribute( 'icon_class', 'class', 'align-' . $settings['text_align'] );
		}
		if ( $settings['text_align_mobile'] ) {
			$this->add_render_attribute( 'icon_class', 'class', 'align-mb-' . $settings['text_align_mobile'] );
		}
		$this->add_render_attribute( 'icon_class', 'class', 'elementor-icon-box-wrapper' );
		if ( $settings['show_slider'] === 'yes' ) {
			$carousel_classes = [ 'slider-multiple' ];
		} else {
			$carousel_classes = [ 'icon-box-grid' ];
		}
		$this->add_render_attribute( 'wrapper', [
			'class'               => $carousel_classes,
			'data-slider_options' => wp_json_encode( $slick_options ),
		] );
		if ( $settings['navigation'] ) {
			$this->add_render_attribute( 'wrapper', 'class', 'cs-' . $settings['navigation'] );
		}
		$this->add_render_attribute( 'description_text', 'class', 'elementor-icon-box-description' );
		$this->add_render_attribute( 'button_text', 'class', 'elementor-icon-box-button' );
		$id          = 'apr-icon-box-' . wp_rand();
		$slide_count = 0;
		?>
		<div id="<?php echo esc_attr( $id ); ?>"
			 class="icon-box-list <?php echo esc_attr( $custom_icon_position_class ); ?> <?php echo esc_attr( $border_right_class ); ?> col-desktop-<?php echo esc_attr( $columns ); ?> col-tablet-<?php echo esc_attr( $columns_tablet ); ?> col-mobile-<?php echo esc_attr( $columns_mobile ); ?>">
			<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
				<?php foreach ( $settings['slides'] as $key => $slide ) : ?>

				<?php if ( ! empty( $slide['button_text'] ) ) :
					$this->add_render_attribute( 'icon_class', 'class', 'icon-box-button' );
				endif; ?>

				<div <?php echo $this->get_render_attribute_string( 'icon_class' ); ?>>
					<?php
					$icon_tag  = 'span';
					$has_icon  = ! empty( $slide['icon'] );
					$slide_url = $slide['link']['url'];
					if ( ! empty( $slide_url ) ) {
						$this->add_render_attribute( 'link' . $slide_count, 'href', $slide_url );
						$icon_tag = 'a';

						if ( $slide['link']['is_external'] ) {
							$this->add_render_attribute( 'link' . $slide_count, 'target', '_blank' );
						}

						if ( $slide['link']['nofollow'] ) {
							$this->add_render_attribute( 'link' . $slide_count, 'rel', 'nofollow' );
						}
					}
					$icon_attributes = $this->get_render_attribute_string( 'icon' );
					$link_attributes = $this->get_render_attribute_string( 'link' . $slide_count );
					?>
					<div class="elementor-icon-box-icon">
						<<?php echo implode( ' ', [ $icon_tag, $icon_attributes, $link_attributes ] ); ?>>
						<i class="<?php echo $slide['icon']; ?>" aria-hidden="true"></i>
					</<?php echo $icon_tag; ?>>
				</div>
				<div class="elementor-icon-box-content">
					<h3 class="elementor-icon-box-title icon-box-title-overflow">
						<<?php echo implode( ' ', [ $icon_tag, $link_attributes ] ); ?>
						><?php echo $slide['title_text']; ?></<?php echo $icon_tag; ?>>
					</h3>
					<?php if ( ! empty( $slide['description_text'] ) ) : ?>
						<p <?php echo $this->get_render_attribute_string( 'description_text' ); ?>><?php echo $slide['description_text']; ?></p>
					<?php endif; ?>
				</div>
				<?php if ( ! empty( $slide['button_text'] ) ) : ?>
				<div class="button-icon-box">
					<<?php echo implode( ' ', [ $icon_tag, $link_attributes ] ); ?> <?php echo $this->get_render_attribute_string( 'button_text' ); ?>
					><?php echo $slide['button_text']; ?></<?php echo $icon_tag; ?>>
			</div>
			<?php endif; ?>
		</div>
		<?php
		$slide_count ++;
	endforeach; ?>
		</div>
		</div>
		<?php if ( $settings['show_slider'] === 'yes' ) : ?>
			<script>
				jQuery(document).ready(function ($) {
					$('#<?php echo esc_js( $id );?> .slider-multiple').slick({
						slidesToShow  : <?php echo esc_attr( $item_desktop );?>,
						slidesToScroll: 1,
						centerMode    : true,
						centerPadding : "0",
						dots          : <?php echo esc_attr( $show_dot );?>,
						arrows        : <?php echo esc_attr( $show_arr );?>,
						nextArrow     : '<button class="btn-next"><i class="theme-icon-next"></i></button>',
						prevArrow     : '<button class="btn-prev"><i class="theme-icon-back"></i></button>',
						autoplay      : <?php echo esc_attr( $autoplay );?>,
						pauseOnHover  : <?php echo esc_attr( $pause_on_hover );?>,
						infinite      : <?php echo esc_attr( $infinite );?>,
						autoplaySpeed : <?php echo absint( $settings['autoplay_speed'] );?>,
						speed         : <?php echo absint( $settings['transition_speed'] );?>,
						swipe         : false,
						responsive    : [
							{
								breakpoint: 1201,
								settings  : {
									rows        : 1,
									slidesToShow: <?php echo esc_attr( $item_1200 );?>,
									swipe       : true,
								}

							},
							{
								breakpoint: 1025,
								settings  : {
									rows        : 1,
									slidesToShow: <?php echo esc_attr( $item_tablet );?>,
									swipe       : true,
								}

							},
							{
								breakpoint: 768,
								settings  : {
									rows         : 1,
									slidesToShow : <?php echo esc_attr( $item_mobile );?>,
									swipe        : true,
									centerMode   : <?php echo esc_attr( $center_mode );?>,
									centerPadding: <?php echo "'" . esc_attr( $center_padding ) . "'";?>
								}
							},
							{
								breakpoint: 576,
								settings  : {
									rows         : 1,
									slidesToShow : 1,
									swipe        : true,
									centerMode   : <?php echo esc_attr( $center_mode );?>,
									centerPadding: <?php echo "'" . esc_attr( $center_padding ) . "'";?>
								}
							}
						]

					});
				});
			</script>
		<?php endif; ?>
		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Apr_Core_Icon_Box );
