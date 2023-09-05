<?php
$section             = 'shop_archive';
$priority            = 1;
$prefix              = 'shop_archive_';
$registered_sidebars = Lusion_Helper::get_registered_sidebars();
arrowpress_customizer()->add_field( array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'General', 'lusion' ) . '</div>',
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => 'shop_layout',
	'label'    => esc_html__( 'Shop Layout', 'lusion' ),
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
	'settings'    => 'shop_sidebar_left',
	'label'       => esc_html__( 'Sidebar Left', 'lusion' ),
	'description' => esc_html__( 'Select sidebar left.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '',
	'choices'     => $registered_sidebars,
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'select',
	'settings'    => 'shop_sidebar_right',
	'label'       => esc_html__( 'Sidebar Right', 'lusion' ),
	'description' => esc_html__( 'Select sidebar right.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '',
	'choices'     => $registered_sidebars,
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Toolbar', 'lusion' ) . '</div>',
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'toggle',
	'settings'    => 'shop_archive_toolbar',
	'label'       => esc_html__( 'Show/Hide Toolbar', 'lusion' ),
	'description' => esc_html__( 'Turn on to show toolbar', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 1,
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'toggle',
	'settings' => 'shop_archive_catalog_ordering',
	'label'    => esc_html__( 'Show/Hide Catalog Ordering', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 1,
	'required' => array(
		array(
			'setting'  => 'shop_archive_toolbar',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'        => 'toggle',
	'settings'    => 'shop_archive_filter',
	'label'       => esc_html__( 'Show/Hide Filter', 'lusion' ),
	'description' => esc_html__( 'Works when selecting the left sidebar or right sidebar', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 1,
	'required'    => array(
		array(
			'setting'  => 'shop_archive_toolbar',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'toggle',
	'settings' => 'shop_archive_filter_top',
	'label'    => esc_html__( 'Filter Top', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 0,
	'required' => array(
		array(
			'setting'  => 'shop_archive_toolbar',
			'operator' => '==',
			'value'    => 1,
		),
		array(
			'setting'  => 'shop_archive_filter',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'        => 'radio-buttonset',
	'settings'    => 'product_column',
	'label'       => esc_html__( 'Product Column', 'lusion' ),
	'description' => esc_html__( 'Option 4 col not for cases where the page has 2 sidebars (left and right)', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '3',
	'choices'     => array(
		'1' => esc_html__( '1', 'lusion' ),
		'2' => esc_html__( '2', 'lusion' ),
		'3' => esc_html__( '3', 'lusion' ),
		'4' => esc_html__( '4', 'lusion' ),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => 'product_layouts',
	'label'    => esc_html__( 'Product Layouts', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'grid_list',
	'choices'  => array(
		'grid'      => esc_html__( 'Grid', 'lusion' ),
		'list'      => esc_html__( 'List', 'lusion' ),
		'grid_list' => esc_html__( 'Grid(default) / List', 'lusion' ),
		'list_grid' => esc_html__( 'List(default) / Grid', 'lusion' ),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => 'product_column_list',
	'label'    => esc_html__( 'Product Column Layout List', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '1',
	'choices'  => array(
		'1' => esc_html__( '1', 'lusion' ),
		'2' => esc_html__( '2', 'lusion' ),
	),
	'required' => array(
		array(
			'setting'  => 'product_layouts',
			'operator' => '!==',
			'value'    => 'grid',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'select',
	'settings' => 'product_type',
	'label'    => esc_html__( 'Product Layout', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '7',
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
	'required' => array(
		array(
			'setting'  => 'product_column',
			'operator' => '!==',
			'value'    => '1',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => 'pagination_type',
	'label'    => esc_html__( 'Pagination Type', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'number',
	'choices'  => array(
		'number'             => esc_html__( 'Number', 'lusion' ),
		'infinite_scrolling' => esc_html__( 'Infinite Scrolling', 'lusion' ),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'number',
	'settings'    => 'shop_archive_number_item',
	'label'       => esc_html__( 'Number items', 'lusion' ),
	'description' => esc_html__( 'Controls the number of products display on the shop archive page', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 6,
	'choices'     => array(
		'min'  => 1,
		'max'  => 30,
		'step' => 1,
	),
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'toggle',
	'settings' => 'show_hide_banner',
	'label'    => esc_html__( 'Show/Hide Banner', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 0,
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'select',
	'settings' => 'product_banner',
	'label'    => esc_html__( 'Select Banner', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '',
	'choices'  => lusion_get_template(),
	'required' => array(
		array(
			'setting'  => 'show_hide_banner',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'toggle',
	'settings' => 'custom_size_product_image',
	'label'    => esc_html__( 'Show/Hide Custom Product Image Size', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 0,
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'number',
	'settings' => 'product_image_width',
	'label'    => esc_html__( 'Product Image Width (Required)', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 750,
	'choices'  => array(
		'min'  => 1,
		'max'  => 1000,
		'step' => 1,
	),
	'required' => array(
		array(
			'setting'  => 'custom_size_product_image',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'number',
	'settings' => 'product_image_height',
	'label'    => esc_html__( 'Product Image Height (Required)', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 1000,
	'choices'  => array(
		'min'  => 1,
		'max'  => 1000,
		'step' => 1,
	),
	'required' => array(
		array(
			'setting'  => 'custom_size_product_image',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
