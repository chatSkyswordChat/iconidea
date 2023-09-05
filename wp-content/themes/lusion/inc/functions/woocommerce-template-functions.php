<?php
if ( ! function_exists( 'apr_core_woocommerce_template_single_title' ) ) {

	/**
	 * Output the product title.
	 */
	function apr_core_woocommerce_template_single_title() {
		echo '<h4 class="woocommerce-loop-product__title">';
		the_title();
		echo '</h4>';
	}
}
if ( ! function_exists( 'apr_core_woocommerce_subtitle' ) ) {

	/**
	 * Output the product title.
	 */
	function apr_core_woocommerce_subtitle() {
		$sub_title = get_post_meta( get_the_ID(), 'sub_title', true );
		if ( $sub_title != '' ) {
			echo '<div class="subtitle-product-sc"><h5>';
			echo $sub_title;
			echo '</h5></div>';
		}

	}
}
if ( ! function_exists( 'apr_core_woocommerce_category' ) ) {

	/**
	 * Output the product title.
	 */
	function apr_core_woocommerce_category() {
		global $product;
		echo '<div class="cate-product">';
		echo wc_get_product_category_list( $product->get_id(), ', ' );
		echo '</div>';
	}
}
if ( ! function_exists( 'apr_core_woocommerce_template_link_details' ) ) {

	/**
	 * Output the product link details.
	 */
	function apr_core_woocommerce_template_link_details() {
		?>
		<div class="btn-single-product">
			<a href="<?php the_permalink() ?>"
			   class="link-more-detail"><?php echo esc_html__( 'Details', 'apr-core' ); ?></a>
		</div>
		<?php
	}
}
if ( ! function_exists( 'apr_core_woocommerce_template_title_link' ) ) {

	/**
	 * Output the product link details.
	 */
	function apr_core_woocommerce_template_title_link() {
		?>
		<h4 class="woocommerce-loop-product__title">
			<a href="<?php the_permalink() ?>" class="link-more-detail"><?php the_title(); ?></a>
		</h4>
		<?php
	}
}
if ( ! function_exists( 'apr_core_woocommerce_time_sale' ) ) {
	function apr_core_woocommerce_time_sale() {
		/**
		 * @var $product WC_Product
		 */
		global $product;
		$time_sale = get_post_meta( $product->get_id(), '_sale_price_dates_to', true );
		if ( $time_sale ) {
			wp_enqueue_script( 'otf-countdown' );
			$time_sale += ( get_option( 'gmt_offset' ) * 3600 );
			$time      = date( 'Y', $time_sale ) . '/' . date( 'm', $time_sale ) . '/' . date( 'd', $time_sale ) . ' ' . date( 'H', $time_sale ) . ':' . date( 'i', $time_sale ) . ':' . date( 's', $time_sale );
			?>
			<h2 class="daily-deal"><?php echo esc_html__( 'Daily Deal', 'apr-core' ) ?></h2>
			<?php
			echo '<div class="time" id="clock-time" data-date="' . date( 'Y', $time_sale ) . '/' . date( 'm', $time_sale ) . '/' . date( 'd', $time_sale ) . ' ' . date( 'H', $time_sale ) . ':' . date( 'i', $time_sale ) . ':' . date( 's', $time_sale ) . '">
                    <div class="countdown-times">
                    </div>
            </div>';
			?>
			<script>
				jQuery(document).ready(function ($) {
					jQuery(".countdown-times").countdown("<?php echo $time;?>", function (event) {
						var $this = jQuery(this).html(event.strftime(''
							+ '<div class="countdown-item"><div class="countdown-digits"><span>%D</span></div><div class="countdown-label">Days</div></div>'
							+ '<div class="countdown-item"><div class="countdown-digits"><span>%H</span></div><div class="countdown-label">Hours</div></div>'
							+ '<div class="countdown-item"><div class="countdown-digits"><span>%M</span></div><div class="countdown-label">Mins</div></div>'
							+ '<div class="countdown-item"><div class="countdown-digits"><span>%S</span></div><div class="countdown-label">Secs</div></div>'));
					});
				})
			</script>
			<?php
		}
	}
}

/**
 * Check if a product is a deal
 *
 * @param int|object $product
 *
 * @return bool
 */
function apr_core_woocommerce_is_deal_product( $product ) {
	$product = is_numeric( $product ) ? wc_get_product( $product ) : $product;

	// It must be a sale product first
	if ( ! $product->is_on_sale() ) {
		return false;
	}

	if ( ! $product->is_in_stock() ) {
		return false;
	}

	// Only support product type "simple" and "external"
	if ( ! $product->is_type( 'simple' ) && ! $product->is_type( 'external' ) ) {
		return false;
	}

	$deal_quantity = get_post_meta( $product->get_id(), '_deal_quantity', true );

	if ( $deal_quantity > 0 ) {
		return true;
	}

	return false;
}

/**
 * Display deal progress on shortcode
 */
if ( ! function_exists( 'apr_core_woocommerce_deal_progress' ) ) {
	function apr_core_woocommerce_deal_progress() {
		global $product;

		$limit = get_post_meta( $product->get_id(), '_deal_quantity', true );
		$sold  = intval( get_post_meta( $product->get_id(), '_deal_sales_counts', true ) );
		if ( empty( $limit ) ) {
			return;
		}

		?>

		<div class="deal-sold">
            <span class="deal-text d-block"><span><?php esc_html_e( 'HURRY! ONLY', 'apr-core' ) ?></span> <span
					class="c-primary"><?php echo esc_attr( trim( $limit - $sold ) ) ?></span> <span><?php esc_html_e( 'LEFT IN STOCK.', 'apr-core' ) ?></span></span>
			<div>
				<div class="deal-progress">
					<div class="progress-bar">
						<div class="progress-value" style="width: <?php echo trim( $sold / $limit * 100 ) ?>%"></div>
					</div>
				</div>
			</div>
		</div>

		<?php
	}
}

if ( ! function_exists( 'apr_core_woocommerce_single_deal' ) ) {
	function apr_core_woocommerce_single_deal() {
		global $product;


		if ( ! apr_core_woocommerce_is_deal_product( $product ) ) {
			return;
		}
		?>

		<div class="apr-woocommerce-deal deal">
			<?php
			apr_core_woocommerce_deal_progress();
			apr_core_woocommerce_time_sale();
			?>
		</div>
		<?php
	}
}
