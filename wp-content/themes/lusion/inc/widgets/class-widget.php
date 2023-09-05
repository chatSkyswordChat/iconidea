<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Abstract Widget Class
 *
 * @version  1.0
 * @extends  WP_Widget
 */
if ( ! class_exists( 'Apr_Widget' ) ) {
	abstract class Apr_Widget extends WP_Widget {
		/**
		 * CSS class.
		 *
		 * @var string
		 */
		public $widget_cssclass;
		/**
		 * Widget description.
		 *
		 * @var string
		 */
		public $widget_description;
		/**
		 * Widget ID.
		 *
		 * @var string
		 */
		public $widget_id;
		/**
		 * Widget name.
		 *
		 * @var string
		 */
		public $widget_name;
		/**
		 * Settings.
		 *
		 * @var array
		 */
		public $settings;

		/**
		 * Constructor.
		 */
		public function __construct() {
			$widget_ops = array(
				'classname'                   => $this->widget_cssclass,
				'description'                 => $this->widget_description,
				'customize_selective_refresh' => true,
			);
			parent::__construct( $this->widget_id, $this->widget_name, $widget_ops );
		}

		/**
		 * Output the html at the start of a widget.
		 *
		 * @param array $args
		 *
		 */
		public function widget_start( $args, $instance ) {
			$before_widget = '<div class="widget %2$s">';
			echo '' . $args['before_widget'];

			if ( $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base ) ) {
				echo '' . $args['before_title'] . $title . $args['after_title'];
			}
		}

		/**
		 * Output the html at the end of a widget.
		 *
		 * @param array $args
		 *
		 */
		public function widget_end( $args ) {
			if ( isset( $args['after_widget'] ) && ! empty( $args['after_widget'] ) ) {
				echo '' . $args['after_widget'];
			}
		}

		/**
		 * Updates a particular instance of a widget.
		 *
		 * @param array $new_instance
		 * @param array $old_instance
		 *
		 * @return array
		 * @see    WP_Widget->update
		 *
		 */
		public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			if ( empty( $this->settings ) ) {
				return $instance;
			}
			// Loop settings and get values to save.
			foreach ( $this->settings as $key => $setting ) {
				if ( ! isset( $setting['type'] ) ) {
					continue;
				}
				// Format the value based on settings type.
				switch ( $setting['type'] ) {
					case 'number' :
						$instance[$key] = absint( $new_instance[$key] );
						if ( isset( $setting['min'] ) && '' !== $setting['min'] ) {
							$instance[$key] = max( $instance[$key], $setting['min'] );
						}
						if ( isset( $setting['max'] ) && '' !== $setting['max'] ) {
							$instance[$key] = min( $instance[$key], $setting['max'] );
						}
						break;
					case 'textarea' :
						$instance[$key] = wp_kses( trim( wp_unslash( $new_instance[$key] ) ), wp_kses_allowed_html( 'post' ) );
						break;
					case 'checkbox' :
						$instance[$key] = empty( $new_instance[$key] ) ? 0 : 1;
						break;
					default:
						$instance[$key] = sanitize_text_field( $new_instance[$key] );
						break;
				}
				/**
				 * Sanitize the value of a setting.
				 */
				$instance[$key] = apply_filters( 'insight_widget_settings_sanitize_option', $instance[$key], $new_instance, $key, $setting );
			}

			return $instance;
		}

		/**
		 * Outputs the settings update form.
		 *
		 * @param array $instance
		 *
		 * @return null
		 * @see   WP_Widget->form
		 *
		 */
		public function form( $instance ) {
			if ( empty( $this->settings ) ) {
				return;
			}
			foreach ( $this->settings as $key => $setting ) {
				$class = isset( $setting['class'] ) ? $setting['class'] : '';
				$value = isset( $instance[$key] ) ? $instance[$key] : $setting['std'];
				switch ( $setting['type'] ) {
					case 'text' :
						?>
						<p>
							<label
								for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo esc_html( $setting['label'] ); ?></label>
							<input class="widefat <?php echo esc_attr( $class ); ?>"
								   id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"
								   name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" type="text"
								   value="<?php echo esc_attr( $value ); ?>"/>
							<?php if ( isset( $setting['desc'] ) ) : ?>
								<?php echo "<small>{$setting['desc']}</small>"; ?>
							<?php endif; ?>
						</p>
						<?php
						break;
					case 'number' :
						?>
						<p>
							<label
								for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo esc_html( $setting['label'] ); ?></label>
							<input class="widefat <?php echo esc_attr( $class ); ?>"
								   id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"
								   name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" type="number"
								   step="<?php echo esc_attr( $setting['step'] ); ?>"
								   min="<?php echo esc_attr( $setting['min'] ); ?>"
								   max="<?php echo esc_attr( $setting['max'] ); ?>"
								   value="<?php echo esc_attr( $value ); ?>"/>
							<?php if ( isset( $setting['desc'] ) ) : ?>
								<?php echo "<small>{$setting['desc']}</small>"; ?>
							<?php endif; ?>
						</p>
						<?php
						break;
					case 'select' :
						?>
						<p>
							<label
								for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo esc_html( $setting['label'] ); ?></label>
							<select class="widefat <?php echo esc_attr( $class ); ?>"
									id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"
									name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>">
								<?php foreach ( $setting['options'] as $option_key => $option_value ) : ?>
									<option
										value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $value ); ?>><?php echo esc_html( $option_value ); ?></option>
								<?php endforeach; ?>
							</select>
							<?php if ( isset( $setting['desc'] ) ) : ?>
								<?php echo "<small>{$setting['desc']}</small>"; ?>
							<?php endif; ?>
						</p>
						<?php
						break;
					case 'textarea' :
						?>
						<p>
							<label
								for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo esc_html( $setting['label'] ); ?></label>
							<textarea class="widefat <?php echo esc_attr( $class ); ?>"
									  id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"
									  name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" cols="20"
									  rows="3"><?php echo esc_textarea( $value ); ?></textarea>
							<?php if ( isset( $setting['desc'] ) ) : ?>
								<?php echo "<small>{$setting['desc']}</small>"; ?>
							<?php endif; ?>
						</p>
						<?php
						break;
					case 'checkbox' :
						?>
						<p>
							<input class="checkbox <?php echo esc_attr( $class ); ?>"
								   id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"
								   name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" type="checkbox"
								   value="1" <?php checked( $value, 1 ); ?> />
							<label
								for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo esc_html( $setting['label'] ); ?></label>
							<?php if ( isset( $setting['desc'] ) ) : ?>
								<?php echo "<small>{$setting['desc']}</small>"; ?>
							<?php endif; ?>
						</p>
						<?php
						break;
					// Default: run an action.
					default :
						do_action( 'insight_widget_field_' . $setting['type'], $key, $value, $setting, $instance );
						break;
				}
			}
		}
	}
}


