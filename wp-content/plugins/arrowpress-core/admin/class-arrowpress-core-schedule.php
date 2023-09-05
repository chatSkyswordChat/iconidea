<?php

/**
 * Class ArrowPress_Core_Schedule.
 *
 * @since 1.5.0
 */
class ArrowPress_Core_Schedule extends Arrowpress_Singleton {

	/**
	 * ArrowPress_Core_Schedule constructor.
	 *
	 * @since 1.5.0
	 */
	protected function __construct() {
		$this->check_product_registration();
	}

	/**
	 * Check product registration.
	 */
	private function check_product_registration() {
		if ( ! wp_next_scheduled( 'arrowpress_core_check_product_registration' ) ) {
			wp_schedule_event( time(), 'twicedaily', 'arrowpress_core_check_product_registration' );
		}
	}
}