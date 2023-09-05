<?php
$panel    = 'popup';
$priority = 1;
arrowpress_customizer()->add_section( array(
	'id'       => 'popup_newsletter',
	'title'    => esc_html__( 'Newsletter', 'lusion' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

arrowpress_customizer()->add_section( array(
	'id'       => 'popup_account',
	'title'    => esc_html__( 'Account', 'lusion' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

arrowpress_customizer()->add_section( array(
	'id'       => 'sale_popup',
	'title'    => esc_html__( 'Sale Popup', 'lusion' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

arrowpress_customizer()->add_section( array(
	'id'       => 'popup_sale',
	'title'    => esc_html__( 'Recommended Products', 'lusion' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
