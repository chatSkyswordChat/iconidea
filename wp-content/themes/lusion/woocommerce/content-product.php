<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */
defined( 'ABSPATH' ) || exit;
global $product, $woocommerce_loop, $lusion_product_layout;
// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$entries_count = 0;
$post_term_filters = $post_term_names = $lusion_product_layouts = $lusion_product_types = $class_action = $product_type = '';
$animation = Lusion::setting( 'product_css_animation' );
$post_term_arr = get_the_terms( get_the_ID(), 'product_cat' );
$lusion_product_columns = lusion_get_meta_value('product_columns');

if(isset($woocommerce_loop['product_column_number']) && !is_shop() && !is_tax() && !is_singular('product')){
	$lusion_product_column = wc_get_loop_prop( 'columns' );
}elseif($lusion_product_columns){
	$lusion_product_column = $lusion_product_columns;
}else{
	$lusion_product_column = Lusion::setting('product_column');
}

if(isset($lusion_product_layout) && $lusion_product_layout !== 'default'){
	$lusion_product_layouts = $lusion_product_layout;
}else{
	$lusion_product_layouts = Lusion::setting('product_layouts');
}

if(isset($lusion_product_type) && $lusion_product_type !== 'default'){
	$lusion_product_types = $lusion_product_type;
}else{
	$lusion_product_types = Lusion::setting('product_type');
}

if( is_array( $post_term_arr ) && count( $post_term_arr ) > 0 ) {
    foreach ( $post_term_arr as $post_term ) {

        $post_term_filters .= $post_term->slug . ' ';
        $post_term_names .= $post_term->name . ', ';
    }
}

