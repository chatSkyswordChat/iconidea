<?php

namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Apr_Core_Blog extends Widget_Base {

	public function apr_sc_blog() {
		/* Import Css */
		if ( is_rtl() ) {
			wp_enqueue_style( 'apr-sc-blog', LUSION_CSS . '/elementor/blog-rtl.css', array(), LUSION_THEME_VERSION );
		} else {
			wp_enqueue_style( 'apr-sc-blog', LUSION_CSS . '/elementor/blog.css', array(), LUSION_THEME_VERSION );
		}
	}

	public function get_categories() {
		return array( 'apr-core' );
	}

	public function get_name() {
		return 'apr_blog_lusion';
	}

	public function get_title() {
		return __( 'APR Blog', 'apr-core' );
	}

	public function get_icon() {
		return 'eicon-post-excerpt';
	}

	protected function register_controls() {
		$this->start_controls_section(
			'blog_section',
			[
				'label' => __( 'APR Blog', 'apr-core' )
			]
		);
		$this->add_control(
			'blog_style',
			[
				'label'   => __( 'Blog Style', 'apr-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => __( 'Layout 1', 'apr-core' ),
					'style2' => __( 'Layout 2', 'apr-core' ),
					'style3' => __( 'Layout 3', 'apr-core' ),
					'style4' => __( 'Layout 4', 'apr-core' ),
					'style5' => __( 'Layout 5', 'apr-core' ),
					'style6' => __( 'Layout 6', 'apr-core' ),
					'style7' => __( 'Layout 7', 'apr-core' ),
					'style8' => __( 'Layout 8', 'apr-core' ),
				],
			]
		);
		$this->add_control(
			'blog_layout',
			[
				'label'     => __( 'Blog Layout', 'apr-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'list',
				'options'   => [
					'grid' => __( 'Grid', 'apr-core' ),
					'list' => __( 'List', 'apr-core' ),
				],
				'condition' => [
					'blog_style' => [ 'style7' ],
				],
			]
		);

		$this->add_control(
			'content_layout',
			[
				'label'     => __( 'Content Layout', 'apr-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'content_layout_1',
				'options'   => [
					'content_layout_1' => __( 'Content 1', 'apr-core' ),
					'content_layout_2' => __( 'Content 2', 'apr-core' ),
				],
				'condition' => [
					'blog_style' => [ 'style7' ],
				],
			]
		);

		$this->add_responsive_control(
			'content_align',
			[
				'label'     => __( 'Alignment', 'apr-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'apr-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'apr-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'apr-core' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .blog-shortcode .blog-item' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'blog_number_column',
			[
				'label'           => __( 'Number column', 'apr-core' ),
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
			'blog_select_cat',
			[
				'label'       => __( 'Select Category Post', 'apr-core' ),
				'type'        => Controls_Manager::SELECT2,
				'options'     => apr_core_check_get_cat( 'category' ),
				'multiple'    => true,
				'label_block' => true,
			]
		);
		$this->add_control(
			'blog_limit',
			[
				'label'   => __( 'Number of Posts', 'apr-core' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
			]
		);

		$this->add_control(
			'show_desc',
			[
				'label'   => __( 'Show Description', 'apr-core' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$this->add_control(
			'show_info',
			[
				'label'     => __( 'Show Author & Date', 'apr-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => [
					'blog_style' => [ 'style7' ],
				],
			]
		);
		$this->add_control(
			'limit_desc',
			[
				'label'     => __( 'Limit characters description', 'apr-core' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 80,
				'min'       => 30,
				'max'       => 500,
				'step'      => 1,
				'condition' => [
					'show_desc' => 'yes',
				],
			]
		);
		$this->add_control(
			'reading_text',
			[
				'label'       => __( 'Reading Text', 'apr-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Read more', 'apr-core' ),
				'placeholder' => 'Enter your button reading text',
				'separator'   => 'before',
				'condition'   => [
					'blog_style!' => 'style4',
				],
			]
		);

		$this->add_control(
			'show_social_sharing',
			[
				'label'     => __( 'Show Social Sharing', 'apr-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'On', 'apr-core' ),
				'label_off' => __( 'Off', 'apr-core' ),
				'default'   => 'Off',
				'condition' => [
					'blog_style'     => [ 'style7' ],
					'content_layout' => [ 'content_layout_2' ],
				],
			]
		);

		$this->add_control(
			'show_custom_image',
			[
				'label'     => __( 'Show Custom Image Size', 'apr-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'On', 'apr-core' ),
				'label_off' => __( 'Off', 'apr-core' ),
				'default'   => 'Off',
			]
		);

		$this->add_control(
			'fix_height_img_single',
			[
				'label'     => __( 'Fix single image size', 'apr-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'On', 'apr-core' ),
				'label_off' => __( 'Off', 'apr-core' ),
				'default'   => 'Off',
				'condition' => [
					'show_custom_image' => 'yes',
					'blog_style'        => 'style1',
				],
			]
		);

		$this->add_control(
			'custom_dimension',
			[
				'label'       => __( 'Image Size', 'apr-core' ),
				'type'        => Controls_Manager::IMAGE_DIMENSIONS,
				'description' => __( 'You can crop the original image size to any custom size. You can also set a single value for height or width in order to keep the original size ratio.', 'apr-core' ),
				'condition'   => [
					'show_custom_image' => 'yes',
				],
			]
		);
		$this->add_control(
			'show_cat',
			[
				'label'   => __( 'Show Category', 'apr-core' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$this->add_control(
			'blog_order_by',
			[
				'label'   => __( 'Order By', 'apr-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'id',
				'options' => [
					'id'            => __( 'Post ID', 'apr-core' ),
					'author'        => __( 'Post Author', 'apr-core' ),
					'title'         => __( 'Title', 'apr-core' ),
					'date'          => __( 'Date', 'apr-core' ),
					'rand'          => __( 'Random', 'apr-core' ),
					'comment_count' => __( 'Comment count', 'apr-core' ),
				],
			]
		);
		$this->add_control(
			'blog_order',
			[
				'label'   => __( 'Order', 'apr-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'ASC',
				'options' => [
					'ASC'  => __( 'Ascending', 'apr-core' ),
					'DESC' => __( 'Descending', 'apr-core' ),
				],
			]
		);
		$this->add_control(
			'slide_effect_auto_image',
			[
				'label'   => __( 'Slide Effect Auto Image', 'apr-core' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$this->end_controls_section();
		/*-----------------------------------------------------------------------------------*/
		/*  Style TAB
		/*-----------------------------------------------------------------------------------*/
		//Item Hover
		$this->start_controls_section(
			'title_style_section_item',
			array(
				'label' => __( 'Item', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'space_post_info_color',
			[
				'label' => __( 'Icon space Color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .post-meta-info a:before' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'show_border',
			[
				'label'     => __( 'Show Border Item', 'apr-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [
					'blog_style' => [ 'style7' ],
				],
			]
		);
		$this->add_responsive_control(
			'info_padding',
			[
				'label'      => esc_html__( 'Content Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .blog-post-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'item_box_shadow',
				'selector' => '{{WRAPPER}} .blog-item',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'item_background',
				'selector' => '{{WRAPPER}} .blog-item',
			]
		);
		$this->end_controls_section();
		//Item Hover
		$this->start_controls_section(
			'title_style_section_item_hover',
			array(
				'label' => __( 'Item Hover', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'label'    => __( 'Item Background Hover', 'apr-core' ),
				'name'     => 'item_background_hover',
				'selector' => '{{WRAPPER}} .blog-content:hover .blog-item',
			]
		);
		$this->add_control(
			'date_color_hover',
			[
				'label' => __( 'Date Hover Color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .blog-content:hover .custom-date  a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'date_background_hover',
				'selector' => '{{WRAPPER}} .blog-content:hover .custom-date',
			]
		);
		$this->add_control(
			'title_color_hover',
			[
				'label' => __( 'Title Color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .blog-content:hover .post-name a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'zoom_image_hover',
			[
				'label'     => __( 'Scale zoom image ', 'apr-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '1.1',
				'options'   => [
					'1.1' => __( '1.1', 'apr-core' ),
					'1.2' => __( '1.2', 'apr-core' ),
				],
				'selectors' => [
					'{{WRAPPER}} .blog-item .blog-img img:hover' => 'transform: scale({{VALUE}});',
				],
			]
		);
		$this->end_controls_section();
		//Category
		$this->start_controls_section(
			'title_style_section_category',
			array(
				'label'     => __( 'Category', 'apr-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'blog_style' => [ 'style7' ],
				],
			)
		);
		$this->add_responsive_control(
			'padding_category',
			[
				'label'      => __( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .blog-post-cat' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'category_bg_color',
			[
				'label' => __( 'Category Background Color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .blog-post-cat' => 'background: {{VALUE}};',
				],
				'condition' => [
					'blog_style' => [ 'style7' ],
				],
			]
		);
		$this->add_control(
			'category_color',
			[
				'label' => __( 'Category Color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .blog-post-cat a,{{WRAPPER}} .blog-post-cat' => 'color: {{VALUE}};',
				],
				'condition' => [
					'blog_style' => [ 'style7' ],
				],
			]
		);
		$this->add_control(
			'category_bg_hover_color',
			[
				'label' => __( 'Category Background Hover Color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .blog-post-cat:hover' => 'background: {{VALUE}};',
				],
				'condition' => [
					'blog_style' => [ 'style7' ],
				],
			]
		);
		$this->add_control(
			'category_hover_color',
			[
				'label' => __( 'Category Hover Color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .blog-post-cat a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'blog_style' => [ 'style7' ],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'category_typography',

				'selector'  => '{{WRAPPER}} .blog-post-cat',
				'condition' => [
					'blog_style' => [ 'style7' ],
				],
			]
		);
		$this->add_control(
			'category_position',
			[
				'label'     => __( 'Category Position', 'apr-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => [
					'default'      => __( 'Default', 'apr-core' ),
					'category_top' => __( 'Top image', 'apr-core' ),
				],
				'condition' => [
					'blog_style' => [ 'style7' ],
				],
			]
		);
		$this->end_controls_section();
		//Category
		$this->start_controls_section(
			'style_section_info',
			array(
				'label'     => __( 'Date & Author', 'apr-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'blog_style' => [ 'style7' ],
				],
			)
		);
		$this->add_control(
			'info_post_color',
			[
				'label' => __( 'Info Author & Date Color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .grid-style7 .post_date,{{WRAPPER}} .grid-style7 .post-meta-info,{{WRAPPER}} .grid-style7 .post_author' => 'color: {{VALUE}};',
				],
				'condition' => [
					'blog_style' => [ 'style7' ],
				],
			]
		);
		$this->add_control(
			'info_post_hover_color',
			[
				'label' => __( 'Info Author & Date Hover Color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .grid-style7 .post_date:hover,{{WRAPPER}} .grid-style7 .post_author:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'blog_style' => [ 'style7' ],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'info_post_typography',

				'selector'  => '{{WRAPPER}} .grid-style7 .post_date,{{WRAPPER}} .grid-style7 .post_author',
				'condition' => [
					'blog_style' => [ 'style7' ],
				],
			]
		);
		$this->end_controls_section();
		//Date
		$this->start_controls_section(
			'title_style_section',
			array(
				'label'     => __( 'Date', 'apr-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'blog_style!' => [ 'style7' ],
				],
			)
		);
		$this->add_control(
			'date_color',
			[
				'label' => __( 'Date Color', 'apr-core' ),
				'type'  => Controls_Manager::COLOR,

				'selectors' => [
					// Stronger selector to avoid section style from overwriting
					'{{WRAPPER}} .custom-date a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => __( 'Typography day', 'apr-core' ),
				'name'  => 'date_typography',

				'selector' => '{{WRAPPER}} .custom-date span.day',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => __( 'Typography month', 'apr-core' ),
				'name'  => 'date_month_typography',

				'selector' => '{{WRAPPER}} .custom-date span.mon',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'date_background',
				'selector' => '{{WRAPPER}} .custom-date',
			]
		);
		$this->end_controls_section();
		// Title.
		$this->start_controls_section(
			'section_style_title_blog_item',
			[
				'label'     => __( 'Title Item', 'apr-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'blog_style' => [ 'style1' ],
				],
			]
		);
		$this->add_control(
			'title_text_color_item',
			[
				'label'     => __( 'Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-title-box h5' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography_item',

				'selector' => '{{WRAPPER}} .blog-title-box h5',
			]
		);
		$this->end_controls_section();
		// Title blog
		$this->start_controls_section(
			'section_style_title_blog',
			[
				'label' => __( 'Title blog', 'apr-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label'      => esc_html__( 'Margin', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .post-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_text_color',
			[
				'label'     => __( 'Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-name a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_text_color_hover',
			[
				'label'     => __( 'Hover color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-name a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',

				'selector' => '{{WRAPPER}} .post-name a',
			]
		);
		$this->end_controls_section();
		// Description blog
		$this->start_controls_section(
			'section_style_description_blog',
			[
				'label'     => __( 'Description blog', 'apr-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_desc' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'description_margin',
			[
				'label'      => esc_html__( 'Margin', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .blog_post_desc.show-desc ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'description_text_color',
			[
				'label'     => __( 'Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog_post_desc p,{{WRAPPER}} .blog_post_desc' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'selector' => '{{WRAPPER}} .blog_post_desc.show-desc',
			]
		);
		$this->end_controls_section();
		// Readmore blog
		$this->start_controls_section(
			'section_style_readmore_blog',
			[
				'label'     => __( 'Read More', 'apr-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'blog_style!' => 'style4',
				],
			]
		);
		$this->add_control(
			'button_text_color',
			[
				'label'     => __( 'Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .read_more a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'line_color',
			[
				'label'     => __( 'Line Color Bottom', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .read_more a' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'line_color_style5',
			[
				'label'     => __( 'Line Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .read_more a:before' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'blog_style' => [ 'style5' ],
				],
			]
		);

		$this->add_control(
			'button_text_color_hover',
			[
				'label'     => __( 'Hover Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .read_more a:hover'        => 'color: {{VALUE}};border-color: {{VALUE}};',
					'{{WRAPPER}} .read_more a:hover:before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',

				'selector' => '{{WRAPPER}} .read_more a',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'button_text_border',
				'selector'  => '{{WRAPPER}} .read_more a',
				'condition' => [
					'blog_style'     => [ 'style7' ],
					'content_layout' => [ 'content_layout_2' ],
				],
			]
		);
		$this->add_responsive_control(
			'button_text_padding',
			[
				'label'      => esc_html__( 'Padding', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .read_more a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'blog_style'     => [ 'style7' ],
					'content_layout' => [ 'content_layout_2' ],
				],
			]
		);
		$this->add_responsive_control(
			'button_text_margin',
			[
				'label'      => esc_html__( 'Margin', 'apr-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .read_more a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'blog_style'     => [ 'style7' ],
					'content_layout' => [ 'content_layout_2' ],
				],
			]
		);
		$this->end_controls_section();
		// Social blog
		$this->start_controls_section(
			'section_style_social_blog',
			[
				'label'     => __( 'Social', 'apr-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'blog_style'     => [ 'style7' ],
					'content_layout' => [ 'content_layout_2' ],
				],
			]
		);


		$this->add_control(
			'color_social',
			[
				'label'     => __( 'Social Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-shortcode .read_more .social .btn--share,{{WRAPPER}} .blog-shortcode .read_more .social' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'border_color_social',
			[
				'label'     => __( 'Social Border Color', 'apr-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-shortcode .read_more .social .btn--share,{{WRAPPER}} .blog-shortcode .read_more .social .read-more-blog' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$this->apr_sc_blog();
		$settings       = $this->get_settings_for_display();
		$cat_post       = $settings['blog_select_cat'];
		$column_desktop = $settings['blog_number_column'];
		$column_tablet  = isset( $settings['blog_number_column_tablet'] );
		$column_mobile  = isset( $settings['blog_number_column_mobile'] );
		if ( isset( $column_desktop ) && $column_desktop ) {
			$column_desktop = $settings['blog_number_column'];
		} else {
			$column_desktop = 3;
		}
		if ( isset( $column_tablet ) && $column_tablet ) {
			$column_tablet = $settings['blog_number_column_tablet'];
		} else {
			$column_tablet = 2;
		}
		if ( isset( $column_mobile ) && $column_mobile ) {
			$column_mobile = $settings['blog_number_column_mobile'];
		} else {
			$column_mobile = 1;
		}
		$blog_style              = $settings['blog_style'];
		$limit_post              = $settings['blog_limit'];
		$order_by_post           = $settings['blog_order_by'];
		$order_post              = $settings['blog_order'];
		$show_border             = $settings['show_border'];
		$limit_desc              = $settings['limit_desc'];
		$blog_layout             = $settings['blog_layout'];
		$content_layout          = $settings['content_layout'];
		$category_position       = $settings ['category_position'];
		$show_custom_image       = $settings['show_custom_image'];
		$show_cat                = $settings['show_cat'];
		$custom_dimension        = $settings['custom_dimension'];
		$show_desc               = $settings['show_desc'];
		$show_info               = $settings['show_info'];
		$show_social_sharing     = $settings['show_social_sharing'];
		$reading_text            = $settings['reading_text'];
		$fix_height_img_single   = $settings['fix_height_img_single'];
		$slide_effect_auto_image = $settings['slide_effect_auto_image'];
		$show_desc_blog          = $class_effect = $show_border_class = $category_position_class = '';
		if ( $show_desc === 'yes' ) {
			$show_desc_blog = 'show-desc';
		}
		if ( $show_border === 'yes' ) {
			$show_border_class = 'has_border';
		}
		if ( $category_position === 'category_top' ) {
			$category_position_class = 'category_top_image';
		}
		if ( $slide_effect_auto_image === 'yes' ) {
			$class_effect = 'show-slide-effect';
		}
		if ( $show_custom_image === 'yes' ) {
			$has_custom_size = false;
			if ( ! empty( $custom_dimension['width'] ) ) {
				$has_custom_size    = true;
				$attachment_size[0] = $custom_dimension['width'];
			}

			if ( ! empty( $custom_dimension['height'] ) ) {
				$has_custom_size    = true;
				$attachment_size[1] = $custom_dimension['height'];
			}

			if ( ! $has_custom_size ) {
				$attachment_size = 'full';
			}
		} else {
			if ( $blog_style === "style8" ) {
				$attachment_size[0] = 767;
				$attachment_size[1] = 487;
			} elseif ( $blog_style === "style7" ) {
				$attachment_size[0] = 500;
				$attachment_size[1] = 367;
			} else {
				$attachment_size[0] = 767;
				$attachment_size[1] = 767;
			}
		}

		if ( ! empty( $cat_post ) ) :
			$apr_post_type_arg = array(
				'post_type'      => 'post',
				'posts_per_page' => $limit_post,
				'orderby'        => $order_by_post,
				'order'          => $order_post,
				'col_desktop'    => $column_desktop,
				'col_tablet'     => $column_tablet,
				'col_mobile'     => $column_mobile,
				'tax_query'      => array(
					array(
						'taxonomy' => 'category',
						'field'    => 'slug',
						'terms'    => $cat_post
					)
				)
			);
		else:
			$apr_post_type_arg = array(
				'post_type'      => 'post',
				'posts_per_page' => $limit_post,
				'orderby'        => $order_by_post,
				'order'          => $order_post,
				'col_desktop'    => $column_desktop,
				'col_tablet'     => $column_tablet,
				'col_mobile'     => $column_mobile,
			);
		endif;
		$col_desktop    = 12 / $column_desktop;
		$col_tablets    = 12 / $column_tablet;
		$col_mobile     = 12 / $column_mobile;
		global $wp_query, $post;
		query_posts( $apr_post_type_arg );

		//$post = new WP_Query($apr_post_type_arg);

		if ( have_posts() ) :
			$id = 'apr-blog-' . wp_rand();
			$id_img     = 'blog-img-' . wp_rand();
			$is_rtl     = is_rtl();
			$direction  = $is_rtl ? 'true' : 'false';
			$gallery_id = 'gallery_id-' . wp_rand();
			?>
		<div id="<?php echo esc_attr( $id ); ?>" class="blog-shortcode
            <?php if ( $blog_style === 'style1' ) {
			echo 'grid-style1 ';
		} ?>
            <?php if ( $blog_style === 'style2' ) {
			echo 'grid-style2 blog-slide ';
		} ?>
            <?php if ( $blog_style === 'style4' ) {
			echo 'grid-style4 ';
		} ?>
            <?php if ( $blog_style === 'style5' ) {
			echo 'grid-style5 ';
		} ?>
            <?php if ( $blog_style === 'style7' ) {
			echo 'grid-style7 row';
		} ?>
            <?php if ( $blog_style === 'style8' ) {
			echo 'grid-style8 blog-slide ';
		} ?>
            <?php if ( $blog_style === 'style6' ) {
			echo 'grid-style1 grid-style6';
		} ?>
            <?php if ( $blog_style === 'style3' ) {
			echo 'grid-style3 has-date blog-slide';
		} ?> <?php echo esc_attr( $class_effect ); ?>
            <?php if ( $blog_layout === 'grid' ) {
			echo ' blog-layout-grid';
		} ?><?php if ( $content_layout === 'content_layout_2' ) {
			echo ' content_layout_2';
		} ?>">
			<?php $i = 0;
		while ( have_posts() ):
			the_post();
			 ?>
			<?php
			$format_class = '';
			if ( ! has_post_thumbnail() ) {
				$format_class = 'no-image';
			} elseif ( get_post_format() === 'quote' ) {
				$format_class = 'post-quote';
			} elseif ( get_post_format() === 'link' ) {
				$format_class = 'post-link';
			} elseif ( get_post_format() === 'audio' ) {
				$format_class = 'post-audio';
			} elseif ( get_post_format() === 'video' ) {
				$format_class = 'post-video';
			} elseif ( get_post_format() === 'image' ) {
				$format_class = 'post-image';
			} else {
				$format_class = 'blog-has-img';
			}
			?>
			<?php if ( $blog_style === 'style7' ): ?>
			<?php if ( $content_layout === 'content_layout_2' && $blog_layout === 'grid' ): ?>
			<div
				class="item <?php echo esc_attr( $category_position_class ); ?><?php echo esc_attr( $show_border_class ); ?> col-lg-12 col-md-12 col-sm-12">
			<?php else: ?>
			<div
				class="item <?php echo esc_attr( $category_position_class ); ?><?php echo esc_attr( $show_border_class ); ?> col-lg-<?php echo esc_html( $col_desktop ) ?> col-md-<?php echo esc_html( $col_tablets ) ?> col-sm-<?php echo esc_html( $col_mobile ) ?>">
			<?php endif; ?>
			<?php else: ?>
			<div class="item <?php if ( is_sticky() ) {
				echo 'post_sticky';
			} ?> ">
				<?php endif; ?>
				<div class="blog-content">
					<div class="blog-item <?php echo esc_attr( $format_class ); ?>">
						<?php if ( has_post_thumbnail() && get_post_format() !== 'quote' && get_post_format() !== 'audio' && get_post_format() !== 'video' && get_post_format() !== 'link' ): ?>
							<div class="blog-img">
								<a href="<?php the_permalink(); ?>">
									<?php
									if ( $fix_height_img_single === 'yes' ) {
										if ( $i == 2 ) {
											$image_size_item = array(858,480);
										} else {
											$image_size_item = array($attachment_size[0],$attachment_size[1]);
										}
									} else {
										$image_size_item = array($attachment_size[0],$attachment_size[1]);
									}
									$i ++;
									the_post_thumbnail($image_size_item, array(
										"alt" => get_the_title(),
									));
//									echo get_the_post_thumbnail(null, $image_size_item, array(
//										"alt" => get_the_title(),
//									));
									?>
								</a>
								<?php if ( $blog_style === 'style8' ): ?>
									<?php if ( $show_cat === 'yes' ): ?>
										<div class="blog-post-cat">
											<?php
											$cate = get_the_term_list( $post->ID, 'category', '', ', ' );
											echo get_the_term_list( $post->ID, 'category', '', ',&nbsp;', '' );
											?>
										</div>
									<?php endif; ?>
								<?php endif; ?>
								<?php if ( $blog_style === 'style3' ) { ?>
									<div class="custom-date ">
										<a href="<?php the_permalink(); ?>">
											<span class="day"><?php echo get_the_date( 'j' ); ?></span>
											<span class="mon"><?php echo get_the_date( "M" ); ?></span>
										</a>
									</div>
								<?php } ?>
							</div>
						<?php elseif ( ( get_post_format() == 'quote' ) ): ?>
							<?php
							$quote_text = get_post_meta( get_the_ID(), 'post_quote_text', true );
							?>
							<?php if ( $quote_text && $quote_text != '' ): ?>
								<div class="quote_section">
									<blockquote class="var3">
										<p><?php echo wp_kses( $quote_text, array() ); ?></p>
									</blockquote>
								</div>
							<?php endif; ?>
						<?php elseif ( ( get_post_format() == 'audio' ) ): ?>
							<?php $audio = get_post_meta( get_the_ID(), 'post_audio', true ); ?>
							<?php if ( $audio && $audio != '' ): ?>
								<div class="blog-img blog-audio">
									<?php echo '<div class="iframe_audio_container">';
									?>
									<?php echo wp_oembed_get( $audio, array( 'height' => 230 ) ); ?>
									<?php echo '</div>';
									?>
									<?php if ( $blog_style === 'style8' ): ?>
										<?php if ( $show_cat === 'yes' ): ?>
											<div class="blog-post-cat">
												<?php
												$cate = get_the_term_list( $post->ID, 'category', '', ', ' );
												echo get_the_term_list( $post->ID, 'category', '', ',&nbsp;', '' );
												?>
											</div>
										<?php endif; ?>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						<?php elseif ( get_post_format() == 'link' ): ?>
							<?php
							$link       = get_post_meta( get_the_ID(), 'post_link', true );
							$link_title = get_post_meta( get_the_ID(), 'post_link', true );
							?>
							<?php if ( $link && $link != '' ): ?>
								<div class="blog-img">
									<a href="<?php the_permalink(); ?>">
										<?php
										echo get_the_post_thumbnail(null, array($attachment_size[0],$attachment_size[1]));
										?>

									</a>
									<?php if ( $blog_style === 'style8' ): ?>
										<?php if ( $show_cat === 'yes' ): ?>
											<div class="blog-post-cat">
												<?php
												$cate = get_the_term_list( $post->ID, 'category', '', ', ' );
												echo get_the_term_list( $post->ID, 'category', '', ',&nbsp;', '' );
												?>
											</div>
										<?php endif; ?>
									<?php endif; ?>
									<?php if ( $blog_style === 'style3' ) { ?>
										<div class="custom-date ">
											<a href="<?php the_permalink(); ?>">
												<span class="day"><?php echo get_the_date( "j" ); ?></span>
												<span class="mon"><?php echo get_the_date( "M" ); ?></span>
											</a>
										</div>
									<?php } ?>
								</div>
								<div class="link_section clearfix">
									<div class="link-icon">
										<a class="link-post"
										   href="<?php echo esc_url( is_ssl() ? str_replace( 'http://', 'https://', $link ) : $link ); ?>">
											<i class="fa fa-link"></i>
										</a>
									</div>
								</div>
							<?php endif; ?>
						<?php elseif ( get_post_format() === 'video' ): ?>
							<?php $video = get_post_meta( get_the_ID(), 'post_video', true ); ?>
							<?php if ( $video && $video != '' ): ?>
								<?php if ( has_post_thumbnail() ): ?>
									<div class="blog-video blog-img">
										<a class="fancybox" data-fancybox href="<?php echo esc_url( $video ); ?>">
											<?php
												echo get_the_post_thumbnail(null, array($attachment_size[0],$attachment_size[1]));
											?>
											<i class="fas fa-play"></i>
										</a>
										<?php if ( $blog_style === 'style3' ) { ?>
											<div class="custom-date ">
												<a href="<?php the_permalink(); ?>">
													<span class="day"><?php echo get_the_date( "j" ); ?></span>
													<span class="mon"><?php echo get_the_date( "M" ); ?></span>
												</a>
											</div>
										<?php } ?>
									</div>
								<?php endif; ?>
							<?php endif; ?>
						<?php endif; ?>
						<div class="blog-post-info">
							<?php if ( $blog_style === 'style7' && $show_info === 'yes' && $content_layout === 'content_layout_1' ): ?>
								<div class="post-meta-info">
									<a class="post_date" href="<?php the_permalink(); ?>">
										<?php echo get_the_date(); ?>
									</a>
									<?php echo esc_html__( 'by', 'apr-core' ); ?><a class="post_author"
																					href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
										<?php the_author(); ?>
									</a>
								</div>
							<?php endif; ?>
							<?php if ( $blog_style === 'style8' ): ?>
								<a class="post_author"
								   href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
									<?php if ( $avatar = get_avatar( get_the_author_meta( 'ID' ) ) !== false ): ?>
										<img
											src="<?php echo esc_url( get_avatar_url( get_the_author_meta( 'ID' ) ) ); ?>"
											alt="<?php get_the_title(); ?>"/>
									<?php endif; ?>

								</a>
							<?php endif; ?>
							<?php if ( $blog_style !== 'style8' ): ?>
								<?php if ( $show_cat === 'yes' ): ?>
									<div class="blog-post-cat">
										<?php
										$cate = get_the_term_list( $post->ID, 'category', '', ', ' );
										echo get_the_term_list( $post->ID, 'category', '', ',&nbsp;', '' );
										?>
									</div>
								<?php endif; ?>
							<?php endif; ?>
							<h4 class="post-name"><a href="<?php the_permalink(); ?>"
													 title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
							</h4>
							<?php if ( $blog_style === 'style7' && $show_info === 'yes' && $content_layout === 'content_layout_2' ): ?>
								<div class="post-meta-info">
									<a class="post_date" href="<?php the_permalink(); ?>">
										<?php echo get_the_date( 'd | m | Y' ); ?>
									</a>
								</div>
							<?php endif; ?>
							<?php if ( get_post_format() === 'video' && $blog_style === 'style4' ): ?>
								<?php $video = get_post_meta( get_the_ID(), 'post_video', true ); ?>
								<?php if ( $video && $video != '' ): ?>
									<p class="watch-video"><a class="fancybox" data-fancybox
															  href="<?php echo esc_url( $video ); ?>"><?php echo esc_html__( 'Watch Video', 'apr-core' ); ?>
											<i class="fas fa-play"></i></a></p>
								<?php endif; ?>
							<?php endif; ?>
							<?php if ( $show_desc_blog ): ?>
								<div class="blog_post_desc <?php echo esc_attr( $show_desc_blog ); ?>">
									<?php
									lusion_limit_excerpt( $limit_desc );
									?>
								</div>
							<?php endif; ?>
							<?php if ( $blog_style !== 'style4' && $reading_text != '' ): ?>
								<div
									class="read_more<?php if ( $blog_style === 'style7' && $show_social_sharing === 'yes' && $content_layout === 'content_layout_2' ) {
										echo ' content_layout_2';
									} ?>">
									<a href="<?php the_permalink(); ?>"><?php echo $reading_text; ?></a>
									<?php if ( $blog_style === 'style7' && $show_social_sharing === 'yes' && $content_layout === 'content_layout_2' ): ?>
										<div class="social">
											<span class="theme-icon-share read-more-blog"></span>
											<ul class="social-sharing">
												<li>
													<a target="_blank"
													   href="//www.facebook.com/sharer.php?u=<?php the_permalink(); ?>"
													   class="btn btn--small btn--share share-facebook" tabindex="-1"
													   rel="noopener">
														<i class="theme-icon-facebook"></i>
													</a>
												</li>
												<li>
													<a target="_blank"
													   href="//twitter.com/share?text=&amp;url=<?php the_permalink(); ?>"
													   class="btn btn--small btn--share share-twitter" tabindex="-1"
													   rel="noopener">
														<i class="theme-icon-twitter"></i>
													</a>
												</li>
												<li>
													<a target="_blank"
													   href="//pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo esc_url( $image ); ?>&amp;description="
													   class="btn btn--small btn--share share-pinterest" tabindex="-1"
													   rel="noopener">
														<i class="theme-icon-pinterest"></i>
													</a>
												</li>
											</ul>
										</div>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		<?php endwhile;
			wp_reset_query(); ?>
			</div>
			<?php if ( $blog_style === 'style1' || $blog_style === 'style6' ) { ?>
			<script>
				jQuery(document).ready(function ($) {
					$('#<?php echo esc_js( $id );?>.grid-style1').slick({
						dots         : false,
						arrows       : true,
						speed        : 300,
						rows         : 2,
						rtl          : <?php echo esc_attr( $direction );?>,
						centerPadding: '0',
						slidesToShow :<?php echo esc_attr( $column_desktop );?>,
						prevArrow    : $('.prev'),
						nextArrow    : $('.next'),
						swipe        : false,
						responsive   : [
							{
								breakpoint: 1025,
								settings  : {
									rows        : 1,
									slidesToShow: <?php echo esc_attr( $column_tablet );?>,
									swipe       : true,
								}

							},
							{
								breakpoint: 768,
								settings  : {
									rows        : 1,
									slidesToShow: <?php echo esc_attr( $column_mobile );?>,
									swipe       : true,
								}
							}
						]
					});
				});
			</script>
		<?php }elseif ( $blog_style === 'style2' || $blog_style === 'style3' || $blog_style === 'style8' ){ ?>
			<script>
				jQuery(document).ready(function ($) {
					$('#<?php echo esc_js( $id );?>.blog-slide').slick({
						dots         : false,
						arrows       : true,
						speed        : 300,
						rtl          : <?php echo esc_attr( $direction );?>,
						centerPadding: '0',
						centerMode   : true,
						slidesToShow :<?php echo esc_attr( $column_desktop );?>,
						prevArrow    : $('.prev'),
						nextArrow    : $('.next'),
						swipe        : false,
						responsive   : [
							{
								breakpoint: 1025,
								settings  : {
									slidesToShow: <?php echo esc_attr( $column_tablet );?>,
									swipe       : true,
								}
							},
							{
								breakpoint: 768,
								settings  : {
									slidesToShow: <?php echo esc_attr( $column_mobile );?>,
									swipe       : true,
								}
							}
						]
					});
				});
			</script>
		<?php }elseif ( $blog_style === 'style5' ){ ?>
			<script>
				jQuery(document).ready(function ($) {
					$('#<?php echo esc_js( $gallery_id );?>').slick({
						dots          : false,
						arrows        : true,
						speed         : 300,
						rtl           : <?php echo esc_attr( $direction );?>,
						slidesToShow  : 2,
						slidesToScroll: 2,
						prevArrow     : $('.prev'),
						nextArrow     : $('.next')
					});
				});
			</script>
		<?php }elseif ( $blog_style === 'style7' && $content_layout === 'content_layout_2' && $blog_layout === 'grid' ){ ?>
			<script>
				jQuery(document).ready(function ($) {
					$('#<?php echo esc_js( $id );?>').slick({
						dots          : true,
						arrows        : false,
						speed         : 300,
						rtl           : <?php echo esc_attr( $direction );?>,
						slidesToShow  : 3,
						slidesToScroll: 1,
						prevArrow     : $('.prev'),
						nextArrow     : $('.next'),
						responsive    : [
							{
								breakpoint: 1025,
								settings  : {
									slidesToShow: 2,
								}

							},
							{
								breakpoint: 768,
								settings  : {
									slidesToShow: 1,
								}
							}
						]
					});
				});
			</script>
		<?php } ?>
			<?php if ( $blog_style === 'style6' ) { ?>
			<script>
				jQuery(document).ready(function ($) {
					setInterval(function () {
						if ($(window).width() > 1024) {
							var slick_slide = $('#<?php echo esc_js( $id );?>.grid-style6 .slick-slide');
							for (var i = 0; i < slick_slide.length; i++) {
								var href = $(slick_slide[i]).hasClass('slick-current');
								if (!href) {
									$(slick_slide[i]).addClass('col-right-blog');
								}
							}
							var height_blog_left = $('#<?php echo esc_js( $id );?>.grid-style6 .slick-slide.slick-current.slick-active').height() - 6;
							var height_blog_right = $('#<?php echo esc_js( $id );?>.grid-style6 .slick-slide.col-right-blog.slick-active .blog-content .blog-img').height();
							$('#<?php echo esc_js( $id );?>.grid-style6 .slick-slide.col-right-blog.slick-active .blog-content .blog-post-info').css('height', height_blog_left - height_blog_right);
							$('#<?php echo esc_js( $id );?>.grid-style6 .slick-slide.slick-active:not(.col-right-blog) .blog-content .blog-post-info').removeAttr('style');
						} else {
							$('#<?php echo esc_js( $id );?>.grid-style6 .slick-slide.col-right-blog.slick-active .blog-content .blog-post-info').removeAttr('style');
						}
					}, 100);
				});
			</script>
		<?php } ?>
			<?php if ( $blog_style === 'style1' ) { ?>
			<script>
				jQuery(document).ready(function ($) {
					if ($(window).width() > 1024) {
						var slick_slide = $('.js-fix-height #<?php echo esc_js( $id );?>.grid-style1 .slick-slide');
						for (var i = 0; i < slick_slide.length; i++) {
							var href = $(slick_slide[i]).hasClass('slick-current');
							if (!href) {
								$(slick_slide[i]).addClass('col-right-blog');
							}
						}

						setInterval(function () {
							var height_blog_left = $('.js-fix-height #<?php echo esc_js( $id );?>.grid-style1 .slick-slide.slick-current.slick-active').height() - 6;
							var height_blog_right = $('.js-fix-height #<?php echo esc_js( $id );?>.grid-style1 .slick-slide.col-right-blog.slick-active .blog-content .blog-img').height();
							$('.js-fix-height #<?php echo esc_js( $id );?>.grid-style1 .slick-slide.col-right-blog.slick-active .blog-content .blog-post-info').css('height', height_blog_left - height_blog_right);
						}, 100);

						$(window).resize(function () {
							var height_blog_left = $('.js-fix-height #<?php echo esc_js( $id );?>.grid-style1 .slick-slide.slick-current.slick-active').height() - 6;
							var height_blog_right = $('.js-fix-height #<?php echo esc_js( $id );?>.grid-style1 .slick-slide.col-right-blog.slick-active .blog-content .blog-img').height();
							$('.js-fix-height #<?php echo esc_js( $id );?>.grid-style1 .slick-slide.col-right-blog.slick-active .blog-content .blog-post-info').css('height', height_blog_left - height_blog_right);
						});
					}
				});
			</script>

		<?php } ?>
		<?php endif;
	}
}

Plugin::instance()->widgets_manager->register( new Apr_Core_Blog() );
