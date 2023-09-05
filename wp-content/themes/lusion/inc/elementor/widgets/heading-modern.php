<?php

namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Apr_Core_Heading extends Widget_Base {

	public function apr_sc_heading_modern() {
		/* Import Css */
		if ( is_rtl() ) {
			wp_enqueue_style( 'apr-sc-heading-modern', LUSION_CSS . '/elementor/heading-modern-rtl.css', array(), LUSION_THEME_VERSION );
		} else {
			wp_enqueue_style( 'apr-sc-heading-modern', LUSION_CSS . '/elementor/heading-modern.css', array(), LUSION_THEME_VERSION );
		}
	}

	/* Get widget name */
	public function get_name() {
		return 'apr_modern_heading';
	}

	/* Get widget title */
	public function get_title() {
		return __( 'APR Heading', 'apr-core' );
	}

	/* Get widget icon */
	public function get_icon() {
		return 'eicon-heading apr-badge';
	}

	/* Get widget categories */
	public function get_categories() {
		return array( 'apr-core' );
	}

	/* Register 'Heading' widget controls*/
	protected function register_controls() {
		/*-----------------------------------------------------------------------------------*/
		/*  Content TAB
		/*-----------------------------------------------------------------------------------*/
		$this->start_controls_section(
			'title_section',
			array(
				'label' => __( 'APR Heading', 'apr-core' ),
			)
		);
		/* Heading 1*/
		$this->add_control(
			'title',
			array(
				'label'       => __( 'Title', 'apr-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => array(
					'active' => true
				),
				'placeholder' => __( 'Enter your title', 'apr-core' ),
				'default'     => __( 'Enter your title', 'apr-core' ),
				'label_block' => true,
			)
		);
		$this->add_control(
			'heading_size',
			array(
				'label'   => __( 'HTML Tag', 'apr-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'h1' => __( 'H1', 'apr-core' ),
					'h2' => __( 'H2', 'apr-core' ),
					'h3' => __( 'H3', 'apr-core' ),
					'h4' => __( 'H4', 'apr-core' ),
					'h5' => __( 'H5', 'apr-core' ),
					'p'  => __( 'p', 'apr-core' ),
				),
				'default' => 'h3',
			)
		);
		$this->add_control(
			'link',
			[
				'label'     => __( 'Link', 'elementor' ),
				'type'      => Controls_Manager::URL,
				'dynamic'   => [
					'active' => true,
				],
				'default'   => [
					'url' => '',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'alignment',
			array(
				'label'     => __( 'Alignment', 'apr-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => '',
				'options'   => array(
					'left'   => array(
						'title' => __( 'Left', 'apr-core' ),
						'icon'  => 'fa fa-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'apr-core' ),
						'icon'  => 'fa fa-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'apr-core' ),
						'icon'  => 'fa fa-align-right',
					)
				),
				'selectors' => [
					'{{WRAPPER}} .heading-modern' => 'text-align: {{VALUE}};',
				],
			)
		);
		$this->add_control(
			'description',
			array(
				'label'   => __( 'Description', 'apr-core' ),
				'type'    => Controls_Manager::TEXTAREA,
				'dynamic' => array(
					'active' => true
				),
			)
		);
		$this->add_control(
			'description_position',
			[
				'label'   => __( 'Description Position', 'apr-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'bottom',
				'options' => [
					'aside'  => __( 'Aside', 'apr-core' ),
					'bottom' => __( 'Bottom', 'apr-core' ),
				],
			]
		);
		$this->add_control(
			'list_divider',
			[
				'label'     => __( 'Divider', 'apr-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'divider_position',
			[
				'label'     => __( 'Position', 'apr-core' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'top'    => __( 'Top', 'apr-core' ),
					'bottom' => __( 'Bottom', 'apr-core' )
				],
				'default'   => 'bottom',
				'condition' => [
					'list_divider' => 'yes',
				]
			]
		);

		$this->add_control(
			'divider_color',
			[
				'label'     => __( 'Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'condition' => [
					'list_divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .heading-title:before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'divider_color_hover',
			[
				'label'     => __( 'Color Hover', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'condition' => [
					'list_divider' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .heading-title:hover:before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'divider_top',
			[
				'label'      => __( 'Top Space', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'size' => '',
					'unit' => 'px',
				],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'size_units' => [ 'px' ],
				'condition'  => [
					'list_divider' => 'yes',
				],
				'selectors'  => [
					'{{WRAPPER}} .heading-title:before' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'divider_left',
			[
				'label'      => __( 'Left Space', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'size' => '',
					'unit' => 'px',
				],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'size_units' => [ 'px' ],
				'condition'  => [
					'list_divider' => 'yes',
				],
				'selectors'  => [
					'{{WRAPPER}} .heading-title:before' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'divider_weight',
			[
				'label'      => __( 'Height', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'size' => 1,
					'unit' => 'px',
				],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ '%', 'px' ],
				'condition'  => [
					'list_divider' => 'yes',
				],
				'selectors'  => [
					'{{WRAPPER}} .heading-title:before' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'divider_width',
			[
				'label'      => __( 'Width', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'condition'  => [
					'list_divider' => 'yes',
				],
				'default'    => [
					'size' => 100,
					'unit' => 'px',
				],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ '%', 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .heading-title:before' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		/*-----------------------------------------------------------------------------------*/
		/*  Style TAB
		/*-----------------------------------------------------------------------------------*/
		$this->start_controls_section(
			'title_style_section',
			array(
				'label' => __( 'Color', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'{{WRAPPER}} .heading-modern .heading-title,
                    {{WRAPPER}} .heading-modern .heading-title a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'desc_color',
			[
				'label'     => __( 'Description color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .heading-modern .description' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'desc_style',
			array(
				'label' => __( 'Typography', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => __( 'Title', 'apr-core' ),
				'selector' => '{{WRAPPER}} .heading-modern .heading-title',
			]
		);
		$this->add_responsive_control(
			'title_space',
			array(
				'label'      => __( 'Spacing', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
					'px' => array(
						'min'  => 1,
						'max'  => 1600,
						'step' => 5
					)
				),
				'selectors'  => array(
					'{{WRAPPER}} .heading-modern .heading-title' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				),
			)
		);
		$this->add_responsive_control(
			'title_width',
			array(
				'label'      => __( 'Max width Title', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
					'px' => array(
						'min'  => 1,
						'max'  => 1600,
						'step' => 5
					)
				),
				'selectors'  => array(
					'{{WRAPPER}} .heading-modern .heading-title' => 'max-width:{{SIZE}}{{UNIT}};'
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'  => 'desc_typo',
				'label' => __( 'Description', 'apr-core' ),

				'selector' => '{{WRAPPER}} .heading-modern .description',
			]
		);
		$this->add_responsive_control(
			'desc_width',
			array(
				'label'      => __( 'Max width Description', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
					'px' => array(
						'min'  => 1,
						'max'  => 1600,
						'step' => 5
					)
				),
				'selectors'  => array(
					'{{WRAPPER}} .heading-modern .description' => 'max-width:{{SIZE}}{{UNIT}};'
				),
			)
		);
		$this->add_responsive_control(
			'title_margin',
			array(
				'label'              => __( 'Margin Title', 'apr-core' ),
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
					'{{WRAPPER}} .heading-modern .heading-title' => 'margin-top: {{TOP}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
				],
			)
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label'      => __( 'Padding Title', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .heading-modern .heading-title' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);
		$this->add_responsive_control(
			'desc_margin',
			array(
				'label'              => __( 'Margin Description', 'apr-core' ),
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
					'{{WRAPPER}} .heading-modern .description' => 'margin-top: {{TOP}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
				],
			)
		);
		$this->add_responsive_control(
			'description_padding',
			[
				'label'      => __( 'Padding Description', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .heading-modern .description' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);
		$this->add_control(
			'title_color_hover',
			[
				'label' => __( 'Title Color Hover', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'{{WRAPPER}} .heading-modern .heading-title:hover,
                    {{WRAPPER}} .heading-modern .heading-title a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'desc_color_hover',
			[
				'label' => __( 'Description Color Hover', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'{{WRAPPER}} .heading-modern .description:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$this->apr_sc_heading_modern();
		$settings = $this->get_settings_for_display();
		// $alignment       =   $settings['alignment'];
		// $alignment_class= '';
		$title            = $settings['title'];
		$divider_position = $settings['divider_position'];
		// if ($alignment === 'center') {
		//     $alignment_class = 'center';
		// }elseif ($alignment === 'right') {
		//     $alignment_class = 'right';
		// }else{
		//     $alignment_class = 'left';
		// }
		$this->add_render_attribute( 'title', 'class', 'heading-title' );
		if ( $settings['description_position'] ) {
			$this->add_render_attribute( 'position', 'class', 'description-position-' . $settings['description_position'] );
		}
		$id = 'apr-heading-' . wp_rand();
		?>
		<div id="<?php echo esc_attr( $id ); ?>" class="heading-modern <?php echo esc_attr( $divider_position ); ?>">
			<div <?php echo $this->get_render_attribute_string( 'position' ); ?>>
				<?php
				if ( ! empty( $settings['title'] ) ) :
					$this->add_inline_editing_attributes( 'title' );
					if ( ! empty( $settings['link']['url'] ) ) {
						$this->add_render_attribute( 'url', 'href', $settings['link']['url'] );

						if ( $settings['link']['is_external'] ) {
							$this->add_render_attribute( 'url', 'target', '_blank' );
						}

						if ( ! empty( $settings['link']['nofollow'] ) ) {
							$this->add_render_attribute( 'url', 'rel', 'nofollow' );
						}

						$title = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $title );
					}
					$title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['heading_size'], $this->get_render_attribute_string( 'title' ), $title );
					echo $title_html;
				endif;
				if ( ! empty( $settings['description'] ) ) {
					printf(
						'<p class="description">%s</p>',
						$settings['description']
					);
				};
				?>
			</div>
		</div>
		<?php
	}

}

Plugin::instance()->widgets_manager->register( new Apr_Core_Heading );
