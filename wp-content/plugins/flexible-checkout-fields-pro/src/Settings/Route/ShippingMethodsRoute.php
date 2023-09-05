<?php

namespace WPDesk\FCF\Pro\Settings\Route;

use WPDesk\FCF\Free\Settings\Route\RouteAbstract;
use WPDesk\FCF\Free\Settings\Route\RouteInterface;

/**
 * {@inheritdoc}
 */
class ShippingMethodsRoute extends RouteAbstract implements RouteInterface {

	const REST_API_ROUTE = 'shipping-methods';

	/**
	 * Supported shipping.
	 *
	 * @var array
	 */
	private static $supported_shipping_methods = [
		'paczkomaty_shipping_method',
		'polecony_paczkomaty_shipping_method',
		'enadawca',
		'paczka_w_ruchu',
		'dhl',
		'dpd',
		'furgonetka',
		'flexible_shipping_info',
	];

	/**
	 * {@inheritdoc}
	 */
	public function get_endpoint_route(): string {
		return self::REST_API_ROUTE;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_endpoint_response( array $params ) {
		$fields  = $params['form_values'] ?? [];
		$zone_id = $fields['field'] ?? null;
		if ( ! $fields || ! $zone_id ) {
			return [];
		}

		if ( $zone_id !== ShippingZonesRoute::ZONE_DEFAULT_KEY ) {
			return $this->get_shipping_methods_by_zone( $zone_id );
		} else {
			return array_merge(
				$this->get_shipping_methods_by_zone( 0 ),
				$this->get_shipping_methods_for_global()
			);
		}
	}

	/**
	 * Returns shipping methods for shipping zone.
	 *
	 * @param int $zone_id ID of shipping zone.
	 *
	 * @return \WC_Shipping_Method[] List of shipping methods.
	 */
	private function get_shipping_methods_by_zone( int $zone_id ): array {
		$zone    = \WC_Shipping_Zones::get_zone( $zone_id );
		$methods = [];
		foreach ( $zone->get_shipping_methods( true ) as $shipping_method ) {
			if ( ! $this->is_supported_shipping_method( $shipping_method ) ) {
				continue;
			}
			$methods = array_merge( $methods, $this->get_shipping_methods( $shipping_method ) );
		}
		return $methods;
	}

	/**
	 * Returns shipping methods used globally.
	 *
	 * @return \WC_Shipping_Method[] List of shipping methods.
	 */
	private function get_shipping_methods_for_global(): array {
		$shipping_methods = \WC()->shipping->load_shipping_methods();
		$methods          = [];
		foreach ( $shipping_methods as $shipping_method ) {
			if ( $this->is_supported_shipping_method( $shipping_method )
				|| ! isset( $shipping_method->id )
				|| in_array( $shipping_method->id, self::$supported_shipping_methods, true ) ) {
				continue;
			}
			$methods[ $shipping_method->id ] = $shipping_method->method_title;
		}

		return $methods;
	}

	/**
	 * Returns status of whether Shipping Method is supported.
	 *
	 * @param \WC_Shipping_Method $shipping_method WooCommerce Shipping Method Class.
	 *
	 * @return bool Status of supported.
	 */
	private function is_supported_shipping_method( \WC_Shipping_Method $shipping_method ): bool {
		foreach ( $shipping_method->supports as $support ) {
			if ( in_array( $support, [ 'flexible-shipping', 'shipping-zones' ], true ) ) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Returns list of shipping method options.
	 *
	 * @param \WC_Shipping_Method $shipping_method WooCommerce Shipping Method Class.
	 *
	 * @return array List of shipping methods.
	 */
	private function get_shipping_methods( \WC_Shipping_Method $shipping_method ): array {
		$methods = [];
		switch ( $shipping_method->id ) {
			case 'flexible_shipping':
				$option_name = $shipping_method->shipping_methods_option ?? null;
				if ( ! $option_name ) {
					break;
				}

				$fs_methods = get_option( $option_name, [] );
				foreach ( $fs_methods as $fs_method ) {
					$methods[ $fs_method['id_for_shipping'] ] = sprintf( 'Flexible Shipping: %s', $fs_method['method_title'] );
				}
				break;
			default:
				$key             = sprintf( '%s:%s', $shipping_method->id, $shipping_method->instance_id );
				$methods[ $key ] = $shipping_method->title;
				break;
		}
		return $methods;
	}
}
