<?php
namespace ArrowTheme\Customizer\Field;

use ArrowTheme\Customizer\Modules\Field;

class Sortable extends Field {

	public $type = 'arrowpress-sortable';

	protected $control_class = '\ArrowTheme\Customizer\Control\Sortable';

	protected $control_has_js_template = true;


	public function filter_setting_args( $args, $wp_customize ) {
		if ( $args['id'] === $this->args['id'] ) {
			$args = parent::filter_setting_args( $args, $wp_customize );

			if ( ! isset( $args['sanitize_callback'] ) || ! $args['sanitize_callback'] ) {
				$args['sanitize_callback'] = array( $this, 'sanitize' );
			}
		}

		return $args;
	}

	public function filter_control_args( $args, $wp_customize ) {
		if ( $args['id'] === $this->args['id'] ) {
			$args         = parent::filter_control_args( $args, $wp_customize );
			$args['type'] = 'arrowpress-sortable';
		}

		return $args;
	}

	public function sanitize( $values = array() ) {
		$values = (array) $values;

		foreach ( $values as $key => $value ) {
			$values[ $key ] = sanitize_text_field( $value );
		}

		return $values;
	}
}
