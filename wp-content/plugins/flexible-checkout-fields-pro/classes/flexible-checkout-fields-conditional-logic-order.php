<?php
/**
 * @package Flexible Checkout Fields PRO
 */

if ( ! defined( 'ABSPATH' ) ) { // Exit if accessed directly.
	exit;
}

require_once 'flexible-checkout-fields-conditional-logic-filter.php';

/**
 * Class Flexible_Checkout_Fields_Conditional_Logic_Checkout
 */
class Flexible_Checkout_Fields_Conditional_Logic_Order
	extends Flexible_Checkout_Fields_Conditional_Logic_Filter
	implements \FCFProVendor\WPDesk\PluginBuilder\Plugin\Hookable {

	/**
	 * Constants.
	 */
	const TERM_PRODUCT_CAT = 'product_cat';

	const PRODUCT_TYPE_VARIATION = 'variation';

	/**
	 * Order.
	 *
	 * @var WC_Order Order
	 */
	protected $order;

	/**
	 * In email?
	 *
	 * @var bool
	 */
	protected $in_email = false;


	/**
	 * Hooks.
	 */
	public function hooks() {
		add_filter( 'flexible_checkout_fields_condition', array( $this, 'show_field_for_order_product_and_category_rules' ), 10, 2 );
		add_filter( 'flexible_checkout_fields_condition', array( $this, 'show_field_for_order_fields_rules' ), 10, 2 );

		add_action( 'woocommerce_email_customer_details', array( $this, 'woocommerce_email_customer_details_start' ), 1, 1 );
		add_action( 'woocommerce_email_customer_details', array( $this, 'woocommerce_email_customer_details_end' ), 1000000 );
	}

	/**
	 * We are in email.
	 *
	 * @param WC_Order $order Order.
	 */
	public function woocommerce_email_customer_details_start( $order ) {
		$this->in_email = true;
		$this->order    = $order;
	}

	/**
	 * We are exiting email.
	 */
	public function woocommerce_email_customer_details_end() {
		$this->in_email = false;
	}

	/**
	 * Is thank you page?
	 *
	 * @return bool
	 */
	public function is_thank_you_page() {
		global $wp;
		$thank_you_page = false;
		if ( is_checkout() ) {
			if ( isset( $wp->query_vars['order-received'] ) ) {
				$thank_you_page = true;
				$this->order    = wc_get_order( $wp->query_vars['order-received'] );
			}
		}
		return $thank_you_page;
	}

	/**
	 * Is order page?
	 *
	 * @return bool
	 */
	public function is_order_page() {
		global $wp;
		$order_page = false;
		if ( is_account_page() ) {
			if ( isset( $wp->query_vars['view-order'] ) ) {
				$order_page  = true;
				$this->order = wc_get_order( $wp->query_vars['view-order'] );
			}
		}
		return $order_page;
	}


	/**
	 * Is in email?
	 *
	 * @return bool
	 */
	public function is_in_email() {
		return $this->in_email;
	}

	/**
	 * Check that products are in cart/order.
	 *
	 * @param array $products Products ID array.
	 *
	 * @return bool
	 */
	protected function are_products_meet( array $products ) {
		return $this->are_products_in_order( $products );
	}

	/**
	 * Check that categories are in cart/order.
	 *
	 * @param array $categories Categories ID array.
	 *
	 * @return bool
	 */
	protected function are_categories_meet( array $categories ) {
		return $this->are_categories_in_order( $categories );
	}

	/**
	 * Are products in cart?
	 *
	 * @param array $products Products array.
	 *
	 * @return bool
	 * @internal
	 */
	public function are_products_in_order( array $products ) {
		if ( ! empty( $this->order ) ) {
			foreach ( $this->order->get_items() as $item ) {
				if ( ! $item instanceof WC_Order_Item_Product ) {
					continue;
				}

				$_product = $item->get_product();
				if ( ! $this->is_product_valid( $_product ) ) {
					continue;
				}

				if ( $_product->is_type( self::PRODUCT_TYPE_VARIATION ) ) {
					if ( in_array( (string) wpdesk_get_variation_parent_id( $_product ), $products, true ) ) {
						return true;
					}
					if ( in_array( (string) wpdesk_get_variation_id( $_product ), $products, true ) ) {
						return true;
					}
				} else {
					if ( in_array( (string) wpdesk_get_product_id( $_product ), $products, true ) ) {
						return true;
					}
				}
			}
		}
		return false;
	}

	/**
	 * Are categories in cart?
	 *
	 * @param array $categories Categories array.
	 *
	 * @return bool
	 * @internal
	 */
	public function are_categories_in_order( $categories ) {
		if ( ! empty( $this->order ) ) {
			foreach ( $this->order->get_items() as $item ) {
				if ( ! $item instanceof WC_Order_Item_Product ) {
					continue;
				}

				$_product = $item->get_product();
				if ( ! $this->is_product_valid( $_product ) ) {
					continue;
				}

				if ( $_product->is_type( self::PRODUCT_TYPE_VARIATION ) ) {
					$_categories = get_the_terms( wpdesk_get_variation_parent_id( $_product ), self::TERM_PRODUCT_CAT );
				} else {
					$_categories = get_the_terms( wpdesk_get_product_id( $_product ), self::TERM_PRODUCT_CAT );
				}
				if ( is_array( $_categories ) ) {
					foreach ( $_categories as $_category ) {
						if ( in_array( (string) $_category->term_id, $categories, true ) ) {
							return true;
						}
					}
				}
			}
		}
		return false;
	}

	/** @param mixed $maybe_product */
	private function is_product_valid( $maybe_product ): bool {
		return $maybe_product instanceof WC_Product;
	}

	/**
	 * Show field on checkout page - product and category rules.
	 *
	 * @param bool  $show_field Show field.
	 * @param array $field Field.
	 *
	 * @return bool
	 */
	public function show_field_for_order_product_and_category_rules( $show_field, $field ) {
		if ( ! $this->is_in_email() && ! $this->is_order_page() && ! $this->is_thank_you_page() ) {
			return $show_field;
		}
		if ( ! isset( $this->order ) ) {
			return $show_field;
		}
		return $this->show_field_product_and_category_rules( $show_field, $field );
	}

	/**
	 * Conditional logic fields rule match.
	 *
	 * @param array $rule Rule.
	 *
	 * @return int
	 */
	protected function conditional_logic_fields_rule_match( array $rule ) {
		$rule_match            = 0;
		$rule_field_name       = $rule['field'];
		$rule_field_definition = $this->get_field_settings( $rule_field_name );
		$field_value           = $this->order->get_meta( '_' . $rule_field_name );
		if ( is_array( $rule_field_definition )
				&& isset( $rule_field_definition['type'] )
				&& ( 'inspirecheckbox' === $rule_field_definition['type'] || 'checkbox' === $rule_field_definition['type'] )
		) {
			if ( ( ( 'checked' === $rule['value'] ) && ( '' !== $field_value ) )
				|| ( ( 'unchecked' === $rule['value'] ) && ( '' === $field_value ) ) ) {
				$rule_match = 1;
			}
		} else {
			if ( $field_value === $rule['value'] ) {
				$rule_match = 1;
			}
		}
		return $rule_match;
	}

	/**
	 * Show field on checkout page - fields rules.
	 *
	 * @param bool  $show_field Show field.
	 * @param array $field Field.
	 *
	 * @return bool
	 */
	public function show_field_for_order_fields_rules( $show_field, $field ) {
		if ( ! $this->is_in_email() && ! $this->is_order_page() && ! $this->is_thank_you_page() ) {
			return $show_field;
		}
		if ( ! isset( $this->order ) ) {
			return $show_field;
		}
		if ( isset( $field['conditional_logic_fields'] ) && '1' === $field['conditional_logic_fields'] ) {
			$rules_match = array();
			if ( isset( $field['conditional_logic_fields_rules'] ) ) {
				foreach ( $field['conditional_logic_fields_rules'] as $rule_id => $rule ) {
					$rules_match[ $rule_id ] = $this->conditional_logic_fields_rule_match( $rule );
				}
			}
			if ( isset( $field['conditional_logic_fields_action'] ) ) {
				$show_field = $show_field && $this->compute_show_field( $rules_match, $field['conditional_logic_fields_operator'], $field['conditional_logic_fields_action'] );
			}
		}
		return $show_field;
	}

}
