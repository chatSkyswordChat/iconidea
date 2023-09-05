<?php
$section  = 'advanced';
$priority = 1;
$prefix   = 'advanced_';
arrowpress_customizer()->add_field( array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Googlebot', 'lusion' ) . '</div>',
) );

arrowpress_customizer()->add_field( array(
	'type'        => 'toggle',
	'settings'    => 'googlebot_enable',
	'label'       => esc_html__( 'Googlebot', 'lusion' ),
	'description' => esc_html__( 'Turn on to show Googlebot.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 0,
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Go to top', 'lusion' ) . '</div>',
) );

arrowpress_customizer()->add_field( array(
	'type'        => 'toggle',
	'settings'    => 'scroll_top_enable',
	'label'       => esc_html__( 'Go To Top Button', 'lusion' ),
	'description' => esc_html__( 'Turn on to show go to top button.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 1,
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Purchase theme', 'lusion' ) . '</div>',
) );

arrowpress_customizer()->add_field( array(
	'type'        => 'toggle',
	'settings'    => 'purchase_theme_enable',
	'label'       => esc_html__( 'Purchase theme Button', 'lusion' ),
	'description' => esc_html__( 'Turn on to show purchase theme button.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 0,
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'text',
	'settings' => 'price_theme',
	'label'    => esc_html__( 'Price Theme', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => esc_html__( '19', 'lusion' ),
	'required' => array(
		array(
			'setting'  => 'purchase_theme_enable',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'text',
	'settings' => 'link_theme',
	'label'    => esc_html__( 'Link', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => esc_html__( '', 'lusion' ),
	'required' => array(
		array(
			'setting'  => 'purchase_theme_enable',
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
	'default'  => '<div class="big_title">' . esc_html__( 'Style', 'lusion' ) . '</div>',
) );

arrowpress_customizer()->add_field( array(
	'type'        => 'toggle',
	'settings'    => 'custom_css_enable',
	'label'       => esc_html__( 'Custom CSS', 'lusion' ),
	'description' => esc_html__( 'Turn on to enable custom css.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 1,
) );

arrowpress_customizer()->add_field( array(
	'type'      => 'code',
	'settings'  => 'custom_css',
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 'body{background-color:#fff;}',
	'choices'   => array(
		'language' => 'css',
		'theme'    => 'monokai',
	),
	'transport' => 'postMessage',
	'js_vars'   => array(
		array(
			'element'  => '#lusion-style-inline-css',
			'function' => 'html',
		),
	),
) );

arrowpress_customizer()->add_field( array(
	'type'        => 'toggle',
	'settings'    => 'custom_js_enable',
	'label'       => esc_html__( 'Custom Javascript', 'lusion' ),
	'description' => esc_html__( 'Turn on to enable custom javascript', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 0,
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'code',
	'settings' => 'custom_js',
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '
		(function ($) {
			"use strict";
		})(jQuery);',
	'choices'  => array(
		'language' => 'javascript',
		'theme'    => 'monokai',
	),
) );

arrowpress_customizer()->add_field( array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Home page stylesheet', 'lusion' ) . '</div>',
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'select',
	'settings' => 'choose_home_default_stylesheet',
	'label'    => esc_html__( 'Home fashion store CSS stylesheet', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'fashion_store',
	'choices'  => array(
		'fashion_store' => '_home-fashion-store',
		'fashion_men'   => '_home_fashion-men',
	),
	'required' => array(
		array(
			'setting'  => 'enable_header_builder',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
