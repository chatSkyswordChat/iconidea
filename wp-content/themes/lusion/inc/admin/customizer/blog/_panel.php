<?php
$panel    = 'blog';
$priority = 1;
arrowpress_customizer()->add_section( array(
	'id'       => 'blog_general',
	'title'    => esc_html__( 'General', 'lusion' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
arrowpress_customizer()->add_section( array(
	'id'       => 'blog_archive',
	'title'    => esc_html__( 'Blog Archive', 'lusion' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
arrowpress_customizer()->add_section( array(
	'id'       => 'blog_single',
	'title'    => esc_html__( 'Blog Single Post', 'lusion' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
