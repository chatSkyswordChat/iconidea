<?php

namespace WPDesk\FCF\Pro\Settings\Option;

use WPDesk\FCF\Free\Settings\Option\LabelOption;

/**
 * {@inheritdoc}
 */
class PricingValueOption extends PricingValuesOption {

	/**
	 * Returns name of option whose value will create list of rows for Repeater field.
	 *
	 * @return string Option name.
	 */
	public function get_option_name_to_rows(): string {
		return LabelOption::FIELD_NAME;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_default_value() {
		return [
			'_value' => [
				'type'      => '',
				'value'     => 0,
				'tax_class' => '',
			],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function save_field_data( array $field_data, array $field_settings ): array {
		return $this->update_field_data( $field_data, $field_settings );
	}
}
