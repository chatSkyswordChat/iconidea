<?php

namespace WPDesk\FCF\Pro\Settings\Option;

use WPDesk\FCF\Free\Settings\Option\OptionAbstract;
use WPDesk\FCF\Free\Settings\Tab\LogicTab;
use WPDesk\FCF\Pro\Settings\Route\ProductsRoute;

/**
 * {@inheritdoc}
 */
class LogicProductsRulesValueProductsOption extends OptionAbstract {

	const FIELD_NAME = 'products';

	/**
	 * {@inheritdoc}
	 */
	public function get_option_name(): string {
		return self::FIELD_NAME;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_option_tab(): string {
		return LogicTab::TAB_NAME;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_option_type(): string {
		return self::FIELD_TYPE_SELECT_MULTI;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_option_label(): string {
		return __( 'Products', 'flexible-checkout-fields-pro' );
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_validation_rules(): array {
		return [
			'^.{1,}$' => __( 'This field is required.', 'flexible-checkout-fields-pro' ),
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_options_regexes_to_display(): array {
		return [
			LogicProductsRulesConditionOption::FIELD_NAME => '^cart_contains$',
			LogicProductsRulesWhatOption::FIELD_NAME      => '^product$',
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_endpoint_route(): string {
		return ProductsRoute::REST_API_ROUTE;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_endpoint_option_names(): array {
		return [
			LogicProductsRulesConditionOption::FIELD_NAME,
			LogicProductsRulesWhatOption::FIELD_NAME,
		];
	}
}
