<?php
namespace ArrowTheme\Customizer\Field;

use ArrowTheme\Customizer\Modules\Field;

defined( 'ABSPATH' ) || exit;

class Custom extends Field {

	public $type = 'arrowpress-custom';

	protected $control_class = '\ArrowTheme\Customizer\Control\Custom';

	protected $control_has_js_template = true;

	public function filter_setting_args( $args, $wp_customize ) {
		if ( $args['id'] === $this->args['id'] ) {
			$args = parent::filter_setting_args( $args, $wp_customize );

			if ( ! isset( $args['sanitize_callback'] ) || ! $args['sanitize_callback'] ) {
				$args['sanitize_callback'] = '__return_null';
			}
		}

		return $args;
	}

	public function filter_control_args( $args, $wp_customize ) {
		if ( $args['id'] === $this->args['id'] ) {
			$args         = parent::filter_control_args( $args, $wp_customize );
			$args['type'] = 'arrowpress-custom';
		}

		return $args;
	}
}
