<?php

namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Apr_Core_Countdown extends Widget_Base {

	public function apr_sc_countdown() {
		/* Import Css */
		if ( is_rtl() ) {
			wp_enqueue_style( 'countdown-css-rtl', LUSION_CSS . '/elementor/countdown-rtl.css', array(), LUSION_THEME_VERSION );
		} else {
			wp_enqueue_style( 'countdown-css', LUSION_CSS . '/elementor/countdown.css', array(), LUSION_THEME_VERSION );
		}
	}

	public function get_name() {
		return 'apr_countdown';
	}

	public function get_title() {
		return __( 'APR Countdown', 'apr-core' );
	}

	public function get_icon() {
		return 'eicon-countdown apr-badge';
	}

	public function get_categories() {
		return array( 'apr-core' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'ctw_section',
			[
				'label' => __( 'Countdown', 'apr-core' ),
			]
		);
		$this->add_control(
			'ctw_due_date',
			[
				'label'       => __( 'Due Date', 'apr-core' ),
				'type'        => Controls_Manager::DATE_TIME,
				'default'     => date( 'Y/m/d H:i', strtotime( '+1 month' ) + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ) ),
				'description' => sprintf( __( 'Date set according to your timezone: %s.', 'apr-core' ), Utils::get_timezone_string() ),

			]
		);
		$this->add_control(
			'ctw_show_days',
			[
				'label'        => __( 'Days', 'apr-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'apr-core' ),
				'label_off'    => __( 'Hide', 'apr-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'ctw_show_hours',
			[
				'label'        => __( 'Hours', 'apr-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'apr-core' ),
				'label_off'    => __( 'Hide', 'apr-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'ctw_show_minutes',
			[
				'label'        => __( 'Minutes', 'apr-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'apr-core' ),
				'label_off'    => __( 'Hide', 'apr-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'ctw_show_seconds',
			[
				'label'        => __( 'Secs', 'apr-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'apr-core' ),
				'label_off'    => __( 'Hide', 'apr-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'ctw_label_text_section',
			[
				'label' => __( 'Change Labels Text', 'apr-core' )
			]
		);
		$this->add_control(
			'ctw_change_labels',
			[
				'label'        => __( 'Change Labels', 'apr-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'apr-core' ),
				'label_off'    => __( 'No', 'apr-core' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);
		$this->add_control(
			'ctw_label_days',
			[
				'label'       => __( 'Days', 'apr-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Days', 'apr-core' ),
				'placeholder' => __( 'Days', 'apr-core' ),
				'condition'   => [
					'ctw_change_labels' => 'yes',
					'ctw_show_days'     => 'yes',
				],
			]
		);
		$this->add_control(
			'ctw_label_hours',
			[
				'label'       => __( 'Hours', 'apr-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Hours', 'apr-core' ),
				'placeholder' => __( 'Hours', 'apr-core' ),
				'condition'   => [
					'ctw_change_labels' => 'yes',
					'ctw_show_hours'    => 'yes',
				],
			]
		);
		$this->add_control(
			'ctw_label_minuts',
			[
				'label'       => __( 'Minutes', 'apr-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Minutes', 'apr-core' ),
				'placeholder' => __( 'Minutes', 'apr-core' ),
				'condition'   => [
					'ctw_change_labels' => 'yes',
					'ctw_show_minutes'  => 'yes',
				],
			]
		);
		$this->add_control(
			'ctw_label_seconds',
			[
				'label'       => __( 'Seconds', 'apr-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Seconds', 'apr-core' ),
				'placeholder' => __( 'Seconds', 'apr-core' ),
				'condition'   => [
					'ctw_change_labels' => 'yes',
					'ctw_show_seconds'  => 'yes',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_box_style',
			[
				'label' => __( 'Boxes', 'elementor-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'ctw_content_align',
			[
				'label'     => __( 'Alignment', 'apr-core' ),
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
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .apr-countdown' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'container_width',
			[
				'label'          => __( 'Container Width', 'apr-core' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => [
					'unit' => 'px',
					'size' => 130,
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'range'          => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units'     => [ '%', 'px' ],
				'selectors'      => [
					'{{WRAPPER}} .countdown-section' => 'max-width: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'container_height',
			[
				'label'          => __( 'Container Height', 'apr-core' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => [
					'unit' => 'px',
					'size' => 130,
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'range'          => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units'     => [ '%', 'px' ],
				'selectors'      => [
					'{{WRAPPER}} .countdown-section' => 'max-height: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'cd_image_background',
				'selector' => '{{WRAPPER}} .countdown-section',
			]
		);

		$this->add_control(
			'cd_num_bg_color',
			[
				'label'     => __( 'Number Background', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .countdown-section .countdown-number:before' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'box_border',
				'selector'  => '{{WRAPPER}} .countdown-section',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'box_border_radius',
			[
				'label'      => __( 'Border Radius', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .countdown-section'                          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .countdown-section .countdown-number:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0{{UNIT}} 0{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_spacing',
			[
				'label'          => __( 'Space Between', 'apr-core' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => [
					'unit' => 'px',
					'size' => 10,
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'range'          => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units'     => [ '%', 'px' ],
				'selectors'      => [
					'body:not(.rtl) {{WRAPPER}} .countdown-section' => 'margin-left: {{SIZE}}{{UNIT}} !important;margin-right: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' => __( 'Content', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_day',
			[
				'label' => __( 'Days background', 'apr-core' ),
				'type'  => Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'day_background',
				'selector' => '{{WRAPPER}} .day-countdown',
			]
		);
		$this->add_control(
			'heading_hours',
			[
				'label' => __( 'Hours background', 'apr-core' ),
				'type'  => Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'hours_background',
				'selector' => '{{WRAPPER}} .hours-countdown',
			]
		);
		$this->add_control(
			'heading_minute',
			[
				'label' => __( 'Minutes background', 'apr-core' ),
				'type'  => Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'minute_background',
				'selector' => '{{WRAPPER}} .minute-countdown',
			]
		);
		$this->add_control(
			'heading_secs',
			[
				'label' => __( 'Secs background', 'apr-core' ),
				'type'  => Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'second_background',
				'selector' => '{{WRAPPER}} .seconds-countdown',
			]
		);
		$this->add_control(
			'heading_digits',
			[
				'label' => __( 'Digits', 'apr-core' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_responsive_control(
			'digits_padding',
			[
				'label'      => __( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .countdown-section .countdown-number' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'digits_color',
			[
				'label'     => __( 'Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .countdown-section .countdown-number' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'digits_typography',
				'selector' => '{{WRAPPER}} .countdown-section .countdown-number',

			]
		);

		$this->add_control(
			'heading_label',
			[
				'label'     => __( 'Label', 'apr-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'label_padding',
			[
				'label'      => __( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .countdown-section .countdown-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'label_color',
			[
				'label'     => __( 'Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .countdown-section .countdown-label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'label_typography',
				'selector' => '{{WRAPPER}} .countdown-section .countdown-label',

			]
		);
		$this->add_control(
			'label_position',
			[
				'label'        => __( 'Label Position', 'apr-core' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => '',
				'options'      => [
					''         => __( 'Default', 'apr-core' ),
					'absolute' => __( 'Absolute', 'apr-core' ),
				],
				'prefix_class' => 'elementor-label-',
				'selectors'    => [
					'{{WRAPPER}} .countdown-section .countdown-label' => 'position: {{VALUE}};',
				],
			]
		);

		$start = is_rtl() ? __( 'Right', 'apr-core' ) : __( 'Left', 'apr-core' );
		$end   = ! is_rtl() ? __( 'Right', 'apr-core' ) : __( 'Left', 'apr-core' );

		$this->add_control(
			'label_offset_orientation_h',
			[
				'label'       => __( 'Horizontal Orientation', 'apr-core' ),
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
					'label_position!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'label_offset_x',
			[
				'label'      => __( 'Offset', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min'  => - 1000,
						'max'  => 1000,
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
				'size_units' => [ 'px', '%', 'vw', 'vh' ],
				'selectors'  => [
					'body:not(.rtl) {{WRAPPER}} .countdown-section .countdown-label' => 'left: {{SIZE}}{{UNIT}}',
					'body.rtl {{WRAPPER}} .countdown-section .countdown-label'       => 'right: {{SIZE}}{{UNIT}}',
				],
				'condition'  => [
					'label_offset_orientation_h!' => 'end',
					'label_position!'             => '',
				],
			]
		);

		$this->add_responsive_control(
			'label_offset_x_end',
			[
				'label'      => __( 'Offset', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min'  => - 1000,
						'max'  => 1000,
						'step' => 0.1,
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
				'size_units' => [ 'px', '%', 'vw', 'vh' ],
				'selectors'  => [
					'body:not(.rtl) {{WRAPPER}} .countdown-section .countdown-label' => 'right: {{SIZE}}{{UNIT}}',
					'body.rtl {{WRAPPER}} .countdown-section .countdown-label'       => 'left: {{SIZE}}{{UNIT}}',
				],
				'condition'  => [
					'label_offset_orientation_h' => 'end',
					'label_position!'            => '',
				],
			]
		);

		$this->add_control(
			'label_offset_orientation_v',
			[
				'label'       => __( 'Vertical Orientation', 'apr-core' ),
				'type'        => Controls_Manager::CHOOSE,
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
					'label_position!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'label_offset_y',
			[
				'label'      => __( 'Offset', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min'  => - 1000,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => - 200,
						'max' => 200,
					],
					'vh' => [
						'min' => - 200,
						'max' => 200,
					],
					'vw' => [
						'min' => - 200,
						'max' => 200,
					],
				],
				'size_units' => [ 'px', '%', 'vh', 'vw' ],
				'default'    => [
					'size' => '0',
				],
				'selectors'  => [
					'{{WRAPPER}} .countdown-section .countdown-label' => 'top: {{SIZE}}{{UNIT}}',
				],
				'condition'  => [
					'label_offset_orientation_v!' => 'end',
					'label_position!'             => '',
				],
			]
		);

		$this->add_responsive_control(
			'label_offset_y_end',
			[
				'label'      => __( 'Offset', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min'  => - 1000,
						'max'  => 1000,
						'step' => 1,
					],
					'%'  => [
						'min' => - 200,
						'max' => 200,
					],
					'vh' => [
						'min' => - 200,
						'max' => 200,
					],
					'vw' => [
						'min' => - 200,
						'max' => 200,
					],
				],
				'size_units' => [ 'px', '%', 'vh', 'vw' ],
				'default'    => [
					'size' => '0',
				],
				'selectors'  => [
					'{{WRAPPER}} .countdown-section .countdown-label' => 'bottom: {{SIZE}}{{UNIT}}',
				],
				'condition'  => [
					'label_offset_orientation_v' => 'end',
					'label_position!'            => '',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$this->apr_sc_countdown();
		$settings      = $this->get_settings();
		$day           = $settings['ctw_show_days'];
		$hours         = $settings['ctw_show_hours'];
		$minute        = $settings['ctw_show_minutes'];
		$seconds       = $settings['ctw_show_seconds'];
		$lusion_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_register_script( 'countdown-scripts', get_template_directory_uri() . '/assets/js/jquery.countdown' . esc_html( $lusion_suffix ) . '.js', array( 'jquery' ), LUSION_THEME_VERSION, true );
		wp_enqueue_script( 'countdown-scripts' );
		?>

		<div class="apr-countdown">
			<div id="clock-<?php echo esc_attr( $this->get_id() ); ?>" class="countdown_container"></div>
		</div>
		<script>
			jQuery(document).ready(function ($) {
				jQuery("#clock-<?php echo esc_attr( $this->get_id() ); ?>").countdown('<?php echo $settings["ctw_due_date"];?>', function (event) {
					var $this = jQuery(this).html(event.strftime(''
						+ '<?php if ($day == "yes"){?><div class="countdown-section day-countdown"><div class="countdown-number"><span>%D</span></div><div class="countdown-label"><?php echo $settings["ctw_label_days"]; ?></div></div><?php } ?>'
						+ '<?php if ($hours == "yes"){?><div class="countdown-section hours-countdown"><div class="countdown-number"><span>%H</span></div><div class="countdown-label"><?php echo $settings["ctw_label_hours"]; ?></div></div><?php } ?>'
						+ '<?php if ($minute == "yes"){?><div class="countdown-section minute-countdown"><div class="countdown-number"><span>%M</span></div><div class="countdown-label"><?php echo $settings["ctw_label_minuts"]; ?></div></div><?php } ?>'
						+ '<?php if ($seconds == "yes"){?><div class="countdown-section seconds-countdown"><div class="countdown-number"><span>%S</span></div><div class="countdown-label"><?php echo $settings["ctw_label_seconds"]; ?></div></div><?php } ?>'));
				});
			})
		</script>
		<?php
	}

	/**
	 * Render countdown widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @access protected
	 */
	protected function content_template() {

	}

}

Plugin::instance()->widgets_manager->register( new Apr_Core_Countdown );
