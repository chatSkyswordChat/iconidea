<?php
$section             = 'shop_single';
$priority            = 1;
$prefix              = 'single_product_';
$registered_sidebars = Lusion_Helper::get_registered_sidebars();
$block_name          = lusion_get_template();
arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_layout',
	'label'    => esc_html__( 'Single Layout', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'full_width',
	'choices'  => array(
		'wide'       => esc_html__( 'Wide', 'lusion' ),
		'full_width' => esc_html__( 'Full Width', 'lusion' ),
		'boxed'      => esc_html__( 'Boxed', 'lusion' )
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'select',
	'settings'    => 'single_sidebar_left',
	'label'       => esc_html__( 'Sidebar Left', 'lusion' ),
	'description' => esc_html__( 'Select sidebar left.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '',
	'choices'     => $registered_sidebars,
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'select',
	'settings'    => 'single_sidebar_right',
	'label'       => esc_html__( 'Sidebar Right', 'lusion' ),
	'description' => esc_html__( 'Select sidebar right.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '',
	'choices'     => $registered_sidebars,
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_style',
	'label'       => esc_html__( 'Single Type', 'lusion' ),
	'description' => esc_html__( 'Select single type', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'single_1',
	'choices'     => array(
		'single_default' => esc_html__( 'Single Default', 'lusion' ),
		'single_1'       => esc_html__( 'Single 1', 'lusion' ),
		'single_2'       => esc_html__( 'Single 2', 'lusion' ),
		'single_3'       => esc_html__( 'Single 3', 'lusion' ),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_sticky_product',
	'label'       => esc_html__( 'Show/Hide Sticky Product', 'lusion' ),
	'description' => esc_html__( 'Turn on to display sticky product.', 'lusion' ),
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
	'settings'    => 'single_zoom_image',
	'label'       => esc_html__( 'Show/Hide Zoom Image', 'lusion' ),
	'description' => esc_html__( 'Turn on to display zoom main image.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'lusion' ),
		'1' => esc_html__( 'On', 'lusion' ),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => 'product_thumbnails_style',
	'label'    => esc_html__( 'Product Thumbnails Style', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'vertical',
	'choices'  => array(
		'horizontal' => esc_html__( 'Horizontal', 'lusion' ),
		'vertical'   => esc_html__( 'Vertical', 'lusion' ),
	),
	'required' => array(
		array(
			'setting'  => 'single_style',
			'operator' => '==',
			'value'    => 'single_1',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'number',
	'settings' => 'number_thumbnail_show',
	'label'    => esc_html__( 'Number Product Thumbnails', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '6',
	'required' => array(
		array(
			'setting'  => 'single_style',
			'operator' => '==',
			'value'    => 'single_1',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_ajax_cart',
	'label'       => esc_html__( 'Show/Hide Ajax Add To Cart', 'lusion' ),
	'description' => esc_html__( 'Turn on to display ajax add to cart.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'lusion' ),
		'1' => esc_html__( 'On', 'lusion' ),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'text',
	'settings' => 'single_product_prev',
	'label'    => esc_html__( 'Enter Icon Class Button Prev', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'theme-icon-back',
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'text',
	'settings' => 'single_product_next',
	'label'    => esc_html__( 'Enter Icon Class Button Next', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'theme-icon-next',
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_product_meta_enable',
	'label'       => esc_html__( 'Show/Hide Product Meta', 'lusion' ),
	'description' => esc_html__( 'Turn on to display the product meta.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'lusion' ),
		'1' => esc_html__( 'On', 'lusion' ),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'multicheck',
	'settings' => 'product_meta_multi',
	'label'    => esc_html__( 'Product Meta', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => array( 'categories', 'description', 'availability' ),
	'choices'  => array(
		'availability' => esc_html__( 'Availability', 'lusion' ),
		'sku'          => esc_html__( 'SKU', 'lusion' ),
		'categories'   => esc_html__( 'Categories', 'lusion' ),
		'tags'         => esc_html__( 'Tags', 'lusion' ),
		'brands'       => esc_html__( 'Brands', 'lusion' ),
		'description'  => esc_html__( 'Quick Description', 'lusion' )
	),
	'required' => array(
		array(
			'setting'  => 'single_product_meta_enable',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_product_tab',
	'label'    => esc_html__( 'Tab Width', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'accordion',
	'choices'  => array(
		'accordion'  => esc_html__( 'Accordion', 'lusion' ),
		'full_width' => esc_html__( 'Full width', 'lusion' ),
		'general'    => esc_html__( 'General', 'lusion' ),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_product_delivery',
	'label'       => esc_html__( 'Show Shipping Policy', 'lusion' ),
	'description' => esc_html__( 'Turn on to display the delivery.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'lusion' ),
		'1' => esc_html__( 'On', 'lusion' ),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'text',
	'settings' => 'single_product_title_shipping_policy',
	'label'    => esc_html__( 'Shipping Policy Title', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => esc_html__( 'Free Delivery and Returns', 'lusion' ),
) );

arrowpress_customizer()->add_field( array(
	'type'        => 'select',
	'settings'    => 'single_delivery_content',
	'label'       => esc_html__( 'Delivery Content', 'lusion' ),
	'description' => esc_html__( 'You can create templates in Templates -> Add New', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '',
	'choices'     => $block_name,
	'required'    => array(
		array(
			'setting'  => 'single_product_delivery',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'image',
	'settings' => 'image_size_guide',
	'label'    => esc_html__( 'Image Size Guide', 'lusion' ),
	'section'  => $section,
	'default'  => '',
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_product_sharing_enable',
	'label'       => esc_html__( 'Product sharing', 'lusion' ),
	'description' => esc_html__( 'Turn on to display the product sharing.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'lusion' ),
		'1' => esc_html__( 'On', 'lusion' ),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'number',
	'settings'    => 'per_limit',
	'label'       => esc_html__( 'Product Number', 'lusion' ),
	'description' => esc_html__( 'Displayed Related, Upsell, Cross-sell Products.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '3',
) );

arrowpress_customizer()->add_field( array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_product_related_enable',
	'label'       => esc_html__( 'Related products', 'lusion' ),
	'description' => esc_html__( 'Turn on to display the related products section.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '0',
	'choices'     => array(
		'1' => esc_html__( 'Off', 'lusion' ),
		'0' => esc_html__( 'On', 'lusion' ),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => 'single_product_other_product_position',
	'label'    => esc_html__( 'Position Related, Upsell, Cross-sell Products', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'out',
	'choices'  => array(
		'in'  => esc_html__( 'In', 'lusion' ),
		'out' => esc_html__( 'Out', 'lusion' ),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'select',
	'settings' => 'other_product_type',
	'label'    => esc_html__( 'Related, Upsell Product Layout ', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'default',
	'choices'  => array(
		'default' => esc_html__( 'Default', 'lusion' ),
		'1'       => esc_html__( 'Style 1', 'lusion' ),
		'2'       => esc_html__( 'Style 2', 'lusion' ),
		'3'       => esc_html__( 'Style 3', 'lusion' ),
		'4'       => esc_html__( 'Style 4', 'lusion' ),
		'5'       => esc_html__( 'Style 5', 'lusion' ),
		'6'       => esc_html__( 'Style 6', 'lusion' ),
		'7'       => esc_html__( 'Style 7', 'lusion' ),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'number',
	'settings' => 'related_limit',
	'label'    => esc_html__( 'Related Products Limit', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '4',
	'required' => array(
		array(
			'setting'  => 'single_product_related_enable',
			'operator' => '==',
			'value'    => 0,
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_product_up_sells_enable',
	'label'       => esc_html__( 'Up-sells products', 'lusion' ),
	'description' => esc_html__( 'Turn on to display the up-sells products section.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '0',
	'choices'     => array(
		'1' => esc_html__( 'Off', 'lusion' ),
		'0' => esc_html__( 'On', 'lusion' ),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'number',
	'settings' => 'upsell_limit',
	'label'    => esc_html__( 'Up-sells Products Limit', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '4',
	'required' => array(
		array(
			'setting'  => 'single_product_up_sells_enable',
			'operator' => '==',
			'value'    => 0,
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'text',
	'settings' => 'related_title',
	'label'    => esc_html__( 'Title Related Products', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'required' => array(
		array(
			'setting'  => 'single_product_related_enable',
			'operator' => '==',
			'value'    => 0,
		),
	),
	'default'  => wp_kses(
		__( 'Related Products', 'lusion' ),
		array(
			'a'  => array(
				'href'   => array(),
				'title'  => array(),
				'target' => array(),
			),
			'p'  => array( 'class' => array() ),
			'br' => array(),
			'i'  => array(
				'class'       => array(),
				'aria-hidden' => array(),
			),
		)
	),

) );
arrowpress_customizer()->add_field( array(
	'type'     => 'text',
	'settings' => 'upsel_title',
	'label'    => esc_html__( 'Title Upsell Products', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'required' => array(
		array(
			'setting'  => 'single_product_up_sells_enable',
			'operator' => '==',
			'value'    => 0,
		),
	),
	'default'  => wp_kses(
		__( 'Upsell Products', 'lusion' ),
		array(
			'a'  => array(
				'href'   => array(),
				'title'  => array(),
				'target' => array(),
			),
			'p'  => array( 'class' => array() ),
			'br' => array(),
			'i'  => array(
				'class'       => array(),
				'aria-hidden' => array(),
			),
		)
	),

) );

arrowpress_customizer()->add_field( array(
	'type'     => 'custom',
	'settings' => $prefix . 'single_product_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Product Tab', 'lusion' ) . '</div>',
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'toggle',
	'settings' => 'single_product_desc',
	'label'    => esc_html__( 'Remove Details Tab', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 0
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'toggle',
	'settings' => 'single_product_review',
	'label'    => esc_html__( 'Remove Reviews Tab', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 0
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'text',
	'settings' => 'single_product_rename_desc',
	'label'    => esc_html__( 'Rename Details Tab', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => esc_html__( 'Details', 'lusion' ),
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'text',
	'settings' => 'single_product_rename_info',
	'label'    => esc_html__( 'Rename Information Tab', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => esc_html__( 'More Information', 'lusion' ),
) );
