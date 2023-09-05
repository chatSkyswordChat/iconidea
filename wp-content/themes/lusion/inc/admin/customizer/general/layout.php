<?php
$section             = 'layout-config';
$priority            = 1;
$prefix              = 'layout_';
$registered_sidebars = Lusion_Helper::get_registered_sidebars();
arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'site',
	'label'    => esc_html__( 'General Layout', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'full_width',
	'choices'  => array(
		'wide'       => esc_html__( 'Wide', 'lusion' ),
		'full_width' => esc_html__( 'Full Width', 'lusion' ),
		'boxed'      => esc_html__( 'Boxed', 'lusion' ),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'dimension',
	'settings'    => $prefix . 'padding_container',
	'label'       => esc_html__( 'Padding Container', 'cecile' ),
	'description' => esc_html__( 'Controls the overall site width (layout: wide). Enter value including any valid CSS unit, ex: 0 50px.', 'cecile' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '',
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'dimension',
	'settings'    => $prefix . 'width',
	'label'       => esc_html__( 'Site Width', 'lusion' ),
	'description' => esc_html__( 'Controls the overall site width (layout: full width). Enter value including any valid CSS unit, ex: 1170px.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1200px',
	'output'      => array(
		array(
			'element'     => '.container, .elementor-inner .elementor-section.elementor-section-boxed>.elementor-container',
			'property'    => 'max-width',
			'media_query' => '@media (min-width: 1200px)'
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'select',
	'settings'    => 'general_left_sidebar',
	'label'       => esc_html__( 'Sidebar Left', 'lusion' ),
	'description' => esc_html__( 'Select sidebar left.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '',
	'choices'     => $registered_sidebars,
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'select',
	'settings'    => 'general_right_sidebar',
	'label'       => esc_html__( 'Sidebar Right', 'lusion' ),
	'description' => esc_html__( 'Select sidebar right.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '',
	'choices'     => $registered_sidebars,
) );
