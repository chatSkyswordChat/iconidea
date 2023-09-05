<?php
$section             = 'blog_single';
$priority            = 1;
$prefix              = 'single_post_';
$on                  = esc_html__( 'On', 'lusion' );
$off                 = esc_html__( 'Off', 'lusion' );
$registered_sidebars = Lusion_Helper::get_registered_sidebars();
arrowpress_customizer()->add_field( array(
	'type'        => 'select',
	'settings'    => 'blog_single_sidebar_left',
	'label'       => esc_html__( 'Sidebar Left', 'lusion' ),
	'description' => esc_html__( 'Select sidebar left.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '',
	'choices'     => $registered_sidebars,
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'select',
	'settings'    => 'blog_single_sidebar_right',
	'label'       => esc_html__( 'Sidebar Right', 'lusion' ),
	'description' => esc_html__( 'Select sidebar right.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'blog_sidebar',
	'choices'     => $registered_sidebars,
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'multicheck',
	'settings' => $prefix . 'meta',
	'label'    => esc_attr__( 'Post Meta', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => array( 'date', 'categories', 'comment' ),
	'choices'  => array(
		'date'       => esc_attr__( 'Date', 'lusion' ),
		'categories' => esc_attr__( 'Categories', 'lusion' ),
		'comment'    => esc_attr__( 'Comment', 'lusion' ),
		'author'     => esc_attr__( 'Author', 'lusion' ),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'comment_enable',
	'label'    => esc_html__( 'Single comment', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '1',
	'choices'  => array(
		'0' => $off,
		'1' => $on,
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'tag_enable',
	'label'    => esc_html__( 'Show Tags', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '1',
	'choices'  => array(
		'0' => $off,
		'1' => $on,
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'description_author_enable',
	'label'    => esc_html__( 'Show author', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '1',
	'choices'  => array(
		'0' => $off,
		'1' => $on,
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'share_enable',

	'label'       => esc_html__( 'Post Sharing', 'lusion' ),
	'description' => esc_html__( 'Turn on to display the social sharing on blog single posts.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'lusion' ),
		'1' => esc_html__( 'On', 'lusion' ),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'multicheck',
	'settings'    => $prefix . 'item_enable',
	'label'       => esc_attr__( 'Sharing Links', 'lusion' ),
	'description' => esc_html__( 'Check to the box to enable social share links.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => array( 'facebook', 'twitter', 'pinterest' ),
	'choices'     => array(
		'facebook'  => esc_attr__( 'Facebook', 'lusion' ),
		'twitter'   => esc_attr__( 'Twitter', 'lusion' ),
		'pinterest' => esc_attr__( 'Pinterest', 'lusion' ),
		'whatsapp'  => esc_attr__( 'Whatsapp', 'lusion' ),
	),
	'required'    => array(
		array(
			'setting'  => $prefix . 'share_enable',
			'operator' => '==',
			'value'    => 1,
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_post_related_enable',
	'label'       => esc_html__( 'Other news', 'lusion' ),
	'description' => esc_html__( 'Turn on to display other news post on blog single posts.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'lusion' ),
		'1' => esc_html__( 'On', 'lusion' ),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'textarea',
	'settings' => 'other_news_title',
	'label'    => esc_html__( 'Title other news', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => wp_kses(
		__( 'Other news from the Lusion:', 'lusion' ),
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

	'active_callback' => array(
		array(
			'setting'  => 'single_post_related_enable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'            => 'number',
	'settings'        => 'single_post_related_number',
	'label'           => esc_html__( 'Number of other posts item', 'lusion' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'default'         => 3,
	'choices'         => array(
		'min'  => 0,
		'max'  => 50,
		'step' => 1,
	),
	'active_callback' => array(
		array(
			'setting'  => 'single_post_related_enable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );
