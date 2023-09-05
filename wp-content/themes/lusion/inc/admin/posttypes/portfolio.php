<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;
if ( ! class_exists( 'Apr_Core_Portfolio' ) ) {
	class Apr_Core_Portfolio {
		function __construct() {
			add_action( 'init', array( $this, 'register_portfolio' ), 1 );
		}
		function register_portfolio() {

		    $portfolio_slug = "portfolio";
		    $portfolio_cat_slug = "portfolio-cat";

			$labels = array(
				'name'                  => esc_html__( 'Portfolios', 'apr-core' ),
				'singular_name'         => esc_html__( 'Portfolio', 'apr-core' ),
				'all_items'             => esc_html__( 'All Portfolios', 'apr-core' ),
				'menu_name'             => _x( 'Portfolios', 'Admin menu name', 'apr-core' ),
				'add_new'               => esc_html__( 'Add New', 'apr-core' ),
				'add_new_item'          => esc_html__( 'Add new  portfolio', 'apr-core' ),
				'edit'                  => esc_html__( 'Edit', 'apr-core' ),
				'edit_item'             => esc_html__( 'Edit portfolio', 'apr-core' ),
				'new_item'              => esc_html__( 'New portfolio', 'apr-core' ),
				'view'                  => esc_html__( 'View portfolio', 'apr-core' ),
				'view_item'             => esc_html__( 'View portfolio', 'apr-core' ),
				'search_items'          => esc_html__( 'Search portfolios', 'apr-core' ),
				'not_found'             => esc_html__( 'No portfolios found', 'apr-core' ),
				'not_found_in_trash'    => esc_html__( 'No portfolios found in trash', 'apr-core' ),
				'parent'                => esc_html__( 'Parent portfolio', 'apr-core' ),
				'filter_items_list'     => esc_html__( 'Filter portfolios', 'apr-core' ),
				'items_list_navigation' => esc_html__( 'Portfolios navigation', 'apr-core' ),
				'items_list'            => esc_html__( 'Portfolio list', 'apr-core' ),
			);
			$supports = array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
				'comments',
				'author',
				'revisions',
				'custom-fields',
			);
			register_post_type( 'portfolio', array(
				'labels'      => $labels,
				'supports'    => $supports,
				'public'      => true,
				'has_archive' => true,
				'rewrite'     => array(
					'slug'    => $portfolio_slug,
				),
				'can_export'  => true,
				'menu_icon'   => ( version_compare( $GLOBALS['wp_version'], '3.8', '>=' ) ) ? 'dashicons-portfolio' : false,
			) );
			register_taxonomy( 'portfolio_cat', 'portfolio', array(
				'hierarchical'      => true,
				'label'             => __( 'Categories Portfolio', 'apr-core' ),
				'query_var'         => true,
				'rewrite'           => array( 'slug' => $portfolio_cat_slug ),
				'show_admin_column' => true,
			)  );			
		}
	}
	new Apr_Core_Portfolio;
}
