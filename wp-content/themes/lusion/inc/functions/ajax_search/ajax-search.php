<?php
/* Ajax search box */
add_action('wp_ajax_Product_filters', 'Product_filters');
add_action('wp_ajax_nopriv_Product_filters', 'Product_filters');
function Product_filters() {
    if(isset($_POST['data'])){
        $data = $_POST['data'];
        echo '<div class="woocommerce"><ul class="products  product-grid columns-4">';
        $the_query = new WP_Query(
            array(
                'posts_per_page' => 6,
                's' => $data,
                'post_type' => 'product',
            )
        );
		$view = esc_html__('View all', 'lusion');
        if ($the_query->have_posts()) :
            while ($the_query->have_posts()) : $the_query->the_post();
                ?><li class="product">
                <div class="product-content clearfix">
                    <div class="product-top">
                        <div class="image-product">
                            <a href="<?php echo get_the_permalink()?>" class ="suggestion-title" title="<?php echo get_the_title()?>">
                                <img src="<?php echo esc_url(lusion_resizeImage('210', '284'));?>">
                            </a>
                        </div>
                    </div>
                    <div class="product-desc">
                        <div class="product-content-info">
                            <h2 class="woocommerce-loop-product__title"><a href="<?php echo get_the_permalink()?>" class ="suggestion-title">
                                    <?php echo get_the_title()?>
                                </a>
                            </h2>
                            <div class="product-price">
                                <?php
                                global $product;
                                $price_html = $product->get_price_html();
                                echo wp_kses($price_html , lusion_allow_html());
                                ?>
                            </div>
                            <div class="product-action">
                                <?php
                                do_action( 'woocommerce_product_add_to_cart' );
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                </li>
            <?php
            endwhile; wp_reset_postdata();
        else:
            echo "<li> <p class='no-found-msg'>Search no result</p></li>";
        endif;
        echo '</ul></div>';
        if ($the_query->have_posts()) :
            echo '<div class="view-all"><a href="#" class="view-all-seach">'.$view.'</a></div>';
        endif;
        die();
    }
}
