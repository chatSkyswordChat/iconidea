<?php

namespace Elementor;

use Lusion_Templates;
use WC_Cart;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Apr_Core_Social extends Widget_Base {
	public function apr_sc_socials() {
		/* Add css */
		if ( is_rtl() ) {
			wp_enqueue_style( 'apr-sc-socials', LUSION_CSS . '/elementor/socials-rtl.min.css', array(), LUSION_THEME_VERSION );
		} else {
			wp_enqueue_style( 'apr-sc-socials', LUSION_CSS . '/elementor/socials.min.css', array(), LUSION_THEME_VERSION );
		}
	}

	public function get_name() {
		return 'apr-social';
	}

	public function get_title() {
		return __( 'APR Social', 'apr-core' );
	}

	public function get_icon() {
		return 'eicon-favorite';
	}

	public function get_categories() {
		return [ 'apr-core' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'icon_social_config',
			[
				'label' => __( 'List Social', 'apr-core' ),
			]
		);
		$this->add_control(
			'show_title',
			[
				'label' => __( 'Show title', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'show_desc',
			[
				'label' => __( 'Show description', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
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
				'default'     => __( '', 'apr-core' ),
			]
		);
		$this->add_control(
			'desc',
			[

				'label'       => __( 'Desc', 'apr-core' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 'Enter description',
				'dynamic'     => [
					'active' => true,
				],
				'default'     => __( '', 'apr-core' ),
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
			'social_mastercard',
			[
				'label'       => __( 'Mastercard URL', 'apr-core' ),
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
			'social_visa',
			[
				'label'       => __( 'Visa URL', 'apr-core' ),
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
			'social_american',
			[
				'label'       => __( 'American URL', 'apr-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'apr-core' ),
				'label_block' => true,
				'default'     => [
					'url' => '',

					'is_external' => true,
				],
			]
		);
		$this->add_control(
			'social_paypal',
			[
				'label'       => __( 'Paypal URL', 'apr-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'apr-core' ),
				'label_block' => true,
				'default'     => [
					'url'         => '',
					'is_external' => true,
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'style_general',
			[
				'label' => __( 'General', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_control(
			'show_inline',
			[
				'label' => __( 'Show inline', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);
		$this->add_responsive_control(
			'align',
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
					'{{WRAPPER}} .list-social' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'style_title_social',
			[
				'label' => __( 'Title', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .list-social .title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => __( 'Typography', 'apr-core' ),
				'name'  => 'title_typography',

				'selector' => '{{WRAPPER}} .list-social .title',
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label'      => __( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .list-social .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'style_desc_social',
			[
				'label' => __( 'Desc', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .list-social .desc' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => __( 'Typography', 'apr-core' ),
				'name'  => 'desc_typography',

				'selector' => '{{WRAPPER}} .list-social .desc',
			]
		);
		$this->add_responsive_control(
			'desc_padding',
			[
				'label'      => __( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .list-social .desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'style_icon_social',
			[
				'label' => __( 'Icon', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'icon_font_size',
			[
				'label'     => __( ' Font Size', 'apr-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 14,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .list-social .socials li a' => 'font-size: {{SIZE}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label'     => __( 'Icon Size', 'apr-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .list-social .socials li a' => 'width: {{SIZE}}{{UNIT}};  height: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'icon_line_height',
			[
				'label'     => __( ' Line height', 'apr-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 14,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .list-social .socials li a' => 'line-height: {{SIZE}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'icon_padding',
			[
				'label'      => __( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .list-social .socials li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'margin-social',
			[
				'label'      => esc_html__( 'Margin', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .list-social .socials li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label'      => __( 'Border Radius', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .list-social .socials li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

			]
		);
		$this->start_controls_tabs(
			'tabs_icon_style'
		);
		$this->start_controls_tab(
			'tab_icon_normal',
			[
				'label' => __( 'Normal', 'apr-core' ),
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .list-social .socials li a' => 'color: {{VALUE}};',
				],

			]
		);
		$this->add_control(
			'icon_background',
			[
				'label' => __( 'Background', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .list-social .socials li a' => 'background: {{VALUE}};',
				],

			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'icon_border',
				'label'       => __( 'Border', 'apr-core' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .list-social .socials li a',
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
			'icon_hover_color',
			[
				'label' => __( 'Icon Color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .list-social .socials li a:hover' => 'color: {{VALUE}};',
				],

			]
		);
		$this->add_control(
			'icon_hover_background',
			[
				'label' => __( 'Background', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .list-social .socials li a:hover' => 'background: {{VALUE}};',
				],

			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'icon_hover_border',
				'label'       => __( 'Border', 'apr-core' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .list-social .socials li a :hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_section();
	}

	protected function render() {
		$this->apr_sc_socials();
		$settings     = $this->get_settings();
		$title        = $settings['title'];
		$desc         = $settings['desc'];
		$show_inline  = $settings['show_inline'];
		$icon_classes = [ 'list-social' ];
		if ( $show_inline == 'yes' ) {
			$icon_classes[] = 'social-inline';
		}
		$this->add_render_attribute( 'wrapper', [
			'class' => $icon_classes,
		] );
		?>
		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<?php if ( ! empty( $title ) ) { ?>
				<p class="title">
					<?php echo $title; ?>
				</p>
			<?php } ?>
			<?php if ( ! empty( $desc ) ) { ?>
				<p class="desc">
					<?php echo $desc; ?>
				</p>
			<?php } ?>
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
				<?php if ( ! empty( $settings['social_mastercard']['url'] ) ) : ?>
					<?php $target = $settings['social_mastercard']['is_external'] ? ' target="_blank"' : ''; ?>
					<li>
						<a href="<?php echo esc_url( $settings['social_mastercard']['url'] ); ?>"<?php echo $target; ?>><i
								class="theme-icon-mastercard"></i></a>
					</li>
				<?php endif; ?>
				<?php if ( ! empty( $settings['social_visa']['url'] ) ) : ?>
					<?php $target = $settings['social_visa']['is_external'] ? ' target="_blank"' : ''; ?>
					<li>
						<a href="<?php echo esc_url( $settings['social_visa']['url'] ); ?>"<?php echo $target; ?>><i
								class="theme-icon-visa-pay-logo"></i></a>
					</li>
				<?php endif; ?>
				<?php if ( ! empty( $settings['social_paypal']['url'] ) ) : ?>
					<?php $target = $settings['social_paypal']['is_external'] ? ' target="_blank"' : ''; ?>
					<li>
						<a href="<?php echo esc_url( $settings['social_paypal']['url'] ); ?>"<?php echo $target; ?>><i
								class="theme-icon-paypal"></i></a>
					</li>
				<?php endif; ?>
				<?php if ( ! empty( $settings['social_american']['url'] ) ) : ?>
					<?php $target = $settings['social_american']['is_external'] ? ' target="_blank"' : ''; ?>
					<li>
						<a href="<?php echo esc_url( $settings['social_american']['url'] ); ?>"<?php echo $target; ?>><i
								class="theme-icon-american-express-logo"></i></a>
					</li>
				<?php endif; ?>
			</ul>
		</div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Apr_Core_Social );
