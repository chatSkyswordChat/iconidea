<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;
if ( ! class_exists( 'Apr_Core_Footer' ) ) {
    class Apr_Core_Footer {
        function __construct() {
            add_action( 'init', array( $this, 'register_footer_builder' ), 1 );
        }
        function register_footer_builder() {
            $slug = apply_filters( 'apr_core_static_slug', 'footer_builder' );
            $labels = array(
                'name'               => __('Footer', "apr-core"),
                'singular_name'      => __('Footer', "apr-core"),
                'add_new'            => __('Add New Footer', "apr-core"),
                'add_new_item'       => __('Add New Footer', "apr-core"),
                'edit_item'          => __('Edit Footer', "apr-core"),
                'new_item'           => __('New Footer', "apr-core"),
                'view_item'          => __('View Footer', "apr-core"),
                'search_items'       => __('Search Footers', "apr-core"),
                'not_found'          => __('No Footers found', "apr-core"),
                'not_found_in_trash' => __('No Footers found in Trash', "apr-core"),
                'parent_item_colon'  => __('Parent Footer:', "apr-core"),
                'menu_name'          => __('Footer Builder', "apr-core"),
            );
            $args = array(
                'labels'              => $labels,
                'hierarchical'        => true,
                'description'         => __('List Footer', "apr-core"),
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
            register_post_type('footer', $args);
        }
    }
    new Apr_Core_Footer;
}
