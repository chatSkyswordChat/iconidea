<?php

namespace WPDesk\FCF\Pro\Settings\Route;

use WPDesk\FCF\Free\Settings\Route\RouteInterface;
use WPDesk\FCF\Free\Settings\Route\UpdateFormSettingsRoute as DefaultUpdateFormSettingsRoute;
use WPDesk\FCF\Pro\Settings\Form\SettingsPageForm;

/**
 * {@inheritdoc}
 */
class UpdateFormSettingsRoute extends DefaultUpdateFormSettingsRoute implements RouteInterface {

	/**
	 * {@inheritdoc}
	 *
	 * @throws \Exception
	 */
	public function get_endpoint_response( array $params ) {
		try {
			$status = ( new SettingsPageForm() )->save_form_data( $params );
			if ( $status !== true ) {
				throw new \Exception();
			}

			return null;
		} catch ( \Exception $e ) {
			throw $e;
		}
	}
}
