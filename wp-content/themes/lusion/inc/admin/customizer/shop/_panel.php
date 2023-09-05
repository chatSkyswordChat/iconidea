<?php
$panel    = 'shop';
$priority = 1;
arrowpress_customizer()->add_section( array(
	'id'       => 'general_shop',
	'title'    => esc_html__( 'General', 'lusion' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
arrowpress_customizer()->add_section( array(
	'id'       => 'shop_archive',
	'title'    => esc_html__( 'Shop Archive', 'lusion' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
arrowpress_customizer()->add_section( array(
	'id'       => 'shop_single',
	'title'    => esc_html__( 'Shop Single', 'lusion' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
arrowpress_customizer()->add_section( array(
	'id'       => 'shopping_cart',
	'title'    => esc_html__( 'Shopping Cart', 'lusion' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
