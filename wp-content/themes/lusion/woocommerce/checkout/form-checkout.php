<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and 
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
	<div class="row">
		<?php if ( $checkout->get_checkout_fields() ) : ?>
			<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

			<div class="col-xl-7 col-lg-7 col-md-12" id="customer_details">
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			</div>

			<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

		<?php endif; ?>
		<div class="col-xl-5 col-lg-5 col-md-12 checkout_content-right">
			<div class="checkout-col-right">
			
				<?php $link_cart = apply_filters( 'woocommerce_get_cart_url', wc_get_page_permalink( 'cart' ) );?>
				<a class="button-back-cart" href="<?php echo  esc_attr($link_cart);?>"><span class="theme-icon-back"></span><?php echo esc_html__('Back to cart', 'lusion') ?></a>
				<!-- Order -->
				<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
				<h4 class="label-item" id="order_review_heading"><?php esc_html_e( 'Order summary', 'lusion' ); ?></h4>
				<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
				<?php
					global $woocommerce;
					$count = $woocommerce->cart->cart_contents_count;
					if ($count > 0) {
						echo '<div class="product-number"><span class="label-item">';
						echo esc_html_e( ' Cart', 'lusion' );
						echo '<span class="number">&#40;' . esc_attr( $count ) . '&#41;</span>';
						echo '</span><span class = "theme-icon-upload arrow-item"></span></div>';
					}
                ?>
				<div id="order_review" class="woocommerce-checkout-review-order">
					<?php do_action( 'woocommerce_checkout_order_review' ); ?>
				</div>
				<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
			</div>
		</div>
	</div>
</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
