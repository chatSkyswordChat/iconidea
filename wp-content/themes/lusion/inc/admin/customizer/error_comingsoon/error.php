<?php
$section  = 'error404_page';
$priority = 1;
$prefix   = 'error404_page_';


arrowpress_customizer()->add_field( array(
	'type'     => 'text',
	'settings' => 'text_404',
	'label'    => esc_html__( 'Text 404', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => esc_html__( '404', 'lusion' ),
) );

arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => 'text_404_color',
	'label'     => esc_html__( 'Text 404 Color.', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => '#ffffff',
	'output'    => array(
		array(
			'element'  => '.page-404 .text-404',
			'property' => 'color',
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'      => 'slider',
	'settings'  => 'text_404_size',
	'label'     => esc_html__( 'Text 404 Font Size', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 350,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 1000,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-404 .text-404',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'      => 'slider',
	'settings'  => 'text_404_line_height',
	'label'     => esc_html__( 'Line Height', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => 328,
	'choices'   => array(
		'min'  => 10,
		'max'  => 1000,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-404 .text-404',
			'property' => 'line-height',
			'units'    => 'px',
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'      => 'slider',
	'settings'  => 'text_404_mb',
	'label'     => esc_html__( 'Margin Bottom', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 1000,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-404 .text-404',
			'property' => 'margin-bottom',
			'units'    => 'px',
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'text',
	'settings' => 'error_title',
	'label'    => esc_html__( 'Title', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => esc_html__( 'Oops... looks like you got lost', 'lusion' ),
) );

arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => 'title_404_color',
	'label'     => esc_html__( 'Title Color.', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => '#ffffff',
	'output'    => array(
		array(
			'element'  => '.page-404 h3.page-title',
			'property' => 'color',
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'text',
	'settings' => 'error404_content',
	'label'    => esc_html__( 'Text content', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => esc_html__( 'Get back home by clicking the button', 'lusion' ),
) );

arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => 'content_404_color',
	'label'     => esc_html__( 'Text Content Color.', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => '#ffffff',
	'output'    => array(
		array(
			'element'  => '.page-404 p',
			'property' => 'color',
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'text',
	'settings' => 'go_back_home_404',
	'label'    => esc_html__( 'Button Go To Home', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => esc_html__( 'Go to home', 'lusion' ),
) );

arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => 'go_back_home_404_color',
	'label'     => esc_html__( 'Button 404 Text Color.', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => Lusion::PRIMARY_COLOR,
	'output'    => array(
		array(
			'element'  => '.page-404 .go-home',
			'property' => 'color',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => 'go_back_home_404_bg_color',
	'label'     => esc_html__( 'Button 404 Background Color.', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => '#FFFFFF',
	'output'    => array(
		array(
			'element'  => '.page-404 .go-home',
			'property' => 'background-color',
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'        => 'background',
	'settings'    => $prefix . 'bg_404',
	'label'       => esc_html__( 'Background images', 'lusion' ),
	'description' => esc_html__( 'Background image for 404 page', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => array(
		'background-color'      => '',
		'background-image'      => LUSION_THEME_URI . '/assets/images/bg-404.jpg',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => 'body .page-404',
		),
	),
) );
