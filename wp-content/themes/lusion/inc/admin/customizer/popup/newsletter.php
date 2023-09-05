<?php
$section  = 'popup_newsletter';
$priority = 1;
$prefix   = 'popup_newsletter_';
arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'show',
	'label'    => esc_html__( 'Show/Hide Popup', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '0',
	'choices'  => array(
		'0' => esc_html__( 'No', 'lusion' ),
		'1' => esc_html__( 'Yes', 'lusion' ),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'text',
	'settings' => $prefix . 'height',
	'label'    => esc_html__( 'Height Popup', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '504px',
	'required' => array(
		array(
			'setting'  => 'popup_newsletter_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'   => array(
		array(
			'element'  => '.popup-newsletter',
			'property' => 'min-height',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'text',
	'settings' => $prefix . 'width',
	'label'    => esc_html__( 'Width Popup', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '570px',
	'required' => array(
		array(
			'setting'  => 'popup_newsletter_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'   => array(
		array(
			'element'  => '.popup-newsletter',
			'property' => 'width',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'color',
	'settings'    => $prefix . 'background',
	'label'       => esc_html__( 'Background', 'lusion' ),
	'description' => esc_html__( 'Controls background', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.popup-newsletter',
			'property' => 'background-color',
		),
	),
	'required'    => array(
		array(
			'setting'  => 'popup_newsletter_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_form' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Title Form Popup', 'lusion' ) . '</div>',
	'required' => array(
		array(
			'setting'  => 'popup_newsletter_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'text',
	'settings' => $prefix . 'title_form',
	'label'    => esc_html__( 'Title Form', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => esc_html__( 'Sign up newsletter', 'lusion' ),
	'required' => array(
		array(
			'setting'  => 'popup_newsletter_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'color',
	'settings'    => $prefix . 'title_form_bg',
	'label'       => esc_html__( 'Background', 'lusion' ),
	'description' => esc_html__( 'Background title form', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '#2c2c2c',
	'output'      => array(
		array(
			'element'  => '.popup-title-form',
			'property' => 'background-color',
		),
	),
	'required'    => array(
		array(
			'setting'  => 'popup_newsletter_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'        => 'typography',
	'settings'    => $prefix . 'title_form_typography',
	'label'       => esc_html__( 'Font family', 'lusion' ),
	'description' => esc_html__( 'These settings control the title text.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'required'    => array(
		array(
			'setting'  => 'popup_newsletter_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'default'     => array(
		'font-family'    => Lusion::PRIMARY_FONT,
		'variant'        => 'regular',
		'line-height'    => '28px',
		'letter-spacing' => '0',
		'text-transform' => 'none'
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
			'element' => '.popup-title-form',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => 'title_form_color',
	'label'     => esc_html__( 'Color', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => '#fff',
	'required'  => array(
		array(
			'setting'  => 'popup_newsletter_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'    => array(
		array(
			'element'  => '.popup-title-form',
			'property' => 'color',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'slider',
	'settings'  => 'title_form_size',
	'label'     => esc_html__( 'Font size', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 18,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.popup-title-form',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
	'required'  => array(
		array(
			'setting'  => 'popup_newsletter_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Heading title', 'lusion' ) . '</div>',
	'required' => array(
		array(
			'setting'  => 'popup_newsletter_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'textarea',
	'settings' => $prefix . 'title',
	'label'    => esc_html__( 'Heading title', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => esc_html__( 'Sign up our newsletter and save 25% off for the next purchase!', 'lusion' ),
	'required' => array(
		array(
			'setting'  => 'popup_newsletter_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'typography',
	'settings'    => $prefix . 'title_typography',
	'label'       => esc_html__( 'Font family', 'lusion' ),
	'description' => esc_html__( 'These settings control the title text.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'required'    => array(
		array(
			'setting'  => 'popup_newsletter_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'default'     => array(
		'font-family'    => Lusion::PRIMARY_FONT,
		'variant'        => '500',
		'line-height'    => '24px',
		'letter-spacing' => '-0.1px',
		'text-transform' => 'initial',
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
			'element' => '.popup-newsletter-content .form-content h4',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => $prefix . 'title_color',
	'label'     => esc_html__( 'Color', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => '#2c2c2c',
	'output'    => array(
		array(
			'element'  => '.popup-newsletter-content .form-content h4',
			'property' => 'color',
		),
	),
	'required'  => array(
		array(
			'setting'  => 'popup_newsletter_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'slider',
	'settings'  => $prefix . 'title_size',
	'label'     => esc_html__( 'Font size', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 20,
	'transport' => 'auto',
	'required'  => array(
		array(
			'setting'  => 'popup_newsletter_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'choices'   => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.popup-newsletter-content .form-content h4',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_description' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'After Title', 'lusion' ) . '</div>',
	'required' => array(
		array(
			'setting'  => 'popup_newsletter_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'textarea',
	'settings' => $prefix . 'description',
	'label'    => esc_html__( 'Description', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => esc_html__( 'Subscribe to our newsletters and don&rsquot; miss new arrivals, the latest fashion updates and our promotions.', 'lusion' ),
	'required' => array(
		array(
			'setting'  => 'popup_newsletter_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'typography',
	'settings'    => $prefix . 'description_typography',
	'label'       => esc_html__( 'Font family', 'lusion' ),
	'description' => esc_html__( 'These settings control the title text.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'required'    => array(
		array(
			'setting'  => 'popup_newsletter_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'default'     => array(
		'font-family'    => Lusion::PRIMARY_FONT,
		'variant'        => 'regular',
		'line-height'    => '22px',
		'letter-spacing' => '0',
		'text-transform' => 'initial',
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
			'element' => '.popup-newsletter-content .form-content p',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => $prefix . 'description_color',
	'label'     => esc_html__( 'Color', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => '#707070',
	'output'    => array(
		array(
			'element'  => '.popup-newsletter-content .form-content p',
			'property' => 'color',
		),
	),
	'required'  => array(
		array(
			'setting'  => 'popup_newsletter_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'slider',
	'settings'  => $prefix . 'description_size',
	'label'     => esc_html__( 'Font size', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 16,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.popup-newsletter-content .form-content p',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
	'required'  => array(
		array(
			'setting'  => 'popup_newsletter_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_note' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Note', 'lusion' ) . '</div>',
	'required' => array(
		array(
			'setting'  => 'popup_newsletter_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'textarea',
	'settings' => $prefix . 'note',
	'label'    => esc_html__( 'Note', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => esc_html__( 'Your Information will never be shared with any third party.', 'lusion' ),
	'required' => array(
		array(
			'setting'  => 'popup_newsletter_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'typography',
	'settings'    => $prefix . 'not_typography',
	'label'       => esc_html__( 'Font family', 'lusion' ),
	'description' => esc_html__( 'These settings control the title text.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'required'    => array(
		array(
			'setting'  => 'popup_newsletter_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'default'     => array(
		'font-family'    => Lusion::PRIMARY_FONT,
		'variant'        => '400',
		'line-height'    => 'initial',
		'letter-spacing' => '0',
		'text-transform' => 'initial'
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
			'element' => '.popup-newsletter-content .form-content .note',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => $prefix . 'note_color',
	'label'     => esc_html__( 'Color', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => '#9a9a9a',
	'output'    => array(
		array(
			'element'  => '.popup-newsletter-content .form-content .note',
			'property' => 'color',
		),
	),
	'required'  => array(
		array(
			'setting'  => 'popup_newsletter_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'slider',
	'settings'  => $prefix . 'note_size',
	'label'     => esc_html__( 'Font size', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 16,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.popup-newsletter-content .form-content .note',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
	'required'  => array(
		array(
			'setting'  => 'popup_newsletter_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'custom',
	'settings' => $prefix . 'form' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Custom Form', 'lusion' ) . '</div>',
	'required' => array(
		array(
			'setting'  => 'popup_newsletter_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => $prefix . 'color_input',
	'label'     => esc_html__( ' Input and Label Color', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => '#9a9a9a',
	'required'  => array(
		array(
			'setting'  => 'popup_newsletter_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'    => array(
		array(
			'element' => '.mc4wp-form-fields input[type=email], 
							.mc4wp-form-fields input[type=email]::placeholder',

			'property' => 'color',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => $prefix . 'border_color',
	'label'     => esc_html__( 'Input Border Color', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => '#ebeeee',
	'required'  => array(
		array(
			'setting'  => 'popup_newsletter_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'    => array(
		array(
			'element'  => '.mc4wp-form-fields input[type=email]',
			'property' => 'border-color',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => $prefix . 'color_button',
	'label'     => esc_html__( 'Button Color ', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => '#fff',
	'required'  => array(
		array(
			'setting'  => 'popup_newsletter_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'    => array(
		array(
			'element'  => '.mc4wp-form-fields input[type=submit]',
			'property' => 'color',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => $prefix . 'hover_color_button',
	'label'     => esc_html__( 'Button Hover Color ', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => '#fff',
	'required'  => array(
		array(
			'setting'  => 'popup_newsletter_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'    => array(
		array(
			'element'  => '.mc4wp-form-fields input[type=submit]:hover',
			'property' => 'color',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => $prefix . 'bg_button',
	'label'     => esc_html__( ' Button Background Color', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => '#2c2c2c',
	'required'  => array(
		array(
			'setting'  => 'popup_newsletter_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'    => array(
		array(
			'element'  => '.mc4wp-form-fields input[type=submit]',
			'property' => 'background-color',
		),
		array(
			'element'  => '.mc4wp-form-fields input[type=submit]',
			'property' => 'border-color',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => $prefix . 'bg_hover_button',
	'label'     => esc_html__( 'Button Background Color Hover ', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => Lusion::PRIMARY_COLOR,
	'required'  => array(
		array(
			'setting'  => 'popup_newsletter_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'    => array(
		array(
			'element'  => '.mc4wp-form-fields input[type=submit]:hover',
			'property' => 'background-color',
		),
		array(
			'element'  => '.mc4wp-form-fields input[type=submit]:hover',
			'property' => 'border-color',
		),
	),
) );
