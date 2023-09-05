<?php
$section    = 'sale_popup';
$priority   = 1;
$prefix     = 'sale_popup_';
$block_name = lusion_get_template();

arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'show',
	'label'    => esc_html__( 'Show/Hide Popup', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'No', 'lusion' ),
		'1' => esc_html__( 'Yes', 'lusion' ),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'        => 'select',
	'settings'    => $prefix . 'content',
	'label'       => esc_html__( 'Sale Popup Content', 'lusion' ),
	'description' => esc_html__( 'You can create templates in Templates -> Add New', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '',
	'choices'     => $block_name,
	'required'    => array(
		array(
			'setting'  => $prefix . 'show',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'        => 'number',
	'settings'    => $prefix . 'time_load',
	'label'       => esc_html__( 'Time Show Popup', 'lusion' ),
	'description' => esc_html__( 'You can set the time to show pop-ups after the page loads (5 seconds (5000 milliseconds - Default is 5000)).', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '5000',
	'required'    => array(
		array(
			'setting'  => $prefix . 'show',
			'operator' => '==',
			'value'    => 1,
		),
	)
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'number',
	'settings'    => $prefix . 'time_load_item',
	'label'       => esc_html__( 'Time Show Popup Load Items', 'lusion' ),
	'description' => esc_html__( 'You can set the popup display after a item loaded(10 seconds (10000 milliseconds - Default is 10000)).', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '10000',
	'required'    => array(
		array(
			'setting'  => $prefix . 'show',
			'operator' => '==',
			'value'    => 1,
		),
	)
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Style', 'lusion' ) . '</div>',
	'required' => array(
		array(
			'setting'  => $prefix . 'show',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'text',
	'settings'    => $prefix . 'width',
	'label'       => esc_html__( 'Width Popup', 'lusion' ),
	'description' => esc_html__( 'Default: 300px - Ex: 300px', 'lusion' ),
	'transport'   => 'auto',
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '',
	'required'    => array(
		array(
			'setting'  => $prefix . 'show',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'      => array(
		array(
			'element'  => 'ul.product-items',
			'property' => 'max-width',
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'        => 'color',
	'settings'    => $prefix . 'background',
	'label'       => esc_html__( 'Background', 'lusion' ),
	'description' => esc_html__( 'Controls background', 'lusion' ),
	'transport'   => 'auto',
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '',
	'output'      => array(
		array(
			'element'  => 'ul.product-items .item.product-item',
			'property' => 'background-color',
		),
	),
	'required'    => array(
		array(
			'setting'  => $prefix . 'show',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'dimensions',
	'settings'    => $prefix . 'padding',
	'label'       => esc_html__( 'Padding', 'lusion' ),
	'description' => esc_html__( 'Ex: 30px', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => array(
		'top'    => '',
		'right'  => '',
		'bottom' => '',
		'left'   => '',
	),
	'transport'   => 'auto',
	'required'    => array(
		array(
			'setting'  => $prefix . 'show',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'      => array(
		array(
			'element'  => array(
				'ul.product-items .item.product-item',
			),
			'property' => 'padding',
		),
	),
) );
