<?php

namespace WPDesk\FCF\Pro\Pricing\Type;

/**
 * Support "Percent Total" type of Pricing.
 */
class TypePercentTotal extends TypeAbstract {

	/**
	 * {@inheritdoc}
	 */
	public function get_calculated_price(): float {
		$totals     = \WC()->cart->get_totals();
		$base_price = ( $totals['cart_contents_total'] + $totals['shipping_total'] + $totals['cart_contents_tax'] + $totals['shipping_tax'] );
		$percent    = $this->get_percentage_of_fee_net_value( $base_price );

		return ( $percent * ( $base_price * $this->get_option_data()['value'] / 100 ) );
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_price_for_label() {
		$value = $this->get_option_data()['value'];
		$price = abs( $value );
		/* translators: %s: percentage value */
		$price = sprintf( __( '%s%% of Total', 'flexible-checkout-fields-pro' ), $price );
		return sprintf( ' (%s %s)', ( $value < 0 ) ? '-' : '+', $price );
	}
}
