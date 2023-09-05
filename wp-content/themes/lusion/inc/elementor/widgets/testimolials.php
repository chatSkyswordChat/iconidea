<?php

namespace Elementor;

use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Apr_Core_Testimolials extends Widget_Base {  

	public function apr_sc_testimonial() {
		/* Import Css */
		if ( is_rtl() ) {
			wp_enqueue_style( 'apr-sc-testimonial', LUSION_CSS . '/elementor/testimonial-rtl.css', array(), LUSION_THEME_VERSION );
		} else {
			wp_enqueue_style( 'apr-sc-testimonial', LUSION_CSS . '/elementor/testimonial.css', array(), LUSION_THEME_VERSION );
		}
	}

	public function get_name() {
		return 'apr-testimolials';
	}

	public function get_categories() {
		return array( 'apr-core' );
	}

	public function get_title() {
		return __( ' APR Testimolials', 'apr-core' );
	}

	public function get_icon() {
		return 'eicon-testimonial';
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_testimonial',
			[
				'label' => __( 'Testimonial', 'apr-core' ),
			]
		);
		$this->add_control(
			'testimonial_type',
			array(
				'label'        => __( 'Testimonials Type', 'apr-core' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => array(
					'1' => __( 'Type 1', 'apr-core' ),
					'2' => __( 'Type 2', 'apr-core' ),
					'3' => __( 'Type 3', 'apr-core' ),
					'4' => __( 'Type 4', 'apr-core' ),
					'5' => __( 'Type 5', 'apr-core' ),
					'6' => __( 'Type 6', 'apr-core' ),
				),
				'default'      => '1',
				'prefix_class' => 'testimonial-type-',
			)
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'testimonial_name',
			[
				'label'   => __( 'Name', 'apr-core' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => 'David Jones',
			]
		);
		$repeater->add_control(
			'testimonial_desc',
			[
				'label'   => __( 'Content', 'apr-core' ),
				'type'    => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'rows'    => '10',
				'default' => 'Lorem ipsum dolor sit amet, his ad detracto quaerendum. Nec no harum alterum bonorum, has movet persius et,',
			]
		);
		$repeater->add_control(
			'testimonial_slider_image',
			[
				'label'       => __( 'Choose Image', 'elementor' ),
				'description' => __( 'You should choose a small, rectangle image.', 'elementor' ),
				'type'        => Controls_Manager::MEDIA,
				'default'     => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'testimonial_job',
			[
				'label'   => __( 'Job', 'apr-core' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => false,
				],
				'default' => 'Designer',
			]
		);
		$repeater->add_control(
			'testimonial_time',
			[
				'label'   => __( 'Time', 'apr-core' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => false,
				],
			]
		);
		$this->add_control(
			'slides',
			[
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'testimonial_name' => __( 'David Jones', 'apr-core' ),
						'testimonial_job'  => __( 'Header of design', 'apr-core' ),
						'testimonial_desc' => 'Lorem ipsum dolor sit amet, his ad detracto quaerendum. Nec no harum alterum bonorum, has movet persius et,',
					],
					[
						'testimonial_name' => __( 'David Jones', 'apr-core' ),
						'testimonial_job'  => __( 'Header of design', 'apr-core' ),
						'testimonial_desc' => 'Lorem ipsum dolor sit amet, his ad detracto quaerendum. Nec no harum alterum bonorum, has movet persius et,',
					],
					[
						'testimonial_name' => __( 'David Jones', 'apr-core' ),
						'testimonial_job'  => __( 'Header of design', 'apr-core' ),
						'testimonial_desc' => 'Lorem ipsum dolor sit amet, his ad detracto quaerendum. Nec no harum alterum bonorum, has movet persius et,',
					],
					[
						'testimonial_name' => __( 'David Jones', 'apr-core' ),
						'testimonial_job'  => __( 'Header of design', 'apr-core' ),
						'testimonial_desc' => 'Lorem ipsum dolor sit amet, his ad detracto quaerendum. Nec no harum alterum bonorum, has movet persius et,',
					],
				],
				'title_field' => '{{{ testimonial_name }}}',
			]
		);
		$this->add_control(
			'testimonial_alignment',
			[
				'label'          => __( 'Alignment', 'apr-core' ),
				'type'           => Controls_Manager::CHOOSE,
				'default'        => 'center',
				'options'        => [
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
				'label_block'    => false,
				'style_transfer' => true,
			]
		);
		$this->add_control(
			'view',
			[
				'label'   => __( 'View', 'apr-core' ),
				'type'    => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_slider_options',
			[
				'label'     => __( 'Slider Options', 'apr-core' ),
				'type'      => Controls_Manager::SECTION,
				'condition' => [
					'testimonial_type!' => [ '5', '6' ],
				],
			]
		);
		$this->add_responsive_control(
			'number_item',
			[
				'label'           => __( 'Number Item', 'apr-core' ),
				'type'            => Controls_Manager::SELECT,
				'options'         => [
					'1' => __( '1', 'apr-core' ),
					'2' => __( '2', 'apr-core' ),
					'3' => __( '3', 'apr-core' ),
					'4' => __( '4', 'apr-core' ),
				],
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => 3,
				'tablet_default'  => 2,
				'mobile_default'  => 1,
				'default'         => 3,
				'condition'       => [
					'testimonial_type!' => [ '5', '6' ],
				],
			]
		);
		$this->add_control(
			'navigation',
			[
				'label'     => __( 'Navigation', 'apr-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'none',
				'options'   => [
					'both'   => __( 'Arrows and Dots', 'apr-core' ),
					'arrows' => __( 'Arrows', 'apr-core' ),
					'dots'   => __( 'Dots', 'apr-core' ),
					'none'   => __( 'None', 'apr-core' ),
				],
				'condition' => [
					'testimonial_type' => [ '1', '2', '4' ],

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
		$this->end_controls_section();
		//content
		$this->start_controls_section(
			'section_style_testimonial_content',
			[
				'label'     => __( 'Content', 'apr-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'testimonial_type' => [ '4' ],
				],
			]
		);
		$this->add_responsive_control(
			'testimonial_content_padding',
			[
				'label'      => __( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}}.testimonial-type-4 .item-testimonial' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'testimonial_content_margin',
			[
				'label'      => __( 'Margin', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}}.testimonial-type-4 .item-testimonial' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'testimonial_content_border',
				'selector' => '{{WRAPPER}}.testimonial-type-4 .item-testimonial'
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_style_testimonial_item',
			[
				'label'     => __( 'Item', 'apr-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'testimonial_type' => [ '1', '2', '4' ],
				],
			]
		);
		$this->add_control(
			'bg_item_color',
			[
				'label'     => __( 'Background color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .item-testimonial' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'item_padding',
			[
				'label'      => esc_html__( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .item-testimonial' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		// Image.
		$this->start_controls_section(
			'section_style_testimonial_image',
			[
				'label'     => __( 'Image', 'apr-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'testimonial_type' => [ '1', '2', '4' ],
				],
			]
		);
		$this->add_responsive_control(
			'size_image',
			[
				'label'      => __( 'Width', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 20,
						'max' => 200,
					],
				],
				'selectors'  => [

					'{{WRAPPER}}.testimonial-type-3 .testimonial-image img,
                    {{WRAPPER}} .testimonial-image  img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'testimonial_image_spacing',
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
					'{{WRAPPER}} .testimonial-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'testimonial_type' => '4',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'testimonial_image_border',
				'selector' => '{{WRAPPER}}.testimonial-type-4 .testimonial-image img'
			]
		);
		$this->add_responsive_control(
			'testimonial_image_radius',
			[
				'label'      => __( 'Border Radius', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'size' => '50',
					'unit' => '%',
				],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-image img' => 'border-radius: {{SIZE}}{{UNIT}} !important;',
				],
				'condition'  => [
					'testimonial_type' => '4',
				],
			]
		);
		$this->end_controls_section();
		// Name.
		$this->start_controls_section(
			'section_style_testimonial_name',
			[
				'label' => __( 'Name', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'name_text_color',
			[
				'label'     => __( 'Text Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-name' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',

				'selector' => '{{WRAPPER}} .testimonial-name',
			]
		);
		$this->end_controls_section();

		// Content.
		$this->start_controls_section(
			'section_style_testimonial_desc',
			[
				'label' => __( 'Description', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'content_desc_color',
			[
				'label'     => __( 'Text Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-desc' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',

				'selector' => '{{WRAPPER}} .testimonial-desc',
			]
		);
		$this->add_responsive_control(
			'testimonial_desc_spacing',
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
					'{{WRAPPER}} .testimonial-desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'testimonial_type' => '4',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => __( 'Icon Quote', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'style_icon_size',
			[
				'label'      => __( 'Size', 'apr-core' ),
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
					'{{WRAPPER}}.testimonial-type-4 .item-testimonial:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'testimonial_type' => '4',
				],
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label'     => __( 'Text Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}}.testimonial-type-3 .testimonial-desc:before,
                    {{WRAPPER}}.testimonial-type-4 .item-testimonial:before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_border_color',
			[
				'label'     => __( 'Border Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}}.testimonial-type-3 .testimonial-desc:before,
                    {{WRAPPER}}.testimonial-type-3 .testimonial-image img,
                    {{WRAPPER}}.testimonial-type-4 .item-testimonial:before' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'style_icon_top',
			[
				'label'      => __( 'Top', 'apr-core' ),
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
					'{{WRAPPER}}.testimonial-type-4 .item-testimonial:before' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'testimonial_type' => '4',
				],
			]
		);
		$this->add_responsive_control(
			'style_icon_left',
			[
				'label'      => __( 'Left', 'apr-core' ),
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
					'{{WRAPPER}}.testimonial-type-4 .item-testimonial:before' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'testimonial_type'      => '4',
					'testimonial_alignment' => 'left',
				],
			]
		);
		$this->add_responsive_control(
			'style_icon_right',
			[
				'label'      => __( 'Right', 'apr-core' ),
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
					'{{WRAPPER}}.testimonial-type-4 .item-testimonial:before' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'testimonial_type'      => '4',
					'testimonial_alignment' => 'right',
				],
			]
		);

		$this->end_controls_section();
		// Content.
		$this->start_controls_section(
			'section_style_testimonial_job',
			[
				'label' => __( 'Job', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'content_job_color',
			[
				'label'     => __( 'Text Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .testimonial-job' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'job_typography',

				'selector' => '{{WRAPPER}} .testimonial-job',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_style_navigation',
			[
				'label'     => __( 'Navigation', 'apr-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => [ 'arrows', 'dots', 'both' ],
				],
			]
		);
		$this->add_control(
			'heading_style_dots',
			[
				'label'     => __( 'Dots', 'apr-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);
		$this->add_control(
			'dots_color',
			[
				'label'     => __( 'Dots Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slick-dots li button' => 'background: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);
		$this->add_control(
			'dots_border_color',
			[
				'label'     => __( 'Dots Hover Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slick-dots li:hover button, 
                    {{WRAPPER}} .slick-dots li.slick-active button' => 'background: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
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
					'navigation' => [ 'arrows', 'both' ],
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
					'navigation' => [ 'arrows', 'both' ],
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
					'navigation' => [ 'arrows', 'both' ],
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
					'navigation' => [ 'arrows', 'both' ],
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
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);
		$this->end_controls_section();

	}

	/**
	 * Render testimonial widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function render() {
		$this->apr_sc_testimonial();
		$settings         = $this->get_settings_for_display(); 
		$testimonial_type = $settings['testimonial_type'];
		$item_desktop     = $settings['number_item'];
		$item_tablet      = isset( $settings['number_item_tablet'] ) ? $settings['number_item_tablet'] : 2;
		$item_mobile      = isset( $settings['number_item_mobile'] ) ? $settings['number_item_mobile'] : 1;
		if ( empty( $settings['slides'] ) ) {
			return;
		}
		$this->add_render_attribute( 'wrapper', 'class', 'elementor-testimonial-wrapper' );
		if ( $settings['testimonial_alignment'] ) {
			$this->add_render_attribute( 'wrapper', 'class', 'text-' . $settings['testimonial_alignment'] );
		}
		$this->add_render_attribute( 'meta', 'class', 'elementor-testimonial-meta' );
		$slides       = [];
		$slides_image = [];
		$slide_count  = 0;
		foreach ( $settings['slides'] as $slide ) {
			$slide_html  = $btn_attributes = '';
			$btn_element = $slide_element = 'div';
			if ( $settings['testimonial_type'] === '3' ) {
				if ( $slide['testimonial_desc'] ) {
					$slide_html .= '<div class="testimonial-desc">' . $slide['testimonial_desc'] . '</div>';
				}
				if ( $slide['testimonial_name'] ) {
					$slide_html .= '<div class="testimonial-name">' . $slide['testimonial_name'] . '</div>';
				}
				if ( $slide['testimonial_job'] ) {
					$slide_html .= '<div class="testimonial-job">' . $slide['testimonial_job'] . '</div>';
				}
			} elseif ( $settings['testimonial_type'] === '2' ) {
				if ( $slide['testimonial_desc'] ) {
					$slide_html .= '<div class="testimonial-desc">' . $slide['testimonial_desc'] . '</div>';
				}
				if ( $slide['testimonial_slider_image']['url'] ) {
					$image_url  = $slide['testimonial_slider_image']['url'];
					$image_html = '<img src="' . esc_attr( $image_url ) . '" alt="' . esc_attr( 'Image Testimonial', 'apr-core' ) . '" />';
					$slide_html .= '<div class="testimonial-image">' . $image_html . '</div>';
				}
				$slide_html .= '<div class="info-client">';
				if ( $slide['testimonial_name'] ) {
					$slide_html .= '<div class="testimonial-name">' . $slide['testimonial_name'] . '</div>';
				}
				if ( $slide['testimonial_job'] ) {
					$slide_html .= '<div class="testimonial-job">' . $slide['testimonial_job'] . '</div>';
				}
				$slide_html .= '</div>';
			} elseif ( $settings['testimonial_type'] === '5' ) {
				if ( $slide['testimonial_slider_image']['url'] ) {
					$image_url  = $slide['testimonial_slider_image']['url'];
					$image_html = '<img src="' . esc_attr( $image_url ) . '" alt="' . esc_attr( 'Image Testimonial', 'apr-core' ) . '" />';
					$slide_html .= '<div class="testimonial-image">' . $image_html . '</div>';
				}
				$slide_html .= '<div class="testimonial-content-inner">';
				if ( $slide['testimonial_desc'] ) {
					$slide_html .= '<div class="testimonial-desc">' . $slide['testimonial_desc'] . '</div>';
				}
				$slide_html .= '<div class="info-client">';
				if ( $slide['testimonial_name'] ) {
					$slide_html .= '<div class="testimonial-name">' . $slide['testimonial_name'] . '</div>';
				}
				if ( $slide['testimonial_job'] ) {
					$slide_html .= '<div class="testimonial-job">' . $slide['testimonial_job'] . '</div>';
				}
				$slide_html .= '</div>';
				$slide_html .= '</div>';
			} elseif ( $settings['testimonial_type'] === '6' ) {
				if ( $slide['testimonial_slider_image']['url'] ) {
					$image_url  = $slide['testimonial_slider_image']['url'];
					$image_html = '<img src="' . esc_attr( $image_url ) . '" alt="' . esc_attr( 'Image Testimonial', 'apr-core' ) . '" />';
					$slide_html .= '<div class="testimonial-image">' . $image_html . '</div>';
				}
				$slide_html .= '<div class="testimonial-content-inner">';
				$slide_html .= '<div class="info-clients">';
				if ( $slide['testimonial_name'] ) {
					$slide_html .= '<div class="testimonial-name">' . $slide['testimonial_name'] . '</div>';
				}
				if ( $slide['testimonial_desc'] ) {
					$slide_html .= '<div class="testimonial-desc">' . $slide['testimonial_desc'] . '</div>';
				}
				if ( $slide['testimonial_time'] ) {
					$slide_html .= '<div class="testimonial-time">' . $slide['testimonial_time'] . '</div>';
				}
				$slide_html .= '</div></div>';
			} else {
				if ( $slide['testimonial_slider_image']['url'] ) {
					$image_url  = $slide['testimonial_slider_image']['url'];
					$image_html = '<img src="' . esc_attr( $image_url ) . '" alt="' . esc_attr( 'Image Testimonial', 'apr-core' ) . '" />';
					$slide_html .= '<div class="testimonial-image">' . $image_html . '</div>';
				}
				if ( $slide['testimonial_desc'] ) {
					$slide_html .= '<div class="testimonial-desc">' . $slide['testimonial_desc'] . '</div>';
				}
				$slide_html .= '<div class="info-client">';
				if ( $slide['testimonial_name'] ) {
					$slide_html .= '<div class="testimonial-name">' . $slide['testimonial_name'] . '</div>';
				}
				if ( $slide['testimonial_job'] ) {
					$slide_html .= '<div class="testimonial-job">' . $slide['testimonial_job'] . '</div>';
				}
				$slide_html .= '</div>';
			}
			$slides[] = '<div class="elementor-repeater-item-' . $slide['_id'] . ' item-testimonial ">' . $slide_html . '</div>';
			$slide_count ++;
		}
		foreach ( $settings['slides'] as $slide_image ) {
			$slide_html1 = '';
			if ( $slide_image['testimonial_slider_image'] ) {
				$image_url  = $slide_image['testimonial_slider_image']['url'];
				$image_html = '<img src="' . esc_attr( $image_url ) . '" alt="" />';
			}
			$slides_image[] = '<div class="img-wrap' . '">' . $image_html . '</div>';
			$slide_count ++;
		}
		$is_rtl      = is_rtl();
		$direction   = $is_rtl ? 'true' : 'false';
		$show_dots   = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
		$show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
		$id          = 'apr-testimolial-' . wp_rand();
		$show_arr    = 'false';
		$show_dot    = 'false';
		/* Import js */
		wp_enqueue_script( 'apr-sc-testimonial-js', LUSION_JS . '/elementor/testimonials.min.js', false );
		if ( $settings['navigation'] == 'both' ) {
			$show_arr = 'true';
			$show_dot = 'true';
		} elseif ( $settings['navigation'] == 'arrows' ) {
			$show_arr = 'true';
		} elseif ( $settings['navigation'] == 'dots' ) {
			$show_dot = 'true';
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
		$slick_options    = [
			'rtl' => $is_rtl,
		];
		$carousel_classes = [ 'testimonial-content' ];
		if ( $show_arrows ) {
			$carousel_classes[] = 'cs-slick-arrows';
		}
		if ( $show_dots ) {
			$carousel_classes[] = 'cs-slick-dots';
		}
		if ( $testimonial_type === '3' ) {
			$carousel_classes[] = 'slider-syncing';

		} elseif ( $testimonial_type === '5' ) {
			$carousel_classes[] = 'testimonial-list';

		} elseif ( $testimonial_type === '6' ) {
			$carousel_classes[] = 'testimonial-list2';
		} else {
			$carousel_classes[] = 'slider-multiple';
		}
		$this->add_render_attribute( 'slides', [
			'class'               => $carousel_classes,
			'data-slider_options' => wp_json_encode( $slick_options ),
		] );
		?>
		<div id="<?php echo esc_attr( $id ); ?>" class="testimonial">
			<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
				<div <?php echo $this->get_render_attribute_string( 'slides' ); ?>>
					<?php echo implode( '', $slides ); ?>
				</div>
				<?php if ( $testimonial_type === '3' ): ?>
					<div class="testimonial-image"> <?php echo implode( '', $slides_image ); ?></div>
				<?php endif; ?>
			</div>
		</div>
		<?php if ( $testimonial_type === '3' ): ?>
			<script>
				jQuery(document).ready(function ($) {
					$('#<?php echo esc_js( $id );?> .testimonial-image').slick({
						slidesToShow  :<?php echo esc_attr( $item_desktop );?>,
						slidesToScroll: 1,
						asNavFor      : '#<?php echo esc_js( $id );?> .slider-syncing',
						dots          : false,
						arrows        : false,
						rtl           : <?php echo esc_attr( $direction );?>,
						focusOnSelect : true,
						pauseOnHover  : <?php echo esc_attr( $pause_on_hover );?>,
						infinite      : true,
						centerMode    : true,
						centerPadding : 0,
						responsive    : [
							{
								breakpoint: 600,
								settings  : {
									slidesToShow: <?php echo esc_attr( $item_tablet );?>,
								}
							},
							{
								breakpoint: 480,
								settings  : {
									slidesToShow: <?php echo esc_attr( $item_mobile );?>,
								}
							},
						]
					});
					$('#<?php echo esc_js( $id );?> .slider-syncing').slick({
						slidesToShow  : 1,
						slidesToScroll: 1,
						fade          : true,
						rtl           : <?php echo esc_attr( $direction );?>,
						centerMode    : true,
						centerPadding : 0,
						asNavFor      : '#<?php echo esc_js( $id );?> .testimonial-image',
						dots          : false,
						arrows        : false,
						autoplay      : <?php echo esc_attr( $autoplay );?>,
						pauseOnHover  : <?php echo esc_attr( $pause_on_hover );?>,
						infinite      : <?php echo esc_attr( $infinite );?>,
						autoplaySpeed : <?php echo absint( $settings['autoplay_speed'] );?>,
						speed         : <?php echo absint( $settings['transition_speed'] );?>
					});
				});
			</script>
		<?php endif; ?>
		<?php if ( $testimonial_type !== '6' ): ?>
			<script>
				jQuery(document).ready(function ($) {
					$('#<?php echo esc_js( $id );?> .slider-multiple').slick({
						slidesToShow  : <?php echo esc_attr( $item_desktop );?>,
						slidesToScroll: 1,
						rtl           : <?php echo esc_attr( $direction );?>,
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
						//swipe         : false,
						responsive: [
							{
								breakpoint: 1025,
								settings  : {
									rows        : 1,
									slidesToShow: 3,
									swipe       : true,
								}

							},
							{
								breakpoint: 768,
								settings  : {
									rows        : 1,
									slidesToShow: <?php echo esc_attr( $item_mobile );?>,
									swipe       : true,
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

Plugin::instance()->widgets_manager->register( new Apr_Core_Testimolials );
