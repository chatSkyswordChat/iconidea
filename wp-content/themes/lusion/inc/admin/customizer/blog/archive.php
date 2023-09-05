<?php
$section             = 'blog_archive';
$priority            = 1;
$prefix              = 'blog_archive_';
$on                  = esc_html__( 'On', 'lusion' );
$off                 = esc_html__( 'Off', 'lusion' );
$registered_sidebars = Lusion_Helper::get_registered_sidebars();
arrowpress_customizer()->add_field( array(
	'type'        => 'select',
	'settings'    => 'blog_sidebar_left',
	'label'       => esc_html__( 'Sidebar Left', 'lusion' ),
	'description' => esc_html__( 'Select sidebar left.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '',
	'choices'     => $registered_sidebars,
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'select',
	'settings'    => 'blog_sidebar_right',
	'label'       => esc_html__( 'Sidebar Right', 'lusion' ),
	'description' => esc_html__( 'Select sidebar right.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'blog_sidebar',
	'choices'     => $registered_sidebars,
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'layout',
	'label'    => esc_html__( 'Blog Layout', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'list',
	'choices'  => array(
		'list'    => esc_html__( 'List', 'lusion' ),
		'grid'    => esc_html__( 'Grid', 'lusion' ),
		'masonry' => esc_html__( 'Masonry', 'lusion' ),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'layout_list_style',
	'label'    => esc_html__( 'Layout Style', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'style_3',
	'choices'  => array(
		'style_1' => esc_html__( 'Style 1', 'lusion' ),
		'style_2' => esc_html__( 'Style 2', 'lusion' ),
		'style_3' => esc_html__( 'Style 3', 'lusion' ),
	),
	'required' => array(
		array(
			'setting'  => 'blog_archive_layout',
			'operator' => '==',
			'value'    => 'list',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'columns_grid',
	'label'       => esc_html__( ' Number Columns', 'lusion' ),
	'description' => esc_html__( 'Select columns for blog.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '2',
	'choices'     => array(
		'2' => esc_html__( '2 col', 'lusion' ),
		'3' => esc_html__( '3 col', 'lusion' ),
		'4' => esc_html__( '4 col', 'lusion' ),
	),
	'required'    => array(
		array(
			'setting'  => 'blog_archive_layout',
			'operator' => '==',
			'value'    => 'grid',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'columns_masonry',
	'label'       => esc_html__( ' Number Columns', 'lusion' ),
	'description' => esc_html__( 'Select columns for blog.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '2',
	'choices'     => array(
		'2' => esc_html__( '2 col', 'lusion' ),
		'3' => esc_html__( '3 col', 'lusion' ),
		'4' => esc_html__( '4 col', 'lusion' ),
	),
	'required'    => array(
		array(
			'setting'  => 'blog_archive_layout',
			'operator' => '==',
			'value'    => 'masonry',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'meta_enable',
	'label'       => esc_html__( 'Post Meta', 'lusion' ),
	'description' => esc_html__( 'Turn on to display the meta post.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => $off,
		'1' => $on,
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'multicheck',
	'settings' => $prefix . 'meta',
	'label'    => esc_attr__( 'Post Meta', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => array( 'date', 'author', 'comment', 'tags', 'categories' ),
	'choices'  => array(
		'date'       => esc_attr__( 'Date', 'lusion' ),
		'author'     => esc_attr__( 'Author', 'lusion' ),
		'comment'    => esc_attr__( 'Comment', 'lusion' ),
		'tags'       => esc_attr__( 'Tags', 'lusion' ),
		'categories' => esc_attr__( 'Categories', 'lusion' ),
	),
	'required' => array(
		array(
			'setting'  => 'blog_archive_meta_enable',
			'operator' => '==',
			'value'    => 1,
		),

		array(
			'setting'  => 'blog_archive_layout_list_style',
			'operator' => '!==',
			'value'    => 'style_2',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'     => 'multicheck',
	'settings' => $prefix . 'meta_list_style_2',
	'label'    => esc_attr__( 'Post Meta', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => array( 'categories', 'date', 'comment' ),
	'choices'  => array(
		'date'       => esc_attr__( 'Date', 'lusion' ),
		'author'     => esc_attr__( 'Author', 'lusion' ),
		'comment'    => esc_attr__( 'Comment', 'lusion' ),
		'tags'       => esc_attr__( 'Tags', 'lusion' ),
		'categories' => esc_attr__( 'Categories', 'lusion' ),
	),
	'required' => array(
		array(
			'setting'  => 'blog_archive_meta_enable',
			'operator' => '==',
			'value'    => 1,
		),
		array(
			'setting'  => 'blog_archive_layout_list_style',
			'operator' => '==',
			'value'    => 'style_2',
		),
	),
) );
arrowpress_customizer()->add_field( array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'desc_enable',
	'label'       => esc_html__( 'Post Description', 'lusion' ),
	'description' => esc_html__( 'Turn on to display the description post.', 'lusion' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => $off,
		'1' => $on,
	),
) );
arrowpress_customizer()->add_field( array(
	'type'      => 'slider',
	'settings'  => 'limit_desc',
	'label'     => esc_html__( 'Limit characters description', 'lusion' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 300,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 30,
		'max'  => 500,
		'step' => 1,
	),
	'required'  => array(
		array(
			'setting'  => 'blog_archive_desc_enable',
			'operator' => '==',
			'value'    => 1,
		),
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
	'default'     => array( 'facebook', 'twitter', 'pinterest', 'gmail' ),
	'choices'     => array(
		'facebook'  => esc_attr__( 'Facebook', 'lusion' ),
		'twitter'   => esc_attr__( 'Twitter', 'lusion' ),
		'pinterest' => esc_attr__( 'Pinterest', 'lusion' ),
		'gmail'     => esc_attr__( 'Gmail', 'lusion' ),
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
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'pagination',
	'label'    => esc_html__( 'Pagination type', 'lusion' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'number',
	'choices'  => array(
		'load_more' => esc_html__( 'Load more', 'lusion' ),
		'next_prev' => esc_html__( 'Next/Prev', 'lusion' ),
		'number'    => esc_html__( 'Number', 'lusion' ),
	),
) );
