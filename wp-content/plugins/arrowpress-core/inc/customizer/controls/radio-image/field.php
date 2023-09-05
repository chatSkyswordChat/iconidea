<?php
namespace ArrowTheme\Customizer\Field;

if ( ! class_exists( '\ArrowTheme\Customizer\Field\Radio' ) ) {
	require_once ARROWPRESS_CUSTOMIZER_DIR . '/controls/radio/field.php';
}

class Radio_Image extends Radio {

	public $type = 'arrowpress-radio-image';

	protected $control_class = '\ArrowTheme\Customizer\Control\Radio_Image';

	public function filter_control_args( $args, $wp_customize ) {
		if ( $args['id'] === $this->args['id'] ) {
			$args         = parent::filter_control_args( $args, $wp_customize );
			$args['type'] = 'arrowpress-radio-image';
		}
		
		return $args;
	}
}
