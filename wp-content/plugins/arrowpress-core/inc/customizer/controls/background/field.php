<?php
namespace ArrowTheme\Customizer\Field;

use ArrowTheme\Customizer\Modules\Field;

class Background extends Field {

	public $type = 'arrowpress-background';

	public function init( $args ) {
		$args['required']     = isset( $args['required'] ) ? (array) $args['required'] : [];
		$args['arrowpress_config'] = isset( $args['arrowpress_config'] ) ? $args['arrowpress_config'] : 'global';

		new \ArrowTheme\Customizer\Field\Generic(
			wp_parse_args(
				[
					'type'              => 'arrowpress-generic',
					'default'           => '',
					'choices'           => [
						'type'        => 'hidden',
						'parent_type' => 'arrowpress-background',
					],
					'sanitize_callback' => [ '\ArrowTheme\Customizer\Field\Background', 'sanitize' ],
				],
				$args
			)
		);

		$args['parent_setting'] = $args['id'];
		$args['output']         = [];
		$args['wrapper_attrs']  = [
			'data-arrowpress-parent-control-type' => 'arrowpress-background',
		];

		if ( isset( $args['transport'] ) && 'auto' === $args['transport'] ) {
			$args['transport'] = 'postMessage';
		}

		$default_bg_color = isset( $args['default']['background-color'] ) ? $args['default']['background-color'] : '';

		/**
		 * Background Color.
		 */
		new \ArrowTheme\Customizer\Field\Color(
			wp_parse_args(
				[
					'id'    => $args['id'] . '[background-color]',
					'label'       => '',
					'description' => 'Background Color',
					'default'     => $default_bg_color,
					'section'     => $args['section'],
					'choices'     => [
						'alpha' => true,
					],
				],
				$args
			)
		);

		/**
		 * Background Image.
		 */
		new \ArrowTheme\Customizer\Field\Image(
			wp_parse_args(
				[
					'id'    => $args['id'] . '[background-image]',
					'label'       => '',
					'description' => 'Background Image',
					'default'     => isset( $args['default']['background-image'] ) ? $args['default']['background-image'] : '',
					'section'     => $args['section'],
				],
				$args
			)
		);

		/**
		 * Background Repeat.
		 */
		new \ArrowTheme\Customizer\Field\Select(
			wp_parse_args(
				[
					'id'    => $args['id'] . '[background-repeat]',
					'label'       => '',
					'description' => 'Background Repeat',
					'section'     => $args['section'],
					'default'     => isset( $args['default']['background-repeat'] ) ? $args['default']['background-repeat'] : '',
					'choices'     => [
						'no-repeat' => 'No Repeat',
						'repeat'    => 'Repeat All',
						'repeat-x'  => 'Repeat Horizontally',
						'repeat-y'  => 'Repeat Vertically',
					],
					'required'    => array_merge(
						$args['required'],
						[
							[
								'setting'  => $args['id'],
								'operator' => '!=',
								'value'    => '',
								'choice'   => 'background-image',
							],
						]
					),
				],
				$args
			)
		);

		/**
		 * Background Position.
		 */
		new \ArrowTheme\Customizer\Field\Select(
			wp_parse_args(
				[
					'id'    => $args['id'] . '[background-position]',
					'label'       => '',
					'description' => 'Background Position',
					'default'     => isset( $args['default']['background-position'] ) ? $args['default']['background-position'] : '',
					'section'     => $args['section'],
					'choices'     => [
						'left top'      => 'Left Top',
						'left center'   => 'Left Center',
						'left bottom'   => 'Left Bottom',
						'center top'    => 'Center Top',
						'center center' => 'Center Center',
						'center bottom' => 'Center Bottom',
						'right top'     => 'Right Top',
						'right center'  => 'Right Center',
						'right bottom'  => 'Right Bottom',
					],
					'required'    => array_merge(
						$args['required'],
						[
							[
								'setting'  => $args['id'],
								'operator' => '!=',
								'value'    => '',
								'choice'   => 'background-image',
							],
						]
					),
				],
				$args
			)
		);

		/**
		 * Background size.
		 */
		new \ArrowTheme\Customizer\Field\Radio_Buttonset(
			wp_parse_args(
				[
					'id'    => $args['id'] . '[background-size]',
					'label'       => '',
					'description' => 'Background Size',
					'default'     => isset( $args['default']['background-size'] ) ? $args['default']['background-size'] : '',
					'section'     => $args['section'],
					'choices'     => [
						'cover'   => 'Cover',
						'contain' => 'Contain',
						'auto'    => 'Auto',
					],
					'required'    => array_merge(
						$args['required'],
						[
							[
								'setting'  => $args['id'],
								'operator' => '!=',
								'value'    => '',
								'choice'   => 'background-image',
							],
						]
					),
				],
				$args
			)
		);

		/**
		 * Background attachment.
		 */
		new \ArrowTheme\Customizer\Field\Radio_Buttonset(
			wp_parse_args(
				[
					'id'    => $args['id'] . '[background-attachment]',
					'description' => 'Background Attachment',
					'label'       => '',
					'default'     => isset( $args['default']['background-attachment'] ) ? $args['default']['background-attachment'] : '',
					'section'     => $args['section'],
					'choices'     => [
						'scroll' => 'Scroll',
						'fixed'  => 'Fixed',
					],
					'required'    => array_merge(
						$args['required'],
						[
							[
								'setting'  => $args['id'],
								'operator' => '!=',
								'value'    => '',
								'choice'   => 'background-image',
							],
						]
					),
				],
				$args
			)
		);

		add_filter( 'arrowpress_customizer_output_control_classnames', [ $this, 'output_control_classnames' ] );
	}

