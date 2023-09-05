<?php

namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Apr_Core_Banner extends Widget_Base {
	public function apr_sc_banner() {
		/* Import Css */
		if ( is_rtl() ) {
			wp_enqueue_style( 'apr-sc-banner', LUSION_CSS . '/elementor/banner-rtl.css', array(), LUSION_THEME_VERSION, LUSION_THEME_VERSION );
		} else {
			wp_enqueue_style( 'apr-sc-banner', LUSION_CSS . '/elementor/banner.css', array(), LUSION_THEME_VERSION );
		}
	}

	public function get_name() {
		return 'apr_banner';
	}

	public function get_title() {
		return __( 'APR Banner', 'apr-core' );
	}

	public function get_icon() {
		return 'eicon-image-box';
	}

	public function get_categories() {
		return array( 'apr-core' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_banner',
			[
				'label' => __( 'Banner', 'apr-core' ),
			]
		);
		$this->add_control(
			'banner_type',
			[
				'label'   => __( 'Type', 'apr-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'type_1',
				'options' => [
					'type_1' => __( 'Type 1', 'apr-core' ),
					'type_2' => __( 'Type 2', 'apr-core' ),
					'type_3' => __( 'Type 3', 'apr-core' ),
					'type_4' => __( 'Type 4', 'apr-core' ),
					'type_5' => __( 'Type 5', 'apr-core' ),
					'type_6' => __( 'Type 6', 'apr-core' ),
					'type_7' => __( 'Type 7', 'apr-core' ),
					'type_8' => __( 'Type 8', 'apr-core' ),
					'type_9' => __( 'Type 9', 'apr-core' ),
				],
			]
		);
		$this->add_control(
			'content_position',
			[
				'label'     => __( 'Content Position', 'apr-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'right',
				'options'   => [
					'left'  => __( 'Left', 'apr-core' ),
					'right' => __( 'Right', 'apr-core' ),
				],
				'condition' => [
					'banner_type' => [ 'type_3', 'type_5' ],
				],
			]
		);
		/**/
		$this->start_controls_tabs( 'tabs_bn_style' );

		$this->start_controls_tab(
			'tab_bn_content',
			[
				'label' => __( 'CONTENT', 'apr-core' ),
			]
		);

		$this->add_responsive_control(
			'bn_align',
			[
				'label'     => __( 'Alignment', 'apr-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'center',
				'options'   => [
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
				'selectors' => [
					'{{WRAPPER}} ' => 'text-align:{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title',
			[

				'label'       => __( 'Title', 'apr-core' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 'Enter your title',
				'dynamic'     => [
					'active' => true,
				],
				'default'     => __( 'Title', 'apr-core' ),
				'condition'   => [
					'banner_type!' => 'type_5',
				],
			]
		);
		$this->add_control(
			'text_feature',
			[

				'label'       => __( 'Text Feature', 'apr-core' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 'Enter your text feature',
				'dynamic'     => [
					'active' => true,
				],
				'default'     => __( '', 'apr-core' ),
				'condition'   => [
					'banner_type' => 'type_1',
				],
			]
		);
		$this->add_control(
			'effect_text',
			[
				'label' => __( 'Effect', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'after_title',
			[

				'label'       => __( 'After Title', 'apr-core' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 'Enter your after title',
				'dynamic'     => [
					'active' => true,
				],
				'default'     => __( 'After', 'apr-core' ),
				'condition'   => [
					'banner_type' => 'type_3',
				],
			]
		);
		$this->add_control(
			'subtitle',
			[

				'label'       => __( 'Subtitle', 'apr-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => 'Enter your subtitle',
				'dynamic'     => [
					'active' => true,
				],
				'default'     => __( '', 'apr-core' ),
				'condition'   => [
					'banner_type!' => [ 'type_5', 'type_7' ],
				],
			]
		);
		$sub_title_repeater = new Repeater();
		$sub_title_repeater->add_control(
			'subtitle_text',
			[
				'label'       => __( 'SubTitle', 'apr-core' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your sub title', 'apr-core' ),
				'label_block' => true,
			]
		);
		$sub_title_repeater->add_control(
			'link',
			[
				'label'       => __( 'Link', 'apr-core' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'apr-core' ),
				'separator'   => 'before',
			]
		);
		$this->add_control(
			'list',
			[
				'label'       => esc_html__( 'List of subtitles', 'apr-core' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $sub_title_repeater->get_controls(),
				'title_field' => '{{{ subtitle_text }}}',
				'default'     => [
					[
						'subtitle_text' => __( 'Subtitle #1', 'apr-core' ),
					],
					[
						'subtitle_text' => __( 'Subtitle #2', 'apr-core' ),
					],
					[
						'subtitle_text' => __( 'Subtitle #3', 'apr-core' ),
					]
				],
				'condition'   => [
					'banner_type' => 'type_7',
				],
			]
		);
		$this->add_control(
			'description',
			[

				'label'       => __( 'Description', 'apr-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => 'Enter your description',
				'dynamic'     => [
					'active' => true,
				],
				'default'     => __( '', 'apr-core' ),
				'condition'   => [
					'banner_type' => [ 'type_1', 'type_5' ],
				],
			]
		);
		$this->add_control(
			'button_text',
			[
				'label'       => __( 'Button Text', 'apr-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '', 'apr-core' ),
				'placeholder' => 'Enter your button text',
				'separator'   => 'before',
				'condition'   => [
					'banner_type!' => 'type_5',
				],
			]
		);
		$this->add_control(
			'effect_button',
			[
				'label'        => __( 'Effect Button', 'apr-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			]
		);
		$this->add_control(
			'icon',
			[
				'label'     => __( 'Icon', 'apr-core' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'theme-icon-right-arrow',
				'condition' => [
					'banner_type' => [ 'type_6', 'type_2' ],
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
				'separator'   => 'before',
			]
		);
		$this->add_responsive_control(
			'position',
			[
				'label'     => __( 'Position', 'apr-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'bottom_center',
				'options'   => [
					'top_left'      => _x( 'Top Left', 'apr-core' ),
					'top_center'    => _x( 'Top center', 'apr-core' ),
					'top_right'     => _x( 'Top right', 'apr-core' ),
					'center_left'   => _x( 'Center left', 'apr-core' ),
					'center_center' => _x( 'Center center', 'apr-core' ),
					'center_right'  => _x( 'Center right', 'apr-core' ),
					'bottom_left'   => _x( 'Bottom Left', 'apr-core' ),
					'bottom_center' => _x( 'Bottom Center', 'apr-core' ),
					'bottom_right'  => _x( 'Bottom Right', 'apr-core' ),
					'custom'        => _x( 'Custom', 'apr-core' ),
				],
				'condition' => [
					'banner_type' => [ 'type_1', 'type_2', 'type_9' ],
				],
			]
		);
		$this->add_responsive_control(
			'x_position',
			[
				'label'      => __( 'X Position', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .bn-content' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'position'    => 'custom',
					'banner_type' => [ 'type_1', 'type_2' ],
				],
			]
		);
		$this->add_responsive_control(
			'y_position',
			[
				'label'      => __( 'Y Position', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .bn-content' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'position'    => 'custom',
					'banner_type' => [ 'type_1', 'type_2' ],
				],
			]
		);
		$this->add_control(
			'xy_transform',
			[
				'label'     => __( 'Transform', 'apr-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'x',
				'options'   => [
					'x' => _x( 'X', 'apr-core' ),
					'y' => _x( 'Y', 'apr-core' ),
				],
				'condition' => [
					'position'    => 'custom',
					'banner_type' => [ 'type_1', 'type_2' ],
				],
			]
		);
		$this->add_responsive_control(
			'x_transform',
			[
				'label'      => __( 'X Transform', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .bn-content' => 'transform: translateX(-{{SIZE}}{{UNIT}}) ;',
				],
				'condition'  => [
					'position'     => 'custom',
					'banner_type'  => [ 'type_1', 'type_2' ],
					'xy_transform' => 'x'
				],
			]
		);
		$this->add_responsive_control(
			'y_transform',
			[
				'label'      => __( 'Y Transform', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .bn-content' => 'transform: translateY(-{{SIZE}}{{UNIT}}) ;',
				],
				'condition'  => [
					'position'     => 'custom',
					'banner_type'  => [ 'type_1', 'type_2' ],
					'xy_transform' => 'y'
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_bn_image',
			[
				'label' => __( 'Image', 'apr-core' ),
			]
		);

		$this->add_control(
			'cate_thumb',
			[
				'label'       => __( 'Choose Image', 'apr-core' ),
				'description' => __( 'You should choose a small, square image.', 'apr-core' ),
				'type'        => Controls_Manager::MEDIA,
				'default'     => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'cate_thumb',
				'default'   => 'large',
				'separator' => 'none',
			]
		);
		$this->add_control(
			'cate_thumb_tablet',
			[
				'label'   => __( 'Choose Image Tablet', 'apr-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'cate_thumb_tablet',
				'default'   => 'large',
				'separator' => 'none',
			]
		);
		$this->add_control(
			'cate_thumb_mobile',
			[
				'label'   => __( 'Choose Image Mobile', 'apr-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'cate_thumb_mobile',
				'default'   => 'large',
				'separator' => 'none',
			]
		);
		$this->add_control(
			'effect',
			[
				'label'   => __( 'Effect', 'apr-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'effect_zoom',
				'options' => [
					'effect_default' => _x( 'Default', 'apr-core' ),
					'effect_zoom'    => _x( 'Zoom', 'apr-core' ),
					'effect_blur'    => _x( 'Blur', 'apr-core' ),
				],
			]
		);
		$this->add_responsive_control(
			'bg_color_hover',
			[
				'label'     => __( 'Background Color Hover', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .image-banner:after, {{WRAPPER}} .image-banner:before' => 'background: {{VALUE}} none repeat scroll 0 0;',
				],
				'condition' => [
					'effect' => 'effect_blur',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'banner-box',
			[
				'label' => __( 'Banner box', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'margin-banner',
			[
				'label'      => esc_html__( 'Margin', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .apr-banner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding-banner',
			[
				'label'      => esc_html__( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .apr-banner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_banner_border' );

		$this->start_controls_tab(
			'tab_border_normal',
			[
				'label' => __( 'Normal', 'apr-core' ),
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'banner_border',
				'selector'  => '{{WRAPPER}} .apr-banner',
				'separator' => 'before',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_border_hover',
			[
				'label' => __( 'Hover', 'apr-core' ),
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'banner_border_hover',
				'selector'  => '{{WRAPPER}} .apr-banner:hover',
				'separator' => 'before',
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();


		$this->start_controls_section(
			'content-margin-padding',
			[
				'label' => __( 'Content', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content-margin-banner',
			[
				'label'      => esc_html__( 'Margin', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .apr-banner .bn-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'content-padding-banner',
			[
				'label'      => esc_html__( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .apr-banner .bn-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_width',
			[
				'label'          => __( 'Width', 'apr-core' ),
				'type'           => Controls_Manager::SLIDER,
				'range'          => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units'     => [ '%', 'px' ],
				'default'        => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'selectors'      => [
					'{{WRAPPER}} .bn-content' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'bn_content_bg_color',
			[
				'label'     => __( 'Background Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .bn-content' => 'background-color: {{VALUE}};',
				],

			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'bn_tab_style',
			[
				'label'     => __( 'Title', 'apr-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'banner_type!' => 'type_5',
				],
			]
		);

		$this->add_responsive_control(
			'content_title_max_width',
			[
				'label'          => __( 'Max Width', 'apr-core' ),
				'type'           => Controls_Manager::SLIDER,
				'range'          => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units'     => [ '%', 'px' ],
				'default'        => [
					'size' => '100',
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'selectors'      => [
					'{{WRAPPER}} .apr-banner .bn-title' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'padding-title-banner',
			[
				'label'      => esc_html__( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .apr-banner .bn-title a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_title_style' );

		$this->start_controls_tab(
			'tab_title_normal',
			[
				'label' => __( 'Normal', 'apr-core' ),
			]
		);
		$this->add_control(
			'bn_top_title_color',
			[
				'label'     => __( 'Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#2c2c2c',
				'selectors' => [
					'{{WRAPPER}} .apr-banner .bn-title, {{WRAPPER}} .apr-banner .bn-title a' => 'color: {{VALUE}};',
				],

			]
		);
		$this->add_control(
			'bn_top_title_bg_color',
			[
				'label'     => __( 'Background Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .apr-banner .bn-title, {{WRAPPER}} .apr-banner .bn-title a' => 'background-color: {{VALUE}};',
				],

			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_title_hover',
			[
				'label' => __( 'Hover', 'apr-core' ),
			]
		);

		$this->add_control(
			'bn_hover_title_color',
			[
				'label'     => __( 'Hover Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#2c2c2c',
				'selectors' => [
					'{{WRAPPER}} .apr-banner .bn-title:hover,
                         {{WRAPPER}} .apr-banner .bn-title a:hover,
                         {{WRAPPER}} .apr-banner .bn-title:hover a' => 'color: {{VALUE}};',
				],

			]
		);
		$this->add_control(
			'bn_top_title_bg_color_hover',
			[
				'label'     => __( 'Background Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .apr-banner .bn-title:hover, {{WRAPPER}} .apr-banner .bn-title a:hover' => 'background-color: {{VALUE}};',
				],

			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'bn_title_typography',
				'label'    => __( 'Typography', 'apr-core' ),
				'selector' => '{{WRAPPER}} .apr-banner .bn-title, {{WRAPPER}} .apr-banner .bn-title a',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'title_border',
				'label'       => __( 'Border', 'apr-core' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .apr-banner .bn-title',
			]
		);
		$this->add_control(
			'after_title_head',
			[
				'label'     => __( 'After title', 'apr-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'banner_type' => 'type_3',
				],
			]
		);
		$this->add_control(
			'bn_after_title_color',
			[
				'label'     => __( 'Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#2c2c2c',
				'selectors' => [
					'{{WRAPPER}} .apr-banner .bn-title .after-title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'banner_type' => 'type_3',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'bn_after_title_typography',
				'label'     => __( 'Typography', 'apr-core' ),
				'selector'  => '{{WRAPPER}} .apr-banner .bn-title .after-title',
				'condition' => [
					'banner_type' => 'type_3',
				],
			]
		);
		$this->add_responsive_control(
			'after_x_position',
			[
				'label'      => __( 'X Position', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .bn-content .bn-title .after-title' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'banner_type' => 'type_3',
				],
			]
		);
		$this->add_responsive_control(
			'after_y_position',
			[
				'label'      => __( 'Y Position', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .bn-content .bn-title .after-title' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'banner_type' => 'type_3',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'bn_tab_text_feature_style',
			[
				'label'     => __( 'Text feature', 'apr-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'banner_type' => 'type_1',
				],
			]
		);

		$this->add_responsive_control(
			'padding_text_feature_banner',
			[
				'label'      => esc_html__( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .apr-banner .text-feature' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'bn_text_feature_typography',
				'label'    => __( 'Typography', 'apr-core' ),
				'selector' => '{{WRAPPER}} .apr-banner .text-feature',
			]
		);
		$this->add_control(
			'bn_text_feature_color',
			[
				'label'     => __( 'Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .apr-banner .text-feature' => 'color: {{VALUE}};',
				],
				'condition' => [
					'banner_type' => 'type_1',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'bn_tab_subtitle_style',
			[
				'label'     => __( 'Subtitle', 'apr-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'banner_type!' => 'type_5',
				],
			]
		);

		$this->add_responsive_control(
			'content_subtitle_max_width',
			[
				'label'          => __( 'Max Width', 'apr-core' ),
				'type'           => Controls_Manager::SLIDER,
				'range'          => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units'     => [ '%', 'px' ],
				'default'        => [
					'size' => '100',
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'selectors'      => [
					'{{WRAPPER}} .apr-banner .subtitle,
                    {{WRAPPER}} .apr-banner .list-subtitle' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_subtitle_style' );

		$this->start_controls_tab(
			'tab_subtitle_normal',
			[
				'label' => __( 'Normal', 'apr-core' ),
			]
		);
		$this->add_control(
			'bn_subtitle_color',
			[
				'label'     => __( 'Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#2c2c2c',
				'selectors' => [
					'{{WRAPPER}} .apr-banner .subtitle, {{WRAPPER}} .apr-banner .subtitle a' => 'color: {{VALUE}};',
				],

			]
		);
		$this->add_control(
			'sub_title_bg_color',
			[
				'label'     => __( 'Background Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .list-subtitle h4' => 'background-color: {{VALUE}};',
				],

			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_subtitle_hover',
			[
				'label' => __( 'Hover', 'apr-core' ),
			]
		);

		$this->add_control(
			'bn_subtitle_hover_color',
			[
				'label'     => __( 'Hover Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#2c2c2c',
				'selectors' => [
					'{{WRAPPER}} .apr-banner .subtitle:hover, {{WRAPPER}} .apr-banner .subtitle a:hover' => 'color: {{VALUE}};',
				],

			]
		);
		$this->add_control(
			'subtitle_bg_color_hover',
			[
				'label'     => __( 'Background Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .list-subtitle h4:hover' => 'background-color: {{VALUE}};',
				],

			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'bn_subtitle_typography',
				'label'    => __( 'Typography', 'apr-core' ),
				'selector' => '{{WRAPPER}} .apr-banner .subtitle',
			]
		);

		$this->add_responsive_control(
			'bn_subtitle_margin',
			[
				'label'      => __( 'Margin', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range'      => [
					'px' => [
						'min' => - 50,
						'max' => 60,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors'  => [
					'{{WRAPPER}}  .apr-banner .subtitle' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'bn_tab_desc_style',
			[
				'label'     => __( 'Description', 'apr-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'banner_type' => [ 'type_1', 'type_5' ],
				],
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label'     => __( 'Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#2c2c2c',
				'selectors' => [
					'{{WRAPPER}} .apr-banner .description' => 'color: {{VALUE}};',
				],

			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'bn_desc_typography',
				'label'    => __( 'Typography', 'apr-core' ),
				'selector' => '{{WRAPPER}} .apr-banner .description',
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'bn_tab_icon_style',
			[
				'label'     => __( 'Icon', 'apr-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'banner_type' => 'type_2',
					'icon!'       => '',
				],
			]
		);
		$this->add_control(
			'bn_icon_color',
			[
				'label'     => __( 'Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .icon-detail a' => 'color: {{VALUE}};',
				],

			]
		);
		$this->add_control(
			'bn_icon_hover_color',
			[
				'label'     => __( 'Hover Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#2c2c2c',
				'selectors' => [
					'{{WRAPPER}} .icon-detail a:hover' => 'color: {{VALUE}};',
				],

			]
		);
		$this->add_control(
			'bn_icon_bg_color',
			[
				'label'     => __( 'Background Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .icon-detail'                                                   => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .apr-banner.type_2:after,{{WRAPPER}} .apr-banner.type_2:before' => 'border-color: {{VALUE}};',
				],

			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'bn_button_tab_style',
			[
				'label' => __( 'Button', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			'tabs_button_style'
		);

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'apr-core' ),
			]
		);

		$this->add_control(
			'bn_btn_bn_color',
			[
				'label'     => __( 'Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0d0d12',
				'selectors' => [
					'{{WRAPPER}} .apr-banner .btn-bn' => 'color: {{VALUE}};',
				],

			]
		);
		$this->add_control(
			'button_bg_color',
			[
				'label'     => __( 'Background Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'transparent',
				'selectors' => [
					'{{WRAPPER}} .apr-banner .btn-bn' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'btn_border',
				'label'       => __( 'Border', 'apr-core' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .apr-banner .btn-bn',
			]
		);
		$this->add_responsive_control(
			'btn_border_radius',
			[
				'label'      => __( 'Border Radius', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .apr-banner .btn-bn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'after',
			]
		);
		$this->add_responsive_control(
			'btn_padding',
			[
				'label'      => __( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .apr-banner .btn-bn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'after',
			]
		);
		$this->add_responsive_control(
			'bn_btn_bn_margin',
			[
				'label'      => __( 'Margin', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}}  .apr-banner .button-banner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'after',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'bn_btn_bn_typography',
				'label'     => __( 'Typography', 'apr-core' ),
				'selector'  => '{{WRAPPER}} .apr-banner .btn-bn',
				'separator' => 'after',
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
			'bn_btn_bn_hover_color',
			[
				'label'     => __( 'Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .apr-banner .btn-bn:hover' => 'color: {{VALUE}};',
				],

			]
		);
		$this->add_control(
			'button_background_hover_color',
			[
				'label'     => __( 'Background Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .apr-banner .btn-bn:hover,{{WRAPPER}} .button-banner .btn-bn:before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'btn_border_hover',
				'label'       => __( 'Border', 'apr-core' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .apr-banner .btn-bn:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {
		$this->apr_sc_banner();
		$settings = $this->get_settings();
		if ( empty( $settings['list'] ) ) {
			return;
		}
		$banner_type           = $settings['banner_type'];
		$effect                = $settings['effect'];
		$effect_text           = $settings['effect_text'];
		$effect_button         = $settings['effect_button'];
		$content_position      = $settings['content_position'];
		$title                 = $settings['title'];
		$text_feature          = $settings['text_feature'];
		$subtitle              = $settings['subtitle'];
		$button_text           = $settings['button_text'];
		$cate_thumb_url        = Group_Control_Image_Size::get_attachment_image_html( $settings, 'cate_thumb', 'cate_thumb' );
		$cate_thumb_url_tablet = Group_Control_Image_Size::get_attachment_image_html( $settings, 'cate_thumb_tablet', 'cate_thumb_tablet' );
		$cate_thumb_url_mobile = Group_Control_Image_Size::get_attachment_image_html( $settings, 'cate_thumb_mobile', 'cate_thumb_mobile' );
		$link                  = '';
		$position              = $settings['position'];
		$class_position        = $class_content_position = $class_effect = $class_effect_text = $class_effect_btn = '';
		if ( $effect_text == 'yes' ) {
			$class_effect_text = 'effect_text';
		}
		if ( $effect_button == 'yes' ) {
			$class_effect_btn = 'effect_button';
		}
		if ( $effect === 'effect_zoom' ) {
			$class_effect = 'effect_zoom';
		} elseif ( $effect === 'effect_blur' ) {
			$class_effect = 'effect_blur';
		} else {
			$class_effect = '';
		}
		if ( $content_position === 'left' ) {
			$class_content_position = 'content_left';
		} else {
			$class_content_position = 'content_right';
		}
		if ( $position === 'top_left' ) {
			$class_position = 'top_left';
		} elseif ( $position === 'top_right' ) {
			$class_position = 'top_right';
		} elseif ( $position === 'top_center' ) {
			$class_position = 'top_center';
		} elseif ( $position === 'center_left' ) {
			$class_position = 'center_left';
		} elseif ( $position === 'center_center' ) {
			$class_position = 'center_center';
		} elseif ( $position === 'center_right' ) {
			$class_position = 'center_right';
		} elseif ( $position === 'bottom_left' ) {
			$class_position = 'bottom_left';
		} elseif ( $position === 'bottom_center' ) {
			$class_position = 'bottom_center';
		} elseif ( $position === 'bottom_right' ) {
			$class_position = 'bottom_right';
		} else {
			$class_position = 'custom';
		}
		$class_image = '';
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
		$has_icon = ! empty( $settings['icon'] );
		if ( $has_icon ) {
			$this->add_render_attribute( 'i', 'class', $settings['icon'] );
			$this->add_render_attribute( 'i', 'aria-hidden', 'true' );
		}
		$subtitle_count = 0;
		?>
		<div
			class="apr-banner <?php echo esc_attr( $banner_type ); ?> <?php echo esc_attr( $class_effect_text ); ?> <?php echo esc_attr( $class_content_position ); ?> <?php echo esc_attr( $class_position ); ?>">
			<?php if ( $settings['banner_type'] === 'type_3' ): ?>
			<div class="img-banner <?php echo esc_attr( $class_effect ); ?> ">
				<?php endif; ?>
				<?php if ( $link !== '' ): ?>
				<a class="img-content" <?php echo $link; ?>>
					<?php endif; ?>
					<?php if ( ! empty( $cate_thumb_url ) ):
						$class_image = 'show-img-desktop';
						if ( ! empty( $cate_thumb_url_tablet ) && empty( $cate_thumb_url_mobile ) ) {
							$class_image = 'show-img-desktop show-img-tablet';
						} elseif ( ! empty( $cate_thumb_url_mobile ) && empty( $cate_thumb_url_tablet ) ) {
							$class_image = 'show-img-desktop show-img-mobile';
						} elseif ( ! empty( $cate_thumb_url_mobile ) && ! empty( $cate_thumb_url_tablet ) ) {
							$class_image = 'show-img-desktop show-img-tablet show-img-mobile';
						}
					endif ?>
					<div class="<?php echo esc_attr( $class_image ); ?> show-img">
						<?php if ( ! empty( $cate_thumb_url ) ) { ?>
							<div class="image-banner <?php echo esc_attr( $class_effect ); ?> image-desktop">
								<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'cate_thumb', 'cate_thumb' ); ?>
							</div>
						<?php } ?>
						<?php if ( ! empty( $cate_thumb_url_tablet ) ) { ?>
							<div class="image-banner <?php echo esc_attr( $class_effect ); ?> image-tablet">
								<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'cate_thumb_tablet', 'cate_thumb_tablet' ); ?>
							</div>
						<?php } ?>
						<?php if ( ! empty( $cate_thumb_url_mobile ) ) { ?>
							<div class="image-banner <?php echo esc_attr( $class_effect ); ?> image-mobile">
								<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'cate_thumb_mobile', 'cate_thumb_mobile' ); ?>
							</div>
						<?php } ?>
					</div>
					<?php if ( $link !== '' ): ?>
				</a>
			<?php endif; ?>
				<?php if ( $settings['banner_type'] === 'type_3' ): ?>
			</div>
		<?php endif; ?>
			<div class="bn-content">
				<?php if ( $settings['banner_type'] === 'type_7' ): ?>
					<div class="list-subtitle">
						<?php foreach ( $settings['list'] as $key => $list ) : ?>

							<?php
							$icon_tag = 'span';
							$list_url = $list['link']['url'];
							if ( ! empty( $list_url ) ) {
								$this->add_render_attribute( 'link' . $subtitle_count, 'href', $list_url );
								$icon_tag = 'a';

								if ( $list['link']['is_external'] ) {
									$this->add_render_attribute( 'link' . $subtitle_count, 'target', '_blank' );
								}

								if ( $list['link']['nofollow'] ) {
									$this->add_render_attribute( 'link' . $subtitle_count, 'rel', 'nofollow' );
								}
							}
							$link_attributes = $this->get_render_attribute_string( 'link' . $subtitle_count );
							?>
							<?php if ( ! empty( $list['subtitle_text'] ) ) : ?>
								<h4>
								<<?php echo implode( ' ', [ $icon_tag, $link_attributes ] ); ?>
								><?php echo $list['subtitle_text']; ?></<?php echo $icon_tag; ?>>
								</h4>
							<?php endif; ?>
							<?php
							$subtitle_count ++;
						endforeach; ?>
					</div>
				<?php endif; ?>
				<?php if ( $settings['banner_type'] === 'type_1' && ! empty( $text_feature ) ) : ?>
					<p class="text-feature">
						<?php echo $text_feature; ?>
					</p>
				<?php endif; ?>
				<?php if ( ! empty( $settings['title'] ) ) : ?>
					<h3 class="bn-title">
						<?php if ( $link !== '' ): ?>
						<a <?php echo $link; ?>>
							<?php endif; ?>
							<?php echo $settings['title']; ?>
							<?php if ( $settings['banner_type'] === 'type_3' && $settings['after_title'] !== '' ): ?>
								<span class="after-title">
                                    <?php echo $settings['after_title']; ?>
                                    </span>

							<?php endif; ?>
							<?php if ( $link !== '' ): ?>
						</a>
					<?php endif; ?>
					</h3>
				<?php endif; ?>
				<?php if ( ! empty( $settings['subtitle'] ) ) : ?>
					<p class="subtitle">
						<?php echo $settings['subtitle']; ?>
					</p>
				<?php endif; ?>
				<?php if ( ! empty( $settings['description'] ) ) : ?>
					<p class="description">
						<?php echo $settings['description']; ?>
					</p>
				<?php endif; ?>
				<?php
				if ( $button_text != '' ) {
					?>
					<div class="button-banner <?php echo esc_attr( $class_effect_btn ); ?>">
						<a <?php if ( $link != '' ) {
							echo $link;
						} else {
							echo 'href="#"';
						} ?> class="btn-bn"><?php echo $button_text; ?></a>
					</div>

				<?php } ?>
				<?php if ( ! empty( $settings['icon'] ) && $settings['banner_type'] === 'type_6' ) : ?>
					<div class="icon-detail">
						<a <?php if ( $link != '' ) {
							echo $link;
						} else {
							echo 'href="#"';
						} ?>>
							<i <?php echo $this->get_render_attribute_string( 'i' ); ?>></i>
						</a>
					</div>
				<?php endif; ?>
			</div>
			<?php if ( ! empty( $settings['icon'] ) && $settings['banner_type'] === 'type_2' ) : ?>
				<div class="icon-detail">
					<a <?php if ( $link != '' ) {
						echo $link;
					} else {
						echo 'href="#"';
					} ?>>
						<i <?php echo $this->get_render_attribute_string( 'i' ); ?>></i>
					</a>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}

}

Plugin::instance()->widgets_manager->register( new Apr_Core_Banner );
