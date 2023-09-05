<?php

/**
 * Class ArrowPress_Core_Admin.
 *
 * @package   ArrowPress_Core
 * @since     0.1.0
 */
class Arrowpress_Metabox extends Arrowpress_Singleton {

	private static $saved_meta_boxes = false;

	/**
	 * Arrowpress_Metabox constructor.
	 *
	 * @since 0.1.0
	 */
	protected function __construct() {

		$this->includes();
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_meta_boxes' ), 1000, 2 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_script' ) );
	}

	public function add_meta_boxes() {
		$metaboxes = apply_filters( 'arrowpress_add_meta_boxes', array() );

		if ( ! empty( $metaboxes ) ) {
			foreach ( $metaboxes as $metabox ) {
				new Arrowpress_Add_Meta_Box( $metabox );
			}
		}
	}

	public function save_meta_boxes( $post_id, $post ) {
		$post_id = absint( $post_id );

		if ( empty( $post_id ) || empty( $post ) || self::$saved_meta_boxes ) {
			return;
		}

		if ( empty( $_POST['arrowpress_meta_box_nonce'] ) || ! wp_verify_nonce( wp_unslash( $_POST['arrowpress_meta_box_nonce'] ), 'arrowpress_save_meta_box' ) ) {
			return;
		}

		if ( empty( $_POST['post_ID'] ) || absint( $_POST['post_ID'] ) !== $post_id ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		self::$saved_meta_boxes = true;

		$metaboxes = apply_filters( 'arrowpress_add_meta_boxes', array() );

		if ( ! empty( $metaboxes ) ) {
			foreach ( $metaboxes as $metabox ) {
				$save = new Arrowpress_Add_Meta_Box( $metabox );
				$save->save_meta_box( $metabox, $post_id );
			}
		}

		do_action( 'arrowpress_core_save_metabox', $post_id, $post );
	}

	public function includes() {
		require_once ARROWPRESS_CORE_ADMIN_PATH . '/function-meta-box.php';
	}

	public function enqueue_script() {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style(
			'arrowpress_metabox', ARROWPRESS_CORE_ADMIN_URI . '/assets/css/metabox.min.css', array(),
			ARROWPRESS_CORE_VERSION

		);

		wp_register_script( 'arrowpress-wp-color-picker-alpha', ARROWPRESS_CORE_ADMIN_URI . '/assets/js/plugins/wp-color-picker-alpha.min.js', array( 'wp-color-picker' ), ARROWPRESS_CORE_VERSION );

		wp_enqueue_script( 'arrowpress_metabox', ARROWPRESS_CORE_ADMIN_URI . '/assets/js/metabox.min.js', array(
			'jquery', 'wp-color-picker'
		), ARROWPRESS_CORE_VERSION );

		$post_id = $this->get_post_id();
		$parent  = null;
		if ( $post_id ) {
			$post   = get_post( $post_id );
			$parent = $post->post_parent;
		}
		$data = array(
			'template'    => get_post_meta( $post_id, '_wp_page_template', true ),
			'post_format' => get_post_format( $post_id ),
			'parent'      => $parent,
		);

		wp_localize_script( 'arrowpress_metabox', 'MBShowHideData', $data );
	}

	public function get_post_id() {
		$post_id = null;
		if ( isset( $_GET['post'] ) ) {
			$post_id = intval( $_GET['post'] );
		} elseif ( isset( $_POST['post_ID'] ) ) {
			$post_id = intval( $_POST['post_ID'] );
		}

		return $post_id;
	}
}

class Arrowpress_Add_Meta_Box {
	public $metabox;

	public function __construct( $metabox ) {
		$this->metabox = $metabox;

		$this->add_meta_box( $metabox );
	}

	public function add_meta_box( $metabox ) {
		$id        = isset( $metabox['id'] ) ? $metabox['id'] : sanitize_title( $metabox['title'] );
		$post_type = isset( $metabox['post_types'] ) ? $metabox['post_types'] : null;
		$context   = isset( $metabox['context'] ) ? $metabox['context'] : 'normal';
		$priority  = isset( $metabox['priority'] ) ? $metabox['priority'] : 'default';

		add_meta_box( $id, $metabox['title'], array( $this, 'callback_meta_box' ), $post_type, $context, $priority );
	}

