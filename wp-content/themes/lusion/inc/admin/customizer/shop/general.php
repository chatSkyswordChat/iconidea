<?php
$section  = 'general_shop';
$priority = 1;
$prefix   = 'general_shop_';
arrowpress_customizer()->add_field( array(
	'type'        => 'number',
	'settings'    => 'number_cate',
	'label'       => esc_html__( '[Desktop] Number of categories to show', 'lusion' ),
	'description' => esc_html__( 'This option will work if you select to display categories in shop archive page.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '4',
) );
/*--------------------------------------------------------------
# Product Button
--------------------------------------------------------------*/
arrowpress_customizer()->add_field( array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Product Button', 'lusion' ) . '</div>',
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => 'add_to_cart',
	'label'    => esc_html__( 'Show Add to Cart button', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Off', 'lusion' ),
		'1' => esc_html__( 'On', 'lusion' ),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'text',
	'settings' => 'unicode_add_to_cart',
	'label'    => esc_html__( 'Enter Icon Unicode Button Add to Cart', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '',
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => 'product_price',
	'label'    => esc_html__( 'Show Product Price', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Off', 'lusion' ),
		'1' => esc_html__( 'On', 'lusion' ),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => 'product_categories',
	'label'    => esc_html__( 'Show Product Categories', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '0',
	'choices'  => array(
		'0' => esc_html__( 'Off', 'lusion' ),
		'1' => esc_html__( 'On', 'lusion' ),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'radio-buttonset',
	'settings'    => 'product_quickview',
	'label'       => esc_html__( 'Show Quickview', 'lusion' ),
	'description' => esc_html__( 'This option will work if you install and active YITH Quickview plugin.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'lusion' ),
		'1' => esc_html__( 'On', 'lusion' ),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'radio-buttonset',
	'settings'    => 'product_compare',
	'label'       => esc_html__( 'Show Compare', 'lusion' ),
	'description' => esc_html__( 'This option will work if you install and active YITH Compare plugin.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'lusion' ),
		'1' => esc_html__( 'On', 'lusion' ),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'radio-buttonset',
	'settings'    => 'product_wishlist',
	'label'       => esc_html__( 'Show Wishlist', 'lusion' ),
	'description' => esc_html__( 'This option will work if you install and active YITH Wishlist plugin.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'lusion' ),
		'1' => esc_html__( 'On', 'lusion' ),
	),
) );
/*--------------------------------------------------------------
# Product Lable
--------------------------------------------------------------*/
arrowpress_customizer()->add_field( array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Product Infomation', 'lusion' ) . '</div>',
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => 'show_category_mobile',
	'label'    => esc_html__( 'Show Category on Mobile', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'none',
	'choices'  => array(
		'none'  => esc_html__( 'Off', 'lusion' ),
		'block' => esc_html__( 'On', 'lusion' ),
	),
	'output'   => array(
		array(
			'element'     => array(
				'.category-product',
			),
			'media_query' => '@media (max-width: 767px)',
			'property'    => 'display',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => 'show_rating_mobile',
	'label'    => esc_html__( 'Show Rating on Mobile', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'none',
	'choices'  => array(
		'none'  => esc_html__( 'Off', 'lusion' ),
		'block' => esc_html__( 'On', 'lusion' ),
	),
	'output'   => array(
		array(
			'element'     => array(
				'.rating-product',
			),
			'media_query' => '@media (max-width: 767px)',
			'property'    => 'display',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => 'show_attribute_mobile',
	'label'    => esc_html__( 'Show Attribute on Mobile', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'none',
	'choices'  => array(
		'none'  => esc_html__( 'Off', 'lusion' ),
		'block' => esc_html__( 'On', 'lusion' ),
	),
	'output'   => array(
		array(
			'element'     => array(
				'.show-attribute',
			),
			'media_query' => '@media (max-width: 767px)',
			'property'    => 'display',
		),
	),
) );
/*--------------------------------------------------------------
# Product Lable
--------------------------------------------------------------*/
arrowpress_customizer()->add_field( array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Product Label', 'lusion' ) . '</div>',
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'radio-buttonset',
	'settings'    => 'hot_lable',
	'label'       => esc_html__( 'Show "Hot" Label', 'lusion' ),
	'description' => esc_html__( 'Will be show in the featured product.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'lusion' ),
		'1' => esc_html__( 'On', 'lusion' ),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'radio-buttonset',
	'settings'    => 'new_lable',
	'label'       => esc_html__( 'Show "New" Label', 'lusion' ),
	'description' => esc_html__( 'Will be show in the recent product.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'lusion' ),
		'1' => esc_html__( 'On', 'lusion' ),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'radio-buttonset',
	'settings'    => 'sale_lable',
	'label'       => esc_html__( 'Show "Sale" Label', 'lusion' ),
	'description' => esc_html__( 'Will be show in the sale product.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'lusion' ),
		'1' => esc_html__( 'On', 'lusion' ),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'radio-buttonset',
	'settings'    => 'percentage_lable',
	'label'       => esc_html__( 'Show Sale Price Percentage', 'lusion' ),
	'description' => esc_html__( 'Will be show in the special product.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'lusion' ),
		'1' => esc_html__( 'On', 'lusion' ),
	),
	'required'    => array(
		array(
			'setting'  => 'sale_lable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'select',
	'settings'    => 'shop_archive_new_days',
	'label'       => esc_html__( 'New Badge (Days)', 'lusion' ),
	'description' => esc_html__( 'If the product was published within the newness time frame display the new badge.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '7',
	'choices'     => array(
		'0'  => esc_html__( 'None', 'lusion' ),
		'1'  => esc_html__( '1 day', 'lusion' ),
		'2'  => esc_html__( '2 days', 'lusion' ),
		'3'  => esc_html__( '3 days', 'lusion' ),
		'4'  => esc_html__( '4 days', 'lusion' ),
		'5'  => esc_html__( '5 days', 'lusion' ),
		'6'  => esc_html__( '6 days', 'lusion' ),
		'7'  => esc_html__( '7 days', 'lusion' ),
		'8'  => esc_html__( '8 days', 'lusion' ),
		'9'  => esc_html__( '9 days', 'lusion' ),
		'10' => esc_html__( '10 days', 'lusion' ),
		'15' => esc_html__( '15 days', 'lusion' ),
		'20' => esc_html__( '20 days', 'lusion' ),
		'25' => esc_html__( '25 days', 'lusion' ),
		'30' => esc_html__( '30 days', 'lusion' ),
		'60' => esc_html__( '60 days', 'lusion' ),
		'90' => esc_html__( '90 days', 'lusion' ),
	),
) );
