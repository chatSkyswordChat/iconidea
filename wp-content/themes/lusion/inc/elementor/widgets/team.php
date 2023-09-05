<?php

namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Apr_core_Team_Carousel extends Widget_Base {
	public function apr_sc_team_members() {
		/* Import Css */
		if ( is_rtl() ) {
			wp_enqueue_style( 'apr-sc-team-members', LUSION_CSS . '/elementor/team-members-rtl.css', array(), LUSION_THEME_VERSION );
		} else {
			wp_enqueue_style( 'apr-sc-team-members', LUSION_CSS . '/elementor/team-members.css', array(), LUSION_THEME_VERSION );
		}
	}

	public function get_name() {
		return 'apr-core-team-carousel';
	}

	public function get_title() {
		return esc_html__( 'APR Teams', 'apr-core' );
	}

	public function get_icon() {
		return 'eicon-person';
	}

	public function get_categories() {
		return [ 'apr-core' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_team_carousel',
			[
				'label' => esc_html__( 'Contents', 'apr-core' ),
			]
		);
		$this->add_control(
			'style',
			[
				'label'   => __( 'Style', 'apr-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => array(
					'style-1' => esc_html__( 'Style 1', 'apr-core' ),
					'style-2' => esc_html__( 'Style 2', 'apr-core' ),
				),
			]
		);
		$this->add_responsive_control(
			'column_number',
			[
				'label'           => __( 'Column', 'apr-core' ),
				'type'            => Controls_Manager::SELECT,
				'options'         => [
					5 => __( '5 Column', 'apr-core' ),
					4 => __( '4 Column', 'apr-core' ),
					3 => __( '3 Column', 'apr-core' ),
					2 => __( '2 Column', 'apr-core' ),
					1 => __( '1 Column', 'apr-core' ),
				],
				'desktop_default' => 4,
				'tablet_default'  => 4,
				'mobile_default'  => 2,
				'condition'       => [
					'style' => 'style-2',
				],

			]
		);
		$team_repeater = new Repeater();

		/*
		* Team Member Image
		*/
		$team_repeater->add_control(
			'team_image',
			[
				'label'   => __( 'Image', 'apr-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$team_repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'full',
				'condition' => [
					'team_image[url]!' => '',
				],
			]
		);

		$team_repeater->add_control(
			'team_name',
			[
				'label'       => esc_html__( 'Name', 'apr-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'John Doe', 'apr-core' ),
			]
		);

		$team_repeater->add_control(
			'team_information',
			[
				'label'       => esc_html__( 'Information', 'apr-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'My Information', 'apr-core' ),
			]
		);

		$team_repeater->add_control(
			'team_enable_social_profiles',
			[
				'label'   => esc_html__( 'Display Social Profiles?', 'apr-core' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);

		$team_repeater->add_control(
			'team_facebook',
			[
				'label'       => __( 'Facebook URL', 'apr-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'apr-core' ),
				'label_block' => true,
				'default'     => [
					'url'         => '',
					'is_external' => true,
				],
				'condition'   => [
					'team_enable_social_profiles!' => '',
				],
			]
		);

		$team_repeater->add_control(
			'team_twitter',
			[
				'label'       => __( 'Twitter URL', 'apr-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'apr-core' ),
				'label_block' => true,
				'default'     => [
					'url'         => '',
					'is_external' => true,
				],
				'condition'   => [
					'team_enable_social_profiles!' => '',
				],
			]
		);

		$team_repeater->add_control(
			'team_instagram',
			[
				'label'       => __( 'Instagram URL', 'apr-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'apr-core' ),
				'label_block' => true,
				'default'     => [
					'url'         => '',
					'is_external' => true,
				],
				'condition'   => [
					'team_enable_social_profiles!' => '',
				],
			]
		);

		$team_repeater->add_control(
			'team_google',
			[
				'label'       => __( 'Google URL', 'apr-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'apr-core' ),
				'label_block' => true,
				'default'     => [
					'url'         => '',
					'is_external' => true,
				],
				'condition'   => [
					'team_enable_social_profiles!' => '',
				],
			]
		);

		$team_repeater->add_control(
			'team_linkedin',
			[
				'label'       => __( 'Linkedin URL', 'apr-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'apr-core' ),
				'label_block' => true,
				'default'     => [
					'url'         => '',
					'is_external' => true,
				],
				'condition'   => [
					'team_enable_social_profiles!' => '',
				],
			]
		);

		$team_repeater->add_control(
			'team_dribbble',
			[
				'label'       => __( 'Dribbble URL', 'apr-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'apr-core' ),
				'label_block' => true,
				'default'     => [
					'url'         => '',
					'is_external' => true,
				],
				'condition'   => [
					'team_enable_social_profiles!' => '',
				],
			]
		);


		$this->add_control(
			'team_carousel_repeater',
			[
				'label'       => esc_html__( 'Team Carousel', 'apr-core' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $team_repeater->get_controls(),
				'title_field' => '{{{ team_name }}}',
				'default'     => [
					[
						'team_name'        => __( 'Member #1', 'apr-core' ),
						'team_information' => __( 'Fashion Design', 'apr-core' ),
					],
					[
						'team_name'        => __( 'Member #2', 'apr-core' ),
						'team_information' => __( 'Fashion Design', 'apr-core' ),
					],
					[
						'team_name'        => __( 'Member #3', 'apr-core' ),
						'team_information' => __( 'Fashion Design', 'apr-core' ),
					],
					[
						'team_name'        => __( 'Member #4', 'apr-core' ),
						'team_information' => __( 'Fashion Design', 'apr-core' ),
					],
				]
			]
		);
		$this->add_control(
			'team_alignment',
			[
				'label'          => __( 'Alignment', 'apr-core' ),
				'type'           => Controls_Manager::CHOOSE,
				'default'        => 'center',
				'options'        => [
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
				'label_block'    => false,
				'style_transfer' => true,
			]
		);

		$this->end_controls_section();

		/*
		* Team Members Styling Section
		*/
		$this->start_controls_section(
			'apr_core_section_team_carousel_styles_preset',
			[
				'label' => esc_html__( 'General Styles', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'team_content_bg',
			[
				'label'     => esc_html__( 'Content Background Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-team-meta-inner' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'team_content_padding',
			[
				'label'      => __( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'devices'    => [ 'desktop', 'tablet' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-teams-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'section_team_carousel_name',
			[
				'label' => __( 'Name', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'apr_core_title_color',
			[
				'label'     => __( 'Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-team-name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .elementor-team-name',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_team_member_information',
			[
				'label' => __( 'Information', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'information_color',
			[
				'label'     => __( 'Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-team-job' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'information_typography',
				'selector' => '{{WRAPPER}} .elementor-team-job',
			]
		);

		$this->end_controls_section();
		// Slider Option
		$this->start_controls_section(
			'section_slider_options',
			[
				'label'     => __( 'Slider Options', 'apr-core' ),
				'type'      => Controls_Manager::SECTION,
				'condition' => [
					'style' => 'style-1',
				],
			]
		);
		$this->add_responsive_control(
			'number_item',
			[
				'label'           => __( 'Number Item', 'apr-core' ),
				'type'            => Controls_Manager::SELECT,
				'options'         => [
					'1' => __( '1', 'apr-core' ),
					'2' => __( '2', 'apr-core' ),
					'3' => __( '3', 'apr-core' ),
					'4' => __( '4', 'apr-core' ),
				],
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => 3,
				'tablet_default'  => 2,
				'mobile_default'  => 1,
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
				'default' => 'none',
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
			'transition_speed',
			[
				'label'   => __( 'Transition Speed (ms)', 'apr-core' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 500,
			]
		);
		$this->end_controls_section();

		// Tab Style

		$this->start_controls_section(
			'apr_core_team_carousel_social_section',
			[
				'label' => __( 'Social', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'apr_core_team_carousel_social_icons_style_tabs' );

		$this->start_controls_tab(
			'apr_core_team_carousel_social_icon_control',
			[ 'label' => esc_html__( 'Normal', 'apr-core' ) ]
		);

		$this->add_control(
			'social_color',
			[
				'label'     => __( 'Social Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-teams-wrapper .socials li a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'apr_core_team_carousel_social_icon_hover_control',
			[ 'label' => esc_html__( 'Hover', 'apr-core' ) ]
		);

		$this->add_control(
			'social_color_hover',
			[
				'label'     => __( 'Social Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-teams-wrapper .socials li a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'social_bg_hover_color',
			[
				'label'     => esc_html__( 'Background Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-teams-wrapper .socials li a:hover' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}


	protected function render() {
		$this->apr_sc_team_members();
		$settings             = $this->get_settings_for_display(); 
		$style                = $settings['style'];
		$column_number        = $settings['column_number'];
		$column_number_tablet = $settings['column_number_tablet'];
		$column_number_mobile = $settings['column_number_mobile'];
		$item_desktop         = $settings['number_item'];
		$item_tablet      		= isset( $settings['number_item_tablet'] ) ? $settings['number_item_tablet'] : 2;
		$item_mobile      		= isset( $settings['number_item_mobile'] ) ? $settings['number_item_mobile'] : 1;

		if ( empty( $settings['team_carousel_repeater'] ) ) {
			return;
		}
		$this->add_render_attribute( 'wrapper', 'class', 'elementor-teams-wrapper' );
		if ( $settings['team_alignment'] ) {
			$this->add_render_attribute( 'wrapper', 'class', 'text-' . $settings['team_alignment'] );
		}
		if ( $settings['style'] ) {
			$this->add_render_attribute( 'wrapper', 'class', 'layout-' . $settings['style'] );
		}
		if ( $settings['column_number'] ) {
			$this->add_render_attribute( 'wrapper', 'class', 'team-col-' . $settings['column_number'] );
		}
		if ( $settings['column_number_tablet'] ) {
			$this->add_render_attribute( 'wrapper', 'class', 'team-col-sm-' . $settings['column_number_tablet'] );
		}
		if ( $settings['column_number_mobile'] ) {
			$this->add_render_attribute( 'wrapper', 'class', 'team-col-xs-' . $settings['column_number_mobile'] );
		}
		# Item slider
		$this->add_render_attribute( 'item', 'class', 'elementor-team-item' );
		$this->add_render_attribute( 'row', 'class', 'slider-multiple' );
		$team_id     = 'team-' . wp_rand();
		$is_rtl      = is_rtl();
		$direction   = $is_rtl ? 'true' : 'false';
		$show_dots   = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
		$show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );
		$show_arr    = 'false';
		$show_dot    = 'false';
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
		$slick_options    = [
			'rtl' => $is_rtl,
		];
		$carousel_classes = [ 'team-content' ];
		if ( $show_arrows ) {
			$carousel_classes[] = 'cs-slick-arrows';
		}
		if ( $show_dots ) {
			$carousel_classes[] = 'cs-slick-dots';
		}
		$this->add_render_attribute( 'row', [
			'class'               => $carousel_classes,
			'data-slider_options' => wp_json_encode( $slick_options ),
		] );
		?>
		<div id="<?php echo $team_id; ?>" <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<div <?php echo $this->get_render_attribute_string( 'row' ) ?>>

				<?php foreach ( $settings['team_carousel_repeater'] as $key => $member ) :

					$team_carousel_image = $member['team_image'];
					$team_carousel_image_url = Group_Control_Image_Size::get_attachment_image_src( $team_carousel_image['id'], 'thumbnail', $member );
					?>
					<div <?php echo $this->get_render_attribute_string( 'item' ) ?>>
						<div class="elementor-team-meta-inner">
							<div class="elementor-team-image">
								<img src="<?php echo esc_url( $team_carousel_image_url ); ?>"
									 alt="<?php echo $member['team_name']; ?>">
							</div>
							<div class="elementor-team-details">
								<?php if ( $settings['style'] == 'style-2' ) : ?>
								<div class="team-info">
									<?php endif; ?>
									<div class="elementor-team-name"><?php echo $member['team_name']; ?></div>
									<div class="elementor-team-job"><?php echo $member['team_information']; ?></div>
									<?php if ( $settings['style'] == 'style-2' ) : ?>
								</div>
							<?php endif; ?>
								<div class="elementor-team-socials">
									<?php if ( $member['team_enable_social_profiles'] == 'yes' ): ?>
										<?php if ( $settings['style'] == 'style-2' ) : ?>
											<div class="icon-show-social">
												<i class="theme-icon-plus"></i>
											</div>
										<?php endif; ?>
										<ul class="socials">

											<?php if ( ! empty( $member['team_facebook']['url'] ) ) : ?>
												<?php $target = $member['team_facebook']['is_external'] ? ' target="_blank"' : ''; ?>
												<li>
													<a href="<?php echo esc_url( $member['team_facebook']['url'] ); ?>"<?php echo $target; ?>><i
															class="fab fa-facebook-f"></i></a>
												</li>
											<?php endif; ?>
											<?php if ( ! empty( $member['team_twitter']['url'] ) ) : ?>
												<?php $target = $member['team_twitter']['is_external'] ? ' target="_blank"' : ''; ?>
												<li>
													<a href="<?php echo esc_url( $member['team_twitter']['url'] ); ?>"<?php echo $target; ?>><i
															class="fab fa-twitter"></i></a>
												</li>
											<?php endif; ?>
											<?php if ( ! empty( $member['team_instagram']['url'] ) ) : ?>
												<?php $target = $member['team_instagram']['is_external'] ? ' target="_blank"' : ''; ?>
												<li>
													<a href="<?php echo esc_url( $member['team_instagram']['url'] ); ?>"<?php echo $target; ?>><i
															class="fab fa-instagram"></i></a>
												</li>
											<?php endif; ?>

											<?php if ( ! empty( $member['team_linkedin']['url'] ) ) : ?>
												<?php $target = $member['team_linkedin']['is_external'] ? ' target="_blank"' : ''; ?>
												<li>
													<a href="<?php echo esc_url( $member['team_linkedin']['url'] ); ?>"<?php echo $target; ?>><i
															class="fab fa-linkedin"></i></a>
												</li>
											<?php endif; ?>

											<?php if ( ! empty( $member['team_dribbble']['url'] ) ) : ?>
												<?php $target = $member['team_dribbble']['is_external'] ? ' target="_blank"' : ''; ?>
												<li>
													<a href="<?php echo esc_url( $member['team_dribbble']['url'] ); ?>"<?php echo $target; ?>><i
															class="fab fa-dribbble"></i></a>
												</li>
											<?php endif; ?>

											<?php if ( ! empty( $member['team_google']['url'] ) ) : ?>
												<?php $target = $member['team_dribbble']['is_external'] ? ' target="_blank"' : ''; ?>
												<li>
													<a href="<?php echo esc_url( $member['team_google']['url'] ); ?>"<?php echo $target; ?>><i
															class="fab fa-google-plus-g"></i></a>
												</li>
											<?php endif; ?>

										</ul>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

		<?php if ( $settings['style'] == 'style-1' ) : ?>
			<script>
				jQuery(document).ready(function ($) {
					$('#<?php echo esc_js( $team_id );?> .slider-multiple').slick({
						slidesToShow  : <?php echo esc_attr( $item_desktop );?>,
						slidesToScroll: 1,
						centerMode    : true,
						centerPadding : "0",
						dots          : <?php echo esc_attr( $show_dot );?>,
						arrows        : <?php echo esc_attr( $show_arr );?>,
						rtl           : <?php echo esc_attr( $direction );?>,
						nextArrow     : '<button class="btn-next"><i class="theme-icon-next"></i></button>',
						prevArrow     : '<button class="btn-prev"><i class="theme-icon-back"></i></button>',
						autoplay      : <?php echo esc_attr( $autoplay );?>,
						pauseOnHover  : <?php echo esc_attr( $pause_on_hover );?>,
						infinite      : <?php echo esc_attr( $infinite );?>,
						autoplaySpeed : <?php echo absint( $settings['autoplay_speed'] );?>,
						speed         : <?php echo absint( $settings['transition_speed'] );?>,
						responsive    : [
							{
								breakpoint: 1025,
								settings  : {
									rows        : 1,
									slidesToShow: <?php echo esc_attr( $item_tablet );?>,
									swipe       : true,
								}

							},
							{
								breakpoint: 768,
								settings  : {
									rows        : 1,
									slidesToShow: <?php echo esc_attr( $item_mobile );?>,
									swipe       : true,
								}
							}
						]

					});
				});
			</script>
		<?php endif; ?>
		<?php
	}
}

Plugin::instance()->widgets_manager->register( new Apr_core_Team_Carousel() );
