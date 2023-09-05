<?php

namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Apr_Core_MailChimp extends Widget_Base {

	public function apr_sc_mailchimp() {
		/* Import Css */
		if ( is_rtl() ) {
			wp_enqueue_style( 'apr-sc-mailchimp', LUSION_CSS . '/elementor/mailchimp-rtl.css', array(), LUSION_THEME_VERSION );
		} else {
			wp_enqueue_style( 'apr-sc-mailchimp', LUSION_CSS . '/elementor/mailchimp.css', array(), LUSION_THEME_VERSION );
		}
	}

	public function get_name() {
		return 'apr_mailchimp';
	}

	public function get_title() {
		return __( 'APR MailChimp', 'apr-core' );
	}


	public function get_icon() {
		return 'eicon-mailchimp apr-badge';
	}

	public function get_categories() {
		return array( 'apr-core' );
	}

	public function get_forms() {
		$options = array( 0 => __( 'Select the form to show', 'apr-core' ) );

		if ( ! function_exists( 'mc4wp_get_forms' ) ) {
			return $options;
		}

		$forms = mc4wp_get_forms();
		foreach ( $forms as $form ) {
			$options[$form->ID] = $form->name;
		}

		return $options;
	}

	protected function register_controls() {

		/*-----------------------------------------------------------------------------------*/
		/*  Content TAB
		/*-----------------------------------------------------------------------------------*/

		$this->start_controls_section(
			'forms_section',
			array(
				'label' => __( 'Form', 'apr-core' ),
			)
		);

		$this->add_control(
			'form_type',
			array(
				'label'        => __( 'Form Type', 'apr-core' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'default',
				'options'      => array(
					'default' => __( 'Defaults', 'apr-core' ),
					'type1'   => __( 'Type 1', 'apr-core' ),
					'type2'   => __( 'Type 2', 'apr-core' ),
					'type3'   => __( 'Type 3', 'apr-core' ),
					'type4'   => __( 'Type 4', 'apr-core' ),
					'custom'  => __( 'Custom', 'apr-core' )
				),
				'prefix_class' => 'mail-chimp-',
			)
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
				'default'     => __( '', 'apr-core' ),
			]
		);
		$this->add_control(
			'description',
			[

				'label'       => __( 'Description', 'apr-core' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 'Enter Description',
				'dynamic'     => [
					'active' => true,
				],
				'default'     => __( '', 'apr-core' ),
			]
		);
		$this->add_responsive_control(
			'top_form_align',
			[
				'label'     => __( '  Title Text Alignment ', 'apr-core' ),
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
					'{{WRAPPER}} .top-form' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'form_max_width',
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
					'{{WRAPPER}}.elementor-widget-apr_mailchimp' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'form_id',
			array(
				'label'       => __( 'MailChimp Sign-Up Form', 'apr-core' ),
				'label_block' => true,
				'type'        => Controls_Manager::SELECT,
				'default'     => 0,
				'options'     => $this->get_forms(),
				'condition'   => array(
					'form_type' => array( 'default' )
				),
			)
		);

		$this->add_control(
			'html',
			array(
				'label'       => __( 'Custom Form', 'apr-core' ),
				'type'        => Controls_Manager::CODE,
				'language'    => 'html',
				'description' => __( 'Enter your custom form markup', 'apr-core' ),
				'condition'   => array(
					'form_type' => array( 'custom' )
				)
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			array(
				'label' => __( 'Style', 'apr-core' ),
			)
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title form', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .top-form .title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => __( 'Typography title form', 'apr-core' ),
				'name'  => 'title_typography',

				'selector' => '{{WRAPPER}} .top-form .title',
			]
		);
		$this->add_responsive_control(
			'title_margin_bottom',
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
					'{{WRAPPER}} .top-form .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Description Color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'{{WRAPPER}} .top-form .description' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => __( 'Typography description form', 'apr-core' ),
				'name'  => 'desc_typography',

				'selector' => '{{WRAPPER}} .top-form .description',
			]
		);
		$this->add_responsive_control(
			'margin-top-form',
			[
				'label'      => esc_html__( 'Margin top form', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .top-form' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'input_color',
			[
				'label' => __( 'Input color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .mc4wp-form-fields input[type=email], 
                    {{WRAPPER}}  .mc4wp-form-fields input[type=email]::placeholder,
                    {{WRAPPER}} .mc4wp-form-fields .type-email,
                    {{WRAPPER}} .mc4wp-form-fields .type-email::placeholder
                    ' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => __( 'Typography Input', 'apr-core' ),
				'name'  => 'input_email_typography',

				'selector' => '{{WRAPPER}} .mc4wp-form-fields input[type=email],{{WRAPPER}} .mc4wp-form-fields .type-email',
			]
		);
		$this->add_responsive_control(
			'input_height',
			[
				'label'     => __( 'Input height', 'apr-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .mc4wp-form-fields input[type=email],{{WRAPPER}} .mc4wp-form-fields .type-email' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'input_padding',
			[
				'label'      => __( 'padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .mc4wp-form-fields input[type=email],{{WRAPPER}} .mc4wp-form-fields .type-email' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'input_border_color',
			[
				'label' => __( 'Border input color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .mc4wp-form-fields input[type=email],{{WRAPPER}} .mc4wp-form-fields .type-email' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'border_width_input_size',
			[
				'label'      => __( 'Border Width Input', 'apr-core' ),
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
					'{{WRAPPER}} .mc4wp-form-fields input[type=email],{{WRAPPER}} .mc4wp-form-fields .type-email' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'input_bg_color',
			[
				'label' => __( 'Background input color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .mc4wp-form-fields input[type=email],{{WRAPPER}} .mc4wp-form-fields .type-email' => 'background-color: {{VALUE}};',
				],
				'condition' => array(
					'form_type' => array( 'type2', 'default', 'type4' )
				),
			]
		);
		$this->add_responsive_control(
			'btn_height',
			[
				'label'     => __( 'Button height', 'apr-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}}  .mc4wp-form-fields input[type=submit]' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => __( 'Typography Button', 'apr-core' ),
				'name'  => 'input_btn_typography',

				'selector' => '{{WRAPPER}} .mc4wp-form-fields input[type=submit],
                {{WRAPPER}} .mc4wp-form-fields:before',
			]
		);
		$this->add_responsive_control(
			'btn_padding',
			[
				'label'      => __( 'Button padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .mc4wp-form-fields input[type=submit]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .mc4wp-form-fields:before'             => 'right:  {{RIGHT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'tab_button' );
		$this->start_controls_tab(
			'tab_btn',
			[
				'label' => __( 'Normal', 'apr-core' ),
			]
		);
		$this->add_control(
			'btn_color',
			[
				'label' => __( 'Button color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .mc4wp-form-fields input[type=submit], 
                    {{WRAPPER}} .mc4wp-form-fields:before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'btn_bg_color',
			[
				'label' => __( 'Bacground Button color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .mc4wp-form-fields input[type=submit]' => 'background-color: {{VALUE}};',
				],
				'condition' => array(
					'form_type' => array( 'type2', 'default', 'type3', 'type4' )
				),
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'button_border',
				'selector' => '{{WRAPPER}} .mc4wp-form-fields input[type=submit]',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_btn_hover',
			[
				'label' => __( 'Hover', 'apr-core' ),
			]
		);
		$this->add_control(
			'btn_hover_color',
			[
				'label' => __( 'Button hover color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .mc4wp-form-fields input[type=submit]:hover' => 'color: {{VALUE}};',
				],
				'condition' => array(
					'form_type' => array( 'type2', 'default', 'type3' )
				),
			]
		);

		$this->add_control(
			'btn_bg_hover_color',
			[
				'label' => __( 'Bacground Hover Button color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .mc4wp-form-fields input[type=submit]:hover' => 'background: {{VALUE}};',
				],
				'condition' => array(
					'form_type' => array( 'type2', 'default', 'type3', 'type4' )
				),
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'button_hover_border',
				'selector' => '{{WRAPPER}} .mc4wp-form-fields input[type=submit]:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tab();
		$this->end_controls_section();
	}

	public function custom_form( $content ) {
		$settings = $this->get_settings_for_display();

		if ( ! empty( $settings['html'] ) ) {
			$content = $settings['html'];
		}

		return $content;
	}

	protected function render() {
		$this->apr_sc_mailchimp();
		// Check whether required resources are available
		if ( ! function_exists( 'mc4wp_show_form' ) ) {
			$this->apr_elementor_plugin_missing_notice( array( 'plugin_name' => __( 'MailChimp', 'apr-core' ) ) );

			return;
		}

		$settings    = $this->get_settings_for_display();
		$title       = $settings['title'];
		$description = $settings['description'];

		if ( ( ! empty( $title ) ) || ( ! empty( $description ) ) ) {
			?>
			<div class="top-form">
				<?php if ( ! empty( $title ) ) { ?>
					<h3 class="title">
						<?php echo $title; ?>
					</h3>
				<?php }
				if ( ! empty( $description ) ) {
					?>
					<p class="description">
						<?php echo $description; ?>
					</p>
				<?php } ?>
			</div>
		<?php }
		if ( $settings['form_type'] === 'custom' ) {
			add_filter( 'mc4wp_form_content', array( $this, 'custom_form' ), 10, 1 );
			$settings['form_id'] = 0;
		}

		return mc4wp_show_form( $settings['form_id'] );
	}

	public function apr_elementor_plugin_missing_notice( $args ) {
		// default params
		$defaults = array(
			'plugin_name' => '',
			'echo'        => true
		);
		$args     = wp_parse_args( $args, $defaults );

		ob_start();
		?>
		<div class="elementor-alert elementor-alert-danger" role="alert">
            <span class="elementor-alert-title">
                <?php echo sprintf( esc_html__( '"%s" Plugin is Not Activated!', 'apr-core' ), $args['plugin_name'] ); ?>
            </span>
			<span class="elementor-alert-description">
                <?php esc_html_e( 'In order to use this element, you need to install and activate this plugin.', 'apr-core' ); ?>
            </span>
		</div>
		<?php
		$notice = ob_get_clean();

		if ( $args['echo'] ) {
			echo $notice;
		} else {
			return $notice;
		}
	}
}

Plugin::instance()->widgets_manager->register( new Apr_Core_MailChimp );
