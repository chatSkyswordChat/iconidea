<?php

/**
 * The template for displaying product widget entries.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.5
 */

if (!defined('ABSPATH')) {
    exit;
}

global $product;
$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
if (!is_a($product, 'WC_Product')) {
    return;
}
?>
<li>
    <?php do_action('woocommerce_widget_product_item_start', $args); ?>
    <div class="product-content clearfix">
        <div class="product-top">
            <div class="product-image">
                <a href="<?php echo esc_url($product->get_permalink()); ?>">
                    <?php
                    echo wp_get_attachment_image(get_post_thumbnail_id(), array(100, 120), false, array(
                        'alt'  => esc_attr($product->get_name())
                    )); ?>
                </a>
            </div>
        </div>
        <div class="product-desc">
            <h6 class="product-title">
                <a href="<?php echo esc_url($product->get_permalink()); ?>">
                    <?php
                    $name = $product->get_name();
                    echo esc_attr($name);
                    ?>
                </a>
            </h6>
            <div class="product-price">
                <span class="price">
                    <?php echo wp_kses($product->get_price_html(), lusion_allow_html()); ?>
                </span>
            </div>
            <?php
            if ($rating_count > 0) : ?>
                <div class="rating-product">
                    <?php echo wc_get_rating_html($product->get_average_rating()); ?>
                    <?php if (comments_open()) : ?><a href="<?php echo get_permalink() ?>#reviews" class="woocommerce-review-link" rel="nofollow">
                            <?php printf(_n('%s', '%s', $review_count, 'lusion'), '<span class="count-rating">' . esc_html($review_count) . '</span>'); ?>
                            <?php if ($review_count < 2) : ?>
                                <?php echo esc_html__('Review', 'lusion'); ?>
                            <?php else : ?>
                                <?php echo esc_html__('Reviews', 'lusion'); ?>

                            <?php endif; ?>

                        </a>
                    <?php endif; ?>
                </div>

            <?php endif; ?>
            <?php
            do_action('woocommerce_product_add_to_cart');
            ?>
        </div>

    </div>
    <?php do_action('woocommerce_widget_product_item_end', $args); ?>
</li>