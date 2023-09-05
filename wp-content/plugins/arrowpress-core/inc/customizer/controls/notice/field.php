<?php
namespace ArrowTheme\Customizer\Field;

use ArrowTheme\Customizer\Modules\Field;

class Notice extends Field {

	public $type = 'arrowpress-notice';

	protected $control_class = '\ArrowTheme\Customizer\Control\Notice';

	protected $control_has_js_template = true;

	public function filter_control_args( $args, $wp_customize ) {
		if ( $args['id'] === $this->args['id'] ) {
			$args         = parent::filter_control_args( $args, $wp_customize );
			$args['type'] = 'arrowpress-notice';
		}

		return $args;
	}
}
