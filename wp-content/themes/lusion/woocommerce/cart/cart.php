<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/ 
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined('ABSPATH') || exit;
$shopping_cart_layout = Lusion::setting('shopping_cart_layout');
do_action('woocommerce_before_cart'); ?>

<div class="row <?php echo esc_attr($shopping_cart_layout); ?>">
    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
        <h1 class="title-heading-cart"><?php esc_html_e('Shopping Cart', 'lusion'); ?></h1>
        <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
            <?php if ($shopping_cart_layout == 'layout1'): ?>
                <?php do_action('woocommerce_before_cart_table'); ?>
                <div class="cart-left">
                    <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents">
                        <thead>
                        <tr>
                            <th class="product-thumbnail"><?php esc_html_e('Product details', 'lusion'); ?></th>
                            <th class="product-price"><?php esc_html_e('Unit price', 'lusion'); ?></th>
                            <th class="product-quantity"><?php esc_html_e('Quantity', 'lusion'); ?></th>
                            <th class="product-subtotal"><?php esc_html_e('Amount', 'lusion'); ?></th>
                            <th class="product-remove"></th>
                        </thead>
                        <tbody>
                        <?php do_action('woocommerce_before_cart_contents'); ?>

                        <?php
                        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {

                            $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                            $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                            if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                                $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                                ?>
                                <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">

                                    <td class="product-thumbnail"
                                        data-title="<?php esc_attr_e('Products', 'lusion'); ?>">
                                        <div class="img-product">
                                            <?php
                                            $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

                                            if (!$product_permalink) {
                                                echo apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                                            } else {
                                                printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
                                            }
                                            ?>
                                        </div>
                                        <div class="product-cart-content">
                                            <?php
                                            if (!$product_permalink) {
                                                echo wp_kses(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;', lusion_allow_html());
                                            } else {
                                                echo wp_kses(apply_filters('woocommerce_cart_item_name', sprintf('<a class="product-name" href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key), lusion_allow_html());
                                            }

                                            do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

                                            // Meta data.
                                            echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok

                                            // Backorder notification.
                                            if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                                                echo esc_attr(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'lusion') . '</p>', $product_id));
                                            }
                                            $rating_count = $_product->get_rating_count();
                                            $rating_count = $_product->get_review_count();
                                            if ($rating_count > 0) : ?>
                                                <div class="rating-product">
                                                    <?php echo wc_get_rating_html($_product->get_average_rating()); ?>
                                                    <?php if (comments_open()): ?><a
                                                        href="<?php echo get_permalink() ?>#reviews"
                                                        class="woocommerce-review-link" rel="nofollow">
                                                        <?php printf(_n('%s', '%s', $review_count, 'lusion'), '<span class="count-rating">' . esc_html($review_count) . '</span>'); ?>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif;
                                            ?>
                                        </div>
                                    </td>

                                    <td class="product-price" data-title="<?php esc_attr_e('Price', 'lusion'); ?>">
                                        <?php if ($price_html = $_product->get_price_html()) : ?>
                                            <p class="price">
                                                <?php echo wp_kses($price_html, array(
                                                    'div' => array(
                                                        'class' => array(),
                                                    ),
                                                    'span' => array(
                                                        'class' => array(),
                                                    ),
                                                    'ins' => array(),
                                                    'del' => array(),
                                                )); ?>
                                            </p>
                                        <?php endif; ?>
                                    </td>

                                    <td class="product-quantity"
                                        data-title="<?php esc_attr_e('Quantity', 'lusion'); ?>">
                                        <?php
                                        if ($_product->is_sold_individually()) {
                                            $product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
                                        } else {
                                            $product_quantity = woocommerce_quantity_input(array(
                                                'input_name' => "cart[{$cart_item_key}][qty]",
                                                'input_value' => $cart_item['quantity'],
                                                'max_value' => $_product->get_max_purchase_quantity(),
                                                'min_value' => '0',
                                                'product_name' => $_product->get_name(),
                                            ), $_product, false);
                                        }

                                        echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
                                        ?>
                                    </td>

                                    <td class="product-subtotal" data-title="<?php esc_attr_e('Total', 'lusion'); ?>">
                                        <?php
                                        echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                                        ?>
                                    </td>
                                    <td class="product-remove">
                                        <?php
                                        // @codingStandardsIgnoreLine
                                        echo apply_filters('woocommerce_cart_item_remove_link', sprintf(
                                            '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="theme-icon-close"></i></a>',
                                            esc_url(wc_get_cart_remove_url($cart_item_key)),
                                            __('Remove this item', 'lusion'),
                                            esc_attr($product_id),
                                            esc_attr($_product->get_sku())
                                        ), $cart_item_key);
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        </tbody>

                    </table>
                    <?php do_action('woocommerce_cart_contents'); ?>

                    <div class="actions">
                        <button type="submit" class="button" name="update_cart"
                                value="<?php esc_attr_e('Update shopping cart', 'lusion'); ?>"><?php esc_html_e('Update shopping cart', 'lusion'); ?></button>
                        <?php do_action('woocommerce_cart_actions'); ?>
                        <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
                    </div>

                    <?php do_action('woocommerce_after_cart_contents'); ?>
                </div>
                <?php do_action('woocommerce_after_cart_table'); ?>
                <div class="cart-right show-desktop">
                    <div class="cart-right-inner">
                        <?php if (wc_coupons_enabled()) { ?>
                            <div class="coupon">
                                <div class="coupon-form">
                                    <input type="text" name="coupon_code" class="input-text" id="coupon_code"
                                           placeholder="<?php echo esc_attr_e('Coupon code', 'lusion'); ?>"/>
                                    <button type="submit" class="button  btn btn-primary" name="apply_coupon"
                                            value="<?php esc_attr_e('Apply', 'lusion'); ?>"><?php esc_html_e('Apply', 'lusion'); ?></button>
                                    <?php do_action('woocommerce_cart_coupon'); ?>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="cart-collaterals">
                            <?php
                            /**
                             * Cart collaterals hook.
                             *
                             * @hooked woocommerce_cross_sell_display
                             * @hooked woocommerce_cart_totals - 10
                             */
                            do_action('woocommerce_cart_collaterals');
                            ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($shopping_cart_layout == 'layout2'): ?>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                        <?php do_action('woocommerce_before_cart_table'); ?>
                        <div class="cart-left">
                            <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents">
                                <thead>
                                <tr>
                                    <th class="product-thumbnail"><?php esc_html_e('Product details', 'lusion'); ?></th>
                                    <th class="product-price"><?php esc_html_e('Unit price', 'lusion'); ?></th>
                                    <th class="product-quantity"><?php esc_html_e('Quantity', 'lusion'); ?></th>
                                    <th class="product-subtotal"><?php esc_html_e('Amount', 'lusion'); ?></th>
                                    <th class="product-remove"></th>
                                </thead>
                                <tbody>
                                <?php do_action('woocommerce_before_cart_contents'); ?>

                                <?php
                                foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {

                                    $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                                    $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                                    if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                                        $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                                        ?>
                                        <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">

                                            <td class="product-thumbnail"
                                                data-title="<?php esc_attr_e('Products', 'lusion'); ?>">
                                                <div class="img-product">
                                                    <?php
                                                    $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

                                                    if (!$product_permalink) {
                                                        echo apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                                                    } else {
                                                        printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
                                                    }
                                                    ?>
                                                </div>
                                                <div class="product-cart-content">
                                                    <?php
                                                    if (!$product_permalink) {
                                                        echo wp_kses(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;', lusion_allow_html());
                                                    } else {
                                                        echo wp_kses(apply_filters('woocommerce_cart_item_name', sprintf('<a class="product-name" href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key), lusion_allow_html());
                                                    }

                                                    do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

                                                    // Meta data.
                                                    echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok

                                                    // Backorder notification.
                                                    if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                                                        echo esc_attr(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'lusion') . '</p>', $product_id));
                                                    }
                                                    $rating_count = $_product->get_rating_count();
                                                    $rating_count = $_product->get_review_count();
                                                    if ($rating_count > 0) : ?>
                                                        <div class="rating-product">
                                                            <?php echo wc_get_rating_html($_product->get_average_rating()); ?>
                                                            <?php if (comments_open()): ?><a
                                                                href="<?php echo get_permalink() ?>#reviews"
                                                                class="woocommerce-review-link" rel="nofollow">
                                                                <?php printf(_n('%s', '%s', $review_count, 'lusion'), '<span class="count-rating">' . esc_html($review_count) . '</span>'); ?>
                                                                </a>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endif;
                                                    ?>
                                                </div>
                                            </td>

                                            <td class="product-price"
                                                data-title="<?php esc_attr_e('Price', 'lusion'); ?>">
                                                <?php if ($price_html = $_product->get_price_html()) : ?>
                                                    <p class="price">
                                                        <?php echo wp_kses($price_html, array(
                                                            'div' => array(
                                                                'class' => array(),
                                                            ),
                                                            'span' => array(
                                                                'class' => array(),
                                                            ),
                                                            'ins' => array(),
                                                            'del' => array(),
                                                        )); ?>
                                                    </p>
                                                <?php endif; ?>
                                            </td>

                                            <td class="product-quantity"
                                                data-title="<?php esc_attr_e('Quantity', 'lusion'); ?>">
                                                <?php
                                                if ($_product->is_sold_individually()) {
                                                    $product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
                                                } else {
                                                    $product_quantity = woocommerce_quantity_input(array(
                                                        'input_name' => "cart[{$cart_item_key}][qty]",
                                                        'input_value' => $cart_item['quantity'],
                                                        'max_value' => $_product->get_max_purchase_quantity(),
                                                        'min_value' => '0',
                                                        'product_name' => $_product->get_name(),
                                                    ), $_product, false);
                                                }

                                                echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
                                                ?>
                                            </td>

                                            <td class="product-subtotal"
                                                data-title="<?php esc_attr_e('Total', 'lusion'); ?>">
                                                <?php
                                                echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                                                ?>
                                            </td>
                                            <td class="product-remove">
                                                <?php
                                                // @codingStandardsIgnoreLine
                                                echo apply_filters('woocommerce_cart_item_remove_link', sprintf(
                                                    '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="theme-icon-close"></i></a>',
                                                    esc_url(wc_get_cart_remove_url($cart_item_key)),
                                                    __('Remove this item', 'lusion'),
                                                    esc_attr($product_id),
                                                    esc_attr($_product->get_sku())
                                                ), $cart_item_key);
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                                </tbody>

                            </table>
                            <?php do_action('woocommerce_cart_contents'); ?>

                            <div class="actions">
                                <button type="submit" class="button" name="update_cart"
                                        value="<?php esc_attr_e('Update shopping cart', 'lusion'); ?>"><?php esc_html_e('Update shopping cart', 'lusion'); ?></button>
                                <?php do_action('woocommerce_cart_actions'); ?>
                                <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
                            </div>

                            <?php do_action('woocommerce_after_cart_contents'); ?>
                        </div>
                        <?php do_action('woocommerce_after_cart_table'); ?>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                        <div class="row">
                            <div class="col-xl-9 col-lg-12 col-md-12 col-12">
                                <?php if (wc_coupons_enabled()) { ?>
                                    <div class="coupon">
                                        <span><i class="theme-icon-gift"></i><?php echo esc_html__('Have a coupon?','lusion'); ?></span>
                                        <div class="coupon-form">
                                            <input type="text" name="coupon_code" class="input-text" id="coupon_code"
                                                   placeholder="<?php echo esc_attr_e('Coupon code', 'lusion'); ?>"/>
                                            <button type="submit" class="button  btn btn-primary" name="apply_coupon"
                                                    value="<?php esc_attr_e('Apply', 'lusion'); ?>"><?php esc_html_e('Apply', 'lusion'); ?></button>
                                            <?php do_action('woocommerce_cart_coupon'); ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                        <div class="row">
                            <div class="col-xl-9 col-lg-12 col-md-12 col-12">
                                <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>
                                    <div class="box-shipping box-shipping-cs box-shipping-large ">
                                        <div class="title-hdwoo">
                                            <h6 class="title-cart"><?php esc_html_e('Estimate shipping and tax', 'lusion'); ?></h6>
                                            <span class="ti-angle-down"></span>
                                        </div>

                                        <div class="form-shipping-cs">

                                            <?php do_action('woocommerce_cart_totals_before_shipping'); ?>

                                            <?php wc_cart_totals_shipping_html(); ?>

                                            <?php do_action('woocommerce_cart_totals_after_shipping'); ?>

                                        </div>
                                    </div>
                                <?php elseif (WC()->cart->needs_shipping() && 'yes' === get_option('woocommerce_enable_shipping_calc')) : ?>

                                    <?php woocommerce_shipping_calculator(); ?>

                                <?php endif; ?>
                            </div>
                            <div class="col-xl-3 col-lg-12 col-md-12 col-12">
                                <div class="cart-right">
                                    <div class="cart-collaterals">
                                        <?php
                                        /**
                                         * Cart collaterals hook.
                                         *
                                         * @hooked woocommerce_cross_sell_display
                                         * @hooked woocommerce_cart_totals - 10
                                         */
                                        do_action('woocommerce_cart_collaterals');
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        /**
                         * Cart collaterals hook.
                         *
                         * @hooked woocommerce_cross_sell_display
                         */
                        do_action('woocommerce_cart_collaterals_before');
                        ?>
                    </div>
                </div>
            <?php endif; ?>
        </form>
    </div>
    <?php if ($shopping_cart_layout == 'layout1'): ?>
        <div class="col-xl-9 col-lg-12 col-md-12 col-12">
            <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>
                <div class="box-shipping box-shipping-cs box-shipping-large ">
                    <div class="title-hdwoo">
                        <h6 class="title-cart"><?php esc_html_e('Estimate shipping and tax', 'lusion'); ?></h6>
                        <span class="ti-angle-down"></span>
                    </div>

                    <div class="form-shipping-cs">

                        <?php do_action('woocommerce_cart_totals_before_shipping'); ?>

                        <?php wc_cart_totals_shipping_html(); ?>

                        <?php do_action('woocommerce_cart_totals_after_shipping'); ?>

                    </div>
                </div>
            <?php elseif (WC()->cart->needs_shipping() && 'yes' === get_option('woocommerce_enable_shipping_calc')) : ?>
                <?php woocommerce_shipping_calculator(); ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
<?php do_action('woocommerce_after_cart'); ?>
