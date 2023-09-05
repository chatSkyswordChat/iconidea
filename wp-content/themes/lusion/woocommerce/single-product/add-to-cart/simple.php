<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

global $product;
$lusion_ajax_cart = Lusion::setting('single_ajax_cart');

if ( ! $product->is_purchasable() ) {
	return;
}

echo wc_get_stock_html( $product ); // WPCS: XSS ok.

if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' );
	$action = apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ;
	?>

	<form class="cart" action="<?php if (!empty($action)){echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) );}else{echo esc_url('#');}  ?>"  method="post" enctype='multipart/form-data'>
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
		<?php
		do_action( 'woocommerce_before_add_to_cart_quantity' );

		woocommerce_quantity_input( array(
			'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
			'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
			'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
		) );

		do_action( 'woocommerce_after_add_to_cart_quantity' );
		?>
		<?php if(isset($lusion_ajax_cart) && $lusion_ajax_cart):?>
			<!-- apr custom code for ajax add to cart button -->
			<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />
			<!-- End apr custom code -->
		<?php endif; ?>
		<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt">
			<?php if ( $product->is_virtual() ) : ?>
				<?php echo esc_html__( 'Book now', 'lusion' ); ?>
			<?php elseif ( $product->is_on_backorder() ) : ?>
				<?php echo esc_html__( 'Backorder', 'lusion' ); ?>
			<?php else : ?>
				<?php echo esc_html( $product->single_add_to_cart_text() ); ?>
			<?php endif; ?>
		</button>
		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
