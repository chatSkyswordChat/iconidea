<?php
$panel    = 'error_comingsoon';
$priority = 1;
arrowpress_customizer()->add_section( array(
	'id'       => 'error404_page',
	'title'    => esc_html__( '404 Page', 'lusion' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
arrowpress_customizer()->add_section( array(
	'id'       => 'comingsoon',
	'title'    => esc_html__( 'Coming Soon', 'lusion' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
