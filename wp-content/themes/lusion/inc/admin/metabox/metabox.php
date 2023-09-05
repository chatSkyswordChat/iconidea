<?php

class Apr_Metabox {

	public function __construct() {
		add_filter( 'arrowpress_add_meta_boxes', array( $this, 'register_page_metabox' ) );
	}

	function register_page_metabox( $meta_boxes ) {
		$meta_boxes[] = array(
			'id'         => 'new',
			'title'      => __( 'Page Options', 'lusion' ),
			'post_types' => array( 'page', 'e-landing-page' ),
			'tabs'       => true,
			'fields'     => $this->general_meta_fields()
		);

		return $meta_boxes;
	}

	public function general_option() {
		$apr_sidebars = Lusion_Helper::get_registered_sidebars( $default_option = true );

		return array(
			'title'  => esc_attr__( 'General', 'apr-core' ),
			'id'     => 'general',
			'fields' => array(
				array(
					'id'      => 'site_layout',
					'label'   => esc_attr__( 'Layout', 'apr-core' ),
					'desc'    => esc_attr__( 'Controls the layout of this page.', 'apr-core' ),
					'type'    => 'button_set',
					'options' => array(
						'default'     => esc_html__( 'Default', 'apr-core' ),
						'wide'        => esc_html__( 'Wide', 'apr-core' ),
						'full-screen' => esc_html__( 'Full Screen', 'apr-core' ),
						'full-width'  => esc_html__( 'Full width', 'apr-core' ),
						'boxed'       => esc_html__( 'Boxed', 'apr-core' ),
					),
					'default' => 'default',
				),
				array(
					'id'      => 'padding_container',
					'label'   => esc_attr__( 'Padding Container', 'apr-core' ),
					'desc'    => esc_attr__( '(Only works with wide layout). Enter value including any valid CSS unit, ex: 0 50px.', 'apr-core' ),
					'type'    => 'text',
					'default' => '',
				),
				array(
					'id'      => 'site_width',
					'label'   => esc_attr__( 'Site width', 'apr-core' ),
					'desc'    => esc_attr__( 'Controls the site width for this page (Only works with Full Width layout). Enter value including any valid CSS unit, ex: 1200px. Leave blank to use global setting.', 'apr-core' ),
					'type'    => 'text',
					'default' => '',
				),
				array(
					'id'      => 'preload',
					'label'   => esc_attr__( 'Preload Layout', 'apr-core' ),
					'type'    => 'select',
					'default' => 'default',
					'options' => array(
						'default'   => esc_html__( 'Default Preload', 'apr-core' ),
						'preload-1' => esc_html__( 'Preload Type 1', 'apr-core' ),
						'preload-2' => esc_html__( 'Preload Type 2', 'apr-core' ),
						'preload-3' => esc_html__( 'Preload Type 3', 'apr-core' ),
						'preload-4' => esc_html__( 'Preload Type 4', 'apr-core' ),
						'preload-5' => esc_html__( 'Preload Type 5', 'apr-core' ),
						'preload-6' => esc_html__( 'Preload Type 6', 'apr-core' ),
						'preload-7' => esc_html__( 'Preload Type 7', 'apr-core' ),
						'preload-8' => esc_html__( 'Preload Type 8', 'apr-core' ),
						'preload-9' => esc_html__( 'Preload Type 9', 'apr-core' ),
					),
					'desc'    => esc_attr__( '', 'apr-core' ),
				),
				array(
					'id'      => 'left_sidebar_general',
					'label'   => esc_attr__( 'Left Sidebar', 'apr-core' ),
					'type'    => 'select',
					'default' => 'default',
					'options' => $apr_sidebars,
					'desc'    => esc_attr__( '', 'apr-core' ),
				),
				array(
					'id'      => 'right_sidebar_general',
					'label'   => esc_attr__( 'Right Sidebar', 'apr-core' ),
					'type'    => 'select',
					'default' => 'default',
					'options' => $apr_sidebars,
					'desc'    => esc_attr__( '', 'apr-core' ),
				),
				array(
					'id'      => 'remove_space_top',
					'label'   => esc_attr__( 'Remove top space', 'apr-core' ),
					'type'    => 'checkbox',
					'default' => '',
					'desc'    => esc_attr__( 'Remove top space', 'apr-core' ),
				),
				array(
					'id'      => 'remove_space_bottom',
					'label'   => esc_attr__( 'Remove bottom space', 'apr-core' ),
					'type'    => 'checkbox',
					'default' => '',
					'desc'    => esc_attr__( 'Remove bottom space', 'apr-core' ),
				),
				array(
					'id'      => 'scroll_chevron_enable',
					'label'   => esc_attr__( 'Enable scroll chevron', 'apr-core' ),
					'type'    => 'checkbox',
					'default' => '',
					'desc'    => esc_attr__( 'Enable scroll chevron', 'apr-core' ),
				),
				array(
					'id'      => 'sale_popup_disabled_page',
					'label'   => esc_attr__( 'Disabled Sale Popup', 'apr-core' ),
					'type'    => 'checkbox',
					'default' => '',
					'desc'    => esc_attr__( 'Disabled Sale Popup', 'apr-core' ),
				),
				array(
					'id'      => 'recommend_popup_disabled_page',
					'label'   => esc_attr__( 'Disabled Recommend Products Popup', 'apr-core' ),
					'type'    => 'checkbox',
					'default' => '',
					'desc'    => esc_attr__( 'Disabled Recommend Products Popup', 'apr-core' ),
				),
			),
		);

	}

