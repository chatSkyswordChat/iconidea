<?php

namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Apr_Core_Nav_Menu extends Widget_Base {

	protected $nav_menu_index = 1;

	public function get_name() {
		return 'apr-nav-menu';
	}

	public function get_title() {
		return __( 'APR Nav Menu', 'apr-core' );
	}

	public function get_icon() {
		return 'eicon-nav-menu';
	}

	public function get_categories() {
		return array( 'apr-core' );
	}

	public function get_keywords() {
		return [ 'menu', 'nav', 'button' ];
	}

	public function get_script_depends() {
		return [ 'smartmenus' ];
	}

	public function on_export( $element ) {
		unset( $element['settings']['menu'] ); 

		return $element;
	}

	protected function get_nav_menu_index() {
		return $this->nav_menu_index ++;
	}

	private function get_available_menus() {
		$menus = wp_get_nav_menus();

		$options = [];

		foreach ( $menus as $menu ) {
			$options[$menu->slug] = $menu->name;
		}

		return $options;
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_layout',
			[
				'label' => __( 'Layout', 'apr-core' ),
			]
		);

		$menus = $this->get_available_menus();

		if ( ! empty( $menus ) ) {
			$this->add_control(
				'menu',
				[
					'label'        => __( 'Menu', 'apr-core' ),
					'type'         => Controls_Manager::SELECT,
					'options'      => $menus,
					'default'      => array_keys( $menus )[0],
					'save_default' => true,
					'separator'    => 'after',
					'description'  => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'apr-core' ), admin_url( 'nav-menus.php' ) ),
				]
			);
		} else {
			$this->add_control(
				'menu',
				[
					'type'            => Controls_Manager::RAW_HTML,
					'raw'             => '<strong>' . __( 'There are no menus in your site.', 'apr-core' ) . '</strong><br>' . sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'apr-core' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'separator'       => 'after',
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
		}

		$this->add_control(
			'layout',
			[
				'label'              => __( 'Layout', 'apr-core' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'horizontal',
				'options'            => [
					'horizontal' => __( 'Horizontal', 'apr-core' ),
					'vertical'   => __( 'Vertical', 'apr-core' ),
					'dropdown'   => __( 'Dropdown', 'apr-core' ),
				],
				'frontend_available' => true,
				'prefix_class'       => 'apr-menu-layout-',
			]
		);
		$this->add_control(
			'show_tt_menu',
			[
				'label'     => __( 'Show Title Menu', 'apr-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => [
					'layout' => 'vertical',
				],
			]
		);
		$this->add_control(
			'title_menu',
			[

				'label'       => __( 'Title', 'apr-core' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 'Enter your title',
				'dynamic'     => [
					'active' => true,
				],
				'default'     => __( '', 'apr-core' ),
				'condition'   => [
					'layout' => 'horizontal',
				],
			]
		);
		$this->add_control(
			'title_toogle_menu_tablet',
			[

				'label'        => __( 'Show toggle Tablet ', 'apr-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'apr-core' ),
				'label_off'    => __( 'Hide', 'apr-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'layout'       => 'vertical',
					'show_tt_menu' => 'yes',
				],
			]
		);
		$this->add_control(
			'title_toogle_menu_mb',
			[

				'label'        => __( 'Show toggle mobile ', 'apr-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'apr-core' ),
				'label_off'    => __( 'Hide', 'apr-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'layout'       => 'vertical',
					'show_tt_menu' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'align_items',
			[
				'label'        => __( 'Align', 'apr-core' ),
				'type'         => Controls_Manager::CHOOSE,
				'label_block'  => false,
				'options'      => [
					'left'    => [
						'title' => __( 'Left', 'apr-core' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center'  => [
						'title' => __( 'Center', 'apr-core' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'   => [
						'title' => __( 'Right', 'apr-core' ),
						'icon'  => 'eicon-h-align-right',
					],
					'justify' => [
						'title' => __( 'Stretch', 'apr-core' ),
						'icon'  => 'eicon-h-align-stretch',
					],
				],
				'prefix_class' => 'apr-nav-menu__align-',
			]
		);

		$this->add_control(
			'pointer',
			[
				'label'   => __( 'Pointer', 'apr-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none'        => __( 'None', 'apr-core' ),
					'underline'   => __( 'Underline', 'apr-core' ),
					'overline'    => __( 'Overline', 'apr-core' ),
					'double-line' => __( 'Double Line', 'apr-core' ),
					'framed'      => __( 'Framed', 'apr-core' ),
					'background'  => __( 'Background', 'apr-core' ),
				],
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'section_style_main-menu',
			[
				'label' => __( 'Main Menu', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'title_menu_margin',
			[
				'label'      => __( 'Title Margin', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .footer-menu-title, {{WRAPPER}}.menu-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_menu_padding',
			[
				'label'      => __( 'Title Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .menu-title , {{WRAPPER}} .footer-menu-title ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'color_menu_title',
			[
				'label'     => __( 'Title Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .menu-title, {{WRAPPER}} .footer-menu-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'color_icon_title',
			[
				'label'     => __( 'Icon Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .footer-menu-title i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => __( 'Title typography', 'apr-core' ),
				'name'  => 'date_typography',

				'selector' => '{{WRAPPER}} .menu-title, {{WRAPPER}} .footer-menu-title i, {{WRAPPER}} .footer-menu-title',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'label'     => __( 'Menu title border', 'apr-core' ),
				'name'      => 'title_menu_border',
				'selector'  => '{{WRAPPER}} .menu-title ,{{WRAPPER}} .footer-menu-title',
				'separator' => 'after',
			]
		);

		$this->start_controls_tabs( 'tabs_menu_item_style' );

		$this->start_controls_tab(
			'tab_menu_item_normal',
			[
				'label' => __( 'Normal', 'apr-core' ),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'menu_typography',

				'selector' => '{{WRAPPER}} > .elementor-widget-container > .apr-nav-menu--main > .mega-menu > li > a',

			]
		);

		$this->add_control(
			'color_menu_item',
			[
				'label'     => __( 'Text Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} > .elementor-widget-container > .apr-nav-menu--main > .mega-menu > li > a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'color_menu_item_sticky',
			[
				'label'     => __( 'Text Color Header sticky', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'.is-sticky {{WRAPPER}} .apr-nav-menu--main .apr-item' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_menu_item_hover',
			[
				'label' => __( 'Hover & Active', 'apr-core' ),
			]
		);

		$this->add_control(
			'color_menu_item_hover',
			[
				'label'     => __( 'Text Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} > .elementor-widget-container > .apr-nav-menu--main > .mega-menu > li:hover > a,
					{{WRAPPER}} .apr-nav-menu--main .apr-item.apr-item-active,
					{{WRAPPER}} .apr-nav-menu--main .apr-item.highlighted,
					{{WRAPPER}} > .elementor-widget-container > .apr-nav-menu--main > .mega-menu > li.current-menu-parent > a,
					{{WRAPPER}} > .elementor-widget-container > .apr-nav-menu--main > .mega-menu > li.current_page_item > a,
					{{WRAPPER}} > .elementor-widget-container > .apr-nav-menu--main > .mega-menu > li > a:focus' => 'color: {{VALUE}} !important',
				],
				'condition' => [
					'pointer!' => 'background',
				],
			]
		);
		$this->add_control(
			'color_menu_item_sticky_hover',
			[
				'label'     => __( 'Text Color Header Sticky', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'.is-sticky {{WRAPPER}} .apr-nav-menu--main .apr-item:hover,
					.is-sticky {{WRAPPER}} .apr-nav-menu--main .apr-item.apr-item-active,
					.is-sticky {{WRAPPER}} .apr-nav-menu--main .apr-item.highlighted,
					.is-sticky {{WRAPPER}} .mega-menu > li.current-menu-parent > a,
					.is-sticky {{WRAPPER}} .apr-nav-menu--main .apr-item:focus' => 'color: {{VALUE}}',
				],
				'condition' => [
					'pointer!' => 'background',
				],
			]
		);

		$this->add_control(
			'hover_underline',
			[
				'label'        => __( 'Underline', 'apr-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',
			]
		);
		$this->add_control(
			'color_hover_underline',
			[
				'label'     => __( ' Color underline', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .hover-underline>ul>li>a:before, {{WRAPPER}} .hover-underline .apr-nav-menu--main>ul>li>a:before, {{WRAPPER}} .hover-underline>ul>li .sub-menu li>a:before' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'color_menu_item_hover_pointer_bg',
			[
				'label'     => __( 'Text Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .apr-nav-menu--main .apr-item:hover,
					{{WRAPPER}} .apr-nav-menu--main .apr-item.apr-item-active,
					{{WRAPPER}} .apr-nav-menu--main .apr-item.highlighted,
					{{WRAPPER}} .apr-nav-menu--main .mega-menu > li > a:focus,
					' => 'color: {{VALUE}}',
				],
				'condition' => [
					'pointer' => 'background',
				],
			]
		);

		$this->add_control(
			'pointer_color_menu_hover',
			[
				'label'     => __( 'Pointer Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .apr-nav-menu--main:not(.e--pointer-framed) .apr-item:before,
					{{WRAPPER}} .apr-nav-menu--main:not(.e--pointer-framed) .apr-item:after,
					{{WRAPPER}} .apr-nav-menu--main:not(.e--pointer-framed) .mega-menu > li > a:before,
					{{WRAPPER}} .apr-nav-menu--main:not(.e--pointer-framed) .mega-menu > li > a:after' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .e--pointer-framed .apr-item:before,
					{{WRAPPER}} .e--pointer-framed .apr-item:after,
					{{WRAPPER}} .e--pointer-framed .mega-menu > li > a:before,
					{{WRAPPER}} .e--pointer-framed .mega-menu > li > a:after'      => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'pointer!' => [ 'none', 'text' ],
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		/* This control is required to handle with complicated conditions */
		$this->add_control(
			'hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'pointer_width',
			[
				'label'     => __( 'Pointer Width', 'apr-core' ),
				'type'      => Controls_Manager::SLIDER,
				'devices'   => [ self::RESPONSIVE_DESKTOP, self::RESPONSIVE_TABLET ],
				'range'     => [
					'px' => [
						'max' => 30,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .e--pointer-framed .apr-item:before'                         => 'border-width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .e--pointer-framed.e--animation-draw .apr-item:before'       => 'border-width: 0 0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .e--pointer-framed.e--animation-draw .apr-item:after'        => 'border-width: {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} 0 0',
					'{{WRAPPER}} .e--pointer-framed.e--animation-corners .apr-item:before'    => 'border-width: {{SIZE}}{{UNIT}} 0 0 {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .e--pointer-framed.e--animation-corners .apr-item:after'     => 'border-width: 0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} 0',
					'{{WRAPPER}} .e--pointer-underline .apr-item:after,
					 {{WRAPPER}} .e--pointer-overline .apr-item:before,
					 {{WRAPPER}} .e--pointer-double-line .apr-item:before,
					 {{WRAPPER}} .e--pointer-double-line .apr-item:after' => 'height: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'pointer' => [ 'underline', 'overline', 'double-line', 'framed' ],
				],
			]
		);

		$this->add_responsive_control(
			'menu_item_padding',
			[
				'label'      => __( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .apr-nav-menu--main > .mega-menu > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'menu_item_margin',
			[
				'label'      => __( 'Margin', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .apr-nav-menu--main > .mega-menu > li > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'menu_item_border',
				'selector'  => '{{WRAPPER}} .apr-nav-menu--main > .mega-menu > li > a',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'menu_space_line',
			[
				'label' => __( 'Show space line', 'apr-core' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'bg_line',
			[
				'label'     => __( 'Background Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .show-space-line.apr-nav-menu--main .mega-menu > li > a:before,
                    {{WRAPPER}} .show-space-line.apr-nav-menu--main .mega-menu>li:last-child>a:after' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'bg_hover_line',
			[
				'label'     => __( 'Background Hover Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .show-space-line.apr-nav-menu--main .mega-menu > li > a:hover:before' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'menu_space_line_width',
			[
				'label'      => __( 'Width', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min'  => - 100,
						'max'  => 100,
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
					'size' => '',
				],
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .show-space-line.apr-nav-menu--main .mega-menu > li > a:before' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'menu_space_line' => 'yes',
				],
			]
		);
		$this->add_control(
			'menu_space_line_height',
			[
				'label'      => __( 'Height', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min'  => - 100,
						'max'  => 100,
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
					'size' => '',
				],
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .show-space-line.apr-nav-menu--main .mega-menu > li > a:before' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'menu_space_line' => 'yes',
				],
			]
		);
		$this->add_control(
			'menu_space_line_opacity',
			[
				'label'     => __( 'Opacity (%)', 'apr-core' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 1,
				],
				'range'     => [
					'px' => [
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .show-space-line.apr-nav-menu--main .mega-menu > li > a:before,
                    {{WRAPPER}} .show-space-line.apr-nav-menu--main .mega-menu > li:last-child > a:after' => 'opacity: {{SIZE}} !important;',
				],
				'condition' => [
					'menu_space_line' => 'yes',
				],
			]
		);
		$start = is_rtl() ? __( 'Right', 'apr-core' ) : __( 'Left', 'apr-core' );
		$end   = ! is_rtl() ? __( 'Right', 'apr-core' ) : __( 'Left', 'apr-core' );

		$this->add_control(
			'line_offset_orientation_h',
			[
				'label'       => __( 'Horizontal Orientation', 'apr-core' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
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
					'menu_space_line' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'line_offset_x',
			[
				'label'      => __( 'Offset Left', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min'  => - 100,
						'max'  => 100,
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
					'size' => '',
				],
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'body:not(.rtl) {{WRAPPER}} .show-space-line.apr-nav-menu--main .mega-menu > li > a:before'     => 'left: {{SIZE}}{{UNIT}}',
					'body:not(.rtl) .show-space-line.apr-nav-menu--main .mega-menu > li:last-child > a:after'       => 'right: {{SIZE}}{{UNIT}}',
					'body.rtl {{WRAPPER}} .show-space-line.apr-nav-menu--main .mega-menu > li > a:before'           => 'right: {{SIZE}}{{UNIT}}',
					'body.rtl {{WRAPPER}} .show-space-line.apr-nav-menu--main .mega-menu > li:last-child > a:after' => 'left: {{SIZE}}{{UNIT}}',
				],
				'condition'  => [
					'menu_space_line' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'line_offset_x_end',
			[
				'label'      => __( 'Offset Right', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min'  => - 100,
						'max'  => 100,
						'step' => 0.1,
					],
					'%'  => [
						'min' => - 200,
						'max' => 200,
					],
				],
				'default'    => [
					'size' => '',
				],
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'body:not(.rtl) {{WRAPPER}} .show-space-line.apr-nav-menu--main .mega-menu > li > a:before'           => 'right: {{SIZE}}{{UNIT}}',
					'body:not(.rtl) {{WRAPPER}} .show-space-line.apr-nav-menu--main .mega-menu > li:last-child > a:after' => 'left: {{SIZE}}{{UNIT}}',
					'body.rtl {{WRAPPER}} .show-space-line.apr-nav-menu--main .mega-menu > li > a:before'                 => 'left: {{SIZE}}{{UNIT}}',
					'body.rtl {{WRAPPER}} .show-space-line.apr-nav-menu--main .mega-menu > li:last-child > a:after'       => 'right: {{SIZE}}{{UNIT}}',
				],
				'condition'  => [
					'menu_space_line' => 'yes',
				],
			]
		);

		$this->add_control(
			'line_offset_orientation_v',
			[
				'label'       => __( 'Vertical Orientation', 'apr-core' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
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
					'menu_space_line' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'line_offset_y',
			[
				'label'      => __( 'Offset Top', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min'  => - 100,
						'max'  => 100,
						'step' => 1,
					],
					'%'  => [
						'min' => - 100,
						'max' => 200,
					],
				],
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'size' => '',
				],
				'selectors'  => [
					'{{WRAPPER}} .show-space-line.apr-nav-menu--main .mega-menu > li > a:before,
                    {{WRAPPER}} .show-space-line.apr-nav-menu--main .mega-menu > li:last-child > a:after' => 'top: {{SIZE}}{{UNIT}}',
				],
				'condition'  => [
					'menu_space_line' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'line_offset_y_end',
			[
				'label'      => __( 'Offset Bottom', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min'  => - 100,
						'max'  => 100,
						'step' => 1,
					],
					'%'  => [
						'min' => - 200,
						'max' => 200,
					],
				],
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'size' => '',
				],
				'selectors'  => [
					'{{WRAPPER}} .show-space-line.apr-nav-menu--main .mega-menu > li > a:before,
                    {{WRAPPER}} .show-space-line.apr-nav-menu--main .mega-menu > li:last-child > a:after' => 'bottom: {{SIZE}}{{UNIT}}',
				],
				'condition'  => [
					'menu_space_line' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'menu_width',
			[
				'label'      => __( 'Menu width', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'%' => [
						'max' => 100,
					],
				],
				'devices'    => [ 'desktop', 'tablet' ],
				'selectors'  => [
					'{{WRAPPER}} .apr-nav-menu--main .mega-menu > li,{{WRAPPER}} .footer-menu-title,{{WRAPPER}} .menu-title' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'border_radius_menu_item',
			[
				'label'      => __( 'Border Radius', 'apr-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'devices'    => [ 'desktop', 'tablet' ],
				'selectors'  => [
					'{{WRAPPER}} .mega-menu > li > a:before'                                     => 'border-radius: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .e--animation-shutter-in-horizontal .mega-menu > li > a:before' => 'border-radius: {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} 0 0',
					'{{WRAPPER}} .e--animation-shutter-in-horizontal .mega-menu > li > a:after'  => 'border-radius: 0 0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .e--animation-shutter-in-dropdown .mega-menu > li > a:before'   => 'border-radius: 0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} 0',
					'{{WRAPPER}} .e--animation-shutter-in-dropdown .mega-menu > li > a:after'    => 'border-radius: {{SIZE}}{{UNIT}} 0 0 {{SIZE}}{{UNIT}}',
				],
				'condition'  => [
					'pointer' => 'background',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_submenu',
			[
				'label' => __( 'Sub Menu', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'submenu_description',
			[
				'raw'             => __( 'On desktop, this will affect the submenu.', 'apr-core' ),
				'type'            => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-descriptor',
			]
		);

		$this->start_controls_tabs( 'tabs_submenu_item_style' );

		$this->start_controls_tab(
			'tab_submenu_item_normal',
			[
				'label' => __( 'Normal', 'apr-core' ),
			]
		);

		$this->add_control(
			'color_submenu_item',
			[
				'label'     => __( 'Text Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .sub-menu a, {{WRAPPER}} .mega-menu > li > a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_submenu_item_hover',
			[
				'label' => __( 'Hover & active', 'apr-core' ),
			]
		);

		$this->add_control(
			'color_submenu_item_hover',
			[
				'label'     => __( 'Text Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .sub-menu li:hover > a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'background_color_submenu_item',
			[
				'label'     => __( 'Background Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .sub-menu' => 'background-color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'submenu_typography',

				'exclude'   => [ 'line_height' ],
				'selector'  => '.apr-nav-menu--main > .mega-menu .sub-menu li a',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'submenu_border',
				'selector'  => '{{WRAPPER}} .apr-nav-menu--main > .mega-menu .sub-menu',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'submenu_border_radius',
			[
				'label'      => __( 'Border Radius', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .apr-nav-menu--main > .mega-menu .sub-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'submenu_box_shadow',
				'exclude'  => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .apr-nav-menu--main > .mega-menu .sub-menu',
			]
		);

		$this->add_responsive_control(
			'sub_menu_padding',
			[
				'label'      => __( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .apr-nav-menu--main > .mega-menu .sub-menu a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_submenu_divider',
			[
				'label'     => __( 'Divider', 'apr-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'submenu_divider',
				'selector' => '{{WRAPPER}} .apr-nav-menu--main > .mega-menu .sub-menu li:not(:first-child) > a',
				'exclude'  => [ 'width' ],
			]
		);

		$this->add_control(
			'submenu_divider_width',
			[
				'label'     => __( 'Border Width', 'apr-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .apr-nav-menu--main > .mega-menu .sub-menu li:not(:first-child) > a' => 'border-top-width: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'submenu_divider_border!' => '',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_toggle',
			[
				'label' => __( 'Toggle Button', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'toggle_menu_gradient',
				'label'    => __( 'Background Color', 'apr-core' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}}.toggle-menu-custom .menu-icon',
			]
		);
		$this->start_controls_tabs( 'tabs_toggle_style' );

		$this->start_controls_tab(
			'tab_toggle_style_normal',
			[
				'label' => __( 'Normal', 'apr-core' ),
			]
		);

		$this->add_control(
			'toggle_color',
			[
				'label'     => __( 'Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .menu-icon' => 'color: {{VALUE}}', // Harder selector to override text color control
				],
			]
		);

		$this->add_control(
			'toggle_background_color',
			[
				'label'     => __( 'Background Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .menu-icon:before' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_toggle_style_hover',
			[
				'label' => __( 'Hover', 'apr-core' ),
			]
		);

		$this->add_control(
			'toggle_color_hover',
			[
				'label'     => __( 'Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} div.menu-icon:hover' => 'color: {{VALUE}}', // Harder selector to override text color control
				],
			]
		);

		$this->add_control(
			'toggle_background_color_hover',
			[
				'label'     => __( 'Background Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .menu-icon:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'toggle_size',
			[
				'label'     => __( 'Size', 'apr-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 15,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .menu-icon' => 'font-size: {{SIZE}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'toggle_border_color',
			[
				'label'     => __( 'Border color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .menu-icon' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'toggle_border_hover_color',
			[
				'label'     => __( 'Border hover color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .menu-icon:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'toggle_border_style',
			[
				'label'       => __( 'Border Style', 'apr-core' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'none',
				'label_block' => false,
				'options'     => [
					'none'   => __( 'None', 'apr-core' ),
					'solid'  => __( 'Solid', 'apr-core' ),
					'double' => __( 'Double', 'apr-core' ),
					'dotted' => __( 'Dotted', 'apr-core' ),
					'dashed' => __( 'Dashed', 'apr-core' ),
				],
				'selectors'   => [
					'{{WRAPPER}} .menu-icon' => 'border-style: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'toggle_border_size',
			[
				'label'      => __( 'Border Width', 'apr-core' ),
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
					'{{WRAPPER}} .menu-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'toggle_border_radius',
			[
				'label'      => __( 'Border Radius', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .menu-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default'    => [
					'top'    => '',
					'bottom' => '',
					'left'   => '',
					'right'  => '',
					'unit'   => 'px',
				],
			]
		);
		$this->add_responsive_control(
			'config_toggle_padding',
			[
				'label'      => __( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .menu-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'config_toggle_margin',
			[
				'label'      => __( 'Margin', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .menu-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$available_menus = $this->get_available_menus();
		$settings =  $this->get_settings_for_display();
		if ( ! $available_menus ) { 
			return;
		}
		if (  !array_key_exists($settings['menu'],$available_menus) ) {
			return;
		}
		
		$title    = $settings['title_menu'];
		
		$args = [
			'echo'        => false,
			'menu'        => $settings['menu'],
			'menu_class'  => 'mega-menu',
			'fallback_cb' => '__return_empty_string',
			'container'   => '',
		];
		if ( 'dropdown' === $settings['layout'] ) {
			$args['menu_class'] .= ' sm-dropdown';
		}
		$classes_vertical = [];
		if ( $settings['title_toogle_menu_tablet'] == 'yes' ) {
			$classes_vertical[] = "show-toggle-tablet";
		}
		if ( $settings['title_toogle_menu_mb'] == 'yes' ) {
			$classes_vertical[] = "show-toggle-mb";
		}
		if ( $settings['show_tt_menu'] == 'yes' ) {
			$classes_vertical[] = "footer-menu-title";
		}
		// Add custom filter to handle Nav Menu HTML output.
		add_filter( 'nav_menu_link_attributes', [ $this, 'handle_link_classes' ], 10, 4 );
		add_filter( 'nav_menu_submenu_css_class', [ $this, 'handle_sub_menu_classes' ] );
		add_filter( 'nav_menu_item_id', '__return_empty_string' );

		// General Menu.
		$menu_html = wp_nav_menu( $args );

		// Dropdown Menu.
		$args['menu_class'] = 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id();
		// Remove all our custom filters.
		remove_filter( 'nav_menu_link_attributes', [ $this, 'handle_link_classes' ] );
		remove_filter( 'nav_menu_submenu_css_class', [ $this, 'handle_sub_menu_classes' ] );
		remove_filter( 'nav_menu_item_id', '__return_empty_string' );

		if ( empty( $menu_html ) ) {
			return;
		}
		$rootMenuObj = wp_get_nav_menu_object( $settings['menu'] );
		$this->add_render_attribute( 'main-menu', 'class', [
			'apr-nav-menu--main',
			'apr-nav-menu--layout-' . $settings['layout'],
		] );
		if ( $settings['menu_space_line'] == 'yes' ) {
			$this->add_render_attribute( 'main-menu', 'class', 'show-space-line' );
		}
		if ( $settings['hover_underline'] == 'yes' ) {
			$this->add_render_attribute( 'main-menu', 'class', 'hover-underline' );
		}
		if ( 'dropdown' === $settings['layout'] ) {
			$this->add_render_attribute( 'main-menu', 'class', 'menu-dropdown' );
		}
		if ( $settings['pointer'] ) :
			$this->add_render_attribute( 'main-menu', 'class', 'e--pointer-' . $settings['pointer'] );

			foreach ( $settings as $key => $value ) :
				if ( 0 === strpos( $key, 'animation' ) && $value ) :
					$this->add_render_attribute( 'main-menu', 'class', 'e--animation-' . $value );

					break;
				endif;
			endforeach;
		endif; ?>
		<?php if ( 'vertical' === $settings['layout'] ) : ?>
			<nav <?php echo $this->get_render_attribute_string( 'main-menu' ); ?>>
				<?php if ( $settings['show_tt_menu'] == 'yes' ): ?>
					<p class="<?php echo implode( ' ', $classes_vertical ) ?>">
						<?php echo $rootMenuObj->name; ?>
					</p>
				<?php endif; ?>
				<?php
				\Lusion::menu_vertical( $settings['menu'] ); ?>
			</nav>
		<?php elseif ( 'dropdown' === $settings['layout'] ) : ?>
			<div class="menu-icon">
				<i class="theme-icon-menu" aria-hidden="true"></i>
			</div>
			<nav <?php echo $this->get_render_attribute_string( 'main-menu' ); ?>>
				<?php
				\Lusion::menu_builder( $settings['menu'] );
				 ?>
			</nav>
		<?php else: ?>
			<nav <?php echo $this->get_render_attribute_string( 'main-menu' ); ?>>
				<?php if ( ! empty( $title ) ) { ?>
					<h4 class="menu-title">
						<?php echo $title; ?>
					</h4>
					<span class="caret-submenu"><i class="theme-icon-download"></i></span>
				<?php } ?>
				<?php
				\Lusion::menu_builder( $settings['menu'] );
				?>
			</nav>
		<?php endif;
	}

	public function handle_link_classes( $atts, $item, $args, $depth ) {
		$classes   = $depth ? 'elementor-sub-item' : 'apr-item';
		$is_anchor = false !== strpos( $atts['href'], '#' );

		if ( ! $is_anchor && in_array( 'current-menu-item', $item->classes ) ) {
			$classes .= ' apr-item-active';
		}

		if ( $is_anchor ) {
			$classes .= ' apr-item-anchor';
		}

		if ( empty( $atts['class'] ) ) {
			$atts['class'] = $classes;
		} else {
			$atts['class'] .= ' ' . $classes;
		}

		return $atts;
	}

	public function handle_sub_menu_classes( $classes ) {
		$classes[] = 'apr-nav-menu--dropdown';

		return $classes;
	}
}

Plugin::instance()->widgets_manager->register( new Apr_Core_Nav_Menu );