/**
 * Extra class to widget
 * -----------------------------------------------------------------------------
 */
add_action( 'widgets_init', array( 'Apr_Widget_Attributes', 'setup' ) );

class Apr_Widget_Attributes {
	const VERSION = '0.2.2';

	/**
	 * Initialize plugin
	 */
	public static function setup() {
		if ( is_admin() ) {
			// Add necessary input on widget configuration form
			add_action( 'in_widget_form', array( __CLASS__, '_input_fields' ), 10, 3 );

			// Save widget attributes
			add_filter( 'widget_update_callback', array( __CLASS__, '_save_attributes' ), 10, 4 );
		} else {
			// Insert attributes into widget markup
			add_filter( 'dynamic_sidebar_params', array( __CLASS__, '_insert_attributes' ) );
		}
	}


	/**
	 * Inject input fields into widget configuration form
	 *
	 * @param object $widget Widget object
	 *
	 * @return NULL
	 * @since   0.1
	 * @wp_hook action in_widget_form
	 *
	 */
	public static function _input_fields( $widget, $return, $instance ) {
		$instance = self::_get_attributes( $instance );
		?>
		<p>
			<?php printf(
				'<label for="%s">%s</label>',
				esc_attr( $widget->get_field_id( 'widget-class' ) ),
				esc_html__( 'Extra Class', 'lusion' )
			) ?>
			<?php printf(
				'<input type="text" class="widefat" id="%s" name="%s" value="%s" />',
				esc_attr( $widget->get_field_id( 'widget-class' ) ),
				esc_attr( $widget->get_field_name( 'widget-class' ) ),
				esc_attr( $instance['widget-class'] )
			) ?>
		</p>
		<?php
		return null;
	}

	/**
	 * Get default attributes
	 *
	 * @param array $instance Widget instance configuration
	 *
	 * @return array
	 * @since 0.1
	 *
	 */
	private static function _get_attributes( $instance ) {
		$instance = wp_parse_args(
			$instance,
			array(
				'widget-class' => '',
			)
		);

		return $instance;
	}

	/**
	 * Save attributes upon widget saving
	 *
	 * @param array  $instance     Current widget instance configuration
	 * @param array  $new_instance New widget instance configuration
	 * @param array  $old_instance Old Widget instance configuration
	 * @param object $widget       Widget object
	 *
	 * @return array
	 * @since   0.1
	 * @wp_hook filter widget_update_callback
	 *
	 */
	public static function _save_attributes( $instance, $new_instance, $old_instance, $widget ) {
		$instance['widget-class'] = '';

		// Classes
		if ( ! empty( $new_instance['widget-class'] ) ) {
			$instance['widget-class'] = apply_filters(
				'widget_attribute_classes',
				implode(
					' ',
					array_map(
						'sanitize_html_class',
						explode( ' ', $new_instance['widget-class'] )
					)
				)
			);
		} else {
			$instance['widget-class'] = '';
		}

		return $instance;
	}

	/**
	 * Insert attributes into widget markup
	 *
	 * @param array $params Widget parameters
	 *
	 * @return Array
	 * @since  0.1
	 * @filter dynamic_sidebar_params
	 *
	 */
	public static function _insert_attributes( $params ) {
		global $wp_registered_widgets;

		$widget_id  = $params[0]['widget_id'];
		$widget_obj = $wp_registered_widgets[$widget_id];

		if (
			! isset( $widget_obj['callback'][0] )
			|| ! is_object( $widget_obj['callback'][0] )
		) {
			return $params;
		}

		$widget_options = get_option( $widget_obj['callback'][0]->option_name );
		if ( empty( $widget_options ) ) {
			return $params;
		}

		$widget_num = $widget_obj['params'][0]['number'];
		if ( empty( $widget_options[$widget_num] ) ) {
			return $params;
		}

		$instance = $widget_options[$widget_num];

		// Classes
		if ( ! empty( $instance['widget-class'] ) ) {
			$params[0]['before_widget'] = preg_replace(
				'/class="/',
				sprintf( 'class="%s ', $instance['widget-class'] ),
				$params[0]['before_widget'],
				1
			);
		}

		return $params;
	}
}
