<?php

namespace WPDesk\FCF\Pro\Validator\Error;

/**
 * {@inheritdoc}
 */
class DateTooEarlyError extends ErrorAbstract {

	/**
	 * {@inheritdoc}
	 */
	public function get_error_message(): string {
		return sprintf(
		/* translators: %s: field label */
			__( '%s field has a date set too early.', 'flexible-checkout-fields-pro' ),
			sprintf( '<strong>%s</strong>', strip_tags( $this->field_data['label'] ) )
		);
	}
}