	public function general_meta_fields() {
		$meta_fields = array();

		return apply_filters( 'arrowpress_metabox_display_settings', $meta_fields );
	}

	public function callback_meta_box() {
		$metabox = $this->metabox;
		wp_nonce_field( 'arrowpress_save_meta_box', 'arrowpress_meta_box_nonce' );

		if ( isset( $metabox['tabs'] ) && $metabox['tabs'] ) {
			?>
			<div class="metabox-tabs-container">
				<div class="tab-bg"></div>
				<ul class="metabox-tabs" id="metabox-tabs">
					<?php foreach ( $metabox['fields'] as $meta_fields ) {
						?>
						<li>
							<a href="#<?php echo esc_attr( $meta_fields['id'] ); ?>"><?php echo esc_html( $meta_fields['title'] ); ?></a>
						</li>
					<?php } ?>
				</ul>
				<ul class="metabox-content">
					<?php
					foreach ( $metabox['fields'] as $list_meta ) {
						?>
						<li id="<?php echo esc_attr( $list_meta['id'] ); ?>"
							class="<?php echo 'meta-content-' . esc_attr( $list_meta['id'] ) ?>">
							<?php
							if ( $list_meta['fields'] ) {
								foreach ( $list_meta['fields'] as $meta_field ) {
									$this->display( $meta_field );
								}
							} ?>
						</li>
					<?php } ?>
				</ul>
			</div>
		<?php } else { ?>
			<div class="metabox-tabs-container arrowpress-meta-box"
				 data-show="<?php echo isset( $metabox['show'] ) ? htmlentities( wp_json_encode( $metabox['show'] ) ) : ''; ?>">
				<div class="arrowpress-meta-box__inner">
					<div class="metabox-content">
						<?php
						if ( $metabox['fields'] ) {
							foreach ( $metabox['fields'] as $field ) {
								$this->display( $field );
							}
						}
						?>
					</div>
				</div>
			</div>
			<?php
		}
	}

	public function save_meta_box( $meta_boxes, $post_id ) {
		if ( ! empty( $meta_boxes['fields'] ) ) {
			if ( isset( $meta_boxes['tabs'] ) && $meta_boxes['tabs'] ) {
				foreach ( $meta_boxes['fields'] as $meta_box ) {
					foreach ( $meta_box['fields'] as $setting ) {
						$this->save_field_meta_box( $setting, $post_id );
					}
				}
			} else {
				foreach ( $meta_boxes['fields'] as $setting ) {
					$this->save_field_meta_box( $setting, $post_id );
				}
			}
		}
	}

	public function save_field_meta_box( $setting, $post_id ) {
		$field = $this->normalize_setting( $setting );
		switch ( $field['type'] ) {
			case 'text':
			case 'number':
			case 'textarea':
			case 'select':

			case 'image_select':
			case 'button_set':
				$text = isset( $_POST[$field['id']] ) ? wp_unslash( $_POST[$field['id']] ) : '';
				if ( $text ) {
					update_post_meta( $post_id, $field['id'], $text );
				} else {
					delete_post_meta( $post_id, $field['id'], $text );
				}

				break;

			case 'checkbox':
				$checkbox = isset( $_POST[$field['id']] ) ? 1 : 0;
				// save database value is id
				if(isset($field['id_value']) && $field['id_value']){
					$checkbox = isset( $_POST[$field['id']] ) ? $field['id'] : '';
				}

				if ( $checkbox ) {
					update_post_meta( $post_id, $field['id'], $checkbox );
				} else {
					delete_post_meta( $post_id, $field['id'], $checkbox );
				}

				break;

			case 'duration':
				$duration = isset( $_POST[$field['id']][0] ) && $_POST[$field['id']][0] !== '' ? implode( ' ', wp_unslash( $_POST[$field['id']] ) ) : '0 minute';
				update_post_meta( $post_id, $field['id'], $duration );
				break;

			case 'image_advanced':
				if ( isset( $field['max_file_uploads'] ) && $field['max_file_uploads'] > 1 ) {
					$image_advanced = isset( $_POST[$field['id']] ) ? wp_unslash( array_filter( explode( ',', $_POST[$field['id']] ) ) ) : array();
				} else {
					$image_advanced = isset( $_POST[$field['id']] ) ? wp_unslash( $_POST[$field['id']] ) : '';
				}
				if ( $image_advanced ) {
					update_post_meta( $post_id, $field['id'], $image_advanced );
				} else {
					delete_post_meta( $post_id, $field['id'], $image_advanced );
				}
				break;
			case 'group':
				if ( isset( $field['fields'] ) ) {
					$this->save_meta_box( $field, $post_id );
				}
				break;

			default:
				$default = isset( $_POST[$field['id']] ) ? wp_unslash( $_POST[$field['id']] ) : '';
				if ( $default ) {
					update_post_meta( $post_id, $field['id'], $default );
				} else {
					delete_post_meta( $post_id, $field['id'], $default );
				}
		}
	}

