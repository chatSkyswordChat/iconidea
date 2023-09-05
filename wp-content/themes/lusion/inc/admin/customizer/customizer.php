<?php

/**
 * Add sections
 */
$priority = 1;
arrowpress_customizer()->add_panel( array(
	'id'       => 'general',
	'title'    => esc_html__( 'General', 'lusion' ),
	'priority' => $priority ++,
) );
arrowpress_customizer()->add_section( array(
	'id'       => 'header',
	'title'    => esc_html__( 'Header', 'lusion' ),
	'priority' => $priority ++,
) );
arrowpress_customizer()->add_section( array(
	'id'       => 'footer',
	'title'    => esc_html__( 'Footer', 'lusion' ),
	'priority' => $priority ++,
) );
arrowpress_customizer()->add_panel( array(
	'id'       => 'blog',
	'title'    => esc_html__( 'Blog', 'lusion' ),
	'priority' => $priority ++,
) );
arrowpress_customizer()->add_panel( array(
	'id'       => 'portfolio',
	'title'    => esc_html__( 'Portfolio', 'lusion' ),
	'priority' => $priority ++,
) );
arrowpress_customizer()->add_panel( array(
	'id'       => 'shop',
	'title'    => esc_html__( 'Shop', 'lusion' ),
	'priority' => $priority ++,
) );
arrowpress_customizer()->add_panel( array(
	'id'       => 'popup',
	'title'    => esc_html__( 'Popup', 'lusion' ),
	'priority' => $priority ++,
) );
arrowpress_customizer()->add_section( array(
	'id'       => 'sidebars',
	'title'    => esc_html__( 'Sidebars', 'lusion' ),
	'priority' => $priority ++,
) );
arrowpress_customizer()->add_panel( array(
	'id'       => 'error_comingsoon',
	'title'    => esc_html__( '404 Page & Coming Soon', 'lusion' ),
	'priority' => $priority ++,
) );
arrowpress_customizer()->add_section( array(
	'id'       => 'advanced',
	'title'    => esc_html__( 'Advanced', 'lusion' ),
	'priority' => $priority ++,
) );

/* Custom field height logo */
arrowpress_customizer()->add_field( array(
	'type'        => 'slider',
	'settings'    => 'logo_size',
	'label'       => esc_html__( 'Width Logo', 'lusion' ),
	'description' => esc_html__( 'Select max width for your logo', 'lusion' ),
	'section'     => 'title_tagline',
	'priority'    => 9,
	'default'     => '100',
	'transport'   => 'refresh',
	'choices'     => array(
		'min'  => 30,
		'max'  => 200,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => '.custom-logo',
			'property' => 'max-width',
			'units'    => 'px',
		),
	),
) );

/**
 * Load panel & section files
 */
/* General */
require_once LUSION_CUSTOMIZER_DIR . '/general/_panel.php';
require_once LUSION_CUSTOMIZER_DIR . '/general/typography.php';
require_once LUSION_CUSTOMIZER_DIR . '/general/color.php';
require_once LUSION_CUSTOMIZER_DIR . '/general/layout.php';
require_once LUSION_CUSTOMIZER_DIR . '/general/preloader.php';
require_once LUSION_CUSTOMIZER_DIR . '/general/breadcrumb.php';;
/* Header */
require_once LUSION_CUSTOMIZER_DIR . '/header/_panel.php';
require_once LUSION_CUSTOMIZER_DIR . '/header/general.php';
/* Footer */
require_once LUSION_CUSTOMIZER_DIR . '/section-footer.php';
/* Advanced */
require_once LUSION_CUSTOMIZER_DIR . '/section-advanced.php';
/* Blog */
require_once LUSION_CUSTOMIZER_DIR . '/blog/_panel.php';
require_once LUSION_CUSTOMIZER_DIR . '/blog/general.php';
require_once LUSION_CUSTOMIZER_DIR . '/blog/archive.php';
require_once LUSION_CUSTOMIZER_DIR . '/blog/single.php';
/* Portfolio */
require_once LUSION_CUSTOMIZER_DIR . '/portfolio/_panel.php';
require_once LUSION_CUSTOMIZER_DIR . '/portfolio/archive.php';
require_once LUSION_CUSTOMIZER_DIR . '/portfolio/single.php';
/* Shop */
require_once LUSION_CUSTOMIZER_DIR . '/shop/_panel.php';
require_once LUSION_CUSTOMIZER_DIR . '/shop/general.php';
require_once LUSION_CUSTOMIZER_DIR . '/shop/archive.php';
require_once LUSION_CUSTOMIZER_DIR . '/shop/single.php';
require_once LUSION_CUSTOMIZER_DIR . '/shop/cart.php';
require_once LUSION_CUSTOMIZER_DIR . '/section-sidebars.php';
/* Popup */
require_once LUSION_CUSTOMIZER_DIR . '/popup/_panel.php';
require_once LUSION_CUSTOMIZER_DIR . '/popup/account.php';
require_once LUSION_CUSTOMIZER_DIR . '/popup/newsletter.php';
require_once LUSION_CUSTOMIZER_DIR . '/popup/sale-popup.php';
require_once LUSION_CUSTOMIZER_DIR . '/popup/sale.php';

/* errorcomingsoon */
require_once LUSION_CUSTOMIZER_DIR . '/error_comingsoon/_panel.php';
require_once LUSION_CUSTOMIZER_DIR . '/error_comingsoon/error.php';
require_once LUSION_CUSTOMIZER_DIR . '/error_comingsoon/comingsoon.php';
