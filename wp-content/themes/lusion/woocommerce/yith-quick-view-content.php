<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

while (have_posts()) : the_post();
    add_action( 'yith_wcqv_product_summary', 'lusion_wishlist_custom', 26 );
?>
    <div id="product-<?php the_ID(); ?>" <?php post_class('product'); ?>>

            <?php
            do_action('yith_wcqv_product_image');
            ?>
            <script type='text/javascript'>
                /* <![CDATA[ */
                var wcva = {
                    "tooltip": "no",
                    "disable_options": "no",
                    "hide_options": "no",
                    "show_attribute": "no",
                    "quick_view": "off"
                };
                /* ]]> */
                (function ($) {
                    "use strict";
                    var $rtl = false;
                    if (lusion_params.lusion_rtl == 'yes') {
                        $rtl = true;
                    }
                    $(document).ready(function () {
                        $('#yith-quick-view-modal .product-list-thumbnails img').on('click', function (e) {
                            $('#yith-quick-view-modal .woocommerce-product-gallery__image').trigger('zoom.destroy'); // remove zoom
                        });
                        $('#yith-quick-view-modal .woocommerce-product-gallery__wrapper').on('afterChange', function (event, slick, currentSlide, nextSlide) {
                            $('.slick-slide').removeClass('flex-active-slide');
                            $("[data-slick-index='" + currentSlide + "']").addClass('flex-active-slide');
                        });
                        var $productGallery = $('#yith-quick-view-modal .woocommerce-product-gallery__wrapper'),
                            $productGalleryThumb = $('#yith-quick-view-modal .product-list-thumbnails');
                        $productGallery.slick({
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            dots: false,
                            rtl: $rtl,
                            focusOnSelect: true,
                            arrows: false,
                            fade: true,
                            infinite: true,
                            asNavFor: $productGalleryThumb
                        });
                        $productGalleryThumb.slick({
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            nextArrow: '<button class="btn-next"><i class="theme-icon-next"></i></button>',
                            prevArrow: '<button class="btn-prev"><i class="theme-icon-back"></i></button>',
                            dots: false,
                            rtl: $rtl,
                            focusOnSelect: true,
                            vertical: false,
                            infinite: true,
                            asNavFor: $productGallery,
                            responsive: [
                                {
                                    breakpoint: 1200,
                                    settings: {
                                        slidesToShow: 3,
                                    }
                                },
                                {
                                    breakpoint: 1199,
                                    settings: {
                                        slidesToShow: 3,
                                    }
                                },
                                {
                                    breakpoint: 992,
                                    settings: {
                                        slidesToShow: 3,
                                    }
                                },
                                {
                                    breakpoint: 767,
                                    settings: {
                                        slidesToShow: 3,
                                    }
                                },
                                {
                                    breakpoint: 577,
                                    settings: {
                                        slidesToShow: 3,
                                        vertical: false,
                                    }
                                }
                            ]
                        });

                        // Ajax add to cart on the product page
                        var $warp_fragment_refresh = {
                            url: wc_cart_fragments_params.wc_ajax_url.toString().replace('%%endpoint%%', 'get_refreshed_fragments'),
                            type: 'POST',
                            success: function (data) {
                                if (data && data.fragments) {
                                    $.each(data.fragments, function (key, value) {
                                        $(key).replaceWith(value);
                                    });
                                    $(document.body).trigger('wc_fragments_refreshed');
                                }
                            }
                        };

                        $('.entry-summary form.cart').on('submit', function (e) {
                            e.preventDefault();
                            var $this = $(this);
                            $this.block({
                                message: null,
                                overlayCSS: {
                                    cursor: 'none'
                                }
                            });
                            if ($('div').hasClass('elementor-single-product')) {
                                var product_url = $('.link-more-detail').attr('href'), form = $(this);
                            } else {
                                var product_url = window.location,
                                    form = $(this);
                            }
                            $.post(product_url, form.serialize() + '&_wp_http_referer=' + product_url, function (result) {
                                var cart_dropdown = $('.widget_shopping_cart', result)

                                var msg = $('#cart_added_msg_popup');
                                $('#cart_added_msg').html(lusion_params.ajax_cart_added_msg);
                                msg.css('margin-left', '-' + $(msg).width() / 2 + 'px').fadeIn();

                                // update dropdown cart
                                $('.widget_shopping_cart').replaceWith(cart_dropdown);

                                // update fragments
                                $.ajax($warp_fragment_refresh);
                                $this.unblock();
                                window.setTimeout(function () {
                                    msg.fadeOut();
                                }, 2000);
                                $('#yith-quick-view-modal').removeClass('open');
                            });
                        });
                    });
                })(jQuery);
            </script>
            <?php if (class_exists('WooCommerce') && class_exists('wcva_shop_page_swatches')) : ?>
                <script type='text/javascript'
                        src='<?php echo esc_url(WP_PLUGIN_URL . '/woocommerce-colororimage-variation-select/js/product-frontend.js') ?>?ver=<?php echo LUSION_THEME_VERSION ?>'></script>
                <script type='text/javascript'
                        src='<?php echo esc_url(WP_PLUGIN_URL . '/woocommerce-colororimage-variation-select/js/add-to-cart-variation3.js') ?>?ver=<?php echo LUSION_THEME_VERSION ?>'></script>
            <?php endif; ?>
            <div class="summary entry-summary">
                <div class="summary-content">
                    <?php do_action('yith_wcqv_product_summary'); ?>
                </div>
            </div>

        </div>
<?php endwhile; // end of the loop.