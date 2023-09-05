<?php
$panel    = 'general';
$priority = 1;
arrowpress_customizer()->add_section( array(
		'id'       => 'layout-config',
		'title'    => esc_html__( 'Layout', 'lusion' ),
		'panel'    => $panel,
		'priority' => $priority ++,
	)
);

arrowpress_customizer()->add_section( array(
	'id'       => 'color-config',
	'title'    => esc_html__( 'Color', 'lusion' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

arrowpress_customizer()->add_section( array(
	'id'       => 'typography-config',
	'title'    => esc_html__( 'Typography', 'lusion' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

arrowpress_customizer()->add_section( array(
	'id'       => 'preloader-config',
	'title'    => esc_html__( 'Preloader', 'lusion' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

arrowpress_customizer()->add_section( array(
	'id'       => 'breadcrumb-config',
	'title'    => esc_html__( 'Breadcrumbs & Page Title', 'lusion' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
