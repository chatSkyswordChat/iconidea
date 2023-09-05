<?php
namespace ArrowTheme\Customizer\Control;

use ArrowTheme\Customizer\Modules\Base;

defined( 'ABSPATH' ) || exit;

class Multicheck extends Base {

	public $type = 'arrowpress-multicheck';

	public static $control_ver = '1.0';
	
	protected function content_template() {
		?>
		<# if ( ! data.choices ) { return; } #>

		<# if ( data.label ) { #><span class="customize-control-title">{{{ data.label }}}</span><# } #>
		<# if ( data.description ) { #><span class="description customize-control-description">{{{ data.description }}}</span><# } #>

		<ul>
			<# for ( key in data.choices ) { #>
				<li><label<# if ( _.contains( data.value, key ) ) { #> class="checked"<# } #>><input {{{ data.inputAttrs }}} type="checkbox" value="{{ key }}"<# if ( _.contains( data.value, key ) ) { #> checked<# } #> />{{ data.choices[ key ] }}</label></li>
			<# } #>
		</ul>
		<?php
	}
}
