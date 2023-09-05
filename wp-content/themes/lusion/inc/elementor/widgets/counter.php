<?php

namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Apr_Core_Counter extends Widget_Base {

	public function apr_sc_counter() {
		/* Import Css */
		if ( is_rtl() ) {
			wp_enqueue_style( 'apr-sc-counter', LUSION_CSS . '/elementor/counter-rtl.css', array(), LUSION_THEME_VERSION );
		} else {
			wp_enqueue_style( 'apr-sc-counter', LUSION_CSS . '/elementor/counter.css', array(), LUSION_THEME_VERSION );
		}
	}

	public function get_categories() {
		return array( 'apr-core' );
	}

	/**
	 * Get widget name.
	 *
	 * Retrieve counter widget name.
	 *
	 * @return string Widget name.
	 * @since  1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return 'apr_counter';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve counter widget title.
	 *
	 * @return string Widget title.
	 * @since  1.0.0
	 * @access public
	 *
	 */
	public function get_title() {
		return __( 'APR Counter', 'apr-core' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve counter widget icon.
	 *
	 * @return string Widget icon.
	 * @since  1.0.0
	 * @access public
	 *
	 */
	public function get_icon() {
		return 'eicon-counter-circle';
	}

	/**
	 * Register counter widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_counter',
			[
				'label' => __( 'APR Counter', 'apr-core' ),
			]
		);
		$this->add_control(
			'counter_type',
			[
				'label'   => __( 'Counter Type', 'apr-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'type1',
				'options' => [
					'type1' => __( 'Type 1', 'apr-core' ),
				],
			]
		);
		$this->add_control(
			'horizontal_enable',
			[
				'label'   => esc_html__( 'Content Is Centered Horizontally', 'apr-core' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
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
					'{{WRAPPER}} .elementor-counter'                          => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .elementor-counter .elementor-counter-title' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'horizontal_enable!' => 'yes',
				],
			]
		);
		$this->add_control(
			'icon_counter',
			[
				'label'     => __( 'Icon', 'apr-core' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'icon-cloud-computing',
				'condition' => [
					'counter_type' => 'type1',
				],
			]
		);
		$this->add_control(
			'starting_number_type',
			[
				'label'     => __( 'Starting Number', 'apr-core' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 0,
				'condition' => [
					'counter_type' => 'type1',
				],
			]
		);
		$this->add_control(
			'ending_number_type',
			[
				'label'     => __( 'Ending Number', 'apr-core' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 100,
				'condition' => [
					'counter_type' => 'type1',
				],
			]
		);
		$this->add_control(
			'title_type1',
			[
				'label'     => __( 'Title', 'apr-core' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Members', 'apr-core' ),
				'condition' => [
					'counter_type' => 'type1',
				],
			]
		);
		$this->add_control(
			'counter_duration',
			[
				'label'   => __( 'Animation Duration', 'apr-core' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 2000,
				'min'     => 100,
				'step'    => 100,
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_responsive_control(
			'counter_width',
			[
				'label'      => __( 'Max width', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .box-counter' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'box_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .box-counter' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label'      => esc_html__( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .box-counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'margin_padding',
			[
				'label'      => esc_html__( 'Margin', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .box-counter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		//Number
		$this->start_controls_section(
			'section_number',
			[
				'label' => __( 'Number', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'number_padding',
			[
				'label'      => esc_html__( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-counter-number-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'number_margin',
			[
				'label'      => esc_html__( 'Margin', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-counter-number-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'number_color',
			[
				'label'     => __( 'Text Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-counter-number-wrapper' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_number',

				'selector' => '{{WRAPPER}} .elementor-counter-number-wrapper',
			]
		);

		$this->add_control(
			'border_color_number',
			[
				'label'     => __( 'Border Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-counter-number-wrapper' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'horizontal_enable' => 'yes',
				],
			]
		);

		$this->end_controls_section();
		//Title
		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Title', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label'      => esc_html__( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-counter-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label'      => esc_html__( 'Margin', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-counter-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Text Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-counter-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_title',

				'selector' => '{{WRAPPER}} .elementor-counter-title',
			]
		);
		$this->end_controls_section();
		//Icon
		$this->start_controls_section(
			'section_icon',
			[
				'label'     => __( 'Icon', 'apr-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'counter_type' => 'type1',
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
					'{{WRAPPER}} .icon-counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_margin',
			[
				'label'      => esc_html__( 'Margin', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .icon-counter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'icon_bg',
			[
				'label'     => esc_html__( 'Background Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .icon-counter' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label'     => __( 'Text Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-counter' => 'color: {{VALUE}};',
				],
				'condition' => [
					'counter_type' => 'type1',
				],
			]
		);
		$this->add_control(
			'icon_size',
			[
				'label'      => __( 'Font size', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'size_units' => [ 'px' ],
				'default'    => [
					'size' => '',
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .icon-counter' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'counter_type' => 'type1',
				],
			]
		);
		$this->add_control(
			'icon_line_height',
			[
				'label'      => __( 'Line Height', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'size_units' => [ 'em', 'px' ],
				'default'    => [
					'size' => '',
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .icon-counter' => 'line-height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'counter_type' => 'type1',
				],
			]
		);
		$this->end_controls_section();
		//Border
		$this->start_controls_section(
			'section_border',
			[
				'label'     => __( 'Border', 'apr-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'counter_type' => 'type1',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'border',
				'selector' => '{{WRAPPER}} .content-counter',
			]
		);

		$this->add_responsive_control(
			'border_radius',
			[
				'label'      => __( 'Border Radius', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .content-counter' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		//Hover
		$this->start_controls_section(
			'section_box_hover',
			[
				'label'     => __( 'Box hover', 'apr-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'counter_type' => 'type1',
				],
			]
		);
		$this->add_control(
			'icon_color_hover',
			[
				'label'     => __( 'Icon Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .box-counter .icon-counter' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_color_hover',
			[
				'label'     => __( 'Title Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .elementor-counter-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'number_color_hover',
			[
				'label'     => __( 'Number Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .elementor-counter-number-wrapper' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$this->apr_sc_counter();
		$settings   = $this->get_settings_for_display();
		$type_count = $settings['counter_type'];
		$id         = 'apr-counter-' . wp_rand();
		if ( $type_count === 'type1' ) {
			$this->add_render_attribute( 'counter', [
				'class'      => 'elementor-counter-number',
				'data-count' => $settings['ending_number_type'],
			] );
		}
		$horizontal_enable = '';
		if ( $settings['horizontal_enable'] == 'yes' ) {
			$horizontal_enable = 'horizontal_enable';
		}
		?>
		<div id="<?php echo esc_attr( $id ); ?>"
			 class="elementor-counter counter-<?php echo esc_attr( $settings['counter_type'] ); ?> <?php echo $horizontal_enable; ?>">
			<div class="box-counter">
				<?php if ( $settings['icon_counter'] ) : ?>
					<div class="icon-counter">
						<i class="<?php echo $settings['icon_counter']; ?>" aria-hidden="true"></i>
					</div>
				<?php endif; ?>
				<div class="content-counter">
					<div class="elementor-counter-number-wrapper">
						<span <?php echo $this->get_render_attribute_string( 'counter' ); ?>><?php echo $settings['starting_number_type']; ?></span>
					</div>
					<?php if ( $settings['title_type1'] ) : ?>
						<div class="elementor-counter-title"><?php echo $settings['title_type1']; ?></div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<script>
			jQuery(document).ready(function ($) {
				$('#<?php echo esc_js( $id );?>.counter-type1 .elementor-counter-number').each(function () {
					var $this = $(this),
						countTo = $this.attr('data-count');
					if (countTo >= 10) {
						$({countNum: $this.text()}).animate({
								countNum: countTo
							},
							{
								duration: <?php echo esc_attr( $settings['counter_duration'] );?>,
								easing  : 'linear',
								step    : function () {
									$this.text(Math.floor(this.countNum));
								},
								complete: function () {
									$this.text(this.countNum);
								}
							});
					} else {
						$({countNum: $this.text()}).animate({
								countNum: countTo
							},
							{
								duration: <?php echo esc_attr( $settings['counter_duration'] );?>,
								easing  : 'linear',
								step    : function () {
									$this.text('0' + Math.floor(this.countNum));
								},
								complete: function () {
									$this.text('0' + this.countNum);
								}
							});
					}
				});
			});
		</script>
		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Apr_Core_Counter );