	public function skin_option() {
		return array(
			'title'  => esc_attr__( 'Skin', 'apr-core' ),
			'id'     => 'skin',
			'fields' => array(
				array(
					'id'      => 'site_color',
					'label'   => esc_attr__( 'Primary Color', 'apr-core' ),
					'desc'    => esc_attr__( 'Select different main color for page', 'apr-core' ),
					'type'    => 'color',
 					'default' => ''
				),
				array(
					'id'      => 'site_background',
					'label'   => esc_attr__( 'Body Background Color', 'apr-core' ),
					'desc'    => 'You should input hex color(ex: #e1e1e1)',
					'type'    => 'color',
					'default' => ''
				),
				array(
					'id'      => 'body_bg_image',
					'label'   => esc_attr__( 'Body Background Image', 'apr-core' ),
					'desc'    => '',
//					'type'    => 'image',
					'type'             => 'image_advanced',
					'max_file_uploads' => 1,
					'default' => ''
				),
				array(
					'id'      => 'scroll_top_color',
					'label'   => esc_attr__( 'Scroll to top color', 'apr-core' ),
					'type'    => 'color',
					'default' => '',
					'desc'    => esc_attr__( 'Scroll to top button color', 'apr-core' ),
				),
			)
		);
	}

	public function breadcrumbs_option() {
		return array(
			'title'  => esc_attr__( 'Breadcrumbs & Page title', 'apr-core' ),
			'id'     => 'breadcrumbs_title',
			'fields' => array(
				array(
					'id'      => 'breadcrumbs',
					'label'   => esc_attr__( 'Hide Breadcrumbs', 'apr-core' ),
					'type'    => 'checkbox',
					'default' => '',
				),
				array(
					'id'      => 'page_title',
					'label'   => esc_html__( 'Hide Page Title', 'apr-core' ),
					'desc'    => esc_html__( 'Hide Page Title', 'apr-core' ),
					'type'    => 'checkbox',
					'default' => '',
				),
				array(
					'id'      => 'align_breadcrumbs',
					'label'   => esc_html__( 'Align Breadcrumb', 'apr-core' ),
					'type'    => 'select',
					'options' => array(
						'default' => esc_html__( 'Default', 'apr-core' ),
						'left'    => esc_html__( 'Left', 'apr-core' ),
						'center'  => esc_html__( 'Center', 'apr-core' ),
						'right'   => esc_html__( 'Right', 'apr-core' ),
					),
					'default' => '',
				),
				array(
					"id"      => "breadcrumbs_bg",
					"label"   => esc_html__( "Breadcrumbs Background", 'apr-core' ),
					'desc'    => esc_html__( "Upload breadcrumbs background", 'apr-core' ),
//					"type"    => "image",
					'type'             => 'image_advanced',
					'max_file_uploads' => 1,
					'default' => '',
				),
				array(
					"id"      => "title_color",
					"label"   => esc_html__( "Page Title Color", 'apr-core' ),
					"type"    => "color",
					'default' => '',
				),
				array(
					"id"      => "breadcrumbs_color",
					"label"   => esc_html__( "Breadcrumbs Color", 'apr-core' ),
					"type"    => "color",
					'default' => '',
				),
				array(
					"id"      => "link_color",
					"label"   => esc_html__( "Breadcrumb Link Color", 'apr-core' ),
					"type"    => "color",
					'default' => '',
				),
				array(
					"id"      => "breadcrumbs_bg_overlay",
					"label"   => esc_html__( "Breadcrumbs Background Overlay ", 'apr-core' ),
					"type"    => "color",
					'default' => '',
				),
				array(
					"id"      => "breadcrumbs_opacity",
					"label"   => esc_html__( "Breadcrumbs Opacity Background Overlay ", 'apr-core' ),
					"type"    => "text",
					'default' => '',
				),
			)
		);
	}