	protected function set_sanitize_callback() {
		if ( ! empty( $this->sanitize_callback ) ) {
			return;
		}

		$this->sanitize_callback = [ '\ArrowTheme\Customizer\Field\Background', 'sanitize' ];
	}

	public static function sanitize( $value ) {
		if ( ! is_array( $value ) ) {
			return [];
		}

		$sanitized_value = [
			'background-color'      => '',
			'background-image'      => '',
			'background-repeat'     => '',
			'background-position'   => '',
			'background-size'       => '',
			'background-attachment' => '',
		];

		if ( isset( $value['background-color'] ) ) {
			$sanitized_value['background-color'] = \ArrowTheme\Customizer\Field\Color::sanitize( $value['background-color'] );
		}

		if ( isset( $value['background-image'] ) ) {
			$sanitized_value['background-image'] = esc_url_raw( $value['background-image'] );
		}

		if ( isset( $value['background-repeat'] ) ) {
			$sanitized_value['background-repeat'] = in_array(
				$value['background-repeat'],
				[
					'no-repeat',
					'repeat',
					'repeat-x',
					'repeat-y',
				],
				true
			) ? $value['background-repeat'] : '';
		}

		if ( isset( $value['background-position'] ) ) {
			$sanitized_value['background-position'] = in_array(
				$value['background-position'],
				[
					'left top',
					'left center',
					'left bottom',
					'center top',
					'center center',
					'center bottom',
					'right top',
					'right center',
					'right bottom',
				],
				true
			) ? $value['background-position'] : '';
		}

		if ( isset( $value['background-size'] ) ) {
			$sanitized_value['background-size'] = in_array(
				$value['background-size'],
				[
					'cover',
					'contain',
					'auto',
				],
				true
			) ? $value['background-size'] : '';
		}

		if ( isset( $value['background-attachment'] ) ) {
			$sanitized_value['background-attachment'] = in_array(
				$value['background-attachment'],
				[
					'scroll',
					'fixed',
				],
				true
			) ? $value['background-attachment'] : '';
		}

		return $sanitized_value;
	}

	protected function set_js_vars() {
		$this->js_vars = (array) $this->js_vars;

		if ( 'auto' !== $this->transport ) {
			return;
		}

		$this->transport = 'refresh';

		$js_vars = [];

		if ( empty( $this->js_vars ) && ! empty( $this->output ) ) {
			foreach ( $this->output as $output ) {
				if ( ! isset( $output['element'] ) ) {
					continue;
				}
				if ( is_array( $output['element'] ) ) {
					$output['element'] = implode( ',', $output['element'] );
				}
				if ( isset( $output['sanitize_callback'] ) && ! empty( $output['sanitize_callback'] ) ) {
					continue;
				}

				$js_vars[] = $output;
			}

			if ( count( $js_vars ) !== count( $this->output ) ) {
				return;
			}

			$this->js_vars   = $js_vars;
			$this->transport = 'postMessage';
		}
	}

	public function add_setting( $wp_customize ) {}

	public function add_control( $wp_customize ) {}

	public function output_control_classnames( $classnames ) {
		$classnames['arrowpress-background'] = '\ArrowTheme\Customizer\CSS\Background';

		return $classnames;
	}
}