if (!Lusion::setting('show_action')) {
	$class_action = 'hide-action';
}
$post_term_filters = trim( $post_term_filters );
$post_term_names = substr( $post_term_names, 0, -2 );
$classes[] = $post_term_filters;
$classes[] = 'product';
?>
<li <?php post_class($classes); ?>>
	<div class="product-content clearfix <?php if ($lusion_product_types == 8) {echo 'product-style-8';} ?>">
		<div class="product-top">
			<?php
				/**
				 * Hook: woocommerce_before_shop_loop_item_title.
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked lusion_woocommerce_product_image - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );
			?>
			
			<?php 
            
            if(($lusion_product_layouts == 'grid' || $lusion_product_layouts == 'grid_list' || (isset($woocommerce_loop['product_layout']) 
                    && $woocommerce_loop['product_layout'] == 'grid') || (isset($woocommerce_loop['product_layout']) 
                    && $woocommerce_loop['product_layout'] == 'tab')) 
                && ($lusion_product_types == 1 || $lusion_product_types == 2 || $lusion_product_types == 5 || (isset($woocommerce_loop['product_type']) 
                    && $woocommerce_loop['product_type'] == '1') || (isset($woocommerce_loop['product_type']) 
                    && $woocommerce_loop['product_type'] == '2') || (isset($woocommerce_loop['product_type']) 
                    && $woocommerce_loop['product_type'] == '5'))): ?>
				<div class="product-action">
					<?php
						/**
						 * Hook: woocommerce_product_add_to_cart.
						 *
						 * @hooked woocommerce_template_loop_add_to_cart - 10
						 */
						do_action( 'woocommerce_product_add_to_cart' );
					?>
					<div class="group-action <?php echo esc_attr($class_action);?>">
						<?php do_action( 'woocommerce_product_top_action_layout_1' );?>
					</div>
				</div>
			<?php elseif(($lusion_product_layouts == 'grid' || $lusion_product_layouts == 'grid_list' ||
                (isset($woocommerce_loop['product_layout']) && $woocommerce_loop['product_layout'] == 'grid') || 
                (isset($woocommerce_loop['product_layout']) && $woocommerce_loop['product_layout'] == 'tab')) 
            && ($lusion_product_types == 1 || $lusion_product_types == 4 || 
                (isset($woocommerce_loop['product_layout']) && $woocommerce_loop['product_type'] == '1') || 
                (isset($woocommerce_loop['product_layout']) && $woocommerce_loop['product_layout'] == 'list') || 
                (isset($woocommerce_loop['product_layout']) && $woocommerce_loop['product_type'] == '4'))): ?>
				<div class="product-action">
					<?php if( $lusion_product_types == 1 || (isset($woocommerce_loop['product_type']) && $woocommerce_loop['product_type'] == '4') || (isset($woocommerce_loop['product_layout']) && $woocommerce_loop['product_layout'] == 'list')): ?>
						<?php
							/**
							 * Hook: woocommerce_product_add_to_cart.
							 *
							 * @hooked woocommerce_template_loop_add_to_cart - 10
							 */
							do_action( 'woocommerce_product_add_to_cart' );
						?>
					<?php endif; ?>
					<div class="group-action <?php echo esc_attr($class_action);?>">
						<?php do_action( 'woocommerce_product_top_action_layout_4' );?>
					</div>
				</div>
			<?php elseif($lusion_product_layouts == 'list' || $lusion_product_layouts == 'list_grid'): ?>
			<?php else: ?>
				<div class="product-action">
					<?php
						/**
						 * Hook: woocommerce_product_add_to_cart.
						 *
						 * @hooked woocommerce_template_loop_add_to_cart - 10
						 */
						do_action( 'woocommerce_product_add_to_cart' );
					?>
					<div class="group-action <?php echo esc_attr($class_action);?>">
						<?php
						/**
						 * Hook: woocommerce_product_action.
						 *
						 * @hooked lusion_quickview - 10
						 * @hooked lusion_wishlist_custom - 20
						 * @hooked lusion_compare_product - 30
						 */
						do_action( 'woocommerce_product_action' );
						?>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<div class="product-desc">
			<div class="product-content-info">
				<?php 
					if (isset($woocommerce_loop['product_layout']) && $woocommerce_loop['product_type'] == 8) {
						woocommerce_template_loop_rating();
					}
					do_action( 'woocommerce_info_product' );
	            ?>
				<?php 
					/**
					 * Hook: woocommerce_shop_loop_item_title.
					 *
					 * @hooked woocommerce_template_loop_product_title - 10
					 */
					do_action( 'woocommerce_shop_loop_item_title' );

				?>
				<div class="product-price">
					<?php
						/**
						 * Hook: woocommerce_after_shop_loop_item_title.
						 *
						 * @hooked woocommerce_template_loop_rating - 5
						 * @hooked woocommerce_template_loop_price - 10
						 */
						do_action( 'woocommerce_after_shop_loop_item_title' );
						
					?>
					
	            </div>
				<?php if(class_exists('WooCommerce') && (is_archive() || is_shop()) && $lusion_product_layout != 'grid'): ?>
					<?php do_action( 'woocommerce_product_excerpt' );  ?>
				<?php endif; ?>
				
				<?php if(($lusion_product_layouts == 'grid' || $lusion_product_layouts == 'grid_list' || (isset($woocommerce_loop['product_layout']) && $woocommerce_loop['product_layout'] == 'grid') || (isset($woocommerce_loop['product_layout']) && $woocommerce_loop['product_layout'] == 'tab')) && ($lusion_product_types == 5 || $lusion_product_types == 1 || (isset($woocommerce_loop['product_type']) && $woocommerce_loop['product_type'] == '1') || (isset($woocommerce_loop['product_type']) && $woocommerce_loop['product_type'] == '5' ) || (isset($woocommerce_loop['product_type']) && $woocommerce_loop['product_type'] == '2' ))): ?>
					<div class="product-action"><?php do_action( 'woocommerce_product_bottom_action_layout_1' );?></div>
				<?php elseif(($lusion_product_layouts == 'grid' || $lusion_product_layouts == 'grid_list' || (isset($woocommerce_loop['product_layout']) && $woocommerce_loop['product_layout'] == 'grid') || (isset($woocommerce_loop['product_layout']) && $woocommerce_loop['product_layout'] == 'tab
				')) && ($lusion_product_types == 2 || $lusion_product_types == 3 || $lusion_product_types == 6 || $lusion_product_types == 7) || (isset($woocommerce_loop['product_type']) && $woocommerce_loop['product_type'] == 'default') || (isset($woocommerce_loop['product_type']) && $woocommerce_loop['product_type'] == '3') || (isset($woocommerce_loop['product_type']) && $woocommerce_loop['product_type'] == '6') || (isset($woocommerce_loop['product_type']) && $woocommerce_loop['product_type'] == '7')): ?>
				<?php elseif(($lusion_product_layouts == 'grid' || $lusion_product_layouts == 'grid_list' || (isset($woocommerce_loop['product_layout']) && $woocommerce_loop['product_layout'] == 'grid') || (isset($woocommerce_loop['product_layout']) && $woocommerce_loop['product_layout'] == 'tab')) && ($lusion_product_types == 4 || (isset($woocommerce_loop['product_type']) && $woocommerce_loop['product_type'] == '4'))): ?>
					<div class="product-action">
						<div class="group-action <?php echo esc_attr($class_action);?>">
							<?php do_action( 'woocommerce_product_bottom_action_layout_4' );?>
						</div>
						<?php
							/**
							 * Hook: woocommerce_product_action.
							 *
							 * @hooked woocommerce_template_loop_add_to_cart - 10
							 */
							do_action( 'woocommerce_product_add_to_cart' );
							
						?>
					</div>
				<?php elseif(($lusion_product_layouts == 'grid' || $lusion_product_layouts == 'grid_list' || (isset($woocommerce_loop['product_layout']) && $woocommerce_loop['product_layout'] == 'grid') || (isset($woocommerce_loop['product_layout']) && $woocommerce_loop['product_layout'] == 'tab')) && (  (isset($woocommerce_loop['product_type']) && $woocommerce_loop['product_type'] == '1') )): ?> 
					<div class="product-action">
						<?php
							/**
							 * Hook: woocommerce_product_action.
							 *
							 * @hooked woocommerce_template_loop_add_to_cart - 10
							 */
							do_action( 'woocommerce_product_add_to_cart' );
							
						?>
					</div>
				<?php else: ?>
					<div class="product-action">
						<div class="group-action <?php echo esc_attr($class_action);?>">
							<?php
							/**
							 * Hook: woocommerce_product_action.
							 *
							 * @hooked lusion_quickview - 10
							 * @hooked lusion_wishlist_custom - 20
							 * @hooked lusion_compare_product - 30
							 */
							do_action( 'woocommerce_product_action' );
							?>
						</div> 
						<?php
							/**
							 * Hook: woocommerce_product_action.
							 *
							 * @hooked woocommerce_template_loop_add_to_cart - 10
							 */
							do_action( 'woocommerce_product_add_to_cart' );
							
						?>
					</div>
				<?php endif; ?>
			</div>
			<?php if (isset($woocommerce_loop['product_layout']) && $woocommerce_loop['product_type'] == 8 && isset($woocommerce_loop['show_product_descriptions']) && $woocommerce_loop['show_product_descriptions'] == 'yes'): ?>
				<div class="product-description">
					<?php the_excerpt(); ?>					
				</div>
				<div class="product-action--8">
					<div class="product-action-8">
						<a href="<?php the_permalink() ?>" class="add-to-cart"><?php echo esc_html__('Shop now', 'lusion') ?></a>
						<?php if ($woocommerce_loop['show_btn_specs'] == 'yes'  && isset($woocommerce_loop['text_button_specs']) && $woocommerce_loop['text_button_specs'] != ''): ?>
							<a href="#" class="view-spec"><?php echo esc_html__($woocommerce_loop['text_button_specs'], 'lusion') ?></a>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</li>