<?php
namespace ArrowTheme\Customizer\Field;

class Toggle extends Checkbox_Switch {

	public $type = 'arrowpress-toggle';

	protected $control_class = '\ArrowTheme\Customizer\Control\Toggle';

	public function filter_control_args( $args, $wp_customize ) {
		if ( $args['id'] === $this->args['id'] ) {
			$args         = parent::filter_control_args( $args, $wp_customize );
			$args['type'] = 'arrowpress-toggle';
		}

		return $args;
	}
}
