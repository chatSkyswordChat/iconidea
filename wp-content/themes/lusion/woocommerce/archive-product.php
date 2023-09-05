<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header('shop');

/**
 * Hook: woocommerce_before_main_content.add-cart-btn
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');
$cols = Lusion_Global::get_page_sidebar();
$lusion_left_sidebar = Lusion_Global::get_left_sidebar();
$lusion_right_sidebar = Lusion_Global::get_right_sidebar();
$lusion_toolbar = Lusion::setting('shop_archive_toolbar');
$product_banner = Lusion::setting('product_banner');
$lusion_tempalte_cate = lusion_get_meta_value('select_template');
$show_hide_banner = Lusion::setting('show_hide_banner');
$banner_page_shop = lusion_get_meta_value('banner_page_shop');
$filter_top_product = lusion_get_meta_value('filter_top_product');
$shop_archive_filter_top = Lusion::setting('shop_archive_filter_top');
$lusion_class_toolbar = $class_filter = $class_filter_top = '';

if (Lusion::setting('shop_archive_filter') && (($lusion_left_sidebar !== 'none' && $lusion_right_sidebar == 'none')
        || ($lusion_left_sidebar == 'none' && $lusion_right_sidebar !== 'none'))):
    $class_filter = 'product-has-filter';
    if ($shop_archive_filter_top == 1 || $filter_top_product):
        $class_filter_top = 'product-has-filter-top';
    else:
        $class_filter_top = 'product-has-filter-content';
    endif;
endif;
?>
<div class="row no-margin <?php echo esc_attr($class_filter); ?> <?php echo esc_attr($class_filter_top); ?>">
    <?php
    get_sidebar('left');
    ?>
    <div class="<?php echo esc_attr($cols); ?> ">
        <?php
        if ($lusion_tempalte_cate !== '' && $lusion_tempalte_cate != '0' && !$banner_page_shop) {
            echo \Elementor\Plugin::$instance->frontend->get_builder_content($lusion_tempalte_cate, true);
        } else {
            if ($product_banner !== '' && $product_banner != '0' && $show_hide_banner == 1 && !$banner_page_shop) {
                echo \Elementor\Plugin::$instance->frontend->get_builder_content($product_banner, true);
            }
        }

        if (woocommerce_product_loop()) {
            do_action('woocommerce_before_shop_loop');

            global $wp_query;
            $cat = $wp_query->get_queried_object();
            if (is_tax('product_cat')) {
                $display_type_product = get_term_meta($cat->term_id, 'display_type', true);
                if ($display_type_product !== '') {
                    $display_type = $display_type_product;
                } else {
                    $display_type = woocommerce_get_loop_display_mode();
                }
            } else {
                $display_type = woocommerce_get_loop_display_mode();
            }

           if ('products' === $display_type || 'both' === $display_type || 'default' === $display_type) {
                ?>
                <ul class="cate-archive clearfix">
                    <?php lusion_woocommerce_show_subcategories(); ?>
                </ul>
                <?php
            }
            if ('products' === $display_type || 'both' === $display_type || 'default' === $display_type) {
                if (isset($lusion_toolbar) && $lusion_toolbar) {
                    ?>
                    <?php
                    /**
                     * Hook: woocommerce_archive_description.
                     *
                     * @hooked woocommerce_taxonomy_archive_description - 10
                     * @hooked woocommerce_product_archive_description - 10
                     */
                    do_action('woocommerce_archive_description');
                    ?>
                    <div class="toobar-top">
                        <?php if (Lusion::setting('shop_archive_filter') && (($lusion_left_sidebar !== 'none' && $lusion_right_sidebar == 'none') || ($lusion_left_sidebar == 'none' && $lusion_right_sidebar !== 'none'))): ?>
                            <?php do_action('woocommerce_categories_filter'); ?>
                        <?php endif; ?>
                        <?php if (Lusion::setting('shop_archive_catalog_ordering')): ?>
                            <?php do_action('woocommerce_categories_catalog_ordering'); ?>
                        <?php endif; ?>
                        <?php do_action('woocommerce_categories_view'); ?>
                    </div>
                    <?php
                    if ($filter_top_product || $shop_archive_filter_top) :
                        if (Lusion::setting('shop_archive_filter') && (($lusion_left_sidebar !== 'none' && $lusion_right_sidebar == 'none') || ($lusion_left_sidebar == 'none' && $lusion_right_sidebar !== 'none'))): ?>
                            <div class="filter-top active-sidebar not-active">
                                <?php if ($lusion_left_sidebar !== 'none' && $lusion_right_sidebar == 'none'):
                                    $get_left_sidebar = Lusion_Global::get_left_sidebar();
                                    dynamic_sidebar($get_left_sidebar);
                                endif; ?>
                                <?php if ($lusion_left_sidebar == 'none' && $lusion_right_sidebar !== 'none'):
                                    $get_right_sidebar = Lusion_Global::get_right_sidebar();
                                    dynamic_sidebar($get_right_sidebar);
                                endif; ?>
                            </div>
                        <?php endif;endif; ?>
                    <?php
                }
                ?>

                <?php woocommerce_product_loop_start(); ?> 
                <?php if (wc_get_loop_prop('total')) {
                    while (have_posts()) {
                        ?>
                        <?php
                        the_post();
                        /**
                         * Hook: woocommerce_shop_loop.
                         *
                         * @hooked WC_Structured_Data::generate_product_data() - 10
                         */
                        do_action('woocommerce_shop_loop');
                        wc_get_template_part('content', 'product');
                        ?>
                        <?php
                    }
                }
                woocommerce_product_loop_end();
                ?>
                <?php
            }
            /**
             * Hook: woocommerce_after_shop_loop.
             *
             * @hooked woocommerce_pagination - 10
             */
            do_action('woocommerce_after_shop_loop');
        } else {
            /**
             * Hook: woocommerce_no_products_found.
             *
             * @hooked wc_no_products_found - 10
             */
            do_action('woocommerce_no_products_found');
        }
        ?>
    </div>

    <?php get_sidebar('right'); ?>
</div>
<?php do_action('woocommerce_after_main_content'); ?>
<?php get_footer('shop'); ?>

