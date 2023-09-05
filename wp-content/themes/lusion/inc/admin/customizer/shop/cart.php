<?php
$section  = 'shopping_cart';
$priority = 1;
$prefix   = 'shopping_cart_';
arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'layout',
	'label'    => esc_html__( 'Cart Layout', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'layout1',
	'choices'  => array(
		'layout1' => esc_html__( 'Layout 1', 'lusion' ),
		'layout2' => esc_html__( 'Layout 2', 'lusion' ),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'cross_sells_enable',
	'label'       => esc_html__( 'Cross-sells products', 'lusion' ),
	'description' => esc_html__( 'Turn on to display the cross-sells products section. This is helpful if you have dozens of products with cross-sells and you don\'t want to go and edit each single page.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 0,
	'choices'     => array(
		'0' => esc_html__( 'Off', 'lusion' ),
		'1' => esc_html__( 'On', 'lusion' ),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'text',
	'settings' => 'cross_title',
	'label'    => esc_html__( 'Title Cross Sells Products', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'required' => array(
		array(
			'setting'  => 'shopping_cart_cross_sells_enable',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'default'  => wp_kses(
		__( 'You may be interested in&hellip;', 'lusion' ),
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
