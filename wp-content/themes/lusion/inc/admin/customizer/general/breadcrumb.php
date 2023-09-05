<?php
$section  = 'breadcrumb-config';
$priority = 1;
$prefix   = 'general_';

arrowpress_customizer()->add_field( array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Styling', 'lusion' ) . '</div>',
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div>' . esc_html__( 'Note: Does Not Apply To Product Pages.', 'lusion' ) . '</div>',
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'dimensions',
	'settings'    => $prefix . 'padding',
	'label'       => esc_html__( 'Padding', 'lusion' ),
	'description' => esc_html__( 'Default padding:39px(top), 40px(bottom).', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => array(
		'top'    => '39px',
		'bottom' => '40px',
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => array(
				'.side-breadcrumb, .side-breadcrumb.breadcrumb_has_bg',
			),
			'property' => 'padding',
		),
	),
) );


arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'align',
	'label'    => esc_html__( 'Align', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'center',
	'choices'  => array(
		'left'   => esc_html__( 'Left', 'lusion' ),
		'center' => esc_html__( 'Center', 'lusion' ),
		'right'  => esc_html__( 'Right', 'lusion' ),
	),
	'output'   => array(
		array(
			'element'  => array(
				'.side-breadcrumb',
			),
			'property' => 'text-align',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'color',
	'settings'    => 'background_overlay',
	'label'       => esc_html__( 'Background Overlay', 'lusion' ),
	'description' => esc_html__( 'Controls the background overlay of breadcrumb.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.side-breadcrumb.breadcrumb_has_bg:before',
			'property' => 'background'
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'text',
	'settings' => 'bg_opacity',
	'label'    => __( 'Enter opacity to set background opacity, default: 0.6.', 'lusion' ),
	'section'  => $section,
	'default'  => '0.5',
	'priority' => $priority ++,
	'output'   => array(
		array(
			'element'  => '.side-breadcrumb.breadcrumb_has_bg:before',
			'property' => 'opacity',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'background',
	'settings'    => $prefix . 'background',
	'label'       => esc_html__( 'Background', 'lusion' ),
	'description' => esc_html__( 'Controls the background of breadcrumb. Note: Setting background image for breadcrumbs on the specific page has priority over that on customizing section which is the default for all pages. Background color is not applied when background image is applied.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => array(
		'background-color'      => '',
		'background-image'      => LUSION_THEME_URI . '/assets/images/bg-breadcrumb.jpg',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
		'background-position'   => 'center center',
	),
	'output'      => array(
		array(
			'element' => '.side-breadcrumb.breadcrumb_has_bg',
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Page Title', 'lusion' ) . '</div>',
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div>' . esc_html__( 'Note: Does Not Apply To Product Pages.', 'lusion' ) . '</div>',
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => 'page_title',
	'label'    => esc_html__( 'Page Title.', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'lusion' ),
		'1' => esc_html__( 'Show', 'lusion' ),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'typography',
	'settings'    => 'page_title_typography',
	'label'       => esc_html__( 'Typography', 'lusion' ),
	'description' => esc_html__( 'These settings control the typography for page title.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => Lusion::PRIMARY_FONT,
		'variant'        => '400',
		'letter-spacing' => '0em',
		'font-size'      => '36px',
		'text-transform' => ''
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
			'media_query' => '@media (min-width: 1200px)',
			'element'     => '.side-breadcrumb .page-title h1',
		),
	),
	'required'    => array(
		array(
			'setting'  => 'page_title',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => 'page_title_color',
	'label'     => esc_html__( 'Color for page title', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => '#ffffff',
	'output'    => array(
		array(
			'element'  => '.side-breadcrumb .page-title h1',
			'property' => 'color',
		),
	),
	'required'  => array(
		array(
			'setting'  => 'page_title',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Breadcrumb', 'lusion' ) . '</div>',
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => 'breadcrumb',
	'label'    => esc_html__( 'Breadcrumb.', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Hide', 'lusion' ),
		'1' => esc_html__( 'Show', 'lusion' ),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => 'link_align',
	'label'    => esc_html__( 'Align breadcrumb link.', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'center',
	'choices'  => array(
		'left'   => esc_html__( 'Left', 'lusion' ),
		'right'  => esc_html__( 'Right', 'lusion' ),
		'center' => esc_html__( 'Center', 'lusion' ),
	),
	'output'   => array(
		array(
			'element'  => '.col-xl-12 .breadcrumb',
			'property' => 'text-align',
		),
	),
	'required' => array(
		array(
			'setting'  => 'page_title',
			'operator' => '==',
			'value'    => 0,
		),
		array(
			'setting'  => 'breadcrumb',
			'operator' => '==',
			'value'    => 1,
		),
	),

) );

// Icon link

arrowpress_customizer()->add_field( array(
	'type'        => 'typography',
	'settings'    => 'link_typography',
	'label'       => esc_html__( 'Typography', 'lusion' ),
	'description' => esc_html__( 'These settings control the typography for breadcrumb link.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => Lusion::PRIMARY_FONT,
		'variant'        => '400',
		'letter-spacing' => '0',
		'text-transform' => 'Capitalize'
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
			'element' => '.breadcrumb li, 
                        .breadcrumb li a',
		),
	),
	'required'    => array(
		array(
			'setting'  => 'breadcrumb',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'slider',
	'settings'  => 'text_font_size',
	'label'     => esc_html__( 'Breadcrumb Link Font Size', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => '16',
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 30,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.breadcrumb li:before, 
                            .breadcrumb li:last-child, 
                            .breadcrumb li a',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
	'required'  => array(
		array(
			'setting'  => 'breadcrumb',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'        => 'color',
	'settings'    => 'link_color',
	'label'       => esc_html__( 'Color for breadcrumb link', 'lusion' ),
	'description' => esc_html__( 'Note: Does Not Apply To Product Pages.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '',
	'output'      => array(
		array(
			'element'  => '.breadcrumb li .home, .breadcrumb li a, .breadcrumb li:before,
			.side-breadcrumb.breadcrumb_has_bg .breadcrumb .home, .side-breadcrumb.breadcrumb_has_bg .breadcrumb li a',
			'property' => 'color',
		),
	),
	'required'    => array(
		array(
			'setting'  => 'breadcrumb',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'        => 'color',
	'settings'    => 'text_color',
	'label'       => esc_html__( 'Color for breadcrumb', 'lusion' ),
	'description' => esc_html__( 'Note: Does Not Apply To Product Pages.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '',
	'output'      => array(
		array(
			'element'  => '.breadcrumb li, .side-breadcrumb.breadcrumb_has_bg .breadcrumb li',
			'property' => 'color',
		),
	),
	'required'    => array(
		array(
			'setting'  => 'breadcrumb',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Breadcrumb For Product Pages.', 'lusion' ) . '</div>',
) );

arrowpress_customizer()->add_field( array(
	'type'        => 'dimensions',
	'settings'    => $prefix . 'padding_product',
	'label'       => esc_html__( 'Padding', 'lusion' ),
	'description' => esc_html__( 'Default padding:22px 0 22px.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => array(
		'top'    => '22px',
		'bottom' => '22px',
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => array(
				'.single-product .side-breadcrumb',
			),
			'suffix'   => '!important',
			'property' => 'padding',
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'align_product',
	'label'    => esc_html__( 'Align', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'left',
	'choices'  => array(
		'left'   => esc_html__( 'Left', 'lusion' ),
		'center' => esc_html__( 'Center', 'lusion' ),
		'right'  => esc_html__( 'Right', 'lusion' ),
	),
	'output'   => array(
		array(
			'element'  => array(
				'.single-product .side-breadcrumb',
			),
			'suffix'   => '!important',
			'property' => 'text-align',
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'        => 'color',
	'settings'    => 'background_single_product',
	'label'       => esc_html__( 'Background', 'lusion' ),
	'description' => esc_html__( 'Controls the background of breadcrumb.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '',
	'output'      => array(
		array(
			'element'  => '.single-product .side-breadcrumb',
			'suffix'   => '!important',
			'property' => 'background'
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => 'link_color_product',
	'label'     => esc_html__( 'Color for breadcrumb link', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => '',
	'output'    => array(
		array(
			'element'  => '.single-product .side-breadcrumb .breadcrumb li:before, .single-product .side-breadcrumb .breadcrumb li a, .single-product .side-breadcrumb .breadcrumb li .home',
			'property' => 'color',
		),
	),
	'required'  => array(
		array(
			'setting'  => 'breadcrumb',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'      => 'color',
	'settings'  => 'text_color_product',
	'label'     => esc_html__( 'Color for breadcrumb', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'transport' => 'auto',
	'default'   => '',
	'output'    => array(
		array(
			'element'  => '.single-product .side-breadcrumb .breadcrumb li',
			'property' => 'color',
		),
	),
	'required'  => array(
		array(
			'setting'  => 'breadcrumb',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );


