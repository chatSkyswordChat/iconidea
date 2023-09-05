<?php
$section    = 'popup_sale';
$priority   = 1;
$prefix     = 'popup_sale_';
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
	'settings'    => $prefix . 'time_load_close',
	'label'       => esc_html__( 'Time Show Popup After Close', 'lusion' ),
	'description' => esc_html__( 'You can set the popup display again after closing the popup(86400 seconds (Default is 86400)).', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '86400',
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
	'description' => esc_html__( 'Default: 950px - Ex: 950px', 'lusion' ),
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
			'element'  => '.popup-sale',
			'property' => 'max-width',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'text',
	'settings'    => $prefix . 'height',
	'label'       => esc_html__( 'Height Popup', 'lusion' ),
	'description' => esc_html__( 'Default: auto', 'lusion' ),
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
			'element'  => '.popup-sale',
			'property' => 'min-height',
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
			'element'  => '.popup-sale',
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
				'.popup-sale',
			),
			'property' => 'padding',
		),
	),
) );
