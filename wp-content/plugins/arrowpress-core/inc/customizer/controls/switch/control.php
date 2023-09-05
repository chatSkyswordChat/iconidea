<?php
namespace ArrowTheme\Customizer\Control;

use ArrowTheme\Customizer\Modules\Base;

defined( 'ABSPATH' ) || exit;

class Checkbox_Switch extends Base {

	public $type = 'arrowpress-switch';

	public function to_json() {
		parent::to_json();

		$this->json['checkboxType'] = str_ireplace( 'arrowpress-', '', $this->type );

		$this->json['defaultChoices'] = array(
			'on'  => 'On',
			'off' => 'Off',
		);
	}

	protected function content_template() {
		?>

		<div class="arrowpress-{{ data.checkboxType }}-control arrowpress-{{ data.checkboxType }}">
			<# if ( data.label || data.description ) { #>
				<div class="arrowpress-control-label">
					<# if ( data.label ) { #>
						<label class="customize-control-title" for="arrowpress_{{ data.checkboxType }}_{{ data.id }}">
							{{{ data.label }}}
						</label>
					<# } #>

					<# if ( data.description ) { #>
						<span class="description customize-control-description">{{{ data.description }}}</span>
					<# } #>
					</div>
			<# } #>

			<div class="arrowpress-control-form">
				<input class="screen-reader-text arrowpress-toggle-switch-input" {{{ data.inputAttrs }}} name="arrowpress_{{ data.checkboxType }}_{{ data.id }}" id="arrowpress_{{ data.checkboxType }}_{{ data.id }}" type="checkbox" value="{{ data.value }}" {{{ data.link }}}<# if ( '1' == data.value ) { #> checked<# } #> />
				<label class="arrowpress-toggle-switch-label" for="arrowpress_{{ data.checkboxType }}_{{ data.id }}">
					<# if ('switch' === data.checkboxType) { #>
						<span class="toggle-on">
							<# data.choices.on = data.choices.on || data.defaultChoices.on #>
							{{ data.choices.on }}
						</span>
						<span class="toggle-off">
							<# data.choices.off = data.choices.off || data.defaultChoices.off #>
							{{ data.choices.off }}
						</span>
					<# } #>
				</label>
			</div>
		</div>

		<?php
	}
}
