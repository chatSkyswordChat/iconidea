<?php
$section  = 'footer';
$priority = 1;
$prefix   = 'footer_';
$link_id  = Lusion::setting( 'choose_footer_builder' );
$link     = '<a target="_blank" href="edit.php?post_type=footer" class="link_edit_header_buider">Go to footer buider</a>';
$footers  = Lusion_Helper::get_footer_list();
arrowpress_customizer()->add_field( array(
	'type'     => 'toggle',
	'settings' => 'enable_footer_builder',
	'label'    => esc_html__( 'Enable Footer Builder', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 0,
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => 'footer_layout',
	'label'    => esc_html__( 'Footer Layout', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'full_width',
	'choices'  => array(
		'wide'       => esc_html__( 'Wide', 'lusion' ),
		'full_width' => esc_html__( 'Full Width', 'lusion' )
	),
	'required' => array(
		array(
			'setting'  => 'enable_footer_builder',
			'operator' => '==',
			'value'    => 0,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => 'footer_bg_color',
	'label'     => esc_html__( 'Background Color', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => '#f8f8f8',
	'output'    => array(
		array(
			'element'  => '.footer-default, .list-hours ul li span:last-child',
			'property' => 'background-color',
		),
	),
	'required'  => array(
		array(
			'setting'  => 'enable_footer_builder',
			'operator' => '==',
			'value'    => 0,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => 'footer_text_color',
	'label'     => esc_html__( 'Color text', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => '#707070',
	'output'    => array(
		array(
			'element'  => '.footer-default p, .footer-default .list-hours ul li',
			'property' => 'color',
		),
	),
	'required'  => array(
		array(
			'setting'  => 'enable_footer_builder',
			'operator' => '==',
			'value'    => 0,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => 'footer_link_color',
	'label'     => esc_html__( 'Color link', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => '#2c2c2c',
	'output'    => array(
		array(
			'element'  => '.footer-default a',
			'property' => 'color',
		),
	),
	'required'  => array(
		array(
			'setting'  => 'enable_footer_builder',
			'operator' => '==',
			'value'    => 0,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => 'footer_link_hover_color',
	'label'     => esc_html__( 'Color link hover', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => Lusion::PRIMARY_COLOR,
	'output'    => array(
		array(
			'element'  => '.footer-default a:hover',
			'property' => 'color',
		),
	),
	'required'  => array(
		array(
			'setting'  => 'enable_footer_builder',
			'operator' => '==',
			'value'    => 0,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'select',
	'settings' => 'choose_footer_builder',
	'label'    => esc_html__( 'Default Footer', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'choices'  => lusion_get_footers_post_type(),
	'required' => array(
		array(
			'setting'  => 'enable_footer_builder',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'id'       => 'my_config',
	'type'     => 'custom',
	'settings' => 'link_edit_footer_buider',
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => $link,
	'required' => array(
		array(
			'setting'  => 'enable_footer_builder',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'textarea',
	'settings' => 'footer_copyright',
	'label'    => esc_html__( 'Copyright', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => wp_kses(
		__( ' <p>Copyright &copy;2020 <a href="#">Lusion</a> &ndash; Design by <a target="_blank" href="https://arrowtheme.com/">ArrowTheme</a> &ndash; All Rights Reserved.</p>', 'lusion' ),
		array(
			'a'  => array(
				'href'   => array(),
				'title'  => array(),
				'target' => array(),
			),
			'p'  => array( 'class' => array() ),
			'br' => array(),
			'i'  => array(
				'class'       => array(),
				'aria-hidden' => array(),
			),
		)
	),
	'required' => array(
		array(
			'setting'  => 'enable_footer_builder',
			'operator' => '==',
			'value'    => 0,
		),
	),
) );
