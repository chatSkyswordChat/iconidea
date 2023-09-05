<?php
$section  = 'color-config';
$priority = 1;
$prefix   = 'general_';
$show     = esc_html__( 'Show', 'lusion' );
$hide     = esc_html__( 'Hide', 'lusion' );

/*--------------------------------------------------------------
# Color
--------------------------------------------------------------*/
arrowpress_customizer()->add_field( array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_color' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Color', 'lusion' ) . '</div>',
) );

arrowpress_customizer()->add_field( array(
	'type'        => 'color',
	'settings'    => 'primary_color',
	'label'       => esc_html__( 'Primary Color', 'lusion' ),
	'description' => esc_html__( 'If you select a color, there is only one main color, while two colors change it to a gradient.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '',
	'choices' => array ('alpha'     => true),
) );

/*--------------------------------------------------------------
# Body background
--------------------------------------------------------------*/

arrowpress_customizer()->add_field( array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_bg' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Body background', 'lusion' ) . '</div>',
) );

arrowpress_customizer()->add_field( array(
	'type'        => 'background',
	'settings'    => $prefix . 'image_body',
	'label'       => esc_html__( 'Background', 'lusion' ),
	'description' => esc_html__( 'Controls background of the outer background area in boxed mode.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => array(
		'background-color'      => 'rgba(255,255,255,0)',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'contain',
		'background-attachment' => 'scroll',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => 'html body',
		),
	),
) );

/*--------------------------------------------------------------
# Button Color
--------------------------------------------------------------*/

arrowpress_customizer()->add_field( array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_button' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Button', 'lusion' ) . '</div>',
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'toggle',
	'settings' => 'btn_custom',
	'label'    => esc_html__( 'Enable Custom', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 0,
) );

arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => 'btn_primary_color',
	'label'     => esc_html__( 'Button Primary', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => '',
	'choices' => array ('alpha'     => true),
	'required'  => array(
		array(
			'setting'  => 'btn_custom',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => 'btn_dark_color',
	'label'     => esc_html__( 'Button Dark', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'choices' => array ('alpha'     => true),
	'default'   => Lusion::HEADING_COLOR,
	'required'  => array(
		array(
			'setting'  => 'btn_custom',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => 'btn_light_color',
	'label'     => esc_html__( 'Button Light', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'choices' => array ('alpha'     => true),
	'default'   => '#ebeeee',
	'required'  => array(
		array(
			'setting'  => 'btn_custom',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