	private function get_post_type_data( $post_type = 'post' ) {

		$data            = array();
		$args            = array(
			'post_type'      => 'header',
			'posts_per_page' => - 1,
			'post_status'    => 'publish',
		);
		$data['default'] = esc_html__( 'Default', 'apr-core' );
		if ( $posts = get_posts( $args ) ) {
			foreach ( $posts as $post ) {
				/**
				 * @var $post WP_Post
				 */
				$data[$post->post_name] = $post->post_title;
			}
		}

		return $data;
	}

	public function header_option() {
		return array(
			'title'  => esc_attr__( 'Header', 'apr-core' ),
			'id'     => 'header',
			'fields' => array(
				array(
					'id'      => 'header_type',
					'label'   => esc_attr__( 'Header Type', 'apr-core' ),
					'desc'    => esc_attr__( 'Select header type that displays on this page.', 'apr-core' ),
					'type'    => 'select',
					'options' => $this->get_post_type_data( 'header' ),
					'default' => 'default',
				),
				array(
					'id'      => 'menu_display',
					'label'   => esc_attr__( 'Primary menu', 'apr-core' ),
					'desc'    => esc_attr__( 'Select the menu displayed on this page. Only applies to the default header', 'apr-core' ),
					'type'    => 'select',
					'options' => Lusion_Helper::get_all_menus(),
					'default' => '',
				),
				array(
					'id'      => 'hide_header',
					'label'   => esc_attr__( 'Hide Header', 'apr-core' ),
					'desc'    => esc_attr__( 'Turn on hide status.', 'apr-core' ),
					'type'    => 'checkbox',
					'default' => '',
				),
				array(
					'id'      => 'fixed_header',
					'label'   => esc_attr__( 'Header fixed', 'apr-core' ),
					'desc'    => esc_attr__( 'Switch header fixed ON or OFF?', 'apr-core' ),
					'type'    => 'button_set',
					'options' => array(
						''    => esc_html__( 'Default', 'apr-core' ),
						'on'  => esc_html__( 'On', 'apr-core' ),
						'off' => esc_html__( 'Off', 'apr-core' ),
					),
					'default' => '',
				),

				array(
					'id'      => 'meta_header_sticky',
					'label'   => esc_attr__( 'Header Sticky', 'apr-core' ),
					'desc'    => esc_attr__( 'Switch header sticky ON or OFF?', 'apr-core' ),
					'type'    => 'button_set',
					'options' => array(
						''    => esc_html__( 'Default', 'apr-core' ),
						'on'  => esc_html__( 'On', 'apr-core' ),
						'off' => esc_html__( 'Off', 'apr-core' ),
					),
					'default' => '',
				),
				array(
					'id'      => 'sticky_bg',
					'label'   => esc_attr__( 'Header Sticky Background', 'apr-core' ),
					'desc'    => esc_html__( "You should input hex color(ex: #ffffff).", 'apr-core' ),
					'type'    => 'color',
					'default' => '',
				),
			)
		);
	}

	private function get_post_type_data_footer( $post_type = 'post' ) {

		$data            = array();
		$args            = array(
			'post_type'      => 'footer',
			'posts_per_page' => - 1,
			'post_status'    => 'publish',
		);
		$data['default'] = esc_html__( 'Default', 'apr-core' );
		if ( $posts = get_posts( $args ) ) {
			foreach ( $posts as $post ) {
				/**
				 * @var $post WP_Post
				 */
				$data[$post->post_name] = $post->post_title;
			}
		}

		return $data;
	}

	public function footer_option() {
		return array(
			'title' => esc_attr__( 'Footer', 'apr-core' ),
			'id'    => 'footer', 'fields' => array(
				array(
					'id'      => 'footer_type',
					'label'   => esc_attr__( 'Footer Type', 'apr-core' ),
					'desc'    => esc_attr__( 'Select footer type that displays on this page.', 'apr-core' ),
					'type'    => 'select',
					'options' => $this->get_post_type_data_footer( 'footer' ),
					'default' => 'default',
				),
				array(
					'id'      => 'hide_footer',
					'label'   => esc_attr__( 'Hide Footer', 'apr-core' ),
					'desc'    => esc_attr__( 'Turn on hide status.', 'apr-core' ),
					'type'    => 'checkbox',
					'default' => '',
				),
			)
		);
	}

	public function general_meta_fields() {
		$meta_fields = array(
			$this->general_option(),
			$this->skin_option(),
			$this->breadcrumbs_option(),
			$this->header_option(),
			$this->footer_option(),
		);

		return $meta_fields;
	}
}

if ( class_exists( 'Apr_Metabox' ) ) {
	new Apr_Metabox;
}

require_once LUSION_ADMIN . '/metabox/class-header-metabox.php';
require_once LUSION_ADMIN . '/metabox/class-post-metabox.php';
require_once LUSION_ADMIN . '/metabox/class-product-metabox.php';
require_once LUSION_ADMIN . '/metabox/class-portfolio-metabox.php';
