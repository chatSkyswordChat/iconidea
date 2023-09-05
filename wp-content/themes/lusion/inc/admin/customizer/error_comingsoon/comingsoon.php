<?php
$section  = 'comingsoon';
$priority = 1;
$prefix   = 'comingsoon_page_';

/*Coming soon */
arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => 'coming_soon_enable',
	'label'    => esc_html__( 'Activate under construction mode', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '0',
	'choices'  => array(
		'0' => esc_html__( 'Off', 'lusion' ),
		'1' => esc_html__( 'On', 'lusion' ),
	),
) );


arrowpress_customizer()->add_field( array(
	'type'     => 'text',
	'settings' => 'cm_title',
	'label'    => esc_html__( 'Title', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => esc_html__( 'Coming Soon!', 'lusion' ),
) );

arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => 'cm_text_title_color',
	'label'     => esc_html__( 'Text Title Color.', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => '#ffffff',
	'output'    => array(
		array(
			'element'  => '.page-coming-soon .coming-soon h1',
			'property' => 'color',
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'text',
	'settings' => 'cm_text_content',
	'label'    => esc_html__( 'Text content', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => esc_html__( 'We are currently working on an awesome new site. Stay tuned for more information. Subscribe to our newsletter to stay updated on our progress', 'lusion' ),
) );

arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => 'cm_text_content_color',
	'label'     => esc_html__( 'Text Content Color.', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => '#ffffff',
	'output'    => array(
		array(
			'element'  => '.page-coming-soon .coming-soon .cm-info',
			'property' => 'color',
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'        => 'background',
	'settings'    => 'cm_bg_img',
	'label'       => esc_html__( 'Background Images', 'lusion' ),
	'description' => esc_html__( 'Background image for coming soon page', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => array(
		'background-image'    => LUSION_THEME_URI . '/assets/images/bg-404.jpg',
		'background-repeat'   => 'no-repeat',
		'background-size'     => 'cover',
		'background-position' => 'center center',
	),
	'output'      => array(
		array(
			'element' => 'body .coming-soon-container',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => 'coming_subcribe_border-color',
	'label'     => esc_html__( 'Form Coming Soon Input Border Color.', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => '#ffffff',
	'output'    => array(
		array(
			'element'  => '.page-coming-soon .coming-subcribe .mc4wp-form-fields input[type=email]',
			'property' => 'border-color',
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => 'coming_subcribe_input',
	'label'     => esc_html__( 'Form Coming Soon Input Color.', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => '',
	'output'    => array(
		array(
			'element'  => '.page-coming-soon .coming-subcribe .mc4wp-form-fields input[type=email],
            .page-coming-soon .coming-subcribe .mc4wp-form-fields input[type=email]::placeholder
            ',
			'property' => 'color',
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'date',
	'settings' => 'coming_soon_countdown',
	'label'    => esc_html__( 'Countdown', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => Lusion_Helper::get_coming_soon_demo_date(),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => 'countdown_border_color',
	'label'     => esc_html__( 'Countdown Border Color.', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => '#ffffff',
	'output'    => array(
		array(
			'element'  => '.countdown_container .countdown-section',
			'property' => 'border-color',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => 'countdown_bg_color',
	'label'     => esc_html__( 'Countdown Background Color.', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => '#ffffff',
	'output'    => array(
		array(
			'element'  => '.countdown_container .countdown-section',
			'property' => 'background-color',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => 'countdown_number_color',
	'label'     => esc_html__( 'Countdown Number Color.', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => Lusion::PRIMARY_COLOR,
	'output'    => array(
		array(
			'element'  => '.page-template-coming-soon .coming-soon .countdown-number',
			'property' => 'color',
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'      => 'slider',
	'settings'  => 'countdown_number_font_size',
	'label'     => esc_html__( 'Countdown Number Font Size', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 50,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 70,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-template-coming-soon .coming-soon .countdown-number',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => 'countdown_label_color',
	'label'     => esc_html__( 'Countdown Label Color.', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => Lusion::PRIMARY_COLOR,
	'output'    => array(
		array(
			'element'  => '.page-template-coming-soon .coming-soon .countdown-label',
			'property' => 'color',
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'      => 'slider',
	'settings'  => 'countdown_label_font_size',
	'label'     => esc_html__( 'Countdown Label Font Size', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 20,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 70,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-template-coming-soon .coming-soon .countdown-label',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );
