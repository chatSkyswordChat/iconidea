<?php
$section  = 'popup_account';
$priority = 1;
$prefix   = 'popup_account_';
arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'show',
	'label'    => esc_html__( 'Show/Hide Popup', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'No', 'lusion' ),
		'1' => esc_html__( 'Yes', 'lusion' ),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'text',
	'settings' => 'popup_login_height',
	'label'    => esc_html__( 'Height Popup Login', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '472px',
	'required' => array(
		array(
			'setting'  => 'popup_account_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'   => array(
		array(
			'element'  => '.popup-account, .popup-account.popup-login',
			'property' => 'min-height',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'text',
	'settings' => 'popup_login_width',
	'label'    => esc_html__( 'Width Popup Login', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '490px',
	'required' => array(
		array(
			'setting'  => 'popup_account_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'   => array(
		array(
			'element'  => '.popup-account, .popup-account.popup-login',
			'property' => 'width',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'text',
	'settings' => 'popup_register_height',
	'label'    => esc_html__( 'Height Popup Register', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '577px',
	'required' => array(
		array(
			'setting'  => 'popup_account_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'   => array(
		array(
			'element'  => '.popup-account.popup-register',
			'property' => 'min-height',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'text',
	'settings' => 'popup_register_width',
	'label'    => esc_html__( 'Width Popup Register', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '490px',
	'required' => array(
		array(
			'setting'  => 'popup_account_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'   => array(
		array(
			'element'  => '.popup-account.popup-register',
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
			'element'  => '.popup-account',
			'property' => 'background-color',
		),
	),
	'required'    => array(
		array(
			'setting'  => 'popup_account_show',
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
	'default'  => '<div class="big_title">' . esc_html__( 'Title Form Popup', 'lusion' ) . '</div>',
	'required' => array(
		array(
			'setting'  => 'popup_account_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'color',
	'settings'    => $prefix . 'title_bg',
	'label'       => esc_html__( 'Background', 'lusion' ),
	'description' => esc_html__( 'Background title form', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'transparent',
	'output'      => array(
		array(
			'element'  => '.popup-account .popup-title',
			'property' => 'background-color',
		),
	),
	'required'    => array(
		array(
			'setting'  => 'popup_account_show',
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
			'setting'  => 'popup_account_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'default'     => array(
		'font-family'    => Lusion::PRIMARY_FONT,
		'variant'        => 'regular',
		'line-height'    => '32px',
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
			'element' => '.popup-title',
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
	'required'  => array(
		array(
			'setting'  => 'popup_account_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'    => array(
		array(
			'element'  => '.popup-account .popup-title',
			'property' => 'color',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'slider',
	'settings'  => $prefix . 'title_size',
	'label'     => esc_html__( 'Font size', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 32,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.popup-account .popup-title',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
	'required'  => array(
		array(
			'setting'  => 'popup_account_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => $prefix . 'text_color',
	'label'     => esc_html__( 'Text Color', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => '#2c2c2c',
	'required'  => array(
		array(
			'setting'  => 'popup_account_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'    => array(
		array(
			'element'  => '.popup-account .nav-tabs li a.nav-link,.popup-account form.woocommerce-form-login .wc-social-login .ywsl-label',
			'property' => 'color',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => $prefix . 'link_color',
	'label'     => esc_html__( 'Link Color', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => '#707070',
	'required'  => array(
		array(
			'setting'  => 'popup_account_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'    => array(
		array(
			'element'  => '.popup-account form .lost_password a',
			'property' => 'color',
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
			'setting'  => 'popup_account_show',
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
			'setting'  => 'popup_account_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'    => array(
		array(
			'element'  => '.popup-account form .form-row input[type=email], 
							.popup-account form .form-row input[type=password], 
							.popup-account form .form-row input[type=text],
							.popup-account form .form-row input[type=email]::placeholder, 
							.popup-account form .form-row input[type=password]::placeholder, 
							.popup-account form .form-row input[type=text]::placeholder',
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
			'setting'  => 'popup_account_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'    => array(
		array(
			'element'  => '	.popup-account form .form-row input[type=email], 
							.popup-account form .form-row input[type=password], 
							.popup-account form .form-row input[type=text]',
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
	'default'   => '',
	'required'  => array(
		array(
			'setting'  => 'popup_account_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'    => array(
		array(
			'element'  => '.popup-account form.woocommerce-form.woocommerce-form-register button.button, .popup-account form.woocommerce-form.woocommerce-form-login button.button',
			'property' => 'color',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => $prefix . 'hover_color_button',
	'label'     => esc_html__( 'Hover Button Color ', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => '',
	'required'  => array(
		array(
			'setting'  => 'popup_account_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'    => array(
		array(
			'element'  => '.popup-account form.woocommerce-form.woocommerce-form-register button.button:hover, .popup-account form.woocommerce-form.woocommerce-form-register button.button:focus, .popup-account form.woocommerce-form.woocommerce-form-register button.button:active, .popup-account form.woocommerce-form.woocommerce-form-login button.button:hover, .popup-account form.woocommerce-form.woocommerce-form-login button.button:focus, .popup-account form.woocommerce-form.woocommerce-form-login button.button:active',
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
	'default'   => '',
	'required'  => array(
		array(
			'setting'  => 'popup_account_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'    => array(
		array(
			'element'  => '.popup-account form.woocommerce-form.woocommerce-form-register button.button, .popup-account form.woocommerce-form.woocommerce-form-login button.button',
			'property' => 'background-color',
		),
		array(
			'element'  => '.popup-account form.woocommerce-form.woocommerce-form-register button.button, .popup-account form.woocommerce-form.woocommerce-form-login button.button',
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
	'default'   => '',
	'required'  => array(
		array(
			'setting'  => 'popup_account_show',
			'operator' => '==',
			'value'    => 1,
		),
	),
	'output'    => array(
		array(
			'element'  => '.popup-account form.woocommerce-form.woocommerce-form-register button.button:hover, .popup-account form.woocommerce-form.woocommerce-form-register button.button:focus, .popup-account form.woocommerce-form.woocommerce-form-register button.button:active, .popup-account form.woocommerce-form.woocommerce-form-login button.button:hover, .popup-account form.woocommerce-form.woocommerce-form-login button.button:focus, .popup-account form.woocommerce-form.woocommerce-form-login button.button:active',
			'property' => 'background-color',
		),
		array(
			'element'  => '.popup-account form.woocommerce-form.woocommerce-form-register button.button:hover, .popup-account form.woocommerce-form.woocommerce-form-register button.button:focus, .popup-account form.woocommerce-form.woocommerce-form-register button.button:active, .popup-account form.woocommerce-form.woocommerce-form-login button.button:hover, .popup-account form.woocommerce-form.woocommerce-form-login button.button:focus, .popup-account form.woocommerce-form.woocommerce-form-login button.button:active',
			'property' => 'border-color',
		),
	),
) );
