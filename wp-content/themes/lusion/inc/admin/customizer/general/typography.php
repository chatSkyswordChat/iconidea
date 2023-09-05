<?php
$section  = 'typography-config';
$priority = 1;
$prefix   = 'general_';
arrowpress_customizer()->add_field( array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_note' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="desc"><strong class="insight-label insight-label-info">' . esc_html__( 'IMPORTANT NOTE: ', 'lusion' ) . '</strong>' . esc_html__( 'This section contains general typography options. Additional typography options for specific areas can be found within other sections. Example: For breadcrumb typography options go to the breadcrumb section.', 'lusion' ) . '</div>',
) );
/*--------------------------------------------------------------
# Body Typography
--------------------------------------------------------------*/
arrowpress_customizer()->add_field( array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_body' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Body Typography', 'lusion' ) . '</div>',
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'typography',
	'settings'    => $prefix . 'body',
	'label'       => esc_html__( 'Font family', 'lusion' ),
	'description' => esc_html__( 'These settings control the typography for all body text.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',

	'default' => array(
		'font-family'    => Lusion::PRIMARY_FONT,
		'variant'        => '400',
		'line-height'    => 'normal',
		'letter-spacing' => '0.01em',
	),
	'choices' => array(
		'variant' => array(
			'100',
			'100italic',
			'200',
			'200italic',
			'300',
			'300italic',
			'regular',
			'italic',
			'500',
			'500italic',
			'600',
			'600italic',
			'700',
			'700italic',
			'800',
			'800italic',
			'900',
			'900italic',
		),
	),
	'output'  => array(
		array(
			'element' => 'body,.tooltip-inner, div.fancybox-container',
		),
	),
) );


arrowpress_customizer()->add_field( array(
	'type'        => 'color',
	'settings'    => 'body_color',
	'label'       => esc_html__( 'Body Text Color', 'lusion' ),
	'description' => esc_html__( 'Controls the color of body text.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '',
	'output'      => array(
		array(
			'element'  => 'body, p',
			'property' => 'color',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'slider',
	'settings'  => 'body_font_size',
	'label'     => esc_html__( 'Font size', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 16,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 12,
		'max'  => 30,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => 'body',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

/*--------------------------------------------------------------
# Heading typography
--------------------------------------------------------------*/
arrowpress_customizer()->add_field( array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_heading' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Heading Typography', 'lusion' ) . '</div>',
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'typography',
	'settings'    => $prefix . 'heading',
	'label'       => esc_html__( 'Font family', 'lusion' ),
	'description' => esc_html__( 'These settings control the typography for all heading text.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => Lusion::PRIMARY_FONT,
		'variant'        => 'regular',
		'line-height'    => 'normal',
		'letter-spacing' => '0',
	),
	'choices'     => array(
		'variant' => array(
			'100',
			'100italic',
			'200',
			'200italic',
			'300',
			'300italic',
			'regular',
			'italic',
			'500',
			'500italic',
			'600',
			'600italic',
			'700',
			'700italic',
			'800',
			'800italic',
			'900',
			'900italic',
		),
	),
	'output'      => array(
		array(
			'element' => 'h1,h2,h3,h4,h5,h6,.h1,.h2,.h3,.h4,.h5,.h6,th',
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'        => 'color',
	'settings'    => 'heading_color',
	'label'       => esc_html__( 'Heading Color', 'lusion' ),
	'description' => esc_html__( 'Controls the color of heading.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '#2c2c2c',
	'output'      => array(
		array(
			'element'  => 'h1,h2,h3,h4,h5,h6,.h1,.h2,.h3,.h4,.h5,.h6,th',
			'property' => 'color',
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'        => 'slider',
	'settings'    => 'h1_font_size',
	'label'       => esc_html__( 'Font size', 'lusion' ),
	'description' => esc_html__( 'H1', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 34,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h1,.h1',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'slider',
	'settings'    => 'h2_font_size',
	'description' => esc_html__( 'H2', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 30,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h2,.h2',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'slider',
	'settings'    => 'h3_font_size',
	'description' => esc_html__( 'H3', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 26,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h3,.h3',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'slider',
	'settings'    => 'h4_font_size',
	'description' => esc_html__( 'H4', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 24,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h4,.h4',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'slider',
	'settings'    => 'h5_font_size',
	'description' => esc_html__( 'H5', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 20,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h5,.h5',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'slider',
	'settings'    => 'h6_font_size',
	'description' => esc_html__( 'H6', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 18,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 100,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => 'h6,.h6',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );
