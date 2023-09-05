<?php
namespace ArrowTheme\Customizer\Control;

use ArrowTheme\Customizer\Modules\Base;

class Sortable extends Base {

	public $type = 'arrowpress-sortable';

	protected function content_template() {
		?>
		<label class='arrowpress-sortable'>
			<span class="customize-control-title">
				{{{ data.label }}}
			</span>
			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } #>

			<ul class="sortable">
				<# _.each( data.value, function( choiceID ) { #>
					<# if ( data.choices[ choiceID ] ) { #>
						<li {{{ data.inputAttrs }}} class='arrowpress-sortable-item' data-value='{{ choiceID }}'>
							<i class='dashicons dashicons-menu'></i>
							<i class="dashicons dashicons-visibility visibility"></i>
							{{{ data.choices[ choiceID ] }}}
						</li>
					<# } #>
				<# }); #>
				<# _.each( data.choices, function( choiceLabel, choiceID ) { #>
					<# if ( -1 === data.value.indexOf( choiceID ) ) { #>
						<li {{{ data.inputAttrs }}} class='arrowpress-sortable-item invisible' data-value='{{ choiceID }}'>
							<i class='dashicons dashicons-menu'></i>
							<i class="dashicons dashicons-visibility visibility"></i>
							{{{ data.choices[ choiceID ] }}}
						</li>
					<# } #>
				<# }); #>
			</ul>
		</label>
		<?php
	}
}
