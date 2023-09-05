<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     4.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$lusion_related_product = '';
$lusion_related = get_post_meta(get_the_ID(), 'related_product', true);
$single_type = Lusion_Templates::get_product_single_style();
if($lusion_related ){
	$lusion_related_product = $lusion_related;
}else{
	$lusion_related_product = Lusion::setting( 'single_product_related_enable' );
}
$related_title = Lusion::setting( 'related_title' );
if ( $related_products && $lusion_related_product !== '1') : ?>
	<div class="products-related <?php if ($single_type == 'single_3'){echo 'container';}?>">
		<div class="product-extra">
			<section class="related products">
				<div class="extra_title">
					<?php if($related_title !== ''): ?>
						<?php if((in_array('sitepress-multilingual-cms/sitepress.php', apply_filters('active_plugins', get_option('active_plugins')))) && function_exists('icl_object_id') ): ?>
							<h2><?php echo esc_html__( 'Related products', 'lusion' ) ?></h2>
						<?php else:?>
							<h2><?php echo esc_html($related_title); ?></h2>
						<?php endif;?>
					<?php endif;?>
				</div>

				<?php woocommerce_product_loop_start(); ?>

					<?php foreach ( $related_products as $related_product ) : ?>

						<?php
							$post_object = get_post( $related_product->get_id() );

							setup_postdata( $GLOBALS['post'] =& $post_object );

							wc_get_template_part( 'content', 'product' ); ?>

					<?php endforeach; ?>

				<?php woocommerce_product_loop_end(); ?>

			</section>
		</div>
	</div>
<?php endif;

wp_reset_postdata();
