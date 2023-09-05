<?php


add_action( 'wcmmq_form_panel_before_message','wcmmq_cart_page_conditions' );

function wcmmq_cart_page_conditions( $saved_data ){
    
    $min_price = isset( $saved_data['cart_price_min'] ) && $saved_data['cart_price_min'] != '' ? $saved_data['cart_price_min'] : '';
    $max_price = isset( $saved_data['cart_price_max'] ) && $saved_data['cart_price_max'] != '' ? $saved_data['cart_price_max'] : '';
    $min_quantity = isset( $saved_data['cart_quantity_min'] ) && $saved_data['cart_quantity_min'] != '' ? $saved_data['cart_quantity_min'] : '';
    $max_quantity = isset( $saved_data['cart_quantity_max'] ) && $saved_data['cart_quantity_max'] != '' ? $saved_data['cart_quantity_max'] : '';

    $excluded_products = isset( $saved_data['cart_product_exclude'] ) && $saved_data['cart_product_exclude'] != '' ? $saved_data['cart_product_exclude'] : '';
    $included_products = isset( $saved_data['cart_product_include'] ) && $saved_data['cart_product_include'] != '' ? $saved_data['cart_product_include'] : '';
    
    
    
    ?>
    <div class="ultraaddons-panel">
        <h2 class="with-background"><?php echo esc_html__( 'Cart Page Conditions', 'wcmmq_pro'); ?></h2>
        <table class="wcmmq_config_form cart_page_limit_wrapper">
            <tr>
                <th><?php echo esc_html__( 'Price Limit', 'wcmmq_pro'); ?><?php wcmmq_doc_link('https://codeastrology.com/min-max-quantity/set-conditions-on-cart-page/'); ?></th>
                <td>
                    <label for="cart_price_min"><?php echo esc_html__( 'Min', 'wcmmq_pro'); ?></label>
                    <input type="number" name="data[cart_price_min]" id="cart_price_min" value="<?php echo esc_attr( $min_price ); ?>" placeholder=<?php echo esc_html__( "Minimum Price", 'wcmmq_pro'); ?> > <?php echo esc_html__( '(Optional)', 'wcmmq_pro'); ?>
                </td>
                <td>
                    <label for="cart_price_max"><?php echo esc_html__( 'Max', 'wcmmq_pro'); ?></label>
                    <input type="number" name="data[cart_price_max]" id="cart_price_max" value="<?php echo esc_attr( $max_price ); ?>" placeholder=<?php echo esc_html__( "Maximum Price", 'wcmmq_pro'); ?> > <?php echo esc_html( '(Optional)', 'wcmmq_pro'); ?>
                </td>
            </tr>
            <tr>
                <th><?php echo esc_html__( 'Quantity Limit', 'wcmmq_pro'); ?><?php wcmmq_doc_link('https://codeastrology.com/min-max-quantity/set-conditions-on-cart-page/'); ?></th>
                <td>
                    <label for="cart_quantity_min"><?php echo esc_html__( 'Min', 'wcmmq_pro'); ?></label>
                    <input type="number" name="data[cart_quantity_min]" id="cart_quantity_min" value="<?php echo esc_attr( $min_quantity ); ?>" placeholder=<?php echo esc_html__( "Minimum Quantity", 'wcmmq_pro'); ?> > <?php echo esc_html__( '(Optional)', 'wcmmq_pro'); ?>
                </td>
                <td>
                    <label for="cart_quantity_max"><?php echo esc_html__( 'Max', 'wcmmq_pro'); ?></label>
                    <input type="number" name="data[cart_quantity_max]" id="cart_quantity_max" value="<?php echo esc_attr( $max_quantity ); ?>" placeholder=<?php echo esc_html__( "Maximum Quantity", 'wcmmq_pro'); ?> > <?php echo esc_html__( '(Optional)', 'wcmmq_pro'); ?>                    
                </td>
            </tr>            
            <tr>
                <th><?php echo esc_html__( 'Product Exclude', 'wcmmq_pro'); ?><?php wcmmq_doc_link('https://codeastrology.com/min-max-quantity/exclude-include-products-on-cart-page/'); ?></th>
                <td>                   
                    <input type="text" name="data[cart_product_exclude]" id="cart_product_exclude" value="<?php echo esc_attr( $excluded_products ); ?>" placeholder=<?php echo esc_html__( "Input product Ids", 'wcmmq_pro'); ?> >
                    <p class="product-exclude-include"><?php echo esc_html__( 'Insert Products IDs. Use a comma as a separator. (Example: 45,84,5).  Cart conditions will not apply to those products', 'wcmmq_pro' ); ?></p>
                </td>
            </tr>            
            <tr>
                <th><?php echo esc_html__( 'Product Include', 'wcmmq_pro'); ?><?php wcmmq_doc_link('https://codeastrology.com/min-max-quantity/exclude-include-products-on-cart-page/'); ?></th>
                <td>  
                    <input type="text" name="data[cart_product_include]" id="cart_product_include" value="<?php echo esc_attr( $included_products ); ?>" placeholder=<?php echo esc_html__( "Input product Ids", 'wcmmq_pro'); ?> >
                    <p class="product-exclude-include"><?php echo esc_html__( 'Insert Products IDs. Use a comma as a separator. (Example: 45,84,5).  Cart conditions will apply only those products', 'wcmmq_pro'); ?></p>                   
                </td>
            </tr>            
        </table>
        <div class="ultraaddons-button-wrapper">
            <button name="configure_submit" class="button-primary primary button"><?php echo esc_html__( 'Save All', 'wcmmq_pro'); ?></button>
        </div>
    </div>
    <?php
}



