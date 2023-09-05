<?php

namespace WPDesk\FCF\Pro\Settings\Route;

use WPDesk\FCF\Free\Field\FieldData;
use WPDesk\FCF\Free\Settings\Form\EditFieldsForm;
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
class FieldsFieldRoute extends RouteAbstract implements RouteInterface {

	const REST_API_ROUTE = 'fields-field';

	/**
	 * List of supported field types.
	 *
	 * @var array
	 */
	public static $supported_field_types = [
		CheckboxType::FIELD_TYPE,
		CheckboxDefaultType::FIELD_TYPE,
		SelectType::FIELD_TYPE,
		RadioType::FIELD_TYPE,
		RadioImagesType::FIELD_TYPE,
		RadioColorsType::FIELD_TYPE,
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
		$settings       = $this::update_fields_settings( $params['form_section'] ?? '', $params['form_fields'] ?? [] );
		$excluded_field = $params['form_field_name'] ?? '';
		$values         = [];
		foreach ( $settings as $section_fields ) {
			foreach ( $section_fields as $field ) {
				if ( ( $field['name'] === $excluded_field )
					|| ! in_array( $field['type'] ?? '', self::$supported_field_types, true ) ) {
					continue;
				}
				$values[ $field['name'] ] = sprintf( '%s (%s)', $field['label'], $field['name'] );
			}
		}
		return $values;
	}

	/**
	 * Returns updated fields settings using posted data.
	 *
	 * @param string $section_name     Name of section.
	 * @param array  $section_settings Settings of section.
	 *
	 * @return array Fields settings.
	 */
	public static function update_fields_settings( string $section_name, array $section_settings ): array {
		$settings = get_option( EditFieldsForm::SETTINGS_OPTION_NAME, [] );
		if ( ! $section_settings ) {
			return $settings;
		}

		$section_fields = [];
		foreach ( $section_settings as $field_data ) {
			$new_field_data = FieldData::get_field_data( $field_data, false );
			if ( ! $new_field_data ) {
				continue;
			}
			$section_fields[ $field_data['name'] ] = $new_field_data;
		}

		$settings[ $section_name ] = $section_fields;
		return $settings;
	}
}
