<?php
if ( ! class_exists( 'Apr_Core_Social_Widget' ) ) {
	class Apr_Core_Social_Widget extends Apr_Widget {
		public function __construct() {
			$this->widget_cssclass    = 'tm-social-widget';
			$this->widget_description = esc_html__( 'Get list social info.', 'apr-core' );
			$this->widget_id          = 'tm-social-widget';
			$this->widget_name        = esc_html__( '[APR] Social', 'apr-core' );
			parent::__construct();
		}
		public function widget( $args, $instance ) {
			$before_widget = '<div class="widget tm-social-widget">';
			$after_widget  = '</div>';
			$before_title  = '<h2 class="widget-title">';
			$after_title   ='</h2>';
			$title 		   = isset($instance['title'])?apply_filters('widget_title', $instance['title'] ):'';
			$desc_title     = isset( $instance['desc_title'] ) ? $instance['desc_title'] : $this->settings['desc_title']['std'];
			$facebook 	   = isset($instance['facebook'])?$instance['facebook']:'';
			$twitter 	   = isset($instance['twitter'])? $instance['twitter']:'';
			$instagram     = isset($instance['instagram'])? $instance['instagram']:'';
			$pinterest     = isset($instance['pinterest'])? $instance['pinterest']:'';
			$google        = isset($instance['google']) ? $instance['google']: '';
			$linkedin      = isset($instance['linkedin']) ? $instance['linkedin'] : '';
			$youtube       = isset($instance['youtube']) ? $instance['youtube'] :'';
			$dribble        = isset($instance['dribble']) ? $instance['dribble'] :'';
            $behance        = isset($instance['behance']) ? $instance['behance'] :'';
            $gmail        = isset($instance['gmail']) ? $instance['gmail'] :'';
            $rss        = isset($instance['rss']) ? $instance['rss'] :'';
			$output        = '';
			$show_social   = Lusion::setting( "show_social" );
			echo wp_kses_post( $args['before_widget']);
			if ( $instance['title'] ){
                echo wp_kses_post($args['before_title'] . esc_html($instance['title']) . $args['after_title']);
			}?>
			<?php if($desc_title!=''){?>
				<p class="title-desc">
					<?php echo esc_attr($desc_title); ?>
				</p>
				<?php
			}
				echo '<ul class="footer-social-networks">';
					if($facebook != ''){
						echo '<li class="fb"><a href="' . esc_attr($facebook) . '"><i class="theme-icon-facebook"></i><span class="label">' . esc_html__("Facebook", "apr-core") . '</span></a> </li>';
					}
					if($twitter != ''){
						echo '<li class="tw"><a href="' . esc_attr($twitter) .'"><i class="theme-icon-twitter"></i><span class="label">' . esc_html__("Twitter", "apr-core") . '</span></a> </li>';
					}
					if($google != ''){
						echo '<li class="gg"><a href="'.esc_attr($google) .'"><i class="theme-icon-google-hangouts"></i><span class="label">' . esc_html__("Google +", "apr-core") . '</span></a> </li>';
					}
					if($instagram != ''){
						echo '<li class="insta"><a href="' . esc_attr($instagram). '"><i class="theme-icon-instagram"></i><span class="label">' . esc_html__("Instagram", "apr-core") . '</span></a> </li>';
					}
					if($pinterest != ''){
						echo '<li class="pin"><a href="'. esc_attr($pinterest). '"><i class="theme-icon-pinterest" aria-hidden="true"></i><span class="label">' . esc_html__("Pinterest", "apr-core") . '</span></a> </li>';
					}
					if($linkedin != ''){
						echo '<li class="linkedin"><a href="' . esc_attr($linkedin) . '"><i class="fab fa-linkedin"><span class="label">' . esc_html__("Linkedin", "apr-core") . '</span></i></a> </li>';
					}
					if($youtube != ''){
						echo '<li class="yt"><a href="' . esc_attr($youtube).'"><i class="fab fa-youtube"></i><span class="label">' . esc_html__("Youtobe", "apr-core") . '</span></a> </li>';
					}
					if($dribble != ''){
						echo '<li class="dribble"><a href="' . esc_attr($dribble).'"><i class="fab fa-dribbble"></i><span class="label">' . esc_html__("Dribble", "apr-core") . '</span></a> </li>';
					}
					if($behance != ''){
						echo '<li class="behance"><a href="' . esc_attr($behance).'"><i class="fab fa-behance"></i><span class="label">' . esc_html__("Behance", "apr-core") . '</span></a> </li>';
					}
					if($gmail != ''){
						echo '<li class="gmail"><a href="' . esc_attr($gmail).'"><i class="theme-icon-gmail"></i><span class="label">' . esc_html__("Gmail", "apr-core") . '</span></a> </li>';
					}
					if($rss != ''){
						echo '<li class="rss"><a href="' . esc_attr($rss).'"><i class="theme-icon-rss"></i><span class="label">' . esc_html__("Rss", "apr-core") . '</span></a> </li>';
					}
			echo '</ul>';
			echo wp_kses_post($args['after_widget']);
		}
		public function update( $new_instance, $old_instance ){
			$instance = $old_instance;
			$instance['title'] 		= strip_tags( $new_instance['title'] );
			$instance['desc_title'] = strip_tags( $new_instance['desc_title'] );
			$instance['facebook'] 	= strip_tags( $new_instance['facebook'] );
			$instance['twitter']    = strip_tags( $new_instance['twitter'] );
			$instance['instagram'] 	= strip_tags( $new_instance['instagram'] );
			$instance['pinterest'] 	= strip_tags( $new_instance['pinterest'] );
			$instance['google'] 	= strip_tags( $new_instance['google'] );
			$instance['linkedin'] 	= strip_tags( $new_instance['linkedin'] );
			$instance['youtube'] 	= strip_tags( $new_instance['youtube'] );
			$instance['dribble'] 	= strip_tags( $new_instance['dribble'] );
			$instance['behance'] 	= strip_tags( $new_instance['behance'] );
			$instance['gmail'] 		= strip_tags( $new_instance['gmail'] );
			$instance['rss'] 		= strip_tags( $new_instance['rss'] );
			return $instance;
		}
		public function form($instance){
			$defaults = array( 
				'title' 	=> 'Follow us',
				'desc_title'=> '',
				'facebook' 	=> '#',
				'twitter' 	=> '#',
				'google' 	=> '#',
				'instagram' => '',
				'pinterest' => '',
				'linkedin' 	=> '',
				'youtube' 	=> '',
				'dribble' 	=> '',
				'behance' 	=> '',
				'gmail' 	=> '',
				'rss' 	=> '',

			);
			$instance = wp_parse_args( (array) $instance, $defaults );
		?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Widget Title', 'apr-core'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" style="width:100%;" />
			</p>
			<p >
				<label for="<?php echo esc_attr($this->get_field_id( 'desc_title' )); ?>"><?php esc_html_e('Description Title', 'apr-core'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'desc_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'desc_title' )); ?>" value="<?php echo esc_attr($instance['desc_title']); ?>" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'facebook' )); ?>"><?php esc_html_e('Facebook', 'apr-core'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'facebook' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'facebook' )); ?>" value="<?php echo esc_attr($instance['facebook']); ?>" style="width:100%;" />
			</p>
			<p >
				<label for="<?php echo esc_attr($this->get_field_id( 'twitter' )); ?>"><?php esc_html_e('Twitter', 'apr-core'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'twitter' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'twitter' )); ?>" value="<?php echo esc_attr($instance['twitter']); ?>" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'google' )); ?>"><?php esc_html_e('Google Plus', 'apr-core'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'google' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'google' )); ?>" value="<?php echo esc_attr($instance['google']); ?>" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'instagram' )); ?>"><?php esc_html_e('Instagram', 'apr-core'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'instagram' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'instagram' )); ?>" value="<?php echo esc_attr($instance['instagram']); ?>" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'pinterest' )); ?>"><?php esc_html_e('Pinterest', 'apr-core'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'pinterest' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'pinterest' )); ?>" value="<?php echo esc_attr($instance['pinterest']); ?>" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'linkedin' )); ?>"><?php esc_html_e('Linkedin', 'apr-core'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'linkedin' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'linkedin' )); ?>" value="<?php echo esc_attr($instance['linkedin']); ?>" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'youtube' )); ?>"><?php esc_html_e('Youtube', 'apr-core'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'youtube' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'youtube' )); ?>" value="<?php echo esc_attr($instance['youtube']); ?>" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'dribble' )); ?>"><?php esc_html_e('Dribble', 'apr-core'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'dribble' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'dribble' )); ?>" value="<?php echo esc_attr($instance['dribble']); ?>" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'behance' )); ?>"><?php esc_html_e('Behance', 'apr-core'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'behance' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'behance' )); ?>" value="<?php echo esc_attr($instance['behance']); ?>" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'gmail' )); ?>"><?php esc_html_e('Gmail', 'apr-core'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'gmail' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'gmail' )); ?>" value="<?php echo esc_attr($instance['gmail']); ?>" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'rss' )); ?>"><?php esc_html_e('Rss', 'apr-core'); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'rss' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'rss' )); ?>" value="<?php echo esc_attr($instance['rss']); ?>" style="width:100%;" />
			</p>
		<?php
		}
	}
}