/**
 * Based on main config we are trying to validate cart page before going to checkout.
 * 
 * @since 2.0.0
 * 
 * @return bool Where cart page conditions are met ot not.
 */
function wcmmq_cart_page_validation() {
    
    $cart_conditions = get_option( WC_MMQ_KEY );
    $min_price = isset( $cart_conditions['cart_price_min'] ) && !empty( $cart_conditions['cart_price_min'] ) ? floatval( $cart_conditions['cart_price_min'] ) : false;
    $max_price = isset( $cart_conditions['cart_price_max'] ) && !empty( $cart_conditions['cart_price_max'] ) ? floatval( $cart_conditions['cart_price_max'] ) : false;
    $min_quantity = isset( $cart_conditions['cart_quantity_min'] ) && !empty( $cart_conditions['cart_quantity_min'] ) ? floatval( $cart_conditions['cart_quantity_min'] ) : false;
    $max_quantity = isset( $cart_conditions['cart_quantity_max'] ) && !empty( $cart_conditions['cart_quantity_max'] ) ? floatval( $cart_conditions['cart_quantity_max'] ) : false;

    $excluded_products = $cart_conditions['cart_product_exclude'] ?? '';
    $included_products = $cart_conditions['cart_product_include'] ?? '';

    $excluded_products = explode( ',', $excluded_products );
    $included_products = explode( ',', $included_products );

    $excluded_products = array_filter($excluded_products,function($item){
        return ! empty( $item );
    });
    $included_products = array_filter($included_products,function($item){
        return ! empty( $item );
    });

    $contents = WC()->cart->get_cart();
    // var_dump($contents);
    $quantiti = 0;
    $totoal_price = 0;

    $include_empty = empty( $included_products );

    $qtys_arr = [];
    foreach( $contents as $cart){

        $product_id = $cart['product_id'];
        if( ! in_array( $product_id, $excluded_products ) && $include_empty ){
            $quantiti += $cart['quantity'];
            $totoal_price += $cart['line_subtotal'];
        }
        
        if( in_array( $product_id, $included_products ) ){
            $quantiti += $cart['quantity'];
            $totoal_price += $cart['line_subtotal'];
        }
        if( ! empty( $cart['product_id'] ) ){
            $qtys_arr[$product_id][] = $cart['quantity'];
        }
        
        
     }
     $qtys_sum_arr = array_map(function($val){
        return  is_array( $val ) ? array_sum($val) : 0;
     },$qtys_arr);

     
     if( is_array( $qtys_sum_arr ) && ! empty( $qtys_sum_arr ) ){
        wc_clear_notices();
        // wc_print_notices();

        $min_total_errrs = 0;
        foreach( $qtys_sum_arr as $pr_id => $pr_qty ){
            if( empty( $pr_qty ) ) continue;

            $title = get_the_title( $pr_id );
            $min_total = get_post_meta($pr_id,'wcmmq_var_quantity_min_total',true);

            $args = [
                'product_name' => $title,
                'vari_total_min_qty' => $min_total,
            ];

            if( $pr_qty < $min_total ){
                $message = sprintf( wcmmq_get_message( 'msg_vari_total_min_qty', false ), $title, $min_total );
                $message = wcmmq_message_convert_replace( $message, $args );
                wc_add_notice( $message, 'error' );
                $min_total_errrs++;

            }
        }

        if($min_total_errrs){
            
            return false;
            
         }
     }

    if( empty( $excluded_products ) && empty( $included_products ) ){
        $cart_total = WC()->cart->subtotal;
        $cart_total_quantity = WC()->cart->get_cart_contents_count();
    }else{
        $cart_total = $totoal_price;
        $cart_total_quantity = $quantiti;
    }

    if( ! $cart_total_quantity ) return true;

    $args = array(
        'cart_min_price' => wc_price( $min_price ),
        'cart_max_price' => wc_price( $max_price ),
        'cart_min_quantity' => $min_quantity,
        'cart_max_quantity' => $max_quantity,
    );
    $error_count = 0;
    if( $min_price ){
        if( $cart_total < $min_price ){
            $error_count++;
            $message = sprintf( wcmmq_get_message( 'msg_min_price_cart', false ), wc_price( $min_price ) );
            $message = wcmmq_message_convert_replace( $message, $args );
            wc_add_notice( $message, 'error' );
        }
    }
    if( $max_price ){
        if( $cart_total > $max_price ){
            $error_count++;
            $message = sprintf( wcmmq_get_message( 'msg_max_price_cart', false ), wc_price( $max_price ) );
            $message = wcmmq_message_convert_replace( $message, $args );
            wc_add_notice( $message, 'error' );
        }
    }
    if( $min_quantity ){
        if( $cart_total_quantity < $min_quantity ){
            $error_count++;
            $message = sprintf( wcmmq_get_message( 'msg_min_quantity_cart', false ), $min_quantity );
            $message = wcmmq_message_convert_replace( $message, $args );
            wc_add_notice( $message, 'error' );
        }
    }
    if( $max_quantity ){
        if( $cart_total_quantity > $max_quantity ){
            $error_count++;
            $message = sprintf( wcmmq_get_message( 'msg_max_quantity_cart', false ), $max_quantity );
            $message = wcmmq_message_convert_replace( $message, $args );
            wc_add_notice( $message, 'error' );
        }
    }
	
    if( $error_count > 0 ){
        wc_print_notices();
        return false;
    }else{
        return true;
    }

}
add_action( 'woocommerce_before_cart_table' , 'wcmmq_cart_page_validation' );
