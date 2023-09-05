<?php

namespace Elementor;

use Lusion_Templates;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Apr_Core_Search_Mobile extends Widget_Base {

	public function get_name() {
		return 'apr-search-mobile';
	}

	public function get_title() {
		return __( 'APR Search Mobile', 'apr-core' );
	}

	public function get_icon() {
		return 'eicon-search';
	}

	public function get_categories() {
		return [ 'apr-core' ];
	}

	protected function register_controls() {
		//Search form config
		$this->start_controls_section(
			'search_config',
			[
				'label' => __( 'Icon Search', 'apr-core' ),
			]
		);

		$this->add_control(
			'icon_skin',
			[
				'label'   => __( 'Choose Icon', 'apr-core' ),
				'type'    => Controls_Manager::ICON,
				'default' => 'theme-icon-magnifying-glass'
			]
		);
		$this->add_responsive_control(
			'icon_align',
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
					'{{WRAPPER}} .btn-search.toggle-search' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'style_icon',
			[
				'label' => __( 'Style', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_icon',
			[
				'label' => __( 'Color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .btn-search.toggle-search' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_hover_color',
			[
				'label' => __( 'Hover Color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .btn-search.toggle-search:hover' => 'color: {{VALUE}};',
				],

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
					'{{WRAPPER}} .btn-search.toggle-search i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_padding',
			[
				'label'      => __( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .btn-search.toggle-search' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .btn-search.toggle-search' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
		?>
		<div class="apr-searchmobile btn-search toggle-search">
			<i class="<?php echo $settings['icon_skin']; ?>" aria-hidden="true"></i>
		</div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Apr_Core_Search_Mobile );