	public function display( $field ) {
		$field = $this->normalize_setting( $field );

		switch ( $field['type'] ) {
			case 'text':
			case 'number':
			case 'url':
				arrowpress_meta_box_text_input_field(
					array(
						'id'                => $field['id'],
						'label'             => isset( $field['label'] ) ? $field['label'] : $field['name'],
						'description'       => isset( $field['description'] ) ? $field['description'] : $field['desc'],
						'type'              => $field['type'],
						'default'           => isset( $field['default'] ) ? $field['default'] : $field['std'],
						'hidden'            => isset( $field['hidden'] ) ? $field['hidden'] : false,
						'custom_attributes' => isset( $field['custom_attributes'] ) ? $field['custom_attributes'] : '',
					)
				);
				break;

			case 'textarea':
				arrowpress_meta_box_textarea_field(
					array(
						'id'                => $field['id'],
						'label'             => isset( $field['label'] ) ? $field['label'] : $field['name'],
						'description'       => isset( $field['description'] ) ? $field['description'] : $field['desc'],
						'default'           => isset( $field['default'] ) ? $field['default'] : $field['std'],
						'custom_attributes' => isset( $field['custom_attributes'] ) ? $field['custom_attributes'] : '',
						'hidden'            => isset( $field['hidden'] ) ? $field['hidden'] : false,
					)
				);
				break;

			case 'checkbox':
				arrowpress_meta_box_checkbox_field(
					array(
						'id'          => $field['id'],
						'label'       => isset( $field['label'] ) ? $field['label'] : $field['name'],
						'description' => isset( $field['description'] ) ? $field['description'] : $field['desc'],
						'default'     => isset( $field['default'] ) ? $field['default'] : $field['std'],
						'hidden'      => isset( $field['hidden'] ) ? $field['hidden'] : false,
						'id_value'      => isset( $field['id_value'] ) ? $field['id_value'] : false,
					)
				);
				break;

			case 'duration':
				arrowpress_meta_box_duration_field(
					array(
						'id'                => $field['id'],
						'label'             => isset( $field['label'] ) ? $field['label'] : $field['name'],
						'default_time'      => $field['default_time'],
						'description'       => isset( $field['description'] ) ? $field['description'] : $field['desc'],
						'default'           => isset( $field['default'] ) ? $field['default'] : $field['std'],
						'custom_attributes' => isset( $field['custom_attributes'] ) ? $field['custom_attributes'] : '',
						'hidden'            => isset( $field['hidden'] ) ? $field['hidden'] : false,
					)
				);
				break;

			case 'select':
				arrowpress_meta_box_select_field(
					array(
						'id'                => $field['id'],
						'label'             => isset( $field['label'] ) ? $field['label'] : $field['name'],
						'default'           => isset( $field['default'] ) ? $field['default'] : $field['std'],
						'description'       => isset( $field['description'] ) ? $field['description'] : $field['desc'],
						'options'           => $field['options'],
						'custom_attributes' => isset( $field['custom_attributes'] ) ? $field['custom_attributes'] : '',
						'hidden'            => isset( $field['hidden'] ) ? $field['hidden'] : false,
					)
				);
				break;

			case 'select_advanced':
				arrowpress_meta_box_select_field(
					array(
						'id'                => $field['id'],
						'label'             => isset( $field['label'] ) ? $field['label'] : $field['name'],
						'default'           => isset( $field['default'] ) ? $field['default'] : $field['std'],
						'description'       => isset( $field['description'] ) ? $field['description'] : $field['desc'],
						'options'           => $field['options'],
						'multiple'          => true,
						'wrapper_class'     => 'arrowpress-select-2',
						'style'             => 'min-width: 200px',
						'custom_attributes' => isset( $field['custom_attributes'] ) ? $field['custom_attributes'] : '',
						'hidden'            => isset( $field['hidden'] ) ? $field['hidden'] : false,
					)
				);
				break;

			case 'image_advanced':
				arrowpress_meta_box_file_input_field(
					array(
						'id'                => $field['id'],
						'label'             => isset( $field['label'] ) ? $field['label'] : $field['name'],
						'default'           => isset( $field['default'] ) ? $field['default'] : $field['std'],
						'description'       => isset( $field['description'] ) ? $field['description'] : $field['desc'],
						'multil'            => ( isset( $field['max_file_uploads'] ) && absint( $field['max_file_uploads'] ) > 1 ) ? true : false,
						'image_url'         => ( isset( $field['max_file_uploads'] ) && absint(
								$field['max_file_uploads']
							) > 1 ) ? false : true,
						'custom_attributes' => isset( $field['custom_attributes'] ) ? $field['custom_attributes'] : '',
						'hidden'            => isset( $field['hidden'] ) ? $field['hidden'] : false,
					)
				);
				break;

			case 'color':
				arrowpress_meta_box_color_input_field(
					array(
						'id'                => $field['id'],
						'label'             => isset( $field['label'] ) ? $field['label'] : $field['name'],
						'default'           => isset( $field['default'] ) ? $field['default'] : $field['std'],
						'description'       => isset( $field['description'] ) ? $field['description'] : $field['desc'],
						'custom_attributes' => isset( $field['custom_attributes'] ) ? $field['custom_attributes'] : '',
						'hidden'            => isset( $field['hidden'] ) ? $field['hidden'] : false,
						'alpha'             => isset( $field['alpha'] ) ? $field['alpha'] : true,
					)
				);
				break;
			case 'button_set':
			case 'image_select':
				arrowpress_meta_box_image_select_field(
					array(
						'id'                => $field['id'],
						'type'              => $field['type'],
						'label'             => isset( $field['label'] ) ? $field['label'] : $field['name'],
						'default'           => isset( $field['default'] ) ? $field['default'] : $field['std'],
						'description'       => isset( $field['description'] ) ? $field['description'] : $field['desc'],
						'options'           => isset( $field['options'] ) ? $field['options'] : false,
						'custom_attributes' => isset( $field['custom_attributes'] ) ? $field['custom_attributes'] : '',
						'hidden'            => isset( $field['hidden'] ) ? $field['hidden'] : false,
					)
				);
				break;


			case 'group':
				if ( isset( $field['fields'] ) ) {
					foreach ( $field['fields'] as $g_fields ) {
						$this->display( $g_fields );
					}
				}
				break;

			case 'wysiwyg':
				arrowpress_meta_box_wysiwyg_field(
					array(
						'id'          => $field['id'],
						'label'       => isset( $field['label'] ) ? $field['label'] : $field['name'],
						'description' => isset( $field['description'] ) ? $field['description'] : $field['desc'],
						'type'        => $field['type'],
						'hidden'      => isset( $field['hidden'] ) ? $field['hidden'] : false,
					)
				);
				break;
		}
	}

	public function normalize_setting( $setting ) {
		$setting = wp_parse_args(
			$setting,
			array(
				'id'   => '',
				'name' => '',
				'desc' => '',
				'std'  => '',
			)
		);

		return $setting;
	}
}
