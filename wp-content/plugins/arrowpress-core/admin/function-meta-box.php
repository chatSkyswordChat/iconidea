<?php
/**
 * Output a text input box.
 *
 * @param array $field
 */
function arrowpress_meta_box_text_input_field( $field ) {
	global $thepostid, $post;

	$thepostid              = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['placeholder']   = isset( $field['placeholder'] ) ? $field['placeholder'] : '';
	$field['class']         = isset( $field['class'] ) ? $field['class'] : 'short';
	$field['style']         = isset( $field['style'] ) ? $field['style'] : '';
	$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
	$field['default']       = ( ! get_post_meta( $thepostid, $field['id'], true ) && isset( $field['default'] ) ) ? $field['default'] : get_post_meta( $thepostid, $field['id'], true );
	$field['value']         = isset( $field['value'] ) && $field['value'] !== false ? $field['value'] : $field['default'];
	$field['name']          = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['type']          = isset( $field['type'] ) ? $field['type'] : 'text';
	$field['desc_tip']      = isset( $field['desc_tip'] ) ? $field['desc_tip'] : false;
	$field['hidden']        = isset( $field['hidden'] ) ? $field['hidden'] : false;
	$data_type              = empty( $field['data_type'] ) ? '' : $field['data_type'];

	// Custom attribute handling
	$custom_attributes = array();

	if ( ! empty( $field['custom_attributes'] ) && is_array( $field['custom_attributes'] ) ) {
		foreach ( $field['custom_attributes'] as $attribute => $value ) {
			$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $value ) . '"';
		}
	}

	echo '<div class="form-field ' . esc_attr( $field['id'] ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '" data-hide="' . esc_attr( ! empty( $field['hidden'] ) ? htmlentities( wp_json_encode( $field['hidden'] ) ) : '' ) . '">
		<label for="' . esc_attr( $field['id'] ) . '">' . wp_kses_post( $field['label'] ) . '</label>';
	echo '<div class="section-row-right">';
	echo '<input type="' . esc_attr( $field['type'] ) . '" class="' . esc_attr( $field['class'] ) . '" style="' . esc_attr( $field['style'] ) . '" name="' . esc_attr( $field['name'] ) . '" id="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $field['value'] ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" ' . implode( ' ', $custom_attributes ) . ' /> ';

	if ( ! empty( $field['description'] ) && false === $field['desc_tip'] ) {
		echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
	}

	echo '</div>';
	echo '</div>';
}

/**
 * Output a textarea input box.
 *
 * @param array $field
 */
function arrowpress_meta_box_textarea_field( $field ) {
	global $thepostid, $post;

	$thepostid              = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['placeholder']   = isset( $field['placeholder'] ) ? $field['placeholder'] : '';
	$field['class']         = isset( $field['class'] ) ? $field['class'] : 'short';
	$field['style']         = isset( $field['style'] ) ? $field['style'] : '';
	$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
	$field['default']       = ( ! get_post_meta( $thepostid, $field['id'], true ) && isset( $field['default'] ) ) ? $field['default'] : get_post_meta( $thepostid, $field['id'], true );
	$field['value']         = isset( $field['value'] ) && $field['value'] !== false ? $field['value'] : $field['default'];
	$field['desc_tip']      = isset( $field['desc_tip'] ) ? $field['desc_tip'] : false;
	$field['name']          = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['rows']          = isset( $field['rows'] ) ? $field['rows'] : 2;
	$field['cols']          = isset( $field['cols'] ) ? $field['cols'] : 20;
	$field['hidden']        = isset( $field['hidden'] ) ? $field['hidden'] : false;

	// Custom attribute handling
	$custom_attributes = array();
	if ( ! empty( $field['custom_attributes'] ) && is_array( $field['custom_attributes'] ) ) {
		foreach ( $field['custom_attributes'] as $attribute => $value ) {
			$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $value ) . '"';
		}
	}

	echo '<div class="form-field ' . esc_attr( $field['id'] ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '" data-hide="' . esc_attr( ! empty( $field['hidden'] ) ? htmlentities( wp_json_encode( $field['hidden'] ) ) : '' ) . '">
		<label for="' . esc_attr( $field['id'] ) . '">' . wp_kses_post( $field['label'] ) . '</label>';
	echo '<div class="section-row-right">';

	echo '<textarea class="' . esc_attr( $field['class'] ) . '" style="' . esc_attr( $field['style'] ) . '"  name="' . esc_attr( $field['name'] ) . '" id="' . esc_attr( $field['id'] ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" rows="' . esc_attr( $field['rows'] ) . '" cols="' . esc_attr( $field['cols'] ) . '" ' . implode( ' ', $custom_attributes ) . '>' . esc_textarea( $field['value'] ) . '</textarea> ';

	if ( ! empty( $field['description'] ) && false === $field['desc_tip'] ) {
		echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
	}

	echo '</div>';
	echo '</div>';
}

/**
 * Output a checkbox input box.
 *
 * @param array $field
 */
function arrowpress_meta_box_checkbox_field( $field ) {
	global $thepostid, $post;

	$thepostid              = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['class']         = isset( $field['class'] ) ? $field['class'] : 'checkbox';
	$field['style']         = isset( $field['style'] ) ? $field['style'] : '';
	$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
	$field['default']       = ( ! get_post_meta( $thepostid, $field['id'], true ) && isset( $field['default'] ) ) ? $field['default'] : get_post_meta( $thepostid, $field['id'], true );
	$field['value']         = isset( $field['value'] ) && $field['value'] !== false ? $field['value'] : $field['default'];
	// save db with value is id
	if ( isset( $field['id_value'] ) && $field['id_value'] ) {
		$field['cbvalue'] = isset( $field['cbvalue'] ) ? $field['cbvalue'] : $field['id'];
	} else {
		$field['cbvalue'] = isset( $field['cbvalue'] ) ? $field['cbvalue'] : 1;
	}
	$field['name']     = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['desc_tip'] = isset( $field['desc_tip'] ) ? $field['desc_tip'] : false;
	$field['hidden']   = isset( $field['hidden'] ) ? $field['hidden'] : false;

	// Custom attribute handling
	$custom_attributes = array();
	if ( ! empty( $field['custom_attributes'] ) && is_array( $field['custom_attributes'] ) ) {
		foreach ( $field['custom_attributes'] as $attribute => $value ) {
			$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $value ) . '"';
		}
	}

	echo '<div class="form-field ' . esc_attr( $field['id'] ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '" data-hide="' . esc_attr( ! empty( $field['hidden'] ) ? htmlentities( wp_json_encode( $field['hidden'] ) ) : '' ) . '">
		<label for="' . esc_attr( $field['id'] ) . '">' . wp_kses_post( $field['label'] ) . '</label>';
	echo '<div class="section-row-right field-checkbox">';
	echo '<input type="checkbox" class="' . esc_attr( $field['class'] ) . '" style="' . esc_attr( $field['style'] ) . '" name="' . esc_attr( $field['name'] ) . '" id="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $field['cbvalue'] ) . '" ' . checked( $field['value'], $field['cbvalue'], false ) . '  ' . implode( ' ', $custom_attributes ) . '/> <label for="' . esc_attr( $field['id'] ) . '" data-on="ON" data-off="OFF"></label>';

	if ( ! empty( $field['description'] ) && false === $field['desc_tip'] ) {
		echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
	}

	echo '</div>';
	echo '</div>';
}

/**
 * Output a select input box.
 *
 * @param array $field Data about the field to render.
 */
function arrowpress_meta_box_select_field( $field ) {
	global $thepostid, $post;

	$thepostid = empty( $thepostid ) ? $post->ID : $thepostid;
	$default   = ( ! get_post_meta( $thepostid, $field['id'], true ) && isset( $field['default'] ) ) ? $field['default'] : get_post_meta( $thepostid, $field['id'], true );

	$field = wp_parse_args(
		$field,
		array(
			'class'             => 'select',
			'style'             => '',
			'wrapper_class'     => '', // Use "arrowpress-select-2" for select2.
			'value'             => isset( $field['value'] ) && $field['value'] !== false ? $field['value'] : $default,
			'name'              => $field['id'],
			'desc_tip'          => false,
			'multiple'          => false,
			'custom_attributes' => array(),
		)
	);

	$label_attributes = array(
		'for' => $field['id'],
	);

	$field_attributes          = (array) $field['custom_attributes'];
	$field_attributes['style'] = $field['style'];
	$field_attributes['id']    = $field['id'];
	$field_attributes['name']  = $field['name'];
	$field_attributes['class'] = $field['class'];

	if ( $field['multiple'] ) {
		$field_attributes['multiple'] = true;
	}

	$tooltip     = ! empty( $field['description'] ) && false !== $field['desc_tip'] ? $field['description'] : '';
	$description = ! empty( $field['description'] ) && false === $field['desc_tip'] ? $field['description'] : '';
	?>

	<div class="form-field <?php echo esc_attr( $field['id'] ) . '_field ' . esc_attr( $field['wrapper_class'] ); ?>">
		<label for="<?php echo esc_attr( $field['id'] ); ?>"><?php echo wp_kses_post( $field['label'] ); ?></label>
		<div class="section-row-right">
			<select <?php echo arrowpress_implode_html_attributes( $field_attributes ); ?>>
				<?php
				foreach ( $field['options'] as $key => $value ) {
					echo '<option value="' . esc_attr( $key ) . '"' . selected( $key, $field['value'], false ) . '>' . esc_html( $value ) . '</option>';
				}
				?>
			</select>

			<?php if ( $description ) : ?>
				<span class="description"><?php echo wp_kses_post( $description ); ?></span>
			<?php endif; ?>
		</div>
	</div>
	<?php
}

/**
 * Output a radio input box.
 *
 * @param array $field
 */
function arrowpress_meta_box_radio_field( $field ) {
	global $thepostid, $post;

	$thepostid              = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['class']         = isset( $field['class'] ) ? $field['class'] : 'select';
	$field['style']         = isset( $field['style'] ) ? $field['style'] : '';
	$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
	$field['default']       = ( ! get_post_meta( $thepostid, $field['id'], true ) && isset( $field['default'] ) ) ? $field['default'] : get_post_meta( $thepostid, $field['id'], true );
	$field['value']         = isset( $field['value'] ) && $field['value'] !== false ? $field['value'] : $field['default'];
	$field['name']          = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['desc_tip']      = isset( $field['desc_tip'] ) ? $field['desc_tip'] : false;
	$field['hidden']        = isset( $field['hidden'] ) ? $field['hidden'] : false;

	echo '<div class="form-field ' . esc_attr( $field['id'] ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '" data-hide="' . esc_attr( ! empty( $field['hidden'] ) ? htmlentities( wp_json_encode( $field['hidden'] ) ) : '' ) . '"><h4>' . wp_kses_post( $field['label'] ) . '</h4>';
	echo '<div class="section-row-right">';
	echo '<ul class="arrowpress-radios-field-meta-box">';

	foreach ( $field['options'] as $key => $value ) {
		echo '<li><label><input
					name="' . esc_attr( $field['name'] ) . '"
					value="' . esc_attr( $key ) . '"
					type="radio"
					class="' . esc_attr( $field['class'] ) . '"
					style="' . esc_attr( $field['style'] ) . '"
					' . checked( esc_attr( $field['value'] ), esc_attr( $key ), false ) . '
					/> ' . ( $value ) . '</label>
			</li>';
	}
	echo '</ul>';

	if ( ! empty( $field['description'] ) && false === $field['desc_tip'] ) {
		echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
	}

	echo '</div>';
	echo '</div>';
}


function arrowpress_meta_box_file_input_field( $field ) {
	global $thepostid, $post;

	$thepostid              = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['class']         = isset( $field['class'] ) ? $field['class'] : 'short';
	$field['style']         = isset( $field['style'] ) ? $field['style'] : '';
	$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
	$field['name']          = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['mime_type']     = isset( $field['mime_type'] ) ? implode( ',', $field['mime_type'] ) : '';
	$field['multil']        = ( isset( $field['multil'] ) && $field['multil'] ) ? true : false;
	$field['image_url']     = ( isset( $field['image_url'] ) && $field['image_url'] ) ? true : false;
	$field['desc_tip']      = isset( $field['desc_tip'] ) ? $field['desc_tip'] : false;
	$field['hidden']        = isset( $field['hidden'] ) ? $field['hidden'] : false;

	$field['default'] = ( ! get_post_meta( $thepostid, $field['id'], true ) && isset( $field['default'] ) ) ? $field['default'] : get_post_meta( $thepostid, $field['id'], true );

	$field['value'] = isset( $field['value'] ) && $field['value'] !== false ? $field['value'] : $field['default'];

	// Custom attribute handling
	$custom_attributes = array();

	if ( ! empty( $field['custom_attributes'] ) && is_array( $field['custom_attributes'] ) ) {
		foreach ( $field['custom_attributes'] as $attribute => $value ) {
			$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $value ) . '"';
		}
	}

	echo '<div class="form-field ' . esc_attr( $field['id'] ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '" data-hide="' . esc_attr( ! empty( $field['hidden'] ) ? htmlentities( wp_json_encode( $field['hidden'] ) ) : '' ) . '">
		<label for="' . esc_attr( $field['id'] ) . '">' . wp_kses_post( $field['label'] ) . '</label>';

	echo '<div id="' . esc_attr( $field['id'] ) . '" class="arrowpress-meta-box__file ' . esc_attr( $field['class'] )
		. '" data-mime="' . $field['mime_type'] . '" data-multil="' . $field['multil'] . '" data-img_url = "'.$field['image_url'] .'" style="' .
		esc_attr( $field['style'] ) . '" ' . implode( ' ', $custom_attributes ) . '>';
	echo '<ul class="arrowpress-meta-box__file_list">';

	if ( ! empty( $field['value'] ) ) {
		if ( $field['image_url'] && ! is_numeric( $field['value'] ) ) {
			echo '<li class="arrowpress-meta-box__file_list-item image">';
			echo '<img class="is_file" src="' . $field['value'] . '" />';
			echo '<ul class="actions"><li><a href="#" class="delete"></a></li></ul>';
			echo '</li>';
		} else {
			foreach ( (array) $field['value'] as $attachment_id ) {

				$url = wp_get_attachment_url( $attachment_id );

				if ( $url ) {
					$check_file = wp_check_filetype( $url );
					// update database url image
					echo '<li class="arrowpress-meta-box__file_list-item image" data-attachment_id="' . $attachment_id . '">';

					if ( in_array( $check_file['ext'], array( 'jpg', 'png', 'gif', 'bmp', 'tif' ), true ) ) {
						echo wp_get_attachment_image( $attachment_id, 'thumbnail' );
					} else {
						echo '<img class="is_file" src="' . wp_mime_type_icon( $check_file['type'] ) . '" />';
						echo '<span>' . wp_basename( get_attached_file( $attachment_id ) ) . '</span>';
					}
					echo '<ul class="actions"><li><a href="#" class="delete"></a></li></ul>';
					echo '</li>';

				}
			}
		}
	}
	echo '</ul>';

	echo '<input class="arrowpress-meta-box__file_input" type="hidden" name="' . esc_attr( $field['id'] ) . '" value="' .
		esc_attr(
			( ! empty( $field['value'] ) && is_array( $field['value'] ) ) ? json_encode( $field['value'] ) :
				$field['value']
		) . '" />';
	echo '<p>';
	echo '<a href="#" class="button btn-upload">' . esc_html__( '+ Add media', 'learnpress' ) . '</a>';
	echo '</p>';

	if ( ! empty( $field['description'] ) && false === $field['desc_tip'] ) {
		echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
	}
	echo '</div>';
	echo '</div>';
}

/**
 * Output a duration input box.
 *
 * @param array $field
 */
function arrowpress_meta_box_duration_field( $field ) {
	global $thepostid, $post;

	$thepostid              = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['placeholder']   = isset( $field['placeholder'] ) ? $field['placeholder'] : '';
	$field['class']         = isset( $field['class'] ) ? $field['class'] : 'short';
	$field['style']         = isset( $field['style'] ) ? $field['style'] : '';
	$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
	$field['default']       = ( ! get_post_meta( $thepostid, $field['id'], true ) && isset( $field['default'] ) ) ? $field['default'] : get_post_meta( $thepostid, $field['id'], true );
	$field['value']         = isset( $field['value'] ) && $field['value'] !== false ? $field['value'] : $field['default'];
	$field['name']          = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['desc_tip']      = isset( $field['desc_tip'] ) ? $field['desc_tip'] : false;
	$field['hidden']        = isset( $field['hidden'] ) ? $field['hidden'] : false;
	$data_type              = empty( $field['data_type'] ) ? '' : $field['data_type'];
	$duration               = learn_press_get_course_duration_support();

	$duration_keys = array_keys( $duration );
	$default_time  = ! empty( $field['default_time'] ) ? $field['default_time'] : end( $duration_keys );

	if ( preg_match_all( '!([0-9]+)\s*(' . join( '|', $duration_keys ) . ')?!', $field['value'], $matches ) ) {
		$a1 = $matches[1][0];
		$a2 = in_array( $matches[2][0], $duration_keys ) ? $matches[2][0] : $default_time;
	} else {
		$a1 = absint( $field['value'] );
		$a2 = $default_time;
	}

	// Custom attribute handling
	$custom_attributes = array();

	if ( ! empty( $field['custom_attributes'] ) && is_array( $field['custom_attributes'] ) ) {
		foreach ( $field['custom_attributes'] as $attribute => $value ) {
			$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $value ) . '"';
		}
	}

	$html_option = '';
	foreach ( $duration as $k => $v ) {
		$html_option .= sprintf( '<option value="%s" %s>%s</option>', $k, selected( $k, $a2, false ), $v );
	}

	echo '<div class="arrowpress-meta-box__duration form-field ' . esc_attr( $field['id'] ) . '_field ' . esc_attr(
			$field['wrapper_class']
		) . '" data-hide="' . esc_attr( ! empty( $field['hidden'] ) ? htmlentities( wp_json_encode( $field['hidden'] ) ) : '' ) . '">
		<label for="' . esc_attr( $field['id'] ) . '">' . wp_kses_post( $field['label'] ) . '</label>';
	echo '<div class="section-row-right">';
	echo '<input type="number" class="' . esc_attr( $field['class'] ) . '" style="' . esc_attr( $field['style'] ) . '" name="' . esc_attr( $field['name'] ) . '[]" id="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $a1 ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" ' . implode( ' ', $custom_attributes ) . ' /> ';

	echo '<select name="' . esc_attr( $field['name'] ) . '[]" class="arrowpress-meta-box__duration-select">' . $html_option . '</select>';

	if ( ! empty( $field['description'] ) && false === $field['desc_tip'] ) {
		echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
	}

	echo '</div>';
	echo '</div>';
}

function arrowpress_meta_box_color_input_field( $field ) {
	global $thepostid, $post;

	$thepostid              = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['placeholder']   = isset( $field['placeholder'] ) ? $field['placeholder'] : '';
	$field['class']         = isset( $field['class'] ) ? $field['class'] : 'short';
	$field['style']         = isset( $field['style'] ) ? $field['style'] : 'width: 6em;';
	$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
	$field['default']       = ( ! get_post_meta( $thepostid, $field['id'], true ) && isset( $field['default'] ) ) ? $field['default'] : get_post_meta( $thepostid, $field['id'], true );
	$field['value']         = isset( $field['value'] ) && $field['value'] !== false ? $field['value'] : $field['default'];
	$field['name']          = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['desc_tip']      = isset( $field['desc_tip'] ) ? $field['desc_tip'] : false;
	$field['hidden']        = isset( $field['hidden'] ) ? $field['hidden'] : false;
	$field['alpha']         = isset( $field['alpha'] ) ? $field['alpha'] : false;
	$data_type              = empty( $field['data_type'] ) ? '' : $field['data_type'];

	// Custom attribute handling
	$custom_attributes = array();

	if ( ! empty( $field['custom_attributes'] ) && is_array( $field['custom_attributes'] ) ) {
		foreach ( $field['custom_attributes'] as $attribute => $value ) {
			$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $value ) . '"';
		}
	}

	if ( $field['alpha'] ) {
		$custom_attributes[] = 'data-alpha-enabled="true"';
	}

	wp_enqueue_script( 'arrowpress-wp-color-picker-alpha' );

	echo '<div class="form-field arrowpress-meta-box__color ' . esc_attr( $field['id'] ) . '_field ' . esc_attr(
			$field['wrapper_class']
		) . '" data-hide="' . esc_attr( ! empty( $field['hidden'] ) ? htmlentities( wp_json_encode( $field['hidden'] ) ) : '' ) . '">
		<label for="' . esc_attr( $field['id'] ) . '">' . wp_kses_post( $field['label'] ) . '</label>';
	echo '<div class="section-row-right apr-meta-color">';
	echo '<input type="text" class="arrowpress-meta-box__color--input ' . esc_attr( $field['class'] ) . '" style="' . esc_attr( $field['style'] ) . '" name="' . esc_attr( $field['name'] ) . '" id="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $field['value'] ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" dir="ltr" ' . implode( ' ', $custom_attributes ) . ' /> ';

	if ( ! empty( $field['description'] ) && false === $field['desc_tip'] ) {
		echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
	}

	echo '</div>';
	echo '</div>';
}

function arrowpress_meta_box_image_select_field( $field ) {
	global $thepostid, $post;

	$thepostid              = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['class']         = isset( $field['class'] ) ? $field['class'] : 'short';
	$field['style']         = isset( $field['style'] ) ? $field['style'] : '';
	$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
	$field['default']       = ( ! get_post_meta( $thepostid, $field['id'], true ) && isset( $field['default'] ) ) ? $field['default'] : get_post_meta( $thepostid, $field['id'], true );
	$field['value']         = isset( $field['value'] ) && $field['value'] !== false ? $field['value'] : $field['default'];
	$field['name']          = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['options']       = isset( $field['options'] ) ? $field['options'] : false;
	$field['desc_tip']      = isset( $field['desc_tip'] ) ? $field['desc_tip'] : false;
	$field['hidden']        = isset( $field['hidden'] ) ? $field['hidden'] : false;
	$data_type              = empty( $field['data_type'] ) ? '' : $field['data_type'];

	// Custom attribute handling
	$custom_attributes = array();

	if ( ! empty( $field['custom_attributes'] ) && is_array( $field['custom_attributes'] ) ) {
		foreach ( $field['custom_attributes'] as $attribute => $value ) {
			$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $value ) . '"';
		}
	}

	echo '<div class="form-field ' . esc_attr( $field['id'] ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '" data-hide="' . esc_attr( ! empty( $field['hidden'] ) ? htmlentities( wp_json_encode( $field['hidden'] ) ) : '' ) . '">
		<label for="' . esc_attr( $field['id'] ) . '">' . wp_kses_post( $field['label'] ) . '</label>';
	echo '<div class="section-row-right">';
	if ( $field['options'] ) {
		echo '<div class="arrowpress-meta-box__' . $field['type'] . '">';
		foreach ( $field['options'] as $key => $img ) {
			echo '<label class="arrowpress-meta-box__image_select--radio ' . esc_attr( $field['class'] ) . '" style="' . esc_attr( $field['style'] ) . '" ' . implode( ' ', $custom_attributes ) . '>';
			echo '<input type="radio"  name="' . esc_attr( $field['name'] ) . '" id="' . esc_attr( $field['id'] ) . '" value="' . esc_attr( $key ) . '" ' . checked( esc_attr( $field['value'] ), esc_attr( $key ), false ) . ' /> ';
			if ( $field['type'] == 'button_set' ) {
				echo '<span>' . esc_attr( $img ) . '</span>';
			} else {
				echo '<img src="' . esc_url( $img ) . '" alt="' . $key . '" />';
			}

			echo '</label>';
		}
		echo '</div>';
	}

	if ( ! empty( $field['description'] ) && false === $field['desc_tip'] ) {
		echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
	}
	echo '</div>';
	echo '</div>';
}

