<?php
namespace ArrowTheme\Customizer\Field;

use ArrowTheme\Customizer\Modules\Field;

class Slider extends Field {

	public $type = 'arrowpress-slider';

	protected $control_class = '\ArrowTheme\Customizer\Control\Slider';

	protected $control_has_js_template = true;

	public function filter_setting_args( $args, $wp_customize ) {
		if ( $args['id'] === $this->args['id'] ) {
			$args = parent::filter_setting_args( $args, $wp_customize );

			// Set the sanitize_callback if none is defined.
			if ( ! isset( $args['sanitize_callback'] ) || ! $args['sanitize_callback'] ) {
				$args['sanitize_callback'] = function ( $value ) {
					return filter_var( $value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
				};
			}
		}

		return $args;
	}

	public function filter_control_args( $args, $wp_customize ) {
		if ( $args['id'] === $this->args['id'] ) {
			$args         = parent::filter_control_args( $args, $wp_customize );
			$args['type'] = 'arrowpress-slider';
		}

		return $args;
	}
}
