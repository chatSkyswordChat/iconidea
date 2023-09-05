<?php
if ( ! class_exists( 'Apr_Core_Brand_Widget' ) ) {
	class Apr_Core_Brand_Widget extends Apr_Widget {
		public function __construct() {
			$this->widget_cssclass    = 'brand';
			$this->widget_description = esc_html__( 'Get list brands product.', 'apr-core' );
			$this->widget_id          = 'brand';
			$this->widget_name        = esc_html__( '[APR] Brands', 'apr-core' );
			parent::__construct();
		}
		public function widget( $args, $instance ) {
			static $first_dropdown = true;
			$before_widget 	= '<div id="brand-widget" class="widget brand">';
			$after_widget 	= '</div>';
			$before_title 	= '<h3 class="widget-title">';
			$after_title  	= '</h3>';
			$title 			= apply_filters('widget_title', $instance['title'] );
			$c = ! empty( $instance['count'] ) ? '1' : '0';
			$h = ! empty( $instance['hierarchical'] ) ? '1' : '0';
			$cat_args = array(
				'taxonomy'	=> 'yith_product_brand',
				'orderby'      => 'name',
				'show_count'   => $c,
				'hierarchical' => $h,
				'value_field'	=>'slug',
			);
			echo wp_kses_post( $args['before_widget']);
			if ( $instance['title'] ){
                echo wp_kses_post($args['before_title'] . esc_html($instance['title']) . $args['after_title']);
			}
			echo '<ul class="list-brand">';
					$cat_args['title_li'] = '';

					/**
					 * Filter the arguments for the Recipes Categories widget.
					 *
					 *
					 * @param array $cat_args An array of Recipes Categories widget options.
					 */
					wp_list_categories( apply_filters( 'widget_categories_args', $cat_args ) );
			echo '</ul>';
			echo wp_kses_post($args['after_widget']);
		}
		public function update( $new_instance, $old_instance ){
			$instance = $old_instance;
			$instance['title']   = strip_tags( $new_instance['title'] );
			$instance['count'] = !empty($new_instance['count']) ? 1 : 0;
			$instance['hierarchical'] = !empty($new_instance['hierarchical']) ? 1 : 0;
			return $instance;
		}
		public function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, array( 'title' => 'Brands') );
			$title = sanitize_text_field( $instance['title'] );
			$count = isset($instance['count']) ? (bool) $instance['count'] :false;
			$hierarchical = isset( $instance['hierarchical'] ) ? (bool) $instance['hierarchical'] : false;
			?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Widget Title', 'apr-core'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" style="width:100%;" />
			</p>
			<p>
			<input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>"<?php checked( $count ); ?> />
			<label for="<?php echo esc_attr($this->get_field_id('count')); ?>"><?php echo esc_html__( 'Show post counts', 'apr-core' ); ?></label><br />

			<input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id('hierarchical')); ?>" name="<?php echo esc_attr($this->get_field_name('hierarchical')); ?>"<?php checked( $hierarchical ); ?> />
			<label for="<?php echo esc_attr($this->get_field_id('hierarchical')); ?>"><?php echo esc_html__( 'Show hierarchy', 'apr-core' ); ?></label></p>
			<?php
		}
	}
}