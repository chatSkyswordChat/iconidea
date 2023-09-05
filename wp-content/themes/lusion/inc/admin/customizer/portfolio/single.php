<?php
$section  = 'portfolio_single';
$priority = 1;
$prefix   = 'portfolio_single_';

arrowpress_customizer()->add_field( array(
	'type'     => 'select',
	'settings' => $prefix . 'layout_content',
	'label'    => esc_html__( 'Portfolio Layout', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'portfolio-layout1',
	'choices'  => array(
		'portfolio-layout1' => esc_html__( 'Layout 1', 'lusion' ),
		'portfolio-layout2' => esc_html__( 'Layout 2', 'lusion' ),
		'portfolio-layout3' => esc_html__( 'Layout 3', 'lusion' ),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'category_enable',

	'label'       => esc_html__( 'Category', 'lusion' ),
	'description' => esc_html__( 'Turn on to display category portfolio information.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'lusion' ),
		'1' => esc_html__( 'On', 'lusion' ),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'information_enable',

	'label'       => esc_html__( 'Information', 'lusion' ),
	'description' => esc_html__( 'Turn on to display article portfolio information.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'lusion' ),
		'1' => esc_html__( 'On', 'lusion' ),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'        => 'multicheck',
	'settings'    => $prefix . 'item_enable_information',
	'label'       => esc_attr__( 'Hide or Unhide:', 'lusion' ),
	'description' => esc_html__( 'Check the box to turn on the properties.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => array( 'client', 'designer', 'materials', 'website' ),
	'choices'     => array(
		'client'    => esc_attr__( 'Client', 'lusion' ),
		'designer'  => esc_attr__( 'Designer', 'lusion' ),
		'materials' => esc_attr__( 'Materials', 'lusion' ),
		'website'   => esc_attr__( 'Website', 'lusion' ),
	),
	'required'    => array(
		array(
			'setting'  => $prefix . 'information_enable',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'share_enable',

	'label'       => esc_html__( 'Portfolio Sharing', 'lusion' ),
	'description' => esc_html__( 'Turn on to display the social sharing on portfolio single posts.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'lusion' ),
		'1' => esc_html__( 'On', 'lusion' ),
	),
) );


arrowpress_customizer()->add_field( array(
	'type'        => 'multicheck',
	'settings'    => $prefix . 'item_enable',
	'label'       => esc_attr__( 'Sharing Links', 'lusion' ),
	'description' => esc_html__( 'Check to the box to enable social share links.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => array( 'facebook', 'twitter', 'pinterest' ),
	'choices'     => array(
		'facebook'  => esc_attr__( 'Facebook', 'lusion' ),
		'twitter'   => esc_attr__( 'Twitter', 'lusion' ),
		'pinterest' => esc_attr__( 'Pinterest', 'lusion' ),
	),
	'required'    => array(
		array(
			'setting'  => $prefix . 'share_enable',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );


arrowpress_customizer()->add_field( array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'related_enable',
	'label'       => esc_html__( 'Other portfolio', 'lusion' ),
	'description' => esc_html__( 'Turn on to display other news portfolio on portfolio single.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'lusion' ),
		'1' => esc_html__( 'On', 'lusion' ),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'textarea',
	'settings' => $prefix . 'other_title',
	'label'    => esc_html__( 'Title other portfolio', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => wp_kses(
		__( 'Related Projects', 'lusion' ),
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

	'active_callback' => array(
		array(
			'setting'  => $prefix . 'related_enable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'            => 'number',
	'settings'        => $prefix . 'related_number',
	'label'           => esc_html__( 'Number of other portfolio item', 'lusion' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'default'         => 4,
	'choices'         => array(
		'min'  => 0,
		'max'  => 50,
		'step' => 1,
	),
	'active_callback' => array(
		array(
			'setting'  => $prefix . 'related_enable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );
