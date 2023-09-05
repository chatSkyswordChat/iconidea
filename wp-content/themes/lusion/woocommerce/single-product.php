<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
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
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$cols = Lusion_Global::get_page_sidebar();
$position_upsell_related = get_post_meta(get_the_ID(), 'position_upsell_related', true);
if ($position_upsell_related) {
    $other_position = $position_upsell_related;
} else {
    $other_position = Lusion::setting('single_product_other_product_position');
}
get_header( 'shop' ); ?>
	<?php get_sidebar('left'); ?>
	<div class="<?php echo esc_attr($cols);?>">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php wc_get_template_part( 'content', 'single-product' ); ?>
			<?php if ($other_position === 'in') :?>
				<div class="other-product">
					<?php
						/**
						 * Hook: woocommerce_after_single_product_summary.
						 *
						 * @hooked woocommerce_upsell_display - 15
						 * @hooked woocommerce_output_related_products - 20
						 */
						do_action('woocommerce_after_single_product_other_summary');
					?>
				</div>
			<?php endif; ?>
			
		<?php endwhile; // end of the loop. ?>
	</div>
	<?php get_sidebar('right'); ?>
	<?php if ($other_position === 'out') :?>
		<div class="col-xl-12 col-lg-12 col-sm-12 col-md-12 other-product">
			<?php
				/**
				 * Hook: woocommerce_after_single_product_summary.
				 *
				 * @hooked woocommerce_upsell_display - 15
				 * @hooked woocommerce_output_related_products - 20
				 */
				do_action('woocommerce_after_single_product_other_summary');
			?>
		</div>
	<?php endif; ?>
	
<?php get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