function arrowpress_implode_html_attributes( $raw_attributes ) {
	$attributes = array();
	foreach ( $raw_attributes as $name => $value ) {
		$attributes[] = esc_attr( $name ) . '="' . esc_attr( $value ) . '"';
	}

	return implode( ' ', $attributes );
}


/**
 * Output a wysiwyg field.
 *
 * @param array $field
 */
function arrowpress_meta_box_wysiwyg_field( $field ) {

	global $thepostid, $post;

	$thepostid              = empty( $thepostid ) ? $post->ID : $thepostid;
	$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : 'arrowpress-wysiwyg-wrapper';
	$field['default']       = ( ! get_post_meta( $thepostid, $field['id'], true ) && isset( $field['default'] ) ) ? $field['default'] : get_post_meta( $thepostid, $field['id'], true );
	$field['value']         = isset( $field['value'] ) && $field['value'] !== false ? $field['value'] : $field['default'];
	$field['name']          = isset( $field['name'] ) ? $field['name'] : $field['id'];
	$field['type']          = isset( $field['type'] ) ? $field['type'] : 'wysiwyg';
	$field['desc_tip']      = isset( $field['desc_tip'] ) ? $field['desc_tip'] : false;
	$field['hidden']        = isset( $field['hidden'] ) ? $field['hidden'] : false;

	wp_enqueue_editor();
	echo '<div class="form-field ' . esc_attr( $field['id'] ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '" data-hide="' . esc_attr( ! empty( $field['hidden'] ) ? htmlentities( wp_json_encode( $field['hidden'] ) ) : '' ) . '">
		<label for="' . esc_attr( $field['id'] ) . '">' . wp_kses_post( $field['label'] ) . '</label>';
	echo '<div class="section-row-right">';
	wp_editor(
		$field['value'],
		esc_attr( $field['id'] ),
		array(
			'textarea_rows' => 20,
		)
	);

	if ( ! empty( $field['description'] ) && false === $field['desc_tip'] ) {
		echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
	}

	echo '</div>';
	echo '</div>';
}
