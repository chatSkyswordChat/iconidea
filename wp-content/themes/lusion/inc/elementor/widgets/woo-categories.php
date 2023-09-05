<?php

namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( class_exists( 'WooCommerce' ) ) {
	class Apr_Core_Woo_categories extends Widget_Base {
		public function apr_sc_categories() {
			/* Import Css */
			if ( is_rtl() ) {
				wp_enqueue_style( 'apr-sc-categories', LUSION_CSS . '/elementor/categories-rtl.css', array(), LUSION_THEME_VERSION );
			} else {
				wp_enqueue_style( 'apr-sc-categories', LUSION_CSS . '/elementor/categories.css', array(), LUSION_THEME_VERSION );
			}
		}

		public function get_name() {
			return 'apr_woo_categories';
		}

		public function get_title() {
			return __( 'APR Woo - Categories', 'apr-core' );
		}

		public function get_icon() {
			return 'eicon-woocommerce';
		}

		public function get_categories() {
			return array( 'apr-core' );
		}

		protected function register_controls() {
			$this->start_controls_section(
				'woo_categories_section',
				array(
					'label' => __( 'Content', 'apr-core' ),
				)
			);

			$this->add_control(
				'category_style',
				[
					'label'   => __( 'Category Style', 'apr-core' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'style2',
					'options' => [
						'style2' => __( 'Layout 1', 'apr-core' ),
						'style3' => __( 'Layout 2', 'apr-core' ),
						'style4' => __( 'Layout 3', 'apr-core' ),
					],
				]
			);
			$this->add_control(
				'show_slider',
				[
					'label'        => __( 'Show Slider', 'apr-core' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'no',
					'return_value' => 'yes',
					'condition'    => [
						'category_style' => 'style3',
					],
				]
			);
			$this->add_responsive_control(
				'cate_number_column',
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
					'condition'       => [
						'category_style' => [ 'style3' ],
						'show_slider'    => 'yes',
					],
				]
			);
			$this->add_responsive_control(
				'cate_image',
				array(
					'label'     => __( 'Image', 'apr-core' ),
					'type'      => Controls_Manager::MEDIA,
					'dynamic'   => array(
						'active' => true,
					),
					'default'   => array(
						'url' => Utils::get_placeholder_image_src(),
					),
					'condition' => [
						'show_slider!' => 'yes',
					],

				)
			);
			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name'      => 'cate_image',
					'default'   => 'large',
					'separator' => 'none',
					'condition' => [
						'show_slider!' => 'yes',
					],
				]
			);
			$this->add_control(
				'category_filter',
				[
					'label'    => __( 'Category Filter', 'apr-core' ),
					'type'     => Controls_Manager::SELECT,
					'multiple' => true,
					'default'  => 'uncategorized',
					'options'  => apr_core_check_get_cat( 'product_cat' ),
				]
			);
			$this->add_control(
				'cate_alignment',
				[
					'label'          => __( 'Alignment', 'apr-core' ),
					'type'           => Controls_Manager::CHOOSE,
					'default'        => 'left',
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
					'selectors'      => [
						'{{WRAPPER}} .woo-list-category' => 'text-align: {{VALUE}}',

					],
				]
			);
			$this->end_controls_section();
			$this->start_controls_section(
				'section_style_content',
				[
					'label' => __( 'Content', 'apr-core' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_responsive_control(
				'item_cate_padding',
				[
					'label'      => __( 'Item Padding', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors'  => [
						'{{WRAPPER}} .woo-list-category.style3 .cat-list-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .woo-list-category.style3'                => 'margin: {{TOP}}{{UNIT}} -{{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} -{{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .woo-list-category.style3 .slick-arrow'   => 'right: {{RIGHT}}{{UNIT}};'
					],
					'condition'  => [
						'category_style' => 'style3',
					],

				]
			);
			$this->add_control(
				'category_content_bg_color',
				[
					'label'     => esc_html__( 'Background Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .woo-list-category' => 'background-color: {{VALUE}};',
					],
					'condition' => [
						'category_style' => 'style2',
					],
				]
			);
			$this->add_responsive_control(
				'category_content_padding',
				[
					'label'      => esc_html__( 'Content Padding', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .woo-list-category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'  => [
						'category_style' => 'style2',
					],
				]
			);
			$this->add_responsive_control(
				'image_margin_bottom',
				[
					'label'      => __( 'Images Spacing', 'apr-core' ),
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
					'selectors'  => [
						'{{WRAPPER}} .woo-list-category .cate-list' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
					'separator'  => 'after',
					'condition'  => [
						'category_style' => 'style2',
					],
				]
			);
			$this->add_control(
				'text_above_color',
				[
					'label'     => __( 'Title Categories Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .woo-list-category .list-cate-title' => 'color: {{VALUE}}',

					],
				]
			);
			$this->add_control(
				'text_above_hover_color',
				[
					'label'     => __( 'Title Categories Hover Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .woo-list-category .list-cate-title:hover' => 'color: {{VALUE}}',

					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'  => 'text_above_typo',
					'label' => __( 'Title Categories Typography', 'apr-core' ),

					'selector' => '{{WRAPPER}} .woo-list-category .list-cate-title',
				]
			);
			$this->add_responsive_control(
				'img_margin_bottom',
				[
					'label'      => esc_html__( 'Image Margin Bottom', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .woo-list-category.style3 .cat-list-item img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'  => [
						'category_style' => 'style3',
					],
				]
			);
			$this->add_responsive_control(
				'text_above_padding',
				[
					'label'      => esc_html__( 'Content Title Padding', 'apr-core' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .woo-list-category .list-cate-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'condition'  => [
						'category_style' => [ 'style2', 'style3' ],
					],
				]
			);

			$this->add_responsive_control(
				'text_above_margin_bottom',
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
							'max' => 1000,
						],
					],
					'size_units' => [ 'px' ],
					'selectors'  => [
						'{{WRAPPER}} .woo-list-category .list-cate-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
					'separator'  => 'after',
					'condition'  => [
						'category_style' => 'style2',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'      => 'text_above_border',
					'selector'  => '{{WRAPPER}} .woo-list-category .list-cate-title',
					'condition' => [
						'category_style!' => 'style3',
					],
				]
			);
			$this->add_control(
				'text_cats_total_color',
				[
					'label'     => __( 'Total Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .woo-list-category .cats-total' => 'color: {{VALUE}}',

					],
					'condition' => [
						'category_style' => 'style2',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'  => 'text_cats_total_typo',
					'label' => __( 'Total Typography', 'apr-core' ),

					'selector'  => '{{WRAPPER}} .woo-list-category .cats-total',
					'condition' => [
						'category_style' => 'style2',
					],
				]
			);
			$this->add_control(
				'text_below_color',
				[
					'label'     => __( 'Sub Title Categories Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .woo-list-category ul.children-cate li a' => 'color: {{VALUE}}',

					],
					'condition' => [
						'category_style' => 'style1',
					],
				]
			);
			$this->add_control(
				'text_below_hover_color',
				[
					'label'     => __( 'Sub Title Categories Hover Color', 'apr-core' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .woo-list-category ul.children-cate li a:hover' => 'color: {{VALUE}}',

					],
					'condition' => [
						'category_style' => 'style1',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'  => 'text_below_typo',
					'label' => __( 'Sub Title Categories Typography', 'apr-core' ),

					'selector'  => '{{WRAPPER}} .woo-list-category ul.children-cate li a',
					'condition' => [
						'category_style' => 'style1',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'      => 'text_below_border',
					'selector'  => '{{WRAPPER}} .woo-list-category ul.children-cate li',
					'condition' => [
						'category_style!' => 'style3',
					],
				]
			);
			$this->end_controls_section();
		}

		protected function render() {
			$this->apr_sc_categories();
			$settings       = $this->get_settings_for_display();
			$category       = $settings['category_filter'];
			$cate_alignment = $settings['cate_alignment'];
			$category_style = isset( $settings['category_style'] ) ? $settings['category_style'] : 'style1';
			$show_slider    = $settings['show_slider'];
			$column_desktop = isset( $settings['cate_number_column'] ) ? $settings['cate_number_column'] : 3;
			$column_tablet  = isset( $settings['cate_number_column_tablet'] ) ? $settings['cate_number_column_tablet'] : 2;
			$column_mobile  = isset( $settings['cate_number_column_mobile'] ) ? $settings['cate_number_column_mobile'] : 1;
			$is_rtl         = is_rtl();
			$direction      = $is_rtl ? 'true' : 'false';
			$align          = $class_has_slider = '';
			if ( $show_slider === 'yes' ) {
				$class_has_slider = 'has-slider';
			} else {
				$class_has_slider = 'no-slider';
			}
			if ( $cate_alignment === 'left' ) {
				$align = 'al-left';
			} elseif ( $cate_alignment === 'right' ) {
				$align = 'al-right';
			} else {
				$align = 'al-center';
			}
			if ( $category !== '' ) {
				$term = get_term_by( 'slug', $category, 'product_cat' );
				if ( is_wp_error( $term ) ) {
					$term = 'uncategorized';
				}
			} else {
				$term = 'uncategorized';
			}
			$id             = 'apr_woo_categories_' . wp_rand();
			$cate_thumb_url = Group_Control_Image_Size::get_attachment_image_html( $settings, 'cate_image', 'cate_image' );

			/* Import js */
			wp_enqueue_script( 'apr-sc-categories-script', LUSION_JS . '/elementor/woo-categories.min.js', array() );


			if ( $category_style !== 'style3' || ( $category_style === 'style3' && $show_slider !== 'yes' ) ) {
				if ( $term != '' ) { ?>
					<div class="woo-list-category <?php echo esc_attr( $category_style ); ?>">
						<div class="cate-list">
							<?php if ( ! empty( $cate_thumb_url ) ) { ?>
								<a href="<?php echo get_term_link( $term, 'product_cat' ); ?>" class="cate-thumb">
									<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'cate_image', 'cate_image' ); ?>
								</a>
							<?php }
							?>
						</div>
						<?php if ( $category_style === 'style4' ){ ?>
						<div class="info-woo-category">
							<?php } ?>
							<a href="<?php echo get_term_link( $term, 'product_cat' ); ?>" class="list-cate-title">
								<?php echo $term->name; ?>
							</a>
							<p class="cats-total">
								<?php
								if ( $category_style === 'style3' ) {
									if ( $term->count <= 1 ) {
										echo $term->count . esc_html__( ' item ', 'apr-core' );
									} else {
										echo $term->count . esc_html__( ' items ', 'apr-core' );
									}
								} else {
									if ( $term->count <= 1 ) {
										echo $term->count . esc_html__( ' item ', 'apr-core' );
									} else {
										echo $term->count . esc_html__( ' items ', 'apr-core' );
									}
								}
								?>
							</p>
							<?php if ( $category_style === 'style4' ){ ?>
						</div>
					<?php } ?>
					</div>
					<?php
				}
			}
			if ( $category_style === 'style3' && $show_slider === 'yes' ) {
				?>
				<div id="<?php echo esc_attr( $id ); ?>"
					 class="woo-list-category  <?php echo esc_attr( $category_style ); ?>  <?php echo esc_attr( $class_has_slider ); ?>">
					<?php
					$children = get_terms( $term->taxonomy, array(
						'parent'     => $term->term_id,
						'hide_empty' => false
					) );
					if ( $children ) {
						foreach ( $children as $subcat ) {
							echo '<div class="cat-list-item">';
							$thumbnail_id    = get_term_meta( $subcat->term_id, 'thumbnail_id', true );
							$image           =  lusion_get_attachment($thumbnail_id,array(435,590));
							?>
							<a class="list-cate-img"
							   href="<?php echo esc_url( get_term_link( $subcat, $subcat->taxonomy ) ); ?>">
								<img src="<?php echo esc_url( $image['src'] ); ?>" alt="<?php get_the_title(); ?>" height="590"
									 width="435"/>
							</a>
							<a class="list-cate-title"
							   href="<?php echo esc_url( get_term_link( $subcat, $subcat->taxonomy ) ); ?>"><?php echo $subcat->name; ?></a>
							<p class="cats-total">
								<?php
								if ( $subcat->count <= 1 ) {
									echo $subcat->count . esc_html__( ' item ', 'apr-core' );
								} else {
									echo $subcat->count . esc_html__( ' items ', 'apr-core' );
								} ?>
							</p>
							<?php
							echo '</div>';
						}
					}
					?>
				</div>
				<script>
					jQuery(document).ready(function ($) {
						$('#<?php echo esc_js( $id );?>').slick({
							dots         : false,
							arrows       : true,
							speed        : 300,
							rtl          : <?php echo esc_attr( $direction );?>,
							centerPadding: '0',
							slidesToShow :<?php echo esc_attr( $column_desktop );?>,
							nextArrow    : '<button class="slick-next"><i class="theme-icon-right-arrow"></i></button>',
							prevArrow    : '<button class="slick-prev"><i class="theme-icon-left-arrow"></i></button>',
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
				<?php
			}
		}

		protected function content_template() {
		}
	}

	Plugin::instance()->widgets_manager->register( new Apr_Core_Woo_categories );
}
