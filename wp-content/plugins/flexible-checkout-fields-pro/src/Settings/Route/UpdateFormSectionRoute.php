<?php

namespace WPDesk\FCF\Pro\Settings\Route;

use WPDesk\FCF\Free\Settings\Route\RouteAbstract;
use WPDesk\FCF\Free\Settings\Route\RouteInterface;
use WPDesk\FCF\Pro\Settings\Form\EditSectionForm;

/**
 * {@inheritdoc}
 */
class UpdateFormSectionRoute extends RouteAbstract implements RouteInterface {

	const REST_API_ROUTE = '(?P<form_section>[a-z_]+)/section';

	/**
	 * {@inheritdoc}
	 */
	public function get_endpoint_route(): string {
		return self::REST_API_ROUTE;
	}

	/**
	 * Returns list of args for params using to register endpoint.
	 *
	 * @return array Args for endpoint params.
	 */
	public function get_route_params(): array {
		return [
			'form_section' => [
				'description' => 'Section name',
				'required'    => true,
			],
			'form_fields'  => [
				'description' => 'Form fields',
				'required'    => true,
			],
		];
	}

	/**
	 * {@inheritdoc}
	 *
	 * @throws \Exception
	 */
	public function get_endpoint_response( array $params ) {
		try {
			$status = ( new EditSectionForm() )->save_form_data( $params );
			if ( $status !== true ) {
				throw new \Exception();
			}

			return null;
		} catch ( \Exception $e ) {
			throw $e;
		}
	}
}
