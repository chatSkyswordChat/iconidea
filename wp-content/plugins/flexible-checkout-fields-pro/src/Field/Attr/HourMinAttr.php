<?php

namespace WPDesk\FCF\Pro\Field\Attr;

use WPDesk\FCF\Pro\Field\Type\TimeType;
use WPDesk\FCF\Pro\Settings\Option\HourMinOption;

/**
 * {@inheritdoc}
 */
class HourMinAttr implements Attr {

	const ATTR_NAME = 'data-hour-min';

	/**
	 * {@inheritdoc}
	 */
	public function is_available( array $field_data ): bool {
		return ( isset( $field_data['type'] )
			&& ( $field_data['type'] === TimeType::FIELD_TYPE )
			&& ( $field_data[ HourMinOption::FIELD_NAME ] ?? '' ) );
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_name(): string {
		return self::ATTR_NAME;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_value( array $field_data ): string {
		return $field_data[ HourMinOption::FIELD_NAME ];
	}
}
