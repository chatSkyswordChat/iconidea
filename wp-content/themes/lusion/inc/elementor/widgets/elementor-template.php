<?php

namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Apr_Core_Elementor_Template extends Widget_Base {
	public function get_name() {
		return 'apr_elementor_template';
	}

	public function get_title() {
		return __( 'APR Elementor Template', 'apr-core' );
	}

	public function get_icon() {
		return 'eicon-site-logo';
	}

	public function get_categories() {
		return [ 'apr-core' ];
	}

	protected function register_controls() {

		$page_template = apr_core_get_page_templates();

		$this->start_controls_section(
			'section_elementor_template',
			[
				'label' => __( 'Elementor Template', 'apr-core' ),
			]
		);
		$this->add_control(
			'choose_elementor_template',
			array(
				'label'   => __( 'Choose Template', 'apr-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $page_template,
			)
		);
		$this->add_control(
			'show_slide',
			array(
				'label'   => __( 'Show Slide', 'apr-core' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => '',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider_options',
			[
				'label'     => __( 'Slider Options', 'apr-core' ),
				'condition' => [
					'show_slide' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'space',
			array(
				'label'              => __( 'Space Content', 'apr-core' ),
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
					'{{WRAPPER}} .slick-list' => 'padding-top: {{TOP}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}};',
				],
			)
		);
		$this->add_responsive_control(
			'slidestoshow',
			[
				'label'       => __( 'Slides To Show', 'apr-core' ),
				'description' => __( 'Set how many item for screen < 1200px.', 'apr-core' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => '1',
			]
		);
		$this->add_control(
			'slidesrow',
			[
				'label'   => __( 'Row', 'apr-core' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '1',
			]
		);
		$this->add_control(
			'navigation',
			[
				'label'   => __( 'Navigation', 'apr-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'arrows',
				'options' => [
					'both'   => __( 'Arrows and Dots', 'apr-core' ),
					'arrows' => __( 'Arrows', 'apr-core' ),
					'dots'   => __( 'Dots', 'apr-core' ),
					'none'   => __( 'None', 'apr-core' ),
				],
			]
		);
		$this->add_control(
			'navigation_type',
			[
				'label'     => __( 'Navigation Type', 'apr-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'type-2',
				'options'   => [
					'type-1' => __( 'Type 1', 'apr-core' ),
					'type-2' => __( 'Type 2', 'apr-core' ),
					'type-3' => __( 'Type 3', 'apr-core' ),
					'type-4' => __( 'Type 4', 'apr-core' ),
					'type-5' => __( 'Type 5', 'apr-core' )
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);
		$this->add_control(
			'arrows_position',
			[
				'label'     => __( 'Position', 'apr-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'slick-arrows-bottom',
				'options'   => [
					'slick-arrows-top'    => __( 'Top', 'apr-core' ),
					'slick-arrows-center' => __( 'Center', 'apr-core' ),
					'slick-arrows-bottom' => __( 'Bottom', 'apr-core' ),
					'slick-arrows-right'  => __( 'Right', 'apr-core' ),
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
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
		$this->add_control(
			'content_animation',
			[
				'label'   => __( 'Content Animation', 'apr-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'fadeInUp',
				'options' => [
					''            => __( 'None', 'apr-core' ),
					'fadeInDown'  => __( 'Down', 'apr-core' ),
					'fadeInUp'    => __( 'Up', 'apr-core' ),
					'fadeInRight' => __( 'Right', 'apr-core' ),
					'fadeInLeft'  => __( 'Left', 'apr-core' ),
					'zoomIn'      => __( 'Zoom', 'apr-core' ),
				],
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
				'selectors' => [
					'{{WRAPPER}} .slick-slide-bg' => 'animation-duration: calc({{VALUE}}ms*1.2); transition-duration: calc({{VALUE}}ms)',
				],
			]
		);
		$this->add_control(
			'autoplay',
			[
				'label'   => __( 'Autoplay', 'apr-core' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => '',
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
			'pause_on_hover',
			[
				'label'   => __( 'Pause on Hover', 'apr-core' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$is_rtl          = is_rtl();
		$direction       = $is_rtl ? 'true' : 'false';
		$show_dots       = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
		$show_arrows     = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
		$navigation_type = $settings['navigation_type'];
		$arrows_position = $settings['arrows_position'];
		$show_arr        = 'false';
		$show_dot        = 'false';
		if ( $settings['navigation'] == 'both' ) {
			$show_arr = 'true';
			$show_dot = 'true';
		} elseif ( $settings['navigation'] == 'arrows' ) {
			$show_arr = 'true';
		} elseif ( $settings['navigation'] == 'dots' ) {
			$show_dot = 'true';
		}
		if ( $settings['infinite'] == 'yes' ) {
			$infinite = 'true';
		} else {
			$infinite = 'false';
		}
		if ( $settings['autoplay'] == 'yes' ) {
			$autoplay = 'true';
		} else {
			$autoplay = 'false';
		}
		if ( $settings['pause_on_hover'] == 'yes' ) {
			$pauseonhover = 'true';
		} else {
			$pauseonhover = 'false';
		}

		if ( ! empty( $settings['choose_elementor_template'] ) ) {
			$apr_template_id = $settings['choose_elementor_template'];
			$apr_frontend    = new Frontend;
			?>
			<div
				class="elememtor-template <?php echo esc_attr( $navigation_type ); ?> <?php echo esc_attr( $arrows_position ); ?>">
				<?php echo $apr_frontend->get_builder_content( $apr_template_id, true ); ?>
			</div>
			<?php
		}
		if ( $settings['show_slide'] == 'yes' ) {
			?>
			<script>
				jQuery(document).ready(function ($) {
					var viewportWidth = $(window).width();
					if (viewportWidth > 768) {
						var Rows = <?php echo absint( $settings['slidesrow'] );?>;
					} else {
						var Rows = 1;
					}
					$('.elementor-widget-apr_elementor_template .elementor-widget-wrap').slick({
						slidesToShow : <?php echo absint( $settings['slidestoshow'] );?>,
						rows         : 2,
						dots         : <?php echo esc_attr( $show_dot );?>,
						arrows       : <?php echo esc_attr( $show_arr );?>,
						nextArrow    : '<button class="slick-next"><i class="theme-icon-right-arrow2"></i></button>',
						prevArrow    : '<button class="slick-prev"><i class="theme-icon-left-arrow"></i></button>',
						speed        : <?php echo absint( $settings['transition_speed'] );?>,
						infinite     : <?php echo esc_attr( $infinite );?>,
						autoplay     : <?php echo esc_attr( $autoplay );?>,
						autoplaySpeed: <?php echo absint( $settings['autoplay_speed'] );?>,
						rtl          : <?php echo esc_attr( $direction );?>,
						pauseOnHover : <?php echo esc_attr( $pauseonhover );?>,
						responsive   : [
							{
								breakpoint: 1200,
								settings  : {
									slidesToShow: <?php echo absint( $settings['slidestoshow_tablet'] );?>,
								}
							},
							{
								breakpoint: 768,
								settings  : {
									slidesToShow: <?php echo absint( $settings['slidestoshow_mobile'] );?>
								}
							},
							{
								breakpoint: 481,
								settings  : {
									slidesToShow: 1
								}
							},
						]
					});
				});
			</script>
			<?php
		}
	}
}

Plugin::instance()->widgets_manager->register( new Apr_Core_Elementor_Template );
