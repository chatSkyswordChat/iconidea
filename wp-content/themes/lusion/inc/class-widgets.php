<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'Lusion_Widgets' ) ) {
	class Lusion_Widgets {
		public function __construct() {
			// Register widget areas.
			add_action( 'widgets_init', array(
				$this,
				'register_sidebars',
			) );
		}

		/**
		 * Register widget area.
		 *
		 * @access public
		 * @link   https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
		 */
		public function register_sidebars() {
			$defaults = array(
				'before_widget' => '<div class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title"><span class="widget-tlt">',
				'after_title'   => '</span></h2>',
			);
			register_sidebar(
				array_merge( $defaults, array(
					'id'          => 'blog_sidebar',
					'name'        => esc_html__( 'Blog Sidebar', 'lusion' ),
					'description' => esc_html__( 'Default Sidebar of blog.', 'lusion' ),
				) )
			);
			register_sidebar(
				array_merge( $defaults, array(
					'id'          => 'page_sidebar',
					'name'        => esc_html__( 'Page Sidebar', 'lusion' ),
					'description' => esc_html__( 'Add widgets here.', 'lusion' ),
				) )
			);
			register_sidebar(
				array_merge( $defaults, array(
					'id'          => 'shop_sidebar',
					'name'        => esc_html__( 'Shop Sidebar', 'lusion' ),
					'description' => esc_html__( 'Default Sidebar of shop.', 'lusion' ),
				) )
			);
			register_sidebar(
				array_merge( $defaults, array(
					'id'          => 'shop_sidebar_left',
					'name'        => esc_html__( 'Shop Sidebar Left', 'lusion' ),
					'description' => esc_html__( 'Default Sidebar left of shop.', 'lusion' ),
				) )
			);
			register_sidebar(
				array_merge( $defaults, array(
					'id'          => 'shop_sidebar_right',
					'name'        => esc_html__( 'Shop Sidebar Right', 'lusion' ),
					'description' => esc_html__( 'Default Sidebar Right of shop.', 'lusion' ),
				) )
			);
			register_sidebar(
				array_merge( $defaults, array(
					'id'   => 'footer',
					'name' => esc_html__( 'Footer', 'lusion' ),
				) )
			);
			register_sidebar(
				array_merge( $defaults, array(
					'id'   => 'info_header',
					'name' => esc_html__( 'Header Info', 'lusion' ),
				) )
			);
			register_sidebar(
				array_merge( $defaults, array(
					'id'   => 'popup_newsletter',
					'name' => esc_html__( 'Popup Newsletter', 'lusion' ),
				) )
			);
		}
	}

	new Lusion_Widgets();
}
