<?php
$section  = 'blog_general';
$priority = 1;
$prefix   = 'blog_general_';
arrowpress_customizer()->add_field( array(
	'type'     => 'text',
	'settings' => 'blog_title',
	'label'    => esc_html__( 'Blog Title', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => esc_html__( 'Blogs', 'lusion' ),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'layout',
	'label'    => esc_html__( 'Blog Layout', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'full_width',
	'choices'  => array(
		'wide'       => esc_html__( 'Wide', 'lusion' ),
		'full_width' => esc_html__( 'Full Width', 'lusion' ),
		'boxed'      => esc_html__( 'Boxed', 'lusion' ),
	),
) );
