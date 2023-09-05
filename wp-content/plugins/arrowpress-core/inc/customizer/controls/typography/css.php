<?php
namespace ArrowTheme\Customizer\CSS;

use ArrowTheme\Customizer\Modules\CSS\Output;

class Typography extends Output {

	protected function process_output( $output, $value ) {
		$output['media_query'] = ( isset( $output['media_query'] ) ) ? $output['media_query'] : 'global';
		$output['element']     = ( isset( $output['element'] ) ) ? $output['element'] : 'body';
		$output['prefix']      = ( isset( $output['prefix'] ) ) ? $output['prefix'] : '';
		$output['suffix']      = ( isset( $output['suffix'] ) ) ? $output['suffix'] : '';
		
		$properties = [
			'font-family',
			'font-size',
			'variant',
			'font-weight',
			'font-style',
			'letter-spacing',
			'word-spacing',
			'line-height',
			'text-align',
			'text-transform',
			'text-decoration',
			'color',
			'margin-top',
			'margin-bottom',
		];

		foreach ( $properties as $property ) {
			if ( ! isset( $this->field['default'][ $property ] ) ) {
				continue;
			}

			if ( ! isset( $value[ $property ] ) || ! $value[ $property ] ) {
				continue;
			}

			if ( isset( $output['choice'] ) && $output['choice'] !== $property ) {
				continue;
			}

			if ( 'variant' === $property && isset( $value['variant'] ) && ! empty( $value['variant'] ) ) {
				$font_weight = str_replace( 'italic', '', $value['variant'] );
				$font_weight = ( in_array( $font_weight, [ '', 'regular' ], true ) ) ? '400' : $font_weight;

				$is_italic = ( false !== strpos( $value['variant'], 'italic' ) );

				$this->styles[ $output['media_query'] ][ $output['element'] ]['font-weight'] = $font_weight;

				if ( $is_italic ) {
					$this->styles[ $output['media_query'] ][ $output['element'] ]['font-style'] = 'italic';
				}

				continue;
			}
			
			$property_value = $this->process_property_value( $property, $value[ $property ] );
			$property       = ( isset( $output['choice'] ) && isset( $output['property'] ) ) ? $output['property'] : $property;
			$property_value = ( is_array( $property_value ) && isset( $property_value[0] ) ) ? $property_value[0] : $property_value;
			
			$this->styles[ $output['media_query'] ][ $output['element'] ][ $property ] = $output['prefix'] . $property_value . $output['suffix'];
		}

	}
}
