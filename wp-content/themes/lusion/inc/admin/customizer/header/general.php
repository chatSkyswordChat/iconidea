<?php
$section  = 'header';
$priority = 1;
$prefix   = 'header_';
$link_id  = Lusion::setting( 'choose_header_builder' );
$link     = '<a target="_blank" href="edit.php?post_type=header" class="link_edit_header_buider">Go to header buider</a>';

arrowpress_customizer()->add_field( array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_layout' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Layout', 'lusion' ) . '</div>',
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'toggle',
	'settings' => 'enable_header_builder',
	'label'    => esc_html__( 'Enable Header Builder', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 0,
) );


arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => 'header_layout_style',
	'label'    => __( 'Header layout style', 'lusion' ),
	'section'  => $section,
	'default'  => 'full_width',
	'priority' => $priority ++,
	'choices'  => array(
		'wide'       => esc_attr__( 'Wide', 'lusion' ),
		'full_width' => esc_attr__( 'Full Width', 'lusion' ),
	),
	'required' => array(
		array(
			'setting'  => 'enable_header_builder',
			'operator' => '==',
			'value'    => 0,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'toggle',
	'settings'    => 'show_cart',
	'label'       => esc_html__( 'Show Mini Cart', 'lusion' ),
	'description' => esc_html__( 'Turn on to show mini cart.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 1,
	'required'    => array(
		array(
			'setting'  => 'enable_header_builder',
			'operator' => '==',
			'value'    => 0,
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'        => 'toggle',
	'settings'    => 'show_search',
	'label'       => esc_html__( 'Show Search', 'lusion' ),
	'description' => esc_html__( 'Turn on to show search.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 1,
	'required'    => array(
		array(
			'setting'  => 'enable_header_builder',
			'operator' => '==',
			'value'    => 0,
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'        => 'toggle',
	'settings'    => 'show_account',
	'label'       => esc_html__( 'Show Account', 'lusion' ),
	'description' => esc_html__( 'Turn on to show account.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '',
	'required'    => array(
		array(
			'setting'  => 'enable_header_builder',
			'operator' => '==',
			'value'    => 0,
		),
	),
) );


arrowpress_customizer()->add_field( array(
	'type'      => 'slider',
	'settings'  => 'logo-max-width',
	'label'     => esc_html__( 'Logo max width', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 300,
		'step' => 1,
	),
	'default'   => '100',
	'output'    => array(
		array(
			'element'  => '.custom-logo-link',
			'property' => 'max-width',
			'units'    => 'px',
		),
	),
	'required'  => array(
		array(
			'setting'  => 'enable_header_builder',
			'operator' => '==',
			'value'    => 0,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'select',
	'settings' => 'choose_header_builder',
	'label'    => esc_html__( 'Default Header', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '',
	'choices'  => lusion_get_headers_post_type(),
	'required' => array(
		array(
			'setting'  => 'enable_header_builder',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'id'       => 'my_config',
	'type'     => 'custom',
	'settings' => 'link_edit_header_buider',
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => $link,
	'required' => array(
		array(
			'setting'  => 'enable_header_builder',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_header_fix' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Header fix', 'lusion' ) . '</div>',
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'toggle',
	'settings'    => 'fixed_header',
	'label'       => esc_html__( 'Enable Fixed Header', 'lusion' ),
	'description' => esc_html__( 'Header displays over content', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 0,
) );

arrowpress_customizer()->add_field( array(
	'type'        => 'radio-buttonset',
	'settings'    => 'header_fix_bg_img',
	'label'       => esc_html__( 'Show/Hide Header Background', 'lusion' ),
	'description' => esc_html__( 'Option header fixed.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'No', 'lusion' ),
		'1' => esc_html__( 'Yes', 'lusion' ),
	),
	'required'    => array(
		array(
			'setting'  => 'fixed_header',
			'operator' => '==',
			'value'    => 1,
		),
		array(
			'setting'  => 'enable_header_builder',
			'operator' => '==',
			'value'    => 0,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'background',
	'settings' => $prefix . 'image_setting_array',
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => array(
		'background-color'      => '',
		'background-image'      => '',
		'background-repeat'     => 'repeat',
		'background-position'   => 'center center',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
	),
	'output'   => array(
		array(
			'element' => '.header-fixed .site-header',
		),
	),
	'required' => array(
		array(
			'setting'  => 'header_fix_bg_img',
			'operator' => '==',
			'value'    => 1,
		),
		array(
			'setting'  => 'fixed_header',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_sticky' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Header sticky', 'lusion' ) . '</div>',
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'toggle',
	'settings'    => 'header_sticky_enable',
	'label'       => esc_html__( 'Sticky Enable', 'lusion' ),
	'description' => esc_html__( 'Enable this option to turn on header sticky feature.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 0,
) );

arrowpress_customizer()->add_field( array(
	'type'        => 'image',
	'settings'    => 'header_sticky_logo',
	'label'       => esc_html__( 'Logo Sticky', 'lusion' ),
	'description' => esc_html__( 'Select an image file for your logo', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '',
	'required'    => array(
		array(
			'setting'  => 'enable_header_builder',
			'operator' => '==',
			'value'    => 0,
		),
		array(
			'setting'  => 'header_sticky_enable',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );

// Show search
arrowpress_customizer()->add_field( array(
	'type'        => 'toggle',
	'settings'    => 'show_search_sticky',
	'label'       => esc_html__( 'Show Search', 'lusion' ),
	'description' => esc_html__( 'Turn on to show search.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'required'    => array(
		array(
			'setting'  => 'enable_header_builder',
			'operator' => '==',
			'value'    => 0,
		),
		array(
			'setting'  => 'header_sticky_enable',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
// Show minicart
arrowpress_customizer()->add_field( array(
	'type'        => 'toggle',
	'settings'    => 'show_mini_cart_sticky',
	'label'       => esc_html__( 'Show Mini Cart', 'lusion' ),
	'description' => esc_html__( 'Turn on to show mini cart.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '',
	'required'    => array(
		array(
			'setting'  => 'enable_header_builder',
			'operator' => '==',
			'value'    => 0,
		),
		array(
			'setting'  => 'header_sticky_enable',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'        => 'toggle',
	'settings'    => 'show_account_sticky',
	'label'       => esc_html__( 'Show Account', 'lusion' ),
	'description' => esc_html__( 'Turn on to show account.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '',
	'required'    => array(
		array(
			'setting'  => 'enable_header_builder',
			'operator' => '==',
			'value'    => 0,
		),
		array(
			'setting'  => 'header_sticky_enable',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
