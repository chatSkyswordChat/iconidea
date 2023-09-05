<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;
if ( ! class_exists( 'Apr_Core_Header' ) ) {
    class Apr_Core_Header {
        function __construct() {
            add_action( 'init', array( $this, 'register_header_builder' ), 1 );
        }
        function register_header_builder() {
            $slug = apply_filters( 'apr_core_static_slug', 'header_builder' );
            $labels = array(
                'name'               => __('Header', "apr-core"),
                'singular_name'      => __('Header', "apr-core"),
                'add_new'            => __('Add New Header', "apr-core"),
                'add_new_item'       => __('Add New Header', "apr-core"),
                'edit_item'          => __('Edit Header', "apr-core"),
                'new_item'           => __('New Header', "apr-core"),
                'view_item'          => __('View Header', "apr-core"),
                'search_items'       => __('Search Headers', "apr-core"),
                'not_found'          => __('No Headers found', "apr-core"),
                'not_found_in_trash' => __('No Headers found in Trash', "apr-core"),
                'parent_item_colon'  => __('Parent Header:', "apr-core"),
                'menu_name'          => __('Header Builder', "apr-core"),
            );
            $args = array(
                'labels'              => $labels,
                'hierarchical'        => true,
                'description'         => __('List Header', "apr-core"),
                'supports'            => array('title', 'editor', 'thumbnail'), //page-attributes, post-formats
                'public'              => true,
                'show_ui'             => true,
                'show_in_menu'        => true,
                'menu_position'       => 5,
                'menu_icon'           => 'dashicons-welcome-add-page',
                'show_in_nav_menus'   => false,
                'publicly_queryable'  => true,
                'exclude_from_search' => true,
                'has_archive'         => true,
                'query_var'           => true,
                'can_export'          => true,
                'rewrite'             => true,
                'capability_type'     => 'page'
            );
            register_post_type('header', $args);
        }
    }
    new Apr_Core_Header;
}
