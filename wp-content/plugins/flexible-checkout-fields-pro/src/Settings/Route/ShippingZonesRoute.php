<?php

namespace WPDesk\FCF\Pro\Settings\Route;

use WPDesk\FCF\Free\Settings\Route\RouteAbstract;
use WPDesk\FCF\Free\Settings\Route\RouteInterface;

/**
 * {@inheritdoc}
 */
class ShippingZonesRoute extends RouteAbstract implements RouteInterface {

	const REST_API_ROUTE   = 'shipping-zones';
	const ZONE_DEFAULT_KEY = 'no_shipping_zones';

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
		$zones = \WC_Shipping_Zones::get_zones();

		$values = [
			self::ZONE_DEFAULT_KEY => __( 'No Shipping Zones or Global Methods', 'flexible-checkout-fields-pro' ),
		];
		foreach ( $zones as $zone ) {
			$values[ $zone['zone_id'] ] = $zone['zone_name'];
		}
		return $values;
	}
}
