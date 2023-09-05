<?php

namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( class_exists( 'WooCommerce' ) ) {
	class Apr_Core_Image360 extends Widget_Base {
		public function apr_sc_image360() {
			/* Add css */
			if ( is_rtl() ) {
				wp_enqueue_style( 'apr-sc-image360', LUSION_CSS . '/elementor/image360-rtl.css', array(), LUSION_THEME_VERSION );
			} else {
				wp_enqueue_style( 'apr-sc-image360', LUSION_CSS . '/elementor/image360.css', array(), LUSION_THEME_VERSION );
			}
			/* Import js */
			wp_enqueue_script( 'threesixty-script', LUSION_JS . '/elementor/threesixty.min.js', array() );
		}

		public function get_name() {
			return 'apr_image360';
		}

		public function get_title() {
			return esc_html__( 'APR Image 360', 'apr-core' );
		}

		public function get_icon() {
			return 'eicon-image';
		}

		public function get_categories() {
			return [ 'apr-core' ];
		}

		protected function register_controls() {
			$this->start_controls_section(
				'section_image',
				[
					'label' => esc_html__( 'Contents', 'apr-core' ),
				]
			);

			$this->add_control(
				'select_images_heading',
				[
					'label' => __( 'Images', 'apr-core' ),
					'type'  => Controls_Manager::HEADING,
				]
			);

			$this->add_control(
				'select_images',
				[
					'label'      => esc_html__( 'Add Images', 'apr-core' ),
					'type'       => Controls_Manager::GALLERY,
					'default'    => [],
					'show_label' => false,
					'dynamic'    => [
						'active' => true,
					],
				]
			);

			$this->add_control(
				'select_bg_images_heading',
				[
					'label'     => __( 'Background', 'apr-core' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'select_bg_image',
				[
					'label'   => __( 'Choose Background', 'apr-core' ),
					'type'    => Controls_Manager::MEDIA,
					'default' => [
						'url' => Utils::get_placeholder_image_src(),
					],
				]
			);

			$this->add_responsive_control(
				'background_position_y',
				[
					'label'      => esc_html__( 'Background Position', 'elementor' ),
					'type'       => Controls_Manager::SLIDER,
					'default'    => [
						'unit' => '%',
					],
					'size_units' => [ '%' ],
					'range'      => [
						'%' => [
							'min' => - 50,
							'max' => 50,
						],
					],
					'selectors'  => [
						'{{WRAPPER}} .threesixty-wrapper .nav_bar' => 'bottom: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .threesixty-wrapper+.bg-360'  => 'bottom: calc({{SIZE}}{{UNIT}} + 7%);',
					],
				]
			);

			$this->add_control(
				'navigation_heading',
				[
					'label'     => __( 'Navigation', 'apr-core' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'navigation_color',
				[
					'label'     => __( 'Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .threesixty-wrapper .nav_bar a' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'navigation_color_hover',
				[
					'label'     => __( 'Hover Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .threesixty-wrapper .nav_bar a:hover' => 'color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_section();
		}

		protected function render() {
			$settings = $this->get_settings_for_display();
			$this->apr_sc_image360();
			$images360_id  = wp_rand();
			$select_images = $settings['select_images'];
			$array_image   = [];
			foreach ( $select_images as $images ) {
				$array_image[] = $images['url'];
			}

			if ( count( $array_image ) > 0 ) {
				$array_images = implode( ",", $array_image );
			}
			?>
			<div class="threesixty-wrapper image360<?php echo $images360_id; ?>">
				<div id="threesixty" class="threesixty" data-array-image="<?php echo $array_images; ?>">
					<div class="spinner">
						<span>0%</span>
					</div>
					<ol class="threesixty_images"></ol>
				</div>
			</div>
			<div class="bg-360">
				<?php
				if ( $settings['select_bg_image']['url'] ): ?>
					<img class="frame-360" src="<?php echo $settings['select_bg_image']['url']; ?>"
						 alt="<?php echo $settings['select_bg_image']['alt']; ?>">
				<?php endif; ?>
			</div>
			<script>
				jQuery(document).ready(function ($) {
					var threesixty = $('.image360<?php echo $images360_id; ?> > #threesixty');
					var data_image = threesixty.data('array-image').split(',');
					threesixty.ThreeSixty({
						totalFrames      : data_image.length,
						endFrame         : data_image.length,
						imgArray         : data_image,
						currentFrame     : 1,
						autoplayDirection: 1,
						framerate        : 60,
						imgList          : '.threesixty_images',
						progress         : '.spinner',
						responsive       : true,
						navigation       : true
					});
				});
			</script>
			<?php

		}
	}

	Plugin::instance()->widgets_manager->register( new Apr_Core_Image360 );
}
