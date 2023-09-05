<?php

namespace Elementor;

use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Apr_Core_Slides extends Widget_Base {
	public function get_name() {
		return 'apr-slides';
	}

	public function get_categories() {
		return array( 'apr-core' );
	}

	public function get_title() {
		return __( 'APR Slides', 'apr-core' );
	}

	public function get_icon() {
		return 'eicon-slideshow';
	}

	public static function get_animation_options() {
		return [
			''                  => __( 'None', 'apr-core' ),
			'fadeInDown'        => __( 'FadeInDown', 'apr-core' ),
			'fadeInUp'          => __( 'FadeInUp', 'apr-core' ),
			'fadeInRight'       => __( 'FadeInRight', 'apr-core' ),
			'fadeInLeft'        => __( 'FadeInLeft', 'apr-core' ),
			'fadeInDownBig'     => __( 'FadeInDownBig', 'apr-core' ),
			'fadeInLeftBig'     => __( 'FadeInLeftBig', 'apr-core' ),
			'fadeInRightBig'    => __( 'FadeInRightBig', 'apr-core' ),
			'fadeInUpBig'       => __( 'FadeInUpBig', 'apr-core' ),
			'lightSpeedIn'      => __( 'LightSpeedIn', 'apr-core' ),
			'lightSpeedOut'     => __( 'LightSpeedOut', 'apr-core' ),
			'zoomIn'            => __( 'Zoom', 'apr-core' ),
			'zoomInDown'        => __( 'ZoomInDown', 'apr-core' ),
			'zoomInLeft'        => __( 'ZoomInLeft', 'apr-core' ),
			'zoomInRight'       => __( 'ZoomInRight', 'apr-core' ),
			'zoomInUp'          => __( 'ZoomInUp', 'apr-core' ),
			'pulse'             => __( 'Pulse', 'apr-core' ),
			'bounceIn'          => __( 'BounceIn', 'apr-core' ),
			'bounceInDown'      => __( 'BounceInDown', 'apr-core' ),
			'bounceInLeft'      => __( 'BounceInLeft', 'apr-core' ),
			'bounceInRight'     => __( 'BounceInRight', 'apr-core' ),
			'bounceInUp'        => __( 'BounceInUp', 'apr-core' ),
			'rotateIn'          => __( 'RotateIn', 'apr-core' ),
			'rotateInDownLeft'  => __( 'RotateInDownLeft', 'apr-core' ),
			'rotateInDownRight' => __( 'RotateInDownRight', 'apr-core' ),
			'rotateInUpLeft'    => __( 'RotateInUpLeft', 'apr-core' ),
			'rotateInUpRight'   => __( 'RotateInUpRight', 'apr-core' ),
			'slideInUp'         => __( 'SlideInUp', 'apr-core' ),
			'slideInDown'       => __( 'SlideInDown', 'apr-core' ),
			'slideInLeft'       => __( 'SlideInLeft', 'apr-core' ),
			'slideInRight'      => __( 'SlideInRight', 'apr-core' ),
			'JackInTheBox'      => __( 'JackInTheBox', 'apr-core' ),
		];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_slides',
			[
				'label' => __( 'Slides', 'apr-core' ),
			]
		);

		$repeater = new Repeater();

		$repeater->start_controls_tabs( 'slides_repeater' );

		$repeater->start_controls_tab( 'background', [ 'label' => __( 'Background', 'apr-core' ) ] );
		$repeater->add_responsive_control(
			'content_max_width',
			[
				'label'          => __( 'Content Width', 'apr-core' ),
				'type'           => Controls_Manager::SLIDER,
				'range'          => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units'     => [ '%', 'px' ],
				'default'        => [
					'size' => '66',
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'selectors'      => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .elementor-slide-content' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$repeater->add_control(
			'background_color',
			[
				'label'     => __( 'Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#bbbbbb',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-bg' => 'background-color: {{VALUE}}',
				],
			]
		);

		$repeater->add_responsive_control(
			'background_image',
			[
				'label'     => _x( 'Image', 'Background Control', 'apr-core' ),
				'type'      => Controls_Manager::MEDIA,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-bg' => 'background-image: url({{URL}})',
				],
			]
		);


		$repeater->add_responsive_control(
			'position',
			[
				'label'      => _x( 'Position', 'Background Control', 'apr-core' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => '',
				'responsive' => true,
				'options'    => [
					''              => _x( 'Default', 'Background Control', 'apr-core' ),
					'center center' => _x( 'Center Center', 'Background Control', 'apr-core' ),
					'center left'   => _x( 'Center Left', 'Background Control', 'apr-core' ),
					'center right'  => _x( 'Center Right', 'Background Control', 'apr-core' ),
					'top center'    => _x( 'Top Center', 'Background Control', 'apr-core' ),
					'top left'      => _x( 'Top Left', 'Background Control', 'apr-core' ),
					'top right'     => _x( 'Top Right', 'Background Control', 'apr-core' ),
					'bottom center' => _x( 'Bottom Center', 'Background Control', 'apr-core' ),
					'bottom left'   => _x( 'Bottom Left', 'Background Control', 'apr-core' ),
					'bottom right'  => _x( 'Bottom Right', 'Background Control', 'apr-core' ),
					'initial'       => _x( 'Custom', 'Background Control', 'apr-core' ),

				],
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-bg' => 'background-position: {{VALUE}};',
				],
				'condition'  => [
					'background_image[url]!' => '',
				],
			]
		);

		$repeater->add_responsive_control( 'xpos', [
			'label'          => _x( 'X Position', 'Background Control', 'apr-core' ),
			'type'           => Controls_Manager::SLIDER,
			'responsive'     => true,
			'size_units'     => [ 'px', 'em', '%', 'vw' ],
			'default'        => [
				'unit' => 'px',
				'size' => 0,
			],
			'tablet_default' => [
				'unit' => 'px',
				'size' => 0,
			],
			'mobile_default' => [
				'unit' => 'px',
				'size' => 0,
			],
			'range'          => [
				'px' => [
					'min' => - 800,
					'max' => 800,
				],
				'em' => [
					'min' => - 100,
					'max' => 100,
				],
				'%'  => [
					'min' => - 100,
					'max' => 100,
				],
				'vw' => [
					'min' => - 100,
					'max' => 100,
				],
			],
			'selectors'      => [
				'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-bg' => 'background-position: {{SIZE}}{{UNIT}} {{ypos.SIZE}}{{ypos.UNIT}}',
			],
			'condition'      => [
				'position'               => [ 'initial' ],
				'background_image[url]!' => '',
			],
			'required'       => true,
			'device_args'    => [
				Controls_Stack::RESPONSIVE_TABLET => [
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-bg' => 'background-position: {{SIZE}}{{UNIT}} {{ypos_tablet.SIZE}}{{ypos_tablet.UNIT}}',
					],
					'condition' => [
						'position_tablet' => [ 'initial' ],
					],
				],
				Controls_Stack::RESPONSIVE_MOBILE => [
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-bg' => 'background-position: {{SIZE}}{{UNIT}} {{ypos_mobile.SIZE}}{{ypos_mobile.UNIT}}',
					],
					'condition' => [
						'position_mobile' => [ 'initial' ],
					],
				],
			],
		] );
		$repeater->add_responsive_control( 'ypos', [
			'label'          => _x( 'Y Position', 'Background Control', 'apr-core' ),
			'type'           => Controls_Manager::SLIDER,
			'responsive'     => true,
			'size_units'     => [ 'px', 'em', '%', 'vh' ],
			'default'        => [
				'unit' => 'px',
				'size' => 0,
			],
			'tablet_default' => [
				'unit' => 'px',
				'size' => 0,
			],
			'mobile_default' => [
				'unit' => 'px',
				'size' => 0,
			],
			'range'          => [
				'px' => [
					'min' => - 800,
					'max' => 800,
				],
				'em' => [
					'min' => - 100,
					'max' => 100,
				],
				'%'  => [
					'min' => - 100,
					'max' => 100,
				],
				'vh' => [
					'min' => - 100,
					'max' => 100,
				],
			],
			'selectors'      => [
				'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-bg' => 'background-position: {{xpos.SIZE}}{{xpos.UNIT}} {{SIZE}}{{UNIT}}',
			],
			'condition'      => [
				'position'               => [ 'initial' ],
				'background_image[url]!' => '',
			],
			'required'       => true,
			'device_args'    => [
				Controls_Stack::RESPONSIVE_TABLET => [
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-bg' => 'background-position: {{xpos_tablet.SIZE}}{{xpos_tablet.UNIT}} {{SIZE}}{{UNIT}}',
					],
					'condition' => [
						'position_tablet' => [ 'initial' ],
					],
				],
				Controls_Stack::RESPONSIVE_MOBILE => [
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-bg' => 'background-position: {{xpos_mobile.SIZE}}{{xpos_mobile.UNIT}} {{SIZE}}{{UNIT}}',
					],
					'condition' => [
						'position_mobile' => [ 'initial' ],
					],
				],
			],
		] );

		$repeater->add_responsive_control( 'repeat', [
			'label'      => _x( 'Repeat', 'Background Control', 'apr-core' ),
			'type'       => Controls_Manager::SELECT,
			'default'    => '',
			'responsive' => true,
			'options'    => [
				''          => _x( 'Default', 'Background Control', 'apr-core' ),
				'no-repeat' => _x( 'No-repeat', 'Background Control', 'apr-core' ),
				'repeat'    => _x( 'Repeat', 'Background Control', 'apr-core' ),
				'repeat-x'  => _x( 'Repeat-x', 'Background Control', 'apr-core' ),
				'repeat-y'  => _x( 'Repeat-y', 'Background Control', 'apr-core' ),
			],
			'selectors'  => [
				'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-bg' => 'background-repeat: {{VALUE}};',
			],
			'condition'  => [
				'background_image[url]!' => '',
			],
		] );

		$repeater->add_responsive_control(
			'background_size',
			[
				'label'      => _x( 'Size', 'Background Control', 'apr-core' ),
				'type'       => Controls_Manager::SELECT,
				'responsive' => true,
				'default'    => '',
				'options'    => [
					''        => _x( 'Default', 'Background Control', 'apr-core' ),
					'auto'    => _x( 'Auto', 'Background Control', 'apr-core' ),
					'cover'   => _x( 'Cover', 'Background Control', 'apr-core' ),
					'contain' => _x( 'Contain', 'Background Control', 'apr-core' ),
					'initial' => _x( 'Custom', 'Background Control', 'apr-core' ),
				],
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-bg' => 'background-size: {{VALUE}};',
				],
				'condition'  => [
					'background_image[url]!' => '',
				],
			]
		);

		$repeater->add_responsive_control( 'bg_width', [
			'label'       => _x( 'Width', 'Background Control', 'apr-core' ),
			'type'        => Controls_Manager::SLIDER,
			'responsive'  => true,
			'size_units'  => [ 'px', 'em', '%', 'vw' ],
			'range'       => [
				'px' => [
					'min' => 0,
					'max' => 1000,
				],
				'%'  => [
					'min' => 0,
					'max' => 100,
				],
				'vw' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'default'     => [
				'size' => 100,
				'unit' => '%',
			],
			'required'    => true,
			'selectors'   => [
				'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-bg' => 'background-size: {{SIZE}}{{UNIT}} auto',

			],
			'condition'   => [
				'background_size'        => [ 'initial' ],
				'background_image[url]!' => '',
			],
			'device_args' => [
				Controls_Stack::RESPONSIVE_TABLET => [
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-bg' => 'background-size: {{SIZE}}{{UNIT}} auto',
					],
					'condition' => [
						'background_size_tablet' => [ 'initial' ],
					],
				],
				Controls_Stack::RESPONSIVE_MOBILE => [
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-bg' => 'background-size: {{SIZE}}{{UNIT}} auto',
					],
					'condition' => [
						'background_size_mobile' => [ 'initial' ],
					],
				],
			],
		] );

		$repeater->add_control(
			'background_ken_burns',
			[
				'label'      => __( 'Ken Burns Effect', 'apr-core' ),
				'type'       => Controls_Manager::SWITCHER,
				'default'    => '',
				'separator'  => 'before',
				'conditions' => [
					'terms' => [
						[
							'name'     => 'background_image[url]',
							'operator' => '!=',
							'value'    => '',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'zoom_direction',
			[
				'label'      => __( 'Zoom Direction', 'apr-core' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'in',
				'options'    => [
					'in'  => __( 'In', 'apr-core' ),
					'out' => __( 'Out', 'apr-core' ),
				],
				'conditions' => [
					'terms' => [
						[
							'name'     => 'background_ken_burns',
							'operator' => '!=',
							'value'    => '',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'background_overlay',
			[
				'label'      => __( 'Background Overlay', 'apr-core' ),
				'type'       => Controls_Manager::SWITCHER,
				'default'    => '',
				'separator'  => 'before',
				'conditions' => [
					'terms' => [
						[
							'name'     => 'background_image[url]',
							'operator' => '!=',
							'value'    => '',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'background_overlay_color',
			[
				'label'      => __( 'Color', 'apr-core' ),
				'type'       => Controls_Manager::COLOR,
				'default'    => 'rgba(0,0,0,0.5)',
				'conditions' => [
					'terms' => [
						[
							'name'  => 'background_overlay',
							'value' => 'yes',
						],
					],
				],
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner .elementor-background-overlay' => 'background-color: {{VALUE}}',
				],
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab( 'content', [ 'label' => __( 'Content', 'apr-core' ) ] );
		$repeater->add_control(
			'text_features',
			[
				'label'       => __( 'Text Features', 'apr-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Text Features', 'apr-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'animation_text_features',
			[
				'label'   => __( 'Heading Animation', 'apr-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'fadeInUp',
				'options' => self::get_animation_options(),
			]
		);
		$repeater->add_control(
			'transition_delay_text_features',
			[
				'label'   => __( 'Transition Delay For Heading (ms)', 'apr-core' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 500,
			]
		);
		$repeater->add_control(
			'before_heading',
			[
				'label'       => __( 'Before Title', 'apr-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '', 'apr-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'heading',
			[
				'label'       => __( 'Title', 'apr-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '', 'apr-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'after_heading',
			[
				'label'       => __( 'After Title', 'apr-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '', 'apr-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'title_tag',
			[
				'label'   => __( 'Title Tag', 'apr-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'span',
				'options' => [
					'h1'   => __( 'H1', 'apr-core' ),
					'h2'   => __( 'H2', 'apr-core' ),
					'h3'   => __( 'H3', 'apr-core' ),
					'h4'   => __( 'H4', 'apr-core' ),
					'h5'   => __( 'H5', 'apr-core' ),
					'p'    => __( 'p', 'apr-core' ),
					'span' => __( 'span', 'apr-core' ),
				],
			]
		);

		$repeater->add_control(
			'animation_heading',
			[
				'label'   => __( 'Heading Animation', 'apr-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'fadeInUp',
				'options' => self::get_animation_options(),
			]
		);
		$repeater->add_control(
			'transition_delay_heading',
			[
				'label'   => __( 'Transition Delay For Heading (ms)', 'apr-core' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 500,
			]
		);

		$repeater->add_control(
			'description',
			[
				'label'      => __( 'Description', 'apr-core' ),
				'type'       => Controls_Manager::TEXTAREA,
				'default'    => __( 'I am slide content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'apr-core' ),
				'show_label' => false,
			]
		);

		$repeater->add_control(
			'animation_descr',
			[
				'label'   => __( 'Description Animation', 'apr-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'fadeInUp',
				'options' => self::get_animation_options(),
			]
		);

		$repeater->add_control(
			'transition_delay_description',
			[
				'label'   => __( 'Transition Delay For Description (ms)', 'apr-core' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 500,
			]
		);

		$repeater->add_control(
			'button_text',
			[
				'label'   => __( 'Button Text', 'apr-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Click here', 'apr-core' )
			]
		);

		$repeater->add_control(
			'link',
			[
				'label'       => __( 'Link', 'apr-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'apr-core' ),
			]
		);

		$repeater->add_control(
			'link_click',
			[
				'label'      => __( 'Apply Link On', 'apr-core' ),
				'type'       => Controls_Manager::SELECT,
				'options'    => [
					'slide'  => __( 'Whole Slide', 'apr-core' ),
					'button' => __( 'Button Only', 'apr-core' ),
				],
				'default'    => 'slide',
				'conditions' => [
					'terms' => [
						[
							'name'     => 'link[url]',
							'operator' => '!=',
							'value'    => '',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'animation_button',
			[
				'label'   => __( 'Button Animation', 'apr-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'fadeInUp',
				'options' => self::get_animation_options(),
			]
		);

		$repeater->add_control(
			'transition_delay_button',
			[
				'label'   => __( 'Transition Delay for button (ms)', 'apr-core' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 500,
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab( 'style', [ 'label' => __( 'Style', 'apr-core' ) ] );

		$repeater->add_control(
			'custom_style',
			[
				'label'       => __( 'Custom', 'apr-core' ),
				'type'        => Controls_Manager::SWITCHER,
				'description' => __( 'Set custom style that will only affect this specific slide.', 'apr-core' ),
			]
		);

		$repeater->add_responsive_control(
			'slides_padding_CURRENT',
			[
				'label'      => __( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_responsive_control(
			'slides_margin_CURRENT',
			[
				'label'      => __( 'Margin', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_responsive_control(
			'vertical_position',
			[
				'label'      => __( 'Vertical Position', 'apr-core' ),
				'type'       => Controls_Manager::SELECT,
				'default'    => '',
				'options'    => [
					''           => __( 'Default', 'apr-core' ),
					'flex-start' => __( 'Top', 'apr-core' ),
					'center'     => __( 'Center', 'apr-core' ),
					'flex-end'   => __( 'Bottom', 'apr-core' ),
				],
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .lusion-slick-slide' => 'align-items: {{VALUE}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'horizontal_position',
			[
				'label'                => __( 'Horizontal Position', 'apr-core' ),
				'type'                 => Controls_Manager::CHOOSE,
				'label_block'          => false,
				'options'              => [
					'left'   => [
						'title' => __( 'Left', 'apr-core' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'apr-core' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'apr-core' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'selectors'            => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner .elementor-slide-content' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'left'   => 'margin-right: auto',
					'center' => 'margin: 0 auto',
					'right'  => 'margin-left: auto',
				],
				'conditions'           => [
					'terms' => [
						[
							'name'  => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_responsive_control(
			'text_align',
			[
				'label'       => __( 'Text Align', 'apr-core' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
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
				'selectors'   => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner' => 'text-align: {{VALUE}}',
				],
				'conditions'  => [
					'terms' => [
						[
							'name'  => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'content_color',
			[
				'label'      => __( 'Content Color', 'apr-core' ),
				'type'       => Controls_Manager::COLOR,
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner .elementor-slide-heading'       => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner .elementor-slide-description'   => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner .elementor-slide-btn'           => 'color: {{VALUE}}; border-color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner .elementor-slide-text-features' => 'color: {{VALUE}};',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'  => 'item_text_features_typography',
				'label' => __( 'Text Features', 'apr-core' ),

				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .elementor-slide-text-features',
			]
		);

		$repeater->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'  => 'item_heading_typography',
				'label' => 'Typography for heading',

				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .elementor-slide-heading',
			]
		);

		$repeater->add_responsive_control(
			'heading_spacing_item',
			[
				'label'      => __( 'Heading Spacing', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner .elementor-slide-heading:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$repeater->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => 'Typography for special heading',
				'name'  => 'item_special_heading_typography',

				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .elementor-slide-heading .heading',
			]
		);

		$repeater->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => 'Typography Description',
				'name'  => 'item_description_typography',

				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .elementor-slide-description',
			]
		);

		$repeater->add_responsive_control(
			'desctiption_spacing',
			[
				'label'      => __( 'Description Spacing', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slick-slide-inner .elementor-slide-description:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$repeater->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label'    => __( 'Typography Button', 'apr-core' ),
				'name'     => 'item_button_typography',
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .elementor-slide-btn',

			]
		);
		$repeater->add_responsive_control(
			'item_header_padding',
			[
				'label'      => __( 'Padding Button', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .elementor-slide-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'slides',
			[
				'label'       => __( 'Slides', 'apr-core' ),
				'type'        => Controls_Manager::REPEATER,
				'show_label'  => true,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'heading'                        => __( 'Slide 1 Heading', 'apr-core' ),
						'description'                    => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'apr-core' ),
						'button_text'                    => __( 'Click Here', 'apr-core' ),
						'background_color'               => '#F7F7F7',
						'before_heading'                 => __( 'Before Heading', 'apr-core' ),
						'after_heading'                  => __( 'After Heading', 'apr-core' ),
						'text_features'                  => __( 'Text Features', 'apr-core' ),
						'animation_heading'              => __( 'zoomIn', 'apr-core' ),
						'animation_text_features'        => __( 'zoomIn', 'apr-core' ),
						'animation_descr'                => __( 'zoomIn', 'apr-core' ),
						'animation_button'               => __( 'zoomIn', 'apr-core' ),
						'transition_delay_heading'       => __( '500', 'apr-core' ),
						'transition_delay_text_features' => __( '500', 'apr-core' ),
						'transition_delay_description'   => __( '500', 'apr-core' ),
						'transition_delay_button'        => __( '500', 'apr-core' ),
					],
					[
						'heading'                        => __( 'Slide 2 Heading', 'apr-core' ),
						'description'                    => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'apr-core' ),
						'button_text'                    => __( 'Click Here', 'apr-core' ),
						'background_color'               => '#F7F7F7',
						'before_heading'                 => __( 'Before Heading', 'apr-core' ),
						'after_heading'                  => __( 'After Heading', 'apr-core' ),
						'text_features'                  => __( 'Text Features', 'apr-core' ),
						'animation_heading'              => __( 'zoomIn', 'apr-core' ),
						'animation_text_features'        => __( 'zoomIn', 'apr-core' ),
						'animation_descr'                => __( 'zoomIn', 'apr-core' ),
						'animation_button'               => __( 'zoomIn', 'apr-core' ),
						'transition_delay_heading'       => __( '500', 'apr-core' ),
						'transition_delay_text_features' => __( '500', 'apr-core' ),
						'transition_delay_description'   => __( '500', 'apr-core' ),
						'transition_delay_button'        => __( '500', 'apr-core' ),
					],
					[
						'heading'                        => __( 'Slide 3 Heading', 'apr-core' ),
						'description'                    => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'apr-core' ),
						'button_text'                    => __( 'Click Here', 'apr-core' ),
						'background_color'               => '#F7F7F7',
						'before_heading'                 => __( 'Before Heading', 'apr-core' ),
						'text_features'                  => __( 'Text Features', 'apr-core' ),
						'after_heading'                  => __( 'After Heading', 'apr-core' ),
						'animation_heading'              => __( 'zoomIn', 'apr-core' ),
						'animation_text_features'        => __( 'zoomIn', 'apr-core' ),
						'animation_descr'                => __( 'zoomIn', 'apr-core' ),
						'animation_button'               => __( 'zoomIn', 'apr-core' ),
						'transition_delay_heading'       => __( '500', 'apr-core' ),
						'transition_delay_text_features' => __( '500', 'apr-core' ),
						'transition_delay_description'   => __( '500', 'apr-core' ),
						'transition_delay_button'        => __( '500', 'apr-core' ),
					],
				],
				'title_field' => '{{{ heading }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider_options',
			[
				'label' => __( 'Slider Options', 'apr-core' ),
				'type'  => Controls_Manager::SECTION,
			]
		);

		$this->add_control(
			'navigation',
			[
				'label'   => __( 'Navigation', 'apr-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'None',
				'options' => [
					'both'   => __( 'Arrows and Dots', 'apr-core' ),
					'arrows' => __( 'Arrows', 'apr-core' ),
					'dots'   => __( 'Dots', 'apr-core' ),
					'none'   => __( 'None', 'apr-core' ),
				],
			]
		);

		$this->add_control(
			'slides_navigation_align',
			[
				'label'        => __( 'Navigation Align', 'apr-core' ),
				'type'         => Controls_Manager::CHOOSE,
				'label_block'  => false,
				'options'      => [
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
				'prefix_class' => 'slides-navigation-align-',
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
				'default' => 'yes',
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
			'infinite',
			[
				'label'   => __( 'Infinite Loop', 'apr-core' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'transition',
			[
				'label'   => __( 'Transition', 'apr-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'slide',
				'options' => [
					'slide' => __( 'Slide', 'apr-core' ),
					'fade'  => __( 'Fade', 'apr-core' ),
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

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_slides',
			[
				'label' => __( 'Slides', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'slide_height',
			[
				'label'      => __( 'Height', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vh' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
					'%'  => [
						'min' => - 100,
						'max' => 100,
					],
					'vw' => [
						'min' => - 100,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .lusion-slick-slide' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'slide_height_custom_l',
			[
				'label'      => __( 'Height (only screen 1367px and 1537px)', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vh' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
					'%'  => [
						'min' => - 100,
						'max' => 100,
					],
					'vw' => [
						'min' => - 100,
						'max' => 100,
					],
				],
			]
		);

		$this->add_control(
			'slide_height_custom',
			[
				'label'      => __( 'Height (only screen 1025px and 1366px)', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vh' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
					'%'  => [
						'min' => - 100,
						'max' => 100,
					],
					'vw' => [
						'min' => - 100,
						'max' => 100,
					],
				],
			]
		);

		$this->add_responsive_control(
			'slides_padding',
			[
				'label'      => __( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .slick-slide-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slides_margin',
			[
				'label'      => __( 'Margin', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .slick-slide-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slides_vertical_position',
			[
				'label'     => __( 'Vertical Position', 'apr-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''           => __( 'Default', 'apr-core' ),
					'flex-start' => __( 'Top', 'apr-core' ),
					'center'     => __( 'Center', 'apr-core' ),
					'flex-end'   => __( 'Bottom', 'apr-core' ),
				],
				'selectors' => [
					'{{WRAPPER}} .lusion-slick-slide' => 'align-items: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'slides_horizontal_position',
			[
				'label'                => __( 'Horizontal Positions', 'apr-core' ),
				'type'                 => Controls_Manager::CHOOSE,
				'label_block'          => false,
				'default'              => 'center',
				'options'              => [
					'left'   => [
						'title' => __( 'Left', 'apr-core' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'apr-core' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'apr-core' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'selectors'            => [
					'{{WRAPPER}} .slick-slide-inner' => 'justify-content: {{VALUE}}',
				],
				'selectors_dictionary' => [
					'left'   => 'flex-start',
					'center' => 'center',
					'right'  => 'flex-end',
				],
				'prefix_class'         => 'elementor--h-position-',
			]
		);

		$this->add_responsive_control(
			'slides_text_align',
			[
				'label'       => __( 'Text Align', 'apr-core' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
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
				'default'     => 'left',
				'selectors'   => [
					'{{WRAPPER}} .slick-slide-inner' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'slides_background_color',
			[
				'label'     => __( 'Background Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slides' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_text_features',
			[
				'label' => __( 'Text Features', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'text_features_spacing',
			[
				'label'      => __( 'Spacing', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .slick-slide-inner .elementor-slide-text-features' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'text_features_width',
			[
				'label'      => __( 'Width', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .slick-slide-inner .elementor-slide-text-features > div' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_control(
			'special_text_features_color',
			[
				'label'     => __( 'Text Features Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-text-features' => 'color: {{VALUE}}',

				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_features_typography',

				'selector' => '{{WRAPPER}} .elementor-slide-text-features',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_title',
			[
				'label' => __( 'Title', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'heading_spacing',
			[
				'label'      => __( 'Spacing', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .slick-slide-inner .elementor-slide-heading:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'heading_width',
			[
				'label'      => __( 'Width', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .slick-slide-inner .elementor-slide-heading, {{WRAPPER}} .elementor-slide-content.slides-left .slider-content > div > div:not(.elementor-slide-btn)' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'special_heading_color',
			[
				'label'     => __( 'Text Color For Special Heading', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-heading .heading' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'heading_color',
			[
				'label'     => __( 'Text Color For Overal Heading', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-heading' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',

				'selector' => '{{WRAPPER}} .elementor-slide-heading',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => 'Typography for special heading',
				'name'  => 'special_heading_typography',

				'selector' => '{{WRAPPER}} .elementor-slide-heading .heading',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_description',
			[
				'label' => __( 'Description', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'description_spacing',
			[
				'label'      => __( 'Spacing', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .slick-slide-inner .elementor-slide-description:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'description_width',
			[
				'label'      => __( 'Width', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .slick-slide-inner .elementor-slide-description > div' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     => __( 'Text Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-description' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',

				'selector' => '{{WRAPPER}} .elementor-slide-description',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_button',
			[
				'label' => __( 'Button', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} .elementor-slide-btn',

			]
		);
		$this->add_responsive_control(
			'header_padding',
			[
				'label'      => __( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-slide-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'button_border_width',
			[
				'label'      => __( 'Border Width', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-slide-btn' => 'border-top-width: {{TOP}}{{UNIT}}; border-right-width:{{RIGHT}}{{UNIT}};  border-bottom-width:{{BOTTOM}}{{UNIT}}; border-left-width:{{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label'     => __( 'Border Radius', 'apr-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-btn' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$this->start_controls_tabs( 'button_tabs' );

		$this->start_controls_tab( 'normal', [ 'label' => __( 'Normal', 'apr-core' ) ] );

		$this->add_control(
			'button_text_color',
			[
				'label'     => __( 'Button Text Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label'     => __( 'Background Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_border_color',
			[
				'label'     => __( 'Border Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-btn' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover', [ 'label' => __( 'Hover', 'apr-core' ) ] );

		$this->add_control(
			'button_hover_text_color',
			[
				'label'     => __( 'Text Hover Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_background_color',
			[
				'label'     => __( 'Background Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-btn:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'     => __( 'Border Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-btn:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

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

		$this->add_responsive_control(
			'navigation_position_bottom',
			[
				'label'      => __( 'Navigation Position Bottom', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'%' => [
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .elementor-slick-slider .slider-navigation' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'navigation' => [ 'arrows', 'dots', 'both' ],
				],
			]
		);

		$this->add_responsive_control(
			'navigation_position_left',
			[
				'label'      => __( 'Navigation Position Left', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'%' => [
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}}.slides-navigation-align-left .elementor-slick-slider .slider-navigation' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'navigation'              => [ 'arrows', 'dots', 'both' ],
					'slides_navigation_align' => [ 'left' ],
				],
			]
		);

		$this->add_responsive_control(
			'navigation_position_right',
			[
				'label'      => __( 'Navigation Position Right', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'%' => [
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}}.slides-navigation-align-right .elementor-slick-slider .slider-navigation' => 'right: {{SIZE}}{{UNIT}};',
				],
				'devices'    => [ 'desktop', 'tablet' ],
				'condition'  => [
					'navigation'              => [ 'arrows', 'dots', 'both' ],
					'slides_navigation_align' => [ 'right' ],
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
			'arrows_size',
			[
				'label'     => __( 'Arrows Size', 'apr-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 16,
						'max' => 60,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-slick-slider .elementor-slides button.slick-arrow:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
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
				'selectors' =>
					[
						'{{WRAPPER}} .elementor-slick-slider button.slick-arrow:before' => 'color: {{VALUE}};',
					],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_color_hover',
			[
				'label'     => __( 'Arrows Color Hover', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' =>
					[
						'{{WRAPPER}} .elementor-slick-slider button.slick-arrow:hover:before' => 'color: {{VALUE}};',
					],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_background_color',
			[
				'label'     => __( 'Arrows Background Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' =>
					[
						'{{WRAPPER}} .elementor-slick-slider button.slick-arrow' => 'background: {{VALUE}};',
					],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_background_color_hover',
			[
				'label'     => __( 'Arrows Background Color Hover', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' =>
					[
						'{{WRAPPER}} .elementor-slick-slider button.slick-arrow:hover' => 'background: {{VALUE}};',
					],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
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
					'{{WRAPPER}} .elementor-slides-wrapper .slider-navigation ul.slick-dots li button,
                    {{WRAPPER}} .elementor-slides-wrapper .slider-navigation ul.slick-dots li:before' => 'background-color: {{VALUE}};color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_color_active',
			[
				'label'     => __( 'Dots Color Hover', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slick-slider .slider-navigation ul.slick-dots li.slick-active button,
                    {{WRAPPER}} .elementor-slick-slider .slider-navigation ul.slick-dots li:hover button' => 'background-color: {{VALUE}};',
					'.elementor-slick-slider .slider-navigation ul.slick-dots'                            => 'color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render slides widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings();

		if ( empty( $settings['slides'] ) ) {
			return;
		}

		$this->add_render_attribute( 'button', 'class', [ 'elementor-button', 'elementor-slide-btn' ] );

		$slides      = [];
		$slide_count = 0;
		foreach ( $settings['slides'] as $slide ) {
			$slide_html  = $slide_attributes = $btn_attributes = '';
			$btn_element = $slide_element = 'div';
			$slide_url   = $slide['link']['url'];
			if ( ! empty( $slide_url ) ) {
				$this->add_render_attribute( 'slide_link' . $slide_count, 'href', $slide_url );

				if ( $slide['link']['is_external'] ) {
					$this->add_render_attribute( 'slide_link' . $slide_count, 'target', '_blank' );
				}

				if ( 'button' === $slide['link_click'] ) {
					$btn_element    = 'a';
					$btn_attributes = $this->get_render_attribute_string( 'slide_link' . $slide_count );
				} else {
					$slide_element    = 'a';
					$slide_attributes = $this->get_render_attribute_string( 'slide_link' . $slide_count );
				}
			}

			if ( 'yes' === $slide['background_overlay'] ) {
				$slide_html .= '<div class="elementor-background-overlay"></div>';
			}

			$slides_text_align = '';
			if ( $settings['slides_text_align'] ) {
				$slides_text_align = ' slides-' . $settings['slides_text_align'];
			}
			$text_align_child = '';
			if ( $slide['text_align'] ) {
				$text_align_child = ' text-align-child-' . $slide['text_align'];
			}

			$slide_html .= '<div class="elementor-slide-content' . $slides_text_align . $text_align_child . '"><div class="slider-content">';

			if ( $slide['text_features'] ) {
				$slide_html .= '<div data-animation="' . $slide['animation_text_features'] . '" data-delay="' . $slide['transition_delay_text_features'] . 'ms" class="elementor-slide-text-features"><div>' . $slide['text_features'] . '</div></div>';
			}

			if ( $slide['heading'] ) {
				$slide_html .= '<div data-animation="' . $slide['animation_heading'] . '" data-delay="' . $slide['transition_delay_heading'] . 'ms" class="elementor-slide-heading"><div>' . $slide['before_heading'] . ' <' . $slide['title_tag'] . ' class="heading">' . $slide['heading'] . '</' . $slide['title_tag'] . '> ' . $slide['after_heading'] . '</div></div>';
			}

			if ( $slide['description'] ) {
				$slide_html .= '<div data-animation="' . $slide['animation_descr'] . '" class="elementor-slide-description" data-delay="' . $slide['transition_delay_description'] . 'ms"><div>' . $slide['description'] . '</div></div>';
			}

			if ( $slide['button_text'] ) {
				$slide_html .= '<div class="slides-link"><' . $btn_element . ' ' . $btn_attributes . ' ' . $this->get_render_attribute_string( 'button' ) . ' data-animation="' . $slide['animation_button'] . '" data-delay="' . $slide['transition_delay_button'] . 'ms">' . $slide['button_text'] . '</' . $btn_element . '></div>';
			}

			$ken_class = '';

			if ( '' != $slide['background_ken_burns'] ) {
				$ken_class = ' elementor-ken-' . $slide['zoom_direction'];
			}

			$slide_html .= '</div></div>';
			$slide_html = '<div class="lusion-slick-slide"><div class="slick-slide-bg' . $ken_class . '"></div><' . $slide_element . ' ' . $slide_attributes . ' class="slick-slide-inner">' . $slide_html . '</' . $slide_element . '></div>';
			$slides[]   = '<div class="slide-animation elementor-repeater-item-' . $slide['_id'] . ' slick-slide">' . $slide_html . '</div>';
			$slide_count ++;
		}

		$is_rtl    = is_rtl();
		$direction = $is_rtl ? 'true' : 'false';
		$show_arr  = 'false';
		$show_dot  = 'false';
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
		$slick_options = [
			'slidesToShow'  => absint( 1 ),
			'autoplaySpeed' => absint( $settings['autoplay_speed'] ),
			'autoplay'      => $autoplay,
			'infinite'      => $infinite,
			'pauseOnHover'  => $pause_on_hover,
			'speed'         => absint( $settings['transition_speed'] ),
			'arrows'        => $show_arr,
			'dots'          => $show_dot,
			'rtl'           => $direction,
		];

		if ( $settings['transition'] == 'fade' ) {
			$slick_options['fade'] = 'true';
		} else {
			$slick_options['fade'] = 'false';
		}
		$carousel_classes = [ 'elementor-slides' ];

		$this->add_render_attribute( 'slides', [
			'class' => $carousel_classes,
		] );
		$id = 'apr-slider-' . wp_rand();

		/* Import js */
		wp_enqueue_script( 'slick', LUSION_JS . '/elementor/slick.min.js', array() );

		/* Import Css */
		if ( is_rtl() ) {
			wp_enqueue_style( 'apr-sc-slides', LUSION_CSS . '/elementor/slides-rtl.css', array(), LUSION_THEME_VERSION );
		} else {
			wp_enqueue_style( 'apr-sc-slides', LUSION_CSS . '/elementor/slides.css', array(), LUSION_THEME_VERSION );
		}
		add_action( 'wp_enqueue_scripts', [ $this, 'apr-sc-slides' ] );
		?>
		<div id="<?php echo esc_attr( $id ); ?>"
			 class="elementor-slides-wrapper elementor-slick-slider slide <?php echo $settings['slides_navigation_align']; ?>">
			<div class="elementor-background-overlay"></div>
			<div <?php echo $this->get_render_attribute_string( 'slides' ); ?>>
				<?php echo implode( '', $slides ); ?>
			</div>
			<div class="slider-navigation"></div>
			<div class="slider-navigation-arrow"></div>
		</div>
		<?php
		if ( $settings['slide_height_custom'] && $settings['slide_height_custom']['size'] != '' ) {
			echo '<style scope>@media (min-width: 1025px) and (max-width: 1366px){#' . esc_js( $id ) . ' .lusion-slick-slide {height: ' . $settings['slide_height_custom']['size'] . $settings['slide_height_custom']['unit'] . '}}</style>';
		}
		?>

		<?php
		if ( $settings['slide_height_custom_l'] && $settings['slide_height_custom_l']['size'] != '' ) {
			echo '<style scope>@media (min-width: 1367px) and (max-width: 1537px){#' . esc_js( $id ) . ' .lusion-slick-slide {height: ' . $settings['slide_height_custom_l']['size'] . $settings['slide_height_custom_l']['unit'] . '}}</style>';
		}
		?>

		<script type="text/javascript">
			jQuery(document).ready(function ($) {
				$('#<?php echo esc_js( $id );?> .elementor-slides').slick({
					slidesToShow  : 1,
					slidesToScroll: 1,
					autoplay      : <?php echo esc_attr( $slick_options['autoplay'] ); ?>,
					autoplaySpeed : <?php echo esc_attr( $slick_options['autoplaySpeed'] );?>,
					arrows        : <?php echo esc_attr( $slick_options['arrows'] ); ?>,
					dots          : <?php echo esc_attr( $slick_options['dots'] ); ?>,
					rtl           : <?php echo esc_attr( $slick_options['rtl'] );?>,
					infinite      : <?php echo esc_attr( $slick_options['infinite'] ); ?>,
					speed         : <?php echo esc_attr( $slick_options['speed'] ); ?>,
					pauseOnHover  : <?php echo esc_attr( $slick_options['pauseOnHover'] );?>,
					fade          : <?php echo esc_attr( $slick_options['fade'] ); ?>,
					appendDots    : $('#<?php echo esc_js( $id ); ?> .slider-navigation'),
					appendArrows  : $('#<?php echo esc_js( $id ); ?> .slider-navigation')
				});

				var $firstAnimatingElements = $('div.slide-animation:first-child').find('[data-animation]');
				doAnimations($firstAnimatingElements);
				$('#<?php echo esc_js( $id );?> .elementor-slides').on('beforeChange', function (e, slick, currentSlide, nextSlide) {
					var $animatingElements = $('div.slick-slide[data-slick-index="' + nextSlide + '"] div.slide-animation').find('[data-animation]');
					doAnimations($animatingElements);
				});

				function doAnimations(elements) {
					var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
					elements.each(function () {
						var $this = $(this);
						var $animationDelay = $this.data('delay');
						var $animationType = 'animated ' + $this.data('animation');
						$this.css({
							'animation-delay'        : $animationDelay,
							'-webkit-animation-delay': $animationDelay
						});
						$this.addClass($animationType).one(animationEndEvents, function () {
							$this.removeClass($animationType);
						});
					});
				}
			});
		</script>
		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Apr_Core_Slides );
