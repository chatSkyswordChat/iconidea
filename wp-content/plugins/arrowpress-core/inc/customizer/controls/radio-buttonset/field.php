<?php
namespace ArrowTheme\Customizer\Field;

if ( ! class_exists( '\ArrowTheme\Customizer\Field\Radio' ) ) {
	require_once ARROWPRESS_CUSTOMIZER_DIR . '/controls/radio/field.php';
}

class Radio_Buttonset extends Radio {

	public $type = 'arrowpress-radio-buttonset';

	protected $control_class = '\ArrowTheme\Customizer\Control\Radio_Buttonset';

	public function filter_control_args( $args, $wp_customize ) {
		if ( $args['id'] === $this->args['id'] ) {
			$args         = parent::filter_control_args( $args, $wp_customize );
			$args['type'] = 'arrowpress-radio-buttonset';
		}
		return $args;
	}
}
