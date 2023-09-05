<?php
$panel    = 'portfolio';
$priority = 1;
arrowpress_customizer()->add_section( array(
	'id'       => 'portfolio_archive',
	'title'    => esc_html__( 'Portfolio Archive', 'lusion' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
arrowpress_customizer()->add_section( array(
	'id'       => 'portfolio_single',
	'title'    => esc_html__( 'Portfolio Single', 'lusion' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
