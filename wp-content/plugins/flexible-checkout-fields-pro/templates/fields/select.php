<?php
/**
 * This template can be overridden by copying it to yourtheme/flexible-checkout-fields/fields/select.php
 *
 * @var string   $key               Field ID.
 * @var mixed[]  $args              Custom attributes for field.
 * @var mixed    $value             Field value.
 * @var string[] $custom_attributes .
 *
 * @package Flexible Checkout Fields PRO
 */

?>
<p class="form-row <?php echo esc_attr( $args['class'] ); ?>"
	id="<?php echo esc_attr( $key ); ?>_field"
	data-priority="<?php echo esc_attr( $args['priority'] ); ?>"
	data-fcf-field="<?php echo esc_attr( $key ); ?>">
	<label for="<?php echo esc_attr( $key ); ?>">
		<?php echo wp_kses_post( $args['label'] ); ?>
		<?php if ( $args['required'] ) : ?>
			<abbr class="required"
				title="<?php echo esc_attr( __( 'Required Field', 'flexible-checkout-fields-pro' ) ); ?>">*</abbr>
		<?php endif; ?>
	</label>
	<span class="woocommerce-input-wrapper">
		<select
			class="select"
			name="<?php echo esc_attr( $key ); ?>"
			id="<?php echo esc_attr( $key ); ?>"
			data-fcf-field-input="<?php echo esc_attr( $key ); ?>"
			<?php foreach ( $custom_attributes as $attr_key => $attr_value ) : ?>
				<?php echo esc_attr( $attr_key ); ?>="<?php echo esc_attr( $attr_value ); ?>"
			<?php endforeach; ?>
			data-placeholder="<?php echo esc_html( $args['placeholder'] ); ?>">
			<option value=""><?php echo esc_html( $args['placeholder'] ); ?></option>
			<?php foreach ( $args['options'] as $option_data ) : ?>
				<option value="<?php echo esc_attr( $option_data['key'] ); ?>"
					<?php echo ( $value == $option_data['key'] ) ? 'selected' : ''; ?>>
					<?php echo esc_html( $option_data['value'] ); ?>
				</option>
			<?php endforeach; ?>
		</select>
	</span>
</p>
