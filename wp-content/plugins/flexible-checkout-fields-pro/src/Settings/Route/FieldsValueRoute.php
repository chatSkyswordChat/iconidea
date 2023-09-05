<?php

namespace WPDesk\FCF\Pro\Settings\Route;

use WPDesk\FCF\Free\Field\FieldData;
use WPDesk\FCF\Free\Settings\Route\RouteInterface;
use WPDesk\FCF\Pro\Field\Type\CheckboxDefaultType;
use WPDesk\FCF\Pro\Field\Type\CheckboxType;
use WPDesk\FCF\Pro\Field\Type\RadioColorsType;
use WPDesk\FCF\Pro\Field\Type\RadioImagesType;
use WPDesk\FCF\Pro\Field\Type\RadioType;
use WPDesk\FCF\Pro\Field\Type\SelectType;
use WPDesk\FCF\Pro\Settings\Option\OptionsKeyOption;
use WPDesk\FCF\Pro\Settings\Option\OptionsOption;
use WPDesk\FCF\Pro\Settings\Option\OptionsValueOption;

/**
 * {@inheritdoc}
 */
class FieldsValueRoute extends FieldsConditionRoute implements RouteInterface {

	const REST_API_ROUTE = 'fields-value';

	/**
	 * {@inheritdoc}
	 */
	public function get_endpoint_route(): string {
		return self::REST_API_ROUTE;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_values_for_field( array $field_data ): array {
		switch ( $field_data['type'] ) {
			case CheckboxType::FIELD_TYPE:
			case CheckboxDefaultType::FIELD_TYPE:
				return [
					'checked'   => __( 'checked', 'flexible-checkout-fields-pro' ),
					'unchecked' => __( 'unchecked', 'flexible-checkout-fields-pro' ),
				];
			case SelectType::FIELD_TYPE:
			case RadioType::FIELD_TYPE:
			case RadioImagesType::FIELD_TYPE:
			case RadioColorsType::FIELD_TYPE:
				$field_args = FieldData::get_field_data( $field_data );
				$options    = $field_args[ OptionsOption::FIELD_NAME ] ?? [];
				if ( ! $field_args || ! $options ) {
					return [];
				}
				return array_combine(
					array_column( $options, OptionsKeyOption::FIELD_NAME ),
					array_column( $options, OptionsValueOption::FIELD_NAME )
				);
		}
		return [];
	}
}
