<?php
namespace ArrowTheme\Customizer\CSS;

use ArrowTheme\Customizer\Modules\CSS\Output;

class Background extends Output {

	protected function process_output( $output, $value ) {
		$output = wp_parse_args(
			$output,
			[
				'media_query' => 'global',
				'element'     => 'body',
				'prefix'      => '',
				'suffix'      => '',
			]
		);

		foreach ( [ 'background-image', 'background-color', 'background-repeat', 'background-position', 'background-size', 'background-attachment' ] as $property ) {
			if ( 'background-color' === $property && isset( $value['background-color'] ) && $value['background-color'] && ( ! isset( $value['background-image'] ) || empty( $value['background-image'] ) ) ) {
				$this->styles[ $output['media_query'] ][ $output['element'] ]['background'] = $output['prefix'] . $this->process_property_value( $property, $value[ $property ] ) . $output['suffix'];
			}

			if ( isset( $value[ $property ] ) && ! empty( $value[ $property ] ) ) {
				$this->styles[ $output['media_query'] ][ $output['element'] ][ $property ] = $output['prefix'] . $this->process_property_value( $property, $value[ $property ] ) . $output['suffix'];
			}
		}
	}
}
