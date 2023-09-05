<?php

namespace WPDesk\FCF\Pro\Settings\Route;

use WPDesk\FCF\Free\Settings\Route\RouteAbstract;
use WPDesk\FCF\Free\Settings\Route\RouteInterface;
use WPDesk\FCF\Pro\Field\Type\CheckboxDefaultType;
use WPDesk\FCF\Pro\Field\Type\CheckboxType;
use WPDesk\FCF\Pro\Field\Type\RadioColorsType;
use WPDesk\FCF\Pro\Field\Type\RadioImagesType;
use WPDesk\FCF\Pro\Field\Type\RadioType;
use WPDesk\FCF\Pro\Field\Type\SelectType;

/**
 * {@inheritdoc}
 */
class FieldsConditionRoute extends RouteAbstract implements RouteInterface {

	const REST_API_ROUTE = 'fields-condition';

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
		$settings   = FieldsFieldRoute::update_fields_settings( $params['form_section'] ?? '', $params['form_fields'] ?? [] );
		$field_name = $params['form_values']['field'] ?? '';
		$values     = [];
		foreach ( $settings as $section_fields ) {
			foreach ( $section_fields as $field ) {
				if ( ( $field['name'] !== $field_name )
					|| ! in_array( $field['type'] ?? '', FieldsFieldRoute::$supported_field_types, true ) ) {
					continue;
				}
				$values += $this->get_values_for_field( $field );
			}
		}
		return $values;
	}


	/**
	 * {@inheritdoc}
	 */
	public function get_values_for_field( array $field_data ): array {
		switch ( $field_data['type'] ) {
			case CheckboxType::FIELD_TYPE:
			case CheckboxDefaultType::FIELD_TYPE:
			case SelectType::FIELD_TYPE:
			case RadioType::FIELD_TYPE:
			case RadioImagesType::FIELD_TYPE:
			case RadioColorsType::FIELD_TYPE:
				return [
					'is' => __( 'is', 'flexible-checkout-fields-pro' ),
				];
		}
		return [];
	}
}
