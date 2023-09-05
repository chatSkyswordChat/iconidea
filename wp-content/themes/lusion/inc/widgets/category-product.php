<?php
if ( ! class_exists( 'Apr_Core_Category_Product_Widget' ) ) {
    class Apr_Core_Category_Product_Widget extends Apr_Widget {
        /**
         * Category ancestors.
         *
         * @var array
         */
        public $cat_ancestors;

        /**
         * Current Category.
         *
         * @var bool
         */
        public $current_cat;

        /**
         * Constructor.
         */
        public function __construct() {
            $this->widget_cssclass    = 'woocommerce widget_product_categories';
            $this->widget_description = esc_html__( 'A list or dropdown of product categories.', 'apr-core' );
            $this->widget_id          = 'woocommerce_product_categories';
            $this->widget_name        = esc_html__( '[APR] WooCommerce Product Categories', 'apr-core' );
            $this->settings           = array(
                'title'  => array(
                    'type'  => 'text',
                    'std'   => esc_html__( 'Product categories', 'apr-core' ),
                    'label' => esc_html__( 'Title', 'apr-core' ),
                ),
                'orderby' => array(
                    'type'  => 'select',
                    'std'   => 'name',
                    'label' => esc_html__( 'Order by', 'apr-core' ),
                    'options' => array(
                        'order' => esc_html__( 'Category order', 'apr-core' ),
                        'name'  => esc_html__( 'Name', 'apr-core' ),
                    ),
                ),
                'dropdown' => array(
                    'type'  => 'checkbox',
                    'std'   => 0,
                    'label' => esc_html__( 'Show as dropdown', 'apr-core' ),
                ),
                'count' => array(
                    'type'  => 'checkbox',
                    'std'   => 0,
                    'label' => esc_html__( 'Show product counts', 'apr-core' ),
                ),
                'hierarchical' => array(
                    'type'  => 'checkbox',
                    'std'   => 1,
                    'label' => esc_html__( 'Show hierarchy', 'apr-core' ),
                ),
                'show_children_only' => array(
                    'type'  => 'checkbox',
                    'std'   => 0,
                    'label' => esc_html__( 'Only show children of the current category', 'apr-core' ),
                ),
                'hide_empty' => array(
                    'type'  => 'checkbox',
                    'std'   => 0,
                    'label' => esc_html__( 'Hide empty categories', 'apr-core' ),
                ),
            );

            parent::__construct();
        }

        public function widget( $args, $instance ) {
            global $wp_query, $post;

            $count              = isset( $instance['count'] ) ? $instance['count'] : $this->settings['count']['std'];
            $hierarchical       = isset( $instance['hierarchical'] ) ? $instance['hierarchical'] : $this->settings['hierarchical']['std'];
            $show_children_only = isset( $instance['show_children_only'] ) ? $instance['show_children_only'] : $this->settings['show_children_only']['std'];
            $dropdown           = isset( $instance['dropdown'] ) ? $instance['dropdown'] : $this->settings['dropdown']['std'];
            $orderby            = isset( $instance['orderby'] ) ? $instance['orderby'] : $this->settings['orderby']['std'];
            $hide_empty         = isset( $instance['hide_empty'] ) ? $instance['hide_empty'] : $this->settings['hide_empty']['std'];
            $dropdown_args      = array( 'hide_empty' => $hide_empty );
            $list_args          = array( 'show_count' => $count, 'hierarchical' => $hierarchical, 'taxonomy' => 'product_cat', 'hide_empty' => $hide_empty );

            // Menu Order
            $list_args['menu_order'] = false;
            if ( 'order' === $orderby ) {
                $list_args['menu_order'] = 'asc';
            } else {
                $list_args['orderby']    = 'title';
            }

            // Setup Current Category
            $this->current_cat   = false;
            $this->cat_ancestors = array();

            if ( is_tax( 'product_cat' ) ) {

                $this->current_cat   = $wp_query->queried_object;
                $this->cat_ancestors = get_ancestors( $this->current_cat->term_id, 'product_cat' );

            } elseif ( is_singular( 'product' ) ) {

                $product_category = wc_get_product_terms( $post->ID, 'product_cat', apply_filters( 'woocommerce_product_categories_widget_product_terms_args', array( 'orderby' => 'parent' ) ) );

                if ( ! empty( $product_category ) ) {
                    $this->current_cat   = end( $product_category );
                    $this->cat_ancestors = get_ancestors( $this->current_cat->term_id, 'product_cat' );
                }
            }

            global $product;


            // Show Siblings and Children Only
            if ( isset($show_children_only) && $show_children_only && $this->current_cat ) {
                if($product){
                    $top_level = array();
                    $terms = get_the_terms( $product->get_id(), 'product_cat');
                    // Top level is needed
                    foreach ( $terms as $term ) {
                        $top_levels[] = get_terms(
                            'product_cat',
                            array(
                                'fields'       => 'ids',
                                'parent'       => $term->term_id,
                                'hierarchical' => true,
                                'hide_empty'   => false,
                            )
                        );
                    }

                    foreach($top_levels as $k => $v){
                        foreach($v as $ke => $vl){
                            $top_level[]= $vl;
                        }
                    }
                    // Direct children are wanted
                    $direct_children = array();
                    foreach ( $terms as $term ) {
                        $parent_id[] = $term->term_id;
                    }
                    $direct_children[] = implode( ',', $parent_id );
                }else{
                    // Top level is needed
                    $top_level = get_terms(
                        'product_cat',
                        array(
                            'fields'       => 'ids',
                            'parent'       => 0,
                            'hierarchical' => true,
                            'hide_empty'   => false,
                        )
                    );

                    // Direct children are wanted
                    $direct_children = get_terms(
                        'product_cat',
                        array(
                            'fields'       => 'ids',
                            'parent'       => $this->current_cat->term_id,
                            'hierarchical' => true,
                            'hide_empty'   => false,
                        )
                    );
                }
                // Gather siblings of ancestors
                $siblings  = array();
                if ( $this->cat_ancestors ) {
                    foreach ( $this->cat_ancestors as $ancestor ) {
                        $ancestor_siblings = get_terms(
                            'product_cat',
                            array(
                                'fields'       => 'ids',
                                'parent'       => $ancestor,
                                'hierarchical' => false,
                                'hide_empty'   => false,
                            )
                        );
                        $siblings = array_merge( $siblings, $ancestor_siblings );
                    }
                }
                if ( isset($hierarchical) && $hierarchical ) {
                    $include = array_merge( $top_level, $this->cat_ancestors, $siblings, $direct_children, array( $this->current_cat->term_id ) );
                } else {
                    $include = array_merge( $direct_children );
                }

                $dropdown_args['include'] = implode( ',', $include );
                $list_args['include']     = implode( ',', $include );

                if ( empty( $include ) ) {
                    return;
                }
            } elseif ( isset($show_children_only) && $show_children_only ) {
                $dropdown_args['depth']        = 1;
                $dropdown_args['child_of']     = 0;
                $dropdown_args['hierarchical'] = 1;
                $list_args['depth']            = 1;
                $list_args['child_of']         = 0;
                $list_args['hierarchical']     = 1;
            }

            $this->widget_start( $args, $instance );

            // Dropdown
            if ( $dropdown ) {
                $dropdown_defaults = array(
                    'show_count'         => $count,
                    'hierarchical'       => $hierarchical,
                    'show_uncategorized' => 0,
                    'orderby'            => $orderby,
                    'selected'           => $this->current_cat ? $this->current_cat->slug : '',
                );
                $dropdown_args = wp_parse_args( $dropdown_args, $dropdown_defaults );

                // Stuck with this until a fix for https://core.trac.wordpress.org/ticket/13258
                wc_product_dropdown_categories( apply_filters( 'woocommerce_product_categories_widget_dropdown_args', $dropdown_args ) );

                wc_enqueue_js( "
				jQuery( '.dropdown_product_cat' ).change( function() {
					if ( jQuery(this).val() != '' ) {
						var this_page = '';
						var home_url  = '" . esc_js( home_url( '/' ) ) . "';
						if ( home_url.indexOf( '?' ) > 0 ) {
							this_page = home_url + '&product_cat=' + jQuery(this).val();
						} else {
							this_page = home_url + '?product_cat=' + jQuery(this).val();
						}
						location.href = this_page;
					}
				});
			" );

                // List
            } else {

                include_once( WC()->plugin_path() . '/includes/walkers/class-product-cat-list-walker.php' );

                $list_args['walker']                     = new WC_Product_Cat_List_Walker;
                $list_args['title_li']                   = '';
                $list_args['pad_counts']                 = 1;
                $list_args['show_option_none']           = esc_html__( 'No product categories exist.', 'apr-core' );
                $list_args['current_category']           = ( $this->current_cat ) ? $this->current_cat->term_id : '';
                $list_args['current_category_ancestors'] = $this->cat_ancestors;

                echo '<ul class="product-categories">';

                wp_list_categories( apply_filters( 'woocommerce_product_categories_widget_args', $list_args ) );

                echo '</ul>';
            }

            $this->widget_end( $args );
        }
    }
}