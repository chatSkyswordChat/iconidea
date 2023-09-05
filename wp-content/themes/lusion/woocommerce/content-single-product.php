<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

defined('ABSPATH') || exit;
global $product;
/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
$single_type = Lusion_Templates::get_product_single_style();
$lusion_product_thumbnails = lusion_get_meta_value('product_thumbnail_style');
if ($lusion_product_thumbnails != 'default') {
    $lusion_product_thumbnails = lusion_get_meta_value('product_thumbnail_style');
} elseif (Lusion::setting('product_thumbnails_style')) {
    $lusion_product_thumbnails = Lusion::setting('product_thumbnails_style');
} else {
    $lusion_product_thumbnails = 'vertical';
}
$class_thumbnails='';
if ($lusion_product_thumbnails === 'horizontal') {
    $class_thumbnails = 'product-thumbnails-horizontal';
} else {
    $class_thumbnails = 'product-thumbnails-vertical';
}

$sticky_single_product_cs = Lusion::setting('single_sticky_product');
$sticky_single_product = lusion_get_meta_value('sticky_product');
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
    <div class="product-detail  <?php echo esc_attr($single_type); ?> <?php if($single_type ==='single_1'){echo esc_attr($class_thumbnails);}?>">
        <div class="row">
            <?php
            $gallery_ids = $product->get_gallery_image_ids();
            $gallery = empty($gallery_ids) ? 'no-gallery' : 'has-gallery';
            ?>
            <div class="col-xl-8 col-lg-8 col-sm-12 col-md-12 product-images-wrapper <?php echo esc_attr( $gallery ); ?>">
                <?php
                /**
                 * Hook: woocommerce_before_single_product_summary.
                 *
                 * @hooked woocommerce_show_product_sale_flash - 10
                 * @hooked woocommerce_show_product_images - 20
                 */
                do_action('woocommerce_before_single_product_summary');
                ?>
            </div>
            <div class="col-xl-4 col-lg-4 col-sm-12 col-md-12 product-detail-summary">
                <div class="summary entry-summary">
                    <?php if($single_type =='single_3'):?>
                        <div class="entry_summary_left">
                            <?php
                            /**
                             * Hook: woocommerce_single_product_summary.
                             *
                             * @hooked woocommerce_template_single_title - 5
                             * @hooked woocommerce_template_single_rating - 10
                             * @hooked woocommerce_template_single_price - 10
        					 * @hooked lusion_stock_text_shop_page - 15
                             * @hooked lusion_delivery_return - 15 - 7
                             * @hooked woocommerce_template_single_sharing - 50
                              * @hooked woocommerce_template_single_excerpt - 10
                             * @hooked WC_Structured_Data::generate_product_data() - 60
                             */
                            do_action('woocommerce_single_product_summary_2');
                            ?>
                        </div>
                        <div class="entry_summary_right">
                            <?php
                                /**
                                 * Hook: woocommerce_after_single_product_summary.
                                 *
                                 * @hooked woocommerce_template_single_add_to_cart - 5
                                 * @hooked woocommerce_output_product_data_tabs - 20
                                 * @hooked woocommerce_template_single_meta - 15 - 5
                                 */
                                do_action('woocommerce_after_single_product_summary_2');
                            ?>
                        </div>
                    <?php else:?>
                        <?php if($single_type =='single_4'):?>
                            <?php
                                /**
                                 * Hook: woocommerce_single_product_summary.
                                 *
                                 * @hooked woocommerce_template_single_title - 5
                                 * @hooked woocommerce_template_single_rating - 10
                                 * @hooked woocommerce_template_single_price - 10
                                 * @hooked woocommerce_template_single_excerpt - 10
                                 * @hooked lusion_stock_text_shop_page - 15
                                 * @hooked woocommerce_template_single_meta - 15 - 5
                                 * @hooked lusion_delivery_return - 15 - 7
                                 * @hooked woocommerce_template_single_add_to_cart - 30
                                 * @hooked woocommerce_template_single_sharing - 50
                                 * @hooked WC_Structured_Data::generate_product_data() - 60
                                 */
                                do_action('woocommerce_single_product_summary_3');
                            ?>
                        <?php else:?>
                            <?php
                                /**
                                 * Hook: woocommerce_single_product_summary.
                                 *
                                 * @hooked woocommerce_template_single_title - 5
                                 * @hooked woocommerce_template_single_rating - 10
                                 * @hooked woocommerce_template_single_price - 10
                                 * @hooked woocommerce_template_single_excerpt - 10
                                 * @hooked lusion_stock_text_shop_page - 15
                                 * @hooked woocommerce_template_single_meta - 15 - 5
                                 * @hooked lusion_delivery_return - 15 - 7
                                 * @hooked woocommerce_template_single_add_to_cart - 30
                                 * @hooked woocommerce_template_single_sharing - 50
                                 * @hooked WC_Structured_Data::generate_product_data() - 60
                                 */
                                do_action('woocommerce_single_product_summary');
                            ?>
                        <?php endif;?>
                        <?php
                            /**
                             * Hook: woocommerce_after_single_product_summary.
                             *
                             * @hooked woocommerce_output_product_data_tabs - 10
                             */
                            do_action('woocommerce_after_single_product_summary');
                        ?>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div><!-- /. Product detail -->
</div>
<?php do_action('woocommerce_after_single_product'); ?>

<?php 
if(($sticky_single_product_cs == 1 && $sticky_single_product !='off')  || ($sticky_single_product_cs == 0   &&  $sticky_single_product =='on')): 
?>
	<div class="sitcky-product <?php if(!Lusion::setting('product_wishlist')){echo 'no-wishlist';} ?>">
		<?php 
			?>
			<div class="sitcky-wapper container">
				<div class="sitcky-left">
				<?php 
					echo do_action('woocommerce_sticky_single_product'); 
					echo the_title( '<h3 class="product_title">', '</h3>' );
					echo woocommerce_template_single_price();
				?>
				</div>
				<div class="sitcky-right">
					<?php echo woocommerce_template_single_add_to_cart(); ?>
					<?php if (class_exists('YITH_WCWL') && Lusion::setting('product_wishlist')) : ?>
						<?php
                        if(function_exists('lusion_wishlist_custom')){
                            echo lusion_wishlist_custom();
                        }
                        ?> 
					<?php endif; ?>
				</div>
			</div>
			<?php
		?>
	</div>
<?php 
endif; 
?>

