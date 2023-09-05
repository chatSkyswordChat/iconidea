<?php
if ( ! class_exists( 'Apr_Core_Contact_Widget' ) ) {
	class Apr_Core_Contact_Widget extends Apr_Widget {
		public function __construct() {
			$this->widget_cssclass    = 'tm-contact-widget';
			$this->widget_description = esc_html__( 'Get list contact info.', 'apr-core' );
			$this->widget_id          = 'tm-contact-widget';
			$this->widget_name        = esc_html__( '[APR] Contact', 'apr-core' );
			parent::__construct();
		}
		public function widget( $args, $instance ) {
			$before_widget 	= '<div  class="widget tm-contact-widget">';
			$after_widget 	= '</div>';
			$before_title 	= '<h2 class="widget-title">';
			$after_title  	= '</h2>';
			$title 			= apply_filters('widget_title', $instance['title'] );
			$desc        	= isset( $instance['desc'] ) ? $instance['desc'] : $this->settings['desc']['std'];
			$address        = isset( $instance['address'] ) ? $instance['address'] : $this->settings['address']['std'];
			$phone          = isset( $instance['phone'] ) ? $instance['phone'] : $this->settings['phone']['std'];
			$mail           = isset( $instance['mail'] ) ? $instance['mail'] : $this->settings['mail']['std'];
			$time           = isset( $instance['time'] ) ? $instance['time'] : $this->settings['time']['std'];
			$output         = '';
			echo wp_kses_post( $args['before_widget']);
			if ( $instance['title'] ){
                echo wp_kses_post($args['before_title'] . esc_html($instance['title']) . $args['after_title']);
			}?>
			<?php if($desc!=''): ?>
                <?php 
					echo '<p class="contact-desc">'. esc_html($desc) .'</p>';
                ?>
            <?php endif; ?>
			<ul class="list-info-contact">
				<?php if($address!=''): ?>
                    <li class="info-address">
                    	<i class="theme-icon-pin"></i>
                        <div class="info-content">
                            <?php 
								echo '<p>'. esc_html($address) .'</p>';
                            ?>
                        </div>
                    </li>
                <?php endif; ?>
				<?php if($mail!=''): ?>
                    <li class="info-mail">
                    	<i class="theme-icon-envelope"></i>
                        <div class="info-content">
                        	<?php 
								echo '<a href="mailto:' . esc_html($mail).'">'.esc_html($mail) . '</a>';           	
                            ?>
                        </div>
                    </li>
				<?php endif;?>
				<?php if($phone!=''): ?>
                    <li class="info-phone">
						<i class="theme-icon-call"></i>
                        <div class="info-content">
                            <?php 
                             echo '<a href="tel:' . str_replace(" ", "", $phone).'">'.esc_html($phone) . '</a>';
                            ?>
                        </div>
                    </li>
				<?php endif; ?>
				<?php if($time!=''): ?>
					<li class="info-time"> 
						<i class="theme-icon-nine-oclock-on-circular-clock"></i>
						 <div class="info-content">
							<?php 
								echo '<p>'. esc_html($time) .'</p>';
							?>
						</div>
					</li>
				<?php endif;?>
			</ul>
			<?php 
			echo wp_kses_post($args['after_widget']);
		}
		public function update( $new_instance, $old_instance ){
			$instance = $old_instance;
			$instance['title']   = strip_tags( $new_instance['title'] );
			$instance['desc']    = strip_tags( $new_instance['desc'] );
			$instance['address'] = strip_tags( $new_instance['address'] );
			$instance['phone'] 	 = strip_tags( $new_instance['phone'] );
			$instance['mail'] 	 = strip_tags( $new_instance['mail'] );
			$instance['time'] 	 = strip_tags( $new_instance['time'] );
			return $instance;
		}
		public function form($instance){

			$defaults = array( 
				'title'          => 'Quick contacts',
				'desc' 			 => '',
				'address'        => '924/1 Cummerata Mission, Los Angeles, USA, Inc - 4852',
				'phone'          => '+8 (800) 123 4589',
				'mail'           => 'lusion@gmail.com',
				'time'           => 'Monday: 13:00-18:00',
			);
			$instance = wp_parse_args( (array) $instance, $defaults );
		?>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Widget Title', 'apr-core'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'desc' )); ?>"><?php esc_html_e('Desc', 'apr-core'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'desc' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'desc' )); ?>" value="<?php echo esc_attr($instance['desc']); ?>" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'address' )); ?>"><?php esc_html_e('Address', 'apr-core'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'address' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'address' )); ?>" value="<?php echo esc_attr($instance['address']); ?>" style="width:100%;" />
			</p>
			<p >
				<label for="<?php echo esc_attr($this->get_field_id( 'phone' )); ?>"><?php esc_html_e('Phone Number', 'apr-core'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'phone' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'phone' )); ?>" value="<?php echo esc_attr($instance['phone']); ?>" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'mail' )); ?>"><?php esc_html_e('Email', 'apr-core'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'mail' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'mail' )); ?>" value="<?php echo esc_attr($instance['mail']); ?>" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'time' )); ?>"><?php esc_html_e('Time', 'apr-core'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'time' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'time' )); ?>" value="<?php echo esc_attr($instance['time']); ?>" style="width:100%;" />
			</p>	
		<?php
		}
	}
}