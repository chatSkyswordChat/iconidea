<?php
namespace ArrowTheme\Customizer\Field;

use ArrowTheme\Customizer\Modules\Field;

class Multicheck extends Field {

	public $type = 'arrowpress-multicheck';

	protected $control_class = '\ArrowTheme\Customizer\Control\Multicheck';

	protected $control_has_js_template = true;

	public function filter_setting_args( $args, $wp_customize ) {
		if ( $args['id'] === $this->args['id'] ) {
			$args = parent::filter_setting_args( $args, $wp_customize );

			if ( ! isset( $args['sanitize_callback'] ) || ! $args['sanitize_callback'] ) {
				$args['sanitize_callback'] = [ __CLASS__, 'sanitize' ];
			}
		}
		return $args;
	}

	public function filter_control_args( $args, $wp_customize ) {
		if ( $args['id'] === $this->args['id'] ) {
			$args         = parent::filter_control_args( $args, $wp_customize );
			$args['type'] = 'arrowpress-multicheck';
		}
		return $args;
	}

	public static function sanitize( $value ) {
		$value = ( ! is_array( $value ) ) ? explode( ',', $value ) : $value;
		return ( ! empty( $value ) ) ? array_map( 'sanitize_text_field', $value ) : [];
	}
}
