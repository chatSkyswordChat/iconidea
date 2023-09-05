<?php

namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( class_exists( 'WPCF7_ContactForm' ) ) {
	class Apr_Core_Contact_Form extends Widget_Base {
		public function apr_sc_contact() {
			/* Import Css */
			if ( is_rtl() ) {
				wp_enqueue_style( 'apr-sc-contact', LUSION_CSS . '/elementor/contact-form-rtl.css', array(), LUSION_THEME_VERSION );
			} else {
				wp_enqueue_style( 'apr-sc-contact', LUSION_CSS . '/elementor/contact-form.css', array(), LUSION_THEME_VERSION );
			}
		}

		public function get_name() {
			return 'Apr_Core_Contact_Form';
		}

		public function get_title() {
			return __( 'APR Contact Form', 'apr-core' );
		}

		public function get_icon() {
			return 'eicon-form-horizontal apr-badge';
		}

		public function get_categories() {
			return array( 'apr-core' );
		}

		protected function register_controls() {
			$this->register_general_content_controls();
			$this->register_button_content_controls();
		}

		protected function register_general_content_controls() {

			$this->start_controls_section(
				'section_general_field',
				[
					'label' => __( 'General', 'apr-core' ),
				]
			);

			$this->add_control(
				'select_form',
				[
					'label'     => __( 'Select Form', 'apr-core' ),
					'type'      => Controls_Manager::SELECT,
					'options'   => $this->get_cf7_forms(),
					'default'   => '0',
					'help'      => __( 'Choose the form that you want for this page for styling', 'apr-core' ),
					'separator' => 'before',
				]
			);

			$this->add_responsive_control(
				'cf7_form_width',
				[
					'label'      => __( 'Form width', 'apr-core' ),
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
						'{{WRAPPER}} .apr-cf7' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'cf7_input_padding',
				[
					'label'      => __( 'Field Padding', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .apr-cf7-style input:not([type="submit"]), {{WRAPPER}} .apr-cf7-style select,{{WRAPPER}} .apr-cf7-style textarea'      => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .apr-cf7-style input[type="checkbox"] + span:before,{{WRAPPER}} .apr-cf7-style input[type="radio"] + span:before'      => 'height: {{TOP}}{{UNIT}}; width: {{TOP}}{{UNIT}};',
						'{{WRAPPER}} input[type="checkbox"] + span:before,{{WRAPPER}} input[type="radio"] + span:before'                                    => 'height: {{TOP}}{{UNIT}}; width: {{TOP}}{{UNIT}};',
						'{{WRAPPER}} .apr-cf7-style input[type="checkbox"]:checked + span:before, {{WRAPPER}} input[type="checkbox"]:checked + span:before' => 'font-size: calc({{BOTTOM}}{{UNIT}} / 1.2);',
						'{{WRAPPER}} .apr-cf7-style input[type=range]::-webkit-slider-thumb'                                                                => 'font-size: {{BOTTOM}}{{UNIT}};',
						'{{WRAPPER}} .apr-cf7-style input[type=range]::-moz-range-thumb'                                                                    => 'font-size: {{BOTTOM}}{{UNIT}};',
						'{{WRAPPER}} .apr-cf7-style input[type=range]::-ms-thumb'                                                                           => 'font-size: {{BOTTOM}}{{UNIT}};',
						'{{WRAPPER}} .apr-cf7-style input[type=range]::-webkit-slider-runnable-track'                                                       => 'font-size: {{BOTTOM}}{{UNIT}};',
						'{{WRAPPER}} .apr-cf7-style input[type=range]::-moz-range-track'                                                                    => 'font-size: {{BOTTOM}}{{UNIT}};',
						'{{WRAPPER}} .apr-cf7-style input[type=range]::-ms-fill-lower'                                                                      => 'font-size: {{BOTTOM}}{{UNIT}};',
						'{{WRAPPER}} .apr-cf7-style input[type=range]::-ms-fill-upper'                                                                      => 'font-size: {{BOTTOM}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'input_border_style',
				[
					'label'       => __( 'Border Style', 'apr-core' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'solid',
					'label_block' => false,
					'options'     => [
						'none'   => __( 'None', 'apr-core' ),
						'solid'  => __( 'Solid', 'apr-core' ),
						'double' => __( 'Double', 'apr-core' ),
						'dotted' => __( 'Dotted', 'apr-core' ),
						'dashed' => __( 'Dashed', 'apr-core' ),
					],
					'selectors'   => [
						'{{WRAPPER}} .apr-cf7-style input:not([type=submit]), {{WRAPPER}} .apr-cf7-style select,{{WRAPPER}} .apr-cf7-style textarea,{{WRAPPER}} .wpcf7-checkbox input[type="checkbox"]:checked + span:before, {{WRAPPER}} .wpcf7-checkbox input[type="checkbox"] + span:before,{{WRAPPER}} .wpcf7-acceptance input[type="checkbox"]:checked + span:before, {{WRAPPER}} .wpcf7-acceptance input[type="checkbox"] + span:before, {{WRAPPER}} .wpcf7-radio input[type="radio"] + span:before' => 'border-style: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'input_border_size',
				[
					'label'      => __( 'Border Width', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'default'    => [
						'top'    => '1',
						'bottom' => '1',
						'left'   => '1',
						'right'  => '1',
						'unit'   => 'px',
					],
					'condition'  => [
						'input_border_style!' => 'none',
					],
					'selectors'  => [
						'{{WRAPPER}} .apr-cf7-style input:not([type=submit]), {{WRAPPER}} .apr-cf7-style select,{{WRAPPER}} .apr-cf7-style textarea,{{WRAPPER}} .wpcf7-checkbox input[type="checkbox"]:checked + span:before, {{WRAPPER}} .wpcf7-checkbox input[type="checkbox"] + span:before,{{WRAPPER}} .wpcf7-acceptance input[type="checkbox"]:checked + span:before, {{WRAPPER}} .wpcf7-acceptance input[type="checkbox"] + span:before,{{WRAPPER}} .wpcf7-radio input[type="radio"] + span:before' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'cf7_input_radius',
				[
					'label'      => __( 'Rounded Corners', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .apr-cf7-style input:not([type="submit"]), {{WRAPPER}} .apr-cf7-style select, {{WRAPPER}} .apr-cf7-style textarea, {{WRAPPER}} .wpcf7-checkbox input[type="checkbox"] + span:before, {{WRAPPER}} .wpcf7-acceptance input[type="checkbox"] + span:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'default'    => [
						'top'    => '0',
						'bottom' => '0',
						'left'   => '0',
						'right'  => '0',
						'unit'   => 'px',
					],
				]
			);

			$this->add_responsive_control(
				'cf7_text_align',
				[
					'label'     => __( 'Field Alignment', 'apr-core' ),
					'type'      => Controls_Manager::CHOOSE,
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
						'{{WRAPPER}} .apr-cf7-style .wpcf7, {{WRAPPER}} .apr-cf7-style input:not([type=submit]),{{WRAPPER}} .apr-cf7-style textarea' => 'text-align: {{VALUE}};',
						' {{WRAPPER}} .apr-cf7-style select'                                                                                         => 'text-align-last:{{VALUE}};',
					],
				]
			);

			$this->end_controls_section();
		}

		protected function register_button_content_controls() {

			$this->start_controls_section(
				'cf7_submit_button',
				[
					'label' => __( 'Submit Button', 'apr-core' ),
				]
			);

			$this->add_responsive_control(
				'cf7_button_align',
				[
					'label'        => __( 'Button Alignment', 'apr-core' ),
					'type'         => Controls_Manager::CHOOSE,
					'options'      => [
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
					'default'      => 'justify',
					'prefix_class' => 'apr%s-cf7-button-',
					'toggle'       => false,
				]
			);

			$this->add_responsive_control(
				'cf7_button_padding',
				[
					'label'      => __( 'Padding', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .apr-cf7-style input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'cf7_button_margin',
				[
					'label'              => __( 'Margin', 'apr-core' ),
					'type'               => Controls_Manager::DIMENSIONS,
					'size_units'         => [ 'px', '%' ],
					'allowed_dimensions' => 'vertical',
					'placeholder'        => [
						'top'    => '',
						'right'  => 'auto',
						'bottom' => '',
						'left'   => 'auto',
					],
					'selectors'          => [
						'{{WRAPPER}} .apr-cf7-style input[type="submit"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'cf7_button_height',
				[
					'label'      => __( 'Height', 'apr-core' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', 'em' ],
					'range'      => [
						'px' => [
							'min' => 1,
							'max' => 100,
						],
						'em' => [
							'min' => 1,
							'max' => 100,
						],
					],
					'selectors'  => [
						'{{WRAPPER}} .apr-cf7-style input[type="submit"]' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs( 'tabs_button_style' );

			$this->start_controls_tab(
				'tab_button_normal',
				[
					'label' => __( 'Normal', 'apr-core' ),
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'     => 'btn_background_color',
					'label'    => __( 'Background Color', 'apr-core' ),
					'types'    => [ 'classic', 'gradient' ],
					'default'  => '#0ca8c9',
					'selector' => '{{WRAPPER}} .apr-cf7-style input[type="submit"]',
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'        => 'btn_border',
					'label'       => __( 'Border', 'apr-core' ),
					'placeholder' => '1px',
					'default'     => '1px',
					'selector'    => '{{WRAPPER}} .apr-cf7-style input[type="submit"]',
				]
			);

			$this->add_responsive_control(
				'btn_border_radius',
				[
					'label'      => __( 'Border Radius', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .apr-cf7-style input[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'button_box_shadow',
					'selector' => '{{WRAPPER}} .apr-cf7-style input[type="submit"]',
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
				'button_hover_border_color',
				[
					'label'     => __( 'Border Hover Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .apr-cf7-style input[type="submit"]:hover' => 'border-color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'     => 'button_background_hover_color',
					'label'    => __( 'Background Color', 'apr-core' ),
					'types'    => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .apr-cf7-style input[type="submit"]:hover',
				]
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->end_controls_section();

			/* Tab style */

			$this->start_controls_section(
				'cf7_input_spacing',
				[
					'label' => __( 'Spacing', 'apr-core' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'cf7_input_margin_top',
				[
					'label'      => __( 'Between Label & Input', 'apr-core' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', 'em', 'rem' ],
					'range'      => [
						'px' => [
							'min' => 1,
							'max' => 60,
						],
					],
					'default'    => [
						'unit' => 'px',
						'size' => 4,
					],
					'selectors'  => [
						'{{WRAPPER}} .apr-cf7-style input:not([type=submit]):not([type=checkbox]):not([type=radio]), {{WRAPPER}} .apr-cf7-style select, {{WRAPPER}} .apr-cf7-style textarea, {{WRAPPER}} .apr-cf7-style span.wpcf7-list-item' => 'margin-top: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'cf7_input_margin_bottom',
				[
					'label'      => __( 'Between Fields', 'apr-core' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px', 'em', 'rem' ],
					'range'      => [
						'px' => [
							'min' => 1,
							'max' => 60,
						],
					],
					'default'    => [
						'unit' => 'px',
						'size' => 0,
					],
					'selectors'  => [
						'{{WRAPPER}} .apr-cf7-style input:not([type=submit]):not([type=checkbox]):not([type=radio]), {{WRAPPER}} .apr-cf7-style select, {{WRAPPER}} .apr-cf7-style textarea, {{WRAPPER}} .apr-cf7-style span.wpcf7-list-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_section();
			$this->start_controls_section(
				'cf7_typo',
				[
					'label' => __( 'Color & Typography', 'apr-core' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'cf7_label_typo',
				[
					'label'     => __( 'Form Label (some forms may not have label)', 'apr-core' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'cf7_label_color',
				[
					'label'     => __( 'Label Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .apr-cf7-style .wpcf7 form.wpcf7-form:not(input) label' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'form_label_typography',

					'selector' => '{{WRAPPER}} .apr-cf7-style .wpcf7 form.wpcf7-form label',
				]
			);

			$this->add_control(
				'cf7_input_typo',
				[
					'label'     => __( 'Input Text / Placeholder', 'apr-core' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'cf7_input_bgcolor',
				[
					'label'     => __( 'Field Background Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#ffffff',
					'selectors' => [
						'{{WRAPPER}} .apr-cf7-style input:not([type=submit]), {{WRAPPER}} .apr-cf7-style select, {{WRAPPER}} .apr-cf7-style textarea, {{WRAPPER}} .apr-cf7-style .wpcf7-checkbox input[type="checkbox"] + span:before,{{WRAPPER}} .apr-cf7-style .wpcf7-acceptance input[type="checkbox"] + span:before, {{WRAPPER}} .apr-cf7-style .wpcf7-radio input[type="radio"]:not(:checked) + span:before' => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .apr-cf7-style input[type=range]::-webkit-slider-runnable-track,{{WRAPPER}} .apr-cf7-style input[type=range]:focus::-webkit-slider-runnable-track'                                                                                                                                                                                                                           => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .apr-cf7-style input[type=range]::-moz-range-track,{{WRAPPER}} input[type=range]:focus::-moz-range-track'                                                                                                                                                                                                                                                                    => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .apr-cf7-style input[type=range]::-ms-fill-lower,{{WRAPPER}} .apr-cf7-style input[type=range]:focus::-ms-fill-lower'                                                                                                                                                                                                                                                         => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .apr-cf7-style input[type=range]::-ms-fill-upper,{{WRAPPER}} .apr-cf7-style input[type=range]:focus::-ms-fill-upper'                                                                                                                                                                                                                                                         => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-radio input[type="radio"]:checked + span:before, {{WRAPPER}} .wpcf7-radio input[type="radio"]:checked + span:before'                                                                                                                                                                                                                                                  => 'box-shadow:inset 0px 0px 0px 4px {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'cf7_input_color',
				[
					'label'     => __( 'Input Text / Placeholder Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .apr-cf7-style .wpcf7 input:not([type=submit]),{{WRAPPER}} .apr-cf7-style .wpcf7 input::placeholder, {{WRAPPER}} .apr-cf7-style .wpcf7 select, {{WRAPPER}} .apr-cf7-style .wpcf7 textarea, {{WRAPPER}} .apr-cf7-style .wpcf7 textarea::placeholder,{{WRAPPER}} .apr-cf7-style .apr-cf7-select-custom:after' => 'color: {{VALUE}};',
						'{{WRAPPER}} .apr-cf7-style .wpcf7 input:not([type=submit]),
                         {{WRAPPER}} .apr-cf7-style .wpcf7 select,
                          {{WRAPPER}} .apr-cf7-style .wpcf7 textarea'                                                                                                                                                                                                                                                    => 'color: {{VALUE}};',
						'{{WRAPPER}}.elementor-widget-apr-cf7-styler .wpcf7-checkbox input[type="checkbox"]:checked + span:before, {{WRAPPER}}.elementor-widget-apr-cf7-styler .wpcf7-acceptance input[type="checkbox"]:checked + span:before'                                                                                                   => 'color: {{VALUE}};',
						'{{WRAPPER}} .wpcf7-radio input[type="radio"]:checked + span:before, {{WRAPPER}} .wpcf7-radio input[type="radio"]:checked + span:before'                                                                                                                                                                                 => 'background-color: {{VALUE}};',
						'{{WRAPPER}} .apr-cf7-style input[type=range]::-webkit-slider-thumb'                                                                                                                                                                                                                                                     => 'border: 1px solid {{VALUE}}; background: {{VALUE}};',
						'{{WRAPPER}} .apr-cf7-style input[type=range]::-moz-range-thumb'                                                                                                                                                                                                                                                         => 'border: 1px solid {{VALUE}}; background: {{VALUE}};',
						'{{WRAPPER}} .apr-cf7-style input[type=range]::-ms-thumb'                                                                                                                                                                                                                                                                => 'border: 1px solid {{VALUE}}; background: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'input_border_color',
				[
					'label'     => __( 'Border Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'condition' => [
						'input_border_style!' => 'none',
					],
					'default'   => '#ebeeee',
					'selectors' => [
						'{{WRAPPER}} .apr-cf7-style input:not([type=submit]), {{WRAPPER}} .apr-cf7-style select,{{WRAPPER}} .apr-cf7-style textarea,{{WRAPPER}} .wpcf7-checkbox input[type="checkbox"]:checked + span:before, {{WRAPPER}} .wpcf7-checkbox input[type="checkbox"] + span:before,{{WRAPPER}} .wpcf7-acceptance input[type="checkbox"]:checked + span:before, {{WRAPPER}} .wpcf7-acceptance input[type="checkbox"] + span:before, {{WRAPPER}} .wpcf7-radio input[type="radio"] + span:before' => 'border-color: {{VALUE}};',
						'{{WRAPPER}} .apr-cf7-style input[type=range]::-webkit-slider-runnable-track'                                                                                                                                                                                                                                                                                                                                                                                                      => 'border: 0.2px solid {{VALUE}}; box-shadow: 1px 1px 1px {{VALUE}}, 0px 0px 1px {{VALUE}};',
						'{{WRAPPER}} .apr-cf7-style input[type=range]::-moz-range-track'                                                                                                                                                                                                                                                                                                                                                                                                                   => 'border: 0.2px solid {{VALUE}}; box-shadow: 1px 1px 1px {{VALUE}}, 0px 0px 1px {{VALUE}};',
						'{{WRAPPER}} .apr-cf7-style input[type=range]::-ms-fill-lower'                                                                                                                                                                                                                                                                                                                                                                                                                     => 'border: 0.2px solid {{VALUE}}; box-shadow: 1px 1px 1px {{VALUE}}, 0px 0px 1px {{VALUE}};',
						'{{WRAPPER}} .apr-cf7-style input[type=range]::-ms-fill-upper'                                                                                                                                                                                                                                                                                                                                                                                                                     => 'border: 0.2px solid {{VALUE}}; box-shadow: 1px 1px 1px {{VALUE}}, 0px 0px 1px {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'cf7_ipborder_active',
				[
					'label'     => __( 'Border Active Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .apr-cf7-style .wpcf7 form input:not([type=submit]):focus, {{WRAPPER}} .apr-cf7-style select:focus, {{WRAPPER}} .apr-cf7-style .wpcf7 textarea:focus, {{WRAPPER}} .apr-cf7-style .wpcf7-checkbox input[type="checkbox"]:checked + span:before,{{WRAPPER}} .apr-cf7-style .wpcf7-acceptance input[type="checkbox"]:checked + span:before, {{WRAPPER}} .apr-cf7-style .wpcf7-radio input[type="radio"]:checked + span:before' => 'border-color: {{VALUE}};',
					],
					'condition' => [
						'input_border_style!' => 'none',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'input_typography',

					'selector' => '{{WRAPPER}} .apr-cf7-style .wpcf7 input:not([type=submit]), {{WRAPPER}} .apr-cf7-style .wpcf7 input::placeholder, {{WRAPPER}} .wpcf7 select,{{WRAPPER}} .apr-cf7-style .wpcf7 textarea, {{WRAPPER}} .apr-cf7-style .wpcf7 textarea::placeholder, {{WRAPPER}} .apr-cf7-style input[type=range]::-webkit-slider-thumb,{{WRAPPER}} .apr-cf7-style .apr-cf7-select-custom',
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'input_box_shadow',
					'selector' => '{{WRAPPER}} .apr-cf7-style .wpcf7 input:not([type=submit]), {{WRAPPER}} .apr-cf7-style .wpcf7 input::placeholder, {{WRAPPER}} .wpcf7 select,{{WRAPPER}} .apr-cf7-style .wpcf7 textarea, {{WRAPPER}} .apr-cf7-style .wpcf7 textarea::placeholder, {{WRAPPER}} .apr-cf7-style input[type=range]::-webkit-slider-thumb,{{WRAPPER}} .apr-cf7-style .apr-cf7-select-custom',
				]
			);
			$this->add_control(
				'btn_typography_label',
				[
					'label'     => __( 'Button', 'apr-core' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'button_text_color',
				[
					'label'     => __( 'Text Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .apr-cf7-style input[type="submit"]' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'btn_hover_color',
				[
					'label'     => __( 'Text Hover Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .apr-cf7-style input[type="submit"]:hover' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'btn_typography',
					'label'    => __( 'Typography', 'apr-core' ),
					'selector' => '{{WRAPPER}} .apr-cf7-style input[type=submit]',
				]
			);
			$this->end_controls_section();
		}

		protected function render() {
			$this->apr_sc_contact();
			if ( ! class_exists( 'WPCF7_ContactForm' ) ) {
				return;
			}
			$settings           = $this->get_settings();
			$field_options      = array();
			$args               = array(
				'post_type'      => 'wpcf7_contact_form',
				'posts_per_page' => - 1,
			);
			$forms              = get_posts( $args );
			$field_options['0'] = __( 'select', 'apr-core' );
			if ( $forms ) {
				foreach ( $forms as $form ) {
					$field_options[$form->ID] = $form->post_title;
				}
			}
			$forms = $this->get_cf7_forms();
			$html  = '';

			if ( ! empty( $forms ) && ! isset( $forms[- 1] ) ) {
				if ( 0 == $settings['select_form'] ) {
					$html = __( 'Please select a Contact Form 7.', 'apr-core' );
				} else {
					?>
					<div class="apr-cf7 apr-contact apr-cf7-style elementor-clickable">
						<?php
						if ( $settings['select_form'] ) {
							echo do_shortcode( '[contact-form-7 id=' . $settings['select_form'] . ']' );
						}
						?>
					</div>
					<?php
				}
			} else {
				$html = __( 'You have not added any Contact Form 7 yet.', 'apr-core' );
			}
			echo $html;
		}

		protected function get_cf7_forms() {

			$field_options = array();

			if ( class_exists( 'WPCF7_ContactForm' ) ) {
				$args               = array(
					'post_type'      => 'wpcf7_contact_form',
					'posts_per_page' => - 1,
				);
				$forms              = get_posts( $args );
				$field_options['0'] = 'Select';
				if ( $forms ) {
					foreach ( $forms as $form ) {
						$field_options[$form->ID] = $form->post_title;
					}
				}
			}

			if ( empty( $field_options ) ) {
				$field_options = array(
					'-1' => __( 'You have not added any Contact Form 7 yet.', 'apr-core' ),
				);
			}

			return $field_options;
		}

	}

	Plugin::instance()->widgets_manager->register( new Apr_Core_Contact_Form );
}
